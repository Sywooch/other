<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Форма обратной связи");
?><h1 style="color: #464646; background-color: #ffffff;">Форма обратной связи</h1>
<p>
	 Задайте нам интересующий вас вопрос, и мы постараемся вам помочь.
</p>
<p>
	<strong><span color="#FF0000">Прежде чем задать свой вопрос, пожалуйста, поищите ответ на него в рубрике&nbsp;<a href="/obrashcheniya-grazhdan/chasto-zadavaemye-voprosy/" style="color: #00749e;">"Часто задаваемые вопросы"</a>!&nbsp;</span>&nbsp;</strong>
</p>
<p>
	<strong>ВНИМАНИЕ! Заявления и жалобы, поступившие на сайт, рассматриваются ТОЛЬКО в том случае,&nbsp; если в них указаны Ваши личные данные (ФИО, контактный телефон/e-mail )!</strong>
</p>
<p>
	<strong><?$APPLICATION->IncludeComponent(
	"api:main.feedback",
	"template1",
	Array(
		"USE_CAPTCHA" => "Y",
		"USE_HIDDEN_PROTECTION" => "Y",
		"REPLACE_FIELD_FROM" => "Y",
		"UNIQUE_FORM_ID" => "91d631238dd30005393acc3fbf6f434f",
		"OK_TEXT" => "Спасибо, ваше сообщение принято.",
		"EMAIL_TO" => "ufmsyo@rambler.ru",
		"DISPLAY_FIELDS" => array("AUTHOR_NAME","AUTHOR_LAST_NAME","AUTHOR_SECOND_NAME","AUTHOR_EMAIL","AUTHOR_MESSAGE"),
		"REQUIRED_FIELDS" => array("AUTHOR_NAME","AUTHOR_LAST_NAME","AUTHOR_SECOND_NAME","AUTHOR_EMAIL","AUTHOR_MESSAGE"),
		"CUSTOM_FIELDS" => array("Ваше гражданство@select@values=Гражданин России#Иностранный гражданин",""),
		"ADMIN_EVENT_MESSAGE_ID" => array("26"),
		"USER_EVENT_MESSAGE_ID" => array("26"),
		"TITLE_DISPLAY" => "N",
		"FORM_TITLE" => "",
		"FORM_TITLE_LEVEL" => "1",
		"FORM_STYLE_TITLE" => "",
		"FORM_STYLE" => "text-align:left;",
		"FORM_STYLE_DIV" => "overflow:hidden;padding:5px;",
		"FORM_STYLE_LABEL" => "display: block;min-width:150px;margin-bottom: 3px;float:left;",
		"FORM_STYLE_TEXTAREA" => "padding:3px 5px;min-width:380px;min-height:150px;",
		"FORM_STYLE_INPUT" => "min-width:220px;padding:3px 5px;",
		"FORM_STYLE_SELECT" => "min-width:232px;padding:3px 5px;",
		"FORM_STYLE_SUBMIT" => "",
		"FORM_SUBMIT_VALUE" => "Отправить",
		"INCLUDE_JQUERY" => "Y",
		"VALIDTE_REQUIRED_FIELDS" => "Y",
		"INCLUDE_PRETTY_COMMENTS" => "N",
		"INCLUDE_FORM_STYLER" => "N",
		"HIDE_FORM_AFTER_SEND" => "N",
		"SCROLL_TO_FORM_IF_MESSAGES" => "N",
		"SCROLL_TO_FORM_SPEED" => "1000",
		"BRANCH_ACTIVE" => "N",
		"SHOW_FILES" => "N",
		"USER_AUTHOR_FIO" => "",
		"USER_AUTHOR_NAME" => "",
		"USER_AUTHOR_LAST_NAME" => "",
		"USER_AUTHOR_SECOND_NAME" => "",
		"USER_AUTHOR_EMAIL" => "Ваш e-mail:",
		"USER_AUTHOR_PERSONAL_MOBILE" => "",
		"USER_AUTHOR_WORK_COMPANY" => "",
		"USER_AUTHOR_POSITION" => "",
		"USER_AUTHOR_PROFESSION" => "",
		"USER_AUTHOR_STATE" => "",
		"USER_AUTHOR_CITY" => "",
		"USER_AUTHOR_STREET" => "",
		"USER_AUTHOR_ADRESS" => "",
		"USER_AUTHOR_PERSONAL_PHONE" => "",
		"USER_AUTHOR_WORK_PHONE" => "",
		"USER_AUTHOR_FAX" => "",
		"USER_AUTHOR_MAILBOX" => "",
		"USER_AUTHOR_WORK_MAILBOX" => "",
		"USER_AUTHOR_SKYPE" => "",
		"USER_AUTHOR_ICQ" => "",
		"USER_AUTHOR_WWW" => "",
		"USER_AUTHOR_WORK_WWW" => "",
		"USER_AUTHOR_MESSAGE_THEME" => "",
		"USER_AUTHOR_MESSAGE" => "Задайте вопрос:",
		"USER_AUTHOR_NOTES" => "",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"SHOW_CSS_MODAL_AFTER_SEND" => "Y",
		"CSS_MODAL_HEADER" => "Информация",
		"CSS_MODAL_FOOTER" => "",
		"CSS_MODAL_CONTENT" => "<p>Модуль <b>расширенная форма обратной связи битрикс с вложением</b> предназначен для отправки сообщений с сайта, включая код CAPTCHA и скрытую защиту от спама, и отличается от стандартной формы Битрикс:
<br> - <b>отправкой файлов вложениями или ссылками на файл</b>,
<br> - <b>встроенным конструктором форм,</b>
<br> - скрытой защитой от спама,
<br> - работой нескольких форм на одной странице,
<br> - встроенным фирменным валидатором форм,
<br> - 4 встроенными WEB 2.0 шаблонами,
<br> - дополнительными полями со своим именованием,
<br> - и многими другими функциями...
<br>подробнее читайте на странице модуля <a href=\"http://tuning-soft.ru/1c-bitrix/modules/main-feedback/\" target=\"_blank\">Расширенная форма обратной связи</a>
</p>",
		"AJAX_OPTION_ADDITIONAL" => ""
	)
);?><br>
	</strong>
</p><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>