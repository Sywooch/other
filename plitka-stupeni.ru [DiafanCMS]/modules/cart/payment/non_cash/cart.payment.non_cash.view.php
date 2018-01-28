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
 * Шаблон безналичного платежа
 */
echo $this->result["text"]
.'<p><a href="'.BASE_PATH.'cart/payment/non_cash/ul/'.$this->result["order_id"].'/'.$this->result["code"].'/">'.$this->diafan->_('Счет для юридических лиц', false).'</a></p>
<p><a href="'.BASE_PATH.'cart/payment/non_cash/fl/'.$this->result["order_id"].'/'.$this->result["code"].'/">'.$this->diafan->_('Квитанция для физических лиц', false).'</a></p>';