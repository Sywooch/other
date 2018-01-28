<?php
require_once 'class_tree.php';  // ������ ���� ���������


/**
 * �������
 *
 *
 * ����������� ����� ���������� � ����� ***_t_config.php
 * timestamp - ������ ����
 * node_last_onmod	- ���� ����� �� ������ ��������� ����������� ������� ������
 * node_best	- ���� ����� �� ������ ������/��������� ������� ������
 * node_last_onmain	- ���� ����� �� ������ ��������� ����������� ������� ������
 * node_best_onmain	- ���� ����� �� ������ ����������/������ ������� ��� ������ �� ������� �������� (��� �� ����� ������)
 * menu_withchilds	- ���� � ������
 * menu_withoutchilds	- ���� ��� �����
 *
 *
 *
 *
 */
class class_tree_shop extends class_tree
{
	
	/** ����� - �������  */ 
	var $catalog = null;
	
	
	var $catalog_name = '';

	public function main()
	{

		$this->catalog_name = $this->std->settings[$this->mod_name.'_modrecipient'];



		# ������������� ������ �������, ������ ���������, ����� �� ��������� �������� �������� ������
		if ($this->std->alias[0] != $this->mod_name)
		{
			# ��������� ������� - ����� ���������� ������� � ����� �����
			$this->setPul($this->mod_name.'_cart', $this->getMiniCart());
				
			# ���� �������� ������ ������, �� �����
			return;
		}



		# ����� ����������� ������������� ��������
		$this->selectAction();

		# ��������� ������� - ����� ���������� ������� � ����� �����
		$this->setPul($this->mod_name.'_cart', $this->getMiniCart());

	}





	/**
	 * ����� ����������� ������������� ��������
	 *
	 */
	public function selectAction()
	{
		if (isset($this->std->alias[0]) && ($this->std->alias[0] == $this->mod_name))
		if (isset($this->std->alias[1]))
		{
			$this->setPul('h1', '������� ����������');
			$this->setPul('title', '������� ����������');
			
			
			switch ($this->std->alias[1])
			{									
				case 'cart' :
							$this->setPul('body', $this->getFullCart()); 
							break;
				case 'thankyou' :
							# �����
							$this->updatePul('h1', '���������� ������');
							$this->updatePul('title', '���������� ������'); 
							$this->setPul('body', $this->getOrder());
							break; 
							break;
				case 'calc' :					
							if (isset($this->std->input['calc']))
							{ 
								# ������ �������� 
								$this->calcCart();
								$this->setPul('body', $this->getFullCart()); 
								break;
							}
							else
							{
								# �����
								$this->updatePul('h1', '���������� ������');
								$this->updatePul('title', '���������� ������'); 
								$this->setPul('body', $this->getOrder());
								break;
							}
							
				case 'add' : 
							$this->addCart(); 
							$this->setPul('body', $this->getFullCart()); 
							break;
				case 'del' : 
							$this->delCart(); 
							$this->setPul('body', $this->getFullCart()); 
							break;
							
				case 'approve' :							 
							$this->setPul('body', $this->approveCart()); 
							break;
							
				case 'statistic' :							 
							$this->setPul('body', $this->statisticCart()); 
							break;
							
				default : 
						$this->setPul('body', $this->getFullCart()); 
						break;
			}
				
			$this->template = 'static';
		}
		else
		{
			$this->setPul('body', $this->getFullCart());
		}
	}
	
	

	/**
	 * ������������ ���������� ������� � ������� � ����� ����� ������
	 *
	 */
	public function getMiniCart()
	{
		$res = '';

		# ���������� ���������� � ��������� �������
		$cart = $this->std->getValueSession($this->mod_name); 
		$pms = array();
		$pms['sum'] = 0;
		$pms['count'] = 0;

		if (is_array($cart['goods']))
		foreach ($cart['goods'] as $id => $good)
		{
			$pms['sum'] += $good['price'] * $good['count'];
			$pms['count']++;
		}

		if ($pms['count'] > 0)
		{
			# � ������� ���-�� �����
			$pms['sum'] = number_format($pms['sum'], 2, ',', ' ');
			$res = $this->strtr_mod($this->skin['full'], $pms);
		}
		else
		{
			# ������� �����
			$res = $this->skin['empty'];
		}

		$res = str_replace('{mod_name}', $this->mod_name, $res);
		
		return $res;

	}


	/**
	 * �������� ��������� �������
	 *
	 */
	function calcCart()
	{
		# �������� ������ ������� (������������ ��� �������� ���������� �������)
		$cart = $this->std->getValueSession($this->mod_name);
		
		
		
		# ������� ������ � ������� �� ����
		$ids = array();
		foreach ($cart['goods'] as $id => $good)
		{
			$ids[] = $id;
		}

		
		if (count($ids) > 0)
		{
			$new_cart = array('goods' => array());
			
			# �������� �������������� ������������ �������, ������ ������ ���� � ��������
			$sql = "SELECT id FROM se_{$this->catalog_name} WHERE `id` IN ('".implode("','", $ids)."')";
			
			if ($this->std->db->query($sql, $rows) > 0)
			{
				foreach ($rows as $row)
				{
					$id = $row['id'];
					$count = $this->std->StringToInt($this->std->input['count'][$id]);
					$new_cart['goods'][$id] = $cart['goods'][$id];				
						
					if ($count <= 0)
					{
						unset($new_cart['goods'][$id]);
					}
					else
					{
						$new_cart['goods'][$id]['count'] = $count;
					}
				}
			}
			
			$this->std->updateSession($this->std->member['session_id'], 'update', array($this->mod_name => $new_cart));
		}
		
		
			
		return;
	}

	

	

	/**
	 * ���������� ������������� �������
	 *
	 */
	function updateAttend()
	{
		# ������� ������ � �������
		$cart = $this->std->getValueSession($this->mod_name);

		$pairs = array(); // ���� �������
		foreach ($cart['goods'] as $gid1 => $good)
		{
			foreach ($cart['goods'] as $gid2 => $good)
			{
				if ($gid1 == $gid2) continue;
				$g1 = ($gid1 < $gid2)? $gid1 : $gid2;
				$g2 = ($gid1 < $gid2)? $gid2 : $gid1;

				if (!isset($pairs[$g1.$g2])) $pairs[$g1.$g2] = array('g1' => $g1, 'g2' => $g2);
			}
		}

		if (count($pairs) == 0) return;

		# ��������� ������ sql ����� ������, ���������� ����� ���� ��� ���
		$ors = array();
		foreach ($pairs as $ids)
		{
			$ors[] = "(`good_id1` = '".$ids['g1']."' AND `good_id2` = '".$ids['g2']."')";
		}

		$ors = implode(" OR ", $ors);

		$sql = "SELECT * FROM se_{$this->mod_name}_attend WHERE ".$ors;
		$this->std->db->do_query($sql);

		$pairsdb = array();
		while ($row = $this->std->db->fetch_row())
		{
			$pairsdb[$row['good_id1'].$row['good_id2']] = $row['count'];
		}

		# ���� ���� ���������� - ��������� ����������, ����� ��������� � ����.
		# ����������� ���������� ����� ��������� ��������� ������� ��� �����������
		# ����������� ����� ����� ��������.
		$values = array(); // ��� insert'�
		foreach ($pairs as $pair)
		{
			if (isset($pairsdb[$pair['g1'].$pair['g2']]))
			{
				$this->std->db->do_query("UPDATE se_{$this->mod_name}_attend SET `count` = `count` + 1 WHERE `good_id1` = '".$pair['g1']."' AND `good_id2` = '".$pair['g2']."'");
			} else {
				$values[] = "('".$pair['g1']."', '".$pair['g2']."', '1')";
			}
		}
		
		
		# ������� ��� ���������� ������ ��������
		if ($this->std->settings[$this->catalog_name.'_cache'] == '1')
		{
			# ����������� ��������, ������ ����� �������� ����� ���� ���������			
			if ($this->initCatalog())
			{				
				foreach ($cart['goods'] as $good)
				{
					$good['alias'] = $good['id'];
					$this->catalog->clearCacheByNode($good);
				}
			}
		}
		

		# ��������� � ����
		if (count($values) > 0)
		{
			$values = implode(", ", $values);
			$sql = "INSERT INTO se_{$this->mod_name}_attend (`good_id1`, `good_id2`, `count`) VALUES ".$values;
			
			$this->std->db->do_query($sql);
		}
	}
	
	
	
	
	

	/**
	 * ������� ����� ������
	 *
	 */
	function getOrder()
	{
		$res = '';
		
		

		if (isset($this->std->input['order']))
		{
			# ������������ ��� �������� ���������� �������, ������ ��������
			$this->calcCart();
			
			$pms = array();
			
			
			# ���� ������������ �����������, ����� ��������� ��� ������ � �����
			if ($this->issetUser())
			{
				$user = &$this->std->member['session_cache']['user'];
				
				$pms['name'] = $user['user_lname'].' '.$user['user_fname'];
				$pms['phone'] = $user['user_phone'];
				$pms['email'] = $user['user_email'];
				$pms['read_only'] = '';
			}
			
			# ����� ����� ������			
			$res = $this->strtr_mod($this->skin['order'], $pms) ;
			$res = $this->endRender($res);
		}
		else
		{
			$error = '';
			
			if ($this->std->input['name'] == '') $error .= $this->skin['error_name'];
			if ($this->std->input['phone'] == '') $error .= $this->skin['error_phone'];
			if ($this->std->email_validate($this->std->input['email']) == '') $error .= $this->skin['error_email'];
			
			if ($error == '')
			{
				if ($this->doOrder())
				{
					$res = $this->skin['success'];
				}
			}
			else
			{				
				$this->std->input['error'] = $error;
				$res = $this->strtr_mod($this->skin['order'], $this->std->input);
				$res = $this->endRender($res);
			}
		}
		

		return $res;
	}
	
	
	
/**
	 * �������� ������
	 *
	 */
	function doOrder()
	{
		# �������� �� ������ ���������� � ������
		$cart = $this->std->getValueSession($this->mod_name);

		
		
		#--------------------------------------------------------------
		# ������� � ������������� ���������
		$goods = $this->skin['mail_cart_begin'];
	
		# ��������� �������				
		$total = 0;
		foreach ($cart['goods'] as $id => $good)
		{
			$good['total'] = $good['count'] * $good['price'];
			$total += $good['total'];
			$good['total'] = number_format($good['total'], 2, ',', ' ');
			
			$good['alias'] = $good['id'];
			
				
			$goods .= $this->strtr_mod($this->skin['mail_cart_item'], $good);
		}

						
		$strtotal = number_format($total, 2, ',', ' ');
		$goods .= str_replace("{total}", $strtotal, $this->skin['mail_cart_end']);
		
		
		#--------------------------------------------------------------
		# ������ � ������������
		$user = array();
		$user['name'] = $this->std->input['name'];
		$user['phone'] = $this->std->input['phone'];
		$user['email'] = $this->std->input['email'];
		$user['comment'] = $this->std->input['comment'];
		
		
		
		#--------------------------------------------------------------
		# ���������� ������
		$hesh = md5(time());
		$order = array();
		$order['total'] = $total;
		$order['rectime'] = time();
		$order['goods'] = serialize($cart['goods']);
		$order['user'] = serialize($user);
		$order['hesh'] = $hesh;
		
		$order['user_id'] = -1;
		if ($this->issetUser())
		{
			 $order['user_id'] = $this->std->member['user_id'];
		}
		
		$this->db->do_insert($this->mod_name, $order);
		
		
		
		#--------------------------------------------------------------
		# ��������� ������������
		$message = str_replace('{goods}', $goods, $this->skin['mail_foruser']);
		$message = str_replace('{hesh}', $hesh, $message);
		$message = str_replace('{mod_name}', $this->mod_name, $message);
		$message = str_replace('{mail_footer}', $this->std->settings['site_mail_footer'], $message);
		$message = str_replace('{host}', $this->std->host, $message);
				
		
		
		# �������� ������
		$this->std->initMail();		
		$this->std->mail->to		= $this->std->input['email'];
		$this->std->mail->is_html	= 1;
		$this->std->mail->from		= ($this->std->settings[$this->mod_name.'_email'] != '') ? $this->std->settings[$this->mod_name.'_email'] : $this->std->settings['site_email'];
		$this->std->mail->fullname	= $this->std->settings['site_title'];
		$this->std->mail->subject	= str_replace('{host}', $this->std->host, $this->skin['subject_foruser']);
		$this->std->mail->message	= $message;
		$this->std->mail->send_mail();
		
		
		# ���������� ������������� ������
		if ($this->std->settings[$this->mod_name.'_attend'] > 0)
		{
			$this->updateAttend();
		}

		# ������� �������
		$cart['goods'] = array();
		$this->std->updateSession($this->std->member['session_id'], 'update', array($this->mod_name => $cart));

		return true;
	}

	
	
	
	/**
	 * ������� �� ������� ������������
	 *
	 */
	function delCart()
	{
		$good_id = $this->std->alias[2];
		
		$cart = $this->std->getValueSession($this->mod_name);
		
		if (isset($cart['goods'][$good_id]))
		{
			unset($cart['goods'][$good_id]);
			
			$this->std->updateSession($this->std->member['session_id'], 'update', array($this->mod_name => $cart));
		}
		

		return;
	}
	
	
	
	

	/**
	 * ������� ����� �������
	 *
	 * @return unknown
	 */
	function getFullCart()
	{
		$res = '';

		$cart = $this->std->getValueSession($this->mod_name);
		if ($this->initCatalog())
		{
			$this->catalog->initTreeWithoutSheet();
			
			if (!is_array($cart) || (count($cart['goods']) == 0))
			{
				$res = $this->skin['cart_empty'];
			} else {
					
				$res .= str_replace('{mod_name}', $this->mod_name, $this->skin['cart_begin']);
	
				# ��������� �������				
				$total = 0;
				foreach ($cart['goods'] as $id => $good)
				{
					$good['total'] = $good['count'] * $good['price'];
					$total += $good['total'];
					$good['total'] = number_format($good['total'], 2, ',', ' ');
					
					$good['alias'] = $good['alias'];					
					$good['alias'] = $this->catalog->getAliasByPid($good);

                                        // ���������� ��� ������� � ���� ����
                                        if (($good['price'] == 0) || ($good['price_show'] == 0))
                                        {
                                            $good['price'] = '����������';
                                            $good['total'] = '';
                                        }
                                        else
                                        {
                                            $good['total'] = $good['count'] * $good['price'];
                                        }
						
					$res .= $this->strtr_mod($this->skin['cart_item'], $good);
				}
	
								
				//$total = number_format($total, 2, ',', ' ');
				$res .= str_replace("{total}", $total, $this->skin['cart_end']);
			}
		}
		else
		{
			$this->log($this->skin['error_catalog']);
			$res = $this->skin['error_catalog'];
		}

		return $res;
	}

	

	/**
	 * ���������� ����� ������������� �������
	 *
	 * @param unknown_type $gid
	 */
	function getAttend($id)
	{
		$res = '';
		
		$limit = $this->std->settings[$this->mod_name.'_attend'];
		$this->catalog_name = $this->std->settings[$this->mod_name.'_modrecipient'];
		if ($limit > 0)
		{

			$sql = "SELECT * FROM se_{$this->mod_name}_attend at
					INNER JOIN se_{$this->catalog_name} c ON ((at.good_id1 = c.id) OR (at.good_id2 = c.id))
					WHERE (at.good_id1 = '".$id."' OR at.good_id2 = '".$id."') AND
							c.id <> '".$id."'
					GROUP BY c.id 
					ORDER BY at.count DESC, c.title				
					LIMIT ".$limit;	
			if ($this->std->db->query($sql, $rows) > 0)
			{	
				foreach ($rows as $row)
				{	
					$row['alias'] = $this->catalog->getAliasByPid($row);					
					$res .= $this->catalog->strtr_mod($this->skin['attend'], $row);
				}
				
	
			}
	
			
		}
		
		return $res;
	}

	/**
	 * ������ � ������� (������) �����
	 *
	 */
	function addCart()
	{
		$good_id = $this->std->input['good_id'];
		$count	 = $this->std->input['good_count'];

		if ($good_id != '' && $count > 0)
		{
			# ������ �� ������ ������ ������
			$cart = $this->std->getValueSession($this->mod_name);


			if (!is_array($cart)) $cart = array(); // ������� �����


			# ������ ���������� � ������
			$sql = "SELECT * FROM se_".$this->catalog_name." WHERE is_active=1 AND id='{$good_id}' LIMIT 1";
			
			if ($this->db->query($sql, $rows) > 0)
			{
				$row = $rows[0];
				if (isset($cart['goods'][$good_id]))
				{
					# ����� ����� ��� ���� � �������, ���������� ����������
					$cart['goods'][$good_id]['count'] += $count;
				} else {
					# ��������� � ������� ����� �����
					$cart['goods'][$good_id] = array(
	        							'id' => $row['id'],
	        							'pid' => $row['pid'],
										'alias' => $row['alias'],
		        						'title' => $row['title'],
		        						'price' => $row['price'],	
	        							'count' => $count,
                                                                        'price_show' => $row['price_show'],
					);
				}

				# ��������� ������� � ������
				$this->std->updateSession($this->std->member['session_id'], 'update', array($this->mod_name => $cart));
			}
		}
		
		
		header("Location: ".$_SERVER['HTTP_REFERER']);
		exit;
	}





	/**
	 * ��������������� ������ �������� ��� ������� � �������� ������
	 *
	 */
	function initCatalog()
	{
		include_once $this->std->config['path_modules']."/{$this->catalog_name}/{$this->catalog_name}_main.php";

		$class = 'main_'.$this->catalog_name;
		if (class_exists($class))
		{
			$module_run = new  $class($this->catalog_name, &$this->std);
			
			$this->catalog = &$module_run;
			return true;			
		}
		
		return false;
	}
	
	
	
	
	/**
	 * ������������� ������ ���� �������� �� ��������� ������� ������
	 *
	 */
	public function approveCart()
	{
		$res = '';
		
		if (isset($this->std->alias[2]))
		{
			$hesh = $this->std->alias[2];
			
			if (strlen($hesh) == 32)
			{
				$sql = "SELECT * FROM {$this->table} WHERE hesh = '{$hesh}'";
				if ($this->db->query($sql, $rows) > 0)
				{
					# ������� ������, ������ ����� ���-�� � ���� ������
					$row = $rows[0];
					
					if ($row['status'] == '0')
					{
						
						# �������� ����������� ��������� � ����� ������������� ������ �� �����
						$this->sendManagerMail($row);
						
						
						# ����������� �����
						$pms = array('status' => 1);
						$this->db->do_update($this->mod_name, $pms, 'id='.$row['id']);
						
						
						# ������� ������, �������������� � ������� ������, ������
						$month = time() - 60*60*24*30; // �����
						$sql = "DELETE FROM {$this->table} WHERE status=0 AND rectime < {$month}";
						$this->db->do_query($sql);
						
						# � ���� ������, ������������� �������, ������� ���������� ���� - ���, ��� �������� ������
						$month = time() - 60*60*24*30; // �����
						$sql = "UPDATE {$this->table} SET hesh='' WHERE status=1 AND rectime < {$month}";
						$this->db->do_query($sql);
						
						
						$res = $this->skin['approve'];
					}
					else
					{
						$res = $this->skin['is_approve'];
					}
				}
			}
		}
		
		if ($res == '')
		{
			$res = '�� ������� �� ���� �� ��������� ������.<br>���������� � ������������� ����� �� �������������.';
		}
		
		
		return $res;		
	}
	
	
	
	/**
	 * �������� ����������� ��������� � ����� ������������� ������ �� �����
	 *
	 */
	public function sendManagerMail(&$row)
	{
		#----------------------------------------------------------------
		# ��������� ������ ��� �������� ���������
		#----------------------------------------------------------------
		# ������� � ������������� ���������
		$strgoods = $this->skin['mail_cart_begin'];					
		
		$goods = unserialize( $row['goods'] );
		
		
		# ��������� �������										
		$total = 0;
		foreach ($goods as $id => $good)
		{
			$good['total'] = $good['count'] * $good['price'];
			$total += $good['total'];
			$good['total'] = number_format($good['total'], 2, ',', ' ');
			
			$good['alias'] = $good['id'];
			
				
			$strgoods .= $this->strtr_mod($this->skin['mail_cart_item'], $good);
		}										
		$strtotal = number_format($total, 2, ',', ' ');
		$strgoods .= str_replace("{total}", $strtotal, $this->skin['mail_cart_end']);

		
		# ���������� � ������������
		$user = unserialize( $row['user'] );
		$user['host'] = $this->std->host;
		
		
		
		$message = str_replace('{goods}', $strgoods, $this->skin['mail_formanager']);
		$message = str_replace('{mail_footer}', $this->std->settings['site_mail_footer'], $message);
		$message = $this->strtr_mod($message, $user);
		
		
		# ���������� ����������� ��������� � ������������ ������
		$this->std->initMail();		
		$this->std->mail->to		= ($this->std->settings[$this->mod_name.'_email'] != '') ? $this->std->settings[$this->mod_name.'_email'] : $this->std->settings['site_email'];
		$this->std->mail->is_html	= 1;
		$this->std->mail->from		= $this->std->settings['site_email'];
		$this->std->mail->fullname	= $this->std->settings['site_title'];
		$this->std->mail->subject	= str_replace('{host}', $this->std->host, $this->skin['subject_formanager']);
		$this->std->mail->message	= $message;
		$this->std->mail->send_mail();
	}
	
	
	
	
	
	/**
	 * ���������� ������� ������ ������������
	 *
	 */
	public function statisticCart()
	{
		$res = '';
		
		if ($this->issetUser())
		{
			$sql = "SELECT * FROM {$this->table} WHERE user_id='".$this->std->member['user_id']."' ORDER BY id DESC";
			if ($this->db->query($sql, $rows) > 0)
			{
				$res .= $this->skin['statistic_begin'];
				
				foreach($rows as $row)
				{
					$row['rectime'] = $this->std->getSystemTime($row['rectime']);
					$row['total'] = number_format($row['total'], 2, ',', ' ');
					$row['extend'] = ($row['status'] == '0') ? ' (<a href="/'.$this->mod_name.'/approve/'.$row['hesh'].'/">�����������?)' : '';
					$row['status'] = $this->skin['statistic_status'][$row['status']];
					
					$res .= $this->strtr_mod($this->skin['statistic_item'], $row);
				}
				
				$res .= $this->skin['statistic_end'];
			}
			else
			{
				$res = $this->skin['statistic_empty'];
			}
		}
		else
		{
			$res = $this->skin['no_statistic'];
		}
		
		return $res;
	}

}






?>