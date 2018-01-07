<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
CUtil::InitJSCore(array('ajax', 'fx')); 
// ************************* Input params***************************************************************
$arParams["SHOW_LINK_TO_FORUM"] = ($arParams["SHOW_LINK_TO_FORUM"] == "N" ? "N" : "Y");
$arParams["FILES_COUNT"] = intVal(intVal($arParams["FILES_COUNT"]) > 0 ? $arParams["FILES_COUNT"] : 1);
$arParams["IMAGE_SIZE"] = (intVal($arParams["IMAGE_SIZE"]) > 0 ? $arParams["IMAGE_SIZE"] : 100);
if (LANGUAGE_ID == 'ru'):
	$path = str_replace(array("\\", "//"), "/", dirname(__FILE__)."/ru/script.php");
	include($path);
endif;

// *************************/Input params***************************************************************
?>









<?

?>



	<div class="b-comments">
		<div class="grid-container">
			<div class="grid-row col-1 col-s-12"></div>
			<div class="grid-row col-11 col-s-12">
				<div class="b-comments__title"><?=GetMessage("COMMENTS");?></div>
			</div>
		</div>



		<div class="b-comments__form grid-container">
		<form name="REPLIER<?=$arParams["form_index"]?>" id="REPLIER<?=$arParams["form_index"]?>" action="<?=POST_FORM_ACTION_URI?>#postform"<?
		?> method="POST" enctype="multipart/form-data" onsubmit="return ValidateForm(this, '<?=$arParams["AJAX_TYPE"]?>', '<?=$arParams["AJAX_POST"]?>', '<?=$arParams["PREORDER"]?>');"<?
		?>>
			<input type="hidden" name="back_page" value="<?=$arResult["CURRENT_PAGE"]?>" />
			<input type="hidden" name="ELEMENT_ID" value="<?=$arParams["ELEMENT_ID"]?>" />
			<input type="hidden" name="SECTION_ID" value="<?=$arResult["ELEMENT_REAL"]["IBLOCK_SECTION_ID"]?>" />
			<input type="hidden" name="save_product_review" value="Y" />
			<input type="hidden" name="preview_comment" value="N" />
			<?=bitrix_sessid_post()?>
			<?
			if ($arParams['AUTOSAVE'])
				$arParams['AUTOSAVE']->Init();
			?>


			<div class="grid-row col-1 col-s-12"></div>
			<div class="b-comments__form-col grid-row col-4 col-s-12">
				<textarea class="b-form__textarea review-text" placeholder="<?=GetMessage("COMMENT");?>"
						  name="REVIEW_TEXT"></textarea>



			</div>


			<?
			if(empty($arResult["REVIEW_EMAIL"])){
				global $USER;
				$arResult["REVIEW_EMAIL"] = $USER->GetEmail();
			}
			?>



			<div class="b-comments__form-col grid-row col-3 col-s-12">
				<input name="REVIEW_AUTHOR" id="REVIEW_AUTHOR<?=$arParams["form_index"]?>"
					   placeholder="<?=GetMessage("AUTHOR");?>" type="text" class="b-form__input"
					   value="<? if($arResult["REVIEW_AUTHOR"] != "Guest"){ echo $arResult["REVIEW_AUTHOR"]; } ?>">
				<input name="REVIEW_EMAIL" id="REVIEW_EMAIL<?=$arParams["form_index"]?>"
					   placeholder="<?=GetMessage("E_MAIL");?>" type="text" class="b-form__input"
					   value="<?=$arResult["REVIEW_EMAIL"]?>">

			</div>











			<div class="b-comments__form-col grid-row col-3 col-s-12">
				<button name="send_button" type="submit"
						onclick="this.form.preview_comment.value = 'N';"
						class="btn _full"><?=GetMessage("COMMENT_BUTTON");?></button>
				<div class="b-comments__form-notice"> <!--  b-comments__form-error-->
					<?=GetMessage("COMMENT_NOTICE");?>
				</div>


			</div>





		</form>
		</div>









		<div class="grid-container">
			<div class="grid-row col-1 col-s-12"></div>
			<div class="grid-row col-10 col-s-12">
				<div class="b-comments__list">


					<?
					if (empty($arResult["ERROR_MESSAGE"]) && !empty($arResult["OK_MESSAGE"])):
						?>
						<div class="b-comments__item">

							<div class="b-comments__item-text"><?=ShowNote($arResult["OK_MESSAGE"]);?></div>
						</div>
						<?
					endif;
					?>


					<div class="b-comments__item" <?=(($arParams['SHOW_MINIMIZED'] == "Y")?'style="display:none;"':'')?>>
						<a name="review_anchor"></a>
						<?
						if (!empty($arResult["ERROR_MESSAGE"])):
							?>

								<div class="b-comments__item-text"><?=ShowError($arResult["ERROR_MESSAGE"], "reviews-note-error");?></div>

							<?
						endif;
						?>

					</div>



					<?if(count($arResult["MESSAGES"])==0):?>
						<div class="b-comments__item-text"><!-- b-comments__form-success -->
							<?=GetMessage("NO_REVIEWS");?>
						</div>
					<?endif;?>



					<?
					$iCount = 0;
					foreach ($arResult["MESSAGES"] as $res):
						$iCount++;
						?>

						<?if ($iCount>0):?><script>$("#product_reviews_title .count").removeClass("empty").html("&nbsp;(<?=$iCount?>)")</script><?endif;?>




						<div class="b-comments__item" style="border-bottom:0px;">
							<a name="message<?=$res["ID"]?>"></a>
							<div class="b-comments__item-meta">
								<div class="b-comments__item-name"><?=$res["AUTHOR_NAME"]?></div>
								<div class="b-comments__item-date"><?=$DB->FormatDate($res["POST_DATE"], "DD.MM.YYYY", "DD | MM | YYYY");?></div>
							</div>
							<div class="b-comments__item-text" id="message_text_<?=$res["ID"]?>">
								<?=$res["POST_MESSAGE_TEXT"]?>
							</div>

							<?  if ($arResult["SHOW_POST_FORM"] == "Y") { ?>
								<div class="reviews-post-reply-buttons">
									<!--noindex-->
									<?			if ($arResult["PANELS"]["MODERATE"] == "Y") { ?>

										<a style='margin-left:0;' rel="nofollow" href="<?=$res["URL"]["MODERATE"]?>" class="reviews-button-small" <? if ($arParams['AJAX_POST'] == 'Y') { ?>onclick="return replyActionComment(this, 'MODERATE');"<? } ?>><?=GetMessage((($res["APPROVED"] == 'Y') ? "F_HIDE" : "F_SHOW"))?></a>
									<?			} ?>
									<?			if ($arResult["PANELS"]["DELETE"] == "Y") { ?>
										<span class="separator"></span>
										<a rel="nofollow" href="<?=$res["URL"]["DELETE"]?>" class="reviews-button-small" <? if ($arParams['AJAX_POST'] == 'Y') { ?>onclick="return replyActionComment(this, 'DEL');"<? } ?>><?=GetMessage("F_DELETE")?></a>
									<?			} ?>
									<?			if ($arParams["SHOW_RATING"] == "Y") { ?>
										<span class="rating_vote_text">
			<span class="separator"></span>
											<?
											$arRatingParams = Array(
												"ENTITY_TYPE_ID" => "FORUM_POST",
												"ENTITY_ID" => $res["ID"],
												"OWNER_ID" => $res["AUTHOR_ID"],
												"PATH_TO_USER_PROFILE" => strlen($arParams["PATH_TO_USER"]) > 0? $arParams["PATH_TO_USER"]: $arParams["~URL_TEMPLATES_PROFILE_VIEW"]
											);
											if (!isset($res['RATING']))
												$res['RATING'] = array(
													"USER_VOTE" => 0,
													"USER_HAS_VOTED" => 'N',
													"TOTAL_VOTES" => 0,
													"TOTAL_POSITIVE_VOTES" => 0,
													"TOTAL_NEGATIVE_VOTES" => 0,
													"TOTAL_VALUE" => 0
												);
											$arRatingParams = array_merge($arRatingParams, $res['RATING']);
											$GLOBALS["APPLICATION"]->IncludeComponent( "bitrix:rating.vote", $arParams["RATING_TYPE"], $arRatingParams, $component, array("HIDE_ICONS" => "Y"));
											?>
			</span>
									<?			} ?>
									<!--noindex-->
								</div>
							<?  } ?>

						</div>



						<?
					endforeach;
					?>











				</div>
			</div>
		</div>

	</div>




<?
if (!empty($arResult["MESSAGES"])):
if ($arResult["NAV_RESULT"] && $arResult["NAV_RESULT"]->NavPageCount > 1):
?>
<div class="reviews-navigation-box reviews-navigation-top">
	<div class="reviews-page-navigation">
		<?=$arResult["NAV_STRING"]?>
	</div>
	<div class="reviews-clear-float"></div>
</div>
<?
endif;

?>
<div class="reviews-block-container reviews-reviews-block-container">
	<div class="reviews-block-outer">
		<div class="reviews-block-inner">
		

		</div>
	</div>
</div>
<?

if (strlen($arResult["NAV_STRING"]) > 0 && $arResult["NAV_RESULT"]->NavPageCount > 1):
?>
<div class="reviews-navigation-box reviews-navigation-bottom">
	<div class="reviews-page-navigation">
		<?=$arResult["NAV_STRING"]?>
	</div>
	<div class="reviews-clear-float"></div>
</div>
<?
endif;


if (!empty($arResult["read"]) && $arParams["SHOW_LINK_TO_FORUM"] != "N"):
?>
<div class="reviews-link-box">
	<div class="reviews-link-box-text">
		<a href="<?=$arResult["read"]?>"><?=GetMessage("F_C_GOTO_FORUM");?></a>
	</div>
</div>

<?
endif;

endif;
?>

<?


if (!empty($arResult["MESSAGE_VIEW"])):
?>
<div class="reviews-preview">
<div class="reviews-header-box">
	<div class="reviews-header-title"><span><?=GetMessage("F_PREVIEW")?></span></div>
</div>

<div class="reviews-info-box reviews-post-preview">
	<div class="reviews-info-box-inner">
		<div class="reviews-post-entry">
			<div class="reviews-post-text"><?=$arResult["MESSAGE_VIEW"]["POST_MESSAGE_TEXT"]?></div>
<?
		if (!empty($arResult["REVIEW_FILES"])):
?>
			<div class="reviews-post-attachments">
				<label><?=GetMessage("F_ATTACH_FILES")?></label>
<?
			foreach ($arResult["REVIEW_FILES"] as $arFile): 
?>
				<div class="reviews-post-attachment"><?
				?><?$GLOBALS["APPLICATION"]->IncludeComponent(
					"bitrix:forum.interface", "show_file",
					Array(
						"FILE" => $arFile,
						"WIDTH" => $arResult["PARSER"]->image_params["width"],
						"HEIGHT" => $arResult["PARSER"]->image_params["height"],
						"CONVERT" => "N",
						"FAMILY" => "FORUM",
						"SINGLE" => "Y",
						"RETURN" => "N",
						"SHOW_LINK" => "Y"),
					null,
					array("HIDE_ICONS" => "Y"));
				?></div>
<?
			endforeach;
?>
			</div>
<?
		endif;
?>
		</div>
	</div>
</div>
<div class="reviews-br"></div>
</div>
<?
endif;
?>

<?
?>












<?/* if ($arParams['SHOW_MINIMIZED'] == "Y") { ?>
<div class="reviews-collapse reviews-minimized" style='position:relative; float:none;'>
	<a class="button reviews-collapse-link" onclick="fToggleCommentsForm(this)" href="javascript:void(0);"><span><?=$arParams['MINIMIZED_EXPAND_TEXT']?></span></a>
</div>
<? } */?>


<script type="text/javascript">

if (typeof oErrors != "object")
	var oErrors = {};
oErrors['no_topic_name'] = "<?=CUtil::addslashes(GetMessage("JERROR_NO_TOPIC_NAME"))?>";
oErrors['no_message'] = "<?=CUtil::addslashes(GetMessage("JERROR_NO_MESSAGE"))?>";
oErrors['max_len'] = "<?=CUtil::addslashes(GetMessage("JERROR_MAX_LEN"))?>";
oErrors['no_url'] = "<?=CUtil::addslashes(GetMessage("FORUM_ERROR_NO_URL"))?>";
oErrors['no_title'] = "<?=CUtil::addslashes(GetMessage("FORUM_ERROR_NO_TITLE"))?>";
oErrors['no_path'] = "<?=CUtil::addslashes(GetMessage("FORUM_ERROR_NO_PATH_TO_VIDEO"))?>";

oErrors['no_author'] = "<?=CUtil::addslashes(GetMessage("FORUM_ERROR_NO_AUTHOR"))?>";
oErrors['no_mail'] = "<?=CUtil::addslashes(GetMessage("FORUM_ERROR_NO_MAIL"))?>";
oErrors['error_mail'] = "<?=CUtil::addslashes(GetMessage("FORUM_ERROR_ERROR_MAIL"))?>";

if (typeof oText != "object")
	var oText = {};
oText['author'] = " <?=CUtil::addslashes(GetMessage("JQOUTE_AUTHOR_WRITES"))?>:\n";
oText['enter_url'] = "<?=CUtil::addslashes(GetMessage("FORUM_TEXT_ENTER_URL"))?>";
oText['enter_url_name'] = "<?=CUtil::addslashes(GetMessage("FORUM_TEXT_ENTER_URL_NAME"))?>";
oText['enter_image'] = "<?=CUtil::addslashes(GetMessage("FORUM_TEXT_ENTER_IMAGE"))?>";
oText['list_prompt'] = "<?=CUtil::addslashes(GetMessage("FORUM_LIST_PROMPT"))?>";
oText['video'] = "<?=CUtil::addslashes(GetMessage("FORUM_VIDEO"))?>";
oText['path'] = "<?=CUtil::addslashes(GetMessage("FORUM_PATH"))?>:";
oText['preview'] = "<?=CUtil::addslashes(GetMessage("FORUM_PREVIEW"))?>:";
oText['width'] = "<?=CUtil::addslashes(GetMessage("FORUM_WIDTH"))?>:";
oText['height'] = "<?=CUtil::addslashes(GetMessage("FORUM_HEIGHT"))?>:";
oText['cdm'] = '<?=CUtil::addslashes(GetMessage("F_DELETE_CONFIRM"))?>';
oText['show'] = '<?=CUtil::addslashes(GetMessage("F_SHOW"))?>';
oText['hide'] = '<?=CUtil::addslashes(GetMessage("F_HIDE"))?>';
oText['wait'] = '<?=CUtil::addslashes(GetMessage("F_WAIT"))?>';

oText['BUTTON_OK'] = "<?=CUtil::addslashes(GetMessage("FORUM_BUTTON_OK"))?>";
oText['BUTTON_CANCEL'] = "<?=CUtil::addslashes(GetMessage("FORUM_BUTTON_CANCEL"))?>";
oText['smile_hide'] = "<?=CUtil::addslashes(GetMessage("F_HIDE_SMILE"))?>";
oText['MINIMIZED_EXPAND_TEXT'] = "<?=CUtil::addslashes($arParams["MINIMIZED_EXPAND_TEXT"])?>";
oText['MINIMIZED_MINIMIZE_TEXT'] = "<?=CUtil::addslashes($arParams["MINIMIZED_MINIMIZE_TEXT"])?>";

if (typeof oForum != "object")
	var oForum = {};
oForum.page_number = <?=intval($arResult['PAGE_NUMBER']);?>;
oForum.page_count = <?=intval($arResult['PAGE_COUNT']);?>;

if (typeof oHelp != "object")
	var oHelp = {};
if (typeof phpVars != "object")
	var phpVars = {};
phpVars.bitrix_sessid = '<?=bitrix_sessid()?>';

function reviewsCtrlEnterHandler<?=CUtil::JSEscape($arParams["form_index"]);?>()
{
	if (window.oLHE)
		window.oLHE.SaveContent();
	var form = document.forms["REPLIER<?=CUtil::JSEscape($arParams["form_index"]);?>"];
	if (BX.fireEvent(form, 'submit'))
		form.submit();
}

function replyForumFormOpen()
{
<? if ($arParams['SHOW_MINIMIZED'] == "Y") { ?>
	var link = BX.findChild(document, {'class': 'reviews-collapse-link'}, true);
	if (link) fToggleCommentsForm(link, true);
<? } ?>
	return;
}

function fToggleCommentsForm(link, forceOpen)
{
	if (forceOpen == null) forceOpen = false;
	forceOpen = !!forceOpen;
	var form = BX.findChild(link.parentNode.parentNode, {'class':'reviews-reply-form'}, true);
	var bHidden = (form.style.display != 'block') || forceOpen;
	$(".reviews-reply-form").slideToggle(200);
	form.style.display = (bHidden ? 'block' : 'none');
	link.innerHTML = (bHidden ? "<span>"+oText['MINIMIZED_MINIMIZE_TEXT']+"</span>" : "<span>"+oText['MINIMIZED_EXPAND_TEXT']+"</span>");
	var classAdd = (bHidden ? 'reviews-expanded' : 'reviews-minimized');
	var classRemove = (bHidden ? 'reviews-minimized' : 'reviews-expanded');
	BX.removeClass(BX.addClass(link.parentNode, classAdd), classRemove);
	//BX.scrollToNode(BX.findChild(form, {'attribute': { 'name' : 'send_button' }}, true));
	if (window.oLHE)
		setTimeout(function() {
				if (!BX.browser.IsIE())
					window.oLHE.SetFocusToEnd();
				else
					window.oLHE.SetFocus();
			}, 100);
}

function reply2author(name) {
	name = name.replace(/&lt;/gi, "<").replace(/&gt;/gi, ">").replace(/&quot;/gi, "\"");
	if (!!window.oLHE && !!name)
	{
		replyForumFormOpen();
		name = name.replace(/&lt;/gi, "<").replace(/&gt;/gi, ">").replace(/&quot;/gi, "\"");
		if (window.oLHE.sEditorMode == 'code' && window.oLHE.bBBCode) { // BB Codes
		<?if ($arResult["FORUM"]["ALLOW_BIU"] == "Y") { ?> name = '[B]' + name + '[/B]';<? } ?>
			window.oLHE.WrapWith("", ", ", name);
		} else if (window.oLHE.sEditorMode == 'html') { // WYSIWYG
		<?if ($arResult["FORUM"]["ALLOW_BIU"] == "Y") { ?> name = '<b>' + name + '</b>, ';<? } ?>
			window.oLHE.InsertHTML(name);
		}
		window.oLHE.SetFocus();
		BX.defer(window.oLHE.SetFocus, window.oLHE)();
	}
	return false;
}

BX(function() {
	BX.addCustomEvent(window,  'LHE_OnInit', function(lightEditor)
	{
		BX.addCustomEvent(lightEditor, 'onShow', function() {
			BX.style(BX('bxlhe_frame_REVIEW_TEXT').parentNode, 'width', '100%');
		});
	});
});
</script>
<?
if ($arParams['AUTOSAVE'])
	$arParams['AUTOSAVE']->LoadScript(array(
		"formID" => "REPLIER".CUtil::JSEscape($arParams["form_index"]),
		"controlID" => "REVIEW_TEXT"
	));
?>
<?=ForumAddDeferredScript($this->GetFolder().'/script_deferred.js')?>

<?if ($arResult["ERROR_MESSAGE"] || $arResult["OK_MESSAGE"]):?>	
	<script>
		$("#product_reviews_title").parents("li").addClass("current").siblings().removeClass('current').parents('.tabs_section').find('.box').eq($(this).index()).fadeIn(100).siblings('.box').hide();
	</script>
<?endif;?>



