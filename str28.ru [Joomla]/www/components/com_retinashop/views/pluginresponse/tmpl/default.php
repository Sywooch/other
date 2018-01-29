<?php

/**
 *
 * Show Confirmation message from Offlien Payment
 *
 * @package	Magazin
 * @subpackage
 * @author Valerie Isaksen
 * @link http://www.retinashop.net
 * 
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * 
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default.php 3217 2011-05-12 15:51:19Z alatak $
 */
// Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access');
JHTML::_('behavior.modal');


echo "<h3>" . $this->paymentResponse . "</h3>";
if ($this->paymentResponseHtml) {
    echo "<fieldset>";
    echo $this->paymentResponseHtml;
    echo "</fieldset>";
}

// add something???
?>
