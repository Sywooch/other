<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?if(!empty($arParams["VK"])):?>
	<a href="<?=$arParams["VK"]?>" target="_blank" >
		<img border="0" src="/bitrix/components/aspro/social.info/images/vk.png" alt="<?=GetMessage("VKONTAKTE")?>" title="<?=GetMessage("VKONTAKTE")?>" />
	</a>
<?endif;?>
<?if(!empty($arParams["FACE"])):?>
	<a href="<?=$arParams["FACE"]?>" target="_blank">
		<img border="0" src="/bitrix/components/aspro/social.info/images/facebook.png" alt="Facebook" title="Facebook" />
	</a>
<?endif;?>
<?if(!empty($arParams["TWIT"])):?>
	<a href="<?=$arParams["TWIT"]?>" target="_blank">
		<img border="0" src="/bitrix/components/aspro/social.info/images/twitter.png" alt="Twitter" title="Twitter" /> 
	</a>
<?endif;?>