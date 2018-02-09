<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
<?endforeach;?>
<script type="text/javascript" src="/bitrix/js/inseco/jquery.featureList-1.0.0.js"></script>
 <p style="font-family: Georgia, Times New Roman, Times, serif; font-style: italic; font-size: 24px; color: #5e7180; margin-bottom: 20px;"></p>
 <style type="text/css">
	
		h3 {
			margin: 0;	
			padding: 7px 0 0 0;
			font-size: 16px;
			text-transform: uppercase;
		}

		div#feature_list {
			width: 750px;
			height: 240px;
			overflow: hidden;
			position: relative;
		}

		div#feature_list ul {
			position: absolute;
			top: 0;
			list-style: none;	
			padding: 0;
			margin: 0;
		}

		ul#tabs {
			left: 0;
			z-index: 2;
			width: 319px;
		}

		ul#tabs li {
			font-size: 12px;
			font-family: Arial;
		}
		
		ul#tabs li img {
			padding: 5px;
			border: none;
			float: left;
			margin: 10px 10px 0 0;
		}

		ul#tabs li a {
			color: #222;
			text-decoration: none;	
			display: block;
			padding: 10px;
			height: 60px;
			outline: none;
		}

		ul#tabs li a:hover {
			text-decoration: underline;
		}

		ul#tabs li a.current {
			background:  url('/bitrix/components/inseco/inseco.feature/images/feature-tab-current.png');
			color: #FFF;
		}

		ul#tabs li a.current:hover {
			text-decoration: none;
			cursor: default;
		}

		ul#output {
			right: 0;
			width: 463px;
			height: 240px;
			position: relative;
		}

		ul#output li {
			position: absolute;
			width: 463px;
			height: 240px;
		}

		ul#output li a {
			position: absolute;
			bottom: 10px;
			right: 10px;
			padding: 8px 12px;
			text-decoration: none;
			font-size: 11px;
			color: #FFF;
			background: #4f6bb0;
			-moz-border-radius: 5px;
		}
		
		ul#output li a:hover {
			background: #D33431;
		}
	</style>
 	 		 
    <div id="feature_list"> 			 
      <ul id="tabs"> 
	<?foreach($arResult["ITEMS"] as $arItem):?>
				 
        <li><a href="javascript:;" ><img src="<?=CFile::GetPath($arItem["DISPLAY_PROPERTIES"]["ICON"]["VALUE"])?>"  /><h3><?echo $arItem["NAME"]?></h3><span><?=$arItem["DISPLAY_PROPERTIES"]["DESK"]["VALUE"]?></span></a></li>
       
        
    <?endforeach;?>  				 
        
       			</ul>
     			 
      <ul id="output"> 	
	<?foreach($arResult["ITEMS"] as $arItem):?>			 
        <li> 					<img src="<?=CFile::GetPath($arItem["DISPLAY_PROPERTIES"]["PICT"]["VALUE"])?>"  /> 					<?if($arItem["DISPLAY_PROPERTIES"]["URL"]["VALUE"]):?><a href="<?=$arItem["DISPLAY_PROPERTIES"]["URL"]["VALUE"]?>">Посмотреть</a><?endif;?> 				</li>
       				 
    <?endforeach;?>  		
			</ul>
     		</div>
   
<script language="javascript">
		$(document).ready(function() {

			$.featureList(
				$("#tabs li a"),
				$("#output li"), {
					start_item	:	1
				}
			);

			/*
			
			// Alternative

			
			$('#tabs li a').featureList({
				output			:	'#output li',
				start_item		:	1
			});

			*/

		});
	</script>
 