<?php
class MenuModel2 extends CMS_Model
{
    protected $valuesConf = array(
        'pid' => array(
            'keyField'         => 'id',
            'titleField'     => 'title',
            'tableName'     => 'menu',
            'cond'             => array()
        )
    );
    /** Возвращает меню по условию или false если нет совпадений
     *
     * @param  $cond
     * @return array|bool
     */
    public function getMenu($cond){
        $group = $this->GetByCond('menu', '', $cond, 1);
        return ($group) ? $this->getTree($group['id']) : false;
    }
    
    public function getTree($pid = 0, $level = 0, $clevel = 0, $show_hidden = false, $url = '', $addSQL = array())
    {
        $file = md5($this->db->getPrefix().'menu'.$pid.$level.$clevel.$show_hidden.$url.var_export($addSQL, true));
        misc::create_dir('.zf_cache/menu2/', 0777);
        if (is_file(".zf_cache/menu2/$file.cache")) {
            include ".zf_cache/menu2/$file.cache";
            debug::add("MenuModel->getTree($pid, $level, $clevel, ".($show_hidden?'true':'false').", '$url', ".var_export($addSQL, true).") from cache", 'cache');
        } else {
            $data = $this->getTreeSQL($pid, $level, $clevel, $show_hidden, $url, $addSQL);
            file_put_contents(".zf_cache/menu2/$file.cache", '<?php $data='.var_export($data, true).';');
        }
        return $data;
    }
    
    /**
     * Рекурсивная супер функция по получению дерева
     * @param integer $pid
     * @return array
     */
    public function getTreeSQL($pid = 0, $level = 0, $clevel = 0, $show_hidden = false, $url = '', $addSQL = array()) 
    {
        if ($level != 0 and $clevel >= $level) {
            return array();
        }
        $tree = array();
           $result = $this->getSubTree($pid, $show_hidden, $addSQL);
           if (!$result) return array();
           foreach ($result as $value) {
            $value = array_merge($value, array('level' => $clevel));
               $branch = $value;
               if ($value['count'] > 0) {
                  $branch['children'] = $this->getTreeSQL($value['id'], $level, $clevel + 1, $show_hidden, $branch['url']);
               }
               $tree[$value['id']] = $branch;
           }
        return $tree;
    }
    
    private function getSubTree($pid, $show_hidden=false, $addSQL=array())
    {
        $fields = $this->getFieldsNames('menu', 'menu');
        if (empty($fields)) {
            $fields = array('t1.id', 't1.pid', 't1.path', 't1.title', 't1.link');
        } else {
            foreach ($fields as &$field) {
                $field = 't1.'.$field;
            }
        }
        
        return $this->db->query("
            SELECT ?lt, count(t2.pid) as count ".
            (isset($addSQL['fields']) ? $addSQL['fields'] : '').
            " FROM ?t as t1
            LEFT OUTER JOIN ?t AS t2 ON t1.id = t2.pid ".
            (isset($addSQL['join']) ? $addSQL['join'] : '').
            " WHERE t1.pid = ?d ".($show_hidden? "" : " AND t1.hidden = 'no' ").
            (isset($addSQL['where']) ? $addSQL['where'] : '').
            " GROUP BY t1.id
            ORDER BY t1.pos", $fields, $this->tables['menu'], $this->tables['menu'], $pid);
    }
    
    public function Shift($tableName, $id, $to, $cond = array(), $posFields = array('pos'))
    {
    	misc::empty_dir('.zf_cache/menu2/');
    	parent::Shift($tableName, $id, $to, $cond, $posFields);
    }
}
