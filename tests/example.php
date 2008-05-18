<?php
/**
 * XML_GRDDL
 *
 * Copyright (c) 2008, Daniel O'Connor <daniel.oconnor@gmail.com>.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the name of Daniel O'Connor nor the names of his
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @category  Semantic_Web
 * @package   XML_GRDDL
 * @author    Daniel O'Connor <daniel.oconnor@gmail.com>
 * @copyright 2008 Daniel O'Connor
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version   SVN: $Id$
 * @link      http://code.google.com/p/xmlgrddl/
 */

require_once 'XML/GRDDL.php';
require_once 'PHPUnit/Framework/Assert.php';
require_once 'Log.php';


/**
 * A PHP test runner for grddl tests.
 *
 * You might also be interested in
 * <code>python testft.py -r 'php process-grddl.php' --debug grddl-tests.rdf</code>
 */

$log = &Log::singleton('console', '', 'ident');

$options = XML_GRDDL::getDefaultOptions();

$options['quiet'] = false;

//See http://www.w3.org/TR/grddl-tests/#grddl-library
$tests = array();

//Localized Tests
require_once 'local.php';

//Namespace Documents and Absolute Locations
require_once 'namespaces.php';

// Library tests
require_once 'library.php';

// Ambiguous Infosets, Representations, and Traversals
require_once 'ambiguous.php';

foreach ($tests as $test) {

    try {
        $other_options = isset($test['options']) ? $test['options'] : array();
        $test_options  = array_merge($options, $other_options);

        $grddl = XML_GRDDL::factory('xsl', $test_options);

        $in = $grddl->fetch($test['in']);

        if (!file_exists($test['realistic'])) {
            file_put_contents($test['realistic'], $grddl->fetch($test['out']));
        }
        $out = "";
        if (!empty($test['realistic'])) {
            $out = $grddl->fetch($test['realistic']);
        }

        $stylesheets = $grddl->inspect($in, $test['in']);

        $rdfXml = array();
        foreach ($stylesheets as $stylesheet) {
            $rdfXml[] = $grddl->transform($stylesheet, $in);
        }

        $result = array_reduce($rdfXml, array($grddl, 'merge'));

        print $test['name'] . "\n";
        PHPUnit_Framework_Assert::assertSame(trim($grddl->prettify($out)),
                                             trim($grddl->prettify($result)));
        print "\tPHP tests: Pass\n\n";

    } catch (PHPUnit_Framework_AssertionFailedError $e) {
        print "\tPHP tests: ";
        print $e->toString() . "\n\n";

        print $test['realistic'] . "\n";
        print "Got:\n";
        print $result . "\n";
        print "Expected:\n";
        print $out . "\n\n";
    } catch (Exception $e) {
        print $e->getMessage();
        print_r($e->getTrace());
    }

}
