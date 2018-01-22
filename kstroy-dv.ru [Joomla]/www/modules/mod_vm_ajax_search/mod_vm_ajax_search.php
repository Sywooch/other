<?php
/**
* @package mod_vm_ajax_search
*
* @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU/GPL, see LICENSE.php
* VM Live Product Search is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
*/

/*
* Modified by rupostel.com team. 
* Original extensions:
*/

/**
 * VM AJAX Product Search
 *
 * Used to process Ajax searches on a Virtuemart 1.1.9 Products.
 * Based on the excellent mod_pixsearch live search module designed by Henrik Hussfelt (henrik@pixpro.net - http://pixpro.net)
 * Based on mod_vm_live_product from John Connolly <webmaster@GJCWebdesign.com
 *
 * @author		Stan Scholtz <info@rupostel.com>
 * @package		mod_vm_ajax_search
 * @since		1.5
 * @version     1.0.0
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

require(JModuleHelper::getLayoutPath('mod_vm_ajax_search'));