<?php
/**
 *
 * Modify user form view, User info
 *
 * @package	Magazin
 * @subpackage User
 * @author Oscar van Eijk
 * @link http://www.retinashop.net
 * 
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * 
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: edit_shopper.php 5843 2012-04-09 17:29:17Z Milbo $
 */

// Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access');

?>
<?php if(!$this->userDetails->user_is_vendor){ ?>
<div class="buttonBar-right">
	<button class="button" type="submit" onclick="javascript:return myValidator(userForm, 'saveuser');" ><?php echo $this->button_lbl ?></button>
	&nbsp;
	<button class="button" type="submit" onclick="javascript:return myValidator(userForm, 'cancel');" ><?php echo RText::_('COM_RETINASHOP_CANCEL'); ?></button>
</div>
<?php } ?>
<?php if( $this->userDetails->retinashop_user_id!=0)  {
    echo $this->loadTemplate('rsshopper');
    } ?>
<?php echo $this->loadTemplate('address_userfields'); ?>



<?php if ($this->userDetails->JUser->get('id') ) {
  echo $this->loadTemplate('address_addshipto');
  }
  ?>
<?php if(!empty($this->retinashop_userinfo_id)){
	echo '<input type="hidden" name="retinashop_userinfo_id" value="'.(int)$this->retinashop_userinfo_id.'" />';
}
?>
<input type="hidden" name="address_type" value="BT" />

