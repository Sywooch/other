<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?


$content = ob_get_clean();
$replace = "";


?>


<? $i = 1;

//$M=generate_rand_massive(1, 4, count($arResult["SECTIONS"]));
$M = generate_all_permutation(1, 4, count($arResult["SECTIONS"]));
$replace = "";

foreach ($arResult["SECTIONS"] as $key => $arSection) {
    $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
    $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));

    $PICTURE = "";
    if (!empty($arSection["DETAIL_PICTURE"])) {

        $PICTURE = CFile::GetFileArray($arSection["DETAIL_PICTURE"]);

        $renderImage = CFile::ResizeImageGet($PICTURE, Array("height" => 250, BX_RESIZE_IMAGE_EXACT));
        $PICTURE["SRC"] = $renderImage['src'];
        $PICTURE = $PICTURE["SRC"];

    } else if (!empty($arSection["PICTURE"])) {

        $renderImage = CFile::ResizeImageGet($arSection["PICTURE"], Array("height" => 250, BX_RESIZE_IMAGE_EXACT));
        $PICTURE["SRC"] = $renderImage['src'];
        $PICTURE = $PICTURE["SRC"];

    } else {
        $PICTURE = BX_DEFAULT_NO_PHOTO_IMAGE;
    }

    $ELEMENT_CNT = "";
    if ($arSection["ELEMENT_CNT"]) {
        $ELEMENT_CNT = '&nbsp;(' . $arSection["ELEMENT_CNT"] . ')';
    } else {
        $ELEMENT_CNT = '';
    }

    $replace = $replace . "
<div class=\"b-catalog-list__item b-catalog-section-list__item js-product-list-card\">
    <a href=\"" . $arSection["SECTION_PAGE_URL"] . "\"
       class=\"b-collections__item b-collections-section-list__item _type" . $M[$i - 1] . "\">
        <div class=\"b-collections__item-ico\"></div>
        <div class=\"b-collections__item-img\" style=\"background-image: url(" . $PICTURE . ")\"></div>
        <div class=\"b-collections__item-name\">
            <span>" . $arSection["NAME"] . $ELEMENT_CNT . "</span>
        </div>
    </a>
</div>
";

    if ($i % 4 == 0 && $arResult["SECTIONS"][$key + 1]) {
        $replace = $replace . "</div><div class=\"b-catalog-list _with-end-line\">";
    }

    $i++;
} ?>

<?
echo str_replace('#NEED_TO_REPLACE#', $replace, $content);
?>
