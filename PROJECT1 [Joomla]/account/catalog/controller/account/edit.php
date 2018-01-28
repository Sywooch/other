<?php
class ControllerAccountEdit extends Controller {
	private $error = array();

	public function index() {
		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/edit', '', 'SSL');

			$this->redirect($this->url->link('account/login', '', 'SSL'));
		}

		$this->language->load('account/edit');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('account/customer');
		
		if (isset($this->session->data['success'])) {
    		$this->data['success'] = $this->session->data['success'];
			
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}
		
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_account_customer->editCustomer($this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('account/account', '', 'SSL'));
		}
		
		
		$this->data['outs'] = array();
		
		$outs = $this->model_account_customer->getIns();
 		
    	foreach ($outs as $out) {
		
		$customer = $this->model_account_customer->getCustomer($out['customer_id']);
		
			$this->data['outs'][] = array(
			
		
			
				'date_added'      => $out['date_added'],
				'amount'     	 => (float)$out['amount'],
				'email' 		=> $customer['email'],
				'telephone' 	=> $customer['telephone'],
				'type' 	=> $out['type'],
				'firstname' 	=> $customer['firstname'],
				'add' 			=> $this->url->link('account/edit/add', 'customer_in_id='.$out['customer_in_id'], 'SSL'),
				'status'	=> $out['status'],
				'del' 		=> $this->url->link('account/edit/del', 
				'customer_in_id='.$out['customer_in_id'], 'SSL')
				
			);
		}
		
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_your_details'] = $this->language->get('text_your_details');

		$this->data['entry_firstname'] = $this->language->get('entry_firstname');
		$this->data['entry_lastname'] = $this->language->get('entry_lastname');
		$this->data['entry_email'] = $this->language->get('entry_email');
		$this->data['entry_telephone'] = $this->language->get('entry_telephone');
		$this->data['entry_fax'] = $this->language->get('entry_fax');

		$this->data['button_continue'] = $this->language->get('button_continue');
		$this->data['button_back'] = $this->language->get('button_back');

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->error['firstname'])) {
			$this->data['error_firstname'] = $this->error['firstname'];
		} else {
			$this->data['error_firstname'] = '';
		}

		if (isset($this->error['email'])) {
			$this->data['error_email'] = $this->error['email'];
		} else {
			$this->data['error_email'] = '';
		}	
		
		if (isset($this->error['telephone'])) {
			$this->data['error_telephone'] = $this->error['telephone'];
		} else {
			$this->data['error_telephone'] = '';
		}	
		
		$this->data['action'] = $this->url->link('account/edit', '', 'SSL');

		if ($this->request->server['REQUEST_METHOD'] != 'POST') {
			$customer_info = $this->model_account_customer->getCustomer($this->customer->getId());
		}

		if (isset($this->request->post['firstname'])) {
			$this->data['firstname'] = $this->request->post['firstname'];
		} elseif (isset($customer_info)) {
			$this->data['firstname'] = $customer_info['firstname'];
		} else {
			$this->data['firstname'] = '';
		}


		if (isset($this->request->post['email'])) {
			$this->data['email'] = $this->request->post['email'];
		} elseif (isset($customer_info)) {
			$this->data['email'] = $customer_info['email'];
		} else {
			$this->data['email'] = '';
		}

		if (isset($this->request->post['telephone'])) {
			$this->data['telephone'] = $this->request->post['telephone'];
		} elseif (isset($customer_info)) {
			$this->data['telephone'] = $customer_info['telephone'];
		} else {
			$this->data['telephone'] = '';
		}

		$this->data['back'] = $this->url->link('account/account', '', 'SSL');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/edit.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/account/edit.tpl';
		} else {
			$this->template = 'default/template/account/edit.tpl';
		}
		
		$this->children = array(

			'common/footer',
			'common/header'	
		);
						
		$this->response->setOutput($this->render());	
	}

	protected function validate() {
		if ((utf8_strlen($this->request->post['firstname']) < 1) || (utf8_strlen($this->request->post['firstname']) > 32)) {
			$this->error['firstname'] = 'Укажите ваше имя!';
		}

		if ((utf8_strlen($this->request->post['email']) > 96) || !$this->ocstore->validate($this->request->post['email'])) {
			$this->error['email'] = $this->language->get('error_email');
		}
		
		if (($this->customer->getEmail() != $this->request->post['email']) && $this->model_account_customer->getTotalCustomersByEmail($this->request->post['email'])) {
			$this->error['warning'] = $this->language->get('error_exists');
		}

		if ((utf8_strlen($this->request->post['telephone']) < 12) || (utf8_strlen($this->request->post['telephone']) > 14)) {
			$this->error['telephone'] = 'Пример: +76665554433';
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
	
	public function del() {
	
	if($this->customer->getAdmin()) {
			
			if(isset($this->request->get['customer_in_id']) && $this->request->get['customer_in_id']) {
			$this->load->model('account/customer');
			$customers = $this->model_account_customer->delCustomerin($this->request->get['customer_in_id']);
			
			$this->session->data['success'] = 'Заявка успешно удалена.';
			
	  		$this->redirect($this->url->link('account/edit', '', 'SSL'));
			
			}
	}
	
	}
	
	
	public function add() {
	
	if($this->customer->getAdmin()) {
			
			if(isset($this->request->get['customer_in_id']) && $this->request->get['customer_in_id']) {
			$this->load->model('account/customer');
			$customers = $this->model_account_customer->addCustomerin($this->request->get['customer_in_id']);
			
			$this->session->data['success'] = 'Заявка успешно обработана, средства зачислены на счет пользователя.';
			
	  		$this->redirect($this->url->link('account/edit', '', 'SSL'));
			
			}
	}
	
	}
	
	
}
?>