<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if (!empty($arResult["ORDER"]))
{

$APPLICATION->SetTitle(GetMessage("SOA_TEMPL_ORDER_COMPLETE"));

	?>


<div class="b-order__section _lined">







	<div class="grid-container b-layout__info-box">



		<div class="grid-row col-1 col-xm-12 col-s-12"></div>
		<div class="grid-row col-10 col-xm-12 col-s-12">
			<?= GetMessage("SOA_TEMPL_ORDER_SUC", Array("#ORDER_DATE#" => $arResult["ORDER"]["DATE_INSERT"], "#ORDER_ID#" => $arResult["ORDER"]["ACCOUNT_NUMBER"]))?>
			<br /><br />
			<?= GetMessage("SOA_TEMPL_ORDER_SUC1", Array("#LINK#" => $arParams["PATH_TO_PERSONAL"])) ?>


		</div>


	</div>

</div>
<div class="b-order__section _lined">

	<?
	if (!empty($arResult["PAY_SYSTEM"]))
	{
		?>







	<div class="grid-container">
		<div class="grid-row col-1 col-xm-12 col-s-12"></div>
		<div class="grid-row col-10 col-xm-12 col-s-12 b-layout__info-box">



			<div class="b-order__list">
				<div class="b-order__item ">
					<input class="b-order__item-radio non-styler" type="radio" name="del" value="" id="del1" checked="checked">
					<label class="b-order__item-label" for="del1"></label>
					<div class="b-order__item-img" style="background-image: url(
					<?

					$fileTmp = "";


					if (count($arResult["PAY_SYSTEM"]) > 0):
						$fileTmp = CFile::GetPath($arResult["PAY_SYSTEM"]["LOGOTIP"]["ID"]);
						echo $fileTmp;
					else:
						echo "/bitrix/components/bitrix/sale.order.ajax/templates/visual/images/logo-default-d.gif";
					endif;
					?>

					)"></div>
					<div class="b-order__item-text">
						<div class="b-order__item-title"><?=GetMessage("SOA_TEMPL_PAY")?>:
							<b><?= $arResult["PAY_SYSTEM"]["NAME"] ?></b></div>

						<div class="b-layout__info-box">
							<!--<div class="b-order__item ">b-order__list -->


							<!--</div>-->

						</div>

						<!--<div class="b-order__item-price"><?= $arResult["PAY_SYSTEM"]["NAME"] ?></div>-->
					</div>
				</div>

			</div>



			<?
			if (strlen($arResult["PAY_SYSTEM"]["ACTION_FILE"]) > 0)
			{
				?>
				<br><br>

				<?
				if ($arResult["PAY_SYSTEM"]["NEW_WINDOW"] == "Y")
				{
					?>
					<script language="JavaScript">
						window.open('<?=$arParams["PATH_TO_PAYMENT"]?>?ORDER_ID=<?=urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]))?>');
					</script>

				<?= GetMessage("SOA_TEMPL_PAY_LINK", Array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]))))?>
					<?
					if (CSalePdf::isPdfAvailable())
					{
						?><br />
						<?= GetMessage("SOA_TEMPL_PAY_PDF", Array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".$arResult["ORDER_ID"]."&pdf=1")) ?>
						<?
					}
				}
				else
				{

					if (strlen($arResult["PAY_SYSTEM"]["PATH_TO_ACTION"])>0)
					{
						//echo "<pre>";
						//print_r($arResult);
						//echo "</pre>";

						include($arResult["PAY_SYSTEM"]["PATH_TO_ACTION"]);

					}
				}
				?>

				<?
			}
			?>




		</div>







	</div>



		<?
	}
}
else
{
	?>

	<div class="grid-container">
		<div class="grid-row col-1 col-xm-12 col-s-12"></div>
		<div class="grid-row col-10 col-xm-12 col-s-12">
			<?=GetMessage("SOA_TEMPL_ERROR_ORDER")?>
		</div>
	</div>


	<div class="grid-container">
		<div class="grid-row col-1 col-xm-12 col-s-12"></div>
		<div class="grid-row col-10 col-xm-12 col-s-12">
			<?=GetMessage("SOA_TEMPL_ERROR_ORDER_LOST", Array("#ORDER_ID#" => $arResult["ORDER_ID"]))?>
			<?=GetMessage("SOA_TEMPL_ERROR_ORDER_LOST1")?>
		</div>
	</div>


	<?
}
?>




</div>