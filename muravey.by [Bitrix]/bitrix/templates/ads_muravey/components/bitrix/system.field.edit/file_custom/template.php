<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach (GetModuleEvents("main", "system.field.edit.file", true) as $arEvent)
{
	if (ExecuteModuleEventEx($arEvent, array($arResult, $arParams)))
		return;
}

?>
<div class="documents-row">
<?
$postFix = ($arParams["arUserField"]["MULTIPLE"] == "Y" ? "[]" : "");
foreach ($arResult["VALUE"] as $res):
	?>
	<div class="documents-item">
        <?
        $arFile = CFile::GetFileArray($res);
        if($arFile)
        {
	        if(CFile::IsImage($arFile["SRC"], $arFile["CONTENT_TYPE"]))
	        {
                $img = CFile::ResizeImageGet(
                    $arFile, 
                    array(
                       'width' => 160, 
                       'height' => 240
                    ), 
                    BX_RESIZE_IMAGE_PROPORTIONAL, 
                    true, 
                    array()
                );
                ?>
                <img src="<?=$img['src']?>" />
                <?
//		        echo CFile::ShowImage($arFile, 0, 0, null, '', false, 0, 0, 0, !empty($arParams['FILE_URL_TEMPLATE']) ? $arParams['FILE_URL_TEMPLATE'] : '');
	        }
	        else
	        {
		        if($arParams['FILE_URL_TEMPLATE'] <> '')
		        {
			        $src = CComponentEngine::MakePathFromTemplate($arParams['FILE_URL_TEMPLATE'], array('file_id' => $arFile["ID"]));
		        }
		        else
		        {
			        $src = $arFile["SRC"];
		        }
		        echo '<a href="'.htmlspecialcharsbx($src).'">'.htmlspecialcharsbx($arFile["ORIGINAL_NAME"]).'</a> ('.CFile::FormatSize($arFile["FILE_SIZE"]).')';
	        }
        }
        ?>
	</div>
	<?endforeach;?>
    <div class="documents_old" style="display: none;">
        <?
        foreach ($arResult["VALUE"] as $res):
            if (intval($res) > 0):?>
            <input type="hidden" name="UF_DOCUMENT_old_id[]" value="<?=$res?>" />
            <input type="file" style="display: none;" name="UF_DOCUMENT[]" value="" />
            <input type="checkbox" style="display: none;" value="994" name="UF_DOCUMENT_del[]" id="UF_DOCUMENT_del[]">
            <?endif?>
        <?endforeach?>
    </div>
           
    <a class="add-document modalbox" href="#add-document"><img src="<?=SITE_TEMPLATE_PATH?>/img/add-big.png" alt="">Добавить документ</a>
</div>
<div class="clear"></div>