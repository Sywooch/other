<?php

use JchOptimize\Minify_HTMLi;

/**
 * JCH Optimize - Joomla! plugin to aggregate and minify external resources for
 * optmized downloads
 * @author Samuel Marshall <sdmarshall73@gmail.com>
 * @copyright Copyright (c) 2010 Samuel Marshall
 * @license GNU/GPLv3, See LICENSE file
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * If LICENSE file missing, see <http://www.gnu.org/licenses/>.
 *
 */
// No direct access
defined('_JEXEC') or die('Restricted access');

/**
 * Main plugin file
 * 
 */
class JchOptimize
{

        /** @var object   Plugin params * */
        public $params = null;

        /**
         * Optimize website by aggregating css and js
         *
         */
        public function process($sHtml)
        {
                global $_PROFILER;
                JCH_DEBUG ? $_PROFILER->mark('beforeProcess plgSystem (JCH Optimize)') : null;

                try
                {
                        $oParser = new JchOptimizeParser($this->params, $sHtml);

                        $oLinkBuilder = new JchOptimizeLinkBuilder($oParser);
                        $oLinkBuilder->insertJchLinks();

                        $sOptimizedHtml = $this->minifyHtml($oParser->getHtml());
                }
                catch (Exception $ex)
                {
                        JchOptimizeLogger::log($ex->getMessage(), $this->params);

                        $sOptimizedHtml = $sHtml;
                }

                spl_autoload_unregister('loadJchOptimizeClass');

                JCH_DEBUG ? $_PROFILER->mark('afterProcess plgSystem (JCH Optimize)') : null;
                
                return $sOptimizedHtml;
        }

        /**
         * Static method to initialize the plugin
         * 
         * @param type $params  Plugin parameters
         */
        public static function optimize($oParams, $sHtml)
        {
                $JchOptimize = new JchOptimize($oParams);
                return $JchOptimize->process($sHtml);
        }

        /**
         * Constructor
         * 
         * @param type $params  Plugin parameters
         */
        public function __construct($oParams)
        {
                $this->params = $oParams;

                if (!defined('JCH_DEBUG'))
                {
                        define('JCH_DEBUG', ($this->params->get('debug', 0) && JDEBUG));
                }

                if (!defined('JCH_VERSION'))
                {
                        define('JCH_VERSION', '4.0.3');
                }
        }

        /**
         * If parameter is set will minify HTML before sending to browser; 
         * Inline CSS and JS will also be minified if respective parameters are set
         * 
         * @return string                       Optimized HTML
         * @throws Exception
         */
        public function minifyHtml($sHtml)
        {
                global $_PROFILER;
                JCH_DEBUG ? $_PROFILER->mark('beforeMinifyHtml plgSystem (JCH Optimize)') : null;

                $oParams = $this->params;
                $aOptions = array();

                if ($oParams->get('css_minify', 0))
                {
                        $aOptions['cssMinifier'] = array('JchOptimize\Minify_CSSi', 'process');
                }

                if ($oParams->get('js_minify', 0))
                {
                        $aOptions['jsMinifier'] = array('JchOptimize\JSMinRegex', 'minify');
                }

                if ($oParams->get('html_minify', 0))
                {
                        $sHtmlMin = Minify_HTMLi::minify($sHtml, $aOptions);

                        if ($sHtmlMin == '')
                        {
                                JchOptimizeLogger::log(JText::_('Error while minifying HTML'), $oParams);

                                return $sHtml;
                        }

                        $sHtml = $sHtmlMin;
                }

                JCH_DEBUG ? $_PROFILER->mark('afterMinifyHtml plgSystem (JCH Optimize)') : null;

                return $sHtml;
        }

        /**
         * Splits a string into an array using any regular delimiter or whitespace
         *
         * @param string  $sString   Delimited string of components
         * @return array            An array of the components
         */
        public static function getArray($sString)
        {
                if (is_array($sString))
                {
                        return $sString;
                }

                $aArray = explode(',', trim($sString));
                $aArray = array_map(function($sValue)
                {
                        return trim($sValue);
                }, $aArray);

                return $aArray;
        }

        /**
         * Returns url of current host
         *
         * @return string    Url of current host
         */
        public function getHost()
        {
                $sWww = $this->oUri->toString(array('scheme', 'user', 'pass', 'host', 'port'));

                return $sWww;
        }

        /**
         * Determines if document is of html5 doctype
         * 
         * @return boolean
         */
        protected function isHtml5()
        {
                global $sHtml;

                if (preg_match('#^<!DOCTYPE html>#i', trim($sHtml)))
                {
                        return true;
                }
                else
                {
                        return false;
                }
        }

}
