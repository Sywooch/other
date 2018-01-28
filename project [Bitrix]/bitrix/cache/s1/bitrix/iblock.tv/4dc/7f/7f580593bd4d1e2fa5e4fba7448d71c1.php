<?
if($INCLUDE_FROM_CACHE!='Y')return false;
$datecreate = '001397469283';
$dateexpire = '001397472883';
$ser_content = 'a:2:{s:7:"CONTENT";s:8945:"	<div id="bx_tv_block_0" style="width: 1000px;">


		<div id="tv_playerjsPublicTVCollector.tv[0]" class="player_player" style="width: 1000px; height: 774px;">

        		<div id="bitrix_tv_flv_cont_0">


<div id="bitrix_tv_flv_0_div" style="width: 1000px; height: 774px;">Загрузка плеера</div>
<script>
window.bxPlayerOnloadbitrix_tv_flv_0 = function(config)
{
	if (typeof config != \'object\')
		config = {\'file\':\'/upload/iblock/a06/a06bfa15269d5bd658af3bbc468a068a.flv\',\'height\':\'774\',\'width\':\'1000\',\'dock\':true,\'id\':\'bitrix_tv_flv_0\',\'controlbar\':\'bottom\',\'players\':[{\'type\':\'html5\'},{\'type\':\'flash\',\'src\':\'/bitrix/components/bitrix/player/mediaplayer/player\'}],\'image\':\'/bitrix/components/bitrix/iblock.tv/templates/.default/images/default_big.png\',\'logo.file\':\'/bitrix/components/bitrix/iblock.tv/templates/.default/images/logo.png\',\'logo.link\':\'http://www.1c-bitrix.ru/products/cms/features/mediaplayer.php\',\'skin\':\'/bitrix/components/bitrix/player/mediaplayer/skins/lulu/lulu.zip\',\'repeat\':\'N\',\'bufferlength\':\'10\',\'abouttext\':\'1С-Битрикс: Медиа-плеер\',\'aboutlink\':\'http://www.1c-bitrix.ru/products/cms/features/mediaplayer.php\'};

	jwplayer("bitrix_tv_flv_0_div").setup(config);

		jwplayer("bitrix_tv_flv_0_div").onReady(function()
	{
		try{
			var pWmode = BX.findChild(BX("bitrix_tv_flv_0_div"), {tagName: "PARAM", attribute: {name: "wmode"}});
			if (pWmode)
				pWmode.value = "transparent";

			var pEmbed = BX.findChild(BX("bitrix_tv_flv_0_div"), {tagName: "EMBED"});
			if (pEmbed && pEmbed.setAttribute)
				pEmbed.setAttribute("wmode", "transparent");
		}catch(e){}
	});
	};

if (window.jwplayer) // jw script already loaded
{
	setTimeout(bxPlayerOnloadbitrix_tv_flv_0, 100);
}
else
{
	BX.addCustomEvent(window, "onPlayerJWScriptLoad", function(){setTimeout(bxPlayerOnloadbitrix_tv_flv_0, 100);});
	if (!window.bPlayerJWScriptLoaded)
	{
		window.bPlayerJWScriptLoaded = true;
		// load jw scripts once
		BX.loadScript(\'/bitrix/components/bitrix/player/mediaplayer/jwplayer.js\', function(){setTimeout(function()
		{
			BX.onCustomEvent(window, "onPlayerJWScriptLoad");
		}, 100);});
	}
}
</script><noscript>В вашем браузере отключен JavaScript</noscript>

		</div>
		
				</div>

		<div style="width:100%; height:10px; background-color:transparent;"></div>



			<div align="center" id="tv_list_0" class="player_tree_list" style="border:1px transparent solid !important; width: 997px;

		"></div>
		</div>
	<script>
	
		jsPublicTVCollector.list[0] =
		[
			{
				Id: \'5\',
				Name: \'\',
				Depth: \'0\',
				Items:
				[
					{
						Id: 47,
						Name: \'Файл1\',
						Description: \'\',
						SmallImage: \'/bitrix/components/bitrix/iblock.tv/templates/.default/images/default_small.png\',
						BigImage: \'/bitrix/components/bitrix/iblock.tv/templates/.default/images/default_big.png\',
						Duration: \'1 min\',
						File: \'/upload/iblock/a06/a06bfa15269d5bd658af3bbc468a068a.flv\',
						Size: \'6.03\',
						Type: \'flv\',
						Action: \'javascript:(new BX.CAdminDialog({\\\'content_url\\\':\\\'/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=5&type=video&ID=47&lang=ru&force_catalog=&filter_section=5&bxpublic=Y&from_module=iblock&return_url=%2F1_soziv%2Fvideo.php\\\',\\\'width\\\':\\\'700\\\',\\\'height\\\':\\\'400\\\'})).Show()\'
					},
					{
						Id: 48,
						Name: \'Видеофайл2\',
						Description: \'\',
						SmallImage: \'/bitrix/components/bitrix/iblock.tv/templates/.default/images/default_small.png\',
						BigImage: \'/bitrix/components/bitrix/iblock.tv/templates/.default/images/default_big.png\',
						Duration: \'\',
						File: \'/upload/iblock/dc0/dc072fbded4e2616bb301100dc508c17.flv\',
						Size: \'6.03\',
						Type: \'flv\',
						Action: \'javascript:(new BX.CAdminDialog({\\\'content_url\\\':\\\'/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=5&type=video&ID=48&lang=ru&force_catalog=&filter_section=5&bxpublic=Y&from_module=iblock&return_url=%2F1_soziv%2Fvideo.php\\\',\\\'width\\\':\\\'700\\\',\\\'height\\\':\\\'400\\\'})).Show()\'
					}
				]
			}
		];
	jsPublicTVCollector.tv[0] = new jsPublicTV();
	jsPublicTVCollector.tv[0].LanguagePhrases = {
		\'duration\':\'Длительность: \',
		\'title\':\'Название: \',
		\'description\':\'Описание: \',
		\'file\':\'Файл: \',
		\'download\':\'Скачать\',
		\'size_mb\':\' Мб\',
		\'play\':\'Посмотреть\',
		\'edit\':\'Изменить\'
	};

	//set uniq prefix
	jsPublicTVCollector.tv[0].Prefix = \'p0\';

	//Init additonal TV properties
	jsPublicTVCollector.add[0] = {};

	//set orderplay \\section\\
	jsPublicTVCollector.add[0].PlayOrder = function(type)
	{
		jsPublicTVCollector.tv[0].PlayOrder = type;
	}

	/*select*/
	//set selected item
	jsPublicTVCollector.add[0].SelectListItem = function(old_i, old_j)
	{
		if(jsPublicTVCollector.tv[0].CurrentItem)
		{
			var i = jsPublicTVCollector.tv[0].CurrentItem.Section;
			var j = jsPublicTVCollector.tv[0].CurrentItem.Item;
			var prefix = jsPublicTVCollector.tv[0].Prefix ;
			var item = document.getElementById(prefix + \'bx-tv-s\' + i + \'i\' + j);
			if(item)
			{
				item = item.getElementsByTagName(\'DIV\');
				if(item.length>0)
					item[0].className = jsPublicTVCollector.add[0].ListItemColors.select;

				//scroll to selected
				TreeBlockID = document.getElementById(jsPublicTVCollector.tv[0].TreeBlockID.id);
				TreeBlockID.scrollTop = BX.browser.IsIE()
					?item[0].offsetTop-13
					:item[0].offsetTop - TreeBlockID.offsetTop - 4;

				//unselect
				if(typeof(old_i) != "undefined" && typeof(old_j) != "undefined" && old_j!==\'\' && old_i!==\'\')
				{
					var item = document.getElementById(prefix + \'bx-tv-s\' + old_i + \'i\' + old_j);
					if(item)
					{
						item = item.getElementsByTagName(\'DIV\');
						if(item.length>0)
							item[0].className = jsPublicTVCollector.add[0].ListItemColors.normal;
					}
				}
			}
		}
	}

	//set hover item
	jsPublicTVCollector.add[0].HoverListItem = function(ob)
	{
		if(ob.className != jsPublicTVCollector.add[0].ListItemColors.select)
		{
			if(ob.className != jsPublicTVCollector.add[0].ListItemColors.hover)
				ob.className = jsPublicTVCollector.add[0].ListItemColors.hover;
			else
				ob.className = jsPublicTVCollector.add[0].ListItemColors.normal;
		}
	}

	//set default hover\\select colors
	jsPublicTVCollector.add[0].ListItemColors = {select: \'selected-tv-item\', hover:\'hover-tv-item\', normal:\'normal-tv-item\'}
	/*end-select*/

	//Template of the item block
	jsPublicTVCollector.tv[0].AddPlayerListener(
		\'BUILD_ITEM\',
		function(txt, i, j)
		{
			txt = \'<style type="text/css">.bitrix-tv-tree-item{ clear:none !important; }</style>\' +
				\'<div onmouseover="jsPublicTVCollector.add[0].HoverListItem(this)" onmouseout="jsPublicTVCollector.add[0].HoverListItem(this)" style="padding:10px 0px; background-color:transparent !important;  width:320px !important; border:1px transparent solid !important;  overflow:hidden !important; float:left !important; display:block !important; ">\'


					+\'<div align="center" class="bitrix-tv-tree-item-description" style="background-color:transparent !important; width:300px !important; float:left !important;">\'
					+\'<a onclick="jsPublicTVCollector.tv[0].PlayFile(\'+i+\',\'+j+\',true,true)" class="tv-desc-name">\' + jsPublicTVCollector.tv[0][\'Sections\'][i][\'Items\'][j][\'Name\'] + \'</a>\' //name

						+\'<img style="cursor:pointer; border:1px black solid !important;" onclick="jsPublicTVCollector.tv[0].PlayFile(\'+i+\',\'+j+\',true,true)" width="\'/* + jsPublicTVCollector.tv[0].ShowPreviewImageSize[0] + */ + \'256px" height="\' /*+ jsPublicTVCollector.tv[0].ShowPreviewImageSize[1]*/ + \'192px" src="\' + jsPublicTVCollector.tv[0][\'Sections\'][i][\'Items\'][j][\'SmallImage\'] + \'">\' //image


				+\'<div style="clear:both;"></div>\'
			+\'</div>\'
			+\'<div class="delimiter-gray-mono-grad2-item" style="display:none !important; height:0px !important;">\';

			return txt;
		}
	);

	jsPublicTVCollector.tv[0].AddPlayerListener(
		\'BEFORE_PLAY_FILE\',
		function(i, j, old_i, old_j)
		{
			jsPublicTVCollector.add[0].SelectListItem(old_i, old_j);
		}
	);

	//init&run
	if(jsPublicTVCollector.tv[0])
	{
		jsPublicTVCollector.tv[0].Init(
			jsPublicTVCollector.list[0],
			\'tv_list_0\',
			\'tv_description_0\',
			{
				block_id:
				{
					wmv: \'bitrix_tv_wmv_cont_0\',
					flv: \'bitrix_tv_flv_cont_0\'
				},
				obj_id:
				{
					wmv: \'bitrix_tv_wmv_0\',
					flv: \'bitrix_tv_flv_0_div\'
				},
				logo: \'/bitrix/templates/.default/components/bitrix/iblock.tv/template_video1/images/logo.png\',
				height: \'774\',
				width: \'1000\'
			}
		);
		jsPublicTVCollector.tv[0].BuildTree(false, 0);

		SetItem = jsPublicTVCollector.tv[0].SeekByRealParams(false, 47);
		if(false!==SetItem.section && false!==SetItem.element)
			jsPublicTVCollector.tv[0].PlayFile(SetItem.section, SetItem.element, false, true);

		if(jsPublicTVCollector.tv[0].PlayOrder != \'section\')
			jsPublicTVCollector.add[0].PlayOrder(\'section\');

		//set selected item
		jsPublicTVCollector.add[0].SelectListItem();
	}

	</script>
<br clear="all"/>";s:4:"VARS";a:2:{s:8:"arResult";a:4:{s:8:"CAN_EDIT";s:1:"Y";s:14:"IBLOCK_TYPE_ID";s:5:"video";s:9:"RAW_FILES";a:2:{s:55:"/upload/iblock/a06/a06bfa15269d5bd658af3bbc468a068a.flv";a:2:{s:2:"ID";s:2:"47";s:4:"NAME";s:9:"Файл1";}s:55:"/upload/iblock/dc0/dc072fbded4e2616bb301100dc508c17.flv";a:2:{s:2:"ID";s:2:"48";s:4:"NAME";s:19:"Видеофайл2";}}s:9:"IBLOCK_ID";s:1:"5";}s:18:"templateCachedData";a:4:{s:13:"additionalCSS";s:80:"/bitrix/templates/.default/components/bitrix/iblock.tv/template_video1/style.css";s:12:"additionalJS";s:80:"/bitrix/templates/.default/components/bitrix/iblock.tv/template_video1/script.js";s:14:"__children_css";a:1:{i:0;s:61:"/bitrix/components/bitrix/player/templates/.default/style.css";}s:18:"__children_epilogs";a:1:{i:0;a:5:{s:10:"epilogFile";s:72:"/bitrix/components/bitrix/player/templates/.default/component_epilog.php";s:12:"templateName";s:8:".default";s:12:"templateFile";s:64:"/bitrix/components/bitrix/player/templates/.default/template.php";s:14:"templateFolder";s:51:"/bitrix/components/bitrix/player/templates/.default";s:12:"templateData";b:0;}}}}}';
return true;
?>