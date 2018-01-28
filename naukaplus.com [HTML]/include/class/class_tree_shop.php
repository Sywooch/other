<?php
require_once 'class_tree.php';  // предок всех каталогов


/**
 * Магазин
 *
 *
 * Необходимые части оформления в файле ***_t_config.php
 * timestamp - формат даты
 * node_last_onmod	- один пункт из списка последних добавленных пунктов модуля
 * node_best	- один пункт из списка лучших/избранных пунктов модуля
 * node_last_onmain	- один пункт из списка последних добавленных пунктов модуля
 * node_best_onmain	- один пункт из списка помеченных/лучших пунктов для вывода на глувную страницу (или на любую другую)
 * menu_withchilds	- меню с детьми
 * menu_withoutchilds	- меню без детей
 *
 *
 *
 *
 */
class class_tree_shop extends class_tree
{
	
	/** класс - каталог  */ 
	var $catalog = null;
	
	
	var $catalog_name = '';

	public function main()
	{

		$this->catalog_name = $this->std->settings[$this->mod_name.'_modrecipient'];



		# инициализация прошла успешно, теперь проверяем, нужно ли запустить основной комплекс модуля
		if ($this->std->alias[0] != $this->mod_name)
		{
			# состояние корзины - показ количества товаров и общей суммы
			$this->setPul($this->mod_name.'_cart', $this->getMiniCart());
				
			# если вызывает другой модуль, то выход
			return;
		}



		# Выбор обработчика запрашиваемой операции
		$this->selectAction();

		# состояние корзины - показ количества товаров и общей суммы
		$this->setPul($this->mod_name.'_cart', $this->getMiniCart());

	}





	/**
	 * Выбор обработчика запрашиваемой операции
	 *
	 */
	public function selectAction()
	{
		if (isset($this->std->alias[0]) && ($this->std->alias[0] == $this->mod_name))
		if (isset($this->std->alias[1]))
		{
			$this->setPul('h1', 'Корзина покупателя');
			$this->setPul('title', 'Корзина покупателя');
			
			
			switch ($this->std->alias[1])
			{									
				case 'cart' :
							$this->setPul('body', $this->getFullCart()); 
							break;
				case 'thankyou' :
							# заказ
							$this->updatePul('h1', 'Оформление заказа');
							$this->updatePul('title', 'Оформление заказа'); 
							$this->setPul('body', $this->getOrder());
							break; 
							break;
				case 'calc' :					
							if (isset($this->std->input['calc']))
							{ 
								# просто пересчёт 
								$this->calcCart();
								$this->setPul('body', $this->getFullCart()); 
								break;
							}
							else
							{
								# заказ
								$this->updatePul('h1', 'Оформление заказа');
								$this->updatePul('title', 'Оформление заказа'); 
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
	 * подсчитывает количество товаров в корзине и общую сумму заказа
	 *
	 */
	public function getMiniCart()
	{
		$res = '';

		# извлечение информации о состоянии корзины
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
			# в корзине что-то лежит
			$pms['sum'] = number_format($pms['sum'], 2, ',', ' ');
			$res = $this->strtr_mod($this->skin['full'], $pms);
		}
		else
		{
			# корзина пуста
			$res = $this->skin['empty'];
		}

		$res = str_replace('{mod_name}', $this->mod_name, $res);
		
		return $res;

	}


	/**
	 * пересчёт состояния корзины
	 *
	 */
	function calcCart()
	{
		# апдейтим сессию корзины (пользователь мог поменять количество товаров)
		$cart = $this->std->getValueSession($this->mod_name);
		
		
		
		# достаем данные о товарах из базы
		$ids = array();
		foreach ($cart['goods'] as $id => $good)
		{
			$ids[] = $id;
		}

		
		if (count($ids) > 0)
		{
			$new_cart = array('goods' => array());
			
			# получаем идентификаторы заказываемых позиций, которе сейчас есть в каталоге
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
	 * Обновление сопутствующих товаров
	 *
	 */
	function updateAttend()
	{
		# Достаем товары в корзине
		$cart = $this->std->getValueSession($this->mod_name);

		$pairs = array(); // пары товаров
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

		# формируем запрос sql чтобы узнать, существуют такие пары или нет
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

		# если пара существует - обновляем количество, иначе добавляем в базу.
		# Обновляться количество будет столькими запросами сколько пар обновляется
		# добавляться будет одним запросом.
		$values = array(); // для insert'а
		foreach ($pairs as $pair)
		{
			if (isset($pairsdb[$pair['g1'].$pair['g2']]))
			{
				$this->std->db->do_query("UPDATE se_{$this->mod_name}_attend SET `count` = `count` + 1 WHERE `good_id1` = '".$pair['g1']."' AND `good_id2` = '".$pair['g2']."'");
			} else {
				$values[] = "('".$pair['g1']."', '".$pair['g2']."', '1')";
			}
		}
		
		
		# удаляем кеш затронутых вершин каталога
		if ($this->std->settings[$this->catalog_name.'_cache'] == '1')
		{
			# кеширование включено, значит нужно некотрые файлы кеша поудалять			
			if ($this->initCatalog())
			{				
				foreach ($cart['goods'] as $good)
				{
					$good['alias'] = $good['id'];
					$this->catalog->clearCacheByNode($good);
				}
			}
		}
		

		# добавляем в базу
		if (count($values) > 0)
		{
			$values = implode(", ", $values);
			$sql = "INSERT INTO se_{$this->mod_name}_attend (`good_id1`, `good_id2`, `count`) VALUES ".$values;
			
			$this->std->db->do_query($sql);
		}
	}
	
	
	
	
	

	/**
	 * Выводит форму заказа
	 *
	 */
	function getOrder()
	{
		$res = '';
		
		

		if (isset($this->std->input['order']))
		{
			# пользователь мог поменять количество товаров, делаем пересчёт
			$this->calcCart();
			
			$pms = array();
			
			
			# если пользователь авторизован, тогда вставляем его данные в форму
			if ($this->issetUser())
			{
				$user = &$this->std->member['session_cache']['user'];
				
				$pms['name'] = $user['user_lname'].' '.$user['user_fname'];
				$pms['phone'] = $user['user_phone'];
				$pms['email'] = $user['user_email'];
				$pms['read_only'] = '';
			}
			
			# вызов формы заказа			
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
	 * Отправка заказа
	 *
	 */
	function doOrder()
	{
		# получаем из сессии информацию о заказе
		$cart = $this->std->getValueSession($this->mod_name);

		
		
		#--------------------------------------------------------------
		# таблица с заказываемыми позициями
		$goods = $this->skin['mail_cart_begin'];
	
		# заполняем корзину				
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
		# данные о пользователе
		$user = array();
		$user['name'] = $this->std->input['name'];
		$user['phone'] = $this->std->input['phone'];
		$user['email'] = $this->std->input['email'];
		$user['comment'] = $this->std->input['comment'];
		
		
		
		#--------------------------------------------------------------
		# сохранение заказа
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
		# сообщение пользователю
		$message = str_replace('{goods}', $goods, $this->skin['mail_foruser']);
		$message = str_replace('{hesh}', $hesh, $message);
		$message = str_replace('{mod_name}', $this->mod_name, $message);
		$message = str_replace('{mail_footer}', $this->std->settings['site_mail_footer'], $message);
		$message = str_replace('{host}', $this->std->host, $message);
				
		
		
		# отправка письма
		$this->std->initMail();		
		$this->std->mail->to		= $this->std->input['email'];
		$this->std->mail->is_html	= 1;
		$this->std->mail->from		= ($this->std->settings[$this->mod_name.'_email'] != '') ? $this->std->settings[$this->mod_name.'_email'] : $this->std->settings['site_email'];
		$this->std->mail->fullname	= $this->std->settings['site_title'];
		$this->std->mail->subject	= str_replace('{host}', $this->std->host, $this->skin['subject_foruser']);
		$this->std->mail->message	= $message;
		$this->std->mail->send_mail();
		
		
		# запоминаем сопутствующие товары
		if ($this->std->settings[$this->mod_name.'_attend'] > 0)
		{
			$this->updateAttend();
		}

		# очищаем корзину
		$cart['goods'] = array();
		$this->std->updateSession($this->std->member['session_id'], 'update', array($this->mod_name => $cart));

		return true;
	}

	
	
	
	/**
	 * Удаляет из корзины наименование
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
	 * Выводит форму корзины
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
	
				# заполняем корзину				
				$total = 0;
				foreach ($cart['goods'] as $id => $good)
				{
					$good['total'] = $good['count'] * $good['price'];
					$total += $good['total'];
					$good['total'] = number_format($good['total'], 2, ',', ' ');
					
					$good['alias'] = $good['alias'];					
					$good['alias'] = $this->catalog->getAliasByPid($good);

                                        // определяем что вывести в поле ЦЕНА
                                        if (($good['price'] == 0) || ($good['price_show'] == 0))
                                        {
                                            $good['price'] = 'договорная';
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
	 * Возвращает текст сопутствующих товаров
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
	 * Кладет в корзину (сессию) товар
	 *
	 */
	function addCart()
	{
		$good_id = $this->std->input['good_id'];
		$count	 = $this->std->input['good_count'];

		if ($good_id != '' && $count > 0)
		{
			# читаем из сессии данные модуля
			$cart = $this->std->getValueSession($this->mod_name);


			if (!is_array($cart)) $cart = array(); // корзина пуста


			# полная информация о товаре
			$sql = "SELECT * FROM se_".$this->catalog_name." WHERE is_active=1 AND id='{$good_id}' LIMIT 1";
			
			if ($this->db->query($sql, $rows) > 0)
			{
				$row = $rows[0];
				if (isset($cart['goods'][$good_id]))
				{
					# такой товар уже есть в корзине, прибавляем количество
					$cart['goods'][$good_id]['count'] += $count;
				} else {
					# добавляем в корзину новый товар
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

				# обновляем корзину в сессии
				$this->std->updateSession($this->std->member['session_id'], 'update', array($this->mod_name => $cart));
			}
		}
		
		
		header("Location: ".$_SERVER['HTTP_REFERER']);
		exit;
	}





	/**
	 * иницициализация модуля каталога для доступа к функциям класса
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
	 * подтверждение заказа путём перехода по высланной письмом ссылке
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
					# найдена запись, теперь нужно что-то с этим делать
					$row = $rows[0];
					
					if ($row['status'] == '0')
					{
						
						# отправка уведомления менеджеру о новом подтверждённом заказе на сайте
						$this->sendManagerMail($row);
						
						
						# подтвержаем заказ
						$pms = array('status' => 1);
						$this->db->do_update($this->mod_name, $pms, 'id='.$row['id']);
						
						
						# удаляем старые, неподтвердённые в течение месяца, заказы
						$month = time() - 60*60*24*30; // месяц
						$sql = "DELETE FROM {$this->table} WHERE status=0 AND rectime < {$month}";
						$this->db->do_query($sql);
						
						# у всех старых, подтверждённых заказов, удаляем содержание поля - хеш, для экономии памяти
						$month = time() - 60*60*24*30; // месяц
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
			$res = 'Вы перешли на сайт по ошибочной ссылке.<br>Обратитесь к администрации сайта за разъяснениями.';
		}
		
		
		return $res;		
	}
	
	
	
	/**
	 * отправка уведомления менеджеру о новом подтверждённом заказе на сайте
	 *
	 */
	public function sendManagerMail(&$row)
	{
		#----------------------------------------------------------------
		# формируем письмо для отправки менеджеру
		#----------------------------------------------------------------
		# таблица с заказываемыми позициями
		$strgoods = $this->skin['mail_cart_begin'];					
		
		$goods = unserialize( $row['goods'] );
		
		
		# заполняем корзину										
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

		
		# информация о пользователе
		$user = unserialize( $row['user'] );
		$user['host'] = $this->std->host;
		
		
		
		$message = str_replace('{goods}', $strgoods, $this->skin['mail_formanager']);
		$message = str_replace('{mail_footer}', $this->std->settings['site_mail_footer'], $message);
		$message = $this->strtr_mod($message, $user);
		
		
		# отправляем уведомление менеджеру о подтвержённом заказе
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
	 * статистика покупок одного пользователя
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
					$row['extend'] = ($row['status'] == '0') ? ' (<a href="/'.$this->mod_name.'/approve/'.$row['hesh'].'/">Подтвердить?)' : '';
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