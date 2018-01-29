<?
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');

    define('CFG_SERVICE_APPKEY', '');
    define('CFG_SERVICE_APPPASSWORD', '');
    define('CFG_CACHED', false);
    define('CFG_SERVICE_INSTANCEKEY', 'testTopApi');
    //define('CFG_SERVICE_INSTANCEKEY', 'opendemo');
    //define('CFG_SERVICE_INSTANCEKEY', '58d83a57-5f1c-4801-8569-03ef96c42217');
    define('CFG_SERVICE_URL', 'http://otapi.business.dev.services.opentao.net/OtapiWebService2.asmx/');
    //define('CFG_SERVICE_URL', 'http://otapi.business.demo.services.opentao.net/OtapiWebService2.asmx/');

    define('CFG_MULTI_CURL', 0);
    define('CFG_SHOW_SOCIAL_BLOCK', 1);

	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', '');
	define('DB_BASE', 'dev.opentao.srv');

    //define('CFG_FRIENDLY_URLS', true);
    //define('CFG_BASE_HREF', 'http://localhost/_vivatao/opentao.net/');

    //define('NO_DEBUG', '1');

    define('KEY_REFERRAL_SYSTEM',1);
    define('LIMIT_FOR_BONUS_REFERRAL_SYSTEM', 15);

    define('CFG_PAYMENT_SERVER', 'http://paymentsystemconnector.payments.dev.opentao.net/');
    define('CFG_TRADEHUB_CELL', true);    

    define('CFG_SAVE_ADMIN_COOKIE', 1);

    define('ITEM_FILTER', 1);
	define('MY_GOODS_SYSTEM', 1);
	define('CNF_OUTPUT_MONEY_EMAIL', 'email@mail.ru');
    //define('SEND_EMAIL_NOTIFICATION', true);
    define('NOTIFICATION_LOGIN', 'info@opentao.net');
    define('NOTIFICATION_PASS', 'nhekzkz123');

    //define('USE_IMAGE_LIST_IN_ITEM', 1);
    define('CFG_WEBPHOTO', 1);
    define('CFG_DIGEST', 1);
	define('CFG_USRHISTORY', 1);
	define('CFG_SHOPREVIEW', 1);

?>