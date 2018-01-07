<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>




<div class="cart-items" id="id-shelve-list" <?if ($_REQUEST["section"]!="delay"):?>style="display:none;"<?endif;?>>



	<div class="b-order">
		<!--<form>-->
		<div class="b-order__section ">
			<div class="b-basket-table">
				<div class="b-basket-table__header grid-container">


					<div class="grid-row col-1 col-xm-12 col-s-12"></div>
					<div class="grid-row col-3 col-xm-4 col-s-12"><?=GetMessage("SALE_NAME")?></div>
					<div class="grid-row col-1 col-xm-1  col-s-2 hidden-s"><?=GetMessage("SALE_DISCOUNT")?></div>
					<div class="grid-row col-2 col-xm-3  col-s-7"><?=GetMessage("SALE_QUANTITY")?></div>
					<div class="grid-row col-1 col-xm-1  col-s-3 hidden-s hidden-m"><?=GetMessage("SALE_PRICE")?></div>
					<div class="grid-row col-1 col-xm-1  col-s-3"><?=GetMessage("SALE_SUMM")?></div>
					<div class="grid-row col-1 col-xm-1  col-s-3 hidden-s hidden-m"><?=GetMessage("SALE_ADD_CART")?></div>
					<div class="grid-row col-1 "><?=GetMessage("SALE_DELETE")?></div>



				</div>


			</div>



	<!--
<ul class="tabs">
<li><span onclick="ShowBasketItems(1);"><i><?=GetMessage("SALE_PRD_IN_BASKET_ACT")?> (<?=count($arResult["ITEMS"]["AnDelCanBuy"])?>)</i></span></li>
<?if( $countItemsDelay=count($arResult["ITEMS"]["DelDelCanBuy"]) ){?>
<li class="current"><span><i><?=GetMessage("SALE_PRD_IN_BASKET_SHELVE")?></i></span></li>
<?}?>
<?if( $countItemsSubscribe=count($arResult["ITEMS"]["ProdSubscribe"]) ){?>
<li><span onclick="ShowBasketItems(3);"><i><?=GetMessage("SALE_PRD_IN_BASKET_SUBSCRIBE")?> (<?=$countItemsSubscribe?>)</i></span></li>
<?}?>
<?if( $countItemsNotAvailable=count($arResult["ITEMS"]["nAnCanBuy"]) ){?>
<li><span onclick="ShowBasketItems(4);"><i><?=GetMessage("SALE_PRD_IN_BASKET_NOTA")?> (<?=$countItemsNotAvailable?>)</i></span></li>
<?}?>
</ul>
-->






	<?if( count($arResult["ITEMS"]["DelDelCanBuy"]) > 0 ){?>



			<!--
			<thead>
				<tr>
					<?if( in_array("NAME", $arParams["COLUMNS_LIST"]) ){?>
						<td></td>
						<td class="cart-item-name"><?=GetMessage("SALE_NAME")?></td>
					<?}?>
					<?if( in_array("VAT", $arParams["COLUMNS_LIST"]) ){?>
						<td class="cart-item-vat"><?= GetMessage("SALE_VAT")?></td>
					<?}?>
					<?if( in_array("TYPE", $arParams["COLUMNS_LIST"]) ){?>
						<td class="cart-item-type"><?= GetMessage("SALE_PRICE_TYPE")?></td>
					<?}?>
					<?if( in_array("DISCOUNT", $arParams["COLUMNS_LIST"]) ){?>
						<td class="cart-item-discount"><?= GetMessage("SALE_DISCOUNT")?></td>
					<?}?>
					<?if( in_array("WEIGHT", $arParams["COLUMNS_LIST"]) ){?>
						<td class="cart-item-weight"><?= GetMessage("SALE_WEIGHT")?></td>
					<?}?>
					<?if( in_array("QUANTITY", $arParams["COLUMNS_LIST"]) ){?>
						<td class="cart-item-quantity"><?= GetMessage("SALE_QUANTITY")?></td>
					<?}?>
					<?if( in_array("PRICE", $arParams["COLUMNS_LIST"]) ){?>
						<td class="cart-item-price"><?= GetMessage("SALE_PRICE")?></td>
					<?}?>
					<td>
						<?/*if (in_array("DELETE", $arParams["COLUMNS_LIST"]) || in_array("DELAY", $arParams["COLUMNS_LIST"])):?>
							<?= GetMessage("SALE_ACTION")?>
						<?endif;*/?>
					</td>
				</tr>
			</thead>
			-->






			<?foreach($arResult["ITEMS"]["DelDelCanBuy"] as $arBasketItems){?>



			<!-------------->



			<div class="b-basket-table__item grid-container">
				<div class="grid-row col-1 col-xm-12 col-s-12"></div>
				<div class="b-basket-table__item-title grid-row col-3 col-xm-4 col-s-12">
					<a href="<?=$arBasketItems["DETAIL_PAGE_URL"]?>">
						<?
						if( strlen($arBasketItems["DETAIL_PICTURE"]["SRC"]) > 0 ) {
							$image=$arBasketItems["DETAIL_PICTURE"]["SRC"];
						}else {
							$image=$componentPath."/images/no_photo.png";
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
					<div class="b-basket-table__item-inner">
						<div class="b-product-card__prices-counter">
							<div class="b-counter  js-product-counter" data-maxcount="<?=$arBasketItems["MAX_QUANTITY"];?>">
								<div class="b-counter__plus">+</div>
								<div class="b-counter__minus">-</div>
								<!--<input class="b-counter__input" value="<?=$arBasketItems["QUANTITY"]?>">-->
								<input class="text b-counter__input" maxlength="18" type="text" name="QUANTITY_<?=$arBasketItems["ID"]?>" value="<?=$arBasketItems["QUANTITY"]?>" size="3" id="QUANTITY_<?=$arBasketItems["ID"]?>">

							</div> 
						</div>
					</div>
				</div>
				<div class="b-basket-table__item-row grid-row col-1 col-xm-1 col-s-3  hidden-s hidden-m">
					<div class="b-basket-table__item-inner b-basket-table__item-price">
						<?=$arBasketItems["PRICE_FORMATED"];?>
					</div>
				</div>
				<div class="b-basket-table__item-row grid-row col-1 col-xm-1 col-s-3">
					<div class="b-basket-table__item-inner b-basket-table__item-price">
						<?=SaleFormatCurrency($arBasketItems["PRICE"]*$arBasketItems["QUANTITY"], $arBasketItems["CURRENCY"]);?>
					</div>
				</div>
				<div class="b-basket-table__item-row grid-row col-1 col-xm-1 col-s-3 hidden-s hidden-m">
					<div class="b-basket-table__item-inner ">
						<a href="<?=str_replace("#ID#", $arBasketItems["ID"], $arUrlTempl["add"])?>"
						   class="btn _medium-size setaside"
							style="line-height:14px;"><?=GetMessage("SALE_ADD_CART")?></a>

					</div>
				</div>
				<div class="b-basket-table__item-row grid-row col-1 col-xm-1 col-s-1"
					 style="text-align:center;">
					<div class="b-basket-table__item-inner ">
						<a href="<?=str_replace("#ID#", $arBasketItems["ID"], $arUrlTempl["delete"])?>"
						   class="b-basket-table__remove"
						   onclick="return DeleteFromCart(this);"></a>
					</div>
				</div>
			</div>
			<div class="b-basket-table__delimiter">
				<div class="grid-row col-1 col-xm-12 col-s-12"></div>
				<div class="b-basket-table__delimiter-line grid-row col-10 col-xm-12"></div>
			</div>

			<!-------------->


				<!--
				<tr>
					<td class="basket-img">
						<?if( in_array("DELETE", $arParams["COLUMNS_LIST"]) ){?>
							<a class="deleteitem" href="<?=str_replace("#ID#", $arBasketItems["ID"], $arUrlTempl["delete"])?>" onclick="return DeleteFromCart(this);" title="<?=GetMessage("SALE_DELETE_PRD")?>"></a>
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
					<?if( in_array("NAME", $arParams["COLUMNS_LIST"]) ){?>
						<td class="cart-item-name">
							<?if (strlen($arBasketItems["DETAIL_PAGE_URL"]) > 0 ){?>
								<a href="<?=$arBasketItems["DETAIL_PAGE_URL"] ?>">
							<?}?>
								<?=$arBasketItems["NAME"] ?>
							<?if (strlen($arBasketItems["DETAIL_PAGE_URL"]) > 0 ){?>
								</a>
							<?}?>
							<?if( in_array("PROPS", $arParams["COLUMNS_LIST"]) ){
								foreach($arBasketItems["PROPS"] as $val){
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
						<td class="cart-item-discount"><?=$arBasketItems["DISCOUNT_PRICE_PERCENT_FORMATED"]?></td>
					<?}?>
					<?if( in_array("WEIGHT", $arParams["COLUMNS_LIST"]) ){?>
						<td class="cart-item-weight"><?=$arBasketItems["WEIGHT_FORMATED"]?></td>
					<?}?>
					<?if( in_array("QUANTITY", $arParams["COLUMNS_LIST"]) ){?>
						<td class="cart-item-quantity"><?=$arBasketItems["QUANTITY"]?><?if (($arParams["SHOW_MEASURE"]=="Y")&&($arBasketItems["MEASURE"]["SYMBOL_RUS"])) { echo "&nbsp;".$arBasketItems["MEASURE"]["SYMBOL_RUS"];}?></td>
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
					<?if( in_array("DELAY", $arParams["COLUMNS_LIST"]) ){?>
						<td class="cart-item-actions">
							<a class="setaside" href="<?=str_replace("#ID#", $arBasketItems["ID"], $arUrlTempl["add"])?>"><?=GetMessage("SALE_ADD_CART")?></a>
						</td>
					<?}?>
					
				</tr>
				-->



			<?}?>






	<?}?>


		</div>
		<!--</form>-->
	</div>




</div>