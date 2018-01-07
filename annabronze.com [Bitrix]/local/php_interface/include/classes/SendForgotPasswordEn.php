<?php
class SendForgotPasswordEn{



    /*
     * шлём англоязычному пользователю письмо с ссылкой для восстановления пароля
     * */

    public static function SendPasswordEn($LOGIN, $EMAIL, $SITE_ID = false, $captcha_word = "", $captcha_sid = 0)
    {
        /** @global CMain $APPLICATION */
        global $DB, $APPLICATION;

        $arParams = array(
            "LOGIN" => $LOGIN,
            "EMAIL" => $EMAIL,
            "SITE_ID" => $SITE_ID
        );



        $result_message = array("MESSAGE"=>""."<br>", "TYPE"=>"OK");
        $APPLICATION->ResetException();
        $bOk = true;


        foreach(GetModuleEvents("main", "OnBeforeUserSendPassword", true) as $arEvent)
        {
            if(ExecuteModuleEventEx($arEvent, array(&$arParams))===false)
            {
                if($err = $APPLICATION->GetException())
                    $result_message = array("MESSAGE"=>$err->GetString()."<br>", "TYPE"=>"ERROR");

                $bOk = false;
                break;
            }
        }

        if($bOk && COption::GetOptionString("main", "captcha_restoring_password", "N") == "Y")
        {
            if (!($APPLICATION->CaptchaCheckCode($captcha_word, $captcha_sid)))
            {
                $result_message = array("MESSAGE"=>GetMessage("main_user_captcha_error")."<br>", "TYPE"=>"ERROR");
                $bOk = false;
            }
        }

        if($bOk)
        {
            $f = false;
            if($arParams["LOGIN"] <> '' || $arParams["EMAIL"] <> '')
            {
                $confirmation = (COption::GetOptionString("main", "new_user_registration_email_confirmation", "N") == "Y");



                $strSql = "";
                if($arParams["LOGIN"] <> '')
                {
                    $strSql =
                        "SELECT ID, LID, ACTIVE, CONFIRM_CODE, LOGIN, EMAIL, NAME, LAST_NAME, LANGUAGE_ID ".
                        "FROM b_user u ".
                        "WHERE LOGIN='".$DB->ForSQL($arParams["LOGIN"])."' ".
                        "    AND (ACTIVE='Y' OR NOT(CONFIRM_CODE IS NULL OR CONFIRM_CODE='')) ".
                        "    AND (EXTERNAL_AUTH_ID IS NULL OR EXTERNAL_AUTH_ID='') ";
                }
                if($arParams["EMAIL"] <> '')
                {
                    if($strSql <> '')
                    {
                        $strSql .= "\nUNION\n";
                    }
                    $strSql .=
                        "SELECT ID, LID, ACTIVE, CONFIRM_CODE, LOGIN, EMAIL, NAME, LAST_NAME, LANGUAGE_ID ".
                        "FROM b_user u ".
                        "WHERE EMAIL='".$DB->ForSQL($arParams["EMAIL"])."' ".
                        "    AND (ACTIVE='Y' OR NOT(CONFIRM_CODE IS NULL OR CONFIRM_CODE='')) ".
                        "    AND (EXTERNAL_AUTH_ID IS NULL OR EXTERNAL_AUTH_ID='') ";
                }
                $res = $DB->Query($strSql);

                while($arUser = $res->Fetch())
                {


                    if($arParams["SITE_ID"]===false)
                    {
                        if(defined("ADMIN_SECTION") && ADMIN_SECTION===true)
                            $arParams["SITE_ID"] = CSite::GetDefSite($arUser["LID"]);
                        else
                            $arParams["SITE_ID"] = SITE_ID;
                    }

                    if($arUser["ACTIVE"] == "Y")
                    {


                        //CUser::SendUserInfo($arUser["ID"], $arParams["SITE_ID"], GetMessage("INFO_REQ"), true, 'USER_PASS_REQUEST_en');


                        $rsUserCopy = CUser::GetByID($arUser["ID"]);
                        $arUserCopy = $rsUserCopy->Fetch();

                       
                        if($arUserCopy["ACTIVE"] == "Y") $status = GetMessage("STATUS_ACTIVE");
                        else $status = GetMessage("STATUS_BLOCKED");

                        $checkword = md5(CMain::GetServerUniqID().uniqid());


                        $saleEmail = COption::GetOptionString("sale", "order_email");

                       
                        Bitrix\Main\Mail\Event::send(array(
                            "EVENT_NAME" => "USER_PASS_REQUEST_en",
                            "LID" => "en",
                            "C_FIELDS" => array(
                                "EMAIL" => $arUser["EMAIL"],
                                "NAME" => $arUser["NAME"],
                                "LAST_NAME" => $arUser["LAST_NAME"],
                                "MESSAGE" => GetMessage("INFO_REQ"),
                                "USER_ID" => $arUser["ID"],
                                "LOGIN" => $arUser["LOGIN"],
                                "STATUS" => $status,
                                "CHECKWORD" => $checkword,
                                "URL_LOGIN" => urlencode($arUserCopy["LOGIN"]),
                                "SERVER_NAME" => $_SERVER['SERVER_NAME'],
                                "SALE_EMAIL" => $saleEmail
                            ),
                        ));

                        $f = true;
                    }
                    elseif($confirmation)
                    {

                        //unconfirmed registration - resend confirmation email
                        $arFields = array(
                            "USER_ID" => $arUser["ID"],
                            "LOGIN" => $arUser["LOGIN"],
                            "EMAIL" => $arUser["EMAIL"],
                            "NAME" => $arUser["NAME"],
                            "LAST_NAME" => $arUser["LAST_NAME"],
                            "CONFIRM_CODE" => $arUser["CONFIRM_CODE"],
                            "USER_IP" => $_SERVER["REMOTE_ADDR"],
                            "USER_HOST" => @gethostbyaddr($_SERVER["REMOTE_ADDR"]),
                        );



                        $event = new CEvent;
                        $event->SendImmediate("NEW_USER_CONFIRM", $arParams["SITE_ID"], $arFields, "Y", "", array(), $arUser["LANGUAGE_ID"]);

                        $result_message = array("MESSAGE"=>GetMessage("MAIN_SEND_PASS_CONFIRM")."<br>", "TYPE"=>"OK");
                        $f = true;
                    }

                    if(COption::GetOptionString("main", "event_log_password_request", "N") === "Y")
                    {
                        CEventLog::Log("SECURITY", "USER_INFO", "main", $arUser["ID"]);
                    }
                }
            }
            if(!$f)
            {
                return array("MESSAGE"=>GetMessage('DATA_NOT_FOUND')."<br>", "TYPE"=>"ERROR");
            }
        }

        return $result_message;
    }

}