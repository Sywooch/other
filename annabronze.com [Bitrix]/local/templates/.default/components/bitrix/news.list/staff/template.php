<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if ($arParams["DISPLAY_TOP_PAGER"]=="Y"):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
<div class="staff_wrapp">
	<?foreach( $arResult["SECTIONS"] as $key => $arSection ):?>
	<div class="section_title"><a <?if ($key==0):?>class="opened"<?endif;?>><span><?=$arSection["NAME"];?></span><i class="barr"></i></a></div>
	<div class="section_items" <?if ($key==0):?>style="display: block;"<?endif;?>>
			<?foreach ($arSection["ITEMS"] as $key => $arItem):?>
				<?	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
				<div class="staff_item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<div class="image">
						<?if( !empty( $arItem["PREVIEW_PICTURE"] ) ){?>
							<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" border="0" />
						<?}?>
					</div>
					<div class="info">
						<div class="name">
							<?=$arItem["NAME"]?>
						</div>
						<div class="post">
							<?=$arItem["PROPERTIES"]["POST"]["VALUE"]?>
						</div>
						<div class="contacts">
							<div class="phone"><span><?=GetMessage('PHONE')?></span><?=$arItem["PROPERTIES"]["PHONE"]["VALUE"]?></div>
							<div class="email"><span><?=GetMessage('EMAIL')?></span><a href="mailto:<?=$arItem["PROPERTIES"]["EMAIL"]["VALUE"]?>"><?=$arItem["PROPERTIES"]["EMAIL"]["VALUE"]?></a></div>
						</div>
					</div>
				</div>
			<?endforeach;?>
		</div>
	<?endforeach;?>
</div>
<?if ($arParams["DISPLAY_BOTTOM_PAGER"]=="Y"):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
<script> 
	$(".staff_wrapp").ready(function() 
	{ 
		$(".section_title").click(function()
		{ 
			$(this).find("a").toggleClass('opened'); 
			$(this).next().slideToggle(333); 
		}); 
	});
</script>