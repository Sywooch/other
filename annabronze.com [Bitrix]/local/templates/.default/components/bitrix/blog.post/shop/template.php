<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if (!$this->__component->__parent || empty($this->__component->__parent->__name) || $this->__component->__parent->__name != "bitrix:blog"):
	$GLOBALS['APPLICATION']->SetAdditionalCSS('/bitrix/components/bitrix/blog/templates/.default/style.css');
	$GLOBALS['APPLICATION']->SetAdditionalCSS('/bitrix/components/bitrix/blog/templates/.default/themes/blue/style.css');
endif;
?>
<?CUtil::InitJSCore(array("image"));?>

<div class="blog-post-current">


		<div class="grid-row col-1 col-xm-12 col-s-12"></div>

		<div class="b-layout__inner-content grid-row col-10 col-xm-12  col-s-12"><!-- new grid classes -->
			<div class="b-layout__info-box"><!-- for content pages - content styles -->


				<?
				if(!empty($arResult["Post"])>0) {
					$className = "blog-post";
					$className .= " blog-post-first";
					$className .= " blog-post-alt";
					$className .= " blog-post-year-" . $arResult["Post"]["DATE_PUBLISH_Y"];
					$className .= " blog-post-month-" . IntVal($arResult["Post"]["DATE_PUBLISH_M"]);
					$className .= " blog-post-day-" . IntVal($arResult["Post"]["DATE_PUBLISH_D"]);
					?>
					<script>
						BX.viewImageBind(
							'blg-post-<?=$arResult["Post"]["ID"]?>',
							{showTitle: false},
							{tag: 'IMG', attr: 'data-bx-image'}
						);
					</script>

					<div class="b-blog-list" >
						<div class="b-blog-list__item" id="blg-post-<?=$arResult["Post"]["ID"]?>">
							<a href="#" class="b-blog-list__item-title"><?=$arResult["Post"]["TITLE"]?></a>
							<div class="b-blog-list__item-meta">
								<span class="b-blog-list__item-author"><?=$arResult["arUser"]["~NAME"];?></span>
								<div class="b-blog-list__item-date"><?=$arResult["Post"]["DATE_PUBLISH_FORMATED"]?></div>
							</div>
							<div class="b-blog-list__item-text">
								
								<?

								$arResult["Post"]["textFormated"] = preg_replace("/(<img\s[\w\d\W]+?>){1,}/", '<div class="b-blog-list__item-img">$0</div>', $arResult["Post"]["textFormated"]);
								echo $arResult["Post"]["textFormated"];

								?>

							</div>





								<?if(!empty($arResult["images"]))
								{
									?>

											<?
											foreach($arResult["images"] as $val)
											{
												?><div class="b-blog-list__item-img">
												<img src="<?=$val["small"]?>" alt=""
													border="0" data-bx-image="<?=$val["full"]?>">
												</div><?
											}
											?>
									<?
								}?>



							<?

							$arImages = array();
							$res = CBlogImage::GetList(array("ID"=>"ASC"),array("POST_ID"=>$arResult["Post"]["ID"], "IS_COMMENT" => "N"));
							while ($arImage = $res->Fetch())
							{


								$arImages[$arImage['ID']] = $arImage['FILE_ID'];
								$arTmp["arImages"][$arImage['ID']] = Array(
									"small" => "/bitrix/components/bitrix/blog/show_file.php?fid=".$arImage['ID']."&width=70&height=70&type=square",
									"full" => $arImage['ID']
								);
							}



							?>




							<?
							if(count($arTmp["arImages"])>0) {
								?>


								<div class="b-blog-list__photos">
									<div class="b-blog-list__photos-title"><?=GetMessage("BLOG_PHOTOS")?>:</div>
									<div class="b-blog-list__photos-list">

										<?


										foreach ($arTmp["arImages"] as $val) {


											//$url = parse_url($val["full"]);
											//parse_str($url["query"], $params);


											//fid

											$res = CBlogImage::GetByID($val["full"]);
											$FILE_ID = $res["FILE_ID"];
											$arFile = CFile::GetFileArray($FILE_ID);
											$val["full"] = $arFile["SRC"];
											$renderImage = CFile::ResizeImageGet($arFile, Array("width" => 68, "height" => 68), BX_RESIZE_IMAGE_EXACT);
											$val["small"] = $renderImage['src'];

											?>
											<a href="<?= $arFile["SRC"] ?>" class="b-blog-list__photos-item fancybox"
											   rel="blog<?=$arResult["Post"]["ID"]?>"
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
								<div class="b-blog-list__counts-item _views"><?=GetMessage("BLOG_VIEWS")?>:
									<span><?=IntVal($arResult["Post"]["VIEWS"])?></span></div>
								<div class="b-blog-list__counts-item _comments"><?=GetMessage("BLOG_COMMENTS")?>:
									<span><?=IntVal($arResult["Post"]["NUM_COMMENTS"])?></span></div>

								<?


								$APPLICATION->IncludeComponent(
									"bitrix:rating.vote", "like_shop",//
									Array(
										"ENTITY_TYPE_ID" => "BLOG_POST",
										"ENTITY_ID" => $arResult["Post"]["ID"],
										"OWNER_ID" => $arResult["Post"]["AUTHOR_ID"],
										"USER_VOTE" => $arResult["RATING"]["USER_VOTE"],
										"USER_HAS_VOTED" => $arResult["RATING"]["USER_HAS_VOTED"],
										"TOTAL_VOTES" => $arResult["RATING"]["TOTAL_VOTES"],
										"TOTAL_POSITIVE_VOTES" => $arResult["RATING"]["TOTAL_POSITIVE_VOTES"],
										"TOTAL_NEGATIVE_VOTES" => $arResult["RATING"]["TOTAL_NEGATIVE_VOTES"],
										"TOTAL_VALUE" => $arResult["RATING"]["TOTAL_VALUE"],
										"PATH_TO_USER_PROFILE" => $arParams["~PATH_TO_USER"],
									),
									$component,
									array("HIDE_ICONS" => "Y")
								);?>

							</div>
							<div class="b-blog-list__tags">


								<?
								if(!empty($arResult["Category"]))
								{
									echo GetMessage("BLOG_TAGS").":";

									$i=0;
									foreach($arResult["Category"] as $v)
									{
										if($i!=0)
											echo ",";
										?> <a href="<?=$v["urlToCategory"]?>" rel="nofollow"><?=$v["NAME"]?></a><?
										$i++;
									}

								}
								?>

							</div>

							<?
							//echo $arResult["CanUserComment"]."------";

							if($arResult["Blog"]["ENABLE_COMMENTS"] == "Y" && $arResult["CanUserComment"]){
							?>




							<div class="b-blog-list__add-btn align-center margin-top-big">
								<a href="#" class="btn _medium-size" onclick="return showComment('0')">
									<?=GetMessage("BLOG_ADD_A_COMMENT");?>
								</a>
							</div>

							<?
							}
							?>










						</div>


					</div>
					<?
				}
				?>





			</div>
		</div>


	



	<?
	/*
	?>



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
				<span class="b-blog-list__item-author"><?=$CurPost["~AUTHOR_NAME"];?> </span>
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
			<a href="#" class="btn _medium-size"><?=GetMessage("BLOG_BLOG_BLOG_MORE")?></a>

			<?
			if(count($CurPost["arImages"])>0) {
				?>


				<div class="b-blog-list__photos">
					<div class="b-blog-list__photos-title"><?=GetMessage("BLOG_BLOG_BLOG_PHOTOS")?>:</div>
					<div class="b-blog-list__photos-list">

						<?


						foreach ($CurPost["arImages"] as $val) {
							$protocol = (CMain::IsHTTPS()) ? "https://" : "http://";
							$dir = $protocol . $_SERVER["HTTP_HOST"];
							$content = file_get_contents("http://gs.annabronze.amado.su/bitrix/components/bitrix/blog/show_file.php?fid=680&width=1000&height=1000");


							$url = parse_url($val["full"]);
							parse_str($url["query"], $params);


							//fid
							$res = CBlogImage::GetByID($params["fid"]);
							$FILE_ID = $res["FILE_ID"];
							$arFile = CFile::GetFileArray($FILE_ID);

							?>
							<a href="<?= $arFile["SRC"] ?>" class="b-blog-list__photos-item fancybox"
							   rel="blog<?= $CurPost["ID"] ?>"
							   style="background-image: url(<?= $val["small"] ?>)"
							   data-bx-image="<?= $val["full"] ?>">
								<!--<img src="<?= $val["small"] ?>" alt="" border="0" data-bx-image="<?= $val["full"] ?>">-->

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
				<div class="b-blog-list__counts-item _likes"><?=GetMessage("BLOG_LIKES")?>: <span>

								<?


								$APPLICATION->IncludeComponent(
									"bitrix:rating.vote", "like_shop",
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

							</span></div>
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
?>


	<?
	*/
	?>







<?
/*
?>


<?
if(strlen($arResult["MESSAGE"])>0)
{
	?>
	<div class="blog-textinfo blog-note-box">
		<div class="blog-textinfo-text">
			<?=$arResult["MESSAGE"]?>
		</div>
	</div>
	<?
}
if(strlen($arResult["ERROR_MESSAGE"])>0)
{
	?>
	<div class="blog-errors blog-note-box blog-note-error">
		<div class="blog-error-text">
			<?=$arResult["ERROR_MESSAGE"]?>
		</div>
	</div>
	<?
}
if(strlen($arResult["FATAL_MESSAGE"])>0)
{
	?>
	<div class="blog-errors blog-note-box blog-note-error">
		<div class="blog-error-text">
			<?=$arResult["FATAL_MESSAGE"]?>
		</div>
	</div>
	<?
}
elseif(strlen($arResult["NOTE_MESSAGE"])>0)
{
	?>
	<div class="blog-textinfo blog-note-box">
		<div class="blog-textinfo-text">
			<?=$arResult["NOTE_MESSAGE"]?>
		</div>
	</div>
	<?
}
else
{
	if(!empty($arResult["Post"])>0)
	{
		$className = "blog-post";
		$className .= " blog-post-first";
		$className .= " blog-post-alt";
		$className .= " blog-post-year-".$arResult["Post"]["DATE_PUBLISH_Y"];
		$className .= " blog-post-month-".IntVal($arResult["Post"]["DATE_PUBLISH_M"]);
		$className .= " blog-post-day-".IntVal($arResult["Post"]["DATE_PUBLISH_D"]);
		?>
		<script>
		BX.viewImageBind(
			'blg-post-<?=$arResult["Post"]["ID"]?>',
			{showTitle: false},
			{tag:'IMG', attr: 'data-bx-image'}
		);
		</script>
		<div class="<?=$className?>" id="blg-post-<?=$arResult["Post"]["ID"]?>">
		<h2 class="blog-post-title"><span><?=$arResult["Post"]["TITLE"]?></span></h2>
		<div class="blog-post-info-back blog-post-info-top">
		<div class="blog-post-info">
			<?if ($arParams["SHOW_RATING"] == "Y"):?>
			<div class="blog-post-rating rating_vote_graphic">
			<?
			$APPLICATION->IncludeComponent(
				"bitrix:rating.vote", $arParams["RATING_TYPE"],
				Array(
					"ENTITY_TYPE_ID" => "BLOG_POST",
					"ENTITY_ID" => $arResult["Post"]["ID"],
					"OWNER_ID" => $arResult["Post"]["AUTHOR_ID"],
					"USER_VOTE" => $arResult["RATING"]["USER_VOTE"],
					"USER_HAS_VOTED" => $arResult["RATING"]["USER_HAS_VOTED"],
					"TOTAL_VOTES" => $arResult["RATING"]["TOTAL_VOTES"],
					"TOTAL_POSITIVE_VOTES" => $arResult["RATING"]["TOTAL_POSITIVE_VOTES"],
					"TOTAL_NEGATIVE_VOTES" => $arResult["RATING"]["TOTAL_NEGATIVE_VOTES"],
					"TOTAL_VALUE" => $arResult["RATING"]["TOTAL_VALUE"],
					"PATH_TO_USER_PROFILE" => $arParams["~PATH_TO_USER"],
				),
				$component,
				array("HIDE_ICONS" => "Y")
			);?>
			</div>
			<?endif;?>
			<div class="blog-author">
			<?if($arParams["SEO_USER"] == "Y"):?>
				<noindex>
					<a class="blog-author-icon" href="<?=$arResult["urlToAuthor"]?>" rel="nofollow"></a>
				</noindex>
			<?else:?>
				<a class="blog-author-icon" href="<?=$arResult["urlToAuthor"]?>"></a>
			<?endif;?>
			<?
			if (COption::GetOptionString("blog", "allow_alias", "Y") == "Y" && array_key_exists("ALIAS", $arResult["BlogUser"]) && strlen($arResult["BlogUser"]["ALIAS"]) > 0)
				$arTmpUser = array(
					"NAME" => "",
					"LAST_NAME" => "",
					"SECOND_NAME" => "",
					"LOGIN" => "",
					"NAME_LIST_FORMATTED" => $arResult["BlogUser"]["~ALIAS"],
				);
			elseif (strlen($arResult["urlToBlog"]) > 0 || strlen($arResult["urlToAuthor"]) > 0)
					$arTmpUser = array(
						"NAME" => $arResult["arUser"]["~NAME"],
						"LAST_NAME" => $arResult["arUser"]["~LAST_NAME"],
						"SECOND_NAME" => $arResult["arUser"]["~SECOND_NAME"],
						"LOGIN" => $arResult["arUser"]["~LOGIN"],
						"NAME_LIST_FORMATTED" => "",
					);
			?>
			<?if($arParams["SEO_USER"] == "Y"):?>
				<noindex>
			<?endif;?>
			<?		
			$APPLICATION->IncludeComponent("bitrix:main.user.link",
				'',
				array(
					"ID" => $arResult["arUser"]["ID"],
					"HTML_ID" => "blog_post_".$arResult["arUser"]["ID"],
					"NAME" => $arTmpUser["NAME"],
					"LAST_NAME" => $arTmpUser["LAST_NAME"],
					"SECOND_NAME" => $arTmpUser["SECOND_NAME"],
					"LOGIN" => $arTmpUser["LOGIN"],
					"NAME_LIST_FORMATTED" => $arTmpUser["NAME_LIST_FORMATTED"],
					"USE_THUMBNAIL_LIST" => "N",
					"PROFILE_URL" => $arResult["urlToAuthor"],
					"PROFILE_URL_LIST" => $arResult["urlToBlog"],
					"PATH_TO_SONET_MESSAGES_CHAT" => $arParams["~PATH_TO_MESSAGES_CHAT"],
					"PATH_TO_VIDEO_CALL" => $arParams["~PATH_TO_VIDEO_CALL"],
					"DATE_TIME_FORMAT" => $arParams["DATE_TIME_FORMAT"],
					"SHOW_YEAR" => $arParams["SHOW_YEAR"],
					"CACHE_TYPE" => $arParams["CACHE_TYPE"],
					"CACHE_TIME" => $arParams["CACHE_TIME"],
					"NAME_TEMPLATE" => $arParams["NAME_TEMPLATE"],
					"SHOW_LOGIN" => $arParams["SHOW_LOGIN"],
					"PATH_TO_CONPANY_DEPARTMENT" => $arParams["~PATH_TO_CONPANY_DEPARTMENT"],
					"PATH_TO_SONET_USER_PROFILE" => ($arParams["USE_SOCNET"] == "Y" ? $arParams["~PATH_TO_USER"] : $arParams["~PATH_TO_SONET_USER_PROFILE"]),
					"INLINE" => "Y",
					"SEO_USER" => $arParams["SEO_USER"],
				),
				false,
				array("HIDE_ICONS" => "Y")
			);
			?>
			<?if($arParams["SEO_USER"] == "Y"):?>
				</noindex>
			<?endif;?>
			</div>
			<div class="blog-post-date"><span class="blog-post-day"><?=$arResult["Post"]["DATE_PUBLISH_DATE"]?></span><span class="blog-post-time"><?=$arResult["Post"]["DATE_PUBLISH_TIME"]?></span><span class="blog-post-date-formated"><?=$arResult["Post"]["DATE_PUBLISH_FORMATED"]?></span></div>
		</div>
		</div>
		<div class="blog-post-content">
			<div class="blog-post-avatar"><?=$arResult["BlogUser"]["AVATAR_img"]?></div>
			<?=$arResult["Post"]["textFormated"]?>
			<?if(!empty($arResult["images"]))
			{
				?>
				<div class="feed-com-files">
					<div class="feed-com-files-title"><?=GetMessage("BLOG_PHOTO")?></div>
					<div class="feed-com-files-cont">
						<?
						foreach($arResult["images"] as $val)
						{
							?><span class="feed-com-files-photo"><img src="<?=$val["small"]?>" alt="" border="0" data-bx-image="<?=$val["full"]?>"></span><?
						}
						?>
					</div>
				</div>
				<?
			}?>
			<?if($arResult["POST_PROPERTIES"]["SHOW"] == "Y"):
				$eventHandlerID = false;
				$eventHandlerID = AddEventHandler('main', 'system.field.view.file', Array('CBlogTools', 'blogUFfileShow'));
				?>
				<div>
				<?foreach ($arResult["POST_PROPERTIES"]["DATA"] as $FIELD_NAME => $arPostField):?>
				<?if(!empty($arPostField["VALUE"])):?>
					<?=($FIELD_NAME=='UF_BLOG_POST_DOC' ? "" : "<b>".$arPostField["EDIT_FORM_LABEL"].":</b>&nbsp;")?>
							<?$APPLICATION->IncludeComponent(
								"bitrix:system.field.view", 
								$arPostField["USER_TYPE"]["USER_TYPE_ID"], 
								array("arUserField" => $arPostField), null, array("HIDE_ICONS"=>"Y"));?><br />
				<?endif;?>
				<?endforeach;?>
				</div>
				<?
				if ($eventHandlerID !== false && ( intval($eventHandlerID) > 0 ))
					RemoveEventHandler('main', 'system.field.view.file', $eventHandlerID);
			endif;?>
		</div>
			<div class="blog-post-meta">
				<div class="blog-post-info-bottom">
				<div class="blog-post-info">
					<div class="blog-author">
					<?if($arParams["SEO_USER"] == "Y"):?>
						<noindex>
							<a class="blog-author-icon" href="<?=$arResult["urlToAuthor"]?>" rel="nofollow"></a>
						</noindex>
					<?else:?>
						<a class="blog-author-icon" href="<?=$arResult["urlToAuthor"]?>"></a>
					<?endif;?>
					<?if($arParams["SEO_USER"] == "Y"):?>
						<noindex>
					<?endif;?>
					<?		
					$APPLICATION->IncludeComponent("bitrix:main.user.link",
						'',
						array(
							"ID" => $arResult["arUser"]["ID"],
							"HTML_ID" => "blog_post_".$arResult["arUser"]["ID"],
							"NAME" => $arTmpUser["NAME"],
							"LAST_NAME" => $arTmpUser["LAST_NAME"],
							"SECOND_NAME" => $arTmpUser["SECOND_NAME"],
							"LOGIN" => $arTmpUser["LOGIN"],
							"NAME_LIST_FORMATTED" => $arTmpUser["NAME_LIST_FORMATTED"],
							"USE_THUMBNAIL_LIST" => "N",
							"PROFILE_URL" => $arResult["urlToAuthor"],
							"PROFILE_URL_LIST" => $arResult["urlToBlog"],
							"PATH_TO_SONET_MESSAGES_CHAT" => $arParams["~PATH_TO_MESSAGES_CHAT"],
							"PATH_TO_VIDEO_CALL" => $arParams["~PATH_TO_VIDEO_CALL"],
							"DATE_TIME_FORMAT" => $arParams["DATE_TIME_FORMAT"],
							"SHOW_YEAR" => $arParams["SHOW_YEAR"],
							"CACHE_TYPE" => $arParams["CACHE_TYPE"],
							"CACHE_TIME" => $arParams["CACHE_TIME"],
							"NAME_TEMPLATE" => $arParams["NAME_TEMPLATE"],
							"SHOW_LOGIN" => $arParams["SHOW_LOGIN"],
							"PATH_TO_CONPANY_DEPARTMENT" => $arParams["~PATH_TO_CONPANY_DEPARTMENT"],
							"PATH_TO_SONET_USER_PROFILE" => ($arParams["USE_SOCNET"] == "Y" ? $arParams["~PATH_TO_USER"] : $arParams["~PATH_TO_SONET_USER_PROFILE"]),
							"INLINE" => "Y",
							"SEO_USER" => $arParams["SEO_USER"],
						),
						false,
						array("HIDE_ICONS" => "Y")
					);
					?>
					<?if($arParams["SEO_USER"] == "Y"):?>
						</noindex>
					<?endif;?>
					</div>
					<div class="blog-post-date"><span class="blog-post-day"><?=$arResult["Post"]["DATE_PUBLISH_DATE"]?></span><span class="blog-post-time"><?=$arResult["Post"]["DATE_PUBLISH_TIME"]?></span><span class="blog-post-date-formated"><?=$arResult["Post"]["DATE_PUBLISH_FORMATED"]?></span></div>
				</div>
				</div>
				<?
				if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y")
				{
					?><div class="blog-post-share">
						<noindex><?
						$APPLICATION->IncludeComponent("bitrix:main.share", "", array(
								"HANDLERS" => $arParams["SHARE_HANDLERS"],
								"PAGE_URL" => htmlspecialcharsback($arResult["urlToPost"]),
								"PAGE_TITLE" => $arResult["Post"]["~TITLE"],
								"SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
								"SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
								"ALIGN" => "right",
								"HIDE" => $arParams["SHARE_HIDE"],
							),
							$component,
							array("HIDE_ICONS" => "Y")
						);
						?></noindex>
					</div>
					<?
				}?>
				<div class="blog-post-meta-util">
					<span class="blog-post-views-link"><a href=""><span class="blog-post-link-caption"><?=GetMessage("BLOG_BLOG_BLOG_VIEWS")?></span><span class="blog-post-link-counter"><?=IntVal($arResult["Post"]["VIEWS"])?></span></a></span>
					<?if($arResult["Post"]["ENABLE_COMMENTS"] == "Y"):?>
						<span class="blog-post-comments-link"><a href=""><span class="blog-post-link-caption"><?=GetMessage("BLOG_BLOG_BLOG_COMMENTS")?></span><span class="blog-post-link-counter"><?=IntVal($arResult["Post"]["NUM_COMMENTS"])?></span></a></span>
					<?endif;?>
					<?if(strLen($arResult["urlToHide"])>0):?>
						<span class="blog-post-hide-link"><a href="javascript:if(confirm('<?=GetMessage("BLOG_MES_HIDE_POST_CONFIRM")?>')) window.location='<?=$arResult["urlToHide"]."&".bitrix_sessid_get()?>'"><span class="blog-post-link-caption"><?=GetMessage("BLOG_MES_HIDE")?></span></a></span>
					<?endif;?>
					<?if(strLen($arResult["urlToEdit"])>0):?>
						<span class="blog-post-edit-link"><a href="<?=$arResult["urlToEdit"]?>"><span class="blog-post-link-caption"><?=GetMessage("BLOG_BLOG_BLOG_EDIT")?></span></a></span>
					<?endif;?>
					<?if(strLen($arResult["urlToDelete"])>0):?>
						<span class="blog-post-delete-link"><a href="javascript:if(confirm('<?=GetMessage("BLOG_MES_DELETE_POST_CONFIRM")?>')) window.location='<?=$arResult["urlToDelete"]."&".bitrix_sessid_get()?>'"><span class="blog-post-link-caption"><?=GetMessage("BLOG_BLOG_BLOG_DELETE")?></span></a></span>
					<?endif;?>

					<?if ($arParams["SHOW_RATING"] == "Y"):?>
					<span class="rating_vote_text">
					<?
					$APPLICATION->IncludeComponent(
						"bitrix:rating.vote", $arParams["RATING_TYPE"],
						Array(
							"ENTITY_TYPE_ID" => "BLOG_POST",
							"ENTITY_ID" => $arResult["Post"]["ID"],
							"OWNER_ID" => $arResult["Post"]["AUTHOR_ID"],
							"USER_VOTE" => $arResult["RATING"]["USER_VOTE"],
							"USER_HAS_VOTED" => $arResult["RATING"]["USER_HAS_VOTED"],
							"TOTAL_VOTES" => $arResult["RATING"]["TOTAL_VOTES"],
							"TOTAL_POSITIVE_VOTES" => $arResult["RATING"]["TOTAL_POSITIVE_VOTES"],
							"TOTAL_NEGATIVE_VOTES" => $arResult["RATING"]["TOTAL_NEGATIVE_VOTES"],
							"TOTAL_VALUE" => $arResult["RATING"]["TOTAL_VALUE"],
							"PATH_TO_USER_PROFILE" => $arParams["~PATH_TO_USER"],
						),
						$component,
						array("HIDE_ICONS" => "Y")
					);?>
					</span>
					<?endif;?>
				</div>
				
				<?if(!empty($arResult["Category"]))
				{
					?>
					<div class="blog-post-tag">
						<noindex>
						<?=GetMessage("BLOG_BLOG_BLOG_CATEGORY")?>
						<?
						$i=0;
						foreach($arResult["Category"] as $v)
						{
							if($i!=0)
								echo ",";
							?> <a href="<?=$v["urlToCategory"]?>" rel="nofollow"><?=$v["NAME"]?></a><?
							$i++;
						}
						?>
						</noindex>
					</div>
					<?
				}
				?>
			</div>
		</div>
		<?
	}
	else
		echo GetMessage("BLOG_BLOG_BLOG_NO_AVAIBLE_MES");
}
?>



<?
*/
?>


</div>