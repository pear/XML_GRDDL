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

$tests[] = array('name' => 'An hcard profile',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/card.html',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/card-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/card-output.rdf');

$tests[] = array('name' => '2 profiles: eRDF and hCard',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/multiprofile.html',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/multiprofile-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/multiprofile-output.rdf');

$tests[] = array('name' => 'Namespace documents and media types 1',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/sq1.xml',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/sq1-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/sq1-output.rdf');

$tests[] = array('name' => 'Namespace documents and media types 2',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/sq2.xml',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/sq2-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/sq2-output.rdf');

$tests[] = array('name' => 'A variant of the card5n test',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/card5na.html',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/card5n-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/card5n-output.rdf');

$tests[] = array('name' => 'hcard from a 1998 review comment on P3P',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/card5n.html',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/card5n-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/card5n-output.rdf');

/** @todo   Determine just what the hell is correct behaviour */
$tests[] = array('name' => 'A copy of the hcard profile',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/hcard.html',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/hcard-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/hcard-output.rdf');

/** @bug issue 8 */
/*
$tests[] = array('name' => 'An XML document with two namespace transformations',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/two-transforms.xml',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/two-transforms-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/two-transforms-output.rdf');
*/

$tests[] = array('name' => 'An XML document with two namespace transformations and a transform on the root element',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/three-transforms.xml',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/three-transforms-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/three-transforms-output.rdf');

$tests[] = array('name' => 'An XML document with two namespace transformations and two transforms on the root element',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/four-transforms.xml',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/four-transforms-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/four-transforms-output.rdf');

/** @todo   Determine just what the hell is correct behaviour */
/*
$tests[] = array('name' => 'A variant of the hcard profile',
                 'in' => 'http://www.w3.org/2001/sw/grddl-wg/td/hcarda.html',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/hcard-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/hcard-output.rdf');
*/

$tests[] = array('name' => 'Document linking to its transformer through a GRDDL-enabled profile',
                 'in'  => 'http://www.w3.org/2001/sw/grddl-wg/td/xhtmlWithGrddlEnabledProfile.html',
                 'out' => 'http://www.w3.org/2001/sw/grddl-wg/td/xhtmlWithGrddlEnabledProfile-output.rdf',
                 'realistic' => dirname(__FILE__) . '/data/xhtmlWithGrddlEnabledProfile-output.rdf');
