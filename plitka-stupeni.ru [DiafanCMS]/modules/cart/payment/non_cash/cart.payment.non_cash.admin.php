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

/*
 * Настройки платежной системы "Банковские платежи" для административного интерфейса
 */
class Cart_payment_non_cash_admin
{
	public $config;

	public function __construct()
	{
		$this->config = array(
			"name" => 'Банковские платежи',
			"params" => array(
			'non_cash_name' => 'Наименование организации',
			'non_cash_ogrn' => 'ОГРН',
			'non_cash_inn' => 'ИНН',
			'non_cash_kpp' => 'КПП',
			'non_cash_rs' => 'Расч. счет',
			'non_cash_bank' => 'Банк',
			'non_cash_bik' => 'БИК',
			'non_cash_ks' => 'Кор. счет',
			'non_cash_address' => 'Адрес',
			'non_cash_director' => 'Руководитель предприятия',
			'non_cash_glbuh' => 'Главный бухгалтер',
			'non_cash_kbk' => 'КБК',
			'non_cash_tax_department' => 'Сокр. наим. налогового органа',
			'non_cash_okato' => 'Код ОКАТО',
			'non_cash_nds' => 'НДС',
			'pechat' => array('name' => 'Печать', 'type' => 'function')
			)
		);
	}
	
	/**
	 * Редактирвание поля "Печать"
	 *
	 * @return void
	 */
	public function edit_variable_pechat()
	{
		echo '<tr class="tr_payment" payment="non_cash" style="display:none">
			<td class="td_first">Печать</td>
			<td>';
		if(file_exists(ABSOLUTE_PATH.USERFILES.'/shop/non_cash.pechat.jpg'))
		{
			echo '<p><img src="'.BASE_PATH.USERFILES.'/shop/non_cash.pechat.jpg?'.rand(0, 888888).'"></p>';
		}
		echo '<input type="file" value="" size="40" name="non_cash_pechat">
			</td>
		</tr>';
	}
	
	/**
	 * Сохранение поля "Печать"
	 *
	 * @return void
	 */
	public function save_variable_pechat()
	{
		if(isset( $_FILES["non_cash_pechat"] ) && is_array($_FILES["non_cash_pechat"]) && $_FILES["non_cash_pechat"]['name'] != '')
		{
			Customization::inc("includes/image.php");
			Image::resize($_FILES["non_cash_pechat"]['tmp_name'], 150, 150, 90);
			copy($_FILES["non_cash_pechat"]['tmp_name'], ABSOLUTE_PATH.USERFILES.'/shop/non_cash.pechat.jpg');
		}
	}
}