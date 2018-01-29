<?php
/**
 *
 * Layout for the shopping cart
 *
 * @package	Magazin
 * @subpackage Cart
 * @author Max Milbers, Valerie Isaksen
 *
 * @link http://www.retinashop.net
 * 
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * 
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 *
 */
// Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access');

//require(__DIR__.'/invoice_elements.php');

$oldlayout=$this->getLayout();
$this->setLayout('invoice');
echo $this->loadTemplate('elements');
$this->setLayout($oldlayout);

