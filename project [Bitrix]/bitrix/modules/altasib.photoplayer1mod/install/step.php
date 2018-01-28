<?
#################################################
#   Company developer: ALTASIB                  #
#   Site: http://www.altasib.ru                 #
#   E-mail: dev@altasib.ru                      #
#   Copyright (c) 2006-2011 ALTASIB             #
#################################################
?>
<?IncludeModuleLangFile(__FILE__);?>
<?echo CAdminMessage::ShowNote(GetMessage("ALTASIB_GALLERY_INSTALL_COMPLETE_OK"));?>
<form action="<?echo $APPLICATION->GetCurPage()?>">
        <input type="hidden" name="lang" value="<?echo LANG?>">
        <input type="submit" name="" value="<?echo GetMessage("ALTASIB_GALLERY_INSTALL_BACK")?>">
<form>
