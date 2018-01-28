<?php
class ModelAccountTransaction extends Model {	

	public function deltr($id) {
	$this->db->query("DELETE FROM " . DB_PREFIX . "customer_transaction
		WHERE customer_transaction_id = '". (int)$id."'");
	}
	public function gettr($id) {		
        
		//transaction
	    $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_transaction WHERE
		customer_transaction_id = '" . (int)$id . "'");
		
	    
		return $query->row;
		
	}
	
	public function changestatus($id) {
    $this->db->query("UPDATE " . DB_PREFIX . "customer_transaction SET status=1 WHERE
		customer_transaction_id = '" . (int)$id . "'");

	}
	
	public function addpreinvest($data) {	
	
		$this->db->query("INSERT INTO " . DB_PREFIX . "customer_in SET customer_id = '" . (int)$this->customer->getId() . "', type = '" . $this->db->escape($data['type']) . "', amount = '" . (float)$data['summ'] . "', status = '0', date_added = NOW()");
		
		$tr_id = $this->db->getLastId();
		return $tr_id;
		
	}
	
	
	public function checkoprders($id) {	
		$this->db->query("DELETE FROM " . DB_PREFIX . "customer_transaction WHERE customer_id = '". (int)$id."' AND status = 0");
        
	}
	
	public function getTransactions($data = array()) {
		$sql = "SELECT * FROM `" . DB_PREFIX . "customer_transaction` WHERE customer_id = '" . (int)$this->customer->getId() . "'";
		   
		$sort_data = array(
			'amount',
			'description',
			'date_added'
		);
	
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY date_added";	
		}
			
		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}
		
		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}			

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}	
			
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);
	
		return $query->rows;
	}	
		
	public function getTotalTransactions() {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "customer_transaction` WHERE customer_id = '" . (int)$this->customer->getId() . "'");
			
		return $query->row['total'];
	}	
	
	public function getTransactionsId($data = array(),$id) {
		$sql = "SELECT * FROM `" . DB_PREFIX . "customer_transaction` WHERE customer_id = '" . (int)$id . "'";
		   
		$sort_data = array(
			'amount',
			'description',
			'date_added'
		);
	
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY date_added";	
		}
			
		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}
		
		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}			

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}	
			
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);
	
		return $query->rows;
	}	
		
	public function getTotalTransactionsId($id) {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "customer_transaction` WHERE customer_id = '" . (int)$id . "'");
			
		return $query->row['total'];
	}	
	
	
	public function getTotalAmount() {
		$query = $this->db->query("SELECT SUM(amount) AS total FROM `" . DB_PREFIX . "customer_transaction` WHERE customer_id = '" . (int)$this->customer->getId() . "' GROUP BY customer_id");
		
		if ($query->num_rows) {
			return $query->row['total'];
		} else {
			return 0;	
		}
	}
}
?>