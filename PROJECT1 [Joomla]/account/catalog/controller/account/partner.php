<?php 
class ControllerAccountPartner extends Controller {  
	public function index() {
    	$this->language->load('account/success');
  if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/edit', '', 'SSL');

			$this->redirect($this->url->link('account/login', '', 'SSL'));
		}
    	$this->document->setTitle('Партнерка');

    	$this->data['heading_title'] = 'Партнерка';

		$this->load->model('account/customer');
		$this->data['ref_balance'] = (float)$this->model_account_customer->getCustomerRefbalance($this->customer->getId());
		$this->data['actref'] = $this->model_account_customer->getactrefs($this->customer->getId());
		$this->data['ref_count'] = $this->model_account_customer->getCustomerRefCount($this->customer->getId());
		
		if (isset($this->session->data['success'])) {
    		$this->data['success'] = $this->session->data['success'];
			
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}
		
		
		
		$this->data['outs'] = array();
		
		$outs = $this->model_account_customer->getOuts();
 		
    	foreach ($outs as $out) {
		
		$customer = $this->model_account_customer->getCustomer($out['customer_id']);
		
			$this->data['outs'][] = array(
			
		
			
				'date_added'      => $out['date_added'],
				'amount'     	 => (float)$out['amount'],
				'email' 		=> $customer['email'],
				'telephone' 	=> $customer['telephone'],
				'type' 	=> $out['type'],
				'wallet' 	=> $out['wallet'],
				'firstname' 	=> $customer['firstname'],
				'total' 	=> (float)$customer['balance'],
				'add' 			=> $this->url->link('account/partner/add', 'customer_out_id='.$out['customer_out_id'], 'SSL'),
				'status'	=> $out['status'],
				'del' 		=> $this->url->link('account/partner/del', 
				'customer_out_id='.$out['customer_out_id'], 'SSL')
				
			);
		}
		
    	$this->data['text_message'] = sprintf($this->language->get('text_message'), $this->url->link('information/contact'));
		
    	$this->data['button_continue'] = $this->language->get('button_continue');
		

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/partner.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/account/partner.tpl';
		} else {
			$this->template = 'default/template/account/partner.tpl';
		}
		
		$this->children = array(
			'common/footer',
			'common/header'	
		);
						
		$this->response->setOutput($this->render());				
  	}
	
	public function del() {
	
	if($this->customer->getAdmin()) {
			
			if(isset($this->request->get['customer_out_id']) && $this->request->get['customer_out_id']) {
			$this->load->model('account/customer');
			$customers = $this->model_account_customer->delCustomerout($this->request->get['customer_out_id']);
			
			$this->session->data['success'] = 'Заявка успешно удалена.';
			
	  		$this->redirect($this->url->link('account/partner', '', 'SSL'));
			
			}
	}
	
	}
	
	
	public function add() {
	
	if($this->customer->getAdmin()) {
			
			if(isset($this->request->get['customer_out_id']) && $this->request->get['customer_out_id']) {
			$this->load->model('account/customer');
			$customers = $this->model_account_customer->addCustomerout($this->request->get['customer_out_id']);
			
			$this->session->data['success'] = 'Заявка успешно обработана, средства списаны со счета пользователя.';
			
	  		$this->redirect($this->url->link('account/partner', '', 'SSL'));
			
			}
	}
	
	}
	
	
}
?>