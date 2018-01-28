<?php
class ModelAccountCustomer extends Model {
	public function addCustomer($data) {
		
		
      	$this->db->query("INSERT INTO " . DB_PREFIX . "customer SET store_id = '" . (int)$this->config->get('config_store_id') . "', firstname = '" . $this->db->escape($data['firstname']) . "', email = '" . $this->db->escape($data['email']) . "', telephone = '" . $this->db->escape($data['telephone']) . "', partner_id='" . (int)$data['partner_id'] . "', salt = '" . $this->db->escape($salt = substr(md5(uniqid(rand(), true)), 0, 9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "', ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "', status = '1', approved = '" . (int)!$customer_group_info['approval'] . "', date_added = NOW()");
      	
		$customer_id = $this->db->getLastId();
		
		$this->language->load('mail/customer');
		
		$subject = sprintf($this->language->get('text_subject'), NAME);
		
		$message = sprintf($this->language->get('text_welcome'), NAME) . "\n\n";
		
		if (!$customer_group_info['approval']) {
			$message .= $this->language->get('text_login') . "\n";
		} else {
			$message .= $this->language->get('text_approval') . "\n";
		}
		
		$message .= $this->url->link('account/login', '', 'SSL') . "\n\n";
		$message .= $this->language->get('text_thanks') . "\n";
		$message .= NAME;
		
		$mail = new Mail();
		$mail->protocol = $this->config->get('config_mail_protocol');
		$mail->parameter = $this->config->get('config_mail_parameter');
		$mail->hostname = $this->config->get('config_smtp_host');
		$mail->username = $this->config->get('config_smtp_username');
		$mail->password = $this->config->get('config_smtp_password');
		$mail->port = $this->config->get('config_smtp_port');
		$mail->timeout = $this->config->get('config_smtp_timeout');				
		$mail->setTo($data['email']);
		$mail->setFrom(EMAIL);
		$mail->setSender(NAME);
		$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
		$mail->setText(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
		$mail->send();
		
		// Send to main admin email if new account email is enabled
		if ($this->config->get('config_account_mail')) {
			$message  = $this->language->get('text_signup') . "\n\n";
			$message .= $this->language->get('text_website') . ' ' . NAME . "\n";
			$message .= $this->language->get('text_firstname') . ' ' . $data['firstname'] . "\n";
			$message .= $this->language->get('text_email') . ' '  .  $data['email'] . "\n";
			$message .= $this->language->get('text_telephone') . ' ' . $data['telephone'] . "\n";
			
			$mail->setTo(EMAIL);
			$mail->setSubject(html_entity_decode($this->language->get('text_new_customer'), ENT_QUOTES, 'UTF-8'));
			$mail->setText(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
			$mail->send();

		}
	}
	public function getTotalCustomersByEmail($email) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");

		
		return $query->row['total'];
	}
	
	public function getactrefs($id) {
	
		$query = $this->db->query("SELECT COUNT(ct.customer_transaction_id) AS total FROM " . DB_PREFIX . "customer_transaction ct LEFT JOIN " . DB_PREFIX . "customer c ON (ct.customer_id = c.customer_id) WHERE c.partner_id = '" . (int)$id . "'");

		
		return $query->row['total'];
	}
	
	public function getCustomers() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE admin = 0 ORDER BY customer_id");

		
		return $query->rows;
	}
	public function getOuts() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_out");
		
		
		return $query->rows;
	}
	
	public function getIns() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_in");
		
		
		return $query->rows;
	}
	
	public function addOut($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "customer_out SET customer_id = '" . (int)$this->customer->getId() . "', type = '" . $this->db->escape($data['type']) . "', wallet = '" . $this->db->escape($data['wallet']) . "', amount = '" . (float)$data['amount'] . "', status = '0', date_added = NOW()");
	}
	
	
	public function delCustomers($id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "customer WHERE customer_id = '".(int)$id."'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "customer_transaction WHERE customer_id = '".(int)$id."'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "customer_in WHERE customer_id = '".(int)$id."'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "customer_out WHERE customer_id = '".(int)$id."'");
	}
	
	public function delCustomerOut($id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "customer_out WHERE customer_out_id = '".(int)$id."'");
		
	}
	
	public function addCustomerOut($id) {
		

    $this->db->query("UPDATE " . DB_PREFIX . "customer_out SET status=1 WHERE customer_out_id = '" . (int)$id . "'");
	
	
	///тут нужно списать средства с инвестиций
	
	$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_out WHERE customer_out_id = '" . (int)$id . "'");
		
	$info = $query->row;
	


	$this->db->query("INSERT INTO " . DB_PREFIX . "customer_transaction SET customer_id = '" . (int)$info['customer_id'] . "', description = 'Вывод средств со счета', amount = '" . (float)abs($info['amount']) . "', date_added = NOW()");
		
	$this->db->query("UPDATE " . DB_PREFIX . "customer SET balance=balance-'".(float)abs($info['amount'])."' WHERE customer_id = '" . (int)$info['customer_id'] . "'");
	
	
	}
	
	public function delCustomerIn($id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "customer_in WHERE customer_in_id = '".(int)$id."'");
		
	}
	
	public function addCustomerIn($id) {
		

    $this->db->query("UPDATE " . DB_PREFIX . "customer_in SET status=1 WHERE customer_in_id = '" . (int)$id . "'");

	$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_in WHERE customer_in_id = '" . (int)$id . "'");
		
	$info = $query->row;
	
	///тут нужно зачислить средства на инвестиции

	$this->db->query("INSERT INTO " . DB_PREFIX . "customer_transaction SET customer_id = '" . (int)$info['customer_id'] . "', description = 'Пополнение счета', amount = '" . (float)abs($info['amount']) . "', date_added = NOW()");
		
	$this->db->query("UPDATE " . DB_PREFIX . "customer SET balance=balance+'".(float)abs($info['amount'])."' WHERE customer_id = '" . (int)$info['customer_id'] . "'");
	
	}
	
	public function editCustomer($data) {
		$this->db->query("UPDATE " . DB_PREFIX . "customer SET firstname = '" . $this->db->escape($data['firstname']) . "', email = '" . $this->db->escape($data['email']) . "', telephone = '" . $this->db->escape($data['telephone']) . "' WHERE customer_id = '" . (int)$this->customer->getId() . "'");
	}

	public function editPassword($email, $password) {
      	$this->db->query("UPDATE " . DB_PREFIX . "customer SET salt = '" . $this->db->escape($salt = substr(md5(uniqid(rand(), true)), 0, 9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($password)))) . "' WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");
	}
		
	public function getCustomer($customer_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int)$customer_id . "'");
		
		return $query->row;
	}
	
	public function getCustomerByEmail($email) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");
		
		return $query->row;
	}
	
	
	public function getCustomerRefbalance($id) {
		$query = $this->db->query("SELECT ref_balance FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int)$id . "'");
		
		return $query->row['ref_balance'];
	}
	
	public function getCustomerbalance($id) {
		$query = $this->db->query("SELECT balance FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int)$id . "'");
		
		return $query->row['balance'];
	}
	
	
	public function getCustomerbalanceOut($id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_transaction WHERE customer_id = '" . (int)$id . "' AND description = 'Вывод средств со счета'");
		$amount = false;
		if($query->rows) {
		foreach($query->rows as $query->row) { 
		$amount = $amount+$query->row['amount'];
		}
		} else {
		return false;
		}
	}
	
	public function getCustomerbalanceIn($id) {
		$query = $this->db->query("SELECT amount FROM " . DB_PREFIX . "customer_transaction WHERE customer_id = '" . (int)$id . "' AND description = 'Пополнение счета'");
		$amount = false;
		
		if($query->rows) {
		foreach($query->rows as $query->row) { 
		$amount = $amount+$query->row['amount'];
		}
		} else {
		return false;
		}
	}
	
	public function getCustomerName($id) {
		$query = $this->db->query("SELECT firstname FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int)$id . "'");
		
		if(isset($query->row['firstname']) && $query->row['firstname']) {
		return $query->row['firstname'];
		} else {
		return false;
		}
	}
	
	public function getCustomerRefCount($id) {
		$query = $this->db->query("SELECT COUNT(customer_id) AS total FROM " . DB_PREFIX . "customer WHERE partner_id = '" . (int)$id . "'");
		
		return $query->row['total'];
	}
	
	
	public function getCustomerByToken($token) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE token = '" . $this->db->escape($token) . "' AND token != ''");
		
		$this->db->query("UPDATE " . DB_PREFIX . "customer SET token = ''");
		
		return $query->row;
	}
	
}
?>
