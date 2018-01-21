<?php
class DbModel extends CMS_Model
{
    protected $valuesConf = array(
        'country_id' => array(
            'keyField'   => 'id',
            'titleField' => 'title',
            'tableName'  => 'countries',
            'cond'       => array()
        ),
        'factory_id' => array(
            'keyField'   => 'id',
            'titleField' => 'title',
            'tableName'  => 'factories',
            'cond'       => array()
        ),
        'collection_id' => array(
            'keyField'   => 'id',
            'titleField' => 'title',
            'tableName'  => 'collections',
            'cond'       => array()
        ),
        'types' => array(
            'keyField'   => 'id',
            'titleField' => 'title',
            'tableName'  => 'types',
            'cond'       => array()
        ),
        'type_id' => array(
            'keyField'   => 'id',
            'titleField' => 'title',
            'tableName'  => 'types',
            'cond'       => array()
        ),
        'purposes' => array(
            'keyField'   => 'id',
            'titleField' => 'title',
            'tableName'  => 'purposes',
            'cond'       => array()
        ),
        'surfaces' => array(
            'keyField'   => 'id',
            'titleField' => 'title',
            'tableName'  => 'surfaces',
            'cond'       => array()
        ),
		'styles' => array(
            'keyField'   => 'id',
            'titleField' => 'title',
            'tableName'  => 'styles',
            'cond'       => array()
        ),
		'colors' => array(
            'keyField'   => 'id',
            'titleField' => 'title',
            'tableName'  => 'colors',
            'cond'       => array()
        ),
        'materials' => array(
            'keyField'   => 'id',
            'titleField' => 'title',
            'tableName'  => 'materials',
            'cond'       => array()
        ),
        'typespromotional_id' => array(
            'keyField'   => 'id',
            'titleField' => 'title',
            'tableName'  => 'typespromotional',
            'cond'       => array()
        )
    );
	public $error = null;

	public function getGoodsCollection($collection_id)
	{
		$fields = $this->getFieldsNames('goods', 'good_one');
		foreach ($fields as &$v) $v = 'g.'.$v;
        $goods = $this->db->fullKarr(
            'SELECT g.id AS k, f.title AS f_title, c.title AS c_title, ?lt, u.title AS unit_title, p2g.price AS price,
            p2g2.price AS price_opt, p2g3.price AS price_old, SUM(rem.stock) AS remains FROM ?t AS g
            JOIN ?t AS c ON c.id = g.collection_id
            JOIN ?t AS f ON f.id = c.factory_id
            JOIN ?t AS u ON u.id = g.unit_id
            JOIN ?t AS p2g ON p2g.good_id = g.id AND p2g.price_id = 1
            JOIN ?t AS p2g2 ON p2g2.good_id = g.id AND p2g2.price_id = 6
            JOIN ?t AS p2g3 ON p2g3.good_id = g.id AND p2g3.price_id = 3
            JOIN ?t AS rem ON rem.good_id = g.id
            WHERE ?t = ?d AND rem.store_id = 1
            GROUP BY g.id',
            $fields, $this->tables['goods'], $this->tables['collections'], $this->tables['factories'],
            $this->tables['units'], $this->tables['prices2goods'], $this->tables['prices2goods'], $this->tables['prices2goods'],
            $this->tables['remains'], 'c.id', $collection_id
        );

        $goods_several_coll = $this->db->fullKarr(
            'SELECT g1.id AS k, f.title AS f_title, c.title AS c_title, g1.id as id, g1.title as title,
            g1.ftitle as ftitle, g1.unit_id as unit_id, g1.photo as photo, g1.action as action, g1.sale as sale, g1.novice as novice, u.title AS unit_title,
            p2g.price AS price, p2g2.price AS price_opt, p2g3.price AS price_old, SUM(rem.stock) AS remains
            FROM ?t AS g
            JOIN ?t AS g2c ON g2c.collection_id = g.collection_id
            JOIN ?t AS c ON c.id = g2c.collection_id
            JOIN ?t AS f ON f.id = c.factory_id
            JOIN ?t AS g1 ON g1.id = g2c.good_id
            JOIN ?t AS u ON u.id = g1.unit_id
            JOIN ?t AS p2g ON p2g.good_id = g1.id AND p2g.price_id = 1
            JOIN ?t AS p2g2 ON p2g2.good_id = g1.id AND p2g2.price_id = 6
            JOIN ?t AS p2g3 ON p2g3.good_id = g.id AND p2g3.price_id = 3
            JOIN ?t AS rem ON rem.good_id = g1.id
            WHERE g2c.collection_id = ?d AND rem.store_id = 1
            GROUP BY g1.id',
            $this->tables['goods'], $this->tables['goods2collectionsNM'], $this->tables['collections'],
            $this->tables['factories'], $this->tables['goods'], $this->tables['units'],
            $this->tables['prices2goods'], $this->tables['prices2goods'], $this->tables['prices2goods'],
            $this->tables['remains'], $collection_id
        );
        $goods = $goods_several_coll + $goods;
        //формируем поля action, sale, novice в зависимости от дат
        $valuesAction = $this->model('catalog', 'catalog')->valuesAction;
        $col = $this->Get(
            $collection_id,
            'collections',
            $this->getFieldsNames('collections', 'list_coll')
        );
        foreach($goods as $goodKey => $good)
        {
            foreach($valuesAction as $actionKey => $val)
            {
                if (!empty($col['date_start_'.$actionKey]) && !empty($col['date_end_'.$actionKey]) && !empty($good[$actionKey]) && $good[$actionKey] == 'yes'){
                    $curr_time = time();
                    if (!(strtotime($col['date_start_'.$actionKey]) <= $curr_time && $curr_time <= strtotime($col['date_end_'.$actionKey]))){
                        $goods[$goodKey][$actionKey] = 'no';
                    }
                } else {
                    $goods[$goodKey][$actionKey] = 'no';
                }
            }
        }
		return $goods;

	}

	public function getMenu($act_filter = false)
	{
		$raw_data = $this->db->query(
				'SELECT c.id AS cid, c.url AS curl, c.mtitle AS ctitle, f.id AS fid, f.url AS furl, f.title AS ftitle, col.id AS colid, col.url AS colurl, col.title AS coltitle
				FROM ?t AS c
				JOIN ?t AS f ON c.id = f.country_id
				JOIN ?t AS col ON f.id = col.factory_id
				WHERE f.hidden = ? AND col.hidden = ?
				'.($act_filter ? " AND col.".$act_filter." = 'yes'" : '').'
				ORDER BY c.title, f.title, col.title',
				$this->tables['countries'], $this->tables['factories'], $this->tables['collections'], 'no', 'no'
		);

		$menu = array();
		foreach ($raw_data as $e) {
			if (!array_key_exists($e['cid'], $menu)) {
				$menu[$e['cid']] = array(
						'id' => $e['cid'],
						'url' => $e['curl'].($act_filter ? "/".$act_filter."/yes" : ''),
						'title' => $e['ctitle'],
						'children' => array()
				);
			}
			if (!array_key_exists($e['fid'], $menu[$e['cid']]['children'])) {
				$menu[$e['cid']]['children'][$e['fid']] = array(
						'id' => $e['fid'],
						'url' => $e['furl'].($act_filter ? "/".$act_filter."/yes" : ''),
						'title' => $e['ftitle'],
						'children' => array()
				);
			}

			if (!array_key_exists($e['colid'], $menu[$e['cid']]['children'][$e['fid']]['children'])) {
				$menu[$e['cid']]['children'][$e['fid']]['children'][$e['colid']] = array(
						'id' => $e['colid'],
						'url' => $e['colurl'].($act_filter ? "/".$act_filter."/yes" : ''),
						'title' => $e['coltitle']
				);
			}
		}
		return $menu;
	}

    public function getFactoriesList($country_id, $act_filter){
        $raw_data = $this->db->query(
            "SELECT f.id, f.url, f.country_id, f.title, f.descr, f.image
            FROM ?t AS f
            JOIN ?t AS col ON f.id = col.factory_id
            WHERE f.country_id = ? AND f.hidden = ? AND col.".$act_filter." = ?
            GROUP BY f.title
            ORDER BY f.title",
            $this->tables['factories'], $this->tables['collections'], $country_id, 'no', 'yes'
        );
        return $raw_data;
    }

	public function getSpecFilters($factory_id = null)
	{
		$where = '';
		if ($factory_id) {
			if (is_numeric($factory_id)) $where = 'AND f.id = '.intval($factory_id);
			else $where = 'AND f.url = \''.mysql_real_escape_string($factory_id)."'";
		}

		$spec = $this->db->assoc(
				'SELECT SUM(IF(novice = \'yes\', 1, 0)) AS novice,
				SUM(IF(action = \'yes\', 1, 0)) AS action,
				SUM(IF(sale = \'yes\', 1, 0)) AS sale
				FROM ?t AS c
				JOIN ?t AS f ON c.factory_id = f.id
				WHERE c.hidden = ? '.$where,
				$this->tables['collections'], $this->tables['factories'], 'no'
		);

		return $spec;
	}
////////////////////////////////////////////////////////
	public function importGoods($fileName)
	{
		$this->error = null;
		if (is_file($fileName)) {
			//инициализируем списки
			$factories   = $this->db->karr('SELECT id, title FROM ?t', $this->tables['factories'], 1);
			$collections = $this->db->fullKarrQuery('SELECT factory_id, id, title FROM ?t ORDER BY factory_id ASC', $this->tables['collections'], 1);
			$tmp_collections = array();
			foreach ($collections as $f_id => $c) {
				$tmp_collections[$f_id] = array();
				for ($i = 0, $maxi = count($c); $i < $maxi; $i++) {
					$tmp_collections[$f_id][$c[$i]['id']] = $c[$i]['title'];
				}
			}
			$collections = $tmp_collections;
			unset($tmp_collections);
			$units       = $this->db->karr('SELECT id, title FROM ?t', $this->tables['units'], 1);
			$goods       = $this->db->karr('SELECT id, title FROM ?t', $this->tables['goods'], 1);
			//сбрасываем конфиг, чтобы не логировать кучу говна
			$this->db->apply_conf(array());

			$nomenclature_h = fopen($fileName, "rt");
			if ($nomenclature_h == false) {
				$this->error =  "File '$fileName' could not open.";
				return false;
			}
			$titles = fgetcsv($nomenclature_h, null, ";");
			for ($i = 16; $i < count($titles); $i++) {
				$this->Save('prices', array('id' => $i-15, 'title' => iconv('cp1251', 'utf-8', $titles[$i])));
			}
			//хак для картинок
			$this->conf['tables']['goods']['fields']['photo']['am']['type'] = 'string';

			while ( ($good = fgetcsv($nomenclature_h, null, ";")) != false ) {
				//юникод наше все
				foreach ($good as &$item) {
					$item = iconv('cp1251', 'utf-8', $item);
				}
				unset($item);
				//добавляем фабрики
				if (!in_array($good[4], $factories)) {
					$factory_id = $this->Save('factories', array('title' => $good[4]));
					$factories[$factory_id] = $good[4];
				} else {
					$factory_id = array_search($good[4], $factories);
				}

				//добавляем коллекцию
				if (!isset($collections[$factory_id]) or !in_array($good[5], $collections[$factory_id])) {
					$collection_id = $this->Save('collections', array('title' => $good[5], 'factory_id' => $factory_id));
					$collections[$factory_id][$collection_id] = $good[5];
					$good[5] = $collection_id;
				} else {
					$good[5] = array_search($good[5], $collections[$factory_id]);
				}

				//добавляем единицы измерения
				if (!in_array($good[13], $units)) {
					$unit_id = $this->Save('units', array('title' => $good[13]));
					$units[$unit_id] = $good[13];
					$unit_text = $good[13];
					$good[13] = $unit_id;
				} else {
					$unit_text = $good[13];
					$good[13] = array_search($good[13], $units);
				}

				//фотография
				$photo = '';
				if (file_exists("./public/userfiles/goods/small/{$good[0]}.jpg")) {
					$photo = "/public/userfiles/goods/[dir]/{$good[0]}.jpg";
				}
                //echo implode(';', $good).'<br/>';
                //echo "act-".$good[24]."_sale-".$good[25]."_nov-".$good[26];
				$data = array(
					'id'  => $good[0],
					'art' => $good[1],
					'title' => $good[2],
					'ftitle' => $good[3],
					'collection_id' => $good[5],
					'type' => $good[6],
					'size' => $good[7],
					'width' => str_replace(',', '.', $good[8]),
					'length' => str_replace(',', '.', $good[9]),
					'weight' => str_replace(',', '.', $good[10]),
					'packCntByCount' => str_replace(',', '.', $good[11]),
					'packCntByArea' => str_replace(',', '.', $good[12]),
					'packCntByUnit' => $unit_text == 'шт' ? str_replace(',', '.', $good[11]) : str_replace(',', '.', $good[12]),
					'unit_id' => $good[13],
					'url' => $good[14],
					'non_liquid' => intval($good[15]),
					'photo' => $photo,
                    'action' => $good[27] == '1' ? 'yes' : 'no',
                    'sale' => $good[28] == '1' ? 'yes' : 'no',
                    'novice' => $good[29] == '1' ? 'yes' : 'no',
                    'updated' => 'yes',
					'material' => $good[30],//материал
					'style' => $good[31],//стиль
					'surface' => $good[32],//поверхность
					'purpose' => $good[33],//назначение
					'color' => $good[34] //цвет
				);
				switch (trim($unit_text)) {
					case 'шт':
						$data['packCntByUnit'] = $data['packCntByCount'];
					break;
					case 'кг':
						$data['packCntByUnit'] = $data['weight'];
					break;
					default:
						$data['packCntByUnit'] = $data['packCntByArea'];
					break;
				}
				$price = array('q' => array(), 'args' => array($this->tables['prices2goods']));
                $price_key_start = 16;
                $price_key_end = 27;//count($good);
				for ($i = $price_key_start; $i <= $price_key_end; $i++) {
					$price['q'][]    = '(?l)';
					$price['args'][] = array($good[0], $i-15, str_replace(',', '.', $good[$i]));
				}
				$this->db->query(
					'REPLACE INTO ?t (`good_id`, `price_id`, `price`) VALUES '.implode(',', $price['q']),
					$price['args']
				);

				if (empty($goods[$good[0]])) {
					$this->Save('goods', $data);
				} else {
					$this->Save('goods', $data, array('id' => $good[0]));
				}
				
				//добавить наименования материалов, стилей, поверхностей, назначений и цветов в соответствующие таблицы
				$data['material']=trim($data['material']);
				$data['material']=trim($data['material'],";");
				
				$material_ex=explode(";",$data['material']);
				for($i=0;$i<count($material_ex);$i++){
					$material_ex[$i]=trim($material_ex[$i]);
					if($material_ex[$i]==""){ continue; }
					$tmp_select=$this->db->query('SELECT * FROM ad_materials WHERE title="'.$material_ex[$i].'"');
					if(count($tmp_select)==0){
						//в таблице ещё нет данного материала
						$this->db->query('INSERT INTO ad_materials (title) VALUES ("'.$material_ex[$i].'")');
						
					}
				}
				
				$data['style']=trim($data['style']);
				$data['style']=trim($data['style'],";");
				
				$style_ex=explode(";",$data['style']);
				for($i=0;$i<count($style_ex);$i++){
					$style_ex[$i]=trim($style_ex[$i]);
					if($style_ex[$i]==""){ continue; }
					$tmp_select=$this->db->query('SELECT * FROM ad_styles WHERE title="'.$style_ex[$i].'"');
					if(count($tmp_select)==0){
						//в таблице ещё нет данного стиля
						$this->db->query('INSERT INTO ad_styles (title) VALUES ("'.$style_ex[$i].'")');
					
					}
				}
				
				
				$data['surface']=trim($data['surface']);
				$data['surface']=trim($data['surface'],";");
				
				$surface_ex=explode(";",$data['surface']);
				for($i=0;$i<count($surface_ex);$i++){
					$surface_ex[$i]=trim($surface_ex[$i]);
					if($surface_ex[$i]==""){ continue; }
					$tmp_select=$this->db->query('SELECT * FROM ad_surfaces WHERE title="'.$surface_ex[$i].'"');
					if(count($tmp_select)==0){
						//в таблице ещё нет данной поверхности
						$this->db->query('INSERT INTO ad_surfaces (title) VALUES ("'.$surface_ex[$i].'")');
					
					}
				}
				
				
				$data['purpose']=trim($data['purpose']);
				$data['purpose']=trim($data['purpose'],";");
				
				$purpose_ex=explode(";",$data['purpose']);
				for($i=0;$i<count($purpose_ex);$i++){
					$purpose_ex[$i]=trim($purpose_ex[$i]);
					if($purpose_ex[$i]==""){ continue; }
					$tmp_select=$this->db->query('SELECT * FROM ad_purposes WHERE title="'.$purpose_ex[$i].'"');
					if(count($tmp_select)==0){
						//в таблице ещё нет данного назначения
						$this->db->query('INSERT INTO ad_purposes (title) VALUES ("'.$purpose_ex[$i].'")');
					
					}
				}
				
				
				$data['color']=trim($data['color']);
				$data['color']=trim($data['color'],";");
				
				$color_ex=explode(";",$data['color']);
				for($i=0;$i<count($color_ex);$i++){
					$color_ex[$i]=trim($color_ex[$i]);
					if($color_ex[$i]==""){ continue; }
					$tmp_select=$this->db->query('SELECT * FROM ad_colors WHERE title="'.$color_ex[$i].'"');
					if(count($tmp_select)==0){
						//в таблице ещё нет данного цвета
						$this->db->query('INSERT INTO ad_colors (title) VALUES ("'.$color_ex[$i].'")');
					
					}
				}
				
				
				//вставка в таблицы соответствий
				for($i=0;$i<count($material_ex);$i++){	
					$tmp_select=$this->db->query('SELECT * FROM ad_materials WHERE title="'.$material_ex[$i].'"');
					$material_id=$tmp_select[0]['id'];
					
					$tmp_select=$this->db->query('SELECT * FROM ad_goods2materials WHERE material_id="'.$material_id.'" AND good_id="'.$data['id'].'" ');
					if(count($tmp_select)==0){
						$this->db->query('INSERT INTO ad_goods2materials (material_id,good_id) VALUE ("'.$material_id.'","'.$data['id'].'") ');	
					}
					
					$tmp_select=$this->db->query('SELECT * FROM ad_collections2materials WHERE material_id="'.$material_id.'" AND collection_id="'.$data['collection_id'].'" ');
					if(count($tmp_select)==0){
						$this->db->query('INSERT INTO ad_collections2materials (material_id,collection_id) VALUE ("'.$material_id.'","'.$data['collection_id'].'") ');
					}
					
					
				}
				
				for($i=0;$i<count($style_ex);$i++){	
					$tmp_select=$this->db->query('SELECT * FROM ad_styles WHERE title="'.$style_ex[$i].'"');
					$style_id=$tmp_select[0]['id'];
					
					$tmp_select=$this->db->query('SELECT * FROM ad_goods2styles WHERE style_id="'.$style_id.'" AND good_id="'.$data['id'].'" ');
					if(count($tmp_select)==0){
						$this->db->query('INSERT INTO ad_goods2styles (style_id,good_id) VALUE ("'.$style_id.'","'.$data['id'].'") ');
					}
					
					$tmp_select=$this->db->query('SELECT * FROM ad_collections2styles WHERE style_id="'.$style_id.'" AND collection_id="'.$data['collection_id'].'" ');
					if(count($tmp_select)==0){
						$this->db->query('INSERT INTO ad_collections2styles (style_id,collection_id) VALUE ("'.$style_id.'","'.$data['collection_id'].'") ');
					}
					
					
				}
				
				for($i=0;$i<count($surface_ex);$i++){	
					$tmp_select=$this->db->query('SELECT * FROM ad_surfaces WHERE title="'.$surface_ex[$i].'"');
					$surface_id=$tmp_select[0]['id'];
					
					$tmp_select=$this->db->query('SELECT * FROM ad_goods2surfaces WHERE surface_id="'.$surface_id.'" AND good_id="'.$data['id'].'" ');
					if(count($tmp_select)==0){
						$this->db->query('INSERT INTO ad_goods2surfaces (surface_id,good_id) VALUE ("'.$surface_id.'","'.$data['id'].'") ');
					}
					
					$tmp_select=$this->db->query('SELECT * FROM ad_collections2surfaces WHERE surface_id="'.$surface_id.'" AND collection_id="'.$data['collection_id'].'" ');
					if(count($tmp_select)==0){
						$this->db->query('INSERT INTO ad_collections2surfaces (surface_id,collection_id) VALUE ("'.$surface_id.'","'.$data['collection_id'].'") ');
					}
					
					
				}
				
				for($i=0;$i<count($purpose_ex);$i++){	
					$tmp_select=$this->db->query('SELECT * FROM ad_purposes WHERE title="'.$purpose_ex[$i].'"');
					$purpose_id=$tmp_select[0]['id'];
					
					$tmp_select=$this->db->query('SELECT * FROM ad_goods2purposes WHERE purpose_id="'.$purpose_id.'" AND good_id="'.$data['id'].'" ');
					if(count($tmp_select)==0){
						$this->db->query('INSERT INTO ad_goods2purposes (purpose_id,good_id) VALUE ("'.$purpose_id.'","'.$data['id'].'") ');
					}
					
					$tmp_select=$this->db->query('SELECT * FROM ad_collections2purposes WHERE purpose_id="'.$purpose_id.'" AND collection_id="'.$data['collection_id'].'" ');
					if(count($tmp_select)==0){
						$this->db->query('INSERT INTO ad_collections2purposes (purpose_id,collection_id) VALUE ("'.$purpose_id.'","'.$data['collection_id'].'") ');
					}
					
					
				}
				
				for($i=0;$i<count($color_ex);$i++){	
					$tmp_select=$this->db->query('SELECT * FROM ad_colors WHERE title="'.$color_ex[$i].'"');
					$color_id=$tmp_select[0]['id'];
					
					$tmp_select=$this->db->query('SELECT * FROM ad_goods2colors WHERE color_id="'.$color_id.'" AND good_id="'.$data['id'].'" ');
					if(count($tmp_select)==0){
						$this->db->query('INSERT INTO ad_goods2colors (color_id,good_id) VALUE ("'.$color_id.'","'.$data['id'].'") ');
					}
					
					$tmp_select=$this->db->query('SELECT * FROM ad_collections2colors WHERE color_id="'.$color_id.'" AND collection_id="'.$data['collection_id'].'" ');
					if(count($tmp_select)==0){
						$this->db->query('INSERT INTO ad_collections2colors (color_id,collection_id) VALUE ("'.$color_id.'","'.$data['collection_id'].'") ');
					}
					
					
				}
				
				
				//добавление размера для коллекции
				$tmp_select=$this->db->query('SELECT * FROM ad_based_sizes WHERE title="'.$data['size'].'" ');
				if(count($tmp_select)==0){
					$this->db->query('INSERT INTO ad_based_sizes (title) VALUE ("'.$data['size'].'") ');
				}
				$id_size_tmp=$this->db->query('SELECT * FROM ad_based_sizes WHERE title="'.$data['size'].'" ');
				$id_size=$id_size_tmp[0]['id'];
				
				
				//связь коллекции и размера
				$tmp_select=$this->db->query('SELECT * FROM ad_based_sizes2collections WHERE collection_id="'.$data['collection_id'].'" AND based_size_id="'.$id_size.'" ');
				
				//echo "<br>";
				//print_r($tmp_select);
				//echo "==".$data['collection_id']." - ".$id_size." - ".$data['size']."==".count($tmp_select)."<br>";
				//echo "<br>";
				
				if(count($tmp_select)==0){
					$this->db->query('INSERT INTO ad_based_sizes2collections (collection_id,based_size_id) VALUE ("'.$data['collection_id'].'","'.$id_size.'") ');
				}
				
				
				
				
				
				
				
				
				
				
				
			}
            $this->db->query("DELETE FROM ".$this->tables['goods']." WHERE updated = 'no'");
            $this->db->query("UPDATE ad_collections SET novice = 'no', action = 'no', sale = 'no'");
            $this->db->query("UPDATE ad_collections AS c JOIN ad_goods AS g ON c.id = g.collection_id SET c.novice = 'yes' WHERE g.novice = 'yes'");
            $this->db->query("UPDATE ad_collections AS c JOIN ad_goods AS g ON c.id = g.collection_id SET c.action = 'yes' WHERE g.action = 'yes'");
            $this->db->query("UPDATE ad_collections AS c JOIN ad_goods AS g ON c.id = g.collection_id SET c.sale = 'yes' WHERE g.sale = 'yes';");
		} else {
			$this->error =  "File '$fileName' not found.";
			return false;
		}
		return true;
	}
/////////////////////////////////
	public function importGoods_to_order ($fileName) {
		$this->error = null;
		if (is_file($fileName)) {
            //инициализируем списки
            $factories   = $this->db->karr('SELECT id, title FROM ?t', $this->tables['factories'], 1);
            $collections = $this->db->fullKarrQuery('SELECT factory_id, id, title FROM ?t ORDER BY factory_id ASC', $this->tables['collections'], 1);
            $tmp_collections = array();
            foreach ($collections as $f_id => $c) {
                $tmp_collections[$f_id] = array();
                for ($i = 0, $maxi = count($c); $i < $maxi; $i++) {
                    $tmp_collections[$f_id][$c[$i]['id']] = $c[$i]['title'];
                }
            }
            $collections = $tmp_collections;
            unset($tmp_collections);
            $units       = $this->db->karr('SELECT id, title FROM ?t', $this->tables['units'], 1);
            $goods       = $this->db->karr('SELECT id, title FROM ?t', $this->tables['goods_to_order'], 1);
            //сбрасываем конфиг, чтобы не логировать кучу говна
            $this->db->apply_conf(array());

            $nomenclature_h = fopen($fileName, "rt");
            $length = filesize($fileName);

            if ($nomenclature_h == false) {
                $this->error =  "File '$fileName' could not open.";
                return false;
            }
            $titles = fgetcsv($nomenclature_h, null, ";");
            for ($i = 16; $i < count($titles); $i++) {
                $this->Save('prices', array('id' => $i-15, 'title' => iconv('cp1251', 'utf-8', $titles[$i])));
            }
            $i = 0;
            $step = 1000;
            $inserts = array();
            //$this->progress($length, ftell($nomenclature_h), 1);
            while ( ($good = fgetcsv($nomenclature_h, null, ";")) != false ) {
                //$this->progress($length, ftell($nomenclature_h));
                //юникод наше все
                foreach ($good as &$item) {
                    $item = iconv('cp1251', 'utf-8', $item);
                }
                unset($item);

                //добавляем фабрики
                if (!in_array($good[3], $factories)) {
                    $factory_id = $this->Save('factories', array('title' => $good[3]));
                    $factories[$factory_id] = $good[3];
                } else {
                    $factory_id = array_search($good[3], $factories);
                }

                //добавляем коллекцию
                if (!isset($collections[$factory_id]) or !in_array($good[4], $collections[$factory_id])) {
                    $collection_id = $this->Save('collections', array('title' => $good[4], 'factory_id' => $factory_id));
                    $collections[$factory_id][$collection_id] = $good[4];
                    $good[4] = $collection_id;
                } else {
                    $good[4] = array_search($good[4], $collections[$factory_id]);
                }

                //добавляем единицы измерения
                if (!in_array($good[11], $units)) {
                    $unit_id = $this->Save('units', array('title' => $good[11]));
                    $units[$unit_id] = $good[11];
                    $unit_text = $good[11];
                    $good[11] = $unit_id;
                } else {
                    $unit_text = $good[11];
                    $good[11] = array_search($good[11], $units);
                }
                $data = array(
                    'id'  => $good[0],
                    'art' => $good[1],
                    'title' => $good[2],
                    'collection_id' => $good[4],
                    'type' => $good[5],
                    'size' => $good[6],
                    'weight' => str_replace(',', '.', $good[7]),
                    'packCntByUnit' => $unit_text == 'шт' ? str_replace(',', '.', $good[8]) : str_replace(',', '.', $good[9]),
                    'unit_id' => $good[11],
                    'colprice2' => str_replace(',', '.', $good[12]),
                    'price1' => str_replace(',', '.', $good[13]),
                    'price2' => str_replace(',', '.', $good[14]),
                    'max_sk' => str_replace(',', '.', $good[15]),
                    'packCntByCount' => str_replace(',', '.', $good[8]),
                    'packCntByArea' => str_replace(',', '.', $good[9]),
                    'updated' => 'yes',
                );
                $data    = array_map(array($this, 'slashes_hack'), $data);


//                if (empty($goods[$good[0]])) {
                    $inserts[] = implode(", ", array_values($data));

                    //                    $this->Save('goods_to_order', $data);
                    if ($i == $step) {
                        $this->insertGoodsToOrder($data, $inserts);
                        $i = 0;
                        $inserts = array();
                    }
                    $i++;

//                } else {
//                    $this->Save('goods_to_order', $data, array('id' => $good[0]));
//                }
            }
            if (!empty($inserts)) {
                $this->insertGoodsToOrder($data, $inserts);
            }
            $this->db->query("DELETE FROM ".$this->tables['goods_to_order']." WHERE updated = 'no'");
		} else {
			$this->error =  "File '$fileName' not found.";
			return false;
		}
		return true;
	}

	public function importRequestsToOrder ($fileName) {
		$this->error = null;
		if (is_file($fileName)) {
            //сбрасываем конфиг, чтобы не логировать кучу говна
            $this->db->apply_conf(array());

            $nomenclature_h = fopen($fileName, "rt");
//            $length = filesize($fileName);

            if ($nomenclature_h == false) {
                $this->error =  "File '$fileName' could not open.";
                return false;
            }
            $titles = fgetcsv($nomenclature_h, null, ";");

            $i = 0;
            $step = 1000;
            $inserts = array();
            $statuses   = $this->db->karr('SELECT import_id, title FROM ?t', 'ad_requests_statuses', 1);
            //            $this->progress($length, ftell($nomenclature_h), 1);
            while ( ($order = fgetcsv($nomenclature_h, null, ";")) != false ) {
//                $this->progress($length, ftell($nomenclature_h));
                //юникод наше все
                foreach ($order as &$item) {
                    $item = iconv('cp1251', 'utf-8', $item);
                }

                if (!isset($statuses[$order[4]])) continue;
                $date_of_receipt = '';

                if (in_array($statuses[$order[4]], array('nalichie_raschitano', 'nal_rascitano_izmen'))) $date_of_receipt = date('Y-m-d H:i:s');

                unset($item);
                $data = array(
                    'id'  => $order[0],
                    'number_in_bd_artisan' => $order[1],
                    'comments_all' => $order[2],
                    'account_number' => $order[3],
                    'status' => $statuses[$order[4]],
                    'date_of_receipt' => $date_of_receipt,
                );
                $data    = array_map(array($this, 'slashes_hack'), $data);

                $inserts[] = implode(", ", array_values($data));

                if ($i == $step) {
                    $this->insertGoodsToOrder($data, $inserts, 'ad_requests_to_order');
                    $i = 0;
                    $inserts = array();
                }
                $i++;

            }
            if (!empty($inserts)) {
                $this->insertGoodsToOrder($data, $inserts, 'ad_requests_to_order');
            }
		} else {
			$this->error =  "File '$fileName' not found.";
			return false;
		}
		return true;
	}

	public function importGoodsToOrderUpdate ($fileName) {
		$this->error = null;
		if (is_file($fileName)) {
            //сбрасываем конфиг, чтобы не логировать кучу говна
            $this->db->apply_conf(array());

            $nomenclature_h = fopen($fileName, "rt");
//            $length = filesize($fileName);

            if ($nomenclature_h == false) {
                $this->error =  "File '$fileName' could not open.";
                return false;
            }
            $titles = fgetcsv($nomenclature_h, null, ";");

            $i = 0;
            $step = 1000;
            $inserts = array();
//            $this->progress($length, ftell($nomenclature_h), 1);
            while ( ($order = fgetcsv($nomenclature_h, null, ";")) != false ) {
//                $this->progress($length, ftell($nomenclature_h));
                //юникод наше все
                foreach ($order as &$item) {
                    $item = iconv('cp1251', 'utf-8', $item);
                }
                unset($item);
                $data = array(
                    'request_id'  => $order[0],
                    'good_id' => $order[1],
                    'good_price' => str_replace(',', '.', $order[2]),
                    'good_count_new' => str_replace(',', '.', $order[3]),
                    'status' => $order[4],
                    'date_ready' => ($order[5]) ? date('Y-m-d H:i:s', strtotime($order[5])) : '',
                );
                $data    = array_map(array($this, 'slashes_hack'), $data);
                $inserts[] = implode(", ", array_values($data));

                if ($i == $step) {
                    $this->insertGoodsToOrder($data, $inserts, 'ad_requests_goods_to_order');
                    $i = 0;
                    $inserts = array();
                }
                $i++;

            }
            if (!empty($inserts)) {
                $this->insertGoodsToOrder($data, $inserts, 'ad_requests_goods_to_order');
                $this->db->query("UPDATE ad_requests_goods_to_order SET good_count_new = '' WHERE good_count = good_count_new");
            }
		} else {
			$this->error =  "File '$fileName' not found.";
			return false;
		}
		return true;
	}

    public function slashes_hack($e) {
        return "'" . addcslashes(str_replace("'", "''", $e), "\000\n\r\\\032") . "'";
    }

    protected function insertGoodsToOrder($data, $inserts, $tableName = 'ad_goods_to_order') {
        $update = array_map(array($this, 'values_hack'), array_keys($data));
        $sql       = strtr(
            'INSERT INTO {table} ({fields}) VALUES {values} ON DUPLICATE KEY UPDATE {update}', array(
                '{table}'  => $tableName,
                '{fields}' => '`' . implode('`, `', array_keys($data)) . '`',
                '{values}' => '(' . implode('), (', array_values($inserts)) . ')',
                '{update}' => implode(', ', $update),
                                                                                               )
        );
//        echo var_export($sql);

        //        file_put_contents(ROOT_PATH.'console/data/test.sql', $sql);exit;
        $this->db->query($sql);
    }

    public function values_hack($e) {
        return '`' . $e . '` = VALUES(`' . $e . '`)';
    }

    private $time;
    protected function progress($total, $curr, $force = false) {
        if (!$this->time) $this->time = microtime(true) - 1;
        if ($force || $this->time < (microtime(true) - 1)) {
            echo str_repeat("\x08", 50);
            echo $curr.' bytes from '.$total.' = '.ceil($curr*100/$total).'%';
        }
    }

    /**
     * @deprecated Надо использовать getFactories
     * @return mixed
     */
    public function getFactoriesOnOrder() {
        $sql = 'SELECT f.id, f.title FROM ?t AS gto
                LEFT JOIN ?t AS c ON c.id = gto.collection_id
                LEFT JOIN ?t AS f ON f.id = c.factory_id
                WHERE f.title IS NOT NULL GROUP BY f.title';

        return $this->db->query($sql, $this->tables['goods_to_order'], $this->tables['collections'], $this->tables['factories']);
    }

    /**
     * Список фабрик
     * @param bool $onOrder
     *
     * @return mixed
     */
    public function getFactories($onOrder = false) {
        $table = $onOrder ? 'goods_to_order' : 'goods';
        $sql = 'SELECT f.id, f.title
                FROM ?t AS g
                LEFT JOIN ?t AS c ON c.id = g.collection_id
                LEFT JOIN ?t AS f ON f.id = c.factory_id
                WHERE f.title IS NOT NULL GROUP BY f.title';

        return $this->db->query($sql, $this->tables[$table], $this->tables['collections'], $this->tables['factories']);
    }

    /**
     * Список коллекций фабрики
     * @param      $factoryId
     * @param bool $onOrder     Под заказ или не под заказ
     *
     * @return mixed
     */
    public function getCollections($factoryId, $onOrder = false) {
        $table = $onOrder ? 'goods_to_order' : 'goods';
        $sql = 'SELECT c.id, c.title
                FROM ?t AS g
                LEFT JOIN ?t AS c ON c.id = g.collection_id
                WHERE c.title IS NOT NULL AND c.factory_id = ? GROUP BY c.title;';
        return $this->db->query($sql, $this->tables[$table], $this->tables['collections'], $factoryId);
    }

    /**
     * @deprecated Вместо данного метода - getCollections
     * @param $factory_id
     *
     * @return mixed
     */
    public function getCollectionsOnOrder($factory_id) {
        $sql = 'SELECT c.id, c.title FROM ?t AS gto
                LEFT JOIN ?t AS c ON c.id=gto.collection_id
                WHERE c.title IS NOT NULL AND c.factory_id = ? GROUP BY c.title;';

        return $this->db->query($sql, $this->tables['goods_to_order'], $this->tables['collections'], $factory_id);
    }

    public function getGoods($where = array(), $onOrder = false) {
        $table = $onOrder ? 'goods_to_order' : 'goods';
        $goods              = $this->getList($table,
            $this->model('db')->getFieldsNames($table, 'selection'),
            array('where' => $where)
        );
        return $goods;
    }

	public function importStores($fileName)
	{
		$this->error = null;
		if (is_file($fileName)) {
			$stores_h = fopen($fileName, "rt");
			if ($stores_h == false) {
				$this->error =  "File '$fileName' could not open.";
				return false;
			}
			$titles = fgetcsv($stores_h, null, ";");
			$this->db->query('TRUNCATE ?t', $this->tables['stores'], 1);
			while ( ($store = fgetcsv($stores_h, null, ";")) != false ) {
				//юникод наше все
				foreach ($store as &$item) {
					$item = iconv('cp1251', 'utf-8', $item);
				}
				unset($item);
				$data = array(
					'id' => $store[0]+1,
					'title' => $store[1],
					'delivery_date' => $store[2] ? date('Y-m-d', strtotime($store[2])) : null
				);
				switch ($store[3]) {
					case 0:
						$data['status'] = 'main';
					break;
					case 1:
						$data['status'] = 'road';
					break;
					case 2:
						$data['status'] = 'service';
					break;
				}
				$this->Save('stores', $data);
			}
		} else {
			$this->error =  "File '$fileName' not found.";
			return false;
		}
		return true;
	}

	public function importRemains($fileName)
	{
		$this->error = null;
		if (is_file($fileName)) {
			$remains_h = fopen($fileName, "rt");
			if ($remains_h == false) {
				$this->error =  "File '$fileName' could not open.";
				return false;
			}
			$titles = fgetcsv($remains_h, null, ";");
			//сбрасываем конфиг, чтобы не логировать кучу говна
			$this->db->apply_conf(array());
			while ( ($r = fgetcsv($remains_h, null, ";")) != false ) {
				//юникод наше все
				foreach ($r as &$item) {
					$item = iconv('cp1251', 'utf-8', $item);
				}
				unset($item);
				$r[2] = str_replace(',', '.', $r[2]);
				$r[3] = str_replace(',', '.', $r[3]);
				$data = array(
					'good_id' => $r[0],
					'store_id' => $r[1]+1,
					'stock' => $r[2] > 0 ?  $r[2] : 0,
					'reserve' => $r[3] > 0 ?  $r[3] : 0
				);
				$this->db->query(
					'REPLACE INTO ?t (?lt) VALUES (?l)',
					$this->tables['remains'], array_keys($data), $data
				);
			}
		} else {
			$this->error =  "File '$fileName' not found.";
			return false;
		}
		return true;
	}

    public function importRequests($fileName)
    {
        $this->error = null;
        if (is_file($fileName)) {
            $requests_h = fopen($fileName, "rt");
            if ($requests_h == false) {
                $this->error =  "File '$fileName' could not open.";
                return false;
            }
            $titles = fgetcsv($requests_h, null, ";");
            //сбрасываем конфиг, чтобы не логировать кучу говна
            $this->db->apply_conf(array());
            $reqs_to_not_recalc = array(); // этот массив передаст в функцию импорта товаров заявок инфу о том какие заяки НЕ НАДО пересчитывать
            while ( ($r = fgetcsv($requests_h, null, ";")) != false ) {
                //юникод наше все
                foreach ($r as &$item) {
                    $item = iconv('cp1251', 'utf-8', $item);
                }
                unset($item);
                $statuses = $this->db->karr("SELECT import_id, title FROM ad_requests_statuses", 1);
                //debug::dump($statuses);
                /*$statuses = array(
                    1 => 'new',
                    2 => 'reserved',
                    3 => 'unreserved',
                    4 => 'expired',
                    5 => 'partly_pay',
                    6 => 'paid',
                    7 => 'shipment_prep',
                    8 => 'shipment_approved',
                    9 => 'shipment_decline',
                    10 => 'partly_shipped',
                    11 => 'processed',
                );*/
                $data = array(
                    'id' => $r[0],
                    'status' => $statuses[$r[1]],
                    'paid' => $r[2] ? 'yes' : 'no',
                );
                $old_vals = $this->db->fullKarr("SELECT id, status, paid, discount FROM ad_requests WHERE id='".$data['id']."'", 1);
                if($r[3]){
                    if($old_vals[$data['id']]['discount'] != '0'){
                        $this->db->query("UPDATE ad_requests SET discount = '0', mdate = '".date('Y-m-d H:i:s')."' WHERE id = '".$data['id']."'");
                    }
                }
                else{
                    $reqs_to_not_recalc[$data['id']] = $data['id'];
                }
                if($old_vals[$data['id']]['status'] != $data['status'] || $old_vals[$data['id']]['paid'] != $data['paid']){
                    $this->db->query(
                        "UPDATE ad_requests SET status = '".$data['status']."', mdate = '".date('Y-m-d H:i:s')."', paid = '".$data['paid']."' WHERE id = '".$data['id']."'"
                    );
                    if($old_vals[$data['id']]['status'] != $data['status']){
                        $this->db->query(
                            "INSERT INTO ad_requests_history SET old_status = '".$data['status']."', mdate = '".date('Y-m-d H:i:s')."', req_id = '".$data['id']."'"
                        );
                    }
                }
                if ($data['paid'] == 'yes' && $statuses[$r[1]] == 'paid' || $statuses[$r[1]] == 'partly_shipped') {
                    $this->db->query(
                        "UPDATE ad_shipment_goods SET is_blocked = 'no' WHERE req_id ='".$data['id']."'"
                    );
                }
            }
        } else {
            $this->error =  "File '$fileName' not found.";
            return false;
        }
        if(!empty($reqs_to_not_recalc)){
            return $reqs_to_not_recalc;
        }
        else{return true;}
    }
    public function importRequestsGoods($fileName, $not_recalc = 0)
    {
        $this->error = null;
        if (is_file($fileName)) {
            $requests_h = fopen($fileName, "rt");
            if ($requests_h == false) {
                $this->error =  "File '$fileName' could not open.";
                return false;
            }
            $titles = fgetcsv($requests_h, null, ";");
            //сбрасываем конфиг, чтобы не логировать кучу говна
            $this->db->apply_conf(array());
            $changed_requests = array();
            $history = array();
            $new_data = array();
            while ( ($r = fgetcsv($requests_h, null, ";")) != false ) {
                //юникод наше все
                foreach ($r as &$item) {
                    $item = iconv('cp1251', 'utf-8', $item);
                }
                unset($item);
                $data = array(
                    'count' => round(str_replace(',', '.', $r[2]), 4), // excel: kovo
                    'price' => round(str_replace(',', '.', $r[3]), 4), // excel: cena
                    'not_shipped' => round(str_replace(',', '.', $r[4]), 4), // excel: NeOtgr
                    'reserved' => round(str_replace(',', '.', $r[5]), 4), // excel: Bron
                );

                $old_pos = $this->db->fullKarr("SELECT good_id, good_count, good_price, good_not_shipped, good_reserved FROM ad_requests_goods WHERE request_id='".$r[0]."' AND good_id = '".$r[1]."'", 1);

                // если этой пары заявка-товар нет в таблице заявок, то добавить товар к заявке
                $flag_insert_new = 0;
                if (!$old_pos) {
                    $exist_request = $this->db->fullKarr("SELECT 1 FROM ad_requests WHERE id='".$r[0]."'");
                    $exist_good = $this->db->fullKarr("SELECT 1 FROM ad_goods WHERE id='".$r[1]."'");
                    if (!$exist_request || !$exist_good) {
                        continue;
                    }
                    else {
                        $old_pos[$r[1]]['good_count'] = 0;
                        $old_pos[$r[1]]['good_price'] = 0;
                        $old_pos[$r[1]]['good_not_shipped'] = 0;
                        $old_pos[$r[1]]['good_reserved'] = 0;

                        $flag_insert_new = 1;
                    }
                }

                foreach($data as $par => $value){ // проходим по всем импортируемым параметрам
                    if(round($value, 4) != round($old_pos[$r[1]]['good_'.$par], 4) || ($par == 'not_shipped' && $old_pos[$r[1]]['good_'.$par] == null)){ // если значение импорта отличается от значения в таблице ИЛИ это параметр not_shipped и он равен NULL (тогда надо в любом случае обновить)
                        $history[$r[0]][$r[1]][$par] = $old_pos[$r[1]]['good_'.$par];               // пишем это значение в файл истории история(заявка)(позиция)
                    }
                }
                if(isset($history[$r[0]][$r[1]])){
                    $new_data[$r[0]][$r[1]] = $data;
                }
            }
            //debug::dump($history);

            foreach($history as $req_id => $req){
                foreach($req as $pos_id => $pos){
                    if((isset($pos['count']) || isset($pos['price'])) && !isset($saved_reqs[$req_id])){
                        if(!is_array($not_recalc) || !array_key_exists($req_id, $not_recalc)){
                            //debug::dump('ss');
                            $this->saveReqHistory($req_id, $req);
                            $saved_reqs[$req_id] = 1;
                        }
                    }
                    if((isset($pos['not_shipped']) || isset($pos['reserved']))){
                        $sql = "INSERT ad_requests_goods_history SET req_id = '".$req_id."', pos_id = '".$pos_id."'";
                        if(isset($req_changes[$pos_id]['not_shipped'])){
                            $sql .= ", old_not_shipped = '".$pos_id['not_shipped']."'";
                        }
                        if(isset($req_changes[$pos_id]['not_shipped'])){
                            $sql .= ", old_reserved = '".$pos_id['reserved']."'";
                        }
                        $this->db->query($sql);
                    }
                }
            }
            foreach($new_data as $req_id => $req){
                foreach($req as $pos_id => $pos){
                    $insert_data = array();
                    if(isset($history[$req_id][$pos_id]['count']) && !is_array($not_recalc) || (is_array($not_recalc) && !array_key_exists($req_id, $not_recalc))){
                        $dop_data = $this->recalculatePos($pos_id, $pos);
                        $insert_data['good_count'] = $pos['count'];
                        $insert_data['good_count_pack'] = $dop_data['pack'];
                        $insert_data['good_count_unit'] = $dop_data['unit'];
                        $insert_data['good_weight'] = $dop_data['weight'];
                    }
                    if(isset($history[$req_id][$pos_id]['price']) && !is_array($not_recalc) || (is_array($not_recalc) && !array_key_exists($req_id, $not_recalc))){
                        $insert_data['good_price'] = $pos['price'];
                    }
                    if(isset($history[$req_id][$pos_id]['not_shipped'])){
                        $insert_data['good_not_shipped'] = $pos['not_shipped'];
                    }
                    if(isset($history[$req_id][$pos_id]['reserved'])){
                        $insert_data['good_reserved'] = $pos['reserved'];
                    }
                    if(!empty($insert_data)){
                        if ($flag_insert_new) {
                            $sql = "INSERT INTO ad_requests_goods (request_id,good_id,";
                            foreach ($insert_data as $col => $val) {
                                $sql .= $col.',';
                            }
                            $sql = substr($sql, 0, strlen($sql)-1).") VALUES ('".$req_id."','".$pos_id."',";
                            foreach ($insert_data as $col => $val) {
                                $sql .= "'".$val."',";
                            }
                            $sql = substr($sql, 0, strlen($sql)-1).')';
                            $this->db->query($sql);

                            // добавить недостающие поля в таблицу заявок из таблицы товаров
                            $good_info = $this->db->assoc("SELECT art, title, ftitle, packCntByUnit FROM ad_goods WHERE id='".$pos_id."'");
                            $sql = "UPDATE ad_requests_goods SET good_art = '".$good_info['art']."', good_title = '".$good_info['title']."', good_ftitle = '".$good_info['ftitle']."', good_packCntByUnit = '".$good_info['packCntByUnit']."' WHERE request_id='".$req_id."' AND good_id='".$pos_id."'";
                            $this->db->query($sql);
                        }
                        else
                        {
                            $sql = "UPDATE ad_requests_goods SET ";
                            $i = 0;
                            foreach($insert_data as $col => $val){
                                if($i){
                                    $j = ', ';
                                }
                                else{
                                    $j = ' '; $i = 1;
                                }
                                $sql .= $j.$col." = '".$val."'";
                            }
                            $sql .= "WHERE request_id='".$req_id."' AND good_id = '".$pos_id."'";
                            $this->db->query($sql);
                        }
                    }
                }
            }
        } else {
            $this->error =  "File '$fileName' not found.";
            return false;
        }
        return true;
    }
    public function recalculatePos($pos_id, $values){
        $result = array();
        $good_params_res = $this->db->fullKarr("SELECT id, packCntByUnit, packCntByArea, packCntByCount, weight FROM ad_goods WHERE id='".$pos_id."'", 1);
        $good_params = $good_params_res[$pos_id];
        $count_in_pack = $good_params['packCntByUnit'];
        $unit_in_pack = $good_params['packCntByCount'];
        if($good_params['packCntByUnit'] == $good_params['packCntByCount']){
            $count_to_unit = 1;
        }
        else{
            $count_to_unit =  $count_in_pack / $unit_in_pack;
        }
        $result['pack'] = round($values['count'] / $count_in_pack);
        $result['unit'] = round($values['count'] / $count_to_unit);
        $result['weight'] = $good_params['weight']; //round($values['count'] * $good_params['weight'], 4);
        return $result;
    }
    public function saveReqHistory($request_id, $req_changes){
        $positions = $this->db->fullKarr("SELECT good_id, good_count, good_price, good_not_shipped, good_reserved FROM ad_requests_goods WHERE request_id='".$request_id."'", 1);
        $settings_res = $this->db->fullKarr("SELECT id, name, value FROM ad_settings", 1);
        foreach($settings_res as $key => $vals){
            $settings[$vals['name']] = $vals['value'];
        }
        //считаем сумму, дабы узнать, какую скидку применить
        $total_without_discounts = 0;
        foreach($positions as $pos_id => $values){
            $good_params_res = $this->db->fullKarr("SELECT id, packCntByUnit, packCntByArea, packCntByCount, weight FROM ad_goods WHERE id='".$pos_id."'", 1);
            $good_params = $good_params_res[$pos_id];
            if ($settings['round_count'] == 'yes' and $good_params['packCntByUnit'] == $good_params['packCntByArea']) {
                $count = round($values['good_count'] / $good_params['packCntByUnit']) * $good_params['packCntByUnit'];
            } elseif ($good_params['packCntByUnit'] == $good_params['packCntByArea']) {
                $count_in_area = $good_params['packCntByArea']/$good_params['packCntByCount'];
                $count = round(round(strval($values['good_count'] / $count_in_area)) * $count_in_area, 4);
            } elseif ($good_params['packCntByUnit'] == $good_params['packCntByCount']) {
                $count = ceil($values['good_count']);
            } else {
                $count = floatval($values['good_count']);
            }
        }
        $total_without_discounts += round($count * $values['good_price'], 2);
        if ($settings['account4extra_discount'] != 0 and $total_without_discounts >= $settings['account4extra_discount']) {
            $discount = (100 - $settings['extra_discount']) / 100;
            $this->page->extra_discount = true;
        }
        else{
            $discount = (100 - $settings['discount']) / 100;
        }

        $goods_tmp = array();
        $req_tmp = array();
        $arts = array();
        $counts = array();
        $req_tmp['total_weight'] = 0;
        $req_tmp['total'] = 0;
        $req_tmp['count_pos'] = 0;
        $max_stores_count = 0;
        $discount_total = 0;

        foreach($positions as $pos_id => $values){
            $good_params_res = $this->db->fullKarr("SELECT id, packCntByUnit, packCntByArea, packCntByCount, weight FROM ad_goods WHERE id='".$pos_id."'", 1);
            $good_params = $good_params_res[$pos_id];
            $goods_tmp[$pos_id] = $values;
            if ($settings['round_count'] == 'yes' and $good_params['packCntByUnit'] == $good_params['packCntByArea']) {
                $goods_tmp[$pos_id]['count'] = round($values['good_count'] / $good_params['packCntByUnit']) * $good_params['packCntByUnit'];
            } elseif ($good_params['packCntByUnit'] == $good_params['packCntByArea']) {
                $count_in_area = $good_params['packCntByArea']/$good_params['packCntByCount'];
                $goods_tmp[$pos_id]['count'] = round(round(strval($values['good_count'] / $count_in_area)) * $count_in_area, 4);
            } elseif ($good_params['packCntByUnit'] == $good_params['packCntByCount']) {
                $goods_tmp[$pos_id]['count'] = ceil($values['good_count']);
            } else {
                $goods_tmp[$pos_id]['count'] = floatval($values['good_count']);
            }
            $counts[] = $goods_tmp[$pos_id]['count'];
            $arts[] = $pos_id;

            if (isset($goods_tmp[$pos_id])) {
                //скидочка
                $goods_tmp[$pos_id]['discount'] = round($values['good_price'] * $discount, 2);

                //считаем стоимость товара
                $goods_tmp[$pos_id]['discount_total'] = round($goods_tmp[$pos_id]['discount'] * $goods_tmp[$pos_id]['count'], 2);
                $goods_tmp[$pos_id]['total'] = round($goods_tmp[$pos_id]['count'] * $values['good_price'], 2);
                //считаем общую массу
                $goods_tmp[$pos_id]['weight'] = $good_params['weight'] * $goods_tmp[$pos_id]['count'];
                $req_tmp['total_weight'] += $goods_tmp[$pos_id]['weight'];
                //считаем общую стоимость
                $req_tmp['total'] += $goods_tmp[$pos_id]['total'];
                $req_tmp['count_pos'] += 1;
                $discount_total += $goods_tmp[$pos_id]['discount_total'];
                //шаманизм с остатками
                $requests_remains = $this->db->fullKarr("SELECT request_id, stock FROM ad_requests_goods_remains WHERE request_id = '".$request_id."' AND good_id ='".$pos_id."'", 1);
                $goods_tmp[$pos_id]['remains'] = $requests_remains[$request_id]['stock'] - $goods_tmp[$pos_id]['count'];
            }
        }
        //debug::dump($goods_tmp);
        //debug::dump($req_changes);
        //debug::dump($req_tmp);
        foreach($goods_tmp as $pos_id => $values){
            if(isset($req_changes[$pos_id])){
                $sql = "INSERT ad_requests_goods_history SET req_id = '".$request_id."', pos_id = '".$pos_id."'";
                if(isset($req_changes[$pos_id]['count']) || isset($req_changes[$pos_id]['price'])){
                    $sql .= " ".(isset($req_changes[$pos_id]['count']) ? ", old_count = '".$values['good_count']."' " : "").(isset($req_changes[$pos_id]['price']) ? ", old_price = '".$values['good_price']."'" : "").", old_weight = '".$values['weight']."', old_cost = '".$values['total']."', old_remains = '".$values['remains']."'";
                }
                /*if(isset($req_changes[$pos_id]['not_shipped'])){
                    $sql .= ", old_not_shipped = '".$req_changes[$pos_id]['not_shipped']."'";
                }
                if(isset($req_changes[$pos_id]['not_shipped'])){
                    $sql .= ", old_reserved = '".$req_changes[$pos_id]['reserved']."'";
                }*/
                $this->db->query($sql);
                //debug::dump($sql);
            }
        }
        //$old_pos = $this->db->fullKarr("SELECT COUNT(id) AS old_count, stock FROM ad_requests_goods_remains WHERE request_id = '".$request_id."' AND good_id ='".$pos_id."'", 1);
        //$sql = "INSERT ad_requests_history SET req_id = '".$request_id."', old_count_pos = '".$req_tmp['count_pos']."', old_sum = '".$req_tmp['total']."', old_sum_weight = '".$req_tmp['total_weight']."'";
        $sql = "INSERT ad_requests_history SET req_id = '".$request_id."', old_sum = '".$req_tmp['total']."', old_sum_weight = '".$req_tmp['total_weight']."'";
        $this->db->query($sql);
        //debug::dump($sql);
    }

    public function ImportBills($fileName)
    {
        $this->error = null;
        if (is_file($fileName)) {
            $bills_h = fopen($fileName, "rt");
            if ($bills_h == false) {
                $this->error =  "File '$fileName' could not open.";
                return false;
            }
            //сбрасываем конфиг, чтобы не логировать кучу говна
            $this->db->apply_conf(array());
            $reqs = array();
            while ( ($r = fgetcsv($bills_h, null, ";")) != false ) {
                //юникод наше все
                foreach ($r as &$item) {
                    $item = iconv('cp1251', 'utf-8', $item);
                }
                unset($item);
                $data = array(
                    'req_id' => $r[0],
                    'bill_id' => $r[1],
					'date' => $r[2],
					'desc' => $r[3]
                );
                $reqs[$data['req_id']][$data['bill_id']] = $data['bill_id'];
            }
            foreach($reqs as $req_id => $bills){
                $existed_bills = $this->db->fullKarr("SELECT bill_id FROM ad_requests_bills WHERE req_id='".$req_id."'", 1);
                foreach($bills as $bill_id => $bill){
                    if(!array_key_exists($bill_id, $existed_bills)){
                        $this->db->query(
                            "INSERT ad_requests_bills SET bill_id = '".$bill_id."', req_id = '".$req_id."', date = '12.06.2016', desc = 'Описание1' "
                        );
                    }
                }
            }
        } else {
            $this->error =  "File '$fileName' not found.";
            return false;
        }
        return true;
    }

	public function importSimilar($fileName)
	{
		$this->error = null;
		if (is_file($fileName)) {
			$similar_h = fopen($fileName, "rt");
			if ($similar_h == false) {
				$this->error = "File '$fileName' could not open.";
				return false;
			}
			$titles = fgetcsv($similar_h, null, ";");
			//сбрасываем конфиг, чтобы не логировать кучу говна
			$this->db->apply_conf(array());
			while ( ($s = fgetcsv($similar_h, null, ";")) != false ) {
				//юникод наше все
				/* Тут одни ИД, поэтому не будет делать лишние преобразования
				foreach ($s as &$item) {
					$item = iconv('cp1251', 'utf-8', $item);
				}
				unset($item);*/
				$data = array(
					'good_id' => $s[0],
					'sgood_id' => $s[1]
				);
				$this->db->query(
					'REPLACE INTO ?t (?lt) VALUES (?l)',
					$this->tables['similar_goods'], array_keys($data), $data
				);
			}
		} else {
			$this->error = "File '$fileName' not found.";
			return false;
		}
		return true;
	}

	public function truncate($tableName)
	{
		return $this->db->query("TRUNCATE ?t", $this->tables[$tableName], 1);
	}

	public function getStores()
	{
		return $this->db->fullKarr('SELECT `id` AS `key`, `id`, `title`, `delivery_date`, `status` FROM ?t ORDER BY `delivery_date` ASC', $this->tables['stores'], 1);
	}

    public function flushGoods(){
        $this->db->query("UPDATE ".$this->tables['goods']." SET updated = 'no'");
    }

	public function flushGoods_to_order(){
		$this->db->query("UPDATE ".$this->tables['goods_to_order']." SET updated = 'no'");
	}

    public function switchGoodsVisibility($collection_id){
        $collection_visibility = $this->db->query("SELECT c.hidden FROM ?t AS c WHERE c.id = ?", $this->tables['collections'], $collection_id);

        if($collection_visibility[0]['hidden'] == 'no'){
            $new_val = 'yes';
        } else{
            $new_val = 'no';
        }
        debug::dump($new_val);

        $this->db->query("UPDATE ?t AS g SET hidden = ? WHERE g.collection_id = ?", $this->tables['goods'], $new_val, $collection_id);
    }
}