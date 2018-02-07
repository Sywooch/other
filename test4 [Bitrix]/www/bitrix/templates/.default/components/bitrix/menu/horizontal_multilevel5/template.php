<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<ul id="horizontal-multilevel-menu" >

<?
$previousLevel = 0;
$tmp=0;
foreach($arResult as $arItem):?>

	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>

	<?if ($arItem["IS_PARENT"]):?>

		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
	<li style="float:right; background-color:transparent;  border-right:<? if($tmp==0)echo'0'; else echo'1';  ?>px #f1f1f1 solid; max-width:200px;" >
		<table style="margin:0; padding:0; border:0;  border-spacing:0px;">
			<tr style="margin:0; padding:0; border:0;"><td style="background-color:transparent; margin:0; border:0; padding:0; height:77px;">
				<a style="height:77px; padding-top:0px; padding-bottom:0px; padding-left:15px; padding-right:15px; vertical-align:middle; " href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>">
					<table style=" border-spacing:0px;"><tr><td style="vertical-align:mibble; height:75px; margin:0; border:0; padding:0;">   
						<span><?=$arItem["TEXT"]?></span>
				</td></tr></table>
                </a>
		</td></tr></table>

    <ul>
		<?else:?>
			<li style="float:right; border-right:<? if($tmp==0)echo'0'; else echo'1';  ?>px #f1f1f1 solid; max-width:200px;"  <?if ($arItem["SELECTED"]):?> class="item-selected"  <?endif?>><a style="padding-top:30px; padding-bottom:30px; padding-left:20px; padding-right:20px; " href="<?=$arItem["LINK"]?>" class="parent"><?=$arItem["TEXT"]?></a>
				<ul>
		<?endif?>

	<?else:?>

		<?if ($arItem["PERMISSION"] > "D"):?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
					<li style="float:right; background-color:transparent; border-right:<? if($tmp==0)echo'0'; else echo'1';  ?>px #f1f1f1 solid; max-width:200px;" >
        <table style="margin:0; padding:0; border:0; border-spacing:0px;">
        <tr  style="margin:0; padding:0; border:0;"><td style="background-color:transparent; margin:0; border:0; padding:0; height:77px;">

        <a style="height:77px; padding-top:0px; padding-bottom:0px; padding-left:15px; padding-right:15px; vertical-align:middle; " href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?  /*$path = $APPLICATION->GetCurUri(); echo $path." "; */ ?> 
		<table style=" border-spacing:0px;"><tr><td style="vertical-align:mibble; height:75px; margin:0; border:0; padding:0;">   
        <?=$arItem["TEXT"]?>
		</td></tr></table>
        </a>

        </td></tr></table>
        </li>

		<?else:?>
				<li style="float:right; border-right:<? if($tmp==0)echo'0'; else echo'1';  ?>px #f1f1f1 solid; max-width:200px;" <?if ($arItem["SELECTED"]):?>  style="padding-top:30px; padding-bottom:30px; padding-left:20px; padding-right:20px;" class="item-selected"<?endif?>><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
			<?endif?>

		<?else:?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li><a href="" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
			<?else:?>
				<li><a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
			<?endif?>

		<?endif?>

	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>
<? $tmp++;   ?>
<?endforeach?>

<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>

</ul>
<div class="menu-clear-left"></div>
<?endif?>