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
 * Theme_functions
 * 
 * Общие шаблонные функции
 */
class Theme_functions
{
	/**
	 * @var object основной объект системы
	 */
	private $diafan;

	/**
	 * @var object представление в пользовательской части
	 */
	private $view;

	/**
	 * Конструктор класса. Определяет свойства класса
	 * 
	 * @return void
	 */
	public function __construct(&$view)
	{
		$this->diafan = &$view->diafan;
		$this->view   = $view;
	}

	/**
	 * Выводит основной контент страницы
	 * 
	 * @return void
	 */
	public function show_body()
	{		
		if ($name = $this->show_h1(array(), false))
		{
			echo '<h1>'.$name.'</h1>';
		}

		if($this->diafan->module == 'shop' && empty($this->diafan->param)){
			if(empty($this->diafan->show) && empty($this->diafan->cat)) echo '<div class="text">';
			$this->show_text();
			if(empty($this->diafan->show) && empty($this->diafan->cat)) echo '</div>';
		} else if($this->diafan->module != 'shop') $this->show_text();
		$this->show_module();
	}
	public function show_bodys()
	{		
		if($this->diafan->module != 'shop'){echo '<div style="padding-top: 20px;clear: both;">'; $this->show_text2(); echo '</div>';}
		//$this->show_module();
	}
	/**
	 * Выводит заголовок страницы
	 * 
	 * @return void
	 */
	public function show_h1($attributes, $print = true)
	{	
		if($this->diafan->module == 'news') return false;
		if($this->diafan->module == 'clauses') return false;
		if($this->diafan->module == 'search') return false;

		if($this->diafan->module == 'shop' && !empty($this->diafan->show))
		{
			if( ! $res = DB::fetch_array(DB::query('SELECT element_id FROM {shop_rel} WHERE rel_element_id = "'.$this->diafan->show.'"')) ) return false;
		}

		if (! $this->diafan->title_no_show)
		{
			if ($this->diafan->titlemodule)
			{
				$name = $this->diafan->titlemodule;
				if ($this->diafan->edit_meta)
				{
					$name = $this->diafan->_useradmin->get($name, 'name', $this->diafan->edit_meta["id"], $this->diafan->edit_meta["table"], _LANG);
				}
			}
			else
			{
				$name = $this->diafan->_useradmin->get($this->diafan->name, 'name', $this->diafan->cid, 'site', _LANG);
			}
			
			if($this->diafan->module == 'shop')
			{
				$name = str_replace('Назначение: ', '', $name);
				$name = str_replace('Материал: ', '', $name);

				if(!empty($this->diafan->cat))
				{
					$isFabric = DB::fetch_array(DB::query('SELECT [name], [name_rus], [name_rus2], parent_id FROM {shop_category} WHERE id = "'.$this->diafan->cat.'" AND parent_id != "0"'));
					if(!$isFabric)
					{
						$h1 = DB::fetch_array(DB::query('SELECT [name_hone] FROM {shop_category} WHERE id = "'.$this->diafan->cat.'"'));
						if(!empty($h1['name_hone'])) $name = $h1['name_hone'];
					} else {
						$subCat = DB::fetch_array(DB::query('SELECT [name_rus] FROM {shop_category} WHERE id = "'.$isFabric['parent_id'].'"'));

						$name = 'Фабрика '.$isFabric['name'].' ('.$subCat['name_rus'].')';
					}
				}
				if(!empty($this->diafan->param))
				{
					if($param_value = DB::fetch_array(DB::query("SELECT param_id, [name] FROM {shop_param_select} WHERE id=%d LIMIT 1", $this->diafan->param)))
					{
						$res = DB::fetch_array(DB::query('SELECT [name_hone] FROM {news} WHERE [name] = "'.$param_value["name"].'" AND site_id = "53"'));
						if(!empty($res['name_hone'])) $name = $res['name_hone'];
					}
				}
			}

			if($print)
			{
				echo $name;
			}
			else
			{
				if($this->diafan->page != ''){
					return $name.' - страница '.$this->diafan->_paginator->page;
				}
				else if(isset($_GET['view']) && $_GET['view']=='all'){
					return $name.' - Все коллекции';
				}
				else{
					return $name;
				}
				
			}
		}
	}

	/**
	 * Выводит текст страницы
	 * 
	 * @return void
	 */
	public function show_text()
	{
		if (! $this->diafan->show && ! $this->diafan->cat && ! $this->diafan->step && empty($_GET["action"]) && $this->diafan->cid != 29)
		{
			$text = $this->diafan->_route->replace_id_to_link($this->diafan->text);
			$text = $this->diafan->_useradmin->get($text, 'text', $this->diafan->cid, 'site', _LANG);
			$this->view->get_function_in_theme($text);
		}
	}
	public function show_text2()
	{
		$fab = DB::fetch_array(DB::query('SELECT text_niz1 FROM {site} WHERE id = "'.(int) $this->diafan->cid.'"'));
		//print_r($fab);
		//print_r($this->diafan);
			$text = $this->diafan->_route->replace_id_to_link($fab['text_niz1']);
			//$text = $this->diafan->_useradmin->get($text, 'text_niz', $this->diafan->cid, 'site', _LANG);
			$this->view->get_function_in_theme($text);
	
	}
	/**
	 * Выводит контент модуля
	 * 
	 * @return void
	 */
	public function show_module()
	{
		$this->view->module->show_module();
	}

	
	
	
	
	
	
	
	/**
	 * Выводит навигации по сайту «Хлебные крошки»
	 * 
	 * @return void
	 */
	public function show_path($attributes)
	{
		if ($this->diafan->id == 1 && ! $this->diafan->path)
		{
			return;
		}
		$attributes = $this->view->get_attributes($attributes, 'separator');

		if ($this->diafan->cid == 1 && ! $this->diafan->cat && ! $this->diafan->show)
			return;

		$separator = $attributes["separator"] ? str_replace('src="/', 'src="'.BASE_PATH, $attributes["separator"]) : '/';

		if ($this->diafan->parent_id)
		{
			$cache_meta = array(
					"name"     => "page",
					"id"       => $this->diafan->cid,
					"lang_id"  => _LANG
				);
			$page = $this->diafan->_cache->get($cache_meta, 'site');
			if (! isset($page["path"]))
			{
				$page["path"] = array();
				$parents = $this->diafan->get_parents($this->diafan->cid, 'site');
				$rparents = array();
				$result = DB::query("SELECT id, [name], parent_id FROM {site} WHERE id IN (%h)", implode(',', $parents));
				while ($row = DB::fetch_array($result))
				{
					$rparents[$row["parent_id"]] = $row;
				}
				$i = 0;
				while(! empty($rparents[$i]))
				{
					$row = $rparents[$i];
					unset($rparents[$i]);
					$i = $row["id"];
					$row["link"] = $this->diafan->_route->link($row["id"]);
					$page["path"][] = $row;
				}
				//сохранение кеша
				$this->diafan->_cache->save($page, $cache_meta, 'site');
			}
		}
		echo '<div class="path">';

		if ($this->diafan->cid != 1 && $this->diafan->module != 'shop')
		{
			echo  '<a href="'.BASE_PATH_HREF.'">'.$this->diafan->_('Главная').'</a> '.$separator.' ';
		}
		if ($this->diafan->parent_id)
		{
			foreach ($page["path"] as $row)
			{
				echo '<a href="'.BASE_PATH_HREF.$row["link"].'">'.$this->diafan->_useradmin->get($row["name"], 'name', $row["id"], 'site', _LANG).'</a> '.$separator.' ';
			}
		}
		if ($this->diafan->path)
		{
			foreach ($this->diafan->path as $path)
			{
				if($path['id'] != 8 && $path['link'] != 'shop/tovary-kollektsiy/')
				{
					if ($this->diafan->path[0] == $path)
					{
						$path["name"] = $this->diafan->_useradmin->get($path["name"], 'name', $this->diafan->cid, 'site', _LANG);
					}
					echo '<a href="'.BASE_PATH_HREF.$path["link"].'">'.$path["name"].'</a> '.$separator.' ';
				}
			}
		}

		if($this->diafan->module == 'shop')
		{ 
			// для магазина дополняем крошки 
			$this->show_sub_path($attributes);
		}

		echo '<span>';
		if(!empty($this->diafan->titlemodule))
		{
			$tm_name = $this->diafan->titlemodule;
			$tm_name = str_replace('Назначение: ', '', $tm_name);
			$tm_name = str_replace('Материал: ', '', $tm_name);
		}

		// echo (!empty($this->diafan->titlemodule) ? $this->diafan->titlemodule : $this->diafan->name);
		echo (!empty($this->diafan->titlemodule) ? $tm_name : $this->diafan->name);
		echo '<a class="back-button" href="javascript:window.history.back();">Вернутся назад</a>';
		echo '</span>';
		echo '</div>';
	}

	public function show_sub_path($attr)
	{
		$separator = $attr["separator"] ? str_replace('src="/', 'src="'.BASE_PATH, $attr["separator"]) : '/';
		
		if($this->diafan->module == 'shop' && $this->diafan->cat != 0)
		{
			if($this->diafan->cat != 8)
			{
				// страна, фабрика, коллекция
				if($this->diafan->show != 0)
				{
					// коллекция
					$fab = DB::fetch_array(DB::query('SELECT c.[name], c.parent_id, r.rewrite FROM {shop_category} c
										LEFT JOIN {rewrite} r ON r.module_name = "shop" AND r.cat_id = c.id
									WHERE c.[act] = "1" AND c.trash = "0" AND c.id = "'.(int) $this->diafan->cat.'"'));
					if($fab['parent_id'] != 0)
					{
						$con = DB::fetch_array(DB::query('SELECT c.[name], r.rewrite FROM {shop_category} c
										LEFT JOIN {rewrite} r ON r.module_name = "shop" AND r.cat_id = c.id
									WHERE c.[act] = "1" AND c.trash = "0" AND c.id = "'.$fab['parent_id'].'"'));

						echo '<a href="/'.$con['rewrite'].'/">'.$con['name'].'</a> '.$separator.' ';
					}
					echo '<a href="/'.$fab['rewrite'].'/">'.$fab['name'].'</a> '.$separator.' ';
				} else {
					// страна, фабрика
					$fab = DB::fetch_array(DB::query('SELECT parent_id FROM {shop_category} WHERE id = "'.(int) $this->diafan->cat.'"'));
					if($fab['parent_id'] != 0)
					{
						$con = DB::fetch_array(DB::query('SELECT c.[name], r.rewrite FROM {shop_category} c
										LEFT JOIN {rewrite} r ON r.module_name = "shop" AND r.cat_id = c.id
									WHERE c.[act] = "1" AND c.trash = "0" AND c.id = "'.$fab['parent_id'].'"'));

						echo '<a href="/'.$con['rewrite'].'/">'.$con['name'].'</a> '.$separator.' ';
					}
				}

			} else if($this->diafan->show != 0 && $this->diafan->cat == 8){
				// элемент коллекции
				$query = DB::query('SELECT s.id, s.[name], s.cat_id, r.rewrite FROM {shop_rel} sr
									LEFT JOIN {shop} s ON s.id = sr.element_id
									LEFT JOIN {rewrite} r ON r.module_name = "shop" AND r.element_id = s.id
								WHERE s.[act] = "1" AND s.trash = "0" AND sr.rel_element_id = "'.(int) $this->diafan->show.'" AND sr.trash = "0" AND s.cat_id != "8"');
				$coll = DB::fetch_array($query);

				if($coll['cat_id'] != 0)
				{
					$fab = DB::fetch_array(DB::query('SELECT c.[name], c.parent_id, r.rewrite FROM {shop_category} c
										LEFT JOIN {rewrite} r ON r.module_name = "shop" AND r.cat_id = c.id
									WHERE c.[act] = "1" AND c.trash = "0" AND c.id = "'.$coll['cat_id'].'"'));

					if($fab['parent_id'] != 0)
					{
						$con = DB::fetch_array(DB::query('SELECT c.[name], r.rewrite FROM {shop_category} c
										LEFT JOIN {rewrite} r ON r.module_name = "shop" AND r.cat_id = c.id
									WHERE c.[act] = "1" AND c.trash = "0" AND c.id = "'.$fab['parent_id'].'"'));
						// show country link
						echo '<a href="/'.$con['rewrite'].'/">'.$con['name'].'</a> '.$separator.' ';
					}

					// show fctory link
					echo '<a href="/'.$fab['rewrite'].'/">'.$fab['name'].'</a> '.$separator.' ';
				}

				// show link collection
				echo '<a href="/'.$coll['rewrite'].'/">'.$coll['name'].'</a> '.$separator.' ';
			}
		}
	}

	/**
	 * Выводит период функционирования сайта в годах
	 * 
	 * @return void
	 */
	public function show_year($attributes)
	{
		$attributes = $this->view->get_attributes($attributes, 'year');
		
		$year = preg_replace('/[^0-9]+/', '', $attributes["year"]);

		echo ($year ? $year : date("Y")).(date("Y") != $year && $year ? ' - '.date("Y").' '.$this->diafan->_('гг.') : ' '.$this->diafan->_('г.'));
	}
	public function show_presto(){
		$periuds=@file_get_contents($_SERVER['DOCUMENT_ROOT']."/modules/presto/admin/periuds.1");
		$text=@file_get_contents($_SERVER['DOCUMENT_ROOT']."/modules/presto/admin/text.html");
		$urls=@file_get_contents($_SERVER['DOCUMENT_ROOT']."/modules/presto/admin/periuds.2");
		$mayarr=unserialize($urls);
		//echo PODSKAZKA_VID;
		//print_r($_COOKIE);
		//print_r($_SERVER);
		if(!is_array($mayarr)){$mayarr="all";}
		if(trim(strip_tags($text))!=""){
				if (in_array($_SERVER['REQUEST_URI'], $mayarr) || $mayarr=="all") {
					if(PODSKAZKA_VID=="YES"){
						echo '<div class="bomber"><div id="close-help2" class="sess"></div>'.$text.'</div>';
						}
					}
			}
		}
	
	public function show_inders_linck(){
		if(count($_SESSION['mania'])>0){
			echo '<div class="portermes"><a href="/inair/" rel="nofollow">Просмотренные коллекции</a></div>';
		}
	}
	
	public function show_inders(){
		echo '<div class="path"><a href="/"><span class="useradmin_contener" >Главная</span></a> &#9658; <span>Просмотренные коллекции<a class="back-button" href="javascript:window.history.back();">Вернутся назад</a></span></div><br><br>';
		//print_r($_SESSION);
		$asss=array();
		if(count($_SESSION['mania'])>0){
			for($i=0;$i<count($_SESSION['mania']);$i++){
			if(!in_array($_SESSION['mania'][$i]['id'],$asss)){
			$asss[]=$_SESSION['mania'][$i]['id'];
			$urldop=explode("/",$_SESSION['mania'][$i]['factory_url']);
				echo '
				<div class="slider2">
				<div class="photo_on_main_full">
					<div class="photoslider'.$i.' ps-full">';
						if(count($_SESSION['mania'][$i]['img'])>0){
						echo "<ul>";
							for($is=0;$is<count($_SESSION['mania'][$i]['img']);$is++){
								echo '
									<li>
										<div class="slider1_img" style="position:relative">
											<div class="slider1_img_best_price"></div>
											<a href="'.$_SESSION['mania'][$i]['factory_url'].'">
												<img src="'.$_SESSION['mania'][$i]['img'][$is].'" alt="'.strip_tags($_SESSION['mania'][$i]['name']).'" />
											</a>
										</div>
									</li>';
							}
						echo "</ul>";
						}
					
					echo '</div>
				</div>
				<div class="slider1_img_money2 tmp1">от '.$_SESSION['mania'][$i]['prise'].' руб/м2</div>
					<div class="slider1_t">
						<a href="'.$_SESSION['mania'][$i]['factory_url'].'">
							'.$_SESSION['mania'][$i]['name'].'
						</a>
						<span class="slider1_span1">
							<a href="/'.$urldop[1].'/'.$urldop[2].'/">'.$_SESSION['mania'][$i]['factory'].'</a>
						</span>
						<span class="slider1_span2">(Плитка '.$_SESSION['mania'][$i]['country_rus'].')</span>
				</div>
			</div>
				
				';
			}
			
			}
			
		}else{
			echo ' <br><br><br><center><h3>Вы еще не смотрели ни одной колекции.</h3></center>';
		
		}
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	/**
	 * Выводит заголовок. Используется между тегами <title></title> в шапке сайта
	 * 
	 * @return void
	 */
	public function show_title()
	{
		if($this->diafan->module == 'shop' && !empty($this->diafan->param))
		{
			if($param_value = DB::fetch_array(DB::query("SELECT param_id, [name] FROM {shop_param_select} WHERE id=%d LIMIT 1", $this->diafan->param)))
			{
				if($res = DB::fetch_array(DB::query('SELECT [title_meta] FROM {news} WHERE [name] = "'.$param_value["name"].'" AND site_id = "53"')))
				{
					if(!empty($res['title_meta']))
					{
						
						if($this->diafan->page > 1)
						{
							echo $param_value["name"].' в салон-магазине «ПЛИТКА & СТУПЕНИ» — Страница '.$this->diafan->page;
						} else echo $res['title_meta'].($this->diafan->page > 1 ? ' — Страница '.$this->diafan->page : '');
						return;
					}
				}
			}
		}

		if($this->diafan->module == 'shop' && !empty($this->diafan->show))
		{
			$res = DB::fetch_array(DB::query('SELECT cat_id, [name], [name_rus] FROM {shop} WHERE id = "'.$this->diafan->show.'" AND cat_id != "8"'));
			if($res)
			{
				$fab = DB::fetch_array(DB::query('SELECT [name], [name_rus], [name_rus2], parent_id FROM {shop_category} WHERE id = "'.$res['cat_id'].'" AND parent_id != "0"'));
				$con = DB::fetch_array(DB::query('SELECT [name], [name_rus], [name_rus2] FROM {shop_category} WHERE id = "'.$fab['parent_id'].'"'));
				
				echo 'Коллекция плитки '.$res['name'].' ('.$res['name_rus'].') '.$con['name_rus2'].' фабрики '.$fab['name'].' ('.$fab['name_rus'].', '.$con['name_rus'].').';
				return;
			}
		}

		if($this->diafan->module == 'shop' && !empty($this->diafan->cat))
		{
			$isFabric = DB::fetch_array(DB::query('SELECT [name], [name_rus], [name_rus2], parent_id FROM {shop_category} WHERE id = "'.$this->diafan->cat.'" AND parent_id != "0"'));
			if($isFabric)
			{
				$subCat = DB::fetch_array(DB::query('SELECT [name], [name_rus], [name_rus2] FROM {shop_category} WHERE id = "'.$isFabric['parent_id'].'"'));

				echo 'Фабрика '.$isFabric['name'].' ('.$isFabric['name_rus'].'): '.$subCat['name_rus2'].' плитка '.$isFabric['name'].' - цена, размеры и широкий ассортимент.';
				return;
			}
		}

		if($this->diafan->module == 'shop' && !empty($this->diafan->cat) && $this->diafan->page > 1)
		{
			$isCountry = DB::fetch_array(DB::query('SELECT [name], [name_rus], [name_rus2] FROM {shop_category} WHERE id = "'.$this->diafan->cat.'" AND parent_id = "0"'));
			if($isCountry)
			{
				echo 'Керамическая '.strtolower($isCountry['name']).' в салон-магазине «ПЛИТКА & СТУПЕНИ» — страница '.$this->diafan->page;
				return;
			}
		}

		if ($this->diafan->titlemodule_meta)
		{
			echo $this->diafan->titlemodule_meta;
			return true;
		}
		elseif ($this->diafan->title_meta)
		{
			echo ($this->diafan->titlemodule ? $this->diafan->titlemodule.' — ' : '').$this->diafan->title_meta;
			return;
		}
		echo ($this->diafan->titlemodule ? $this->diafan->titlemodule.' — ' : '').$this->diafan->name.(TITLE ? ' — '.TITLE : '');
	}
	
	public function mb_ucfirst($text)
	{
		return mb_strtoupper(mb_substr($text, 0, 1, 'UTF-8'), 'UTF-8') . mb_strtolower(mb_substr($text, 1), 'UTF-8');
	}

	/**
	 * Выводит мета-тег description страницы
	 * 
	 * @return void
	 */
	public function show_description()
	{
		if($this->diafan->module == 'shop' && !empty($this->diafan->param))
		{
			if($param_value = DB::fetch_array(DB::query("SELECT param_id, [name] FROM {shop_param_select} WHERE id=%d LIMIT 1", $this->diafan->param)))
			{
				if($res = DB::fetch_array(DB::query('SELECT [descr] FROM {news} WHERE [name] = "'.$param_value["name"].'" AND site_id = "53"')))
				{
					if(!empty($res['descr']))
					{
						echo $res['descr'];
						return;
					}
				}
			}
		}

		if($this->diafan->module == 'shop' && !empty($this->diafan->show))
		{
			$res = DB::fetch_array(DB::query('SELECT cat_id, [name], [name_rus] FROM {shop} WHERE id = "'.$this->diafan->show.'" AND cat_id != "8"'));
			if($res)
			{
				$fab = DB::fetch_array(DB::query('SELECT [name], [name_rus], [name_rus2], parent_id FROM {shop_category} WHERE id = "'.$res['cat_id'].'" AND parent_id != "0"'));
				$con = DB::fetch_array(DB::query('SELECT [name], [name_rus], [name_rus2] FROM {shop_category} WHERE id = "'.$fab['parent_id'].'"'));

				echo 'Плитка '.$res['name'].' фабрики '.$fab['name'].' продажа в Москве. '.$this->mb_ucfirst($con['name_rus2']).' коллекция '.$res['name'].' '.$fab['name'].' - цена в каталоге. Плитка '.$res['name_rus'].' '.$fab['name_rus'].' ('.$con['name_rus'].') онлайн.';
				return;
			}
		}

		if($this->diafan->module == 'shop' && !empty($this->diafan->cat))
		{
			$isFabric = DB::fetch_array(DB::query('SELECT [name], [name_rus], [name_rus2], parent_id FROM {shop_category} WHERE id = "'.$this->diafan->cat.'" AND parent_id != "0"'));
			if($isFabric)
			{
				$subCat = DB::fetch_array(DB::query('SELECT [name], [name_rus], [name_rus2] FROM {shop_category} WHERE id = "'.$isFabric['parent_id'].'"'));

				echo 'Фабрика '.$isFabric['name'].' '.$subCat['name_rus'].': популярные коллекции на сайте ПЛИТКА&СТУПЕНИ. '. $this->mb_ucfirst($subCat['name_rus2']) .' плитка '.$isFabric['name'].' - цена в каталоге. Купить плитку '.$isFabric['name_rus'].' в Москве.';
				return;
			}
		}

		if ($this->diafan->edit_meta)
		{
			$link = $this->diafan->_useradmin->get_meta('descr', $this->diafan->edit_meta["id"], $this->diafan->edit_meta["table"], _LANG);
		}
		else
		{
			$link = $this->diafan->_useradmin->get_meta('descr', $this->diafan->cid, 'site', _LANG);
		}
		echo $this->diafan->descr.($link ? '" useradmin="'.$link : '');
	}

	/**
	 * Выводит ключевые слова страницы. Используется для мета-тега keywords
	 * 
	 * @return void
	 */
	public function show_keywords()
	{
		if($this->diafan->module == 'shop' && !empty($this->diafan->param))
		{
			if($param_value = DB::fetch_array(DB::query("SELECT param_id, [name] FROM {shop_param_select} WHERE id=%d LIMIT 1", $this->diafan->param)))
			{
				if($res = DB::fetch_array(DB::query('SELECT [keywords] FROM {news} WHERE [name] = "'.$param_value["name"].'" AND site_id = "53"')))
				{
					if(!empty($res['keywords']))
					{
						echo $res['keywords'];
						return;
					}
				}
			}
		}

		if($this->diafan->module == 'shop' && !empty($this->diafan->show))
		{
			$res = DB::fetch_array(DB::query('SELECT cat_id, [name], [name_rus] FROM {shop} WHERE id = "'.$this->diafan->show.'" AND cat_id != "8"'));
			if($res)
			{
				$fab = DB::fetch_array(DB::query('SELECT [name], [name_rus], [name_rus2], parent_id FROM {shop_category} WHERE id = "'.$res['cat_id'].'" AND parent_id != "0"'));
				$con = DB::fetch_array(DB::query('SELECT [name], [name_rus], [name_rus2] FROM {shop_category} WHERE id = "'.$fab['parent_id'].'"'));
				
				echo $con['name_rus2'].', '.$con['name_rus'].', '.$fab['name'].', '.$fab['name_rus'].', '.$res['name'].', '.$res['name_rus'].', продажа, опт, розница, цена, стоимость';
				return;
			}
		}

		if($this->diafan->module == 'shop' && !empty($this->diafan->cat))
		{
			$isFabric = DB::fetch_array(DB::query('SELECT [name], [name_rus], [name_rus2], parent_id FROM {shop_category} WHERE id = "'.$this->diafan->cat.'" AND parent_id != "0"'));
			if($isFabric)
			{
				$subCat = DB::fetch_array(DB::query('SELECT [name], [name_rus], [name_rus2] FROM {shop_category} WHERE id = "'.$isFabric['parent_id'].'"'));

				echo $isFabric['name'].', '.$isFabric['name_rus'].', '.$subCat['name_rus'].', продажа, опт, розница, цена, стоимость, керамогранит, мозаика, клинкер, клинерная плитка, производитель, завод, фабрика';
				return;
			}
		}

		if ($this->diafan->edit_meta)
		{
			$link = $this->diafan->_useradmin->get_meta('keywords', $this->diafan->edit_meta["id"], $this->diafan->edit_meta["table"], _LANG);
		}
		else
		{
			$link = $this->diafan->_useradmin->get_meta('keywords', $this->diafan->cid, 'site', _LANG);
		}
		echo $this->diafan->keywords.($link ? '" useradmin="'.$link : '');
	}

	/**
	 * Выводит JS код запрещающий копирование контента на сайте
	 * 
	 * @return void
	 */
	public function show_protect()
	{
		if (! $this->diafan->configmodules('protect', 'site'))
			return;
		echo ' oncopy="return false"';
	}

	/**
	 * Подключает JS-библиотеки
	 * 
	 * @return void
	 */
	public function show_js()
	{    
		echo '<script type="text/javascript" src="http://yandex.st/jquery/1.7.1/jquery.min.js" charset="UTF-8"></script>
		<script type="text/javascript" src="http://yandex.st/jquery/form/2.83/jquery.form.min.js" charset="UTF-8"></script>';
                   
		echo '<script type="text/javascript" src="'.BASE_PATH.'js/jquery.tooltip.min.js" charset="UTF-8"></script>
		<link href="'.BASE_PATH.'css/jquery.tooltip.css" rel="stylesheet" type="text/css">
		    
		<script type="text/javascript" src="//code.jquery.com/ui/1.10.3/jquery-ui.js" charset="UTF-8"></script>
		<script type="text/javascript" src="'.BASE_PATH.'js/timepicker.js" charset="UTF-8"></script>
		<link href="'.BASE_PATH.'css/ui-lightness/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css">
		    
		<script type="text/javascript" src="'.BASE_PATH.'js/user-func.js" charset="UTF-8"></script>';

		if (USERADMIN && $this->diafan->_user->roles('edit', 'useradmin', '', 'site'))
		{
			echo '<script type="text/javascript" src="http://yandex.st/jquery/cookie/1.0/jquery.cookie.min.js" charset="UTF-8"></script>';
			echo '
			<script type="text/javascript" src="'.BASE_PATH.'modules/useradmin/useradmin.js" charset="UTF-8"></script>
			<script type="text/javascript">
				var useradmin_path = "'.BASE_PATH.ADMIN_FOLDER.'/";
				var base_path = "'.BASE_PATH.'";
			</script>
			<link href="'.BASE_PATH.'modules/useradmin/useradmin.css" rel="stylesheet" type="text/css">';
		}

		if ($this->diafan->configmodules('use_animation') || $this->diafan->configmodules('use_animation', 'site') || USERADMIN)
		{
			echo '
			<script src="'.BASE_PATH.'js/jquery.prettyPhoto.js" type="text/javascript" charset="UTF-8"></script>
			<link rel="stylesheet" href="'.BASE_PATH.'css/prettyPhoto.css" type="text/css" media="screen"'
			.' title="prettyPhoto main stylesheet" charset="utf-8">';
		}

		if(!empty($this->diafan->js))
		{
		    echo $this->diafan->js;
		}

		echo "\n".'<meta name="robots" content="';
		if($this->diafan->noindex)
		{
			echo 'noindex';
		}
		else
		{
			echo 'all';
		}
		echo '">';
		
		if(RECAPTCHA)
		{
			echo '<script type="text/javascript" src="http://www.google.com/recaptcha/api/js/recaptcha_ajax.js"></script>
			<script type="text/javascript">
			var create_recaptcha = function (element_id)
			{
				$(".recaptcha_show").show();
				$("#"+element_id).next(".recaptcha_show").hide();
				Recaptcha.create("'.RECAPTCHA_PUBLIC_KEY.'", element_id, {theme : "clean"});
			}
			</script>
';
		}
	}

	/**
	 * Выводит ссылку на страницу сайта. Если текущая страница соответствует адресу, на которую ведет ссылка, то ссылка становится неактивной
	 * 
	 * @return void
	 */
	public function show_href($a)
	{
		if(in_array($this->diafan->theme, array('404.php', '503.php', '403.php')))
		{
			$this->diafan->rewrite = $this->diafan->theme;
		}
		$a = $this->view->get_attributes($a, 'rewrite', 'img', 'img_act', 'width', 'height', 'alt', 'alt'._LANG);
		
		$rewrite = $a["rewrite"];
		if ($this->diafan->rewrite != $rewrite)
		{
			if(! DB::query_result("SELECT s.id FROM {site} AS s INNER JOIN {rewrite} AS r ON s.id=r.site_id AND r.module_name='site' WHERE r.rewrite='%h' AND r.trash='0' AND s.[act]='1' AND s.trash='0'", $rewrite))
			{
				return;
			}
		}

		$img = ($this->diafan->rewrite != $rewrite || ! $a["img_act"]
		       ? preg_replace('/[^A-Za-z0-9-_\/\.]+/', '', $a["img"])
		       : preg_replace('/[^A-Za-z0-9-_\/\.]+/', '', $a["img_act"])
		       );
		
		$width = preg_replace('/[^0-9]+/', '', $a["width"]);
		$height = preg_replace('/[^0-9]+/', '', $a["height"]);
		
		$name = ($a["alt"] == "title"
			? TITLE
			: ($a["alt"] == "url"
			  ? BASE_PATH
			  : $this->diafan->get_param($a, "alt".($a["alt"._LANG] ? _LANG : ''), '', 1)
			  )
			);
		
		if ($this->diafan->rewrite != $rewrite || $this->diafan->show || $this->diafan->cat)
		{
			echo '<a href="'.BASE_PATH_HREF.($rewrite ? $rewrite.ROUTE_END : '').'">';
		}
		if ($img)
		{
			echo '<img src="'.BASE_PATH.$img.'" alt="'.$name.'"'.($width ? ' width="'.$width.'"' : '').($height ? ' height="'.$height.'"' : '').'>';
		}
		else
		{
			echo $name;
		}
		if ($this->diafan->rewrite != $rewrite || $this->diafan->show || $this->diafan->cat)
		{
			echo '</a>';
		}
	}

	/**
	 * Выводит ссылки на социальные сети
	 * 
	 * @return void
	 */
	public function show_social_links()
	{
		echo '
		<br><br>
		<script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
		<div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="button" data-yashareQuickServices="yaru,vkontakte,facebook,twitter,odnoklassniki,moimir"></div> ';
	}

	/**
	 * Подключает файл-блок шаблона
	 *
	 * @param array $attributes атрибуты шаблонного тега
	 * @return void
	 */
	public function show_include($attributes)
	{
		$attributes = str_replace('/[^a-z_0-9]+/', '', $this->view->get_attributes($attributes, 'file'));

		$inc = file_get_contents(ABSOLUTE_PATH.'themes/blocks/'.$attributes["file"].'.php');

		$this->view->get_function_in_theme($inc);
	}



	public function show_factorys($attributes)
	{
		
		echo '<div class="container">';
				// countries ----------------------------------------------------------------------------------
				$query = DB::query('SELECT id, [name], parent_id FROM {shop_category} WHERE [act] = "1" AND trash = "0" AND parent_id = "0" AND id != "8" ORDER BY sort ASC');
				$count = DB::num_rows($query);
				$sb2_rez['countries'] = array();
				if($count > 0)
				{
					while($countries = DB::fetch_array($query))
					{
						$sb2_rez['countries'][] = $countries;
						$query1 = DB::query('SELECT id, [name], parent_id FROM {shop_category} WHERE [act] = "1" AND trash = "0" AND parent_id = "'.$countries['id'].'" AND id != "8" ORDER BY [name] ASC');
						$count1 = DB::num_rows($query1);
						if($count1 > 0)
						{
							while($factory = DB::fetch_array($query1))
							{
								$sb2_rez['countries'][] = $factory;
							}
						}
					}
				}
				// --------------------------------------------------------------------------------------------
				$subSizeArr = array();
				foreach($sb2_rez as $key => $part)
				{
					if(count($part) > 0)
					{
						echo '<noindex><div class="popup-container-box tmp1">';
							$columns = 4;

							echo '<div style="width: 680px;">';
							
							$elem_per_colmn = intval(count($part) / $columns);
							if(count($part) % $columns != 0) $elem_per_colmn++;
							
							for($i = 0; $i < $columns; $i++)
							{
								$tmpArr = array_slice($part, $i*$elem_per_colmn, $elem_per_colmn);
								echo '<div class="box_column">';
								foreach($tmpArr as $element)
								{
									echo '<div class="menu_right_bg_box_1_zakl_1'.(isset($element['parent_id']) && $element['parent_id'] == 0 ? ' red_box' : ' after_red_box').'">';
									echo '<span class="menu_right_bg_box_1_zakl_1_span2"><span><a href="/'.$this->diafan->_route->link(29, 'shop', $element['id']).'" rel="nofollow">'.$element['name'].'</a></span></span>';
									//'.$element['id'].'
									$query_collections = DB::query('SELECT * FROM {shop} WHERE cat_id = "'.$element['id'].'" AND trash="0" AND act1="1" ORDER BY sort ASC');
									$count_collections = DB::num_rows($query_collections);
									if($count_collections > 0)
									{
										while($countries_collections = DB::fetch_array($query_collections))
										{
											echo"<div style='width:100%; height:1px; display: inline-block;'></div>";
											echo"<span class='collection_element'>".$countries_collections["name1"]."_".$countries_collections["id"]."</span>";
								
											
										}
									}
									
									
									echo '</div>';
								}
								echo '</div>';
							}
							echo '</div>';

						echo '</div></noindex>';
					}
				}
		echo '</div>';
	}






	public function show_popup_factorys($attributes)
	{
		echo '<div class="popup-container">';
				// countries ----------------------------------------------------------------------------------
				$query = DB::query('SELECT id, [name], parent_id FROM {shop_category} WHERE [act] = "1" AND trash = "0" AND parent_id = "0" AND id != "8" ORDER BY sort ASC');
				$count = DB::num_rows($query);
				$sb2_rez['countries'] = array();
				if($count > 0)
				{
					while($countries = DB::fetch_array($query))
					{
						$sb2_rez['countries'][] = $countries;
						$query1 = DB::query('SELECT id, [name], parent_id FROM {shop_category} WHERE [act] = "1" AND trash = "0" AND parent_id = "'.$countries['id'].'" AND id != "8" ORDER BY [name] ASC');
						$count1 = DB::num_rows($query1);
						if($count1 > 0)
						{
							while($factory = DB::fetch_array($query1))
							{
								$sb2_rez['countries'][] = $factory;
							}
						}
					}
				}
				// --------------------------------------------------------------------------------------------
				$subSizeArr = array();
				foreach($sb2_rez as $key => $part)
				{
					if(count($part) > 0)
					{
						echo '<noindex><div class="popup-container-box tmp1">';
							$columns = 4;

							echo '<div style="width: 680px;">';
							
							$elem_per_colmn = intval(count($part) / $columns);
							if(count($part) % $columns != 0) $elem_per_colmn++;
							
							for($i = 0; $i < $columns; $i++)
							{
								$tmpArr = array_slice($part, $i*$elem_per_colmn, $elem_per_colmn);
								echo '<div class="box_column">';
								foreach($tmpArr as $element)
								{
									echo '<div class="menu_right_bg_box_1_zakl_1'.(isset($element['parent_id']) && $element['parent_id'] == 0 ? ' red_box' : ' after_red_box').'">';
									echo '<span class="menu_right_bg_box_1_zakl_1_span2"><span><a href="/'.$this->diafan->_route->link(29, 'shop', $element['id']).'" rel="nofollow">'.$element['name'].'</a></span></span>';
									echo '</div>';
								}
								echo '</div>';
							}
							echo '</div>';

						echo '</div></noindex>';
					}
				}
		echo '</div>';
	}

	public function show_search_by($attributes)
	{
		echo '<div class="menuslid">';
		echo '<ul>';
		echo '<li><a href="javascript:openElemMS(\'usefor\')" class="ms-tab usefor">Плитка по назначению</a></li>';
		echo '<li><a href="javascript:openElemMS(\'materials\')" class="ms-tab materials">Плитка по материалу</a></li>';
		echo '<li><a href="javascript:openElemMS(\'countries\')" class="ms-tab countries">Плитка по странам</a></li>';
		echo '<li class="fabrics-all"><a href="#">Все фабрики</a></li>';
		echo '</ul>';
		echo '</div>';
		echo "
			<script type=\"text/javascript\">
			function openElemMS(id)
			{
				// open if close ----------------
				var isOpen = $('a.reset');
				var isOpenStatus = $.trim(isOpen.attr('class').replace('reset', ''));
				if(isOpenStatus == 'ok') $('a.reset').trigger('click');
				// ------------------------------
				
				$('.ms-tab').each(function(){ $(this).removeClass('selected'); });
				$('.' + id).addClass('selected');

				if(id == 'usefor') $('#' + id).css('display', 'block');
				else $('#usefor').css('display', 'none');
				if(id == 'materials') $('#' + id).css('display', 'block');
				else $('#materials').css('display', 'none');
				if(id == 'countries') $('#' + id).css('display', 'block');
				else $('#countries').css('display', 'none');
			}
			function closeAllMS()
			{
				$('#usefor').css('display', 'none');
				$('#materials').css('display', 'none');
				$('#countries').css('display', 'none');
			}
			</script>
		";
		
		// ----------------------------------------------------------------------------------------------------------------

		echo '<div class="menuslid2" id="usefor" style="display: block;">';
		$param = DB::query('SELECT ps.[name], r.rewrite FROM {shop_param_select} ps
										LEFT JOIN {rewrite} r ON r.module_name = "shop" AND r.param_id = ps.id
									WHERE ps.param_id = "2" AND ps.act = "1" AND ps.trash = "0" ORDER BY ps.sort ASC');
		$count = DB::num_rows($param);
		if($count > 0)
		{
			unset($i); $i = 1;
			while($val = DB::fetch_array($param))
			{
				if($i == 1) echo '<ul class="menuslid2_ul_1">';
				if($i == 5) echo '</ul><ul class="menuslid2_ul_1">';
				
				if($val['name'] != '#empty') echo '<li><a href="/'.$val['rewrite'].'/">'.$val['name'].'</a></li>';
				else echo '<li></li>';

				if($i != 4 && $i % 4 == 0) echo '</ul><ul class="menuslid2_ul_1">';

				if($i == $count) echo '</ul>';

				$i++;
			}
			echo '</div>';
		}
		
		// ----------------------------------------------------------------------------------------------------------------

		echo '<div class="menuslid2" id="materials" style="display: none;">';
		$param = DB::query('SELECT ps.[name], r.rewrite FROM {shop_param_select} ps
										LEFT JOIN {rewrite} r ON r.module_name = "shop" AND r.param_id = ps.id
									WHERE ps.param_id = "3" AND ps.act = "1" AND ps.trash = "0" ORDER BY ps.sort ASC');
		$count = DB::num_rows($param);
		if($count > 0)
		{
			unset($i); $i = 1;
			while($val = DB::fetch_array($param))
			{
				if($i == 1) echo '<ul class="menuslid2_ul_1">';
				if($i == 5) echo '</ul><ul class="menuslid2_ul_1">';
					
				if($val['name'] != '#empty') echo '<li><a href="/'.$val['rewrite'].'/">'.$val['name'].'</a></li>';
				else echo '<li></li>';

				if($i != 4 && $i % 4 == 0) echo '</ul><ul class="menuslid2_ul_1">';

				if($i == $count) echo '</ul>';

				$i++;
			}
			echo '</div>';
		}

		// ----------------------------------------------------------------------------------------------------------------

		echo '<div class="menuslid2" id="countries" style="display: none;">';
		$param = DB::query('SELECT c.[name], r.rewrite FROM {shop_category} c
										LEFT JOIN {rewrite} r ON r.module_name = "shop" AND r.cat_id = c.id
									WHERE c.[act] = "1" AND c.trash = "0" AND c.parent_id = "0" AND c.id != "8" ORDER BY c.sort ASC');
		$count = DB::num_rows($param);
		if($count > 0)
		{
			unset($i); $i = 1;
			while($val = DB::fetch_array($param))
			{
				if($i == 1) echo '<ul class="menuslid2_ul_1">';
				if($i == 5) echo '</ul><ul class="menuslid2_ul_1">';
					
				echo '<li><a href="/'.$val['rewrite'].'/">'.$val['name'].'</a></li>';

				if($i != 4 && $i % 4 == 0) echo '</ul><ul class="menuslid2_ul_1">';

				if($i == $count) echo '</ul>';

				$i++;
			}
			echo '</div>';
		}
	}

	public function show_popular_fabric($attributes)
	{
		$query = DB::query('SELECT sc.id, sc.[name], sc.site_id, r.rewrite AS link, i.name AS img FROM {shop_category} sc
									LEFT JOIN {rewrite} r ON r.module_name = "shop" AND r.cat_id = sc.id
									LEFT JOIN {images} i ON i.module_name = "shopcat"
								WHERE sc.parent_id != "0" AND sc.[act] = "1" AND sc.trash = "0" AND i.element_id = sc.id ORDER BY RAND() LIMIT 0, 16');
		$count = DB::num_rows($query);
		
		if($count > 0)
		{
			$sb_pmf = array();
			while($element = DB::fetch_array($query))
			{
				$sb_pmf[] = $element;
			}

			echo '<div class="best">';
				
			if(count($sb_pmf) > 3){
				$lines = intval(count($sb_pmf) / 4);
				if(count($sb_pmf) % 4 != 0) $lines++;

				for($i = 0; $i < $lines; $i++)
				{
					$elements = array_slice($sb_pmf, $i*4, 4);
					if(count($elements) < 3){
						$addLast = 4 - count($elements);
						for($j = 0; $j < count($elements); $j++)
						{
							$imSize = getimagesize(BASE_PATH_HREF.'/userfiles/shop/fabric_list/'.$elements[$j]['img']);
							echo '<div class="best_box best_box3">';
							echo '<a href="'.BASE_PATH_HREF.$elements[$j]['link'].'"><img src="'.BASE_PATH_HREF.'/userfiles/shop/fabric_list/'.$elements[$j]['img'].'"  alt="'.$elements[$j]['name'].'"'.($imSize[1] < 40 ? 'style="margin-bottom: '.(40 - $imSize[1]).'px;"' : '').' /></a>';
							echo '<a href="'.BASE_PATH_HREF.$elements[$j]['link'].'">'.$elements[$j]['name'].'</a>';
							echo '</div>';
						}
						for($n = 0; $n < $addLast; $n++)
						{
							echo '<div class="best_box '.($n == $addLast - 1 ? 'best_box2 ' : '').'best_box3">';
							echo '</div>';
						}
					} else {
						for($j = 0; $j < count($elements); $j++)
						{
							$imSize = getimagesize(BASE_PATH_HREF.'/userfiles/shop/fabric_list/'.$elements[$j]['img']);
							echo '<div class="best_box'.($j == count($elements) - 1 ? ' best_box2' : '').'">';
							echo '<a href="'.BASE_PATH_HREF.$elements[$j]['link'].'"><img src="'.BASE_PATH_HREF.'/userfiles/shop/fabric_list/'.$elements[$j]['img'].'"  alt="'.$elements[$j]['name'].'"'.($imSize[1] < 40 ? 'style="margin-bottom: '.(40 - $imSize[1]).'px;"' : '').' /></a>';
							echo '<a href="'.BASE_PATH_HREF.$elements[$j]['link'].'">'.$elements[$j]['name'].'</a>';
							echo '</div>';
						}
					}
				}
			} else {
				$addLast = 4 - count($sb_pmf);
				for($i = 0; $i < count($sb_pmf); $i++)
				{
					$imSize = getimagesize(BASE_PATH_HREF.'/userfiles/shop/fabric_list/'.$sb_pmf[$i]['img']);
					echo '<div class="best_box best_box3">';
					echo '<a href="'.BASE_PATH_HREF.$sb_pmf[$i]['link'].'"><img src="'.BASE_PATH_HREF.'/userfiles/shop/fabric_list/'.$sb_pmf[$i]['img'].'"  alt="'.$sb_pmf[$i]['name'].'"'.($imSize[1] < 40 ? 'style="margin-bottom: '.(40 - $imSize[1]).'px;"' : '').' /></a>';
					echo '<a href="'.BASE_PATH_HREF.$sb_pmf[$i]['link'].'">'.$sb_pmf[$i]['name'].'</a>';
					echo '</div>';
				}
				for($j = 0; $j < $addLast; $j++)
				{
					echo '<div class="best_box '.($j == $addLast - 1 ? 'best_box2 ' : '').'best_box3">';
					echo '</div>';
				}
			}
			echo '<br clear="both">';
			echo '</div>';
		}
	}

	public function show_new_and_actions($attributes)
	{
		$query = DB::query('SELECT s.*, r.rewrite AS link FROM {shop} s
										LEFT JOIN {rewrite} r ON r.module_name = "shop"
										LEFT JOIN {shop_discount_object} d ON d.good_id = s.id
									WHERE (d.discount_id > 0 OR s.action = "1") AND r.element_id = s.id AND s.[act] = "1" AND s.trash = "0" AND s.cat_id != "8" ORDER BY s.[name] LIMIT 0, 15');
		$count = DB::num_rows($query);

		if($count > 0)
		{
			echo '<div class="slider1">';
				echo '<div class="photo_on_main">';
					echo '<div class="photoslider">';
						echo '<ul>';
						unset($i); $i = 1;
						while($coll = DB::fetch_array($query))
						{
							echo '<li>';
							# print_r($coll);
							echo '<div class="slider1_img">';
								$images = $this->diafan->_images->get("cl-165", $coll['id'], "shop", $coll['site_id'], $coll['name1'], false);
								if(!empty($images[0])) echo '<a href="'.$coll['link'].'/"><img src="'.$images[0]['src'].'" alt="'.$coll['name1'].'" /></a>';
								
								$isDiscount = DB::fetch_array(DB::query('SELECT do.discount_id, d.discount FROM {shop_discount_object} do
																				LEFT JOIN {shop_discount} d ON d.id = do.discount_id
																			WHERE do.good_id = "'.$coll['id'].'" AND d.trash = "0" AND d.date_finish < "'.time().'"'));

								# if($coll['new'] == 1 && $coll['action'] != 1) echo '<div class="slider1_img_sale">NEW</div>';
								if($isDiscount){ echo '<div class="slider1_img_sale2">-'.$isDiscount['discount'].'%</div>';}
								else { echo '<div class="slider1_img_best_price"></div>';}
								// {PRICE}
								// генерируем из под товаров, берем минимальную цену
								$ges = DB::fetch_array(DB::query('SELECT * FROM {shop_param_element} WHERE element_id = "'.$coll['id'].'" AND param_id = "8"'));
								if(!$ges)
								{
									$price = DB::fetch_array(DB::query('SELECT MIN(sp.price) AS price FROM {shop_rel} sr
																			LEFT JOIN {shop_price} sp ON sp.good_id = sr.rel_element_id
																			LEFT JOIN {shop_param_element} spe ON spe.element_id = sr.rel_element_id AND spe.param_id = "5"
																		WHERE spe.value1 = "м2" AND sr.element_id = "'.$coll['id'].'"'));
									if(empty($price['price'])){
										$price = DB::fetch_array(DB::query('SELECT MIN(sp.price) AS price FROM {shop_rel} sr
																			LEFT JOIN {shop_price} sp ON sp.good_id = sr.rel_element_id
																			LEFT JOIN {shop_param_element} spe ON spe.element_id = sr.rel_element_id AND spe.param_id = "5"
																		WHERE spe.value1 = "шт" AND sr.element_id = "'.$coll['id'].'"'));
										$size = 'руб/шт';
										if(empty($price['price']))
										{
											$price = DB::fetch_array(DB::query('SELECT MIN(sp.price) AS price FROM {shop_rel} sr
																			LEFT JOIN {shop_price} sp ON sp.good_id = sr.rel_element_id
																		WHERE sr.element_id = "'.$coll['id'].'"'));
											$size = 'руб/м2';
										}
									} else $size = 'руб/м2';
								} else {
									$price['price'] = $ges['value1'];
									$ges = DB::fetch_array(DB::query('SELECT * FROM {shop_param_element} WHERE element_id = "'.$coll['id'].'" AND param_id = "9"'));
									$size = 'руб/'.$ges['value1'];
								}

								# if(!empty($isDiscount)) $price['price'] = intval($price['price'] - ($price['price'] / 100)*$isDiscount['discount']);

								echo '<div class="slider1_img_money">от '.intval($price['price']).' '.$size.'</div>';
							echo '</div>';
							echo '<div class="slider1_t">';
								$categorys = DB::fetch_array(DB::query('SELECT c1.name1 AS factory, c2.name1 AS country, r1.rewrite AS factory_url, r2.rewrite AS country_url FROM {shop_category} c1
														LEFT JOIN {shop_category} c2 ON c2.id = c1.parent_id
														LEFT JOIN {rewrite} r1 ON r1.module_name = "shop" AND r1.cat_id = c1.id
														LEFT JOIN {rewrite} r2 ON r2.module_name = "shop" AND r2.cat_id = c2.id
													WHERE c1.id = "'.$coll['cat_id'].'"'));
								
								echo '<a href="'.$coll['link'].'/">'.$coll['name1'].'</a>';
								echo '<span class="slider1_span1">'.$categorys['factory'].'</span>';
								echo '<span class="slider1_span2">('.$categorys['country'].')</span>';
							echo '</div>';
							echo '</li>';

							$i++;
						}
						echo '</ul>';
					echo '</div>';
					if($i > 4){
						echo '<div><a href="#" class="prev">&nbsp;</a></div>';
						echo '<div><a href="#" class="next">&nbsp;</a></div>';
					}
				echo '</div>';
			echo '</div>';
		}
	}

	public function show_new_and_actions2($attributes)
	{
		$query = DB::query('SELECT s.*, r.rewrite AS link FROM {shop} s
										LEFT JOIN {rewrite} r ON r.module_name = "shop"
									WHERE (s.new = "1" OR s.hit = "1") AND r.element_id = s.id AND s.[act] = "1" AND s.trash = "0" AND s.cat_id != "8" ORDER BY s.[name] LIMIT 0, 15');
		$count = DB::num_rows($query);

		if($count > 0)
		{
			echo '<div class="slider1">';
				echo '<div class="photo_on_main">';
					echo '<div class="photoslider2">';
						echo '<ul>';
						unset($i); $i = 1;
						while($coll = DB::fetch_array($query))
						{
							echo '<li>';
							# print_r($coll);
							echo '<div class="slider1_img">';
								$images = $this->diafan->_images->get("cl-165", $coll['id'], "shop", $coll['site_id'], $coll['name1'], false);
								if(!empty($images[0])) echo '<a href="'.$coll['link'].'/"><img src="'.$images[0]['src'].'" alt="'.$coll['name1'].'" /></a>';
								
								$isDiscount = DB::fetch_array(DB::query('SELECT do.discount_id, d.discount FROM {shop_discount_object} do
																				LEFT JOIN {shop_discount} d ON d.id = do.discount_id
																			WHERE do.good_id = "'.$coll['id'].'" AND d.trash = "0" AND d.date_finish < "'.time().'"'));

								if($coll['new'] == 1 && $coll['action'] != 1)
								{ 
									echo '<div class="slider1_img_sale">NEW</div>';
								}
								else if($coll['action'] == 1)
								{								
									echo '<div class="slider1_img_sale2">-'.$isDiscount['discount'].'%</div>';
								}
								else
								{
									echo '<div class="slider1_img_hit"></div>';
								}
								// {PRICE}
								// генерируем из под товаров, берем минимальную цену
								$ges = DB::fetch_array(DB::query('SELECT * FROM {shop_param_element} WHERE element_id = "'.$coll['id'].'" AND param_id = "8"'));
								if(!$ges)
								{
									$price = DB::fetch_array(DB::query('SELECT MIN(sp.price) AS price FROM {shop_rel} sr
																			LEFT JOIN {shop_price} sp ON sp.good_id = sr.rel_element_id
																			LEFT JOIN {shop_param_element} spe ON spe.element_id = sr.rel_element_id AND spe.param_id = "5"
																		WHERE spe.value1 = "м2" AND sr.element_id = "'.$coll['id'].'"'));
									if(empty($price['price'])){
										$price = DB::fetch_array(DB::query('SELECT MIN(sp.price) AS price FROM {shop_rel} sr
																			LEFT JOIN {shop_price} sp ON sp.good_id = sr.rel_element_id
																			LEFT JOIN {shop_param_element} spe ON spe.element_id = sr.rel_element_id AND spe.param_id = "5"
																		WHERE spe.value1 = "шт" AND sr.element_id = "'.$coll['id'].'"'));
										$size = 'руб/шт';
										if(empty($price['price']))
										{
											$price = DB::fetch_array(DB::query('SELECT MIN(sp.price) AS price FROM {shop_rel} sr
																			LEFT JOIN {shop_price} sp ON sp.good_id = sr.rel_element_id
																		WHERE sr.element_id = "'.$coll['id'].'"'));
											$size = 'руб/м2';
										}
									} else $size = 'руб/м2';
								} else {
									$price['price'] = $ges['value1'];
									$ges = DB::fetch_array(DB::query('SELECT * FROM {shop_param_element} WHERE element_id = "'.$coll['id'].'" AND param_id = "9"'));
									$size = 'руб/'.$ges['value1'];
								}

								# if(!empty($isDiscount)) $price['price'] = intval($price['price'] - ($price['price'] / 100)*$isDiscount['discount']);

								echo '<div class="slider1_img_money">от '.intval($price['price']).' '.$size.'</div>';
							echo '</div>';
							echo '<div class="slider1_t">';
								$categorys = DB::fetch_array(DB::query('SELECT c1.name1 AS factory, c2.name1 AS country, r1.rewrite AS factory_url, r2.rewrite AS country_url FROM {shop_category} c1
														LEFT JOIN {shop_category} c2 ON c2.id = c1.parent_id
														LEFT JOIN {rewrite} r1 ON r1.module_name = "shop" AND r1.cat_id = c1.id
														LEFT JOIN {rewrite} r2 ON r2.module_name = "shop" AND r2.cat_id = c2.id
													WHERE c1.id = "'.$coll['cat_id'].'"'));
								
								echo '<a href="'.$coll['link'].'/">'.$coll['name1'].'</a>';
								echo '<span class="slider1_span1">'.$categorys['factory'].'</span>';
								echo '<span class="slider1_span2">('.$categorys['country'].')</span>';
							echo '</div>';
							echo '</li>';

							$i++;
						}
						echo '</ul>';
					echo '</div>';
					if($i > 4){
						echo '<div><a href="#" class="prev1">&nbsp;</a></div>';
						echo '<div><a href="#" class="next1">&nbsp;</a></div>';
					}
				echo '</div>';
			echo '</div>';
		}
	}

	
	
	function show_sidebar_content($attributes)
	{
		if(($this->diafan->module == 'shop' && empty($this->diafan->show)) || ($this->diafan->cid == 32 || $this->diafan->cid == 60 || $this->diafan->cid == 129))
		{
?>
		
	<div class="menu_right_bg">
		<div class="text_zag">Фильтр</div>
		<div class="menu_right_bg_box">
			<form method="post" action="" class="ajax filter_form">
				<input type="hidden" name="module" value="shop">
				<input type="hidden" name="action" value="filter">
				<input type="hidden" name="ajax" value="">
				<input type="hidden" name="data" value="">
			<?
				$sb2_rez = array();

				$array = array('usefor' => 'Назначение', 'size' => 'Выбрать размер', 'materials' => 'Выбрать материал', 'countries' => 'Страна и производитель');
				
				// usefor -------------------------------------------------------------------------------------
				$query = DB::query('SELECT ps.id, ps.[name], r.rewrite FROM {shop_param_select} ps
											LEFT JOIN {rewrite} r ON r.module_name = "shop" AND r.param_id = ps.id
										WHERE ps.param_id = "2" AND ps.trash = "0" AND ps.act = "1" AND ps.[name] != "#empty" GROUP BY ps.id ORDER BY ps.sort ASC');
				$count = DB::num_rows($query);
				$sb2_rez['usefor'] = array();
				if($count > 0)
				{
					while($usefor = DB::fetch_array($query))
					{
						# print_r($usefor);
						# echo 'SELECT redirect FROM {redirect} WHERE redirect LIKE "%'.$usefor['rewrite'].'%"';
						$rez = DB::fetch_array(DB::query('SELECT id, redirect FROM {redirect} WHERE redirect = "'.$usefor['rewrite'].'/"'));
						# print_r($rez);
						if(!$rez){ # echo $usefor['rewrite'].' -> '.$rez['redirect'].'<br>';
							$sb2_rez['usefor'][] = $usefor;
						}
					}
				}
				// --------------------------------------------------------------------------------------------
				
				// size ---------------------------------------------------------------------------------------
				$query = DB::query('SELECT id, [value] FROM {shop_param_element} WHERE param_id = "4" AND trash = "0" ORDER BY CAST([value] as unsigned) ASC');
				$count = DB::num_rows($query);
				$sb2_rez['size'] = array();
				if($count > 0)
				{
					$tmpArr = array(); unset($i); $i = 1;
					while($size = DB::fetch_array($query))
					{
						if(!in_array($size['value'], $tmpArr) && $size['value'] != ' ' && $size['value'] != '- см' && $size['value'] != 'см' && $size['value'] != ' см'){
							$tmpArr[] = $size['value'];
							$sb2_rez['size'][] = array('id' => $i, 'name' => $size['value']);

							$i++;
						}
					}
				}
				// hide size
				$sb2_rez['size'] = array();
				// --------------------------------------------------------------------------------------------

				// materials ----------------------------------------------------------------------------------
				$query = DB::query('SELECT ps.id, ps.[name], r.rewrite FROM {shop_param_select} ps
											LEFT JOIN {rewrite} r ON r.module_name = "shop" AND r.param_id = ps.id
											RIGHT JOIN {redirect} rd ON rd.redirect NOT LIKE CONCAT("%", r.rewrite, "%")
										WHERE ps.param_id = "3" AND ps.trash = "0" AND ps.act = "1" AND ps.[name] != "#empty" GROUP BY ps.id ORDER BY ps.sort ASC');
				$count = DB::num_rows($query);
				$sb2_rez['materials'] = array();
				if($count > 0)
				{
					while($materials = DB::fetch_array($query))
					{
						$rez = DB::fetch_array(DB::query('SELECT id, redirect FROM {redirect} WHERE redirect = "'.$materials['rewrite'].'/"'));
						if(!$rez) $sb2_rez['materials'][] = $materials;
					}
				}
				// --------------------------------------------------------------------------------------------

				// countries ----------------------------------------------------------------------------------
				$query = DB::query('SELECT id, [name], parent_id FROM {shop_category} WHERE [act] = "1" AND trash = "0" AND parent_id = "0" AND id != "8" ORDER BY sort ASC');
				$count = DB::num_rows($query);
				$sb2_rez['countries'] = array();
				if($count > 0)
				{
					while($countries = DB::fetch_array($query))
					{
						$sb2_rez['countries'][] = $countries;
						$query1 = DB::query('SELECT id, [name], parent_id FROM {shop_category} WHERE [act] = "1" AND trash = "0" AND parent_id = "'.$countries['id'].'" AND id != "8" ORDER BY [name] ASC');
						$count1 = DB::num_rows($query1);
						if($count1 > 0)
						{
							while($factory = DB::fetch_array($query1))
							{
								$sb2_rez['countries'][] = $factory;
							}
						}
					}
				}
				// --------------------------------------------------------------------------------------------
				
				$subSizeArr = array();
				foreach($sb2_rez as $key => $part)
				{
					if(count($part) > 0)
					{
						echo '<div class="menu_right_bg_box_1">';
							echo '<a href="javascript:void(0)" id="f_'.$key.'" class="f_select">'.$array[$key].'</a><img src="'.BASE_PATH_HREF.'img/menu_right_bg_box_1.png"  class="menu_right_bg_box_1_img" alt="" />';

							if(count($part) > 1 && count($part) <= 4) $columns = 1;
							else if(count($part) > 4 && count($part) <= 8) $columns = 2;
							else if(count($part) > 8 && count($part) <= 12) $columns = 3;
							else $columns = 4;

							echo '<div class="menu_right_bg_box_1_zakl columns_'.$columns.'" id="sf_'.$key.'" style="display: none;">';
							
							if($columns < 4) $elem_per_colmn = 4;
							else {
								$elem_per_colmn = intval(count($part) / $columns);
								if(count($part) % $columns != 0) $elem_per_colmn++;
							}
							
							for($i = 0; $i < $columns; $i++)
							{
								$tmpArr = array_slice($part, $i*$elem_per_colmn, $elem_per_colmn);
								echo '<div class="box_column">';
								foreach($tmpArr as $element)
								{
									if($key == 'size')
									{ 
										echo '<div class="menu_right_bg_box_1_zakl_1 after_red_box2">';
										$pos = strpos($element['name'], 'x');
										$pos2 = strpos($element['name'], 'х');
										$pos3 = strpos($element['name'], 'X');
										$firstNum = '';
										if($pos !== false)
										{
											$firstNum = mb_substr($element['name'], 0, $pos);
										} else if ($pos2 !== false){
											$firstNum = mb_substr($element['name'], 0, $pos2);
										} else if ($pos3 !== false){
											$firstNum = mb_substr($element['name'], 0, $pos3);
										} else {
											$firstNum = preg_replace("/[^0-9]/", '', $element['name']);
										}
										$firstNum = intval($firstNum);
										if($element['id'] == 3 || $element['id'] == 4 || $element['id'] == 5) $firstNum = 0;
										
										if(!in_array($firstNum, $subSizeArr))
										{
											echo '<span class="red_box_size">'.$firstNum.'</span>';
											$subSizeArr[] = $firstNum;
										}
										echo '<span class="menu_right_bg_box_1_zakl_1_span2" ref1="'.$key.'" ref2="'.$element['id'].'"><input type="checkbox" value="'.$element['id'].'" ref1="'.$key.'" ref2="'.$element['id'].'" '.(isset($element['parent_id']) && $element['parent_id'] != 0 ? 'ref3="'.$element['parent_id'].'"' : '').'><span id="name_'.$key.'_'.$element['id'].'">'.$element['name'].'</span></span>';
										echo '</div>';
									} else {
										echo '<div class="menu_right_bg_box_1_zakl_1'.(isset($element['parent_id']) && $element['parent_id'] == 0 ? ' red_box' : ' after_red_box').'">';
										echo '<span class="menu_right_bg_box_1_zakl_1_span2" ref1="'.$key.'" ref2="'.$element['id'].'"><input type="checkbox" value="'.$element['id'].'" ref1="'.$key.'" ref2="'.$element['id'].'" '.(isset($element['parent_id']) && $element['parent_id'] != 0 ? 'ref3="'.$element['parent_id'].'"' : '').'><span id="name_'.$key.'_'.$element['id'].'">'.$element['name'].'</span></span>';
										echo '</div>';
									}
								}
								echo '</div>';
							}

							echo '<div class="menu_right_bg_box_1_zakl_2">';
							echo '<a href="javascript:void(0)" class="discard '.$key.'">Сбросить все</a><span>|</span><a href="javascript:void(0)" id="apply-'.$key.'" class="apply '.$key.'">Выбрать</a><div class="menu_right_bg_box-close"></div>';
							echo '</div>';
							echo '<div class="menu_right_bg_box_1_zakl_strl"></div>';
							echo '</div>';

						echo '</div>';
						echo '<div id="'.$key.'_selects"></div>';
						echo '<input type="hidden" id="'.$key.'_values" name="'.$key.'_values" value="" />';
					}
				}

				$pMin = DB::fetch_array(DB::query('SELECT MIN(price) AS price FROM {shop_price}'));
				# $pMax = DB::fetch_array(DB::query('SELECT MAX(price) AS price FROM {shop_price}'));
			?>
			<div class="menu_right_bg_box_3">
				<div class="menu_right_bg_box_3_zag">Стоимость</div>
				<div class="menu_right_bg_box_3_inp">
					<span>от</span>
					<input class="menu_right_bg_box_3_inp_1" type="text" id="f_minp" name="f_minp" value="<?=intval($pMin['price'])?>" />
					<span>до</span>
					<input class="menu_right_bg_box_3_inp_1" type="text" id="f_maxp" name="f_maxp" value="9999" />
					<span>р/м<span>2</span></span>
				</div>
					<div class="menu_right_bg_box_3_kalk">
					<div class="price_slider"></div>
				</div>
				<div class="menu_right_bg_box_3_zag">Размер</div>
				<div class="menu_right_bg_box_3_inp">
					<span title="Высота">В</span>
					<input class="menu_right_bg_box_3_inp_1 www" title="Высота" type="text" id="f_raz" name="f_raz" value="" />
					<span title="Ширина">Ш</span>
					<input class="menu_right_bg_box_3_inp_1 www" title="Ширина" type="text" id="f_raz2" name="f_raz2" value="" />
					<span title="Погрешность">±</span>
					<select class="menu_right_bg_box_3_inp_1 www" title="Погрешность" id="f_raz3" name="f_raz3"><option value="0">0 см</option><option value="1">1 см</option><option value="2">2 см</option><option value="3">3 см</option><option value="4">4 см</option><option value="5">5 см</option></select>
				</div>
			

				<div class="menu_right_bg_box_3_check">
					<div class="menu_right_bg_box_3_chek_1">
						<input type="checkbox" id="f_hit" name="f_hit" value="1" /> <span rel="f_hit">Хиты</span>
					</div>
					<div class="menu_right_bg_box_3_chek_1">
						<input type="checkbox" id="f_new" name="f_new" value="1" /> <span rel="f_new">Новинки</span>
					</div>
					<div class="menu_right_bg_box_3_chek_1">
						<input type="checkbox" id="f_sale" name="f_sale" value="1" /> <span rel="f_sale">Со скидками</span>
					</div>
					<div class="menu_right_bg_box_3_chek_1">
						<input type="checkbox" id="f_action" name="f_action" value="1" /> <span rel="f_action">По акции</span>
					</div>
				</div>

				<div class="menu_right_go"><a href="javascript:void(0)">Показать</a></div>
				<div class="menu_right_clear"><a href="javascript:void(0)">Сбросить все</a></div>
				
				<div class="errors error" style="display:none"></div>
				</form>
			</div>
			
			<script type="text/javascript">
			$(document).ready(function(){
				var data = {};
				var minPrice = <?=intval($pMin['price'])?>;
				var maxPrice = 9999;

				var f_slider = $('.price_slider').slider({
					range: true,
					values: [ minPrice, maxPrice ],
					min: minPrice,
					max: maxPrice,
					change: function(event, ui){
						// console.log(event);
						// console.log(ui);
						$('#f_minp').val(ui.values[0]);
						$('#f_maxp').val(ui.values[1]);
					},
					slide: function(event, ui){
						// console.log(event);
						// console.log(ui);
					}
				});

				$('#f_minp').change(function(){
					$('.price_slider').slider('values', 0, $('#f_minp').val());
				});

				$('#f_maxp').change(function(){
					$('.price_slider').slider('values', 1, $('#f_maxp').val());
				});

				$('.menu_right_bg_box_3_chek_1 span').click(function(){
					var id = $(this).attr('rel');
					var status = $('#' + id).attr('checked');

					if(status == 'checked') $('#' + id).attr('checked', false);
					else $('#' + id).attr('checked', true);
				});

				$('.f_select').click(function(){
					var id = $(this).attr('id').replace('f_', '');
					var status = $('#sf_' + id).css('display');

					$('.menu_right_bg_box_1_zakl').each(function(){ $(this).css('display', 'none'); });

					if(status == 'none') $('#sf_' + id).css('display', 'block');
					else $('#sf_' + id).css('display', 'none');
				});
				
				$('.discard').click(function(){
					var id = $(this).attr('class').replace('discard ', '');

					$('.menu_right_bg_box_2').each(function(){
						var params = $(this).attr('id').replace('s_', '').split('_');
						if(id == params[0]) $(this).remove();
					});

					$('#sf_' + id + ' input[type="checkbox"]:checked').each(function(){
						$(this).attr('checked', false);
					});
				});

				$('.apply').click(function(){
					var id = $(this).attr('class').replace('apply ', '');
					var selectedCountry = 0;

					$('.menu_right_bg_box_2').each(function(){
						var params = $(this).attr('id').replace('s_', '').split('_');
						
						if(id == params[0]){$(this).remove();}
						//alert(id);
					});

					$('#sf_' + id + ' input[type="checkbox"]:checked').each(function(){
						var key = $(this).attr('ref1');
						var ids = $(this).attr('ref2');
						if(key == 'countries') var parent = $(this).attr('ref3');
						
						if(key == 'countries'){
							var name = $('#name_' + key + '_' + ids).html();
							if(typeof parent === 'undefined') selectedCountry = ids;
							
							if(typeof parent !== 'undefined'){
								if(!( key in data )) data[key] = {};
							}
							
							if(typeof parent !== 'undefined' && selectedCountry != ids){
								if(!(ids in data[key])) data[key][ids] = 1;

								if(selectedCountry != parent) $('#' + key + '_selects').append('<div class="menu_right_bg_box_2" id="s_' + key + '_' + ids + '"><a href="javascript:void(0)">' + name + '</a></div>');
							} else if(selectedCountry == ids){
								console.log(key + ' / ' + ids + ' / ' + name);
								$('#' + key + '_selects').append('<div class="menu_right_bg_box_2" id="s_' + key + '_' + ids + '"><a href="javascript:void(0)">' + name + '</a></div>');
							}
						} else if(key != 'countries'){
							var name = $('#name_' + key + '_' + ids).html();
							
							if(!( key in data )) data[key] = {};

							if(!( ids in  data[key])){
								data[key][ids] = 1;
								// добавляем в виз часть
								//alert(name);
								$('#' + key + '_selects').append('<div class="menu_right_bg_box_2" id="s_' + key + '_' + ids + '"><a href="javascript:void(0)">' + name + '</a></div>');
							}else{
								$('#' + key + '_selects').append('<div class="menu_right_bg_box_2" id="s_' + key + '_' + ids + '"><a href="javascript:void(0)">' + name + '</a></div>');
						
							}
						}
					});

					$('#sf_' + id).css('display', 'none');
				});
				$('.menu_right_bg_box_2').live('click', function(){
					var params = $(this).attr('id').replace('s_', '').split('_');
					$('#sf_' + params[0] + ' input[type="checkbox"]:checked').each(function(){
						if($(this).attr('ref2') == params[1] || $(this).attr('ref3') == params[1]) $(this).attr('checked', false);
						if($(this).attr('ref3') == params[1]) // пора удалять элементы
						{
							var ids = $(this).attr('ref2');
							delete data[params[0]][ids];
						}
					});
					delete data[params[0]][params[1]];
					$(this).remove();
				});

				$('.menu_right_clear').click(function(){
					for(var okey in data){
						delete data[okey];
						$('#' + okey + '_selects').html('');
					}

					$('.menu_right_bg_box_1_zakl_1 input[type="checkbox"]').each(function(){
						$(this).attr('checked', false);
					});
					
					$('#f_minp').val(minPrice);
					$('#f_maxp').val(maxPrice);
					$('.price_slider').slider('values', [minPrice, maxPrice]);
					
					$('#f_hit').attr('checked', false);
					$('#f_sale').attr('checked', false);
					$('#f_new').attr('checked', false);
					$('#f_action').attr('checked', false);
				});

				$(document).mouseup(function (e)
				{
					var container;
					$('.menu_right_bg_box_1_zakl').each(function(){
						if($(this).css('display') == 'block') container = $(this);
					});

					if (typeof container !== 'undefined' && !container.is(e.target) // if the target of the click isn't the container...
						&& container.has(e.target).length === 0) // ... nor a descendant of the container
					{	
						$('#apply-' + container.attr('id').replace('sf_', '')).trigger('click');
					}
				});

				$('#sf_countries input[ref1="countries"]').change(function(){
					var ids = $(this).attr('ref2');
					var parent = $(this).attr('ref3');

					var setStatus = $(this).attr('checked');
					if(typeof setStatus === 'undefined') setStatus = false;

					if(typeof parent === 'undefined'){ // check all factorys in county
						$('#sf_countries input[ref1="countries"][ref3="' + ids + '"]').each(function(){
							$(this).attr('checked', setStatus);
						});
					}
				});

				$('.menu_right_go').click(function(){
					$('.menu_right_go a').html('<img src="/images/ajax-loader.gif" border="0">');
					$('.menu_right_go a').css('cursor', 'progress');
					var strhash = '';
					var i = 0;
					console.log(data);
					for(var okey in data){
						if(okey != 'minp' && okey != 'maxp' && okey != 'hit' && okey != 'sale' && okey != 'new' && okey != 'action'){
							var obj = data[okey];
							strhash += okey + '=';
							var j = 0;
							for(var o2key in obj){
								strhash += o2key;
								j++;
								if(Object.keys(obj).length != j) strhash += ',';
							}
							i++;
							if(Object.keys(data).length != i) strhash += '&';
						}
					}
					strhash += '&minpr=' + $('#f_minp').val();
					strhash += '&maxpr=' + $('#f_maxp').val();
					
					data['minp'] = $('#f_minp').val();
					data['maxp'] = $('#f_maxp').val();
					
					data['sizes_ot'] = $('#f_raz').val();
					data['sizes_do'] = $('#f_raz2').val();
					data['porp'] = $('#f_raz3 :selected').val();
					
					if($('#f_hit').is(':checked')){
						strhash += '&hit=1';
						data['hit'] = 1;
					} else data['hit'] = 0;

					if($('#f_sale').is(':checked')){
						strhash += '&sale=1';
						data['sale'] = 1;
					} else data['sale'] = 0;

					if($('#f_new').is(':checked')){
						strhash += '&new=1';
						data['new'] = 1;
					} else data['new'] = 0;

					if($('#f_action').is(':checked')){
						strhash += '&action=1';
						data['action'] = 1;
					} else data['action'] = 0;

					window.location.hash = strhash;

					$('input[name="data"]').val(JSON.stringify(data));
					$('form.filter_form').submit();
				});
				<? if(!empty($this->diafan->param)){ ?>
					if($('#sf_usefor input[ref1="usefor"][ref2="<?=$this->diafan->param?>"]').length > 0){
						$('#sf_usefor input[ref1="usefor"][ref2="<?=$this->diafan->param?>"]').attr('checked', true);
						$('#apply-usefor').trigger('click');
					}
					if($('#sf_materials input[ref1="materials"][ref2="<?=$this->diafan->param?>"]').length > 0){
						$('#sf_materials input[ref1="materials"][ref2="<?=$this->diafan->param?>"]').attr('checked', true);
						$('#apply-materials').trigger('click');
					}
				<? } ?>
				<? if(!empty($this->diafan->cat)){ ?>
					if($('#sf_countries input[ref1="countries"][ref2="<?=$this->diafan->cat?>"]').length > 0){
						$('#sf_countries input[ref1="countries"][ref2="<?=$this->diafan->cat?>"]').click();
						$('#apply-countries').trigger('click');
					}
				<? } ?>
				<? if($this->diafan->cid == 32){ ?>
					$('#f_sale').attr('checked', true);
					$('#f_action').attr('checked', true);
				<? } ?>
				<? if($this->diafan->cid == 60){ ?>
					$('#f_hit').attr('checked', true);
					$('#f_new').attr('checked', true);
				<? } ?>
				
				$('.menu_right_bg_box-close').click(function(){
					$('.menu_right_bg_box_1_zakl').hide();
				});
				
			});
			</script>

		</div>
	</div>

<?
		} else if($this->diafan->module == 'shop' && !empty($this->diafan->show)){
			
			$category = DB::fetch_array(DB::query('SELECT c.id, c.name1 AS factory FROM {shop_category} c
														LEFT JOIN {shop} s ON s.cat_id = c.id
													WHERE s.id = "'.$this->diafan->show.'"'));

			if($category['id'] == 8)
			{
				$category = DB::fetch_array(DB::query('SELECT sc.id, sc.name1 AS factory, s.id AS elemID FROM {shop_rel} sr
												LEFT JOIN {shop} s ON s.id = sr.element_id AND s.[act] = "1" AND s.trash = "0"
												LEFT JOIN {shop_category} sc ON sc.id = s.cat_id AND sc.[act] = "1" AND sc.trash = "0"
											WHERE sr.rel_element_id = "'.$this->diafan->show.'"'));
			}
?>
			<div class="menu_right_bg">
				<div class="text_zag">Другие коллекции фабрики <?=$category['factory']?></div>
					<div class="menu_right_bg_box">
					<?
						$res = DB::query('SELECT s.id, s.[name], r.rewrite AS link FROM {shop} s
												LEFT JOIN {rewrite} r ON r.module_name = "shop" AND r.element_id = s.id
											WHERE s.cat_id = "'.$category['id'].'" AND s.[act] = "1" AND s.trash = "0" ORDER BY s.[name] ASC');
						$count = DB::num_rows($res);
						if($count > 0)
						{
							while($elem = DB::fetch_array($res))
							{
								if(isset($category['elemID']) && !empty($category['elemID']))
								{
									if($elem['id'] != $category['elemID'])
									{
										echo '<div class="cl-list-elem"><a href="'. BASE_PATH_HREF . $elem['link'].'/">'.$elem['name'].'</a></div>';
									} else {
										echo '<div class="cl-list-elem"><span>'.$elem['name'].'</span></div>';
									}
								} else {
									if($elem['id'] != $this->diafan->show)
									{
										echo '<div class="cl-list-elem"><a href="'. BASE_PATH_HREF . $elem['link'].'/">'.$elem['name'].'</a></div>';
									} else {
										echo '<div class="cl-list-elem"><span>'.$elem['name'].'</span></div>';
									}
								}
							}
						}
					?>
				</div>
			</div>
<?
		} else {
			$inc = file_get_contents(ABSOLUTE_PATH.'themes/blocks/sub_news.php');

			$this->view->get_function_in_theme($inc);
		}
	}

	public function get_shop_list_($attributes)
	{
		
		$queryNewAction = '';
		$leftJoinDiscount = '';
		
		if(isset($attributes['hn']))
		{
			if($attributes['hn'] == 1)
			{
				$queryNewAction = ' AND (s.hit = "1" OR s.new = "1")';
			}
		}

		if(isset($attributes['sa']))
		{
			if($attributes['sa'] == 1)
			{
				$leftJoinDiscount = ' LEFT JOIN diafan_shop_discount_object d ON d.good_id = s.id';
				$queryNewAction = ' AND (s.action = "1" OR d.discount_id > 0)';
			}
		}

			$query1 = 'SELECT s.* FROM diafan_shop s
								'.$leftJoinDiscount.'
							WHERE s.act1 = "1" AND s.trash = "0" AND s.cat_id != "8"'.$queryNewAction;

			$query = DB::query($query1);
			$count = DB::num_rows($query);
		//print_r($query);
			
		echo '<div class="text">';

			if($count > 0){
				echo '<div class="text_zag">Коллекции</div>';
				// echo $query1;
				unset($i); $i = 0; $page = 1;
				while($row = DB::fetch_array($query))
				{
					if($i == 0) echo '<div class="filter_page fp_active" id="filter-page-'.$page.'">';
					if($i != 0 && $i % 10 == 0)
					{
						$page++;
						echo '</div><div class="filter_page" id="filter-page-'.$page.'">';
					}
					$link = DB::fetch_array(DB::query('SELECT rewrite FROM {rewrite} WHERE module_name = "shop" AND element_id = "'.$row['id'].'"'));
					$row['link'] = $link['rewrite'];
					$row['name'] = $row['name1'];

					echo '<div class="slider2">';
						echo '<div class="photo_on_main_full">';
							$images = $this->diafan->_images->get("cl-265", $row['id'], "shop", $row['site_id'], $row['name'], false);
							$check_product = DB::fetch_array(DB::query('SELECT discount_id,s.action,s.new,s.hit FROM {shop} s
										LEFT JOIN {shop_discount_object} d ON d.good_id = s.id
									WHERE (d.discount_id > 0 OR s.action = "1" OR s.new = "1" OR s.hit = "1") AND s.[act] = "1" AND s.trash = "0" AND s.cat_id != "8" AND s.id="'.$row['id'].'"'));
							$attr = '';
							if($check_product['discount_id'])
							{
								$isDiscount = DB::fetch_array(DB::query('SELECT discount FROM {shop_discount} WHERE id="'.$check_product['discount_id'].'" AND date_finish < "'.time().'"'));
								if($isDiscount['discount'])
								{
									$attr = '<div class="slider1_img_sale2">-'.$isDiscount['discount'].'%</div>';
								}
								else
								{
									$attr = '';
								}
									
							}
							if($check_product['action'])
							$attr = '<div class="slider1_img_best_price"></div>';
							if($check_product['new'])
								$attr = '<div class="slider1_img_sale">NEW</div>';
							if($check_product['hit'])
								$attr = '<div class="slider1_img_hit"></div>';
							# print_r($images);
							echo '<div class="photoslider'.$i.' ps-full" style="width: 260px;">';
								if(!empty($images))
								{
									echo '<ul>';
									foreach($images as $image)
									{
										echo '<li>';
										echo '<div class="slider'.$i.'_img" style="position:relative">';
										echo $attr;
										echo '<a href="' . BASE_PATH_HREF . $row["link"] . '/"><img src="'.$image['src'].'" alt="'.$image['alt'].'" /></a>';
										echo '</div>';
										echo '</li>';
									}
									echo '</ul>';
								}
							echo '</div>';
							if(!empty($images))
							{
								echo '<div><a href="#" class="prev'.$i.'" id="prevall">&nbsp;</a></div>';
								echo '<div><a href="#" class="next'.$i.'" id="nextall">&nbsp;</a></div>';
							}
						echo '</div>';
						// {PRICE}
						// генерируем из под товаров, берем минимальную цену
						$price = DB::fetch_array(DB::query('SELECT MIN(sp.price) AS price FROM {shop_rel} sr
																LEFT JOIN {shop_price} sp ON sp.good_id = sr.rel_element_id
																LEFT JOIN {shop_param_element} spe ON spe.element_id = sr.rel_element_id AND spe.param_id = "5"
															WHERE spe.value1 = "м2" AND sr.element_id = "'.$row['id'].'"'));
						if(empty($price['price'])){
							$price = DB::fetch_array(DB::query('SELECT MIN(sp.price) AS price FROM {shop_rel} sr
																LEFT JOIN {shop_price} sp ON sp.good_id = sr.rel_element_id
																LEFT JOIN {shop_param_element} spe ON spe.element_id = sr.rel_element_id AND spe.param_id = "5"
															WHERE spe.value1 = "шт" AND sr.element_id = "'.$row['id'].'"'));
							$size = 'руб/шт';
						} else $size = 'руб/м2';

						echo '<div class="slider1_img_money2 tmp2">от '.intval($price['price']).' '.$size.'</div>';
						echo '<div class="slider1_t">';
							$categorys = DB::fetch_array(DB::query('SELECT c1.name1 AS factory, c2.name1 AS country, r1.rewrite AS factory_url, r2.rewrite AS country_url FROM {shop_category} c1
																LEFT JOIN {shop_category} c2 ON c2.id = c1.parent_id
																LEFT JOIN {rewrite} r1 ON r1.module_name = "shop" AND r1.cat_id = c1.id
																LEFT JOIN {rewrite} r2 ON r2.module_name = "shop" AND r2.cat_id = c2.id
															WHERE c1.id = "'.$row['cat_id'].'"'));
							# print_r($categorys);
							echo '<a href="' . BASE_PATH_HREF . $row["link"] . '/">' . $row["name"] . '</a>';
							echo '<span class="slider1_span1">'.$categorys['factory'].'</span>';
							echo '<span class="slider1_span2">('.$categorys['country'].')</span>';
						echo '</div>';
					echo '</div>';

					$i++;
				}

				if($i % 10 != 0) echo '</div>';

				if($page > 1)
				{
					echo '<div class="paginator filter-paginator">';
					echo '<a href="javascript:void(0)" id="fp_to_first_1" class="fp_to_first" style="display: none;">«</a>';
					for($i = 1; $i <= $page; $i++)
					{
						if($i == 1) echo '<span>'.$i.'</span>';
						else {
							echo '<a href="javascript:void(0)" id="fp_to_'.$i.'" class="fp_to">'.$i.'</a>';
						}
					}
					echo '<a href="javascript:void(0)" id="fp_to_last_'.$page.'" class="fp_to_last">»</a>';
					echo '</div>';
				}
			}
		
		echo '</div>';
	}
}