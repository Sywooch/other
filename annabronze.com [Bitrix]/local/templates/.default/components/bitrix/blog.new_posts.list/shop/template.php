<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if (!$this->__component->__parent || empty($this->__component->__parent->__name) || $this->__component->__parent->__name != "bitrix:blog"):
	$GLOBALS['APPLICATION']->SetAdditionalCSS('/bitrix/components/bitrix/blog/templates/.default/style.css');
	$GLOBALS['APPLICATION']->SetAdditionalCSS('/bitrix/components/bitrix/blog/templates/.default/themes/blue/style.css');
endif;
?>
<?CUtil::InitJSCore(array("image"));?>


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

								$count = 0;
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
									if($count == 5){ break; }
									$count++;
								}
								?>
							</div>
						</div>

						<?
						}
						?>


					<div class="b-blog-list__counts">
						<div class="b-blog-list__counts-item _views">
							<a href="<?=$CurPost["urlToPost"]?>">
								<?=GetMessage("BLOG_VIEWS")?>: <span><?=IntVal($CurPost["VIEWS"]);?></span>
							</a>
						</div>
						<div class="b-blog-list__counts-item _comments">
							<a href="<?=$CurPost["urlToPost"]?>#comments">
								<?=GetMessage("BLOG_COMMENTS")?>: <span><?=IntVal($CurPost["NUM_COMMENTS"]);?></span>
							</a>
						</div>
						

								<?


								$APPLICATION->IncludeComponent(
									"bitrix:rating.vote", "like_shop_list",//
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
										"LINK_TO_DETAIL" => $CurPost["urlToPost"]
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




<? /* ?>


<div id="blog-new-posts-content">
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
			<script>
			BX.viewImageBind(
				'blg-post-<?=$CurPost["ID"]?>',
				{showTitle: false},
				{tag:'IMG', attr: 'data-bx-image'}
			);
			</script>
			<div class="<?=$className?>" id="blg-post-<?=$CurPost["ID"]?>">


		<?

        ?>
                        <h2 class="blog-post-title"><a href="<?=$CurPost["urlToPost"]?>" title="<?=$CurPost["TITLE"]?>"><?=$CurPost["TITLE"]?></a></h2>
                        <div class="blog-post-info-back blog-post-info-top">
                        <div class="blog-post-info">
                            <?if ($arParams["SHOW_RATING"] == "Y"):?>
                            <div class="blog-post-rating rating_vote_graphic">
                            <?
                            $APPLICATION->IncludeComponent(
                                "bitrix:rating.vote", $arParams["RATING_TYPE"],
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
                            <?endif;?>
                            <div class="blog-author">
                            <?if($arParams["SEO_USER"] == "Y"):?>
                                <noindex>
                                    <a class="blog-author-icon" href="<?=$CurPost["urlToAuthor"]?>" rel="nofollow"></a>
                                </noindex>
                            <?else:?>
                                <a class="blog-author-icon" href="<?=$CurPost["urlToAuthor"]?>"></a>
                            <?endif;?>
                            <?
                            if (COption::GetOptionString("blog", "allow_alias", "Y") == "Y" && (strlen($CurPost["urlToBlog"]) > 0 || strlen($CurPost["urlToAuthor"]) > 0) && array_key_exists("BLOG_USER_ALIAS", $CurPost) && strlen($CurPost["BLOG_USER_ALIAS"]) > 0)
                                $arTmpUser = array(
                                    "NAME" => "",
                                    "LAST_NAME" => "",
                                    "SECOND_NAME" => "",
                                    "LOGIN" => "",
                                    "NAME_LIST_FORMATTED" => $CurPost["~BLOG_USER_ALIAS"],
                                );
                            elseif (strlen($CurPost["urlToBlog"]) > 0 || strlen($CurPost["urlToAuthor"]) > 0)
                                $arTmpUser = array(
                                    "NAME" => $CurPost["~AUTHOR_NAME"],
                                    "LAST_NAME" => $CurPost["~AUTHOR_LAST_NAME"],
                                    "SECOND_NAME" => $CurPost["~AUTHOR_SECOND_NAME"],
                                    "LOGIN" => $CurPost["~AUTHOR_LOGIN"],
                                    "NAME_LIST_FORMATTED" => "",
                                );
                            ?>
                            <?if($arParams["SEO_USER"] == "Y"):?>
                                <noindex>
                            <?endif;?>
                            <?
                            $GLOBALS["APPLICATION"]->IncludeComponent("bitrix:main.user.link",
                                '',
                                array(
                                    "ID" => $CurPost["AUTHOR_ID"],
                                    "HTML_ID" => "blog_new_posts_list_".$CurPost["AUTHOR_ID"],
                                    "NAME" => $arTmpUser["NAME"],
                                    "LAST_NAME" => $arTmpUser["LAST_NAME"],
                                    "SECOND_NAME" => $arTmpUser["SECOND_NAME"],
                                    "LOGIN" => $arTmpUser["LOGIN"],
                                    "NAME_LIST_FORMATTED" => $arTmpUser["NAME_LIST_FORMATTED"],
                                    "USE_THUMBNAIL_LIST" => "N",
                                    "PROFILE_URL" => $CurPost["urlToAuthor"],
                                    "PROFILE_URL_LIST" => $CurPost["urlToBlog"],
                                    "PATH_TO_SONET_MESSAGES_CHAT" => $arParams["~PATH_TO_MESSAGES_CHAT"],
                                    "PATH_TO_VIDEO_CALL" => $arParams["~PATH_TO_VIDEO_CALL"],
                                    "DATE_TIME_FORMAT" => $arParams["DATE_TIME_FORMAT"],
                                    "SHOW_YEAR" => $arParams["SHOW_YEAR"],
                                    "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                                    "CACHE_TIME" => $arParams["CACHE_TIME"],
                                    "NAME_TEMPLATE" => $arParams["NAME_TEMPLATE"],
                                    "SHOW_LOGIN" => $arParams["SHOW_LOGIN"],
                                    "PATH_TO_CONPANY_DEPARTMENT" => $arParams["~PATH_TO_CONPANY_DEPARTMENT"],
                                    "PATH_TO_SONET_USER_PROFILE" => $arParams["~PATH_TO_SONET_USER_PROFILE"],
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
                            <div class="blog-post-date"><span class="blog-post-day"><?=$CurPost["DATE_PUBLISH_DATE"]?></span><span class="blog-post-time"><?=$CurPost["DATE_PUBLISH_TIME"]?></span><span class="blog-post-date-formated"><?=$CurPost["DATE_PUBLISH_FORMATED"]?></span></div>
                        </div>
                        </div>
                        <div class="blog-post-content">
                            <div class="blog-post-avatar"><?=$CurPost["BlogUser"]["AVATAR_img"]?></div>
                            <?=$CurPost["TEXT_FORMATED"]?>
                            <?
                            if ($CurPost["CUT"] == "Y")
                            {
                                ?><p><a class="blog-postmore-link" href="<?=$CurPost["urlToPost"]?>"><?=GetMessage("BLOG_BLOG_BLOG_MORE")?></a></p><?
                            }
                            ?>
                            <?if(!empty($CurPost["arImages"]))
                            {
                                ?>
                                <div class="feed-com-files">
                                    <div class="feed-com-files-title"><?=GetMessage("BLOG_PHOTO")?></div>
                                    <div class="feed-com-files-cont">


                                        <?

                                        foreach($CurPost["arImages"] as $val)
                                        {
                                            ?><span class="feed-com-files-photo"><img src="<?=$val["small"]?>" alt="" border="0" data-bx-image="<?=$val["full"]?>"></span><?
                                        }

                                        ?>
                                    </div>
                                </div>
                                <?
                            }?>
                            <?if($CurPost["POST_PROPERTIES"]["SHOW"] == "Y"):
                                $eventHandlerID = false;
                                $eventHandlerID = AddEventHandler('main', 'system.field.view.file', Array('CBlogTools', 'blogUFfileShow'));
                                ?>
                                <?foreach ($CurPost["POST_PROPERTIES"]["DATA"] as $FIELD_NAME => $arPostField):?>
                                <?if(!empty($arPostField["VALUE"])):?>
                                <div>
                                <?=($FIELD_NAME=='UF_BLOG_POST_DOC' ? "" : "<b>".$arPostField["EDIT_FORM_LABEL"].":</b>&nbsp;")?>
                                    <?$APPLICATION->IncludeComponent(
                                        "bitrix:system.field.view",
                                        $arPostField["USER_TYPE"]["USER_TYPE_ID"],
                                        array("arUserField" => $arPostField), null, array("HIDE_ICONS"=>"Y"));?>
                                </div>
                                <?endif;?>
                                <?endforeach;?>
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
                                            <a class="blog-author-icon" href="<?=$CurPost["urlToAuthor"]?>" rel="nofollow"></a>
                                        </noindex>
                                    <?else:?>
                                        <a class="blog-author-icon" href="<?=$CurPost["urlToAuthor"]?>"></a>
                                    <?endif;?>
                                    <?if($arParams["SEO_USER"] == "Y"):?>
                                        <noindex>
                                    <?endif;?>
                                    <?
                                    $GLOBALS["APPLICATION"]->IncludeComponent("bitrix:main.user.link",
                                        '',
                                        array(
                                            "ID" => $CurPost["AUTHOR_ID"],
                                            "HTML_ID" => "blog_new_posts_list_".$CurPost["AUTHOR_ID"],
                                            "NAME" => $arTmpUser["NAME"],
                                            "LAST_NAME" => $arTmpUser["LAST_NAME"],
                                            "SECOND_NAME" => $arTmpUser["SECOND_NAME"],
                                            "LOGIN" => $arTmpUser["LOGIN"],
                                            "NAME_LIST_FORMATTED" => $arTmpUser["NAME_LIST_FORMATTED"],
                                            "USE_THUMBNAIL_LIST" => "N",
                                            "PROFILE_URL" => $CurPost["urlToAuthor"],
                                            "PROFILE_URL_LIST" => $CurPost["urlToBlog"],
                                            "PATH_TO_SONET_MESSAGES_CHAT" => $arParams["~PATH_TO_MESSAGES_CHAT"],
                                            "PATH_TO_VIDEO_CALL" => $arParams["~PATH_TO_VIDEO_CALL"],
                                            "DATE_TIME_FORMAT" => $arParams["DATE_TIME_FORMAT"],
                                            "SHOW_YEAR" => $arParams["SHOW_YEAR"],
                                            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                                            "CACHE_TIME" => $arParams["CACHE_TIME"],
                                            "NAME_TEMPLATE" => $arParams["NAME_TEMPLATE"],
                                            "SHOW_LOGIN" => $arParams["SHOW_LOGIN"],
                                            "PATH_TO_CONPANY_DEPARTMENT" => $arParams["~PATH_TO_CONPANY_DEPARTMENT"],
                                            "PATH_TO_SONET_USER_PROFILE" => $arParams["~PATH_TO_SONET_USER_PROFILE"],
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
                                    <div class="blog-post-date"><span class="blog-post-day"><?=$CurPost["DATE_PUBLISH_DATE"]?></span><span class="blog-post-time"><?=$CurPost["DATE_PUBLISH_TIME"]?></span><span class="blog-post-date-formated"><?=$CurPost["DATE_PUBLISH_FORMATED"]?></span></div>
                                </div>
                            </div>
                            <?
                            if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y")
                            {
                                ?>
                                <div class="blog-post-share" style="float: right;">
                                    <noindex>
                                    <?
                                    $APPLICATION->IncludeComponent("bitrix:main.share", "", array(
                                            "HANDLERS" => $arParams["SHARE_HANDLERS"],
                                            "PAGE_URL" => htmlspecialcharsback($CurPost["urlToPost"]),
                                            "PAGE_TITLE" => htmlspecialcharsback($CurPost["TITLE"]),
                                            "SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
                                            "SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
                                            "ALIGN" => "right",
                                            "HIDE" => $arParams["SHARE_HIDE"],
                                        ),
                                        $component,
                                        array("HIDE_ICONS" => "Y")
                                    );
                                    ?>
                                    </noindex>
                                </div>
                                <?
                            }
                            ?>
                            <div class="blog-post-meta-util">
                                <span class="blog-post-views-link"><a href="<?=$CurPost["urlToPost"]?>"><?=GetMessage("BLOG_BLOG_BLOG_VIEWS")?> <?=IntVal($CurPost["VIEWS"]);?></a></span>
                                <span class="blog-post-comments-link"><a href="<?=$CurPost["urlToPost"]?>#comments"><?=GetMessage("BLOG_BLOG_BLOG_COMMENTS")?> <?=IntVal($CurPost["NUM_COMMENTS"]);?></a></span>
                                <?if ($arParams["SHOW_RATING"] == "Y"):?>
                                <span class="rating_vote_text">
                                <?
                                $APPLICATION->IncludeComponent(
                                    "bitrix:rating.vote", $arParams["RATING_TYPE"],
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
                                </span>
                                <?endif;?>
                            </div>

                            <div class="blog-post-tag">
                                <noindex>
                                <?
                                if(!empty($CurPost["CATEGORY"]))
                                {
                                    echo GetMessage("BLOG_BLOG_BLOG_CATEGORY");
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
                                </noindex>
                            </div>
                        </div>
			        <?

		?>

                    </div>


                <?
            }
            if(strlen($arResult["NAV_STRING"])>0)
                echo $arResult["NAV_STRING"];
        }
        ?>
        </div><? */ ?>

