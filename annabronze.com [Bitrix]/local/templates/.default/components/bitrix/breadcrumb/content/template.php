<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//delayed function must return a string
if(empty($arResult))
	return "";


 //	<div class="b-breadcrumbs__item"><span>Lotus breath</span></div>



$strReturn = '<div class="b-breadcrumbs">';

for($index = 0, $itemSize = count($arResult); $index < $itemSize; $index++)
{
	//if($index > 0)
		//$strReturn .= '<span>&rarr;</span>';

	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	$strReturn .= '<a href="'.$arResult[$index]["LINK"].'" class="b-breadcrumbs__item link"><span>'.$title.'</span></a>';
}

$strReturn .= '</div>';
return $strReturn;
?>
