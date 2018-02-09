<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();?>
<ul class="bxslider">
<? foreach($arResult as $category): ?>
	<li>
		<?if($arParams["HREF_IMG"]):?>
			<a href="<?=$category["HREF"]?>" title="<?=$category["NAME"]?>">
				<img src="<?=$category["DETAIL_PICTURE"]?>" title="<?=$category["NAME"]?>">
			</a>
		<?else:?>
			<img src="<?=$category["DETAIL_PICTURE"]?>" title="<?=$category["NAME"]?>">
		<?endif;?>
	</li>
<? endforeach; ?>
</ul>