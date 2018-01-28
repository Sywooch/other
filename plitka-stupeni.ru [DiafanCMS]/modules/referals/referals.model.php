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
	include(dirname(dirname(dirname(__FILE__))).'/includes/404.php');
}

/**
 * Referals_model
 *
 * Модель модуля "Коды РК"
 */
class Referals_model extends Model
{
	/**
	 * @var array сгенерированные в моделе данные, передаваемые в шаблон
	 */
	protected $result;

	/**
	 * @var object основной объект системы
	 */
	protected $diafan;

	/**
	 * Конструктор класса
	 * 
	 * @return void
	 */
	public function __construct(&$diafan)
	{
		$this->diafan = &$diafan;
	}

	/**
	 * Генерирует данные для шаблонной функции: блок вывода кода посетителя
	 *
	 * @param integer $show_id показывать код посетителя
	 * @return array
	 */
	public function show_block($show_referal_id)
	{
        if (! isset($_SESSION['diafan_show_id']))
        {
            $referal = getenv("HTTP_REFERER");
			if(! empty($referal))
			{
				$url = parse_url($referal);
			}

            if(! empty($referal) && $url["host"] != $_SERVER['HTTP_HOST'])
            {
                DB::query("INSERT INTO {referals} (created, referer) VALUE ('%d', '%s')", time(), $referal);
                $_SESSION['diafan_show_id'] = DB::last_id("referals"); 
            }
            else
            {
                 $_SESSION['diafan_show_id'] = 1;
            }
         }

         return $show_referal_id? $_SESSION['diafan_show_id'] : 0;
    }	
}