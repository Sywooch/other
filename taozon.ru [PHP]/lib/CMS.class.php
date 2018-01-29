<?php

/**
 * CMS
 */

class CMS
{
    private $link;

    /**
     * @param $sql
     * @param array $checkTablesExist
     * @return resource
     * @throws DBException
     */
    public function query($sql, $checkTablesExist = array())
    {
        $this->Check();
        if (!is_resource($this->link)) {
            throw new DBException('There is no DB connection.');
        }
        foreach ($checkTablesExist as $table) {
            $this->checkTable($table);
        }

        $query = mysql_query($sql);
        if (!$query) {
            throw new DBException('Error: ' . mysql_error() . '. SQL: ' . $sql);
        }

        return $query;
    }

    /**
     * @param $sql
     * @param array $checkTablesExist
     * @return resource
     */
    public function querySingleValue($sql, $checkTablesExist = array()){
        $query = $this->query($sql, $checkTablesExist);
        return mysql_num_rows($query) > 0 ? mysql_result($query, 0) : false;
    }

    /**
     * @param $sql
     * @param array $checkTablesExist
     * @return array
     */

    public function queryMakeArray($sql, $checkTablesExist = array(), $idField = null)
    {
        $query = $this->query($sql, $checkTablesExist);
        $result = array();

        if (is_bool($query)){
            return $result;
        }

        while ($row = mysql_fetch_assoc($query)) {
            if ($idField && isset($row[$idField])) {
                $result[$row[$idField]] = $row;
            } else {
                $result[] = $row;
            }
        }

        return $result;
    }

    /**
     * @param $value
     * @return string
     */
    public function escape($value)
    {
        return mysql_real_escape_string($value);
    }

    /**
     * @return int
     */
    public function insertedId()
    {
        return mysql_insert_id();
    }

    public function getFoundRows()
    {
        $res = @mysql_fetch_row(@mysql_query('SELECT FOUND_ROWS()', $this->link));
        return isset($res[0]) ? (int)$res[0] : 0;
    }

    public function checkTable($tableName)
    {
        $tableNameSafe = $this->escape($tableName);
        $result = $this->query("SHOW TABLES LIKE '$tableNameSafe'");

        if (mysql_num_rows($result) <= 0) {
            $f = dirname(dirname(__FILE__)) . '/admin/sql/' . $tableNameSafe . '.sql';
            if(file_exists($f)){
                $this->query(file_get_contents($f));
            }
            else{
                throw new DBException('Table schema file not found', DBException::CANNOT_CREATE_TABLE);
            }
        }

        return true;
    }

    public function tableExists($tableName){
        $tableNameSafe = $this->escape($tableName);
        $result = $this->query("SHOW TABLES LIKE '$tableNameSafe'");

        return mysql_num_rows($result);
    }

    static public function IsFeatureEnabled($feature)
    {
        return in_array($feature, General::$enabledFeatures);
    }

    //
    public function sendEmail($email, $subject, $body)
    {
        General::mail_utf8(
            $email,
            CFG_SITE_NAME,
            'noreply@' . preg_replace('/^www\./', '', $_SERVER['HTTP_HOST']),
            $subject,
            $body
        );
    }

    public function getBlogPostIdByAlias($alias) {
        $q = 'SELECT `p`.`id` FROM `digest` `p`
        LEFT JOIN `site_digest_langs` `pl`
        ON `p`.`id`=`pl`.`post_id`
        LEFT JOIN `site_langs` `l`
        ON `pl`.`lang_id` = `l`.`id`
        WHERE `p`.`alias` = "' . $this->escape($alias) . '" AND (`l`.`lang_code`="' . $_SESSION['active_lang'] . '"  OR `l`.`lang_code` IS NULL)
        ORDER BY `l`.`lang_code` DESC;';
        
        $r = mysql_query($q);
        if ($r && mysql_num_rows($r)) {
            return mysql_result($r, 0);
        } else {
            return '';
        }
    }    
    public function GetPageByAlias($alias)
    {
        $this->checkTable('site_pages_langs');

        $_SESSION['active_lang'];
        $r = mysql_query(
            '
            SELECT `p`.*, `l`.`id` as `lang_id` FROM `pages` `p`
            LEFT JOIN `site_pages_langs` `pl`
                ON `p`.`id`=`pl`.`page_id`
            LEFT JOIN `site_langs` `l`
                ON `pl`.`lang_id` = `l`.`id`
            WHERE `p`.`alias` = "' . $this->escape($alias) . '" AND (`l`.`lang_code`="' . $_SESSION['active_lang'] . '"  OR `l`.`lang_code` IS NULL)
            ORDER BY `l`.`lang_code` DESC
            '
        );
        $page = false;
        if ($r) if ($row = mysql_fetch_assoc($r)) {
            $page = $row;
            $r = mysql_query("
                SELECT * FROM `site_pages_langs_data`
                WHERE `p`='" . $this->escape($page['alias']) . "'
                AND `lang_id`='" . $page['lang_id'] . "'
                ");
            if ($r && mysql_num_rows($r)) {
                $row = mysql_fetch_assoc($r);
                $page['pagetitle'] = $row['pagetitle'];
                $page['seo_keywords'] = $row['seo_keywords'];
                $page['seo_description'] = $row['seo_description'];
            }
        }
        if ($page) {
            $block = $this->GetBlocksByPageID($page['id']);
            if ($block === -1) $block = $this->GetBlocksByPageID($page['id']);
            $page['text'] = $block[0]['text'];
            $page['text'] = str_replace(array("\'", '\"', '\\\\'), array("'", '"', '\\'), $page['text']);
            // TODO
            $page['block_id'] = $block[0]['id'];
        }
        return $page;
    }

    public static function GetQuittanceMethod($currency)
    {
        if ($_SESSION['active_lang'] !== 'ru') return array();
        if (!self::IsFeatureEnabled('SberbankInvoice')) return array();
        if ($currency['Code'] != 'RUB') return array();
        if (!self::CheckStatic()) return array();
        $checkFields = array(
            'name_of_payee',
            'INN_of_payee',
            'account_number_of_payee',
            'bank_name_of_payee',
            'bank_identification_code',
            'correspondent_bank_account',
            'description_of_payment',
        );
        $data = self::getSiteConfigStatic();
        if (!$data[0] || CMS::QuittanceDataHasErrors($data[1], $checkFields))
            return array();
        return array(
            'Id' => 'sberbank',
            'id' => 'sberbank',
            'Name' => Lang::get('quittance'),
            'name' => Lang::get('quittance'),
            'Description' => Lang::get('quittance_desc'),
            'description' => Lang::get('quittance_desc'),
//            'PaymSortCode' => Cash
//            'paymsortcode' => Cash
            'PaymSortText' => Lang::get('quittance'),
            'paymsorttext' => Lang::get('quittance'),
            'ImageURL' => 'sberbank.png',
            'imageurl' => 'sberbank.png',
            'PaymentSystem' => 'quittance',
            'paymentsystem' => 'quittance',
            'CustomField' => 'None',
            'customfield' => 'None',
        );
    }

    public static function QuittanceDataHasErrors($data, $fields)
    {
        $arResult = array();
        foreach ($fields as $fieldName) {
            if (isset($data[$fieldName])) $data[$fieldName] = trim($data[$fieldName]);
            if (!isset($data[$fieldName]) || empty($data[$fieldName])) {
                $arResult[$fieldName] = '';
                continue;
            }
            if ($fieldName == 'INN_of_payee') {
                if (!is_numeric($data[$fieldName]) || strlen($data[$fieldName]) < 10 || strlen($data[$fieldName]) > 12)
                    $arResult[$fieldName] = $data[$fieldName];
            } elseif ($fieldName == 'account_number_of_payee' || $fieldName == 'correspondent_bank_account') {
                if (!is_numeric($data[$fieldName]) || strlen($data[$fieldName]) != 20)
                    $arResult[$fieldName] = $data[$fieldName];
            } elseif ($fieldName == 'bank_identification_code') {
                if (!is_numeric($data[$fieldName]) || strlen($data[$fieldName]) < 8 || strlen($data[$fieldName]) > 9)
                    $arResult[$fieldName] = $data[$fieldName];
            }
        }
        if (!empty($arResult))
            return $arResult;
        else
            return false;

    }

    public function SetSubscribe($name, $email, $subscribe = 'news')
    {
        self::CheckStatic();
        $res = mysql_query('INSERT INTO `subscription`(subscription,email,name,date)' .
            ' VALUES("' . $this->escape($subscribe) . '","' . $this->escape($email) . '","' .
            $this->escape($name) . '","' .
            date('Y.m.d') . '") ON DUPLICATE KEY UPDATE' .
            ' name="' . $this->escape($name) . '"');
        return $res;
    }

    public function GetFullPageById($id)
    {
        $r = mysql_query('SELECT * FROM `pages` WHERE `id` = "' . (int)$id . '"');
        $page = false;
        if ($r) if ($row = mysql_fetch_assoc($r)) {
            $page = $row;
        }
        if ($page) {
            $block = $this->GetBlocksByPageID($page['id']);
            if ($block === -1) $block = $this->GetBlocksByPageID($page['id']);
            $page['text'] = $block[0]['text'];
            $page['text'] = str_replace(array("\'", '\"', '\\\\'), array("'", '"', '\\'), $page['text']);
            // TODO
            $page['block_id'] = $block[0]['id'];
        }
        return $page;
    }

    //
    public function GetBlocksByPageID($id)
    {
        $r = mysql_query('SELECT * FROM `blocks` WHERE `page_id` = "' . (int)$id . '"');
        $block = array();
        if ($r && mysql_num_rows($r) > 0) {
            while ($row = mysql_fetch_assoc($r)) {
                $block[] = $row;
            }
        } else {
            $this->checkTable('blocks');
            mysql_query("INSERT INTO `blocks` (`page_id`, `text` ) VALUES ('" . (int)$id . "', '...');");
            $block = -1;
        }
        return $block;
    }

    public function UpdatePageByID($id, $data)
    {
        $langid = $this->_getLangCodeId($data['lang']);
        $this->checkTable('site_pages_langs');
        $this->checkTable('site_pages_langs_data');

        $isService = (isset($data['is_service'])) ? '1' : '0';
        mysql_query('UPDATE `pages` SET `alias` = "' . $data['alias'] . '", `title`= "' . $this->escape($data['title']) . '", `is_service` = "' . $isService . '" WHERE `id` = "' . (int)$id . '"');

        $r = mysql_query('SELECT COUNT(*) FROM site_pages_langs WHERE `lang_id`="' . $langid . '" AND `page_id`="' . (int)$id . '"');
        $c = mysql_result($r, 0);
        if ($c) {
            mysql_query('UPDATE `site_pages_langs` SET `lang_id` = "' . $langid . '" WHERE `page_id` = "' . (int)$id . '"');
        } else {
            mysql_query('INSERT INTO `site_pages_langs` (`lang_id`, `page_id` ) VALUES ( "' . $langid . '", "' . (int)$id . '" )');
        }

        $r = mysql_query('DELETE FROM site_pages_langs_data WHERE `lang_id`="' . $langid . '" AND `p`="' . $this->escape($data['alias']) . '"');
        mysql_query('INSERT INTO `site_pages_langs_data` (`lang_id`, `p`, `pagetitle`, `seo_keywords`, `seo_description`, `type` ) VALUES ( "' . $langid . '", "' . $this->escape($data['alias']) . '", "' . $this->escape($data['pagetitle']) . '", "' . $this->escape($data['seo_keywords']) . '", "' . $this->escape($data['seo_description']) . '", "content" )');
    }

    public function UpdateBlockByID($id, $text)
    {
        $r = mysql_query('UPDATE `blocks` SET `text` = "' . $this->escape($text) . '" WHERE `id` = "' . (int)$id . '"');
    }

    public function add_site_pages_parents($page_id, $parent_id)
    {
        $this->checkTable('site_pages_parents');
        mysql_query('INSERT INTO `site_pages_parents` SET `page_id` = "' . (int)$page_id . '", '
            . ' `parent_id` = "' . (int)$parent_id . '"');
        return mysql_insert_id();
    }

    public function del_site_pages_parents_page_id($page_id)
    {
        $this->checkTable('site_pages_parents');
        mysql_query('DELETE FROM `site_pages_parents` WHERE `page_id`= "' . (int)$page_id . '"');
        return mysql_affected_rows();
    }

    public function get_parent_id_site_pages_parents_page_id($page_id)
    {
        $this->checkTable('site_pages_parents');
        $sql = 'SELECT `parent_id` FROM `site_pages_parents` WHERE `page_id` = "' . (int)$page_id . '"';
        $query = mysql_query($sql);
        if (mysql_num_rows($query)) {
            return mysql_result($query, 0);
        }
        return false;
    }

    public function DeletePageByID($id)
    {
        $this->checkTable('site_pages_parents');
        $id = (int)$id;
        // СѓРґР°Р»СЏРµРј РїРѕС‚РѕРјРєРѕРІ РµСЃР»Рё СЃС‚СЂР°РЅРёС†Р° СЂРѕРґРёС‚РµР»СЊ
        mysql_query("DELETE FROM `site_pages_parents` WHERE `parent_id` = '" . $id . "'");
        // СѓРґР°Р»СЏРµРј СЃС‚СЂР°РЅРёС†Сѓ РµСЃР»Рё РѕРЅР° РїРѕС‚РѕРјРѕРє
        mysql_query("DELETE FROM `site_pages_parents` WHERE `page_id` = '" . $id . "'");

        // РґР»СЏ РѕС‡РёСЃС‚РєРё С‚Р°Р±Р»РёС†С‹ `site_pages_langs_data`
        $query = mysql_query('SELECT `alias` FROM `pages` WHERE `id` = "' . $id . '"');
        if ($query && mysql_num_rows($query)) {
            $alias = mysql_result($query, 0);
        }

        $this->checkTable('site_pages_langs_data');
        $r = mysql_query('DELETE FROM `site_pages_langs_data` WHERE `p` = "' . $this->escape($alias) . '"');

        $this->checkTable('site_pages_langs');
        $r = mysql_query('DELETE FROM `site_pages_langs` WHERE `page_id` = "' . $id . '"');

        // СѓРґР°Р»СЏРµРј СЃС‚СЂР°РЅРёС†Сѓ
        $r = mysql_query('DELETE FROM `pages` WHERE `id` = "' . $id . '"');
    }

    public function CreatePage($data)
    {
        $langid = $this->_getLangCodeId($data['lang']);
        $this->checkTable('site_pages_langs');
        $this->checkTable('site_pages_langs_data');

        mysql_query('INSERT INTO `pages` (`alias`, `title`) VALUES ("' . $this->escape($data['alias']) . '", "' . $this->escape($data['title']) . '")');
        $pid = mysql_insert_id();
        $sql = 'INSERT INTO `site_pages_langs` (`lang_id`, `page_id` ) VALUES ( "' . $langid . '", "' . $pid . '" )';
        mysql_query($sql);

        $pagetitle = isset($data['pagetitle']) ? $this->escape($data['pagetitle']) : '';
        $seo_keywords = isset($data['seo_keywords']) ? $this->escape($data['seo_keywords']) : '';
        $seo_description = isset($data['seo_description']) ? $this->escape($data['seo_description']) : '';
        $sql = 'INSERT INTO `site_pages_langs_data` (`lang_id`, `p`, `pagetitle`, `seo_keywords`, `seo_description`, `type`) VALUES ("' . $langid . '", "' . $this->escape($data['alias']) . '", "' . $pagetitle . '", "' . $seo_keywords . '", "' . $seo_description . '", "content")';
        mysql_query($sql);

        return $pid;
    }

    public function GetPageByID($id)
    {
        $r = mysql_query(
            '
            SELECT `p`.*, `l`.`lang_code`, `l`.`id` as `lang_id` FROM `pages` `p`
            LEFT JOIN `site_pages_langs` `pl`
                ON `p`.`id`=`pl`.`page_id`
            LEFT JOIN `site_langs` `l`
                ON `pl`.`lang_id` = `l`.`id`
            WHERE `p`.`id` = "' . (int)$id . '"
            '
        );

        $page = false;
        if ($r) if ($row = mysql_fetch_assoc($r)) {
            $page = $row;
            $page['title'] = str_replace(array("\'", '\"', '\\\\'), array("'", '"', '\\'), $page['title']);
            $r = mysql_query("
                SELECT * FROM `site_pages_langs_data`
                WHERE `p`='" . $this->escape($page['alias']) . "'
                AND `lang_id`='" . $page['lang_id'] . "'
                ");
            if ($r && mysql_num_rows($r)) {
                $row = mysql_fetch_assoc($r);
                $page['pagetitle'] = $row['pagetitle'];
                $page['seo_keywords'] = $row['seo_keywords'];
                $page['seo_description'] = $row['seo_description'];
            }
        }
        return $page;
    }

    public function GetPages()
    {
        $r = mysql_query('
            SELECT DISTINCT `p`.*, `l`.`lang_name`, `l`.`lang_code`
            FROM `pages` `p`
            LEFT JOIN `site_pages_langs` `pl`
                ON `p`.`id`=`pl`.`page_id`
            LEFT JOIN `site_langs` `l`
                ON `pl`.`lang_id` = `l`.`id`
                ORDER BY `p`.`id` ASC
            ');
        $pages = array();
        if ($r && @mysql_num_rows($r)) {
            while ($row = mysql_fetch_assoc($r)) {
                $pages[] = $row;
            }
        } else {
            $this->checkTable('pages');
            $this->checkTable('site_langs');
            $this->checkTable('site_pages_langs');
            $this->checkLanguage('ru', 'Russian (Русский)');
            $this->checkLanguage('en', 'English (English)');

            $this->createPaymentPages();
            $this->createDefaultPages();

            $pages = -1;
        }
        return $pages;
    }

    public function CreateNews($data)
    {
        $langid = $this->_getLangCodeId($data['lang']);
        $this->checkTable('site_news_langs');

        mysql_query('INSERT INTO `news` (`title`, `brief`, `image` ) VALUES ( "' . $this->escape($data['title']) . '", "' . $this->escape($data['brief']) . '", "' . $this->escape($data['image']) . '" )');
        $pid = mysql_insert_id();
        mysql_query('INSERT INTO `site_news_langs` (`lang_id`, `news_id` ) VALUES ( "' . $langid . '", "' . $pid . '" )');

        return $pid;
    }

    public function UpdateNewsByID($id, $data)
    {
        $langid = $this->_getLangCodeId($data['lang']);
        $this->checkTable('site_news_langs');

        mysql_query('UPDATE `news` SET `title`= "' . $this->escape($data['title']) . '", `brief`= "' . $this->escape($data['brief']) . '", `image` = "' . $this->escape($data['image']) . '" WHERE `id` = "' . (int)$id . '"');

        $r = mysql_query('SELECT COUNT(*) FROM site_news_langs WHERE `lang_id`="' . $langid . '" AND `news_id`="' . $id . '"');
        $c = mysql_result($r, 0);
        if ($c) {
            mysql_query('UPDATE `site_news_langs` SET `lang_id` = "' . $langid . '" WHERE `news_id` = "' . (int)$id . '"');
        } else {
            mysql_query('INSERT INTO `site_news_langs` (`lang_id`, `news_id` ) VALUES ( "' . $langid . '", "' . (int)$id . '" )');
        }
    }

    function UpdateNewsText($id, $text)
    {
        mysql_query('UPDATE `news` SET `text`= "' . $this->escape($text) . '" WHERE `id` = "' . (int)$id . '"');
    }

    public function DeleteNewsByID($id)
    {
        $r = mysql_query('DELETE FROM `news` WHERE `id` = "' . (int)$id . '"');

        $this->checkTable('site_news_langs');
        $r = mysql_query('DELETE FROM `site_news_langs` WHERE `news_id` = "' . (int)$id . '"');
    }

    public function GetNewsByID($id)
    {
        $r = mysql_query(
            '
            SELECT `p`.*, `l`.`lang_code`, `l`.`id` as `lang_id` FROM `news` `p`
            LEFT JOIN `site_news_langs` `pl`
                ON `p`.`id`=`pl`.`news_id`
            LEFT JOIN `site_langs` `l`
                ON `pl`.`lang_id` = `l`.`id`
            WHERE `p`.`id` = "' . (int)$id . '"
            '
        );

        $news = false;
        if ($r) if ($row = mysql_fetch_assoc($r)) {
            $news = $row;
            $news['title'] = str_replace(array("\'", '\"', '\\\\'), array("'", '"', '\\'), $news['title']);
            $news['brief'] = str_replace(array("\'", '\"', '\\\\'), array("'", '"', '\\'), $news['brief']);
            $news['image'] = str_replace(array("\'", '\"', '\\\\'), array("'", '"', '\\'), $news['image']);
            $news['text'] = str_replace(array("\'", '\"', '\\\\'), array("'", '"', '\\'), $news['text']);
        }
        return $news;
    }

    public function GetAllNews()
    {
        $this->checkTable('news');
        $this->checkTable('site_news_langs');
        $r = mysql_query('
            SELECT DISTINCT `p`.*, `l`.`lang_name`,`l`.`lang_code`
            FROM `news` `p`
            LEFT JOIN `site_news_langs` `pl`
                ON `p`.`id`=`pl`.`news_id`
            LEFT JOIN `site_langs` `l`
                        ON `pl`.`lang_id` = `l`.`id`
                        ORDER BY `p`.`created` DESC
            ');
        //Не осилил SQL запрос, так бы в нем прописал where
        $news = array();
        if ($r && @mysql_num_rows($r)) {
            while ($row = mysql_fetch_assoc($r)) {
                if ($row['lang_code']==$_SESSION['active_lang'])
                    $news[] = $row;
            }
        } else
            $news = -1;

        if (count($news)==0)
            $news = -1;
        return $news;
    }

    public function createDefaultPages()
    {
        $pages = simplexml_load_file('config/defaultpages.xml');
        foreach($pages->alias as $a) {
            $pid = $this->CreatePage(array('lang' => $a[1], 'alias' => $a[0], 'title' => $a[2]));
            $pInfo = $this->GetFullPageById($pid);
            $this->UpdateBlockByID($pInfo['block_id'], '<p>'.$a[3].'</p>');
        }
    }

    private function createPaymentPages()
    {
        $pid = $this->CreatePage(array('lang' => 'ru', 'alias' => 'paymentsuccess', 'title' => 'Оплата успешно произведена'));
        $pInfo = $this->GetFullPageById($pid);
        $this->UpdateBlockByID($pInfo['block_id'], '<p>Оплата успешно произведена</p>');

        $pid = $this->CreatePage(array('lang' => 'ru', 'alias' => 'robo_success', 'title' => 'Оплата успешно произведена'));
        $pInfo = $this->GetFullPageById($pid);
        $this->UpdateBlockByID($pInfo['block_id'], '<p>Оплата успешно произведена</p>');

        $pid = $this->CreatePage(array('lang' => 'ru', 'alias' => 'paymentfail', 'title' => 'Произошла ошибка в процессе оплаты'));
        $pInfo = $this->GetFullPageById($pid);
        $this->UpdateBlockByID($pInfo['block_id'], '<p>Произошла ошибка в процессе оплаты</p>');

        $pid = $this->CreatePage(array('lang' => 'ru', 'alias' => 'robo_fail', 'title' => 'Произошла ошибка в процессе оплаты'));
        $pInfo = $this->GetFullPageById($pid);
        $this->UpdateBlockByID($pInfo['block_id'], '<p>Произошла ошибка в процессе оплаты</p>');

        $pid = $this->CreatePage(array('lang' => 'ru', 'alias' => 'depositsuccess', 'title' => 'Оплата успешно произведена'));
        $pInfo = $this->GetFullPageById($pid);
        $this->UpdateBlockByID($pInfo['block_id'], '<p>Ваш счет учпешно пополнен</p>');

        $pid = $this->CreatePage(array('lang' => 'ru', 'alias' => 'depositfail', 'title' => 'Произошла ошибка в процессе оплаты'));
        $pInfo = $this->GetFullPageById($pid);
        $this->UpdateBlockByID($pInfo['block_id'], '<p>Произошла ошибка в процессе оплаты</p>');


        $pid = $this->CreatePage(array('lang' => 'en', 'alias' => 'paymentsuccess', 'title' => 'Payment is completed successfully'));
        $pInfo = $this->GetFullPageById($pid);
        $this->UpdateBlockByID($pInfo['block_id'], '<p>Payment is completed successfully</p>');

        $pid = $this->CreatePage(array('lang' => 'en', 'alias' => 'robo_success', 'title' => 'Payment is completed successfully'));
        $pInfo = $this->GetFullPageById($pid);
        $this->UpdateBlockByID($pInfo['block_id'], '<p>Payment is completed successfully</p>');

        $pid = $this->CreatePage(array('lang' => 'en', 'alias' => 'paymentfail', 'title' => 'The errors in the payment process'));
        $pInfo = $this->GetFullPageById($pid);
        $this->UpdateBlockByID($pInfo['block_id'], '<p>In the process of payment errors were encountered. Please try again.</p>');

        $pid = $this->CreatePage(array('lang' => 'en', 'alias' => 'robo_fail', 'title' => 'The errors in the payment process'));
        $pInfo = $this->GetFullPageById($pid);
        $this->UpdateBlockByID($pInfo['block_id'], '<p>In the process of payment errors were encountered. Please try again.</p>');

        $pid = $this->CreatePage(array('lang' => 'ru', 'alias' => 'depositsuccess', 'title' => 'Deposit into an account was successfull'));
        $pInfo = $this->GetFullPageById($pid);
        $this->UpdateBlockByID($pInfo['block_id'], '<p>Payment is completed successfully</p>');

        $pid = $this->CreatePage(array('lang' => 'ru', 'alias' => 'depositfail', 'title' => 'The errors in the payment process'));
        $pInfo = $this->GetFullPageById($pid);
        $this->UpdateBlockByID($pInfo['block_id'], '<p>In the process of payment errors were encountered. Please try again.</p>');
    }

    public function Check()
    {
        if (!defined('DB_HOST')) return false;
        if (!defined('DB_USER')) return false;
        if (!defined('DB_PASS')) return false;
        if (!defined('DB_BASE')) return false;
        $this->link = @mysql_connect(DB_HOST, DB_USER, DB_PASS);
        if (!$this->link) return false;
        $res = @mysql_select_db(DB_BASE, $this->link);
        mysql_query('SET NAMES utf8');
        if (!$res) return false;

        return true;
    }

    public static function CheckStatic()
    {
        if (!defined('DB_HOST')) return false;
        if (!defined('DB_USER')) return false;
        if (!defined('DB_PASS')) return false;
        if (!defined('DB_BASE')) return false;
        $link = @mysql_connect(DB_HOST, DB_USER, DB_PASS);
        if (!$link) return false;
        $res = @mysql_select_db(DB_BASE, $link);
        mysql_query('SET NAMES utf8');
        if (!$res) return false;

        return true;
    }

    public function checkLanguage($lang_name, $lang_descr)
    {
        $lang_name = $this->escape($lang_name);
        $lang_descr = $this->escape($lang_descr);
        $q = mysql_query('SELECT COUNT(*) FROM `site_langs` WHERE `lang_code`="' . $lang_name . '"');
        $rows = @mysql_result($q, 0);
        if (!$rows) {
            mysql_query('INSERT INTO `site_langs` SET `lang_code`="' . $lang_name . '", `lang_name`="' . $lang_descr . '"');
        }
    }

    public function getLanguages()
    {
        $q = mysql_query('SELECT * FROM `site_langs`');
        $langs = array();
        while ($lang = mysql_fetch_array($q, MYSQL_ASSOC)) {
            $langs[] = $lang;
        }
        return $langs;
    }

    public function getTranslations($id = '', $lang_code = '', $key = '')
    {
        $where = array();
        if ($id) {
            $id = (int)$id;
            $where[] = '`st`.`id` = "' . $id . '"';
        }
        if ($lang_code) {
            $lang_code = $this->escape($lang_code);
            $where[] = '`l`.`lang_code` = "' . $lang_code . '"';
        }
        if ($key) {
            $key = $this->escape($key);
            $where[] = 'BINARY `k`.`name` = "' . $key . '"';
        }
        if ($where) $where = ' WHERE ' . implode(' AND ', $where); else $where = '';
        $query = '
            SELECT `st`.`id`, `st`.`translation`, `k`.`name` as `key`, `l`.`lang_name`, `l`.`lang_code`
            FROM `site_translations` `st`
            INNER JOIN `site_translation_keys` `k`
            ON `st`.`key`=`k`.`id`
            INNER JOIN `site_langs` `l`
            ON `st`.`langid`=`l`.`id`
            ' . $where . ' ORDER BY `key` ASC';

        $q = mysql_query($query);

        $translations = array();
        while (@$trans = mysql_fetch_array($q, MYSQL_ASSOC)) {
            $translations[] = $trans;
        }
        return $translations;
    }

    public function existTranslations()
    {
        $lang_code = $this->escape($_SESSION['active_lang']);
        $where = 'WHERE `l`.`lang_code` = "' . $lang_code . '"';

        $query = '
            SELECT COUNT(*)
            FROM `site_translations` `st`
            INNER JOIN `site_translation_keys` `k`
            ON `st`.`key`=`k`.`id`
            INNER JOIN `site_langs` `l`
            ON `st`.`langid`=`l`.`id`
            ' . $where;

        $q = mysql_query($query);
        if ($q)
            return mysql_result($q, 0);
        else
            return false;
    }

    public function SetCustomCalculator()
    {
        $files = array('countries.sql', 'delivery.sql', 'countries_for_delivery.sql');
        foreach ($files as $file) {
            $f = dirname(dirname(__FILE__)) . '/admin/sql/calculator/' . $file;
            $fileExists = file_exists($f);
            $r = $fileExists ? mysql_query(file_get_contents($f)) : false;
            echo ' ' . $file . ' : ';
            var_dump($r);
        }
    }

    public function ClearCalculator()
    {
        $tables = array('countries', 'delivery', 'countries_for_delivery');
        foreach ($tables as $table) {
            mysql_query('drop table if exists ' . $table);
            $f = dirname(dirname(__FILE__)) . '/admin/sql/' . $table . '.sql';
            $fileExists = file_exists($f);
            $r = $fileExists ? mysql_query(file_get_contents($f)) : false;
            echo ' ' . $table . ' : '; var_dump($r);
        }
    }

    public function checkTranslations()
    {
        $trans = $this->getTranslations('', $_SESSION['translate_lang']);
        if (count($trans)) {
            return false;
        }

        $xml = @simplexml_load_file(dirname(dirname(__FILE__)) . '/langs/' . $_SESSION['translate_lang'] . '.xml');
        if (!$xml) {
            return false;
        }

        foreach ($xml->key as $k) {
            $keyid = $this->_addKey((string)$k['name']);
            $this->_addTranslation($keyid, $_SESSION['translate_lang'], (string)$k[0]);
        }
    }

    public function getBlock($type)
    {
        $this->checkTable('site_blocks');
        $q = mysql_query('SELECT `properties` FROM `site_blocks` WHERE `type`="' . $this->escape($type) . '"');
        if ($q && mysql_num_rows($q)) {
            return mysql_result($q, 0);
        }
        return false;
    }

    public function getSiteConfig()
    {
        $q = mysql_query('SELECT * FROM `site_config`');
        if (!$q) {
            return array(false, mysql_error());
        }
        $conf = array();
        while ($r = mysql_fetch_assoc($q)) {
            $r['value'] = str_replace(array('\\"', '\\\\', "\\'"), array('"', '\\', "'"), $r['value']);
            $conf[$r['key']] = $r['value'];
        }
        return array(true, $conf);
    }

    public static function getSiteConfigStatic()
    {
        $q = mysql_query('SELECT * FROM `site_config`');
        if (!$q) {
            return array(false, mysql_error());
        }
        $conf = array();
        while ($r = mysql_fetch_assoc($q)) {
            $r['value'] = str_replace(array('\\"', '\\\\', "\\'"), array('"', '\\', "'"), $r['value']);
            $conf[$r['key']] = $r['value'];
        }
        return array(true, $conf);
    }

    public function getSiteConfigMultipleLanguages($name)
    {
        // если есть переменная для текущего языка
        $q = mysql_query("SELECT `value` FROM `site_config` WHERE `key` = '" . $this->escape($name) . "_" . @$_SESSION['active_lang'] . "' LIMIT 1");
        if (mysql_num_rows($q)) {
            return mysql_result($q, 0);
        } else {
            // иначе ищем переменную для всех языков
            $q = mysql_query("SELECT `value` FROM `site_config` WHERE `key` = '" . $this->escape($name) . "' LIMIT 1");
            if (mysql_num_rows($q)) {
                return mysql_result($q, 0);
            }
        }
        return false;
    }

    public function saveSiteConfig($params)
    {
        foreach ($params as $k => $v) {
            if ($v !== '') {
                $existParamQ = mysql_query('SELECT COUNT(*) FROM `site_config` WHERE `key`="' . $this->escape($k) . '"');
                $exists = mysql_result($existParamQ, 0);
                if ($exists) {
                    $r = mysql_query('UPDATE `site_config` SET `value`="' . $this->escape($v) . '" WHERE `key`="' . $this->escape($k) . '"');
                } else {
                    $r = mysql_query('INSERT INTO `site_config` SET `value`="' . $this->escape($v) . '", `key`="' . $this->escape($k) . '"');
                }
            } else {
                $r = mysql_query('DELETE FROM `site_config` WHERE `key`="' . $this->escape($k) . '"');
            }
        }
        if (!@$params['friendly_urls']) {
            $r = mysql_query('DELETE FROM `site_config` WHERE `key`="friendly_urls"');
        }

        return $r;
    }

    public function getCategoryIdByAlias($alias)
    {
        $this->checkTable('site_categories');
        $r = mysql_query('SELECT `category_id` FROM `site_categories` WHERE `alias`="' . $this->escape($alias) . '"');
        if ($r && mysql_num_rows($r)) {
            return mysql_result($r, 0);
        } else {
            return '';
        }
    }

    private function _addKey($key)
    {
        $key = $this->escape($key);
        $q = mysql_query("SELECT `id` FROM `site_translation_keys` WHERE `name`='$key'");

        if ($q && mysql_num_rows($q))
            return mysql_result($q, 0);

        mysql_query("INSERT INTO `site_translation_keys` SET `name`='$key'");
        return mysql_insert_id();
    }

    private function _addTranslation($keyid, $lang, $trans)
    {
        if (!$trans)
            return array(true);

        $lang = $this->escape($lang);
        $q = mysql_query("SELECT `id` FROM `site_langs` WHERE `lang_code`='$lang'");
        if (!mysql_num_rows($q))
            return array(false, 'РЇР·С‹Рє РЅРµ Р±С‹Р» РЅР°Р№РґРµРЅ');

        $langid = mysql_result($q, 0);
        $trans = $this->escape($trans);

        mysql_query("DELETE FROM `site_translations` WHERE `langid`='$langid' AND `key`='$keyid'");
        mysql_query("INSERT INTO `site_translations` SET `langid`='$langid', `key`='$keyid', `translation`='$trans'");
        return array(true);
    }

    public function _getLangCodeId($lang)
    {
        $lang = $this->escape($lang);
        $q = mysql_query("SELECT `id` FROM `site_langs` WHERE `lang_code`='$lang'");
        if (! mysql_num_rows($q))
            return false;

        return mysql_result($q, 0);
    }

    public function getLangDescrByCode($code)
    {
        $lang = $this->escape($code);
        $q = $this->query("SELECT `lang_name` FROM `site_langs` WHERE `lang_code`='$code'", array('site_langs'));
        if (!mysql_num_rows($q))
            return false;

        return mysql_result($q, 0);
    }

    public function GetDelivery()
    {
        $delivery = array();
        $id = isset($_GET['id']) ? (int)$_GET['id'] : NULL;
        $sql = 'SELECT * FROM `delivery` WHERE (1=1)';
        if ($id)
            $sql .= " AND id=$id";
        $query = mysql_query($sql);
        while ($row = mysql_fetch_assoc($query)) {
            $delivery[] = $row;
        }
        return $delivery;
    }

    public function AddOrUpdateDelivery()
    {
        $id = isset($_POST['id']) ? (int)$_POST['id'] : NULL;
        $formula = isset($_POST['formula']) ? trim($_POST['formula']) : '';
        $name = trim($_POST['kind_of_delivery']);

        if (!$id) {
            return mysql_query("INSERT INTO `delivery` (`name`, `formula`) VALUES('$name', '$formula')");
        } else {
            return mysql_query("UPDATE `delivery` SET `name`='$name', `formula`='$formula' WHERE id=$id");
        }
    }

    public function AddOrUpdateCountry()
    {
        $id = isset($_POST['id']) ? (int)$_POST['id'] : NULL;
        $name = trim($_POST['name']);

        if (!$id) {
            return mysql_query("INSERT INTO `countries` (`name`) VALUES('$name')");
        } else {
            return mysql_query("UPDATE `countries` SET `name`='$name' WHERE id=$id");
        }
    }

    public function GetCountries()
    {
        $countries = array();
        $id = isset($_GET['id']) ? (int)$_GET['id'] : NULL;
        $sql = 'SELECT * FROM `countries` WHERE (1=1)';
        if ($id)
            $sql .= " AND id=$id";
        $query = mysql_query($sql);
        while ($row = mysql_fetch_array($query)) {
            $countries[] = $row;
        }
        return $countries;
    }

    public function GetCountriesByDelivery()
    {
        $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
        $result = array();
        $sql = "SELECT `countries_for_delivery`.*, `countries`.name country_name FROM `countries_for_delivery`
                INNER JOIN `countries` ON (`countries_for_delivery`.country_id = `countries`.id)
                WHERE (1=1)";
        if ($id)
            $sql .= " AND delivery_id=$id";
        $query = mysql_query($sql);
        while ($row = mysql_fetch_assoc($query)) {
            $result[] = $row;
        }
        return $result;
    }

    public function SetCountriesByDelivery()
    {
        $delivery = isset($_POST['delivery']) ? (int)$_POST['delivery'] : 0;
        if (!$delivery)
            return false;
        $countries = $_POST['countries'];
        foreach ($countries as $country) {
            $country_id = $country['id'];
            $is_active = isset($country['is_active']) ? 1 : 0;
            $ret = mysql_query("INSERT INTO `countries_for_delivery` (`delivery_id`,`country_id`,`is_active`) VALUES ($delivery, $country_id, $is_active)
                                ON DUPLICATE KEY UPDATE is_active = $is_active");
        }
        return true;
    }

    public function DeleteRow($table, $id)
    {
        if ((empty($id)) || (empty ($table)))
            return false;
        else {
            return mysql_query("DELETE FROM `$table` WHERE id=$id");
        }
    }

    public function DeleteDelivery($delivery_id)
    {
        return mysql_query('DELETE FROM `countries_for_delivery` WHERE delivery_id=' . $delivery_id);
    }

    public function GetDataByCountryAndDelivery()
    {
        $country_id = isset($_GET['country_id']) ? (int)$_GET['country_id'] : 0;
        $delivery_id = isset($_GET['delivery_id']) ? (int)$_GET['delivery_id'] : 0;
        if ($country_id && $delivery_id) {
            $result = mysql_query("SELECT countries_for_delivery.*, countries.name country_name, delivery.name delivery_name, delivery.formula
                                    FROM `countries_for_delivery`
                                        INNER JOIN countries ON (countries_for_delivery.country_id = countries.id)
                                        INNER JOIN delivery ON (countries_for_delivery.delivery_id = delivery.id)
                                    WHERE `delivery_id`=$delivery_id AND `country_id`=$country_id");
            return mysql_fetch_array($result);
        } else
            return false;
    }

    public function UpdateParamsForDelivery()
    {
        $id = isset($_POST['id']) ? (int)$_POST['id'] : NULL;
        $step = isset($_POST['param_step']) ? (int)$_POST['param_step'] : 0;
        $start = isset($_POST['param_start']) ? (float)$_POST['param_start'] : 0;
        if ($id) {
            return mysql_query("UPDATE `countries_for_delivery` SET `param_step`=$step, `param_start`=$start WHERE id=$id");
        } else {
            return false;
        }
    }

    public function GetUserByLogin($login)
    {
        $login = $this->escape($login);
        $query = mysql_query("SELECT * FROM `site_referrals` WHERE `login`='$login'");
        return mysql_fetch_assoc($query);
    }

    public function GetUserById($id)
    {
        $id = (int)$id;
        $query = mysql_query("SELECT * FROM `site_referrals` WHERE `user_id`='$id'");
        return mysql_fetch_assoc($query);
    }

    public function GetReferralUsers($id=0)
    {
        $this->checkTable('site_orders');
        $result = array();
        $sql = 'SELECT *, (SELECT EXISTS( SELECT * from site_orders where site_orders.referral_id = site_referrals.id )) as in_system FROM `site_referrals`';
        $condition = array();
        if ($id)
        $condition[] = 'id=' . (int)$id;

        if ($condition)
            $sql .= ' WHERE ' . implode (' AND ', $condition);
        $query = mysql_query($sql);
        while ($row = mysql_fetch_assoc($query)) {
            $result[] = $row;
        }
        return $result;
    }

    public function ExistsOrderByUser($id)
    {
        $query = mysql_query('SELECT EXISTS( SELECT * from site_orders where site_orders.referral_id = ' . (int)$id . ' limit 1 )');
        $result = mysql_fetch_row($query);
        return $result[0];
    }

    public function GetReferralsInfo($array = array())
    {
        $result = array();
        $sql = '
            SELECT
                site_referrals.id AS idx, parent_id, login, email, `status`, comission, balance
            FROM
              site_referrals';
        if ($array)
            $sql .= ' WHERE id IN (' . implode(',', $array).')';
        $query = mysql_query($sql);
        while ($row = mysql_fetch_assoc($query)) {
            $result[] = $row;
        }
        return $result;
    }

    public function GetChildrenReferralsInfo($array = array())
    {
        $result = array();
        $sql = '
            SELECT
                site_referrals.id AS idx, parent_id, login, email, `status`, comission, balance
            FROM
              site_referrals';
        if ($array)
            $sql .= ' WHERE parent_id IN (' . implode(',', $array).')';
        $query = mysql_query($sql);
        while ($row = mysql_fetch_assoc($query)) {
            $result[] = $row;
        }
        return $result;
    }

    public function updateOrderForPresentByOrderId($id)
    {
        return mysql_query("UPDATE `site_orders` SET `send_present`=1 WHERE order_id=$id");
    }

    public function AddUser($user, $email, $parent_id)
    {
        $user_name = $this->escape($user['Login']);
        $user_id = trim($user['Id']);
        return mysql_query("INSERT INTO `site_referrals` (`parent_id`, `login`, `user_id`, `email`) VALUES($parent_id, '$user_name', '$user_id', '$email')");
    }

    public function UpdateReferral($user_id, $status, $comission, $balance)
    {
        return mysql_query("UPDATE `site_referrals` SET `status`=$status, `comission`=$comission, `balance`=$balance WHERE id=$user_id");
    }

    public function AddOrder($referral_id, $order_id, $purchase)
    {
        return mysql_query("INSERT INTO `site_orders` (`referral_id`, `order_id`, `purchase`) VALUES($referral_id, '$order_id', $purchase)");
    }

    public function getChildrenByStatuses($user_id)
    {
        $result = array();
        $query = mysql_query(
            'SELECT `status`, COUNT(`status`) AS cnt FROM `site_referrals`
                    WHERE parent_id = ' . $user_id . ' GROUP BY `status`;');
        while ($row = mysql_fetch_assoc($query)) {
            $result[$row['status']] = (int)$row['cnt'];
        }
        return $result;
    }

    public function getChildrenByParentId($parent_id)
    {
        $this->Check();
        $result = array();
        $query = mysql_query('
            SELECT r.*, sum(o.purchase) as purchase
            FROM `site_referrals` AS r
            LEFT JOIN site_orders AS o ON (r.id = o.referral_id)
            WHERE r.parent_id = ' . $parent_id . '
            GROUP BY r.id');
        while ($row = mysql_fetch_assoc($query)) {
            $result[] = $row;
        }
        return $result;
    }

    public function getReferralBalance($user_id)
    {
        $query = mysql_query('SELECT SUM(`purchase`) FROM `site_orders` WHERE `send_present`=1 AND `referral_id`=' . $user_id);
        return mysql_fetch_row($query);
    }

    public function updateOrderPurchase($order_id, $purchase)
    {
        return mysql_query("UPDATE `site_orders` SET `purchase`=$purchase, `send_present`=1 WHERE order_id=$order_id");
    }

    public function AddOrUpdateMyCategory()
    {
        $id = isset($_POST['id']) ? (int)$_POST['id'] : NULL;
        $pid = isset($_POST['pid']) ? (int)$_POST['pid'] : 0;
        $name = trim($_POST['name']);
        $description = trim($_POST['description']);
        if (!$id) {
            return mysql_query("INSERT INTO `my_categories` (`parent_id`,`name`,`description`) VALUES($pid, '$name', '" . $this->escape($description) . "');");
        } else {
            return mysql_query("UPDATE `my_categories` SET `name`='$name', `description`='" . $this->escape($description) . "' WHERE id=$id");
        }
    }

    public function GetCategoryById($id = 0)
    {
        $result = array();
        $sql = 'SELECT * FROM `my_categories` WHERE (1=1)';
        if ($id)
            $sql .= ' AND id=' . (int)$id;
        $query = mysql_query($sql);
        if ($query) {
            while ($row = mysql_fetch_assoc($query)) {
                $result[] = $row;
            }
        }
        return $result;
    }

    public function GetGoodsByCatId($cat_id)
    {
        $result = array();
        $sql = 'SELECT * FROM `my_goods`';
        $sql .= ' WHERE `my_category_id`=' . (int)$cat_id;
        $sql .= $this->_setWhere();
        $sql .= $this->_setLimit();
        $query = mysql_query($sql);
        while ($row = mysql_fetch_assoc($query)) {
            $result[] = $row;
        }
        return $result;
    }

    private function _setWhere()
    {
        $where = '';
        $cost_from = isset($_GET['cost']['from']) ? (int)$_GET['cost']['from'] : 0;
        $cost_to = isset($_GET['cost']['to']) ? (int)$_GET['cost']['to'] : 0;
        $where .= $cost_from ? ' AND `price`>' . $cost_from : '';
        $where .= $cost_to ? ' AND `price`<' . $cost_to : '';
        return $where;
    }

    private function _setLimit()
    {
        $limit = ' LIMIT ';
        $per_page = isset($_GET['per_page']) ? (int)$_GET['per_page'] : 16;
        $from = isset($_GET['from']) ? (int)$_GET['from'] : 0;
        $limit .= $from ? $from : '';
        $limit .= ' ' . $per_page;
        return $limit;
    }

    public function GetGoodsById($id)
    {
        $result = array();
        $query = mysql_query('SELECT * FROM `my_goods` WHERE `id`=' . (int)$id);
        while ($row = mysql_fetch_assoc($query)) {
            $result[] = $row;
        }

        return $result;
    }

    public function AddOrUpdateMyGoods()
    {
        $id = isset($_POST['id']) ? (int)$_POST['id'] : NULL;
        $cat = isset($_POST['cat']) ? (int)$_POST['cat'] : 0;
        $price = isset($_POST['price']) ? floatval($_POST['price']) : 0;
        $amount = isset($_POST['amount']) ? (int)$_POST['amount'] : 0;
        $image = isset($_POST['PictureUrl']) ? $_POST['PictureUrl'] : '';
        $name = trim($_POST['name']);
        $description = trim($_POST['description']);
        $properties = $this->_setAttributes();
        if (!$id) {
            return mysql_query("INSERT INTO `my_goods` (`my_category_id`,`name`,`description`,`image`,`price`,`amount`,`properties`) VALUES($cat, '$name', '" . $this->escape($description) . "', '$image', $price, $amount, '$properties');");
        } else {
            $sql = "UPDATE `my_goods` SET `name`='$name', `description`='" . $this->escape($description) . "', `price`=$price,`amount`=" . $amount . ",`properties`='" . $this->escape($properties) . "'";
            $sql .= $image ? ",`image`='$image'" : '';
            $sql .= ' WHERE id=' . $id;
            return mysql_query($sql);
        }
    }

    private function _setAttributes()
    {
        $result = array();
        if (isset($_POST['atr_name'])) {
            foreach ($_POST['atr_name'] as $key => $name) {
                $value = isset($_POST['atr_val'][$key]) ? $_POST['atr_val'][$key] : NULL;
                if ($name && !is_null($value))
                    $result[$name] = $value;
            }
        }
        return serialize($result);
    }


    ///Новые


    public function checkSiteUnavailablePageExists()
    {
        $this->checkTable('pages');
        $result = mysql_query('SELECT * FROM `pages` WHERE `alias`="site_unavailable"');
        $result = mysql_num_rows($result);
        //$page = $this->GetPageByAlias('site_unavailable');
        if($result==0){
            $pageId = $this->CreatePage(
                array(
                    'alias' => 'site_unavailable',
                    'title' => 'На сайте ведутся технические работы',
                    'lang'  => 'ru',
                    'pagetitle' => '',
                    'seo_keywords' => '',
                    'seo_description' => '',
                )
            );
            $pageInfo = $this->GetFullPageById($pageId);
            $this->UpdateBlockByID($pageInfo['block_id'],
                '<p>На сайте ведутся технические работы. Приносим извинения за временные неудобства</p>');

            $pageId = $this->CreatePage(
                array(
                    'alias' => 'site_unavailable',
                    'title' => 'On site maintenance work',
                    'lang'  => Session::getActiveLang(),
                    'pagetitle' => '',
                    'seo_keywords' => '',
                    'seo_description' => '',
                )
            );
            $pageInfo = $this->GetFullPageById($pageId);
            $this->UpdateBlockByID($pageInfo['block_id'],
                '<p>On site maintenance work. We apologize for any inconvenience</p>');
        }
    }

    public function sendReferralMessage($subject, $message, $direction, $parent, $userId)
    {
        $this->checkTable('site_referrals_messages');
        $added = time();
        $subject = $this->escape($subject);
        $message = $this->escape($message);
        $direction = $this->escape($direction);
        $parent = (int)$parent;
        $userId = $this->escape($userId);
        $result = mysql_query("
            INSERT INTO `site_referrals_messages`
            SET
              `subject` = '$subject'
              , `message` = '$message'
              , `direction` = '$direction'
              , `parent` = '$parent'
              , `login` = '$userId'
              , `added` = $added
        ");
        if(!$result)
            throw new DBException(mysql_error(), mysql_errno());
    }

    public function getCategoryAlias($cid, $forceCreate = false, $cName = '')
    {
        $seoCatRepository = new SeoCategoryRepository($this);
        return $seoCatRepository->getCategoryAlias($cid, $forceCreate, $cName);
    }

    public static function removeNotAvailableMenuItems($data)
    {
        $data = (array)$data;
        $preDefinedMenu = array(
            array('name' => 'ProductComments', 'value' => 'reviews'),
            array('name' => 'Digest', 'value' => 'digest'),
            array('name' => 'FleaMarket', 'value' => 'pristroy'),
            array('name' => 'ShopComments', 'value' => 'shopreviews')
        );
        foreach ($preDefinedMenu as $item) {
            if(! CMS::IsFeatureEnabled($item['name'])) {
                $key = array_search($item['value'], $data);
                if ($key) {
                    unset($data[$key]);
                }
            }
        }
        return $data;
    }
}
