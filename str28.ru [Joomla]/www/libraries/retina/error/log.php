<?php
/**
 * @package     retina.Platform
 * @subpackage  Error
 *
 * @copyright   
 * @license     
 */

defined('RPATH_PLATFORM') or die;

// TODO: Wack this into a language file when this gets merged
if (JDEBUG)
{
	JError::raiseWarning(100, "JLog has moved to jimport('retina.log.log'), please update your code.");
	JError::raiseWarning(100, "JLog has changed its behaviour; please update your code.");
}
require_once RPATH_LIBRARIES . '/retina/log/log.php';
