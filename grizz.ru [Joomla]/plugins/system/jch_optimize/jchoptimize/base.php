<?php

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
 */
defined('_JEXEC') or die('Restricted access');

/**
 * Some basic utility functions required by the plugin and shared by class
 * 
 */
class JchOptimizeBase
{

        protected $sBodyHtml = '';
        protected $sHeadHtml = '';

        /**
         * Search area used to find js and css files to remove
         * 
         * @return string
         */
        public function getHeadHtml()
        {
                if ($this->sHeadHtml == '')
                {
                        $sHeadRegex   = $this->getHeadRegex();
                        $aHeadMatches = array();

                        if (preg_match($sHeadRegex, $this->sHtml, $aHeadMatches) === FALSE || empty($aHeadMatches))
                        {
                                throw new Exception(JText::_('Error occured while trying to match for search area.'
                                        . ' Check your template for open and closing head tags'));
                        }

                        $this->sHeadHtml = $aHeadMatches[0];
                }

                return $this->sHeadHtml;
        }
        
        /**
         * 
         * @return string
         */
        public function getBodyHtml()
        {
                return '';
        }

        /**
         * Fetches HTML to be sent to browser
         * 
         * @return string
         */
        public function getHtml()
        {
                $sHtml = preg_replace($this->getHeadRegex(), strtr($this->sHeadHtml, array('\\' => '\\\\', '$' => '\$')), $this->sHtml);

                if (is_null($sHtml) || $sHtml == '')
                {
                        throw new Exception(JText::_('Error occured while trying to get html'));
                }

                return $sHtml;
        }

        /**
         * Regex to find js links in search area
         * 
         * @return array
         */
        public function getJsRegex()
        {
                $aJsRegex = array();

                $aJsRegex[0] = '#<script';
                $aJsRegex[1] = '';
                $aJsRegex[2] = '(?=  (?>  [^\s>]*+[\s]  (?(?=  type=  )  type=["\']?text/javascript  )  )*+  [^\s>]*+>  )
                                (?:
                                        (?=  
                                                (?>  [^\s>]*+\s  )+?  src=["\']?
                                                (?=  (  [^"\'\s>]++  )  )
                                                (?:
                                                        (?>  (?=  [^/\s>?]*+[=/]  )  [^/\s>?]*+[=/]  )*+  (
                                                                                                        (?>  [^/>?.\'"]++\.  )+?  (?:';
                $aJsRegex[3] = '                                                                                                        js';
                $aJsRegex[4] = '                                                                                                   ) 
                                                                                                          )
                                                )';
                $aJsRegex[5] = '';
                $aJsRegex[6] = '        )
                                )';
                $aJsRegex[7] = '';
                $aJsRegex[8] = '[^>]*+>';
                $aJsRegex[9] = '';
                $aJsRegex[10] = '</script>#isx';

                return $aJsRegex;
        }

        /**
         * Regex to find css links in search area to remove
         * 
         * @return array
         */
        public function getCssRegex()
        {
                $aCssRegex          = array();
                
                $aCssRegex[0] = '#<link';
                $aCssRegex[1] = '';
                $aCssRegex[2] = '(?= 
                                        (?>
                                                [^\s>]*+[\s]  (?!
                                                                        (?:  itemprop  )  |  
                                                                        (?:  disabled  )  |  
                                                                        (?:  type=  (?!  ["\']?text/css  )  )  | 
                                                                        (?:  rel=  (?!  ["\']?stylesheet  )  )
                                                                ) 
                                        )*+  [^\s>]*+>
                                )
                                (?:
                                        (?=
                                                (?>  [^\s>]*+\s  )+?  href=["\']?
                                                (?=  (  [^"\'\s>]++  )  )
                                                (?:  
                                                        (?>  (?=  [^/\s>?]*+[=/]  )  [^/\s>?]*+[=/]  )*+  (
                                                                                                        (?>  [^/>?.\'"]++\. )+? (?:';
                $aCssRegex[3] = '                                                                                               css';
                $aCssRegex[4] = '                                                                                               )
                                                                                                           )
                                                        )';
                $aCssRegex[5] = '';
                $aCssRegex[6] = '       )
                                )';
                $aCssRegex[7] = '[^>]*+>';
                $aCssRegex[8] = '';
                $aCssRegex[9] = '#ix';

                return $aCssRegex;
        }

        /**
         * Determines if file requires http protocol to get contents (Not allowed)
         * 
         * @param string $sUrl
         * @return boolean
         */
        protected function isUrlFopenAllowed($sUrl)
        {
                return ((preg_match('#(?:.*\.php)#', $sUrl) === 1) || !JchOptimizeHelper::isInternal($sUrl));
        }

        /**
         * Excludes js files in editor folders
         * 
         * @param string $sUrl  File url
         * @return boolean
         */
        protected function isEditorsExcluded($sUrl)
        {
                return (preg_match('#/editors/#i', $sUrl));
        }

        /**
         * Regex for head search area
         * 
         * @return string
         */
        public function getHeadRegex()
        {
                return '#<head[^>]*+>(?><?[^<]*+)*?</head>#i';
        }

        ##########

        /**
         * Regex for body section in Html
         * 
         * @return string
         */
        public function getBodyRegex()
        {
                return '#<body[^>]*+>.*</body>#si';
        }

        ##########
}
