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
 * Class to parse HTML and find css and js links to replace, populating an array with matches
 * and removing found links from HTML
 * 
 */
class JchOptimizeParser extends JchOptimizeBase
{

        /** @var string   Html of page */
        public $sHtml = '';

        /** @var array    Array of css or js urls taken from head */
        protected $aLinks = array();
        public $iCounter  = 0;
        public $params    = null;
        public $sLnEnd = '';
        public $sTab = '';

        /**
         * Constructor
         * 
         * @param JRegistry object $params      Plugin parameters
         * @param string  $sHtml                Page HMTL
         */
        public function __construct($oParams, $sHtml)
        {
                $this->params = $oParams;
                $this->sHtml  = $sHtml;
                
                
                $oDocument    = JFactory::getDocument();
                $this->sLnEnd = $oDocument->_getLineEnd();
                $this->sTab   = $oDocument->_getTab();

                $this->parseHtml();
        }

        /**
         * Removes applicable js and css links from search area
         * 
         */
        public function parseHtml()
        {
                $oParams = $this->params;

                $aCBArgs = array();

                $this->sHeadHtml = $this->getHeadHtml();

                $aCBArgs['excludes']['if'] = $this->excludeIf('head');

                if ($oParams->get('pro_searchBody', '0'))
                {
                        $this->sBodyHtml = $this->getBodyHtml();

                        $aCBArgs['excludes']['if'] = array_merge($aCBArgs['excludes']['if'], $this->excludeIf('body'));
                }

                $aExcludeExts = array();
                $oUri         = clone JUri::getInstance();
                $sHost        = $oUri->getHost();

                if ($oParams->get('excludeAllExtensions', '1'))
                {
                        $aExcludeExts = array('components/', 'modules/', 'plugins/',
                                'media/(?!system/|jui/|cms/|editors/)', '/(?!' . $sHost . '/)');
                }

                $aExJsComp  = $this->getExCompRegex($oParams->get('excludeJsComponents', ''));
                $aExCssComp = $this->getExCompRegex($oParams->get('excludeCssComponents', ''));

                $aCBArgs['excludes']['js']     = JchOptimize::getArray($oParams->get('excludeJs', ''));
                $aCBArgs['excludes']['script'] = JchOptimize::getArray($oParams->get('pro_excludeScripts'));
                $aCBArgs['excludes']['css']    = JchOptimize::getArray($oParams->get('excludeCss', ''));

                if ($this->enableCssCompression())
                {
                        $sExcludeExtsRegex = $this->getExExtensionsRegex($aExcludeExts, $aExCssComp);

                        $this->initSearch('css', $sExcludeExtsRegex, $aCBArgs);
                }

                if ($oParams->get('javascript', 1))
                {
                        $sExcludeExtsRegex = $this->getExExtensionsRegex($aExcludeExts, $aExJsComp);

                        $this->initSearch('js', $sExcludeExtsRegex, $aCBArgs);
                }
        }

        /**
         * 
         * @param type $sType
         */
        protected function initSearch($sType, $sExcludeExtsRegex, $aCBArgs)
        {
                $aCBArgs['type'] = $sType;

                $aRegex    = $this->{'get' . ucfirst($sType) . 'Regex'}();
                $aRegex[1] = $sExcludeExtsRegex;
                $sRegex    = implode('', $aRegex);

                $this->searchArea($sRegex, $sType, 'head', $aCBArgs);

                if ($this->params->get('pro_searchBody', '0'))
                {
                        $this->searchArea($sRegex, $sType, 'body', $aCBArgs);
                }
        }

        /**
         * 
         * @global type $_PROFILER
         * @param type $sRegex
         * @param type $sType
         * @param type $sSection
         * @param type $aCBArgs
         * @throws Exception
         */
        protected function searchArea($sRegex, $sType, $sSection, $aCBArgs)
        {
                global $_PROFILER;

                JCH_DEBUG ? $_PROFILER->mark('beforeSearchArea' . $sType . ' - ' . $sSection . ' plgSystem (JCH Optimize)') : null;

                $obj = $this;

                $sProcessedHtml = preg_replace_callback($sRegex,
                                                        function($aMatches) use ($obj, $aCBArgs, $sSection)
                {
                        return $obj->replaceScripts($aMatches, $aCBArgs, $sSection);
                }, $this->{'s' . ucfirst($sSection) . 'Html'});

                JCH_DEBUG ? $_PROFILER->mark('afterSearchArea' . $sType . ' - ' . $sSection . ' plgSystem (JCH Optimize)') : null;

                if (is_null($sProcessedHtml))
                {
                        throw new Exception(JText::_('Error while parsing for ' . $sType . ' links in ' . $sSection .
                                ' ...turn off combine ' . $sType . ' option'));
                }

                $this->{'s' . ucfirst($sSection) . 'Html'} = $sProcessedHtml;
        }

        /**
         * 
         * @return type
         */
        public function enableCssCompression()
        {
                jimport('joomla.environment.browser');
                $oBrowser = JBrowser::getInstance();

                if (($oBrowser->getBrowser() == 'msie') && ($oBrowser->getMajor() <= '9'))
                {
                        return FALSE;
                }
                else
                {
                        return ($this->params->get('css', 1) || $this->params->get('csg_enable', 0));
                }
        }

        /**
         * 
         * @param type $aArray1
         * @param type $aArray2
         * @return string
         */
        protected function getExExtensionsRegex($aArray1, $aArray2)
        {
                $sExExtensionsRegex = '';
                $aExExtensions      = array_merge($aArray1, $aArray2);

                if (!empty($aExExtensions))
                {
                        $sExExtensionsRegex .= '(?=  [^/>]*+ (?>/ (?! ' . implode('|', $aExExtensions) . ' )  [^/>]*+)*? >)';
                }

                return $sExExtensionsRegex;
        }

        /**
         * Callback function used to remove urls of css and js files in head tags
         *
         * @param array $aMatches       Array of all matches
         * @return string               Returns the url if excluded, empty string otherwise
         */
        public function replaceScripts($aMatches, $aCBArgs, $sSection)
        {

                if ((!isset($aMatches[1]) || trim($aMatches[1]) == '') && (!isset($aMatches[3]) || trim($aMatches[3]) == ''))
                {
                        return $aMatches[0];
                }

                $sType   = $aCBArgs['type'];
                $sEditor = JchOptimizeHelper::getEditorName();

                $sUrl         = $aMatches[1];
                $sFile        = isset($aMatches[2]) ? $aMatches[2] : '';
                $sDeclaration = isset($aMatches[3]) ? $aMatches[3] : '';
                $aExcludes    = array();
                $sPath        = '';

                //global $_PROFILER;

                if (isset($aCBArgs['excludes']))
                {
                        $aExcludes = $aCBArgs['excludes'];
                }

                $aExcludes['script'] = array_map(function($sScript)
                {
                        return stripslashes($sScript);
                }, $aExcludes['script']);

                $aExcludes['js']  = array_merge($aExcludes['js'],
                                                array('.com/maps/api/js', '.com/jsapi', '.com/uds', 'plugin_googlemap3', '/jw_allvideos/',
                        'typekit.net'));
                $aExcludes['css'] = array_merge($aExcludes['css'], array('fonts.googleapis.com'));

                if ($sSection == 'body')
                {
                        $aExcludes['script'] = array_merge($aExcludes['script'], array('document.write', 'var mapconfig90'));
                        $aExcludes['js']     = array_merge($aExcludes['js'], array('.com/recaptcha/api'));
                }

                if ($sUrl != '')
                {
                        $sPath .= JchOptimizeHelper::getFilePath($sUrl);
                }

                $sMedia = '';

                if (($sType == 'css') && (preg_match('#media=(?(?=["\'])(?:["\']([^"\']+))|(\w+))#i', $aMatches[0], $aMediaTypes) > 0))
                {
                        $sMedia .= $aMediaTypes[1] ? $aMediaTypes[1] : $aMediaTypes[2];
                }
                //JCH_DEBUG ? $_PROFILER->mark('beforeReplaceScript - ' . $sFile . ' plgSystem (JCH Optimize)') : null;

                switch (TRUE)
                {
                        case (isset($aExcludes['if']) && in_array($aMatches[0], $aExcludes['if'])):
                        case (($sUrl != '') && !empty($aExcludes[$sType]) && JchOptimizeHelper::findExcludes($aExcludes[$sType], $sUrl)):
                        case ($sEditor == 'artofeditor' && $sFile == 'ckeditor.js'):
                        case (($sType == 'js') && ($sUrl != '') && $this->isEditorsExcluded($sUrl)):
                        case (($sUrl != '') && $this->isUrlFopenAllowed($sUrl)):
                        case ($sUrl != '' && preg_match('#^https#', $sUrl) && !extension_loaded('openssl')):
                        case ($sUrl != '' && preg_match('#^data:#', $sUrl)):
                        case ($sDeclaration != '' && JchOptimizeHelper::findExcludes($aExcludes['script'], $sDeclaration, TRUE)):

                                //JCH_DEBUG ? $_PROFILER->mark('afterReplaceScript - ' . $sFile . ' plgSystem (JCH Optimize)') : null;

                                return $aMatches[0];

                        case ($sUrl == '' && trim($sDeclaration) != ''):
                                $content                = str_replace(array('<!--', '-->'), '', $sDeclaration);
                                $this->aLinks[$sType][] = array('content' => $content, 'match' => $aMatches[0]);

                                //JCH_DEBUG ? $_PROFILER->mark('afterReplaceScript - ' . $sFile . ' plgSystem (JCH Optimize)') : null;

                                return '';

                        case ($aCBArgs['type'] == 'js'):
                                $this->iCounter++;
                                $this->aLinks[$sType][] = array(
                                        'url'   => $sUrl,
                                        'file'  => $sFile,
                                        'match' => $aMatches[0],
                                        'path'  => $sPath);

                                //JCH_DEBUG ? $_PROFILER->mark('afterReplaceScript - ' . $sFile . ' plgSystem (JCH Optimize)') : null;

                                return '<JCH_SCRIPT>';

                        case ($aCBArgs['type'] == 'css'):
                                $this->aLinks[$sType][] = array(
                                        'url'   => $sUrl,
                                        'file'  => $sFile,
                                        'media' => $sMedia,
                                        'match' => $aMatches[0],
                                        'path'  => $sPath);

                                //JCH_DEBUG ? $_PROFILER->mark('afterReplaceScript - ' . $sFile . ' plgSystem (JCH Optimize)') : null;

                                return '';
                        default:

                                JchOptimizeLogger::log(JText::_('Unknown match type'), $this->params);

                                return $aMatches[0];
                }
        }

        /**
         * Generates regex for excluding components set in plugin params
         * 
         * @param string $param
         * @return string
         */
        protected function getExCompRegex($sExComParam)
        {
                $aComponents = array_filter(JchOptimize::getArray($sExComParam));
                $aExComp     = array();

                if (!empty($aComponents))
                {
                        $aExComp = array_map(function($sValue)
                        {
                                return $sValue . '/';
                        }, $aComponents);
                }

                return $aExComp;
        }

        /**
         * Add js and css urls in conditional tags to excludes list
         *
         * @param string $sType   css or js
         */
        protected function excludeIf($sSection)
        {
                //global $_PROFILER;
                //JCH_DEBUG ? $_PROFILER->mark('beforeExcludeIf plgSystem (JCH Optimize)') : null;

                $aExcludeIf = array();

                if (preg_match_all('#<\!--.*?-->#is', $this->{'s' . ucfirst($sSection) . 'Html'}, $aMatches))
                {
                        foreach ($aMatches[0] as $sMatch)
                        {
                                if (preg_match_all('#<link[^>]*>|<(?:style|script)[^>]*>.*?</(?:script|style)>#is', $sMatch, $aExcludesMatches))
                                {
                                        foreach ($aExcludesMatches[0] as $sExcludesMatch)
                                        {
                                                $aExcludeIf[] = @$sExcludesMatch;
                                        }
                                }
                        }
                }

                return $aExcludeIf;

                //JCH_DEBUG ? $_PROFILER->mark('afterExcludeIf plgSystem (JCH Optimize)') : null;
        }

        /**
         * Fetches Class property containing array of matches of urls to be removed from HTML
         * 
         * @return array
         */
        public function getReplacedFiles()
        {
                return $this->aLinks;
        }

        /**
         * Set the Searcharea property
         * 
         * @param type $sSearchArea
         */
        public function setSearchArea($sSearchArea, $sSection)
        {
                $this->{'s' . ucfirst($sSection) . 'Html'} = $sSearchArea;
        }

        ##########

        /**
         * Get the search area to be used..head section or body
         * 
         * @param type $sHead   
         * @return type
         */
        public function getBodyHtml()
        {
                //global $_PROFILER;
                //JCH_DEBUG ? $_PROFILER->mark('beforeGetSearchArea plgSystem (JCH Optimize)') : null;

                if ($this->sBodyHtml == '')
                {
                        $aBodyMatches = array();

                        if (preg_match($this->getBodyRegex(), $this->sHtml, $aBodyMatches) === FALSE || empty($aBodyMatches))
                        {
                                throw new Exception(JText::_('Error occurred while trying to match for search area.'
                                        . ' Check your template for open and closing body tags'));
                        }

                        $this->sBodyHtml = $aBodyMatches[0];
                }

                //JCH_DEBUG ? $_PROFILER->mark('afterGetSearchArea plgSystem (JCH Optimize)') : null;

                return $this->sBodyHtml;
        }

        /**
         * Regex used to find js links
         * 
         * @return array
         */
        public function getJsRegex()
        {
                $aJsRegex = parent::getJsRegex();

                if (!$this->params->get('free', '0'))
                {
                        $aJsRegex[3] = 'js|php';
                        $aJsRegex[5] = $aJsRegex[7] = '?';

                        if ($this->params->get('pro_inlineScripts', '0'))
                        {
                                $aJsRegex[9] = '(  (?>  <?[^<]*+  )*?  )';
                        }
                }

                return $aJsRegex;
        }

        /**
         * Regex used to find css links
         * 
         * @return array
         */
        public function getCssRegex()
        {
                $aCssRegex = parent::getCssRegex();
                
                if (!$this->params->get('free', '0'))
                {
                        $aCssRegex[3] = 'css|php';
                        $aCssRegex[5] = '?';
                        
                        if ($this->params->get('pro_inlineStyle', '1'))
                        {
                                $aCssRegex[8] = '|(?:<style(?:(?!(?:type=(?!["\']?text/css))|(?:scoped))[^>])*>([^<]+)</style>)';
                        }

                }

                return $aCssRegex;
        }

        /**
         * Determines if files in editor folders should be included
         * 
         * @param string $sUrl Url of file
         * @return boolean
         */
        protected function isEditorsExcluded($sUrl)
        {
                return ((!$this->params->get('pro_inlineScripts')) && (preg_match('#/editors/#i', $sUrl)));
        }

        /**
         * Determines if file contents can be fetched using http protocol
         * 
         * @param string $sUrl    Url of file
         * @return boolean        
         */
        protected function isUrlFopenAllowed($sUrl)
        {
                if ($this->params->get('pro_phpAndExternal', '1'))
                {
                        $oFileRetriever = JchOptimizeFileRetriever::getInstance($this->params);

                        return (!$oFileRetriever->isUrlFOpenAllowed() && ((preg_match('#.*\.php#', $sUrl)) || !JchOptimizeHelper::isInternal($sUrl)));
                }
                else
                {
                        return parent::isUrlFopenAllowed($sUrl);
                }
        }

        /**
         * Returns processed html to be sent to the browser
         * 
         * @return string
         */
        public function getHtml()
        {
                $sHtml = parent::getHtml();

                if ($this->params->get('pro_searchBody', '0'))
                {
                        $sHtml = preg_replace($this->getBodyRegex(), strtr($this->sBodyHtml, array('\\' => '\\\\', '$' => '\$')), $sHtml);

                        if (is_null($sHtml) || $sHtml == '')
                        {
                                throw new Exception(JText::_('Error occured while trying to get html'));
                        }
                }

                return $sHtml;
        }

        ##########
}
