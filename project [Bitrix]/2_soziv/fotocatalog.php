<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "Фотокаталог 2 созыв");
$APPLICATION->SetPageProperty("description", "Фотокаталог 2 созыв");
$APPLICATION->SetTitle("Фотокаталог 2 созыв");
?><span style="font-size: 16pt; font-family: Tahoma; color: rgb(67, 94, 130);"><strong>Фотокаталог 2-го созыва</strong></span> 
<div align="left" style="width: 1000px;">
  <div style="width: 1000px; height: 30px; float: left;"></div> 
  <div align="left" style="float: left; width: 200px; background-color: transparent;"> <span style="font-family: 'Times New Roman', Times, serif; font-size: 14pt;"><strong>Альбомы</strong></span> 
    <br />
   
    <br />
   <a ><span style="font-family: 'Times New Roman', Times, serif; font-size: 12pt; cursor: pointer;">Альбом1</span></a> 
    <br />
   <a ><span style="font-family: 'Times New Roman', Times, serif; font-size: 12pt; cursor: pointer;">Альбом2</span></a> 
    <br />
   <a ><span style="font-family: 'Times New Roman', Times, serif; font-size: 12pt; cursor: pointer;">Альбом3</span></a> 
    <br />
   <a ><span style="font-family: 'Times New Roman', Times, serif; font-size: 12pt; cursor: pointer;">Альбом4</span></a> 
    <br />
   <a ><span style="font-family: 'Times New Roman', Times, serif; font-size: 12pt; cursor: pointer;">Альбом5</span></a> 
    <br />
   <a ><span style="font-family: 'Times New Roman', Times, serif; font-size: 12pt; cursor: pointer;">Альбом6</span></a> 
    <br />
   <a ><span style="font-family: 'Times New Roman', Times, serif; font-size: 12pt; cursor: pointer;">Альбом7</span></a> 
    <br />
   <a ><span style="font-family: 'Times New Roman', Times, serif; font-size: 12pt; cursor: pointer;">Альбом8</span></a> </div>
 
  <div align="center" style="float: left;"> <?$APPLICATION->IncludeComponent("altasib:photoplayer1mod", "template2", array(
	"SOURCE" => "1",
	"COLLECTION_ID_0" => "1",
	"DETAIL_PICT_RESIZE" => "Y",
	"PREVIEW_PICT_RESIZE" => "Y",
	"WRAP" => "WRAP_BOTH",
	"COUNT_EL" => "10",
	"SHOW_RANDOM" => "N",
	"ANIMATION_TYPE" => "fade",
	"SPEED" => "400",
	"SHOW_BUTTONS" => "Y",
	"SHOW_AUTO" => "Y",
	"TIMEOUT" => "6",
	"AUTOSTART" => "Y",
	"CLEAR_RESIZE_IMG" => "N",
	"ALLX" => "",
	"ALLY" => "",
	"BIGPICY" => "400",
	"PREVPICX" => "112",
	"PREVPICY" => "90",
	"INTERVAL" => "2",
	"PREVPIC_NUM" => "5",
	"DISCR_HEIGHT" => "87",
	"DISCR_TITLE_SIZE" => "14",
	"DISCR_TEXT_SIZE" => "12",
	"SHOW_FANCYBOX" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600"
	),
	false
);?> </div>
 </div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>