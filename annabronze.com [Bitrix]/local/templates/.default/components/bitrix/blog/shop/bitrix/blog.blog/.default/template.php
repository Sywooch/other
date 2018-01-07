<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if (!$this->__component->__parent || empty($this->__component->__parent->__name) || $this->__component->__parent->__name != "bitrix:blog"):
	$GLOBALS['APPLICATION']->SetAdditionalCSS('/bitrix/components/bitrix/blog/templates/.default/style.css');
	$GLOBALS['APPLICATION']->SetAdditionalCSS('/bitrix/components/bitrix/blog/templates/.default/themes/blue/style.css');
endif;
?>
<?CUtil::InitJSCore(array("image"));?>


<? /* ?>

<div class="b-blog-list">


	<?

	if(count($arResult["POSTS"])>0)
	{
		foreach($arResult["POSTS"] as $ind => $CurPost)
		{


			$className = "blog-post";
			if($ind == 0)
				$className .= " blog-post-first";
			elseif(($ind+1) == count($arResult["POSTS"]))
				$className .= " blog-post-last";
			if($ind%2 == 0)
				$className .= " blog-post-alt";
			$className .= " blog-post-year-".$CurPost["DATE_PUBLISH_Y"];
			$className .= " blog-post-month-".$CurPost["DATE_PUBLISH_M"];
			$className .= " blog-post-day-".$CurPost["DATE_PUBLISH_D"];
			?>
			<!--<script>
					BX.viewImageBind(
						'blg-post-<?=$CurPost["ID"]?>',
						{showTitle: false},
						{tag:'IMG', attr: 'data-bx-image'}
					);
				</script>-->




			<div class="b-blog-list__item" id="blg-post-<?=$CurPost["ID"]?>">
				<a href="<?=$CurPost["urlToPost"]?>"
				   class="b-blog-list__item-title"><?=$CurPost["TITLE"]?></a>
				<div class="b-blog-list__item-meta">


					<a href="<?=$CurPost["urlToBlog"];?>" class="b-blog-list__item-author"><?=$CurPost["~AUTHOR_NAME"];?> </a>
					<div class="b-blog-list__item-date"><?=$CurPost["DATE_PUBLISH_FORMATED"]?></div>



				</div>
				<div class="b-blog-list__item-text">
					<?=$CurPost["TEXT_FORMATED"]?>
				</div>
				<div class="b-blog-list__item-img">

					<?
					//echo "<pre>";
					//print_r($CurPost['arImages']);
					//echo "</pre>";
					?>

					<img alt="" src="<?=$CurPost['arImages'][0]['full'];?>">
				</div>
				<a href="<?=$CurPost["urlToPost"]?>" class="btn _medium-size"><?=GetMessage("BLOG_BLOG_BLOG_MORE")?></a>

				<?
				if(count($CurPost["arImages"])>0) {
					?>


					<div class="b-blog-list__photos">
						<div class="b-blog-list__photos-title"><?=GetMessage("BLOG_BLOG_BLOG_PHOTOS")?>:</div>
						<div class="b-blog-list__photos-list">

							<?


							foreach ($CurPost["arImages"] as $val) {


								$url = parse_url($val["full"]);
								parse_str($url["query"], $params);


								//fid
								$res = CBlogImage::GetByID($params["fid"]);
								$FILE_ID = $res["FILE_ID"];
								$arFile = CFile::GetFileArray($FILE_ID);
								$renderImage = CFile::ResizeImageGet($arFile, Array("width" => 68, "height" => 68), BX_RESIZE_IMAGE_EXACT);
								$val["small"] = $renderImage['src'];
								?>
								<a href="<?= $arFile["SRC"] ?>" class="b-blog-list__photos-item fancybox"
								   rel="blog<?= $CurPost["ID"] ?>"
								   style="background-image: url(<?= $val["small"] ?>)"
								   data-bx-image="<?= $val["full"] ?>">

								</a>
								<?
							}
							?>
						</div>
					</div>

					<?
				}
				?>


				<div class="b-blog-list__counts">
					<div class="b-blog-list__counts-item _views"><?=GetMessage("BLOG_VIEWS")?>: <span><?=IntVal($CurPost["VIEWS"]);?></span></div>
					<div class="b-blog-list__counts-item _comments"><?=GetMessage("BLOG_COMMENTS")?>: <span><?=IntVal($CurPost["NUM_COMMENTS"]);?></span></div>


					<?


					$APPLICATION->IncludeComponent(
						"bitrix:rating.vote", "like_shop",//
						Array(
							"ENTITY_TYPE_ID" => "BLOG_POST",
							"ENTITY_ID" => $CurPost["ID"],
							"OWNER_ID" => $CurPost["AUTHOR_ID"],
							"USER_VOTE" => $arResult["RATING"][$CurPost["ID"]]["USER_VOTE"],
							"USER_HAS_VOTED" => $arResult["RATING"][$CurPost["ID"]]["USER_HAS_VOTED"],
							"TOTAL_VOTES" => $arResult["RATING"][$CurPost["ID"]]["TOTAL_VOTES"],
							"TOTAL_POSITIVE_VOTES" => $arResult["RATING"][$CurPost["ID"]]["TOTAL_POSITIVE_VOTES"],
							"TOTAL_NEGATIVE_VOTES" => $arResult["RATING"][$CurPost["ID"]]["TOTAL_NEGATIVE_VOTES"],
							"TOTAL_VALUE" => $arResult["RATING"][$CurPost["ID"]]["TOTAL_VALUE"],
							"PATH_TO_USER_PROFILE" => $arParams["~PATH_TO_USER"],
						),
						$component,
						array("HIDE_ICONS" => "Y")
					);?>


				</div>
				<div class="b-blog-list__tags">


					<?
					if(!empty($CurPost["CATEGORY"]))
					{
						echo GetMessage("BLOG_TAGS").":";
						$i=0;
						foreach($CurPost["CATEGORY"] as $v)
						{
							if($i!=0)
								echo ",";
							?> <a href="<?=$v["urlToCategory"]?>" rel="nofollow"><?=$v["NAME"]?></a><?
							$i++;
						}
					}
					?>



				</div>
			</div>




			<?
		}


		//$APPLICATION->IncludeComponent('bitrix:system.pagenavigation', 'shop', array(
		//	'NAV_RESULT' => $arResult["navResult"],
		//));



		if(strlen($arResult["NAV_STRING"])>0)
			echo $arResult["NAV_STRING"];



	}
	?>



</div>

<? */ ?>




<div id="blog-posts-content" class="b-blog-list">
<?
if(!empty($arResult["OK_MESSAGE"]))
{
	?>
	<div class="blog-notes blog-note-box">
		<div class="blog-note-text">
			<ul>
				<?
				foreach($arResult["OK_MESSAGE"] as $v)
				{
					?>
					<li><?=$v?></li>
					<?
				}
				?>
			</ul>
		</div>
	</div>
	<?
}
if(!empty($arResult["MESSAGE"]))
{
	?>
	<div class="blog-textinfo blog-note-box">
		<div class="blog-textinfo-text">
			<ul>
				<?
				foreach($arResult["MESSAGE"] as $v)
				{
					?>
					<li><?=$v?></li>
					<?
				}
				?>
			</ul>
		</div>
	</div>
	<?
}
if(!empty($arResult["ERROR_MESSAGE"]))
{
	?>
	<div class="blog-errors blog-note-box blog-note-error">
		<div class="blog-error-text">
			<ul>
				<?
				foreach($arResult["ERROR_MESSAGE"] as $v)
				{
					?>
					<li><?=$v?></li>
					<?
				}
				?>
			</ul>
		</div>
	</div>
	<?
}

if(count($arResult["POST"])>0)
{
	foreach($arResult["POST"] as $ind => $CurPost)
	{
		$className = "blog-post";
		if($ind == 0)
			$className .= " blog-post-first";
		elseif(($ind+1) == count($arResult["POST"]))
			$className .= " blog-post-last";
		if($ind%2 == 0)
			$className .= " blog-post-alt";
		$className .= " blog-post-year-".$CurPost["DATE_PUBLISH_Y"];
		$className .= " blog-post-month-".IntVal($CurPost["DATE_PUBLISH_M"]);
		$className .= " blog-post-day-".IntVal($CurPost["DATE_PUBLISH_D"]);
		?>



			<div class="b-blog-list__item" id="blg-post-<?=$CurPost["ID"]?>">
				<script>
					BX.viewImageBind(
						'blg-post-<?=$CurPost["ID"]?>',
						{showTitle: false},
						{tag:'IMG', attr: 'data-bx-image'}
					);
				</script>

				<a href="<?=$CurPost["urlToPost"]?>"
				   class="b-blog-list__item-title"><?=$CurPost["TITLE"]?></a>


				<div class="b-blog-list__item-meta">

					<a href="<?=$CurPost["urlToBlog"];?>" class="b-blog-list__item-author"><?=$CurPost["arUser"]["NAME"];?> </a>
					<div class="b-blog-list__item-date"><?=$CurPost["DATE_PUBLISH_FORMATED"]?></div>


				</div>

				<div class="b-blog-list__item-text">
					<?=$CurPost["TEXT_FORMATED"]?>
				</div>


				<div class="b-blog-list__item-img">

					<?
					//echo "<pre>";
					//print_r($CurPost['arImages']);
					//echo "</pre>";
					?>

					<img alt="" src="<?=$CurPost['arImages'][0]['full'];?>">
				</div>
				<a href="<?=$CurPost["urlToPost"]?>" class="btn _medium-size"><?=GetMessage("BLOG_BLOG_BLOG_MORE")?></a>

				<?
				if(count($CurPost["arImages"])>0) {
					?>


					<div class="b-blog-list__photos">
						<div class="b-blog-list__photos-title"><?=GetMessage("BLOG_BLOG_BLOG_PHOTOS")?>:</div>
						<div class="b-blog-list__photos-list">

							<?


							foreach ($CurPost["arImages"] as $val) {


								$url = parse_url($val["full"]);
								parse_str($url["query"], $params);


								//fid
								$res = CBlogImage::GetByID($params["fid"]);
								$FILE_ID = $res["FILE_ID"];
								$arFile = CFile::GetFileArray($FILE_ID);
								$renderImage = CFile::ResizeImageGet($arFile, Array("width" => 68, "height" => 68), BX_RESIZE_IMAGE_EXACT);
								$val["small"] = $renderImage['src'];
								?>
								<a href="<?= $arFile["SRC"] ?>" class="b-blog-list__photos-item fancybox"
								   rel="blog<?= $CurPost["ID"] ?>"
								   style="background-image: url(<?= $val["small"] ?>)"
								   data-bx-image="<?= $val["full"] ?>">

								</a>
								<?
							}
							?>
						</div>
					</div>

					<?
				}
				?>


				<div class="b-blog-list__counts">

					<div class="b-blog-list__counts-item blog-post-views-link"><?=GetMessage("BLOG_VIEWS")?>: <span><?=IntVal($CurPost["VIEWS"]);?></span></div>
		<?if($CurPost["ENABLE_COMMENTS"] == "Y"):?>
					<div class="b-blog-list__counts-item blog-post-comments-link">
						<a href="<?=$CurPost["urlToPost"]?>#comments">
							<?=GetMessage("BLOG_COMMENTS")?>: <span><?=IntVal($CurPost["NUM_COMMENTS"]);?></span>
						</a>
					</div>
		<?endif;?>

					<?if(strLen($CurPost["urlToHide"])>0):?>
						<span class="b-blog-list__counts-item blog-post-hide-link" style="padding-left: 33px;">
							<a href="javascript:if(confirm('<?=GetMessage("BLOG_MES_HIDE_POST_CONFIRM")?>')) window.location='<?=$CurPost["urlToHide"]."&".bitrix_sessid_get()?>'">
								<span class="blog-post-link-caption"><?=GetMessage("BLOG_MES_HIDE")?></span>
							</a>
						</span>


					<?endif;?>
					<?if(strLen($CurPost["urlToEdit"])>0):?>
						<span class="b-blog-list__counts-item blog-post-edit-link" style="padding-left: 33px;">
							<a href="<?=$CurPost["urlToEdit"]?>">
								<span class="blog-post-link-caption"><?=GetMessage("BLOG_MES_EDIT")?></span>
							</a>
						</span>
					<?endif;?>
					<?if(strLen($CurPost["urlToDelete"])>0):?>
						<span class="b-blog-list__counts-item blog-post-delete-link" style="padding-left: 33px;">
							<a href="javascript:if(confirm('<?=GetMessage("BLOG_MES_DELETE_POST_CONFIRM")?>')) window.location='<?=$CurPost["urlToDelete"]."&".bitrix_sessid_get()?>'">
								<span class="blog-post-link-caption"><?=GetMessage("BLOG_MES_DELETE")?></span>
							</a>
						</span>
					<?endif;?>


					<?
					$APPLICATION->IncludeComponent(
						"bitrix:rating.vote", "",//
						Array(
							"ENTITY_TYPE_ID" => "BLOG_POST",
							"ENTITY_ID" => $CurPost["ID"],
							"OWNER_ID" => $CurPost["AUTHOR_ID"],
							"USER_VOTE" => $arResult["RATING"][$CurPost["ID"]]["USER_VOTE"],
							"USER_HAS_VOTED" => $arResult["RATING"][$CurPost["ID"]]["USER_HAS_VOTED"],
							"TOTAL_VOTES" => $arResult["RATING"][$CurPost["ID"]]["TOTAL_VOTES"],
							"TOTAL_POSITIVE_VOTES" => $arResult["RATING"][$CurPost["ID"]]["TOTAL_POSITIVE_VOTES"],
							"TOTAL_NEGATIVE_VOTES" => $arResult["RATING"][$CurPost["ID"]]["TOTAL_NEGATIVE_VOTES"],
							"TOTAL_VALUE" => $arResult["RATING"][$CurPost["ID"]]["TOTAL_VALUE"],
							"PATH_TO_USER_PROFILE" => $arParams["~PATH_TO_USER"],
						),
						$component,
						array("HIDE_ICONS" => "Y")
					);?>


				</div>



				<div class="b-blog-list__tags">


					<?
					if(!empty($CurPost["CATEGORY"]))
					{
						echo GetMessage("BLOG_TAGS").":";
						$i=0;
						foreach($CurPost["CATEGORY"] as $v)
						{
							if($i!=0)
								echo ",";
							?> <a href="<?=$v["urlToCategory"]?>" rel="nofollow"><?=$v["NAME"]?></a><?
							$i++;
						}
					}
					?>



				</div>



				

			</div>
		<?
	}
	if(strlen($arResult["NAV_STRING"])>0)
		echo $arResult["NAV_STRING"];
}
elseif(!empty($arResult["BLOG"]))
	echo GetMessage("BLOG_BLOG_BLOG_NO_AVAIBLE_MES");
?>	
</div>
