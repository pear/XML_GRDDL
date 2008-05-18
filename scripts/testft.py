#!/usr/bin/env python
"""

Test harness for GRDDL test suite. Uses RDFLib to process test
manifest and perform graph isomorphism testing against expected
output.  Uses Sean B. Palmer's RDF Graph Isomorphism Tester

Options:
  -r, --run              path to a GRDDL implementation to use to process the 
                         source document (checking results)
  -u, --update           path to a GRDDL Implementation to use to process the 
                         source document
      --tester           The URI of an agent associated with the EARL test assertions.
                         A BNode is used if none is given                          
      --project          The URI of the EARL 'subject' (the implementation being tested).
                         A BNode is used if none is given
      --local            A boolean flag (false by default) which indicates whether or not
                         to run only the local tests                         

LICENSE: Open Source: Share and Enjoy.

GRDDL Test Workspace: http://www.w3.org/2001/sw/grddl-wg/td/

Copyright 2002-2007 World Wide Web Consortium, (Massachusetts
Institute of Technology, European Research Consortium for
Informatics and Mathematics, Keio University). All Rights
Reserved. This work is distributed under the W3C(R) Software License
  http://www.w3.org/Consortium/Legal/2002/copyright-software-20021231
in the hope that it will be useful, but WITHOUT ANY WARRANTY;
without even the implied warranty of MERCHANTABILITY or FITNESS FOR
A PARTICULAR PURPOSE.


"""

__version__ = "$Id$"

from pprint import pprint
from sets import Set
from rdflib.Namespace import Namespace
from rdflib.syntax.NamespaceManager import NamespaceManager
from rdflib import plugin,RDF,RDFS,URIRef,URIRef,Literal,Variable,BNode
from rdflib.store import Store
from cStringIO import StringIO
from rdflib.Graph import Graph,ReadOnlyGraphAggregate,ConjunctiveGraph
import sys, getopt
import os, tempfile
import urllib2

DC_NS = Namespace('http://purl.org/dc/elements/1.1/')
EARL = Namespace('http://www.w3.org/ns/earl#')

def compare(p, q): 
   return hash(Graph(p)) == hash(Graph(q))

class IsomorphicTestableGraph(Graph):
    """
    Ported from http://www.w3.org/2001/sw/DataAccess/proto-tests/tools/rdfdiff.py
     (Sean B Palmer's RDF Graph Isomorphism Tester)
    """
    def __init__(self, **kargs): 
        super(IsomorphicTestableGraph,self).__init__(**kargs)
        self.hash = None
        
    def internal_hash(self):
        """
        This is defined instead of __hash__ to avoid a circular recursion scenario with the Memory
        store for rdflib which requires a hash lookup in order to return a generator of triples
        """ 
        return hash(tuple(sorted(self.hashtriples())))

    def hashtriples(self): 
        for triple in self: 
            g = ((isinstance(t,BNode) and self.vhash(t)) or t for t in triple)
            yield hash(tuple(g))

    def vhash(self, term, done=False): 
        return tuple(sorted(self.vhashtriples(term, done)))

    def vhashtriples(self, term, done): 
        for t in self: 
            if term in t: yield tuple(self.vhashtriple(t, term, done))

    def vhashtriple(self, triple, term, done): 
        for p in xrange(3): 
            if not isinstance(triple[p], BNode): yield triple[p]
            elif done or (triple[p] == term): yield p
            else: yield self.vhash(triple[p], done=True)
      
    def __eq__(self, G): 
        """Graph isomorphism testing."""
        if not isinstance(G, IsomorphicTestableGraph): return False
        elif len(self) != len(G): return False
        elif list.__eq__(list(self),list(G)): return True # @@
        return self.internal_hash() == G.internal_hash()

    def __ne__(self, G): 
       """Negative graph isomorphism testing."""
       return not self.__eq__(G)

def runProcessor(processor,inputUri):
    if DEBUG:
        print >>sys.stderr, "running: ", processor + " " + inputUri
    return os.popen(processor + " " + inputUri,"r")    

def updateTest(processor,inputUri,outputUri):
    outputfilename = outputUri[outputUri.rfind('/')+1:]
    print >>sys.stderr, "Updating ",outputfilename
    outputfile = open(outputfilename,"w")
    output = runProcessor(processor,inputUri)
    outputfile.write(output.read())
    outputfile.close()

# Returns false when applying processor on inputUri differs from outputUri
def runTest(processor,inputUri,outputUri):
    output = runProcessor(processor,inputUri)
    outputfilename = outputUri[outputUri.rfind('/')+1:] + ".result"
    if DEBUG:
        print >>sys.stderr, "Saving result to ",outputfilename
    outputfile = open(outputfilename,"w")
    outputfile.write(output.read())
    outputfile.close()
    try:
        expected = IsomorphicTestableGraph().parse(outputUri, publicID=inputUri)
        actual = IsomorphicTestableGraph().parse(outputfilename,
                                                 publicID=inputUri)
    except:
        if DEBUG:
            print >>sys.stderr, "problems parsing result"
        return False
    if len(actual) != len(expected):
        if DEBUG:
            print >>sys.stderr, "Unequal lengths: expected = %s actual = %s"%(len(expected),len(actual))
    rt = actual == expected
    if DEBUG and actual != expected:
        print >>sys.stderr, "Missing: ", list(Set(list(expected)).difference(list(actual)))
    return rt

def process(action, processor, manifest, project, tester,localRun = False):
    data = Graph()
    data.parse(manifest)

    results = Graph()
    abbr = NamespaceManager(results)
    abbr.bind("foaf", "http://xmlns.com/foaf/0.1/")
    abbr.bind("earl", "http://www.w3.org/ns/earl#")
    if project:
        try:
            results.parse(project)
        except IOError:
            pass
        project = URIRef(project)
    else:
        project = BNode()
    if tester:
        try:
            results.parse(tester)
        except IOError:
            pass
        tester = URIRef(tester)
    else:
        tester = BNode()
    
    nsMapping = {
        u'test':Namespace('http://www.w3.org/2000/10/rdf-tests/rdfcore/testSchema#'),
        u'dc':DC_NS
    }
    GRDDL_TEST_NS = Namespace('http://www.w3.org/2001/sw/grddl-wg/td/grddl-test-vocabulary#')
    failures = set()
    reportMap = {}
    for descr,test,input,output in data.query("SELECT ?desc ?t ?i ?o WHERE { ?t test:inputDocument ?i. ?t a test:Test . ?t dc:title ?desc. ?t test:outputDocument ?o }",initNs=nsMapping):
        if DEBUG:
            print >>sys.stderr, "###", descr, "###"
            print >>sys.stderr, "\t",input
        if localRun and (test,RDF.type,GRDDL_TEST_NS.NetworkedTest) in data:
            if DEBUG:
                print >>sys.stderr, "\t Skipping networked test (local run only)"
            continue
        if action=="update":
            updateTest(processor,input,output)
        elif action=="run":
            r = runTest(processor,input,output)
            reportMap[test] = (results,tester,project,r)
            if not r:
                failures.add(test)

    hasFailure = False
    TESTING = Namespace('http://www.w3.org/2001/sw/grddl-wg/td/grddl-test-vocabulary#')
    passedByProxy = set()
    if len(failures) > 0:
        for failure in failures:
            #@@ Test subsumption RDF not currently generated by aboutTests.xsl
            subsuming = set(data.transitive_subjects(TESTING.subsumes, failure))
            s = subsuming.difference(failures)
            if len(s) > 0:
                print >>sys.stderr, "* %s failed, but subsuming test %s passed" \
                                    % (failure, list(s)[0])
                passedByProxy.add(failure)
                continue

            subsumes = set(data.transitive_objects(failure, TESTING.subsumes))
            s = subsumes.difference(failures)
            if len(s) > 0:
                print >>sys.stderr, "* %s failed, but subsumed test %s passed" \
                                    % (failure, list(s)[0])
                passedByProxy.add(failure)
                continue

            alternates = set(data.transitive_objects(
                               failure, TESTING.alternative)).union(
                         set(data.transitive_subjects(
                               TESTING.alternative, failure)))
            s = alternates.difference(failures)
            if len(s) > 0:
                print >>sys.stderr, "* %s failed, but alternate test %s passed" \
                                    % (failure, list(s)[0])
                passedByProxy.add(failure)
            else:
                print >>sys.stderr, "* %s failed" % failure
                hasFailure = True
    failures = failures.difference(passedByProxy)
    if not hasFailure and action=="run":
        print >>sys.stderr, "All tests were passed (or had an alternate test pass)!"
    for test,(results,tester,project,r) in reportMap.items():
        reportEarl(results, tester, project, test,
                   test in passedByProxy, test not in failures)
    return results

def somebody(g, name, homepage, who=None):
    """
    >>> g = Graph()
    >>> d = somebody(g, "Dan Connolly", "http://www.w3.org/People/Connolly/")
    >>> len(g)
    2
    """
    FOAF = Namespace("http://xmlns.com/foaf/0.1/")
    if not who:
        who = BNode()
    g.add((who, FOAF.name, Literal(name)))
    g.add((who, FOAF.homepage, URIRef(homepage)))
    #if email:
    #    g.add((who, FOAF.homepage, URIRef("mailto:%s" % email)))
    return who

def reportEarl(results, tester, subject, test, notApplicable, passed):
    """
    >>> g = Graph()
    >>> t = URIRef("http://www.w3.org/2001/sw/grddl-wg/td/testlist1#sq1a")
    >>> impl = URIRef("http://www.w3.org/2003/g/glean.py")
    >>> dc = somebody(g, "Dan Connolly", "http://www.w3.org/People/Connolly/")
    >>> r = reportEarl(g, dc, impl, t, True)
    >>> len(g)
    9
    >>> dc in g.objects(r, EARL.assertedBy)
    True
    >>> impl in g.objects(r, EARL.subject)
    True

    http://chatlogs.planetrdf.com/swig/2006-11-10.html#T15-13-57

    """
    # " help emacs

    # odd; no RDFS there
    result = BNode()
    results.add((result, RDF.type, EARL.TestResult)) # odd; why the indirection?
    if notApplicable:
      results.add((result, EARL.outcome, EARL.notApplicable))
    elif passed:
      results.add((result, EARL.outcome, EARL["pass"]))
    else:
      results.add((result, EARL.outcome, EARL.fail))

    assertion = BNode()
    results.add((assertion, RDF.type, EARL.Assertion))
    results.add((assertion, EARL.result, result))
    results.add((assertion, EARL.assertedBy, tester))
    results.add((assertion, EARL.subject, subject))
    results.add((assertion, EARL.test, test))
    return assertion

    
def main(argv=None):
    if argv is None: argv = sys.argv

    try:
        opts, args = getopt.getopt(argv[1:], "dhr:u:",
                                   ["help", "run=", "update=","debug","local",
                                    "project=", "tester=" # EARL
                                    ])
    except getopt.GetoptError:
        usage()
        return 2
    processor = None
    action = None
    tests = None
    project = None
    tester = None
    global DEBUG
    DEBUG=0
    localOnly = False
    for o, a in opts:
        if o == '--local':
            localOnly = True   
        if o in ("-d", "--debug"):
            DEBUG = 1
        if o in ("-h", "--help"):
            usage()
            return 0
        if o in ("-r", "--run"):
            processor = a
            action = "run"
        if o in ("-u", "--update"):
            processor = a
            action = "update"
        elif o in ("--tester",):
            tester = a
        elif o in ("--project",):
            project = a
    if not (processor and action and len(args) == 1):
        usage()
        return 2
    # URI of the list of tests
    tests = args[0]
    results = process(action, processor, tests, project, tester,localRun=localOnly)
    print results.serialize(format="pretty-xml")
    
    return 0

def usage():
    print __doc__
    print __version__

def _test():
    import doctest
    doctest.testmod()

if __name__ == '__main__':
    if '--test' in sys.argv: _test()
    else: sys.exit(main())
