<div align="center" style="width:100%; height:70px; ">
<a href="/clinika/diagnostika/sotrudniki/index.php" alt="">
<div align="center" style="width:150px; height: 70px;">

	<table style="margin:0; border:0; padding:0;  vertical-align:middle;">
    <tr>
		<td align="left" style="width:80px;height:70px; margin:0; border:0; padding:0; vertical-align:middle; background-color:transparent;"><img src="/images/nazad2.png" alt="" width="60" height="50"/></td><td align="left" style="width:150px; height:70px; margin:0; border:0; padding:0; vertical-align:middle;">

			<span style="font-family: Verdana, Arial, Helvetica, sans-serif; 
color:#656565; font-size:12pt;"><strong>���������</strong></span>

	</td>
	</tr>
	</table>
	</div>
</a>

</div>

<!--menu-->
 <?$APPLICATION->IncludeComponent("bitrix:menu", "left2", Array(
	"ROOT_MENU_TYPE" => "klinikadiagnostika",	// ��� ���� ��� ������� ������
	"MENU_CACHE_TYPE" => "A",	// ��� �����������
	"MENU_CACHE_TIME" => "36000000",	// ����� ����������� (���.)
	"MENU_CACHE_USE_GROUPS" => "Y",	// ��������� ����� �������
	"MENU_CACHE_GET_VARS" => "",	// �������� ���������� �������
	"MAX_LEVEL" => "1",	// ������� ����������� ����
	"CHILD_MENU_TYPE" => "klinikadiagnostika",	// ��� ���� ��� ��������� �������
	"USE_EXT" => "Y",	// ���������� ����� � ������� ���� .���_����.menu_ext.php
	"DELAY" => "N",	// ����������� ���������� ������� ����
	"ALLOW_MULTI_SELECT" => "N",	// ��������� ��������� �������� ������� ������������
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "Y"
	)
);?> 
<!--menu-->