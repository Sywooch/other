<?php
class ControllerAccountAdd extends Controller {
	public function index() {
		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/transaction', '', 'SSL');
			
	  		$this->redirect($this->url->link('account/login', '', 'SSL'));
    	}	
		
		
		$this->language->load('account/transaction');

		$this->document->setTitle('Пополнение счета');

		
		$this->load->model('account/transaction');
        $this->load->model('account/customer');

		
		$this->data['back'] = $this->url->link('account/transaction', '', 'SSL');

		
		if(isset($this->request->post['summ']) && $this->request->post['summ'] >= 300) {

		$transaction_id = $this->model_account_transaction->addpreinvest($this->request->post);
		
		$this->language->load('mail/forgotten');
			
			$subject = 'Заявка на ввод средств. '. NAME;
			
			$message  = 'Поступила новая заявка на ввод средств' . "\n\n";
			$message .= 'Пользователь: '.$this->customer->getFirstname() . "\n";
			$message .= 'Email: '.$this->customer->getEmail() . "\n";
			$message .= 'Телефон: '.$this->customer->getTelephone() . "\n\n";
			$message .= 'Детали заявки:' . "\n";
			$message .= 'Платежная система: '.$this->request->post['type'] . "\n";
			$message .= 'Сумма: '.(float)$this->request->post['summ'] . "\n\n";
			

			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->hostname = $this->config->get('config_smtp_host');
			$mail->username = $this->config->get('config_smtp_username');
			$mail->password = $this->config->get('config_smtp_password');
			$mail->port = $this->config->get('config_smtp_port');
			$mail->timeout = $this->config->get('config_smtp_timeout');				
			$mail->setTo(EMAIL);
			$mail->setFrom(EMAIL);
			$mail->setSender(NAME);
			$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
			$mail->setText(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
			$mail->send();
			
		$customer_info = $this->model_account_customer->getCustomer($this->customer->getId());
		
		if($this->request->post['type'] =='Yandex') {
		
		
		$action = 'https://money.yandex.ru/quickpay/confirm.xml'; 
		
		$summ = (int)$this->request->post['summ'];
		$desc = 'Пополнение счета kondratik.ru от ' . $customer_info['email'];

		$this->data['merchant_url'] = $action .

				'?label=&receiver=41001666106597&quickpay-form=shop&referer=http://kondratik.ru/account/index.php?route=account/add&is-inner-form=true&need-fio=true&need-email=true&targets='. $desc	.'&comment=&sum='.$summ.'&paymentType=PC';
		
         $this->redirect($this->data['merchant_url']);	
		 
		 
		} elseif($this->request->post['type'] =='Qiwi') {
			
			$this->session->data['qiwiinfo'] = $this->request->post['summ'];
			$this->redirect($this->url->link('account/add', '', 'SSL'));	
		 
		} 

		}		
		
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/add.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/account/add.tpl';
		} else {
			$this->template = 'default/template/account/add.tpl';
		}
		
		$this->children = array(

			'common/footer',
			'common/header'	
		);
						
		$this->response->setOutput($this->render());		
	}
	
	public function yes() {
	$this->session->data['success'] = 'Пополнение счета завершено успешно';
			
	  		$this->redirect($this->url->link('account/transaction', '', 'SSL'));
	}
	public function no() {
	$this->session->data['warning'] = 'Птатеж не завершен, попробуйте снова';
	$this->load->model('account/transaction');
	
	  		$this->redirect($this->url->link('account/transaction', '', 'SSL'));
	}
	
	
	public function result() {
		$this->load->model('account/transaction');

		$mrh_pass2 = 'wdfr2345t';
		$out_summ = $this->request->post['OutSum'];
		$order_id = $this->request->post["InvId"];
		$crc = $this->request->post["SignatureValue"];
        $mrh_login = 'bettinvest';
		// HTTP parameters: $out_summ, $inv_id, $crc
		$crc = strtoupper($crc);   // force uppercase

		// build own CRC
		$my_crc = strtoupper(md5("$out_summ:$order_id:$mrh_pass2"));

		if (strtoupper($my_crc) == strtoupper($crc))
		
		{
        
		
		$order = $this->model_account_transaction->gettr($order_id);
		
		if($order && $order['status'] == 0) { 
		
		    $this->model_account_transaction->changestatus($order_id);
			//$this->model_account_transaction->addinvest($out_summ,$order_id);
			
            
         } 
		 
		} else {
		 $this->model_account_transaction->deltr($order_id);

		 } 

	}
	
	
}
?>