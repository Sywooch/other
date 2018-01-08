<?php
require_once 'zf/classes/nestedsets.class.php';
class CatalogModel extends CMS_Model
{
     public $valuesAction = array(
         'action' => array(
             'error_date_comp'   => 'Дата начала акции должна быть меньше даты окончания акции!',
             'error_date_start' => 'Введите дату в поле дата начала акции!',
             'error_date_end' => 'Введите дату в поле дата окончания акции!',
             'error_not_date_end' => 'Введите дату в поле дата окончания акции, так как заполнено поле дата начала акции!',
             'error_not_date_start' => 'Введите дату в поле дата начала акции, так как заполнено поле дата окончания акции!',
             'error_element' => 'Выберите элементы для акции!',
             'error_date_element' => 'Введите даты для акции!'
         ),
         'sale' => array(
             'error_date_comp'   => 'Дата начала распродажи должна быть меньше даты окончания распродажи!',
             'error_date_start' => 'Введите дату в поле дата начала распродажи!',
             'error_date_end' => 'Введите дату в поле дата окончания распродажи!',
             'error_not_date_end' => 'Введите дату в поле дата окончания распродажи, так как заполнено поле дата начала распродажи!',
             'error_not_date_start' => 'Введите дату в поле дата начала распродажи, так как заполнено поле дата окончания распродажи!',
             'error_element' => 'Выберите элементы для распродажи!',
             'error_date_element' => 'Введите даты для распродажи!'
         ),
         'novice' => array(
             'error_date_comp'   => 'Дата появления новинки должна быть меньше даты окончания действия новинки!',
             'error_date_start' => 'Введите дату в поле дата начала действия новинки!',
             'error_date_end' => 'Введите дату в поле дата окончания действия новинки!',
             'error_not_date_end' => 'Введите дату в поле дата окончания действия новинки, так как заполнено поле дата начала действия новинки!',
             'error_not_date_start' => 'Введите дату в поле дата начала действия новинки, так как заполнено поле дата окончания действия новинки!',
             'error_element' => 'Выберите элементы для новинки!',
             'error_date_element' => 'Введите даты для новинки!'
         )
     );
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
        ),
        'collection' => array(
            'keyField'   => 'id',
            'titleField' => 'title',
            'tableName'  => 'collections',
            'cond'       => array()
        )
	);
	public $error = null;
	private $filter = null;


	public function getFilters()
	{
		if ($this->filter === null) {
			$this->filter = array(
				'country' => array(
					'htmltype' => 'select',
					'validate'=> array('is_string' => 'not_a_string'),
					'type' => 'string',
					'title' => 'Страна',
					'null' => '--- Страна ---',
					'values' => $this->db->karr('SELECT id, title FROM ?t ORDER BY title', $this->tables['countries'], 1)
				),
				'purpose' => array(
					'htmltype' => 'select',
					'validate'=> array('is_string' => 'not_a_string'),
					'type' => 'string',
					'title' => 'Назначение',
					'null' => '--- Назначение ---',
					'values' => $this->db->karr('SELECT id, title FROM ?t ORDER BY title', $this->tables['purposes'], 1)
				),
				'type' => array(
					'htmltype' => 'select',
					'validate'=> array('is_string' => 'not_a_string'),
					'type' => 'string',
					'title' => 'Тип',
					'null' => '--- Тип ---',
					'values' => $this->db->karr('SELECT id, title FROM ?t ORDER BY title', $this->tables['types'], 1)
				),
				'material' => array(
					'htmltype' => 'select',
					'validate'=> array('is_string' => 'not_a_string'),
					'type' => 'string',
					'title' => 'Материал',
					'null' => '--- Материал ---',
					'values' => $this->db->karr('SELECT id, title FROM ?t ORDER BY title', $this->tables['materials'], 1)
				),
				'surface' => array(
					'htmltype' => 'select',
					'validate'=> array('is_string' => 'not_a_string'),
					'type' => 'string',
					'title' => 'Поверхность',
					'null' => '--- Поверхность ---',
					'values' => $this->db->karr('SELECT id, title FROM ?t ORDER BY title', $this->tables['surfaces'], 1)
				),
				'style' => array(
					'htmltype' => 'select',
					'validate'=> array('is_string' => 'not_a_string'),
					'type' => 'string',
					'title' => 'Стиль',
					'null' => '--- Стиль ---',
					'values' => $this->db->karr('SELECT id, title FROM ?t ORDER BY title', $this->tables['styles'], 1)
				),
				'color' => array(
					'htmltype' => 'select',
					'validate'=> array('is_string' => 'not_a_string'),
					'type' => 'string',
					'title' => 'Цвет',
					'null' => '--- Цвет ---',
					'values' => $this->db->karr('SELECT id, title FROM ?t ORDER BY title', $this->tables['colors'], 1)
				),
				'collection' => array(
					'htmltype' => 'text',
					'validate'=> array('is_string' => 'not_a_string'),
					'type' => 'string',
					'title' => 'Названиe коллекции'
				)
			);
		}
		return $this->filter;
	}

    public function initValuesForCollections($id_good = NULL)
    {
        $values = $this->values;
        //получаем collection_id и factory_id
        $collec = $this->model('db', 'db')->get($id_good,
            'goods',
            array('collection_id'));
        if (empty($collec['collection_id']))
            return $values;
        $factory = $this->model('db', 'db')->get($collec['collection_id'],
            'collections',
            array('factory_id'));
        //debug::dump($collec); debug::dump($factory);
        if (empty($factory['factory_id']))
            return $values;
        $cond = array('where' => array(
                            'factory_id' => $factory['factory_id'],
                            '!raw' => 'id !='.$collec['collection_id']),
                      'order' => array(
                            'title' => 'ASC'));
        $f_fields = $this->model('db', 'db')->getFieldsNames('collections', 'list_for_good');
        $collec_list = $this->model('db', 'db')->getList('collections', $f_fields, $cond);
        foreach ($collec_list as $val)
        {
            $values['collection'][$val['id']] = $val['title'];
        }
        $this->model('db', 'db')->values = $values;
        return $values;
    }

    public function initValuesForAction($collection_id = NULL)
    {
        $values = $this->values;
        //получаем все товары данной коллекции
        $goods_list = $this->model('db', 'db')->getList(
            'goods',
            array('id', 'title'),
            array(
                'where' => array(
                    'collection_id' => $collection_id
                )
            ));
        $goods_several_coll = $this->model('db', 'db')->getList(
            'goods',
            $this->model('db', 'db')->getFieldsNames('goods', 'search_several_coll'),
            array('where' => array(
                'goods2collectionsNM.collection_id' => $collection_id
            ))
        );
        foreach ($goods_list as $val)
        {
            $values['action_goods_id'][$val['id']] = $val['title'];
            $values['sale_goods_id'][$val['id']] = $val['title'];
            $values['novice_goods_id'][$val['id']] = $val['title'];
        }
        if (!empty($goods_several_coll)){
            foreach ($goods_several_coll as $val)
            {
                $values['action_goods_id'][$val['id']] = $val['title'];
                $values['sale_goods_id'][$val['id']] = $val['title'];
                $values['novice_goods_id'][$val['id']] = $val['title'];
            }
        }
        $this->model('db', 'db')->values = $values;
        return $values;
    }
}