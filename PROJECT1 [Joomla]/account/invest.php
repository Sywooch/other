<?php


define('PERCENT', '33'); // процент
define('PERCENTREF', '20'); // реферальный процент

// HTTP
define('HTTP_SERVER', 'http://kondratik.ru/account/');

// HTTPS
define('HTTPS_SERVER', 'http://kondratik.ru/account/');

// DIR
define('DIR_APPLICATION', '/home/users2/b/bohatko/domains/kondratik.ru/account/catalog/');
define('DIR_SYSTEM', '/home/users2/b/bohatko/domains/kondratik.ru/account/system/');
define('DIR_DATABASE', '/home/users2/b/bohatko/domains/kondratik.ru/account/system/database/');
define('DIR_LANGUAGE', '/home/users2/b/bohatko/domains/kondratik.ru/account/catalog/language/');
define('DIR_TEMPLATE', '/home/users2/b/bohatko/domains/kondratik.ru/account/catalog/view/theme/');
define('DIR_CONFIG', '/home/users2/b/bohatko/domains/kondratik.ru/account/system/config/');
define('DIR_IMAGE', '/home/users2/b/bohatko/domains/kondratik.ru/account/image/');
define('DIR_LOGS', '/home/users2/b/bohatko/domains/kondratik.ru/account/system/logs/');

// DB
define('DB_DRIVER', 'mysql');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', '045806063_cab');
define('DB_PASSWORD', '045806063');
define('DB_DATABASE', 'bohatko_cab');
define('DB_PREFIX', '');
// Startup
require_once(DIR_SYSTEM . 'startup.php');

// Application Classes
require_once(DIR_SYSTEM . 'library/customer.php');
require_once(DIR_SYSTEM . 'library/ocstore.php');

// Registry
$registry = new Registry();

// Loader
$loader = new Loader($registry);
$registry->set('load', $loader);

// Config
$config = new Config();
$registry->set('config', $config);

// Database 
$db = new DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
$registry->set('db', $db);


$date = date("Y-m-d"); // текущая дата
	
	$parts = explode('-',$date);
	
	if($parts[1]==01) {
		$last_date = ($parts[0]-1).'-12-'.$parts[2].' 23:59:59';
	}else {
		$last_date = $parts[0].'-'.($parts[1]-1).'-'.$parts[2].' 23:59:59';
	}
	
	if($parts[1]==01) {
	
	$last_month_days = cal_days_in_month(CAL_GREGORIAN, 12, $parts[0]);
	
	} else {
	$last_month_days = cal_days_in_month(CAL_GREGORIAN, $parts[1]-1, $parts[0]);
	}
	
	$per_one_day = 100/$last_month_days;
	
	$percent = PERCENT;
	
	$query = $db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE balance > '0' ");
	
	$customers = $query->rows; //получили всех юзеров у которых есть дентги на балансе
	
	
	//перебираем по юзерам
	foreach($customers as $customer) {
	
	
	$last_quer = $db->query("SELECT * FROM " . DB_PREFIX . "customer_transaction WHERE customer_id =  '".(int)$customer['customer_id']."' AND date_added <='".$last_date."' ORDER BY date_added ASC");
	
	$last_transactions = $last_quer->rows; //получили все транзакции конкретного юзверя до 1 числа предыдущего месяца, включительно.
	
	$last_deposit = 0;
	foreach($last_transactions as $lt){
		
		if($lt['description']=='Пополнение счета' || $lt['description']=='Начисление прибыли' || $lt['description']=='Прибыль от рефералов') {
		$last_deposit= $last_deposit+$lt['amount'];
		} else {
		$last_deposit= $last_deposit-$lt['amount'];
		}
	
	
	} // депозит на 1е число прошлого месяца
	
	
	$last_query = $db->query("SELECT * FROM " . DB_PREFIX . "customer_transaction WHERE customer_id =  '".(int)$customer['customer_id']."' AND date_added >'".$last_date."' ORDER BY date_added ASC");
	
	$last_outs = $last_query->rows; //получили все транзакции конкретного юзверя до 1 числа предыдущего месяца, включительно.
	
	$last_out = 0;
	foreach($last_outs as $lo){
		
		if($lo['description']=='Пополнение счета' || $lo['description']=='Начисление прибыли' || $lo['description']=='Прибыль от рефералов') {
		break;
		} else {
		$last_deposit = $last_deposit-$lo['amount'];
		}
	
	
	} //выводы после 1го числа первого месяца
	
	$last_deposit = $last_deposit; //сумма расчетная на полный процент прибыли рассчитаная до первого ввода в расчетном месяце.
	
	$quer = $db->query("SELECT * FROM " . DB_PREFIX . "customer_transaction WHERE customer_id =  '".(int)$customer['customer_id']."' AND date_added >'".$last_date."' ORDER BY date_added ASC");
	
	$transactions = $quer->rows; //получили все транзакции конкретного юзверя после 1го числа прошлого месяца
	
	$this_in= array();
	$this_in[] = array('amount'=>$last_deposit,'day'=>1,'type'=>'in');
	
	$i = 1;
	foreach($transactions as $tr){
	if($tr['description']=='Вывод средств со счета' && $i==1) {
	continue;
	} elseif($tr['description']=='Вывод средств со счета' && $i==0) {
	
	$parts0 = explode(' ',$tr['date_added']);
	$parts1 = explode('-',$parts0[0]);
	
	$day = $parts1[2];

	$this_in[] = array('amount'=>$tr['amount'],'day'=>$day,'type'=>'out');
	}
	if($tr['description']=='Пополнение счета') {
	$i = 0;
	$parts0 = explode(' ',$tr['date_added']);
	$parts1 = explode('-',$parts0[0]);
	
	$day = $parts1[2];
	
	$this_in[] = array('amount'=>$tr['amount'],'day'=>$day,'type'=>'in');
	
	}
	
	}
	
	
	// 1 число предыдущего месяца - 100% последнее - 0%. 
	$doxod = array();
	foreach($this_in as $key => $value) {
	
		if($value['type'] == 'in') {

		$perc = ($last_month_days-$value['day']+1)*$per_one_day;
		$doxod[$key]=array('amount'=>$value['amount'],'percent'=>$perc);
		
		} elseif($value['type'] == 'out') {
		
				for($i=$key-1;$i>=0;$i--) {

					if(isset($doxod[$i])) {
					
					if($doxod[$i]['amount'] >0) {
					$doxod[$i]['amount'] = $doxod[$i]['amount']-$value['amount'];
					}
					
					if($doxod[$i]['amount'] >0) {
					break;
					} 
					elseif($doxod[$i]['amount'] <0) {
					$value['amount'] = abs($doxod[$i]['amount']);
					unset($doxod[$i]);
					continue;
					}
					elseif($doxod[$i]['amount'] ==0) {
					unset($doxod[$i]);
					break;
					}
					}
				}
				
				unset($this_in[$key]);
		}
	}
	
	
	///все ништячки получены, теперь собираем все суммы в кучу и начисляем проценты
	
	$add = 0;
	$summa = 0;
	foreach($doxod as $dox) {
	
	$ptr = (PERCENT/100)/100*$dox['percent'];
	$add = $add + $dox['amount']*$ptr;
	$summa = $summa+$dox['amount'];
	
	}
	

	
	$ref = $add*(PERCENTREF/100);
	
	///тут нужно зачислить средства на счет

	$db->query("INSERT INTO " . DB_PREFIX . "customer_transaction SET customer_id = '" . (int)$customer['customer_id'] . "', description = 'Начисление прибыли', amount = '" . (float)$add . "', date_added = NOW()");
		
	$db->query("UPDATE " . DB_PREFIX . "customer SET balance=balance+'".(float)$add."' WHERE customer_id = '" . (int)$customer['customer_id'] . "'");
	
	if($customer['partner_id']) {
		
		$quereee = $db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE customer_id =  '".(int)$customer['partner_id']."'");
		
		if($quereee) {
		///тут нужно зачислить средства на счет привлекшего

	$db->query("INSERT INTO " . DB_PREFIX . "customer_transaction SET customer_id = '" . (int)$customer['partner_id'] . "', description = 'Прибыль от рефералов', amount = '" . (float)$ref . "', date_added = NOW()");
		
	$db->query("UPDATE " . DB_PREFIX . "customer SET balance=balance+'".(float)$ref."' WHERE customer_id = '" . (int)$customer['partner_id'] . "'");
	$db->query("UPDATE " . DB_PREFIX . "customer SET ref_balance=ref_balance+'".(float)$ref."' WHERE customer_id = '" . (int)$customer['partner_id'] . "'");
	}
	}
	
	
	}
	
	
	print('OK');

?>
