<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(
	$arParams["arUserField"]["ENTITY_VALUE_ID"] <= 0
	&& $arParams["arUserField"]["SETTINGS"]["DEFAULT_VALUE"] > 0
)
{
	$arResult['VALUE'] = array($arParams["arUserField"]["SETTINGS"]["DEFAULT_VALUE"]);
}
else
{
	$arResult['VALUE'] = array_filter($arResult["VALUE"]);
}

if($arParams['arUserField']["SETTINGS"]["DISPLAY"] != "CHECKBOX")
{
	if($arParams["arUserField"]["MULTIPLE"] == "Y")
	{
		?>
		<select id="categories" style="display: none" multiple="multiple" name="<?echo $arParams["arUserField"]["FIELD_NAME"]?>" size="<?echo $arParams["arUserField"]["SETTINGS"]["LIST_HEIGHT"]?>" style="width: 225px;">
		<?
		foreach ($arParams["arUserField"]["USER_TYPE"]["FIELDS"] as $key => $val)
		{
			$bSelected = in_array($key, $arResult["VALUE"]);
			?>
			<option value="<?echo $key?>" <?echo ($bSelected? "selected" : "")?> title="<?echo trim($val, " .")?>"><?echo $val?></option>
			<?
		}
		?>
		</select>
              
        <ul class="order">
        <?
        foreach ($arParams["arUserField"]["USER_TYPE"]["FIELDS"] as $key => $val)
        {
            if ($key > 0)
            {
                $bSelected = in_array($key, $arResult["VALUE"]);
                ?>
                <li data-section_id="<?=$key?>" <?if ($bSelected):?>class="selected"<?endif?>><a href="<?=$arParams['arUserField']['USER_TYPE']['FIELDS_FORMATTED'][$key]['URL']?>" class="<?=$arParams['arUserField']['USER_TYPE']['FIELDS_FORMATTED'][$key]['CSS_CLASS']?> <?if ($bSelected):?>selected<?endif?>"><?=$arParams['arUserField']['USER_TYPE']['FIELDS_FORMATTED'][$key]['NAME']?></a></li>
                <?
            }
        }
        ?>
        </ul>
		<?
	}
}
?>

<script type="text/javascript">
$(document).ready(function()
{
    $('.order li').click(function(e)
    {
        e.preventDefault();
    
        console.log($(this).data('section_id'));
        if ($(this).hasClass('selected'))
        {
            $(this).removeClass('selected');
            $(this).find('a').removeClass('selected');
            $('#categories option[value='+$(this).data('section_id')+']').attr('selected', false).change();
        }
        else
        {
            $(this).addClass('selected');
            $(this).find('a').addClass('selected');
            $('#categories option[value='+$(this).data('section_id')+']').attr('selected', true).change();
        }
        
        return false; 
    });
});
</script>