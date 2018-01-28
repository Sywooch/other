<?php


require_once 'class_tree_shop.php';

class main_shop extends class_tree_shop 
{
	

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
			
			
			$pms['lico'] = $this->std->input['order_lico'];
			if ($pms['lico'] == 'ur')
			{
				$temp = $this->skin['ur_order'];
			}
			else
			{
				$temp = $this->skin['fiz_order'];
			}
			
			# ����� ����� ������			
			$res = $this->strtr_mod($temp, $pms) ;
			$res = $this->endRender($res);
		}
		else
		{
			$error = '';
						
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
				if ($this->std->input['lico'] == 'ur')
				{
					$temp = $this->skin['ur_order'];
				}
				else
				{
					$temp = $this->skin['fiz_order'];
				}
				
				$this->std->input['error'] = $error;
				$res = $this->strtr_mod($temp, $this->std->input);
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
			
			$total += $good['total'];
			$good['total'] = number_format($good['total'], 2, ',', ' ');
			
			$good['alias'] = $good['id'];

                        // ���������� ��� ������� � ���� ����
                        if (($good['price'] == 0) || ($good['price_show'] == 0))
                        {
                            $good['price'] = '���������';
                            $good['total'] = '';
                        }
                        else
                        {
                            $good['total'] = $good['count'] * $good['price'];
                        }
			
				
			$goods .= $this->strtr_mod($this->skin['mail_cart_item'], $good);
		}

						
		$strtotal = number_format($total, 2, ',', ' ');
		$goods .= str_replace("{total}", $strtotal, $this->skin['mail_cart_end']);
		
		
		#--------------------------------------------------------------
		# ������ � ������������
		$user = array();
		if ($this->std->input['lico'] == 'ur')
		{
			$user['lico'] 		= $this->std->input['lico'];
			$user['lname'] 		= $this->std->input['lname'];
			$user['email'] 		= $this->std->input['email'];
			$user['phone'] 		= $this->std->input['phone'];
			$user['company'] 	= $this->std->input['company'];
//			$user['uradress'] 	= $this->std->input['uradress'];
//			$user['inn']		= $this->std->input['inn'];
//			$user['kpp'] 		= $this->std->input['kpp'];
//			$user['bank'] 		= $this->std->input['bank'];
//			$user['bik'] 		= $this->std->input['bik'];
//			$user['rschet'] 	= $this->std->input['rschet'];
//			$user['cschet'] 	= $this->std->input['cschet'];
			$user['delivery'] 	= $this->std->input['delivery'];
			$template_user 		= $this->skin['user_ur'];
		}
		else
		{
			$user['lico'] 		= $this->std->input['lico'];
			$user['lname'] 		= $this->std->input['lname'];
			//$user['fname'] 		= $this->std->input['fname'];
			$user['email'] 		= $this->std->input['email'];
			$user['phone'] 		= $this->std->input['phone'];
//			$user['pasport'] 	= $this->std->input['pasport'];
//			$user['adress'] 	= $this->std->input['adress'];
			$user['delivery'] 	= $this->std->input['delivery'];
			$template_user 		= $this->skin['user_fiz'];
		}
		$user_block = $this->strtr_mod($template_user, $user); 
		
		
		
		
		#--------------------------------------------------------------
		# ���������� ������
		$hesh = md5(time());
		$order = array();
		$order['total'] = $total;
		$order['rectime'] = time();
		$order['goods'] = serialize($cart['goods']);
		$order['user'] = serialize($user);
		$order['hesh'] = $hesh;
		$order['status'] = 1;
		
		$order['user_id'] = -1;
		if ($this->issetUser())
		{
			 $order['user_id'] = $this->std->member['user_id'];
		}
		
		$this->db->do_insert($this->mod_name, $order);
		$order_num = $this->db->get_insert_id();
		
		
		#--------------------------------------------------------------
		# ��������� ������������
		$message = str_replace('{goods}', $goods, $this->skin['mail_foruser']);
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
		$this->std->mail = null;
		#--------------------------------------------------------------
		
		
		#--------------------------------------------------------------
		# ��������� ���������
		$message = str_replace('{goods}', $goods, $this->skin['mail_formanager']);
		$message = str_replace('{user}', $user_block, $message);
		$message = str_replace('{mod_name}', $this->mod_name, $message);
		$message = str_replace('{mail_footer}', $this->std->settings['site_mail_footer'], $message);
		$message = str_replace('{host}', $this->std->host, $message);
				
		
		
		# �������� ������
		$this->std->initMail();		
		$this->std->mail->to		= ($this->std->settings[$this->mod_name.'_email'] != '') ? $this->std->settings[$this->mod_name.'_email'] : $this->std->settings['site_email'];
		$this->std->mail->is_html	= 1;
		$this->std->mail->from		= $this->std->settings['site_email'];
		$this->std->mail->fullname	= $this->std->settings['site_title'];
		$this->std->mail->subject	= str_replace('{host}', $this->std->host, $this->skin['subject_formanager']);
		$this->std->mail->subject	= str_replace('{order_num}', $order_num, $this->std->mail->subject);
		$this->std->mail->message	= $message;
		$this->std->mail->send_mail();
		#--------------------------------------------------------------
		
		
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
	
	
}


?>