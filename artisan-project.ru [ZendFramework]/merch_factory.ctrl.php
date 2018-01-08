<?php
class CartController extends Site_Controller
{	



	public function run()
	{
		
		
		/*
		$this->page->cart=$cart;*/
	
		parent::run();
	}
	
	public function actionDefault()
	{
		
		
		
		/*zf::addJS('profile.show', '/public/site/js/profile.show.js');
		$fields = $this->model('dealers')->getFields('dealers', 'profile');
		$fields['legal_entities'] = $this->model('dealers')->getFields('dealers_legal_entities', 'profile');
		$this->page->fields = $fields;
		$this->page->data = $this->model('dealers')->GetByCond(
			'dealers',
			$this->model('dealers')->getFieldsNames('dealers', 'profile'),
			array('where' => array('dealers.id' => $this->page->dealer['id']))
		);*/
		$this->page->page_content['title']="Фабрика";
		$this->page->content = $this->renderView('show');
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