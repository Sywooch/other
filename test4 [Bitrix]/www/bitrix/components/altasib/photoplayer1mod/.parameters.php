<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
        return;
if(!CModule::IncludeModule("fileman"))
        return;

CMedialib::Init();?>
<div style="background-color: #fff; padding: 0; border-top: 1px solid #8E8E8E; border-bottom: 1px solid #8E8E8E;  margin-bottom: 15px;"><div style="background-color: #8E8E8E; height: 30px; padding: 7px; border: 1px solid #fff">
        <a href="http://www.is-market.ru?param=cl" target="_blank"><img src="/bitrix/components/altasib/photoplayer1mod/images/is-market.gif" style="float: left; margin-right: 15px;" border="0" /></a>
        <div style="margin: 13px 0px 0px 0px">
                <a href="http://www.is-market.ru?param=cl" target="_blank" style="color: #fff; font-size: 10px; text-decoration: none"><?=GetMessage("ALTASIB_IS")?></a>
        </div>
</div></div>
<?
$arSources[0] = GetMessage("SOURCE_IB");
$arSources[1] = GetMessage("SOURCE_MEDIA");

$rsIBlockType = CIBlockType::GetList(array("sort"=>"asc"), array("ACTIVE"=>"Y"));
while ($arr=$rsIBlockType->Fetch())
{
        if($ar=CIBlockType::GetByIDLang($arr["ID"], LANGUAGE_ID))
                $arIBlockType[$arr["ID"]] = "[".$arr["ID"]."] ".$ar["NAME"];
}

$rsIBlock = CIBlock::GetList(Array("sort" => "asc"), Array("TYPE" => $arCurrentValues["IBLOCK_TYPE"], "ACTIVE"=>"Y"));
while($arr=$rsIBlock->Fetch())
        $arIBlock[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];

$rsSection = CIBlockSection::GetList(Array("sort" => "asc"), Array("IBLOCK_ID" => $arCurrentValues["IBLOCK_ID"], "ACTIVE"=>"Y"));
$arSections[] = "";
while($arr=$rsSection->Fetch())
        $arSections[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];

$arCollections[0] = GetMessage("SELECT_COLLECTION");
$Params['arFilter']["PARENT_ID"] = 0;
$rsCollections = CMedialibCollection::GetList($Params);
foreach($rsCollections as $arr)
{
    $arCollections[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];
}
$rsCollections1 = array();
$arCollections1 = array();
for($i=0; $i<11; $i++)
{
    if(isset($arCurrentValues["COLLECTION_ID_".$i]) && ($arCurrentValues["COLLECTION_ID_".$i] > 0))
    {
        $arCollections1[$i+1][0] = GetMessage("SELECT_COLLECTION");
        $Params['arFilter']["PARENT_ID"] = $arCurrentValues["COLLECTION_ID_".$i];
        $rsCollections1[$i+1] = CMedialibCollection::GetList($Params);
        foreach($rsCollections1[$i+1] as $arr)
            $arCollections1[$i+1][$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];
    }
}

/*$arProperty_S["NONE"] = "";
$rsProp = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$arCurrentValues["IBLOCK_ID"]));
while ($arr=$rsProp->Fetch())
{
        $arProperty[$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
        if(in_array($arr["PROPERTY_TYPE"], array("S")))
        {
                $arProperty_S[$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
        }
} */
$arProperty_P["NONE"] = "";
$arProperty_P["DETAIL_PICTURE"] = "[DETAIL_PICTURE]";
$arProperty_P["PREVIEW_PICTURE"] = "[PREVIEW_PICTURE]";
$rsProp_P = CIBlockProperty::GetList(Array("sort"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$arCurrentValues["IBLOCK_ID"]));
while ($arr=$rsProp_P->Fetch())
{
        if(in_array($arr["PROPERTY_TYPE"], array("F")))
        {
                $arProperty_P[$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
        }
}

//for text
$arProperty_T["NONE"] = "";
$arProperty_T["DETAIL_TEXT"] = "[DETAIL_TEXT]";
$arProperty_T["PREVIEW_TEXT"] = "[PREVIEW_TEXT]";

$rsProp_T = CIBlockProperty::GetList(Array("sort"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$arCurrentValues["IBLOCK_ID"]));
while ($arr=$rsProp_T->Fetch())
{
        if(in_array($arr["PROPERTY_TYPE"], array("T")))
        {
                $arProperty_T[$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
        }
}

$arWrap = Array(
         "WRAP_NO"      => GetMessage("WRAP_NO"),
         "WRAP_BOTH"    => GetMessage("WRAP_BOTH")
         );
$arAinmationTypes = Array(
        "fade"      =>      "fade",
        "slide"      =>      "slide"
        );
$arSlideShowTypes = Array(
        "sequence"      =>      "sequence",
        "random"      =>      "random",
        "random_start"      =>      "random_start"
        );

$arComponentParameters = array(
        "GROUPS" => array(
              "APPEARANCE" => array(
                 "NAME" => GetMessage("APPEARANCE"),
                 "SORT" => "110",
           ),
            "DATA_SOURCE1" => array(
                "NAME" => GetMessage("DATA_SOURCE1"),
                "SORT" => "5"
            ),
        ),
        "PARAMETERS" => array(
                "SOURCE" => array(
                        "PARENT" => "DATA_SOURCE1",
                        "NAME" => GetMessage("SOURCE"),
                        "TYPE" => "LIST",
                        "ADDITIONAL_VALUES" => "N",
                        "VALUES" => $arSources,
                        "REFRESH" => "Y",
                        "DEFAULT" => 0,
                ),
/*                "BANNER_ID" => array(
                        "PARENT" => "BASE",
                        "NAME" => GetMessage("BANNER_ID"),
                        "TYPE" => "STRING",
                        "DEFAULT" => 'photoplayer1mod',
                ),*/
/*                "URL_PROPERTY" => array(
                        "PARENT" => "DATA_SOURCE",
                        "NAME" => GetMessage("URL_PROPERTY"),
                        "TYPE" => "LIST",
                        "VALUES" => $arProperty_S,
                        "REFRESH" => "N",
                ),*/
//for text
                "WRAP" => array(
                        "PARENT" => "BASE",
                        "NAME" => GetMessage("WRAP"),
                        "TYPE" => "LIST",
                        "VALUES" => $arWrap,
                        "DEFAULT" => "WRAP_BOTH",
                        "REFRESH" => "N",
                ),
                'COUNT_EL' => array(
                        'PARENT' => 'BASE',
                        'NAME' => GetMessage('COUNT_EL'),
                        'TYPE' => 'STRING',
                        'DEFAULT' => '10',
                        "COLS" => "4"
                ),
                "SHOW_RANDOM" => array(
                        "PARENT" => "BASE",
                        "NAME" => GetMessage("SHOW_RANDOM"),
                        "TYPE" => "CHECKBOX",
                        "VALUE" => "Y",
                ),
                "CLEAR_RESIZE_IMG" => array(
                        "PARENT" => "APPEARANCE",
                        "NAME" => GetMessage("CLEAR_RESIZE_IMG"),
                        "TYPE" => "CHECKBOX",
                        "VALUE" => "N",
                ),
                "ALLX" => array(
                        "PARENT" => "APPEARANCE",
                        "NAME" => GetMessage("ALLX"),
                        "TYPE" => "STRING",
                        "DEFAULT" => "10",
                        "COLS" => "4"
                ),
                "ALLY" => array(
                        "PARENT" => "APPEARANCE",
                        "NAME" => GetMessage("ALLY"),
                        "TYPE" => "STRING",
                        "DEFAULT" => "10",
                        "COLS" => "4"
                ),
/*                "BIGPICX" => array(
                        "PARENT" => "APPEARANCE",
                        "NAME" => GetMessage("BIGPICX"),
                        "TYPE" => "STRING",
                        "DEFAULT" => "630",
                        "COLS" => "4"
                ),*/
                "BIGPICY" => array(
                        "PARENT" => "APPEARANCE",
                        "NAME" => GetMessage("BIGPICY"),
                        "TYPE" => "STRING",
                        "DEFAULT" => "375",
                        "COLS" => "4"
                ),
                "PREVPICX" => array(
                        "PARENT" => "APPEARANCE",
                        "NAME" => GetMessage("PREVPICX"),
                        "TYPE" => "STRING",
                        "DEFAULT" => "112",
                        "COLS" => "3",
                ),
                "PREVPICY" => array(
                        "PARENT" => "APPEARANCE",
                        "NAME" => GetMessage("PREVPICY"),
                        "TYPE" => "STRING",
                        "DEFAULT" => "90",
                        "COLS" => "3",
                ),
                "INTERVAL" => array(
                        "PARENT" => "APPEARANCE",
                        "NAME" => GetMessage("INTERVALX"),
                        "TYPE" => "STRING",
                        "DEFAULT" => "15",
                        "COLS" => "3"
                ),
                "PREVPIC_NUM" => array(
                        "PARENT" => "APPEARANCE",
                        "NAME" => GetMessage("PREVPIC_NUM"),
                        "TYPE" => "STRING",
                        "DEFAULT" => "5",
                        "COLS" => "2"
                ),
                "DISCR_HEIGHT" => array(
                        "PARENT" => "APPEARANCE",
                        "NAME" => GetMessage("DISCR_HEIGHT"),
                        "TYPE" => "STRING",
                        "DEFAULT" => "87",
                        "COLS" => "3"
                ),
                "DISCR_TITLE_SIZE" => array(
                        "PARENT" => "APPEARANCE",
                        "NAME" => GetMessage("DISCR_TITLE_SIZE"),
                        "TYPE" => "STRING",
                        "DEFAULT" => "14",
                        "COLS" => "2"
                ),
                "DISCR_TEXT_SIZE" => array(
                        "PARENT" => "APPEARANCE",
                        "NAME" => GetMessage("DISCR_TEXT_SIZE"),
                        "TYPE" => "STRING",
                        "DEFAULT" => "12",
                        "COLS" => "2"
                ),
                "SHOW_FANCYBOX" => array(
                        "PARENT" => "APPEARANCE",
                        "NAME" => GetMessage("SHOW_FANCYBOX"),
                        "TYPE" => "CHECKBOX",
                        "VALUE" => "Y",
                ),
                "ANIMATION_TYPE" => array(
                        "PARENT" => "BASE",
                        "NAME" => GetMessage("ANIMATION_TYPE"),
                        "TYPE" => "LIST",
                        "VALUES" => $arAinmationTypes,
                        "REFRESH" => "N",
                ),
                "SPEED" => array(
                        "PARENT" => "BASE",
                        "NAME" => GetMessage("SPEED"),
                        "TYPE" => "STRING",
                        "DEFAULT" => '600',
                        "COLS" => "4"
                ),
                "CACHE_TIME"  =>  Array("DEFAULT"=>3600),
        ),
);

$arComponentParameters["PARAMETERS"]["SHOW_BUTTONS"] = array(
                        "PARENT" => "BASE",
                        "NAME" => GetMessage("SHOW_BUTTONS"),
                        "TYPE" => "CHECKBOX",
                        "DEFAULT" => "Y",
                        "REFRESH" => "Y",
);

if($arCurrentValues["SHOW_BUTTONS"] == "Y")
{
    $arComponentParameters["PARAMETERS"]["SHOW_AUTO"] = array(
                        "PARENT" => "BASE",
                        "NAME" => GetMessage("SHOW_AUTO"),
                        "TYPE" => "CHECKBOX",
                        "DEFAULT" => "Y",
                        "REFRESH" => "Y",
                );
}
else
    $arCurrentValues["SHOW_AUTO"] = "N";

if($arCurrentValues["SHOW_AUTO"] == "Y")
{
    $arComponentParameters["PARAMETERS"]["TIMEOUT"] = array(
                        "PARENT" => "BASE",
                        "NAME" => GetMessage("TIMEOUT"),
                        "TYPE" => "STRING",
                        "DEFAULT" => '2',
                        "COLS" => "3"
                    );
    $arComponentParameters["PARAMETERS"]["AUTOSTART"] = array(
                        "PARENT" => "BASE",
                        "NAME" => GetMessage("AUTOSTART"),
                        "TYPE" => "CHECKBOX",
                        "VALUE" => "N",
                    );
}
if($arCurrentValues["SOURCE"] == 0)
{
                $arComponentParameters["PARAMETERS"]["IBLOCK_TYPE"] = array(
                        "PARENT" => "DATA_SOURCE1",
                        "NAME" => GetMessage("IBLOCK_TYPE"),
                        "TYPE" => "LIST",
                        "ADDITIONAL_VALUES" => "Y",
                        "VALUES" => $arIBlockType,
                        "REFRESH" => "Y",
                );
                $arComponentParameters["PARAMETERS"]["IBLOCK_ID"] = array(
                        "PARENT" => "DATA_SOURCE1",
                        "NAME" => GetMessage("IBLOCK_IBLOCK"),
                        "TYPE" => "LIST",
                        "ADDITIONAL_VALUES" => "Y",
                        "VALUES" => $arIBlock,
                        "REFRESH" => "Y",
                );
                $arComponentParameters["PARAMETERS"]["SECTION_ID"] = array(
                        "PARENT" => "DATA_SOURCE1",
                        "NAME" => GetMessage("IBLOCK_SECTION"),
                        "TYPE" => "LIST",
                        "VALUES" => $arSections,
                        "REFRESH" => "Y",
                );
                $arComponentParameters["PARAMETERS"]["ELEMENTS_ID"] = array(
                        "PARENT" => "DATA_SOURCE1",
                        "NAME" => GetMessage("IBLOCK_ELEMENTS"),
                        "TYPE" => "STRING",
                        "DEFAULT" => '',
                );
                $arComponentParameters["PARAMETERS"]["DETAIL_PICT_PROPERTY"] = array(
                        "PARENT" => "DATA_SOURCE1",
                        "NAME" => GetMessage("DETAIL_PICT_PROPERTY"),
                        "TYPE" => "LIST",
                        "VALUES" => $arProperty_P,
                        "DEFAULT" => "DETAIL_PICTURE",
                        "REFRESH" => "N",
                );
                $arComponentParameters["PARAMETERS"]["TEXT_PROPERTY"] = array(
                        "PARENT" => "DATA_SOURCE1",
                        "NAME" => GetMessage("TEXT_PROPERTY"),
                        "TYPE" => "LIST",
                        "VALUES" => $arProperty_T,
                        "DEFAULT" => "PREVIEW_TEXT",
                        "REFRESH" => "N",
                );
                $arComponentParameters["PARAMETERS"]["DETAIL_PICT_RESIZE"] = array(
                        "PARENT" => "DATA_SOURCE1",
                        "NAME" => GetMessage("DETAIL_PICT_RESIZE"),
                        "TYPE" => "CHECKBOX",
                        "DEFAULT" => "Y",
                );
                $arComponentParameters["PARAMETERS"]["PREVIEW_PICT_RESIZE"] = array(
                        "PARENT" => "DATA_SOURCE1",
                        "NAME" => GetMessage("PREVIEW_PICT_RESIZE"),
                        "TYPE" => "CHECKBOX",
                        "DEFAULT" => "Y",
                );
}
else
{
                $arComponentParameters["PARAMETERS"]["COLLECTION_ID_0"] = array(
                        "PARENT" => "DATA_SOURCE1",
                        "NAME" => GetMessage("COLLECTION"),
                        "TYPE" => "LIST",
                        "VALUES" => $arCollections,
                        "REFRESH" => "Y",
                );
                if($arCurrentValues["COLLECTION_ID_0"] > 0)
                {
                    for($i=1; $i<11; $i++)
                    {
                        if(is_array($arCollections1[$i]) && (count($arCollections1[$i]) > 1))
                            $arComponentParameters["PARAMETERS"]["COLLECTION_ID_".$i] = array(
                                    "PARENT" => "DATA_SOURCE1",
                                    "NAME" => GetMessage("COLLECTION1"),
                                    "TYPE" => "LIST",
                                    "VALUES" => $arCollections1[$i],
                                    "REFRESH" => "Y",
                            );
                    }
                }
                $arComponentParameters["PARAMETERS"]["DETAIL_PICT_RESIZE"] = array(
                        "PARENT" => "DATA_SOURCE1",
                        "NAME" => GetMessage("DETAIL_PICT_RESIZE"),
                        "TYPE" => "CHECKBOX",
                        "DEFAULT" => "Y",
                );
                $arComponentParameters["PARAMETERS"]["PREVIEW_PICT_RESIZE"] = array(
                        "PARENT" => "DATA_SOURCE1",
                        "NAME" => GetMessage("PREVIEW_PICT_RESIZE"),
                        "TYPE" => "CHECKBOX",
                        "DEFAULT" => "Y",
                );
}
?>
