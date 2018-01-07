<?


global $APPLICATION;

unset($ITEMS);

if(CModule::IncludeModule("iblock"))
{



	$wanted_sect=CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>GALLERY_IBLOCK_ID_EN), false, Array());
	while($one_sect=$wanted_sect->GetNext()) //
	{

		$item["NAME"] = $one_sect["NAME"];
		$item["SECTION_PAGE_URL"] = $one_sect["SECTION_PAGE_URL"];

		$ITEMS[] = $item;

	}


}



$aMenuLinks = Array(
	Array(
		"Articles",
		"/en/info/article/",
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Classes",
		"/en/info/master-klass/",
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"FAQ",
		"/en/info/faq/",
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Gallery",
		"/en/info/gallery/",
		Array(), 
		Array("ITEMS" => $ITEMS),//
		"" 
	),
	Array(
		"Blog",
		"/en/info/blog/?page=history",
		Array(), 
		Array(), 
		"" 
	)
);
?>