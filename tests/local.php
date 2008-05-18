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


$tests[] = array('name' => 'P3P work-alike',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/xmlWithGrddlAttribute.xml',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/xmlWithGrddlAttribute-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/xmlWithGrddlAttribute-output.rdf');

$tests[] = array('name' => 'Get RDF from a spreadsheet',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/projects.xml',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/projects.rdf',
                 'realistic' => dirname(__FILE__) . '/data/projects.rdf');

$tests[] = array('name' => 'RDFa example',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/rdf_sem.html',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/rdf_sem-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/rdf_sem-output.rdf');

$tests[] = array('name' => 'Inline transformation reference',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/inline.html',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/inline.rdf',
                 'realistic' => dirname(__FILE__) . '/data/inline.rdf');

$tests[] = array('name' => 'Base URI: Same document reference',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/baseURI.html',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/baseURI.rdf',
                 'realistic' => dirname(__FILE__) . '/data/baseURI.rdf');

$tests[] = array('name' => 'Title / Author (from specification)',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/titleauthor.html',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/titleauthor-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/titleauthor-output.rdf');

$tests[] = array('name' => 'RDF/XML document',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/projects.rdf',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/projects.rdf',
                 'realistic' => dirname(__FILE__) . '/data/projects.rdf');


$tests[] = array('name' => 'One transform linked from the head of a document with only the GRDDL profile',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/xhtmlWithGrddlProfile.html',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/xhtmlWithGrddlProfile-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/xhtmlWithGrddlProfile-output.rdf');


$tests[] = array('name' => 'One transform linked from the body of a document with only the GRDDL profile',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/xhtmlWithGrddlTransformationInBody.html',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/xhtmlWithGrddlTransformationInBody-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/xhtmlWithGrddlTransformationInBody-output.rdf');


$tests[] = array('name' => 'One transform linked from the head of a document with several profiles, including the GRDDL profile',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/xhtmlWithMoreThanOneProfile.html',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/xhtmlWithTwoTransformations-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/xhtmlWithTwoTransformations-output.rdf');


$tests[] = array('name' => 'Two transformations linked from the body of a document with the GRDDL profile',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/xhtmlWithMoreThanOneGrddlTransformation.html',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/xhtmlWithTwoTransformations-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/xhtmlWithTwoTransformations-output.rdf');


$tests[] = array('name' => 'XML document linking to its transformer through the GRDDL attribute',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/xmlWithGrddlAttributeAndNonXMLNamespaceDocument.xml',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/xmlWithGrddlAttributeAndNonXMLNamespaceDocument-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/xmlWithGrddlAttributeAndNonXMLNamespaceDocument-output.rdf');
