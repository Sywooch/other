<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<?if (strlen($_REQUEST["bxajaxid"]) || ($_REQUEST["AJAX_CALL"] == "Y")){?>
	<script>jsAjaxUtil.InsertDataToNode('<?=SITE_DIR?>ajax/show_small_cart.php', 'basket_small', false);</script>

<?}?>



<div class="b-basket-table__states">
	<?if( $countItemsDelay=count($arResult["ITEMS"]["AnDelCanBuy"]) ){?>
	<div class="b-basket-table__states-item js-basket-table__states-item _current">
		<a class="link _invert link_1"  onclick="ShowBasketItems(1);"><span><?=GetMessage("SALE_PRD_IN_BASKET_ACT")?></span></a>
	</div>
	<?}?>
	<?if( $countItemsDelay=count($arResult["ITEMS"]["DelDelCanBuy"]) ){?>
		<div class="b-basket-table__states-item js-basket-table__states-item">
			<a class="link _invert link_2"  onclick="ShowBasketItems(2);"><span><?=GetMessage("SALE_PRD_IN_BASKET_SHELVE")?> <b>(<?=$countItemsDelay?>)</b></span></a>
		</div>
	<?}?>
</div>


<div id="id-cart-list"<?if($_REQUEST["section"]=="delay"):?> style="display:none;"<?endif;?>>





	<!--
	<ul class="tabs">
		<li class="current"><span><i><?=GetMessage("SALE_PRD_IN_BASKET_ACT")?></i></span></li>
		<?if( $countItemsDelay=count($arResult["ITEMS"]["DelDelCanBuy"]) ){?>
			<li><span onclick="ShowBasketItems(2);"><i><?=GetMessage("SALE_PRD_IN_BASKET_SHELVE")?> (<?=$countItemsDelay?>)</i></span></li>
		<?}?>
		<?if( $countItemsSubscribe=count($arResult["ITEMS"]["ProdSubscribe"]) ){?>
			<li><span onclick="ShowBasketItems(3);"><i><?=GetMessage("SALE_PRD_IN_BASKET_SUBSCRIBE")?> (<?=$countItemsSubscribe?>)</i></span></li>
		<?}?>
		<?if( $countItemsNotAvailable=count($arResult["ITEMS"]["nAnCanBuy"]) ){?>
			<li><span onclick="ShowBasketItems(4);"><i><?=GetMessage("SALE_PRD_IN_BASKET_NOTA")?> (<?=$countItemsNotAvailable?>)</i></span></li>
		<?}?>
	</ul>
	-->


<?$numCells = 0;?>


	<div class="b-order">
		<!--<form>-->
			<div class="b-order__section ">
				<div class="b-basket-table">
					<?if( $countItemsDelay=count($arResult["ITEMS"]["AnDelCanBuy"]) ){?>
					<div class="b-basket-table__header grid-container">


						<!--
						<?if( in_array("NAME", $arParams["COLUMNS_LIST"]) ){?>
							<td></td>
							<td class="cart-item-name"><?= GetMessage("SALE_NAME")?></td>
							<?$numCells += 2;?>
						<?}?>
						<?if( in_array("VAT", $arParams["COLUMNS_LIST"]) ){?>
							<td class="cart-item-vat"><?= GetMessage("SALE_VAT")?></td>
							<?$numCells++;?>
						<?}?>
						<?if( in_array("TYPE", $arParams["COLUMNS_LIST"]) ){?>
							<td class="cart-item-type"><?= GetMessage("SALE_PRICE_TYPE")?></td>
							<?$numCells++;?>
						<?}?>
						<?if( in_array("DISCOUNT", $arParams["COLUMNS_LIST"]) ){?>
							<td class="cart-item-discount"><?= GetMessage("SALE_DISCOUNT")?></td>
							<?$numCells++;?>
						<?}?>
						<?if( in_array("WEIGHT", $arParams["COLUMNS_LIST"]) ){?>
							<td class="cart-item-weight"><?= GetMessage("SALE_WEIGHT")?></td>
							<?$numCells++;?>
						<?}?>
						<?if( in_array("QUANTITY", $arParams["COLUMNS_LIST"]) ){?>
							<td class="cart-item-quantity"><?= GetMessage("SALE_QUANTITY")?></td>
							<?$numCells++;?>
						<?}?>
						<?if( in_array("PRICE", $arParams["COLUMNS_LIST"]) ){?>
							<td class="cart-item-price"><?= GetMessage("SALE_PRICE")?></td>
							<?$numCells++;?>
						<?}?>
						<?if( in_array("DELAY", $arParams["COLUMNS_LIST"]) ){?>
							<td class="cart-item-delay"></td>
							<?$numCells++;?>
						<?}?>
						-->


						<div class="grid-row col-1 col-xm-12 col-s-12"></div>
						<div class="grid-row col-3 col-xm-4 col-s-12"><?=GetMessage("SALE_NAME")?></div>
						<div class="grid-row col-1 col-xm-1  col-s-2 hidden-s"><?=GetMessage("SALE_DISCOUNT")?></div>
						<div class="grid-row col-2 col-xm-3  col-s-7"><?=GetMessage("SALE_QUANTITY")?></div>
						<div class="grid-row col-1 col-xm-1  col-s-3  hidden-s hidden-m"><?=GetMessage("SALE_PRICE")?></div>
						<div class="grid-row col-1 col-xm-1  col-s-3"><?=GetMessage("SALE_SUMM")?></div>
						<div class="grid-row col-1 col-xm-1  col-s-3 hidden-s hidden-m"><?=GetMessage("SALE_OTLOG")?></div>
						<div class="grid-row col-1 "><?=GetMessage("SALE_DELETE")?></div>



					</div>
					<? } ?>

					<!--nAnCanBuy-->
					<!--AnDelCanBuy-->
					<?if(count($arResult["ITEMS"]["AnDelCanBuy"]) > 0){?>

					<?
					$i=0;
					$productsQuantity=0;
					foreach($arResult["ITEMS"]["AnDelCanBuy"] as $arBasketItems){?>
					<!-------------->




					<div class="b-basket-table__item grid-container">
						<div class="grid-row col-1 col-xm-12 col-s-12"></div>
						<div class="b-basket-table__item-title grid-row col-3 col-xm-4 col-s-12">
							<a href="<?=$arBasketItems["DETAIL_PAGE_URL"]?>">
								<?
								if( strlen($arBasketItems["DETAIL_PICTURE"]["SRC"]) > 0 ) {
									$image=$arBasketItems["DETAIL_PICTURE"]["SRC"];
								}else {
									$image = $componentPath."/images/no_photo.png";
								}
								?>

								<div class="b-basket-table__item-img" style="background-image: url(<?=$image;?>)"></div>
								<div class="b-basket-table__item-text">
									<?=$arBasketItems["NAME"];?>
								</div>
							</a>
						</div>
						<div class="b-basket-table__item-row grid-row col-1 col-xm-1 col-s-2 hidden-s">
							<?
							if( in_array("DISCOUNT", $arParams["COLUMNS_LIST"]) ){
								$item_discount=$arBasketItems["DISCOUNT_PRICE_PERCENT_FORMATED"];
							}else{
								$item_discount="0%";
							}
							if(LANGUAGE_ID==='en') {
								$item_discount = round($arBasketItems["DISCOUNT_PRICE_PERCENT"])."%";
							}
							?>
							<div class="b-basket-table__item-inner"><?=$item_discount;?></div>
						</div>
						<div class="b-basket-table__item-row grid-row col-2 col-xm-3 col-s-7">
							<div class="b-basket-table__item-inner ">
								<div class="b-product-card__prices-counter cart-item-quantity">
									<div class="b-counter  js-product-counter counter_block"
										 data-maxcount="<?=$arBasketItems["MAX_QUANTITY"];?>">

										<div class="b-counter__plus plus js-counter__plus">+</div>
										<div class="b-counter__minus minus js-counter__minus">-</div>
										<input class="text b-counter__input" maxlength="18" type="text" name="QUANTITY_<?=$arBasketItems["ID"]?>" value="<?=$arBasketItems["QUANTITY"]?>" size="3" id="QUANTITY_<?=$arBasketItems["ID"]?>">

									</div>
								</div>
							</div>

							<div class="b-basket-table__stock-message
							js-basket-table__stock-message js-basket-table__stock-message"
								 style="<?
								 if($arBasketItems["QUANTITY"] > $arBasketItems["MAX_QUANTITY"]){
									 echo "display:block;";
								 }else{
									 echo "display:none;";
								 }
								 ?>"><?=GetMessage("POPUP_IN_STOCK_MESSAGE");?></div>
						</div>






						<div class="b-basket-table__item-row grid-row col-1 col-xm-1 col-s-3 ">
							<div class="b-basket-table__item-inner b-basket-table__item-price">
								<?=$arBasketItems["PRICE_FORMATED"];?>
							</div>
						</div>
						<div class="b-basket-table__item-row grid-row col-1 col-xm-1 col-s-3  hidden-s hidden-m">
							<div class="b-basket-table__item-inner b-basket-table__item-price">
								<?=SaleFormatCurrency($arBasketItems["PRICE"]*$arBasketItems["QUANTITY"], $arBasketItems["CURRENCY"]);?>
							</div>
						</div>
						<div class="b-basket-table__item-row grid-row col-1 col-xm-1 col-s-3 hidden-s hidden-m">
							<div class="b-basket-table__item-inner ">
								<a href="<?=str_replace("#ID#", $arBasketItems["ID"], $arUrlTempl["shelve"])?>"
								   class="btn _medium-size setaside"><?=GetMessage("SALE_OTLOG")?></a>

							</div>
						</div>
						<div class="b-basket-table__item-row grid-row col-1 col-xm-1 col-s-1"
							style="text-align:center;">
							<div class="b-basket-table__item-inner ">
								<a href="<?=str_replace("#ID#", $arBasketItems["ID"], $arUrlTempl["delete"])?>"
								   class="b-basket-table__remove deleteitem" title="<?=GetMessage("SALE_DELETE_PRD")?>"></a>

							</div>
						</div>
					</div>
					<div class="b-basket-table__delimiter">
						<div class="grid-row col-1 col-xm-12 col-s-12"></div>
						<div class="b-basket-table__delimiter-line grid-row col-10 col-xm-12"></div>
					</div>






					<!-------------->


					<? $productsQuantity += $arBasketItems["QUANTITY"];	$i++; }?>


					<div class="b-basket-table__total grid-container">
						<div class="grid-row col-1"></div>
						<div class="grid-row col-10">
							<div class="b-basket-table__total-coupon">


								<input type="text" class="input_text_style b-form__input js-form__input-coupon"
									   placeholder="<?=GetMessage("SALE_COUPON_VAL")?>"
									   value="<?if(!empty($arResult["COUPON"])):?><?=$arResult["COUPON"]?><?else:?><?endif;?>"
									   name="COUPON">
								<div class="b-form-errors" style="display:none;"><?=GetMessage("SALE_COUPON_ERROR")?></div>

							</div>
							<div class="b-basket-table__total-total js-basket-table__total-total">
								<?=GetMessage("SALE_ITOGO")?>: <b><?=$arResult["allSum_FORMATED"]?></b>
								<?
								if($arResult["DISCOUNT_PRICE_ALL"]>0) {
									?>
									<strike><?= $arResult["allSumOld_FORMATED"] ?></strike>
									<?
								}
								?>
							</div>
							<div class="hidden js-basket-table__total-total-quantity"><?=$productsQuantity;?></div>
						</div>
					</div>
					<div class="b-basket-table__delimiter margin-top-small">
						<div class="grid-row col-1 col-xm-12 col-s-12"></div>
						<div class="b-basket-table__delimiter-line grid-row col-10 col-xm-12"></div>
					</div>


					<div class="clear"></div>
					<div class="grid-container">
						<div class="grid-row col-1 col-xm-12 col-s-12"></div>
						<div class="grid-row col-10 col-xm-12 col-s-12">
							<div class="b-basket-table__btns">
								<div class="b-basket-table__btns-left basket_reload">
										<?/*<span class="js-basket-table__btn1">
											<?=GetMessage("COUNTED")?>
										</span> */?>
										<!--<button type="submit" name="BasketRefresh"  class="button4 js-basket-table__btn2"
										style="display:block;">
											<span>
												<?=GetMessage("COUNT")?>
											</span>
										</button>-->
										<span class="js-basket-table__btn2" style="display:none;">
											<button class="button4 b-basket-table__btns-left basket_reload"
												type="submit" value="<?=GetMessage("COUNT")?>"
												name="BasketRefresh" class="">
												<span class="btn _medium-size setaside">
													<?=GetMessage("COUNT")?>
												</span>
											</button>
										</span>



								</div>


								<input type="hidden" name="button_text" id="button_text" value="<?= GetMessage("SOA_TEMPL_BUTTON") ?>">

								<div class="b-basket-table__btns-right button-s">


									<?
									if (!$USER->IsAuthorized()) {
										?>
										<?
											//global $IS_BASKET_PAGE;
											//$IS_BASKET_PAGE = true;
										$GLOBALS["IS_BASKET_PAGE"] = true;
										?>

										<input type="button" id="authFormLinkOrder"
											   class="btn _full _inline _little-font button-s"
											   value="<?= GetMessage("SOA_TEMPL_BUTTON_AUTH") ?>"
											   name="BasketOrder" id="basketOrderButton2">


										<input type="submit" class="btn _full _inline _little-font _big-padding button-s"
											   value="<?= GetMessage("SALE_ORDER") ?>"
											   name="BasketOrder" id="basketOrderButton2"
												style="display:none;">
										<?
									}else {
										?>

										<input type="submit" class="btn _full _inline _little-font _big-padding button-s"
											   value="<?= GetMessage("SALE_ORDER") ?>"
											   name="BasketOrder" id="basketOrderButton2">
										<?
									}
									?>


								</div>


							</div>
						</div>
					</div>

					<?}else{?>

						<div class="grid-container">
							<div class="grid-row col-1 col-xm-12 col-s-12"></div>
							<div class="grid-row col-10 col-xm-12 col-s-12">
								<div class="b-basket-table__btns">
									<div class="b-basket-table__btns-center">
										<div><?=GetMessage("SALE_NO_ACTIVE_PRD");?></div>

									</div>


								</div>
							</div>
						</div>

					<? } ?>


				</div>

			</div>
		<!--</form>-->
	</div>

</div>




<!--

<table class="table-standart" style="margin-top: 20px;" rules="rows">
	<thead>
		<tr>
			<?if( in_array("NAME", $arParams["COLUMNS_LIST"]) ){?>
				<td></td>
				<td class="cart-item-name"><?= GetMessage("SALE_NAME")?></td>
				<?$numCells += 2;?>
			<?}?>
			<?if( in_array("VAT", $arParams["COLUMNS_LIST"]) ){?>
				<td class="cart-item-vat"><?= GetMessage("SALE_VAT")?></td>
				<?$numCells++;?>
			<?}?>
			<?if( in_array("TYPE", $arParams["COLUMNS_LIST"]) ){?>
				<td class="cart-item-type"><?= GetMessage("SALE_PRICE_TYPE")?></td>
				<?$numCells++;?>
			<?}?>
			<?if( in_array("DISCOUNT", $arParams["COLUMNS_LIST"]) ){?>
				<td class="cart-item-discount"><?= GetMessage("SALE_DISCOUNT")?></td>
				<?$numCells++;?>
			<?}?>
			<?if( in_array("WEIGHT", $arParams["COLUMNS_LIST"]) ){?>
				<td class="cart-item-weight"><?= GetMessage("SALE_WEIGHT")?></td>
				<?$numCells++;?>
			<?}?>
			<?if( in_array("QUANTITY", $arParams["COLUMNS_LIST"]) ){?>
				<td class="cart-item-quantity"><?= GetMessage("SALE_QUANTITY")?></td>
				<?$numCells++;?>
			<?}?>
			<?if( in_array("PRICE", $arParams["COLUMNS_LIST"]) ){?>
				<td class="cart-item-price"><?= GetMessage("SALE_PRICE")?></td>
				<?$numCells++;?>
			<?}?>
			<?if( in_array("DELAY", $arParams["COLUMNS_LIST"]) ){?>
				<td class="cart-item-delay"></td>
				<?$numCells++;?>
			<?}?>
		</tr>
	</thead>
<?if(count($arResult["ITEMS"]["AnDelCanBuy"]) > 0){?>
	<tbody>
	<?$i=0;
	
	foreach($arResult["ITEMS"]["AnDelCanBuy"] as $arBasketItems){?>
		<tr>
			<?if( in_array("NAME", $arParams["COLUMNS_LIST"]) ){?>
				<td class="basket-img">
					<?if( in_array("DELETE", $arParams["COLUMNS_LIST"]) ){?>
						<a class="deleteitem" href="<?=str_replace("#ID#", $arBasketItems["ID"], $arUrlTempl["delete"])?>" onclick="//return DeleteFromCart(this);" title="<?=GetMessage("SALE_DELETE_PRD")?>"></a>
					<?}?>
					<?if( strlen($arBasketItems["DETAIL_PAGE_URL"]) > 0 ){?>
						<a href="<?=$arBasketItems["DETAIL_PAGE_URL"]?>">
					<?}?>
					<?if( strlen($arBasketItems["DETAIL_PICTURE"]["SRC"]) > 0 ){?>
						<img src="<?=$arBasketItems["DETAIL_PICTURE"]["SRC"]?>" alt="<?=$arBasketItems["NAME"] ?>"/>
					<?}else{?>
						<img src="<?=SITE_TEMPLATE_PATH?>/images/noimage40.gif" alt="<?=$arBasketItems["NAME"] ?>"/>
					<?}?>
					<?if( strlen($arBasketItems["DETAIL_PAGE_URL"]) > 0 ){?>
						</a>
					<?}?>
				</td>
				<td class="cart-item-name">
					<?if( strlen($arBasketItems["DETAIL_PAGE_URL"]) > 0 ){?>
						<a href="<?=$arBasketItems["DETAIL_PAGE_URL"]?>">
					<?}?>
					<?=$arBasketItems["NAME"] ?>
					<?if( strlen($arBasketItems["DETAIL_PAGE_URL"]) > 0 ){?>
						</a>
					<?}?>
					<?if (in_array("PROPS", $arParams["COLUMNS_LIST"]))
					{
						foreach($arBasketItems["PROPS"] as $val)
						{
							echo "<br />".$val["NAME"].": ".$val["VALUE"];
						}
					}?>
				</td>
			<?}?>
			<?if( in_array("VAT", $arParams["COLUMNS_LIST"]) ){?>
				<td class="cart-item-vat"><?=$arBasketItems["VAT_RATE_FORMATED"]?></td>
			<?}?>
			<?if( in_array("TYPE", $arParams["COLUMNS_LIST"]) ){?>
				<td class="cart-item-type"><?=$arBasketItems["NOTES"]?></td>
			<?}?>
			
			<?if( in_array("DISCOUNT", $arParams["COLUMNS_LIST"]) ){?>
				<td class="cart-item-discount">
					<?=$arBasketItems["DISCOUNT_PRICE_PERCENT_FORMATED"]?>
				</td>
			<?}?>
			<?if( in_array("WEIGHT", $arParams["COLUMNS_LIST"]) ){?>
				<td><?=$arBasketItems["WEIGHT_FORMATED"]?></td>
			<?}?>	
			<?if( in_array("QUANTITY", $arParams["COLUMNS_LIST"]) ){?>			
				<td class="cart-item-quantity">
					<div class="counter_block">
						<input class="text" maxlength="18" type="text" name="QUANTITY_<?=$arBasketItems["ID"]?>" value="<?=$arBasketItems["QUANTITY"]?>" size="3" id="QUANTITY_<?=$arBasketItems["ID"]?>">
						<span class="plus">+</span>
						<span class="minus">-</span>
					</div>
					<?if (($arParams["SHOW_MEASURE"]=="Y")&&($arBasketItems["MEASURE"]["SYMBOL_RUS"])) { echo "&nbsp;".$arBasketItems["MEASURE"]["SYMBOL_RUS"];}?>
				</td>
			<?}?>
			<?if( in_array("PRICE", $arParams["COLUMNS_LIST"]) ){?>
				<td class="cart-item-price">
					<?if( (doubleval($arBasketItems["FULL_PRICE"]) > 0 ) && (doubleval($arBasketItems["FULL_PRICE"])!=$arBasketItems["PRICE"])){?>
						<div class="discount-price"><?=$arBasketItems["PRICE_FORMATED"]?></div>
						<div class="old-price"><?=$arBasketItems["FULL_PRICE_FORMATED"]?></div>
					<?}else{?>
						<div class="price"><?=$arBasketItems["PRICE_FORMATED"];?></div>
					<?}?>
				</td>
			<?}?>
			<?if (in_array("DELAY", $arParams["COLUMNS_LIST"])){?>
				<td class="cart-item-delay"><a class="setaside" href="<?=str_replace("#ID#", $arBasketItems["ID"], $arUrlTempl["shelve"])?>"><?=GetMessage("SALE_OTLOG")?></a></td>
			<?}?>
		</tr>
		<?
		$i++;
	}
	?>
	</tbody>
</table>

-->
<!--
<table class="table-standart basket_result">
	<tbody>
		<?if( $arParams["HIDE_COUPON"] != "Y" ){?>
			<tr>
				<td rowspan="5" class="tal">
					<input class="input_text_style"
					<?if( empty($arResult["COUPON"]) ){?>
						onclick="if (this.value=='<?=GetMessage("SALE_COUPON_VAL")?>')this.value=''; this.style.color='black'"
						onblur="if (this.value=='') {this.value='<?=GetMessage("SALE_COUPON_VAL")?>'; this.style.color='#a9a9a9'}"
						style="color:#a9a9a9"
					<?}?>
						value="<?if(!empty($arResult["COUPON"])):?><?=$arResult["COUPON"]?><?else:?><?=GetMessage("SALE_COUPON_VAL")?><?endif;?>"
						name="COUPON">
				</td>
			</tr>
		<?}?>
		<?if( in_array("WEIGHT", $arParams["COLUMNS_LIST"]) ){?>
			<tr>
				<td class="title"><?echo GetMessage("SALE_ALL_WEIGHT")?>:</td>
				<td class="value"><?=$arResult["allWeight_FORMATED"]?></td>
			</tr>
		<?}?>
		<?if( doubleval($arResult["DISCOUNT_PRICE"]) > 0 ){?>
			<tr>
				<td class="title"><?echo GetMessage("SALE_CONTENT_DISCOUNT")?><?
					if (strLen($arResult["DISCOUNT_PERCENT_FORMATED"])>0)
						echo " (".$arResult["DISCOUNT_PERCENT_FORMATED"].")";?>:
				</td>
				<td class="price"><?=$arResult["DISCOUNT_PRICE_FORMATED"]?></td>
			</tr>
		<?}?>
		<?if( $arParams['PRICE_VAT_SHOW_VALUE'] == 'Y' ){?>
			<tr>
				<td class="title"><?echo GetMessage('SALE_VAT_EXCLUDED')?></td>
				<td class="price"><?=$arResult["allNOVATSum_FORMATED"]?></td>
			</tr>
			<tr>
				<td class="title"><?echo GetMessage('SALE_VAT_INCLUDED')?></td>
				<td class="price"><?=$arResult["allVATSum_FORMATED"]?></td>
			</tr>
		<?}?>
		<tr class="total">
			<td class="title"><?= GetMessage("SALE_ITOGO")?>:</td>
			<td class="price"><?=$arResult["allSum_FORMATED"]?></td>
		</tr>
	</tbody>
</table>
<table width="100%">
	<tr>
		<td style="padding: 32px  0 0 10px; vertical-align: middle;" class="tal"><button class="button4" type="submit" value="<?=GetMessage("SALE_UPDATE")?>"
		name="BasketRefresh" class=""><span><?=GetMessage("SALE_UPDATE")?></span></button></td>
		<td style="padding: 32px 2px 0; text-align: right;" class="tar">
			<button style="margin-right: 20px;" class="button bt3" type="submit" value="<?=GetMessage("SALE_ORDER")?>" name="BasketOrder"  id="basketOrderButton2" class=""><span><?=GetMessage("SALE_ORDER")?></span></button>
			<button class="button bt3"  type="button" value="<?=GetMessage("SALE_ORDER")?>" name="FastOrder"  onclick="return oneClickBuyBasket();"><span><?=GetMessage("SALE_FAST_ORDER")?></span></button>
		</td>
	</tr>
</table>
<div class="shadow-item_info" style="margin-bottom: 50px;"><img border="0" style="margin-bottom: 50px;" src="<?=SITE_TEMPLATE_PATH?>/images/shadow-item_info_revert.png"></div>
<?}else{?>
	<tbody>
		<tr>
			<td colspan="<?=$numCells?>" style="text-align:center">
				<div class="cart-notetext"><?=GetMessage("SALE_NO_ACTIVE_PRD");?></div>
				<a href="<?=SITE_DIR?>" class="bt3"><?=GetMessage("SALE_NO_ACTIVE_PRD_START")?></a><br><br>
			</td>
		</tr>
	</tbody>
</table>
<?}?>
-->
<!--
</div>
-->



<input type="hidden" id="column_headers" value="<?//=CUtil::JSEscape(implode($arHeaders, ","))?>" />
<input type="hidden" id="offers_props" value="<?=CUtil::JSEscape(implode($arParams["OFFERS_PROPS"], ","))?>" />
<input type="hidden" id="action_var" value="<?=CUtil::JSEscape($arParams["ACTION_VARIABLE"])?>" />
<input type="hidden" id="quantity_float" value="<?=$arParams["QUANTITY_FLOAT"]?>" />
<input type="hidden" id="count_discount_4_all_quantity" value="<?=($arParams["COUNT_DISCOUNT_4_ALL_QUANTITY"] == "Y") ? "Y" : "N"?>" />
<input type="hidden" id="price_vat_show_value" value="<?=($arParams["PRICE_VAT_SHOW_VALUE"] == "Y") ? "Y" : "N"?>" />
<input type="hidden" id="hide_coupon" value="<?=($arParams["HIDE_COUPON"] == "Y") ? "Y" : "N"?>" />
<input type="hidden" id="use_prepayment" value="<?=($arParams["USE_PREPAYMENT"] == "Y") ? "Y" : "N"?>" />
<input type="hidden" id="auto_calculation" value="<?=($arParams["AUTO_CALCULATION"] == "N") ? "N" : "Y"?>" />