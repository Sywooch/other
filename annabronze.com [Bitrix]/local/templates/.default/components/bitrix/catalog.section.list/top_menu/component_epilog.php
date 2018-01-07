
<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$content = ob_get_clean();
$replace = "";


$log=1;
$number=10;
$number = ceil(count($arResult["SECTIONS"])/4);
$M=generate_rand_massive(1, 6, $arResult["SECTIONS_COUNT"]);
$i2=0;

foreach( $arResult["SECTIONS"] as $arItems ){
$replace = $replace . "
<a href=\"".$arItems["SECTION_PAGE_URL"]."\"
   class=\"b-top-menu__catalog-link link _ico".$M[$i2]."\">
	<span>".$arItems["NAME"]." (".$arItems["COUNT_ELEMENTS"].")</span>
</a>";
//CIBlockSection::GetSectionElementsCount($arItems["ID"])
if(($log % $number) == 0){ $replace = $replace . "</div><div class=\"b-top-menu__catalog-col\">";  }

 $log++; $i2++;

}
	echo str_replace('#NEED_TO_REPLACE#', $replace, $content);

