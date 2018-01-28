<?php
/*------------------------------------------------------------------------
# com_k2store - K2 Store
# ------------------------------------------------------------------------
# author    Ramesh Elamathi - Weblogicx India http://www.weblogicxindia.com
# copyright Copyright (C) 2012 Weblogicxindia.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://k2store.org
# Technical Support:  Forum - http://k2store.org/forum/index.html
-------------------------------------------------------------------------*/



// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<div class="k2store">
<?php if(!$this->redirect && !isset($this->free_redirect)): ?>
<!--    ORDER SUMMARY   -->
	<div class="k2storeOrderSummary">
		<?php echo $this->orderSummary; ?>
	</div>

		<!--    PAYMENT METHOD   -->
	<h3>
		<?php echo JText::_("K2STORE_PAYMENT_METHOD"); ?>
	</h3>
	<div class="payment">
	
	<?php echo $this->plugin_html; ?>
	</div>
<?php elseif(isset($this->free_redirect) && JString::strlen($this->free_redirect) > 5): ?>
<div class="k2storeOrderSummary">
		<?php echo $this->orderSummary; ?>
	</div>
<form action="<?php echo JRoute::_('index.php?option=com_k2store&view=checkout&task=confirmPayment') ?>" method="post" >
<input type="submit" class="btn btn-common" value="<?php echo JText::_('K2STORE_PLACE_ORDER'); ?>" />

<input type="hidden" name="option" value="com_k2store" />
<input type="hidden" name="view" value="checkout" />
<input type="hidden" name="task" value="confirmPayment" />
</form>
<?php else: ?>

<div class="k2storeOrderSummary">
		<?php echo $this->orderSummary; ?>
	</div>
<form action="<?php echo JRoute::_('index.php?option=com_k2store&view=checkout&task=confirmPayment') ?>" method="post" >
<input type="submit" class="btn btn-common" value="<?php echo JText::_('K2STORE_PLACE_ORDER'); ?>" />

<input type="hidden" name="option" value="com_k2store" />
<input type="hidden" name="view" value="checkout" />
<input type="hidden" name="task" value="confirmPayment" />
</form>
<style type="text/css">

.border_bottom_line{display:none;}
.note1{display:none;}

</style>



<!--<script type="text/javascript">
location ='<?php echo $this->redirect; ?>';
</script>-->
<?php endif;?>



 
 
  

  <!--
  <pre>
  <?php
 // echo print_r($_SESSION["__k2store"]);
  //print_r($this->session->get('guest', array(), 'k2store');
  //print_r($this);
  
 // print_r($_SESSION["__k2store"]["guest"]["billing"]);
 // $_SESSION["__k2store"]["guest"]["billing"]["first_name"]="session1";
 // echo $_SESSION["__k2store"]["guest"]["billing"]["first_name"];
  ?>
  </pre>-->
  <?php
//  $session2 = JFactory::getSession();
//  echo $session2->getName()." ++1+ ";
 // echo $session->get('guest', array(), 'k2store');
 // echo $session->get('guest', 'k2store');
//  echo $session2->get('guest')." ++2+ ";
  
  ?>
  



</div>