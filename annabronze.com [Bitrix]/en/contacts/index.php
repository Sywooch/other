<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Сontacts");
?>
    <div class="b-contacts__map">
        <script src="https://api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=en-US"
                type="text/javascript"></script>
        <script type="text/javascript">
            var myMap;
            ymaps.ready(function () {
                myMap = new ymaps.Map("YMapsID", {
                    center: [57.428374, 56.943802],
                    zoom: 10
                });
            });
        </script>

        <div id="YMapsID" class="b-contacts__map-inner"></div>
    </div>
    <div class="grid-row col-1 col-xm-12 col-s-12"></div>
    <div class="b-layout__inner-content grid-row col-10 col-xm-12  col-s-12">
        <div class="b-layout__info-box"><!-- for content pages - content styles -->
            <div class="b-contacts">
                <div class="b-contacts__info">
                    <div class="b-contacts__info-text">
                    <p>We will gladly answer all your questions. For communication you can use either any of
                        the social networks, a feedback form. In an extreme case - call us.</p>

                    <p>Pay attention to our official page VKontakte. There are regularly held competitions
                        for
                        the best decoration, new works are published with our accessories and many more
                        interesting things. Drop in, sign up, take part in competitions.</p>

                    <p>On the Facebook page regularly published new work in which our furniture is used. A
                        great opportunity to spy on a new idea or tell others about your new product!</p>

                    <p>You want to get to know us a little closer? Subscribe to our account in Instagram.
                        Jewellery Anne, a trip to the exhibition and a photo of life.</p>

                    <p>We also regularly publish the works of our favorite authors, using hardware Anne
                        Black
                        The site Pinterest. And yet there it is possible to subscribe to the boards that
                        Anna is
                        just for yourself. You may also be interested in them.</p>

                    <p>Learn a little more about our fittings in the section "Information". For example,
                        read
                        about how we produce it, how to care for furniture. In this section you can check
                        out
                        the workshops to create jewelry. There is also a section "Questions and Answers" -
                        where
                        you will find answers to the serious and not very questions we asked during our
                        work.
                        Any funny or a serious issue and you want to see all the answer? Ask him there.</p>

                    <br/>
                    </div>
                    <div class="b-contacts__info-col">
                        <div class="b-contacts__item _phone">
                            <div class="b-contacts__item-inner">
                                <div class="b-contacts__item-title"><?=GetMessage("PHONE_NUMBER");?> -</div>
                                +7 964 190 78 16
                            </div>
                        </div>
                        <div class="b-contacts__item _vk">
                            <div class="b-contacts__item-inner">
                                <div class="b-contacts__item-title">VK -</div>
                                <a href="//vk.com/findings">vk.com/findings</a>
                            </div>
                        </div>
                        <div class="b-contacts__item _fb">
                            <div class="b-contacts__item-inner">
                                <div class="b-contacts__item-title">Facebook -</div>
                                <a href="//facebook.com/AnnaFindings">facebook.com/AnnaFindings</a>
                            </div>
                        </div>
                        <div class="b-contacts__item _in">
                            <div class="b-contacts__item-inner">
                                <div class="b-contacts__item-title">Instagram -</div>
                                <a href="//instagram.com/annabronze">instagram.com/annabronze</a>
                            </div>
                        </div>
                        <div class="b-contacts__item _pi">
                            <div class="b-contacts__item-inner">
                                <div class="b-contacts__item-title">Pinterest -</div>
                                <a href="//pinterest.com/anna_bronze">pinterest.com/anna_bronze</a>
                            </div>
                        </div>
                        <div class="b-contacts__item _skype">
                            <div class="b-contacts__item-inner">
                                <div class="b-contacts__item-title">Skype -</div>
                                <a href="#">blackslava </a>
                            </div>
                        </div>
                        <div class="b-contacts__item _email">
                            <div class="b-contacts__item-inner">
                                <div class="b-contacts__item-title">E-mail -</div>
                                <a href="mailto:sales@annabronze.com">sales@annabronze.com </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <div class="clear"></div>


<? Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("form-feedback-block"); ?><? $APPLICATION->IncludeComponent(
    "bitrix:form",
    "shop_faq2",
    Array(
        "START_PAGE" => "new",
        "SHOW_LIST_PAGE" => "N",
        "SHOW_EDIT_PAGE" => "N",
        "SHOW_VIEW_PAGE" => "N",
        "SUCCESS_URL" => "",
        "WEB_FORM_ID" => "11",
        "RESULT_ID" => "",
        "SHOW_ANSWER_VALUE" => "N",
        "SHOW_ADDITIONAL" => "N",
        "SHOW_STATUS" => "N",
        "EDIT_ADDITIONAL" => "N",
        "EDIT_STATUS" => "N",
        "NOT_SHOW_FILTER" => array(0 => "", 1 => "",),
        "NOT_SHOW_TABLE" => array(0 => "", 1 => "",),
        "IGNORE_CUSTOM_TEMPLATE" => "N",
        "USE_EXTENDED_ERRORS" => "N",
        "SEF_MODE" => "N",
        "AJAX_MODE" => "Y",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "CHAIN_ITEM_TEXT" => "",
        "CHAIN_ITEM_LINK" => "",
        "AJAX_OPTION_ADDITIONAL" => "",
        "VARIABLE_ALIASES" => Array(
            "action" => "action"
        )
    )
); ?><? Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("form-feedback-block", ""); ?>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>