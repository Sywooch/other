<?

/**
 * CMS
 */

class CMS
{

    private $link;

    public function CreateOrder($secret, $orderid, $vendorid, $tradeid)
    {
        $this->checkTable('site_taobao_orders');
        $secret = mysql_real_escape_string($secret);
        $orderid = mysql_real_escape_string($orderid);
        $vendorid = mysql_real_escape_string($vendorid);
        $tradeid = mysql_real_escape_string($tradeid);
        $result = mysql_query("
            INSERT INTO `site_taobao_orders`
            SET
              `secret` = '$secret'
              , `orderid` = '$orderid'
              , `vendorid` = '$vendorid'
              , `tradeid` = '$tradeid'
        ");
        if (!$result) return array(false, 'Ошибка при создании заказа');
        $id = mysql_insert_id();
        return array(true, $id);
    }

    static public function IsFeatureEnabled($feature)
    {
        return in_array($feature, General::$enabledFeatures);
    }

    //
    public function sendEmail($email, $subject, $body)
    {
        if(!$email) return true;
        try {
            require_once dirname(dirname(__FILE__)) . '/lib/phpmailer/class.phpmailer.php';
            $mail = new PHPMailer;
            $mail->Subject = $subject;
            $mail->From = 'noreply@' . preg_replace('/^www\./', '', $_SERVER['HTTP_HOST']);
            $mail->FromName = CFG_SITE_NAME;
            $mail->IsHTML(true);
            $mail->CharSet = 'utf-8';
            /*SMTP if need*/
            $settings = $this->getSiteConfig();
            if ($settings[0]) $settings = $settings[1];
            if ($settings['smtp']==1) {
                $mail->IsSMTP();
                $mail->SMTPAuth = true; // enable SMTP authentication
                if (isset($settings['smtp_ssl']) && $settings['smtp_ssl'])
                    $mail->SMTPSecure = "tls"; // sets the prefix to the servier
                $mail->Host = $settings['smtp_host']; // sets GMAIL as the SMTP server
                $mail->Port = $settings['smtp_port']; // set the SMTP port

                $mail->Username = $settings['smtp_user']; // GMAIL username
                $mail->Password = $settings['smtp_password']; // GMAIL password

            }
            $block = new RegisterEmail();
            $mail->Body = $body;

            $mail->AddAddress($email);
            $mail->Send();
			return true;
        } catch (phpmailerException $e) {
            //print $e->getMessage();
			return false;
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
            WHERE `p`.`alias` = "' . mysql_real_escape_string($alias) . '" AND (`l`.`lang_code`="' . $_SESSION['active_lang'] . '"  OR `l`.`lang_code` IS NULL)
            ORDER BY `l`.`lang_code` DESC
            '
        );
        $page = false;
        if ($r) if ($row = mysql_fetch_assoc($r)) {
            $page = $row;
            $r = mysql_query("
                SELECT * FROM `site_pages_langs_data`
                WHERE `p`='" . mysql_real_escape_string($page['alias']) . "'
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

    public function GetPagesByLang($lang)
    {
        $this->checkTable('site_pages_langs');

        $r = mysql_query(
            '
            SELECT DISTINCT `p`.* FROM `pages` `p`
            LEFT JOIN `site_pages_langs` `pl`
                ON `p`.`id`=`pl`.`page_id`
            LEFT JOIN `site_langs` `l`
                ON `pl`.`lang_id` = `l`.`id`
            WHERE `l`.`lang_code`="' . mysql_real_escape_string($lang) . '"
            '
        );
        $pages = array();
        while ($p = mysql_fetch_assoc($r)) {
            $pages[] = $p;
        }
        return $pages;
    }

    public function getItemComments($itemid)
    {
        if (!self::IsFeatureEnabled('ProductComments')) return array();
        if (!is_numeric($itemid)) return array();
        $this->checkTable('reviews');
        $res = mysql_query('SELECT * FROM `reviews` WHERE `item_id`="' . $itemid . '"');
        $comments = array();
        while ($row = mysql_fetch_assoc($res)) {
            $comments[] = $row;
        }
        return $comments;
    }

    public function getNumberOfComments()
    {
        if (!self::IsFeatureEnabled('ProductComments')) return 0;
        $this->checkTable('reviews');
        $res = mysql_query('SELECT count(review_id) as COUNT FROM `reviews` WHERE `accepted`=0');
        $result = 0;
        if ($row = mysql_fetch_assoc($res))
            $result = $row['COUNT'];
        return $result;
    }

    public function getNotAcceptedComments($from = 0, $perpage = 16)
    {
        if (!self::IsFeatureEnabled('ProductComments')) return array();
        $this->checkTable('reviews');
        $res = mysql_query('SELECT * FROM `reviews` WHERE `accepted`=0 order by created desc limit ' . $from . ',' . $perpage);
        $comments = array();
        while ($row = mysql_fetch_assoc($res)) {
            $comments[] = $row;
        }
        return $comments;
    }

    public function saveComment($data, $name, $id)
    {
        if (!self::IsFeatureEnabled('ProductComments')) return false;
        if (!is_numeric($id)) return false;
        $text = mysql_real_escape_string($data['review']['text']);
        mysql_query('INSERT INTO `reviews` SET `name`="' . $name . '", `item_id`="' . $id . '",`category_id`="' . $data['review']['item_cid'] . '", `text`="' . $text . '", `created`=NOW()');
    }

    public function acceptComment($id)
    {
        if (!self::IsFeatureEnabled('ProductComments')) return false;
        if (!is_int($id)) return false;
        mysql_query('update `reviews` SET accepted=1 WHERE `review_id`="' . $id . '"');
    }

    public function deleteComment($id)
    {
        if (!self::IsFeatureEnabled('ProductComments')) return false;
        if (!is_int($id)) return false;
        mysql_query('DELETE FROM `reviews` WHERE `review_id`="' . $id . '"');
    }

    public static function GetQuittanceMethod()
    {
        if ($_SESSION['active_lang'] !== 'ru') return array();
        if (!self::IsFeatureEnabled('SberbankInvoice')) return array();
        if (!isset ($_SESSION[CFG_SITE_NAME . 'loginUserData']['currencycode']) || $_SESSION[CFG_SITE_NAME . 'loginUserData']['currencycode'] != 'RUB') return array();
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
            ' VALUES("' . $subscribe . '","' . $email . '","' .
            $name . '","' .
            date('Y.m.d') . '") ON DUPLICATE KEY UPDATE' .
            ' name="' . $name . '"');
        return $res;
    }

    public function GetFullPageById($id)
    {
        $r = mysql_query('SELECT * FROM `pages` WHERE `id` = "' . $id . '"');
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
    public function GetBlockByID($id)
    {
        //
        $text = '';

        return $text;
    }

    //
    public function GetBlocksByPageID($id)
    {
        $r = mysql_query('SELECT * FROM `blocks` WHERE `page_id` = "' . $id . '"');
        $block = array();
        if ($r && mysql_num_rows($r) > 0) {
            while ($row = mysql_fetch_assoc($r)) {
                $block[] = $row;
            }
        } else {
            // РЎРѕР·РґР°РµРј С‚Р°Р±Р»РёС†Сѓ Рё Р±Р»РѕРє
            mysql_query("CREATE TABLE IF NOT EXISTS `blocks` (  `id` int(11) NOT NULL auto_increment,  `page_id` int(11) NOT NULL,  `position` int(11) NOT NULL default '0',  `text` longtext NOT NULL,  PRIMARY KEY  (`id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8");
            mysql_query("INSERT INTO `blocks` (`page_id`, `text` ) VALUES ('" . $id . "', '...');");
            $block = -1;
        }
        return $block;
    }

    public function UpdatePageByID($id, $data)
    {
        $langid = $this->_getLangCodeId($data['lang']);
        $this->checkTable('site_pages_langs');
        $this->checkTable('site_pages_langs_data');

        mysql_query('UPDATE `pages` SET `alias` = "' . $data['alias'] . '", `title`= "' . mysql_real_escape_string($data['title']) . '" WHERE `id` = "' . $id . '"');

        $r = mysql_query('SELECT COUNT(*) FROM site_pages_langs WHERE `lang_id`="' . $langid . '" AND `page_id`="' . $id . '"');
        $c = mysql_result($r, 0);
        if ($c) {
            mysql_query('UPDATE `site_pages_langs` SET `lang_id` = "' . $langid . '" WHERE `page_id` = "' . $id . '"');
        } else {
            mysql_query('INSERT INTO `site_pages_langs` (`lang_id`, `page_id` ) VALUES ( "' . $langid . '", "' . $id . '" )');
        }

        $r = mysql_query('DELETE FROM site_pages_langs_data WHERE `lang_id`="' . $langid . '" AND `p`="' . $data['alias'] . '"');
        mysql_query('INSERT INTO `site_pages_langs_data` (`lang_id`, `p`, `pagetitle`, `seo_keywords`, `seo_description`, `type` ) VALUES ( "' . $langid . '", "' . $data['alias'] . '", "' . mysql_real_escape_string($data['pagetitle']) . '", "' . mysql_real_escape_string($data['seo_keywords']) . '", "' . mysql_real_escape_string($data['seo_description']) . '", "content" )');
    }

    public function setCategorySEO($data)
    {
        $r = mysql_query('DELETE FROM site_pages_langs_data WHERE `p`="' . $data['cid'] . '"');
        $q = 'INSERT INTO `site_pages_langs_data` (`p`, `seo_title`, `pagetitle`, `seo_keywords`, `seo_description`, `type` ) VALUES ( "' . $data['cid'] . '", "' . mysql_real_escape_string($data['seo_title']) . '", "' . mysql_real_escape_string($data['meta_title']) . '", "' . mysql_real_escape_string($data['meta_keywords']) . '", "' . mysql_real_escape_string($data['meta_description']) . '", "category" )';
        mysql_query($q);
    }

    public function getCategorySEO($cid)
    {
        $q = 'SELECT * FROM `site_pages_langs_data` WHERE `p`="' . $cid . '"';
        $r = mysql_query($q);
        return @mysql_fetch_assoc($r);
    }

    public function UpdateBlockByID($id, $text)
    {
        $r = mysql_query('UPDATE `blocks` SET `text` = "' . mysql_real_escape_string($text) . '" WHERE `id` = "' . $id . '"');
    }

    public function add_site_pages_parents($page_id, $parent_id)
    {
        $this->checkTable('site_pages_parents');
        mysql_query('INSERT INTO `site_pages_parents` SET `page_id` = "' . $page_id . '", '
            . ' `parent_id` = "' . $parent_id . '"');
        return mysql_insert_id();
    }

    public function del_site_pages_parents_page_id($page_id)
    {
        $this->checkTable('site_pages_parents');
        mysql_query('DELETE FROM `site_pages_parents` WHERE `page_id`= "' . $page_id . '"');
        return mysql_affected_rows();
    }

    public function get_parent_id_site_pages_parents_page_id($page_id)
    {
        $this->checkTable('site_pages_parents');
        $sql = 'SELECT `parent_id` FROM `site_pages_parents` WHERE `page_id` = "' . $page_id . '"';
        $query = mysql_query($sql);
        if (mysql_num_rows($query)) {
            return mysql_result($query, 0);
        }
        return false;
    }

    public function DeletePageByID($id)
    {
        $this->checkTable('site_pages_parents');
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
        $r = mysql_query('DELETE FROM `site_pages_langs_data` WHERE `p` = "' . $alias . '"');

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

        mysql_query('INSERT INTO `pages` (`alias`, `title` ) VALUES ( "' . $data['alias'] . '", "' . mysql_real_escape_string($data['title']) . '" )');
        $pid = mysql_insert_id();
        $sql = 'INSERT INTO `site_pages_langs` (`lang_id`, `page_id` ) VALUES ( "' . $langid . '", "' . $pid . '" )';
        mysql_query($sql);
        $sql = 'INSERT INTO `site_pages_langs_data` (`lang_id`, `p`, `pagetitle`, `seo_keywords`, `seo_description`, `type` ) VALUES ( "' . $langid . '", "' . $data['alias'] . '", "' . mysql_real_escape_string(@$data['pagetitle']) . '", "' . mysql_real_escape_string($data['seo_keywords']) . '", "' . mysql_real_escape_string($data['seo_description']) . '", "content" )';
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
            WHERE `p`.`id` = "' . $id . '"
            '
        );

        $page = false;
        if ($r) if ($row = mysql_fetch_assoc($r)) {
            $page = $row;
            $page['title'] = str_replace(array("\'", '\"', '\\\\'), array("'", '"', '\\'), $page['title']);
            $r = mysql_query("
                SELECT * FROM `site_pages_langs_data`
                WHERE `p`='" . mysql_real_escape_string($page['alias']) . "'
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
            SELECT DISTINCT `p`.*, `l`.`lang_name`
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
            // РЎРѕР·РґР°РµРј С‚Р°Р±Р»РёС†Сѓ Рё Р·Р°Р±РёРІР°РµРј РґРµРјРѕР№
            mysql_query("CREATE TABLE IF NOT EXISTS `pages` (   `id` int(11) NOT NULL auto_increment,   `alias` varchar(255) NOT NULL,   `title` text NOT NULL,   PRIMARY KEY  (`id`) ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;");

            $this->checkTable('site_langs');
            $this->checkTable('site_pages_langs');
            $this->checkLanguage('ru', 'Russian (Р СѓСЃСЃРєРёР№)');
            $this->checkLanguage('en', 'English (English)');

            $this->createPaymentPages();

            $pages = -1;
        }
        return $pages;
    }

    public function CreateNews($data)
    {
        $langid = $this->_getLangCodeId($data['lang']);
        $this->checkTable('site_news_langs');

        mysql_query('INSERT INTO `news` (`title`, `brief`, `image` ) VALUES ( "' . mysql_real_escape_string($data['title']) . '", "' . mysql_real_escape_string($data['brief']) . '", "' . $data['image'] . '" )');
        $pid = mysql_insert_id();
        mysql_query('INSERT INTO `site_news_langs` (`lang_id`, `news_id` ) VALUES ( "' . $langid . '", "' . $pid . '" )');

        return $pid;
    }

    public function UpdateNewsByID($id, $data)
    {
        $langid = $this->_getLangCodeId($data['lang']);
        $this->checkTable('site_news_langs');

        mysql_query('UPDATE `news` SET `title`= "' . mysql_real_escape_string($data['title']) . '", `brief`= "' . mysql_real_escape_string($data['brief']) . '", `image` = "' . $data['image'] . '" WHERE `id` = "' . $id . '"');

        $r = mysql_query('SELECT COUNT(*) FROM site_news_langs WHERE `lang_id`="' . $langid . '" AND `news_id`="' . $id . '"');
        $c = mysql_result($r, 0);
        if ($c) {
            mysql_query('UPDATE `site_news_langs` SET `lang_id` = "' . $langid . '" WHERE `news_id` = "' . $id . '"');
        } else {
            mysql_query('INSERT INTO `site_news_langs` (`lang_id`, `news_id` ) VALUES ( "' . $langid . '", "' . $id . '" )');
        }
    }

    function UpdateNewsText($id, $text)
    {
        mysql_query('UPDATE `news` SET `text`= "' . mysql_real_escape_string($text) . '" WHERE `id` = "' . $id . '"');
    }

    public function DeleteNewsByID($id)
    {
        $r = mysql_query('DELETE FROM `news` WHERE `id` = "' . $id . '"');

        $this->checkTable('site_news_langs');
        $r = mysql_query('DELETE FROM `site_news_langs` WHERE `news_id` = "' . $id . '"');
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
            WHERE `p`.`id` = "' . $id . '"
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
            SELECT DISTINCT `p`.*, `l`.`lang_name`
            FROM `news` `p`
            LEFT JOIN `site_news_langs` `pl`
                ON `p`.`id`=`pl`.`news_id`
            LEFT JOIN `site_langs` `l`
						ON `pl`.`lang_id` = `l`.`id`
						ORDER BY `p`.`created` DESC
            ');
        $news = array();
        if ($r && @mysql_num_rows($r)) {
            while ($row = mysql_fetch_assoc($r)) {
                $news[] = $row;
            }
        } else
            $news = -1;
        return $news;
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
        //
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
        //
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
        $lang_name = mysql_real_escape_string($lang_name);
        $lang_descr = mysql_real_escape_string($lang_descr);
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
            $lang_code = mysql_real_escape_string($lang_code);
            $where[] = '`l`.`lang_code` = "' . $lang_code . '"';
        }
        if ($key) {
            $key = mysql_real_escape_string($key);
            $where[] = '`k`.`name` = "' . $key . '"';
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
        $lang_code = mysql_real_escape_string($_SESSION['active_lang']);
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

    public function checkTable($tbl)
    {
        $result = mysql_query("SHOW TABLES LIKE '$tbl'");
        if ($result) {
            $tableExists = mysql_num_rows($result) > 0;
        } else {
            $tableExists = false;
        }

        if (!$tableExists) {
            $f = dirname(dirname(__FILE__)) . '/admin/sql/' . $tbl . '.sql';
            $fileExists = file_exists($f);
            $tableExists = $fileExists ? mysql_query(file_get_contents($f)) : false;
        }

        return $tableExists;
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
        $q = mysql_query('SELECT `properties` FROM `site_blocks` WHERE `type`="' . mysql_real_escape_string($type) . '"');
        if ($q && mysql_num_rows($q)) {
            return mysql_result($q, 0);
        }
        return false;
    }

    public function createTicket($uid, $orderid, $catid, $subject, $text)
    {
        $subject = mysql_real_escape_string($subject);
        $text = mysql_real_escape_string($text);
        $sql = "
            INSERT INTO `site_support`
            SET
                `subject` = '$subject',
                `orderid` = '$orderid',
                `categoryid` = '$catid',
                `message` = '$text',
                `parent` = 0,
                `userid` = $uid,
                `direction` = 'In',
                `read` = 0,
                `added` = '" . time() . "'
        ";
        $res = mysql_query($sql);
        return $res;
    }

    public function getTicketInfoList($uid, $arFilter = array())
    {
        $where = array();
        if (array_key_exists('ticket_pub_order_number', $arFilter) && !empty($arFilter['ticket_pub_order_number']))
            $where[] = "`orderid` like '%" . $arFilter['ticket_pub_order_number'] . "%'";
        if (array_key_exists('ticket_pub_date_from', $arFilter) && !empty($arFilter['ticket_pub_date_from']))
            $where[] = "`added`>" . strtotime($arFilter['ticket_pub_date_from']);
        if (array_key_exists('ticket_pub_date_to', $arFilter) && !empty($arFilter['ticket_pub_date_to']))
            $where[] = "`added`<" . strtotime($arFilter['ticket_pub_date_to']);
        if (array_key_exists('ticket_pub_new', $arFilter) && !empty($arFilter['ticket_pub_new'])) {
            $where[] = "`direction`='Out' AND `read`=0 AND `parent` in (SELECT id FROM `site_support` WHERE `userid`='$uid')";
            if (!empty($where))
                $whereUser = implode(' AND ', $where);
            else
                $whereUser = '';

            $userTicketsQ = "
            SELECT * FROM `site_support`
            WHERE id in (SELECT distinct parent FROM `site_support` WHERE $whereUser)
            ORDER BY `added` DESC
            ";
        } else {
            $where[] = "`userid`='$uid' AND `parent`=0";
            if (!empty($where))
                $whereUser = implode(' AND ', $where);
            else
                $whereUser = '';

            $userTicketsQ = "
            SELECT * FROM `site_support`
            WHERE $whereUser
            ORDER BY `added` DESC
            ";
        }

        $result = mysql_query($userTicketsQ, $this->link);
        $tickets = array();
        if (!$result)
            return $tickets;

        while ($t = mysql_fetch_assoc($result)) {
            $tickets[] = array(
                'ticketid' => 'Ticket-' . $t['id'],
                'createddate' => date('Y-m-d H:i', $t['added']),
                'msgcount' => $this->getTicketMessagesCount($t['id']) + 1,
                'OrderId' => $t['orderid'],
                'CategoryId' => $t['categoryid'],
                'Subject' => $t['subject'],
                'newmsgcount' => $this->getTicketMessagesCount($t['id'], 'Out', 0)
            );
        }

        return $tickets;
    }

    public function getTicketDetails($uid, $ticketId)
    {
        $this->Check();
        $ticketQ = "
            SELECT * FROM `site_support`
            WHERE `id`=$ticketId AND `userid`=$uid
            ORDER BY `added` DESC
            ";
        $result = mysql_query($ticketQ);

        if (!$result || !mysql_num_rows($result))
            return false;

        $ticket = mysql_fetch_array($result);
        return array(
            'Subject' => $ticket['subject'],
            'TicketId' => 'Ticket-' . $ticket['id'],
            'OrderId' => $ticket['orderid'],
            'CreatedDate' => date('Y-m-d H:i', $ticket['added'])
        );
    }

    public function getTicketMessageList($uid, $ticketId, $markAsRead = true)
    {
        $userId = $this->_getUserIdByTicketId($ticketId);
        if ($uid != $userId) return false;

        $ticketsQ = "
            SELECT * FROM `site_support`
            WHERE `id`=$ticketId OR `parent`=$ticketId
            ORDER BY `added` ASC
            ";
        $ticketsR = mysql_query($ticketsQ);
        if (!$ticketsR) return false;
        $messages = array();
        while ($t = mysql_fetch_assoc($ticketsR)) {
            $messages[] = array(
                'CreatedDate' => date('Y-m-d H:i', $t['added']),
                'Direction' => $t['direction'],
                'Text' => $t['message']
            );
        }

        return $messages;
    }

    public function createTicketMessage($uid, $ticketId, $message, $isAdmin)
    {
        $dir = $isAdmin ? 'Out' : 'In';
        $userId = $this->_getUserIdByTicketId($ticketId);
        if ($uid != $userId && !$isAdmin)
            return array(false, Lang::get('not_current_user_chat'));

        $message = mysql_real_escape_string($message);

        $res = mysql_query("
            INSERT INTO `site_support`
            SET
                `userid` = $uid,
                `message` = '$message',
                `direction` = '$dir',
                `orderid` = '',
                `subject` = '',
                `categoryid` = '',
                `parent` = $ticketId,
                `added` = " . time() . ",
                `read` = 0
            ");
        return array($res, mysql_error());
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
        $q = mysql_query("SELECT `value` FROM `site_config` WHERE `key` = '" . $name . "_" . @$_SESSION['active_lang'] . "' LIMIT 1");
        if (mysql_num_rows($q)) {
            return mysql_result($q, 0);
        } else {
            // иначе ищем переменную для всех языков
            $q = mysql_query("SELECT `value` FROM `site_config` WHERE `key` = '" . $name . "' LIMIT 1");
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
                $existParamQ = mysql_query('SELECT COUNT(*) FROM `site_config` WHERE `key`="' . mysql_real_escape_string($k) . '"');
                $exists = mysql_result($existParamQ, 0);
                if ($exists) {
                    $r = mysql_query('UPDATE `site_config` SET `value`="' . mysql_real_escape_string($v) . '" WHERE `key`="' . mysql_real_escape_string($k) . '"');
                } else {
                    $r = mysql_query('INSERT INTO `site_config` SET `value`="' . mysql_real_escape_string($v) . '", `key`="' . mysql_real_escape_string($k) . '"');
                }
            } else {
                $r = mysql_query('DELETE FROM `site_config` WHERE `key`="' . mysql_real_escape_string($k) . '"');
            }
        }
        if (!@$params['friendly_urls']) {
            $r = mysql_query('DELETE FROM `site_config` WHERE `key`="friendly_urls"');
        }

        return $r;
    }

    private function _getUserIdByTicketId($ticketId)
    {
        $userQ = "SELECT `userid` FROM `site_support` WHERE `id`=$ticketId";
        $userR = mysql_query($userQ);
        if (!$userR) return false;
        $userId = mysql_result($userR, 0);
        return $userId;
    }

    public function getTicketMessagesCount($ticketId = false, $direction = false, $read = false, $uid = false)
    {
        $where = array();
        $whereString = '';
        if ($read !== false) $where[] = '`read`=' . $read;
        if ($direction !== false) $where[] = "`direction`='$direction'";
        if ($uid === false) {
            if ($ticketId !== false) $where[] = '`parent`=' . $ticketId;
        } else {
            $where[] = '`parent` in (select `id` from `site_support` where parent=0 && `userid`=' . $uid . ')';
        }
        if (!empty($where))
            $whereString = 'WHERE ' . implode(' AND ', $where);
        $sql = "
				SELECT COUNT(*)
				FROM `site_support`
				$whereString
				";

        $result = mysql_query($sql);
        if ($result)
            return mysql_result($result, 0);
        else
            return -1;
    }

    public function getCategoryIdByAlias($alias)
    {
        $this->checkTable('site_categories');
        $r = mysql_query('SELECT `category_id` FROM `site_categories` WHERE `alias`="' . mysql_real_escape_string($alias) . '"');
        if ($r && mysql_num_rows($r)) {
            return mysql_result($r, 0);
        } else {
            return '';
        }
    }

    public function getCategoryAlias($cid, $forceCreate = false, $cname = '')
    {
        $this->checkTable('site_categories');
        $r = mysql_query('SELECT `alias` FROM `site_categories` WHERE `category_id`="' . mysql_real_escape_string($cid) . '"');
        if ($r && mysql_num_rows($r)) {
            $alias = mysql_result($r, 0);
            if (!$alias){
                $alias = $cid;
                if ($alias != 'undefined')
                    $this->setCategoryAlias($cid, $alias);
                return $alias;
            }
            return $alias;
        } elseif ($forceCreate) {
            $categoryName = strtolower($this->translit_ru($cname));
            $categoryName = $categoryName ? $categoryName.'-' : $categoryName;
            $alias =  $categoryName . $cid;
            if ($alias != 'undefined')
                $this->setCategoryAlias($cid, $alias);
            return $alias;
        } else {
            return '';
        }
    }

    public function setCategoryAlias($cid, $alias)
    {
        $this->checkTable('site_categories');
        $r = mysql_query('SELECT * FROM `site_categories` WHERE `category_id`="' . mysql_real_escape_string($cid) . '"');
        if ($r && mysql_num_rows($r)) {
            mysql_query('UPDATE `site_categories` SET `alias`="' . mysql_real_escape_string($alias) . '" WHERE `category_id`="' . mysql_real_escape_string($cid) . '"');
        } else {
            mysql_query('INSERT INTO `site_categories` SET `category_id`="' . mysql_real_escape_string($cid) . '", `alias`="' . mysql_real_escape_string($alias) . '"');
        }
    }

    private function translit_ru($string)
    {
        $converter = array(
            'а' => 'a',   'б' => 'b',   'в' => 'v',
            'г' => 'g',   'д' => 'd',   'е' => 'e',
            'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
            'и' => 'i',   'й' => 'y',   'к' => 'k',
            'л' => 'l',   'м' => 'm',   'н' => 'n',
            'о' => 'o',   'п' => 'p',   'р' => 'r',
            'с' => 's',   'т' => 't',   'у' => 'u',
            'ф' => 'f',   'х' => 'h',   'ц' => 'c',
            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
            'ь' => "",  'ы' => 'y',   'ъ' => "",
            'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

            'А' => 'A',   'Б' => 'B',   'В' => 'V',
            'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
            'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
            'И' => 'I',   'Й' => 'Y',   'К' => 'K',
            'Л' => 'L',   'М' => 'M',   'Н' => 'N',
            'О' => 'O',   'П' => 'P',   'Р' => 'R',
            'С' => 'S',   'Т' => 'T',   'У' => 'U',
            'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
            'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
            'Ь' => "",  'Ы' => 'Y',   'Ъ' => "'",
            'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
            '/' => '', '.' => '', ',' => '', ';' => '', ' ' => '', '\'' => ''
        );
        return strtr($string, $converter);
    }

    private function _addKey($key)
    {
        $key = mysql_real_escape_string($key);
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

        $lang = mysql_real_escape_string($lang);
        $q = mysql_query("SELECT `id` FROM `site_langs` WHERE `lang_code`='$lang'");
        if (!mysql_num_rows($q))
            return array(false, 'РЇР·С‹Рє РЅРµ Р±С‹Р» РЅР°Р№РґРµРЅ');

        $langid = mysql_result($q, 0);
        $trans = mysql_real_escape_string($trans);

        mysql_query("DELETE FROM `site_translations` WHERE `langid`='$langid' AND `key`='$keyid'");
        mysql_query("INSERT INTO `site_translations` SET `langid`='$langid', `key`='$keyid', `translation`='$trans'");
        return array(true);
    }

    private function _getLangCodeId($lang)
    {
        $lang = mysql_real_escape_string($lang);
        $q = mysql_query("SELECT `id` FROM `site_langs` WHERE `lang_code`='$lang'");
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
        $query = mysql_query("SELECT * FROM `site_referrals` WHERE `login`='$login'");
        return mysql_fetch_assoc($query);
    }

    public function GetUserById($id)
    {
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
        $user_name = mysql_real_escape_string($user['Login']);
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
            return mysql_query("INSERT INTO `my_categories` (`parent_id`,`name`,`description`) VALUES($pid, '$name', '" . mysql_real_escape_string($description) . "');");
        } else {
            return mysql_query("UPDATE `my_categories` SET `name`='$name', `description`='" . mysql_real_escape_string($description) . "' WHERE id=$id");
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
            return mysql_query("INSERT INTO `my_goods` (`my_category_id`,`name`,`description`,`image`,`price`,`amount`,`properties`) VALUES($cat, '$name', '" . mysql_real_escape_string($description) . "', '$image', $price, $amount, '$properties');");
        } else {
            $sql = "UPDATE `my_goods` SET `name`='$name', `description`='" . mysql_real_escape_string($description) . "', `price`=$price,`amount`=" . $amount . ",`properties`='" . mysql_real_escape_string($properties) . "'";
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
	public function CreatePost($data) {
        $langid = $this->_getLangCodeId($data['lang']);
        $this->checkTable('site_digest_langs');

        mysql_query('INSERT INTO `digest` (`title`, `category_id`, `image`, `content` ) VALUES ( "' . mysql_escape_string($data['title']) . '", "' . mysql_escape_string($data['category']) . '", "' . $data['image'] . '", "' . mysql_escape_string($data['content']) . '" )');
        $pid = mysql_insert_id();
        mysql_query('INSERT INTO `site_digest_langs` (`lang_id`, `post_id` ) VALUES ( "' . $langid . '", "' . $pid . '" )');

        return $pid;
    }

    public function UpdatePostByID($id, $data) {
        $langid = $this->_getLangCodeId($data['lang']);
        $this->checkTable('site_digest_langs');

        mysql_query('UPDATE `digest` SET `title`= "' . mysql_escape_string($data['title']) . '", `category_id`= "' . mysql_escape_string($data['category']) . '", `image` = "' . mysql_escape_string($data['image']) . '",`content` = "' . mysql_escape_string($data['content']) . '" WHERE `id` = "' . $id . '"');

        $r = mysql_query('SELECT COUNT(*) FROM site_digest_langs WHERE `lang_id`="' . $langid . '" AND `post_id`="' . $id . '"');
        $c = mysql_result($r, 0);
        if ($c) {
            mysql_query('UPDATE `site_digest_langs` SET `lang_id` = "' . $langid . '" WHERE `post_id` = "' . $id . '"');
        } else {
            mysql_query('INSERT INTO `site_digest_langs` (`lang_id`, `post_id` ) VALUES ( "' . $langid . '", "' . $id . '" )');
        }
    }

    public function DeletePostByID($id) {
        $r = mysql_query('DELETE FROM `digest` WHERE `id` = "' . $id . '"');

        $this->checkTable('site_digest_langs');
        $r = mysql_query('DELETE FROM `site_dgest_langs` WHERE `post_id` = "' . $id . '"');
    }

    public function GetPostByID($id) {
        $r = mysql_query(
                '
            SELECT `p`.*, `l`.`lang_code`, `l`.`id` as `lang_id` FROM `digest` `p`
            LEFT JOIN `site_digest_langs` `pl`
                ON `p`.`id`=`pl`.`post_id`
            LEFT JOIN `site_langs` `l`
                ON `pl`.`lang_id` = `l`.`id`
            WHERE `p`.`id` = "' . $id . '"
            '
        );
		
        $post = false;
        if ($r)
            if ($row = mysql_fetch_assoc($r)) {
                $post = $row;
                $post['title'] = str_replace(array("\'", '\"', '\\\\'), array("'", '"', '\\'), $post['title']);
                $post['category_id'] = str_replace(array("\'", '\"', '\\\\'), array("'", '"', '\\'), $post['category_id']);
                $post['image'] = str_replace(array("\'", '\"', '\\\\'), array("'", '"', '\\'), $post['image']);
                $post['content'] = str_replace(array("\'", '\"', '\\\\'), array("'", '"', '\\'), $post['content']);
            }
        return $post;
    }

    public function GetAllPosts() {
        $this->checkTable('digest');
        $this->checkTable('site_digest_langs');
				$r = mysql_query("SELECT DISTINCT `p` . * , `pl`.`lang_id`, `l`.`lang_name`, `c`.`title` as `cat_title`
					FROM `digest` `p`
					LEFT JOIN `site_digest_langs` `pl` ON `p`.`id` = `pl`.`post_id`
					LEFT JOIN `site_langs` `l` ON `pl`.`lang_id` = `l`.`id`
					LEFT JOIN `site_digest_categories` `c` ON `p`.`category_id` = `c`.`id`
					ORDER BY `p`.`created` DESC
					LIMIT 0 , 30");

        $posts = array();
        if ($r && @mysql_num_rows($r)) {
            while ($row = mysql_fetch_assoc($r)) {
                $posts[] = $row;
            }
        } else {
            $posts = -1;
        }
        return $posts;
    }

    public function GetPostsByCat($cid) {
        $this->checkTable('digest');
        $this->checkTable('site_digest_langs');
				$r = mysql_query('SELECT DISTINCT `p` . * , `pl`.`lang_id`, `l`.`lang_name`, `c`.`title` as `cat_title`
					FROM `digest` `p`
					LEFT JOIN `site_digest_langs` `pl` ON `p`.`id` = `pl`.`post_id`
					LEFT JOIN `site_langs` `l` ON `pl`.`lang_id` = `l`.`id`
					LEFT JOIN `site_digest_categories` `c` ON `p`.`category_id` = `c`.`id`
					WHERE `p`.`category_id` = "'.$cid.'"
					ORDER BY `p`.`created` DESC
					LIMIT 0 , 30');

        $posts = array();
        if ($r && @mysql_num_rows($r)) {
            while ($row = mysql_fetch_assoc($r)) {
                $posts[] = $row;
            }
        } else {
            $posts = -1;
        }
        return $posts;
    }
    public function GetAllDigestCategories() {
        $categories = array();
        $i = 0;
        $this->checkTable('site_digest_categories');
        $result = mysql_query('SELECT `id`,`title` FROM `site_digest_categories` WHERE 1');
        while ($row = mysql_fetch_assoc($result)) {
            $categories[$i]['cid'] = $row['id'];
            $categories[$i]['title'] = $row['title'];
            $i++;
        }

        return $categories;
    }

    public function CreateDigestCategory($title, $description, $lang_id) {
			$this->checkTable('site_digest_categories');
			$result = mysql_query('INSERT INTO `site_digest_categories` SET `title`="' . mysql_escape_string($title) . '", `alias`="'.mysql_escape_string($this->translit_ru($title)).'", `description`="' . mysql_escape_string($description) . '", `lang_id`=(SELECT `id` FROM `site_langs` WHERE `lang_code`="' . mysql_escape_string($lang_id) . '")');
			return $result;
		}

    public function checkSiteUnavailablePageExists(){
        $page = $this->GetPageByAlias('site_unavailable');
        if(!$page){
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
                    'lang'  => 'en',
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

    public function sendReferralMessage($subject, $message, $direction, $parent, $userId){
        $this->checkTable('site_referrals_messages');
        $added = time();
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
}

?>