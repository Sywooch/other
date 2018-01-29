<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dima
 * Date: 20.08.12
 * Time: 11:18
 * To change this template use File | Settings | File Templates.
 */
class Tao141Clients{
    public static function onRenderMoneyInfo($sid){
        global $otapilib;

        $user = $otapilib->GetUserInfo($sid);


        $cms = new CMS();
        $status = $cms->Check();
        if(!$status)
            return false;
        $cms->checkTable('site_users_additional_data');
        return array('iframe' => stripslashes(self::getUserAttrs((string)$user['Id'], 'iframe')));
    }

    public static function onRenderUserEditForm(&$user){
        $cms = new CMS();
        $status = $cms->Check();
        if(!$status)
            return ;
        $cms->checkTable('site_users_additional_data');
        $user['UserIframe'] = stripslashes(self::getUserAttrs((string)$user['Id'], 'iframe'));
        ob_start();
        require dirname(__FILE__).'/tpl/clients.tao141.onRenderUserEditForm.html';
        $c = ob_get_contents();
        ob_end_clean();
        return $c;
    }

    public static function onAddUser(&$user, $newUserId){
        $cms = new CMS();
        $status = $cms->Check();
        if(!$status)
            return ;
        $cms->checkTable('site_users_additional_data');

        $result = mysql_query('
            INSERT INTO `site_users_additional_data`
            SET
                `userid`='.(int)$newUserId.',
                `attribute_title`="iframe",
                `attribute_value`=""
        ');

        return $result;
    }

    public static function onEditUser(&$user){
        $cms = new CMS();
        $status = $cms->Check();
        if(!$status)
            return ;
        $cms->checkTable('site_users_additional_data');

        if(self::userIframeExists($user['Id']))
            $result = self::addUserIframe(@$user['UserIframe'], $user['Id']);
        else
            $result = self::updateUserIframe(@$user['UserIframe'], $user['Id']);

        return $result;
    }

    private static function userIframeExists($id){
        return mysql_result(
            mysql_query('
                SELECT COUNT(*)
                FROM `site_users_additional_data`
                WHERE
                    `userid`="'.(int)$id.'"
                    AND `attribute_title`="iframe"
            '),
            0
        );
    }

    private static function addUserIframe($iframe, $id){
        return mysql_query('
                UPDATE `site_users_additional_data`
                SET
                    `attribute_value`="'.mysql_real_escape_string($iframe).'"
                WHERE `userid`='.(int)$id.' AND `attribute_title`="iframe"
            ');
    }

    private static function updateUserIframe($iframe, $id){
        return mysql_query('
                INSERT INTO `site_users_additional_data`
                SET
                    `userid`='.(int)$id.',
                    `attribute_title`="iframe",
                    `attribute_value`="'.mysql_real_escape_string($iframe).'"
            ');
    }

    public static function getUserAttrs($id, $attr){
        $result = mysql_query('
            SELECT `attribute_value`
            FROM `site_users_additional_data`
            WHERE
                `userid`="'.$id.'"
                AND `attribute_title`="'.mysql_real_escape_string($attr).'"
        ');
        if(mysql_num_rows($result))
            return mysql_result($result, 0);
        else
            return false;
    }

    public static function onCreateOrder($sid, $model){
        global $otapilib;
        return $otapilib->CreateMultiSalesOrder($sid, $model);
    }
}
