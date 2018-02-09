<?foreach ($arResult["BANNERS"] as $banner):
	if ($banner["URL"]):?>
<a href="<?=$banner["URL"]?>" style="color:transparent;">
	<?endif?>
	<?if ($banner["PICTURE"]["SRC"]):?>
			<img style="margin-bottom:10px;" src="<?=$banner["PICTURE"]["SRC"]?>" width="<?=$banner["PICTURE"]["WIDTH"]?>" height="<?=$banner["PICTURE"]["HEIGHT"]?>">
	<?endif?>
	<?=$banner["TEXT"]?>
	<?if ($banner["URL"]):?>
		</a>
	<?endif?>
<?endforeach?>