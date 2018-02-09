<?

if(!is_object($GLOBALS["USER_FIELD_MANAGER"]))
	return false;

CModule::IncludeModule("softeffect.iblockcopy");
IncludeModuleLangFile(__FILE__);

	
	
		$aMenu[] =  array(
					"parent_menu" => "global_menu_content",
					"icon" => "iblock_menu_icon_settings",
					//"section" => "xls_input",
					"sort" => 300,
					"text" =>GetMessage("IBLOCK_MENU_COPI_IB"),
					"title"=>GetMessage("IBLOCK_MENU_COPI_IB_POL"),
					"url" => "upblock.php?lang=".LANG,
					"items_id" => "softeffect.iblockcopy",
					"more_url" => Array("upblock.php"),
         
		);



return $aMenu;



?>


