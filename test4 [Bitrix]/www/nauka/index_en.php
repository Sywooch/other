<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("�����");
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
  <h4 style="font-weight: bold; font-size: 11px; line-height: normal; font-family: Verdana; text-transform: uppercase; text-align: center; background-color: rgb(245, 240, 234);">�������� ����������� ������� ������</h4>

  <p style="text-align: justify; font-family: Verdana; font-size: 11px; background-color: rgb(245, 240, 234);"></p>

  <ul style="list-style: url(http://z203712.infobox.ru/images/styles/default/menu_item_orange.png); font-family: Verdana; font-size: 11px; text-align: justify; background-color: rgb(245, 240, 234);">
    <li>���������� ���������-���������������� � ����������� ������� ������������������� ������� � ����������� � ������� ������� � ����������, ���������� � ����������, � ����� � ������� ����������� ������-����������� � ����������������� �����������</li>
  
    <li>���������� ������-��������������� ������� � ��������, ������� ������� ������������ � ������� ����������� ���������� � ����������������</li>
  
    <li>���������� ������ � ����� ����������� ������������������ ������� ������������ � ������� �� �������������</li>
  
    <li>���������� ������� ����� ����������� ���������������, �������������������� � ��������������� ������ ���������, ������� ����������� ����������� ������ ������������ �������� � ����� � �������� ����� ���������</li>
  
    <li></li>
  </ul>

  <p style="text-align: justify; font-family: Verdana; font-size: 11px; background-color: rgb(245, 240, 234);"></p>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>