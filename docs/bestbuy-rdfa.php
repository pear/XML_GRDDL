<?php
/**
 * XML_GRDDL
 *
 * Copyright (c) 2008, Daniel O'Connor <daniel.oconnor@gmail.com>.
 * All rights reserved.
 *
 * PHP version 5
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
 * @version   SVN: $Id: digg-rdfa.php 261528 2008-06-23 11:20:59Z clockwerx $
 * @link      http://code.google.com/p/xmlgrddl/
 */

require_once 'XML/GRDDL.php';
require_once 'Log.php';

/**
 * An XML document with two namespace transformations
 *
 * Compare the results to
 * http://www.w3.org/2001/sw/grddl-wg/td/two-transforms-output.rdf
 */

$url = 'http://stores.bestbuy.com/577/fairless-hills-pa/products/open-box/frigidaire-30-freestanding-range/0012505540066/?uid=118';

$options = XML_GRDDL::getDefaultOptions();
$options['log'] = Log::singleton('console');
$grddl = XML_GRDDL::factory('xsl', $options);

$data = $grddl->fetch($url);

$data = $grddl->appendProfiles($data, array('http://ns.inria.fr/grddl/rdfa/'));

$stylesheets = $grddl->inspect($data, $url);

$rdfXml = array();
foreach ($stylesheets as $stylesheet) {
    $rdfXml[] = $grddl->transform($stylesheet, $data);
}

$result = array_reduce($rdfXml, array($grddl, 'merge'));

print $result;
