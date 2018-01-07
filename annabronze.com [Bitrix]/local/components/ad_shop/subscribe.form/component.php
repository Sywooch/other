<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
if (!CModule::IncludeModule('subscribe')) {
    ShowError(GetMessage("SUBSCR_MODULE_NOT_INSTALLED"));
    return;
}

if (!isset($arParams["CACHE_TIME"])) {
    $arParams["CACHE_TIME"] = 3600;
}
if ($arParams["CACHE_TYPE"] == "N" || ($arParams["CACHE_TYPE"] == "A" && COption::GetOptionString("main",
            "component_cache_on", "Y") == "N")
) {
    $arParams["CACHE_TIME"] = 0;
}
$arResult['ALREADY_SUBSCRIBED'] = false;

/*//Если не задана рубрика
echo count($arParams['RUB_ID']);
if (count($arParams['RUB_ID']) === 0) {
    // определим рубрики активные рубрики подписок
    echo 'koko';
    $rub = CRubric::GetList(array(), array("ACTIVE" => "Y"));
    while ($res = $rub->Fetch()) {
        $RUB_ID[] = $res['ID'];
    }
} else {
    $RUB_ID = $arParams['RUB_ID'];
}
print_r($RUB_ID);*/
if ($_SERVER["REQUEST_METHOD"] == "POST" && check_bitrix_sessid()) {
    $result = array();
    $result['result'] = false;
    $result['message'] = GetMessage('subscr_success');
    $arrPost = filter_input_array(
        INPUT_POST,
        array(
            'email' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        )
    );

    if (!preg_match("/^[a-zA-Z0-9_\-.]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-.]+$/", $_POST['email'])) {
        $result['result'] = false;
        $result['message'] = GetMessage('subscr_error');
        //exit();
    } else {



            if ($USER->IsAuthorized()) {
                global $USER;
                $USER_id = $USER->GetID();
            } else {
                $USER_id = null;
            }
            $RUB_ID = array();
            $rub = CRubric::GetList(array(), array("ACTIVE" => "Y"));
            while ($res = $rub->Fetch()) {
                $RUB_ID[] = $res['ID'];
            }
            $subscr = new CSubscription;
            // поиск подписчика по mail
            $subscription = CSubscription::GetByEmail($arrPost['email']);
            if ($arSub = $subscription->Fetch()) {
               //echo"<pre>";print_r($arSub); echo"</pre>";
                if($arSub['ACTIVE']==='N'){
                    $arFields = Array(
                        "ACTIVE" => "Y",
                        "RUB_ID" => $RUB_ID,
                        "SEND_CONFIRM" => "N",
                        "CONFIRMED" => 'Y'
                    );
                    if($subscr->Update($arSub['ID'],$arFields,SITE_ID)){



                        $arrFieldsEmail = array(
                            'EMAIL' => $arrPost['email'],
                            'DATE_SUBSCR' => date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT"))),
                            'MAIL_ID' => $arSub['ID'],
                            'MAIL_MD5' => SubscribeHandlers::GetMailHash($arrPost['email']),
                            //'NAME' => $arrPost['name']
                        );
                        if (CEvent::SendImmediate('SUBSCRIBE_CONFIRM_' . LANGUAGE_ID, SITE_ID, $arrFieldsEmail)) {

                        }

                        $result['message'] = GetMessage('subscr_success');
                        $result['result'] = true;
                    }

                }
                else{
                    $result['message'] = GetMessage('subscr_already');
                }


            } else {
                /* создадим массив на подписку */
                $arFields = Array(
                    "USER_ID" => $USER_id,
                    "FORMAT" => "html/text",
                    "EMAIL" => $arrPost['email'],
                    "ACTIVE" => "Y",
                    "RUB_ID" => $RUB_ID,
                    "SEND_CONFIRM" => "N",
                    "CONFIRMED" => 'Y'
                );
                $idsubrscr = $subscr->Add($arFields);
                if ($idsubrscr) {
                    $arrFieldsEmail = array(
                        'EMAIL' => $arrPost['email'],
                        'DATE_SUBSCR' => date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT"))),
                        'MAIL_ID' => $idsubrscr,
                        'MAIL_MD5' => SubscribeHandlers::GetMailHash($arrPost['email']),
                        //'NAME' => $arrPost['name']
                    );




                    $result['message'] = GetMessage('subscr_success');
                    $result['result'] = true;
                    if (CEvent::SendImmediate('SUBSCRIBE_CONFIRM_' . LANGUAGE_ID, SITE_ID, $arrFieldsEmail)) {

                    }
                }
            }

    }
    echo json_encode($result);
} else {
    $this->IncludeComponentTemplate();
}

?>
