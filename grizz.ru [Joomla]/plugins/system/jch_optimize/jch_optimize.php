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
// No direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.plugin.plugin');

class plgSystemJCH_Optimize extends JPlugin
{

        public function onAfterRender()
        {
                if ((JFactory::getApplication()->getName() != 'site') || (JFactory::getDocument()->getType() != 'html')
                        || (JFactory::getApplication()->input->get('jchbackend') == '1')
                        || (JFactory::getConfig()->get('offline') && JFactory::getUser()->guest))
                {
                        return FALSE;
                }

                if ($this->params->get('log', 0))
                {
                        error_reporting(E_ALL);
                }

                if (version_compare(JVERSION, '3.2.3', '>='))
                {
                        $oApp  = JFactory::getApplication();
                        $sHtml = $oApp->getBody();
                }
                else
                {
                        $sHtml = JResponse::getBody();
                }

                if (JFactory::getApplication()->input->get('jchbackend') == '2')
                {
                        echo $sHtml;
                        while (@ob_end_flush());
                        exit;
                }

                include_once dirname(__FILE__) . '/jchoptimize/loader.php';

                $GLOBALS['oParams'] = $this->params;

                try
                {
                        if (version_compare(PHP_VERSION, '5.3.0', '<'))
                        {
                                throw new Exception(JText::_('PHP Version less than 5.3.0. Exiting plugin...'));
                        }

                        ini_set('pcre.backtrack_limit', 1000000);
                        $sOptimizedHtml = JchOptimize::optimize($this->params, $sHtml);
                }
                catch (Exception $ex)
                {
                        if ($GLOBALS['oParams']->get('log', 0))
                        {
                                jimport('joomla.log.log');
                                JLog::addLogger(
                                        array(
                                        'text_file' => 'plg_jch_optimize.errors.php'), JLog::ALL, 'jch-optimize'
                                );
                                JLog::add(JText::_($ex->getMessage()), JLog::WARNING, 'jch-optimize');
                        }
                }

                if (version_compare(JVERSION, '3.2.3', '>='))
                {
                        $oApp->setBody($sOptimizedHtml);
                }
                else
                {
                        JResponse::setBody($sOptimizedHtml);
                }

                unset($GLOBALS['oParams']);
        }

        ##########

        public function onInstallerBeforePackageDownload(&$url, &$headers)
        {
                $uri = JUri::getInstance($url);

                // I don't care about download URLs not coming from our site
                $host = $uri->getHost();
                if ($host != 'www.jch-optimize.net')
                {
                        return true;
                }

                // Get the download ID
                $dlid = $this->params->get('pro_downloadid', '');

                // If the download ID is invalid, return without any further action
                if (!preg_match('/^([0-9]{1,}:)?[0-9a-f]{32}$/i', $dlid))
                {
                        return true;
                }

                // Append the Download ID to the download URL
                if (!empty($dlid))
                {
                        $uri->setVar('dlid', $dlid);
                        $url = $uri->toString();
                }

                return true;
        }

        ##########
}

//function jchprint($variable, $name = '', $exit = FALSE, $silent = FALSE)
//{
//        if ($silent) echo '<script> ';
//        
//        echo '<pre>';
//        
//        if ($name != '')
//        {
//                echo $name . ' = ';
//        }
//        
//        if ($silent) {$variable = str_replace ('</script>', '</+script>', $variable);}
//        print_r($variable);
//        
//        echo '</pre>';
//        
//        if ($silent) echo ' </script>';
//        
//        if ($exit)
//        {
//                exit();
//        }
//}