<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if (!$this->__component->__parent || empty($this->__component->__parent->__name) || $this->__component->__parent->__name != "bitrix:blog"):
	$GLOBALS['APPLICATION']->SetAdditionalCSS('/bitrix/components/bitrix/blog/templates/.default/style.css');
	$GLOBALS['APPLICATION']->SetAdditionalCSS('/bitrix/components/bitrix/blog/templates/.default/themes/blue/style.css');
endif;



?>
<?CUtil::InitJSCore(array("image", "ajax"));?>

	<div class="clear"></div>




<script>
BX.viewImageBind(
	'blg-comment-<?=$arParams["ID"]?>',
	false, 
	{tag:'IMG', attr: 'data-bx-image'}
);
</script>
<a name="comments"></a>
<div class="blog-comments" id="blg-comment-<?=$arParams["ID"]?>">



	<div class="b-comments margin-top-medium">
		<div class="grid-container">
			<div class="grid-row col-1 col-s-12"></div>
			<div class="grid-row col-11 col-s-12">
				<div class="b-comments__title"><?=GetMessage("COMMENTS");?></div>
			</div>
		</div>




<a name="comments"></a>
<?
if($arResult["is_ajax_post"] != "Y")
	include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/script.php");
else
{
	$APPLICATION->RestartBuffer();
	?><script>window.BX = top.BX;
		<?
		if($arResult["use_captcha"]===true)
		{
			?>
				BX('captcha').src='/bitrix/tools/captcha.php?captcha_code=' + '<?=$arResult["CaptchaCode"]?>';
				BX('captcha_code').value = '<?=$arResult["CaptchaCode"]?>';
				BX('captcha_word').value = "";
			<?
		}
	?>
	if(!top.arImages)
		top.arImages = [];
	if(!top.arImagesId)
		top.arImagesId = [];
	<?
	foreach($arResult["Images"] as $aImg)
	{
		?>
		top.arImages.push('<?=CUtil::JSEscape($aImg["SRC"])?>');
		top.arImagesId.push('<?=$aImg["ID"]?>');
		<?
	}
	?>
	</script><?
	if(strlen($arResult["COMMENT_ERROR"])>0)
	{
		?>
		<script>top.commentEr = 'Y';</script>
		<div class="blog-errors blog-note-box blog-note-error">
			<div class="blog-error-text">
				<?=$arResult["COMMENT_ERROR"]?>
			</div>
		</div>
		<?
	}
}

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
		<div class="blog-error-text" id="blg-com-err">
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
else
{
	if($arResult["imageUploadFrame"] == "Y")
	{
		?>
		<script>
			<?if(!empty($arResult["Image"])):?>
				top.bxBlogImageId = top.arImagesId.push('<?=$arResult["Image"]["ID"]?>');
				top.arImages.push('<?=CUtil::JSEscape($arResult["Image"]["SRC"])?>');
				top.bxBlogImageIdWidth = '<?=CUtil::JSEscape($arResult["Image"]["WIDTH"])?>';
			<?elseif(strlen($arResult["ERROR_MESSAGE"]) > 0):?>
				top.bxBlogImageError = '<?=CUtil::JSEscape($arResult["ERROR_MESSAGE"])?>';
			<?endif;?>
		</script>
		<?
		die();
	}
	else
	{
		if($arResult["is_ajax_post"] != "Y" && $arResult["CanUserComment"])
		{
			?>


			<div id="form_comment_" style="display:none;">




				<div id="form_c_del" style="display:none;">
				<div class="blog-comment-form">

				<form method="POST" name="form_comment" id="form_comment" action="<?=POST_FORM_ACTION_URI?>">
				<input type="hidden" name="parentId" id="parentId" value="">
				<input type="hidden" name="edit_id" id="edit_id" value="">
				<input type="hidden" name="act" id="act" value="add">
				<input type="hidden" name="post" value="Y">
				<?=bitrix_sessid_post()?>


				<!--===============-->

					<div class="b-comments__form grid-container">

					<!---------------->



 
						<div class="grid-row col-1 col-s-12 col-m-1"></div>
						<div class="b-comments__form-col grid-row col-4 col-s-12 col-xm-12 col-m-10">
						<?
						include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/lhe.php");
						?>


						</div>

						<div class="clear hidden visible-m"></div>
						<div class="grid-row hidden visible-m col-12 col-s-12 col-xm-12 col-m-1"></div>
						<div class="b-comments__form-col grid-row col-3 col-s-12 col-xm-12 col-m-10">

<?
							if(empty($_SESSION["blog_user_name"])) {
								global $USER;
								$_SESSION["blog_user_email"] = $USER->GetEmail();
								$_SESSION["blog_user_name"] = $USER->GetFullName();

							}

?>
									<input maxlength="255" size="30" tabindex="3" type="text" name="user_name" id="user_name"
										   value="<?=htmlspecialcharsEx($_SESSION["blog_user_name"])?>"
										   placeholder="<?=GetMessage("AUTHOR");?>" class="b-form__input">


									<input maxlength="255" size="30" tabindex="4" type="text" name="user_email" id="user_email"
										   value="<?=htmlspecialcharsEx($_SESSION["blog_user_email"])?>"
										   placeholder="<?=GetMessage("E_MAIL");?>" class="b-form__input">



						</div>

						<script type="text/javascript">
							$(window).on("load",function () {

								$(".lha-textarea").attr("placeholder","<?=GetMessage("COMMENT");?>");
							});



						</script>

						<div class="clear hidden visible-m"></div>
						<div class="grid-row hidden visible-m col-12 col-s-12 col-xm-12 col-m-1"></div>
						<div class="b-comments__form-col grid-row col-3 col-s-12 col-xm-12 col-m-10">


					<?


					if(strlen($arResult["NoCommentReason"]) > 0)
					{
						?>
						<div id="nocommentreason" style="display:none;"><?=$arResult["NoCommentReason"]?></div>
						<?
					}

					if($arResult["use_captcha"]===true)
					{
						?>
						<div class="blog-comment-field blog-comment-field-captcha">
							<div class="blog-comment-field-captcha-label">
								<label for=""><?=GetMessage("B_B_MS_CAPTCHA_SYM")?></label><span class="blog-required-field">*</span><br>
								<input type="hidden" name="captcha_code" id="captcha_code" value="">
								<input type="text" size="30" name="captcha_word" id="captcha_word" value=""  tabindex="7">
							</div>
							<div class="blog-comment-field-captcha-image">
								<div id="div_captcha">
									<img src="" width="180" height="40" id="captcha" style="display:none;">
								</div>
							</div>
						</div>
						<?
					}
					
					?>







					<div class="blog-comment-buttons">
						<input type="button" class="btn _full " name="sub-post" id="post-button"
								value="<?=GetMessage("COMMENT_BUTTON")?>" onclick="submitComment()">
						<div class="b-comments__form-notice">
							<?=GetMessage("COMMENT_NOTICE");?>
						</div>
					</div>


						</div><!--b-comments__form-col grid-row col-3 col-s-12-->


				</div><!--b-comments__form grid-container-->

				</form>
				</div>


					<!---------------->




			</div>
			</div>
			<?
		}


?>


<?


		$prevTab = 0;
		function ShowComment($comment, $tabCount=0, $tabSize=2.5, $canModerate=false, $User=Array(), $use_captcha=false, $bCanUserComment=false, $errorComment=false, $arParams = array())
		{
			if($comment["SHOW_AS_HIDDEN"] == "Y" || $comment["PUBLISH_STATUS"] == BLOG_PUBLISH_STATUS_PUBLISH || $comment["SHOW_SCREENNED"] == "Y" || $comment["ID"] == "preview")
			{
				global $prevTab;
				$tabCount = IntVal($tabCount);
				if($tabCount <= 5)
					$paddingSize = 3.5 * $tabCount;
				elseif($tabCount > 5 && $tabCount <= 10)
					$paddingSize = 3.5 * 5 + ($tabCount - 5) * 1.5;
				elseif($tabCount > 10)
					$paddingSize = 3.5 * 5 + 1.5 * 5 + ($tabCount-10) * 1;
				
				if(($tabCount+1) <= 5)
					$paddingSizeNew = 3.5 * ($tabCount+1);
				elseif(($tabCount+1) > 5 && ($tabCount+1) <= 10)
					$paddingSizeNew = 3.5 * 5 + (($tabCount+1) - 5) * 1.5;
				elseif(($tabCount+1) > 10)
					$paddingSizeNew = 3.5 * 5 + 1.5 * 5 + (($tabCount+1)-10) * 1;
				$paddingSizeNew -= $paddingSize;
					
				if($prevTab > $tabCount)
					$prevTab = $tabCount;
				if($prevTab <= 5)
					$prevPaddingSize = 3.5 * $prevTab;
				elseif($prevTab > 5 && $prevTab <= 10)
					$prevPaddingSize = 3.5 * 5 + ($prevTab - 5) * 1.5;
				elseif($prevTab > 10)
					$prevPaddingSize = 3.5 * 5 + 1.5 * 5 + ($prevTab-10) * 1;

					$prevTab = $tabCount;
				?>



			<?
			/*
			?>
				<div class="b-comments__item">
					<div class="b-comments__item-meta">
						<div class="b-comments__item-name"><?=$comment["AuthorName"]?></div>
						<div class="b-comments__item-date"><?=$comment["DateFormated"]?></div>
					</div>
					<div class="b-comments__item-text">
						<?=$comment["TextFormated"]?>
					</div>
					<div class="blog-comment-meta">
						<?
						if($bCanUserComment===true)
						{
							?>
							<span class="blog-comment-answer"><a href="javascript:void(0)" onclick="return showComment('<?=$comment["ID"]?>')"><?=GetMessage("B_B_MS_REPLY")?></a></span>
							<span class="blog-vert-separator"></span>
							<?
						}

						if(IntVal($comment["PARENT_ID"])>0)
						{
							?>
							<span class="blog-comment-parent"><a href="#<?=$comment["PARENT_ID"]?>"><?=GetMessage("B_B_MS_PARENT")?></a></span>
							<span class="blog-vert-separator"></span>
							<?
						}
						?>
						<span class="blog-comment-link"><a href="#<?=$comment["ID"]?>"><?=GetMessage("B_B_MS_LINK")?></a></span>
						<?
						if($comment["CAN_EDIT"] == "Y")
						{
							?>
							<script>
								top.text<?=$comment["ID"]?> = text<?=$comment["ID"]?> = '<?=CUtil::JSEscape($comment["~POST_TEXT"])?>';
								top.title<?=$comment["ID"]?> = title<?=$comment["ID"]?> = '<?=CUtil::JSEscape($comment["TITLE"])?>';
							</script>
							<span class="blog-vert-separator"></span>
							<span class="blog-comment-edit"><a href="javascript:void(0)" onclick="return editComment('<?=$comment["ID"]?>')"><?=GetMessage("BPC_MES_EDIT")?></a></span>
							<?
						}
						if(strlen($comment["urlToShow"])>0)
						{
							?>
							<span class="blog-vert-separator"></span>
							<span class="blog-comment-show">
								<?if($arParams["AJAX_POST"] == "Y"):?>
								<a href="javascript:void(0)" onclick="return hideShowComment('<?=$comment["urlToShow"]."&".bitrix_sessid_get()?>', '<?=$comment["ID"]?>');" title="<?=GetMessage("BPC_MES_SHOW")?>">
								<?else:?>
									<a href="<?=$comment["urlToShow"]."&".bitrix_sessid_get()?>" title="<?=GetMessage("BPC_MES_SHOW")?>">
								<?endif;?>
								<?=GetMessage("BPC_MES_SHOW")?></a></span>
							<?
						}
						if(strlen($comment["urlToHide"])>0)
						{
							?>
							<span class="blog-vert-separator"></span>
							<span class="blog-comment-show">
								<?if($arParams["AJAX_POST"] == "Y"):?>
								<a href="javascript:void(0)" onclick="return hideShowComment('<?=$comment["urlToHide"]."&".bitrix_sessid_get()?>', '<?=$comment["ID"]?>');" title="<?=GetMessage("BPC_MES_HIDE")?>">
								<?else:?>
									<a href="<?=$comment["urlToHide"]."&".bitrix_sessid_get()?>" title="<?=GetMessage("BPC_MES_HIDE")?>">
								<?endif;?>
								<?=GetMessage("BPC_MES_HIDE")?></a></span>
							<?
						}
						if(strlen($comment["urlToDelete"])>0)
						{
							?>
							<span class="blog-vert-separator"></span>
							<span class="blog-comment-delete">
								<?if($arParams["AJAX_POST"] == "Y"):?>
								<a href="javascript:void(0)" onclick="if(confirm('<?=GetMessage("BPC_MES_DELETE_POST_CONFIRM")?>')) deleteComment('<?=$comment["urlToDelete"]."&".bitrix_sessid_get()?>', '<?=$comment["ID"]?>');" title="<?=GetMessage("BPC_MES_DELETE")?>">
								<?else:?>
									<a href="javascript:if(confirm('<?=GetMessage("BPC_MES_DELETE_POST_CONFIRM")?>')) window.location='<?=$comment["urlToDelete"]."&".bitrix_sessid_get()?>'" title="<?=GetMessage("BPC_MES_DELETE")?>">
								<?endif;?>
								<?=GetMessage("BPC_MES_DELETE")?></a></span>
							<?
						}
						if(strlen($comment["urlToSpam"])>0)
						{
							?>
							<span class="blog-vert-separator"></span>
							<span class="blog-comment-delete blog-comment-spam"><a href="<?=$comment["urlToSpam"]?>" title="<?=GetMessage("BPC_MES_SPAM_TITLE")?>"><?=GetMessage("BPC_MES_SPAM")?></a></span>
							<?
						}


						?>
					</div>
				</div>




			<? */ ?>



				<a name="<?=$comment["ID"]?>"></a>
				<div class="blog-comment" style="padding-left:<?=$paddingSize?>em;">
				<div class="b-comments__item">
				<div id="blg-comment-<?=$comment["ID"]?>">

				<?
				if($comment["PUBLISH_STATUS"] == BLOG_PUBLISH_STATUS_PUBLISH || $comment["SHOW_SCREENNED"] == "Y" || $comment["ID"] == "preview")
				{
					$aditStyle = "";
					if($arParams["is_ajax_post"] == "Y" || $comment["NEW"] == "Y")
						$aditStyle .= " blog-comment-new";
					if($comment["AuthorIsAdmin"] == "Y")
						$aditStyle = " blog-comment-admin";
					if(IntVal($comment["AUTHOR_ID"]) > 0)
						$aditStyle .= " blog-comment-user-".IntVal($comment["AUTHOR_ID"]);
					if($comment["AuthorIsPostAuthor"] == "Y")
						$aditStyle .= " blog-comment-author";
					if($comment["PUBLISH_STATUS"] != BLOG_PUBLISH_STATUS_PUBLISH && $comment["ID"] != "preview")
						$aditStyle .= " blog-comment-hidden";
					if($comment["ID"] == "preview")
						$aditStyle .= " blog-comment-preview";
					?>
					<div class="blog-comment-cont<?=$aditStyle?>">
					<div class="blog-comment-cont-white">
					<div class="blog-comment-info">

						<?if ($arParams["SHOW_RATING"] == "Y"):?>
						<div class="blog-post-rating rating_vote_graphic">
						<?
						$GLOBALS["APPLICATION"]->IncludeComponent(
							"bitrix:rating.vote", $arParams["RATING_TYPE"],
							Array(
								"ENTITY_TYPE_ID" => "BLOG_COMMENT",
								"ENTITY_ID" => $comment["ID"],
								"OWNER_ID" => $comment["arUser"]["ID"],
								"USER_VOTE" => $arParams["RATING"][$comment["ID"]]["USER_VOTE"],
								"USER_HAS_VOTED" => $arParams["RATING"][$comment["ID"]]["USER_HAS_VOTED"],
								"TOTAL_VOTES" => $arParams["RATING"][$comment["ID"]]["TOTAL_VOTES"],
								"TOTAL_POSITIVE_VOTES" => $arParams["RATING"][$comment["ID"]]["TOTAL_POSITIVE_VOTES"],
								"TOTAL_NEGATIVE_VOTES" => $arParams["RATING"][$comment["ID"]]["TOTAL_NEGATIVE_VOTES"],
								"TOTAL_VALUE" => $arParams["RATING"][$comment["ID"]]["TOTAL_VALUE"],
								"PATH_TO_USER_PROFILE" => $arParams["~PATH_TO_USER"],
							),
							$arParams["component"],
							array("HIDE_ICONS" => "Y")
						);?>
						</div>
						<?endif;?>
						<?
						if (COption::GetOptionString("blog", "allow_alias", "Y") == "Y" && (strlen($comment["urlToBlog"]) > 0 || strlen($comment["urlToAuthor"]) > 0) && array_key_exists("ALIAS", $comment["BlogUser"]) && strlen($comment["BlogUser"]["ALIAS"]) > 0)
							$arTmpUser = array(
								"NAME" => "",
								"LAST_NAME" => "",
								"SECOND_NAME" => "",
								"LOGIN" => "",
								"NAME_LIST_FORMATTED" => $comment["BlogUser"]["~ALIAS"],
							);
						elseif (strlen($comment["urlToBlog"]) > 0 || strlen($comment["urlToAuthor"]) > 0)
							$arTmpUser = array(
								"NAME" => $comment["arUser"]["~NAME"],
								"LAST_NAME" => $comment["arUser"]["~LAST_NAME"],
								"SECOND_NAME" => $comment["arUser"]["~SECOND_NAME"],
								"LOGIN" => $comment["arUser"]["~LOGIN"],
								"NAME_LIST_FORMATTED" => "",
							);


							?>


						<div class="b-comments__item-meta">
							<div class="b-comments__item-name"><?=$comment["AuthorName"]?></div>
							<div class="b-comments__item-date"><?=$comment["DateFormated"]?></div>
						</div>






					</div>
					<div class="blog-clear-float"></div>
					<div class="blog-comment-content b-comments__item-text">

						<?=$comment["TextFormated"]?>



						<div class="blog-comment-meta">
						<?
						if($bCanUserComment===true)
						{
							?>
							<span class="blog-comment-answer"><a href="javascript:void(0)" onclick="return showComment('<?=$comment["ID"]?>')"><?=GetMessage("B_B_MS_REPLY")?></a></span>
							<span class="blog-vert-separator"></span>
							<?
						}

						if(IntVal($comment["PARENT_ID"])>0)
						{
							?>
							<span class="blog-comment-parent"><a href="#<?=$comment["PARENT_ID"]?>"><?=GetMessage("B_B_MS_PARENT")?></a></span>
							<span class="blog-vert-separator"></span>
							<?
						}
						?>
						<span class="blog-comment-link"><a href="#<?=$comment["ID"]?>"><?=GetMessage("B_B_MS_LINK")?></a></span>
						<?
						if($comment["CAN_EDIT"] == "Y")
						{
							?>
							<script>
								top.text<?=$comment["ID"]?> = text<?=$comment["ID"]?> = '<?=CUtil::JSEscape($comment["~POST_TEXT"])?>';
								top.title<?=$comment["ID"]?> = title<?=$comment["ID"]?> = '<?=CUtil::JSEscape($comment["TITLE"])?>';
							</script>
							<span class="blog-vert-separator"></span>
							<span class="blog-comment-edit"><a href="javascript:void(0)" onclick="return editComment('<?=$comment["ID"]?>')"><?=GetMessage("BPC_MES_EDIT")?></a></span>
							<?
						}
						if(strlen($comment["urlToShow"])>0)
						{
							?>
							<span class="blog-vert-separator"></span>
							<span class="blog-comment-show">
								<?if($arParams["AJAX_POST"] == "Y"):?>
									<a href="javascript:void(0)" onclick="return hideShowComment('<?=$comment["urlToShow"]."&".bitrix_sessid_get()?>', '<?=$comment["ID"]?>');" title="<?=GetMessage("BPC_MES_SHOW")?>">
								<?else:?>
									<a href="<?=$comment["urlToShow"]."&".bitrix_sessid_get()?>" title="<?=GetMessage("BPC_MES_SHOW")?>">
								<?endif;?>
								<?=GetMessage("BPC_MES_SHOW")?></a></span>
							<?
						}
						if(strlen($comment["urlToHide"])>0)
						{
							?>
							<span class="blog-vert-separator"></span>
							<span class="blog-comment-show">
								<?if($arParams["AJAX_POST"] == "Y"):?>
									<a href="javascript:void(0)" onclick="return hideShowComment('<?=$comment["urlToHide"]."&".bitrix_sessid_get()?>', '<?=$comment["ID"]?>');" title="<?=GetMessage("BPC_MES_HIDE")?>">
								<?else:?>
									<a href="<?=$comment["urlToHide"]."&".bitrix_sessid_get()?>" title="<?=GetMessage("BPC_MES_HIDE")?>">
								<?endif;?>
								<?=GetMessage("BPC_MES_HIDE")?></a></span>
							<?
						}
						if(strlen($comment["urlToDelete"])>0)
						{
							?>
							<span class="blog-vert-separator"></span>
							<span class="blog-comment-delete">
								<?if($arParams["AJAX_POST"] == "Y"):?>
									<a href="javascript:void(0)" onclick="if(confirm('<?=GetMessage("BPC_MES_DELETE_POST_CONFIRM")?>')) deleteComment('<?=$comment["urlToDelete"]."&".bitrix_sessid_get()?>', '<?=$comment["ID"]?>');" title="<?=GetMessage("BPC_MES_DELETE")?>">
								<?else:?>
									<a href="javascript:if(confirm('<?=GetMessage("BPC_MES_DELETE_POST_CONFIRM")?>')) window.location='<?=$comment["urlToDelete"]."&".bitrix_sessid_get()?>'" title="<?=GetMessage("BPC_MES_DELETE")?>">
								<?endif;?>
								<?=GetMessage("BPC_MES_DELETE")?></a></span>
							<?
						}
						if(strlen($comment["urlToSpam"])>0)
						{
							?>
							<span class="blog-vert-separator"></span>
							<span class="blog-comment-delete blog-comment-spam"><a href="<?=$comment["urlToSpam"]?>" title="<?=GetMessage("BPC_MES_SPAM_TITLE")?>"><?=GetMessage("BPC_MES_SPAM")?></a></span>
							<?
						}

						?>
						</div>

					</div>
					</div>
					</div>
						<div class="blog-clear-float"></div>

					<?
					if(strlen($errorComment) <= 0 && (strlen($_POST["preview"]) > 0 && $_POST["show_preview"] != "N") && (IntVal($_POST["parentId"]) > 0 || IntVal($_POST["edit_id"]) > 0)
						&& ( (IntVal($_POST["parentId"])==$comment["ID"] && IntVal($_POST["edit_id"]) <= 0)
							|| (IntVal($_POST["edit_id"]) > 0 && IntVal($_POST["edit_id"]) == $comment["ID"] && $comment["CAN_EDIT"] == "Y")))
					{
						$commentPreview = Array(
								"ID" => "preview",
								"TitleFormated" => htmlspecialcharsEx($_POST["subject"]),
								"TextFormated" => $_POST["commentFormated"],
								"AuthorName" => $User["NAME"],
								"DATE_CREATE" => GetMessage("B_B_MS_PREVIEW_TITLE"),
							);
						ShowComment($commentPreview, (IntVal($_POST["edit_id"]) == $comment["ID"] && $comment["CAN_EDIT"] == "Y") ? $level : ($level+1), 2.5, false, Array(), false, false, false, $arParams);
					}

					if(strlen($errorComment)>0 && $bCanUserComment===true
						&& (IntVal($_POST["parentId"])==$comment["ID"] || IntVal($_POST["edit_id"]) == $comment["ID"]))
					{
						?>
						<div class="blog-errors blog-note-box blog-note-error">
							<div class="blog-error-text">
								<?=$errorComment?>
							</div>
						</div>
						<?
					}
					?>
					</div>
					<div id="err_comment_<?=$comment['ID']?>"></div>
					<div id="form_comment_<?=$comment['ID']?>"></div>
					<div class="new_comment_cont" id="new_comment_cont_<?=$comment['ID']?>" style="padding-left:<?=$paddingSizeNew?>em;"></div>
					<div id="new_comment_<?=$comment['ID']?>" style="display:none;"></div>

					<?
					if((strlen($errorComment) > 0 || strlen($_POST["preview"]) > 0)
						&& (IntVal($_POST["parentId"])==$comment["ID"] || IntVal($_POST["edit_id"]) == $comment["ID"])
						&& $bCanUserComment===true)
					{
						?>
						<script>
						top.text<?=$comment["ID"]?> = text<?=$comment["ID"]?> = '<?=CUtil::JSEscape($_POST["comment"])?>';
						top.title<?=$comment["ID"]?> = title<?=$comment["ID"]?> = '<?=CUtil::JSEscape($_POST["subject"])?>';
						<?
						if(IntVal($_POST["edit_id"]) == $comment["ID"])
						{
							?>editComment('<?=$comment["ID"]?>');<?
						}
						else
						{
							?>showComment('<?=$comment["ID"]?>', 'Y', '<?=CUtil::JSEscape($_POST["user_name"])?>', '<?=CUtil::JSEscape($_POST["user_email"])?>', 'Y');<?
						}
						?>
						</script>
						<?
					}
				}
				elseif($comment["SHOW_AS_HIDDEN"] == "Y")
					echo "<b>".GetMessage("BPC_HIDDEN_COMMENT")."</b>";
				?>
				</div>
				</div>

	<?  ?>

















				<?
			}
		}
?>




		<?
		function RecursiveComments($sArray, $key, $level=0, $first=false, $canModerate=false, $User, $use_captcha, $bCanUserComment, $errorComment, $arSumComments, $arParams)
		{
			if(!empty($sArray[$key]))
			{
				foreach($sArray[$key] as $comment)
				{
					if(!empty($arSumComments[$comment["ID"]]))
					{
						$comment["CAN_EDIT"] = $arSumComments[$comment["ID"]]["CAN_EDIT"];
						$comment["SHOW_AS_HIDDEN"] = $arSumComments[$comment["ID"]]["SHOW_AS_HIDDEN"];
						$comment["SHOW_SCREENNED"] = $arSumComments[$comment["ID"]]["SHOW_SCREENNED"];
						$comment["NEW"] = $arSumComments[$comment["ID"]]["NEW"];
					}
					ShowComment($comment, $level, 2.5, $canModerate, $User, $use_captcha, $bCanUserComment, $errorComment, $arParams);
					if(!empty($sArray[$comment["ID"]]))
					{
						foreach($sArray[$comment["ID"]] as $key1)
						{
							if(!empty($arSumComments[$key1["ID"]]))
							{
								$key1["CAN_EDIT"] = $arSumComments[$key1["ID"]]["CAN_EDIT"];
								$key1["SHOW_AS_HIDDEN"] = $arSumComments[$key1["ID"]]["SHOW_AS_HIDDEN"];
								$key1["SHOW_SCREENNED"] = $arSumComments[$key1["ID"]]["SHOW_SCREENNED"];
								$key1["NEW"] = $arSumComments[$key1["ID"]]["NEW"];
							}
							ShowComment($key1, ($level+1), 2.5, $canModerate, $User, $use_captcha, $bCanUserComment, $errorComment, $arParams);

							if(!empty($sArray[$key1["ID"]]))
							{
								RecursiveComments($sArray, $key1["ID"], ($level+2), false, $canModerate, $User, $use_captcha, $bCanUserComment, $errorComment, $arSumComments, $arParams);
							}
						}
					}
					if($first)
						$level=0;
				}
			}
		}
		?>


		<?
		if($arResult["is_ajax_post"] != "Y")
		{
			if($arResult["CanUserComment"])
			{
				$postTitle = "";
				if($arParams["NOT_USE_COMMENT_TITLE"] != "Y")
					$postTitle = "RE: ".CUtil::JSEscape($arResult["Post"]["TITLE"]);
				?>
				<a name="0"></a>
				<?
				if(strlen($arResult["COMMENT_ERROR"]) > 0 && strlen($_POST["parentId"]) < 2
					&& IntVal($_POST["parentId"])==0 && IntVal($_POST["edit_id"]) <= 0)
				{
					?>
					<div class="blog-errors blog-note-box blog-note-error">
						<div class="blog-error-text"><?=$arResult["COMMENT_ERROR"]?></div>
					</div>
					<?
				}
			}



			if($arResult["CanUserComment"])
			{
				?>
				<div id="form_comment_0">
					<div id="err_comment_0"></div>
					<div id="form_comment_0"></div>
					<div id="new_comment_cont_0"></div>
					<div id="new_comment_0" style="display:none;"></div>
				</div>
				<?
				if((strlen($arResult["COMMENT_ERROR"])>0 || strlen($_POST["preview"]) > 0)
					&& IntVal($_POST["parentId"]) == 0 && strlen($_POST["parentId"]) < 2 && IntVal($_POST["edit_id"]) <= 0)
				{
					?>
					<script>
					top.text0 = text0 = '<?=CUtil::JSEscape($_POST["comment"])?>';
					top.title0 = title0 = '<?=CUtil::JSEscape($_POST["subject"])?>';
					showComment('0', 'Y', '<?=CUtil::JSEscape($_POST["user_name"])?>', '<?=CUtil::JSEscape($_POST["user_email"])?>', 'Y');
					</script>
					<?
				}
			}
		}

?>




	<div class="grid-container">
		<div class="grid-row col-1 col-s-12"></div>
		<div class="grid-row col-10 col-s-12">
			<div class="b-comments__list">


				<?
				if(count($arResult["CommentsResult"]) == 0){
					?>
					<div class="b-comments__item-text reviews-text">
						<?=GetMessage("NO_REVIEWS");?>
					</div>

					<?
				}
				?>




			<?

		$arParams["RATING"] = $arResult["RATING"];
		$arParams["component"] = $component;
		$arParams["arImages"] = $arResult["arImages"];
		if($arResult["is_ajax_post"] == "Y")
			$arParams["is_ajax_post"] = "Y";

		if($arResult["is_ajax_post"] != "Y" && $arResult["NEED_NAV"] == "Y")
		{
			for($i = 1; $i <= $arResult["PAGE_COUNT"]; $i++)
			{
				$tmp = $arResult["CommentsResult"];
				$tmp[0] = $arResult["PagesComment"][$i];
				?>
					<div id="blog-comment-page-<?=$i?>"<?if($arResult["PAGE"] != $i) echo "style=\"display:none;\""?>><?RecursiveComments($tmp, $arResult["firstLevel"], 0, true, $arResult["canModerate"], $arResult["User"], $arResult["use_captcha"], $arResult["CanUserComment"], $arResult["COMMENT_ERROR"], $arResult["Comments"], $arParams);?></div>
				<?
			}
		}
		else
			RecursiveComments($arResult["CommentsResult"], $arResult["firstLevel"], 0, true, $arResult["canModerate"], $arResult["User"], $arResult["use_captcha"], $arResult["CanUserComment"], $arResult["COMMENT_ERROR"], $arResult["Comments"], $arParams);



?>



				</div>
			</div>
		</div>

<?

				if($arResult["is_ajax_post"] != "Y")
		{
			if($arResult["CanUserComment"])// && count($arResult["Comments"])>2
			{
				if(strlen($arResult["COMMENT_ERROR"])>0 && $_POST["parentId"] == "00" && strlen($_POST["parentId"]) > 1)
				{
					?>
					<div class="blog-errors blog-note-box blog-note-error">
						<div class="blog-error-text">
							<?=$arResult["COMMENT_ERROR"]?>
						</div>
					</div>
					<?
				}
				?>

				<div id="form_comment_00">

					<div id="err_comment_00"></div>
					<div id="form_comment_00"></div>
					<div id="new_comment_cont_00"></div>
					<div id="new_comment_00" style="display:none;"></div>
				</div><br />
				
				<?
				if((strlen($arResult["COMMENT_ERROR"])>0 || strlen($_POST["preview"]) > 0)
					&& $_POST["parentId"] == "00" && strlen($_POST["parentId"]) > 1)
				{
					?>
					<script>
					top.text00 = text00 = '<?=CUtil::JSEscape($_POST["comment"])?>';
					top.title00 = title00 = '<?=CUtil::JSEscape($_POST["subject"])?>';

					showComment('00', 'Y', '<?=CUtil::JSEscape($_POST["user_name"])?>', '<?=CUtil::JSEscape($_POST["user_email"])?>', "Y");
					</script>
					<?
				}
			}


			if($arResult["NEED_NAV"] == "Y")
			{
				?>
	<div class="b-pager">
					<?
					for($i = 1; $i <= $arResult["PAGE_COUNT"]; $i++)
					{
						$style = "blog-comment-nav-item";
						if($i == $arResult["PAGE"])
							$style .= " blog-comment-nav-item-sel";
						?><a class="<?=$style?> b-pager__item" href="<?=$arResult["NEW_PAGES"][$i]?>" onclick="return bcNav('<?=$i?>', this)"
							 id="blog-comment-nav-b<?=$i?>"><i><?=$i?></i></a><?
					}
				?>
				</div>



	<?
			}


		}
	}
}
?>
</div>




</div>


<?

?>


<?
if($arResult["is_ajax_post"] == "Y")
	die();
?>

