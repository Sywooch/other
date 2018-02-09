<?
IncludeModuleLangFile(__FILE__);
Class itlogic_bxslider extends CModule
{
	const MODULE_ID = 'itlogic.bxslider';
	var $MODULE_ID = 'itlogic.bxslider'; 
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME;
	var $MODULE_DESCRIPTION;
	var $MODULE_CSS;
	var $strError = '';

	function __construct()
	{
		$arModuleVersion = array();
		include(dirname(__FILE__)."/version.php");
		$this->MODULE_VERSION = $arModuleVersion["VERSION"];
		$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
		$this->MODULE_NAME = GetMessage("itlogic.bxslider_MODULE_NAME");
		$this->MODULE_DESCRIPTION = GetMessage("itlogic.bxslider_MODULE_DESC");

		$this->PARTNER_NAME = GetMessage("itlogic.bxslider_PARTNER_NAME");
		$this->PARTNER_URI = GetMessage("itlogic.bxslider_PARTNER_URI");
	}

	function InstallDB($arParams = array())
	{
		RegisterModuleDependences('main', 'OnBuildGlobalMenu', self::MODULE_ID, 'CItlogicBxslider', 'OnBuildGlobalMenu');
		return true;
	}

	function UnInstallDB($arParams = array())
	{
		UnRegisterModuleDependences('main', 'OnBuildGlobalMenu', self::MODULE_ID, 'CItlogicBxslider', 'OnBuildGlobalMenu');
		return true;
	}

	function InstallEvents()
	{
		return true;
	}

	function UnInstallEvents()
	{
		return true;
	}
	
	function InstallIblockType()
	{
		global $DB;
		CModule::IncludeModule("iblock");
		$arFields = Array(
			'ID'=>'itlogicbxslider',
			'SECTIONS'=>'Y',
			'IN_RSS'=>'N',
			'SORT'=>100,
			'LANG'=>Array(
				'en'=>Array(
					'NAME'=>'BxSlider',
					'SECTION_NAME'=>'Sections',
					'ELEMENT_NAME'=>'Products'
				),
				'ru'=>Array(
					'NAME'=>'BxSlider',
					'SECTION_NAME'=>'Sections',
					'ELEMENT_NAME'=>'Products'
				)
			)
		);
		$obBlocktype = new CIBlockType;
		$DB->StartTransaction();
		$res = $obBlocktype->Add($arFields);
		if(!$res)
		{
			$DB->Rollback();
			echo 'Error: '.$obBlocktype->LAST_ERROR.'<br>';
		}
		else
			$DB->Commit();
	}
	
	function UnInstallIblockType()
	{
		if(!CIBlockType::Delete('itlogicbxslider'))
		{
			return false;
		}
	}
	
	function InstallIblock()
	{
		CModule::IncludeModule("iblock");
		$ib = new CIBlock;
		$arFields = Array(
			"ACTIVE" => "Y",
			"NAME" => "BxSliderITLOGIC",
			"IBLOCK_TYPE_ID" => 'itlogicbxslider',
			"SITE_ID" => Array("ru", "en", "de"),
			"SORT" => 500,
			"GROUP_ID" => Array("2"=>"R")
		);
		$ID = $ib->Add($arFields);
		COption::SetOptionString("itlogic.bxslider","IBLOCK_ID",$ID);
		$arFields = Array(
		  "NAME" => "HREF",
		  "ACTIVE" => "Y",
		  "SORT" => "100",
		  "CODE" => "HREF",
		  "PROPERTY_TYPE" => "S",
		  "IBLOCK_ID" => $ID
		  );		
		$ibp = new CIBlockProperty;
		$PropID = $ibp->Add($arFields);
	}

	
	function InstallFiles($arParams = array())
	{
		if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/admin'))
		{
			if ($dir = opendir($p))
			{
				while (false !== $item = readdir($dir))
				{
					if ($item == '..' || $item == '.' || $item == 'menu.php')
						continue;
					file_put_contents($file = $_SERVER['DOCUMENT_ROOT'].'/bitrix/admin/'.self::MODULE_ID.'_'.$item,
					'<'.'? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/'.self::MODULE_ID.'/admin/'.$item.'");?'.'>');
				}
				closedir($dir);
			}
		}
		if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/install/components'))
		{
			if ($dir = opendir($p))
			{
				while (false !== $item = readdir($dir))
				{
					if ($item == '..' || $item == '.')
						continue;
					CopyDirFiles($p.'/'.$item, $_SERVER['DOCUMENT_ROOT'].'/bitrix/components/'.$item, $ReWrite = True, $Recursive = True);
				}
				closedir($dir);
			}
		}
		return true;
	}

	function UnInstallFiles()
	{
		if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/admin'))
		{
			if ($dir = opendir($p))
			{
				while (false !== $item = readdir($dir))
				{
					if ($item == '..' || $item == '.')
						continue;
					unlink($_SERVER['DOCUMENT_ROOT'].'/bitrix/admin/'.self::MODULE_ID.'_'.$item);
				}
				closedir($dir);
			}
		}
		if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/install/components'))
		{
			if ($dir = opendir($p))
			{
				while (false !== $item = readdir($dir))
				{
					if ($item == '..' || $item == '.' || !is_dir($p0 = $p.'/'.$item))
						continue;

					$dir0 = opendir($p0);
					while (false !== $item0 = readdir($dir0))
					{
						if ($item0 == '..' || $item0 == '.')
							continue;
						DeleteDirFilesEx('/bitrix/components/'.$item.'/'.$item0);
					}
					closedir($dir0);
				}
				closedir($dir);
			}
		}
		return true;
	}

	function DoInstall()
	{
		global $APPLICATION;
		$this->InstallFiles();
		$this->InstallDB();
		$this->InstallIblockType();
		$this->InstallIblock();
		RegisterModule(self::MODULE_ID);
	}

	function DoUninstall()
	{
		global $APPLICATION;
		UnRegisterModule(self::MODULE_ID);
		$this->UnInstallIblockType();
		$this->UnInstallDB();
		$this->UnInstallFiles();
	}
}
?>
