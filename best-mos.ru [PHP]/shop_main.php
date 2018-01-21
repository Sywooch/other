<?php

#
# shop - пользовательская часть
#


class main_shop extends AbstractClass {

	var $catalog; // модуль каталог
	var $calculate;
    var $is_ogld;

	# Функция которая запустится по умолчанию первой(конструктор нам не подходит)
	function shopClass(        $sub_alias /*запрашиваемая страница разложенная в массив*/        )
	{


		$this->AbstractClass(
		$sub_alias,         // путь разложенный в массив
                                       'shop',        // название таблицы с которой будем работать
                                       'shop'           // название модуля (то как модуль называется в таблице modules)
		);

		global $body, $template;

		$this->setGlobalVars();
		
//print_R($this->current_url_array);exit;
        if ($this->current_url_array[0] == $this->module_name)
		{
			$template = 'shop';

			switch ($this->current_url_array[1])
			{				
				case 'put' : $this->output = $this->shopPut(); break;	// кладём товар в корзину
				case 'calc' : $this->shopCalc(); header("Location: /shop/cart/"); exit;
				case 'cart' : $this->output = $this->shopCart(); break;	// формирование корзины
				case 'order' : $this->output = $this->shopOrder(); break; // просто вывод формы заказа
				case 'del' : $this->shopDelete(); break;	// удаляем товар из корзины
				case 'orderdel' : $this->orderDelete(); break;	// удаляем заказ
				case 'orderdo' : $this->output = $this->shopOrderDo(); break;
				case 'confirm' : $this->output = $this->confirm(); break;	// подтверждение заказа
				case 'setuser' : $this->output = $this->setUserForm(); break;
					
				case 'rayon' : $this->output = $this->getRayon(); break;
				case 'gorod' : $this->output = $this->getGorod(); break;
				case 'myindex' : $this->output = $this->getMyIndex(); break;
					
				case 'ordersinfo' : $this->output = $this->getOrdersInfo2($this->std->member['user_id']); break; // инфо о заказах
				case 'ordersdemo' : $this->output = $this->getOrdersInfo2($this->std->member['user_id']); break; // инфо о заказах
				case 'cancelitem' : $this->output = $this->cancelItem();header("Location: /shop/ordersinfo/"); exit;
				case 'login'	:
				case 'comment':						$this->output = $this->getPageAfterCartAuth();
					break;
				
                case 'card_payment': $this->output = $this->startAcquiring(); break;
                case 'callback': $this->output = $this->startAcquiring(); break;
                case 'save_creds': $this->output = $this->saveCredentials(); break;
                case 'extauth': $this->output = $this->extauth(); break;
                case 'updatesumm': $this->output = $this->updateSumm(); break;
                case 'ordelete': $this->output = $this->orderDelAjax(); break;
                case 'setpasswd': $this->output = $this->changePassword($this->std->member['user_id']); break;
				default : header("location: /shop/cart/"); exit;
			}

			if ($this->current_url_array[2] == 'ajax')
			{
				// если обращение было через ajax, то сразу возвращаем результат в браузер
                if ($this->current_url_array[1] == 'card_payment') {
                    echo $this->startAcquiring();
                }
                else if ($this->current_url_array[1] == 'orderdelajax') {
                    echo $this->orderDelAjax();
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
	 * Добавление товара в корзину через форму быстрого добавления
	 *
	 * @return unknown
	 */
	function shopFastPut()
	{
		$res = '';
		 
		$good_code		= trim($this->std->input['good_code']);
		$good_count		= $this->std->StringToInt($this->std->input['good_count']);

		# получаем все сведения о товара, если такой вообще существует
		$sql = "SELECT * FROM se_catalog WHERE is_sheet = 1 AND id = '$good_code'";
		if ($this->std->db->query($sql, $rows) > 0)
		{
			if ($good_count > 0)
			{
				# читаем из сессии данные модуля
				$shop = $this->std->getValueSession('module_shop');
				 
				# читаем из сессии данные о товарах в корзине
				$cart = $shop['cart'];
				 
				if (!is_array($cart)) $cart = array(); // корзина пуста
				 
				if (isset($cart['goods'][$good_code]))
				{
					# такой товар уже есть в корзине, прибавляем количество
					$cart['goods'][$good_code]['count'] += $good_count;
				} else {
					# добавляем в корзину новый товар
					 
					$cart['goods'][$good_code] = array('count' => $good_count, "price" => $rows[0]['price'], "title" => $rows[0]['title'], "catalog_id" => $rows[0]['catalog_id']);
				}
				 

				# обновляем корзину в сессии
				$shop['cart'] = $cart;
				$this->std->updateSession($this->std->member['session_id'], 'update', array('module_shop' => $shop));
			}
			else
			{
				$res = 'Укажите количество';
			}
		}
		else
		{
			$res = 'Товар не найден';
		}

		global $shop_fastput_error;
		$shop_fastput_error = '<br><h3>'.$res.'</h3>';
	}


	function shopCalc()
	{
		# апдейтим сессию корзины (пользователь мог поменять количество товаров)
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
				# если количество 0, то удаляем товар из списка
				unset($shop['cart']['goods'][$gid]);
			}
		}



		# величина предоплаты, иногда  вводится пользователем
		if (is_array($this->std->input['predoplata_sum']))
		foreach ($this->std->input['predoplata_sum'] as $cid => $value)
		{
			 
			 
			# способ оплаты (ден.перевод/наложенный платёж)
			if (isset($this->std->input['type_pay_'.$cid]))
			{

				$shop['cart']["type_pay_".$cid] = $this->std->input['type_pay_'.$cid];

				if ($this->std->input['type_pay_'.$cid] == 'post_perevod')
				{
					$value = str_replace(",", ".", $value);
					$value = preg_replace( "/[^0-9\.]/"  , ""  , $value ); // очищаем значение от возможного мусора
					$value = $value == '' ? 0 : $value;
					$shop['cart']["predoplata_sum"][$cid] = round($value); // округляем в большую сторону, нам не нужны копейки :)
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
			// обращение было через ajax, нужно отдать вид формы
			echo $this->shopCart();
			exit;
		}
	}
	 

	/**
	 * Снимает экран с символов
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
					# анкета найдена, регистрация не нужна
					$message = $auth_shopreg_isset_user;
				}
				else
				{
					# анкета найдена, можно оформлять заказ
					$message = $auth_shopreg_do;
				}
				$data['user_email'] = $data['email'];
				$user = $data;
			}
			else
			{
				# пользователь есть в базе, но пароль не подошёл
				$message = $auth_shopauth_nopass;
				$data['user_email'] = $data['email'];
				$user = $data;
			}
		}
		else
		{
			# такого пользователя ещё нет, значит нужно создать
			 
			$pms = array(
        				'user_name' => $data['user_name'],
	        			'user_pass' => $data['user_pass'],
	        			'user_email' => $data['email'],
	        			'user_access' => '2', // пользователь
	        			'user_cache' => serialize($data),
	        			'user_is_active' => 1,
        				'user_rectime ' => time()
			);
			if ($data['user_parent']) $pms['user_parent'] = $data['user_parent'];
			$this->std->db->do_insert('users', $pms);
			$data['user_id'] = $this->std->db->get_insert_id();
			$data['user_email'] = $data['email'];
			// нужно уведомить о регистрации и заказе
			$user = $data;
		}

		return $ok;
	}

    //login:test1344517400
    //passw:dD8IWz
    // Начала сеанса оплаты - приглашение к авторизации платежа.
    function startAcquiring() 
    {
    	//print_r($this->std->input);
    	if ($this->current_url_array[3] == 'success' && isset($this->current_url_array[4]))
    	{   
    		$order_id=$this->current_url_array[4];
    		//получение подтверждения об оплате со стороны Юнителлера...
    		$login = "431";
    		$password = "Q9xe5bLS8Kp3TEN2nC47apCr5yxhppQsJGF8F0Jx9CzpEjv5gIyUWZICJDouvJpIAdAb4TV1YmqQ1Gom";
    		$shop_id="00000594";		
    		ini_set('soap.wsdl_cache_enabled', '0');
    		ini_set('soap.wsdl_cache_ttl', '0');
    		$client = new SoapClient("https://wpay.uniteller.ru/results/wsdl/",
    				array(
    						'trace' => 0,
    						'exceptions' => 1,
    				)
    		);    		
    		$result = $client->GetPaymentsResult(
    				$shop_id,
    				$login,
    				$password,
    				$order_id,
    				$success = 2,
    				$startmin = null,
    				$starthour = null,
    				$startday = null,
    				$startmonth = null,
    				$startyear = null,
    				$endmin = null,
    				$endhour = null,
    				$endday = null,
    				$endmonth = null,
    				$endyear = null,
    				$meantype = null,
    				$paymenttype = null,
    				$english = null
    		);
    		    		
    		$response = $result[0];
    		//Регистрируем результат авторизации
    		$sql="INSERT INTO se_uniteller(ZakazId,Amount,DatePay,Code) values ('$response->ordernumber',$response->total,NOW(),'$response->response_code')";
    		$this->std->db->do_query($sql);
    		//Возвращаем пользователя в магазин
    		if ($response->response_code=="AS000") {
    			$order_prepaid=$response->ordernumber;
    			$sql = "UPDATE se_orders SET status=1, order_approved=1, pay_time=NOW(), predoplata_fact=predoplata_sum WHERE order_id='$order_prepaid'";
    			$this->std->db->do_query($sql);
    			$html = "<p>Оплата заказа № $order_prepaid завершена успешно</p>";
    		}
    		else {
    			$html = "<p>Оплата заказа № $order_prepaid выполнена с ошибкой. Свяжитесь с представителем процессингового центра для выяснения причин.</p>";
    		}
            $html.= "<a href=\"/shop/ordersinfo/\">Вернуться в личный кабинет</a>";            
            echo $html;
    	}
    	else if ($this->current_url_array[3] == 'callback') {
    		$html = "<p>Оплата завершена успешно</p>";    		
            $html.= "<a href=\"/shop/ordersinfo/\">Вернуться в личный кабинет</a>";    		
    		print_r($this->std->input);
    		echo $html;
    	}
    	else
    	{
    		$html = "<p>В процессе оплаты возникла ошибка - платеж отклонен</p>";
            $html.= "<a href=\"/shop/ordersinfo/\">Вернуться в личный кабинет</a>";    		
    		echo $html;
    	}    	
    	exit;
    }


    //Сохранение данных, внесенных через форму сохранения карточки клиента
    function saveCredentials() {
    	$user_id = $this->std->member['user_id'];
    	$postind = $this->std->input['post_index'];
    	$oblast = $this->std->input['oblast'];
    	$raion = $this->std->input['raion'];
    	$town = $this->std->input['town'];
    	$phone = $this->std->input['phone'];
    	$house = $this->std->input['house'];
    	$c_name= $this->std->input['c_name'];    	
        $sql = "UPDATE se_users SET PostIndex='$postind', Oblast='$oblast', Rayon='$raion', Town='$town', ShippingAddress='$house', phone='$phone',ClientName='$c_name', address_changed=1 where user_id=$user_id";
		$this->std->db->do_query($sql);
		return "<p>Данные успешно сохранены</p><br /><a href=\"/shop/ordersinfo/\">Вернуться</a>";
    }

    function extauth() {
    	$html= '
		<div id="authWrapper" style="width: 100%; margin-top: 20px;">
			</form>
			<!--<form class="form-horizontal" name="extauth_form" method="POST" action="/shop/extauth/login/>
				<div class="control-group">
					<label class="control-label" for="login">логин</label>
					<div class="controls">
						<input class="input-medium" type="text" id="login" name="login">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="pass">пароль</label>
					<div class="controls">
						<input class="input-medium" type="password" id="pass" name="pass">
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<input type="submit" value="Войти" id="sbmt">
					</div>
				</div>
			</form>-->
			<form name="extauth_form" method="POST" action="/shop/extauth/login/">
				<div id="auth" style="margin: 0 auto; width: 300px;">
					<p>Пожалуйста, пройдите авторизацию</p>
					<span style="display:inline">логин:&nbsp</span><input class="form_field" type="text" id="login" name="login" style="width: 300px; display:block;margin-bottom: 15px;">
					<span style="display:inline">пароль:&nbsp</span><input class="form_field" type="password" id="pass" name="pass" value="" style="width: 300px; display: block;margin-bottom: 15px;">
					<input type="submit" value="Войти" id="sbmt">
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
	                		// отправляем в куку ID пользователя и пароль в MD5
			                $this->std->my_setcookie('member_id', $rows[0]['user_id']);
			                $this->std->my_setcookie('auth', 'ok');
			                // добавляем в текущую сессию ID пользователя
			                $this->std->db->do_update('session', array('session_member_id' => $rows[0]['user_id']), "session_id='{$this->std->session_id}'");
			                // обьединяем массивы сессий и массив пользователя
			                $this->std->member = array_merge($this->std->member, $rows[0]);
			                //return $this->getOrdersInfo($rows[0]['user_id']);
			                return '<script type="text/javascript">window.location.href="http://best-mos.ru/shop/ordersinfo/"</script>';
						}
					else {
						$out.= "<p>Ошибка: неверный логин или пароль. Попробуйте <a href=\"/shop/extauth/$in_login\">снова</a></p>";
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
	 * оформление заказа и при необходимости - регистрация пользователя
	 *
	 */
	/* function shopOrderDo()
	{

		if ($this->std->input['from_last_order_form'] == 'yes')
		{
			// сбор статистики: сколько пользователей зашли на старницу /shop/login/  и сколько там нажали на ЗАКАЗ
			error_log(strftime("%d.%m.%Y %H:%M:%S")." Пользователь с ID[".$this->std->member['user_id']."] вошёл в функцию заказа. Сюда пользователь перешёл из страницы регистрации/авторизации.\n", 3, LOG_PATH."/order.log");
		}
		else
		{
			error_log(strftime("%d.%m.%Y %H:%M:%S")." Пользователь с ID[".$this->std->member['user_id']."] вошёл в функцию заказа. Сюда пользователь перешёл из корзины, будучи авторизованным.\n", 3, LOG_PATH."/order.log");
		}

		$ok	= '';
		$res	= '';
		$dataform = array();

		 
		# в заказ можно попасть только из конзины, остальные обращения перебрасываются на корзину
		if ($this->std->input['request_method'] != 'post')
		{
			unset($this->current_url_array[2]);
			$this->current_url_array[1] = 'cart';
			return $this->shopCart();
		}

		# пользователь должен быть обязательно авторизован!!!
		if (!isset($this->std->member['user_id']))
		{
			header('Location: /');
		}

		if ($this->std->input['first_buy'] == 'no')
		{
			# пользователь авторизован, остаётся только оформить заказ и отправить ему письмо для подтверждения			
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

		# если при проверки данных пользователь найден или зарегистрирован, то формируем заказ и отправляем уведомительное пиьсмо
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
			# отправка письма
			require_once( INCLUDE_PATH."/lib/class_mailer.php");
			$mailer = new ClassMailer();
			$mailer->is_html = 1;
			 
			global $_shop_cart_formail, $_shop_mail_message, $zakaz_status;
			global $_shop_oplata_bank, $_shop_olpata_pochta, $_shop_oplata_html;
			$plat = array();
			$replace = array();
			$replace['{ORDER}'] = $this->shopCart($_shop_cart_formail); // тело письма с информацией о заказе;
			 
			 
			# цикл по каталогам
			$time = time();
			if (is_array($this->calculate->goods))
			foreach ($this->calculate->goods as $cid => $goods)
			{
				#----------------------------------------------
				# формирование заказа
				#----------------------------------------------
				$pms = array();
				$pms['order_time'] 		= $time;	// время заказа
				$pms['user_id'] 		= $user['user_id'];	// идентификатор пользователя
				$pms['predoplata_sum'] 	= $this->calculate->predoplata[$cid];	// сумма продекларированной предоплаты
				$pms['total'] 			= $this->calculate->total[$cid];	// сумма заказа
				$pms['comment'] 		= $dataform['comment'];	// комментарий
				$pms['author_id']		= $this->std->member['user_id'];
				$pms['status']			= 1;
				$this->std->db->do_insert('orders', $pms);
				$order_id 				= $this->std->db->get_insert_id();



				# если по каким-то причинам не получилось вставить запись, то выход
				if ($order_id == '')
				{
					return 'К сожаления заказ не прошёл, технические работы.<br>Попробуйте позже.';
				}


				if ($this->calculate->predoplata[$cid] != 0)
				{
					# если сумма предоплаты не равно 0, значит расчёт будет вестись и через банк и наложенным алатежом
					$plat[$cid]['pochta'] = $_shop_olpata_pochta;
					$plat[$cid]['bank'] = $_shop_oplata_bank;
				}

				# цикл по товарам в каталоге, формирование записей в таблице товарных позиций заказа
				foreach ($goods as $lot => $good)
				{						
					# запрос данных о лоте
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
						# если таких, то старый способ вставки
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
			# подготовка письма для отправки пользователю
			#----------------------------------------------
			 
			$replace['{i}'] = $user['i'];
			$replace['{f}'] = $user['f'];
			$replace['{o}'] = $user['o'];
			$replace['{adress}'] = $user['adress'].', '.$user['adress_deliver'];
			$replace['{user_email}'] = $user['user_email'];
			$replace['{user_pass}'] = $user['user_pass'];
			$replace['{index}'] = $user['index'];
			$replace['{ALIAS}'] = 'http://'.$this->std->host.'/shop/confirm/'.$order_id.'/';

			$mail_message = strtr($_shop_mail_message, $replace); // сообщение для отправки
			 
			 
			 
			 
			#----------------------------------------------
			# подготовка счетов для отправки пользователю
			#----------------------------------------------
			 
			require_once( INCLUDE_PATH."/lib/class_digitwords.php");
			$DigitsWords = new CDigitWords;
				
			$blanks = array();
			$company = array(
        							"{company}" => $this->std->settings['company'],
				        			"{kpp}" => $this->std->settings['company_kpp'],
				        			"{inn}" => $this->std->settings['сompany_inn'],
				        			"{okato}" => $this->std->settings['company_okato'],
				        			"{rschot}" => $this->std->settings['company_rschot'],
				        			"{bank}" => $this->std->settings['company_bank'],
				        			"{bik}" => $this->std->settings['company_bik'],
				        			"{kschot}" => $this->std->settings['company_kschot'],
				        			"{kbk}" => $this->std->settings['company_kbk'],
				        			"{company_adress}" => $this->std->settings['company_adress']
			);
				
			 
			# по каталогам
			foreach ($plat as $cid => $mail_template)
			{
				if (count($mail_template) > 0)
				{
					# если количество шаблонов больше 1, значит есть предоплата, значит нужно формировать платёжки
						
					$sql = "SELECT title FROM se_catalog WHERE id = '$cid'";
					if ($this->std->db->query($sql, $rows) > 0)
					{
						$catalog_title = $rows[0]['title'];
						# по типам платёжек
						foreach ($mail_template as $type_opata => $blank)
						{
							# если будет предоплата, то нужно составить две платёжки
								
							$blank = strtr($blank, $replace);
							$blank = strtr($blank, $company);
							$blank = str_replace('{host}', $this->std->host, $blank); // заголовок каталога
							$blank = str_replace('{catalog_title}', $catalog_title, $blank); // заголовок каталога

							$type_opata_title = '';
							$type_opata_title = ($type_opata == 'bank') ? 'банковский перевод' : 'почтовый перевод';

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
				
				
				
			 
			# обновляем списки заказываемых друг с другом товаров
			$this->updateAttend();
				
				
			 
			# очищаем корзину
			$shop['cart']['goods'] = array();
			$this->std->updateSession($this->std->member['session_id'], 'update', array('module_shop' => $shop));
			 
			 
			global $_shop_OrderDo_done;
			$message = $_shop_OrderDo_done;
		}

		// сбор статистики: сколько пользователей зашли на старницу /shop/login/  и сколько там нажали на ЗАКАЗ
		error_log(strftime("%d.%m.%Y %H:%M:%S")." Пользователь с ID[".$this->std->member['user_id']."] вышел из функции заказа.\n\n", 3, LOG_PATH."/order.log");

		return $message;
	} */
	 
    function shopOrderDo()
    {
    	if (isset($this->std->input['pay_method']))
    	{
    		$html_ret = '';
    		$link = '';
    		$link_order_id = -1;
    
    		$dataform = array();
    
    		# в заказ можно попасть только из корзины, остальные обращения перебрасываются на корзину
    		if ($this->std->input['request_method'] != 'post')
    		{
    			unset($this->current_url_array[2]);
    			$this->current_url_array[1] = 'cart';
    			return $this->shopCart();
    		}
    
    		# пользователь должен быть обязательно авторизован!!!
    		if (!isset($this->std->member['user_id']))
    		{
    		header('Location: /');
    		}
    
    		# пользователь авторизован, остаётся только оформить заказ и отправить ему письмо для подтверждения
    		if (is_array($this->std->member['user_cache']))
			{
    			$dataform = array_merge($dataform, $this->std->member);
    			$dataform = array_merge($dataform, $this->std->member['user_cache']);
				$user = $dataform;
    			}
    
    			$tmp = iconv('UTF-8', 'CP1251', $_POST['comment']);
    			$this->strips($tmp);
    			$tmp = str_replace('"', "'", $tmp);
    					$dataform['comment'] = $this->std->clean_value($tmp);
    
    					# если при проверки данных пользователь найден или зарегистрирован, то формируем заказ и отправляем уведомительное пиьсмо
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
    
    			// запись в бд, формирование письма
    			$link_order_id = $this->sendOrder($user, $dataform);
    			if ($link_order_id == -1)
    			{
    			err_log("Заказ не был отправлен в базу данных");
				return 'К сожалению, заказ не прошёл, технические работы.<br>Попробуйте позже.';
			}
		
    						switch ($this->std->input['pay_method'])
    						{
    								case 'bank':
    								$link="http://test.best-mos.ru/files/file/oplataBank-%20best-mos_ru.pdf";
					break;
    										case 'card':
    										//$link="http://test.best-mos.ru/shop/confirm/order=$link_order_id";
    											$link="http://best-mos.ru/shop/confirm/order=$link_order_id";
    										break;
    										case 'post':
    										$link="http://test.best-mos.ru/files/file/OplataPost1.pdf";
					break;
    						}
    						if ($this->std->input["pay_method"] == 'card')
    						{
    								return "<h3>Ваш заказ зарегистрирован успешно!</h3><p>Для оплаты заказа пожалуйста, перейдите по следующей <a href=\"$link\">ссылке</a></p>";
    						}
    						else
    						{
    						return "<h3>Ваш заказ совершен успешно!</h3><p>Для оплаты заказа воспользуйтесь квитанцией, доступной для загрузки по следующей <a href=\"$link\">ссылке</a></p>";
    						}
    						}
    
    						if ($this->std->input['from_last_order_form'] == 'yes')
    			{
			// сбор статистики: сколько пользователей зашли на старницу /shop/login/  и сколько там нажали на ЗАКАЗ
    			error_log(strftime("%d.%m.%Y %H:%M:%S")." Пользователь с ID[".$this->std->member['user_id']."] вошёл в функцию заказа. Сюда пользователь перешёл из страницы регистрации/авторизации.\n", 3, LOG_PATH."/order.log");
		}
    		else
    		{
    		error_log(strftime("%d.%m.%Y %H:%M:%S")." Пользователь с ID[".$this->std->member['user_id']."] вошёл в функцию заказа. Сюда пользователь перешёл из корзины, будучи авторизованным.\n", 3, LOG_PATH."/order.log");
		}
    
    		$ok	= '';
    		$res	= '';
    		$dataform = array();
    
    			
    		# в заказ можно попасть только из конзины, остальные обращения перебрасываются на корзину
    		if ($this->std->input['request_method'] != 'post')
    		{
    		unset($this->current_url_array[2]);
    		$this->current_url_array[1] = 'cart';
    		return $this->shopCart();
    		}
    
    		# пользователь должен быть обязательно авторизован!!!
    		if (!isset($this->std->member['user_id']))
    		{
    		header('Location: /');
		}
    
    		if ($this->std->input['first_buy'] == 'no')
    		{
    		# пользователь авторизован, остаётся только оформить заказ и отправить ему письмо для подтверждения
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
    
		# если при проверки данных пользователь найден или зарегистрирован, то формируем заказ и отправляем уведомительное пиьсмо
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
    			if ($this->sendOrder($user, $dataform) == -1)
    			{
    			return 'К сожалению, заказ не прошёл, технические работы.<br>Попробуйте позже.';
			}
		}
    
    		// сбор статистики: сколько пользователей зашли на старницу /shop/login/  и сколько там нажали на ЗАКАЗ
    		error_log(strftime("%d.%m.%Y %H:%M:%S")." Пользователь с ID[".$this->std->member['user_id']."] вышел из функции заказа.\n\n", 3, LOG_PATH."/order.log");
    
		global $_shop_OrderDo_done;
    		return $_shop_OrderDo_done;
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
	 * Выводит форму заказа
	 *
	 */
function  shopOrder()
	{
		global $_shop_order;
		//$ret = $_shop_order['begin'];
        $ret = $_shop_order['choose_payment_method'];
        $ret= str_replace('{delivery}', $this->input['shipping_type'], $ret);
        $shop = $this->std->getValueSession('module_shop');
        $prepay=$shop['cart']['predoplata_sum'];
        foreach ($prepay as $pp) {
            $ret = str_replace('{pay_summ}', $pp, $ret);
        }
		# в заказ можно попасть только корзина не пуста, остальные обращения перебрасываются на корзину
		$shop = $this->std->getValueSession('module_shop');
		if (isset($$shop['cart']['goods']) && (count($$shop['cart']['goods']) > 0))
		{
			unset($this->current_url_array[2]);
			$this->current_url_array[1] = 'cart';
			return $this->shopCart();
		}
		return $ret;
	}


	/**
	 * формирование списка регионов в виде <option>
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
	 * формирование списка регионов в виде <option>
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
					$ret .= '<option>- район не определён</option>';
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
	 * формирование списка почтовых отделений в виде <option>
	 *
	 */
	function getGorod()
	{
		$ret = '';
		$ret .= '<option></option>';
		 
		$rayon = iconv('UTF-8', 'CP1251', $this->std->input['rayon']);
		$region = iconv('UTF-8', 'CP1251', $this->std->input['region']);
		if ($rayon == '- район не определён')
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
				$row['rayon'] = iconv('CP1251', 'UTF-8', '- район не определён');
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
			$error = iconv('CP1251', 'UTF-8', 'Введённый индекс не найден среди почтовых индектов России');
			$ret = array('error' => $error);
		}
		 
		 
		$ret = json_encode($ret);
		return $ret;
	}



	/**
	 * Удаляет из корзины наименование
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
			# подготовка письма для отправки пользователю
			#----------------------------------------------
			 
			$replace['{i}'] = $user['i'];
			$replace['{f}'] = $user['f'];
			$replace['{o}'] = $user['o'];
			$replace['{adress}'] = $user['adress'].', '.$user['adress_deliver'];
			$replace['{user_email}'] = $user['user_email'];
			$replace['{index}'] = $user['index'];
			$replace['{order_date}'] = $this->std->get_time($order['order_time'], 'd.m.Y');

			$mail_message = strtr($_orderdel_mail_message, $replace); // сообщение для отправки

			$mailer->from = $this->std->settings['site_email'];
			$mailer->subject = $this->std->settings['site_title'];
			$mailer->to = $user['user_email'];
			$mailer->message = $mail_message;
			$mailer->send_mail();
			unset($mailer);


			$sql = "update se_orders_item set zakaz_status='".$zakaz_status[6]."' where id_order='".$order_id."'";
			$this->std->db->do_query($sql);
			$sql = "update se_orders set status=6,ZakSost=19, order_approved=-1 where order_id='".$order_id."'";
			$this->std->db->do_query($sql);
		}
		header("Location: ".$_SERVER['HTTP_REFERER']);
		exit;
	}
	 
	/**
	 * Выводит форму корзины
	 *
	 * @return unknown
	 */
	function shopCart($template = '')
	{
		if (isset($this->std->member['user_id']))
		{
			// сбор статистики: сколько пользователей зашли на старницу /shop/login/  и сколько там нажали на ЗАКАЗ
			error_log(strftime("%d.%m.%Y %H:%M:%S")." Пользователь с ID[".$this->std->member['user_id']."] вошёл в корзину.\n", 3, LOG_PATH."/order.log");
		}
		 
		$ret = '';
		$disabled = false;
		$predoplata_total = 0;

		global $_shop_cart, $_shop_cart_empty;
		if (is_array($template)) $_shop_cart = $template;

		$shop = $this->std->getValueSession('module_shop');
		 
		if (count($shop['cart']['goods']) == 0)
		{
			# корзина пуста
			$ret = $_shop_cart_empty;
		} else {
			 
			# достаём заголовки каталогов
			$catalogs = array();
			$sql = "SELECT id, title FROM se_catalog WHERE `pid` = -1";
			$this->std->db->do_query($sql);
			while ($row = $this->std->db->fetch_row())
			{
				$catalogs[$row['id']] = $row['title'];
			}
			 
			 
			 
			# достаем данные о товарах из базы
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
			# просчёт скидок по всем группам товаров
			# подключение библиотек и пересчёт всего, что касается цены
			#----------------------------------------------------------

			# подключаем библиотеку для расчёта скидки и стоимости
			require_once BASE_PATH.'calculate/calculate_main.php';
			$calculate = new class_calculate($shop['cart']);
			$calculate->std = &$this->std;
			$calculate->calculateBasket();
			$this->calculate = &$calculate;

			 


			#----------------------------------------------------------
			# заполняем корзину
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
                //$post_acquiring = $_shop_cart['post_acquiring'];


				if ($this->std->db->query($sql, $rows)>0) {

					$sum = $rows[0]['sum']-$rows[0]['predoplata']+$calculate->pre_total[$cid];
					$limit = $this->std->settings['shop_limit_'.$cid];

					
					$limit_owerflow = str_replace('{CAT_ID}', $cid, $limit_owerflow);
					if (isset($this->std->member['user_id']))
					{ // только для авторизованных
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
								$goods[$gid]['title'] .= '<br><font color="red">Ваш предыдущий заказ на этот товар еще не выполнен</font>';
							}
						}
						$search = array("{ID}", "{TITLE}", "{COST}", "{COUNT}", "{SUM}");
						$total += $good['count'] * $goods[$gid]['price'];
						$replace = array($gid, $goods[$gid]['title'], number_format($goods[$gid]['price'], 2, ',', ' '), $good['count'], number_format($good['count'] * $goods[$gid]['price'], 2, ',', ' '));
						 
						$ret .= str_replace($search, $replace, $_shop_cart['item']);
					}
					else
					{
						// удаление товара из корзины
						unset($shop['cart']['goods'][$gid]);
					}
				}

				 
				# если изменился состав корзины - обновляем сессию
				$this->std->updateSession($this->std->member['session_id'], 'update', array('module_shop' => $shop));
				 

				$ret .= $_shop_cart['end'];
				$ret = str_replace('{CATALOG_ID}', $cid, $ret);
				$ret = str_replace("{SKIDKA}", number_format($calculate->skidka[$cid], 2, ',', ' '), $ret);
				 
				 
				 
				 
				// величина предоплаты
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
				 
				# округляем в большую сторону
				$calculate->total[$cid] = ceil($calculate->total[$cid]);
				$ret = str_replace("{TOTAL}", number_format($calculate->total[$cid], 2, ',', ' '), $ret);
				$ret = str_replace("{PRE_TOTAL}", number_format($calculate->pre_total[$cid], 2, ',', ' '), $ret);
				 
				 
				# способ облаты - прячем показываем форму для ввода передоплаты
				//if (($shop['cart']["type_pay_".$cid] == 'post_after_reception') || !isset($shop['cart']["type_pay_".$cid]))
				if ($cid != 99)
				{
					if (($shop['cart']["type_pay_".$cid] == 'post_after_reception'))
					{
						# наложенным платежом (после получения)
						$ret = str_replace("{checked_post_after_reception}", "checked", $ret);
						$ret = str_replace("{checked_post_perevod}", "", $ret);
						$ret = str_replace("{TOTAL_TITLE}", "Итого:", $ret);
						$ret = str_replace("{DISLPAY}", "none", $ret);	// прячем упоминания о предоплатах
					}
					elseif ($shop['cart']["type_pay_".$cid] == 'post_perevod')
					{
						# предоплата через почту/банк
						$ret = str_replace("{checked_post_perevod}", "checked", $ret);
						$ret = str_replace("{checked_post_after_reception}", "", $ret);
						$ret = str_replace("{TOTAL_TITLE}", "Итого с учётом предоплаты:", $ret);
						$ret = str_replace("{DISLPAY}", "", $ret); // показываем поле для ввода величины предоплаты
					}
                    elseif ($shop['cart']["type_pay_".$cid] == 'post_acquiring')
					{
						# оплата через интернет-эквайринг
						$ret = str_replace("{checked_post_acquiring}", "checked", $ret);						
						$ret = str_replace("{TOTAL_TITLE}", "Итого к оплате:", $ret);
                        $ret = str_replace("{DISLPAY}", "none", $ret);	// прячем упоминания о предоплатах						
					}
					else
					{
						$disabled	= true;
						$ret = str_replace("{TOTAL_TITLE}", "Итого с учётом предоплаты:", $ret);
						$ret = str_replace("{DISLPAY}", "none", $ret);	// прячем упоминания о предоплатах
					}
				}
				else
				{
					$ret = str_replace("{TOTAL_TITLE}", "Итого:", $ret);
				}
				 
				$ret = str_replace("{INFO}", $this->std->settings['shop_info_'.$cid], $ret);
				$ret = str_replace("{SBOR}", $this->std->settings['shop_sbor_'.$cid], $ret);
				 
			}
			$ret .= $_shop_cart['after_end'];

			$shipping_html='<select name="shipping_type">';
			$this->std->db->do_query("Select id,shipping_name from se_shipping_type");
			$i=0;
			while ($row = $this->std->db->fetch_row())
			{
				if ($i==0) {
					$shipping_html.="<option value='".$row['id']."' selected='selected'>".$row['shipping_name']."</option>";	
					$i++;
				}
				else {
					$shipping_html.="<option value='".$row['id']."'>".$row['shipping_name']."</option>";	
				}				
			}
			$shipping_html.="</select>";
			# итоговые данные после подсчётов
			$ret= str_replace("{delivery_select}", $shipping_html, $ret);
			$ret = str_replace("{PRE_TOTAL}", number_format($this->sum($calculate->pre_total), 2, ',', ' '), $ret);
			$ret = str_replace("{SKIDKA}", number_format($this->sum($calculate->skidka), 2, ',', ' '), $ret);
			$ret = str_replace("{PRE_TOTAL-SKIDKA}", number_format($this->sum($calculate->pre_total)-$this->sum($calculate->skidka), 2, ',', ' '), $ret);
			$ret = str_replace("{TOTAL}", number_format($this->sum($calculate->total), 2, ',', ' '), $ret);
			$ret = str_replace("{PREDOPLATA}", number_format($predoplata_total, 2, ',', ' '), $ret);
			$ret = str_replace("{KOMPLEKT}", number_format($this->sum($calculate->komplekt), 2, ',', ' '), $ret);
		}
        

		if ($disabled&&(!$isFree))
		{
			# сообщение о необходимости авторизоваться, иначе нельзя заказать			 
			$ret = str_replace('{order_button}', '<font color="red">Не определёны способ оплаты или величина предоплаты</font><br><br>', $ret);
		}
		else
		{
			global $_shop_cart_needauth;
			if (!isset($this->std->member['user_id']))
			$ret = str_replace('{order_button}', $_shop_cart_needauth, $ret);
			else
			$ret = str_replace('{order_button}', '<input type="button" name="post" value="Оформить заказ" onClick="onOrder();" style="background: transparent; border: 1px solid #A7A6AA; font-size: 14px; color: #F8941D; height: 22px;">', $ret);
		}

		$this->output .= $ret;
		return $ret;
	}



	/**
	 * подсчёт общей скидки по группам товаров (кници, цветы и пр.)
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
	 * Назначает значения глобальным переменным модуля (интерфейсные переменные)
	 *
	 */
	function setGlobalVars()
	{
		# пользователь может воспользоваться формой быстрого добавления товара в корзину
		# проверяем это
		if (isset($this->std->input['shop_fast_put']))
		{
			$this->shopFastPut();
		}
		#----------------------------------------------------
		 
		 
		 
		global $shop_vars;
		global $_shop_cartlink_empty, $_shop_cartlink_full;

		$shop = $this->std->getValueSession('module_shop');

		# Ссылка на корзину
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
	 * Кладет в корзину (сессию) товар
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
			# читаем из сессии данные модуля
			$shop = $this->std->getValueSession('module_shop');

			# читаем из сессии данные о товарах в корзине
			$cart = $shop['cart'];

			if (!is_array($cart)) $cart = array(); // корзина пуста

			if (isset($cart['goods'][$good_id]))
			{
				# такой товар уже есть в корзине, прибавляем количество
				$cart['goods'][$good_id]['count'] += $count;
			} else {
				# добавляем в корзину новый товар

				$cart['goods'][$good_id] = array('count' => $count, "price" => $price, "title" => $title, "catalog_id" => $catalog_id);
			}

			 
			# обновляем корзину в сессии
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
	 * подтверждение заказа - приход пол ссылке в письме
	 *
	 */
	function confirm()
	{
		/* global $_shop_confirm_ok, $_shop_confirm_error1,$_shop_confirm_error2;
		 
		if (isset($this->current_url_array[2]))
		{
			$order_id = $this->std->clean_value($this->current_url_array[2]);
		}
		 
		if (!isset($this->current_url_array[2]) && ($order_id == ''))
		{
			header("Location: /");
			exit;
		}
		 
		# похоже что адрес правильный, теперь нужно изменить статус заказа и сообщить пользователю, что у нас всё хорошо        
        if (!empty($this->current_url_array[2]) && !empty($this->current_url_array[3]))  {                    
            $shop_id = '00000594';
            $passwd = "Q9xe5bLS8Kp3TEN2nC47apCr5yxhppQsJGF8F0Jx9CzpEjv5gIyUWZICJDouvJpIAdAb4TV1YmqQ1Gom";
            //$form_lifetime = 300;
            $form_lifetime = '';
            $customer = $this->std->member['user_name'];
            
            $customer_id = $this->std->member['user_id'];
            //$sql = "select ZakazId, SumObPay FROM se_orders where pay_time is null AND order_id=$order_id";
            //$this->std->db->query($sql, $rows);
            //Блокировка кнопок перехода к оплате.
            $this->std->db->do_query("UPDATE se_orders SET pay_time = NOW() WHERE order_id = $order_id");
             
             
            $amount = $this->current_url_array[2];       
            $order_no = $this->current_url_array[3];            
            $mean_type='0';
            $emoney_type='0';
            $card_idp = '';
            $idata = '';
            $pt_code=''; */
			
		global $_shop_confirm_ok, $_shop_confirm_error1,$_shop_confirm_error2;
		
		if (isset($this->current_url_array[2]))
		{
			$order = $this->std->clean_value($this->current_url_array[2]);
			if (strlen($order) > 6 && substr($order, 0, 6) == 'order=')
			//				$order_id = (int)(substr($order, 6));
				$order_id = substr($order, 6);
		}
			
		if (!isset($this->current_url_array[2]) || empty($order_id))
		{
			header("Location: /");
			exit;
		}
			
		# похоже что адрес правильный, теперь нужно изменить статус заказа и сообщить пользователю, что у нас всё хорошо
		$customer = $this->std->member['user_id'];
		if (!empty($customer))  {
			$shop_id = '00000594';
			$passwd = "Q9xe5bLS8Kp3TEN2nC47apCr5yxhppQsJGF8F0Jx9CzpEjv5gIyUWZICJDouvJpIAdAb4TV1YmqQ1Gom";
            $form_lifetime = 300;            
			$customer = $this->std->member['user_name'];		
			$customer_id = $this->std->member['user_id'];
		
			//$sql = "select ZakazId, SumObPay FROM se_orders where pay_time is null AND order_id=$order_id";
			//$this->std->db->query($sql, $rows);
			//Блокировка кнопок перехода к оплате.
			//$this->std->db->do_query("UPDATE se_orders SET pay_time = NOW() WHERE order_id = $order_id");
		
			/*
			$shop = $this->std->getValueSession('module_shop');
			$prepay=$shop['cart']['predoplata_sum'];
			foreach ($prepay as $pp) {
			//$ret = str_replace('{pay_summ}', $pp, $ret);
			$amount = $pp;
			}
			*/
		
			//$amount = $rows[0]['SumObPay'];
			//$order_no = $rows[0]['ZakazId']; 
			$order_no = $order_id;
			//$order_no = mt_rand();
			$sql = "SELECT predoplata_sum FROM se_orders WHERE order_id=".$order_id;
			$rows = null;
			if ($this->std->db->query($sql, $rows))
			{
			$amount = $rows[0]['predoplata_sum'];
		}
		
		$mean_type='0';
		$emoney_type='0';
		$card_idp = '';
		$idata = '';
		$pt_code='';
			
            $sign =  strtoupper(md5(md5($shop_id).'&'.md5($order_no).'&'.md5($amount).'&'.md5($mean_type).'&'.md5($emoney_type).'&'.md5($form_lifetime).'&'.md5($customer).'&'.md5($card_idp).'&'.md5($idata).'&'.md5($pt_code).'&'.md5($passwd)));
            $url_ok =  "http://best-mos.ru/shop/card_payment/ajax/success/".$order_no."/";            
            //$url_ok =  "http://test.best-mos.ru/shop/card_payment/ajax/success/";
            $url_err = "http://best-mos.ru/shop/card_payment/ajax/fail/";
            //$url_err = "http://test.best-mos.ru/shop/card_payment/ajax/fail/";
            //$url_comm = "http://best-mos.ru/shop/card_payment/ajax/callback/";
            //$url_comm = "http://test.best-mos.ru/shop/card_payment/ajax/callback/";
            
            $html=  '</form><form method="POST" action="https://wpay.uniteller.ru/pay/">';
            $html.= "<input type=\"hidden\" name=\"Shop_IDP\" value=\"$shop_id\"/>";
            $html.= "<input type=\"hidden\" name=\"Order_IDP\" value=\"$order_no\"/>";
            $html.= "<input type=\"hidden\" name=\"Subtotal_P\" value=\"$amount\"/>";
            $html.= "<input type=\"hidden\" name=\"Lifetime\" value=\"$form_lifetime\"/>";
            $html.= "<input type=\"hidden\" name=\"Customer_IDP\" value=\"$customer\"/>";
            $html.= "<input type=\"hidden\" name=\"Signature\" value=\"$sign\"/>";  
            //$html.= "<input type=\"hidden\" name=\"URL_RETURN\" value=\"$url_comm\" />";           
            $html.= "<input type=\"hidden\" name=\"URL_RETURN_OK\" value=\"$url_ok\" />"; 
            $html.= "<input type=\"hidden\" name=\"URL_RETURN_NO\" value=\"$url_err\"/>";
            $html.= "<input type=\"hidden\" name=\"MeanType\" value=\"$mean_type\">";
			$html.=	"<input type=\"hidden\" name=\"EMoneyType\" value=\"$emoney_type\">";
			//$html.=	"<input type=\"hidden\" name=\"Preauth\" value=\"1\">";
        
            $html.="<p>Сейчас Вы будете перенаправлены на сервис приема денежных средств Uniteller для осуществления платежа</p>";
            $html.= "<input type=\"submit\" value=\"Перейти к оплате\" />";             
            $html.="</form>"; 

            
			$html.="<img width=\"230\" height=\"51\" src=\"/templates/cards_logo.png \" /><br />";
            $warning = "
            <p style=\"font-size:10pt; text-align:justify\">
            <b>Оплата банковской картой в сети Интернет</b><br />
            Наш магазин подключен к интернет-эквайрингу и Вы можете оплатить свой заказ банковской картой Visa или Mastercard. 
            После подтверждения заказа Вы будете перенаправлены на защищенную платежную страницу процессингового центра Uniteller,
            где Вам необходимо ввести данные Вашей банковской карты. Для дополнительной аутентификации держателя карты используется протокол 3D Secure.
            Если Ваш Банк поддерживает данную технологию, Вы будете перенаправлены на его сервер для дополнительной идентификации. 
            Информацию о правилах и методах дополнительной идентификации уточняйте в Банке, выдавшем Вам банковскую карту.</p>

            <p style=\"font-size:10pt; text-align:justify\">
            <b>Гарантии безопасности</b><br />
            Сервис-провайдер Uniteller защищает и обрабатывает данные Вашей банковской карты по стандарту безопасности PCI DSS 2.0. 
            Передача информации в платежный шлюз Uniteller происходит с применением технологии шифрования SSL.
            Дальнейшая передача информации происходит по закрытым банковским сетям, имеющим наивысший уровень надежности. 
            Uniteller не передает данные Вашей карты нам (Best-mos.ru – ООО ЛОГОСКОР) и иным третьим лицам.
            Для дополнительной аутентификации держателя карты используется протокол 3D Secure.
            В случае, если у Вас есть вопросы по совершенному платежу, 
            Вы можете обратиться в службу поддержки клиентов support@uniteller.ru или по телефону (495) 987-19-60.</p>
			
            ";
            //Удаляем вершки и всю баломуть, в случае,если имеем дело с клиентами OrganoGold :)
//             $script = '<script type="text/javascript">
// 							$(document).ready(function () {
// 								$("#tabs").tabs();								
// 								$("#company_logo").attr("src","/i/logo_temp.png");
// 								$("#verski").remove();
// 								$(".number").empty().html("640 5771");
// 							});
// 						</script>';
//             $html.=$warning.$script;
            return $html.$warning;
        }
        elseif ($order_id != '')
		{
			$sql = "SELECT * FROM se_orders WHERE order_id='$order_id'";
			if ($this->std->db->query($sql, $rows) > 0)
			{
				if ($rows[0]['status'] == 0)
				{
					# подтверждение заказа
					$sql = "UPDATE se_orders SET status=1, order_approved=1 WHERE order_id='$order_id'";
					$this->std->db->do_query($sql);
					# подтверждение других заказов сделанных в это же время тем же пользователем
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
	 * Обновление сопутствующих товаров
	 *
	 */
	function updateAttend()
	{
		# Достаем товары в корзине
		$shop = $this->std->getValueSession('module_shop');

		$pairs = array(); // пары товаров
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

		# формируем запрос sql чтобы узнать, существуют такие пары или нет
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

		# если пара существует - обновляем количество, иначе добавляем в базу.
		# Обновляться количество будет столькими запросами сколько пар обновляется
		# добавляться будет одним запросом.
		$values = array(); // для insert'а
		foreach ($pairs as $pair)
		{
			if (isset($pairsdb[$pair['g1'].$pair['g2']]))
			{
				$this->std->db->do_query("UPDATE se_shop_attend SET `count` = `count` + 1 WHERE `good_id1` = '".$pair['g1']."' AND `good_id2` = '".$pair['g2']."'");
			} else {
				$values[] = "('".$pair['g1']."', '".$pair['g2']."', '1')";
			}
		}

		# добавляем в базу
		if (count($values) > 0)
		{
			$values = implode(", ", $values);
			$sql = "INSERT INTO se_shop_attend (`good_id1`, `good_id2`, `count`) VALUES ".$values;
			$this->std->db->do_query($sql);
		}
	}

	/**
	 * Возвращает текст сопутствующих товаров
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

    function updateSumm() {
        $order_id = $this->std->input['order'];
        $cost = $this->std->input['summ'];
        $shipping_id = $this->std->input['dost'];
        $sql = "UPDATE se_orders SET SumObPay=$cost, DostavkaID = $shipping_id  WHERE ZakazId='$order_id'";
        $this->std->db->do_query($sql);
        return 1;
    }    

    function orderDelAjax(){
    	$o = $this->std->input['order'];
    	$sql = "DELETE FROM se_orders WHERE order_id=$o";
        #$this->std->db->do_query($sql);
        return $sql;
    }

    function changePassword($user_id) {
    	if (empty($user_id)) {
    		return -2;
    	}    	
    	else {
	    	$oldpass = $this->std->input['oldpass'];
	    	$newpass = $this->std->input['newpass'];
	    	$login = $this->std->input['login'];
	    	$passq = "SELECT user_pass from se_users where user_id='$user_id'";
	    	if ($this->std->db->query($passq, $users) > 0) {
	    		$check = $users[0];
	    		if ($check['user_pass'] == $oldpass) {
	    			if (!empty($login))	
	    				$this->std->db->do_query("UPDATE se_users SET user_name='$login',user_pass='$newpass', address_changed=1 WHERE user_id=$user_id");	
	    			else 
	    				$this->std->db->do_query("UPDATE se_users SET user_pass='$newpass', address_changed=1 WHERE user_id=$user_id");	
	    			return 0;
	    		}
	    		else {
	    			return -1;
	    		}
	    	}
	    	else {
	    		return -1;
	    	}
    	}
    }


    function getOrdersInfo2($user_id) {
    	function format_by_count($count, $form1, $form2, $form3) {
    		$count = abs($count) % 100;
    		$lcount = $count % 10;
    		if ($count >= 11 && $count <= 19) return($form3);
    		if ($lcount >= 2 && $lcount <= 4) return($form2);
    		if ($lcount == 1) return($form1);
    		return $form3;
    	}
    	
    	# в список заказов может попасть только авторизованный пользователь
    	if (!isset($this->std->member['user_id']))
    	{
    		header('Location: /');
    		exit;
    	}
    	global $_shop_ordersinfo, $zakaz_status;
    	$sql = "SELECT * FROM se_orders WHERE user_id  = ".$user_id." ORDER BY order_time DESC";
    	if ($this->std->db->query($sql, $orders) > 0)
    	{
    		$ret = $_shop_ordersinfo['best'];
    		
    		$c=1;
    		$ordrs='';
    		foreach ($orders as $order)
    		{
    			$body = $_shop_ordersinfo['body_best']; //fetch body template;
    			$body = str_replace('{order_id}', $order['order_id'], $body);
    			
    			$body = str_replace('{dost_cost}','', $body);
    			$body = str_replace('{order_no}',$order['order_id'],$body);
    			if ($order['order_approved']==1) {
    				$body = str_replace('{item_status}','оплачен', $body);
    			}
    			else if ($order['order_approved']==0) {
    				$body = str_replace('{item_status}','новый',$body);
    			}
    			
    			//$body = str_replace('{n_zakaz}', order_id,$body);
    			
    			$body = str_replace('{total_discount}', $order['total'], $body);
    			$body = str_replace('{prepay_charged}', $order['predoplata_fact'], $body);
    			$body = str_replace('{prepay_announced}', $order['predoplata_sum'], $body);
    			$body = str_replace('{total}', $order['total'], $body);
    			$body = str_replace('{order_time}', $this->std->get_time($order['order_time'], 'd.m.Y'), $body);
    			
    			$body = str_replace('{count}',$c, $body);
    			$body = str_replace('{order_db_id}', $order['order_id'], $body);
    			
    			if ($order['predoplata_sum']==0 || $order['order_time'] < strtotime('2013-05-08')) {
    				$body = str_replace('{pay_btn}', '', $body);
    			}
    			else if ($order['predoplata_fact'] < $order['predoplata_sum']) {
    				//$ret = str_replace('{pay_link}', '(<a href="http://best-mos.ru/shop/confirm/{predoplata}/{order_id}">Оплатить заказ</a>)', $ret);
    				$body = str_replace('{pay_btn}', '<button type="button" id ="pay_button" onclick="window.location.href=\'http://best-mos.ru/shop/confirm/order='.$order['order_id'].'/\'" class="btn btn-success">Оплатить заказ</button><h5>Оплата производится через платежную систему Uniteller пластиковыми картами Visa и MasterCard</h5>', $body);
    			}
    			else {
    				$body = str_replace('{pay_btn}', '<p class="text-info" style="font-weight:bold">По данному заказу внесена предоплата</p>', $body);
    			}
    			
    			$c++;
    			$skidka = 0;
    			$komplekt = 0;
    			$total = 0;
    			$table = '';    			
    			$sql = "SELECT * FROM se_orders_item WHERE  id_order  = '".$order['order_id']."' ORDER BY lot_id";
    			if ($this->std->db->query($sql, $items) > 0)
    			{
    				foreach ($items as $item)
    				{
    					$pms['{item_id}'] = $item['id'];
    					$pms['{lot_id}'] = $item['lot_id'];
    					$pms['{title}'] = $item['title'];    					
    					$pms['{zakaz_status}'] = $item['zakaz_status'];    					
    					$table .= $_shop_ordersinfo['good_new_best'];    					
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
    			$body = str_replace('{items}', $table, $body);
    			$body = str_replace('{discount}', $skidka, $body);
    			$body = str_replace('{packing}', $komplekt, $body);
    			$body = str_replace('{total}', $total, $body);
    			$ords.= $body;
    		}
    		$ret = str_replace("{orders_body}", $ords, $ret);
    	}
    	//читаем данные пользователя....
    	$sql = "SELECT * FROM se_users WHERE  user_id = $user_id";
    	if ($this->std->db->query($sql, $items) > 0)
    	{
    		$data = unserialize($items[0]['user_cache']);
    		/* echo '<pre>';
    		print_r($data);
    		echo '</pre>'; */
    		$ret = str_replace("{email}", $data['email'], $ret);
    		$ret = str_replace("{phone}", $data['phone'], $ret);
    		$ret = str_replace("{index}", $data['index'], $ret);
    		//читаем индекс места назначения
    		if ($this->std->db->query("SELECT * FROM se_post WHERE PostInd=".$data['index'],$post)>0) {
    			$ret = str_replace("{oblast}", $post[0]['Oblast'], $ret);
    			$ret = str_replace("{raion}", $post[0]['Rayon'], $ret);
    			$ret = str_replace("{town}", $post[0]['Gorod'], $ret);
    		}    		
    		else {
    			$ret = str_replace("{oblast}", "", $ret);
    			$ret = str_replace("{raion}", "", $ret);
    			$ret = str_replace("{town}", "", $ret);
    		}    		    		
    		$ret = str_replace("{shipping}", $data['adress_deliver'], $ret);
    		
    		$ret = str_replace("{client}", $data['f']. " " . $data['i'] . " " . $data['o'], $ret);
    		$ret = str_replace("{current_login}", $items[0]['user_name'], $ret);
    	}
    	return $ret;    	
    }
    
    
	function getOrdersInfo($user_id)
	{

		function format_by_count($count, $form1, $form2, $form3) {
		    $count = abs($count) % 100;
		    $lcount = $count % 10;
		    if ($count >= 11 && $count <= 19) return($form3);
		    if ($lcount >= 2 && $lcount <= 4) return($form2);
		    if ($lcount == 1) return($form1);
		    return $form3;
		}

		# в список заказов может попасть только авторизованный пользователь
		if (!isset($this->std->member['user_id']))
		{
			header('Location: /');
			exit;
		}
		 
		global $_shop_ordersinfo, $zakaz_status;
		//$ret = $_shop_ordersinfo['begin'];
		 
		$sql = "SELECT * FROM se_orders left join se_orders_status on ZakSost = se_orders_status.zs_id WHERE user_id  = ".$user_id." ORDER BY order_time DESC";

        if ($this->std->db->query($sql, $orders) > 0)
		{
			//Если имеем дело с заказом OrganoGold, то строим таблицу по-новому, иначе строим по-старому
			if (empty($orders[0]['ZakazId'] )) {
				$ret = $_shop_ordersinfo['old_begin'];
                $this->is_ogld = false;
			}
			else {
				$ret = $_shop_ordersinfo['begin'];
                $this->is_ogld = true;
				$ret_script='<script type="text/javascript">$("#div_ord_info").remove(); $(".div_ord_info2").remove();';
			    $ret_script.='$("#company_logo").attr("src","/i/logo_temp.png");';
			    $ret_script.='$("#verski").remove();';
			    $ret_script.='$(".number").empty().html("640 5771");';
			    $ret_script.='</script>';			    
			}
			$c=1;			
			$ordrs='';
			foreach ($orders as $order)			
			{				
                if (!empty($order['ZakazId'])) {         	                	
                	$body = $_shop_ordersinfo['body']; //fetch body template;
                    $body = str_replace('{order_id}', substr($order['ZakazId'],4), $body);
                    $body = str_replace('{script}', $ret_script, $body);
 				   //$body = str_replace('{dost_cost}', $order['SumObPay'], $body); 
                    $body = str_replace('{dost_cost}','', $body); 
                    $body = str_replace('{order_no}',$order['ZakazId'],$body);   
                    $body = str_replace('{n_zakaz}', substr($order['ZakazId'],4),$body);   
                    // получить список возможных способов доставки для данного товара
                    $order_id = $order['ZakazId'];
                    $data = "SELECT ZakazId,DostDays,DostSum,shipping_name,Active,se_shipping_type.id as id FROM se_shipping INNER JOIN se_shipping_type ON se_shipping.DostId = se_shipping_type.id where ZakazId='$order_id' order by DostId";
                    $shipping_html = '';                     
                    if ($order['zs_is_pay'] == 1) {
                    	$body = str_replace('{delivery_controls}',$_shop_ordersinfo['not_paid'],$body); 	
                    	$body = str_replace('{delivery_controls}',$_shop_ordersinfo['not_paid'],$body); 
	                    if ($this->std->db->query($data, $shipping) > 0) {  
	                    	$write_comment=false;   
	                    	$onclick="
								var cost = $(this).attr('value');			
								var idDost = $(this).attr('dtype');								
								if (cost < 1) {
									alert('Оплата нулевой суммы невозможна!');
								}
								else {
									$('#dost_cost$c').empty().html(cost + ' руб.').attr('value',cost);
									$.post('/shop/updatesumm/ajax/',{order:'".$order['ZakazId']."', summ:cost, dost:idDost});
								}
	                    	";
	                        foreach($shipping as $shipping_entry) {  
	                        		switch ($shipping_entry['shipping_name']) 
	                        		{                        			
	                        		   	case 'Почта России': $img='<img class="dost_logo" src="/templates/images/russian_post.gif" />'; break;
	                        		   	case 'Почта России СНГ': $img='<img class="dost_logo" src="/templates/images/russian_post.gif" />'; break;
	                        		   	case 'EMS Russian Post': $img='<img class="dost_logo" src="/templates/images/ems_post.gif" />'; break;
	                        		   	case 'EMS Russian Post SNG': $img='<img class="dost_logo" src="/templates/images/ems_post.gif" />'; break;
	                        			case 'Boxberry': $img='<img class="dost_logo" src="/templates/images/boxberry.gif" />'; break;
	                        			deault: $img='';                        			
	                        		}            
	                        		$disabled = $shipping_entry['Active'] == 1 ? '' : 'disabled';
	                        		$shipping_html.='<tr>';
	                        		$shipping_html.='<td>'.$img.'&nbsp'.$shipping_entry['shipping_name'].'</td>';                      
	                        		$shipping_html.='<td>'.$shipping_entry['DostDays'].'</td>';                        		
									$shipping_html.='<td>'.$shipping_entry['DostSum'] .' ' . format_by_count($shipping_entry['DostSum'],'рубль','рубля','рублей').'</td>';								
									$shipping_html.='<td style="text-align: center"><input '.$disabled.' tag="i-'.$c.'" type="radio" onClick="'.$onclick.'" name="shippings" id="shippings" dtype="' . $shipping_entry['id'] .'" value="'.$shipping_entry['DostSum'].'"></td>';
									if (!$write_comment) {
										$shipping_html.='<td rowspan=3>'.$order['comment'] .'</td>';
										$write_comment = true;
									}
									$shipping_html.='</tr>';
	                        }	                        
	                        $body = str_replace('{delivery_options}',$shipping_html,$body); 
	                    }
                    }
                    else {
                    	$body = str_replace('{delivery_controls}',$_shop_ordersinfo['payment_custom_notify'],$body); 	
                    	$body = str_replace('{custom_message}', $order['zs_comment'] ,$body);
                    }
                    $body = str_replace('{delivery_options}',$shipping_html,$body);                         
					$body = str_replace('{count}',$c, $body);
					$body = str_replace('{order_db_id}', $order['order_id'], $body);
					$c++;					
                }
                else {
                	$ret .= $_shop_ordersinfo['old_item'];
                	//временная блокировка от посторонних глаз
                	//$ret = str_replace('{pay_link}', '', $ret);
                	if ($order['predoplata_sum']==0 || $order['order_time'] < strtotime('2012-11-09')) {
                		$ret = str_replace('{pay_link}', '', $ret);
                	}
                	else if ($order['predoplata_fact'] < $order['predoplata_sum']) {
                		//$ret = str_replace('{pay_link}', '(<a href="http://best-mos.ru/shop/confirm/{predoplata}/{order_id}">Оплатить заказ</a>)', $ret);
                		$ret = str_replace('{pay_link}', '(<a href="http://best-mos.ru/shop/confirm/order={order_id}">Оплатить заказ</a>)', $ret);
                	}
                	else {
                		$ret = str_replace('{pay_link}', '(предоплата поступила)', $ret);
                	}                	
                    $ret = str_replace('{order_id}', $order['order_id'], $ret);
                }
				
                //if (!empty($order['SumZak'])) {
                if ($this->is_ogld) {
                    $body = str_replace('{total}', $order['SumZak'], $body);
                    $body = str_replace('{order_time}', $this->std->get_time($order['order_time'], 'd.m.Y'), $body);
                }
                else {
				    $ret = str_replace('{total}', $order['total'], $ret);
				    $ret = str_replace('{order_time}', $this->std->get_time($order['order_time'], 'd.m.Y'), $ret);				    
				}				
				$ret = str_replace('{predoplata_fact}', $order['predoplata_fact'], $ret);
				$ret = str_replace('{predoplata}', $order['predoplata_sum'], $ret);				
                if (!empty($order['KodRec'])) {
                	$z_sost_string='';
                	switch ($order['zs_id']) {
                		case 0: $z_sost_string = $order['zs_comment'];
                			break;
                		case 150: $z_sost_string = $order['zs_comment'];
                			break;
                		case 19: $z_sost_string = $order['zs_comment'];
                			break;             		                		
                	}
                	$body = str_replace('{item_status}', $z_sost_string, $body);                    
                }
                else
				    $ret = str_replace('{item_status}', $zakaz_status[$order['status']], $ret);
				if (empty($order['ZakazId']))	{			
					if (!$order['status'])				                        
							$ret = str_replace('{zakaz_action}', '<a href="/shop/confirm/'.$order['order_id'].'/"><input class="btn" type="button" value="Оплатить доставку" /></a>&nbsp;<a href="/shop/orderdel/'.$order['order_id'].'/" onclick="if (confirm(\'Вы уверены в удалении заказа?\')) return true; else return false;"><input class="btn" type="button" value="Отказаться от доставки" /></a>', $ret);									
					else 
						$ret = str_replace('{zakaz_action}', '', $ret);
				 }
				 else {
					if ($order['order_approved'] == 0)
						$ret = str_replace('{zakaz_action}', '<a href="/shop/confirm/'.$order['order_id'].'/"><input class="btn" type="button" value="Оплатить доставку" /></a>&nbsp;<a href="/shop/orderdel/'.$order['order_id'].'/" onclick="if (confirm(\'Вы уверены в удалении заказа?\')) return true; else return false;"><input type="button" class="btn" value="Отказаться от доставки" /></a>', $ret);									
					else 
						$ret = str_replace('{zakaz_action}', '', $ret);
				 }
				$skidka = 0;
				$komplekt = 0;
				$total = 0;
				$table = '';
				$sql = "SELECT * FROM se_orders_item WHERE  id_order  = '".$order['order_id']."' ORDER BY lot_id";
				if ($this->std->db->query($sql, $items) > 0)
				{
					foreach ($items as $item)
					{						 
						$pms['{item_id}'] = $item['id'];     
                        $pms['{lot_id}'] = $item['lot_id'];
                        if (!empty($item['LotName'])) { 
                            $pms['{title}'] = $item['LotName'];
                            if ($order['order_approved']==1) {
                            	$pms['{zakaz_status}'] = 'оплачен';	
                            } 
                            else if ($order['order_approved']==0) {
                            	$pms['{zakaz_status}'] = 'готов к оплате';	
                            }
                            else {
                            	$pms['{zakaz_status}'] = 'отказ';		
                            }                            
                            $table .= $_shop_ordersinfo['good_new_ogld'];
                        }
						else {
                            $pms['{title}'] = $item['title'];
                            $pms['{zakaz_status}'] = $item['zakaz_status'];
                            if ($item['zakaz_status'] == 'новый')
							{
								$table .= $_shop_ordersinfo['good_new'];
							}
							else
							{
								$table .= $_shop_ordersinfo['good'];
							}
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
                    if (!$this->is_ogld) {
                        $ret = str_replace('{items}',$table, $ret);
                    }
				}//items

				//читаем данные пользователя....
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
					$ret = str_replace("{client}", $items[0]['ClientName'], $ret);										
					$ret = str_replace("{current_login}", $items[0]['user_name'], $ret);		
				}
				 
				if ($order['status']>0) {
					$ret = str_replace('{total_part}', $_shop_ordersinfo['total_part'], $ret);
					$ret = str_replace('{skidka}', $skidka, $ret);
					$ret = str_replace('{komplekt}', $komplekt, $ret);
					$ret = str_replace('{z_sum}', ceil($total), $ret);
				} else {
					$ret = str_replace('{total_part}', "", $ret);
				}
				if (!empty($order['KodRec'])) {
					$body = str_replace('{items}', $table, $body);
                    $ords.= $body;
				}
			}//orders
            if ($this->is_ogld) {
			    $ret = str_replace("{orders_body}", $ords, $ret);
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
	 * Функция предлагает пользователю выбор: оформить заказ или вернуться в корзину
	 * страница появляется после регистрации/авторизации, на которую пользователь попадает из корзины
	 *
	 */
	function getPageAfterCartAuth()
	{
		$shop = $this->std->getValueSession('module_shop');
		 
		if (count($shop['cart']['goods']) == 0)
		{
			# корзина пуста
			header('Location: /');
			exit;
		}
		 
		 
		global $shop_after_form, $_shop_form_after_auth;
		$shop_after_form = $_shop_form_after_auth;
		return $shop_after_form;
	}
	
	function sendOrder($user, $dataform)
	{
	# отправка письма
	require_once( INCLUDE_PATH."/lib/class_mailer.php");
	$mailer = new ClassMailer();
	$mailer->is_html = 1;
		
	global $_shop_cart_formail, $_shop_mail_message, $zakaz_status;
	global $_shop_oplata_bank, $_shop_olpata_pochta, $_shop_oplata_html;
	$plat = array();
	$replace = array();
	$replace['{ORDER}'] = $this->shopCart($_shop_cart_formail); // тело письма с информацией о заказе;
		
		
	# цикл по каталогам
	$time = time();
	if (is_array($this->calculate->goods))
	foreach ($this->calculate->goods as $cid => $goods)
	{
	#----------------------------------------------
		# формирование заказа
		#----------------------------------------------
		$pms = array();
		$pms['order_time'] 		= $time;	// время заказа
		$pms['user_id'] 		= $user['user_id'];	// идентификатор пользователя
		$pms['predoplata_sum'] 	= $this->calculate->predoplata[$cid];	// сумма продекларированной предоплаты
		$pms['total'] 			= $this->calculate->total[$cid];	// сумма заказа
		$pms['comment'] 		= $dataform['comment'];	// комментарий
			$pms['author_id']		= $this->std->member['user_id'];
				$pms['status']			= 1;
				$this->std->db->do_insert('orders', $pms);
				$order_id 				= $this->std->db->get_insert_id();
	
	
	
				# если по каким-то причинам не получилось вставить запись, то выход
				if ($order_id == '')
				{
				return -1;
	}
	
	
				if ($this->calculate->predoplata[$cid] != 0)
				{
				# если сумма предоплаты не равно 0, значит расчёт будет вестись и через банк и наложенным алатежом
					$plat[$cid]['pochta'] = $_shop_olpata_pochta;
					$plat[$cid]['bank'] = $_shop_oplata_bank;
				}
	
				# цикл по товарам в каталоге, формирование записей в таблице товарных позиций заказа
				foreach ($goods as $lot => $good)
				{
					# запрос данных о лоте
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
					# если таких, то старый способ вставки
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
			# подготовка письма для отправки пользователю
			#----------------------------------------------
				
			$replace['{i}'] = $user['i'];
			$replace['{f}'] = $user['f'];
			$replace['{o}'] = $user['o'];
			$replace['{adress}'] = $user['adress'].', '.$user['adress_deliver'];
					$replace['{user_email}'] = $user['user_email'];
							$replace['{user_pass}'] = $user['user_pass'];
							$replace['{index}'] = $user['index'];
							$replace['{ALIAS}'] = 'http://'.$this->std->host.'/shop/confirm/'.$order_id.'/';
	
							$mail_message = strtr($_shop_mail_message, $replace); // сообщение для отправки
				
				
				
				
			#----------------------------------------------
			# подготовка счетов для отправки пользователю
			#----------------------------------------------
				
			require_once( INCLUDE_PATH."/lib/class_digitwords.php");
		$DigitsWords = new CDigitWords;
				
			$blanks = array();
			$company = array(
					"{company}" => $this->std->settings['company'],
					"{kpp}" => $this->std->settings['company_kpp'],
					"{inn}" => $this->std->settings['сompany_inn'],
					"{okato}" => $this->std->settings['company_okato'],
					"{rschot}" => $this->std->settings['company_rschot'],
					"{bank}" => $this->std->settings['company_bank'],
					"{bik}" => $this->std->settings['company_bik'],
					"{kschot}" => $this->std->settings['company_kschot'],
					"{kbk}" => $this->std->settings['company_kbk'],
					"{company_adress}" => $this->std->settings['company_adress']
		);
						
						
					# по каталогам
		foreach ($plat as $cid => $mail_template)
			{
			if (count($mail_template) > 0)
			{
			# если количество шаблонов больше 1, значит есть предоплата, значит нужно формировать платёжки
					
				$sql = "SELECT title FROM se_catalog WHERE id = '$cid'";
				if ($this->std->db->query($sql, $rows) > 0)
				{
				$catalog_title = $rows[0]['title'];
				# по типам платёжек
				foreach ($mail_template as $type_opata => $blank)
				{
				# если будет предоплата, то нужно составить две платёжки
			
		$blank = strtr($blank, $replace);
		$blank = strtr($blank, $company);
		$blank = str_replace('{host}', $this->std->host, $blank); // заголовок каталога
		$blank = str_replace('{catalog_title}', $catalog_title, $blank); // заголовок каталога
	
		$type_opata_title = '';
						$type_opata_title = ($type_opata == 'bank') ? 'банковский перевод' : 'сф';
	
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
		
		# обновляем списки заказываемых друг с другом товаров
			$this->updateAttend();
				
			# очищаем корзину
				$shop['cart']['goods'] = array();
				$this->std->updateSession($this->std->member['session_id'], 'update', array('module_shop' => $shop));
					
				return $order_id;
	}


}
?>