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
 * 
 * 
 */
class JchOptimizeCssParser
{

        public $aUrl        = array();
        public $sLnEnd      = '';
        public $params;
        protected $bBackend = FALSE;

        /**
         * 
         * @param type $sLnEnd
         * @param type $bBackend
         */
        public function __construct($oParser, $bBackend = 'FALSE')
        {
                $this->sLnEnd   = $oParser->sLnEnd;
                $this->params   = $oParser->params;
                $this->bBackend = $bBackend;
        }

        /**
         * 
         * @param type $sContent
         * @return type
         */
        public function handleMediaQueries($sContent)
        {
                if ($this->bBackend)
                {
                        return $sContent;
                }

                $sCommentRegex = '#COMMENT_START.*?COMMENT_END#';

                if (isset($this->aUrl['media']) && ($this->aUrl['media'] != ''))
                {
                        $sMedia   = $this->aUrl['media'];
                        $sContent = preg_replace(array($sCommentRegex, '#DELIMITER#'), '', $sContent);
                        $sContent = preg_replace_callback("#@media ([^{]*+)#i", array($this, '_mediaFeaturesCB'), $sContent);
                        $sContent = preg_replace('#' . self::nestedAtRulesRegex() . '#',
                                                 '}' . $this->sLnEnd . '$0' . $this->sLnEnd . '@media ' . $sMedia . ' {' . $this->sLnEnd, $sContent);

                        $sContent = '@media ' . $sMedia . ' {' . $this->sLnEnd . $sContent . $this->sLnEnd . ' }' . $this->sLnEnd;

                        $sContent = preg_replace('#@media[^{]*+{[^\S}]*+}#', '', $sContent);
                }

                return $sContent;
        }

        /**
         * 
         * @return string
         */
        public static function nestedAtRulesRegex()
        {
                return '@(?:-[^-]+-)?(?:media|font-face|page|keyframes|supports|document)[^{]*+(?<b>{(?>[^{}]++|(?&b))*+})';
        }

        /**
         * 
         * @return string
         */
        public static function cssDeclarationRegex()
        {
                return '(?<=^|[{}\s;/])([^@{}/]*+)\{[^{}]*+\}';
        }

        /**
         * 
         * @param type $aMatches
         * @return type
         */
        protected function _mediaFeaturesCB($aMatches)
        {
                return '@media ' . $this->combineMediaFeatures($this->aUrl['media'], $aMatches[1]);
        }

        /**
         * 
         * @param type $sMediaFeatures1
         * @param type $sMediaFeatures2
         * @return type
         */
        protected function combineMediaFeatures($sMediaFeatures1, $sMediaFeatures2)
        {
                $aMediaFeatures1 = preg_split('#\bor\b|,#i', $sMediaFeatures1);
                $aMediaFeatures2 = preg_split('#\bor\b|,#i', $sMediaFeatures2);

                $aMediaFeatures = array();

                foreach ($aMediaFeatures1 as $sMediaFeature1)
                {
                        $sMediaFeature1 = trim($sMediaFeature1);

                        foreach ($aMediaFeatures2 as $sMediaFeature2)
                        {
                                $sMediaFeature2 = trim($sMediaFeature2);

                                $aFeatures = array_unique(array_merge(preg_split('#\s+?and\s+#i', $sMediaFeature1),
                                                                                 preg_split('#\s+?and\s+#i', $sMediaFeature2)));

                                $aMediaFeatures[] = implode(' and ', $aFeatures);
                        }
                }



                return implode(', ', $aMediaFeatures);
        }

        /**
         * 
         * @param string $sContent
         * @param type $sAtRulesRegex
         * @param type $sUrl
         * @return string
         */
        public function removeAtRules($sContent, $sAtRulesRegex, $sUrl = array('url' => 'CSS'))
        {
                if (preg_match_all($sAtRulesRegex, $sContent, $aMatches) === FALSE)
                {
                        JchOptimizeLogger::log(JText::_('Error parsing for at rules in ' . $sUrl['url']), $this->params);

                        return $sContent;
                }

                if (!empty($aMatches[0]))
                {
                        $sAtRules = implode($this->sLnEnd, $aMatches[0]);

                        $sContentReplaced = str_replace($aMatches[0], '', $sContent);

                        $sContent = $sAtRules . $sContentReplaced;
                }

                return $sContent;
        }

        /**
         * Converts url of background images in css files to absolute path
         * 
         * @param string $sContent
         * @return string
         */
        public function correctUrl($sContent)
        {
                $sCorrectedContent = preg_replace_callback('#url\([\'"]?([^\'"\)]+)[\'"]?\)#i', array(__CLASS__, '_correctUrlCB'), $sContent);

                if (is_null($sCorrectedContent))
                {
                        throw new Exception(JText::_('Failed correcting urls of background images'));
                }

                $sContent = $sCorrectedContent;

                return $sContent;
        }

        /**
         * Callback function to correct urls in aggregated css files
         *
         * @param array $aMatches Array of all matches
         * @return string         Correct url of images from aggregated css file
         */
        protected function _correctUrlCB($aMatches)
        {
                $sUriBase    = str_replace('/administrator', '', JUri::base(TRUE));
                $sImageUrl   = $aMatches[1];
                $sCssFileUrl = isset($this->aUrl['url']) ? $this->aUrl['url'] : '/';

                if (!preg_match('#^/|://|^data:#', $sImageUrl))
                {
                        $aCssUrlArray = explode('/', $sCssFileUrl);
                        array_pop($aCssUrlArray);
                        $sCssRootPath = implode('/', $aCssUrlArray) . '/';
                        $sImagePath   = $sCssRootPath . $sImageUrl;
                        $oUri         = JURI::getInstance($sImagePath);
                        $sUriPath     = preg_replace('#^' . preg_quote($sUriBase, '#') . '/#', '', $oUri->getPath());
                        $oUri->setPath($sUriBase . '/' . $sUriPath);
                        $sImageUrl    = $oUri->toString();
                }

                if (JchOptimizeHelper::isInternal($sCssFileUrl))
                {
                        if (JchOptimizeHelper::isInternal($sImageUrl))
                        {
                                $oUri      = JURI::getInstance($sImageUrl);
                                $sImageUrl = $oUri->toString(array('path', 'query', 'fragment'));
                        }
                }

                return 'url(' . $sImageUrl . ')';
        }

        /**
         * Sorts @import and @charset as according to w3C <http://www.w3.org/TR/CSS2/cascade.html> Section 6.3
         *
         * @param string $sCss       Combined css
         * @return string           CSS with @import and @charset properly sorted
         * @todo                     replace @imports with media queries
         */
        public function sortImports($sCss)
        {
                $sCssMediaImports = preg_replace_callback('#@media\s([^{]++)({(?>[^{}]++|(?2))*+})#i', array(__CLASS__, '_sortImportsCB'), $sCss);

                if (is_null($sCssMediaImports))
                {
                        JchOptimizeLogger::log(JText::_('Failed matching for imports within media queries in css'), $this->params);

                        return $sCss;
                }

                $sCss = $sCssMediaImports;

                $sCss = preg_replace('#@charset[^;}]++;#i', '', $sCss);
                $sCss = $this->removeAtRules($sCss, '#@import[^;}]++(?:;|.(?=\}))#i');

                return $sCss;
        }

        /**
         * Callback function for sort Imports
         * 
         * @param type $aMatches
         * @return string
         */
        protected function _sortImportsCB($aMatches)
        {
                $sMedia = $aMatches[1];

                $sImports = preg_replace_callback('#(@import\surl\([^)]++\))([^;}]*+);?#',
                                                  function($aM) use ($sMedia)
                {
                        if (!empty($aM[2]))
                        {
                                return $aM[1] . ' ' . $this->combineMediaFeatures($sMedia, $aM[2]) . ';';
                        }
                        else
                        {
                                return $aM[1] . ' ' . $sMedia . ';';
                        }
                }, $aMatches[2]);

                $sCss = str_replace($aMatches[2], $sImports, $aMatches[0]);

                return $sCss;
        }

        ##########

        public static function cssRulesRegex()
        {
                return self::cssDeclarationRegex()
                        . '|\s*+@(?:-[^-]+-)?(?:media|font-face|page|keyframes|supports|document)[^{]*+{(?>[^{}]++|{(?>[^{}]++)*+})*+}'
                        . '|\s*+/\*\*\*![^!]+!\*\*\*+/\s*+';
        }

        /**
         * 
         * @staticvar string $sCssRuleRegex
         * @param type $sContent
         * @param type $sHtml
         */
        public function optimizeCssDelivery($sContents, $sHtml)
        {
                global $_PROFILER;
                JCH_DEBUG ? $_PROFILER->mark('beforeOptimizeCssDelivery - plgSystem (JCH Optimize)') : null;

                //JCH_DEBUG ? $_PROFILER->mark('beforeLoadDOMXPath - plgSystem (JCH Optimize)') : null;
                
                $sHtmlTruncated = '';

                preg_replace_callback('#<(?:[a-z0-9]++)(?:[^>]*+)>(?><?[^<]*+)*?(?=<[a-z0-9])#i',
                                      function($aM) use (&$sHtmlTruncated)
                {
                        $sHtmlTruncated .= $aM[0];

                        return;
                }, $sHtml, (int) $this->params->get('pro_optimizeCssDelivery', '200'));

                $sHtmlTruncated = preg_replace('#\s*=\s*["\']([^"\']++)["\']#i', '=" $1 "', $sHtmlTruncated);
                $sHtmlTruncated = preg_replace_callback('#(<(?>[^<>]++|(?1))*+>)|((?<=>)(?=[^<>\S]*+[^<>\s])[^<>]++)#',
                                                        function($m)
                {
                        if (isset($m[1]) && $m[1] != '')
                        {
                                return $m[0];
                        }

                        if (isset($m[2]) && $m[2] != '')
                        {
                                return ' ';
                        }
                }, $sHtmlTruncated);

                $obj = $this;

                $oDom = new DOMDocument();

                libxml_use_internal_errors(TRUE);
                $oDom->loadHtml($sHtmlTruncated);
                libxml_clear_errors();

                $oXPath = new DOMXPath($oDom);
                
                //JCH_DEBUG ? $_PROFILER->mark('afterLoadDOMXPath - plgSystem (JCH Optimize)') : null;

                $sCriticalCss = '';

                //JCH_DEBUG ? $_PROFILER->mark('beforeExtractCriticalCss - plgSystem (JCH Optimize)') : null;

                $sContents = preg_replace_callback('#' . self::cssRulesRegex() . '#i',
                                                   function ($aMatches) use ($obj, $oXPath, $sHtmlTruncated, &$sCriticalCss)
                {
                        return $obj->extractCriticalCss($aMatches, $oXPath, $sHtmlTruncated, $sCriticalCss);
                }, $sContents);

                //JCH_DEBUG ? $_PROFILER->mark('afterExtractCriticalCss - plgSystem (JCH Optimize)') : null;

                $sCriticalCss = preg_replace('#@[^{]*+{[^\S}]*+}#', '', $sCriticalCss);
                $sCriticalCss = preg_replace('#@[^{]*+{[^\S}]*+}#', '', $sCriticalCss);
                $sCriticalCss = preg_replace('#/\*\*\*!+[^!]+!\*\*\*+/[^\S]*+(?=\/\*\*\*!|$)#', '', $sCriticalCss);
                $sCriticalCss = preg_replace('#\s*\n{2,}\s*#', "\n\n", $sCriticalCss);

                $aContents = array(
                        'file'        => trim($sContents),
                        'criticalcss' => trim($sCriticalCss)
                );

                JCH_DEBUG ? $_PROFILER->mark('afterOptimizeCssDelivery - plgSystem (JCH Optimize)') : null;

                return $aContents;
        }

        /**
         * 
         * @param type $aMatches
         * @param type $oXPath
         * @param type $sHtml
         * @param type $sCriticalCss
         * @return string
         */
        public function extractCriticalCss($aMatches, $oXPath, $sHtml, &$sCriticalCss)
        {
                if (preg_match('#@font-face#', $aMatches[0]))
                {
                        $sCriticalCss .= $aMatches[0];

                        return '';
                }

                if (preg_match('#/\*\*\*!#', $aMatches[0]))
                {
                        $sCriticalCss .= $aMatches[0];

                        return $aMatches[0];
                }

                if (preg_match('#^\s*+@(?:-[^-]+-)?(?:media|document|supports)#', $aMatches[0]))
                {
                        $aMatches['b'] = preg_replace('#^[^{]++#', '', $aMatches[0]);

                        $sRecCriticalCss = '';

                        $obj = $this;

                        $sRecContents = preg_replace_callback('#' . self::cssRulesRegex() . '#i',
                                                              function ($aMatches) use ($obj, $oXPath, $sHtml, &$sRecCriticalCss)
                        {
                                return $obj->extractCriticalCss($aMatches, $oXPath, $sHtml, $sRecCriticalCss);
                        }, $aMatches['b']);

                        $sCriticalCss .= str_replace($aMatches['b'], '{' . $sRecCriticalCss . '}', $aMatches[0]);

                        return str_replace($aMatches['b'], $sRecContents, $aMatches[0]);
                }

                if (preg_match('#^\s*+@(?:-[^-]+-)?(?:page|keyframes)#', $aMatches[0]))
                {
                        return $aMatches[0];
                }

                $sSelector = preg_replace('#::?[a-zA-Z0-9(\[\])-]+#', '', $aMatches[1]);
                $aSelectors = explode(',', $sSelector);
                $aFoundSels = array();

                foreach ($aSelectors as $sSelector)
                {
                        $aTargetSelector = preg_split('#\[[^\[]*\]\K|[>+~ ]#', trim($sSelector), -1, PREG_SPLIT_NO_EMPTY);

                        $bFoundSel = TRUE;

                        foreach ($aTargetSelector as $sTargetSelector)
                        {
                                if (preg_match('#([a-z0-9]*)(?:([.\#]([_a-z0-9-]+))|(\[([_a-z0-9-]+)(?:[~|^$*]?=["\']?([^\]"\']+))?))*#i',
                                               $sTargetSelector, $aS))
                                {
                                        if (isset($aS[1]) && $aS[1] != '')
                                        {
                                                $sNeedle = '<' . preg_quote($aS[1]);
                                        }

                                        if (isset($aS[4]) && $aS[4] != '')
                                        {
                                                $sNeedle = isset($aS[6]) ? $aS[6] : $aS[5] . '="';
                                        }

                                        if (isset($aS[2]) && $aS[2] != '')
                                        {
                                                $sNeedle = ' ' . $aS[3] . ' ';
                                        }

                                        if (isset($sNeedle) && strpos($sHtml, $sNeedle) === FALSE)
                                        {
                                                $bFoundSel = FALSE;

                                                break;
                                        }
                                }
                        }

                        if ($bFoundSel)
                        {
                                $aFoundSels[] = $sSelector;
                        }
                }

                if (empty($aFoundSels))
                {
                        return $aMatches[0];
                }

                $sFoundSels = implode(',', $aFoundSels);

                $sXPath = $this->convertCss2XPath($sFoundSels);


                if ($sXPath)
                {
                        $aXPaths = array_unique(explode(' | ', $sXPath));

                        foreach ($aXPaths as $sXPathValue)
                        {
                                $oElement = $oXPath->query($sXPathValue);

//                                if ($oElement === FALSE)
//                                {
//                                        echo $aMatches[1] . "\n";
//                                        echo $sXPath . "\n";
//                                        echo $sXPathValue . "\n";
//                                        echo "\n\n";
//                                }

                                if ($oElement !== FALSE && $oElement->length)
                                {
                                        $sCriticalCss .= $aMatches[0];

                                        return '';
                                }
                        }
                }

                return $aMatches[0];
        }

        /**
         * 
         * @param type $sSelector
         * @return boolean
         */
        public function convertCss2XPath($sSelector)
        {
                $sSelector = preg_replace('#\s*([>+~,])\s*#', '$1', $sSelector);
                $sSelector = trim($sSelector);
                $sSelector = preg_replace('#\s+#', ' ', $sSelector);


                if (!$sSelector)
                {
                        return FALSE;
                }

                $sSelectorRegex = '#(?!$)'
                        . '([>+~, ]?)' //separator
                        . '([*a-z0-9]*)' //element
                        . '(?:(([.\#])([_a-z0-9-]+))(([.\#])([_a-z0-9-]+))?|'//class or id
                        . '(\[([_a-z0-9-]+)(([~|^$*]?=)["\']?([^\]"\']+)["\']?)?\]))*' //attribute
                        . '#i';

                return preg_replace_callback($sSelectorRegex, array($this, '_tokenizer'), $sSelector) . '[1]';
        }

        /**
         * 
         * @param type $aM
         */
        protected function _tokenizer($aM)
        {
                $sXPath = '';

                switch ($aM[1])
                {
                        case '>':
                                $sXPath .= '/';

                                break;
                        case '+':
                                $sXPath .= '/following-sibling::*';

                                break;
                        case '~':
                                $sXPath .= '/following-sibling::';

                                break;
                        case ',':
                                $sXPath .= '[1] | descendant-or-self::';

                                break;
                        case ' ':
                                $sXPath .= '/descendant::';

                                break;
                        default:
                                $sXPath .= 'descendant-or-self::';
                                break;
                }

                if ($aM[1] != '+')
                {
                        $sXPath .= $aM[2] == '' ? '*' : $aM[2];
                }

                if (isset($aM[3]) || isset($aM[9]))
                {
                        $sXPath .= '[';

                        $aPredicates = array();

                        if (isset($aM[4]) && $aM[4] == '.')
                        {
                                $aPredicates[] = "contains(@class, ' " . $aM[5] . " ')";
                        }

                        if (isset($aM[7]) && $aM[7] == '.')
                        {
                                $aPredicates[] = "contains(@class, ' " . $aM[8] . " ')";
                        }

                        if (isset($aM[4]) && $aM[4] == '#')
                        {
                                $aPredicates[] = "@id = ' " . $aM[5] . " '";
                        }

                        if (isset($aM[7]) && $aM[7] == '#')
                        {
                                $aPredicates[] = "@id = ' " . $aM[8] . " '";
                        }

                        if (isset($aM[9]))
                        {
                                if (!isset($aM[11]))
                                {
                                        $aPredicates[] = '@' . $aM[10];
                                }
                                else
                                {
                                        switch ($aM[12])
                                        {
                                                case '=':
                                                        $aPredicates[] = "@{$aM[10]} = ' {$aM[13]} '";

                                                        break;
                                                case '|=':
                                                        $aPredicates[] = "(@{$aM[10]} = ' {$aM[13]} ' or "
                                                                . "starts-with(@{$aM[10]}, ' {$aM[13]}'))";
                                                        break;
                                                case '^=':
                                                        $aPredicates[] = "starts-with(@{$aM[10]}, ' {$aM[13]}')";
                                                        break;
                                                case '$=':
                                                        $aPredicates[] = "substring(@{$aM[10]}, string-length(@{$aM[10]})-"
                                                                . strlen($aM[13]) . ") = '{$aM[13]} '";
                                                        break;
                                                case '~=':
                                                        $aPredicates[] = "contains(@{$aM[10]}, ' {$aM[13]} ')";
                                                        break;
                                                case '*=':
                                                        $aPredicates[] = "contains(@{$aM[10]}, '{$aM[13]}')";
                                                        break;
                                                default:
                                                        break;
                                        }
                                }
                        }

                        if ($aM[1] == '+')
                        {
                                if ($aM[2] != '')
                                {
                                        $aPredicates[] = "(name() = '" . $aM[2] . "')";
                                }

                                $aPredicates[] = '(position() = 1)';
                        }

                        $sXPath .= implode(' and ', $aPredicates);
                        $sXPath .= ']';
                }

                return $sXPath;
        }

        ##########
}
