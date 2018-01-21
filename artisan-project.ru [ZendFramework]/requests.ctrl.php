<?php

/**
 * Class RequestsController
 */
class RequestsController extends Site_Controller
{
    public function run()
    {
        if ($this->page->operator['rights'] != 'requests' && $this->action != '') {
            $this->page->content = "У вас нет прав для работы с заявками!<br/><a href=\"javascript:history.back()\">Назад</a>";
            $this->loadView('main', null);
            return;
        } else {
            $this->model('requests')->unlockAllRequests(2);
            $this->page->dealers_categories = $this->model('dealers')->getCategories();
            parent::run();
        }
    }

    public function actionDefault()
    {
        $this->page->page_content = $this->model('content')->GetByCond('content', array(), array('where' => array('path' => 'hello_operators_page', 'pid' => 1)));
        $this->loadView('main', null);
    }

    public function actionProcessings()
    {
        zf::addJS('jquery.simplemodal', '/public/site/js/jquery.simplemodal.js');
        zf::addCSS('jquery.simplemodal', '/public/site/css/jquery.simplemodal.css');
        zf::addJS('requests.processing', '/public/site/js/requests.processing.js');
        $this->page->fields = $this->model('requests')->getFields('requests', 'processing');
        
        $processing = $this->model('requests')->getList(
            'requests',
            $this->model('requests')->getFieldsNames('requests', 'processing'),
            array(
                'where' => array(
                    'dealers.category_id' => array('IN', array_keys($this->page->operator['categories']), '(?l)'),
                    'status' => array('IN', array('new', 'work', 'declined'), '(?l)'),
                    'cid' => array('IS', null, '?i')
                ),
                'group' => array('requests.id')
            )
        );
        $ids = array();
        $requests = array();
        foreach ($processing as $request) {
            $ids[] = $request['id'];
            $requests[$request['id']] = $request;
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
        
        $this->page->processing = $requests;

        if ($this->app->request->ajax) {
            $this->loadView('processing');
        } else {
            $this->page->content = $this->renderView('processing');
            $this->loadView('main', null);
        }
    }

    /**
     * Обработка заказных заявок
     */
    public function actionProcessing_on_order()
    {
        zf::addJS('jquery.simplemodal', '/public/site/js/jquery.simplemodal.js');
        zf::addCSS('jquery.simplemodal', '/public/site/css/jquery.simplemodal.css');
        zf::addJS('requests.processing', '/public/site/js/requests.processing.js');

        $where = array(
            "`requests`.`status` IN('new', 'oformlenie_schyota','declined')",
            "`cid` IS NULL"
        );
        if (!empty($this->page->operator['categories']) && is_array($this->page->operator['categories'])) {
            $cat = implode(',', array_keys($this->page->operator['categories']));
            $where[] = 'dealers.category_id IN ('.$cat.')';
        }
        $where = 'WHERE ' . implode(' AND ', $where);

        $sql = "
            SELECT
                `requests`.`id`,
                `requests`.`cid`,
                `requests`.`cdate`,
                `requests`.`status`,
                `requests`.`operator_id`,
                COUNT(good_id) AS `goods_count`,
                SUM(IFNULL(ROUND(ROUND(good_price / 100, 2) * good_count, 2), 0)) AS `goods_sum`,
                SUM(IFNULL(good_count / good_packCntByUnit * good_weight, 0)) AS `goods_weight`,
                IFNULL(`dealers`.`title`, 'Unknown') AS `dealer_title`, requests_statuses.title_operator AS status_title_operator
            FROM
                `ad_requests_to_order` AS `requests`
            LEFT JOIN `ad_dealers` AS `dealers` ON `requests`.`dealer_id` = `dealers`.`id`
            LEFT JOIN `ad_requests_goods_to_order` AS `requests_goods` ON `requests`.`id` = `requests_goods`.`request_id`
            LEFT JOIN `ad_requests_statuses` AS requests_statuses ON `requests`.`status` = `requests_statuses`.`title`
            ".$where."
            GROUP BY `requests`.`id`;";
        
        $processing = zf::$db->query($sql);

        $ids = array();
        $requests = array();
        foreach ($processing as $request) {
            $ids[] = $request['id'];
            $requests[$request['id']] = $request;
        }

        /**
         *  Корректировки по заказам
         */
        $where = array();
        if (!empty($ids)) {
            $where[] = 'cid IN (' . implode(',',$ids).')';
            $where = 'WHERE ' . implode(' AND ', $where);
        } else $where = '';
        $sql = "
            SELECT
                `requests`.`id`,
                `requests`.`cdate`,
                `requests`.`cid`,
                `requests`.`comments`,
                `requests`.`status`,
                `requests`.`mdate`
            FROM
                `ad_requests_to_order` AS `requests`
            ".$where."
            ;
        ";
        
        $adjustments = zf::$db->query($sql);
//        var_dump($adjustments);die;
//        $corrs = $this->model('requests')->getList(
//            'requests',
//            $this->model('requests')->getFieldsNames('requests', 'archives'),
//            array(
//                'where' => array('cid' => array('IN', $ids, '(?l)')),
//                'order' => array('cid' => 'asc'),
//                'group' => array('requests.id')
//            )
//        );
        if (!empty($adjustments)) {
            foreach ($adjustments as $r) {
                if ($r['cid'] and $r['id'] and isset($requests[$r['cid']])) {
                    $requests[$r['cid']]['corrs'][$r['id']] = $r;
                }
            }
        }
        
        $this->page->processing = $requests;

        if ($this->app->request->ajax) {
            $this->loadView('processing_on_order');
        } else {
            $this->page->content = $this->renderView('processing_on_order');
            $this->loadView('main', null);
        }
    }

	
	 public function actionpretenzii(){
		
		zf::addJS('jquery.simplemodal', '/public/site/js/jquery.simplemodal.js');
        zf::addCSS('jquery.simplemodal', '/public/site/css/jquery.simplemodal.css');
        zf::addJS('requests.processing', '/public/site/js/requests.processing.js');
		
		
		
		/*
		 $sql='SELECT * FROM as_bad_quest ORDER BY id DESC';
		 $archive = zf::$db->query($sql);
		 for($i=0;$i<count($archive);$i++){
			 $archive[$i]['dates']=date('d-m-Y h:i:s',$archive[$i]['data']);
			 if($archive[$i]['status']=="NEW"){$archive[$i]['status']='<font color="red">Новая</font>';}
			 if($archive[$i]['status']=="OPERATOR"){$archive[$i]['status']='<font color="#00CC33">Требует ответа оператора</font>';}
			 if($archive[$i]['status']=="USER"){$archive[$i]['status']='<font color="#999999">Требует ответа пользователя</font>';}
			 if($archive[$i]['status']=="CLOSED"){$archive[$i]['status']='<font color="#330000">Закрыта</font>';}
			 
			 if($archive[$i]['tupe']=="1"){$archive[$i]['tupe']='<b>Брак</b>';}
			 if($archive[$i]['tupe']=="2"){$archive[$i]['tupe']='<b>Возврат</b>';}
			 if($archive[$i]['tupe']=="3"){$archive[$i]['tupe']='<b>Обмен</b>';}
			 
			 $tupes=unserialize($archive[$i]['tupe']);
			 $skghr=array();
			$sarray[1]='Брак';$sarray[2]='Возврат';$sarray[3]='Обмен';
			 foreach ( $tupes['tupe'] as $key => $el) {
				 if($el!="0"){
					 $skghr[]=$sarray[$el];
					 
				 }
				 
			 }
			 $archive[$i]['tupe']=implode(',', $skghr);
			 if($archive[$i]['comment_tups']!=""){
				$daste=unserialize($archive[$i]['comment_tups']);
				if(is_array($daste) && count($daste)>0){
					$archive[$i]['dates_end']=date('d-m-Y h:i:s',$daste[(count($daste)-1)]['date']);
				}else{
					 $archive[$i]['dates_end']="—";
				}
			 }else{
				 $archive[$i]['dates_end']="—";
				 
			 }
		 }
		 */
		 
		 
		 $paging = array(
				'total' => 0,
				'from' => 0,
				'npp' => 50,
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
			
			
			
			$paging['from'] = $this->app->request->page > 0 ? ($this->app->request->page-1)*$paging['npp'] : 0;
			
			
			$archive = $this->model('complaints')->getPage(
					'complaints',
					array(),
					$paging['total'], $paging['from'], $paging['npp'],
					array('order' => array('id' => 'desc'))
				);
		 
		 
		 
		 
		 
		 //$sql='SELECT * FROM ad_complaints WHERE status <> "closed" ORDER BY id DESC';
		 //$archive = zf::$db->query($sql);
		 
		 
		 foreach($archive as $k => $v){
			 
			$type=$v['reason_id'];
			$sql='SELECT * FROM ad_reasons WHERE id="'.$type.'"';
		 	$tmp = zf::$db->query($sql);
			$archive[$k]['reason']=$tmp[0]['title']; 	
			
			$dealer_id=$v['dealer_id'];
			$sql='SELECT * FROM ad_dealers WHERE id="'.$dealer_id.'"';
		 	$tmp = zf::$db->query($sql);
			$archive[$k]['dealer']=$tmp[0]['title']; 	
			
			
			if($archive[$k]['status']=="new" || $archive[$k]['status']=="not_answered"){ $archive[$k]['status']='<font color="red">Непрочтённая</font>';}
			if($archive[$k]['status']=="not_answered" && $archive[$k]['status_view']=="readed"){$archive[$k]['status']='<font color="#00CC33">Прочтённая, но не отвеченная</font>';}
		    if($archive[$k]['status']=="answered"){$archive[$k]['status']='<font color="#999999">Отвеченная</font>';}
			if($archive[$k]['status']=="closed"){$archive[$k]['status']='<font color="#330000">Закрыта</font>';}
			
			
			/*	
			 
			$archive[$k]['data']="";
			$archive[$k]['requet_id']=$archive[$k]['id'];
			//$archive[$k]['title']="";
			
			$archive[$k]['coment']="";
			$archive[$k]['file']="";
			$archive[$k]['comment_tups']="";
			//echo $archive[$k]['status']."==<br>";
			 
			//echo $archive[$k]['status']."==<br>"; 
			
			//$archive[$k]['status']="";
			$archive[$k]['dates']=$archive[$k]['compldate'];
			$archive[$k]['dates_end']=$archive[$k]['last_answ_date'];	
			
			*/
			
			
					 
		 }
		 
		 //echo "<pre>";
		 //print_r($archive);
		 //echo "</pre>";
		 
		 $paging['pages'] = ceil($paging['total']/$paging['npp']);
			$paging['curr_page'] = $this->app->request->page > 0 ? $this->app->request->page : 1; 
			$this->page->paging = $paging;
		 
		 
		 
		 $this->page->archive = $archive;
		$this->page->content = $this->renderView('pretenzii');
        $this->loadView('main', null);
		 
	 }
	
	
	
	
	
	
	
	
	
	
	
	
	
    /**
     * Обработка архива заказных заявок
     */
    public function actionArchive_on_order()
    {
        zf::addJS('jquery.simplemodal', '/public/site/js/jquery.simplemodal.js');
        zf::addCSS('jquery.simplemodal', '/public/site/css/jquery.simplemodal.css');
        zf::addJS('requests.archive', '/public/site/js/requests.archive.js');

        $paging = array(
            'total' => 0,
            'from' => 0,
            'npp' => 20,
            'base_url' => zf::$root_url . "{$this->ctrlName}/archive_on_order/page/",
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
        $paging['from'] = $this->app->request->page > 0 ? ($this->app->request->page - 1) * $paging['npp'] : 0;

//        $where = array(
//            'dealers.category_id' => array('IN', array_keys($this->page->operator['categories']), '(?l)'),
//            'cid' => array('IS', null, '?i')
//        );
        //$fields = $this->model('requests')->getFields('requests', array('status'));
        $status_fields = $this->model('requests')->getList('requests_statuses', array('title', 'title_dealer'));
        foreach ($status_fields as $key => $values) {
            $fields[$values['title']] = $values['title_dealer'];
        }
        
        $this->loadForm('filter', array(
            'id' => array(
                'type' => 'integer',
                'title' => 'Номер заявки'
            ),
            'cdate' => array(
                'type' => 'date',
                'title' => 'Дата создания'
            ),
            'mdate' => array(
                'type' => 'date',
                'title' => 'Дата обработки'
            ),
            'status' => array(
                'type' => 'select',
                'title' => 'Статус',
                'null' => 'не выбрано',
                'values' => $fields
                //'values' => $fields['status']['values']
            ),
            'account_number' => array(
                'type' => 'string',
                'title' => 'Номер счета'
            ),
        ), $_GET, '', 'get');
        if (!empty($_GET)) {
            $fdata = $this->form('filter')->getData();
            if (!empty($fdata['id'])) {
                $where['requests.id'] = $fdata['id'];
            }
            if (!empty($fdata['cdate'])) {
                $where['requests.cdate'] = array(
                    'BETWEEN',
                    date('\'Y-m-d 00:00:00\'', strtotime($fdata['cdate'])) . ' AND ' . date('\'Y-m-d 23:59:59\'', strtotime($fdata['cdate'])),
                    '?i'
                );
            }
            if (!empty($fdata['mdate'])) {
                $where['requests.mdate'] = array(
                    'BETWEEN',
                    date('\'Y-m-d 00:00:00\'', strtotime($fdata['mdate'])) . ' AND ' . date('\'Y-m-d 23:59:59\'', strtotime($fdata['mdate'])),
                    '?i'
                );
            }
            if (!empty($fdata['status'])) {
                $where['requests.status'] = $fdata['status'];
            }
            if (!empty($fdata['account_number'])) {
                $where['requests.account_number'] = $fdata['account_number'];
            }
        }

        $where = array(
            "`cid` IS NULL",
            "`requests`.`status` NOT IN('new', 'oformlenie_schyota')"
        );
        if (!empty($this->page->operator['categories']) && is_array($this->page->operator['categories'])) {
            $cat = implode(',', array_keys($this->page->operator['categories']));
            $where[] = 'dealers.category_id IN ('.$cat.')';
        }
        $where = ' WHERE ' . implode(' AND ', $where);

        $sql = "
            SELECT
                `requests`.`id`,
                `requests`.`cid`,
                `requests`.`comments`,
                `requests`.`cdate`,
                `requests`.`status`,
                `requests`.`mdate`,
                `requests`.`date_of_receipt`,
                `requests`.`number_in_bd_artisan`,
                COUNT(`good_id`) AS `goods_count`,
                SUM(IFNULL(ROUND(ROUND(`good_price` / 100, 2) * `good_count`, 2), 0)) AS `goods_sum`,
                SUM(IFNULL(`good_count` / `good_packCntByUnit` * `good_weight`, 0)) AS `goods_weight`,
                IFNULL(`dealers`.`title`, 'Unknown') AS `dealer_title`,
                `operators`.`name` AS `operator_name`
            FROM `ad_requests_to_order` AS `requests`
            LEFT JOIN `ad_dealers` AS `dealers` ON `requests`.`dealer_id` = `dealers`.`id`
            LEFT JOIN `ad_operators` AS `operators` ON `requests`.`operator_id` = `operators`.`id`
            LEFT JOIN `ad_requests_goods_to_order` AS `requests_goods` ON `requests`.`id` = `requests_goods`.`request_id`
            ".$where."
            GROUP BY `requests`.`id`
            ORDER BY `cdate` DESC;
        ";
//        var_dump($sql);die;
        $archive['data'] = zf::$db->query($sql);
        $archive['fields'] = $this->model('requests')->getFields('requests', 'archives_o');

//        var_dump($archive['data']);die;

//         $ids = array();
//         $requests = array();
//         foreach ($archive['data'] as $request) {
// //            $ids[] = $request['id'];
//             if ($request['status'] === 'yes') {
//                 $request['status'] = 'Новый';
//             } elseif ($request['status'] === 'no') {
//                 $request['status'] = 'Отменен';
//             }

//             $requests[$request['id']] = $request;
//         }

        //- запрос всех статусов
        $sql = "SELECT * FROM `ad_requests_statuses`";
        $statuses = zf::$db->query($sql);
        //-
        // индексация статусов их title`ами
        $statuses_indexed = array();
        foreach ($statuses as $_s) {
            $statuses_indexed[$_s['title']] = $_s;
        }
        
//         $requests = $archive['data'];
        
//         var_dump($requests);exit;
        
        // замена в списке архивов title`ов статусов на их title_dealer
        foreach ($archive['data'] as &$_r) {
            if(isset($statuses_indexed[$_r['status']])) {
                $_r['status'] = $statuses_indexed[$_r['status']]['title_operator'];
            }
        }

//         var_dump($archive['data']);exit;
        
//         $archive['data'] = $requests;
        $this->page->archive = $archive;

        $paging['pages'] = ceil($paging['total'] / $paging['npp']);
        $paging['curr_page'] = $this->app->request->page > 0 ? $this->app->request->page : 1;

        $this->page->paging = $paging;
        $this->page->content = $this->renderView('archive_on_order');
        $this->loadView('main', null);
    }

    private function _request_on_order_proc()
    {
        if(isset($_POST['rejected'])) {
            $status = 'rejected';
        }
        else {
            $status = 'nal_v_raschete';
        }
        
        $number_in_bd_artisan = (int)htmlspecialchars($_POST['number_artisan']);
        $comments_operator = htmlspecialchars($_POST['comments_operator']);
        
        if($number_in_bd_artisan == 0) {
            $number_in_bd_artisan = 'NULL';
        }
        else {
            $number_in_bd_artisan = "'" . $number_in_bd_artisan . "'"; 
        }
        
        $sql = "
                UPDATE `ad_requests_to_order`
                SET
                    `status` = '$status',
                    `comments_operator` = '" . $comments_operator . "',
                    `number_in_bd_artisan` = " . $number_in_bd_artisan . ",
                    `operator_id` = " . $this->page->operator['id'] . "
                WHERE
                    `id` = '" . $this->app->request->id . "'
                ";
        
//         echo $sql; exit;
        
        $result = zf::$db->query($sql);
        if($result !== null) {
            exit('Заявка успешно обработана.');
        }
        else {
            exit('Заявку обработать не удалось.');
        }
    }

    private function _request_on_order_procIssue()
    {
        if(isset($_POST['rejected'])) {
            $status = 'rejected';
        }
        else {
            $status = 'schet_vystavlen';
        }

        $account_number = (int)htmlspecialchars($_POST['account_number']);
        $comments_operator = htmlspecialchars($_POST['comments_operator']);

        if($account_number == 0) $account_number = 'NULL';
        else $account_number = "'" . $account_number . "'";

        $sql = "
                UPDATE `ad_requests_to_order`
                SET
                    `status` = '$status',
                    `comments_operator` = '" . $comments_operator . "',
                    `account_number` = " . $account_number . ",
                    `operator_id` = " . $this->page->operator['id'] . "
                WHERE
                    `id` = '" . $this->app->request->id . "'
                ";

//         echo $sql; exit;

        $result = zf::$db->query($sql);
        if($result !== null) {
            exit('Заявка успешно обработана.');
        }
        else {
            exit('Заявку обработать не удалось.');
        }
    }

    /**
     * Показываем информацию о заказной заявке
     */
    public function actionShow_on_order()
    {
        if(isset($_POST['account_number'])) {
            $this->_request_on_order_procIssue();
        } elseif(isset($_POST['number_artisan'])) {
            $this->_request_on_order_proc();
        }
        if (($id = filter_var($this->app->request->id, FILTER_VALIDATE_INT))) {
            $sql = "
                SELECT
                    `requests`.`id`,
                    `requests`.`cdate`,
                    `requests`.`mdate`,
                    `requests`.`cid`,
                    `requests`.`comments`,
                    `requests`.`comments_operator`,
                    `requests`.`status`,
                    `requests`.`rtype`,
                    COUNT(`good_id`) AS `goods_count`,
                    SUM(IFNULL(ROUND(ROUND(`good_price` / 100, 2) * `good_count`, 2), 0)) AS `goods_sum`,
                    SUM(IFNULL(`good_count` / `good_packCntByUnit`* `good_weight`, 0)) AS `goods_weight`,
                    IFNULL(`dealers`.`title`, 'Unknown') AS `dealer_title`, requests_statuses.title_operator AS status_title_operator
                FROM
                    `ad_requests_to_order` as `requests`
                LEFT JOIN
                    `ad_dealers` AS `dealers` ON `requests`.`dealer_id` = `dealers`.`id`
                LEFT JOIN
                    `ad_requests_goods_to_order` AS `requests_goods` ON `requests`.`id` = `requests_goods`.`request_id`
                LEFT JOIN `ad_requests_statuses` AS requests_statuses ON `requests`.`status` = `requests_statuses`.`title`
                WHERE `requests`.`id` = {$id}
                GROUP BY `requests`.`id`;
            ";
            $data = zf::$db->query($sql);
            
            //- нахождение номера откорректированнй заявки
            $sql = "
                    SELECT
                        `requests`.`id`
                    FROM
                        `ad_requests_to_order` as `requests`
                    WHERE `requests`.`cid` = {$id}
                    ";
            $cid = zf::$db->query($sql);
            $data[0]['cid'] = isset($cid[0]['id']) ? isset($cid[0]['id']) : '';
            //-

            if (isset($data[0])) {
                $data['data'] = $data[0];
                $this->page->archive = $data;

                $sql = "
                    SELECT
                        *
                    FROM `ad_requests_goods_to_order`
                    WHERE `request_id` = {$id};
                ";
                $data['data'] = zf::$db->query($sql);
                $this->page->goods = $data;
            }
        }

        $view = 'show_on_order';
        if($this->app->request->type == 'archive') {
            $view = 'show_in_archive_on_order';
        }
        
        if ($this->app->request->ajax) {
            $this->loadView($view);
        } elseif ($this->app->request->for_print) {
            $this->page->content = $this->renderView($view);
            $this->loadView('print', null);
        } else {
            $this->page->content = $this->renderView($view);
            $this->loadView('main', null);
        }
    }

    public function actionProcess()
    {
  //  print_r($this->page);
        $this->page->process = array(
            'fields' => $this->model('requests')->getFields('requests', 'process'),
            'data' => $this->model('requests')->GetByCond(
                    'requests',
                    $this->model('requests')->getFieldsNames('requests', 'process'),
                    array(
                        'where' => array(
                            'requests.id' => $this->app->request->id,
                            'dealers.category_id' => array('IN', array_keys($this->page->operator['categories']), '(?l)'),
                            'status' => array('IN', array('new', 'work', 'declined'), '(?l)'),
                            '!raw' => '(operator_id = ' . $this->page->operator['id'] . ' OR operator_id IS NULL)'
                        ),
                        'group' => array('requests.id')
                    )
                )
        );
        
        $this->page->corrs = $this->model('requests')->getList(
            'requests',
            $this->model('requests')->getFieldsNames('requests', 'archives'),
            array(
                'where' => array('cid' => $this->page->process['data']['id']),
                'order' => array('cid' => 'asc'),
                'group' => array('requests.id')
            )
        );
        $goods = array(
            'fields' => $this->model('requests')->getFields('requests_goods', 'process'),
            'data' => $this->model('requests')->getList(
                    'requests_goods',
                    $this->model('requests')->getFieldsNames('requests_goods', 'process'),
                    array('where' => array(
                        'requests_goods.request_id' => $this->app->request->id
                    ), 'order' => array('delivery_date' => 'asc'))
                )
        );
        foreach ($goods['data'] as &$g) {
            if (!isset($g['total_count'])) $g['total_count'] = 0;
            foreach ($g['remains'] as $s) {
                $g['total_count'] += (isset($s['stock']) ? $s['stock'] : 0);
            }
        }
        unset($g);
        $this->page->goods = $goods;
        if (!empty($this->page->process['data'])) {
            $this->model('requests')->lockRequest($this->page->process['data']['id'], $this->page->operator['id']);
        }
        if (
            !empty($this->page->process['data']) and
            !empty($_POST) and
            (
                (isset($_POST['processed']) and !empty($_POST['account_number'])) or
                isset($_POST['rejected']) or isset($_POST['processed_decl'])
            )
        ) {
            $data = array(
                'account_number' => isset($_POST['processed']) ? strip_tags($_POST['account_number']) : '',
                'comments_operator' => htmlspecialchars($_POST['comments_operator']),
                'status' => isset($_POST['processed']) ? 'reserved' : 'unreserved',
                'operator_id' => $this->page->operator['id'],
                'mdate' => date('Y-m-d H:i:s')
            );
            if($_POST['zakaz']=='1' && isset($_POST['processed'])){
				$data['status']='nalichie_raschitano';
			}
			if($_POST['zakaz']=='1' && isset($_POST['rejected']) ){
				$data['status']='cancel';
			}
			
			
			
            $res = $this->model('requests')->Save('requests', $data, array(
                'id' => $this->page->process['data']['id'],
                //'status' => array('IN', array('new', 'work'), '(?l)'),
                //'operator_id' => $this->page->operator['id']
            ));
            $res_h = $this->model('requests')->Save('requests_history', array(
                'req_id' => $this->page->process['data']['id'],
                'old_status' => isset($_POST['processed']) ? 'reserved' : 'unreserved',
                'mdate' => date('Y-m-d H:i:s')
            ));
            if ($res !== null) {
                $this->page->archive = array(
                    'fields' => $this->model('requests')->getFields('requests', 'print'),
                    'data' => $this->model('requests')->GetByCond(
                            'requests',
                            $this->model('requests')->getFieldsNames('requests', 'print'),
                            array(
                                'where' => array(
                                    'requests.id' => $this->app->request->id,
                                    'dealers.category_id' => array('IN', array_keys($this->page->operator['categories']), '(?l)')
                                ),
                                'group' => array('requests.id')
                            ),
                            1
                        ),
                );
                $this->page->dealer = $this->model('dealers')->GetByCond(
                    'dealers',
                    'dealer',
                    array('dealers.id' => $this->page->archive['data']['dealer_id']),
                    1
                );
                $this->page->supplier = $this->model('dealers')->GetByCond(
                    'suppliers',
                    $this->model('dealers')->getFieldsNames('suppliers', 'print'),
                    array('id' => $this->page->dealer['supplier_id']), 1
                );
                $this->page->goods = array(
                    'fields' => $this->model('requests')->getFields('requests_goods', 'print'),
                    'data' => $this->model('requests')->getList(
                            'requests_goods',
                            $this->model('requests')->getFieldsNames('requests_goods', 'print'),
                            array('where' => array('request_id' => $this->app->request->id))
                        )
                );
                $dealer = $this->page->dealer;
                if (!empty($dealer['mail'])) {
                    $this->model('requests')->SendMail(
                        $this->page->dealer['mail'],
                        array(
                            'order_id' => $this->app->request->id,
                            'order_cdate' => date('d.m.Y H:i', strtotime($this->page->process['data']['cdate'])),
                            'order_status' => isset($_POST['processed']) ? 'Обработана' : 'Отклонена',
                            'print_url' => 'http://' . $_SERVER['HTTP_HOST'] . '/requests/print/id/' . $this->app->request->id . '/'
                        ),
                        ($this->page->process['data']['goods_sum'] >= $this->page->settings['total_price'] and isset($_POST['processed']))
                            ? 'print_form'
                            : 'without_print_form'
                    );
                }
                $this->page->result = 'Заявка успешно обработана.';
            } else {
                $this->page->error = 'Заявку обработать не удалось.';
            }
        }

        if ($this->app->request->ajax) {
            $this->loadView('process');
        } else {
            $this->page->content = $this->renderView('process');
            $this->loadView('main', null);
        }
    }

    public function actionProcess2db()
    {
        $process = $this->model('requests')->GetByCond(
            'requests',
            $this->model('requests')->getFieldsNames('requests', 'process'),
            array(
                'where' => array(
                    'requests.id' => $this->app->request->id,
                    'dealers.category_id' => array('IN', array_keys($this->page->operator['categories']), '(?l)'),
                    //'status' => array('IN', array('new', 'work'), '(?l)')
                ),
                'group' => array('requests.id')
            )
        );
        
        $process['status'] == 'declined' ? $suff = 'del_' : $suff = '';
        $corrs = $this->model('requests')->getList(
            'requests',
            $this->model('requests')->getFieldsNames('requests', 'archives'),
            array(
                'where' => array('cid' => $process['id']),
                'order' => array('cid' => 'asc', 'cdate' => 'desc'),
                'group' => array('requests.id')
            )
        );
        $cor = current($corrs);
        $goods = $this->model('requests')->getList(
            'requests_goods',
            $this->model('requests')->getFieldsNames('requests_goods', 'process'),
            array('where' => array('requests_goods.request_id' => $process['id']))
        );
        $content = array();
        
        foreach ($goods as $g) {
            $content[] =
                  $g['good_id'] . ';'
                . $g['good_count'] . ';'
                . ($process['rtype'] == 'order' ? '1' : '0') . ';'
                . $process['legal_entity_id'] . ';'
                . (isset($cor['id']) ? $cor['id'] : 0) . ';'
                . (!empty($process['payment_method_id']) ? $process['payment_method_id'] : '0') . ';'
                . (!empty($process['doc_number']) ? $process['doc_number'] : '0') . ';' 
                . ($process['doc_date'] != '0000-00-00' ? $process['doc_date'] : '0') . ';' 
                . str_replace(array("\r\n", "\n", ";"), array(' ', ' ', ','), iconv('utf-8', 'cp1251', $process['comments'])) . ';';
        }
        $content = implode("\n", $content);
        
        header("Content-Description: File Transfer");
        header("Content-Type: application/octet-stream");
        header("Accept-Ranges: bytes");
        header("Content-Disposition: attachment; filename=" . $suff . $this->page->operator['id'] . '_' . $process['id'] . date('_Ymd') . '.csv');
        header("Content-Transfer-Encoding: binary");
        header("Content-Length: " . strlen($content));
        echo $content;
        exit;
    }

    public function actionProcess2db_on_order()
    {
        
        $sql = "
                SELECT
                	`requests`.`id`, `requests`.`cid`, `dealers`.`category_id` AS `dealer_category_id`,
                	`dealers`.`title` AS `dealer_title`, `requests`.`cdate`, `requests`.`legal_entity_id`,
                	COUNT(good_id) AS `goods_count`, `requests`.`status`,
                    `requests_statuses`.`title_operator` AS `status_title_operator`, `requests`.`rtype`, `requests`.`comments`
                FROM
                	`ad_requests_to_order` AS `requests`
                left join `ad_dealers` AS dealers ON `requests`.`dealer_id` = `dealers`.`id`
                left join `ad_requests_goods_to_order` AS requests_goods ON `requests`.`id` = `requests_goods`.`request_id`
                left join `ad_goods_to_order` AS goods ON `requests_goods`.`good_id` = `goods`.`id`
                left join `ad_requests_statuses` AS requests_statuses ON `requests`.`status` = `requests_statuses`.`title`
                WHERE
                	`requests`.`id` = '" . $this->app->request->id . "' AND `dealers`.`category_id` IN (" . implode(', ', array_keys($this->page->operator['categories'])) . ")
                GROUP BY
                    `requests`.`id`;
                ";
        
        $process = zf::$db->assoc($sql);
        
        $process['status'] == 'declined' ? $suff = 'del_' : $suff = '';
        
        $sql = "
                SELECT *
                FROM
                    `ad_requests_to_order` AS `requests`
                WHERE
                    `requests`.`cid` = '" . $process['id'] . "'
                GROUP BY
                    `requests`.`id`
                ORDER BY
                    cid ASC, cdate DESC;
                ";
        $cor = zf::$db->assoc($sql);

//         debug::dump($sql);
//         debug::dump($cor);exit('ok');
        
        $sql = "
                SELECT *
                FROM
                	`ad_requests_goods_to_order` AS `requests_goods`
                WHERE
                	`requests_goods`.`request_id` = '" . $process['id'] . "';
                ";
        $goods = zf::$db->query($sql);
        
        $content = array();
        
        foreach ($goods as $g) {
            $content[] =
            $g['good_id'] . ';'
            . $g['good_count'] . ';'
            . ($process['rtype'] == 'order' ? '1' : '0') . ';'
            . $process['legal_entity_id'] . ';'
            . (isset($cor['id']) ? $cor['id'] : 0) . ';'
            . str_replace(array("\r\n", "\n", ";"), array(' ', ' ', ','), iconv('utf-8', 'cp1251', $process['comments'])) . ';';
        }
        
        $content = implode("\n", $content);
        
        header("Content-Description: File Transfer");
        header("Content-Type: application/octet-stream");
        header("Accept-Ranges: bytes");
        header("Content-Disposition: attachment; filename=zak_" . $suff . $this->page->operator['id'] . '_' . $process['id'] . date('_Ymd') . '.csv');
        header("Content-Transfer-Encoding: binary");
        header("Content-Length: " . strlen($content));
        echo $content;
        exit;
    }
    
    public function actionArchive()
    {
        zf::addJS('jquery.simplemodal', '/public/site/js/jquery.simplemodal.js');
        zf::addCSS('jquery.simplemodal', '/public/site/css/jquery.simplemodal.css');
        zf::addJS('requests.archive', '/public/site/js/requests.archive.js');
        $paging = array(
            'total' => 0,
            'from' => 0,
            'npp' => 20,
            'base_url' => zf::$root_url . "{$this->ctrlName}/archive/page/",
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
        $paging['from'] = $this->app->request->page > 0 ? ($this->app->request->page - 1) * $paging['npp'] : 0;

        $where = array(
            'dealers.category_id' => array('IN', array_keys($this->page->operator['categories']), '(?l)'),
            'cid' => array('IS', null, '?i')
        );
        //$fields = $this->model('requests')->getFields('requests', array('status'));
        $status_fields = $this->model('requests')->getList('requests_statuses', array('title', 'title_dealer'));
        foreach ($status_fields as $key => $values) {
            $fields[$values['title']] = $values['title_dealer'];
        }
        $this->loadForm('filter', array(
            'id' => array(
                'type' => 'integer',
                'title' => 'Номер заявки'
            ),
            'cdate' => array(
                'type' => 'date',
                'title' => 'Дата создания'
            ),
            'mdate' => array(
                'type' => 'date',
                'title' => 'Дата обработки'
            ),
            'status' => array(
                'type' => 'select',
                'title' => 'Статус',
                'null' => 'не выбрано',
                'values' => $fields
                //'values' => $fields['status']['values']
            ),
            'account_number' => array(
                'type' => 'string',
                'title' => 'Номер счета'
            ),
        ), $_GET, '', 'get');
        if (!empty($_GET)) {
            $fdata = $this->form('filter')->getData();
            if (!empty($fdata['id'])) {
                $where['requests.id'] = $fdata['id'];
            }
            if (!empty($fdata['cdate'])) {
                $where['requests.cdate'] = array(
                    'BETWEEN',
                    date('\'Y-m-d 00:00:00\'', strtotime($fdata['cdate'])) . ' AND ' . date('\'Y-m-d 23:59:59\'', strtotime($fdata['cdate'])),
                    '?i'
                );
            }
            if (!empty($fdata['mdate'])) {
                $where['requests.mdate'] = array(
                    'BETWEEN',
                    date('\'Y-m-d 00:00:00\'', strtotime($fdata['mdate'])) . ' AND ' . date('\'Y-m-d 23:59:59\'', strtotime($fdata['mdate'])),
                    '?i'
                );
            }
            if (!empty($fdata['status'])) {
                $where['requests.status'] = $fdata['status'];
            }
            if (!empty($fdata['account_number'])) {
                $where['requests.account_number'] = $fdata['account_number'];
            }
        }

        $archive = array(
            'fields' => $this->model('requests')->getFields('requests', 'archives_o'),
            'data' => $this->model('requests')->getPage(
                    'requests',
                    $this->model('requests')->getFieldsNames('requests', 'archives_o'),
                    $paging['total'], $paging['from'], $paging['npp'],
                    array(
                        'where' => $where,
                        'order' => array('cdate' => 'desc'),
                        'group' => array('requests.id')
                    )
                )
        );

        $ids = array();
        $requests = array();
        foreach ($archive['data'] as $request) {
            $ids[] = $request['id'];
            $requests[$request['id']] = $request;
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
        $archive['data'] = $requests;
        $this->page->archive = $archive;

        $paging['pages'] = ceil($paging['total'] / $paging['npp']);
        $paging['curr_page'] = $this->app->request->page > 0 ? $this->app->request->page : 1;

        $this->page->paging = $paging;
        $this->page->content = $this->renderView('archive');
        $this->loadView('main', null);
    }

    public function actionShow()
    {
        $this->page->archive = array(
            'fields' => $this->model('requests')->getFields('requests', 'archive_o'),
            'data' => $this->model('requests')->GetByCond(
                    'requests',
                    $this->model('requests')->getFieldsNames('requests', 'archive_o'),
                    array(
                        'where' => array(
                            'requests.id' => $this->app->request->id,
                            'dealers.category_id' => array('IN', array_keys($this->page->operator['categories']), '(?l)')
                        ),
                        'group' => array('requests.id')
                    )
                )
        );
        $this->page->goods = array(
            'fields' => $this->model('requests')->getFields('requests_goods', 'archive'),
            'data' => $this->model('requests')->getList(
                    'requests_goods',
                    $this->model('requests')->getFieldsNames('requests_goods', 'archive'),
                    array('where' => array(
                        'requests_goods.request_id' => $this->app->request->id
                    ), 'order' => array('delivery_date' => 'asc'))
                )
        );

        if ($this->app->request->ajax) {
            $this->loadView('show');
        } elseif ($this->app->request->for_print) {
            $this->page->content = $this->renderView('show');
            $this->loadView('print', null);
        } else {
            $this->page->content = $this->renderView('show');
            $this->loadView('main', null);
        }
    }

    public function actionPrint()
    {
        $this->page->archive = array(
            'fields' => $this->model('requests')->getFields('requests', 'print'),
            'data' => $this->model('requests')->GetByCond(
                    'requests',
                    $this->model('requests')->getFieldsNames('requests', 'print'),
                    array(
                        'where' => array(
                            'requests.id' => $this->app->request->id,
                            'dealers.category_id' => array('IN', array_keys($this->page->operator['categories']), '(?l)')
                        ),
                        'group' => array('requests.id')
                    )
                )
        );
        if (!empty($this->page->archive['data'])) {
            $this->page->dealer = $this->model('dealers')->GetByCond(
                'dealers',
                'dealer',
                array('dealers.id' => $this->page->archive['data']['dealer_id'])
            );
            $this->page->supplier = $this->model('dealers')->GetByCond(
                'suppliers',
                $this->model('dealers')->getFieldsNames('suppliers', 'print'),
                array('id' => $this->page->dealer['supplier_id']), 1
            );
            $goods = array(
                'fields' => $this->model('requests')->getFields('requests_goods', 'print'),
                'data' => $this->model('requests')->getList(
                        'requests_goods',
                        $this->model('requests')->getFieldsNames('requests_goods', 'print'),
                        array('where' => array('request_id' => $this->app->request->id))
                    )
            );

            if ($this->page->archive['data']['discount']) {
                $discount = (100 - $this->page->archive['data']['discount']) / 100;
                foreach ($goods['data'] as &$g) {
                    $g['good_price'] = round($g['good_price'] * $discount, 2);
                }
                unset($g);
            }
            $this->page->goods = $goods;
        }
        $this->loadView('../../site/views/requests/print', null);
    }
}