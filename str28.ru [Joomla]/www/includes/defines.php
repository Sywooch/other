<?php
/**
 * @package		Retina.Site
 * @subpackage	Application
 * 
 * 
 */

// No direct access.
defined('_REXEC') or die;

/**
 * Retina Application define.
 */

//Global definitions.
//retina framework path definitions.
$parts = explode(DS, RPATH_BASE);

//Defines.
define('RPATH_ROOT',			implode(DS, $parts));

define('RPATH_SITE',			RPATH_ROOT);
define('RPATH_CONFIGURATION',	RPATH_ROOT);
define('RPATH_admin',	RPATH_ROOT . '/admin');
define('RPATH_LIBRARIES',		RPATH_ROOT . '/libraries');
define('RPATH_PLUGINS',			RPATH_ROOT . '/plugins'  );
define('RPATH_INSTALLATION',	RPATH_ROOT . '/installation');
define('RPATH_THEMES',			RPATH_BASE . '/design1');
define('RPATH_CACHE',			RPATH_BASE . '/cache');
define('RPATH_MANIFESTS',		RPATH_admin . '/manifests');
