<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<ul id="horizontal-multilevel-menu">

<?
$previousLevel = 0;
$count=2;

$z_index=10;
foreach($arResult as $arItem):?>

	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>

	<?if ($arItem["IS_PARENT"]):?>

		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
	<li style="z-index:<?=$z_index; $z_index--;?>" class="<? if(($count % 2) == 0){ echo "red";  }else{  echo "white"; }; $count++; ?> <?if ($arItem["SELECTED"]):?> selected <?endif?>"><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><div class="left"></div><span><?=$arItem["TEXT"]?></span><div class="right"></div></a>
				<ul>
		<?else:?>
					<li<?if ($arItem["SELECTED"]):?> class="item-selected <? if(($count % 2) == 0){ echo "red";  }else{  echo "white"; }; $count++; ?> "<?endif?> class="<? if(($count % 2) == 0){ echo "red";  }else{  echo "white"; }; $count++; ?>"><a href="<?=$arItem["LINK"]?>" class="parent"><div class="left"></div><span><?=$arItem["TEXT"]?></span><div class="right"></div></a>
				<ul>
		<?endif?>

	<?else:?>

		<?if ($arItem["PERMISSION"] > "D"):?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
					<li style="z-index:<?=$z_index; $z_index--;?>" class="<? if(($count % 2) == 0){ echo "red";  }else{  echo "white"; }; $count++; ?><?if ($arItem["SELECTED"]):?> selected <?endif?>"><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><div class="left"></div><span><?=$arItem["TEXT"]?></span><div class="right"></div></a></li>
			<?else:?>
					<li<?if ($arItem["SELECTED"]):?> class="item-selected <? if(($count % 2) == 0){ echo "red";  }else{  echo "white"; }; $count++; ?><?if ($arItem["SELECTED"]):?> selected <?endif?> "<?endif?> class="<? if(($count % 2) == 0){ echo "red";  }else{  echo "white"; }; $count++; ?><?if ($arItem["SELECTED"]):?> selected <?endif?>" style="z-index:<?=$z_index; $z_index--;?>"><a href="<?=$arItem["LINK"]?>"><div class="left"></div><span><?=$arItem["TEXT"]?></span><div class="right"></div></a></li>
			<?endif?>

		<?else:?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
					<li style="z-index:<?=$z_index; $z_index--;?>" class="<? if(($count % 2) == 0){ echo "red";  }else{  echo "white"; }; $count++; ?><?if ($arItem["SELECTED"]):?> selected <?endif?>"><a href="" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><div class="left"></div><span><?=$arItem["TEXT"]?></span><div class="right"></div></a></li>
			<?else:?>
					<li style="z-index:<?=$z_index; $z_index--;?>" class="<? if(($count % 2) == 0){ echo "red";  }else{  echo "white"; }; $count++; ?><?if ($arItem["SELECTED"]):?> selected <?endif?>"><a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><div class="left"></div><span><?=$arItem["TEXT"]?></span><div class="right"></div></a></li>
			<?endif?>

		<?endif?>

	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>
					<? // $count++;  ?>
<?endforeach?>

<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>

</ul>
<div class="menu-clear-left"></div>
<?endif?>