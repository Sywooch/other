<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?
CJSCore::Init(array("ajax"));
$firstItemType = 'flv';
if (isset($arResult['SELECTED_ELEMENT']) && isset($arResult['SELECTED_ELEMENT']['VALUES']['TYPE']))
	$firstItemType = strtolower($arResult['SELECTED_ELEMENT']['VALUES']['TYPE']);
?>
	<div id="bx_tv_block_<?=$arResult['PREFIX']?>" style="width: <?=$arParams['WIDTH']?>px;">


		<div id="tv_playerjsPublicTVCollector.tv[<?=$arResult['PREFIX']?>]" class="player_player" style="width: <?=$arParams['WIDTH']?>px; height: <?=$arParams['HEIGHT'] + $arResult['CORRECTION']['FLV']?>px;">

        <?if ($arResult['FIRST_FLV_ITEM']):?>
		<div id="bitrix_tv_flv_cont_<?= $arResult["PREFIX"]?>">
<?$APPLICATION->IncludeComponent(
			"bitrix:player",
			"",
			Array(
				"PLAYER_TYPE" => "flv",
				"USE_PLAYLIST" => "N",
				"PATH" => $firstItemType == 'flv' ? $arResult['SELECTED_ELEMENT']['FILE'] : $arResult['FIRST_FLV_ITEM'],
				"WIDTH" => $arParams['WIDTH'],
				"HEIGHT" => $arParams['HEIGHT'] + $arResult['CORRECTION']['FLV'],
				"PREVIEW" => $arResult['SELECTED_ELEMENT']['VALUES']['DETAIL_PICTURE'],
				"LOGO" => $arParams["LOGO"],
				"FULLSCREEN" => "Y",
				"SKIN_PATH" => "/bitrix/components/bitrix/player/mediaplayer/skins",
				"SKIN" => "lulu.zip",
				"CONTROLBAR" => "bottom",
				"WMODE" => "transparent",
				"WMODE_WMV" => "windowless",
				"HIDE_MENU" => "N",
				"SHOW_CONTROLS" => "Y",
				"SHOW_STOP" => "N",
				"SHOW_DIGITS" => "N",
				"CONTROLS_BGCOLOR" => "blue",
				"CONTROLS_COLOR" => "red",
				"CONTROLS_OVER_COLOR" => "000000",
				"SCREEN_COLOR" => "000000",
				"AUTOSTART" => "N",
				"REPEAT" => "N",
				"VOLUME" => "90",
				"DISPLAY_CLICK" => "play",
				"MUTE" => "N",
				"HIGH_QUALITY" => "Y",
				"ADVANCED_MODE_SETTINGS" => "Y",
				"BUFFER_LENGTH" => "10",
				"DOWNLOAD_LINK" => $arResult['SELECTED_ELEMENT']['FILE'],
				"DOWNLOAD_LINK_TARGET" => "_self",
				"ALLOW_SWF" => $arParams["ALLOW_SWF"],
				"ADDITIONAL_PARAMS" => array(
					'LOGO' => $arParams['LOGO'],
					'NUM' => $arResult['PREFIX'],
					'HEIGHT_CORRECT' => $arResult['CORRECTION'],
				),
				"PLAYER_ID" => "bitrix_tv_flv_".$arResult["PREFIX"]
			),
			$component,
			Array("HIDE_ICONS" => "Y")
		);?>
		</div>
		<?endif;?>

		<?if ($arResult['FIRST_WMV_ITEM']):?>
		<div id="bitrix_tv_wmv_cont_<?= $arResult["PREFIX"]?>">
		<?$APPLICATION->IncludeComponent(
			"bitrix:player",
			"",
			Array(
				"PLAYER_TYPE" => "wmv",
				"USE_PLAYLIST" => "N",
				"INIT_PLAYER"=>"N",
				"PATH" => $firstItemType == 'wmv' ? $arResult['SELECTED_ELEMENT']['FILE'] : $arResult['FIRST_WMV_ITEM'],
				"WIDTH" => $arParams['WIDTH'],
				"HEIGHT" => $arParams['HEIGHT'] + $arResult['CORRECTION']['FLV'],
				"PREVIEW" => $arResult['SELECTED_ELEMENT']['VALUES']['DETAIL_PICTURE'],
				"LOGO" => $arParams["LOGO"],
				"FULLSCREEN" => "Y",
				"CONTROLBAR" => "bottom",
				"WMODE" => "transparent",
				"WMODE_WMV" => "windowless",
				"HIDE_MENU" => "N",
				"SHOW_CONTROLS" => "Y",
				"SHOW_STOP" => "N",
				"SHOW_DIGITS" => "Y",
				"CONTROLS_BGCOLOR" => "blue",
				"CONTROLS_COLOR" => "red",
				"CONTROLS_OVER_COLOR" => "000000",
				"SCREEN_COLOR" => "000000",
				"AUTOSTART" => "N",
				"REPEAT" => "N",
				"VOLUME" => "90",
				"DISPLAY_CLICK" => "play",
				"MUTE" => "N",
				"HIGH_QUALITY" => "Y",
				"ADVANCED_MODE_SETTINGS" => "Y",
				"BUFFER_LENGTH" => "10",
				"DOWNLOAD_LINK" => $arResult['SELECTED_ELEMENT']['FILE'],
				"DOWNLOAD_LINK_TARGET" => "_self",
				"ALLOW_SWF" => $arParams["ALLOW_SWF"],
				"ADDITIONAL_PARAMS" => array(
					'LOGO' => $arParams['LOGO'],
					'NUM' => $arResult['PREFIX'],
					'HEIGHT_CORRECT' => $arResult['CORRECTION'],
				),
				"PLAYER_ID" => "bitrix_tv_wmv_".$arResult["PREFIX"]
			),
			$component,
			Array("HIDE_ICONS" => "Y")
		);?>
		</div>
		<?endif;?>
		</div>

		<div style="width:100%; height:10px; background-color:transparent;"></div>



	<?if(!$arResult['NO_PLAY_LIST']):?>
		<div align="center" id="tv_list_<?=$arResult['PREFIX']?>" class="player_tree_list" style="border:1px transparent solid !important; width: <?=$arParams['WIDTH']-3?>px;

		"></div>
	<?endif;?>
	</div>
	<?//build tree and call player?>
<script>
	<?=$arResult['LIST']?>

	jsPublicTVCollector.tv[<?=$arResult['PREFIX']?>] = new jsPublicTV();
	jsPublicTVCollector.tv[<?=$arResult['PREFIX']?>].LanguagePhrases = {
		'duration':'<?=GetMessageJS("BITRIXTV_TEMPLATE_DURATION")?>',
		'title':'<?=GetMessageJS("BITRIXTV_TEMPLATE_TITLE")?>',
		'description':'<?=GetMessageJS("BITRIXTV_TEMPLATE_DESCRIPTION")?>',
		'file':'<?=GetMessageJS("BITRIXTV_TEMPLATE_FILE")?>',
		'download':'<?=GetMessageJS("BITRIXTV_TEMPLATE_DOWNLOAD")?>',
		'size_mb':'<?=GetMessageJS("BITRIXTV_TEMPLATE_BXTV_SIZE_MB")?>',
		'play':'<?=GetMessageJS("BITRIXTV_TEMPLATE_BXTV_PLAY")?>',
		'edit':'<?=GetMessageJS("BITRIXTV_TEMPLATE_BXTV_EDIT")?>'
	};

	//set uniq prefix
	jsPublicTVCollector.tv[<?=$arResult['PREFIX']?>].Prefix = 'p<?=$arResult['PREFIX']?>';

	//Init additonal TV properties
	jsPublicTVCollector.add[<?=$arResult['PREFIX']?>] = {};

	//set orderplay \section\
	jsPublicTVCollector.add[<?=$arResult['PREFIX']?>].PlayOrder = function(type)
	{
		jsPublicTVCollector.tv[<?=$arResult['PREFIX']?>].PlayOrder = type;
	}

	/*select*/
	//set selected item
	jsPublicTVCollector.add[<?=$arResult['PREFIX']?>].SelectListItem = function(old_i, old_j)
	{
		if(jsPublicTVCollector.tv[<?=$arResult['PREFIX']?>].CurrentItem)
		{
			var i = jsPublicTVCollector.tv[<?=$arResult['PREFIX']?>].CurrentItem.Section;
			var j = jsPublicTVCollector.tv[<?=$arResult['PREFIX']?>].CurrentItem.Item;
			var prefix = jsPublicTVCollector.tv[<?=$arResult['PREFIX']?>].Prefix ;
			var item = document.getElementById(prefix + 'bx-tv-s' + i + 'i' + j);
			if(item)
			{
				item = item.getElementsByTagName('DIV');
				if(item.length>0)
					item[0].className = jsPublicTVCollector.add[<?=$arResult['PREFIX']?>].ListItemColors.select;

				//scroll to selected
				TreeBlockID = document.getElementById(jsPublicTVCollector.tv[<?=$arResult['PREFIX']?>].TreeBlockID.id);
				TreeBlockID.scrollTop = BX.browser.IsIE()
					?item[0].offsetTop-13
					:item[0].offsetTop - TreeBlockID.offsetTop - 4;

				//unselect
				if(typeof(old_i) != "undefined" && typeof(old_j) != "undefined" && old_j!=='' && old_i!=='')
				{
					var item = document.getElementById(prefix + 'bx-tv-s' + old_i + 'i' + old_j);
					if(item)
					{
						item = item.getElementsByTagName('DIV');
						if(item.length>0)
							item[0].className = jsPublicTVCollector.add[<?=$arResult['PREFIX']?>].ListItemColors.normal;
					}
				}
			}
		}
	}

	//set hover item
	jsPublicTVCollector.add[<?=$arResult['PREFIX']?>].HoverListItem = function(ob)
	{
		if(ob.className != jsPublicTVCollector.add[<?=$arResult['PREFIX']?>].ListItemColors.select)
		{
			if(ob.className != jsPublicTVCollector.add[<?=$arResult['PREFIX']?>].ListItemColors.hover)
				ob.className = jsPublicTVCollector.add[<?=$arResult['PREFIX']?>].ListItemColors.hover;
			else
				ob.className = jsPublicTVCollector.add[<?=$arResult['PREFIX']?>].ListItemColors.normal;
		}
	}

	//set default hover\select colors
	jsPublicTVCollector.add[<?=$arResult['PREFIX']?>].ListItemColors = {select: 'selected-tv-item', hover:'hover-tv-item', normal:'normal-tv-item'}
	/*end-select*/

	//Template of the item block
	jsPublicTVCollector.tv[<?=$arResult['PREFIX']?>].AddPlayerListener(
		'BUILD_ITEM',
		function(txt, i, j)
		{
			txt = '<style type="text/css">.bitrix-tv-tree-item{ clear:none !important; }</style>' +
				'<div onmouseover="jsPublicTVCollector.add[<?=$arResult['PREFIX']?>].HoverListItem(this)" onmouseout="jsPublicTVCollector.add[<?=$arResult['PREFIX']?>].HoverListItem(this)" style="padding:10px 0px; background-color:transparent !important;  width:320px !important; border:1px transparent solid !important;  overflow:hidden !important; float:left !important; display:block !important; ">'


					+'<div align="center" class="bitrix-tv-tree-item-description" style="background-color:transparent !important; width:300px !important; float:left !important;">'
					+'<a onclick="jsPublicTVCollector.tv[<?=$arResult['PREFIX']?>].PlayFile('+i+','+j+',true,true)" class="tv-desc-name">' + jsPublicTVCollector.tv[<?=$arResult['PREFIX']?>]['Sections'][i]['Items'][j]['Name'] + '</a>' //name

						+'<img style="cursor:pointer; border:1px black solid !important;" onclick="jsPublicTVCollector.tv[<?=$arResult['PREFIX']?>].PlayFile('+i+','+j+',true,true)" width="'/* + jsPublicTVCollector.tv[<?=$arResult['PREFIX']?>].ShowPreviewImageSize[0] + */ + '256px" height="' /*+ jsPublicTVCollector.tv[<?=$arResult['PREFIX']?>].ShowPreviewImageSize[1]*/ + '192px" src="' + jsPublicTVCollector.tv[<?=$arResult['PREFIX']?>]['Sections'][i]['Items'][j]['SmallImage'] + '">' //image


				+'<div style="clear:both;"></div>'
			+'</div>'
			+'<div class="delimiter-gray-mono-grad2-item" style="display:none !important; height:0px !important;">';

			return txt;
		}
	);

	jsPublicTVCollector.tv[<?=$arResult['PREFIX']?>].AddPlayerListener(
		'BEFORE_PLAY_FILE',
		function(i, j, old_i, old_j)
		{
			jsPublicTVCollector.add[<?=$arResult['PREFIX']?>].SelectListItem(old_i, old_j);
		}
	);

	//init&run
	if(jsPublicTVCollector.tv[<?=$arResult['PREFIX']?>])
	{
		jsPublicTVCollector.tv[<?=$arResult['PREFIX']?>].Init(
			jsPublicTVCollector.list[<?=$arResult['PREFIX']?>],
			'tv_list_<?=$arResult['PREFIX']?>',
			'tv_description_<?=$arResult['PREFIX']?>',
			{
				block_id:
				{
					wmv: 'bitrix_tv_wmv_cont_<?=$arResult['PREFIX']?>',
					flv: 'bitrix_tv_flv_cont_<?=$arResult['PREFIX']?>'
				},
				obj_id:
				{
					wmv: 'bitrix_tv_wmv_<?=$arResult['PREFIX']?>',
					flv: 'bitrix_tv_flv_<?=$arResult['PREFIX']?>_div'
				},
				logo: '<?=$templateFolder.'/images/logo.png'?>',
				height: '<?=$arParams['HEIGHT']+$arResult['CORRECTION']['FLV']?>',
				width: '<?=$arParams['WIDTH']?>'
			}
		);
		jsPublicTVCollector.tv[<?=$arResult['PREFIX']?>].BuildTree(false, 0);

		SetItem = jsPublicTVCollector.tv[<?=$arResult['PREFIX']?>].SeekByRealParams(false, <?=intval($arResult['SELECTED_ELEMENT']['VALUES']['ID'])?>);
		if(false!==SetItem.section && false!==SetItem.element)
			jsPublicTVCollector.tv[<?=$arResult['PREFIX']?>].PlayFile(SetItem.section, SetItem.element, false, true);

		if(jsPublicTVCollector.tv[<?=$arResult['PREFIX']?>].PlayOrder != 'section')
			jsPublicTVCollector.add[<?=$arResult['PREFIX']?>].PlayOrder('section');

		//set selected item
		jsPublicTVCollector.add[<?=$arResult['PREFIX']?>].SelectListItem();
	}

	<?if($arParams['STAT_EVENT'] || $arParams['SHOW_COUNTER_EVENT']):?>
		jsPublicTVCollector.tv[<?=$arResult['PREFIX']?>].GatherStatistics = true;
	<?endif;?>
</script>
<br clear="all"/>