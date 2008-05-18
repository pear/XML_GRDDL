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

/**
 * Example: Discover if there are any GRDDL transformations
 * from Dan Connolly's w3 homepage.
 */

$url = 'http://www.w3.org/People/Connolly/';

//Load a new GRDDL driver, using PHP's internal XSL extension
$grddl = XML_GRDDL::factory('Xsl');

//Retrieve the URL, using content negotiation
$xml = $grddl->fetch($url);

//Inspect the XML, and make sure we're aware of the baseURI
$stylesheets = $grddl->inspect($xml, $url);

print "Transformations available for " . $url . ":\n";
var_dump($stylesheets). "\n\n";


//Use those transformations
$rdfXml = array();
foreach ($stylesheets as $n => $stylesheet) {
    $rdfXml[$n] = $grddl->transform($stylesheet, $xml);
}

foreach ($stylesheets as $n => $stylesheet) {
    print "Transformation " . $stylesheet . " produced:\n";
    print $rdfXml[$n] . "\n\n";
}


//I want to merge one or more RDF/XML documents
$result = array_reduce($rdfXml, array($grddl, 'merge'));
print "The RDF/XML which extracted from " . $url . " is:\n";
print $result;