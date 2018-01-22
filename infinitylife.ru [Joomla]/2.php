<div class="slider_shop_1">
	 <?$APPLICATION->IncludeComponent(
	"startwww:slider", 
	"template1", 
	array(
		"IBLOCK_TYPE" => "startwwwSliderExample",
		"IBLOCK_ID" => "45",
		"SORT_BY" => "RANDOM",
		"SORT_TYPE" => "ASC",
		"INCLUDE_JQUERY" => "Y",
		"WIDTH" => "900",
		"HEIGHT" => "600",
		"URL_PROP_CODE" => "URL",
		"SHOW_FRAME" => "N",
		"NAV_TYPE" => "NUMBERS",
		"SHOW_ARROWS" => "N",
		"MODE" => "horizontal",
		"AUTO_SCROLL" => "Y",
		"TIME_TO_CHANGE" => "4",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600000"
	),
	false
);?><br>
</div>
<div style="width:100%; height:30px; ">
</div>
<div style="width:100%; height:500px; background-color:#e4e4e4; " class="magazin_info">
	<div style="width:280px; height:480px; float:left;padding:10px;" class="left">
		<p style="font-size:10pt; font-weight:bold;" class="head">
			Магазин
		</p>
		<p>
			Секция <span class="bold"></span>
		</p>
		<p>
			Время работы:  <span class="bold">9.00 - 18.00</span>
		</p>
		<p>
			Сайт:<span class="bold"></span>
		</p>
		<p>
			Категория: <span class="bold"></span>
		</p>
		<p>Количество просмотров: <span id="counter"></span></p>
		<script type="text/javascript">
			$("#counter").html(global_counter);
		</script>
		 <?=$arResult['SHOW_COUNTER']?> <?=$arItem['SHOW_COUNTER']?>
	</div>
	<div align="center" 
 class="right"
	style="width:580px; height:500px; float:left; background-size:cover; background-image:url(/map_detail/detail_1_1.png); background-position:center center; background-repeat:no-repeat; ">
	</div>
</div>
<div style="width:100%; height:30px; ">
</div>
<div align="center" style="width:100%; background-color:transparent;" class="gallery">
	 <?$APPLICATION->IncludeComponent(
	"aprof:lenta_zoom", 
	"fancybox2", 
	array(
		"INCLUDE_JQUERY" => "N",
		"MEDIA_ID" => "45",
		"MEDIA_SORT_FIELD" => "DESCRIPTION",
		"MEDIA_SORT_ORDER" => "ASC",
		"SLIDE_WIDTH" => "248",
		"SLIDE_HEIGHT" => "372",
		"SLIDE_ZOOM_WIDTH" => "",
		"SLIDE_ZOOM_HEIGHT" => "",
		"CNT" => "3"
	),
	false,
	array(
		"ACTIVE_COMPONENT" => "Y"
	)
);?>
</div>

<div class="link_back2">
<div width="100%; height:80px;">
	<a href="/magaziny/" class="link_back">НАЗАД К СПИСКУ</a>
</div>
</div>