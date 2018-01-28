<?php

/**
 * @package		EasyBlog
 * @copyright	Copyright (C) 2010 Stack Ideas Private Limited. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 *
 * EasyBlog is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

defined('_JEXEC') or die('Restricted access');
global $jaxFuncNames;

// First argument should always be plugins to let Community know that its a plugin AJAX call.
// Second argument should be the plugin name, for instance 'profile'
// Third argument should be the plugin's function name to be called.
// It must be comma separated.
$jaxFuncNames[]	= 'plugins,easyblog,savecomment';