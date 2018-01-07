<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>



<div class="b-order__section-title"><?=GetMessage('SOA_ORDER_DELIVERY_SERVICE')?></div>

<div class="b-order__list">

	



<script type="text/javascript">
function fShowStore(id, showImages, formWidth, siteId)
{
	var strUrl = '<?=$templateFolder?>' + '/map.php';
	var strUrlPost = 'delivery=' + id + '&showImages=' + showImages + '&siteId=' + siteId;

	var storeForm = new BX.CDialog({
				'title': '<?=GetMessage('SOA_ORDER_GIVE')?>',
				head: '',
				'content_url': strUrl,
				'content_post': strUrlPost,
				'width': formWidth,
				'height':450,
				'resizable':false,
				'draggable':false
			});

	var button = [
			{
				title: '<?=GetMessage('SOA_POPUP_SAVE')?>',
				id: 'crmOk',
				'action': function ()
				{
					GetBuyerStore();
					BX.WindowManager.Get().Close();
				}
			},
			BX.CDialog.btnCancel
		];
	storeForm.ClearButtons();
	storeForm.SetButtons(button);
	storeForm.Show();
}

function GetBuyerStore()
{
	BX('BUYER_STORE').value = BX('POPUP_STORE_ID').value;
	//BX('ORDER_DESCRIPTION').value = '<?=GetMessage("SOA_ORDER_GIVE_TITLE")?>: '+BX('POPUP_STORE_NAME').value;
	BX('store_desc').innerHTML = BX('POPUP_STORE_NAME').value;
	BX.show(BX('select_store'));
}
</script>

<input type="hidden" name="BUYER_STORE" id="BUYER_STORE" value="<?=$arResult["BUYER_STORE"]?>" />
<div class="section">
<?


//echo "<pre>";
//print_r($arResult["DELIVERY"]);
//echo "</pre>";


if(!empty($arResult["DELIVERY"]))
{
	$width = ($arParams["SHOW_STORES_IMAGES"] == "Y") ? 850 : 700;
	?>





		<?
		foreach ($arResult["DELIVERY"] as $delivery_id => $arDelivery)
		{
			if ($delivery_id !== 0 && intval($delivery_id) <= 0)
			{
				foreach ($arDelivery["PROFILES"] as $profile_id => $arProfile)
				{
					?>



					<div class="b-order__item ">
						<input class="b-order__item-radio non-styler"  type="radio"
							   name="<?=$arProfile["FIELD_NAME"]?>" value="<?=$delivery_id.":".$profile_id;?>"
							   id="ID_DELIVERY_<?=$delivery_id?>_<?=$profile_id?>"
							<?=$arProfile["CHECKED"] == "Y" ? "checked=\"checked\"" : "";?> onclick="submitForm();"
						>
						<label class="b-order__item-label" for="ID_DELIVERY_<?=$delivery_id?>_<?=$profile_id?>"></label>
						<div class="b-order__item-img"
							 style="background-image: url(<?

							 $fileTmp = "";

							 $deliveryImgURL = $arFileTmp["src"];
							 if (count($arDelivery["LOGOTIP"]) > 0):

								 $fileTmp = CFile::GetPath($arDelivery["LOGOTIP"]["ID"]);

								 echo $fileTmp;
							 else:
								 echo "/bitrix/components/bitrix/sale.order.ajax/templates/visual/images/logo-default-d.gif";
							 endif;

							 ?>)"></div>
						<div class="b-order__item-text">
							<div class="b-order__item-title"><?= $arDelivery["NAME"]." (".$arProfile["TITLE"].")"; ?>
							</div>
							<div class="b-order__item-descr"><?=$arDelivery["DESCRIPTION"];?>
							</div>
							<div class="b-order__item-price"><?=$arDelivery["PRICE_FORMATED"]?></div>
						</div>


						<?
						$APPLICATION->IncludeComponent('bitrix:sale.ajax.delivery.calculator', '', array(
							"NO_AJAX" => $arParams["DELIVERY_NO_AJAX"],
							"DELIVERY" => $delivery_id,
							"PROFILE" => $profile_id,
							"ORDER_WEIGHT" => $arResult["ORDER_WEIGHT"],
							"ORDER_PRICE" => $arResult["ORDER_PRICE"],
							"LOCATION_TO" => $arResult["USER_VALS"]["DELIVERY_LOCATION"],
							"LOCATION_ZIP" => $arResult["USER_VALS"]["DELIVERY_LOCATION_ZIP"],
							"CURRENCY" => $arResult["BASE_LANG_CURRENCY"],
							"ITEMS" => $arResult["BASKET_ITEMS"]
						), null, array('HIDE_ICONS' => 'Y'));
						?>

					</div>









					<?
				} // endforeach
			}
			else
			{
				if (count($arDelivery["STORE"]) > 0)
					$clickHandler = "onClick = \"fShowStore('".$arDelivery["ID"]."','".$arParams["SHOW_STORES_IMAGES"]."','".$width."','".SITE_ID."')\";";
				else
					$clickHandler = "onClick = \"BX('ID_DELIVERY_ID_".$arDelivery["ID"]."').checked=true;submitForm();\"";
				?>


				<div class="b-order__item ">
					<input class="b-order__item-radio non-styler" name="<?=$arDelivery["FIELD_NAME"]?>" type="radio"
						   value="<?= $arDelivery["ID"] ?>"
						   id="ID_DELIVERY_ID_<?= $arDelivery["ID"] ?>"
							<?if ($arDelivery["CHECKED"]=="Y") echo " checked";?>
						   onclick="submitForm();"
					>
					<label class="b-order__item-label" for="ID_DELIVERY_ID_<?= $arDelivery["ID"] ?>" <?=$clickHandler?>></label>
					<div class="b-order__item-img"
						 style="background-image: url(<?

						 $fileTmp = "";

						 $deliveryImgURL = $arFileTmp["src"];
						 if (count($arDelivery["LOGOTIP"]) > 0):

							 $fileTmp = CFile::GetPath($arDelivery["LOGOTIP"]["ID"]);

							 echo $fileTmp;
						 else:
							 echo "/bitrix/components/bitrix/sale.order.ajax/templates/visual/images/logo-default-d.gif";
						 endif;

						 ?>)"></div>
					<div class="b-order__item-text">
						<div class="b-order__item-title"><?= $arDelivery["NAME"] ?>
						</div>
						<div class="b-order__item-descr"><?=$arDelivery["DESCRIPTION"];?>
						</div>
						<div class="b-order__item-price"><?=$arDelivery["PRICE_FORMATED"]?></div>
					</div>
				</div>





				<?
			}
		}
		?>

	<?
}
?>
</div>


</div>