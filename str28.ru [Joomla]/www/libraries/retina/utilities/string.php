<?php
/**
 * @package     retina.Platform
 * @subpackage  Utilities
 *
 * @copyright   
 * @license     
 */

defined('RPATH_PLATFORM') or die;

JLog::add('JString has moved to jimport(\'retina.string.string\'), please update your code.', JLog::WARNING, 'deprecated');

require_once RPATH_PLATFORM . '/retina/string/string.php';
