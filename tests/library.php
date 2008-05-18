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

$tests[] = array('name' => 'Embedded RDF1',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/inline-rdf1.xml',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/embedded-rdf1-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/embedded-rdf1-output.rdf');

$tests[] = array('name' => 'Embedded RDF2',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/inline-rdf2.xml',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/embedded-rdf2-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/embedded-rdf2-output.rdf');

$tests[] = array('name' => 'Embedded RDF3',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/inline-rdf3.xml',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/embedded-rdf3-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/embedded-rdf3-output.rdf');

$tests[] = array('name' => 'Glean Profile',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/profile-with-spaces-in-rel.html',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/profile-with-spaces-in-rel-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/profile-with-spaces-in-rel-output.rdf');

/* @bug    Fails this test, incorrect xml:base attribute being rendered */

$tests[] = array('name' => 'Embedded RDF using a relative xml:base',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/inline-rdf4.xml',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/embedded-rdf4-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/embedded-rdf4-output.rdf');

/*
'The base IRI of other XML documents

When an xml:base attribute is present on the root element of an XML document, this specifies the base IRI for that document, following section 5.1.1 of RFC 3986.

When there is no xml:base attribute on the root element, even if there is such an attribute on a descendent element, then section 5.1.1 of RFC 3986 does not apply.'
*/
$tests[] = array('name' => 'Embedded RDF using an absolute xml:base',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/inline-rdf5.xml',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/embedded-rdf5-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/embedded-rdf5-output.rdf');

$tests[] = array('name' => 'Embedded RDF using two nested absolute xml:base',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/inline-rdf6.xml',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/embedded-rdf6-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/embedded-rdf6-output.rdf');

$tests[] = array('name' => 'Embedded RDF using two different xml:base on two different blocks of RDF',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/inline-rdf8.xml',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/embedded-rdf8-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/embedded-rdf8-output.rdf');


$tests[] = array('name' => 'Embedded RDF using two different xml:lang on two different blocks of RDF',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/inline-rdf9.xml',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/embedded-rdf9-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/embedded-rdf9-output.rdf');

$tests[] = array('name' => 'An XHTML profile using a base element',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/base/grddlProfileWithBaseElement.html',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/grddlProfileWithBaseElement-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/grddlProfileWithBaseElement-output.rdf');

$tests[] = array('name' => 'XHTML with an XHTML profile using a base element',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/xhtmlProfileBase1.html',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/xhtmlProfileBase1-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/xhtmlProfileBase1-output.rdf');
