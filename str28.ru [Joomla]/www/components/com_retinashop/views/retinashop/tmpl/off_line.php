<?php
/**
*
* Description
*
* @package	Magazin
* @subpackage
* @author
* @link http://www.retinashop.net
* 
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* 
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: default.php 2931 2011-04-02 00:57:47Z Electrocity $
*/

// Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access');

echo rsConfig::get('offline_message','shop offline mode');