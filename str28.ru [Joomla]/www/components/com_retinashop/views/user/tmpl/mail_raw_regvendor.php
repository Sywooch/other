<?php
defined('_REXEC') or die('');


/**
 * Renders the email for the vendor send in the registration process
 * @package	Magazin
 * @subpackage User
 * @author Max Milbers
 * @author Valérie Isaksen
 * @link http://www.retinashop.net
 * 
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * 
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: view.html.php 2459 2010-07-02 17:30:23Z milbo $
 */
$li = "\n";
?>


<?php echo RText::sprintf('COM_RETINASHOP_WELCOME_VENDOR', $this->vendor->vendor_store_name) . $li. $li ?>
<?php echo RText::_('COM_RETINASHOP_VENDOR_REGISTRATION_DATA') . " " . $li; ?>
<?php echo RText::_('COM_RETINASHOP_LOGINAME')   . $this->user->username . $li; ?>
<?php echo RText::_('COM_RETINASHOP_DISPLAYED_NAME')   . $this->user->name . $li. $li; ?>
<?php echo RText::_('COM_RETINASHOP_ENTERED_ADDRESS')   . $li ?>


<?php

foreach ($this->userFields['fields'] as $userField) {
    if (!empty($userField['value']) && $userField['type'] != 'delimiter' && $userField['type'] != 'BT') {
	echo $userField['title'] . ' ' . $userField['value'] . $li;
    }
}

echo $li;

echo JURI::root() . JRoute::_('index.php?option=com_retinashop&view=user', $this->useXHTML, $this->useSSL) . $li;

echo $li;
//echo JURI::root() . 'index.php?option=com_retinashop&view=user&retinashop_user_id=' . $this->_models['user']->_id . ' ' . $li;
//echo JURI::root() . 'index.php?option=com_retinashop&view=vendor&retinashop_vendor_id=' . $this->vendor->retinashop_vendor_id . ' ' . $li;
?>
