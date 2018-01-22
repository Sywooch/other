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

class JchOptimizeLinkBuilderBase
{

        /**
         * 
         * @return string
         */
        protected function getAsyncAttribute()
        {
                return '';
        }

}

/**
 * 
 * 
 */
class JchOptimizeLinkBuilder extends JchOptimizelinkBuilderBase
{

        /** @var JchOptimizeParser Object       Parser object */
        public $oParser;

        /** @var string         Document line end */
        protected $sLnEnd;

        /** @var string         Document tab */
        protected $sTab;

        /** @var object   Clone of JCACHE object */
        protected $oCache = null;

        /** @var string   Cache group */
        protected $sCacheGroup = 'plg_jch_optimize';

        /** @var string cache id * */
        protected $sId = '';

        /**
         * Constructor
         * 
         * @param JchOptimizeParser Object  $oParser
         */
        public function __construct($oParser = null)
        {
                $this->oParser = $oParser;
                $this->params  = $this->oParser->params;
        }

        /**
         * Prepare links for the combined files and insert them in the processed HTML
         * 
         */
        public function insertJchLinks()
        {
                $aLinks = $this->oParser->getReplacedFiles();
                $params = $this->params;

                if ($this->params->get('htaccess', 2) == 2)
                {
                        JchOptimizeHelper::checkModRewriteEnabled($this->params);
                }

                if ($this->oParser->enableCssCompression())
                {
                        $sNewCssLink = '</title>' . $this->sLnEnd . $this->sTab . '<link rel="stylesheet" type="text/css" ';
                        $sNewCssLink .= 'href="URL"/>';

                        if (!empty($aLinks['css']))
                        {
                                $this->processLink('css', $sNewCssLink);
                        }
                }

                if ($params->get('javascript', 1))
                {
                        $sLink = '<script type="text/javascript" src="URL"';
                        $sLink .= $params->get('defer_js', 0) ?
                                ($this->isXhtml() ? ' defer="defer"' : ' defer' ) :
                                '';
                        $sLink .= $this->getAsyncAttribute();
                        $sLink .= '></script>';

                        $sNewJsLink = ($params->get('bottom_js') == '1') ? $this->sTab . $sLink . $this->sLnEnd . '</body>' : $sLink;

                        if (!empty($aLinks['js']))
                        {
                                $this->processLink('js', $sNewJsLink, $this->oParser->iCounter);
                        }
                }
        }

        /**
         * Use generated id to cache aggregated file
         *
         * @param string $sType           css or js
         * @param string $sLink           Url for aggregated file
         */
        protected function processLink($sType, $sLink, $iCnt = '')
        {
                //global $_PROFILER;
                //JCH_DEBUG ? $_PROFILER->mark('beforeProcessLink plgSystem (JCH Optimize)') : null;

                $aLinks   = $this->oParser->getReplacedFiles();
                $sPageUrl = $this->params->get('pro_optimizeCssDelivery', '0') && $sType == 'css' ? JUri::getInstance()->toString() : '';
                $sId      = md5(serialize($aLinks[$sType]) . serialize($this->params) . JCH_VERSION . $sPageUrl);
                $aArgs    = array($aLinks[$sType], $sType, $this->oParser);

                $oCombiner = new JchOptimizeCombiner($this->oParser);
                $aFunction = array(&$oCombiner, 'getContents');

                $bCached = $this->loadCache($aFunction, $aArgs, $sId);

                if ($bCached === FALSE)
                {
                        throw new Exception(JText::_('Error creating cache file'));
                }

                $iTime = (int) $this->params->get('lifetime', '30');
                $sUrl  = $this->buildUrl($sId, $sType, $iTime, $this->isGZ());


                if ($sType == 'css' && $this->params->get('pro_optimizeCssDelivery', '0'))
                {
                        $sCriticalCss = '<style type="text/css">' . $this->sLnEnd .
                                $bCached['criticalcss'] . $this->sLnEnd .
                                '</style>' . $this->sLnEnd .
                                '</head>';

                        $sHeadHtml = str_replace('</head>', $sCriticalCss, $this->oParser->getHeadHtml());
                        $this->oParser->setSearchArea($sHeadHtml, 'head');

                        $this->loadCssAsync($sUrl);
                }
                else
                {
                        $sNewLink = str_replace('URL', $sUrl, $sLink);
                        $this->replaceLink($sNewLink, $sType, $iCnt);
                }

                //JCH_DEBUG ? $_PROFILER->mark('afterProcessLink plgSystem (JCH Optimize)') : null;
        }

        /**
         * Returns url of aggregated file
         *
         * @param string $sFile		Aggregated file name
         * @param string $sType		css or js
         * @param mixed $bGz		True (or 1) if gzip set and enabled
         * @param number $sTime		Expire header time
         * @return string			Url of aggregated file
         */
        protected function buildUrl($sId, $sType, $iTime, $bGz = false)
        {
                $oUri = clone JUri::getInstance();

                $sBaseFolder = JchOptimizeHelper::getBaseFolder();
                $sPath       = $sBaseFolder . 'plugins/system/jch_optimize/assets';

                if ($this->params->get('htaccess', 0) == 1)
                {
                        $sUrl = $sPath . $sBaseFolder . ($bGz ? 'gz/' : 'nz/') . $iTime . '/' . $sId . '.' . $sType;
                }
                else
                {
                        $oUri->setPath($sPath . '2/jscss.php');

                        $aVar         = array();
                        $aVar['f']    = $sId;
                        $aVar['type'] = $sType;

                        if ($bGz)
                        {
                                $aVar['gz'] = 'gz';
                        }

                        $aVar['d'] = $iTime;
                        $oUri->setQuery($aVar);

                        $sUrl = htmlentities($oUri->toString(array('path', 'query')));
                }

                return ($sUrl);
        }

        /**
         * Insert url of aggregated file in html
         *
         * @param string $sNewLink   Url of aggregated file
         */
        protected function replaceLink($sNewLink, $sType, $iCnt = '')
        {
                $sSearchArea = $this->oParser->getHeadHtml();

                if ($this->params->get('pro_searchBody', '0'))
                {
                        $sSearchArea .= $this->oParser->getBodyHtml();
                }

                if ($sType == 'css')
                {
                        $sSearchArea = str_replace('</title>', $sNewLink, $sSearchArea);
                }

                if ($sType == 'js')
                {
                        switch ($this->params->get('bottom_js', 0))
                        {
                                case 0: //First found javascript tag
                                        $sSearchArea = preg_replace('#<JCH_SCRIPT>#', $sNewLink, $sSearchArea, 1);
                                        $sSearchArea = str_replace('<JCH_SCRIPT>', '', $sSearchArea);

                                        break;

                                case 2: //Last found javascript tag
                                        $iCnt--;
                                        $sSearchArea = preg_replace('#<JCH_SCRIPT>#', '', $sSearchArea, $iCnt);
                                        $sSearchArea = str_replace('<JCH_SCRIPT>', $sNewLink, $sSearchArea);

                                        break;

                                case 1: //Bottom of page
                                        $sSearchArea          = str_replace('<JCH_SCRIPT>', '', $sSearchArea);
                                        $sSearchArea          = str_replace('</body>', $sNewLink, $sSearchArea);
                                        $this->oParser->sHtml = str_replace('</body>', $sNewLink, $this->oParser->sHtml);

                                        break;

                                default:
                                        JchOptimizeLogger::log(JText::_('Unknown value for position javascript type parameter'), $this->params);
                                        $sSearchArea = preg_replace('#<JCH_SCRIPT>#', $sNewLink, $sSearchArea, 1);
                                        $sSearchArea = str_replace('<JCH_SCRIPT>', '', $sSearchArea);

                                        break;
                        }
                }

                if (!$this->params->get('pro_searchBody', '0'))
                {
                        $this->oParser->setSearchArea($sSearchArea, 'head');
                }
                else
                {
                        $this->oParser->setSearchArea(preg_replace($this->oParser->getBodyRegex(), '', $sSearchArea), 'head');
                        $this->oParser->setSearchArea(preg_replace($this->oParser->getHeadRegex(), '', $sSearchArea), 'body');
                }
        }

        /**
         * Create and cache aggregated file if it doesn't exists, file will have
         * lifetime set in global configurations.
         *
         * @param array $aFunction    Name of function used to aggregate files
         * @param array $aArgs        Arguments used by function above
         * @param string $sId         Generated id to identify cached file
         * @return boolean           True on success
         */
        public function loadCache($aFunction, $aArgs, $sId)
        {
                global $_PROFILER;
                JCH_DEBUG ? $_PROFILER->mark('beforeLoadCache plgSystem (JCH Optimize)') : null;

                $oCache  = $this->getCache();
                $bCached = $oCache->get($aFunction, $aArgs, $sId);

                JCH_DEBUG ? $_PROFILER->mark('afterLoadCache plgSystem (JCH Optimize)') : null;

                return $bCached;
        }

        /**
         * Gets Joomla cache object
         * 
         * @return object         Cache object
         */
        protected function getCache()
        {
                if (is_null($this->oCache))
                {
                        $aOptions = array(
                                'defaultgroup' => 'plg_jch_optimize',
                                'storage'      => 'file',
                                'checkTime'    => TRUE,
                                'caching'      => 1,
                                'application'  => 'site',
                                'language'     => 'en-GB'
                        );

                        $this->oCache = JCache::getInstance('callback', $aOptions);
                        $this->oCache->setLifetime((int) $this->params->get('lifetime', '30') * 24 * 60 * 60);
                }

                return $this->oCache;
        }

        /**
         * Check if gzip is set or enabled
         *
         * @return boolean   True if gzip parameter set and server is enabled
         */
        public function isGZ()
        {
                return ($this->params->get('gzip', 0) && extension_loaded('zlib') && !ini_get('zlib.output_compression') && (ini_get('output_handler') !=
                        'ob_gzhandler'));
        }

        /**
         * Determine if document is of XHTML doctype
         * 
         * @return boolean
         */
        protected function isXhtml()
        {
                if (preg_match('#^<!DOCTYPE(?=[^>]+XHTML)#i', trim($this->oParser->sHtml)) === 1)
                {
                        return true;
                }
                else
                {
                        return false;
                }
        }

        ##########

        /**
         * 
         * @param type $sUrl
         */
        protected function loadCssAsync($sUrl)
        {
                $sScript = '<script type="text/javascript">
                                var link = document.createElement("link");
                                var head = document.getElementsByTagName("head")[0];
                                link.type = "text/css";
                                link.rel = "stylesheet";
                                link.href = "' . html_entity_decode($sUrl) . '";
                                head.appendChild(link);
                            </script>' . $this->sLnEnd . '</body>';

                $sBodyHtml            = $this->oParser->getBodyHtml();
                $sBodyHtml            = str_replace('</body>', $sScript, $sBodyHtml);
                $this->oParser->sHtml = str_replace('</body>', $sScript, $this->oParser->sHtml);

                $this->oParser->setSearchArea($sBodyHtml, 'body');
        }

        /**
         * Adds the async attribute to the aggregated js file link
         * 
         * @return string
         */
        protected function getAsyncAttribute()
        {
                if ($this->params->get('pro_loadAsynchronous', '1'))
                {
                        $sAsyncAttribute = $this->isXhtml() ? ' async="async"' : ' async';

                        return $sAsyncAttribute;
                }
                else
                {
                        return parent::getAsyncAttribute();
                }
        }

        ##########
}
