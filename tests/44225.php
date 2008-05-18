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

/**
 * @bug http://bugs.php.net/bug.php?id=44225
 */

$xml = "http://www.w3.org/2001/sw/grddl-wg/td/xhtmlWithMoreThanOneGrddlTransformation.html";

$stylesheet = "http://www.w3.org/2001/sw/grddl-wg/td/getAuthor.xsl";

$dom = new DOMDocument('1.0');
$dom->load($xml);

$xsl = new DOMDocument();
$xsl->load($stylesheet);

$proc = new XSLTProcessor();
$proc->importStyleSheet($xsl);


print $proc->transformToXML($dom);


phpinfo(8);

/*
C:\>xsltproc http://www.w3.org/2001/sw/grddl-wg/td/getAuthor.xsl http://www.w3.org/2001/sw/grddl-wg/td/xhtmlWithMoreThanOneGrddlTransformation.html

<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:foaf="http://xmlns.com/foaf/0.1/">
  <rdf:Description rdf:about="">
    <dc:creator xmlns:dc="http://purl.org/dc/elements/1.1/" rdf:parseType="Resource">
      <foaf:homepage rdf:resource="http://www.w3.org/People/Dom/"/>
    </dc:creator>
  </rdf:Description>
</rdf:RDF>


C:\>xsltproc --version
Using libxml 20630, libxslt 10122 and libexslt 813
xsltproc was compiled against libxml 20630, libxslt 10122 and libexslt 813
libxslt 10122 was compiled against libxml 20630
libexslt 813 was compiled against libxml 20630
*/
