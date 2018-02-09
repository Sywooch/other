


<!--
               <div class="page-right">
			<div id="left-search">
		<?$APPLICATION->IncludeComponent("bitrix:search.title", ".default", array(
			"NUM_CATEGORIES" => "3",
			"TOP_COUNT" => "5",
			"CHECK_DATES" => "N",
			"SHOW_OTHERS" => "Y",
			"PAGE" => "#SITE_DIR#search/",
			"CATEGORY_0_TITLE" => GetMessage('NEWS_TITLE'),
			"CATEGORY_0" => array(
				0 => "iblock_news",
			),
			"CATEGORY_0_iblock_news" => array(
				0 => "2",
				1 => "3",
			),
			"CATEGORY_1_TITLE" => GetMessage('BLOG_TITLE'),
			"CATEGORY_1" => array(
				0 => "blog",
			),
			"CATEGORY_1_blog" => array(
				0 => "all",
			),
			"CATEGORY_2_TITLE" => GetMessage('JOB_TITLE'),
			"CATEGORY_2" => array(
				0 => "iblock_job",
			),
			"CATEGORY_2_iblock_job" => array(
				0 => "all",
			),
			"CATEGORY_OTHERS_TITLE" => GetMessage('OTHER_TITLE'),
			"SHOW_INPUT" => "Y",
			"INPUT_ID" => "title-search-input",
			"CONTAINER_ID" => "title-search"
			),
			false
		);?>
			</div>
			<div class="hr"></div>

		<?$APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
			"AREA_FILE_SHOW" => "sect",
			"AREA_FILE_SUFFIX" => "btop",
			"AREA_FILE_RECURSIVE" => "Y",
			"EDIT_TEMPLATE" => ""
			),
			false
		);?>
		<?$APPLICATION->ShowViewContent("sidebar")?>	
	<?$APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
			"AREA_FILE_SHOW" => "sect",
			"AREA_FILE_SUFFIX" => "rtop",
			"AREA_FILE_RECURSIVE" => "Y",
			"EDIT_TEMPLATE" => ""
			),
			false
		);?>
		<?$APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
			"AREA_FILE_SHOW" => "sect",
			"AREA_FILE_SUFFIX" => "bbottom",
			"AREA_FILE_RECURSIVE" => "Y",
			"EDIT_TEMPLATE" => ""
			),
			false
		);?>
		
		
		</div>-->
</td>
<!--===========================================================================-->

<td width="260"  style="background-color:transparent; vertical-align: top;">


<?$APPLICATION->IncludeComponent("bitrix:main.include", "template8", array(
	"AREA_FILE_SHOW" => "sect",
	"AREA_FILE_SUFFIX" => "inc2",
	"AREA_FILE_RECURSIVE" => "Y",
	"EDIT_TEMPLATE" => "standard.php"
	),
	false
);?>

<?$APPLICATION->IncludeComponent("bitrix:main.include", "template16", Array(
	"AREA_FILE_SHOW" => "sect",	// Показывать включаемую область
	"AREA_FILE_SUFFIX" => "inc789",	// Суффикс имени файла включаемой области
	"AREA_FILE_RECURSIVE" => "Y",	// Рекурсивное подключение включаемых областей разделов
	"EDIT_TEMPLATE" => "standard.php",	// Шаблон области по умолчанию
	),
	false
);?>

<?$APPLICATION->IncludeComponent("bitrix:main.include", "template8", array(
	"AREA_FILE_SHOW" => "sect",
	"AREA_FILE_SUFFIX" => "inc790",
	"AREA_FILE_RECURSIVE" => "Y",
	"EDIT_TEMPLATE" => "standard.php"
	),
	false
);?>


<?$APPLICATION->IncludeComponent("bitrix:main.include", "template8", array(
	"AREA_FILE_SHOW" => "sect",
	"AREA_FILE_SUFFIX" => "inc791",
	"AREA_FILE_RECURSIVE" => "Y",
	"EDIT_TEMPLATE" => "standard.php"
	),
	false
);?>

<?$APPLICATION->IncludeComponent("bitrix:main.include", "template8", array(
	"AREA_FILE_SHOW" => "sect",
	"AREA_FILE_SUFFIX" => "inc792",
	"AREA_FILE_RECURSIVE" => "Y",
	"EDIT_TEMPLATE" => "standard.php"
	),
	false
);?>

<?$APPLICATION->IncludeComponent("bitrix:main.include", "template8", array(
	"AREA_FILE_SHOW" => "sect",
	"AREA_FILE_SUFFIX" => "inc793",
	"AREA_FILE_RECURSIVE" => "Y",
	"EDIT_TEMPLATE" => "standard.php"
	),
	false
);?>

<?$APPLICATION->IncludeComponent("bitrix:main.include", "template8", array(
	"AREA_FILE_SHOW" => "sect",
	"AREA_FILE_SUFFIX" => "inc794",
	"AREA_FILE_RECURSIVE" => "Y",
	"EDIT_TEMPLATE" => "standard.php"
	),
	false
);?>

<?$APPLICATION->IncludeComponent("bitrix:main.include", "template8", array(
	"AREA_FILE_SHOW" => "sect",
	"AREA_FILE_SUFFIX" => "inc795",
	"AREA_FILE_RECURSIVE" => "Y",
	"EDIT_TEMPLATE" => "standard.php"
	),
	false
);?>

<?$APPLICATION->IncludeComponent("bitrix:main.include", "template8", array(
	"AREA_FILE_SHOW" => "sect",
	"AREA_FILE_SUFFIX" => "inc796",
	"AREA_FILE_RECURSIVE" => "Y",
	"EDIT_TEMPLATE" => "standard.php"
	),
	false
);?>

<?$APPLICATION->IncludeComponent("bitrix:main.include", "template8", array(
	"AREA_FILE_SHOW" => "sect",
	"AREA_FILE_SUFFIX" => "inc797",
	"AREA_FILE_RECURSIVE" => "Y",
	"EDIT_TEMPLATE" => "standard.php"
	),
	false
);?>

<?$APPLICATION->IncludeComponent("bitrix:main.include", "template8", array(
	"AREA_FILE_SHOW" => "sect",
	"AREA_FILE_SUFFIX" => "inc798",
	"AREA_FILE_RECURSIVE" => "Y",
	"EDIT_TEMPLATE" => "standard.php"
	),
	false
);?>





<!-- spare include for banners-->

<?$APPLICATION->IncludeComponent("bitrix:main.include", "template15", Array(
	"AREA_FILE_SHOW" => "sect",	// Показывать включаемую область
	"AREA_FILE_SUFFIX" => "inc35641right",	// Суффикс имени файла включаемой области
	"AREA_FILE_RECURSIVE" => "Y",	// Рекурсивное подключение включаемых областей разделов
	"EDIT_TEMPLATE" => "standard.php",	// Шаблон области по умолчанию
	),
	false
);?>


<?$APPLICATION->IncludeComponent("bitrix:main.include", "template15", Array(
	"AREA_FILE_SHOW" => "sect",	// Показывать включаемую область
	"AREA_FILE_SUFFIX" => "inc35642right",	// Суффикс имени файла включаемой области
	"AREA_FILE_RECURSIVE" => "Y",	// Рекурсивное подключение включаемых областей разделов
	"EDIT_TEMPLATE" => "standard.php",	// Шаблон области по умолчанию
	),
	false
);?>


<?$APPLICATION->IncludeComponent("bitrix:main.include", "template15", Array(
	"AREA_FILE_SHOW" => "sect",	// Показывать включаемую область
	"AREA_FILE_SUFFIX" => "inc35643right",	// Суффикс имени файла включаемой области
	"AREA_FILE_RECURSIVE" => "Y",	// Рекурсивное подключение включаемых областей разделов
	"EDIT_TEMPLATE" => "standard.php",	// Шаблон области по умолчанию
	),
	false
);?>


<?$APPLICATION->IncludeComponent("bitrix:main.include", "template15", Array(
	"AREA_FILE_SHOW" => "sect",	// Показывать включаемую область
	"AREA_FILE_SUFFIX" => "inc35656right",	// Суффикс имени файла включаемой области
	"AREA_FILE_RECURSIVE" => "Y",	// Рекурсивное подключение включаемых областей разделов
	"EDIT_TEMPLATE" => "standard.php",	// Шаблон области по умолчанию
	),
	false
);?>


<?$APPLICATION->IncludeComponent("bitrix:main.include", "template15", Array(
	"AREA_FILE_SHOW" => "sect",	// Показывать включаемую область
	"AREA_FILE_SUFFIX" => "inc35644right",	// Суффикс имени файла включаемой области
	"AREA_FILE_RECURSIVE" => "Y",	// Рекурсивное подключение включаемых областей разделов
	"EDIT_TEMPLATE" => "standard.php",	// Шаблон области по умолчанию
	),
	false
);?>



<!-- spare include for banners-->



<div style="width:100%; height:50px;"></div>

</td>


		
		</tr>
		</table>
		



<!---------------------------------table------------------------------------------------------------------------------------------------------------------------------------------------------------>





	</div><!--page-body-->




</div>

<!---++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->








<!--===============================================-->
<!--footer-->
<div align="center" style="width:100%; height:140px; " class="footer_100">
<div align="left" style="width:1122px; height:140px; " class="footer_100">
<div id="footer-wrapper" style="background-color: transparent; height:140px; width:1122px; border-top:0px;
padding-top:0px; color:white; font-weight:bold;">
	<!--<div class="bottom-menu-one">
	<?$APPLICATION->IncludeComponent("bitrix:menu", "bottom_one", array(
	"ROOT_MENU_TYPE" => "bottom1",
	"MENU_CACHE_TYPE" => "A",
	"MENU_CACHE_TIME" => "36000000",
	"MENU_CACHE_USE_GROUPS" => "N",
	"MENU_CACHE_GET_VARS" => array(
	),
	"MAX_LEVEL" => "1",
	"CHILD_MENU_TYPE" => "left",
	"USE_EXT" => "Y",
	"DELAY" => "N",
	"ALLOW_MULTI_SELECT" => "N",
	"MENU_TITLE" => GetMessage('MENU_1_TITLE')
	),
	false
	);?>
	</div>
	<div class="bottom-menu-two">
	<?$APPLICATION->IncludeComponent("bitrix:menu", "bottom_one", array(
	"ROOT_MENU_TYPE" => "bottom2",
	"MENU_CACHE_TYPE" => "A",
	"MENU_CACHE_TIME" => "36000000",
	"MENU_CACHE_USE_GROUPS" => "N",
	"MENU_CACHE_GET_VARS" => array(
	),
	"MAX_LEVEL" => "1",
	"CHILD_MENU_TYPE" => "left",
	"USE_EXT" => "Y",
	"DELAY" => "N",
	"ALLOW_MULTI_SELECT" => "N",
	"MENU_TITLE" => GetMessage('MENU_2_TITLE')
	),
	false
	);?>
	</div>
	<?$APPLICATION->IncludeComponent("bitrix:menu", "bottom", array(
	"ROOT_MENU_TYPE" => "bottom",
	"MENU_CACHE_TYPE" => "A",
	"MENU_CACHE_TIME" => "36000000",
	"MENU_CACHE_USE_GROUPS" => "N",
	"MENU_CACHE_GET_VARS" => array(
	),
	"MAX_LEVEL" => "1",
	"CHILD_MENU_TYPE" => "left",
	"USE_EXT" => "Y",
	"DELAY" => "N",
	"ALLOW_MULTI_SELECT" => "N",
	),
	false
);?>-->
	<div class="copyright" style="left:0px; color:white; font-size:10px; bottom:30px;">
<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/copyright.php"), false);?><?=GetMessage("FOOTER_DISIGN")?></div>

</div>
</div>
</div>


<script type="text/javascript"> var mkgu_widget_param = { id: 2};</script>
<script type="text/javascript" src="https://vashkontrol.ru/widget2-js/mkgu_widget.js"></script>
</body>
</html>