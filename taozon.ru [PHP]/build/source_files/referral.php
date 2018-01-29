<?php

include_once 'config.php';
include_once 'config/config.php';

class mailer {
	protected $_from;
	protected $_to;
	protected $_subject;
	protected $_text;
	protected $_from_name;

	public function __set($key, $val)
	{
		$var = '_' . strtolower ( $key );
		$this->$var = $val;
		return;
	}

	public function __get($key)
	{
		if (!isset($this->$key)) {
		    throw new Exception('Invalid getter for ['.$key.'] property in ['.get_class($this).']');
		}
		return $this->$key();
	}

	private function getFrom()
	{
		if (! empty ( $this->_from_name )) {
			$from = $this->_from_name . " <" . $this->_from . ">";
		} else {
			$from = $this->_from;
		}
		return $from;
	}

	private function getHeader()
	{
	    $from = $this->getFrom();
	    return "From: " . $from . PHP_EOL
		. "Reply-To: " . $from . PHP_EOL
		. "Content-Type: text/html; charset=UTF-8" . PHP_EOL
		. "MIME-Version: 1.0"  . PHP_EOL
		. "Content-Transfer-Encoding: 8bit " . PHP_EOL
		. "X-Mailer: PHP/". phpversion () . PHP_EOL;
	}

	private function setSubject()
	{
	    return "=?UTF-8?B?" . base64_encode ( $this->_subject ) . "?=" . PHP_EOL;
	}

	public function send() {
		return mail ( $this->_to, $this->setSubject(), urldecode($this->_text), $this->getHeader(), "-f" . $this->_from );
	}

}

/**
 * Входные параметры берутся из GET запроса
 * обязательные параметры:
 * - act=название метода, который совершает обработку запроса
 * - login=логин пользователя в системе
 * - order=номер заявки
 * - purchase=сумма заказа
 *
 * Пример запроса для оплаты заказа http://opentao.ru/referral.php?act=payment&id=USR-0000000000&order=2&purchase=80
 * Пример запроса для отправки посылки http://opentao.loc/referral.php?act=sending&id=USR-0000000000&order=3&purchase=87.7
 *
 * @author glebroman@yahoo.com
 */

class Referral {

	private $action;

    /**
     * @var CMS
     */
    private $cms;
	private $order;
	private $purchase;
	private $user;
	private $min_limit;
	private $_tmp_data = array();
	private $send_to_parent = false;
	private $referrals = array();
	private $present = false;
	private $statuses = array(
		1 => array('Участник', 0)
		, array('Лидер', 3)
		, array('Босс', 7)
		, array('Президент', 10)
	);

	public function __construct() {
		$this->_checkCms();
		$this->_checkTables();
		$this->_getDataFromQuery();
		$this->min_limit = defined('LIMIT_FOR_BONUS_REFERRAL_SYSTEM') ? LIMIT_FOR_BONUS_REFERRAL_SYSTEM : 35;
	}

	public function doMethod()
	{
		if (!empty($this->action)) {
			$method = '_do' . ucfirst(strtolower($this->action));
			if (method_exists($this, $method)) {
				$this->$method();
			}
		}
	}

	/**
	 * Метод вызываемый при оплате заказа
	 * @return void
	 */
	private function _doPayment()
	{
		if (!$this->_validate()) return;
		$order = $this->_addOrder();
		$this->_updateStatus();
		$this->_updateBalance();
		$this->_updateUser();
		if ($this->send_to_parent && (int)$this->user['parent_id'])
			$this->_updateParentUserStatus();
	}

	/**
	 * Метод вызываемый при создании посылки
	 * @return void
	 */
	private function _doSending()
	{
		if (!$this->_validate()) return;
		$this->cms->updateOrderPurchase($this->order, $this->purchase);
		$this->_updateBalance();
		$this->_updateUser();
	}

	private function _getDataFromQuery()
	{
		$this->action =  isset($_GET['act']) ? trim($_GET['act']) : '';
		$this->user = $this->_getUser();
		$this->order = isset($_GET['order']) ? $_GET['order'] : NULL;
		$this->purchase = $this->_getPurchase();
	}

	/**
	 * Проверка на наличие входных параметров
	 * @return boolean
	 */
	private function _validate()
	{
		return ($this->order && $this->purchase && $this->user);
	}

	private function _getTree($hasChilds=false, $parent_id=0)
	{
		$result = array();
		$parent_id = (!empty($parent_id)) ? $parent_id : $this->user['id'];
		$tree = $this->_setChildren($parent_id);
		if (!$hasChilds) return $tree;
		foreach ($tree as $item) {
			$result[$item['id']] = $item;
			$children = $this->_getTree(true, $item['id']);
			foreach ($children as $child) {
				$result[$child['id']] = $child;
			}
		}
		return $result;
	}

	private function _setChildren($parent_id)
	{
		return $this->cms->getChildrenByParentId($parent_id);
	}

	private function _checkCms()
	{
		$this->cms = new CMS();
		return $this->cms->Check();
	}

	private function _checkTables()
	{
		$this->cms->checkTable('site_referrals');
		$this->cms->checkTable('site_orders');
	}

	private function _getPurchase()
	{
		$purchase = isset($_GET['purchase']) ? trim($_GET['purchase']) : 0;
		return floatval($purchase);
	}

	private function _getUser()
	{
		$user = isset($_GET['id']) ? trim($_GET['id']) : '';
		return $this->cms->GetUserById($user);
	}

	private function _addOrder()
	{
		$referral_id = $this->user['id'];
		return $this->cms->AddOrder($referral_id, $this->order, $this->purchase);
	}

	private function _sendMail($text)
	{
		if (!empty($text)) {
			$mail = new mailer();
			$mail->From 	 = 'admin@' . $_SERVER['HTTP_HOST'];
			$mail->From_Name = 'admin';
			$mail->Subject	 = 'Сообщение с сайта ' . $_SERVER['HTTP_HOST'];
			$mail->Text = $text;
			$mail->To	= $this->user['email'];
			$mail->send();
		}
	}

	private function _updateStatus()
	{
		$newStatus = $this->_getStatus();
		if ($this->user['status']<$newStatus) {
			$this->_sendMail($this->_congratulation($newStatus));
			$this->send_to_parent = true;
		}
		$this->user['status'] = $newStatus;
	}

	private function _updateParentUserStatus()
	{
		$children_status = $this->user['status'];
		$children_login = $this->user['login'];
		$data = $this->cms->GetReferralUsers($this->user['parent_id']);
		$this->user = $data[0];
		$newStatus = $this->_getStatus();

		if ($this->user['status']<$newStatus)
			$this->_sendMail($this->_congratulation($newStatus));
		$this->user['status'] = $newStatus;

		if ($this->user['status']>1 && $this->send_to_parent && $children_status>1) {
			$this->_sendMail($this->_message($this->user['status']));
		}

		if ($this->user['status']>0 && $this->purchase>=$this->min_limit && $this->present) {
            $this->sendGift();
			$this->_sendMail("Поздравляем! Один из привлеченных Вами друзей - $children_login, оформил заказ! Выберите подарок!");
		}
		$this->_updateUser();
	}

	private function _congratulation($newStatus)
	{
		$text = '';
		switch ($newStatus) {
			case 1:
				$this->present = true;
				$text = 'Поздравляем с первым заказом на Velichina.com.ua!</br>
						 Теперь Вы участник клуба Velichina!</br>
						 Подобрать товар и оформить заказ оказалось невероятно просто и выгодно?
						 Начинай с нами свой бизнес!
						 Расскажи и помоги оформить заказ своим друзьям - сделай первый шаг к своей финансовой свободе!';
				break;
			case 2:
				$text = 'Поздравляем, Вы получили звание "Лидер"!</br>
						 Теперь покупки на Velichina стали еще экономнее, так как теперь Вы на постоянной основе имеете скидку 3%
						 на все свои последующие заказы и  3% от заказов  друзей, приведенных твоими Участниками!';
				break;
			case 3:
				$text = 'Поздравляем с высоким званием Босс!!!</br>
						 Теперь Вы можете приобретать товар с Китая на 7% ниже стоимости!
						 Помогите Вашему другу "Лидеру" стать "Боссом" и тогда Вы будете получать еще с заказов его "Лидеров" и их "Участников" 7% от суммы!';
				break;
			case 4:
				$text = 'Ваша проделанная работа восхищает!!! Вы заслуженно получили великое звание  "Президент"!</br>
						 Теперь Вы получаете 10% скидки на свои заказы!
						 Да что тут говорить... у Вас есть "старт" для ведения по истине большого бизнеса, самое интересное только начинается!</br>
						 Помоги своему другу "Боссу" получить звание "Президент" и получай пассивный доход, в размере 10% от суммы заказов его приведенных"Боссов", "Лидеров", и "Участников"!
						 Как минимум это группа будет из 125 человек!!!';
				break;
		}
		return $text;
	}

	private function _message($status)
	{
		$messages[1] = array(
			 'Поздравляем с первым заказом на Velichina.com.ua!</br> Теперь Вы участник клуба Velichina!</br> Подобрать товар и оформить заказ оказалось невероятно просто и выгодно? Начинай с нами свой бизнес! Расскажи и помоги оформить заказ своим друзьям - сделай первый шаг к своей финансовой свободе!'
			,'Поздравляем!</br> Один из привлеченных Вами друзей оформил заказ! Выберите подарок!'
			,'Поздравляем!</br> Один из привлеченных Вами друзей оформил заказ! Выберите подарок!'
			,'Поздравляем!</br> Один из привлеченных Вами друзей оформил заказ! Выберите подарок!'
			,'Поздравляем!</br> Один из привлеченных Вами друзей оформил заказ! Выберите подарок!'
			,'Поздравляем!</br> Один из привлеченных Вами друзей оформил заказ! Выберите подарок!'
			);
		$messages[2] = array(
			 'Поздравляем, Вы получили звание "Лидер"!</br> Теперь покупки на Velichina стали еще экономнее, так как теперь Вы на постоянной основе имеете скидку 3% на все свои последующие заказы! Но это не все, помогите своему другу получить звание "Лидер" и Вы начнете не только экономить, но и зарабатывать, получая еще 3% с заказов приведенных друзей  Вашего "Лидера"!'
			,'Отличная работа! Один из Ваших "Участников" стал "Лидером", у Вас теперь есть собственная группа из 5 человек, его "Участники". С каждого их заказа Вам на счет будет поступать 3% от суммы!'
			,'Вот это да! Вас я  лично не знаю, но точно могу сказать Вы определенно целеустремленный человек! Один из Ваших "Участников" стал "Лидером". Ваша группа растет! Сегодня она увеличилась еще на 5 человек и Вы будете получать 3% от их последующих заказов!'
			,'Вы настоящий Лидер! За Вами идут люди! Сегодня еще один "Участник" получил звание "Лидер" и привел к Вам 5 человек. С суммы их последующих  заказов  Вам на счет будет поступать 3%!'
			,'Достойная работа! Еще немного и Вы Босс! Один из Ваших друзей получил звание "Лидер" и теперь Ваша группа увеличилась еще на 5 человек. От суммы их  последующих заказов к Вам на счет будет поступать 3%!'
			);
		$messages[3] = array(
			 'Поздравляем с высоким званием Босс!!!</br> Теперь Вы можете приобретать товар с Китая на 7% ниже стоимости! Помогите Вашему другу "Лидеру" стать "Боссом" и тогда Вы будете получать еще с заказов его "Лидеров" и их "Участников" 7% от суммы!'
			,'Вы пример для подражания! Ваша работа выше всяких похвал! Сегодня один из Ваших друзей стал "Боссом"! Поздравляем!!! У Вас есть своя группа, состоящая уже из приведенных другом "Лидров" и их "Участников",  с суммы заказов которых Вам на счет будет поступать 7%!'
			,'Невероятно! Гордимся нашим партнерством с Вами! Приведенный Вами друг получил звание "Босс" и процент, поступающий вам на счет,с суммы заказов его "Лидеров" и "Участников" составляет 7%!  Поздравляем!!!'
			,'Поздравляем! Рады, что Вы разделяете  девиз Velichina - только вперед! Приведенный Вами друг получил звание "Босс". Процент, поступающий вам на счет,с суммы заказов его "Лидеров" и "Участников" теперь составляет 7%!  Поздравляем!!!'
			);
		$messages[4] = array(
			 'Ваша проделанная работа восхищает!!! Вы заслуженно получили великое звание  "Президент"!</br> Теперь Вы получаете 10% скидки на свои заказы! Да что тут говорить... у Вас есть "старт" для ведения по истине большого бизнеса, самое интересное только начинается!</br>	 Помоги своему другу "Боссу" получить звание "Президент" и получай пассивный доход, в размере 10% от суммы заказов его приведенных"Боссов", "Лидеров", и "Участников"! Как минимум это группа будет из 125 человек!!!'
			,'Поздравляем!!! Еще одна победа!  Вы отлично справляетесь с поставленными перед собой задачами, вы взростили своего друга  и поэтому ему сегодня присвоено звание "Президент", а это значит, что теперь  Ваша группа выросла в 7 раз! Теперь на ваш счет будет поступать 10% от сумм заказов  "Боссов" , "Лидеров" и "Участников Вашего друга"!'
			,'В восторге! Ваши организаторские способности своей'
			);
		return @isset($messages[$status][$this->_tmp_data[$status]]) ? $messages[$status][$this->_tmp_data[$status]] : '';
	}

	private function _getStatus()
	{
		$order_exists = $this->cms->ExistsOrderByUser($this->user['id']);
		if (!$order_exists)
			return 0;

		$data = array(1=>0, 0, 0, 0);
		$childrens = $this->cms->getChildrenByStatuses($this->user['id']);
		foreach ($childrens as $key => $value) {
			$data[$key] = $value;
		}

		$this->_tmp_data = $data;
		if ($data[3]+$data[4]>=5 && $data[2]+$data[3]+$data[4]>=25 && $data[1]+$data[2]+$data[3]+$data[4]>=125) {
			return 4;	// Президент
		} elseif ($data[2]+$data[3]+$data[4]>=5 && $data[1]+$data[2]+$data[3]+$data[4]>=25) {
			return 3;	// Босс
		} elseif ($data[1]+$data[2]+$data[3]+$data[4]>=5) {
			return 2;	// Лидер
		} else
			return 1;	//Участник
	}

	private function _updateBalance()
	{
		$this->_getBalance();
		$this->_getCommission();
	}

	private function _getBalance()
	{
		$result = $this->cms->getReferralBalance($this->user['id']);
		$balance = floatval($result[0] ? $result[0] : 0);
		$this->user['balance'] = $balance;
	}

	private function _getCommission()
	{
		$balance = 0;
		$this->referrals = $this->_getTree(true);
		foreach ($this->referrals as $item) {
			$purchase = $item['purchase'] ? floatval($item['purchase']) : 0 ;
			if ($item['parent_id']==$this->user['id']) { //если мой друг
				$percent = $this->statuses[$this->user['status']][1];
			} else { // если друг моего друга
				$percent = $this->statuses[$this->_getMaxStatus($item['id'])][1];
			}

			$comission = $purchase*$percent/100;
			$balance += $comission;
		}
		$this->user['comission'] = floatval(number_format($balance, 2));
	}

	private function _getMaxStatus($user_id)
	{
		$status = $this->referrals[$user_id]['status'];
		if ($this->referrals[$user_id]['parent_id']!=$this->user['id']) {
			$tmp = $this->_getMaxStatus($this->referrals[$user_id]['parent_id']);
			$status = $tmp >= $status ? $tmp : $status;
		}
		return $status;
	}

	private function _updateUser()
	{
		$this->cms->UpdateReferral($this->user['id'], $this->user['status'], $this->user['comission'], $this->user['balance']);
	}

    private function sendGift(){
        $this->cms->checkTable('site_referrals_presents');
        $order = mysql_real_escape_string($this->order);
        mysql_query("INSERT INTO `site_referrals_presents` SET `order_id` = '$order'");
    }
}

$reff = new Referral();
$reff->doMethod();

