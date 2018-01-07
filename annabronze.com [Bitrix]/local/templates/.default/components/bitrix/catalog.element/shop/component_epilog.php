<?	
	if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
	__IncludeLang($_SERVER["DOCUMENT_ROOT"].$templateFolder."/lang/".LANGUAGE_ID."/template.php");
	global $first_tab;
?>


<script>
	$(document).ready(function()
	{		
		if (!$("#product_reviews_title").parents("li").is(".current"))
		{
			$(".inner_left div.box").first().show();
		}
		if ($("#compare").length)
		{
			$("#compare").html($("#compare_content").html());
			$("#compare_content").empty();
		}	
	});
</script>

<?

//$APPLICATION->AddChainItem($arResult["NAME"]);
?>