<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?CJSCore::Init(array('fx', 'popup', 'window', 'ajax'));?>
<?

use Bitrix\Main\Page\Asset;
Asset::getInstance()->addJs($templateFolder.'/js/jquery.mask.min.js');
?>

<a name="order_form"></a>

<div class="b-order" style="margin-top:-20px">
	<!--<form>-->

<div id="order_form_div" class="order-checkout">
	<!--<NOSCRIPT>
	<div class="errortext"><?=GetMessage("SOA_NO_JS")?></div>
	</NOSCRIPT>-->
	<?
	//ini_set('memory_limit', '50M');
	?>



<?
if(!$USER->IsAuthorized() && $arParams["ALLOW_AUTO_REGISTER"] == "N")
{


	include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/auth.php");
}
else
{
	if($arResult["USER_VALS"]["CONFIRM_ORDER"] == "Y" || $arResult["NEED_REDIRECT"] == "Y")
	{
		if(strlen($arResult["REDIRECT_URL"]) > 0)
		{
			?>
			<script type="text/javascript">
				//alert('<?=CUtil::JSEscape($arResult["REDIRECT_URL"])?>');
				window.top.location.href='<?=CUtil::JSEscape($arResult["REDIRECT_URL"])?>';
			</script>
			<?
			die();
		}
		else
		{
			include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/confirm.php");
		}
	}
	else
	{
		?>
		<script type="text/javascript">
			var orderHtml = "";
		function submitForm(val)
		{


			if(val == "Y"){//отправка формы


				$(".error-input").removeClass("error-input");


				var errorText = "";

				if(languageId == "en"){
					var name = $("#ORDER_PROP_39").val();
					var nameObj = $("#ORDER_PROP_39");
				}else{
					var name = $("#ORDER_PROP_1").val();
					var nameObj = $("#ORDER_PROP_1");
				}

				name = name.replace(/(^\s*)|(\s*$)/,"");
				//валидация обязательных полей
				if(name == ""){
					if(languageId == "en"){
						var text = "The name must be filled.<br>";
					}else{
						var text = "Имя должно быть заполнено.<br>";
					}
					errorText = errorText + text;
					nameObj.addClass("error-input");
				}


				if(languageId == "en"){
					var mail = $("#ORDER_PROP_40").val();
					var mailObj = $("#ORDER_PROP_40");
				}else{
					var mail = $("#ORDER_PROP_2").val();
					var mailObj = $("#ORDER_PROP_2");
				}


				mail = mail.replace(/(^\s*)|(\s*$)/,"");

				if(mail == ""){
					if(languageId == "en"){
						var text = "Email is not specified.<br>";
					}else{
						var text = "Email не задан.<br>";
					}
					errorText = errorText + text;
					mailObj.addClass("error-input");
				}else{
					var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
					if(!pattern.test(mail)){
						if(languageId == "en"){
							var text = "Email set incorrectly.<br>";
						}else{
							var text = "Email задан некорректно.<br>";
						}
						errorText = errorText + text;
						mailObj.addClass("error-input");
					}
				}



				if(languageId == "en"){
					var phone = $("#ORDER_PROP_41").val();
					var phoneObj = $("#ORDER_PROP_41");
				}else{
					var phone = $("#ORDER_PROP_3").val();
					var phoneObj = $("#ORDER_PROP_3");
				}

				phone = phone.replace(/(^\s*)|(\s*$)/,"");
				if(phone == ""){
					if(languageId == "en"){
						var text = "Not specified phone number.<br>";
					}else{
						var text = "Не задан номер телефона.<br>";
					}
					errorText = errorText + text;
					phoneObj.addClass("error-input");
				}else{
					var pattern = /^([0-9])+$/i;
					if(!pattern.test(phone)){
						if(languageId == "en"){
							var text = "The phone number is set incorrectly.<br>";
						}else{
							var text = "Номер телефона задан некорректно.<br>";
						}
						errorText = errorText + text;
						phoneObj.addClass("error-input");
					}
				}



				if(languageId == "en"){
					var address = $("#ORDER_PROP_45").val();
					var addressObj = $("#ORDER_PROP_45");
				}else{
					var address = $("#ORDER_PROP_7").val();
					var addressObj = $("#ORDER_PROP_7");
				}


				address = address.replace(/(^\s*)|(\s*$)/,"");
				//валидация обязательных полей
				if(address == ""){
					if(languageId == "en"){
						var text = "The address must be specified.<br>";
					}else{
						var text = "Адрес должен быть задан.<br>";
					}
					errorText = errorText + text;
					addressObj.addClass("error-input");
				}


				//текстовые "Город" и "Индекс"

				if($(".ORDER_PROP_INDEX").css("display") != "none"){
					var index = $(".ORDER_PROP_INDEX").val();
					index = index.replace(/(^\s*)|(\s*$)/,"");
					//валидация обязательных полей
					if(index == ""){
						if(languageId == "en"){
							var text = "Not specified index.<br>";
						}else{
							var text = "Не задан индекс.<br>";
						}
						errorText = errorText + text;
						$(".ORDER_PROP_INDEX").addClass("error-input");
					}
				}

				if($(".ORDER_PROP_CITY").css("display") != "none"){
					var city = $(".ORDER_PROP_CITY").val();
					city = city.replace(/(^\s*)|(\s*$)/,"");
					//валидация обязательных полей
					if(city == ""){
						if(languageId == "en"){
							var text = "Do not set the city.<br>";
						}else{
							var text = "Не задан город.<br>";
						}
						errorText = errorText + text;
						$(".ORDER_PROP_CITY").addClass("error-input");
					}
				} 



				if(errorText != ""){

					$(".errortext").html(errorText);
					$('html, body').animate({ scrollTop: $(".errortext").offset().top }, 500);

					return false;

				}
				orderHtml = $(".b-layout__inner").html();

				BX.addCustomEvent('onAjaxSuccess', function (e) {


					//$("#ADD_ORDER_PROP_CITY").val($("#ORDER_PROP_CITY").val());
					//$("#ADD_ORDER_PROP_INDEX").val($("#ORDER_PROP_INDEX").val());
					if(orderHtml != ""){
						$(".b-layout__inner").html(orderHtml);
					}

				});




			}





			if(val != 'Y')
				BX('confirmorder').value = 'N';

			var orderForm = BX('ORDER_FORM');

			$(".js-form__preload-container").addClass("is-loading");




			BX.ajax.submitComponentForm(orderForm, 'order_form_content', true);

			BX.submit(orderForm);


			return true;
		}

		function SetContact(profileId)
		{
			BX("profile_change").value = "Y";
			submitForm();
		}
		</script>
		<?if($_POST["is_ajax_post"] != "Y")
		{
			?><form action="<?=$APPLICATION->GetCurPage();?>" method="POST" name="ORDER_FORM" id="ORDER_FORM">
			<?=bitrix_sessid_post()?>
			<div id="order_form_content">
			<?
		}
		else
		{
			$APPLICATION->RestartBuffer();
		}

			?>


			<!---errors---->
				<div class="b-order__section b-order__section-error" style="padding:0px;">
					<div class="grid-container">
						<div class="grid-row col-1 col-xm-12 col-s-12"></div>
						<div class="grid-row col-10 col-xm-12 col-s-12">
							<div class="errortext b-order__form-error" style="color:red;">

			<?
		if(!empty($arResult["ERROR"]) && $arResult["USER_VALS"]["FINAL_STEP"] == "Y")
		{
			foreach($arResult["ERROR"] as $v)

				echo ShowError($v);

			?>
			<script type="text/javascript">
				top.BX.scrollToNode(top.BX('ORDER_FORM'));
			</script>
			<?
		}
			?>
							</div>
						</div>

					</div>
				</div>
				<?

		include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/person_type.php");
		include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/props.php");


		?>


	<div class="b-order__section">
		<div class="grid-container">
			<div class="grid-row col-1 col-xm-12 col-s-12"></div>
			<div class="grid-row col-5 col-xm-12 col-s-12">

		<?

		if ($arParams["DELIVERY_TO_PAYSYSTEM"] == "p2d")
		{
			include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/paysystem.php");
			?>
				</div>
			<div class="grid-row col-5 col-xm-12 col-s-12">
			<?
			include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/delivery.php");
		}
		else
		{
			include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/delivery.php");
			?>
				</div>
			<div class="grid-row col-5 col-xm-12 col-s-12">
			<?
			include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/paysystem.php");
		}

		?>

			</div>
		</div>
	</div>

		<?


		include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/summary.php");
		if(strlen($arResult["PREPAY_ADIT_FIELDS"]) > 0)
			echo $arResult["PREPAY_ADIT_FIELDS"];
		?>
		<?if($_POST["is_ajax_post"] != "Y")
		{
			?>
				</div>
				
			</form>
			<?if($arParams["DELIVERY_NO_AJAX"] == "N"):?>
				<script type="text/javascript" src="/bitrix/js/main/cphttprequest.js"></script>
				<script type="text/javascript" src="/bitrix/components/bitrix/sale.ajax.delivery.calculator/templates/.default/proceed.js"></script>
			<?endif;?>
			<?
		}
		else
		{
			?>
			<script type="text/javascript">
				top.BX('confirmorder').value = 'Y';
				top.BX('profile_change').value = 'N';
			</script>
			<?
			die();
		}
	}
}
?>
</div>







<!--</form>-->
</div>