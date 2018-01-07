<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<?if (!empty($arResult)){?>


	<nav class="b-inner-menu">
		<? $i=1; ?>
		<?foreach($arResult as $arItem){
			
			//echo "<pre>";
			//print_r($arItem["PARAMS"]["ITEMS"]);
			//echo "</pre>";


		if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
			continue;?>
			<? if(isset($arItem["PARAMS"]["TYPE"]) && $arItem["PARAMS"]["TYPE"] == "BUTTON"){ ?>
				<div class="b-layout__inner-additional">
					<a href="<?=$arItem["LINK"]?>" class="btn _medium-size"><?=$arItem["TEXT"]?></a>
				</div>
			<? }else{ ?>
				<div class="b-inner-menu__item <?if($arItem["SELECTED"]){?>_current<?}?>">
					<?if(!$arItem["SELECTED"]){?><a href="<?=$arItem["LINK"]?>"><?}?>
						<span><?=$arItem["TEXT"]?></span>
						<?if(!$arItem["SELECTED"]){?></a><?}?>


					<?if(count($arItem["PARAMS"]["ITEMS"]) > 0 && $arItem["SELECTED"]){?>


						<div class="b-inner-menu__sub">

							<?foreach($arItem["PARAMS"]["ITEMS"] as $v){?>
								<?
								$page = $APPLICATION->GetCurPage();
								?>
							<div class="b-inner-menu__item <? if($page == $v["SECTION_PAGE_URL"]){ echo "_current"; } ?>">
								<? if($page == $v["SECTION_PAGE_URL"]){ ?>
									<span><?=$v["NAME"];?></span>
								<? }else{ ?>
									<a href="<?=$v["SECTION_PAGE_URL"];?>"> <span><?=$v["NAME"];?></span></a>
								<? } ?>

							</div>
							<?}?>


						</div>
					<?}?>




				</div>
			<? } ?>
			<? $i++; ?>






		<?}?>




	</nav>


<?}?>