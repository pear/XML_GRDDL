<?php
$tests[] = array('name' => 'Namepace Loop',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/loop.xml',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/loop-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/loop-output.rdf');

/*
In this test case, the input file uses XInclude to reference xinclude2.xml, and the output has only one triple unless the XML Processor of the GRDDL implementation supports XInclude. The output for this case assumes that the processor does resolve XIncludes. This test case (and the one that follows) exercises the Working Group's resolution regarding faithful infosets. In particular, the output illustrates a situation where the XML processor employed invokes XInclude processing at a low-level and presents the expanded result infoset [XINCLUDE] to the higher-level application (the GRDDL-aware agent. See: 1.1 Relationship to XLink [XINCLUDE]).
This pair of tests anticipate that the resolution of TAG issue xmlFunctions-34 will provide further guidance concerning them.
*/
/** @bug issue 16 */
/*
$tests[] = array('name' => 'Testing GRDDL when XInclude processing is enabled',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/xinclude1.html',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/xinclude1.rdf',
                 'realistic' => dirname(__FILE__) . '/data/xinclude1.rdf',
                 'options' => array('xinclude' => true));
*/
/*
This test case is an alternative to the XInclude enabled test case. The output for this case assumes that the processor does not resolve XIncludes, which may lead to a different GRDDL result. Note that the unexpanded infoset and its corresponding XPath Data Model (See: B XML Information Set Mapping [XPATH]) could instead have been presented to an XProc pipeline with an explicit XInclude component.
*/
$tests[] = array('name' => 'Testing GRDDL when XInclude processing is disabled',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/xinclude1.html',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/noxinclude1.rdf',
                 'realistic' => dirname(__FILE__) . '/data/noxinclude1.rdf',
                 'options' => array('xinclude' => false));

/*
Note that the input is an RDF document with a GRDDL transformation, and that according to the rules given by the GRDDL Specification, there are three distinct and equally valid output graphs for this test for this document. This output is a graph that is merge of the graph given by the source document with the graph given by the result of the GRDDL transformation.
*/
$tests[] = array('name' => 'Testing GRDDL attributes on RDF documents',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/grddlonrdf.rdf',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/grddlonrdf-output3.rdf',
                 'realistic' => dirname(__FILE__) . '/data/grddlonrdf-output3.rdf');

$tests[] = array('name' => 'Spaces in rel attribute',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/spaces-in-rel.html',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/spaces-in-rel-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/spaces-in-rel-output.rdf');

/** @bug    Skipped, these tests are weird */
///*
//The layering tests, permit arbitrary nesting (up to depth 9) of HTML profiles and XML namespaces. The general pattern is:
//    o Take a string $V matching ((ns|pf)-){0-8}.
//    o The document ns-$Vfnd is an xml document with namespace $Vfnd.
//    o The document pf-$Vfnd is an xhtml document with profile $Vfnd.
//    o The RDF/XML document fnd specifies appropriate transformations, so that every possible stack have GRDDL results. These are all different.
//    o The output document fnd-$Voutput.srdf is the correct answer.
//
//An HTML document which has a profile being an HTML document, which has a profile being an HTML document, which has a profile being an XML document, which has an RDF namespace document.
//*/
//$tests[] = array('name' => 'Recursion 1',
//                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/pf-pf-pf-ns-fnd',
//                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/fnd-pf-pf-pf-ns-output.srdf',
//                 'realistic' => dirname(__FILE__) . '/data/fnd-output.srdf');
//                 //'realistic' => dirname(__FILE__) . '/data/fnd-pf-pf-pf-ns-output.srdf');
///*
//An XML document which has an XML namespace document, which has an HTML namespace document, which has a profile being an HTML document, which has a profile being an RDF document.
//*/
///** @bug Missing output ? Could be http://www.w3.org/2001/sw/grddl-wg/td/fnd-output.srdf */
//$tests[] = array('name' => 'Recursion 2',
//                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/ns-ns-pf-pf-fnd',
//                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/fnd-ns-ns-pf-pf-output',
//                 'realistic' => dirname(__FILE__) . '/data/fnd-output.srdf');
//                 //'realistic' => dirname(__FILE__) . '/data/fnd-ns-ns-pf-pf-output');
//
///*
//An XML document which has an HTML namespace document, which has a profile being an XML document, which has an HTML namespace document, which has a profile being an XML document, which has an RDF namespace document.
//*/
///** @bug Missing output ? Could be http://www.w3.org/2001/sw/grddl-wg/td/fnd-output.srdf */
//$tests[] = array('name' => 'Recursion 3',
//                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/ns-pf-ns-pf-ns-fnd',
//                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/fnd-ns-pf-ns-pf-ns-output',
//                 'realistic' => dirname(__FILE__)  . '/data/fnd-output.srdf');
//                 //'realistic' => dirname(__FILE__) . '/data/fnd-ns-pf-ns-pf-ns-output');


/*
The following four tests demonstrate GRDDL results for a self-referencing input document. Unlike other tests of this kind, the last of these - the maximal result - is not exlusive. This reflects an interpretation of SHOULD as used in section 7. GRDDL-Aware Agents of [GRDDL] with regards to the computation of GRDDL results. In particular, this interpretation and the text in the section that follows (8. Security considerations) permits an implementation to only pass the first test due to security restrictions against computing recursive GRDDL results.

For this particular test, an XML document is its own namespace document, with a GRDDL transformation, specifying a namespaceTransformation, which specifies a further namespaceTransformation. This result is the first possible GRDDL result. Implementations that make no allowance for such cases may produce this result. Documents authors are advised against having information resources whose GRDDL results depend on other GRDDL results for the same resource.
*/

// We'll try to avoid passing this one.
//$tests[] = array('name' => 'Namespace loops',
//                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/loopx.xml',
//                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/loopx-output1.rdf',
//                 'realistic' => dirname(__FILE__) . '/data/loopx-output1.rdf');

/*
An XML document is its own namespace document, with grddl transformation, specifying a namespaceTransformation, which specifies a further namespaceTransformation. This result is the merge of the first two possible GRDDL results. Implementations that make no special allowance for or prohibition of such cases may produce this result. Documents authors are advised against having information resources whose GRDDL results depend on other GRDDL results for the same resource.
*/
// We'll try to avoid passing this one.
$tests[] = array('name' => 'Namespace loops',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/loopx.xml',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/loopx-output2.rdf',
                 'realistic' => dirname(__FILE__) . '/data/loopx-output2.rdf');

/*
An XML document is its own namespace document, with grddl transformation, specifying a namespaceTransformation, which specifies a further namespaceTransformation. This result is the merge of the first three possible GRDDL results. Implementations that make no special allowance for or prohibition of such cases may produce this result. Documents authors are advised against having information resources whose GRDDL results depend on other GRDDL results for the same resource.
*/
//$tests[] = array('name' => 'Namespace loops',
//                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/loopx.xml',
//                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/loopx-output3.rdf',
//                 'realistic' => dirname(__FILE__) . '/data/loopx-output3.rdf');

/*
An XML document is its own namespace document, with a GRDDL transformation, specifying a namespaceTransformation, which specifies a further namespaceTransformation. This result is the merge of all possible GRDDL results. Documents authors are advised against having information resources whose GRDDL results depend on other GRDDL results for the same resource.
*/
//$tests[] = array('name' => 'Namespace loops',
//                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/loopx.xml',
//                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/loopx-output.rdf',
//                 'realistic' => dirname(__FILE__) . '/data/loopx-output.rdf');

/*
Two transforms apply to this document, following rules in both sections 2 and 4 of the specification.
*/
$tests[] = array('name' => 'HTML document with transformation attribute on root',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/html-and-grddl-xform-attr.html',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/two-transforms-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/two-transforms-output.rdf');
/*
An XHTML file with a profile whose interpretation through GRDDL gives a transformation for the said XHTML file; the document also specifies the GRDDL profile, and a transformation.
*/
$tests[] = array('name' => 'Document linking to its transformer through a GRDDL-enabled profile, and with in-line transformation',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/xhtmlWithGrddlEnabledProfileAndInBodyTransform.html',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/xhtmlWithGrddlEnabledProfileAndInBodyTransform-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/xhtmlWithGrddlEnabledProfileAndInBodyTransform-output.rdf');
/*
An XHTML file with a profile whose interpretation through GRDDL gives a transformation for the said XHTML file; the document also specifies a transformation, but omits to specify the GRDDL profile.
*/
$tests[] = array('name' => 'Document linking to its transformer through a GRDDL-enabled profile, and with in-line transformation',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/xhtmlWithGrddlEnabledProfileAndADisabledInBodyTransform.html',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/xhtmlWithGrddlEnabledProfileAndADisabledInBodyTransform-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/xhtmlWithGrddlEnabledProfileAndADisabledInBodyTransform-output.rdf');

/*
This test differs from the previous example of applying GRDDL to an RDF/XML document in that the RDF file is served (not best practice, but rather common) as media-type "application/xml". The output is a graph that is merge of the graph given by the source document with the graph given by the result of the GRDDL transformation.
*/
$tests[] = array('name' => 'Testing GRDDL attributes on RDF documents with XML media type',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/grddlonrdf-xmlmediatype.rdf',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/grddlonrdf-xmlmediatype-output3.rdf',
                 'realistic' => dirname(__FILE__) . '/data/grddlonrdf-xmlmediatype-output3.rdf');
/*
This test exists to bring attention to developers to issues of content negotiation, in particular, content negotiation over language as described and implemented by W3C QA. There are two valid resulting GRDDL results of running this GRDDL transformation depending on what language the GRDDL-aware agent uses, and an implementation of a GRDDL-aware agent only needs to retrieve the one that is appropriate for its HTTP header request. This result follows from retrieving a English version of the HTML representation and thus having the GRDDL result produce a result with English-language content.
*/

//We can't do this content negotiation properly
//$tests[] = array('name' => 'Content Negotiation with GRDDL (1 of 2)',
//                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/conneg.html',
//                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/conneg-en.rdf',
//                 'realistic' => dirname(__FILE__) . '/data/conneg-en.rdf');

//We can't do this content negotiation properly
///*
//This result follows from retrieving a German version of the HTML representation and thus having the GRDDL result produce a result with German-language content.
//*/
//$tests[] = array('name' => ' Content Negotiation with GRDDL (2 of 2)',
//                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/conneg.html',
//                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/conneg-de.rdf',
//                 'realistic' => dirname(__FILE__) . '/data/conneg-de.rdf');
///*
//A GRDDL aware agent may retrieve both representations, for example, by using transparent content negotiation. This GRDDL result is the merge of the previous two.
//*/
//$tests[] = array('name' => ' Content Negotation with GRDDL (3 of 3)',
//                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/conneg.html',
//                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/conneg-output.rdf',
//                 'realistic' => dirname(__FILE__) . '/data/conneg-output.rdf');
/*
This test gives the GRDDL result of the HTML representation.
*/
$tests[] = array('name' => 'Multiple Representations (HTML)',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/multipleRepresentations.html',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/multipleRepresentationsHtml-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/multipleRepresentationsHtml-output.rdf');
/*
This test gives the GRDDL result of the SVG representation.
*/
$tests[] = array('name' => 'Multiple Representations (SVG)',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/multipleRepresentations.svg',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/multipleRepresentationsSvg-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/multipleRepresentationsSvg-output.rdf');
/*
This GRDDL result is the merge of the previous two.

@bug    NFI?
*/
$tests[] = array('name' => 'Multiple Representations (both)',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/multipleRepresentations',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/multipleRepresentationsBoth-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/multipleRepresentationsBoth-output.rdf');


$tests[] = array('name' => 'An html document with a base element',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/base/xhtmlWithBaseElement.html',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/xhtmlWithBaseElement-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/xhtmlWithBaseElement-output.rdf');

$tests[] = array('name' => 'A similar html document without a base element',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/base/xhtmlWithoutBaseElement.html',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/xhtmlWithoutBaseElement-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/xhtmlWithoutBaseElement-output.rdf');


$tests[] = array('name' => 'A redirected html document with a base element',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/xhtmlWithBaseElement.html',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/xhtmlWithBaseElement-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/xhtmlWithBaseElement-output.rdf');

$tests[] = array('name' => 'A similar redirected html document without a base element',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/xhtmlWithoutBaseElement.html',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/xhtmlWithoutBaseElement-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/xhtmlWithoutBaseElement-output.rdf');

/*
This test case exercises resolution of relative references found in the GRDDL results for a general XML document. In this case, according to RFC 3986, section 5.1, a base URI for the relative reference is recursively discovered on the encapsulating entity for the GRDDL results, which is the root element of the input document, in order to maintain fidelity to the faithful rendition requirement. The root element assigns the base URI using the mechanism described in XML Base.
*/
$tests[] = array('name' => ' An xml document with an xml:base attribute',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/base/xmlWithBase.xml',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/xmlWithBase-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/xmlWithBase-output.rdf');
/*
This test case exercises resolution of relative references found in the GRDDL results for a general XML document. In this case, according to RFC 3986, section 5.1, a base URI for the relative reference is recursively discovered to be the URI used to retrieve the input document, since no base URI is assigned in the content of the encapsulating entity (that is, the root element of the input document).
*/
$tests[] = array('name' => 'A similar xml document without an xml:base attribute',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/base/xmlWithoutBase.xml',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/xmlWithoutBase-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/xmlWithoutBase-output.rdf');
/*
This test case exercises resolution of relative references found in the GRDDL results for a general XML document when that document is resolved through a protocol redirection mechanism. The base URI for these relative references is established by the xml:base attribute on the root element, as for "An xml document with an xml:base attribute".
*/

$tests[] = array('name' => 'A redirected xml document with an xml:base attribute',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/xmlWithBase.xml',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/xmlWithBase-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/xmlWithBase-output.rdf');
/*
This test case exercises resolution of relative references found in the GRDDL results for a general XML document when that document is resolved through a protocol redirection mechanism. The base URI of the document is the target URI of the last redirection step; after establishing this fact, this test case follows the same behavior as "A similar xml document without an xml:base attribute".
*/
$tests[] = array('name' => 'A similar redirected xml document without an xml:base attribute',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/xmlWithoutBase.xml',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/xmlWithoutBase-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/xmlWithoutBase-output.rdf');
