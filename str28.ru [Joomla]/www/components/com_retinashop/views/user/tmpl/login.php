<?php
/**
*
* Layout for the shopping cart
*
* @package	Magazin
* @subpackage Cart
* @author Max Milbers, George Kostopoulos
*
* @link http://www.retinashop.net
* 
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* 
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: cart.php 4431 2011-10-17 grtrustme $
*/

// Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access');

if(!class_exists('shopFunctionsF')) require(RPATH_rs_SITE.DS.'helpers'.DS.'shopfunctionsf.php');
$comUserOption=shopfunctionsF::getComUserOption();
$uri = JFactory::getURI();
$url = $uri->toString(array('path', 'query', 'fragment'));
// rsdebug('$this->show ',$this);
if ($this->show and $this->JUser->id == 0  ) {
JHtml::_('behavior.formvalidation');
JHTML::_ ( 'behavior.modal' );
// rsdebug('cart',$this->cart);



$uri = JFactory::getURI();
$url = $uri->toString(array('path', 'query', 'fragment'));
 rsdebug('my url loginform '.$url);
// 	Hmmmm	$this->cart->userDetails->JUser->id === 0


	//Extra login stuff, mains like openId and plugins HERE
    if (JPluginHelper::isEnabled('authentication', 'openid')) {
        $lang = JFactory::getLanguage();
        $lang->load('plg_authentication_openid', RPATH_admin);
        $langScript = 'var JLanguage = {};' .
                ' JLanguage.WHAT_IS_OPENID = \'' . RText::_('WHAT_IS_OPENID') . '\';' .
                ' JLanguage.LOGIN_WITH_OPENID = \'' . RText::_('LOGIN_WITH_OPENID') . '\';' .
                ' JLanguage.NORMAL_LOGIN = \'' . RText::_('NORMAL_LOGIN') . '\';' .
                ' var comlogin = 1;';
        $document = JFactory::getDocument();
        $document->addScriptDeclaration($langScript);
        JHTML::_('script', 'openid.js');
    }

    //end plugins section

    //anonymous order section
    if ($this->order  ) {
    	?>

	    <div class="order-view">

	    <h1><?php echo RText::_('COM_RETINASHOP_ORDER_ANONYMOUS') ?></h1>

	    <form action="<?php echo JRoute::_( 'index.php', true, 0); ?>" method="post" name="com-login" >

	    	<div class="width30 floatleft" id="com-form-order">
	    		<label for="order_number"><?php echo RText::_('COM_RETINASHOP_ORDER_NUMBER') ?></label><br />
	    		<input type="text" id="order_number " name="order_number" class="inputbox" size="18" alt="order_number " />
	    	</div>
	    	<div class="width30 floatleft" id="com-form-order">
	    		<label for="order_pass"><?php echo RText::_('COM_RETINASHOP_ORDER_PASS') ?></label><br />
	    		<input type="text" id="order_pass" name="order_pass" class="inputbox" size="18" alt="order_pass" value="p_"/>
	    	</div>
	    	<div class="width30 floatleft" id="com-form-order">
	    		<input type="submit" name="Submitbuton" class="button" value="<?php echo RText::_('COM_RETINASHOP_ORDER_BUTTON_VIEW') ?>" />
	    	</div>
	    	<div class="div-hidden-both"></div>
	    	<input type="hidden" name="option" value="com_retinashop" />
	    	<input type="hidden" name="view" value="orders" />
	    	<input type="hidden" name="layout" value="details" />
	    	<input type="hidden" name="return" value="" />

	    </form>

	    </div>

<?php   }


    ?>
    <form action="index.php" method="post" name="com-login" >
	<?php if (!$this->from_cart ) { ?>
	<div>
		<h2><?php echo RText::_('COM_RETINASHOP_ORDER_CONNECT_FORM'); ?></h2>
	</div>
<div class="clear"></div>
<?php } else { ?>
        <p><?php echo RText::_('COM_RETINASHOP_ORDER_CONNECT_FORM'); ?></p>
<?php }   ?>
        <p class="width30 floatleft" id="com-form-login-username">
            <input type="text" name="username" size="18" alt="<?php echo RText::_('COM_RETINASHOP_USERNAME'); ?>" value="<?php echo RText::_('COM_RETINASHOP_USERNAME'); ?>" onblur="if(this.value=='') this.value='<?php echo addslashes(RText::_('COM_RETINASHOP_USERNAME')); ?>';" onfocus="if(this.value=='<?php echo addslashes(RText::_('COM_RETINASHOP_USERNAME')); ?>') this.value='';" />
	</p>

        <p class="width30 floatleft" id="com-form-login-password">
            <?php if ( Jrs_VERSION===1 ) { ?>
            <input type="password" id="passwd" name="passwd" class="inputbox" size="18" alt="<?php echo RText::_('COM_RETINASHOP_PASSWORD'); ?>" value="<?php echo RText::_('COM_RETINASHOP_PASSWORD'); ?>" onblur="if(this.value=='') this.value='<?php echo addslashes(RText::_('COM_RETINASHOP_PASSWORD')); ?>';" onfocus="if(this.value=='<?php echo addslashes(RText::_('COM_RETINASHOP_PASSWORD')); ?>') this.value='';" />
            <?php } else { ?>
            <input id="modlgn-passwd" type="password" name="password" class="inputbox" size="18" alt="<?php echo RText::_('COM_RETINASHOP_PASSWORD'); ?>" value="<?php echo RText::_('COM_RETINASHOP_PASSWORD'); ?>" onblur="if(this.value=='') this.value='<?php echo addslashes(RText::_('COM_RETINASHOP_PASSWORD')); ?>';" onfocus="if(this.value=='<?php echo addslashes(RText::_('COM_RETINASHOP_PASSWORD')); ?>') this.value='';" />
            <?php } ?>
	</p>

        <p class="width30 floatleft" id="com-form-login-remember">
            <input type="submit" name="Submit" class="default" value="<?php echo RText::_('COM_RETINASHOP_LOGIN') ?>" />
            <?php if (JPluginHelper::isEnabled('main', 'remember')) : ?>
            <label for="remember"><?php echo $remember_me = Jrs_VERSION===1? RText::_('Remember me') : RText::_('RGLOBAL_REMEMBER_ME') ?></label>
            <input type="checkbox" id="remember" name="remember" class="inputbox" value="yes" alt="Remember Me" />
            <?php endif; ?>
        </p>
        <div class="div-hidden-both"></div>

        <div class="width30 floatleft">
            <a   href="<?php echo JRoute::_('index.php?option='.$comUserOption.'&view=remind'); ?>">
            <?php echo RText::_('COM_RETINASHOP_ORDER_FORGOT_YOUR_USERNAME'); ?></a>
        </div>
        <div class="width30 floatleft">
            <a   href="<?php echo JRoute::_('index.php?option='.$comUserOption.'&view=reset'); ?>">
            <?php echo RText::_('COM_RETINASHOP_ORDER_FORGOT_YOUR_PASSWORD'); ?></a>
        </div>



        <?php /*
          $usersConfig = &JComponentHelper::getParams( 'com_users' );
          if ($usersConfig->get('allowUserRegistration')) { ?>
          <div class="width30 floatleft">
          <a  class="details" href="<?php echo JRoute::_( 'index.php?option=com_retinashop&view=user' ); ?>">
          <?php echo RText::_('COM_RETINASHOP_ORDER_REGISTER'); ?></a>
          </div>
          <?php }
         */ ?>

        <div class="div-hidden-both"></div>


        <?php if ( Jrs_VERSION===1 ) { ?>
        <input type="hidden" name="task" value="login" />
        <?php } else { ?>
	<input type="hidden" name="task" value="user.login" />
        <?php } ?>
        <input type="hidden" name="option" value="<?php echo $comUserOption ?>" />
        <input type="hidden" name="return" value="<?php echo base64_encode($url) ?>" />
        <?php echo JHTML::_('form.token'); ?>
    </form>

<?php  }else if ($this->JUser->id  ){ ?>

   <form action="index.php" method="post" name="login" id="form-login">
        <?php echo RText::sprintf( 'COM_RETINASHOP_HINAME', $this->JUser->name ); ?>
	<input type="submit" name="Submit" class="button" value="<?php echo RText::_( 'COM_RETINASHOP_BUTTON_LOGOUT'); ?>" />
        <input type="hidden" name="option" value="<?php echo $comUserOption ?>" />
        <?php if ( Jrs_VERSION===1 ) { ?>
            <input type="hidden" name="task" value="logout" />
        <?php } else { ?>
            <input type="hidden" name="task" value="user.logout" />
        <?php } ?>
        <?php echo JHtml::_('form.token'); ?>
	<input type="hidden" name="return" value="<?php echo base64_encode($url) ?>" />
    </form>

<?php }

?>

