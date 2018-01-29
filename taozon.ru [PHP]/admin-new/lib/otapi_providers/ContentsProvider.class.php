<?php

class ContentsProvider extends Repository
{
    /**
     * @var OTAPIlib
     */
    private $otapilib;

    public function __construct($cms, $otapilib)
    {
        parent::__construct($cms);
        $this->otapilib = $otapilib;
    }
    
    public function getPages($language = false )
    {
        $pagesList = $this->cms->GetPages();
        $allPages = array();
        $pages = array();
        
        foreach ($pagesList as $page) {
            if ($language && $page['lang_code'] != $language) {
                continue;
            }
            $allPages[] = $page;
        }

        foreach ($allPages as &$ppage) {
            if ($language && $ppage['lang_code'] != $language) {
                continue;
            }
            $ppage['menu'] = $this->getPageMenu($ppage);
        }
        
        foreach ($allPages as $page) {
            $parent = $this->getPageParentId($page['id']);
            if (!$parent) {
                $pages[$page['id']] = $page;
                $pages[$page['id']]['children'] = array();
            }
        }
        
        foreach ($allPages as $page) {
            $parent = $this->getPageParentId($page['id']);
            if ($parent && array_key_exists($parent, $pages) ) {
                $pages[$parent]['children'][] = $page;
            }
        }

        return $pages;
    }
    
    public function getPageMenu($page)
    {
        $pageLang = $page['lang_code'];
        $top_menu_json = $this->cms->getBlock('top_menu_' . $pageLang);
        $top_menu = $top_menu_json ? json_decode($top_menu_json) : array();
        
        $left_menu_json = $this->cms->getBlock('left_menu_' . $pageLang);
        $left_menu = $left_menu_json ? json_decode($left_menu_json) : array();
        
        $bottom_menu_json = $this->cms->getBlock('bottom_menu_' . $pageLang);
        $bottom_menu = $bottom_menu_json ? json_decode($bottom_menu_json) : array();
        
        if (in_array($page['id'], $top_menu)) {
            return 'top_menu';
        } elseif (in_array($page['id'], $bottom_menu)) {
            return 'bottom_menu';
        } elseif (in_array($page['id'], $left_menu)) {
            return 'left_menu';
        }
        return '';
    }
    
    public function GetLanguageInfoList($predefinedData = "")
    {
        return $this->otapilib->GetLanguageInfoList($predefinedData);
    }

    public function updatePage($pageId, $alias, $title, $isService, $titleh1 = '')
    {
        mysql_query('UPDATE `pages` SET `alias` = "' . mysql_real_escape_string($alias) . '", `title`= "' . mysql_real_escape_string($title) . '", `is_service` = "' . $isService . '", `title_h1`="' . mysql_real_escape_string($titleh1) . '"  WHERE `id` = "' . $pageId . '"');
    }
    
    public function addPage($alias, $title, $isService, $titleh1 = '') 
    {
        $sql = 'INSERT INTO `pages` (`alias`, `title`, `title_h1`, `is_service` ) VALUES ( "' . mysql_real_escape_string($alias) . '", "' . mysql_real_escape_string($title) . '", "' . mysql_real_escape_string($titleh1) . '", "' . $isService . '")';
        $res = mysql_query($sql);
        return mysql_insert_id();
    }

    public function setPageLang($pageId, $pageLanguage) 
    {
        $langId = $this->cms->_getLangCodeId($pageLanguage);
        $r = mysql_query('DELETE FROM `site_pages_langs` WHERE `page_id` = "' . $pageId . '"');
        $sql = 'INSERT INTO `site_pages_langs` (`lang_id`, `page_id` ) VALUES ( "' . $langId . '", "' . $pageId . '" )';
        mysql_query($sql);
        return $langId;
    }
    
    public function setPageContent($pageId, $pageContent) 
    {
        $r = mysql_query('DELETE FROM `blocks` WHERE `page_id` = "' . $pageId . '"');
        mysql_query("INSERT INTO `blocks` (`page_id`, `text` ) VALUES ('" . $pageId . "', '" . $pageContent . "');");
    }
    
    public function setPageData($langId, $alias, $pageTitle, $pageKeywords, $pageDescription, $type = 'content') 
    {
        $r = mysql_query('DELETE FROM `site_pages_langs_data` WHERE `lang_id` = "' . $langId . '" and `p`="' . $alias .'"');
        $sql = 'INSERT INTO `site_pages_langs_data` (`lang_id`, `p`, `pagetitle`, `seo_keywords`, `seo_description`, `type` ) VALUES ( "' . $langId . '", "' . mysql_real_escape_string($alias) . '", "' . mysql_real_escape_string($pageTitle) . '", "' . mysql_real_escape_string($pageKeywords) . '", "' . mysql_real_escape_string($pageDescription) . '", "'. $type .'" )';
        mysql_query($sql);
    }

    public function setPageParent($pageId, $parentId)
    {
        $this->clearPageParent($pageId);
        mysql_query('INSERT INTO `site_pages_parents` SET `page_id` = "' . $pageId . '", ' . ' `parent_id` = "' . $parentId . '"');
        return mysql_insert_id();
    }
    
    public function clearPageParent($pageId)
    {
        mysql_query('DELETE FROM `site_pages_parents` WHERE `page_id`= "' . $pageId . '"');
        return mysql_affected_rows();
    }
    
    public function getPageParentId($pageId)
    {
        $sql = 'SELECT `parent_id` FROM `site_pages_parents` WHERE `page_id` = "' . $pageId . '"';
        $query = mysql_query($sql);
        if (mysql_num_rows($query)) {
            return mysql_result($query, 0);
        }
        return false;
    }
    
    public function deletePageFromMenu($pageId) 
    {
        $sql = 'SELECT id, properties FROM `site_blocks`;';
        $menus = array();
        $query = mysql_query($sql);
        while ($row = mysql_fetch_assoc($query)) {
            $menus[] = $row;
        }
        
        foreach ($menus as $menu) {
            $id = $menu['id'];
            $props = $menu['properties'];
            $ids = json_decode($props);
            $newIds = array();
            foreach ($ids as $id) {
                if ($id != $pageId) {
                    $newIds[] = $id;
                }
            }
            $props = json_encode($newIds);
            mysql_query('UPDATE `site_blocks` SET `properties`="'.  mysql_real_escape_string($props).'" WHERE `id`="'.$id.'"');
        }
    }
    
    public function addPageToMenu($pageId, $menuType)
    {
        $query = mysql_query('SELECT id, properties FROM `site_blocks` WHERE `type`="'.$menuType.'"');
        if ($row = mysql_fetch_assoc($query)) {
            $menu = $row;
            $id = $menu['id'];
            $props = $menu['properties'];
            $ids = json_decode($props);
            if (in_array($pageId, $ids)) {
                return false;
            }
            $ids[] = $pageId;
            $props = json_encode($ids);
            mysql_query('UPDATE `site_blocks` SET `properties`="' . mysql_real_escape_string($props) . '" WHERE `id`="' . $id . '"');
        } else {
            $ids = array($pageId);
            $props = json_encode($ids);
            mysql_query('INSERT INTO `site_blocks` SET `properties`="' . mysql_real_escape_string($props) . '", `type`="' . $menuType . '"');
        }
        
        return true;
    }
    
    public function deletePage($pageId)
    {
        $this->cms->DeletePageByID($pageId);
    }
    
    public function getPageInfo($pageId) 
    {
         return $this->cms->GetPageByID($pageId);           
    }
        
    public function getMenu($menu) 
    {
        $menu_json = $this->cms->getBlock($menu);
        $menu = $menu_json ? json_decode($menu_json) : array();
        return $menu;
    } 
    
    public function getPageContent($pageId)
    {
        $block = $this->cms->GetBlocksByPageID($pageId);
        return $block[0]['text'];
    }
    
    public function getPagesByLang($lang)
    {
        $digestClass = new DigestRepository($this->cms);
        $allPages = $digestClass->GetPagesByLang($lang);
        $allDocs = array();
        foreach($allPages as $page){
            $parent = $this->getPageParentId($page['id']);
            $page['children'] = array();
            if(!$parent) {
                $allDocs[$page['id']] = $page;
            }
        }
        $allDocs['calculator'] = array('id' => 'calculator', 'title' => LangAdmin::get('contents::Calculator'), 'alias' => 'calculator');
        $allDocs['news'] = array('id' => 'allnews', 'title' => LangAdmin::get('contents::News'), 'alias' => 'allnews');
        
        if(CMS::IsFeatureEnabled('ProductComments'))
            $allDocs['reviews'] = array('id' => 'reviews', 'title' => LangAdmin::get('contents::Reviews'), 'alias' => 'reviews');
        if(CMS::IsFeatureEnabled('Digest'))
            $allDocs['digest'] = array('id' => 'digest', 'title' => LangAdmin::get('contents::Digest'), 'alias' => 'digest');
        if (CMS::IsFeatureEnabled('FleaMarket'))
            $allDocs['pristroy'] = array('id' => 'pristroy', 'title' => LangAdmin::get('contents::Pristroy'), 'alias' => 'pristroy');
        if (CMS::IsFeatureEnabled('ShopComments'))
            $allDocs['shopreviews'] = array('id' => 'shopreviews', 'title' => LangAdmin::get('contents::Shop_reviews'), 'alias' => 'shopreviews');

        return $allDocs;
    }

    public function saveMenu($menuType, $ids)
    {
        $menu = array();
        foreach ($ids as $id) {
            if( !in_array($id, $menu) ){
                $menu[] = $id;
            }
        }
        $menuItems = json_encode(CMS::removeNotAvailableMenuItems($menu));
        $q = mysql_query('SELECT COUNT(*) FROM `site_blocks` WHERE `type`="'.$menuType.'"');
        if(mysql_result($q, 0)){
            mysql_query('UPDATE `site_blocks` SET `properties`="'.  mysql_real_escape_string($menuItems).'" WHERE `type`="'.$menuType.'"');
        }
        else{
            mysql_query('INSERT INTO `site_blocks` SET `properties`="'.  mysql_real_escape_string($menuItems).'", `type`="'.$menuType.'"');
        }
    }
    
        
    public function getPageIdByAlias($alias, $language) 
    {
        $sql = 'SELECT `p`.`id` FROM `pages` `p`
                LEFT JOIN `site_pages_langs` `pl`
                ON `p`.`id`=`pl`.`page_id`
                LEFT JOIN `site_langs` `l`
                ON `pl`.`lang_id` = `l`.`id`
                WHERE `p`.`alias` = "' . mysql_real_escape_string($alias) . '" AND (`l`.`lang_code`="' . mysql_real_escape_string($language) . '"  OR `l`.`lang_code` IS NULL)
                ORDER BY `l`.`lang_code` DESC
                ';
        $result = mysql_query($sql);
        
        if (mysql_num_rows($result)) {
            return mysql_result($result, 0);
        }
        return false;
    }
    
    public function getAllNews($lang, $from, $perpage)
    {
        $news = array('count' => 0, 'rows' => array());
        
        $sql = 'SELECT DISTINCT COUNT(*)
                FROM `news` `p`
                LEFT JOIN `site_news_langs` `pl`
                ON `p`.`id`=`pl`.`news_id`
                LEFT JOIN `site_langs` `l`
                ON `pl`.`lang_id` = `l`.`id` ';
        if(!empty($lang)) {
             $sql .= 'WHERE `l`.`lang_code` = "' . $lang . '"';
        }
        $sql .= 'ORDER BY `p`.`created` DESC;';
        
        $news['count'] = $this->cms->querySingleValue($sql);
        
        if( $news['count'] == 0){
            return $news;
        }

        $sql = 'SELECT DISTINCT `p`.*, `l`.`lang_name`,`l`.`lang_code`
        FROM `news` `p`
        LEFT JOIN `site_news_langs` `pl`
        ON `p`.`id`=`pl`.`news_id`
        LEFT JOIN `site_langs` `l`
        ON `pl`.`lang_id` = `l`.`id` ';
        if(!empty($lang)) {
            $sql .= 'WHERE `l`.`lang_code` = "' . $lang . '"';
        }
        $sql .= 'ORDER BY `p`.`created` DESC;';
        
        
        $news['rows'] = $this->cms->queryMakeArray($sql);
        /*'
                SELECT DISTINCT `p`.*, `l`.`lang_name`,`l`.`lang_code`
                FROM `news` `p`
                LEFT JOIN `site_news_langs` `pl`
                ON `p`.`id`=`pl`.`news_id`
                LEFT JOIN `site_langs` `l`
                ON `pl`.`lang_id` = `l`.`id`
				WHERE `l`.`lang_code` = "' . $lang . '"
                ORDER BY `p`.`created` DESC
                LIMIT ' . $from . ', ' . $perpage . ';                
                ');*/
        
        return $news;
    }
    
    public function deleteNews($id)
    {
        settype($id, 'int');
        $this->cms->DeleteNewsByID($id);
    }
    

    public function getNews($id)
    {
        settype($id, 'int');
        return $this->cms->GetNewsByID($id);
    }
        
    
    public function getLangCodeId($lang)
    {
        $lang = $this->cms->escape($lang);
        return $this->cms->querySingleValue('SELECT `id` FROM `site_langs` WHERE `lang_code`="' . $lang . '"');
    }
    
    public function createNews($title, $brief, $text, $image, $lang)
    {
        $langid = $this->getLangCodeId($lang);
        $this->cms->query('INSERT INTO `news` (`title`, `brief`, `image`, `text` ) VALUES ( "' . $this->cms->escape($title) . '", "' . $this->cms->escape($brief) . '", "' . $this->cms->escape($image) . '", "' . $this->cms->escape($text) . '" )');
        $pid = $this->cms->insertedId();
        $this->cms->query('INSERT INTO `site_news_langs` (`lang_id`, `news_id` ) VALUES ( "' . $langid . '", "' . $pid . '" )');
        return $pid;
    }
    
    public function updateNewsById($id, $title, $brief, $text, $image, $lang)
    {
        $langid = $this->getLangCodeId($lang);

        $this->cms->query('UPDATE `news` SET `title`= "' . $this->cms->escape($title) . '", `brief`= "' . $this->cms->escape($brief) . '", `image` = "' . $this->cms->escape($image) . '", text= "' . $this->cms->escape($text) . '" WHERE `id` = "' . $id . '"');

        $c = $this->cms->querySingleValue('SELECT COUNT(*) FROM site_news_langs WHERE `lang_id`="' . $langid . '" AND `news_id`="' . $id . '"');
        if ($c) {
            $this->cms->query('UPDATE `site_news_langs` SET `lang_id` = "' . $langid . '" WHERE `news_id` = "' . $id . '"');
        } else {
            $this->cms->query('INSERT INTO `site_news_langs` (`lang_id`, `news_id` ) VALUES ( "' . $langid . '", "' . $id . '" )');
        }
    }
    
    public function getBlogPosts($lang, $from, $perpage)
    {
        $langid = $this->getLangCodeId($lang);
        
        $q = "SELECT count(*)
        FROM `digest` `p` ";
        if (!empty($lang)) {
            $q .= "LEFT JOIN `site_digest_langs` `pl` ON `p`.`id` = `pl`.`post_id`
            LEFT JOIN `site_langs` `l` ON `pl`.`lang_id` = `l`.`id`
            LEFT JOIN `site_digest_categories` `c` ON `p`.`category_id` = `c`.`id`
            WHERE `pl`.`lang_id`='" . $langid . "' ";
        }
            
        $q .= "ORDER BY `p`.`created` DESC ";
        
        $count = $this->cms->querySingleValue($q);

        $q = "SELECT DISTINCT `p` . *, `c`.`title` as `cat_title`, `pl`.`lang_id`, `l`.`lang_name`";
        $q .= "FROM `digest` `p` ";
        $q .= "LEFT JOIN `site_digest_categories` `c` ON `p`.`category_id` = `c`.`id` ";
        $q .= "LEFT JOIN `site_digest_langs` `pl` ON `p`.`id` = `pl`.`post_id`
            LEFT JOIN `site_langs` `l` ON `pl`.`lang_id` = `l`.`id`";
        if (!empty($lang)) { 
            $q .= "WHERE `pl`.`lang_id`='" . $langid . "' ";
        }
        $q .= "ORDER BY `p`.`created` DESC " .
        " LIMIT " . $this->cms->escape($from) . " , " . $this->cms->escape($perpage);
        
        $r = $this->cms->query($q,array('digest','site_digest_langs', 'site_digest_categories', 'site_langs'));
        $posts = array();
        $posts['count'] = $count;
        $posts['rows'] = array();   
        if ($r && @mysql_num_rows($r)) {
            while ($row = mysql_fetch_assoc($r)) {
                $row['title'] = strip_tags($row['title']);
                $row['content'] = strip_tags($row['content']);
                $row['created'] = new DateTime($row['created']);
                $posts['rows'][] = $row;
            }
        }
        return $posts;
    }
    
    public function CreateBlogCategory($title, $description, $lang)
    {
        $lang_id = $this->cms->_getLangCodeId($lang);
        $q = 'INSERT INTO `site_digest_categories` SET
        `title`="'.$this->cms->escape($title).'",
        `alias`="'.$this->cms->escape(TextHelper::translitСonverter($title)).'",
        `description`="'.$this->cms->escape($description).'",
        `lang_id`="'.$lang_id.'"';
        $r = $this->cms->query($q,array('site_digest_categories'));
        return $this->cms->insertedId();
    }
    
    public function UpdateBlogCategory($title, $description, $lang, $id)
    {
        $lang_id = $this->cms->_getLangCodeId($lang);
        $q = 'UPDATE `site_digest_categories` SET
        `title`="'.$this->cms->escape($title).'",
        `alias`="'.$this->cms->escape(TextHelper::translitСonverter($title)).'",
        `description`="'.$this->cms->escape($description).'",
        `lang_id`="'.$lang_id.'"
        WHERE `id`="'.$this->cms->escape($id).'"';
        $r = $this->cms->query($q,array('site_digest_categories'));
    }
    
    public function DeleteBlogCategory($id)
    {
        $q = 'DELETE FROM `site_digest_categories` WHERE `id`="'.$this->cms->escape($id).'"';
        $r = $this->cms->query($q,array('site_digest_categories'));
    }
    
    public function CreatePost($title, $categoryId, $image, $content, $created, $lang, $preview, $alias)
    {
        $fullDate = '';
        if (! empty($created)) {
            $fullDate = strtotime($created) ? date('Y-m-d', strtotime($created)) : date('Y-m-d');
        }
        $fullDate = $fullDate ? $fullDate : date('Y-m-d');
        $langid = $this->cms->_getLangCodeId($lang);
        $this->cms->checkTable('site_digest_langs');
        $this->cms->query('INSERT INTO `digest` (`title`, `category_id`, `image`, `content`, `brief`, `alias`, `created`) VALUES ( "' . $this->cms->escape($title) . '", "' . $this->cms->escape($categoryId) . '", "' . $image . '", "' . $this->cms->escape($content) . '", "' . $this->cms->escape($preview) . '", "' . $this->cms->escape($alias) . '" ,"' . $fullDate . '" )');
        $pid = $this->cms->insertedId();
        $this->cms->query('INSERT INTO `site_digest_langs` (`lang_id`, `post_id` ) VALUES ( "'.$this->cms->escape($langid).'", "'.$this->cms->escape($pid).'" )');
    
        return $pid;
    }
    
    public function UpdatePostByID($id, $title, $categoryId, $image, $content, $created, $lang, $preview, $alias)
    {
        $fullDate = '';
        if (! empty($created)) {
            $fullDate = strtotime($created) ? date('Y-m-d', strtotime($created)) : date('Y-m-d');
        }
        $fullDate = $fullDate ? $fullDate : date('Y-m-d');
        $langid = $this->cms->_getLangCodeId($lang);
        $this->cms->query('UPDATE `digest` SET `title`= "' . $this->cms->escape($title) . '", `category_id`= "' . $this->cms->escape($categoryId) . '", `image` = "' . $this->cms->escape($image) . '",`content` = "' . $this->cms->escape($content) . '", `brief` = "' . $this->cms->escape($preview) . '" , `alias` = "' . $this->cms->escape($alias) . '" , `created` = "' . $fullDate . '" WHERE `id` = "' . $this->cms->escape($id) . '"',array('site_digest_langs'));
            
        $q = 'SELECT COUNT(*) FROM site_digest_langs WHERE `post_id`="'.$this->cms->escape($id).'"';
        $r = $this->cms->query($q);
        $c = mysql_result($r, 0);
        if ($c) {
            $this->cms->query('UPDATE `site_digest_langs` SET `lang_id` = "'.$this->cms->escape($langid).'" WHERE `post_id` = "'.$this->cms->escape($id).'"');
        } else {
            $this->cms->query('INSERT INTO `site_digest_langs` (`lang_id`, `post_id` ) VALUES ( "'.$this->cms->escape($langid).'", "'.$this->cms->escape($id).'" )');
        }
    }
    
    public function GetPostByID($id)
    {
        $q = 'SELECT `p`.*, `l`.`lang_code`, `l`.`id` as `lang_id` FROM `digest` `p`
        LEFT JOIN `site_digest_langs` `pl`
        ON `p`.`id`=`pl`.`post_id`
        LEFT JOIN `site_langs` `l`
        ON `pl`.`lang_id` = `l`.`id`
        WHERE `p`.`id` = "'.$this->cms->escape($id).'"
        ';
        $r = $this->cms->query($q);
        $post = false;
        if ($r)
            if ($row = mysql_fetch_assoc($r)) {
            $post = $row;
            $post['title'] = str_replace(array("\'", '\"', '\\\\'), array("'", '"', '\\'), $post['title']);
            $post['category_id'] = str_replace(array("\'", '\"', '\\\\'), array("'", '"', '\\'), $post['category_id']);
            $post['image'] = str_replace(array("\'", '\"', '\\\\'), array("'", '"', '\\'), $post['image']);
            $post['content'] = str_replace(array("\'", '\"', '\\\\'), array("'", '"', '\\'), $post['content']);
            $post['brief'] = str_replace(array("\'", '\"', '\\\\'), array("'", '"', '\\'), $post['brief']);
            $post['created'] = new DateTime($post['created']);
            
        }
        
        if ($post && ! empty($post['alias'])) {
            $r = $this->cms->query("
                SELECT * FROM `site_pages_langs_data`
                WHERE `p`='" . $post['alias'] . "'
                AND `lang_id`='" . $post['lang_id'] . "' AND type='post' ");
            if ($r && mysql_num_rows($r)) {
                $row = mysql_fetch_assoc($r);
                $post['pagetitle'] = $row['pagetitle'];
                $post['seo_title'] = $row['seo_title'];
                $post['seo_keywords'] = $row['seo_keywords'];
                $post['seo_description'] = $row['seo_description'];
            }
        }
        
        return $post;
    }
    
    public function DeletePostByID($id)
    {
        $q = 'DELETE FROM `digest` WHERE `id` = "'.$this->cms->escape($id).'"';
        $r = $this->cms->query($q,array('digest'));
        $q = 'DELETE FROM `site_digest_langs` WHERE `post_id` = "'.$this->cms->escape($id).'"';
        $r = $this->cms->query($q,array('site_digest_langs'));
    }
    
    public function GetAllBlogCategories($lang)
    {
        $lang = $this->cms->_getLangCodeId($lang);
        $categories = array();
        //$q = 'SELECT `id`,`alias`,`title`,`description` FROM `site_digest_categories` WHERE `lang_id` = "'.$lang.'"';
        $q = 'SELECT `sdl`.`id`, `sdl`.`alias`, `sdl`.`title`, `sdl`.`description`, `sl`.lang_code FROM `site_digest_categories` as `sdl` JOIN `site_langs` as `sl` on  `sl`.`id` = `sdl`.`lang_id`;';
        $r = $this->cms->query($q,array('site_digest_categories'));
        while ($row = mysql_fetch_assoc($r)) {
            $categories[$row['alias']]['id'] = $row['id'];
            $categories[$row['alias']]['cid'] = $row['alias'];
            $categories[$row['alias']]['title'] = strip_tags($row['title']);
            $categories[$row['alias']]['description'] = strip_tags($row['description']);
            $categories[$row['alias']]['language'] = strip_tags($row['lang_code']);
            $categories[$row['alias']]['lang_id'] = $lang;
        }
    
        return $categories;
    }

    public function GetBlogCategoryById($cid)
    {
        $category = array();
        $q = "SELECT * FROM `site_digest_categories` WHERE `id`='".$this->cms->escape($cid)."'";
        $result = $this->cms->queryMakeArray($q,array('site_digest_categories'));
        return $result;
    }    
    
    public function GetItemInfo($itemId, $predefinedData = "")
    {
        return $this->otapilib->GetItemInfo($itemId, $predefinedData);
    }

    public function BatchGetItemFullInfo($sessionId, $itemId, $blockList)
    {
        return $this->otapilib->BatchGetItemFullInfo($sessionId, $itemId, $blockList);
    }
    
    public function getBlogPostIdByLangAlias($alias, $lang) {
        $query = "select d.`id` " . 
            "from digest as d " .
            "join site_digest_langs as sdl on sdl.`post_id` = d.`id` " .
            "join site_langs as sl on sl.`id` = sdl.`lang_id` " .
            "where d.`alias`='" . $this->cms->escape($alias) . "' and sl.`lang_code`='" . $this->cms->escape($lang) . "';";             
        $result = $this->cms->querySingleValue($query);
        return $result;            
    }
}

