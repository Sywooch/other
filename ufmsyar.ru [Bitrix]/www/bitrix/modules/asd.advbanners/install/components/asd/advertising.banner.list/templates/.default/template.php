<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();
shuffle($arResult['BANNERS']);//you can remove this line
foreach ($arResult['BANNERS'] as $arItem) {
	/*
	 * $arItem = array(
	 *	...
	 *	IMAGE - file array
	 *	CODE_PREPARE - text of banner
	 *	URL_PREPARE - url of banner
	 *	...
	 * );
	 */
	?><a href="<?= $arItem['URL_PREPARE']?>"><?= $arItem['NAME']?></a><br/><?
}
?>