<?php
/**
 * @package    Diafan.CMS
 *
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

define('DIAFAN', 1);
define('IS_ADMIN', 0);
define('_LANG', 1);
define('ABSOLUTE_PATH', dirname(dirname(dirname(__FILE__))).'/');

include_once ABSOLUTE_PATH.'config.php';

if (!TIMEZONE || @!date_default_timezone_set(TIMEZONE))
{
	@date_default_timezone_set('Europe/Moscow');
}
include_once ABSOLUTE_PATH.'includes/customization.php';

Customization::inc('includes/developer.php');
$dev = new Dev;
$dev->set_error();
try
{
	include_once ABSOLUTE_PATH.'plugins/encoding.php';
	
	Customization::inc('includes/diafan.php');
	Customization::inc('includes/core.php');
	Customization::inc('includes/database.php');
	DB::connect();
}
catch (Exception $e)
{
	$dev->exception($e);
}

class Init extends Core
{
	/**
	 * @var object кэш
	 */
	public $_cache;

	/**
	 * @var object ЧПУ страниц магазина
	 */
	public $_route;

	/**
	 * @var object текущий пользователь
	 */
	public $_user;

	/**
	 * @var object подключение магазина
	 */
	public $_shop;

	/**
	 * Конструктор класса
	 * 
	 * @return void
	 */
	public function __construct()
	{
		Customization::inc('includes/cache.php');
		$this->_cache = new Cache;

		Customization::inc('includes/route.php');
		$this->_route = new Route($this);

		$this->_user = new stdClass();
		$this->_user->id = 0;
		$this->_user->role_id = 0;

		Customization::inc('includes/model.php');

		Customization::inc('modules/shop/shop.inc.php');
		$this->_shop = new Shop_inc($this);

		Customization::inc('modules/cart/cart.inc.php');
		$this->_cart = new Cart_inc($this);
	}
}

/**
 * Shopyandex
 * 
 * Импорт товаров в Яндекс.Маркет
 */
class Shop_yandex
{
	/**
	 * @var object основной объект системы
	 */
	private $diafan;

	/**
	 * @var integer время последнего редактирования магазина
	 */
	private $timeedit;

	/**
	 * @var array страницы сайта, к которым прикреплен модуль Магазин
	 */
	private $sites = array();

	/**
	 * Конструктор класса
	 * 
	 * @return void
	 */
	public function __construct()
	{
		global $diafan;
		$this->diafan = &$diafan;
		
		define('BASE_PATH', "http://".$_SERVER["HTTP_HOST"]."/".(REVATIVE_PATH ? REVATIVE_PATH.'/' : ''));

		$result = DB::query("SELECT id FROM {site} WHERE trash='0' AND [act]='1' AND module_name='shop' AND access='0'");
		while($row = DB::fetch_array($result))
		{
			if($this->diafan->configmodules('yandex', 'shop', $row["id"]))
			{
				$this->sites[] = $row["id"];
			}
		}
		if (! $this->sites)
		{
			include_once ABSOLUTE_PATH.'includes/404.php';
		}
		$this->diafan->get_languages();
		define('TITLE', defined('TIT'.$this->diafan->language_base_site) ? constant('TIT'.$this->diafan->language_base_site) : '');
		header('Content-type: application/xml');
		echo utf::to_windows1251($this->init());
	}

	/**
	 * Инициирует генерирование YML-файла
	 * 
	 * @return string
	 */
	private function init()
	{
		$cache_meta = array(
				"name"     => "yandex"
			);
		if (! $text = $this->diafan->_cache->get($cache_meta, "shop"))
		{
			$text  = $this->get_info();
			$text .= $this->get_categories();
			$text .= $this->get_offers();
	
			$text = '<?xml version="1.0" encoding="windows-1251"?>
			<!DOCTYPE yml_catalog SYSTEM "shops.dtd">
			<yml_catalog date="'.date("Y-m-d H:i", $this->timeedit).'">
				<shop>
				'.$text.'
				</shop>
			</yml_catalog>';
			$this->diafan->_cache->save($text, $cache_meta, "shop");
		}
		return $text;
	}

	/**
	 * Генерирует часть YML-файла, содеражащую информацию о магазине
	 * 
	 * @return string
	 */
	private function get_info()
	{
		$text = '
			<name>'.$this->prepare($this->diafan->configmodules('nameshop', 'shop', $this->sites[0])).'</name>
			<company>'.$this->prepare(TITLE).'</company>
			<url>'.BASE_PATH.'</url>
			<currencies>
			<currency id="';
			if ($this->diafan->configmodules('currencyyandex', 'shop', $this->sites[0]))
			{
				$text .= $this->prepare($this->diafan->configmodules('currencyyandex', 'shop', $this->sites[0]));
			}
			else
			{
				$text .= 'RUR';
			}
	
			$text .= '" rate="';
		
			if (! $this->diafan->configmodules('currencyyandex', 'shop', $this->sites[0]) || $this->diafan->configmodules('currencyyandex', 'shop', $this->sites[0]) == 'RUR')
			{
				$text .= '1';
			}
			else
			{
				if ($this->diafan->configmodules('currencyratesel', 'shop', $this->sites[0]) == 1)
				{
					$text .= preg_replace('/[^0-9\.]+/', '', str_replace(',', '.', $this->diafan->configmodules('currencyrate', 'shop', $this->sites[0])));
				}
				else
				{
					$text .= 'CBRF';
				}
			}
		
			if ($this->diafan->configmodules('currencyyandex', 'shop', $this->sites[0]) && $this->diafan->configmodules('currencyyandex', 'shop', $this->sites[0]) != 'RUR'
			   && $this->diafan->configmodules('currencyratesel', 'shop', $this->sites[0]) == 3 && $k)
			{
				$text .= '" plus="'.preg_replace('/[^0-9\.]+/', '', str_replace(',', '.', $this->diafan->configmodules('currencyrate', 'shop', $this->sites[0])));
			}
		
			$text .= '" />
			</currencies>';
		return $text;
	}

	/**
	 * Генерирует часть YML-файла, содеражащую информацию о категориях магазина
	 * 
	 * @return string
	 */
	private function get_categories()
	{
		$text = '';
		foreach($this->sites as $site_id)
		{
			if ($this->diafan->configmodules('cat', 'shop', $site_id))
			{
				$text .= '
				<categories>';
				$result = DB::query("SELECT id, [name], parent_id, timeedit FROM {shop_category} WHERE [act]='1' AND trash='0' AND site_id=%d"
							.($this->diafan->configmodules('show_yandex_category', 'shop', $site_id) ? " AND show_yandex='1'" : ""), $site_id);
				while ($row = DB::fetch_array($result))
				{
					$text .= '
					<category id="'.$row["id"].($row["parent_id"] ? '" parentId="'.$row["parent_id"] : '').'">'
						.$this->prepare($row["name"]).'</category>';
					$this->timeedit = $row["timeedit"] > $this->timeedit ? $row["timeedit"] : $this->timeedit;
				}
				
				$text .= '
				</categories>';
			}
		}
		return $text;
	}

	/**
	 * Генерирует часть YML-файла, содеражащую информацию о товарах магазина
	 * 
	 * @return string
	 */
	private function get_offers()
	{
		$text = '
		<offers>';
		foreach($this->sites as $site_id)
		{
			$result = DB::query("SELECT * FROM {shop} WHERE [act]='1' AND trash='0' AND site_id=%d"
						.($this->diafan->configmodules('show_yandex_element', 'shop', $site_id) ? " AND show_yandex='1'" : ""), $site_id);
			while ($row = DB::fetch_array($result))
			{
				$yandex = array();
				$link = BASE_PATH.$this->diafan->_route->link($row["site_id"], "shop", $row["cat_id"], $row["id"]);
				$this->timeedit = $row["timeedit"] > $this->timeedit ? $row["timeedit"] : $this->timeedit;
	
				if ($row["yandex"])
				{
					$y_arr = explode("\n", $this->prepare($row["yandex"]));
					foreach ($y_arr as $y_a)
					{
						list($k, $v) = explode("=", $y_a, 2);
						$yandex[$k] = $v;
					}   	
				}
				$price = 0;
				if(! $row["no_buy"])
				{
					$prices = $this->diafan->_shop->price_get_all($row["id"], 0);
					if($prices)
					{
						// если учитываются остатки и товара нет на сайте, то цену указываем 0 (согласно стандартов)
						$price = ! $this->diafan->configmodules("use_count_goods", 'shop', $site_id) || $prices[0]["count_goods"] ? $prices[0]["price"] : 0;
					}
				}
				if(! isset($GLOBALS['shop_images_variation_medium']))
				{
					$GLOBALS['shop_images_variation_medium'] = '';
					$images_variations = unserialize($this->diafan->configmodules("images_variations", 'shop', $site_id));
					foreach($images_variations as $images_variation)
					{
						if($images_variation["name"] == 'medium')
						{
							$GLOBALS['shop_images_variation_medium'] = DB::query_result("SELECT folder FROM {images_variations} WHERE id=%d LIMIT 1", $images_variation["id"]);
							continue;
						}
					}
				}
	
				$img = DB::fetch_array(DB::query("SELECT id, name FROM {images} WHERE module_name='shop' AND"
								." element_id='%d' AND trash='0' ORDER BY sort ASC LIMIT 1", $row["id"]));
	
				$picture = $img ? BASE_PATH.USERFILES.'/shop/'.$GLOBALS['shop_images_variation_medium'].'/'.$img["name"] : '';
				
				$bid = ! empty($yandex["bid"]) ? $yandex["bid"] : $this->diafan->configmodules('bid', 'shop', $site_id);
				$cbid = ! empty($yandex["cbid"]) ? $yandex["cbid"] : $this->diafan->configmodules('cbid', 'shop', $site_id);
			
				if (empty($yandex["typePrefix"]) || empty($yandex["vendor"]) || empty($yandex["vendorCode"]) || empty($yandex["model"]))
				{
					$text .= '
					<offer id="'.$row["id"].'" available="true"'.($bid ? ' bid="'.$bid.'"' : '').($cbid ? ' cbid="'.$cbid.'"' : '').'>
						<url>'.$link.'</url>
						<price>'.$price.'</price>
						<currencyId>';
						if ($this->diafan->configmodules('currencyyandex', 'shop', $site_id))
						{
							$text .= $this->prepare($this->diafan->configmodules('currencyyandex', 'shop', $site_id));
						}
						else
						{
							$text .= 'RUR';
						}
					$text .= '</currencyId>';
					if ($this->diafan->configmodules('cat', 'shop', $site_id))
					{
						$text .= '
						<categoryId>'.$row["cat_id"].'</categoryId >';
					}
					if ($picture)
					{
						$text .= '
						<picture>'.$picture.'</picture>';
					}
					$text .= '
						<delivery>true</delivery>
						<name>'.$this->prepare($row["name".$this->diafan->language_base_site]).'</name>';
					if (! empty($yandex["vendor"]))
					{
						$text .= '
						<vendor>'.$yandex["vendor"].'</vendor>';
					}
					if (! empty($yandex["vendorCode"]))
					{
						$text .= '
						<vendorCode>'.$yandex["vendorCode"].'</vendorCode>';
					}
					if ($row["text".$this->diafan->language_base_site])
					{
						$text .= '
						<description>'.$this->prepare($row["text".$this->diafan->language_base_site]).'</description>';
					}
					if (! empty($yandex["country_of_origin"]))
					{
						$text .= '
						<country_of_origin>'.$yandex["country_of_origin"].'</country_of_origin>';
					}
					$text .= '
					</offer>';
				}
				else
				{
					$text .= '
					<offer id="'.$row["id"].'" type="vendor.model" available="true"'.($bid ? ' bid="'.$bid.'"' : '').($cbid ? ' cbid="'.$cbid.'"' : '').'>
						<url>'.$link.'</url>
						<price>'.$price.'</price>
						<currencyId>';
						if ($this->diafan->configmodules('currencyyandex', 'shop', $site_id))
						{
							$text .= $this->prepare($this->diafan->configmodules('currencyyandex', 'shop', $site_id));
						}
						else
						{
							$text .= 'RUR';
						}
					$text .= '</currencyId>';
					if ($this->diafan->configmodules('cat', 'shop', $site_id))
					{
						$text .= '
						<categoryId>'.$row["cat_id"].'</categoryId >';
					}
					if ($picture)
					{
						$text .= '
						<picture>'.$picture.'</picture>';
					}
					$text .= '
						<delivery>true</delivery>';
					$text .= '
						<typePrefix>'.$yandex["typePrefix"].'</typePrefix>
						<vendor>'.$yandex["vendor"].'</vendor>';
					if (! empty($yandex["vendorCode"]))
					{
						$text .= '
						<vendorCode>'.$yandex["vendorCode"].'</vendorCode>';
					}
					$text .= '
						<model>'.$yandex["model"].'</model>';
					if ($row["text".$this->diafan->language_base_site])
					{
						$text .= '
						<description>'.$this->prepare($row["text".$this->diafan->language_base_site]).'</description>';
						$text .= '
						<manufacturer_warranty>'.(! empty($yandex["manufacturer_warranty"]) ? 'true' : 'false').'</manufacturer_warranty>';
					}
					if (! empty($yandex["country_of_origin"]))
					{
						$text .= '
						<country_of_origin>'.$yandex["country_of_origin"].'</country_of_origin>';
					}
					$text .= '
					</offer>';
				}
			}
		}
		$text.='
		</offers>';
		return $text;
	}

	/**
	 * Подготавливает текст для отображения в YML-файле
	 *
	 * @param string $text исходный текст
	 * @return string
	 */
	private function prepare($text)
	{
		$repl = array('&nbsp', '"','&','>','<',"'", chr(0), chr(1), chr(2), chr(3), chr(4),
			      chr(5), chr(6), chr(7), chr(8), chr(11), chr(12), chr(14), chr(15),
			      chr(16), chr(17), chr(18), chr(19), chr(20), chr(21), chr(22), chr(23),
			      chr(24), chr(25), chr(26), chr(27), chr(28), chr(29), chr(30), chr(31));
		$replm = array(' ', '&quot;', '&amp;', '&gt;', '&lt;', '&apos;', '', '', '', '', '',
			       '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '',
			       '', '', '', '', '', '');
		
		$text = str_replace($repl, $replm, strip_tags($text));
		return $text;
	}
}

global $diafan;
$diafan = new Init();
$shy = new Shop_yandex();
