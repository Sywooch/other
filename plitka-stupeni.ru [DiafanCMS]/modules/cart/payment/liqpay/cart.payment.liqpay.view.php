<?php
/**
 * @package    Diafan.CMS
 *
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (! defined('DIAFAN'))
{
	include dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/includes/404.php';
}

/**
 * Шаблон платежа через систему Liqpay
 */

echo $this->result["text"];
$signature = $this->result["signature"];
$phone = '+20123145121';
$xml = "<request>      
	<version>1.2</version>
	<result_url>".$this->result["result_url"]."</result_url>
	<server_url>".$this->result["server_url"]."</server_url>
	<merchant_id>".$this->result["merchant_id"]."</merchant_id>
	<order_id>".$this->result["order_id"]."</order_id>
	<amount>".$this->result["summ"]."</amount>
	<currency>".$this->result["currency"]."</currency>
	<description>Oplata zakaza № ".$this->result["order_id"]."</description>
	<default_phone>$phone</default_phone>
	<pay_way>".$this->result["method"]."</pay_way> 
	</request>
	";

$xml_encoded = base64_encode($xml); 
$lqsignature = base64_encode(sha1($signature.$xml.$signature,1));

echo "<form action='https://www.liqpay.com/?do=clickNbuy' method='POST'>
<input type='hidden' name='operation_xml' value='$xml_encoded' />
<input type='hidden' name='signature' value='$lqsignature' />
<input type='submit' value=".$this->diafan->_('Оплатить', false).">
</form>";