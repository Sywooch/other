<?php

use JchOptimize\JSMinRegex;
use JchOptimize\Minify_CSSi;

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

class JchOptimizeCombinerBase
{

        /**
         * 
         * @param type $sPath
         * @return boolean
         */
        protected function loadAsync()
        {
                return false;
        }

        /**
         * 
         * @param type $sContent
         * @return type
         */
        protected function replaceImports($sContent)
        {
                return $sContent;
        }

}

/**
 * 
 * 
 */
class JchOptimizeCombiner extends JchOptimizeCombinerBase
{

        public $params            = NULL;
        public $sLnEnd            = '';
        public $sTab              = '';
        public $bBackend          = FALSE;
        public $oParser           = NULL;
        public static $bLogErrors = FALSE;

        /**
         * Constructor
         * 
         */
        public function __construct($oParser, $bBackend = FALSE)
        {
                $this->oParser  = $oParser;
                $this->params   = $oParser->params;
                $this->bBackend = $bBackend;

                $this->sLnEnd = $oParser->sLnEnd;
                $this->sTab   = $oParser->sTab;

                self::$bLogErrors = $this->params->get('jsmin_log', 0) ? TRUE : FALSE;
        }

        /**
         * 
         * @return type
         */
        public function getLogParam()
        {
                if (self::$bLogErrors == '')
                {
                        self::$bLogErrors = $this->params->get('log', 0);
                }

                return self::$bLogErrors;
        }

        /**
         * Get aggregated and possibly minified content from js and css files
         *
         * @param array $aUrlArray      Array of urls of css or js files for aggregation
         * @param string $sType         css or js
         * @return string               Aggregated (and possibly minified) contents of files
         */
        public function getContents($aUrlArray, $sType, $oParser)
        {
                $oCssParser = new JchOptimizeCssParser($oParser, $this->bBackend);

                $sContents = $this->combineFiles($aUrlArray, $sType, $oCssParser);
                $sContents = $this->prepareContents($sContents, $sType, $oCssParser);


                $sCriticalCss = '';

                if ($sType == 'css' && $this->params->get('pro_optimizeCssDelivery', '0'))
                {
                        $oParser->params->set('pro_InlineScripts', '1');
                        $oParser->params->set('pro_InlineStyles', '1');
                        $sHtml = preg_replace(array($oParser->getHeadRegex(), implode('', $oParser->getJsRegex()), implode('', $oParser->getCssRegex())),
                                                                                                                           '', $oParser->sHtml);

                        $aCssContents = $oCssParser->optimizeCssDelivery($sContents, $sHtml);
                        $sContents    = $aCssContents['file'];
                        $sCriticalCss .= $aCssContents['criticalcss'];
                }

                $aContents = array(
                        'filemtime'   => JFactory::getDate('now', 'GMT')->toUnix(),
                        'file'        => $sContents,
                        'criticalcss' => $sCriticalCss
                );

                return $aContents;
        }

        /**
         * Aggregate contents of CSS and JS files
         *
         * @param array $aUrlArray      Array of links of files
         * @param string $sType          CSS or js
         * @return string               Aggregarted contents
         * @throws Exception
         */
        public function combineFiles($aUrlArray, $sType, $oCssParser)
        {
                global $_PROFILER;
                JCH_DEBUG ? $_PROFILER->mark('beforeCombineFiles - ' . $sType . ' plgSystem (JCH Optimize)') : null;

                $sContents = '';
                $bAsync    = false;
                $sAsyncUrl = '';

                $oFileRetriever = JchOptimizeFileRetriever::getInstance($this->params);

                foreach ($aUrlArray as $aUrl)
                {
                        $sContent = '';

                        if (isset($aUrl['url']))
                        {

                                if ($sType == 'js' && $sAsyncUrl != '')
                                {
                                        $sContents .= $this->addCommentedUrl('js', $sAsyncUrl) .
                                                'loadScript("' . $sAsyncUrl . '", function(){});  DELIMITER';
                                        $sAsyncUrl = '';
                                }

                                $sPath = $aUrl['path'];

                                if ($sType == 'js' && $this->loadAsync($aUrl['url']))
                                {
                                        $sAsyncUrl = $aUrl['url'];
                                        $bAsync    = true;

                                        continue;
                                }
                                else
                                {
                                        $sFileContents = $oFileRetriever->getFileContents($sPath);

                                        if ($sFileContents === FALSE)
                                        {
                                                throw new Exception(JText::_('Failed getting file contents from ' . $sPath));
                                        }

                                        $sContent .= $sFileContents;
                                        unset($sFileContents);
                                }
                        }
                        else
                        {
                                if ($sType == 'js' && $sAsyncUrl != '')
                                {
                                        $sContents .= $this->addCommentedUrl('js', $sAsyncUrl) .
                                                'loadScript("' . $sAsyncUrl . '", function(){' . $this->sLnEnd . $aUrl['content'] . $this->sLnEnd . '});  
                                        DELIMITER';
                                        $sAsyncUrl = '';
                                }
                                else
                                {
                                        $sContent .= $aUrl['content'];
                                }
                        }

                        if ($sType == 'css')
                        {
                                unset($oCssParser->sCssUrl);
                                $oCssParser->aUrl = $aUrl;

                                $sImportContent = preg_replace('#@import\s(?:url\()?[\'"]([^\'"]+)[\'"](?:\))?#', '@import url($1)', $sContent);

                                if (is_null($sImportContent))
                                {
                                        JchOptimizeLogger::log(JText::_('Error occured trying to parse for @imports in ' . $aUrl['url']),
                                                                        $this->params);

                                        $sImportContent = $sContent;
                                }

                                $sContent = $sImportContent;
                                $sContent = $oCssParser->correctUrl($sContent);
                                $sContent = $this->replaceImports($sContent, $aUrl);
                                $sContent = $oCssParser->handleMediaQueries($sContent);
                        }

                        if ($sType == 'js' && $sContent != '')
                        {
                                $sContent = $this->addSemiColon($sContent);
                        }

                        $sContent = $this->MinifyContent($sContent, $sType, $aUrl);

                        $sContents .= $this->addCommentedUrl($sType, $aUrl) . $sContent . 'DELIMITER';
                        unset($sContent);
                }

                if ($bAsync)
                {
                        $sContents = $this->getLoadScript() . $sContents;

                        if ($sAsyncUrl != '')
                        {
                                $sContents .= $this->addCommentedUrl('js', $sAsyncUrl) . 'loadScript("' . $sAsyncUrl . '", function(){});  DELIMITER';
                                $sAsyncUrl = '';
                        }
                }

                JCH_DEBUG ? $_PROFILER->mark('afterCombineFiles - ' . $sType . ' plgSystem (JCH Optimize)') : null;

                return $sContents;
        }

        /**
         * 
         * @param type $sContent
         * @param type $sUrl
         */
        protected function MinifyContent($sContent, $sType, $aUrl)
        {
                global $_PROFILER;

                if ($this->params->get($sType . '_minify', 0) && preg_match('#\s++#', trim($sContent)))
                {
                        $sUrl = isset($aUrl['url']) ? $aUrl['url'] : ($sType == 'css' ? 'Style' : 'Script') . ' Declaration';

                        JCH_DEBUG ? $_PROFILER->mark('beforeMinifyContent - "' . $sUrl . '" plgSystem (JCH Optimize)') : null;

                        $sContent = trim($sType == 'css' ? Minify_CSSi::process($sContent) : JSMinRegex::minify($sContent));

                        JCH_DEBUG ? $_PROFILER->mark('afterMinifyContent - "' . $sUrl . '" plgSystem (JCH Optimize)') : null;
                }

                return $sContent;
        }

        /**
         * 
         * @param type $sType
         * @param type $sUrl
         * @return string
         */
        protected function addCommentedUrl($sType, $sUrl)
        {
                $sComment = $this->sLnEnd;

                if ($this->params->get('debug', '0'))
                {
                        if (is_array($sUrl))
                        {
                                $sUrl = isset($sUrl['url']) ? $sUrl['url'] : (($sType == 'js' ? 'script' : 'style') . ' declaration');
                        }

                        $sComment = 'COMMENT_START ' . $sUrl . ' COMMENT_END';
                }

                return $sComment;
        }

        /**
         * Add semi-colon to end of js files if non exists;
         * 
         * @param string $sContent
         * @return string
         */
        public function addSemiColon($sContent)
        {
                $sContent = trim($sContent);

                if (substr($sContent, -1) != ';' && $sContent != 'COMMENT_START File does not exist COMMENT_END')
                {
                        $sContent = $sContent . ';';
                }

                return $sContent;
        }

        /**
         * Remove placeholders from aggregated file for caching
         * 
         * @param string $sContents       Aggregated file contents
         * @param string $sType           js or css
         * @return string
         */
        public function prepareContents($sContents, $sType, $oCssParser)
        {
                if ($sType == 'css')
                {
                        $sContents = $oCssParser->sortImports($sContents);

                        if ($this->params->get('csg_enable', 0))
                        {
                                try
                                {
                                        $oSpriteGenerator = new JchOptimizeSpriteGenerator($this->params);
                                        $sCssContents     = $oSpriteGenerator->getSprite($sContents);
                                }
                                catch (Exception $ex)
                                {
                                        JchOptimizeLogger::log($ex->getMessage(), $this->params);

                                        $sCssContents = $sContents;
                                }

                                $sContents = $sCssContents;
                        }

                        if (function_exists('mb_convert_encoding'))
                        {
                                $sContents = '@charset "utf-8";' . $this->sLnEnd . trim($sContents);
                                $sContents = mb_convert_encoding($sContents, 'utf-8');
                        }
                }

                $sContents = str_replace(
                        array(
                        'COMMENT_START',
                        'COMMENT_IMPORT_START',
                        'COMMENT_END',
                        'DELIMITER'
                        ),
                        array(
                        $this->sLnEnd . $this->sLnEnd . '/***! ',
                        $this->sLnEnd . $this->sLnEnd . '/***! @import url',
                        ' !***/' . $this->sLnEnd . $this->sLnEnd,
                        ''
                        ), $sContents);

                return trim($sContents);
        }

        /**
         * 
         * @param type $aUrlArray
         * @param type $params
         * @return type
         */
        public static function getImages($aUrlArray, $oParser)
        {
                $oCombiner  = new JchOptimizeCombiner($oParser, TRUE);
                $oCssParser = new JchOptimizeCssParser($oParser, TRUE);

                try
                {
                        $sCss = $oCombiner->combineFiles($aUrlArray, 'css', $oCssParser);

                        $oSpriteGenerator = new JchOptimizeSpriteGenerator($oCombiner->params);
                        $aMatches         = $oSpriteGenerator->processCssUrls($sCss, TRUE);
                }
                catch (Exception $Ex)
                {
                        $GLOBALS['bTextArea'] = TRUE;

                        JchOptimizeLogger::log($Ex->getMessage(), $oCombiner->params);

                        throw new Exception(JText::_('Failed fetching images for the multiselect exclude options in sprite generator. '
                                . 'Will render textareas instead.'));
                }

                return $aMatches;
        }

        ##########

        /**
         * Determines if js file should be loaded asynchronously. Would be aggregated otherwise.
         * 
         * @param type $sPath    File path
         * @return boolean
         */
        protected function loadAsync($sUrl = '')
        {
                $aPath = preg_split('#[/\\\\]+#', $sUrl);
                $sFile = end($aPath);
                //$sEditor = JchOptimizeHelper::getEditorName();

                switch (true)
                {
                        case (preg_match('#/editors/(?!ckeditor/|codemirror/)|option=com_jce#i', $sUrl)):
                        case (JchOptimizeHelper::findExcludes(JchOptimize::getArray($this->params->get('pro_loadFilesAsync', '')), $sUrl)):

                                return true;
                        default:

                                return false;
                }
        }

        /**
         * Resolves @imports in css files, fetching contents of these files and adding them to the aggregated file
         * 
         * @param string $sContent      
         * @return string
         */
        protected function replaceImports($sContent)
        {
                if ($this->params->get('pro_replaceImports', '1'))
                {
                        $sImportFileContents = preg_replace_callback('#@import url\((?=[^\)]+\.(?:css|php))([^\)]+)\)([^;]*);#',
                                                                     array(__CLASS__, 'getImportFileContents'), $sContent);

                        if (is_null($sImportFileContents))
                        {
                                JchOptimizeLogger::log(JText::_('Failed getting @import file contents'), $this->params);

                                return $sContent;
                        }

                        $sContent = $sImportFileContents;
                }
                else
                {
                        $sContent = parent::replaceImports($sContent);
                }

                return $sContent;
        }

        /**
         * Fetches the contents of files declared with @import 
         * 
         * @param array $aMatches       Array of regex matches
         * @return string               file contents
         */
        protected function getImportFileContents($aMatches)
        {
                $aUrlArray = array();

                $aUrlArray[0]['url']   = $aMatches[1];
                $aUrlArray[0]['media'] = $aMatches[2];
                $aUrlArray[0]['path']  = JchOptimizeHelper::getFilepath($aUrlArray[0]['url']);

                $oCssParser    = new JchOptimizeCssParser($this->oParser, $this->bBackend);
                $sFileContents = $this->combineFiles($aUrlArray, 'css', $oCssParser);

                if ($sFileContents === FALSE)
                {
                        return $aMatches[0];
                }

                return $sFileContents;
        }

        /**
         * Javascript function used to load files asynchronously
         * 
         * @return string       Javascript function added to the top of aggregated js file
         */
        protected function getLoadScript()
        {
                $sLoadScript = '
function loadScript(url, callback){
    var script = document.createElement("script")
    script.type = "text/javascript";

    if (script.readyState){  //IE
        script.onreadystatechange = function(){
            if (script.readyState == "loaded" ||
                    script.readyState == "complete"){
                script.onreadystatechange = null;
                callback();
            }
        };
    } else {  //Others
        script.onload = function(){
            callback();
        };
    }

    script.src = url;
    document.getElementsByTagName("head")[0].appendChild(script);

};';
                if ($this->params->get('js_minify', 0))
                {
                        $sLoadScript = $this->MinifyContent($sLoadScript, 'js', 'loadScript');
                }
                $sLoadScript = $sLoadScript . $this->sLnEnd;

                return $sLoadScript;
        }

        ##########
}
