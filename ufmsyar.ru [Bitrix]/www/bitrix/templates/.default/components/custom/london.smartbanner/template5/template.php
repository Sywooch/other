<?foreach ($arResult["BANNERS"] as $banner):
	if ($banner["URL"]):?>
		<a href="<?=$banner["URL"]?>">
	<?endif?>
	<?if ($banner["PICTURE"]["SRC"]):?>
		<img src="<?=$banner["PICTURE"]["SRC"]?>" width="<?=$banner["PICTURE"]["WIDTH"]?>" height="<?=$banner["PICTURE"]["HEIGHT"]?>"
			style="margin-bottom:10px;">
	<?endif?>
	<?=$banner["TEXT"]?>
	<?if ($banner["URL"]):?>
		</a>
	<?endif?>
<?endforeach?>