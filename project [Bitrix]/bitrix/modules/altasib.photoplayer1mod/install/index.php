<?
#################################################
#   Company developer: ALTASIB                  #
#   Site: http://www.altasib.ru                 #
#   E-mail: dev@altasib.ru                      #
#   Copyright (c) 2006-2011 ALTASIB             #
#################################################
?>
<?
global $MESS;
$PathInstall = str_replace("\\", "/", __FILE__);
$PathInstall = substr($PathInstall, 0, strlen($PathInstall)-strlen("/index.php"));
IncludeModuleLangFile(__FILE__);

Class altasib_photoplayer1mod extends CModule
{
        var $MODULE_ID = "altasib.photoplayer1mod";
        var $MODULE_VERSION;
        var $MODULE_VERSION_DATE;
        var $MODULE_NAME;
        var $MODULE_DESCRIPTION;
        var $MODULE_CSS;
        var $MODULE_GROUP_RIGHTS = "Y";

        function altasib_photoplayer1mod()
        {
                $arModuleVersion = array();
                $path = str_replace("\\", "/", __FILE__);
                $path = substr($path, 0, strlen($path) - strlen("/index.php"));
                include($path."/version.php");
                if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion))
                {
                        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
                        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
                }
                else
                {
                        $this->MODULE_VERSION = $arModuleVersion['VERSION'];
                        $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
                }
                $this->MODULE_NAME = GetMessage("ALTASIB_GALLERY_REG_MODULE_NAME");
                $this->MODULE_DESCRIPTION = GetMessage("ALTASIB_GALLERY_REG_MODULE_DESCRIPTION");
                $this->PARTNER_NAME = "ALTASIB";
                $this->PARTNER_URI = "http://www.altasib.ru/";
        }
        function DoInstall()
        {
                global $APPLICATION;
                $this->InstallFiles();
                RegisterModule("altasib.photoplayer1mod");
                $GLOBALS["errors"] = $this->errors;
                $APPLICATION->IncludeAdminFile(GetMessage("ALTASIB_GALLERY_REG_INSTALL_TITLE"), $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/altasib.photoplayer1mod/install/step.php");
        }
        function DoUninstall()
        {
                global $APPLICATION;
                UnRegisterModule("altasib.photoplayer1mod");
                $this->UnInstallFiles();
                $APPLICATION->IncludeAdminFile(GetMessage("ALTASIB_GALLERY_REG_UNINSTALL_TITLE"), $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/altasib.photoplayer1mod/install/unstep.php");
        }
        function InstallFiles()
        {
                CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/altasib.photoplayer1mod/install/components", $_SERVER["DOCUMENT_ROOT"]."/bitrix/components", true, true);
                CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/altasib.photoplayer1mod/js",$_SERVER["DOCUMENT_ROOT"]."/bitrix/js",true,true);
                return true;
        }
        function UnInstallFiles()
        {
                DeleteDirFilesEx("/bitrix/components/altasib/photoplayer1mod");
                return true;
        }
}
?>
