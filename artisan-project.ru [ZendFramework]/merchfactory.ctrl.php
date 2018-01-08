<?php
class MerchfactoryController extends Site_Controller
{	



	public function run()
	{
		
		parent::run();
	}
	
	public function actionDefault()
	{
		$factory_url=$this->app->request->url;
		$tmp = zf::$db->query("SELECT * FROM ad_factories WHERE url ='".$factory_url."'");
		$factory_name=$tmp[0]['title'];
		$factory_id=$tmp[0]['id'];
		
		
		//$this->page->cart=$cart;
		$this->page->head=$factory_name;
			
			
			
		$this->page->merchandising_types = $this->model('db')->getList(
                       'merchandising_types',
                        array('id','title'), array('order' => array('title' => 'ASC'))
                    );
			
			
		$this->page->fabrics = $this->model('db')->getList(
                       'factories',
                        array('id','url','title','country_id'), array('where' => array('hidden' => 'no'), 'order' => array('title' => 'ASC'))
                    );
					
		
		$this->page->collections=$this->model('db')->getList(
                       'collections',
                        array('id','title'), array('where' => array('hidden' => 'no'), 'order' => array('title' => 'ASC'))
                    );			
		
		
		
		
			$paging = array(
				'total' => 0,
				'from' => 0,
				'npp' => 3,
				'base_url' => preg_replace('/page\/\d+\//i', '', $_SERVER['REQUEST_URI']).'page/',
				'url_append' => '/',
				'separator' => ' ',
				'curr_page' => 0,
				'pages' => 0,
				'first' => '|<',
				'prev' => '<',
				'next' => '>',
				'last' => '>|',
				'skip' => ' ... ',
				'linkcount' => 10
			);
			
			
			
			if(strpos($_SERVER['REQUEST_URI'],"page/all") != false)
			{
			
			$paging = array(
				'total' => 0,
				'from' => 0,
				'npp' => 20000,
				'base_url' => preg_replace('/page\/\d+\//i', '', $_SERVER['REQUEST_URI']).'page/',
				'url_append' => '/',
				'separator' => ' ',
				'curr_page' => 0,
				'pages' => 0,
				'first' => '|<',
				'prev' => '<',
				'next' => '>',
				'last' => '>|',
				'skip' => ' ... ',
				'linkcount' => 10
			);
			
			}	
			
			
		
		$paging['from'] = $this->app->request->page > 0 ? ($this->app->request->page-1)*$paging['npp'] : 0;
		
		
		
		//список коллекций определённой фабрики			
		//$this->page->collections_factory=$this->model('db')->getList(
        //               'collections',
        //                array('id','title'), array('where' => array('hidden' => 'no','factory_id' => $factory_id), 'order' => array('title' => 'ASC'))
        //            );
		
		if(strpos($_SERVER['REQUEST_URI'],"page") != false){
			$m=explode("/",trim($_SERVER['REQUEST_URI'],"/"));
			$m=($m[count($m)-1]-1)*3;
		}else{
			$m=0;
		}
		
		if(strpos($_SERVER['REQUEST_URI'],"page/all") != false){
			$m=0;
		
		}
		
		//	echo $paging['total']." = ".$m." = ".$paging['npp'];
			
			
			$tmp=$this->model('db')->getList(
                       'collections',
                        array('id','title'), 
					    	array('where' => array('hidden' => 'no','factory_id' => $factory_id), 'order' => array('title' => 'ASC'))
                    );
			unset($tmp_collections);		
			foreach($tmp as $v){
				$tmp2=$this->model('db')->getList(
                       'merchandising_elements2collections',
                        array('merchandising_element_id','collection_id'), array('where' => array('collection_id' => $v['id']), 'order' => array('merchandising_element_id' => 'ASC'))
                    );	
				if(count($tmp2)>0){
					$tmp_collections[]=$tmp2[0]['collection_id'];
				}
				
				
			}
			
			//echo "<pre>";
			//print_r($tmp_collections);
			//echo "</pre>";		
		
			$this->page->collections_factory=$this->model('db')->getPage(
                       'collections',
                        array('id','title'), 
						$paging['total'], $m, $paging['npp'],
						array('where' => array('hidden' => 'no','factory_id' => $factory_id,'id' => array('IN', $tmp_collections, '(?l)')), 'order' => array('title' => 'ASC'))
                    );
	//
								
		foreach($this->page->collections_factory as $val){
			//echo $val['id']."<br>";
			//список документов для определённой коллекции
			
			$tmp=$this->model('db')->getList(
                       'merchandising_elements2collections',
                        array('merchandising_element_id'), array('where' => array('collection_id' => $val['id']), 'order' => array('merchandising_element_id' => 'ASC'))
                    );
			//echo "<pre>";
			//print_r($tmp);
			//echo "</pre>";
			
			unset($el);			
			foreach($tmp as $val2){
				$el[]=$val2['merchandising_element_id'];	
			}
			
			//echo "<pre>";
			//print_r($el);
			//echo "</pre>";
			
			$tmp2=$this->model('db')->getList(
                       'merchandising_elements',
                        array('id','title','file','image','desc'), array('where' => array('hidden' => 'no', 'id' => array('IN', $el, '(?l)')), 'order' => array('title' => 'ASC'))
                    );
			foreach($tmp2 as $val3){
				$elements[$val['id']][]=$val3;
				
				$tmp3=$this->model('db')->getList(
                       'merchandising_elements2merchandising_types',
                        array('merchandising_type_id'), array('where' => array('merchandising_element_id' => $val3['id']), 'order' => array('merchandising_element_id' => 'ASC'))
                    );
				foreach($tmp3 as $v3){	
					
					$tmp4=$this->model('db')->getList(
                    	   'merchandising_types',
                        	array('id','title'), array('where' => array('id' => $v3['merchandising_type_id']), 'order' => array('id' => 'ASC'))
                    );
					
					$elements_types[$val3['id']][]=$tmp4[0]['title'];
				}
			}
			
		}
					
		$this->page->elements=$elements;
		$this->page->elements_types=$elements_types;
		
		
		
		$paging['pages'] = ceil($paging['total']/$paging['npp']);
			$paging['curr_page'] = $this->app->request->page > 0 ? $this->app->request->page : 1; 
			$this->page->paging = $paging;
						
		/*zf::addJS('profile.show', '/public/site/js/profile.show.js');
		$fields = $this->model('dealers')->getFields('dealers', 'profile');
		$fields['legal_entities'] = $this->model('dealers')->getFields('dealers_legal_entities', 'profile');
		$this->page->fields = $fields;
		$this->page->data = $this->model('dealers')->GetByCond(
			'dealers',
			$this->model('dealers')->getFieldsNames('dealers', 'profile'),
			array('where' => array('dealers.id' => $this->page->dealer['id']))
		);*/
		$this->page->page_content['title']="Мерчандайзинг";
		$this->page->content = $this->renderView('mench_factories');
		$this->loadView('main', null);
	}
	
	public function actionEdit()
	{/*
		//print_r($this->model('dealers')->getFields('dealers', 'edit-profile'));
	//	exit();
		$this->loadForm(
			'profile',
			$this->model('dealers')->getFields('dealers', 'edit-profile'),
			!empty($_POST) ? $_POST : array_map(
				'html_entity_decode',
				$this->model('dealers')->GetByCond(
					'dealers',
					$this->model('dealers')->getFieldsNames('dealers', 'edit-profile'),
					array('where' => array('dealers.id' => $this->page->dealer['id']))
				)
			),
			'',
			'post'
		);
		
		if (!empty($_POST) and $this->form('profile')->validate()) {
			$this->model('dealers')->Save(
				'dealers',
				array_map('htmlspecialchars', $this->form('profile')->getData()),
				$this->page->dealer['id']
			);
			header('Location: '.zf::$root_url.$this->ctrlName.'/');
			exit;
		} elseif (empty($_POST)) {
		} else {
			$this->page->profile_error = $this->form('profile')->getErrors(); 
		}
	//echo $this->renderView('edit');exit();
		$this->page->content = $this->renderView('edit');
		$this->loadView('main', null);
		*/
	}
	
	public function actionEdit_inf()
	{
		/*
		//print_r($this->model('dealers')->getFields('dealers', 'edit-profile'));
	//	exit();
	//$this->model('dealers')->getFields('dealers_legal_entities', 'profile')
		$this->loadForm(
			'profile',
			$this->model('dealers')->getFields('dealers_legal_entities', 'profile'),
			!empty($_POST) ? $_POST : array_map(
				'html_entity_decode',
				$this->model('dealers')->GetByCond(
					'dealers_legal_entities',
					$this->model('dealers')->getFieldsNames('dealers_legal_entities', 'modify'),
					array('where' => array('dealers_legal_entities.dealer_id' => $this->page->dealer['id']))
				)
			),
			'',
			'post'
		);
		//print_r($this->page->dealer);
		$id_curs=array_keys($this->page->dealer['legal_entities']);
		$this->page->id_curs=$id_curs[0];
		if (!empty($_POST) and $this->form('profile')->validate()) {
			$this->model('dealers')->Save(
				'dealers_legal_entities',
				array_map('htmlspecialchars', $this->form('profile')->getData()),
				$this->page->id_curs
			);
			header('Location: '.zf::$root_url.$this->ctrlName.'/');
			exit;
		} elseif (empty($_POST)) {
		} else {
			$this->page->profile_error = $this->form('profile')->getErrors(); 
		}
	//echo $this->renderView('edit');exit();
		$this->page->content = $this->renderView('edit_inf');
		$this->loadView('main', null);
		*/
	}
	public function actionChange_pass()
	{
		/*
		$this->loadForm(
			'change_pass',
			array(
				'oldpass' => array( 
	                'type' => 'text',
	                'htmltype' => 'pass',
	                'title' => 'Старый пароль',
	                'validate' => array('not_empty' => 'Пароль не может быть пустым.'),
	            ), 
	            'pass' => array( 
	                'type' => 'pass',
	                'htmltype' => 'pass',
	                'title' => 'Новый пароль',
	                'validate' => array('not_empty' => 'Пароль не может быть пустым.'),
	            ),
	            "re-pass" => array(
	                'type' => 'pass',
	                'htmltype' => 'pass',
	                'title' => 'Повторите пароль',
	                'validate' => array('re_pass' => 'Пароль и повтор пароля не совпадают.'),
	            )
	        ),
	        $_POST
		);
		$change_pass_error = array();
		if (!empty($_POST) and $this->form('change_pass')->validate()) {
			$change_flag = true;
			if (md5($this->app->request->post['oldpass']) != $this->page->dealer['pass']) {
				$change_flag = false;
				$change_pass_error[] = 'Вы ввели не правльный пароль';
			}
			if (md5($this->app->request->post['oldpass']) == md5($this->app->request->post['pass'])) {
				$change_flag = false;
				$change_pass_error[] = 'Старый и новый пароль не могут совпадать.';
			}
			if (mb_strlen($this->app->request->post['pass']) < 4 ) {
				$change_flag = false;
				$change_pass_error[] = 'Пароль должен быть минимум 4 символа.';
			}
			if (!preg_match('/[a-zа-я]/i', iconv('utf-8', 'cp1251', $this->app->request->post['pass']))) {
				$change_flag = false;
				$change_pass_error[] = 'Пароль должен содержать хотя бы одну букву.';
			}
			if (!preg_match('/\d/i', iconv('utf-8', 'cp1251', $this->app->request->post['pass']))) {
				$change_flag = false;
				$change_pass_error[] = 'Пароль должен содержать хотя бы одну цифру.';
			}
			
			if ($change_flag) {
				$this->model('dealers')->Save(
					'dealers',
					array(
						'pass' => md5($this->app->request->post['pass']),
						'ch_pass_date' => date('Y-m-d H:i:s')
					),
					$this->page->dealer['id']
				);
				header('Location: '.zf::$root_url.$this->ctrlName.'/');
				exit;
			}
		} elseif (empty($_POST)) {
		} else {
			$change_pass_error = array_merge($this->form('change_pass')->getErrors(), $change_pass_error); 
		}
		$this->page->change_pass_error = $change_pass_error;
		$this->page->content = $this->renderView('change_pass');
		$this->loadView('main', null);
		*/
	}
}