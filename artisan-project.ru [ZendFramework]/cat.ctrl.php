<?php
class CatController extends Site_Controller
{
	public function run()
	{

		$this->app->session->start();
				
		$this->app->session->set('start_collection','0');
		
		
		if(strpos($_SERVER['REQUEST_URI'], "cat/type/purpose")!=false || strpos($_SERVER['REQUEST_URI'], "cat/type/material")!=false){
		//страница материала и страница назначения
		
		
		if(strpos($_SERVER['REQUEST_URI'], "page")==false){
			$url_m=explode("/",trim($_SERVER['REQUEST_URI'], "/"));
			$purpose_id= $url_m[count($url_m)-1];
		}else{
			$url_m=explode("/",trim($_SERVER['REQUEST_URI'], "/"));
			$purpose_id= $url_m[count($url_m)-3];
			
		}
		$this->page->purpose_id=$purpose_id;
		
		$purpose_name=$this->model('db')->getList(
                       'purposes',
                        array('title','detail_title'), array('where' => array('id' => $purpose_id))
                    );
		$this->page->purpose_name=$purpose_name[0]["detail_title"];
		

		
		$material_name=$this->model('db')->getList(
                       'materials',
                        array('title','detail_title'), array('where' => array('id' => $purpose_id))
                    );
		$this->page->material_name=$material_name[0]["detail_title"];
		
		
		
		if(strpos($_SERVER['REQUEST_URI'], "cat/type/purpose")!=false){
		//страница назначения
		
			
		$paging = array(
				'total' => 0,
				'from' => 0,
				'npp' => 30,
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
			
		if(strpos($_SERVER['REQUEST_URI'],"page") != false){
			$m=explode("/",trim($_SERVER['REQUEST_URI'],"/"));
			$m=($m[count($m)-1]-1)*30;
		}else{
			$m=0;
		}
		
		if(strpos($_SERVER['REQUEST_URI'],"page/all") != false){
			$m=0;
		
		}
		
		
		
		
		
		
		//достать идентификаторы коллекций для текущего назначения
		$temp=$this->model('db')->getList(
			'collections2purposes',
                        array('purpose_id','collection_id'), array('where' => array('purpose_id' => $purpose_id))
                    );
		//echo "cat# temp= ".count($temp)."<br>";			
					
		foreach($temp as $v){
			$temp3[]=$v['collection_id'];	
		}
		
		//echo "=".count($temp3);
		$t1=$this->model('db')->getList(
			'collections',
                        array('id','factory_id','title','novice','sale','action','image'),
						array('order' => array('title' => 'ASC'), 'where' => array('hidden' => 'no', 'id' => array('IN', $temp3, '(?l)') ))
                    );
		//echo "cat# t1= ".count($t1)."<br>";	
		
		
		
		$purpose_collections=$this->model('db')->getPage(
                       'collections',
                        array('id','factory_id','title','novice','sale','action','image'),
						$paging['total'], $m, $paging['npp'],
						array('order' => array('title' => 'ASC'), 'where' => array('hidden' => 'no', 'id' => array('IN', $temp3, '(?l)') ))
                    );
		//echo "cat# purpose_collections= ".count($purpose_collections)."<br>";				
		
				
		foreach ($purpose_collections as $value){
			
			
			//	$value['collection_id']
			/*$collections=$this->model('db')->getList(
			'collections',
                        array('id','factory_id','title','novice','sale','action','image'), array('order' => array('title' => 'ASC'), 'where' => array('id' => $value['collection_id'], 'hidden' => 'no'))
                    );
					
			//if($collections[0]['id']==""){  continue;  };		
			$purpose_collections[]=$collections[0];	
			
			*/
			
			
			$purpose_collections_factories_tmp = $this->model('db')->getList(
                'factories',
                array('title','country_id','url'), array('where' => array('id' => $purpose_collections[0]['factory_id']))
                    );
			//идентификатор коллекции - наименование фабрики
			$purpose_collections_factories[$value['id']]=$purpose_collections_factories_tmp[0]['title'];
			$purpose_collections_factories_link[$value['id']]=$purpose_collections_factories_tmp[0]['url'];
			
			
			//echo $purpose_collections_factories_tmp[0]['country_id']."===";
			
			$purpose_collections_countries_tmp = $this->model('db')->getList(
                'countries',
                array('import_title','url'), array('where' => array('id' => $purpose_collections_factories_tmp[0]['country_id']))
                    );
					
			//идентификатор коллекции - наименование страны
			$purpose_collections_countries[$value['id']]=$purpose_collections_countries_tmp[0]['import_title'];
			$purpose_collections_countries_link[$value['id']]=$purpose_collections_countries_tmp[0]['url'];
			
			
			
			
			
			$goods_tmp=$this->model('db')->getList(
                       'goods',
                        array('id','title','art','photo','collection_id'), array('order' => array('id' => 'DESC'),'where' => array('hidden' => 'no','collection_id' => $value['id']))
                    );
					
			foreach($goods_tmp as $value2) {
			
			$purpose_collections_prices_tmp=$this->model('db')->getList(
                       'prices2goods',
                        array('price'), array('where' => array('good_id' => $value2["id"],'price_id' => '1'))
                    );
				foreach($purpose_collections_prices_tmp as $value3) {
			
					//идентфикатор коллекции -> цена товара
					$purpose_collections_prices[$value['id']][]=$value3['price'];
					//echo $value["id"]." -- ".$value3['price']."<br>";
				}
			
			}
			
			
			
					
					
					
		}
		
		
		
		$paging['pages'] = ceil($paging['total']/$paging['npp']);
			$paging['curr_page'] = $this->app->request->page > 0 ? $this->app->request->page : 1; 
			$this->page->paging = $paging;
			//echo "paging6<br>";
		//echo "<br>";
		//echo "pages- ".$paging['pages']."<br>";
		//echo "total- ".$paging['total']."<br>";
		//echo "npp- ".$paging['npp']."<br>";
		
		//echo "<pre>";
		//print_r($this->page->paging);
		//echo "</pre>";
		
		$this->page->purpose_collections_factories_link=$purpose_collections_factories_link;
		$this->page->purpose_collections_countries_link=$purpose_collections_countries_link;
		$this->page->purpose_collections_prices=$purpose_collections_prices;
		$this->page->purpose_collections_countries=$purpose_collections_countries;
		
		/*function cmp($a, $b) {
			return strnatcmp($a["title"], $b["title"]);
		}
		usort($purpose_collections, "cmp");
		*/
		
		
		///echo "<pre>";
		//print_r($purpose_collections);
		//echo "</pre>";
		
		
		
		$this->page->purpose_collections=$purpose_collections;
		
		
		$this->page->purpose_collections_factories=$purpose_collections_factories;
		
		}//страница назначения
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		if(strpos($_SERVER['REQUEST_URI'], "cat/type/material")!=false){
		//страница материала
		
		
		
			
		$paging = array(
				'total' => 0,
				'from' => 0,
				'npp' => 30,
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
			
		//echo "<pre>";
		///$paging['from']
		//print_r($this);	
		//echo "</pre>";	
		if(strpos($_SERVER['REQUEST_URI'],"page") != false){
			$m=explode("/",trim($_SERVER['REQUEST_URI'],"/"));
			$m=($m[count($m)-1]-1)*30;
		}else{
			$m=0;
		}
		
		if(strpos($_SERVER['REQUEST_URI'],"page/all") != false){
			$m=0;
		
		}
		
		
		
		
		
		
		
		//достать идентификаторы коллекций для текущего материала
		$temp=$this->model('db')->getList(
			'collections2materials',
                        array('material_id','collection_id'), array('where' => array('material_id' => $purpose_id))
                    );
		//echo "cat# temp= ".count($temp)."<br>";				
		foreach($temp as $v){
			$temp3[]=$v['collection_id'];	
		}
		
		
		
		
		
		
		$material_collections=$this->model('db')->getPage(
                       'collections',
                        array('id','factory_id','title','novice','sale','action','image'),
						$paging['total'], $m, $paging['npp'],
						array('order' => array('title' => 'ASC'), 'where' => array('hidden' => 'no', 'id' => array('IN', $temp3, '(?l)') ))
                    );
		//echo "cat# material_collections= ".count($material_collections)."<br>";					
				
				
		foreach ($material_collections as $value){
		
			
			
			
			$material_collections_factories_tmp = $this->model('db')->getList(
                'factories',
                array('title','country_id','url'), array('where' => array('id' => $material_collections[0]['factory_id']))
                    );
			//идентификатор коллекции - наименование фабрики
			$material_collections_factories[$value['id']]=$material_collections_factories_tmp[0]['title'];
			$material_collections_factories_link[$value['id']]=$material_collections_factories_tmp[0]['url'];
			
			
			//echo $purpose_collections_factories_tmp[0]['country_id']."===";
			
			$material_collections_countries_tmp = $this->model('db')->getList(
                'countries',
                array('import_title','url'), array('where' => array('id' => $material_collections_factories_tmp[0]['country_id']))
                    );
					
			//идентификатор коллекции - наименование страны
			$material_collections_countries[$value['id']]=$material_collections_countries_tmp[0]['import_title'];
			$material_collections_countries_link[$value['id']]=$material_collections_countries_tmp[0]['url'];
			
			
			
			
			
			$goods_tmp=$this->model('db')->getList(
                       'goods',
                        array('id','title','art','photo','collection_id'), array('order' => array('id' => 'DESC'),'where' => array('hidden' => 'no','collection_id' => $value['id']))
                    );
			foreach($goods_tmp as $value2) {
			
			$material_collections_prices_tmp=$this->model('db')->getList(
                       'prices2goods',
                        array('price'), array('where' => array('good_id' => $value2["id"],'price_id' => '1'))
                    );
				foreach($material_collections_prices_tmp as $value3) {
			
					//идентфикатор коллекции -> цена товара
					$material_collections_prices[$value['id']][]=$value3['price'];
					//echo $value["id"]." -- ".$value3['price']."<br>";
				}
			
			}
			
			
			
					
					
					
		}
		
		
		
		
		
		
		
		
		
		
		$paging['pages'] = ceil($paging['total']/$paging['npp']);
			$paging['curr_page'] = $this->app->request->page > 0 ? $this->app->request->page : 1; 
		
		
		
		//echo "<pre>";
		//print_r($paging);
		//echo "</pre>";
		
			$this->page->paging = $paging;
			//echo "paging7<br>";
			
		$this->page->material_collections_factories_link=$material_collections_factories_link;
		$this->page->material_collections_countries_link=$material_collections_countries_link;
		$this->page->material_collections_prices=$material_collections_prices;
		$this->page->material_collections_countries=$material_collections_countries;
		
		//function cmp($a, $b) {
		//	return strnatcmp($a["title"], $b["title"]);
		//}
		usort($material_collections, "cmp");
		
		$this->page->material_collections=$material_collections;
		
		
		$this->page->material_collections_factories=$material_collections_factories;
		
		}//страница материала
		
		
		
		
		//страница материала и страница назначения
		}
		
		
		
		//////////////////////////////////////////////////////////////
		
		
		
		if(strpos($_SERVER['REQUEST_URI'], "cat/sale")!=false){
		//страница распродажи
		
		$s=$_SERVER['REQUEST_URI'];
		if($s[strlen($s)-1]!="/"){
				
			//header('Location: '.$s."/", null, 301);
		}
			
		
			
		$paging = array(
				'total' => 0,
				'from' => 0,
				'npp' => 30,
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
			
		//echo "<pre>";
		///$paging['from']
		//print_r($this);	
		//echo "</pre>";	
		if(strpos($_SERVER['REQUEST_URI'],"page") != false){
			$m=explode("/",trim($_SERVER['REQUEST_URI'],"/"));
			$m=($m[count($m)-1]-1)*30;
		}else{
			$m=0;
		}
		
		if(strpos($_SERVER['REQUEST_URI'],"page/all") != false){
			$m=0;
		
		}
		
		
		
			
			$collections=$this->model('db')->getPage(
			'collections',
                        array('id','factory_id','title','novice','sale','action','image'), 
						$paging['total'], $m, $paging['npp'],
						array('order' => array('title' => 'ASC'), 'where' => array('sale' => 'yes', 'hidden' => 'no'))
                    );
			$sale=$collections;	
			//echo "cat# sale= ".count($sale)."<br>";
			
			foreach($sale as $value){
			//echo $value['factory_id']." --<br>";
		
				
				$sale_factories_tmp = $this->model('db')->getList(
                'factories',
                array('title','country_id','url'), array('where' => array('id' => $value['factory_id']))
                    );
				//идентификатор коллекции - наименование фабрики
				$sale_factories[$value['id']]=$sale_factories_tmp[0]['title'];
				//echo $value['id']." + <br>";
				//echo $value['id']." -- ".$sale_factories_tmp[0]['title']."<br>";
				$sale_factories_link[$value['id']]=$sale_factories_tmp[0]['url'];
			
			
			
				$sale_countries_tmp = $this->model('db')->getList(
                'countries',
                array('import_title','url'), array('where' => array('id' => $sale_factories_tmp[0]['country_id']))
                    );
					
				//идентификатор коллекции - наименование страны
				$sale_countries[$value['id']]=$sale_countries_tmp[0]['import_title'];
				$sale_countries_link[$value['id']]=$sale_countries_tmp[0]['url'];
			
			
			
			
			
				$goods_tmp=$this->model('db')->getList(
                       'goods',
                        array('id','title','art','photo','collection_id'), array('order' => array('id' => 'DESC'),'where' => array('hidden' => 'no','collection_id' => $value['id']))
                    );
				foreach($goods_tmp as $value2) {
			
				$sale_prices_tmp=$this->model('db')->getList(
                       'prices2goods',
                        array('price'), array('where' => array('good_id' => $value2["id"],'price_id' => '1'))
                    );
					foreach($sale_prices_tmp as $value3) {
			
						//идентфикатор коллекции -> цена товара
						$sale_prices[$value['id']][]=$value3['price'];
						//echo $value["id"]." -- ".$value3['price']."<br>";
					}
			
				}
			}
			
					
					
		
		$this->page->sale_factories_link=$sale_factories_link;
		$this->page->sale_countries_link=$sale_countries_link;
		$this->page->sale_prices=$sale_prices;
		$this->page->sale_countries=$sale_countries;
		$this->page->sale=$sale;
		$this->page->sale_factories=$sale_factories;
		
		
		
		$paging['pages'] = ceil($paging['total']/$paging['npp']);
			$paging['curr_page'] = $this->app->request->page > 0 ? $this->app->request->page : 1; 
			$this->page->paging = $paging;
			 //echo "paging1<br>";
		
		//$paging['curr_page']=2;
		
		
		
		
		/*$country = $this->model('db')->GetByCond(
			'countries',
			$this->model('db')->getFieldsNames('countries', 'show_country'),
			array('where' => $where)
		);
		$this->page->country = $country;
		
		
		$this->page->content = $this->renderView('country', 'catalog');
		$this->loadView('main', null);
		*/
		
		
		
		//страница распродажи
		}
		
		
		
		
		
		//////////////////////////////////////////////////////////////
		
		
		
		if(strpos($_SERVER['REQUEST_URI'], "cat/novice")!=false){
		//страница новинок
		
		
		
		
			
		$paging = array(
				'total' => 0,
				'from' => 0,
				'npp' => 30,
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
			
		//echo "<pre>";
		///$paging['from']
		//print_r($this);	
		//echo "</pre>";	
		if(strpos($_SERVER['REQUEST_URI'],"page") != false){
			$m=explode("/",trim($_SERVER['REQUEST_URI'],"/"));
			$m=($m[count($m)-1]-1)*30;
		}else{
			$m=0;
		}
		
		if(strpos($_SERVER['REQUEST_URI'],"page/all") != false){
			$m=0;
		
		}
		
		
		
		
	
			$collections=$this->model('db')->getPage(
			'collections',
                        array('id','factory_id','title','novice','sale','action','image'),
						$paging['total'], $m, $paging['npp'],
						array('order' => array('title' => 'ASC'), 'where' => array('novice' => 'yes', 'hidden' => 'no'))
                    );
			$novice=$collections;
			//echo "cat# novice= ".count($novice)."<br>";
				
			foreach($novice as $value){
			//echo $value['factory_id']." --<br>";
				
				
				
				$novice_factories_tmp = $this->model('db')->getList(
                'factories',
                array('title','country_id','url'), array('where' => array('id' => $value['factory_id']))
                    );
				//идентификатор коллекции - наименование фабрики
				$novice_factories[$value['id']]=$novice_factories_tmp[0]['title'];
				//echo $value['id']." + <br>";
				//echo $value['id']." -- ".$sale_factories_tmp[0]['title']."<br>";
				$novice_factories_link[$value['id']]=$novice_factories_tmp[0]['url'];
			
			
			
				$novice_countries_tmp = $this->model('db')->getList(
                'countries',
                array('import_title','url'), array('where' => array('id' => $novice_factories_tmp[0]['country_id']))
                    );
					
				//идентификатор коллекции - наименование страны
				$novice_countries[$value['id']]=$novice_countries_tmp[0]['import_title'];
				$novice_countries_link[$value['id']]=$novice_countries_tmp[0]['url'];
			
			
			
			
			
				$goods_tmp=$this->model('db')->getList(
                       'goods',
                        array('id','title','art','photo','collection_id'), array('order' => array('id' => 'DESC'),'where' => array('hidden' => 'no','collection_id' => $value['id']))
                    );
				foreach($goods_tmp as $value2) {
			
				$novice_prices_tmp=$this->model('db')->getList(
                       'prices2goods',
                        array('price'), array('where' => array('good_id' => $value2["id"],'price_id' => '1'))
                    );
					foreach($novice_prices_tmp as $value3) {
			
						//идентфикатор коллекции -> цена товара
						$novice_prices[$value['id']][]=$value3['price'];
						//echo $value["id"]." -- ".$value3['price']."<br>";
					}
			
				}
			}
			
					
					
		
		$this->page->novice_factories_link=$novice_factories_link;
		$this->page->novice_countries_link=$novice_countries_link;
		$this->page->novice_prices=$novice_prices;
		$this->page->novice_countries=$novice_countries;
		$this->page->novice=$novice;
		$this->page->novice_factories=$novice_factories;
		
		
		//echo count($this->page->novice);
		
		
		$paging['pages'] = ceil($paging['total']/$paging['npp']);
			$paging['curr_page'] = $this->app->request->page > 0 ? $this->app->request->page : 1; 
			$this->page->paging = $paging;
			//echo "paging2<br>"; 
		
		
		
		//страница новинок
		}
		//////////////////////////////////////////////////
		/*
		if(strpos($_SERVER['REQUEST_URI'], "cat/novice")!=false){
		//страница новинок
		
			
			$collections=$this->model('db')->getList(
			'collections',
                        array('id','factory_id','title','novice','sale','action','image'), array('order' => array('title' => 'ASC'), 'where' => array('novice' => 'yes', 'hidden' => 'no'))
                    );
			$novice=$collections;	
			foreach($novice as $value){
			//echo $value['factory_id']." --<br>";
				
				
				
				$novice_factories_tmp = $this->model('db')->getList(
                'factories',
                array('title','country_id','url'), array('where' => array('id' => $value['factory_id']))
                    );
				//идентификатор коллекции - наименование фабрики
				$novice_factories[$value['id']]=$novice_factories_tmp[0]['title'];
				//echo $value['id']." + <br>";
				//echo $value['id']." -- ".$sale_factories_tmp[0]['title']."<br>";
				$novice_factories_link[$value['id']]=$novice_factories_tmp[0]['url'];
			
			
			
				$novice_countries_tmp = $this->model('db')->getList(
                'countries',
                array('import_title','url'), array('where' => array('id' => $novice_factories_tmp[0]['country_id']))
                    );
					
				//идентификатор коллекции - наименование страны
				$novice_countries[$value['id']]=$novice_countries_tmp[0]['import_title'];
				$novice_countries_link[$value['id']]=$novice_countries_tmp[0]['url'];
			
			
			
			
			
				$goods_tmp=$this->model('db')->getList(
                       'goods',
                        array('id','title','art','photo','collection_id'), array('order' => array('id' => 'DESC'),'where' => array('hidden' => 'no','collection_id' => $value['id']))
                    );
				foreach($goods_tmp as $value2) {
			
				$novice_prices_tmp=$this->model('db')->getList(
                       'prices2goods',
                        array('price'), array('where' => array('good_id' => $value2["id"],'price_id' => '1'))
                    );
					foreach($novice_prices_tmp as $value3) {
			
						//идентфикатор коллекции -> цена товара
						$novice_prices[$value['id']][]=$value3['price'];
						//echo $value["id"]." -- ".$value3['price']."<br>";
					}
			
				}
			}
			
					
					
		
		$this->page->novice_factories_link=$novice_factories_link;
		$this->page->novice_countries_link=$novice_countries_link;
		$this->page->novice_prices=$novice_prices;
		$this->page->novice_countries=$novice_countries;
		$this->page->novice=$novice;
		$this->page->novice_factories=$novice_factories;
		
		
		
		
		//страница новинок
		}
		*/
		
		
		if(strpos($_SERVER['REQUEST_URI'], "cat/action")!=false){
		//страница акций
		
		
		
		
			
		$paging = array(
				'total' => 0,
				'from' => 0,
				'npp' => 30,
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
			
		//echo "<pre>";
		///$paging['from']
		//print_r($this);	
		//echo "</pre>";	
		if(strpos($_SERVER['REQUEST_URI'],"page") != false){
			$m=explode("/",trim($_SERVER['REQUEST_URI'],"/"));
			$m=($m[count($m)-1]-1)*30;
		}else{
			$m=0;
		}
		
		if(strpos($_SERVER['REQUEST_URI'],"page/all") != false){
			$m=0;
		
		}
		
		
		
		
			
			$collections=$this->model('db')->getPage(
			'collections',
                        array('id','factory_id','title','novice','sale','action','image'), 
						$paging['total'], $m, $paging['npp'],
						array('order' => array('title' => 'ASC'), 'where' => array('action' => 'yes', 'hidden' => 'no'))
                    );
			$action=$collections;	
			//echo "cat# action= ".count($action)."<br>";
			
			foreach($action as $value){
			//echo $value['factory_id']." --<br>";
				
				
				
				$action_factories_tmp = $this->model('db')->getList(
                'factories',
                array('title','country_id','url'), array('where' => array('id' => $value['factory_id']))
                    );
				//идентификатор коллекции - наименование фабрики
				$action_factories[$value['id']]=$action_factories_tmp[0]['title'];
				//echo $value['id']." + <br>";
				//echo $value['id']." -- ".$sale_factories_tmp[0]['title']."<br>";
				$action_factories_link[$value['id']]=$action_factories_tmp[0]['url'];
			
			
			
				$action_countries_tmp = $this->model('db')->getList(
                'countries',
                array('import_title','url'), array('where' => array('id' => $action_factories_tmp[0]['country_id']))
                    );
					
				//идентификатор коллекции - наименование страны
				$action_countries[$value['id']]=$action_countries_tmp[0]['import_title'];
				$action_countries_link[$value['id']]=$action_countries_tmp[0]['url'];
			
			
			
			
			
				$goods_tmp=$this->model('db')->getList(
                       'goods',
                        array('id','title','art','photo','collection_id'), array('order' => array('id' => 'DESC'),'where' => array('hidden' => 'no','collection_id' => $value['id']))
                    );
				foreach($goods_tmp as $value2) {
			
				$action_prices_tmp=$this->model('db')->getList(
                       'prices2goods',
                        array('price'), array('where' => array('good_id' => $value2["id"],'price_id' => '1'))
                    );
					foreach($action_prices_tmp as $value3) {
			
						//идентфикатор коллекции -> цена товара
						$action_prices[$value['id']][]=$value3['price'];
						//echo $value["id"]." -- ".$value3['price']."<br>";
					}
			
				}
			}
			
					
					
		
		$this->page->action_factories_link=$action_factories_link;
		$this->page->action_countries_link=$action_countries_link;
		$this->page->action_prices=$action_prices;
		$this->page->action_countries=$action_countries;
		$this->page->action=$action;
		$this->page->action_factories=$action_factories;
		
		
		$paging['pages'] = ceil($paging['total']/$paging['npp']);
			$paging['curr_page'] = $this->app->request->page > 0 ? $this->app->request->page : 1; 
			$this->page->paging = $paging;
			//echo "paging3<br>"; 
		
		
		
		//страница акций
		}
		
		
		
		if(strpos($_SERVER['REQUEST_URI'], "cat/country")!=false){
		//страница страны
		//#######
		//страница страны
		}
		
		
		
		
		
		return parent::run();
	}
	
	
	
	public function actionDefault()
	{
		if (count($this->app->request->parr) == 1) {
			$this->Factory($this->app->request->parr[0]);
		} elseif (count($this->app->request->parr) == 2) {
			$this->Collection($this->app->request->parr[0], $this->app->request->parr[1]);
		} else {
			//return $this->actionNotFound(1);
			$this->page->page_content = $this->model('content')->getContentByPath(array('cat'));
			$this->loadView('main', null);
		}
	}
	
	public function actionCountry()
	{
		
		/*
		
		$where['!raw'] = '(countries.id = '.intval($this->app->request->parr[1]).' OR countries.url=\''.mysql_real_escape_string($this->app->request->parr[1]).'\')';
		
		$country = $this->model('db')->GetByCond(
			'countries',
			$this->model('db')->getFieldsNames('countries', 'show_country'),
			array('where' => $where)
		);
		if (empty($country)) return $this->actionNotFound(1);
		$this->CheckURL('country/'.(!empty($country['url']) ? $country['url'] : $country['id']));

        $act_filter = false;
        if ($this->app->request->action) $act_filter = 'action';
        if ($this->app->request->novice) $act_filter = 'novice';
        if ($this->app->request->sale)   $act_filter = 'sale';

        if($act_filter){
            $endis = $this->model('db')->getList(
                'factories',
                $this->model('db')->getFieldsNames('factories', 'list_factory'),
                array('where' => array('factories.country_id' => $country['id'], 'factories.hidden' => 'no'))
            );
			$mya_nuw_arr=array();
			//print_r($this->page->factories);
			//print_r($_SESSION);
		/*	if(file_exists($_SERVER['DOCUMENT_ROOT']."/dilers/".$_SESSION['did'].".td")){
				$file=file_get_contents($_SERVER['DOCUMENT_ROOT']."/dilers/".$_SESSION['did'].".td");
				$data=unserialize($file);
				//print_r($data);
				 for($i=0;$i<count($endis);$i++){
					$goper=0;
					foreach ($data as $val) {if($endis[$i]['id']==$val){$goper="1";}}
					if($goper=="0"){$mya_nuw_arr[]=$endis[$i];}
				 }
			}else{
				
			}*/
		/*	$mya_nuw_arr=$endis;
			//print_r($mya_nuw_arr);
		 $this->page->factories=$mya_nuw_arr;	
			
			
            $this->page->act_filter = $act_filter;
        } else{
           $endis = $this->model('db')->getList(
                'factories',
                $this->model('db')->getFieldsNames('factories', 'list_factory'),
                array('where' => array('factories.country_id' => $country['id'], 'factories.hidden' => 'no'))
            );
			$mya_nuw_arr=array();
			//print_r($this->page->factories);
			//print_r($_SESSION);
			/*if(file_exists($_SERVER['DOCUMENT_ROOT']."/dilers/".$_SESSION['did'].".td")){
				$file=file_get_contents($_SERVER['DOCUMENT_ROOT']."/dilers/".$_SESSION['did'].".td");
				$data=unserialize($file);
				//print_r($data);
				 for($i=0;$i<count($endis);$i++){
					$goper=0;
					foreach ($data as $val) {if($endis[$i]['id']==$val){$goper="1";}}
					if($goper=="0"){$mya_nuw_arr[]=$endis[$i];}
				 }
			}else{
				
			}*/
		/*	$mya_nuw_arr=$endis;
			//print_r($mya_nuw_arr);
		 $this->page->factories=$mya_nuw_arr;
		 */
		 
		 
		/* 
		 	
        }
		
		$this->page->country = $country;
		*/
		
		$paging = array(
				'total' => 0,
				'from' => 0,
				'npp' => 30,
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
			
		
		
		
		
		
		
			$where['!raw'] = '(countries.id = '.intval($this->app->request->parr[1]).' OR countries.url=\''.mysql_real_escape_string($this->app->request->parr[1]).'\')';
			$country = $this->model('db')->GetByCond(
			'countries',
			$this->model('db')->getFieldsNames('countries', 'show_country'),
			array('where' => $where)
			);
			if (empty($country)) return $this->actionNotFound(1);
			$this->CheckURL('country/'.(!empty($country['url']) ? $country['url'] : $country['id']));
			//$country['id'];
			
			
			/*$collections=$this->model('db')->getList(
			'collections',
                        array('id','factory_id','title','novice','sale','action','image'), array('order' => array('title' => 'ASC'), 'where' => array('hidden' => 'no'))
                    );
			*/	
			
			
			$factory_tmp = $this->model('db')->getList(
                'factories',
                array('id','title','country_id','url'), array('where' => array('country_id' => $country['id']))
                    );
			//echo "cat# factory_tmp= ".count($factory_tmp)."<br>";
					
			foreach($factory_tmp as $value){
				$factory_q[]=$value['id'];
			}
			//echo count($factory_q);
			
			
				
			$collections = $this->model('db')->getPage(
					'collections',
					array('id','factory_id','title','novice','sale','action','image'),
					$paging['total'], $paging['from'], $paging['npp'],
					//array('order' => array('title' => 'ASC'), 'where' => array('hidden' => 'no', 'factory' => array('IN', "($factory_q[0], $factory_q[1])") ))
					array('order' => array('title' => 'ASC'), 'where' => array('hidden' => 'no' , 'factory_id' => array('IN', $factory_q, '(?l)')))
					
				);	
			//echo "cat# collections= ".count($collections)."<br>";	
				
				
			//echo "--".count($collections)."<br>";
				
				//	array('where' => array('id' => array('IN', "($id, $iid)"))));
					
			
			foreach($collections as $value){
				//$value['factory_id']
				$factory_tmp = $this->model('db')->getList(
                'factories',
                array('title','country_id','url'), array('where' => array('id' => $value['factory_id']))
                    );
					
				
				$goods_tmp=$this->model('db')->getList(
                       'goods',
                        array('id','title','art','photo','collection_id'), array('order' => array('id' => 'DESC'),'where' => array('hidden' => 'no','collection_id' => $value['id']))
                    );
				foreach($goods_tmp as $value2) {
			
				$action_prices_tmp=$this->model('db')->getList(
                       'prices2goods',
                        array('price'), array('where' => array('good_id' => $value2["id"],'price_id' => '1'))
                    );
					foreach($action_prices_tmp as $value3) {
			
						//идентфикатор коллекции -> цена товара
						$country_collection_prices[$value['id']][]=$value3['price'];
						//echo $value["id"]." -- ".$value3['price']."<br>";
					}
			
				}
				
					
				//$factory_tmp[0]['country_id']
				if($factory_tmp[0]['country_id']==$country['id']){
				  $country_collection[]=$value;	
				  $country_collection_factory_title[]=$factory_tmp[0]['title'];
				  $country_collection_factory_url[]=$factory_tmp[0]['url'];
				  
				  
			//	  print_r($value); echo "<br>";
				}
				
				
			}
			
			
			
			
			
			
			
			
			$country_tmp=$this->model('db')->getList(
			'countries',
                        array('title'), array('where' => array('id' => $country['id']))
                    );
			
		$this->page->country_collection_prices=$country_collection_prices;
		$this->page->country_collection_factory_url=$country_collection_factory_url;
		$this->page->country_collection_factory_title=$country_collection_factory_title;
		$this->page->country_collection_country_name=$country_tmp[0]['title'];	
		$this->page->country_collection=$country_collection;
		
		
		
		
		$paging['pages'] = ceil($paging['total']/$paging['npp']);
			$paging['curr_page'] = $this->app->request->page > 0 ? $this->app->request->page : 1; 
			$this->page->paging = $paging;
			 //echo "paging4<br>";
		
		
		
		
		
		
		$country = $this->model('db')->GetByCond(
			'countries',
			$this->model('db')->getFieldsNames('countries', 'show_country'),
			array('where' => $where)
		);
		$this->page->country = $country;
		
		
		$this->page->content = $this->renderView('country', 'catalog');
		$this->loadView('main', null);
		
		
		
		
	}
	
	public function broke_actionSearch()
	{
		$where = array();
		if (empty($_GET['s'])) {
			$filters = $this->form('filter')->getData();
		
			if (!empty($filters['country']))    $where['factories.country_id'] = $filters['country'];
			if (!empty($filters['purpose']))    $where['purposes.id']          = $filters['purpose'];
			if (!empty($filters['type']))       $where['types.id']             = $filters['type'];
			if (!empty($filters['material']))   $where['materials.id']         = $filters['material'];
			if (!empty($filters['surface']))    $where['surfaces.id']          = $filters['surface'];
			if (!empty($filters['style']))      $where['styles.id']            = $filters['style'];
			//если вбито название коллекции, то сбрасываем все фильтры и ищем только в названии
			if (!empty($filters['collection'])) $where = array('collections.title' => array('LIKE', '%'.$filters['collection'].'%', "?"));
		} else {
			$where['!raw'] = "(collections.title LIKE '%".mysql_real_escape_string($_GET['s'])."%'"
			."OR collections.descr LIKE '%".mysql_real_escape_string($_GET['s'])."%'"
			."OR factories.title LIKE '%".mysql_real_escape_string($_GET['s'])."%'"
			."OR goods.ftitle LIKE '%".mysql_real_escape_string($_GET['s'])."%')";
		}
		$where['collections.hidden'] = 'no';
		$where['factories.hidden'] = 'no';
		$this->page->collection = $this->model('db')->getList(
			'collections',
			$this->model('db')->getFieldsNames('collections', 'search_coll'),
			array('where' => $where)
		);
		
		$this->page->content = $this->renderView('search');
		$this->loadView('main', null);
	}
	

	
	public function Collection($factory_id, $collection_id)
	{
		$collection_id = str_replace($factory_id.'-', '', $collection_id);
		zf::addJS('jquery.lightbox', '/public/site/js/jquery.lightbox.min.js?show_linkback=false&amp;scroll=disabled');
		zf::addCSS('jquery.lightbox', '/public/site/css/jquery.lightbox.css');
		$where = array('factories.hidden' => 'no', 'collections.hidden' => 'no');

		$where['!raw'] = '(factories.id = '.intval($factory_id).' OR factories.url=\''.mysql_real_escape_string($factory_id).'\')'
			.' AND (collections.id = '.intval($collection_id).' OR collections.url=\''.mysql_real_escape_string($collection_id).'\')';
		
		
    	$collection = $this->model('db')->GetByCond(
			'collections',
			$this->model('db')->getFieldsNames('collections', 'show_coll'),
			array('where' => $where)
		);

		if (empty($collection)) return $this->actionNotFound(1);
		$this->CheckURL(
			(!empty($collection['factory_url']) ? $collection['factory_url'] : $collection['factory_id'])
			.'/'
			.(!empty($collection['factory_url']) ? $collection['factory_url'] : $collection['factory_id'])
			.'-'
			.(!empty($collection['url']) ? $collection['url'] : $collection['id'])
		);
		$goods = $this->model('db')->getGoodsCollection($collection['id']);
		
		$factory = $this->model('db')->GetByCond(
			'factories',
			$this->model('db')->getFieldsNames('factories', 'show_factory'),
			array('where' => array('factories.id' => $collection['factory_id'])),
			1
		);
		
		$meta['title'] = "Керамическая плитка {$collection['factory_title']} {$collection['title']}";
		$this->page->meta   = $meta;
		$this->page->country = $this->model('db')->GetByCond(
			'countries',
			$this->model('db')->getFieldsNames('countries', 'show_country'),
			array('where' => array('countries.id' => $factory['country_id'])),
			1
		);
		//print_r($this->model('db')->query);
		//$this->model('db')->query("SELECT el.id, el.photo, el.ftitle FROM ad_goods AS el WHERE el.id in (SELECT data  FROM ad_svyaz WHERE id_element = '".$collection['id']."') ")
		//print_r($raw_data);

		$raw_data  = zf::$db->query("SELECT el.id, el.photo,el.collection_id, el.ftitle FROM ad_goods AS el WHERE el.id in (SELECT data  FROM ad_svyaz WHERE id_element = '".$collection['id']."') ");
		$cont="";
			foreach ($raw_data as $el) {
				$price  = zf::$db->query("SELECT price FROM ad_prices2goods WHERE good_id ='".$el['id']."' AND price_id ='1' LIMIT 1");
				$ad_collections  = zf::$db->query("SELECT factory_id, url FROM ad_collections WHERE id ='".$el['collection_id']."' LIMIT 1");
				//echo $el['collection_id'];
				//print_r($ad_collections);
				$ad_factories  = zf::$db->query("SELECT url FROM ad_factories WHERE id ='".$ad_collections[0]['factory_id']."' LIMIT 1");
				//echo "SELECT price FROM ad_prices2goods WHERE good_id ='".$el['id']."' AND price_id ='1' LIMIT 1<br>";
				//print_R($price);
				//exit();
				$cont.='<div class="one_good" id="one_good_308493" style="width: 200px;float: left;padding-right:10px;">
							<a style="display: block;min-height: 62px;" href="'.str_replace("[dir]","original",$el['photo']).'" rel="lightbox-gallery" title="'.$el['ftitle'].'">
								<img style="width: 200px;height: 200px;" src="'.str_replace("[dir]","small",$el['photo']).'" alt="'.$el['ftitle'].'">
							</a>
							<div class="title"><span style="cursor:pointer;" class="title" onclick="document.location.href=\'http://artisan-project.ru/cat/'.$ad_factories[0]['url'].'/'.$ad_factories[0]['url'].'-'.$ad_collections[0]['url'].'/\'">'.$el['ftitle'].'</span></div>
							<div class="price">
								<span class="price">
									<span><span style="font-weight:bold;">'.$price[0]['price'].'*</span>руб./шт</span>
								</span>
							</div>
							<br>
						</div>';
			}
		if($cont!=""){
			$collection['svyaz']='<div class="svayz"><H3>Cопутствующие товары</H3>'.$cont.'</div><div style="width:100%;clear:both"></div>';
		}
		
		echo $conts;
		$this->page->factory = $factory;
		$this->page->collection = $collection;
		$this->page->goods = $goods;
		//$this->page->svyaz = $conts;
		$this->page->smarty()->caching = true;
		if (!(
			$this->page->smarty()->is_cached(ROOT_PATH.'site/views/catalog/collection.tpl', $collection['id'])
			and !empty($this->app->conf['modes'][$this->app->mode]['smarty']['partial_caching'])
		)) {
			file_put_contents('./site/views/collections/'.$collection['id'].'.tpl', $collection['layout']);
			$this->page->layout = $this->renderView($collection['id'], 'collections');
		}
		$this->page->smarty()->caching = false;
		$this->page->content = $this->renderView('collection', 'catalog', $collection['id']);
		$this->loadView('main', null);
	}

	public function Factory($factory_id)
	{
		$where = array('factories.hidden' => 'no');

		$where['!raw'] = '(factories.id = '.intval($factory_id).' OR factories.url=\''.mysql_real_escape_string($factory_id).'\')';
		
		$factory = $this->model('db')->GetByCond(
			'factories',
			$this->model('db')->getFieldsNames('factories', 'show_factory'),
			array('where' => $where)
		);
		if (empty($factory)) return $this->actionNotFound(1);
		$this->CheckURL((!empty($factory['url']) ? $factory['url'] : $factory['id']));

		$raw = array();
		$where = array(
			'factory_id' => $factory['id'],
			'collections.hidden' => 'no'
		);
		if ($this->app->request->action){
            $where['action'] = 'yes';
            $this->page->act_filter = 'action';
        }
		if ($this->app->request->novice){
            $where['novice'] = 'yes';
            $this->page->act_filter = 'action';
        }
		if ($this->app->request->sale){
            $where['sale'] = 'yes';
            $this->page->act_filter = 'action';
        }
		
		
		
		$paging = array(
				'total' => 0,
				'from' => 0,
				'npp' => 30,
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
			
		
		
		$collections = $this->model('db')->getPage(
			'collections',
			$this->model('db')->getFieldsNames('collections', 'list_coll'),
			$paging['total'], $paging['from'], $paging['npp'],
			array('where' => $where, 'order' => array('collections.title' => 'asc'))
		);

        //формируем поля action, sale, novice в зависимости от дат
        $valuesAction = $this->model('catalog', 'catalog')->valuesAction;
        foreach($collections as $colKey => $col)
        {
            foreach($valuesAction as $actionKey => $val)
            {
                if (!empty($col['date_start_'.$actionKey]) && !empty($col['date_end_'.$actionKey]) && !empty($col[$actionKey]) && $col[$actionKey] == 'yes'){
                    $curr_time = time();
                    if (!(strtotime($col['date_start_'.$actionKey]) <= $curr_time && $curr_time <= strtotime($col['date_end_'.$actionKey]))){
                        $collections[$colKey][$actionKey] = 'no';
                    }
                } else {
                    $collections[$colKey][$actionKey] = 'no';
                }
            }
			
			
			
			
			$goods_tmp=$this->model('db')->getList(
                       'goods',
                        array('id'), array('order' => array('id' => 'DESC'),'where' => array('hidden' => 'no','collection_id' => $collections[$colKey]['id']))
                    );
			unset($tmp);
			foreach($goods_tmp as $v){
				$tmp[]=$v['id'];
			}
		
		
			$prices1=$this->model('db')->getList(
                       'prices2goods',
                        array('price'), array('where' => array('price_id' => '1', 'good_id' => array('IN', $tmp, '(?l)')))
                    );
					
			unset($tmp);
			foreach($prices1 as $v){
				$tmp[]=$v['price'];
			}
			sort($tmp);
			$price=$tmp[0];
			
			
			
			$collections[$colKey]['price']=$price;
			
			
        }
		
		
		 
		
		$this->page->collections = $collections;
		$meta['title'] = "Керамическая плитка {$factory['title']}: ";
		$meta_title_collections = array();
		foreach ($this->page->collections as $col) {
			$meta_title_collections[] = $col['title'];
		}
		$meta['title'] .= implode(', ', $meta_title_collections);
		$this->page->meta   = $meta;
		$this->page->country = $this->model('db')->GetByCond(
			'countries',
			$this->model('db')->getFieldsNames('countries', 'show_country'),
			array('where' => array('countries.id' => $factory['country_id'])),
			1
		);
		
		
		
		$paging['pages'] = ceil($paging['total']/$paging['npp']);
			$paging['curr_page'] = $this->app->request->page > 0 ? $this->app->request->page : 1; 
			$this->page->paging = $paging;
			//echo "paging5<br>"; 
		
		
		$this->page->factory = $factory;
		$this->page->content = $this->renderView('factory', 'catalog');
		$this->loadView('main', null);
		
		
		
		
	}

    public function actionAction_nov_sale(){
        $valuesAction = $this->model('catalog', 'catalog')->valuesAction;
        if (!empty($_GET) && !empty($_GET['act']) && array_key_exists ($_GET['act'], $valuesAction)){
            $this->page->curr_action = $curr_action = $_GET['act'];
            $where = array('factories.hidden' => 'no', 'collections.hidden' => 'no');
            $where[$curr_action] = 'yes';
            //$where['!raw'] = "date_start_" . $curr_action . "<=now() AND date_end_" . $curr_action . ">=now()";
            $collections = $this->model('db')->getList(
                'collections',
                $this->model('db')->getFieldsNames('collections', 'list_coll_action'),
                array('where' => $where)
            );
            if (!empty($collections)){
                foreach($collections as $colKey => $col)
                {
                    foreach($valuesAction as $actionKey => $val)
                    {
                        if (!empty($col['date_start_'.$actionKey]) && !empty($col['date_end_'.$actionKey]) && !empty($col[$actionKey]) && $col[$actionKey] == 'yes'){
                            $curr_time = time();
                            if (!(strtotime($col['date_start_'.$actionKey]) <= $curr_time && $curr_time <= strtotime($col['date_end_'.$actionKey]))){
                                $collections[$colKey][$actionKey] = 'no';
                            }
                        } else {
                            $collections[$colKey][$actionKey] = 'no';
                        }
                    }
                }
            }
            $this->page->action_type = htmlspecialchars($_GET['act']);
            $this->page->collections = $collections;
            $this->page->content = $this->renderView('action', null);
            $this->loadView('main', null);
        }  else {
            return $this->actionNotFound();
        }

    }

	private function CheckURL($uri)
	{
		$url = "{$this->ctrlName}/$uri";
		if ($this->app->request->action) $url .= '/action/yes';
		if ($this->app->request->novice) $url .= '/novice/yes';
		if ($this->app->request->sale)   $url .= '/sale/yes';
		$url = '/'.trim($url, '/').'/';
		
		if ($url != $_SERVER['REQUEST_URI']) {
			//header('Location: '.$url, null, 301);
		}
	}


	public function actionActions()
	{
		$where = array('collections.hidden' => 'no');
		if ($this->app->request->action) $where['action'] = 'yes';
		if ($this->app->request->novice) $where['novice'] = 'yes';
		if ($this->app->request->sale)   $where['sale'] = 'yes';

		$this->CheckURL('actions');

		$this->page->collections = $this->model('db')->getList(
			'collections',
			$this->model('db')->getFieldsNames('collections', 'actions_coll'),
			array('where' => $where)
		);
		
		$this->page->content = $this->renderView('actions', 'catalog');
		$this->loadView('main', null);
	}

	public function broke_actionSearch_good()
	{
		$cart = json_decode(stripslashes($_COOKIE['cart']), true);
		$cart_ids = array();
		for ($i = 0; $i < count($cart); $i++) {
			$cart_ids[] = $cart[$i]['id'];
		}
		$this->page->cart_ids = $cart_ids;
		if (!empty($_POST['factory_id']) or !empty($_POST['collection_id'])) {
			$goods = $this->model()->getList(
				'goods',
				$this->model()->getFieldsNames('goods', 'cart_search'),
				array('where' => array(
					'collection_id' => $_POST['collection_id'],
					'goods.title' => array('LIKE ', '%'.$_POST['s'].'%', '?'),
					'goods.hidden' => 'no'
				))
			);
		}

		if (!empty($_POST['factory_id'])) {
			$this->page->collections = $this->model()->getList(
				'collections',
				$this->model()->getFieldsNames('collections', 'search'),
				array('where' => array('factory_id' => $_POST['factory_id'], 'collections.hidden' => 'no'))
			);

			if (!isset($goods) and !empty($_POST['s'])) {
				$goods = $this->model()->getList(
					'goods',
					$this->model()->getFieldsNames('goods', 'cart_search'),
					array('where' => array(
						'factory_id' => $_POST['factory_id'],
						'goods.ftitle' => array('LIKE ', '%'.$_POST['s'].'%', '?'),
						'goods.hidden' => 'no'
					))
				);
			}
		}
		if (!isset($goods) and !empty($_POST['s']) and empty($_POST['factory_id'])) {
			$goods = $this->model()->getList(
				'goods',
				$this->model()->getFieldsNames('goods', 'cart_search'),
				array('where' => array(
					'goods.ftitle' => array('LIKE ', '%'.$_POST['s'].'%', '?'),
					'goods.hidden' => 'no'
				))
			);
		}
		if (!isset($goods)) {
			$goods = array();
		}
		$this->page->factories = $this->model()->getList(
			'factories',
			$this->model()->getFieldsNames('factories', 'search'),
			array('where' => array('factories.hidden' => 'no'))
		);

		$this->page->goods = $goods ;

		$this->page->good_fields = $this->model()->getFields('goods', 'cart_search');
		if ($this->app->request->ajax) {
			$this->loadView('catalog_search');
		} else {
			$this->page->content = $this->renderView('catalog_search');
			$this->loadView('main', null);
		}
	}
	
	public function actionElement()
	{
		$good = $this->model('db')->GetByCond('goods', array('id', 'collection_id', 'collection_url', 'factory_id', 'factory_url'), array('goods.id' => $this->app->request->parr[1]));
		header('Location: '.zf::$root_url.$this->ctrlName.'/'.(!empty($good['factory_url']) ? $good['factory_url'] : $good['factory_id']).'/'.(!empty($good['collection_url'])? $good['collection_url'] : $good['collection_id']).'/'."#one_good_{$good['id']}");
	}
	
	public function actionNotFound($loadView = 0)
	{
		parent::actionNotFound(0);
		$this->loadView('404', null);
	}
}