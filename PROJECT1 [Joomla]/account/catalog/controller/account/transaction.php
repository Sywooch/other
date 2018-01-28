<?php
class ControllerAccountTransaction extends Controller {
	public function index() {
		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/transaction', '', 'SSL');
			
	  		$this->redirect($this->url->link('account/login', '', 'SSL'));
    	}		
		
		$this->language->load('account/transaction');

		$this->document->setTitle(NAME);

      
	  if (isset($this->session->data['success'])) {
    		$this->data['success'] = $this->session->data['success'];
			
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}
		
		if (isset($this->session->data['warning'])) {
    		$this->data['warning'] = $this->session->data['warning'];
			
			unset($this->session->data['warning']);
		} else {
			$this->data['warning'] = '';
		}
		$this->load->model('account/customer');
		$this->load->model('account/transaction');

    	$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['column_date_added'] = $this->language->get('column_date_added');
		$this->data['column_description'] = $this->language->get('column_description');
		$this->data['column_amount'] = sprintf($this->language->get('column_amount'), $this->config->get('config_currency'));
		
		$this->data['text_total'] = $this->language->get('text_total');
		$this->data['text_empty'] = $this->language->get('text_empty');
		
		$this->data['button_continue'] = $this->language->get('button_continue');
		
		$this->data['customers'] = array();
		
		$customers = $this->model_account_customer->getCustomers();
 		
    	foreach ($customers as $customer) {
			$this->data['customers'][] = array(
				'customer_id'=> $customer['customer_id'],
				'balance'      => (float)$customer['balance'],
				'ref_balance'      => (float)$customer['ref_balance'],
				'email' => $customer['email'],
				'telephone' => $customer['telephone'],
				'firstname' => $customer['firstname'],
				'partner' => $customer['partner_id']?$this->model_account_customer->getCustomerName($customer['partner_id']):'',
				'view' => $this->url->link('account/transaction/view', 'customer_id='.$customer['customer_id'], 'SSL'),
				'del' => $this->url->link('account/transaction/del', 'customer_id='.$customer['customer_id'], 'SSL'),
				'date_added'  => date($this->language->get('date_format_short'), strtotime($customer['date_added'])),
			);
		}	
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}		
		
		$this->data['transactions'] = array();
		
		$data = array(				  
			'sort'  => 'date_added',
			'order' => 'DESC',
			'start' => ($page - 1) * 10,
			'limit' => 10
		);
		
		$transaction_total = $this->model_account_transaction->getTotalTransactions($data);
	
		$results = $this->model_account_transaction->getTransactions($data);
 		
    	foreach ($results as $result) {
			$this->data['transactions'][] = array(
				'amount'      => (float)$result['amount'],
				'description' => $result['description'],
				'date_added'  => date($this->language->get('date_format_short'), strtotime($result['date_added']))
			);
		}	

		$pagination = new Pagination();
		$pagination->total = $transaction_total;
		$pagination->page = $page;
		$pagination->limit = 10; 
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('account/transaction', 'page={page}', 'SSL');
			
		$this->data['pagination'] = $pagination->render();
		
		$this->data['total'] = (float)$this->model_account_customer->getCustomerbalance($this->customer->getId());
		$ammout = false;
		foreach ($results as $result) { if($result['description']=='Пополнение счета') {
		
			$ammout = $ammout +(float)$result['amount'];
			}
		}	
		
		$ammin = false;
		foreach ($results as $result) { if($result['description']=='Вывод средств со счета') {
		
			$ammin = $ammin +(float)$result['amount'];
			}
		}	
		
		$this->data['total_out'] = (float)$ammout;
		$this->data['total_in'] = (float)$ammin;
		
		$this->data['continue'] = $this->url->link('account/account', '', 'SSL');
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/transaction.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/account/transaction.tpl';
		} else {
			$this->template = 'default/template/account/transaction.tpl';
		}
		
		$this->children = array(

			'common/footer',
			'common/header'	
		);
						
		$this->response->setOutput($this->render());		
	} 		
	
	public function del() {
	
	if($this->customer->getAdmin()) {
			
			if(isset($this->request->get['customer_id']) && $this->request->get['customer_id']) {
			$this->load->model('account/customer');
			$customers = $this->model_account_customer->delCustomers($this->request->get['customer_id']);
			
			$this->session->data['success'] = 'Пользователь успешно удален.';
			
	  		$this->redirect($this->url->link('account/transaction', '', 'SSL'));
			
			}
	}
	
	}
	
	
	public function view() {
		if (!$this->customer->isLogged() || !$this->customer->getAdmin() || !isset($this->request->get['customer_id']) || !$this->request->get['customer_id']) {
			$this->session->data['redirect'] = $this->url->link('account/transaction', '', 'SSL');
			
	  		$this->redirect($this->url->link('account/login', '', 'SSL'));
    	}		
		
		$customer_id = $this->request->get['customer_id'];
		
		$this->language->load('account/transaction');

		$this->document->setTitle(NAME);

		
		$this->load->model('account/customer');
		$this->load->model('account/transaction');

		$this->data['column_date_added'] = $this->language->get('column_date_added');
		$this->data['column_description'] = $this->language->get('column_description');
		$this->data['column_amount'] = sprintf($this->language->get('column_amount'), $this->config->get('config_currency'));
		
		$this->data['text_total'] = $this->language->get('text_total');
		$this->data['text_empty'] = $this->language->get('text_empty');
		
		$this->data['button_continue'] = $this->language->get('button_continue');
		
		
		
		$this->data['customer'] = $this->model_account_customer->getCustomer($customer_id);
		
		if (isset($this->request->get['page'])) {
	
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}		
		
		$this->data['transactions'] = array();
		
		$data = array(				  
			'sort'  => 'date_added',
			'order' => 'DESC',
			'start' => ($page - 1) * 10,
			'limit' => 10
		);
		
		$transaction_total = $this->model_account_transaction->getTotalTransactionsId($customer_id);
	
		$results = $this->model_account_transaction->getTransactionsId($data,$customer_id);
 		
    	foreach ($results as $result) {
			$this->data['transactions'][] = array(
				'amount'      => (float)$result['amount'],
				'description' => $result['description'],
				'date_added'  => date($this->language->get('date_format_short'), strtotime($result['date_added']))
			);
		}	

		$pagination = new Pagination();
		$pagination->total = $transaction_total;
		$pagination->page = $page;
		$pagination->limit = 10; 
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('account/view', 'page={page}'.'&customer_id='.$customer_id, 'SSL');
			
		$this->data['pagination'] = $pagination->render();
		
		$this->data['total'] = (float)$this->model_account_customer->getCustomerbalance($customer_id);
		
		$this->data['continue'] = $this->url->link('account/transaction', '', 'SSL');
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/view.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/account/view.tpl';
		} else {
			$this->template = 'default/template/account/view.tpl';
		}
		
		$this->children = array(

			'common/footer',
			'common/header'	
		);
						
		$this->response->setOutput($this->render());		
	} 
	
	
	public function payday() {
	
			$this->load->model('account/invets');
			$this->model_account_invets->gogogo();
			
	} 
	
}
?>