<?php

class SeoCategoryRepository extends Repository
{
    const CHUNK_SIZE = 100;

    private $persistedAliases = array();

    public function __construct($cms)
    {
        parent::__construct($cms);
        $this->cms->checkTable('site_categories');
    }

    public function getCategoryAlias($cid, $forceCreate = false, $cname = '')
    {
        $q = 'SELECT `alias` FROM `site_categories` WHERE `category_id`="' . mysql_real_escape_string($cid) . '"';
        $r = $this->cms->query($q);
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
            $categoryName = strtolower(TextHelper::translitСonverter($cname));
            $categoryName = $categoryName ? $categoryName.'-' : $categoryName;
            $alias =  $categoryName . $cid;
            if ($alias != 'undefined')
                $this->setCategoryAlias($cid, $alias);
            return $alias;
        } else {
            return '';
        }
    }

    public function persistCategoryAlias($categoryId, $categoryName)
    {
        $alias = strtolower(TextHelper::translitСonverter($categoryName)).'-'.$categoryId;
        $this->setCategoryAlias($categoryId, $alias);

        /*$existedAlias = $this->cms->querySingleValue('
            SELECT `alias`
            FROM `site_categories`
            WHERE `category_id`="'.$this->cms->escape($categoryId).'"');

        if (!$existedAlias) {
            $this->persistedAliases[] = array(
                'alias' => $this->cms->escape($alias),
                'category_id' => $this->cms->escape($categoryId),
            );
            return $alias;
        }

        return $existedAlias;*/
    }

    public function updateCategoryAliases($categories, &$aliases)
    {
        $sqlStart = 'INSERT IGNORE INTO `site_categories` (`alias`, `category_id`) VALUES ';
        $values = array();
        foreach ($categories as $item) {
            if (! array_key_exists($item['id'], $aliases)) {
                $alias = strtolower(TextHelper::translitСonverter($item['name'])) . '-' . $item['id'];
                $values[] = '"' . $this->cms->escape($alias) . '", "' . $this->cms->escape($item['id']) . '"';
                if (count($values) >= self::CHUNK_SIZE) {
                    $sql = $sqlStart . '(' . implode('), (', $values) . ')';
                    $values = array();
                    $res = $this->cms->query($sql);
                    if ($res) {
                        $aliases[$item['id']] = array('category_id' => $item['id'], 'alias' => $alias);  
                    }
                }
            }
        }
        if (! empty($values)) {
            $sql = $sqlStart . '(' . implode('), (', $values) . ')';
            $this->cms->query($sql);
        }
        return $categories;
    }

    public function getCategoryAliases($categoriesIds)
    {
        $categoriesIds = ! is_array($categoriesIds) ? array($categoriesIds) : $categoriesIds;
        $categoriesIds = array_map(array($this->cms, 'escape'), $categoriesIds);

        $i = 0;
        $result = array();
        $count = count($categoriesIds);
        while ($i * self::CHUNK_SIZE < $count) {
            $ids = array_slice($categoriesIds, $i * self::CHUNK_SIZE, self::CHUNK_SIZE);
            if (! empty($ids)) {
                $sql = 'SELECT * FROM `site_categories` WHERE `category_id` IN ("' . implode('", "', $ids) . '")';
                $result = array_merge($result, $this->cms->queryMakeArray($sql, array(), 'category_id'));
            }
            $i++;
        }
        return $result;
    }

    public function flushAliases()
    {
        /*$inserts = array();
        foreach ($this->persistedAliases as $alias) {
            $inserts[] =
                "('{$alias['category_id']}','{$alias['alias']}')";
        }
        $this->persistedAliases = array();
        $query = "INSERT INTO site_categories(category_id,alias) VALUES " . implode(",\n", $inserts);
        $this->cms->query($query);*/
    }

    public function getCategorySEO($cid)
    {
        $this->cms->checkTable('site_pages_langs_data');
        $q = 'SELECT * FROM `site_pages_langs_data` WHERE `p`="' . $cid . '"';
        $r = $this->cms->query($q);
        return @mysql_fetch_assoc($r);
    }

    public function setCategoryAlias($cid, $alias)
    {
        $this->cms->checkTable('site_categories');
        return $this->cms->query('REPLACE INTO `site_categories` SET `category_id`="' . mysql_real_escape_string($cid) . '", `alias`="' . mysql_real_escape_string($alias) . '"');
    }

    public function setCategorySEO($data)
    {
        $this->cms->checkTable('site_pages_langs_data');
        $this->cms->query('DELETE FROM `site_pages_langs_data` WHERE `p`="' . $data['cid'] . '"');
        $q = 'INSERT INTO `site_pages_langs_data` (`p`, `seo_title`, `pagetitle`, `seo_keywords`, `seo_description`, `type` ) VALUES ( "' . $data['cid'] . '", "' . mysql_real_escape_string($data['seo_title']) . '", "' . mysql_real_escape_string($data['meta_title']) . '", "' . mysql_real_escape_string($data['meta_keywords']) . '", "' . mysql_real_escape_string($data['meta_description']) . '", "category" )';

        $this->cms->query($q);
    }

    public function removeCategoryByCategoryId($categoryId)
    {
        $categoryId = mysql_real_escape_string($categoryId);
        $this->cms->checkTable('site_categories');
        $this->cms->query('DELETE FROM `site_categories` WHERE `category_id`="' . $categoryId . '"');
    }
}
