<?


global $APPLICATION;

unset($ITEMS);

if(CModule::IncludeModule("iblock"))
{



	if(LANGUAGE_ID==='en'){
		$IBLOCK_GALLERY = BX_IBLOCK_GALLERY_EN;
	}else{
		$IBLOCK_GALLERY = BX_IBLOCK_GALLERY_RU;
	}

	$wanted_sect=CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$IBLOCK_GALLERY), false, Array());
	while($one_sect=$wanted_sect->GetNext()) //
	{

		$item["NAME"] = $one_sect["NAME"];
		$item["SECTION_PAGE_URL"] = $one_sect["SECTION_PAGE_URL"];
		$ITEMS[] = $item;

	}


}


$aMenuLinks = Array(
	Array(
		"Статьи", 
		"/info/article/", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Мастер классы", 
		"/info/master-klass/", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Вопрос-ответ", 
		"/info/faq/", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Галерея", 
		"/info/gallery/", 
		Array(), 
		Array("ITEMS" => $ITEMS),
		"" 
	),
	Array(
		"Блог", 
		"/info/blog/?page=history", 
		Array(), 
		Array(), 
		"" 
	)
);
?>