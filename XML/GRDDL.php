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

require_once 'GRDDL/Exception.php';

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
class XML_GRDDL
{
    const NS       = "http://www.w3.org/2003/g/data-view#";
    const XHTML_NS = 'http://www.w3.org/1999/xhtml';
    const RDF_NS   = 'http://www.w3.org/1999/02/22-rdf-syntax-ns#';
    const XML_NS   = 'http://www.w3.org/XML/1998/namespace';

    /**
     * Instantiate a new instance of a GRDDL driver.
     *
     * @param string  $driver  Name of driver. Default is 'xsl'.
     * @param mixed[] $options An array of options, refer to individual drivers
     *                         document for more information.
     *
     * @see     getDefaultOptions()
     *
     * @return  XML_GRDDL_Driver
     */
    public static function factory($driver = 'Xsl', $options = array())
    {
        if (empty($options)) {
            $options = self::getDefaultOptions();
        }

        $class = 'XML_GRDDL_Driver_' . $driver;

        $path = 'XML/GRDDL/Driver/' . $driver . '.php';

        if (!@fclose(@fopen($path, 'r', true))) {
            throw new XML_GRDDL_Exception("Unknown driver " . $class);
        }

        include_once $path;

        return new $class($options);
    }

    /**
     * Helper method to fetch default options.
     *
     * @see     factory()
     *
     * @return  mixed[] An array of options
     */
    public static function getDefaultOptions()
    {
        return array('tidy'                       => true,
                     'prettify'                   => true,
                     'quiet'                      => false,
                     'formatOutput'               => true,
                     'documentTransformations'    => true,
                     'namespaceTransformations'   => true,
                     'htmlTransformations'        => true,
                     'htmlProfileTransformations' => true);
    }
}