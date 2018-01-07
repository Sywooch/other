
<? if(isset($isFaq) && $isFaq == 1){ ?>

    <?Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("form-faq-block");?>
    <?
    $faqWebFormID=FAQ_WEB_FORM_ID;
    if(LANGUAGE_ID==='en'){
        $faqWebFormID=FAQ_WEB_FORM_ID_EN;
    }?>

    <div style="background-color:#fff;">
    <?$APPLICATION->IncludeComponent("bitrix:form", "shop_faq", Array(
        "AJAX_MODE" => "Y",	// Включить режим AJAX
        "SEF_MODE" => "N",	// Включить поддержку ЧПУ
        "WEB_FORM_ID" => $faqWebFormID,	// ID веб-формы
        "RESULT_ID" => "",	// ID результата
        "START_PAGE" => "new",	// Начальная страница
        "SHOW_LIST_PAGE" => "N",	// Показывать страницу со списком результатов
        "SHOW_EDIT_PAGE" => "N",	// Показывать страницу редактирования результата
        "SHOW_VIEW_PAGE" => "N",	// Показывать страницу просмотра результата
        "SUCCESS_URL" => "",	// Страница с сообщением об успешной отправке
        "SHOW_ANSWER_VALUE" => "N",	// Показать значение параметра ANSWER_VALUE
        "SHOW_ADDITIONAL" => "N",	// Показать дополнительные поля веб-формы
        "SHOW_STATUS" => "N",	// Показать текущий статус результата
        "EDIT_ADDITIONAL" => "N",	// Выводить на редактирование дополнительные поля
        "EDIT_STATUS" => "N",	// Выводить форму смены статуса
        "NOT_SHOW_FILTER" => "",	// Коды полей, которые нельзя показывать в фильтре
        "NOT_SHOW_TABLE" => "",	// Коды полей, которые нельзя показывать в таблице
        "CHAIN_ITEM_TEXT" => "",	// Название дополнительного пункта в навигационной цепочке
        "CHAIN_ITEM_LINK" => "",	// Ссылка на дополнительном пункте в навигационной цепочке
        "IGNORE_CUSTOM_TEMPLATE" => "N",	// Игнорировать свой шаблон
        "USE_EXTENDED_ERRORS" => "N",	// Использовать расширенный вывод сообщений об ошибках
        "CACHE_TYPE" => "A",	// Тип кеширования
        "CACHE_TIME" => "3600",	// Время кеширования (сек.)
        "AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
        "AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
        "AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
        "VARIABLE_ALIASES" => array(
            "action" => "action",
        )
    ),
        false
    );?>
    </div>

    <?Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("form-faq-block", "");?>
<? };
$isFaq = 0;
?>


<div class="b-main-collection-top _inner-collection">
    <div class="grid-container">
        <?if(LANGUAGE_ID==='en'):?>
            <?$specialIBblockID=SPECIAL_OFFER_EN?>
            <?$iblockType='	content'?>
        <?else:?>
            <?$specialIBblockID=SPECIAL_OFFER_RU?>
            <?$iblockType='aspro_ishop_content'?>
        <?endif?>
        <?$APPLICATION->IncludeComponent(
            "ad_shop:special_product",
            ".default",
            array(
                "CACHE_TIME" => "3600",
                "CACHE_TYPE" => "A",
                "IBLOCK_ID" => $specialIBblockID,
                "IBLOCK_TYPE" => $iblockType,
                "COMPONENT_TEMPLATE" => ".default"
            ),
            false
        );?>
        <div class="grid-row col-3 col-m-4  col-s-12">
            <div class="b-subscribe _on-inner">
                <?$APPLICATION->IncludeComponent(
                    "ad_shop:subscribe.form",
                    ".default",
                    array(
                        "CACHE_TIME" => "3600",
                        "CACHE_TYPE" => "A",
                        "RUB_ID" => "1",
                        "COMPONENT_TEMPLATE" => ".default"
                    ),
                    false
                );?>
            </div>
        </div>
    </div>
</div>


