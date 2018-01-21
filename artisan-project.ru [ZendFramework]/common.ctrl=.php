<?php
class CommonController extends Site_Common_Controller
{
	public function run()
	{
		
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
					header('Location: '.zf::$root_url.'profile/change_pass/');
					exit;
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
					header('Location: '.zf::$root_url.'requests/');
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
		
		
		
		$this->page->catalog_menu = $my_arr;
		
		//меню-фильтр каталога
		if (empty($this->app->request->parr[0]) or $this->app->request->parr[0] == 'actions' or $this->app->ctrl->ctrlName != 'catalog') {
			$this->page->spec_filters = $this->model('db')->getSpecFilters();
		} else {
			$this->page->spec_filters = $this->model('db')->getSpecFilters($this->app->request->parr[0]);
		}
		
		$this->loadForm('simple_search', array(
			'string' => array(
				'type' => 'string',
				'title' => 'Поиск'
			)
		), $_GET, '/search/', 'get');

		// обычные баннеры
		$this->page->top_banners = $this->model('banners')->getList('banners', array('id', 'title', 'descr', 'image', 'url'), array('where' => array('hidden' => 'no', 'type' => 'top', 'type2' => 'normal'), 'order' => array('pos' => 'asc')));
		//$this->page->top_banners = $this->model('banners')->getList('banners', array('id', 'title', 'descr', 'image', 'url'), array('where' => array('hidden' => 'no', 'type' => 'top', 'type2' => 'normal'), 'order' => array('pos' => 'asc')));
		
		$this->page->spec_banners = $this->model('banners')->getList('banners', array('id', 'title', 'descr', 'image', 'url'), array('where' => array('hidden' => 'no', 'type' => 'spec', 'type2' => 'normal'), 'order' => array('pos' => 'asc')));
		$this->page->through_banners = $this->model('banners')->GetByCond('banners', array('id', 'title', 'descr', 'image', 'url'), array('where' => array('hidden' => 'no', 'type' => 'through', 'type2' => 'normal'), 'order' => array('pos' => 'asc')));

        // дилерские баннеры
        if ($this->page->dealer) {
            $this->page->dealers_top_banners = $this->model('banners')->getList('banners', array('id', 'title', 'descr', 'image', 'url'), array('where' => array('hidden' => 'no', 'type' => 'top', 'type2' => 'dealers'), 'order' => array('pos' => 'asc')));
        }

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
	}
	
	/**
	 * @see Controller::form()
	 */
	public function form($formName)
	{
		return parent::form($formName);
	}
}