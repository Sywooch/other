<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Наука");
?> <?$APPLICATION->IncludeComponent(
	"altasib:photoplayer1mod",
	"template1",
	Array(
		"SOURCE" => "1",
		"COLLECTION_ID_0" => "2",
		"DETAIL_PICT_RESIZE" => "Y",
		"PREVIEW_PICT_RESIZE" => "Y",
		"WRAP" => "WRAP_BOTH",
		"COUNT_EL" => "100",
		"SHOW_RANDOM" => "N",
		"ANIMATION_TYPE" => "fade",
		"SPEED" => "600",
		"SHOW_BUTTONS" => "Y",
		"SHOW_AUTO" => "N",
		"CLEAR_RESIZE_IMG" => "N",
		"ALLX" => "0",
		"ALLY" => "0",
		"BIGPICY" => "300",
		"PREVPICX" => "112",
		"PREVPICY" => "90",
		"INTERVAL" => "15",
		"PREVPIC_NUM" => "5",
		"DISCR_HEIGHT" => "50",
		"DISCR_TITLE_SIZE" => "12",
		"DISCR_TEXT_SIZE" => "10",
		"SHOW_FANCYBOX" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600"
	)
);?> 
<div> 
  <br />
<span style="color:#656565 !important;">  
  <div> 
    <h1>ОСНОВНЫЕ НАПРАВЛЕНИЯ НАУЧНОЙ РАБОТЫ</h1>
   
    <p style="text-align: justify;"></p>
   
    <ul style="list-style: url(http://z203712.infobox.ru/images/styles/default/menu_item_orange.png); text-align: justify;"> 
      <li>Разработка теоретико-методологических и клинических проблем биопсихосоциального подхода к диагностике и терапии больных в психиатрии, неврологии и наркологии, а также в области пограничных нервно-психических и психосоматических заболеваний</li>
     
      <li>Разработка медико-психологических проблем в медицине, включая научные исследования в области медицинской психологии и психодиагностики</li>
     
      <li>Разработка теории и новых современных специализированных методов психотерапии с оценкой их эффективности</li>
     
      <li>Разработка научных основ организации психиатрической, психотерапевтической и неврологической помощи населению, включая современную методологию оценки психического здоровья в целом и качества жизни населения</li>
     </ul>
   
    <p style="text-align: justify; font-family: Verdana; font-size: 11px; background-color: rgb(245, 240, 234);"></p>
   </div>
 </div>
</span> <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>