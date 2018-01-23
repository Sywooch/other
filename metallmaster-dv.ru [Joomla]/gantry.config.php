<?php
/**
 * @package 	Gantry Template Framework - RocketTheme
 * @version 	3.2.1 March 18, 2011
 * @author 		RocketTheme http://www.rockettheme.com
 * @copyright	Copyright (C) 2007 - 2011 RocketTheme, LLC
 * @license 	http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Gantry uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
 *
 */
defined('JPATH_BASE') or die();

$gantry_config_mapping = array(
    'belatedPNG' => 'belatedPNG',
	'ie6Warning' => 'ie6Warning'
);

$gantry_presets = array(
    'presets' => array(
        'preset1' => array(
            'name' => 'Green',
            'cssstyle' => 'style1',
            'linkcolor' => '#90d33b',
            'font-family' => 'helvetica'
        ),
        'preset2' => array(
            'name' => 'Blue',
            'cssstyle' => 'style2',
            'linkcolor' => '#5A9CEC',
            'font-family' => 'helvetica'
        ),
        'preset3' => array(
            'name' => 'Gray Blue',
            'cssstyle' => 'style3',
            'linkcolor' => '#C8D7E2',
            'font-family' => 'helvetica'
        ),
        'preset4' => array(
            'name' => 'Orange',
            'cssstyle' => 'style4',
            'linkcolor' => '#FFCF3B',
            'font-family' => 'helvetica'
        ),
		'preset5' => array(
            'name' => 'Purple',
            'cssstyle' => 'style5',
            'linkcolor' => '#AC81CF',
            'font-family' => 'helvetica'
		),
		'preset6' => array(
            'name' => 'Your own',
            'cssstyle' => 'style6',
            'linkcolor' => '#90d33b',
            'font-family' => 'helvetica'
        )
    )
);

$gantry_browser_params = array(
    'ie6' => array(
        'backgroundlevel' => 'low',
        'bodylevel' => 'low'
    )
);

$gantry_belatedPNG = array('.png','#rt-logo');

$gantry_ie6Warning = "<h3>IE6 DETECTED: Currently Running in Compatibility Mode</h3><h4>This site is compatible with IE6, however your experience will be enhanced with a newer browser</h4><p>Internet Explorer 6 was released in August of 2001, and the latest version of IE6 was released in August of 2004.  By continuing to run Internet Explorer 6 you are open to any and all security vulnerabilities discovered since that date.  In March of 2009, Microsoft released version 8 of Internet Explorer that, in addition to providing greater security, is faster and more standards compliant than both version 6 and 7 that came before it.</p> <br /><a class='external'  href='http://www.microsoft.com/windows/internet-explorer/?ocid=ie8_s_cfa09975-7416-49a5-9e3a-c7a290a656e2'>Download Internet Explorer 8 NOW!</a>";
