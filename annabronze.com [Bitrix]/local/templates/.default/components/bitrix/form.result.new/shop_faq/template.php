<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
$this->addExternalJS($this->GetFolder()."/js/jquery.mask.min.js");

$end = '';
if(LANGUAGE_ID == 'en') {
    $end = '_EN';
}
$nameID = FEEDBACK_WEB_FORM_NAME_ID.$end;
$phoneID = FEEDBACK_WEB_FORM_PHONE_ID.$end;
$emailID = FEEDBACK_WEB_FORM_EMAIL_ID.$end;
$questionID = FEEDBACK_WEB_FORM_QUESTION_ID.$end;
?>



<div class="grid-container">

	<div class="grid-row col-3 col-xm-12 col-s-12"></div>

	<div class="grid-row col-9 col-xm-9  col-s-12">
		<div class="b-faq__btn js-faq__btn margin-bottom-small">
			<a href="#" class="btn _full _inline "><?=GetMessage("ASK_A_QUESTION")?></a>
		</div>
	</div>


</div>



<div class="b-comments__form b-comments__form-white-background grid-container padding-top-small padding-bottom-small-30">

		<div class="staff_wrapp">
			<?if( $arResult["isFormErrors"] == "Y" ){?>

				<div class="_is-success">
					<div class="grid-container">

						<div class="grid-row col-3 col-xm-12 col-s-12"></div>

						<div class="grid-row col-9 col-xm-9  col-s-12">
							<div class="b-subscribe__form-errors"><?=$arResult["FORM_ERRORS_TEXT"]?></div>
						</div>
					</div>
				</div>
			<?}?>

			<?if( $arResult["isFormNote"] == "Y" ){?>


				<div class="_is-success">
					<div class="grid-container">
						<div class="grid-row col-3 col-xm-12 col-s-12"></div>

						<div class="grid-row col-9 col-xm-9  col-s-12">
							<div class="b-subscribe__form-success"><?=$arResult["FORM_NOTE"]?></div>
						</div>
					</div>
				</div>
			<?}else{?>



				<div class="js-faq__form-container " style="display: none;">

					<div class="section_items">
						<?$html = str_replace('name=', 'class="ishop faq" name=', $arResult["FORM_HEADER"]);?>
						<?=$html?>
						<blockquote>
							<?foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion){
								if( $arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden' ){
									echo $arQuestion["HTML_CODE"];
								}
							}?>


							<div class="grid-row col-1 col-s-12 col-xm-12"></div>
							<div class="b-comments__form-col grid-row col-4 col-s-12 col-xm-12">
                                <?if($arResult['arQuestions']['QUESTION']):?>
                                    <textarea class="b-form__textarea QUESTION"
                                              placeholder="<?=GetMessage('TEXT_QUESTION');?>"
                                              name="form_textarea_<?=$arResult['arQuestions']['QUESTION']['ID']?>"
                                    ></textarea>
                                <?endif;?>
							</div>
							<div class="b-comments__form-col grid-row col-3 col-s-12 col-xm-12">

                                <?foreach ($arResult['arQuestions'] as $FIELD_SID => $arQuestion):?>
                                    <?if($FIELD_SID != 'QUESTION'):?>
                                        <?$type = $arResult['arAnswers'][$FIELD_SID][0]['FIELD_TYPE']?>
                                        <input class="b-form__input <?=$FIELD_SID?>"
                                               placeholder="<?=GetMessage('TEXT_'.$FIELD_SID);?>"
                                               type="text"
                                               name="form_<?=$type?>_<?=$arQuestion['ID']?>" value="" size="0">
                                    <?endif;?>
                                <?endforeach;?>
							</div>

							<div class="b-comments__form-col grid-row col-3 col-s-12 col-xm-12">

								<button class="button btn _full" <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" name="web_form_submit" value="<?=htmlspecialcharsbx(strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>"><span><?=GetMessage("IBLOCK_FORM_SUBMIT")?></span></button>

								<div class="promt b-comments__form-notice">
									* - <?=GetMessage("IBLOCK_FORM_IMPORTANT")?>
								</div>


							</div>

						</blockquote>
					</div>




				</div><!--js-faq__form-container-->
				<?=$arResult["FORM_FOOTER"]?>
			<?}?>



		</div><!--staff_wrapp-->


</div>









<script>
	$(document).ready(function() {
		$('input.PHONE').mask('000000000000000000');

		$(".section_title a").click(function(){ $(this).toggleClass('opened').parents(".section_title").next().slideToggle(333); });

		$(".js-faq__btn").click(function(e){
			e.preventDefault();
			if($(".js-faq__form-container").css("display") == "none"){
				$(".js-faq__form-container").fadeIn("600");
			}else{
				$(".js-faq__form-container").fadeOut("600");
			}


		});

		<?

		global $USER;
		if ($USER->IsAuthorized()) {

			$email = $USER->GetEmail();

			if(!empty($USER->GetFullName())){
				$name = $USER->GetFullName();
			}else{
				$name = $USER->GetLogin();
			}
		}


		?>
		$('.FIO').val("<?=$name;?>");
		$('.EMAIL').val("<?=$email;?>");

	});

	var oErrors = {};
	oErrors['no_topic_name'] = "<?=CUtil::addslashes(GetMessage("JERROR_NO_TOPIC_NAME"))?>";
	oErrors['no_message'] = "<?=CUtil::addslashes(GetMessage("JERROR_NO_MESSAGE"))?>";
	oErrors['max_len'] = "<?=CUtil::addslashes(GetMessage("JERROR_MAX_LEN"))?>";
	oErrors['no_url'] = "<?=CUtil::addslashes(GetMessage("FORUM_ERROR_NO_URL"))?>";
	oErrors['no_title'] = "<?=CUtil::addslashes(GetMessage("FORUM_ERROR_NO_TITLE"))?>";
	oErrors['no_path'] = "<?=CUtil::addslashes(GetMessage("FORUM_ERROR_NO_PATH_TO_VIDEO"))?>";

	oErrors['no_author'] = "<?=CUtil::addslashes(GetMessage("FORUM_ERROR_NO_AUTHOR"))?>";
	oErrors['no_mail'] = "<?=CUtil::addslashes(GetMessage("FORUM_ERROR_NO_MAIL"))?>";
	oErrors['no_phone'] = "<?=CUtil::addslashes(GetMessage("FORUM_ERROR_NO_PHONE"))?>";

	oErrors['error_mail'] = "<?=CUtil::addslashes(GetMessage("FORUM_ERROR_ERROR_MAIL"))?>";

	var sended = false;
	$('form.faq').unbind("submit");
	$('form.faq').on("submit", function(e){
		
		if(sended){ return false; }
		//$(".js-comments__item-message").hide();
		$(".b-comments__form-notice").html("");
		$(".b-comments__form-notice").removeClass("b-comments__form-error");

		$(".b-form__textarea").removeClass("error-input");
		$(".b-form__input").removeClass("error-input");

		var errors = "";

		var MessageLength = $("textarea.QUESTION").val().length;

		if (MessageLength < 2) {
			errors += oErrors['no_message'] + "<br>";
			$("textarea.QUESTION").addClass("error-input");
		}

		var AuthorLength = $("input.FIO").val().length;
		if (AuthorLength == 0){
			errors += oErrors['no_author'] + "<br>";
			$("input.FIO").addClass("error-input");
		}

		var MailLength = $("input.EMAIL").val().length;

		if (MailLength == 0){
			errors += oErrors['no_mail'] + "<br>";
		 	$("input.EMAIL").addClass("error-input");
		}else{
		//if(MailLength != 0){

			var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
			if(!pattern.test($("input.EMAIL").val())){
				errors += oErrors['error_mail'] + "<br>";
				$("input.EMAIL").addClass("error-input");
			}

		}

		if (errors != "")
		{

			$(".b-comments__form-notice").html(errors);
			$(".b-comments__form-notice").addClass("b-comments__form-error");
			BX.closeWait();

			return false;
		}

		//$('form.faq').unbind("submit");
		sended = true;
		$('form.faq').submit();
		//$('button[name="web_form_submit"]').click();

		return true;
	});

</script>