<?php
/**
 *
 * Enter address data for the cart, when anonymous users checkout
 *
 * @package	Magazin
 * @subpackage User
 * @author Oscar van Eijk, Max Milbers
 * @link http://www.retinashop.net
 * 
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * 
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: edit_address.php 5843 2012-04-09 17:29:17Z Milbo $
 */
// Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access');
// rsdebug('user edit address',$this->userFields['fields']);
// Implement retina's form validation
JHTML::_('behavior.formvalidation');
JHTML::stylesheet('rspanels.css', JURI::root() . 'components/com_retinashop/retina_097115115101116115/css/');

if ($this->fTask === 'savecartuser') {
    $rtask = 'registercartuser';
} else {
    $rtask = 'registercheckoutuser';
}
?>
<h1><?php echo $this->page_title ?></h1>
<?php
echo shopFunctionsF::getLoginForm(false);
?>
<script language="javascript">
    function myValidator(f, t)
    {
        f.task.value=t; //I understand this as method to set the task of the form on the fTask. This is not longer needed, because we use another js method for the cancel button than before.
        if (document.formvalidator.isValid(f)) {
            f.submit();
            return true;
        } else {
            var msg = '<?php echo addslashes(RText::_('COM_RETINASHOP_USER_FORM_MISSING_REQUIRED_JS')); ?>';
            alert (msg+' ');
        }
        return false;
    }

    function callValidatorForRegister(f){

        var elem = jQuery('#username_field');
        elem.attr('class', "required");

        var elem = jQuery('#name_field');
        elem.attr('class', "required");

        var elem = jQuery('#password_field');
        elem.attr('class', "required");

        var elem = jQuery('#password2_field');
        elem.attr('class', "required");

        var elem = jQuery('#userForm');

	return myValidator(f, '<?php echo $rtask ?>');

    }


</script>

<fieldset>
    <h2><?php
if ($this->address_type == 'BT') {
    echo RText::_('COM_RETINASHOP_USER_FORM_EDIT_BILLTO_LBL');
} else {
    echo RText::_('COM_RETINASHOP_USER_FORM_ADD_SHIPTO_LBL');
}
?>
    </h2>


    <form method="post" id="adminForm" name="userForm" class="form-validate">
    <!--<form method="post" id="userForm" name="userForm" action="<?php echo JRoute::_('index.php'); ?>" class="form-validate">-->
	<div class="control-buttons">
	    <?php
	    if (strpos($this->fTask, 'cart') || strpos($this->fTask, 'checkout')) {
		$rview = 'cart';
	    } else {
		$rview = 'user';
	    }
// echo 'rview = '.$rview;

	    if (strpos($this->fTask, 'checkout') || $this->address_type == 'ST') {
		$buttonclass = 'default';
	    } else {
		$buttonclass = 'button rs-button-correct';
	    }


	    if (rsConfig::get('oncheckout_show_register', 1) && $this->userId == 0 && !rsConfig::get('oncheckout_only_registered', 0) && $this->address_type == 'BT' and $rview == 'cart') {
		echo RText::sprintf('COM_RETINASHOP_ONCHECKOUT_DEFAULT_TEXT_REGISTER', RText::_('COM_RETINASHOP_REGISTER_AND_CHECKOUT'), RText::_('COM_RETINASHOP_CHECKOUT_AS_GUEST'));
	    } else {
		//echo RText::_('COM_RETINASHOP_REGISTER_ACCOUNT');
	    }
	    if (rsConfig::get('oncheckout_show_register', 1) && $this->userId == 0 && $this->address_type == 'BT' and $rview == 'cart') {
		?>

    	    <button class="<?php echo $buttonclass ?>" type="submit" onclick="javascript:return callValidatorForRegister(userForm);" title="<?php echo RText::_('COM_RETINASHOP_REGISTER_AND_CHECKOUT'); ?>"><?php echo RText::_('COM_RETINASHOP_REGISTER_AND_CHECKOUT'); ?></button>
    <?php if (!rsConfig::get('oncheckout_only_registered', 0)) { ?>
		    <button class="<?php echo $buttonclass ?>" title="<?php echo RText::_('COM_RETINASHOP_CHECKOUT_AS_GUEST'); ?>" type="submit" onclick="javascript:return myValidator(userForm, '<?php echo $this->fTask; ?>');" ><?php echo RText::_('COM_RETINASHOP_CHECKOUT_AS_GUEST'); ?></button>
		<?php } ?>
    	    <button class="default" type="reset" onclick="window.location.href='<?php echo JRoute::_('index.php?option=com_retinashop&view=' . $rview); ?>'" ><?php echo RText::_('COM_RETINASHOP_CANCEL'); ?></button>


<?php } else { ?>

    	    <button class="<?php echo $buttonclass ?>" type="submit" onclick="javascript:return myValidator(userForm, '<?php echo $this->fTask; ?>');" ><?php echo RText::_('COM_RETINASHOP_SAVE'); ?></button>
    	    <button class="default" type="reset" onclick="window.location.href='<?php echo JRoute::_('index.php?option=com_retinashop&view=' . $rview); ?>'" ><?php echo RText::_('COM_RETINASHOP_CANCEL'); ?></button>

<?php } ?>
	</div>


	    <?php
	    if (!class_exists('retinashopCart'))
		require(RPATH_rs_SITE . DS . 'helpers' . DS . 'cart.php');

	    if (count($this->userFields['functions']) > 0) {
		echo '<script language="javascript">' . "\n";
		echo join("\n", $this->userFields['functions']);
		echo '</script>' . "\n";
	    }
	     echo $this->loadTemplate('userfields');

	  ?>
</fieldset>
<?php // }
if ($this->userDetails->JUser->get('id')) {
    echo $this->loadTemplate('addshipto');
  } ?>
<input type="hidden" name="option" value="com_retinashop" />
<input type="hidden" name="view" value="user" />
<input type="hidden" name="controller" value="user" />
<input type="hidden" name="task" value="<?php echo $this->fTask; // I remember, we removed that, but why?   ?>" />
<input type="hidden" name="address_type" value="<?php echo $this->address_type; ?>" />
<?php if(!empty($this->retinashop_userinfo_id)){
	echo '<input type="hidden" name="shipto_retinashop_userinfo_id" value="'.(int)$this->retinashop_userinfo_id.'" />';
}
echo JHTML::_('form.token');
?>
</form>
