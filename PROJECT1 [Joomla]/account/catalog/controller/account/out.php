<?php
class ControllerAccountOut extends Controller {
	private $error = array();

	public function index() {
		if (!$this->customer->isLogged()) {
			$this->redirect($this->url->link('account/login', '', 'SSL'));
		}

		$this->language->load('account/forgotten');

		$this->document->setTitle('Заявка на вывод средств');
		
		$this->load->model('account/customer');
		
		$this->data['total'] = (float)$this->model_account_customer->getCustomerbalance($this->customer->getId());
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->language->load('mail/forgotten');
			
			$this->model_account_customer->addOut($this->request->post);
			
			$subject = 'Заявка на вывод средств. '. NAME;
			
			$message  = 'Поступила новая заявка на вывод средств' . "\n\n";
			$message .= 'Пользователь: '.$this->customer->getFirstname() . "\n";
			$message .= 'Email: '.$this->customer->getEmail() . "\n";
			$message .= 'Телефон: '.$this->customer->getTelephone() . "\n\n";
			$message .= 'Детали заявки:' . "\n";
			$message .= 'Платежная система: '.$this->request->post['type'] . "\n";
			$message .= 'Кошелек: '.$this->request->post['wallet'] . "\n";
			$message .= 'Сумма: '.(float)$this->request->post['amount'] . "\n\n";
			

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
			
			$this->session->data['success'] = 'Заявка на вывод средств успешно отправлена!';

			$this->redirect($this->url->link('account/transaction', '', 'SSL'));
		}

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_your_email'] = $this->language->get('text_your_email');
		$this->data['text_email'] = $this->language->get('text_email');

		$this->data['entry_email'] = $this->language->get('entry_email');

		$this->data['button_continue'] = $this->language->get('button_continue');
		$this->data['button_back'] = $this->language->get('button_back');

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
		if (isset($this->request->post['wallet'])) {
			$this->data['wallet'] = $this->request->post['wallet'];
		} else {
			$this->data['wallet'] = '';
		}
		
		if (isset($this->request->post['amount'])) {
			$this->data['amount'] = (float)$this->request->post['amount'];
		} else {
			$this->data['amount'] = '';
		}
		
		if (isset($this->request->post['type'])) {
			$this->data['type'] = $this->request->post['type'];
		} else {
			$this->data['type'] = '';
		}
		
		$this->data['action'] = $this->url->link('account/out', '', 'SSL');
 
		$this->data['back'] = $this->url->link('account/transaction', '', 'SSL');
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/out.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/account/out.tpl';
		} else {
			$this->template = 'default/template/account/out.tpl';
		}
		
		$this->children = array(

			'common/footer',
			'common/header'	
		);
								
		$this->response->setOutput($this->render());		
	}

	protected function validate() {
	
		$this->load->model('account/customer');
		
		$total = (float)$this->model_account_customer->getCustomerbalance($this->customer->getId());
		
		if (!isset($this->request->post['wallet']) || !$this->request->post['wallet']) {
			$this->error['warning'] = 'Необходимо указать номер кошелька в выбранной системе!';
		} 
		
		if (!isset($this->request->post['amount'])) {
			$this->error['warning'] = 'Необходимо указать сумму!';
		} elseif (!$this->request->post['amount'] || (float)$this->request->post['amount'] > (float)$total) {
			$this->error['warning'] = 'Сумма не может быть больше баланса или равной 0!';
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
}
?>