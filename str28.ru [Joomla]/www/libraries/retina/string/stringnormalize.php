<?php
/**
 * @package     retina.Platform
 * @subpackage  String
 *
 * @copyright   
 * @license     
 */

defined('RPATH_PLATFORM') or die;

JLog::add('JStringNormalize has moved to jimport(\'retina.string.normalise\'), please update your code.', JLog::WARNING, 'deprecated');

require_once RPATH_PLATFORM . '/retina/string/normalise.php';
