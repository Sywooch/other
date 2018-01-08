<?php
class CommonController extends Site_Common_Controller
{
	public function run()
	{
		
		
		$start = microtime(true);
		//echo "<pre>";
		//print_r($this);
		//echo "</pre>";
		
		
		
		//echo $_COOKIE['PHPSESSID'];
		//echo "<br>";
		//echo session_id();
		
		//ini_set ("session.use_trans_sid", true);
		session_start();
		//$_SESSION['n']="4";
		//echo"<pre>";
		//print_r($_SESSION);
		//echo"</pre>";
		
		$tmp=$this->model('news')->getPage('news',
                $this->model('news')->getFieldsNames('news', 'listing'),
                $total, 0, 3,
                array('where' => array('hidden' => 'no'), 'order' => array('date' => 'desc'))
            );
		echo "tmp= ".count($tmp)."<br>";
		
		
		
	  	for($i=0;$i<count($tmp);$i++){
				$desc=$tmp[$i]['description'];
				$desc=strip_tags($desc);
				$desc=trim($desc);
				//echo "==".$desc."==<br>";
				$desc = $this->getPrewText($desc,10,100);
				$tmp[$i]['description']=$desc;
					
			}	
			
				
		
		$this->page->main_news = $tmp;
		
		//echo "<pre>";
		//print_r($this->page->main_news);
		//echo "</pre>";
		
		
		if ($this->app->request->ajax){
			//Zend_Controller_Action_HelperBroker::removeHelper('viewRenderer');	
			echo "ajax";
		}
		
		
		//восстановление доступа для дилера
		if(isset($_GET['restore_access'])){
			$dealer_id=$_GET['dealer_id'];
			$new_pass=$_GET['new_pass'];
			$code=$_GET['code'];	
			
			$tmp = zf::$db->query("SELECT * FROM ad_dealers_restore_access WHERE dealer_id ='".$dealer_id."' AND code ='".$code."' ");
			
			if(count($tmp)==0){
				//код неверный, кидаем на главную.
				header('Location: /');
				
			}else{
				//код верный - меняем пароль
				$new_pass=md5($new_pass);
				$tmp = zf::$db->query("UPDATE ad_dealers SET pass ='".$new_pass."' WHERE id='".$dealer_id."' ");
				$tmp = zf::$db->query("DELETE FROM ad_dealers_restore_access WHERE dealer_id='".$dealer_id."' ");
				
				$this->page->restore_access="Пароль успешно изменён";
				
			}
			
			
		}
		
		
		
		//корзина
		$this->page->basket="";
		$this->page->basket_goods="";
		$tmp = zf::$db->query("SELECT * FROM ad_basket WHERE session_id ='".session_id()."' ");
		//print_r($tmp[0]);
		$collections=unserialize($tmp[0]['collections']);
		
		$tmp = zf::$db->query("SELECT * FROM ad_basket_goods WHERE session_id ='".session_id()."' ");
		$goods=unserialize($tmp[0]['goods']);
		
		//echo "<pre>";
		//print_r($collections);
		//echo "</pre>";
		$this->page->basket=$collections;
		$this->page->basket_goods=$goods;
		
		
		
		
		
		//выход дилера
		if (isset($this->app->request->parr[0]) and $this->app->request->parr[0] == 'logout') {
			$this->app->session->did = 0;
			//header('Location: '. (!empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : zf::$root_url ));
			header('Location: /');
			exit;
		}
		
		//аутентификация на сайте
		if ($this->app->session->did) {
            $answered_complaint = $this->model('complaints', 'complaints')->getList(
                'complaints',
                array('id'),
                array(
                    'dealer_id' => $this->app->session->did,
                    'status' => 'answered',
                    'status_view' => 'not_readed'
                )
            );
            $this->page->count_answered_complaint = count($answered_complaint);
            $this->page->dealer = $this->model('dealers')->GetByCond(
				'dealers',
				'dealer',
				array('dealers.id' => $this->app->session->did)
			);
			//истек ли пароль
			$s = $this->model('settings')->getDataToForm();
			$ch_pass_time = strtotime($this->page->dealer['ch_pass_date']);
			$ch_pass_time = $ch_pass_time ? $ch_pass_time : 0;
			if (time() - $ch_pass_time > $s['pwd_exp_dealer']*30*24*60*60) {
				if (trim($_SERVER['REQUEST_URI'], '/') != 'profile/change_pass') {
					//header('Location: '.zf::$root_url.'profile/change_pass/');
					//exit;
				}
				$this->page->change_pass_error = array('Срок действия пароля истек, введите новый пароль.');
			}
			//заблокирован ли пользователь
			if ($this->page->dealer['blocked'] == 'yes') {
				$this->app->session->did = 0;
				header('Location: '.zf::$root_url);
				exit;
			}
			
		} else {
			$this->loadForm('login', $this->model('dealers')->getFields('dealers', 'login'), $_POST, '', 'post');
			if ($this->form('login')->validate()) {
				$login_form = $this->form('login')->getData();
				if (($id = $this->model('dealers')->authentification($login_form['login'], $login_form['pass'])) != false) {
					$this->app->session->did = $id;
                    $this->app->session->answer_show = true; // для того чтобы показать сообщение о наличие новых ответов по претензиям
					$this->page->dealer = $this->model('dealers')->GetByCond(
						'dealers',
                        'dealer',
						array('dealers.id' => $id)
					);
					header('Location: '.zf::$root_url.'requests/archive/');
					exit;
				} else {
					$this->page->auth_error = 'Сочетание логин/пароль не найдено.';
				}
			} elseif (empty($_POST)) {
			} else {
				$this->page->auth_error = 'Сочетание логин/пароль не найдено.';
			}
			
			//$this->page->page_content = $this->model('content')->GetByCond('content', array(), array('where' => array('path' => 'auth_dealer_page', 'pid' => 1)));
			$ret = 1;
		}
		
		
		
		/*
		//меню
		//public function getTree($pid = 1, $level = 0, $clevel = 0, $show_hidden = false, $url = '', $addSQL = array())
		$this->page->menu = $this->model('content')->getTree(1, 0, 0, false, rtrim(zf::$root_url, '/'), array('where' => 'AND t1.in_menu = "yes"'));
		//подменю
		$temp = $this->app->request->parr ? $this->app->request->parr : (
				trim($this->app->request->uri, '/')
				? explode('/', trim($this->app->request->uri, '/'))
				: array('/')
		);
		$result = $this->model('content')->getContentByPath($temp);
		if (!empty($result) and $result['pid'] != 0) {
			$submenu = $this->model('content')->getTree($result['id'], 0, 0, false, rtrim($this->app->request->uri, '/'), array('where' => 'AND t1.in_menu = "yes"'));
			if (!empty($submenu)) {
				$this->page->submenu = $submenu;
			} elseif ($result['pid'] != 1) {
				array_pop($temp);
				$this->page->submenu = $this->model('content')->getTree($result['pid'], 0, 0, false, '/'.implode('/', $temp));
			}
		}
		//меню каталога
        $act_filter = false;
        if(isset($_GET['act'])){
            $act_filter = htmlspecialchars($_GET['act']);
        } else{
            if ($this->app->request->action) $act_filter = 'action';
            if ($this->app->request->novice) $act_filter = 'novice';
            if ($this->app->request->sale)   $act_filter = 'sale';
        }
        $this->page->act_type = $act_filter;
		$my_arr=$this->model('db')->getMenu($act_filter);
		*/
		/*if(file_exists($_SERVER['DOCUMENT_ROOT']."/dilers/".$_SESSION['did'].".td")){
				$file=file_get_contents($_SERVER['DOCUMENT_ROOT']."/dilers/".$_SESSION['did'].".td");
				$data=unserialize($file);
				foreach ($my_arr as $k => $val) {
					foreach($val['children'] as $key => $value){
						if(in_array($key,$data)){
							unset ($my_arr[$k]['children'][$key]);
						}
					}
				}
				
		}*/
		//print_r($my_arr);
		
		
		/*	
		$this->page->catalog_menu = $my_arr;
		
		//меню-фильтр каталога
		if (empty($this->app->request->parr[0]) or $this->app->request->parr[0] == 'actions' or $this->app->ctrl->ctrlName != 'catalog') {
			$this->page->spec_filters = $this->model('db')->getSpecFilters();
		} else {
			$this->page->spec_filters = $this->model('db')->getSpecFilters($this->app->request->parr[0]);
		}
		*/
		
		$this->loadForm('simple_search', array(
			'string' => array(
				'type' => 'string',
				'title' => 'Поиск'
			)
		), $_GET, '/search/', 'get');

		// обычные баннеры
		$this->page->top_banners = $this->model('banners')->getList('banners', array('id', 'title', 'descr', 'image', 'url'), array('where' => array('hidden' => 'no', 'type' => 'top', 'type2' => 'normal'), 'order' => array('pos' => 'asc')));
		$this->page->about_gallery = $this->model('banners')->getList('banners', array('id', 'title', 'descr', 'image', 'url'), array('where' => array('hidden' => 'no', 'type' => 'top', 'type2' => 'normal'), 'order' => array('pos' => 'asc')));
		
		$this->page->spec_banners = $this->model('banners')->getList('banners', array('id', 'title', 'descr', 'image', 'url'), array('where' => array('hidden' => 'no', 'type' => 'spec', 'type2' => 'normal'), 'order' => array('pos' => 'asc')));
		$this->page->through_banners = $this->model('banners')->GetByCond('banners', array('id', 'title', 'descr', 'image', 'url'), array('where' => array('hidden' => 'no', 'type' => 'through', 'type2' => 'normal'), 'order' => array('pos' => 'asc')));

        // дилерские баннеры
        if ($this->page->dealer) {
            $this->page->dealers_top_banners = $this->model('banners')->getList('banners', array('id', 'title', 'descr', 'image', 'url'), array('where' => array('hidden' => 'no', 'type' => 'top', 'type2' => 'dealers'), 'order' => array('pos' => 'asc')));
        }
		
		
		if($this->app->request->uri=="/"){
		
		//слайды для слайдера на главной
		$this->page->main_slider = $this->model('banners')->getList('main_slider', array('title', 'description', 'link', 'image'), array('order' => array('pos' => 'asc'),'limit' => '4','where' => array('hidden' => 'no')));
       // $this->page->main_slider = $this->model('banners')->getList('banners2', array('id', 'title', 'descr', 'image', 'url'), array('order' => array('id' => 'asc')));
		
		}
		
		
		
		
		//нижнее меню
		$this->page->bottom_menu = $this->model('menu')->getList('bottom_menu', array('text', 'link'), array('order' => array('id' => 'asc')));

		//верхнее меню
		$this->page->top_menu = $this->model('menu')->getList('top_menu', array('id', 'text', 'link', 'parent'), array('order' => array('id' => 'asc')));


		
		
		$message_block_text1 = zf::$db->query("SELECT text1, text2 FROM ad_message_blocks WHERE id ='1' LIMIT 1");
		$this->page->message_block_text1=$message_block_text1[0]['text1'];
		$this->page->message_block_text2=$message_block_text1[0]['text2'];

		//++++++++++++++++++++++++++++++++++++++++++
		
		if( strpos($this->app->request->uri,'merchandising')!=false || strpos($this->app->request->uri,'merchfactory')!=false || strpos($this->app->request->uri,'merchtype')!=false){
			
			$this->page->purposes=$this->model('db')->getList('purposes', array('id', 'title', 'detail_title', 'image'), array('order' => array('detail_title' => 'asc')));	
			echo "purposes= ".count($this->page->purposes)."<br>";
			$main_catalog=$this->model('db')->getList('merch_main_catalogs', array('file'), array('order' => array('id' => 'asc')));	
			echo "main_catalog= ".count($main_catalog)."<br>";
			$this->page->main_catalog=$main_catalog[0]['file'];
			
			
		}
		
		
		
		if( (trim($this->app->request->uri, '/')=='cat')||(strpos($this->app->request->uri,'cat/id')!=false)|| (strpos($this->app->request->uri,'search')!=false)|| (strpos($this->app->request->uri,'cat')!=false) ){
		//страница каталога или страница товара	
		
		
		$this->page->purposes=$this->model('db')->getList('purposes', array('id', 'title', 'detail_title', 'image'), array('order' => array('detail_title' => 'asc')));
		echo "purposes= ".count($this->page->purposes)."<br>";
		$tmp_1="";
		
		//echo "purposes- ".count($this->page->purposes)."<br>";
		
		//$this->page->purposes_count=$this->model('db')->
		foreach ($this->page->purposes as $value) {
    		
			$count_tmp=0;
			$count_tmp=$this->model('db')->getList('collections2purposes', array('purpose_id'), array('where' => array('purpose_id' => ''.$value["id"].'')));
			
			//$this->db->query("SELECT COUNT(*) FROM ad_goods WHERE purponses=".$value["id"]."");
			
			$tmp_1 = $tmp_1.",".$value["id"].":".count($count_tmp);
			
			//идентификатор назначения - наименование назначения
			$purposes_1[$value["id"]]=$value['detail_title'];
			
			
			//$purposes_image_tmp=$this->model('db')->getList('images2purposes', array('images'), array('where' => array('purpose_id' => ''.$value["id"].'')));
			
			//идентификатор назначения - картинка назначения
			$purposes_image[$value["id"]]=$value['image'];
			//echo $purposes_image[$value["id"]]."==";
			
		}
		
		$this->page->purposes_image=$purposes_image;
		$this->page->purposes_count=$tmp_1;
		$this->page->purposes_1=$purposes_1;
		
		
		//echo "<pre>";
		//print_r($this->app->request[]);
		//echo "</pre>";
		//echo ;
		
		$collections2purposes_1=$this->model('db')->getList('collections2purposes', array('purpose_id','collection_id'), array('order' => array('purpose_id' => 'ASC'), 'where' => array('collection_id' => $this->app->request->id)));
		echo "collections2purposes_1= ".count($collections2purposes_1)."<br>";
		foreach ($collections2purposes_1 as $value1) {
			$purposes_detail2[$value1['collection_id']][]=$purposes_1[$value1['purpose_id']];
	
			//идентификатор коллекции - идентификаторы назначения
			unset($purposes_collections[$value1['collection_id']]);
			$purposes_collections[$value1['collection_id']][]=$value1['purpose_id'];
			
			
			
		}
		
		
		
		
		
		
		$this->page->surfaces=$this->model('db')->getList('surfaces', array('id', 'title', 'detail_title', 'image'), array('order' => array('title' => 'asc')));
		$this->page->colors=$this->model('db')->getList('colors', array('id', 'title', 'detail_title', 'color'), array('order' => array('title' => 'asc')));
		$this->page->styles=$this->model('db')->getList('styles', array('id', 'title', 'detail_title', 'image'), array('order' => array('title' => 'asc')));
		echo "surfaces= ".count($this->page->surfaces)."<br>";
		echo "colors= ".count($this->page->colors)."<br>";
		echo "styles= ".count($this->page->styles)."<br>";
		
		$this->page->materials=$this->model('db')->getList('materials', array('id', 'title', 'detail_title', 'image'), array('order' => array('title' => 'asc')));
		
		echo "materials= ".count($this->page->materials)."<br>";
		
		$tmp_1="";
		
		foreach ($this->page->materials as $value4) {
    		
			$count_tmp=0;
			$count_tmp=$this->model('db')->getList('collections2materials', array('material_id'), array('where' => array('material_id' => ''.$value4["id"].'')));
			
			//$this->db->query("SELECT COUNT(*) FROM ad_goods WHERE purponses=".$value["id"]."");
			
			$tmp_1 = $tmp_1.",".$value4["id"].":".count($count_tmp);
			
			//идентфикатор материала - наименование материала
			$materials_1[$value4["id"]]=$value4["detail_title"];
			
			
			//$materials_image_tmp=$this->model('db')->getList('images2materials', array('images'), array('where' => array('material_id' => ''.$value4["id"].'')));
			//идентификатор материала - изображение материала
			$materials_image[$value4["id"]]=$value4["image"];
			
			
		}
		$this->page->materials_image=$materials_image;
		$this->page->materials_count=$tmp_1;
		$this->page->materials_1=$materials_1;
		
		//страница каталога или страница товара	
		}
		
		
		
		
		
		
		
		
		
		
		
		//---------------------------------------------------
		
		
		
		
		$this->page->countries=$this->model('db')->getList('countries', array('id,url,title,import_title,flag'), array('order' => array('import_title' => 'asc')));
		
		echo "countries= ".count($this->page->countries)."<br>";
		
		//---------------------------------------------------
		
		
		
		if( strpos($this->app->request->uri,'cat/id')!=false || (strpos($this->app->request->uri,'search')!=false)){
		//детальная страница коллекции	
		
		$collections2materials_1=$this->model('db')->getList('collections2materials', array('material_id','collection_id'), array('order' => array('material_id' => 'ASC'), 'where' => array('collection_id' => $this->app->request->id)));
		
		echo "collections2materials_1= ".count($collections2materials_1)."<br>";
		
		foreach ($collections2materials_1 as $value1) {
			//идентфикатор коллекции - наименования материалов
			$materials_detail2[$value1['collection_id']][]=$materials_1[$value1['material_id']];
			
			
			//идентификатор коллекции - идентификаторы материалов
			$materials_collections[$value1['collection_id']]="";
			$materials_collections[$value1['collection_id']]=$materials_collections[$value1['collection_id']].", ".$value1['material_id'];
			$materials_collections[$value1['collection_id']]=trim($materials_collections[$value1['collection_id']]);
			$materials_collections[$value1['collection_id']]=trim($materials_collections[$value1['collection_id']],",");
			$materials_collections[$value1['collection_id']]=trim($materials_collections[$value1['collection_id']]);
					
		}
		$this->page->purposes_detail2=$purposes_detail2;
		$this->page->materials_detail2=$materials_detail2;
		
		//детальная страница коллекции	
		}
		
		
		
		
		//---------------------------------------------------
		
		
		
		if( (strpos($this->app->request->uri,'cat/id'))!=false || (trim($this->app->request->uri, '/')=='cat')|| (strpos($this->app->request->uri,'cat')!=false) ){
		//детальная страница коллекции
		
		$based_sizes=$this->model('db')->getList('based_sizes', array('id', 'title'), array('order' => array('title' => 'asc')));
		//echo "based_sizes- ".count($this->page->based_sizes)."<br>";
		
		echo "based_sizes= ".count($based_sizes)."<br>";
		
		foreach ($based_sizes as $value1) {
			//идентфикатор базового размера - наименование базового размера
			$based_sizes_1[$value1["id"]]=$value1["title"];
			//echo $value1["id"]." - ".$value1["title"];
		}
		$this->page->based_sizes=$based_sizes;
		$this->page->based_sizes_1=$based_sizes_1;
		
		}
		
		
		
		//---------------------------------------------------
		
		
		
		if( (strpos($this->app->request->uri,'cat/id'))!=false || (strpos($this->app->request->uri,'search')!=false) ){
		//детальная страница коллекции
		
		
		if((strpos($this->app->request->uri,'cat/id'))!=false ){
			$collections2based_sizes_1=$this->model('db')->getList('based_sizes2collections', array('collection_id','based_size_id'), array('order' => array('collection_id' => 'ASC'),'where' => array('collection_id' => $this->app->request->vars['id'])));
			echo "collections2based_sizes_1= ".count($collections2based_sizes_1)."<br>";
		
			foreach ($collections2based_sizes_1 as $value1) {
				//идентификатор коллекции - наименование базового размера
				$based_sizes_detail2[$value1['collection_id']][]=$based_sizes_1[$value1['based_size_id']];
			
			
			}
			$this->page->based_sizes_detail2=$based_sizes_detail2;
		
		}
		
		//детальная страница коллекции
		}
		
		
		
		
		//---------------------------------------------------
		
		
		
		
		if( (trim($this->app->request->uri, '/')=='cat') || (strpos($this->app->request->uri,'cat')!=false) ||  (trim($this->app->request->uri,"/")=='merchandising') ){
		//страница каталога
		
		
		
		if(strpos($this->app->request->uri,'cat/id')==false){
		
		
		if((strpos($this->app->request->uri,'cat/country')!=false)){
		
		
		$tmp_country = $this->model('db')->getList(
                      'countries',
                       array('id','url','title'), array('where' => array('url' => $this->app->request->parr[1]), 'order' => array('id' => 'ASC'))
                   );
		echo "tmp_country= ".count($tmp_country)."<br>";
		
		$this->page->fabrics1 = $this->model('db')->getList(
                       'factories',
                        array('id','url','title','country_id'), array('where' => array('hidden' => 'no','country_id' => $tmp_country[0]['id']), 'order' => array('country_id' => 'ASC','title' => 'ASC'))
                    );
		echo "fabrics1= ".count($this->page->fabrics1)."<br>";			
		}else{
		$this->page->fabrics1 = $this->model('db')->getList(
                       'factories',
                        array('id','url','title','country_id'), array('where' => array('hidden' => 'no'), 'order' => array('country_id' => 'ASC','title' => 'ASC'))
                    );
		echo "fabrics1= ".count($this->page->fabrics1)."<br>";	
					
			
		}
		
		
					
		
					
		
		$this->page->fabrics2 = $this->model('db')->getList(
                       'factories',
                        array('id','title','country_id'), array('order' => array('title' => 'ASC'))
                    );
		echo "fabrics2= ".count($this->page->fabrics2)."<br>";	
		
		
		}
		
		
		
		
		$this->page->countries1 = $this->model('db')->getList(
                       'countries',
                        array('id','import_title','flag'), array('order' => array('id' => 'ASC'))
                    );
		echo "countries1= ".count($this->page->countries1)."<br>";	
		
		//страница каталога
		}
		
		
		
		//---------------------------------------------------
		
		
		
		
		if( ($this->app->request->uri=="/")||((trim($this->app->request->uri, '/')=='cat')) ){
		//главная страница или страница каталога
		$limit_sale='1000';
		$limit_new='1000';
		$limit_action='1000';
		
		if($this->app->request->uri=="/"){
			$limit_sale='8';
			$limit_new='8';
			$limit_action='8';
			
		}else if(trim($this->app->request->uri, '/')=='cat'){
			$limit_sale='8';
			$limit_new='8';
			$limit_action='8';
		}
		
		$this->page->collections_sale = $this->model('db')->getList(
                       'collections',
                        array('id','factory_id','title','novice','sale','action','url','image'), array('where' => array('hidden' => 'no','sale' => 'yes'), 'order' => array('title' => 'ASC'), 'limit' => $limit_sale)
                    );
		echo "collections_sale= ".count($this->page->collections_sale)."<br>";
					
		$this->page->collections_new = $this->model('db')->getList(
                       'collections',
                        array('id','factory_id','title','novice','sale','action','url','image'), array('where' => array('hidden' => 'no','novice' => 'yes'), 'order' => array('title' => 'ASC'), 'limit' => $limit_new)
                    );
		echo "collections_new= ".count($this->page->collections_new)."<br>";			
		
		$this->page->collections_action = $this->model('db')->getList(
                       'collections',
                        array('id','factory_id','title','novice','sale','action','url','image'), array('where' => array('hidden' => 'no','action' => 'yes'), 'order' => array('title' => 'ASC'), 'limit' => $limit_action)
                    );
		echo "collections_action= ".count($this->page->collections_action)."<br>";
		
		//главная страница или страница каталога
		}
					
					
					
		//---------------------------------------------------
			
		
			
					
		//
		$countries_temp=$this->model('db')->getList(
                       'countries',
                        array('id','import_title','flag','url'), array('order' => array('id' => 'ASC'))
                    );			
		echo "countries_temp= ".count($countries_temp)."<br>";
		
		foreach($countries_temp as $value) {	
			$list_countries[$value["id"]]=$value["import_title"];
			$list_countries_url[$value["id"]]=$value["url"];
			//list_factories3
			//идентфикатор страны = флаг
			$list_countries_flag[$value["id"]]=$value["flag"];
			
			//echo $value["id"]." -- ".$value["import_title"]."<br>";
		}
		
		$this->page->list_countries_flag=$list_countries_flag;
		
		
		
		//---------------------------------------------------
		
		
		
		if ((strpos($this->app->request->uri,'cat/id')!=false) || (trim($this->app->request->uri, '/')=='cat') || ($this->app->request->uri=="/") || (strpos($this->app->request->uri,'search')!=false)|| (strpos($this->app->request->uri,'merchandising')!=false)) {		
		//детальная страница коллекции			
					
		//получение списка  factory_id:factory_title
		$factories1=$this->model('db')->getList(
                       'factories',
                        array('id','title','country_id','url'), array('where' => array('hidden' => 'no'), 'order' => array('title' => 'ASC'))
                    );
		echo "factories1= ".count($factories1)."<br>";
		
		$list_factories="";		
		foreach($factories1 as $value) {
			$list_factories=$list_factories.",".$value["id"].":".$value["title"];
			
			// идентификатор фабрики - наименование фабрики
			$list_factories2[$value["id"]]=$value["title"];
			
			//идентификатор фабрики - ссылка на страницу фабрики
			$list_factories2_url[$value["id"]]=$value["url"];
			
			$list_factories2_collections=$this->model('db')->getList(
                       'collections',
                        array('id','title'), array('where' => array('hidden' => 'no','factory_id' => $value["id"]), 'order' => array('title' => 'ASC'))
                    );
			foreach($list_factories2_collections as $value2) {
				//список коллекций оппределённой фабрики
				$list_fabric_collections[$value['id']][]=$value2['title'];
				$list_fabric_collections_id[$value['id']][]=$value2['id'];
			}
			
			
			$list_countries2[$value["id"]]=$list_countries[$value["country_id"]];
			
			//идентификатор фабрики - ссылка на страну
			$list_countries2_url[$value["id"]]=$list_countries_url[$value["country_id"]];
			
			//идентификатор фабрики - картинка флага страны этой фабрики
			$list_factory_flag[$value["id"]]=$list_countries_flag[$value["country_id"]];
		}
		
		
		$this->page->list_factories2_url=$list_factories2_url;
		$this->page->list_fabric_collections_id=$list_fabric_collections_id;
		$this->page->list_fabric_collections=$list_fabric_collections;
		$this->page->merchandising_factories=$factories1;
		//echo count($this->page->merchandising_factories)."-f5 ";
		
		$this->page->list_factories=$list_factories;
		$this->page->list_factories2=$list_factories2;
		$this->page->list_countries2=$list_countries2;
		$this->page->list_factory_flag=$list_factory_flag;
		$this->page->list_countries2_url=$list_countries2_url;
		//детальная страница коллекции
		}
		
		
			
		
		//---------------------------------------------------
		
		
		
		if( (strpos($this->app->request->uri,'cat/id')!=false) || (trim($this->app->request->uri, '/')=='cat') || ($this->app->request->uri=="/") || (strpos($this->app->request->uri,'cat')!=false) || (strpos($this->app->request->uri,'search')!=false) ){
		//детальная страница коллекции
		
		
		
		
		$collections_list=$this->model('db')->getList(
                       'collections',
                        array('id','title','factory_id','novice','sale','action','image'), array('where' => array('hidden' => 'no'), 'order' => array('title' => 'ASC'))
                    );
		
		echo "collections_list= ".count($collections_list)."<br>";			
		
		foreach($collections_list as $value) {
			$list_collections[$value["id"]]=$value["title"];
			$list_factories3[$value["id"]]['name']=$list_factories2[$value["factory_id"]];
			$list_factories3[$value["id"]]['url']=$list_factories2_url[$value["factory_id"]];
			
			//идентфикатор коллекции - картинка флага страны
			$list_countries_flag3[$value["id"]]=$list_factory_flag[$value["factory_id"]];
			$list_collection_sale[$value["id"]]=$value["sale"];
			$list_collection_novice[$value["id"]]=$value["novice"];
			$list_collection_action[$value["id"]]=$value["action"];
			$list_collections_images[$value["id"]]=$value["image"];
			
			$list_collections_images2=$this->model('db')->getList(
                       'images',
                        array('id','image'), array('where' => array('hidden' => 'no','model' => 'collections','pid' => $value["id"]), 'order' => array('id' => 'ASC'))
                    );
			foreach($list_collections_images2 as $value2) {
				//echo $value["id"]."=";
				$detail_images_list[$value["id"]][]=$value2['image'];
				
			}
		
			//идентификатор коллекции - идентификатор фабрики
			$list_collection_factory[$value["id"]]=$value["factory_id"];
			
			
			//$list_collection_goods[$value["id"]]
			
			//########
			$goods_tmp=$this->model('db')->getList(
                       'goods',
                        array('id','title','art','photo','collection_id'), array('order' => array('id' => 'DESC'),'where' => array('hidden' => 'no','collection_id' => $value["id"]))
                    );
					
			//# $list_collections_goods_purposes[идентификатор коллекции][идентфикатор товара]=назначение товара
			//вытащить все товары коллекции
					
			foreach($goods_tmp as $value2) {	
			
				
				
				$list_goods_prices_1=$this->model('db')->getList(
                       'prices2goods',
                        array('price'), array('where' => array('good_id' => $value2["id"],'price_id' => '1'))
                    );
				foreach($list_goods_prices_1 as $value3) {
			
					//идентфикатор коллекции -> цена товара
					$list_collections_prices[$value["id"]][]=$value3['price'];
					//echo $value["id"]." -- ".$value3['price']."<br>";
				}
				
				
				//получить назначение товара
				$list_goods_purposes_1=$this->model('db')->getList(
                       'goods2purposes',
                        array('purpose_id'), array('where' => array('good_id' => $value2["id"]))
                    );
				//echo count($list_goods_purposes_1)."<br>";	
					
				foreach($list_goods_purposes_1 as $value3) {
					//$list_collections_goods_purposes[$value["id"]][$value2["id"]]="";
					//[идентификатор коллекции][идентификатор товара]=идентификатор назначения товара
					$list_collections_goods_purposes[$value["id"]][$value2["id"]][]=$value3["purpose_id"];
					
					//echo $value["id"]."--".$value2["id"]."--".$value3["purpose_id"]."<br>";
					
				}
				
				
				
				
			}
			
			
		
		}
		
			
		//блок "мерчандайзинг" на детальной странице коллекции
		$collections2merchandising_docs=$this->model('db')->getList(
                      'merchandising_elements2collections',
                       array('merchandising_element_id'), array('where' => array('collection_id' => $this->app->request->vars['id']))
                   );
		echo "collections2merchandising_docs= ".count($collections2merchandising_docs)."<br>";		
		
		foreach($collections2merchandising_docs as $value3) {
			
				
			$merchandising_docs=$this->model('db')->getList(
                      'merchandising_elements',
                       array('id','title','file','image','desc'), array('where' => array('id' => $value3['merchandising_element_id'],'hidden' => 'no'))
                   );
			  
			foreach($merchandising_docs as $value4) {
				
				$merchandising_docs_detail[]=$value4;
			
				
			}
				
				
		}
			
		
		$this->page->merchandising_docs_detail=$merchandising_docs_detail;
		$this->page->list_collections_goods_purposes=$list_collections_goods_purposes;
		
		$this->page->list_collections_prices=$list_collections_prices;
		$this->page->list_collection_factory=$list_collection_factory;
		
		
		
		$this->page->detail_images_list=$detail_images_list;
		$this->page->list_collections_images=$list_collections_images;
		
		$this->page->list_collection_sale=$list_collection_sale;
		$this->page->list_collection_novice=$list_collection_novice;
		$this->page->list_collection_action=$list_collection_action;
		
		$this->page->list_collections=$list_collections;
		$this->page->list_factories3=$list_factories3;
		$this->page->list_countries_flag3=$list_countries_flag3;
		
		
		
		
		
		
		//детальная страница коллекции
		}
		
		
		
		//---------------------------------------------------
		
		$this->page->fabrics3 = $this->model('db')->getList(
                       'factories',
                        array('id','url','title','country_id'), array('where' => array('hidden' => 'yes'), 'order' => array('title' => 'ASC'))
                   );
		echo "fabrics3= ".count($this->page->fabrics3)."<br>";	
		
		if(strpos($this->app->request->uri,'requests')!=false){
		//личный кабинет
		
	
		$fabrics1 = $this->model('db')->getList(
                       'factories',
                        array('id','url','title','country_id'), array('where' => array('hidden' => 'no'), 'order' => array('country_id' => 'ASC','title' => 'ASC'))
                    );
		
		echo "fabrics1= ".count($fabrics1)."<br>";
		
		foreach($collections_list2 as $value) {
			$list_collections2[$value["id"]]=$value["title"];
			
			//echo $list_factories2[$value["factory_id"]]."<br>";
		
		}

			//список всех коллекций, в том числе и скрытых
			//print_r($_GET);
		if(isset($_GET['fabrics']) && $_GET['fabrics']!="" && isset($_GET['rtupe']) && $_GET['rtupe']!=""){
			//$db='collections';
			$hid='no';
			if($_GET['rtupe']=="reservation"){
				$hid='yes';
			}
			
		$list_collections2=$this->model('db')->getList(
                       'collections',
                        array('id','title'), array('where' => array('hidden' => $hid,'factory_id' => $_GET['fabrics']), 'order' => array('title' => 'ASC'))
            );
		echo "list_collections2= ".count($list_collections2)."<br>";
		$this->page->list_collections2=$list_collections2;
		echo ' <option value="">'.iconv("utf-8","windows-1251","Выберите").'</option>';
		foreach($list_collections2 as $vals){
			echo '<option value="'.$vals['id'].'">'.$vals['title'].'</option>';
			
		}
		exit();
		}
		
		
		if((isset($_GET['colllection']) && $_GET['colllection']!="" && isset($_GET['rtupe']) && $_GET['rtupe']!="") or (isset($_GET['searts']) && $_GET['searts']=="1")){
			
			
		if(isset($_POST['arts']) && $_POST['arts']!=""){
				$db='goods';
				//$hid='no';
				if($_POST['rtupe']=="reservation"){
					$db='goods_to_order';
				}
				$goodsss=$this->model('db')->getList(
                       $db,
                        array('id','title','art','photo','collection_id','unit_id','weight','packCntByUnit','packCntByArea','packCntByCount'), array('order' => array('id' => 'DESC'),'where' => array('hidden' => 'no','art' =>array('LIKE', '%'.$_POST['arts'].'%', "?") )) 
                    );
			//print_r($_POST);
		}else{
			if(isset($_POST['namma']) && $_POST['namma']!=""){
				$db='goods';
				//$hid='no';
				if($_POST['rtupe']=="reservation"){
					$db='goods_to_order';
				}
					$goodsss=$this->model('db')->getList(
                       $db,
                        array('id','title','art','photo','collection_id','unit_id','weight','packCntByUnit','packCntByArea','packCntByCount'), array('order' => array('id' => 'DESC'),'where' => array('hidden' => 'no','title' => array('LIKE', '%'.$_POST['namma'].'%', "?")))
                    );	
				
			}else{
			$db='goods';
			//$hid='no';
			if($_GET['rtupe']=="reservation"){
				$db='goods_to_order';
			}
		$goodsss=$this->model('db')->getList(
                       $db,
                        array('id','title','art','photo','collection_id','unit_id','weight','packCntByUnit','packCntByArea','packCntByCount'), array('order' => array('id' => 'DESC'),'where' => array('hidden' => 'no','collection_id' => $_GET['colllection']))
                    );
		}}

		foreach($goodsss as $k => $value1) {
			//идентификатор товара - наименование коллекции
			//echo $list_collections[3630]."<br>";
			//echo 
			$goodsss[$k]['photo']='/public/userfiles/goods/original/'.$value1['id'].'.jpg';
			$collections_1[$value1["id"]]=$list_collections2[$value1["collection_id"]];
			//echo $collections_1[$value1["id"]]."<br>";
			
			//echo $value1["id"];
			$prices1=$this->model('db')->getList(
                       'prices2goods',
                        array('price'), array('where' => array('good_id' => $value1["id"],'price_id'=>$this->page->dealer['price_id']))
                    );
					//print_r($prices1);
					//echo $this->page->dealer['price_id'];
			//foreach($prices1 as $value2) {
			
				//идентфикатор товара -> цена товара
				$prices_1[$value1["id"]]=$prices1[0]['price'];
				
				//echo $prices_1[$value1["id"]]." -- ".$value1["id"]."<br>";	
			
			//}
			
			$remains1=$this->model('db')->getList(
                       'remains',
                        array('store_id','stock','reserve'), array('where' => array('good_id' => $value1["id"]))
                    );
			foreach($remains1 as $value2) {
				if($value2['store_id']==1){
					$stock_1[$value1["id"]]['ad']=$value2['stock'];
					$reserve_1[$value1["id"]]['ad']=$value2['reserve'];
				}else{
					$stock_1[$value1["id"]]['stock']=$value2['stock'];
					$reserve_1[$value1["id"]]['store']=$value2['store_id'];
					$reserve_1[$value1["id"]]['reserve']=$value2['reserve'];
				}
				//echo $prices_1[$value1["id"]]."<br>";	
			}
			
			
			
			$delivery_date1=$this->model('db')->getList(
                       'stores',
                        array('delivery_date'), array('where' => array('id' => $reserve_1[$value1["id"]]['store']))
                    );
					
					
			foreach($delivery_date1 as $value2) {
				
				//идентификатор товара - дата ближайшей поставки
				$delivery_date_12[$value1["id"]]=$value2['delivery_date'];
				
				
				//echo $prices_1[$value1["id"]]."<br>";	
			}
		}
		//print_R($delivery_date_12);
		$propers='';
		//print_r($goodsss);
		if(isset($_GET['zakaz']) && $_GET['zakaz']==1){$propers='<span class="underTheOrderMarker">под заказ</span>';}
		foreach($goodsss as $key =>$val){
		
		echo iconv("utf-8","windows-1251",'<div class="itemWrap">
                            <div class="item">
                                <div class="removeFromList"></div>
								<input type="checkbox" class="">
                                <input name="ids[]" type="hidden" value="'.$val['id'].'" class="">
								<input name="art[]" type="hidden" value="'.$val['art'].'" class="">
                                <label for="">
                                    <div class="shippingInfo">
                                        <div class="line">
                                            <div class="box">
                                                <p>'.$val['title'].' '.$propers.'</p>
                                                <span class="number itemName">'.$collections_1[$val['id']].'</span>
                                                <span class="shippingStatus">'.$val['art'].'</span>
                                            </div>
                                            <div class="box imgBox">
                                            	<img style="max-height:100px;max-width: 350px;" src="'.$val['photo'].'" alt="'.$val['title'].'">
                                            </div>
                                            <div class="box">
                                                <div class="inputs">
                                                    <div class="calculate">
                                                        <div class="meters block">
                                                            <input class="fileStyle" name="count[]"  data-type="" data="'.(($val['unit_id']==1)?'м2':'шт').'" step="0.01" type="text"><span class="type">'.(($val['unit_id']==1)?'м2':'шт').'</span>

                                                        </div>
                                                        <div class="wraps block">
                                                            <input class="fileStyle" name="count_pack[]" data="'.$val['packCntByUnit'].'" type="number"><span class="type">уп</span>

                                                        </div>
                                                        <div class="sum block"> 
                                                            <input class="fileStyle" name="count_unit[]" data="'.$val['packCntByCount'].'" type="number"><span class="type">пл</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="remain">
                                                    <p class="now">
                                                        Остаток на складе — <span class="num">'.($stock_1[$val['id']]['ad']+$reserve_1[$val['id']]['ad']).'</span> '.(($val['unit_id']==1)?'м2':'шт').', из него в резерве — <span class="reserve">'.$reserve_1[$val['id']]['ad'].'</span>  '.(($val['unit_id']==1)?'м2':'шт').'
                                                    </p>'.((isset($delivery_date_12))?
                                                    '<p class="will">
                                                         Ближайшая поставка '.$delivery_date_12[$val['id']].' — <span class="willBe">'.$stock_1[$val['id']]['stock'].'</span> '.(($val['unit_id']==1)?'м2':'шт').', в резерве — <span class="willBeReserve">'.$reserve_1[$val['id']]['reserve'].'</span> '.(($val['unit_id']==1)?'м2':'шт').'
                                                    </p>':"").'
                                                </div>
                                            </div>
                                            <p class="formPrice">Цена <span class="price">'.$prices_1[$val['id']].'</span> руб <span class="result">, стоимость <span class="lastPrice">0</span> руб</span></p>
                                        </div>

                                    </div>
                                </label>
                                <div class="checkBoxTrue imit"></div>
                                <div class="checkBoxFalse imit"></div>
                            </div>
                        </div>');
		
			
		}
		//print_r();
		
		
		
		
		
		//echo $_GET['colllection'];
		exit();

		}
		
		
		$this->page->fabrics1=$fabrics1;
		//print_r($this->page->list_collections2);
		//личный кабинет
		}
		
		
		
		//---------------------------------------------------
		
		
		
		if(strpos($this->app->request->uri,'about')!=false){
		//о компании	
		
		$about_slider1=$this->model('banners')->getList(
                       'about_fotogallery',
                        array('id','title','image','link'), array('order' => array('id' => 'ASC'))
                    );
		$this->page->about_slider1=$about_slider1;
		
		
		
		
		//клиенты на странице "О компании"
		$this->page->about_clients = $this->model('banners')->getList('about_clients', array('title','description','image'), array('order' => array('id' => 'asc')));
		
		//партнёры на странице "О компании"
		$this->page->about_partners = $this->model('banners')->getList('about_partners', array('title','description','image'), array('order' => array('title' => 'asc')));
		
		//сертификаты на странице "О компании"
		$this->page->about_sertificates = $this->model('banners')->getList('about_sertificates', array('title','description','image'), array('order' => array('title' => 'asc')));
		
		//документы на странице "О компании"
		$this->page->about_docs = $this->model('banners')->getList('about_docs', array('title','image'), array('order' => array('title' => 'asc')));
		
		
		//о компании
		}
		
		
		
		//---------------------------------------------------
		
		
		
		if(strpos($this->app->request->uri,'merchandising')!=false){
		
		
		//менчандайзинг - вкладка "по типу"
		$this->page->merch_types = $this->model('db')->getList('merchandising_types', array('id','title','image'), array('order' => array('title' => 'asc')));
		echo "merch_types= ".count($this->page->merch_types)."<br>";
		
		}
		
		
		
		//---------------------------------------------------
		
		
		
		if(strpos($this->app->request->uri,'about')!=false){
		//о компании
		
		//о компании - торговая политика компании
		$this->page->about_text1 = $this->model('db')->getList('text_blocks', array('text'), array('where' => array('id' => '1'),'order' => array('id' => 'asc')));
		
		//о компании - ценовая политика компании
		$this->page->about_text2 = $this->model('db')->getList('text_blocks', array('text'), array('where' => array('id' => '2'),'order' => array('id' => 'asc')));
		
		//о компании - рекламная политика компании
		$this->page->about_text3 = $this->model('db')->getList('text_blocks', array('text'), array('where' => array('id' => '3'),'order' => array('id' => 'asc')));
		
		}
		
		
		
		//---------------------------------------------------
		
		
		
		if(strpos($this->app->request->uri,'merchandising')!=false){
		
		
		//менчандайзинг - заголовок
		$this->page->merchandising_head = $this->model('db')->getList('text_blocks', array('text'), array('where' => array('id' => '5'),'order' => array('id' => 'asc')));
		
		}
		
		
		
		//---------------------------------------------------
		
		
		
		if(strpos($this->app->request->uri,'about')!=false){
		//о компании
		
		//о компании - реквизиты
		$this->page->about_rekvisites = $this->model('db')->getList('rekvisites', array('title','text'), array('order' => array('id' => 'asc')));
		//о компании - банковские реквизиты
		$this->page->about_bank_rekvisites = $this->model('db')->getList('bank_rekvisites', array('title','text'), array('order' => array('id' => 'asc')));
		
		//о компании - сервис
		$this->page->about_service = $this->model('db')->getList('text_blocks', array('text'), array('where' => array('id' => '4'),'order' => array('id' => 'asc')));
		//echo count($this->page->about_service)."-f5 ";	
		
		}
		
		
		
		//---------------------------------------------------
		
		
		
		if( (strpos($this->app->request->uri,'about/employees')!=false) || (strpos($this->app->request->uri,'contacts')!=false) ){
		
		//сотрудники
		$employee_main = $this->model('employees')->getList('employees2otdels', array('id_employee'), array('where' => array('id_otdel' => '26'),'order' => array('id_otdel' => 'asc')));
		$id_employee_main="";
		foreach($employee_main as $value) {
			$id_employee_main=$value['id_employee'];	
		}
		
		$this->page->employees_main = $this->model('employees')->getList('employees', array('fio','image','post','intro','content'), array('where' => array('id' => $id_employee_main, 'hidden' => 'no'),'order' => array('id' => 'asc')));
		
		
		$employees_otdels = $this->model('employees')->getList('employees_otdels', array('id','title','order'), array('order' => array('order' => 'asc')));
		//список отделов
		$this->page->employees_otdels=$employees_otdels;
		
		foreach($employees_otdels as $value) {
			
			
			//получить список идентификаторов сотрудников, принадлежащих к текущему отделу
			$employee_1 = $this->model('employees')->getList('employees2otdels', array('id_employee'), array('where' => array('id_otdel' => $value['id']),'order' => array('id_employee' => 'asc')));
			foreach($employee_1 as $value2) {
				
				//получение параметров сотрудника по идентификатору 
				$employee_2 = $this->model('employees')->getList('employees', array('id', 'fio', 'image', 'post', 'intro', 'content','pos'), array('where' => array('id' => $value2['id_employee'],'hidden' => 'no'), 'order' => array('pos' => 'asc')));
				
				foreach($employee_2 as $value3) {
					
					$otdel_employee[$value['id']]['fio'][$value3['pos']]=$value3['fio'];
					$otdel_employee[$value['id']]['image'][$value3['pos']]=$value3['image'];
					$otdel_employee[$value['id']]['post'][$value3['pos']]=$value3['post'];
					$otdel_employee[$value['id']]['intro'][$value3['pos']]=$value3['intro'];
					$otdel_employee[$value['id']]['content'][$value3['pos']]=$value3['content'];
					
				}
				
				ksort($otdel_employee[$value['id']]['fio']);
				ksort($otdel_employee[$value['id']]['image']);
				ksort($otdel_employee[$value['id']]['post']);
				ksort($otdel_employee[$value['id']]['intro']);
				ksort($otdel_employee[$value['id']]['content']);
				
			}
			
				
		}
		
		
		$this->page->otdel_employee=$otdel_employee;
		
		
		
		//страница сотрудников
		}
		
		
		
		//---------------------------------------------------
		
		
		
		if(strpos($this->app->request->uri,'contacts')!=false){
		
		//контакты
		$contacts=$this->model('employees')->getList(
                       'contacts',
                        array('id','title','id_otdel','content','map','map_code','mail','order','no_emp'), array('order' => array('order' => 'ASC'))
                    );
		$this->page->contacts=$contacts;
		
		
		unset($otdel_employee);
		foreach($contacts as $value) {
			
			
			
			//получить список идентификаторов сотрудников, принадлежащих к текущему отделу
			$employee_1 = $this->model('employees')->getList('employees_contacts2contacts', array('id_employee_contact'), array('where' => array('id_contact' => $value['id']),'order' => array('id_employee_contact' => 'asc')) );
			
			foreach($employee_1 as $value2) {
				
				// идентификатор отдела  -  идентификатор сотрудника
				//echo $value['id']." -- ".$value2['id_employee']."<br>";
				
				//получение параметров сотрудника по идентификатору 
				$employee_2 = $this->model('employees')->getList('employees_contacts', array('id', 'fio', 'image', 'post', 'intro', 'content','pos'), array('where' => array('id' => $value2['id_employee_contact'],'hidden' => 'no'), 'order' => array('pos' => 'asc')));
				
				
				
				
				foreach($employee_2 as $value3) {
				
					//идентификатор = характеристики сотрудника
					//$value['id'] - номер отдела
					
					$otdel_employee[$value['id']]['fio'][$value3['pos']]=$value3['fio'];
					$otdel_employee[$value['id']]['image'][$value3['pos']]=$value3['image'];
					$otdel_employee[$value['id']]['post'][$value3['pos']]=$value3['post'];
					$otdel_employee[$value['id']]['intro'][$value3['pos']]=$value3['intro'];
					$otdel_employee[$value['id']]['content'][$value3['pos']]=$value3['content'];
					//$otdel_employee[$value['id']]['pos'][]=$value3['pos'];
					
					
					
				}
				
				ksort($otdel_employee[$value['id']]['fio']);
				ksort($otdel_employee[$value['id']]['image']);
				ksort($otdel_employee[$value['id']]['post']);
				ksort($otdel_employee[$value['id']]['intro']);
				ksort($otdel_employee[$value['id']]['content']);
				
				
					   	
			}
			
			
				
		}
		
		
		
		
		
		
		
		$this->page->otdel_employee=$otdel_employee;
		
		
		
		}
		
		
		
		//---------------------------------------------------
		
		
		
		if((strpos($this->app->request->uri,'requests')!=false) ||(strpos($this->app->request->uri,'cat/id')!=false)){
		
		
		
		//личный кабинет - вывод списка заявок
		
		
		
		$requests_1=$this->model('requests')->getList(
                       'requests',
                        array('id','cdate','status','comments'), array('order' => array('cdate' => 'DESC'), 'limit' => '100')
                    );
		echo "requests_1= ".count($requests_1)."<br>";
		$this->page->requests_1=$requests_1;
		
		
		
		//echo count($employees_otdels)."-f5 ";
		//ЛК - создание заявки - список товаров 
		$goods_1=$this->model('db')->getList(
                       'goods',
                        array('id','title','art','photo','collection_id'), array('order' => array('id' => 'DESC'),'where' => array('hidden' => 'no'),'limit' => '30')
                    );
		echo "goods_1= ".count($goods_1)."<br>";
		
		foreach($goods_1 as $k => $value1) {
			//идентификатор товара - наименование коллекции
			//echo $list_collections[3630]."<br>";
			//echo 
			$goods_1[$k]['photo']='/public/userfiles/goods/original/'.$value1['id'].'.jpg';
			$collections_1[$value1["id"]]=$list_collections2[$value1["collection_id"]];
			//echo $collections_1[$value1["id"]]."<br>";
			
			
			$prices1=$this->model('db')->getList(
                       'prices2goods',
                        array('price'), array('where' => array('good_id' => $value1["id"]))
                    );
					//print_r($prices1);
					$this->page->dealer['price_id'];
			//foreach($prices1 as $value2) {
			
				//идентфикатор товара -> цена товара
				$prices_1[$value1["id"]]=$prices1[$this->page->dealer['price_id']]['price'];
				
				//echo $prices_1[$value1["id"]]." -- ".$value1["id"]."<br>";	
			
			//}
			
			$remains1=$this->model('db')->getList(
                       'remains',
                        array('stock','reserve'), array('where' => array('good_id' => $value1["id"]))
                    );
			foreach($remains1 as $value2) {
				
				$stock_1[$value1["id"]]=$value2['stock'];
				$reserve_1[$value1["id"]]=$value2['reserve'];
				
				//echo $prices_1[$value1["id"]]."<br>";	
			}
			
			
			
			$delivery_date1=$this->model('db')->getList(
                       'stores',
                        array('delivery_date'), array('where' => array('id' => $value1["id"]))
                    );
			foreach($delivery_date1 as $value2) {
				
				//идентификатор товара - дата ближайшей поставки
				$delivery_date_1[$value1["id"]]=$value2['delivery_date'];
				
				
				//echo $prices_1[$value1["id"]]."<br>";	
			}
			
			
			
			
			
			
			
			
			
			
						
		}//foreach($goods_1 as $k => $value1)
		
		$this->page->goods_1=$goods_1;
		
		if(isset($this->app->request->vars['id'])){
		
		
		$goods_2=$this->model('db')->getList(
                       'goods',
                        array('id','title','art','photo','collection_id','size','recomended'), array('order' => array('id' => 'DESC'),'where' => array('hidden' => 'no','collection_id' => $this->app->request->vars['id']))
                    );
		//####
		echo "goods_2= ".count($goods_2)."<br>";	
		
		foreach($goods_2 as $value2) {
			//,'title','art','photo','collection_id'
			$goods_parameters[$value2["id"]]["title"]=$value2["title"];
			$goods_parameters[$value2["id"]]["art"]=$value2["art"];
			$goods_parameters[$value2["id"]]["photo"]=$value2["photo"];
			$goods_parameters[$value2["id"]]["id"]=$value2["id"];
			$goods_parameters[$value2["id"]]["size"]=$value2["size"];
			
			$goods_price=$this->model('db')->GetList(
                       'prices2goods',
                        array('price'), array('where' => array('price_id' => '1','good_id' => $value2["id"]))
                    );	
			//print_r($goods_price);		
			$goods_parameters[$value2["id"]]["price"]=$goods_price[0]['price'];	
			//echo "=".$goods_parameters[$value2["id"]]["price"]."=<br>";
			
			$goods_size=$this->model('db')->GetByCond(
                       'based_sizes2goods',
                        array('based_size_id'), array('where' => array('good_id' => $value2["id"]))
                    );	
			//echo $goods_size['based_size_id']."=";
					
			$goods_size3=$this->model('db')->GetList('based_sizes', array('id', 'title'), array('where' => array('id' => $goods_size['based_size_id'])));
			
			if($value2["recomended"]=="yes"){
				$goods_parameters[$value2["id"]]["recomended"]='1';
			}else{
				$goods_parameters[$value2["id"]]["recomended"]='0';
			}
			
			
			$goods_purposes=$this->model('db')->GetList(
                       'goods2purposes',
                        array('purpose_id'), array('where' => array('good_id' => $value2["id"]))
                    );
			 
			foreach($goods_purposes as $v1){ 
			
				$goods_purposes2=$this->model('db')->GetList(
						'purposes',
					  	array('id','title','detail_title'), array('where' => array('id' => $v1['purpose_id']))
                    );
					
				//echo $goods_purposes2[0]['detail_title']."<br>";	
				if(($goods_purposes2[0]['detail_title']!="") && ($goods_purposes2[0]['id']!="")){
					$goods_parameters[$value2["id"]]["purpose"][]=$goods_purposes2[0]['detail_title'];
					$goods_parameters[$value2["id"]]["purpose_id"][]=$goods_purposes2[0]['id'];
				}
			
			}
			
			
		
		}//foreach($goods_2 as $value2)
		
		
		
		
		
		}//if(isset($this->app->request->vars['id']))
		
		
		$this->page->goods_parameters=$goods_parameters;
		$this->page->collections_1=$collections_1;
		$this->page->prices_1=$prices_1;
		$this->page->stock_1=$stock_1;
		$this->page->reserve_1=$reserve_1;
		$this->page->delivery_date_1=$delivery_date_1;
		
		//prices_1 - сортировка по возрастанию цен
		//asort($prices_1);
		
		//ЛК - создание заявки - список товаров под заказ
		$goods_2=$this->model('db')->getList(
                       'goods_to_order',
                        array('id','title','art','collection_id','price1'), array('order' => array('id' => 'DESC'),'where' => array('hidden' => 'no'),'limit' => '300')
                    );
		
		echo "goods_2= ".count($goods_2)."<br>";	
		
		$this->page->goods_2=$goods_2;
			
		foreach($goods_2 as $value1) {
			
			//идентификатор товара - наименование коллекции
			//echo $list_collections[3630]."<br>";
			//echo 
			
			
			$collections_2[$value1["id"]]=$list_collections2[$value1["collection_id"]];
			//echo $collections_1[$value1["id"]]."<br>";
			
			$remains2=$this->model('db')->getList(
                       'remains',
                        array('stock','reserve'), array('where' => array('good_id' => $value1["id"]))
                    );
			foreach($remains2 as $value2) {
				
				$stock_2[$value1["id"]]=$value2['stock'];
				$reserve_2[$value1["id"]]=$value2['reserve'];
				
				//echo $prices_1[$value1["id"]]."<br>";	
			}
			
			
			
			$delivery_date2=$this->model('db')->getList(
                       'stores',
                        array('delivery_date'), array('where' => array('id' => $value1["id"]))
                    );
			foreach($delivery_date2 as $value2) {
				
				//идентификатор товара - дата ближайшей поставки
				$delivery_date_2[$value1["id"]]=$value2['delivery_date'];
				
				
				//echo $prices_1[$value1["id"]]."<br>";	
			}
			
			
			
			
			
			
			
		
			
			
						
		}//foreach($goods_2 as $value1)
			
		$this->page->collections_2=$collections_2;
		//$this->page->prices_2=$prices_2;
		$this->page->stock_2=$stock_2;
		$this->page->reserve_2=$reserve_2;
		$this->page->delivery_date_2=$delivery_date_2;
		
		
		

		//личный кабинет - заявки
		}
		if(strpos($this->app->request->uri,'requests/docs')!=false){ 
		//requests/docs
		$page_content   = $this->model('content')->getList('content', array('id','content','title'), array('where' => array('path' => "requests/docs")));
		echo "page_content= ".count($page_content)."<br>";	
		
		$this->page->content22=array('content'=>$page_content[0]['content'],'title'=>$page_content[0]['title']);
		//---------------------------------------------------
		}
		if(strpos($this->app->request->uri,'requests/prise')!=false){ 
		//requests/docs
		$page_content   = $this->model('content')->getList('content', array('id','content','title'), array('where' => array('path' => "requests/prise")));
		echo "page_content= ".count($page_content)."<br>";
		
		$this->page->content22=array('content'=>$page_content[0]['content'],'title'=>$page_content[0]['title']);
		//---------------------------------------------------
		}
		
		if(trim($this->app->request->uri, '/')=='cat' || (strpos($this->app->request->uri,'search')!=false)|| (strpos($this->app->request->uri,'cat')!=false) ){
		//страница каталога
		
		
		$tmp=$this->model('db')->getList(
                       'prices2goods',
                        array('price'), array('order' => array('price' => 'ASC'),'limit' => '1','where' => array('price_id' => '1'))
                    );
		foreach($tmp as $value) {
			$collections_min_price=$value['price'];
			
		}

		$tmp=$this->model('db')->getList(
                       'prices2goods',
                        array('price'), array('order' => array('price' => 'DESC'),'limit' => '1','where' => array('price_id' => '1'))
                    );
		foreach($tmp as $value) {
			$collections_max_price=$value['price'];
			//echo $collections_max_price."==";
		}
		$this->page->collections_min_price=$collections_min_price;
		$this->page->collections_max_price=$collections_max_price;

		//страница каталога
		}
		
		
		
		
		//---------------------------------------------------
		
		
		
		//поиск по коллекциям . 
		//проход по коллекциям и извлечение параметров
	    if(isset($_GET['collections'])){
			
		
			
		$tmp=$this->model('db')->getList(
                       'collections',
                        array('id','factory_id','title','novice','sale','action','image'), array('order' => array('id' => 'DESC'),'where' => array('hidden' => 'no'))
                    );
		echo "tmp= ".count($tmp)."<br>";			
		 		
		foreach($tmp as $value) {
			
			//echo "++".print_r($based_sizes_collection)."++<br>";
			//echo "-".$value["id"]."-";
			
			$factory_id=$value['factory_id'];//идентификатор фабрики
			$price=$list_collections_prices[$value["id"]][0];//цена коллекции
			
			
			//$based_size=$based_sizes_collection[$value["id"]]; 
			$based_size=$this->based_sizes_collection($value["id"]);//идентфикатор базового размера
			
			
			
			//$purpose=$purposes_collections[$value["id"]];//идентификатор назначения
			//purposes_collections($value["id"]);
			$purpose_m1=$this->purposes_collections($value["id"]);
			//echo $purpose."<br>";
			//echo "<pre>";
			//echo print_r($purposes_collections[$value["id"]]);
			//echo "</pre>";
			
			//$material=$materials_collections[$value["id"]];//идентификатор материала
			//$purpose_m1=explode(":",$purpose);
			//$material_m1=explode(":",$material);
			$material_m1=$this->materials_collections($value["id"]);
			
			
			$surface_tmp=$this->model('db')->getList(
                       'collections2surfaces',
                        array('surface_id'), array('order' => array('surface_id' => 'DESC'),'where' => array('collection_id' => $value["id"]))
                    );
			unset($surface);
			foreach ($surface_tmp as $val){		
				$surface[]=$val['surface_id']; //идентфикатор поверхности
			}
			
			
			$style_tmp=$this->model('db')->getList(
                       'collections2styles',
                        array('style_id'), array('order' => array('style_id' => 'DESC'),'where' => array('collection_id' => $value["id"]))
                    );
					
			unset($style);
			foreach ($style_tmp as $val){		
				$style[]=$val['style_id']; //идентфикатор стиля
			}
			
			
			
			
			$color_tmp=$this->model('db')->getList(
                       'collections2colors',
                        array('color_id'), array('order' => array('color_id' => 'DESC'),'where' => array('collection_id' => $value["id"]))
                    );
					
			unset($color);
			foreach ($color_tmp as $val){			
				$color[]=$val['color_id']; //идентфикатор цвета
			}
			
			
			
			//++++++++++
			//echo $factory_id." - ".$price." - ".$based_size." - ".$purpose." - ".$material."<br>";
			
			$log1=1; $log2=1; $log3=1; $log4=1; $log5=1; $log6=1; $log7=1; $log8=1;
			if($_GET['factories']!=""){
				$factories_m=explode(":",$_GET['factories']);
				$log_tmp=0;
				for($i=0;$i<count($factories_m);$i++){
					if($factory_id==$factories_m[$i]){
						$log1=1; $log_tmp=1; break;	
					}
				}
				if($log_tmp==0){ $log1=0; }
				
			}
			
			if(($price>=$_GET['price_min'])&&($price<=$_GET['price_max'])){
				$log2=1;
			}else{
				$log2=0;	
			}
			
			
			if($_GET['based_sizes']!=""){
				$based_sizes_m=explode(":",$_GET['based_sizes']);
				$log_tmp=0;
				for($i=0;$i<count($based_sizes_m);$i++){
					//if($based_size==$based_sizes_m[$i]){
					if(in_array($based_sizes_m[$i],$based_size)){	
						$log3=1; $log_tmp=1; break;	
					}
				}
				if($log_tmp==0){ $log3=0; }
				
			}
			
			
			if($_GET['purposes']!=""){
				$purposes_m=explode(":",$_GET['purposes']);
				$log_tmp=0;
				for($i=0;$i<count($purposes_m);$i++){
					//echo $purposes_m[$i]."--";
					//echo "<pre>";
					//print_r($purpose_m1);
					//echo "</pre>";
					if(in_array($purposes_m[$i],$purpose_m1)){
						
						$log4=1; $log_tmp=1; break;	
					}
				}
				if($log_tmp==0){ $log4=0; }
				//echo"<br>=========================<br>";
			}
			
			
			if($_GET['materials']!=""){
				$materials_m=explode(":",$_GET['materials']);
				$log_tmp=0;
				for($i=0;$i<count($materials_m);$i++){
					if(in_array($materials_m[$i],$material_m1)){
						$log5=1; $log_tmp=1; break;	
					}
				}
				if($log_tmp==0){ $log5=0; }
				
			}
			
			if($_GET['surfaces']!=""){
				$surfaces_m=explode(":",$_GET['surfaces']);
				$log_tmp=0;
				for($i=0;$i<count($surfaces_m);$i++){
					//if($surface==$surfaces_m[$i]){
					if(in_array($surfaces_m[$i],$surface)){
						$log6=1; $log_tmp=1; break;	
					}
				}
				if($log_tmp==0){ $log6=0; }
				
			}
			
			if($_GET['styles']!=""){
				$styles_m=explode(":",$_GET['styles']);
				$log_tmp=0;
				for($i=0;$i<count($styles_m);$i++){
					//if($style==$styles_m[$i]){
					if(in_array($styles_m[$i],$style)){
						$log7=1; $log_tmp=1; break;	
					}
				}
				if($log_tmp==0){ $log7=0; }
				
			}
			
			
			if($_GET['colors']!=""){
				$colors_m=explode(":",$_GET['colors']);
				$log_tmp=0;
				for($i=0;$i<count($colors_m);$i++){
					//if($color==$colors_m[$i]){
					if(in_array($colors_m[$i],$color)){	
						$log8=1; $log_tmp=1; break;	
					}
				}
				if($log_tmp==0){ $log8=0; }
				
			}
			
			
			
			
			
			if(($log1==1)&&($log2==1)&&($log3==1)&&($log4==1)&&($log5==1)&&($log6==1)&&($log7==1)&&($log8==1)){
				$search_collections[]=$value;	
			}
			
			
			
		}
		
		$this->page->search_collections=$search_collections;
		//echo count($this->page->search_collections)."-f5 ";
		
		}//if(isset($_GET['collection'])
		
		
		
		
		
		echo 'Время выполнения : '.(microtime(true) - $start).' сек.';
		
		
		
		//++++++++++++++++++++++++++++++++++++++++++

		parent::run();
		if ($this->page->dealer['have_discount'] == 'no') {
			$s = $this->page->settings;
			$s['discount'] = 0;
			$this->page->settings = $s;
		}
        zf::addJS('common', '/public/site/js/common.js');
        zf::addCSS('jquery-ui', '/public/site/css/jquery-ui.css');
        zf::addCSS('fonts', '/public/site/css/fonts.css');
        zf::addCSS('main', '/public/site/css/main.css');
        zf::addCSS('jquery.pnotify', '/public/site/css/jquery.pnotify.css');
        zf::addJS('jquery.cookie', '/public/site/js/jquery.cookie.js');
		zf::addJS('jquery.pnotify', '/public/site/js/jquery.pnotify.js');
		zf::addJS('jquery.cycle', '/public/site/js/jquery.cycle.all.js');
		zf::addJS('jquery.lightbox', '/public/site/js/jquery.lightbox.min.js');
		zf::addJS('proscroll', '/public/site/js/pro.scroll.0.3.js');
		zf::addJS('iflabel', '/public/site/js/iflabel.js');

		if (isset($ret) and $ret and in_array($this->app->ctrl->ctrlName, array('requests', 'profile', 'documents'))) {
			$this->loadView('auth', null);
			return $ret;
		}
		session_write_close();
	
	}
	
	/**
	 * @see Controller::form()
	 */
	public function form($formName)
	{
		return parent::form($formName);
	}
	public function purposes_collections($collection_id){
		unset($result);
		$m=$this->model('db')->getList('collections2purposes', array('purpose_id','collection_id'), array('order' => array('purpose_id' => 'ASC'), 'where' => array('collection_id' => $collection_id)));
		foreach($m as $v){
			$result[]=$v['purpose_id'];
		}
		return $result;	
	}
	
	public function materials_collections($collection_id){
		unset($result);
		$m=$this->model('db')->getList('collections2materials', array('material_id','collection_id'), array('order' => array('material_id' => 'ASC'), 'where' => array('collection_id' => $collection_id)));
		foreach($m as $v){
			$result[]=$v['material_id'];
		}
		return $result;	
	}
	
	public function based_sizes_collection($collection_id){
		unset($result);
		$m=$this->model('db')->getList('based_sizes2collections', array('based_size_id','collection_id'), array('order' => array('based_size_id' => 'ASC'), 'where' => array('collection_id' => $collection_id)));
		foreach($m as $v){
			$result[]=$v['based_size_id'];
		}
		//$result="";
		return $result;	
	}
	
	
	
		
	public function getPrewText($text,$maxwords=60,$maxchar=50) {
	//$text=strip_tags($text);
	$words=split(' ',$text);
	$text='';
	foreach ($words as $word) {
		if (mb_strlen($text.' '.$word)<$maxchar) {
			$text.=' '.$word;
		}
		else {
			$text.='...';
			break;
		}
	}
	return $text;
	}
	
	
	
	
	
	
	
}