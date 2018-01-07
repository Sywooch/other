<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>





<div class="b-order__section _lined">
	<div class="b-basket-table">




		<div class="b-basket-table__header grid-container">
			<div class="grid-row col-1 col-xm-12 col-s-12"></div>
			<div class="grid-row col-6 col-xm-4  col-s-12"><?=GetMessage("SOA_TEMPL_SUM_NAME")?></div>
			<div class="grid-row col-1 col-xm-2  col-s-3"><?=GetMessage("SOA_TEMPL_SUM_DISCOUNT")?></div>
			<div class="grid-row col-1 col-xm-2  col-s-3"><?=GetMessage("SOA_TEMPL_SUM_QUANTITY")?></div>
			<div class="grid-row col-1 col-xm-2  col-s-3"><?=GetMessage("SOA_TEMPL_SUM_PRICE")?></div>
			<div class="grid-row col-1 col-xm-2  col-s-3"><?=GetMessage("SOA_TEMPL_SUM_TOTAL")?></div>
		</div>




	<?
	foreach($arResult["BASKET_ITEMS"] as $arBasketItems)
	{
		?>



		<div class="b-basket-table__item grid-container">
			<div class="grid-row col-1 col-xm-12 col-s-12"></div>
			<div class="b-basket-table__item-title grid-row col-6 col-xm-4 col-s-12">
				<a href="<?=$arBasketItems["DETAIL_PAGE_URL"];?>">


					<div class="b-basket-table__item-img" style="background-image: url(<?

					if (!empty($arBasketItems["DETAIL_PICTURE_SRC"])) {
						echo $arBasketItems["DETAIL_PICTURE_SRC"];
					}elseif (!empty($arBasketItems["PREVIEW_PICTURE_SRC"])) {
						echo $arBasketItems["PREVIEW_PICTURE_SRC"];
					}
					?>)"></div>
					<div class="b-basket-table__item-text">
						<?=$arBasketItems["NAME"]?>
					</div>
				</a>
			</div>
			<div class="b-basket-table__item-row grid-row col-1 col-xm-2 col-s-3">
				<div class="b-basket-table__item-inner"><?=$arBasketItems["DISCOUNT_PRICE_PERCENT_FORMATED"]?></div>
			</div>
			<div class="b-basket-table__item-row grid-row col-1 col-xm-2 col-s-3">
				<div class="b-basket-table__item-inner"><?=$arBasketItems["QUANTITY"]?></div>
			</div>
			<div class="b-basket-table__item-row grid-row col-1 col-xm-2 col-s-3">
				<div class="b-basket-table__item-inner b-basket-table__item-price"><?=$arBasketItems["PRICE_FORMATED"]?></div>
			</div>
			<div class="b-basket-table__item-row grid-row col-1 col-xm-2 col-s-3">
				<div class="b-basket-table__item-inner b-basket-table__item-price"><?=$arBasketItems["SUM_BASE_FORMATED"];?></div>
			</div>
		</div>
		<div class="b-basket-table__delimiter">
			<div class="grid-row col-1 col-xm-12 col-s-12"></div>
			<div class="b-basket-table__delimiter-line grid-row col-10 col-xm-12"></div>
		</div>





		<?
	}
	?>




		<div class="b-basket-table__total grid-container">
			<div class="grid-row col-1"></div>
			<div class="grid-row col-10">
				<div class="b-basket-table__total-table">
					<table>
						<tbody><tr>
							<td><?=GetMessage("SOA_TEMPL_SUM_WEIGHT_SUM")?></td>
							<td><b><?=$arResult["ORDER_WEIGHT"]?> <?=GetMessage("SOA_TEMPL_MEASURE")?></b></td>
						</tr>
						<tr>
							<td><?=GetMessage("SOA_TEMPL_SUM_SUMMARY")?></td>
							<td><b><?=$arResult["ORDER_PRICE_FORMATED"]?></b></td>
						</tr>

						<?
						if (doubleval($arResult["DISCOUNT_PRICE"]) > 0)
						{
						?>
						<tr>
							<td><?=GetMessage("SOA_TEMPL_SUM_DISCOUNT")?></td>
							<td><b><?if (strLen($arResult["DISCOUNT_PERCENT_FORMATED"])>0):?> (<?echo $arResult["DISCOUNT_PERCENT_FORMATED"];?>)<?endif;?></b>
								 <?echo $arResult["DISCOUNT_PRICE_FORMATED"]?></td>
						</tr>
						<?
						}

						if(!empty($arResult["arTaxList"])) {
							foreach ($arResult["arTaxList"] as $val) {
								?>

								<tr>
									<td><?= $val["NAME"] ?> <?= $val["VALUE_FORMATED"] ?></td>
									<td><b><?= $val["VALUE_MONEY_FORMATED"] ?></b></td>
								</tr>

								<?
							};
						}
						if (doubleval($arResult["DELIVERY_PRICE"]) > 0)
						{
							?>

							<tr>
								<td><?=GetMessage("SOA_TEMPL_SUM_DELIVERY")?></td>
								<td><b><?=$arResult["DELIVERY_PRICE_FORMATED"]?></b></td>
							</tr>

							<?
						}
						?>





						<?
						if (strlen($arResult["PAYED_FROM_ACCOUNT_FORMATED"]) > 0)
						{
							?>



							<tr>
								<td><?=GetMessage("SOA_TEMPL_SUM_PAYED")?></td>
								<td><b><?=$arResult["PAYED_FROM_ACCOUNT_FORMATED"]?></b></td>
							</tr>


							<?
						}
						?>






						</tbody></table>
				</div>
				<div class="clear"></div>
				<div class="b-basket-table__total-total">
					<?=GetMessage("SOA_TEMPL_SUM_IT")?> <b><?=$arResult["ORDER_TOTAL_PRICE_FORMATED"]?></b>
				</div>
			</div>
		</div>






		<div class="b-order__section">
			<div class="grid-container">
				<div class="grid-row col-1 col-xm-12 col-s-12"></div>
				<div class="grid-row col-10 col-xm-12 col-s-12">

					<textarea class="b-form__textarea _big-height" placeholder="<?=GetMessage("SOA_TEMPL_SUM_COMMENTS")?>" name="ORDER_DESCRIPTION" id="ORDER_DESCRIPTION"><?=$arResult["USER_VALS"]["ORDER_DESCRIPTION"]?></textarea>

					<div class="b-order__submit">

						<?//if($_POST["is_ajax_post"] != "Y")
						///{
						?>
							<input type="hidden" name="confirmorder" id="confirmorder" value="Y">
							<input type="hidden" name="profile_change" id="profile_change" value="N">
							<input type="hidden" name="is_ajax_post" id="is_ajax_post" value="Y">

						

							<button type="button" name="submitbutton" onClick="submitForm('Y');"
									value="<?= GetMessage("SOA_TEMPL_BUTTON") ?>"
									class="button btn _full _little-font _inline _big-padding">
								<span><?= GetMessage("SOA_TEMPL_BUTTON") ?></span>
							</button>


						<?
						//}
						?>


					</div>
				</div>
			</div>
		</div>













	</div>

</div>
