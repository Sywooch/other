<?
define('CATALOG_IBLOCK_ID', 40);
define('CATALOG_IBLOCK_ID_EN', 21);
define('LIST_CITIES_IBLOCK_ID', 42);
define('LIST_CITIES_IBLOCK_ID_EN', 43);
define('NALOZH_PAYSYSTEM_ID', 20);
define('CATALOG_IBLOCK_OFFERS_ID_RU', 55);//Пакет предложений (Каталог товаров актуальный (RU)
define('CATALOG_IBLOCK_OFFERS_ID_EN', 56);//Пакет предложений (Каталог товаров актуальный (EN)

define('SPECIAL_OFFER_RU',70);
define('SPECIAL_OFFER_EN',73);
define('GALLERY_IBLOCK_ID_EN', 49);

define('BX_DEFAULT_TEMPLATE_PATH',"/local/templates/ab_shop");
define('BX_DEFAULT_NO_PHOTO_IMAGE',"/local/templates/ab_shop/images/no_photo.png");

define('BX_LINK_HELP_DELIVERY',"/help/delivery/");

define('BX_CATALOG_SMART_FILTER_TYPES', "TIP_FURNITURY");//тип фурнитуры
define('BX_CATALOG_SMART_FILTER_TYPES_EN', "TYPE");//тип фурнитуры

define('BX_IBLOCK_OFFERS_PROPERTY_COLOR_RU', "TSVET");//цвет
define('BX_IBLOCK_OFFERS_PROPERTY_COLOR_EN', "COLOR");//

define('BX_IBLOCK_GALLERY_RU', "41");//галерея
define('BX_IBLOCK_GALLERY_EN', "49");//

define('BX_SALE_OTHER_CITY_RU', "58");//доп. поле "Город" в оформлении заказа
define('BX_SALE_OTHER_CITY_EN', "59");//

define('BX_SALE_OTHER_INDEX_RU', "60");//доп. поле "Индекс" в оформлении заказа
define('BX_SALE_OTHER_INDEX_EN', "61");//

define('FEEDBACK_WEB_FORM_ID', 1);
define('FEEDBACK_WEB_FORM_ID_EN', 11);
define('FAQ_WEB_FORM_ID', 2);
define('FAQ_WEB_FORM_ID_EN', 12);


define('P_GALLERY_URL', "/local/include/ajax-gallery.php");

//эти типы в фильтре ТОП на главной будут выводиться в первую очередь (для RU)
// замок-тоггл, колпачок для бусин, подвеска, бейл, концевик
$arTypesRu = array(
    "00eac760-26f6-11e6-a6dd-08606e7a3064",//замок-тоггл
    "2160ab49-26f6-11e6-a6dd-08606e7a3064",//колпачок для бусин
    "9510dcf1-df30-11e5-9f60-f07f8a8bf93c",//подвеска
    "7fa46aec-df30-11e5-9f60-f07f8a8bf93c",//бейл
    "4027bfd2-26cd-11e6-a6dd-08606e7a3064"//концевик
);
define("BX_IBLOCK_CATALOG_TYPES_ARRAY_RU", serialize($arTypesRu));

//первоприоритетные цвета, рандомный выбор будет производиться из них
$arColorsRu = array(
    "169",//античная бронза
    "167",//античная латунь
    //"164",//пушечная бронза
);
$arColorsEn = array(
    "195",//античная бронза
    "199",//античная латунь
    //"197",//пушечная бронза
);
define("BX_IBLOCK_CATALOG_COLORS_ARRAY_RU", serialize($arColorsRu));
define("BX_IBLOCK_CATALOG_COLORS_ARRAY_EN", serialize($arColorsEn));


define("BX_CATALOG_DETAIL_ATTRIBUTE_WEIGHT_DESCRIPTION_RU", "Вес, грамм");
define("BX_CATALOG_DETAIL_ATTRIBUTE_WEIGHT_DESCRIPTION_EN", "Weight, g");


//цвета для топа на главной, из которых будут выбираться случайные ТП
$arColorsTopRu = array(
    "169",//античная бронза
    "167",//античная латунь
    //"164",//пушечная бронза
    //"165"//античное серебро
);
$arColorsTopEn = array(
    "195",//античная бронза
    "199",//античная латунь
    //"197",//пушечная бронза
    //"196"//античное серебро
);
define("BX_IBLOCK_CATALOG_COLORS_TOP_ARRAY_RU", serialize($arColorsTopRu));
define("BX_IBLOCK_CATALOG_COLORS_TOP_ARRAY_EN", serialize($arColorsTopEn));



define("BX_CATALOG_DETAIL_COMMENT_ID_MAIL_EVENT_RU", 345);//добавлен новый комментарий (админу)
define("BX_CATALOG_DETAIL_COMMENT_ID_MAIL_EVENT_EN", 346);

define("BX_CATALOG_DETAIL_COMMENT_ID_MAIL_EVENT_TO_AUTHOR_RU", 347);//добавлен новый комментарий (автору)
define("BX_CATALOG_DETAIL_COMMENT_ID_MAIL_EVENT_TO_AUTHOR_EN", 348);

define("BX_CATALOG_DETAIL_COMMENT_ID_MAIL_EVENT_SHOW_RU", 349);//публикация комментария
define("BX_CATALOG_DETAIL_COMMENT_ID_MAIL_EVENT_SHOW_EN", 350);

define("BX_CATALOG_DETAIL_COMMENT_ID_MAIL_EVENT_HIDE_RU", 351);//сокрытие комментария
define("BX_CATALOG_DETAIL_COMMENT_ID_MAIL_EVENT_HIDE_EN", 352);

define("BX_CATALOG_DETAIL_COMMENT_ID_MAIL_EVENT_DELETE_RU", 353);//удаление комментария
define("BX_CATALOG_DETAIL_COMMENT_ID_MAIL_EVENT_DELETE_EN", 354);



