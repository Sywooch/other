<?php

/**
* @copyright	Copyright (C) 2009 - 2009 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* @contact		shyam@joomlaxi.com
*/

defined('JPATH_BASE') or die();

function debugMessage($msg, $debugMode = false)
{
	if($debugMode==false)
		return;
		
	global $mainframe;
	$mainframe->enqueueMessage($msg);
} 