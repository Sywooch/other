<?php

/**
 * @package    Diafan.CMS
 *
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

/**
 * Diafan
 *
 * Каркас класса
 */
abstract class Diafan
{
	/**
	 * @var object основной объект системы
	 */
	public $diafan;

	/**
	 * Конструктор класса
	 *
	 * @return void
	 */
	public function __construct(&$diafan)
	{
		$this->diafan = &$diafan;
	}
}