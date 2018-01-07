<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>





<div class="b-news-list">

	<?
	unset($arGalleries);
	?>

	<?foreach( $arResult["ITEMS"] as $arItem ){?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
	?>

	<div class="b-news-list__item _is-article">
		<a id="link_open_gallery_<?=$arItem["ID"];?>" href="<?=P_GALLERY_URL?>?url=<? echo $arItem["DETAIL_PAGE_URL"];?>&id=<? echo $arItem["ID"];?>"
		   class="open-ajax"><!---->
			<div class="b-news-list__item-img">
				<div class="b-news-list__item-imginner" style="background-image: url(<?
				if ($arItem["PREVIEW_PICTURE"]["SRC"]):
				$img = CFile::ResizeImageGet( $arItem["PREVIEW_PICTURE"], array( "width" => 170, "height" => 170 ),
					BX_RESIZE_IMAGE_EXACT, true, array() );
					echo $img["src"];
				else:
					echo BX_DEFAULT_NO_PHOTO_IMAGE;
				endif;

				?>)"></div>
			</div>
		</a>
		<div class="b-news-list__item-wrapper">
			<a href="/local/include/ajax-gallery.php?url=<? echo $arItem["DETAIL_PAGE_URL"];?>&id=<? echo $arItem["ID"];?>"
			   class="b-news-list__item-title open-ajax"><?=$arItem["NAME"];?></a>
			<div class="b-news-list__item-text">
				<?=$arItem["PREVIEW_TEXT"];?>
			</div>
		</div>
	</div>

		<?
		$arGalleries[$arItem["ID"]] = $arItem["DETAIL_PAGE_URL"];

		?>


	<?}?>

	<?if( $arParams["DISPLAY_BOTTOM_PAGER"] == "Y" ){?>
		<?=$arResult["NAV_STRING"]?>
	<?}?>
	
</div>



<?
if(isset($_GET["gallery"])){
	?>
	<script type="text/javascript">
		$(window).on("load", function () {


			$.fancybox({
				type: 'ajax',
				href: "/local/include/ajax-gallery.php?id=<?=$_GET["gallery"];?>",
				afterLoad: function (current, previous) {
					setTimeout(function () {
					}, 300);
				}
			});

			//$("#link_open_gallery_<?=$_GET["gallery"];?>").click();

		});
	</script>

	<?
}

?>

