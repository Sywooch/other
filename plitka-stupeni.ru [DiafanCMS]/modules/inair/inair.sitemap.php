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
	include dirname(dirname(__FILE__)).'/includes/404.php';
}

/**
 * Map_sitemap
 * 
 * Карта сайта в xml формате
 */
class Inair_sitemap extends Diafan
{
	/**
	 * @var array языковые версии сайта
	 */
	public $lang;

	/**
	 * @var string перечень всех полей, указывающих на активность элемента
	 */
	public $act;

	/**
	 * @var array ЧПУ
	 */
	public $rewrites;

	/**
	 * Инициирует создание карты сайта
	 * 
	 * @return void
	 */
	public function init()
	{
		$this->set_languages();
		$this->set_rewrites();

		header('Content-type: application/xml'); 
		echo '<?xml version="1.0" encoding="UTF-8"?>';
		echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
		$this->site_map();
		echo '</urlset>';
		
	}


}


$sitemap = new Inair_sitemap($this);
$sitemap->init();
exit;