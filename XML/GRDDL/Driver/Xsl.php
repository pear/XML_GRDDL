<?php
/**
 * XML_GRDDL
 *
 * PHP version 5
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

require_once 'XML/GRDDL/Driver.php';

/**
 * A driver for PHP 5's XSL extension.
 *
 * Requires PHP 5.2.6, XSL extension
 *
 * @category Semantic_Web
 * @package  XML_GRDDL
 * @author   Daniel O'Connor <daniel.oconnor@gmail.com>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://code.google.com/p/xmlgrddl/
 */
class XML_GRDDL_Driver_Xsl extends XML_GRDDL_Driver
{
    /**
     * Make a new instance of XML_GRRDL_Driver_XSL directly
     *
     * @param mixed[] $options An array of driver specific options
     *
     * @todo Document driver specific options!
     *
     * @see XML_GRDDL::factory()
     *
     * @return  void
     */
    public function __construct($options = array())
    {
        if (!extension_loaded('xsl')) {
            throw new XML_GRDDL_Exception("Don't forget to enable the xsl extension");
        }

        parent::__construct($options);
    }

    /**
     * Transform the given XML with the provided XSLT.
     *
     * @param string $stylesheet URL or file location of an XSLT transformation
     * @param string $xml        String of XML
     *
     * @return  string  Transformed document contents.
     */
    public function transform($stylesheet, $xml)
    {
        if (empty($stylesheet) || empty($xml)) {
            $this->logger->log("Given empty stylesheet or xml");
            return $xml;
        }

        $oldCwd = getcwd();

        $paths = array();

        $paths[] = '@DATADIR@/@package_name@/data/grddl-library/';
        $paths[] = dirname(__FILE__) . '/../../../data/grddl-library/';

        foreach ($paths as $path) {
            if (file_exists($path)) {
                chdir($path);
                break;
            }
        }

        if (getcwd() == $oldCwd) {
            $this->logger->log("Could not access standard transform library");
            //throw new XML_GRDDL_Exception("Could not access standard transform library");
        }

        try {
            $this->logger->log("Attempting to transform with " . $stylesheet);

            //Cheat: set cwd() to an xslt library dir?
            $dom = new DOMDocument('1.0');
            $dom->loadXML($xml);


            $xslt = $this->fetch($stylesheet, 'xsl');

            $xsl = new DOMDocument();
            $xsl->loadXML($xslt, LIBXML_NOCDATA | LIBXML_NOENT);

            set_error_handler(array($this, 'handleTransformationErrorMessage'));

            $proc = new XSLTProcessor();
            $proc->importStyleSheet($xsl);

            $result = $proc->transformToXML($dom);
            restore_error_handler();

            $this->logger->log("Transformed successfully with " . $stylesheet);

            return $result;
        } catch (XML_GRDDL_Exception $e) {
            restore_error_handler();
            chdir($oldCwd);

            throw $e;
        }
    }

    /**
     * Handle generated error messages
     *
     * @param string   $errno      Error number
     * @param string   $errstr     Error message
     * @param string   $errfile    Error file
     * @param string   $errline    Error line
     * @param string[] $errcontext Error context
     *
     * @throws  XML_GRDDL_Exception
     * @return  void
     */
    public function handleTransformationErrorMessage($errno, $errstr, $errfile, $errline,
                                                     $errcontext = array())
    {
        throw new XML_GRDDL_Exception($errstr);
    }
}