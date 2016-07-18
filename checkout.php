<?php
/*
 * --------------------------------------------------------------------------------
   Weblogicx India  - K2 Store
 * --------------------------------------------------------------------------------
 * @package		Joomla! 2.5x
 * @subpackage	K2 Store
 * @author    	Weblogicx India http://www.weblogicxindia.com
 * @copyright	Copyright (c) 2010 - 2015 Weblogicx India Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link		http://weblogicxindia.com
 * --------------------------------------------------------------------------------
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
$action = JRoute::_('index.php?option=com_k2store&view=checkout');



define( '_JEXEC', 1 );
define( 'DS', DIRECTORY_SEPARATOR );

$dir=str_replace("/ajax","",dirname(__FILE__));
$dir=str_replace("\ajax","",$dir);

if ( file_exists( $dir. '/defines.php' ) ) {
	include_once $dir. '/defines.php';
}
if ( !defined( '_JDEFINES' ) ) {
	define( 'JPATH_BASE', $dir );
	require_once JPATH_BASE . '/includes/defines.php';
}
require_once JPATH_BASE . '/includes/framework.php';

$mainframe =& JFactory::getApplication('site');
$mainframe->initialise();





 session_start();
?>

<div id="k2store-checkout" class="k2store checkout container tmp1">
	<div id="k2store-checkout-content">
  		<h2 class="text-center">
  			<?php //echo JText::_('K2STORE_CHECKOUT'); ?>
  			<?php echo JText::_( "K2STORE_MY_SHOPPING_CART" ); ?>
  		</h2>
        
<?php        
//mail("gsu1234@mail.ru", "t", "t");





?>


<div class="cart_navigation">
  <div class="item completed number1">1. Мои товары</div>
  <div class="separator"></div>
  <div class="item active number2">2. Мои данные</div>
  <div class="separator"></div>
  <div class="item number3">3. Как оплатить</div>
  <div class="separator"></div>
  <div class="item number4">4. Заказ оформлен</div>

</div>



    <div id="checkout">
      <div class="checkout-heading"><?php echo JText::_('K2STORE_CHECKOUT_OPTIONS'); ?></div>
      <div class="checkout-content"></div>
    </div>
    <?php if (!$this->logged) { ?>
    <div id="billing-address">
    	
    	
    	
      <div class="checkout-heading"><span><?php echo JText::_('K2STORE_CHECKOUT_ACCOUNT'); ?></span></div>
      <div class="checkout-content number1 tmp1"></div>


     

    </div>
    <?php } else { ?>
    <div id="billing-address">


      <div class="checkout-heading"><span><?php echo JText::_('K2STORE_CHECKOUT_BILLING_ADDRESS'); ?></span></div>
      <div class="checkout-content number1"></div>
    </div>
    <?php } ?>
    

    <?php if ($this->showShipping == null) { ?>
    <div id="shipping-address">
      <div class="checkout-heading"><?php echo JText::_('K2STORE_CHECKOUT_SHIPPING_ADDRESS'); ?></div>
      <div class="checkout-content"></div>
    </div>
    <?php } ?>


    <div id="shipping-payment-method">
      <div class="checkout-heading">
      <?php if ($this->showShipping) : ?>
      <?php echo JText::_('K2STORE_CHECKOUT_SHIPPING_PAYMENT_METHOD'); ?>
      <?php else: ?>
      <?php echo JText::_('K2STORE_CHECKOUT_PAYMENT_METHOD'); ?>
      <?php endif;?>
      </div>
      <div class="checkout-content number2"></div>









    </div>


  	<div class="border_bottom_line"></div>
  	<span class="note1">Поля, помеченные <span style="color:red;">*</span> - обязательные для заполнения</span>

    <div id="confirm">
      <div class="checkout-heading"><?php echo JText::_('K2STORE_CHECKOUT_CONFIRM'); ?></div>
      <div class="checkout-content number3"></div>
    </div>

  </div>




  </div>
  
  
  
  
    <script type="text/javascript">
  	var $j=jQuery.noConflict();
	
 // var first_name=$('.checkout-content.number1 #first_name').val();
	var first_name="";
	
	$j.ajax({
	url: '/ajax/session.php',
	type: 'post',
	async: 'false',
	data: 'first_name='+(first_name)+'',
	dataType: 'html',
	success: function(html) {
		//alert(html);
	}
  });
  
  </script>
  
 
  <?php
  
  //print_r($this->session->get('guest', array(), 'k2store');
  //print_r($this);
  
//  print_r($_SESSION);
  ?>

  <?php
//  $session2 = JFactory::getSession();
//  echo $session2->getName()." ++1+ ";
 // echo $session->get('guest', array(), 'k2store');
 // echo $session->get('guest', 'k2store');
 // echo $session2->get('guest')." ++2+ ";
  
  
//  echo "=========php-payment_method2=========";
//  $_SESSION["__k2store"]["guest"]["billing"]["first_name"]="session1-php";
//  echo $_SESSION["__k2store"]["guest"]["billing"]["first_name"];
 // $_SESSION["__k2store"]["payment_values"]["payment_plugin"]="payment_banktransfer";
//  echo $_SESSION["__k2store"]["payment_values"]["payment_plugin"];
  
//  $_SESSION["__k2store"]["payment_method"]="payment_banktransfer";
 // echo $_SESSION["__k2store"]["payment_method"];
  
  ?>
  
  
<script type="text/javascript"><!--

var query = {};
query['option']='com_k2store';
query['view']='checkout';
(function($) {
$(document).on('change', '#checkout .checkout-content input[name=\'account\']', function() {
	if ($(this).attr('value') == 'register') {
		$('#billing-address .checkout-heading span').html('<?php echo JText::_('K2STORE_CHECKOUT_ACCOUNT'); ?>');
	} else {
		$('#billing-address .checkout-heading span').html('<?php echo JText::_('K2STORE_CHECKOUT_BILLING_ADDRESS'); ?>');
	}
});
})(k2store.jQuery);

(function($) {
$(document).on('click', '.checkout-heading a', function() {
	$('.checkout-content').slideUp('slow');

	$(this).parent().parent().find('.checkout-content').slideDown('slow');
});
})(k2store.jQuery);

//incase only guest checkout is allowed we got to process that first
<?php if((!$this->logged && $this->params->get('allow_guest_checkout')) && (!$this->params->get('show_login_form', 1) && !$this->params->get('allow_registration', 1))){ ?>
(function($) {
$(document).ready(function() {
	$('#billing-address .checkout-heading span').html('<?php echo JText::_('K2STORE_CHECKOUT_BILLING_ADDRESS'); ?>');
	$('#checkout').hide();
	$.ajax({
	url: 'index.php',
	type: 'post',
	data: 'option=com_k2store&view=checkout&task=guest',
	dataType: 'html',
	success: function(html) {
		$('.warning, .k2error').remove();

		$('#billing-address .checkout-content').html(html);

		$('#checkout .checkout-content').slideUp('slow');

		$('#billing-address .checkout-content').slideDown('slow');

	},
	error: function(xhr, ajaxOptions, thrownError) {
		//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
	}
});
});
})(k2store.jQuery);

<?php }elseif(!$this->logged) { ?>
(function($) {
$(document).ready(function() {
	$.ajax({
		url: 'index.php',
		type: 'post',
		data: 'option=com_k2store&view=checkout&task=login',
		success: function(html) {
			$('#checkout .checkout-content').html(html);

			$('#checkout .checkout-content').slideDown('slow');
		},
		error: function(xhr, ajaxOptions, thrownError) {
			//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});
})(k2store.jQuery);

<?php } else { ?>
(function($) {
$(document).ready(function() {
	$.ajax({
		url: 'index.php',
		type: 'post',
		data: 'option=com_k2store&view=checkout&task=billing_address',
		dataType: 'html',
		success: function(html) {
			$('#billing-address .checkout-content').html(html);

			$('#billing-address .checkout-content').slideDown('slow');
		},
		error: function(xhr, ajaxOptions, thrownError) {
			//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});
})(k2store.jQuery);
<?php } ?>

//new account
(function($) {
$(document).on('click', '#button-account', function() {
		var task = $('input[name=\'account\']:checked').attr('value');
	$.ajax({
		url: 'index.php',
		type: 'post',
		data: 'option=com_k2store&view=checkout&task='+task,
		dataType: 'html',
		beforeSend: function() {
			$('#button-account').attr('disabled', true);
			$('#button-account').after('<span class="wait">&nbsp;<img src="media/k2store/images/loader.gif" alt="" /></span>');
		},
		complete: function() {
			$('#button-account').attr('disabled', false);
			$('.wait').remove();
		},
		success: function(html) {
			$('.warning, .k2error').remove();

			$('#billing-address .checkout-content').html(html);

			$('#checkout .checkout-content').slideUp('slow');

			$('#billing-address .checkout-content').slideDown('slow');

			$('.checkout-heading a').remove();

			$('#checkout .checkout-heading').append('<a><?php echo JText::_('K2STORE_CHECKOUT_MODIFY'); ?></a>');
		},
		error: function(xhr, ajaxOptions, thrownError) {
			//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});
})(k2store.jQuery);

//Login
(function($) {
$(document).on('click', '#button-login', function() {
	$.ajax({
		url: 'index.php',
		type: 'post',
		data: $('#checkout #login :input'),
		dataType: 'json',
		beforeSend: function() {
			$('#button-login').attr('disabled', true);
			$('#button-login').after('<span class="wait">&nbsp;<img src="media/k2store/images/loader.gif" alt="" /></span>');
		},
		complete: function() {
			$('#button-login').attr('disabled', false);
			$('.wait').remove();
		},
		success: function(json) {
			$('.warning, .k2error').remove();

			if (json['redirect']) {
				location = json['redirect'];
			} else if (json['error']) {
				$('#checkout .checkout-content').prepend('<div class="warning alert alert-danger" style="display: none;">' + json['error']['warning'] + '<button data-dismiss="alert" class="close" type="button"></button></div>');

				$('.warning').fadeIn('slow');
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});
})(k2store.jQuery);

// Register
(function($) {
$(document).on('click', '#button-register', function() {
	$.ajax({
		url: 'index.php',
		type: 'post',
		data: $('#billing-address input[type=\'text\'], #billing-address input[type=\'password\'], #billing-address input[type=\'checkbox\']:checked, #billing-address input[type=\'radio\']:checked, #billing-address input[type=\'hidden\'], #billing-address select, #billing-address textarea'),
		dataType: 'json',
		beforeSend: function() {
			$('#button-register').attr('disabled', true);
			$('#button-register').after('<span class="wait">&nbsp;<img src="media/k2store/images/loader.gif" alt="" /></span>');
		},
		complete: function() {
			$('#button-register').attr('disabled', false);
			$('.wait').remove();
		},
		success: function(json) {
			$('#billing-address .warning, #billing-address .k2error').remove();

			if (json['redirect']) {
				location = json['redirect'];
			} else if (json['error']) {

				$.each( json['error'], function( key, value ) {
					if (value) {
						//$('#billing-address #'+key).after('<br class="k2error" /><span class="k2error">' + value + '</span>');
						$('#billing-address #'+key).val(value);
						$('#billing-address #'+key).addClass("k2error");
					}
					//alert( key + ": " + value );
					});


				if (json['error']['warning']) {
					$('#billing-address .checkout-content').prepend('<div class="warning alert alert-block alert-danger" style="display: none;">' + json['error']['warning'] + '<button data-dismiss="alert" class="close" type="button"></button></div>');

					$('.warning').fadeIn('slow');
				}

				if (json['error']['password']) {
					$('#billing-address input[name=\'password\'] + br').after('<span class="k2error">' + json['error']['password'] + '</span>');
				}

				if (json['error']['confirm']) {
					$('#billing-address input[name=\'confirm\'] + br').after('<span class="k2error">' + json['error']['confirm'] + '</span>');
				}
			} else {
				<?php if ($this->showShipping) { ?>
				var shipping_address = $('#billing-address input[name=\'shipping_address\']:checked').attr('value');

				if (shipping_address) {
					$.ajax({
						url: 'index.php',
						type: 'post',
						data: 'option=com_k2store&view=checkout&task=shipping_payment_method',
						dataType: 'html',
						success: function(html) {
							$('#shipping-payment-method .checkout-content').html(html);

							$('#billing-address .checkout-content').slideUp('slow');

							$('#shipping-payment-method .checkout-content').slideDown('slow');

							$('#checkout .checkout-heading a').remove();
							$('#billing-address .checkout-heading a').remove();
							$('#shipping-address .checkout-heading a').remove();
							$('#shipping-payment-method .checkout-heading a').remove();
							//$('#payment-method .checkout-heading a').remove();

							$('#shipping-address .checkout-heading').append('<a><?php echo JText::_('K2STORE_CHECKOUT_MODIFY'); ?></a>');
							$('#billing-address .checkout-heading').append('<a><?php echo JText::_('K2STORE_CHECKOUT_MODIFY'); ?></a>');

							$.ajax({
								url: 'index.php?option=com_k2store&view=checkout&task=shipping_address',
								dataType: 'html',
								success: function(html) {
									$('#shipping-address .checkout-content').html(html);
								},
								error: function(xhr, ajaxOptions, thrownError) {
									//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
								}
							});
						},
						error: function(xhr, ajaxOptions, thrownError) {
							//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
						}
					});
				} else {
					$.ajax({
						url: 'index.php',
						type: 'post',
						data: 'option=com_k2store&view=checkout&task=shipping_address',
						dataType: 'html',
						success: function(html) {
							$('#shipping-address .checkout-content').html(html);

							$('#billing-address .checkout-content').slideUp('slow');

							$('#shipping-address .checkout-content').slideDown('slow');

							$('#checkout .checkout-heading a').remove();
							$('#billing-address .checkout-heading a').remove();
							$('#shipping-address .checkout-heading a').remove();
							$('#shipping-payment-method .checkout-heading a').remove();
							//$('#payment-method .checkout-heading a').remove();

							$('#billing-address .checkout-heading').append('<a><?php echo JText::_('K2STORE_CHECKOUT_MODIFY'); ?></a>');
						},
						error: function(xhr, ajaxOptions, thrownError) {
							//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
						}
					});
				}
				<?php } else { ?>
				$.ajax({
					url: 'index.php',
					type: 'post',
					data: 'option=com_k2store&view=checkout&task=shipping_payment_method',
					dataType: 'html',
					success: function(html) {
						$('#shipping-payment-method .checkout-content').html(html);

						$('#billing-address .checkout-content').slideUp('slow');

						$('#shipping-payment-method .checkout-content').slideDown('slow');

						$('#checkout .checkout-heading a').remove();
						$('#billing-address .checkout-heading a').remove();
						//$('#payment-method .checkout-heading a').remove();
						$('#shipping-payment-method .checkout-heading a').remove();

						$('#billing-address .checkout-heading').append('<a><?php echo JText::_('K2STORE_CHECKOUT_MODIFY'); ?></a>');
					},
					error: function(xhr, ajaxOptions, thrownError) {
						//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});
				<?php } ?>

				$.ajax({
					url: 'index.php',
					type: 'post',
					data: 'option=com_k2store&view=checkout&task=billing_address',
					dataType: 'html',
					success: function(html) {
						$('#billing-address .checkout-content').html(html);

						$('#billing-address .checkout-heading span').html('<?php echo JText::_('K2STORE_BILLING_ADDRESS'); ?>');
					},
					error: function(xhr, ajaxOptions, thrownError) {
						//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});
})(k2store.jQuery);

//billing address
(function($) {
$(document).on('click', '#button-billing-address', function() {
	$.ajax({
		url: 'index.php',
		type: 'post',
		data: $('#billing-address input[type=\'text\'], #billing-address input[type=\'password\'], #billing-address input[type=\'checkbox\']:checked, #billing-address input[type=\'radio\']:checked, #billing-address input[type=\'hidden\'], #billing-address select'),
		dataType: 'json',
		beforeSend: function() {
			$('#button-billing-address').attr('disabled', true);
			$('#button-billing-address').after('<span class="wait">&nbsp;<img src="media/k2store/images/loader.gif" alt="" /></span>');
		},
		complete: function() {
			$('#button-billing-address').attr('disabled', false);
			$('.wait').remove();
		},
		success: function(json) {
			$('.warning, .k2error').remove();

			if (json['redirect']) {
				location = json['redirect'];
			} else if (json['error']) {
				if (json['error']['warning']) {
					$('#billing-address .checkout-content').prepend('<div class="warning" style="display: none;">' + json['error']['warning'] + '<button data-dismiss="alert" class="close" type="button"></button></div>');

					$('.warning').fadeIn('slow');
				}

				$.each( json['error'], function( key, value ) {
					if (value) {
						//$('#billing-address #'+key).after('<br class="k2error" /><span class="k2error">' + value + '</span>');
						$('#billing-address #'+key).val(value);
						$('#billing-address #'+key).addClass("k2error");
					}
				});

			} else {
				<?php if ($this->showShipping) { ?>
				$.ajax({
					url: 'index.php',
					type: 'post',
					data: 'option=com_k2store&view=checkout&task=shipping_address',
					dataType: 'html',
					success: function(html) {
						$('#shipping-address .checkout-content').html(html);

						$('#billing-address .checkout-content').slideUp('slow');

						$('#shipping-address .checkout-content').slideDown('slow');

						$('#billing-address .checkout-heading a').remove();
						$('#shipping-address .checkout-heading a').remove();
						$('#shipping-payment-method .checkout-heading a').remove();
						//$('#payment-method .checkout-heading a').remove();

						$('#billing-address .checkout-heading').append('<a><?php echo JText::_('K2STORE_CHECKOUT_MODIFY'); ?></a>');
					},
					error: function(xhr, ajaxOptions, thrownError) {
						//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});
				<?php } else { ?>
				$.ajax({
					url: 'index.php',
					type: 'post',
					data: 'option=com_k2store&view=checkout&task=shipping_payment_method',
					dataType: 'html',
					success: function(html) {
						$('#shipping-payment-method .checkout-content').html(html);

						$('#billing-address .checkout-content').slideUp('slow');

						$('#shipping-payment-method .checkout-content').slideDown('slow');

						$('#billing-address .checkout-heading a').remove();
						$('#shipping-payment-method .checkout-heading a').remove();

						$('#billing-address .checkout-heading').append('<a><?php echo JText::_('K2STORE_CHECKOUT_MODIFY'); ?></a>');
					},
					error: function(xhr, ajaxOptions, thrownError) {
						//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});
				<?php } ?>

				$.ajax({
					url: 'index.php',
					type: 'post',
					data: 'option=com_k2store&view=checkout&task=billing_address',
					dataType: 'html',
					success: function(html) {
						$('#billing-address .checkout-content').html(html);
					},
					error: function(xhr, ajaxOptions, thrownError) {
						//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});
})(k2store.jQuery);

//Shipping Address
(function($) {
$(document).on('click', '#button-shipping-address', function() {
	$.ajax({
		url: 'index.php',
		type: 'post',
		data: $('#shipping-address input[type=\'text\'], #shipping-address input[type=\'hidden\'], #shipping-address input[type=\'password\'], #shipping-address input[type=\'checkbox\']:checked, #shipping-address input[type=\'radio\']:checked, #shipping-address select'),
		dataType: 'json',
		beforeSend: function() {
			$('#button-shipping-address').attr('disabled', true);
			$('#button-shipping-address').after('<span class="wait">&nbsp;<img src="media/k2store/images/loader.gif" alt="" /></span>');
		},
		complete: function() {
			$('#button-shipping-address').attr('disabled', false);
			$('.wait').remove();
		},
		success: function(json) {
			$('.warning, .k2error').remove();

			if (json['redirect']) {
				location = json['redirect'];
			} else if (json['error']) {
				if (json['error']['warning']) {
					$('#shipping-address .checkout-content').prepend('<div class="warning alert alert-danger" style="display: none;">' + json['error']['warning'] + '<button data-dismiss="alert" class="close" type="button"></button></div>');

					$('.warning').fadeIn('slow');
				}

				$.each( json['error'], function( key, value ) {
					if (value) {
						//$('#shipping-address #'+key).after('<br class="k2error" /><span class="k2error">' + value + '</span>');
						$('#shipping-address #'+key).val(value);
						$('#shipping-address #'+key).addClass("k2error");
					}
				});


			} else {
				$.ajax({
					url: 'index.php',
					type: 'post',
					data: 'option=com_k2store&view=checkout&task=shipping_payment_method',
					dataType: 'html',
					success: function(html) {
						$('#shipping-payment-method .checkout-content').html(html);

						$('#shipping-address .checkout-content').slideUp('slow');

						$('#shipping-payment-method .checkout-content').slideDown('slow');

						$('#shipping-address .checkout-heading a').remove();
						$('#shipping-payment-method .checkout-heading a').remove();
						//$('#payment-method .checkout-heading a').remove();

						$('#shipping-address .checkout-heading').append('<a><?php echo JText::_('K2STORE_CHECKOUT_MODIFY'); ?></a>');

						$.ajax({
							url: 'index.php',
							type: 'post',
							data: 'option=com_k2store&view=checkout&task=shipping_address',
							dataType: 'html',
							success: function(html) {
								$('#shipping-address .checkout-content').html(html);
							},
							error: function(xhr, ajaxOptions, thrownError) {
								//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
							}
						});
					},
					error: function(xhr, ajaxOptions, thrownError) {
						//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});

				$.ajax({
					url: 'index.php',
					type: 'post',
					data: 'option=com_k2store&view=checkout&task=billing_address',
					dataType: 'html',
					success: function(html) {
						$('#billing-address .checkout-content').html(html);
					},
					error: function(xhr, ajaxOptions, thrownError) {
						//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});
})(k2store.jQuery);

//Guest
(function($) {
$(document).on('click', '#button-guest', function() {




//проверка
//$('#billing-address #'+key).val(value);
//$('#billing-address #'+key).addClass("k2error");

var name=$('.checkout-content.number1 #first_name').val();
var phone=$('.checkout-content.number1 #phone_1').val();

if(name==""){

$('.checkout-content.number1 #first_name').val("Заполните поле");
$('.checkout-content.number1 #first_name').addClass("k2error");

return false;


}


if(phone==""){

$('.checkout-content.number1 #phone_1').val("Заполните поле");
$('.checkout-content.number1 #phone_1').addClass("k2error");

return false;


}

var re = /^[0-9]*$/;
if (!re.test(phone)){
	$('.checkout-content.number1 #phone_1').val("Заполните корректно поле");
	$('.checkout-content.number1 #phone_1').addClass("k2error");

	return false;

}


//radio3 - курьерр по Киеву
//radio2 - самовывоз
//radio1 - доставка по украине


if( ($(".checkout-content.number1 .k2store-shipping .radio3").prop("checked")==false) && ($(".checkout-content.number1 .k2store-shipping .radio2").prop("checked")==false) && 
	($(".checkout-content.number1 .k2store-shipping .radio1").prop("checked")==false) ){

alert("Необходимо выбрать способ доставки");
return false;
}


if($(".checkout-content.number1 .k2store-shipping .radio3").prop("checked")){

	var street=$(".checkout-content.number1 #address_1").val();
	//alert(street);
	if(street==""){


		$('.checkout-content.number1 #address_1').val("Заполните поле");
		$('.checkout-content.number1 #address_1').addClass("k2error");

		return false;
	}


}

//if($(".checkout-content.number1 .k2store-shipping .radio2").prop("checked")){

//}

if($(".checkout-content.number1 .k2store-shipping .radio1").prop("checked")){

	var street=$(".checkout-content.number1 #address_1").val();
	if(street==""){


		$('.checkout-content.number1 #address_1').val("Заполните поле");
		$('.checkout-content.number1 #address_1').addClass("k2error");

		return false;
	}


}




//заполнение сессии
var first_name=$('.checkout-content.number1 #first_name').val();
var phone_1=$('.checkout-content.number1 #phone_1').val();
var email=$('.checkout-content.number1 #email').val();

if($(".checkout-content.number1 .k2store-shipping .radio1").prop("checked")==true){
	var shipping_method=$(".checkout-content.number1 .k2store-shipping .radio1").attr("rel");
}
if($(".checkout-content.number1 .k2store-shipping .radio2").prop("checked")==true){
	var shipping_method=$(".checkout-content.number1 .k2store-shipping .radio2").attr("rel");
}
if($(".checkout-content.number1 .k2store-shipping .radio3").prop("checked")==true){
	var shipping_method=$(".checkout-content.number1 .k2store-shipping .radio3").attr("rel");
}
var city=$(".checkout-content.number1 #city").val();
var address_1=$('.checkout-content.number1 #address_1').val();

//alert(shipping_method);
//alert(city);
//alert(address_1);


$.ajax({
	url: '/ajax/session.php',
	type: 'post',
	async: 'false',
	data: 'first_name='+(first_name)+'&phone_1='+(phone_1)+'&email='+(email)+'&shipping_method='+(shipping_method)+'&city='+(city)+'&address_1='+(address_1)+'',
	dataType: 'html',
	success: function(html) {
	//	alert(html);
	}
});









var s1=$('#billing-address input[type=\'text\'], #billing-address input[type=\'checkbox\']:checked, #billing-address input[type=\'radio\']:checked, #billing-address input[type=\'hidden\'], #billing-address select').serialize();
//alert(s1);

	$.ajax({
		url: 'index.php',
		type: 'post',
		data: $('#billing-address input[type=\'text\'], #billing-address input[type=\'checkbox\']:checked, #billing-address input[type=\'radio\']:checked, #billing-address input[type=\'hidden\'], #billing-address select'),
		//data: s1,
		dataType: 'json',
		beforeSend: function() {
			$('#button-guest').attr('disabled', true);
			$('#button-guest').after('<span class="wait">&nbsp;<img src="media/k2store/images/loader.gif" alt="" /></span>');
		},
		complete: function() {
			$('#button-guest').attr('disabled', false);
			$('.wait').remove();
		},
		success: function(json) {
			$('.warning, .k2error').remove();

			if (json['redirect']) {
				location = json['redirect'];
			//} else if (json['error']) {


/*
				if (json['error']['warning']) {
					$('#billing-address .checkout-content').prepend('<div class="warning alert alert-danger" style="display: none;">' + json['error']['warning'] + '<button data-dismiss="alert" class="close" type="button"></button></div>');

					$('.warning').fadeIn('slow');
				}

				$.each( json['error'], function( key, value ) {
					alert(key);
					if (value) {
						value="Заполните поле";
						//$('#billing-address #'+key).after('<br class="k2error" /><span class="k2error">' + value + '</span>');
						$('#billing-address #'+key).val(value);
						$('#billing-address #'+key).addClass("k2error");
					}
				});
*/
			} else {
				//alert("s-1");
				//--OK--//
				<?php if ($this->showShipping) { ?>
				var shipping_address = $('#billing-address input[name=\'shipping_address\']:checked').attr('value');

				if (shipping_address) {
					$.ajax({
						url: 'index.php',
						type: 'post',
						data: 'option=com_k2store&view=checkout&task=shipping_payment_method',
						dataType: 'html',
						success: function(html) {
							$('#shipping-payment-method .checkout-content').html(html);

							$('#billing-address .checkout-content').slideUp('slow');

							$('#shipping-payment-method .checkout-content').slideDown('slow');

							$('#billing-address .checkout-heading a').remove();
							$('#shipping-address .checkout-heading a').remove();
							$('#shipping-payment-method .checkout-heading a').remove();

							$('#billing-address .checkout-heading').append('<a><?php echo JText::_('K2STORE_CHECKOUT_MODIFY'); ?></a>');
							$('#shipping-address .checkout-heading').append('<a><?php echo JText::_('K2STORE_CHECKOUT_MODIFY'); ?></a>');


							$('.checkout-content.number2 .k2store-shipping').remove();
							$('.checkout-content.number2 #address-del').remove();
	





							$.ajax({
								url: 'index.php',
								type: 'post',
								data: 'option=com_k2store&view=checkout&task=guest_shipping',
								dataType: 'html',
								success: function(html) {
									$('#shipping-address .checkout-content').html(html);
								},
								error: function(xhr, ajaxOptions, thrownError) {
									//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
								}
							});
						},
						error: function(xhr, ajaxOptions, thrownError) {
							//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
						}
					});
				} else {
					$.ajax({
						url: 'index.php',
						type: 'post',
						data: 'option=com_k2store&view=checkout&task=guest_shipping',
						dataType: 'html',
						success: function(html) {
							$('#shipping-address .checkout-content').html(html);

							$('#billing-address .checkout-content').slideUp('slow');

							$('#shipping-address .checkout-content').slideDown('slow');

							$('#billing-address .checkout-heading a').remove();
							$('#shipping-address .checkout-heading a').remove();
							$('#shipping-payment-method .checkout-heading a').remove();
							//$('#payment-method .checkout-heading a').remove();

							$('#billing-address .checkout-heading').append('<a><?php echo JText::_('K2STORE_CHECKOUT_MODIFY'); ?></a>');
						},
						error: function(xhr, ajaxOptions, thrownError) {
							//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
						}
					});
				}
				<?php } else { ?>
				$.ajax({
					url: 'index.php',
					type: 'post',
					data: 'option=com_k2store&view=checkout&task=shipping_payment_method',
					dataType: 'html',
					success: function(html) {
						$('#shipping-payment-method .checkout-content').html(html);

						$('#billing-address .checkout-content').slideUp('slow');

						$('#shipping-payment-method .checkout-content').slideDown('slow');

						$('#billing-address .checkout-heading a').remove();
						$('#shipping-payment-method .checkout-heading a').remove();

						$('#billing-address .checkout-heading').append('<a><?php echo JText::_('K2STORE_CHECKOUT_MODIFY'); ?></a>');
					},
					error: function(xhr, ajaxOptions, thrownError) {
						//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});
				<?php } ?>
				
				
			//alert("s-2");	
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});





//alert("1111");






});

})(k2store.jQuery);


// Guest Shipping
(function($) {
$(document).on('click', '#button-guest-shipping', function() {
	$.ajax({
		url: 'index.php?option=com_k2store&view=checkout&task=guest_shipping_validate',
		type: 'post',
		data: $('#shipping-address input[type=\'text\'], #shipping-address select'),
		dataType: 'json',
		beforeSend: function() {
			$('#button-guest-shipping').attr('disabled', true);
			$('#button-guest-shipping').after('<span class="wait">&nbsp;<img src="media/k2store/images/loader.gif" alt="" /></span>');
		},
		complete: function() {
			$('#button-guest-shipping').attr('disabled', false);
			$('.wait').remove();
		},
		success: function(json) {
			$('.warning, .k2error').remove();

			if (json['redirect']) {
				location = json['redirect'];
			} else if (json['error']) {
				if (json['error']['warning']) {
					$('#shipping-address .checkout-content').prepend('<div class="warning alert alert-danger" style="display: none;">' + json['error']['warning'] + '<button data-dismiss="alert" class="close" type="button"></button></div>');

					$('.warning').fadeIn('slow');
				}

				$.each( json['error'], function( key, value ) {
					if (value) {
						//$('#shipping-address #'+key).after('<br class="k2error" /><span class="k2error">' + value + '</span>');
						$('#shipping-address #'+key).val(value);
						$('#shipping-address #'+key).addClass("k2error");
					}
				});

			} else {
				$.ajax({
					url: 'index.php',
					type: 'post',
					data: 'option=com_k2store&view=checkout&task=shipping_payment_method',
					dataType: 'html',
					success: function(html) {
						$('#shipping-payment-method .checkout-content').html(html);

						$('#shipping-address .checkout-content').slideUp('slow');

						$('#shipping-payment-method .checkout-content').slideDown('slow');

						$('#shipping-address .checkout-heading a').remove();
						$('#shipping-payment-method .checkout-heading a').remove();

						$('#shipping-address .checkout-heading').append('<a><?php echo JText::_('K2STORE_CHECKOUT_MODIFY'); ?></a>');
					},
					error: function(xhr, ajaxOptions, thrownError) {
						//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});
})(k2store.jQuery);

//shipping and payment methods
(function($) {
$(document).on('click', '#button-payment-method', function() {



if( ($(".checkout-content.number2 .payment_plugin.number_payment0").prop("checked") == false ) && ($(".checkout-content.number2 .payment_plugin.number_payment1").prop("checked") == false ) ){
alert("Выберите способ оплаты");
return false;
} 

//alert(#shipping-payment-method input[type='text']);
//alert(#shipping-payment-method input[type='hidden']);
//alert(#shipping-payment-method input[type='radio']:checked);
//alert(#shipping-payment-method input[type='checkbox']:checked);
//alert(#shipping-payment-method textarea);
//alert(#shipping-payment-method select);
  
//alert(s);


//$('#address_1').val("[null]");
//$('#city').val("[null]");


//заполнение сессии

if($(".checkout-content.number2 .payment_plugin.number_payment0").prop("checked") == true ){
	var payment_method=$(".checkout-content.number2 .payment_plugin.number_payment0").val();
}else{
	var payment_method=$(".checkout-content.number2 .payment_plugin.number_payment1").val();	
}


$.ajax({
	url: '/ajax/session_payment.php',
	type: 'post',
	async: 'false',
	data: 'payment_method='+(payment_method)+'',
	dataType: 'html',
	success: function(html) {
		//alert(html);
	}
});








var s=$('#shipping-payment-method input[type=\'text\'], #shipping-payment-method input[type=\'hidden\'], #shipping-payment-method input[type=\'radio\']:checked, #shipping-payment-method input[type=\'checkbox\']:checked, #shipping-payment-method textarea, #shipping-payment-method select').serialize();
s=s+'&address_1=[null]&city=[null]';
s=s+'&shippingrequired=1&shipping_plugin=shipping_standard&shipping_price=0&shipping_tax=0&shipping_name=name&shipping_code=0&shipping_extra=0';

//alert(s);

	$.ajax({
		url: 'index.php',
		type: 'post',
	//	data: $('#shipping-payment-method input[type=\'text\'], #shipping-payment-method input[type=\'hidden\'], #shipping-payment-method input[type=\'radio\']:checked, #shipping-payment-method input[type=\'checkbox\']:checked, #shipping-payment-method textarea, #shipping-payment-method select').serialize(),
		data: s,
		dataType: 'json',
		beforeSend: function() {
			$('#button-payment-method').attr('disabled', true);
			$('#button-payment-method').after('<span class="wait">&nbsp;<img src="media/k2store/images/loader.gif" alt="" /></span>');
		},
		complete: function() {
			$('#button-payment-method').attr('disabled', false);
			$('.wait').remove();
		},
		success: function(json) {
			$('.warning, .k2error').remove();


			 if (json['error']) {
			 	//alert("error");
			 	if (json['error']['warning']) {
			 		//alert(json['error']['warning']);
				}

				$.each( json['error'], function( key, value ) {
					if (value) {
						//$('#shipping-payment-method #'+key).after('<br class="k2error" /><span class="k2error">' + value + '</span>');
						//$('#shipping-payment-method #'+key).val(value);
						//$('#shipping-payment-method #'+key).addClass("k2error");
						//alert(key+' = '+value);
					}
				});



			 }	


			//if (json['redirect']) {
			//alert("1111");	
			//alert(json['redirect']);
			//	location = json['redirect'];
			//} else if (json['error']) {


			/*	if (json['error']['warning']) {
					$('#shipping-payment-method .checkout-content').prepend('<div class="warning alert alert-danger" style="display: none;">' + json['error']['warning'] + '<button data-dismiss="alert" class="close" type="button"></button></div>');

					$('.warning').fadeIn('slow');
				}

				$.each( json['error'], function( key, value ) {
					if (value) {
						//$('#shipping-payment-method #'+key).after('<br class="k2error" /><span class="k2error">' + value + '</span>');
						$('#shipping-payment-method #'+key).val(value);
						$('#shipping-payment-method #'+key).addClass("k2error");
					}
				});
			*/

			//} else {
				//alert("2222");
				$.ajax({
					url: 'index.php',
					type: 'post',
					data: 'option=com_k2store&view=checkout&task=confirm',
					dataType: 'html',
					success: function(html) {

						//alert(html);
						$('#confirm .checkout-content').html(html);

						$('#shipping-payment-method .checkout-content').slideUp('slow');

						$('#confirm .checkout-content').slideDown('slow');

						$('#shipping-payment-method .checkout-heading a').remove();

						$('#shipping-payment-method .checkout-heading').append('<a><?php echo JText::_('K2STORE_CHECKOUT_MODIFY'); ?></a>');
						
						$('form').submit();	
						
					},
					error: function(xhr, ajaxOptions, thrownError) {
						//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});
			//}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
	

	
	
});
})(k2store.jQuery);

function getFormData(target) {
	var d = document, ret = '';
	if( typeof(target) == 'string' )
		target = d.getElementById(target);
	if( target === undefined )
		target = d;
	var typelist = ['input','select','textarea'];
	for(var t in typelist ) {
		t = typelist[t];
		var inputs = target.getElementsByTagName(t);
		for(var i = inputs.length - 1; i >= 0; i--) {
			if( inputs[i].name && !inputs[i].disabled ) {
				var evalue = inputs[i].value, etype = '';
				if( t == 'input' )
					etype = inputs[i].type.toLowerCase();
				if( (etype == 'radio' || etype == 'checkbox') && !inputs[i].checked )
					evalue = null;
				if( (etype != 'file' && etype != 'submit') && evalue != null ) {
					if( ret != '' ) ret += '&';
					ret += encodeURI(inputs[i].name) + '=' + encodeURIComponent(evalue);
				}
			}
		}
	}
	return ret;
}
//--></script>



<script type="text/javascript">

var $j=jQuery.noConflict();
$j(window).load(function () {

$j.ajax({
						url: 'index.php',
						type: 'post',
						data: 'option=com_k2store&view=checkout&task=shipping_payment_method',
						dataType: 'html',
						success: function(html) {
							$j('.checkout-content.number1').append(html);

							$j('.checkout-content.number1 .client_note').remove();	
							$j('.checkout-content.number1 .buttons.checkout_shipping_payment').remove();
							$j('#onCheckoutPayment_wrapper').remove();	

							//$j('.checkout-content.number1').html(html);
	
							/*$j('#billing-address .checkout-content').slideUp('slow');

							$j('#shipping-payment-method .checkout-content').slideDown('slow');

							$j('#billing-address .checkout-heading a').remove();
							$j('#shipping-address .checkout-heading a').remove();
							$j('#shipping-payment-method .checkout-heading a').remove();

							$j('#billing-address .checkout-heading').append('<a>Изменить</a>');
							$j('#shipping-address .checkout-heading').append('<a>Изменить</a>');

							$j.ajax({
								url: 'index.php',
								type: 'post',
								data: 'option=com_k2store&view=checkout&task=guest_shipping',
								dataType: 'html',
								success: function(html) {
									$j('#shipping-address .checkout-content').html(html);
								},
								error: function(xhr, ajaxOptions, thrownError) {
									//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
								}
							});*/
						},
						error: function(xhr, ajaxOptions, thrownError) {
							//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
						}
					});

	
});





$j(document).on('click', '#billing-address .button', function() {
	//$('.checkout-content').slideUp('slow');

	//$(this).parent().parent().find('.checkout-content').slideDown('slow');
$j('.cart_navigation .item.number2').removeClass('active');
$j('.cart_navigation .item.number2').addClass('completed');


$j('.cart_navigation .item.number3').removeClass('completed');
$j('.cart_navigation .item.number3').addClass('active');


});



$j(document).on('click', '#shipping-payment-method .button', function() {


$j('.cart_navigation .item.number3').removeClass('active');
$j('.cart_navigation .item.number3').addClass('completed');


$j('.cart_navigation .item.number4').removeClass('completed');
$j('.cart_navigation .item.number4').addClass('active');


});


$j(document).on('click', '#billing-address .checkout-heading a', function() {
	

$j('.cart_navigation .item.number2').removeClass('completed');
$j('.cart_navigation .item.number2').addClass('active');


$j('.cart_navigation .item.number3').removeClass('completed');
$j('.cart_navigation .item.number3').removeClass('active');
$j('.cart_navigation .item.number4').removeClass('completed');
$j('.cart_navigation .item.number4').removeClass('active');



});


$j(document).on('click', '#shipping-payment-method .checkout-heading a', function() {


$j('.cart_navigation .item.number3').removeClass('completed');
$j('.cart_navigation .item.number3').addClass('active');

$j('.cart_navigation .item.number4').removeClass('completed');
$j('.cart_navigation .item.number4').removeClass('active');


});



function number2(){



	$j('.checkout-content').slideUp('slow');

	$j('#billing-address .checkout-content').slideDown('slow');

	$j('.cart_navigation .item.number2').removeClass('completed');
	$j('.cart_navigation .item.number2').addClass('active');

	$j('.cart_navigation .item.number3').removeClass('completed');
	$j('.cart_navigation .item.number3').removeClass('active');

	$j('.cart_navigation .item.number4').removeClass('completed');
	$j('.cart_navigation .item.number4').removeClass('active');



}


$j(document).on('click', '.cart_navigation .item.number2', function() {
	

number2();

});




function number3(){



	///$j('#billing-address #button-guest').click();
/*

	$j.ajax({
		url: 'index.php',
		type: 'post',
		data: $j('#billing-address input[type=\'text\'], #billing-address input[type=\'checkbox\']:checked, #billing-address input[type=\'radio\']:checked, #billing-address input[type=\'hidden\'], #billing-address select'),
		dataType: 'json',
		beforeSend: function() {
			$j('#button-guest').attr('disabled', true);
			$j('#button-guest').after('<span class="wait">&nbsp;<img src="media/k2store/images/loader.gif" alt="" /></span>');
		},
		complete: function() {
			$j('#button-guest').attr('disabled', false);
			$j('.wait').remove();
		},
		success: function(json) {
		
			$j('.warning, .k2error').remove();

			if (json['redirect']) {
				
				location = json['redirect'];
			} else if (json['error']) {
				

				if (json['error']['warning']) {
					$j('#billing-address .checkout-content').prepend('<div class="warning alert alert-danger" style="display: none;">' + json['error']['warning'] + '<button data-dismiss="alert" class="close" type="button"></button></div>');

					$j('.warning').fadeIn('slow');
				}

				$j.each( json['error'], function( key, value ) {
					if (value) {
						//$j('#billing-address #'+key).after('<br class="k2error" /><span class="k2error">' + value + '</span>');
						$('#billing-address #'+key).val(value);
						$('#billing-address #'+key).addClass("k2error");
					}
				});

			} else {

		



	$j('.checkout-content').slideUp('slow');

	$j('#shipping-payment-method .checkout-content').slideDown('slow');


	$j('.cart_navigation .item.number2').addClass('completed');
	$j('.cart_navigation .item.number2').removeClass('active');

	$j('.cart_navigation .item.number3').removeClass('completed');
	$j('.cart_navigation .item.number3').addClass('active');

	$j('.cart_navigation .item.number4').removeClass('completed');
	$j('.cart_navigation .item.number4').removeClass('active');




								var shipping_address = $j('#billing-address input[name=\'shipping_address\']:checked').attr('value');

				if (shipping_address) {
					$j.ajax({
						url: 'index.php',
						type: 'post',
						data: 'option=com_k2store&view=checkout&task=shipping_payment_method',
						dataType: 'html',
						success: function(html) {
							$j('#shipping-payment-method .checkout-content').html(html);

							$j('#billing-address .checkout-content').slideUp('slow');

							$j('#shipping-payment-method .checkout-content').slideDown('slow');

							$j('#billing-address .checkout-heading a').remove();
							$j('#shipping-address .checkout-heading a').remove();
							$j('#shipping-payment-method .checkout-heading a').remove();

							$j('#billing-address .checkout-heading').append('<a>Изменить</a>');
							$j('#shipping-address .checkout-heading').append('<a>Изменить</a>');

							$j.ajax({
								url: 'index.php',
								type: 'post',
								data: 'option=com_k2store&view=checkout&task=guest_shipping',
								dataType: 'html',
								success: function(html) {
									$j('#shipping-address .checkout-content').html(html);
								},
								error: function(xhr, ajaxOptions, thrownError) {
									//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
								}
							});
						},
						error: function(xhr, ajaxOptions, thrownError) {
							//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
						}
					});
				} else {
					$j.ajax({
						url: 'index.php',
						type: 'post',
						data: 'option=com_k2store&view=checkout&task=guest_shipping',
						dataType: 'html',
						success: function(html) {
							$j('#shipping-address .checkout-content').html(html);

							$j('#billing-address .checkout-content').slideUp('slow');

							$j('#shipping-address .checkout-content').slideDown('slow');

							$j('#billing-address .checkout-heading a').remove();
							$j('#shipping-address .checkout-heading a').remove();
							$j('#shipping-payment-method .checkout-heading a').remove();
							//$('#payment-method .checkout-heading a').remove();

							$j('#billing-address .checkout-heading').append('<a>Изменить</a>');
						},
						error: function(xhr, ajaxOptions, thrownError) {
							//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
						}
					});
				}
							}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});

*/





//проверка
//$('#billing-address #'+key).val(value);
//$('#billing-address #'+key).addClass("k2error");

var name=$j('.checkout-content.number1 #first_name').val();
var phone=$j('.checkout-content.number1 #phone_1').val();

if(name==""){

$j('.checkout-content.number1 #first_name').val("Заполните поле");
$j('.checkout-content.number1 #first_name').addClass("k2error");

return false;


}


if(phone==""){

$j('.checkout-content.number1 #phone_1').val("Заполните поле");
$j('.checkout-content.number1 #phone_1').addClass("k2error");

return false;


}

var re = /^[0-9]*$/;
if (!re.test(phone)){
	$j('.checkout-content.number1 #phone_1').val("Заполните корректно поле");
	$j('.checkout-content.number1 #phone_1').addClass("k2error");

	return false;

}


//radio3 - курьерр по Киеву
//radio2 - самовывоз
//radio1 - доставка по украине


if( ($j(".checkout-content.number1 .k2store-shipping .radio3").prop("checked")==false) && ($j(".checkout-content.number1 .k2store-shipping .radio2").prop("checked")==false) && 
	($j(".checkout-content.number1 .k2store-shipping .radio1").prop("checked")==false) ){

alert("Необходимо выбрать способ доставки");
return false;
}


if($j(".checkout-content.number1 .k2store-shipping .radio3").prop("checked")){

	var street=$j(".checkout-content.number1 #address_1").val();
	//alert(street);
	if(street==""){


		$j('.checkout-content.number1 #address_1').val("Заполните поле");
		$j('.checkout-content.number1 #address_1').addClass("k2error");

		return false;
	}


}

//if($(".checkout-content.number1 .k2store-shipping .radio2").prop("checked")){

//}

if($j(".checkout-content.number1 .k2store-shipping .radio1").prop("checked")){

	var street=$j(".checkout-content.number1 #address_1").val();
	if(street==""){


		$j('.checkout-content.number1 #address_1').val("Заполните поле");
		$j('.checkout-content.number1 #address_1').addClass("k2error");

		return false;
	}


}








	$j.ajax({
		url: 'index.php',
		type: 'post',
		data: $j('#billing-address input[type=\'text\'], #billing-address input[type=\'checkbox\']:checked, #billing-address input[type=\'radio\']:checked, #billing-address input[type=\'hidden\'], #billing-address select'),
		dataType: 'json',
		beforeSend: function() {
			$j('#button-guest').attr('disabled', true);
			$j('#button-guest').after('<span class="wait">&nbsp;<img src="media/k2store/images/loader.gif" alt="" /></span>');
		},
		complete: function() {
			$j('#button-guest').attr('disabled', false);
			$j('.wait').remove();
		},
		success: function(json) {
			$j('.warning, .k2error').remove();

			if (json['redirect']) {
				location = json['redirect'];
			//} else if (json['error']) {


/*
				if (json['error']['warning']) {
					$('#billing-address .checkout-content').prepend('<div class="warning alert alert-danger" style="display: none;">' + json['error']['warning'] + '<button data-dismiss="alert" class="close" type="button"></button></div>');

					$('.warning').fadeIn('slow');
				}

				$.each( json['error'], function( key, value ) {
					alert(key);
					if (value) {
						value="Заполните поле";
						//$('#billing-address #'+key).after('<br class="k2error" /><span class="k2error">' + value + '</span>');
						$('#billing-address #'+key).val(value);
						$('#billing-address #'+key).addClass("k2error");
					}
				});
*/
			} else {



					$j('.checkout-content').slideUp('slow');

					$j('#shipping-payment-method .checkout-content').slideDown('slow');


					$j('.cart_navigation .item.number2').addClass('completed');
					$j('.cart_navigation .item.number2').removeClass('active');

					$j('.cart_navigation .item.number3').removeClass('completed');
					$j('.cart_navigation .item.number3').addClass('active');

					$j('.cart_navigation .item.number4').removeClass('completed');
					$j('.cart_navigation .item.number4').removeClass('active');



				//--OK--//
				<?php if ($this->showShipping) { ?>
				var shipping_address = $('#billing-address input[name=\'shipping_address\']:checked').attr('value');

				if (shipping_address) {
					$j.ajax({
						url: 'index.php',
						type: 'post',
						data: 'option=com_k2store&view=checkout&task=shipping_payment_method',
						dataType: 'html',
						success: function(html) {
							$j('#shipping-payment-method .checkout-content').html(html);

							$j('#billing-address .checkout-content').slideUp('slow');

							$j('#shipping-payment-method .checkout-content').slideDown('slow');

							$j('#billing-address .checkout-heading a').remove();
							$j('#shipping-address .checkout-heading a').remove();
							$j('#shipping-payment-method .checkout-heading a').remove();

							$j('#billing-address .checkout-heading').append('<a><?php echo JText::_('K2STORE_CHECKOUT_MODIFY'); ?></a>');
							$j('#shipping-address .checkout-heading').append('<a><?php echo JText::_('K2STORE_CHECKOUT_MODIFY'); ?></a>');


							$j('.checkout-content.number2 .k2store-shipping').remove();
							$j('.checkout-content.number2 #address-del').remove();
	





							$j.ajax({
								url: 'index.php',
								type: 'post',
								data: 'option=com_k2store&view=checkout&task=guest_shipping',
								dataType: 'html',
								success: function(html) {
									$j('#shipping-address .checkout-content').html(html);
								},
								error: function(xhr, ajaxOptions, thrownError) {
									//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
								}
							});
						},
						error: function(xhr, ajaxOptions, thrownError) {
							//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
						}
					});
				} else {
					$j.ajax({
						url: 'index.php',
						type: 'post',
						data: 'option=com_k2store&view=checkout&task=guest_shipping',
						dataType: 'html',
						success: function(html) {
							$j('#shipping-address .checkout-content').html(html);

							$j('#billing-address .checkout-content').slideUp('slow');

							$j('#shipping-address .checkout-content').slideDown('slow');

							$j('#billing-address .checkout-heading a').remove();
							$j('#shipping-address .checkout-heading a').remove();
							$j('#shipping-payment-method .checkout-heading a').remove();
							//$('#payment-method .checkout-heading a').remove();

							$('#billing-address .checkout-heading').append('<a><?php echo JText::_('K2STORE_CHECKOUT_MODIFY'); ?></a>');
						},
						error: function(xhr, ajaxOptions, thrownError) {
							//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
						}
					});
				}
				<?php } else { ?>
				$j.ajax({
					url: 'index.php',
					type: 'post',
					data: 'option=com_k2store&view=checkout&task=shipping_payment_method',
					dataType: 'html',
					success: function(html) {
						$j('#shipping-payment-method .checkout-content').html(html);

						$j('#billing-address .checkout-content').slideUp('slow');

						$j('#shipping-payment-method .checkout-content').slideDown('slow');

						$j('#billing-address .checkout-heading a').remove();
						$j('#shipping-payment-method .checkout-heading a').remove();

						$j('#billing-address .checkout-heading').append('<a><?php echo JText::_('K2STORE_CHECKOUT_MODIFY'); ?></a>');
					},
					error: function(xhr, ajaxOptions, thrownError) {
						//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});
				<?php } ?>
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});





//alert("1111");








}


$j(document).on('click', '.cart_navigation .item.number3', function() {

number3();

});




function number4(){




	//	$j('#button-payment-method').click();

$j.ajax({
		url: 'index.php',
		type: 'post',
		data: $j('#shipping-payment-method input[type=\'text\'], #shipping-payment-method input[type=\'hidden\'], #shipping-payment-method input[type=\'radio\']:checked, #shipping-payment-method input[type=\'checkbox\']:checked, #shipping-payment-method textarea, #shipping-payment-method select').serialize(),
		dataType: 'json',
		beforeSend: function() {
			$j('#button-payment-method').attr('disabled', true);
			$j('#button-payment-method').after('<span class="wait">&nbsp;<img src="media/k2store/images/loader.gif" alt="" /></span>');
		},
		complete: function() {
			$j('#button-payment-method').attr('disabled', false);
			$j('.wait').remove();
		},
		success: function(json) {
			$j('.warning, .k2error').remove();

			if (json['redirect']) {
				location = json['redirect'];
			} else if (json['error']) {
				if (json['error']['warning']) {
					$j('#shipping-payment-method .checkout-content').prepend('<div class="warning alert alert-danger" style="display: none;">' + json['error']['warning'] + '<button data-dismiss="alert" class="close" type="button"></button></div>');

					$j('.warning').fadeIn('slow');
				}

				$j.each( json['error'], function( key, value ) {
					if (value) {
						//$j('#shipping-payment-method #'+key).after('<br class="k2error" /><span class="k2error">' + value + '</span>');
						$('#shipping-payment-method #'+key).val(value);
						$('#shipping-payment-method #'+key).addClass("k2error");
					}
				});


			} else {


						$j('.checkout-content').slideUp('slow');

	$j('#confirm .checkout-content').slideDown('slow');


	$j('.cart_navigation .item.number2').addClass('completed');
	$j('.cart_navigation .item.number2').removeClass('active');

	$j('.cart_navigation .item.number3').addClass('completed');
	$j('.cart_navigation .item.number3').removeClass('active');

	$j('.cart_navigation .item.number4').removeClass('completed');
	$j('.cart_navigation .item.number4').addClass('active');



				$j.ajax({
					url: 'index.php',
					type: 'post',
					data: 'option=com_k2store&view=checkout&task=confirm',
					dataType: 'html',
					success: function(html) {
						$j('#confirm .checkout-content').html(html);

						$j('#shipping-payment-method .checkout-content').slideUp('slow');

						$j('#confirm .checkout-content').slideDown('slow');

						$j('#shipping-payment-method .checkout-heading a').remove();

						$j('#shipping-payment-method .checkout-heading').append('<a>Изменить</a>');
					},
					error: function(xhr, ajaxOptions, thrownError) {
						//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});






	
}



$j(document).on('click', '.cart_navigation .item.number4', function() {
	
number4();


});








$j('.cart_navigation .item.number1').click(function(){
  location.href="/index.php?option=com_k2store&view=mycart";
});



<?php
if( (!isset($_GET['page'])) || ($_GET['page']=="") || ($_GET['page']==NULL) ){
	

}else{


if($_GET['page']=="2"){
?>	
	number2();
<?php
}else if($_GET['page']=="3"){
?>
	number3();
<?php
}else if($_GET['page']=="4"){
?>
	number4();
<?php 
}

}






?>



</script>

<script type="text/javascript">
var $j=jQuery.noConflict();


$j(document).on('click', '.inputbox', function() {

	
	$j(this).removeClass('k2error');

});


</script>




<script type="text/javascript">



var $j=jQuery.noConflict();

/*
$j(".inputbox").focus(function(){
  $j(this).attr("placeholder","");

  
  
});
*/


 $j(document).on('focus', 'input,textarea', function() {

  //$j(this).data('placeholder',$j(this).attr('placeholder'))
   $j(this).attr('placeholder','');
 });
 
 
 $j(document).on('blur', 'input,textarea', function() {

  // $j(this).attr('placeholder',$j(this).data('placeholder'));
  
        $j('input#phone_1').attr('placeholder', '+380937014040');
        $j('input#first_name').attr('placeholder', 'Матвей');
        $j('input#last_name').attr('placeholder', 'Иванов');
        $j('input#email').attr('placeholder', 'info@poparada.com.ua');
  
 });



</script>



