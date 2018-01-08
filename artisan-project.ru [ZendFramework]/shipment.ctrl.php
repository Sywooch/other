<?php
class ShipmentController extends Site_Controller
{
	
	
	/*
	public function actionDefault()
	{
		zf::addJS('jquery.simplemodal', '/public/site/js/jquery.simplemodal.js');
		zf::addCSS('jquery.simplemodal', '/public/site/css/jquery.simplemodal.css');
        zf::addJS('shipment', '/public/site/js/shipment.js');
		$paging = array(
				'total' => 0,
				'from' => 0,
				'npp' => 20,
				'base_url' => zf::$root_url."{$this->ctrlName}/page/",
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
		$paging['from'] = $this->app->request->page > 0 ? ($this->app->request->page-1)*$paging['npp'] : 0;
        
        // получаем поля для формы заказа
        $this->model()->initValues(array('type_id', 'prep_id'));
        $reg_form = $this->model('shipment')->getFields('shipment', 'add');
        $this->loadForm('shipment_form', $reg_form, empty($_POST) ? (isset($request) ? $request : array()) : $_POST, '', 'post');
        // если POST не пустой - сохраняем заявку
        if(!empty($_POST)){
            if(empty($_POST['reqs'])){
                $this->page->shipment_error = 'Заявку создать не удалось, нет выбранных товаров.'; 
            }
            else if (!$this->form('shipment_form')->validate()) {
                $this->page->form_errors = $this->form('shipment_form')->getErrors();
                $this->page->shipment_error = 'Заявку создать не удалось, не все поля заполнены.';
                
                // при ошибке сохраняем отмеченные позиции
                $ship_sel = $_POST['reqs'];
                foreach($ship_sel as $k => $v) {
                    // меняем ключ/значение, потому что в шаблоне проще использовать isset, вместо поиска по массиву
                    $ship_sel[$k] = array_flip($v);
                }
                $this->page->ship_sel = $ship_sel;
            }
            else {
                $ship_data = $this->form('shipment_form')->getData();
                
                $ship_data['dealer_id'] = $this->page->dealer['id'];
                $ship_data['comment'] = str_replace(';',' ',$ship_data['comment']);
                $id = $this->model('shipment')->Save('shipment', $ship_data);
                $this->page->shipment_id = $id;
                
                $ship_goods = $_POST['reqs'];
                foreach($ship_goods as $req_id => $req){
                    foreach($req as $key => $good_id){
                        $this->model('shipment')->Save('shipment_goods', array('ship_id' => $id, 'req_id' => $req_id, 'good_id' => $good_id, 'is_blocked' => 'yes'));
                    }
                    $this->model('requests')->Save('requests', array('status' => 'shipment_prep'), array('id' => $req_id));
                }
                $type = $this->model()->getList('shipment_types', array(), array('where' => array('id' => $ship_data['type_id'])));
                $prep = $this->model()->getList('shipment_preps', array(), array('where' => array('id' => $ship_data['prep_id'])));
                $dealer = $this->model('dealers', 'dealers')->getList('dealers', array('title'), array('where' => array('id' => $this->page->dealer['id'])));
                $data_to_send = array(
                    'ship_id' => $id,
                    'diler_title' => $dealer[0]['title'],
                    'sdate' => $ship_data['sdate'],
                    'type' => $type[0]['title'],
                    'prep' => $prep[0]['title'],
//                    'adress' => $ship_data['adress'],
                    'comment' => $ship_data['comment'],
                );   
                $mail = $this->page->settings['email_to_shipments'];//'aleshin@artektiv.ru, test739@mail.ru';
                $this->model()->SendMail($mail, $data_to_send, 'new_shipment'); 
            }
        }
        $ar_fields = $this->model('requests')->getFields('requests', 'archives');
        $ar_fields['status']['values']['new'] = 'В обработке';
        $ar_fields['status']['values']['shipment_prep'] = 'Подготовка к отгрузке';
        $ar_fields['status']['values']['reserved'] = 'Зарезервировано';   
        
		
		
		
		
		// получаем список заявок
		$shipments = array(
			'fields' => $ar_fields,
			'data'   => $this->model('requests')->getPage(
				'requests',
				$this->model('requests')->getFieldsNames('requests', 'archives'),
				$paging['total'], $paging['from'], $paging['npp'],
				array('where' => array('dealer_id' => $this->page->dealer['id'], 'cid' => array('IS', null, '?i'), 'paid' => 'yes'),
					//'where' => array('dealer_id' => $this->page->dealer['id'], 'cid' => array('IS', null, '?i'), 'status' => array('IN', array('paid', 'shipment_prep', 'partly_shipped'), '(?l)')),
					'order' => array('cdate' => 'desc'),
					'group' => array('requests.id')
				)
			)
		);
        $ids = array();
        $requests = array();
        foreach($shipments['data'] as $key => $request){
                $requests[$request['id']] = $request;
                $ids[] = $request['id'];
        }
	    $corrs = $this->model('requests')->getList(
            'requests',
            $this->model('requests')->getFieldsNames('requests', 'archives'),
            array(
                'where' => array('cid' => array('IN', $ids, '(?l)')),
                'order' => array('cid' => 'asc'),
                'group' => array('requests.id')
            )
        );
        if (!empty($corrs)) {
            foreach ($corrs as $r) {
                if ($r['cid'] and $r['id']) {
                    $requests[$r['cid']]['corrs'][$r['id']] = $r;
                }
            }
        }
        
        // для каждой заявки получаем список товаров
        foreach($requests as $req_id => $values){        
            $goods = array(
                'fields' => $this->model('requests')->getFields('requests_goods', 'archive'),
                'data'  => $this->model('requests')->getList(
                    'requests_goods',
                    $this->model('requests')->getFieldsNames('requests_goods', 'archive'),
                    array('where' => array(
                        'requests_goods.request_id'    => $req_id,
                    ), 'order' => array('delivery_date' => 'asc'))
                )
            );
            $blocked = $this->model()->getList('shipment_goods', array('good_id'), array('where' => array('req_id' => $req_id, 'is_blocked' => 'yes')));
            if(!empty($blocked)){
                foreach($blocked as $key => $values2){
                    $goods['data'][$values2['good_id']]['blocked'] = 1;
                }
            }
            $requests[$req_id]['goods']['fields'] = $goods['fields'];
            $remains_actual = $this->model('requests', 'requests')->getRemainsActual(array($req_id));
            foreach($goods['data'] as $good => $values2){
                $requests[$req_id]['goods']['data'][$good] = $values2;
                $requests[$req_id]['goods']['data'][$good]['remains'] = $remains_actual[$good];
                
                //debug::dump($values);
                if ($values['discount']) {
                    $discount = (100 - $values['discount']) / 100;
                        $requests[$req_id]['goods']['data'][$good]['good_price'] = round($values2['good_price'] * $discount, 2);
                }
            }
        }
        //debug::dump($requests);
        $shipments['data'] = $requests;
        $this->page->shipments = $shipments;
        
        
		$paging['pages'] = ceil($paging['total']/$paging['npp']);
		$paging['curr_page'] = $this->app->request->page > 0 ? $this->app->request->page : 1;
		
		$this->page->paging = $paging;
		$this->page->content = $this->renderView('list');
		$this->loadView('main', null);
	}
	*/
	
	public function actionDefault()
	{
		zf::addJS('jquery.simplemodal', '/public/site/js/jquery.simplemodal.js');
		zf::addCSS('jquery.simplemodal', '/public/site/css/jquery.simplemodal.css');
        zf::addJS('shipment', '/public/site/js/shipment.js');
		$paging = array(
				'total' => 0,
				'from' => 0,
				'npp' => 20,
				'base_url' => zf::$root_url."{$this->ctrlName}/page/",
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
		$paging['from'] = $this->app->request->page > 0 ? ($this->app->request->page-1)*$paging['npp'] : 0;
        
        // получаем поля для формы заказа
        $this->model()->initValues(array('type_id', 'prep_id'));
        $reg_form = $this->model('shipment')->getFields('shipment', 'add');
        $this->loadForm('shipment_form', $reg_form, empty($_POST) ? (isset($request) ? $request : array()) : $_POST, '', 'post');
        // если POST не пустой - сохраняем заявку
        if(!empty($_POST)){
            if(empty($_POST['reqs'])){
                $this->page->shipment_error = 'Заявку создать не удалось, нет выбранных товаров.'; 
            }
            else if (!$this->form('shipment_form')->validate()) {
                $this->page->form_errors = $this->form('shipment_form')->getErrors();
                $this->page->shipment_error = 'Заявку создать не удалось, не все поля заполнены.';
                
                // при ошибке сохраняем отмеченные позиции
                $ship_sel = $_POST['reqs'];
                foreach($ship_sel as $k => $v) {
                    // меняем ключ/значение, потому что в шаблоне проще использовать isset, вместо поиска по массиву
                    $ship_sel[$k] = array_flip($v);
                }
                $this->page->ship_sel = $ship_sel;
            }
            else {
                $ship_data = $this->form('shipment_form')->getData();
                
                $ship_data['dealer_id'] = $this->page->dealer['id'];
                $ship_data['comment'] = str_replace(';',' ',$ship_data['comment']);
                $id = $this->model('shipment')->Save('shipment', $ship_data);
                $this->page->shipment_id = $id;
                
                $ship_goods = $_POST['reqs'];
                foreach($ship_goods as $req_id => $req){
                    foreach($req as $key => $good_id){
                        $this->model('shipment')->Save('shipment_goods', array('ship_id' => $id, 'req_id' => $req_id, 'good_id' => $good_id, 'is_blocked' => 'yes'));
                    }
                    $this->model('requests')->Save('requests', array('status' => 'shipment_prep'), array('id' => $req_id));
                }
                $type = $this->model()->getList('shipment_types', array(), array('where' => array('id' => $ship_data['type_id'])));
                $prep = $this->model()->getList('shipment_preps', array(), array('where' => array('id' => $ship_data['prep_id'])));
                $dealer = $this->model('dealers', 'dealers')->getList('dealers', array('title'), array('where' => array('id' => $this->page->dealer['id'])));
                $data_to_send = array(
                    'ship_id' => $id,
                    'diler_title' => $dealer[0]['title'],
                    'sdate' => $ship_data['sdate'],
                    'type' => $type[0]['title'],
                    'prep' => $prep[0]['title'],
//                    'adress' => $ship_data['adress'],
                    'comment' => $ship_data['comment'],
                );   
                $mail = $this->page->settings['email_to_shipments'];//'aleshin@artektiv.ru, test739@mail.ru';
                $this->model()->SendMail($mail, $data_to_send, 'new_shipment'); 
            }
        }
        $ar_fields = $this->model('requests')->getFields('requests', 'archives');
        $ar_fields['status']['values']['new'] = 'В обработке';
        $ar_fields['status']['values']['shipment_prep'] = 'Подготовка к отгрузке';
        $ar_fields['status']['values']['reserved'] = 'Зарезервировано';   
        
		
		
		
		
		// получаем список заявок
		$shipments = array(
			'fields' => $ar_fields,
			'data'   => $this->model('requests')->getPage(
				'requests',
				$this->model('requests')->getFieldsNames('requests', 'archives'),
				$paging['total'], $paging['from'], $paging['npp'],
				array(//'where' => array('dealer_id' => $this->page->dealer['id'], 'cid' => array('IS', null, '?i'), 'paid' => 'yes'),
					'where' => array('dealer_id' => $this->page->dealer['id'], 'cid' => array('IS', null, '?i'), 'status' => array('IN', array('paid', 'shipment_prep', 'partly_shipped'), '(?l)')),
					'order' => array('cdate' => 'desc'),
					'group' => array('requests.id')
				)
			)
		);
       
	   
	   
		
		$shipments2 = array(
			'fields' => $ar_fields,
			'data'   => $this->model('requests')->getPage(
				'requests',
				$this->model('requests')->getFieldsNames('requests', 'archives'),
				$paging['total'], $paging['from'], $paging['npp'],
				array('where' => array('dealer_id' => $this->page->dealer['id'], 'status' => 'reserved'),
					//'where' => array('dealer_id' => $this->page->dealer['id'], 'cid' => array('IS', null, '?i'), 'status' => array('IN', array('paid', 'shipment_prep', 'partly_shipped'), '(?l)')),
					'order' => array('cdate' => 'desc'),
					'group' => array('requests.id')
				)
			)
		);
		
		
		
		//echo "<pre>";
		//print_r($shipments2);
		//echo "</pre>";
		
		
		//$shipments=array_merge($shipments, $shipments2);
		
		
		
		
		
		
		
        $ids = array();
        $requests = array();
        foreach($shipments['data'] as $key => $request){
                $requests[$request['id']] = $request;
                $ids[] = $request['id'];
        }
	    $corrs = $this->model('requests')->getList(
            'requests',
            $this->model('requests')->getFieldsNames('requests', 'archives'),
            array(
                'where' => array('cid' => array('IN', $ids, '(?l)')),
                'order' => array('cid' => 'asc'),
                'group' => array('requests.id')
            )
        );
        if (!empty($corrs)) {
            foreach ($corrs as $r) {
                if ($r['cid'] and $r['id']) {
                    $requests[$r['cid']]['corrs'][$r['id']] = $r;
                }
            }
        }
       
	   
	   /*
	   // для каждой заявки получаем список товаров
        foreach($requests as $req_id => $values){        
            $goods = array(
                'fields' => $this->model('requests')->getFields('requests_goods', 'archive'),
                'data'  => $this->model('requests')->getList(
                    'requests_goods',
                    $this->model('requests')->getFieldsNames('requests_goods', 'archive'),
                    array('where' => array(
                        'requests_goods.request_id'    => $req_id,
                    ), 'order' => array('delivery_date' => 'asc'))
                )
            );
            $blocked = $this->model()->getList('shipment_goods', array('good_id'), array('where' => array('req_id' => $req_id, 'is_blocked' => 'yes')));
            if(!empty($blocked)){
                foreach($blocked as $key => $values2){
                    $goods['data'][$values2['good_id']]['blocked'] = 1;
                }
            }
            $requests[$req_id]['goods']['fields'] = $goods['fields'];
            $remains_actual = $this->model('requests', 'requests')->getRemainsActual(array($req_id));
			$sens='';
			
			//echo "==".$req_id."==<br>";
				
				
				$tmp_2 = $this->model('requests')->getList(
                'requests_bills',
                array(),
				array(
                        'where' => array('req_id' => $req_id)
                       
                    )
            	);
				
				
				$requests[$req_id]['docs']=$tmp_2;
				
			
            foreach($goods['data'] as $good => $values2){
				
				//echo "<pre>";
				//print_r($values2);
				//echo "</pre>";
				//echo $values2['good_id']."==<br>";
				$tmp_good = zf::$db->query("SELECT * FROM ad_goods WHERE id='".$values2['good_id']."' AND art='".$values2['good_art']."' ");
				if(count($tmp_good)!=0){
				
					$packCntByUnit=$tmp_good[0]['packCntByUnit'];
					$packCntByCount=$tmp_good[0]['packCntByCount'];
				
				}else{
					$tmp_good = zf::$db->query("SELECT * FROM ad_goods_to_order WHERE id='".$values2['good_id']."' ");
					$packCntByUnit=$tmp_good[0]['packCntByUnit'];
					$packCntByCount=$tmp_good[0]['packCntByCount'];
					
				}
				
				//echo $packCntByUnit." == ".$packCntByCount."<br>";
				
				$values2['count_pack']=$packCntByUnit;
				$values2['count_unit']=$packCntByCount;
				//$goods['data'][$good]['count_pack']=$packCntByUnit;
				//$goods['data'][$good]['count_unit']=$packCntByCount;
				
				//$packCntByUnit." == ".$packCntByCount.
				
				
				if($requests[$req_id]['status']=="partly_shipped"){
				//проверить, отгружался ли данный товар
					//$good  - идентификатор товара
					 
					$tmp = $this->model('shipment')->getList(
                    	'shipment_goods',
                    	array('id'),
                    	array('where' => array(
                        	'req_id'    => $req_id,
							'good_id'   => $good
							))
                	
            		);
					if(count($tmp)>0){
							continue;
							
					}
					
					
				}
				
				
				
                $requests[$req_id]['goods']['data'][$good] = $values2;
                $requests[$req_id]['goods']['data'][$good]['remains'] = $remains_actual[$good];
                if($requests[$req_id]['goods']['data'][$good]['remains']!="" && ($requests[$req_id]['goods']['data'][$good]['good_count']/1)>$requests[$req_id]['goods']['data'][$good]['remains']){
					$sens='alert';
					
				}
                //debug::dump($values);
                if ($values['discount']) {
                    $discount = (100 - $values['discount']) / 100;
                        $requests[$req_id]['goods']['data'][$good]['good_price'] = round($values2['good_price'] * $discount, 2);
                }
				//echo $requests[$req_id]['goods']['data'][$good]['good_title']."=<br>";
				//добавить сведения об остатке (в том числе и резерв)
				//echo "<pre>";
				//print_r($requests[$req_id]['goods']['data'][$good]);
				//echo "</pre>";
				
				$good_id=$requests[$req_id]['goods']['data'][$good]['good_id'];
				
				$remains1=$this->model('db')->getList(
                       'remains',
                        array('store_id','stock','reserve'), array('where' => array('good_id' => $good_id))
                    );
				foreach($remains1 as $value2) {
					if($value2['store_id']==1){
						$stock_1[$good_id]['ad']=$value2['stock'];
						$reserve_1[$good_id]['ad']=$value2['reserve'];
					}else{
						$stock_1[$good_id]['stock']=$value2['stock'];
						$reserve_1[$good_id]['store']=$value2['store_id'];
						$reserve_1[$good_id]['reserve']=$value2['reserve'];
					}
				
				}
				
				$ostatok=floor($stock_1[$good_id]['ad']+$reserve_1[$good_id]['ad']);
				$ostatok=number_format($ostatok, 0);
				
				$requests[$req_id]['goods']['data'][$good]['ostatok']=$ostatok;
				
				
				
				//дата ближайшей поставки
				$delivery_date1=$this->model('db')->getList(
                       'stores',
                        array('delivery_date'), array('where' => array('id' => $reserve_1[$good_id]['store']))
                    );
				foreach($delivery_date1 as $value2) {
				
					//идентификатор товара - дата ближайшей поставки
					$delivery_date_12[$good_id]=$value2['delivery_date'];
					
				
				}
				
				
				$postavka=$delivery_date_12[$good_id];
				$requests[$req_id]['goods']['data'][$good]['postavka']=$postavka;
				
				$requests[$req_id]['goods']['data'][$good]['good_count']=floor($requests[$req_id]['goods']['data'][$good]['good_count']);
				$requests[$req_id]['goods']['data'][$good]['good_count']=number_format($requests[$req_id]['goods']['data'][$good]['good_count'], 0);
				
				
            }
			$requests[$req_id]['alert']=$sens;
			
			//echo $requests[$req_id]['status']." = ".$requests[$req_id]['status_title_dealer']."=<br>";
			
			if($requests[$req_id]['status']=="partly_shipped"){
			//частичная отгрузка
				
				$requests[$req_id]['status_title_dealer']="Частичная отгрузка";	
				
				//вычисление количества оставшихся товаров
				$all=$requests[$req_id]['goods_count'];
				$sended_g=0;
				$goods = array(
                	'fields' => $this->model('requests')->getFields('requests_goods', 'archive'),
                	'data'  => $this->model('requests')->getList(
                    	'requests_goods',
                    	$this->model('requests')->getFieldsNames('requests_goods', 'archive'),
                    	array('where' => array(
                        	'requests_goods.request_id'    => $req_id,
                    		), 'order' => array('delivery_date' => 'asc'))
                )
            	);
				
				
				foreach($goods['data'] as $good => $values2){
					$good_id=$values2['good_id'];///идентификатор товара
					//$req_id - идентификатор счёта
					//проверить не производилась ли отправка этого товара
					$tmp = $this->model('shipment')->getList(
                    	'shipment_goods',
                    	array('id'),
                    	array('where' => array(
                        	'req_id'    => $req_id,
							'good_id'   => $good_id
							))
                	
            		);
					if(count($tmp)>0){
							$sended_g++;
					}
					
				}
				
				$ost_g=$all-$sended_g;
				//echo "=".$ost_g."=";
				$requests[$req_id]['goods_count']=$ost_g;
				$requests[$req_id]['goods_count_text']="позиций";
				
				
				//
				$tmp = $this->model('shipment')->getList(
                    	'shipment_goods',
                    	array('id','ship_id'),
                    	array('where' => array(
                        	'req_id'    => $req_id
							),'order' => array('id' => 'desc'))
                	
            		);
				
				$ship_id=$tmp[0]['ship_id'];
				$requests[$req_id]['shipment_number']=$ship_id;
				
				$tmp = $this->model('shipment')->getList(
                    	'shipment',
                    	array('sdate'),
                    	array('where' => array(
                        	'id'    => $ship_id
							))
                	
            		);
				$requests[$req_id]['shipment_date']=$tmp[0]['sdate'];
				
				
				
				
			//частичная отгрузка	
			}
			
			
			
        }
		*/
		
		
		
		// для каждой заявки получаем список товаров
        foreach($requests as $req_id => $values){        
            $goods = array(
                'fields' => $this->model('requests')->getFields('requests_goods', 'archive'),
                'data'  => $this->model('requests')->getList(
                    'requests_goods',
                    $this->model('requests')->getFieldsNames('requests_goods', 'archive'),
                    array('where' => array(
                        'requests_goods.request_id'    => $req_id,
                    ), 'order' => array('delivery_date' => 'asc'))
                )
            );
            $blocked = $this->model()->getList('shipment_goods', array('good_id'), array('where' => array('req_id' => $req_id, 'is_blocked' => 'yes')));
            if(!empty($blocked)){
                foreach($blocked as $key => $values2){
                    $goods['data'][$values2['good_id']]['blocked'] = 1;
                }
            }
            $requests[$req_id]['goods']['fields'] = $goods['fields'];
            $remains_actual = $this->model('requests', 'requests')->getRemainsActual(array($req_id));
            foreach($goods['data'] as $good => $values2){
                $requests[$req_id]['goods']['data'][$good] = $values2;
                $requests[$req_id]['goods']['data'][$good]['remains'] = $remains_actual[$good];
                
                //debug::dump($values);
                if ($values['discount']) {
                    $discount = (100 - $values['discount']) / 100;
                        $requests[$req_id]['goods']['data'][$good]['good_price'] = round($values2['good_price'] * $discount, 2);
                }
            }
			
			
			
			if($requests[$req_id]['status']=="partly_shipped"){
			//частичная отгрузка
				
				$requests[$req_id]['status_title_dealer']="Частичная отгрузка";	
				
				//вычисление количества оставшихся товаров
				$all=$requests[$req_id]['goods_count'];
				$sended_g=0;
				$goods = array(
                	'fields' => $this->model('requests')->getFields('requests_goods', 'archive'),
                	'data'  => $this->model('requests')->getList(
                    	'requests_goods',
                    	$this->model('requests')->getFieldsNames('requests_goods', 'archive'),
                    	array('where' => array(
                        	'requests_goods.request_id'    => $req_id,
                    		), 'order' => array('delivery_date' => 'asc'))
                )
            	);
				
				
				foreach($goods['data'] as $good => $values2){
					$good_id=$values2['good_id'];///идентификатор товара
					//$req_id - идентификатор счёта
					//проверить не производилась ли отправка этого товара
					$tmp = $this->model('shipment')->getList(
                    	'shipment_goods',
                    	array('id'),
                    	array('where' => array(
                        	'req_id'    => $req_id,
							'good_id'   => $good_id
							))
                	
            		);
					if(count($tmp)>0){
							$sended_g++;
					}
					
				}
				
				$ost_g=$all-$sended_g;
				//echo "=".$ost_g."=";
				$requests[$req_id]['goods_count']=$ost_g;
				$requests[$req_id]['goods_count_text']="позиций";
				
				
				//
				$tmp = $this->model('shipment')->getList(
                    	'shipment_goods',
                    	array('id','ship_id'),
                    	array('where' => array(
                        	'req_id'    => $req_id
							),'order' => array('id' => 'desc'))
                	
            		);
				
				$ship_id=$tmp[0]['ship_id'];
				$requests[$req_id]['shipment_number']=$ship_id;
				
				$tmp = $this->model('shipment')->getList(
                    	'shipment',
                    	array('sdate'),
                    	array('where' => array(
                        	'id'    => $ship_id
							))
                	
            		);
				$requests[$req_id]['shipment_date']=$tmp[0]['sdate'];
				
				
				
				
			//частичная отгрузка	
			}
			
			
			
			
			
			
			
			
			
        }
		
		
		
		
		
		//отправленные заявки
		if(strpos($this->app->request->uri,'shipment/archive')!==false){
			
			
			$sended = $this->model('requests')->getList(
            'requests',
            array('id','cdate','mdate','cid','dealer_id','legal_entity_id','operator_id','status','account_number'),
            array(
                'where' => array('status' => array('IN', "('processed', 'partly_shipped')"),'dealer_id' => $this->page->dealer['id']),
                'order' => array('mdate' => 'desc')
            )
        	);
			
			
			//echo "<pre>";
			//print_r($sended);
			//echo "</pre>";
			
			
			foreach($sended as $k => $v){
			
			//echo $v['id']."==<br>";
			
			$tmp_2 = $this->model('requests')->getList(
                'requests_bills',
                array(),
				array(
                        'where' => array('req_id' => $v['id'])
                       
                    )
            	);
				
				
			
			$sended[$k]['docs']=$tmp_2;
			//echo "<pre>";
			//print_r($v);
			//echo "</pre>";
			
			//-------------------
			
			/*
			$blocked = $this->model()->getList('shipment_goods', array('good_id'), array('where' => array('req_id' => $req_id, 'is_blocked' => 'yes')));
            if(!empty($blocked)){
                foreach($blocked as $key => $values2){
                    $goods['data'][$values2['good_id']]['blocked'] = 1;
                }
            }
			*/
			
			
			
			/*
            $requests[$req_id]['goods']['fields'] = $goods['fields'];
            $remains_actual = $this->model('requests', 'requests')->getRemainsActual(array($req_id));
			$sens='';
            foreach($goods['data'] as $good => $values2){
                $requests[$req_id]['goods']['data'][$good] = $values2;
                $requests[$req_id]['goods']['data'][$good]['remains'] = $remains_actual[$good];
                if($requests[$req_id]['goods']['data'][$good]['remains']!="" && ($requests[$req_id]['goods']['data'][$good]['good_count']/1)>$requests[$req_id]['goods']['data'][$good]['remains']){
					$sens='alert';
					
				}
                //debug::dump($values);
                if ($values['discount']) {
                    $discount = (100 - $values['discount']) / 100;
                        $requests[$req_id]['goods']['data'][$good]['good_price'] = round($values2['good_price'] * $discount, 2);
                }
				//echo $requests[$req_id]['goods']['data'][$good]['good_title']."=<br>";
				//добавить сведения об остатке (в том числе и резерв)
				//echo "<pre>";
				//print_r($requests[$req_id]['goods']['data'][$good]);
				//echo "</pre>";
				
				$good_id=$requests[$req_id]['goods']['data'][$good]['good_id'];
				
				$remains1=$this->model('db')->getList(
                       'remains',
                        array('store_id','stock','reserve'), array('where' => array('good_id' => $good_id))
                    );
				foreach($remains1 as $value2) {
					if($value2['store_id']==1){
						$stock_1[$good_id]['ad']=$value2['stock'];
						$reserve_1[$good_id]['ad']=$value2['reserve'];
					}else{
						$stock_1[$good_id]['stock']=$value2['stock'];
						$reserve_1[$good_id]['store']=$value2['store_id'];
						$reserve_1[$good_id]['reserve']=$value2['reserve'];
					}
				
				}
				
				$ostatok=round($stock_1[$good_id]['ad']+$reserve_1[$good_id]['ad']);
				$ostatok=number_format($ostatok, 0);
				
				$requests[$req_id]['goods']['data'][$good]['ostatok']=$ostatok;
				
				
				
				//дата ближайшей поставки
				$delivery_date1=$this->model('db')->getList(
                       'stores',
                        array('delivery_date'), array('where' => array('id' => $reserve_1[$good_id]['store']))
                    );
				foreach($delivery_date1 as $value2) {
				
					//идентификатор товара - дата ближайшей поставки
					$delivery_date_12[$good_id]=$value2['delivery_date'];
				
				
				}
				
				
				$postavka=$delivery_date_12[$good_id];
				$requests[$req_id]['goods']['data'][$good]['postavka']=$postavka;
				
				$requests[$req_id]['goods']['data'][$good]['good_count']=round($requests[$req_id]['goods']['data'][$good]['good_count']);
				$requests[$req_id]['goods']['data'][$good]['good_count']=number_format($requests[$req_id]['goods']['data'][$good]['good_count'], 0);
				
				
            }
			*/
			//---------------
			
			$sended[$k]['goods_sum']=0;
			$sended[$k]['goods_weight']=0;
			$sended[$k]['goods_count']=0;
			
			//список товаров заявки
			$goods_s = $this->model('requests')->getList(
                    'requests_goods',
                    $this->model('requests')->getFieldsNames('requests_goods', 'archive'),
                    array('where' => array(
                        'requests_goods.request_id'    => $v['id'],
                    ), 'order' => array('delivery_date' => 'asc'))
                
            );
			
			foreach($goods_s as $k1 => $v1){
				
				if ($values['discount']) {
                    $discount = (100 - $values['discount']) / 100;
                    $v1['good_price'] = round($v1['good_price'] * $discount, 2);
                	
				}
				
				
				$sended[$k]['goods_sum']=$sended[$k]['goods_sum']+$v1['good_price'];
				$sended[$k]['goods_weight']=$sended[$k]['goods_weight']+$v1['good_weight'];
				
			}
			
			//echo "<pre>";
			//print_r($goods_s);
			//echo "</pre>";
			
			$sended[$k]['goods_count']=$sended[$k]['goods_count']+count($goods_s);
			$sended[$k]['goods_count_text']="позиций";
				if($sended[$k]['status']=="partly_shipped" || $sended[$k]['status']=="processed"){
						//echo "s";
						$sended_g=0;
						$goods = array(
                		'fields' => $this->model('requests')->getFields('requests_goods', 'archive'),
                		'data'  => $this->model('requests')->getList(
                    	'requests_goods',
                    	$this->model('requests')->getFieldsNames('requests_goods', 'archive'),
                    	array('where' => array(
                        	'requests_goods.request_id'    => $v['id'],
                    		), 'order' => array('delivery_date' => 'asc'), 'group' => array('good_id'))
                		)
            			);
						//echo "<pre>";
						//print_r($goods['data']);
						//echo "</pre>";
				
					foreach($goods['data'] as $good => $values2){
						$good_id=$values2['good_id'];///идентификатор товара
						//$req_id - идентификатор счёта
						//проверить не производилась ли отправка этого товара
						$tmp = $this->model('shipment')->getList(
                    	'shipment_goods',
                    	array('id'),
                    	array('where' => array(
                        	'req_id'    => $v['id'],
							'good_id'   => $good_id
							))
                	
            			);
						if(count($tmp)>0){
							$sended_g++;
						}
					
					}
					
					$sended[$k]['goods_count']=$sended_g;
					$sended[$k]['goods_count_text']="позиций";
					
					
					
				}
				
				
				//echo "<pre>";
				//print_r($sended[$k]);
				//echo "</pre>";
				//268
				//echo $sended[$k]['id']."<br>";
				
				
				$tmp = $this->model('shipment')->getList(
                    'shipment_goods',
                    array(),
                    array('where' => array(
                        'req_id'    => $sended[$k]['id'],
                    ), 'order' => array('id' => 'asc'))
                
            	);
				
				//echo "<pre>";
				//print_r($tmp);
				//echo "</pre>";
				//echo "--".count($tmp)."--";
				
				$ship_id=$tmp[count($tmp)-1]['ship_id'];
				
				$tmp = $this->model('shipment')->getList(
                    'shipment',
                    array(),
                    array('where' => array(
                        'id'    => $ship_id,
                    ), 'order' => array('id' => 'asc'))
                
            	);
				
				//echo $tmp[0]['sdate']."===<br>";
				
				if($tmp[0]['sdate']==""){
					$tmp[0]['sdate']=date("Y-m-d");
				}
				
				$sended[$k]['sdate']=$tmp[0]['sdate'];
				
				
				
			
			}
			
			
			
			
			$this->page->sended=$sended;
			
			
			
			
			
			
			
			
			
			
			
			
		}
		
		
		
		
		
		
        //debug::dump($requests);
        $shipments['data'] = $requests;
		
		
		//echo "<pre>";
		//print_r($shipments['data']);
		//echo "</pre>";
		
        $this->page->shipments = $shipments;
      //  print_r( $this->page->shipments);
       
        
		$paging['pages'] = ceil($paging['total']/$paging['npp']);
		$paging['curr_page'] = $this->app->request->page > 0 ? $this->app->request->page : 1;
		
		$this->page->paging = $paging;
		$this->page->content = $this->renderView('list');
		$this->loadView('main', null);
	}
	
	
	
}