<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>




<div class="b-order__section-title"><?=GetMessage("SOA_TEMPL_PAY_SYSTEM")?></div>
<div class="b-order__list">





<script type="text/javascript">
function changePaySystem(param)
{
	if (BX("account_only") && BX("account_only").value == 'Y') // PAY_CURRENT_ACCOUNT checkbox should act as radio
	{
		if (param == 'account')
		{
			if (BX("PAY_CURRENT_ACCOUNT"))
			{
				BX("PAY_CURRENT_ACCOUNT").checked = true;
				BX("PAY_CURRENT_ACCOUNT").setAttribute("checked", "checked");
				BX.addClass(BX("PAY_CURRENT_ACCOUNT_LABEL"), 'selected');

				// deselect all other
				var el = document.getElementsByName("PAY_SYSTEM_ID");
				for(var i=0; i<el.length; i++)
					el[i].checked = false;
			}
		}
		else
		{
			BX("PAY_CURRENT_ACCOUNT").checked = false;
			BX("PAY_CURRENT_ACCOUNT").removeAttribute("checked");
			BX.removeClass(BX("PAY_CURRENT_ACCOUNT_LABEL"), 'selected');
		}
	}
	else if (BX("account_only") && BX("account_only").value == 'N')
	{
		if (param == 'account')
		{
			if (BX("PAY_CURRENT_ACCOUNT"))
			{
				BX("PAY_CURRENT_ACCOUNT").checked = !BX("PAY_CURRENT_ACCOUNT").checked;

				if (BX("PAY_CURRENT_ACCOUNT").checked)
				{
					BX("PAY_CURRENT_ACCOUNT").setAttribute("checked", "checked");
					BX.addClass(BX("PAY_CURRENT_ACCOUNT_LABEL"), 'selected');
				}
				else
				{
					BX("PAY_CURRENT_ACCOUNT").removeAttribute("checked");
					BX.removeClass(BX("PAY_CURRENT_ACCOUNT_LABEL"), 'selected');
				}
			}
		}
	}

	submitForm();
}
</script>




	






	<?
	foreach($arResult["PAY_SYSTEM"] as $arPaySystem)
	{
		if(count($arResult["PAY_SYSTEM"]) == 1 && false)
		{
			?>
			<div class="ps_logo selected">
				<input type="hidden" name="PAY_SYSTEM_ID" value="<?=$arPaySystem["ID"]?>">
				<?if (count($arPaySystem["PSA_LOGOTIP"]) > 0):?>
					<img src="<?=$arPaySystem["PSA_LOGOTIP"]["SRC"]?>" title="<?=$arPaySystem["PSA_NAME"];?>"/>
				<?else:?>
					<img src="/bitrix/components/bitrix/sale.order.ajax/templates/visual/images/logo-default-ps.gif" title="<?=$arPaySystem["PSA_NAME"];?>"/>
				<?endif;?>
				<div class="paysystem_name"><?=$arPaySystem["NAME"];?></div>
			</div>
			<?
			if (strlen($arPaySystem["DESCRIPTION"])>0)
			{
				?>
				<?=$arPaySystem["DESCRIPTION"]?>
				<?
			}
		}
		else
		{
		?>

			<div class="b-order__item <?if ($arPaySystem["CHECKED"]=="Y") echo "_current";?>">
				<input class="b-order__item-radio non-styler" type="radio" name="PAY_SYSTEM_ID"
					   value="<?= $arPaySystem["ID"] ?>"
					   id="ID_PAY_SYSTEM_ID_<?= $arPaySystem["ID"] ?>"
					   onclick="submitForm();"
					<?if ($arPaySystem["CHECKED"]=="Y") echo " checked=\"checked\"";?>>
				<label class="b-order__item-label" for="ID_PAY_SYSTEM_ID_<?= $arPaySystem["ID"] ?>"
					   onclick="BX('ID_PAY_SYSTEM_ID_<?= $arPaySystem["ID"] ?>').checked=true;changePaySystem();"></label>
				<div class="b-order__item-img" style="background-image: url(
				<?

				$fileTmp = "";

				$deliveryImgURL = $arFileTmp["src"];
				if (count($arPaySystem["PSA_LOGOTIP"]) > 0):
					$fileTmp = CFile::GetPath($arPaySystem["PSA_LOGOTIP"]["ID"]);
					echo $fileTmp;
				else:
					echo "/bitrix/components/bitrix/sale.order.ajax/templates/visual/images/logo-default-d.gif";
				endif;
				?>
				)"></div>
				<div class="b-order__item-text">
					<div class="b-order__item-title"><?=$arPaySystem["PSA_NAME"];?></div>
					<div class="b-order__item-descr"><?=$arPaySystem["DESCRIPTION"];?>
					</div>
				</div>
			</div>




		<?
		}
	}
	?>





</div>