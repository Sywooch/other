<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if (!function_exists("altasib_resize_img"))
{
    function altasib_resize_img ($img_src_path, $folder, $filename, $prefix, $width, $height, $zoom, $quality, $cut, $waterPath='', $x_water=20, $y_water=20)
    {
            $arrTypes = array(
                   0 => "GIF", 1 => "JPG", 2 => "PNG", 3 => "SWF", 4 => "PSD", 5 => "BMP", 6 => "TIFF_II", 7 => "TIFF_MM",
                   8 => "JPC", 9 => "JP2", 10 => "JPX", 11 => "JB2", 12 => "SWC", 13 => "IFF", 14 => "WBMP", 15 => "XBMP"
            );

            $img_attr = getimagesize($img_src_path);
            $width_orig = $img_attr[0];
            $height_orig = $img_attr[1];

            $img_type = $img_attr[2];
            $img_type = $arrTypes[$img_type-1];
            $img_size = $img_attr[3];

            if($img_type == "JPG")
            {
                $img_bits = $img_attr['bits'];
                $img_channels = $img_attr['channels'];
            }
            $img_mime = $img_attr['mime'];

            if ($cut!="Y")
            {
                if ($height!="")
                {
                    $crop = $height / $height_orig;
                    $height_dest = $height;
                    $width_dest = $width_orig * $crop;
                }
                if ($width!="")
                {
                    $crop = $width / $width_orig;
                    $width_dest = $width;
                    $height_dest = $height_orig * $crop;
                    if(($height!="") && ($height_dest > $height))
                    {
                        $crop = $height / $height_dest;
                        $height_dest = $height;
                        $width_dest = $width_dest * $crop;
                    }
                }
            }
            else
            {
                if ($height!="")
                {
                    $crop = $height / $height_orig;
                    $height_dest = $height;
                    $width_dest = $width_orig * $crop;
                }
                if ($width!="")
                {
                    $crop = $width / $width_orig;
                    $width_dest = $width;
                    $height_dest = $height_orig * $crop;
                    if(($height!="") && ($height_dest < $height))
                    {
                        $crop = $height / $height_orig;
                        $height_dest = $height;
                        $width_dest = $width_orig * $crop;
                    }
                }
            }

            if((($width_orig > $width)||($height_orig > $height))||($zoom!="") || (strlen($waterPath)>0))
            {
                if ($cut!="Y")
                    $img_dest = imagecreatetruecolor($width_dest, $height_dest) or die("Cannot Initialize new GD image stream");
                else
                    $img_dest = imagecreatetruecolor($width, $height) or die("Cannot Initialize new GD image stream");

                $bg = imagecolorallocate($img_dest, 255, 255, 255);

                if($img_type == "JPG")
                    $img_orig = imagecreatefromjpeg($img_src_path);
                elseif($img_type == "GIF")
                    $img_orig = imagecreatefromgif($img_src_path);
                elseif($img_type == "PNG")
                    $img_orig = imagecreatefrompng($img_src_path);
                elseif($img_type == "WBMP")
                    $img_orig = imagecreatefromwbmp($img_src_path);

                if ($cut!="Y")
                    imagecopyresampled($img_dest, $img_orig, 0, 0, 0, 0, $width_dest, $height_dest, $width_orig, $height_orig);
                else
                    imagecopyresampled($img_dest, $img_orig, -($width_dest-$width)/2, -($height_dest-$height)/2, 0, 0, $width_dest, $height_dest, $width_orig, $height_orig);
                if(strlen($waterPath)>0)
                {
                    $arwater_img = getimagesize($waterPath);
                    $water_width = $arwater_img[0];
                    $water_height = $arwater_img[1];
                    $water_img_type = $arwater_img[2];
                    $water_img_type = $arwater_img[$water_img_type-1];
                    $water_img_size = $arwater_img[3];
                    $water_img = imagecreatefrompng($waterPath);
                    $wbg = imagecolorallocate($water_img, 255, 255, 255);
                    imagecopy ($img_dest, $water_img, $x_water, $y_water, 0, 0, $water_width, $water_height);
                }
                $new_img_path = $folder."/".$prefix.$filename;

                if($img_type == "JPG")
                    if (function_exists("imagejpeg"))
                        imagejpeg($img_dest, $new_img_path, $quality);
                if($img_type == "GIF")
                    if (function_exists("imagegif"))
                        imagegif($img_dest, $new_img_path);
                if($img_type == "PNG")
                    if (function_exists("imagepng"))
                        imagepng($img_dest, $new_img_path);
                if($img_type == "WBMP")
                    if (function_exists("imagewbmp"))
                        imagewbmp($img_dest, $new_img_path);

                imagedestroy($img_dest);
                imagedestroy($img_orig);

                return $new_img_path;
            }
            else
                return $img_src_path;
    }
}
$COLLECTION_ID = 0;
$source = "ib";
$arResult["SOURCE"] = "SRC";
if($arParams["SOURCE"] == 0)
{
    $arParams["IBLOCK_ID"] = intval($arParams["IBLOCK_ID"]);
    $arParams["SECTION_ID"] = intval($arParams["SECTION_ID"]);
    $arParams["ELEMENTS_ID"] = intval($arParams["ELEMENTS_ID"]);
}
else
{
    for($i=0; $i<11; $i++)
        if(isset($arParams["COLLECTION_ID_".$i]) && ($arParams["COLLECTION_ID_".$i] > 0))
        {
            $arParams["COLLECTION_ID_".$i] = intval($arParams["COLLECTION_ID_".$i]);
            $COLLECTION_ID = $arParams["COLLECTION_ID_".$i];
        }
    $source = "ml";
    $arResult["SOURCE"] = "PATH";
}

$arParams["COUNT_EL"] = intval($arParams["COUNT_EL"]);
if($arParams["COUNT_EL"]<1) $arParams["COUNT_EL"] = 0;

$arParams["SLIDE_TYPE"] = trim($arParams["SLIDE_TYPE"]);
if(strlen($arParams["SLIDE_TYPE"])<=0)
        $arParams["SLIDE_TYPE"] = "random";

$arParams["ANIMATION_TYPE"] = trim($arParams["ANIMATION_TYPE"]);
if(strlen($arParams["ANIMATION_TYPE"])<=0)
        $arParams["ANIMATION_TYPE"] = "slide";

$arParams["SPEED"] = intval($arParams["SPEED"]);
if(strlen($arParams["SPEED"])<=0)
        $arParams["SPEED"] = 750;

$arParams["TIMEOUT"] = intval($arParams["TIMEOUT"]);
if(strlen($arParams["TIMEOUT"])<=0)
        $arParams["TIMEOUT"] = 2;

$arParams["LOGO_PATH"] = trim(htmlspecialchars($arParams["LOGO_PATH"]));

$arParams["PREVPICX"] = intval($arParams["PREVPICX"]);
$arParams["PREVPICY"] = intval($arParams["PREVPICY"]);
//$arParams["BIGPICX"] = intval($arParams["BIGPICX"]);
$arParams["BIGPICY"] = intval($arParams["BIGPICY"]);
$arParams["ALLX"] = intval($arParams["ALLX"]);
$arParams["ALLY"] = intval($arParams["ALLY"]);
$arParams["INTERVAL"] = intval($arParams["INTERVAL"]);
$arParams["PREVPIC_NUM"] = intval($arParams["PREVPIC_NUM"]);
$arParams["BIGPICX"] = ($arParams["PREVPICX"] + 2) * $arParams["PREVPIC_NUM"] + $arParams["INTERVAL"] * $arParams["PREVPIC_NUM"] - $arParams["INTERVAL"];
$arParams["DISCR_HEIGHT"] = intval($arParams["DISCR_HEIGHT"]);
$arParams["DISCR_TEXT_SIZE"] = intval($arParams["DISCR_TEXT_SIZE"]);
$arParams["DISCR_TITLE_SIZE"] = intval($arParams["DISCR_TITLE_SIZE"]);

$PICT = "";
$TEXT = "";
if(isset($arParams["DETAIL_PICT_PROPERTY"]))
    switch ($arParams["DETAIL_PICT_PROPERTY"])
    {
        case "NONE":
            $PICT = "";
            $DETAIL_PICT_PROPERTY = "";
            break;
        case "DETAIL_PICTURE":
            $PICT = "DETAIL_PICTURE";
            $DETAIL_PICT_PROPERTY = "DETAIL_PICTURE";
            break;
        case "PREVIEW_PICTURE":
            $PICT = "PREVIEW_PICTURE";
            $DETAIL_PICT_PROPERTY = "PREVIEW_PICTURE";
            break;
        default:
            $PICT = "PROPERTY_".$arParams["DETAIL_PICT_PROPERTY"]."_VALUE";
            $DETAIL_PICT_PROPERTY = "PROPERTY_".$arParams["DETAIL_PICT_PROPERTY"];
            break;
    }

if(isset($arParams["TEXT_PROPERTY"]))
    //for text
    switch ($arParams["TEXT_PROPERTY"])
    {
        case "NONE":
            $TEXT = "";
            $TEXT_PROPERTY = "";
            break;
        case "DETAIL_TEXT":
            $TEXT = "DETAIL_TEXT";
            $TEXT_PROPERTY = "DETAIL_TEXT";
            break;
        case "PREVIEW_TEXT":
            $TEXT = "PREVIEW_TEXT";
            $TEXT_PROPERTY = "PREVIEW_TEXT";
            break;
        default:
            $TEXT = "PROPERTY_".$arParams["TEXT_PROPERTY"]."_VALUE";
            $TEXT_PROPERTY = "PROPERTY_".$arParams["TEXT_PROPERTY"];
            break;
    }

if($this->StartResultCache())
{
        if(($source == "ib") && !CModule::IncludeModule("iblock"))
        {
                $this->AbortResultCache();
                ShowError(GetMessage("IB_MODULE_NOT_INSTALLED"));
                return;
        }
        if(($source == "ml") && !CModule::IncludeModule("fileman"))
        {
                $this->AbortResultCache();
                ShowError(GetMessage("FM_MODULE_NOT_INSTALLED"));
                return;
        }

        if(strlen($PICT) != 0 || strlen($TEXT) != 0)
        {
            $arFilter = Array(
                    "IBLOCK_ID"       =>      $arParams["IBLOCK_ID"],
            );
            if($arParams["SECTION_ID"] > 0)
                    $arFilter["SECTION_ID"] = $arParams["SECTION_ID"];
            if($arParams["ELEMENTS_ID"] > 0)
                    $arFilter["ID"] = $arParams["ELEMENTS_ID"];


            $arSelect = Array(
                    "ID",
                    "NAME",
                    "IBLOCK_ID",
                    "DETAIL_PAGE_URL"
            );

            if(strlen($PICT) != 0)
                $arSelect[] = $DETAIL_PICT_PROPERTY;

//for text
            if(strlen($TEXT) != 0)
                $arSelect[] = $TEXT_PROPERTY;

            if($arParams["URL_PROPERTY"] != "NONE")
                     $arSelect[] = "PROPERTY_".$arParams["URL_PROPERTY"];

            //It is necessary for restriction of an amount of elements
            if($arParams["COUNT_EL"]):
              $arOrder = Array();
              $arNavStartParams = Array("nTopCount"=>$arParams["COUNT_EL"]);
            else:
              $arOrder = 'false';
            endif;

            $arResult["ITEMS"] = array();

            $rsElement = CIBlockElement::GetList($arOrder, $arFilter, false, $arNavStartParams, $arSelect);
            while($arElement = $rsElement->GetNext())
            {
                $arElement["PICT"] = $PICT;
//for text
                $arElement["TEXT"] = $TEXT;
                $perem = CFile::GetFileArray($arElement[$PICT]);
                $arElement["ORIGINAL_PICT"] = $perem;
                $large_img_path = "";
                //It is necessary to resize preview picture
                if ($arParams["DETAIL_PICT_RESIZE"] == 'Y')
                {
                    $img_path = $_SERVER['DOCUMENT_ROOT'].$perem["SRC"];
                    $arImgPath = explode("/",$img_path);
                    $key = array_search("upload", $arImgPath);
                    $arImgPath[$key+1] = "altasib.photoplayer1mod";
                    $img_path_check = end(explode('/',$img_path));
                    if ($img_path_check{0}!='d' || $img_path_check{1}!='_')
                          $img_path_check = 'd_'.str_replace(" ", "_", $img_path_check);
                    $arImgPath[$key+3] = $img_path_check;
                    $img_path_check = implode('/',$arImgPath);
                    if ((!file_exists($img_path_check)) || ($arParams["CLEAR_RESIZE_IMG"] == 'Y'))
                    {
                        if (!is_dir($_SERVER['DOCUMENT_ROOT']."/upload/altasib.photoplayer1mod/"))
                            mkdir($_SERVER['DOCUMENT_ROOT']."/upload/altasib.photoplayer1mod/", 0777);
                        $arImgPath = explode("/",$img_path);
                        $key = array_search("upload", $arImgPath);
                        $arImgPath[$key+1] = "altasib.photoplayer1mod";
                        $arImgFolderPath = $arImgPath;
                        unset($arImgFolderPath[$key+3]);
                        mkdir(implode("/",$arImgFolderPath), 0777);
                        $filename = array_pop($arImgPath);
                        if (($perem["WIDTH"] > $arParams["BIGPICX"]) || ($perem["HEIGHT"] > $arParams["BIGPICY"]))
                        {
                            $small_img_path = altasib_resize_img($img_path,implode("/",$arImgPath),str_replace(" ", "_",$filename),"d_",$arParams["BIGPICX"], $arParams["BIGPICY"], "", 95, "");
                            $img_path_check = str_replace($_SERVER['DOCUMENT_ROOT'],'',$img_path_check);
                            //p($small_img_path);

                            $size = getimagesize($_SERVER['DOCUMENT_ROOT'].$img_path_check);
                            $arElement["P"]["DETAIL_SRC"] = $img_path_check;
                            $arElement["P"]["DETAIL_SRC_SIZE"] = $size[3];
                        }
                    }
                }
                //It is necessary to resize preview picture
                if ($arParams["PREVIEW_PICT_RESIZE"] == 'Y')
                {
                    $img_path = $_SERVER['DOCUMENT_ROOT'].$perem["SRC"];
                    $arImgPath = explode("/",$img_path);
                    $key = array_search("upload", $arImgPath);
                    $arImgPath[$key+1] = "altasib.photoplayer1mod";
                    $img_path_check = end(explode('/',$img_path));
                    if ($img_path_check{0}!='s' || $img_path_check{1}!='_')
                          $img_path_check = 's_'.str_replace(" ", "_", $img_path_check);
                    $arImgPath[$key+3] = $img_path_check;
                    $img_path_check = implode('/',$arImgPath);
                    if ((!file_exists($img_path_check)) || ($arParams["CLEAR_RESIZE_IMG"] == 'Y'))
                    {
                        if (!is_dir($_SERVER['DOCUMENT_ROOT']."/upload/altasib.photoplayer1mod/"))
                            mkdir($_SERVER['DOCUMENT_ROOT']."/upload/altasib.photoplayer1mod/", 0777);
                        $arImgPath = explode("/",$img_path);
                        $key = array_search("upload", $arImgPath);
                        $arImgPath[$key+1] = "altasib.photoplayer1mod";
                        $arImgFolderPath = $arImgPath;
                        unset($arImgFolderPath[$key+3]);
                        mkdir(implode("/",$arImgFolderPath), 0777);
                        $filename = array_pop($arImgPath);
                        $small_img_path = altasib_resize_img($img_path,implode("/",$arImgPath),str_replace(" ", "_",$filename),"s_",$arParams["PREVPICX"], $arParams["PREVPICY"], "", 95, "");
                    }
                    $img_path_check = str_replace($_SERVER['DOCUMENT_ROOT'],'',$img_path_check);
                    $arElement["P"]["SRC"] = $img_path_check;
                }
                else
                    $arElement["P"]["SRC"] = $perem["SRC"];
                $arElement["P"]["WIDTH"] = $perem["WIDTH"];
                $arElement["P"]["HEIGHT"] = $perem["HEIGHT"];
//for text
                if(strlen($perem["DESCRIPTION"]) > 0)
                    $arElement["DESCR"] = $perem["DESCRIPTION"];
                else
                    $arElement["DESCR"] = $perem["FILE_NAME"];
                if(strlen($arElement["PROPERTY_".$arParams["URL_PROPERTY"]."_VALUE"]) > 0)
                    $arElement["URL"] = str_replace('http://', '', $arElement["PROPERTY_".$arParams["URL_PROPERTY"]."_VALUE"]);
                $arResult["ITEMS"][] = $arElement;
            }
        }
        elseif($source == "ml")
        {
            CMedialib::Init();
            $Params['arCollections'][0] = $COLLECTION_ID;
            $arResult["ITEMS"] = array();
            $arRes = CMedialibItem::GetList($Params);
            foreach($arRes as $res_key=>$res_val)
            {
                $large_img_path = "";
                $arRes[$res_key]["ORIGINAL_PICT"] = $res_val;
                //It is necessary to resize preview picture
                if ($arParams["DETAIL_PICT_RESIZE"] == 'Y')
                {
                    $img_path = $_SERVER['DOCUMENT_ROOT'].$res_val["PATH"];
                    $arImgPath = explode("/",$img_path);
                    $key = array_search("upload", $arImgPath);
                    $arImgPath[$key+1] = "altasib.photoplayer1mod";
                    $img_path_check = end(explode('/',$img_path));
                    if ($img_path_check{0}!='d' || $img_path_check{1}!='_')
                          $img_path_check = 'd_'.str_replace(" ", "_", $img_path_check);
                    $arImgPath[$key+3] = $img_path_check;
                    $img_path_check = implode('/',$arImgPath);
                    if ((!file_exists($img_path_check)) || ($arParams["CLEAR_RESIZE_IMG"] == 'Y'))
                    {
                        if (!is_dir($_SERVER['DOCUMENT_ROOT']."/upload/altasib.photoplayer1mod/"))
                            mkdir($_SERVER['DOCUMENT_ROOT']."/upload/altasib.photoplayer1mod/", 0777);
                        $arImgPath = explode("/",$img_path);
                        $key = array_search("upload", $arImgPath);
                        $arImgPath[$key+1] = "altasib.photoplayer1mod";
                        $arImgFolderPath = $arImgPath;
                        unset($arImgFolderPath[$key+3]);
                        mkdir(implode("/",$arImgFolderPath), 0777);
                        $filename = array_pop($arImgPath);
                        if (($res_val["WIDTH"] > $arParams["BIGPICX"]) || ($res_val["HEIGHT"] > $arParams["BIGPICY"]))
                        {
                            $small_img_path = altasib_resize_img($img_path,implode("/",$arImgPath),str_replace(" ", "_",$filename),"d_",$arParams["BIGPICX"], $arParams["BIGPICY"], "", 95, "");
                            $img_path_check = str_replace($_SERVER['DOCUMENT_ROOT'],'',$img_path_check);
                            //p($small_img_path);

                            $size = getimagesize($_SERVER['DOCUMENT_ROOT'].$img_path_check);
                            $arRes[$res_key]["P"]["DETAIL_SRC"] = $img_path_check;
                            $arRes[$res_key]["P"]["DETAIL_SRC_SIZE"] = $size[3];
                        }
                    }
                }
                //It is necessary to resize preview picture
                if ($arParams["PREVIEW_PICT_RESIZE"] == 'Y')
                {
                    $img_path = $_SERVER['DOCUMENT_ROOT'].$res_val["PATH"];
                    $arImgPath = explode("/",$img_path);
                    $key = array_search("upload", $arImgPath);
                    $arImgPath[$key+1] = "altasib.photoplayer1mod";
                    $img_path_check = end(explode('/',$img_path));
                    if ($img_path_check{0}!='s' || $img_path_check{1}!='_')
                          $img_path_check = 's_'.str_replace(" ", "_", $img_path_check);
                    $arImgPath[$key+3] = $img_path_check;
                    $img_path_check = implode('/',$arImgPath);
                    if ((!file_exists($img_path_check)) || ($arParams["CLEAR_RESIZE_IMG"] == 'Y'))
                    {
                        if (!is_dir($_SERVER['DOCUMENT_ROOT']."/upload/altasib.photoplayer1mod/"))
                            mkdir($_SERVER['DOCUMENT_ROOT']."/upload/altasib.photoplayer1mod/", 0777);
                        $arImgPath = explode("/",$img_path);
                        $key = array_search("upload", $arImgPath);
                        $arImgPath[$key+1] = "altasib.photoplayer1mod";
                        $arImgFolderPath = $arImgPath;
                        unset($arImgFolderPath[$key+3]);
                        mkdir(implode("/",$arImgFolderPath), 0777);
                        $filename = array_pop($arImgPath);
                        $small_img_path = altasib_resize_img($img_path,implode("/",$arImgPath),str_replace(" ", "_",$filename),"s_",$arParams["PREVPICX"], $arParams["PREVPICY"], "", 95, "");
                    }
                    $img_path_check = str_replace($_SERVER['DOCUMENT_ROOT'],'',$img_path_check);
                    $arRes[$res_key]["P"]["SRC"] = $img_path_check;
                }
                else
                    $arRes[$res_key]["P"]["SRC"] = $res_val["PATH"];
                $arRes[$res_key]["P"]["WIDTH"] = $res_val["WIDTH"];
                $arRes[$res_key]["P"]["HEIGHT"] = $res_val["HEIGHT"];
                $arRes[$res_key]["DESCR"] = $perem["DESCRIPTION"];
                $arRes[$res_key]["TEXT"] = "DESCRIPTION";
                $arRes[$res_key]["PICT"] = "PATH";
            }
            $arResult["ITEMS"] = $arRes;
        }
        if($arParams["SHOW_RANDOM"] == "Y")
            shuffle($arResult["ITEMS"]);
        switch ($arParams["WRAP"])
        {
            case "WRAP_NO":
                $arResult["WRAP"] = null;
                break;
            case "WRAP_BOTH":
                $arResult["WRAP"] = 'circular';
                break;
        }
        $this->IncludeComponentTemplate();
}
?>
