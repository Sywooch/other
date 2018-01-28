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
	include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

/**
 * Shop_admin_order
 *
 * Редактирование заказов товаров
 */
class Shop_admin_rebuildchpu extends Frame_admin
{
	/**
	 * @var array настройки модуля
	 */
	public $config = array();

	public $_imageConfig = array();

	/**
	 * Выводит список заказов
	 * @return void
	 */
	public function show()
	{	
		if(isset($_POST['update_chpu']) && $_POST['update_chpu'] == 1)
		{
			
			// clauses update
			$res = DB::query('SELECT id FROM {site} WHERE [act] = "1" AND trash = "0" AND module_name = "clauses"');
			while($cl = DB::fetch_array($res))
			{
				$base_rewrite = DB::fetch_array(DB::query('SELECT rewrite FROM {rewrite} WHERE module_name = "site" AND site_id = "'.$cl['id'].'" AND element_id = "0" AND cat_id = "0" AND param_id = "0" AND trash = "0"'));
				
				// обновляем статьи без категорий
				$res2 = DB::query('SELECT r.id, r.rewrite FROM {clauses} c 
													LEFT JOIN {rewrite} r ON r.module_name = "clauses" AND r.trash = "0" AND r.site_id = "'.$cl['id'].'"
												WHERE c.id = r.element_id AND c.cat_id = "0" AND c.act1 = "1" AND c.trash = "0"');
				if(DB::num_rows($res2) > 0)
				{
					while($cl2 = DB::fetch_array($res2))
					{
						$nrewr = explode('/', $cl2['rewrite']);
						$nrewr[0] = $base_rewrite['rewrite'];
						$nrewr = implode('/', $nrewr);
						DB::query('UPDATE {rewrite} SET rewrite = "'.$nrewr.'" WHERE id = "'.$cl2['id'].'"');
					}
				}
				
				// Обновляем категории статей
				// future recursion

				// Обновляем статьи в категориях
				// future recursion
			}

			// shop update
			$res = DB::query('SELECT c.id, r.rewrite FROM {shop_category} c 
											LEFT JOIN {rewrite} r ON r.module_name = "shop"
										WHERE c.id = r.cat_id AND c.parent_id = "0" AND c.id != "8"');
			while($country = DB::fetch_array($res))
			{
				$country_url = $country['rewrite'];
				// update factorys
				$res2 = DB::query('SELECT c.id, r.id AS rid, r.rewrite FROM {shop_category} c 
											LEFT JOIN {rewrite} r ON r.module_name = "shop"
										WHERE c.id = r.cat_id AND c.parent_id = "'.$country['id'].'"');
				if(DB::num_rows($res2) > 0)
				{
					while($factory = DB::fetch_array($res2))
					{
						unset($rwr);
						$rwr = explode('/', $factory['rewrite']);
						$factory_url = $rwr[1];
						$rwr[0] = $country_url;
						$rwr = implode('/', $rwr);
						DB::query('UPDATE {rewrite} SET rewrite = "'.$rwr.'" WHERE id="'.$factory['rid'].'"');

						// update factory collection
						$res3 = DB::query('SELECT s.id, r.id AS rid, r.rewrite FROM {shop} s 
													LEFT JOIN {rewrite} r ON r.module_name = "shop"
												WHERE s.id = r.element_id AND s.cat_id = "'.$factory['id'].'"');
						if(DB::num_rows($res3) > 0)
						{
							while($collection = DB::fetch_array($res3))
							{
								unset($rwr);
								$rwr = explode('/', $collection['rewrite']);
								if(count($rwr) > 3){ 
									$collection_url = $rwr[count($rwr) - 1];
									unset($rwr);
									$rwr[0] = $country_url;
									$rwr[1] = $factory_url;
									$rwr[2] = $collection_url;
								} else {
									$collection_url = $rwr[2];
									$rwr[0] = $country_url;
									$rwr[1] = $factory_url;
								}
								$rwr = implode('/', $rwr);
								DB::query('UPDATE {rewrite} SET rewrite = "'.$rwr.'" WHERE id="'.$collection['rid'].'"');

								// update collection products
								$res4 = DB::query('SELECT s.id, r.id AS rid, r.rewrite FROM {shop_rel} sr 
													LEFT JOIN {shop} s ON s.id = sr.rel_element_id
													LEFT JOIN {rewrite} r ON r.module_name = "shop"
												WHERE sr.element_id = "'.$collection['id'].'" AND s.id = r.element_id AND s.cat_id = "8"');
								if(DB::num_rows($res4) > 0)
								{
									while($product = DB::fetch_array($res4))
									{
										unset($rwr);
										$rwr = explode('/', $product['rewrite']);
										if(count($rwr) > 4){ 
											$product_url = $rwr[count($rwr) - 1];
											unset($rwr);
											$rwr[0] = $country_url;
											$rwr[1] = $factory_url;
											$rwr[2] = $collection_url;
											$rwr[3] = $product_url;
										} else {
											$rwr[0] = $country_url;
											$rwr[1] = $factory_url;
											$rwr[2] = $collection_url;
										}
										// 3 не меняем - ссылка продукта
										// $rwr[3] = $product['rewrite'];
										$rwr = implode('/', $rwr);
										DB::query('UPDATE {rewrite} SET rewrite = "'.$rwr.'" WHERE id="'.$product['rid'].'"');
									}
								}
							}
						}
					}
				}
			}
		} // update_chpu

		// autoupload
		if(isset($_POST['autoupload']) && $_POST['autoupload'] == 1)
		{
			// get image config
			$res = DB::fetch_array(DB::query('SELECT * FROM diafan_images_variations WHERE id = "1"'));
			$this->_imageConfig['small'] = $res;
			
			// read dirs
			$_globalDir = $_SERVER['DOCUMENT_ROOT'].'/autoupload';

			$_fabricDir = $_globalDir.'/fabrics/';
			$_collectionDir = $_globalDir.'/collections/';
			$_productDir = $_globalDir.'/products/';

			$dataArr = array();
			$dataArr['fabrics']		= scandir($_fabricDir);
			$dataArr['collections']	= scandir($_collectionDir);
			$dataArr['products']	= scandir($_productDir);
			
			unset($i); $i = 0;
			// start upload
			foreach($dataArr as $key => &$data)
			{
				$path = '';
				if($key == 'fabrics') $path = $_fabricDir;
				if($key == 'collections') $path = $_collectionDir;
				if($key == 'products') $path = $_productDir;
				foreach($data as &$image)
				{
					if($image != '.' && $image != '..')
					{
						$is = getimagesize($path . $image);
						if($is && ($is['mime'] == 'image/gif' || $is['mime'] == 'image/jpeg' || $is['mime'] == 'image/png'))
						{
							$namef = '_au_'.$key;
							//$image =  mb_convert_encoding($image, "UTF-8", "windows-1251");
							
							//echo $image;
							$status = $this->$namef(array('name' => $image, 'src' => $path . $image, 'data' => $is));
							//print_r($status);
							$image = array('name' => $image, 'status' => $status);
						} else $image = array('name' => $image, 'status' => 1);
					}
					$i++;
				}
				if($i % 100 == 0) sleep(1);
			}
			// status
			// 0 - ok, no errors
			// 1 - not image
			// 2 - not found in base
			// 3 - not loaded image config
		} // autoupload

		echo 'Обновление ЧПУ ссылок:<br>';
		echo ' - магазина<br>';
		echo ' - статей<br>';
		echo '<form method="post" action="">';
		echo '<input type="hidden" name="update_chpu" value="1">';
		echo '<input type="submit" value="Обновить">';
		echo '</form>';

		echo '<hr>';
		
		echo 'Автозагрузка картинок:<br>';
		echo '1. Загрузить изображения по FTP в /autoupload/ (доступны 3 директории products, collections, fabrics)<br>';
		echo '2. Название изображения должно соответствовать необходимому элементу (регистр не важен)<br>';
		echo '3. После успешной загрузки изображение будет автоматически удалено из /autoupload/<br>';
		echo '4. После окончания загрузки, необходимо пересоздать форматы изображений (Каталог -> Настройки модуля -> Вкладка "Изображения" -> Применить настройки ко всем ранее загруженным изображениям)<br><br>';
		if(isset($dataArr) && !empty($dataArr))
		{
			$showErr = '';
			foreach($dataArr as $key => $dato)
			{
				foreach($dato as $image)
				{
					if(is_array($image) && $image['status'] != 0)
					{
						echo '[/autoupload/'.$key.'/'.$image['name'].'] ';
						if($image['status'] == 1) echo 'Недопустимый формат файла. Разрешенные: png, jpeg, jpg, gif';
						if($image['status'] == 2) echo 'Элемент с таким имененем не найден в базе';
						if($image['status'] == 3) echo 'Не удалось загрузить конфиг изображений (В таблице diafan_images_variations должна быть срока с id = 1)';
						echo '<br>';
					}
				}
			}
			if(!empty($showErr)) echo 'Ошибки:<br>'.$showErr.'<br><br>';
		}
		echo '<form method="post" action="">';
		echo '<input type="hidden" name="autoupload" value="1">';
		echo '<input type="submit" value="Запуск">';
		echo '</form>';
	}

	public function rus2translit($string) {

		$converter = array(

			'а' => 'a',   'б' => 'b',   'в' => 'v',

			'г' => 'g',   'д' => 'd',   'е' => 'e',

			'ё' => 'e',   'ж' => 'zh',  'з' => 'z',

			'и' => 'i',   'й' => 'y',   'к' => 'k',

			'л' => 'l',   'м' => 'm',   'н' => 'n',

			'о' => 'o',   'п' => 'p',   'р' => 'r',

			'с' => 's',   'т' => 't',   'у' => 'u',

			'ф' => 'f',   'х' => 'h',   'ц' => 'c',

			'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',

			'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',

			'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

			

			'А' => 'A',   'Б' => 'B',   'В' => 'V',

			'Г' => 'G',   'Д' => 'D',   'Е' => 'E',

			'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',

			'И' => 'I',   'Й' => 'Y',   'К' => 'K',

			'Л' => 'L',   'М' => 'M',   'Н' => 'N',

			'О' => 'O',   'П' => 'P',   'Р' => 'R',

			'С' => 'S',   'Т' => 'T',   'У' => 'U',

			'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',

			'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',

			'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',

			'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',

		);

		return strtr($string, $converter);

	}

	public function str2url($str) {

		// переводим в транслит

		$str = $this->rus2translit($str);

		// в нижний регистр

		$str = strtolower($str);

		// заменям все ненужное нам на "-"

		$str = preg_replace('~[^-a-z0-9_]+~u', '-', $str);

		// удаляем начальные и конечные '-'

		$str = trim($str, "-");

		return $str;

	}

	public function _au_fabrics($image)
	{ // shopcat
		$real_name = explode('.', $image['name']);
		unset($real_name[count($real_name) - 1]);

		$real_name	= implode($real_name);
		$real_ext	= pathinfo($image['name'], PATHINFO_EXTENSION);

		$real_name1 = str_replace('_', ' ', $real_name);

		$res = DB::fetch_array(DB::query('SELECT id, name1 FROM diafan_shop_category WHERE name1 = "'.$real_name1.'" AND parent_id != "0" AND trash = "0" AND act1 = "1"'));
		if($res)
		{
			if(!empty($this->_imageConfig))
			{
				$check = DB::fetch_array(DB::query('SELECT id FROM diafan_images WHERE name = "'.$real_name.'.'.$real_ext.'"'));
				if($check)
				{
					DB::query('DELETE FROM diafan_images WHERE id = "'.$check['id'].'"');
					unlink($_SERVER['DOCUMENT_ROOT'].'/userfiles/original/'.$real_name.'.'.$real_ext);
					unlink($_SERVER['DOCUMENT_ROOT'].'/userfiles/'.$this->_imageConfig['small']['folder'].'/'.$real_name.'.'.$real_ext);
				}

				DB::query('INSERT INTO diafan_images (id, name, module_name, alt1, title1, element_id, param_id, size, sort, tmpcode, created, trash) VALUES (NULL, "'.$real_name.'.'.$real_ext.'", "shopcat", "'.$res['name1'].'", "", "'.$res['id'].'", "", "", "0", "", "'.time().'", "0")');

				$id = DB::last_id('images');

				DB::query('UPDATE diafan_images SET alt1 = "'.$res['name1'].' '.$id.'", sort = "'.$id.'" WHERE id = "'.$id.'"');
				
				copy($image['src'], $_SERVER['DOCUMENT_ROOT'].'/userfiles/original/'.$real_name.'.'.$real_ext);
				copy($image['src'], $_SERVER['DOCUMENT_ROOT'].'/userfiles/'.$this->_imageConfig['small']['folder'].'/'.$real_name.'.'.$real_ext);

				$cimages = DB::query('SELECT * FROM diafan_images_variations WHERE id IN (5)');
				while($cimg = DB::fetch_array($cimages))
				{
					$cc = unserialize($cimg['param']);
					copy($image['src'], ABSOLUTE_PATH.USERFILES.'/shop/'.$cimg['folder'].'/'.$real_name.'.'.$real_ext);
					Image::resize(ABSOLUTE_PATH.USERFILES.'/shop/'.$cimg['folder'].'/'.$real_name.'.'.$real_ext, $cc[0]['width'], $cc[0]['height'], $cimg['quality']);
				}

				unlink($image['src']);

				return 0;

			} else return 3;
		} else return 2;
	}

	public function _au_collections($image)
	{ // shop
		$real_name = explode('.', $image['name']);
		unset($real_name[count($real_name) - 1]);

		$real_name	= implode($real_name);
		$real_ext	= pathinfo($image['name'], PATHINFO_EXTENSION);
		
		if(preg_match('/(.+)_([0-9]{1})\.'.$real_ext.'/i', $image['name'], $result))
		{
			$real_name1 = str_replace('_', ' ', $result[1]);
		} else {
			$real_name1 = str_replace('_', ' ', $real_name);
		}
		
		$res = DB::fetch_array(DB::query('SELECT id, name1 FROM diafan_shop WHERE name1 = "'.$real_name1.'" AND cat_id != "8" AND trash = "0" AND act1 = "1"'));
		//print_r($res);
		if($res)
		{
			if(!empty($this->_imageConfig))
			{
				$real_name = $res['id'].'_'.$real_name;

				$check = DB::fetch_array(DB::query('SELECT id, name FROM diafan_images WHERE module_name = "shop" AND element_id = "'.$res['id'].'" AND name = "'.$real_name.'.'.$real_ext.'"'));
				if($check)
				{
					DB::query('DELETE FROM diafan_images WHERE id = "'.$check['id'].'"');
					unlink($_SERVER['DOCUMENT_ROOT'].'/userfiles/original/'.$himg['name']);
					unlink($_SERVER['DOCUMENT_ROOT'].'/userfiles/small/'.$himg['name']);
					unlink($_SERVER['DOCUMENT_ROOT'].'/userfiles/shop/collection/'.$himg['name']);
					unlink($_SERVER['DOCUMENT_ROOT'].'/userfiles/shop/collection_list/'.$himg['name']);
					unlink($_SERVER['DOCUMENT_ROOT'].'/userfiles/shop/collection_list_main/'.$himg['name']);
				}

				DB::query('INSERT INTO diafan_images (id, name, module_name, alt1, title1, element_id, param_id, size, sort, tmpcode, created, trash) VALUES (NULL, "'.$real_name.'.'.$real_ext.'", "shop", "'.$res['name1'].'", "", "'.$res['id'].'", "", "", "0", "", "'.time().'", "0")');

				$id = DB::last_id('images');

				DB::query('UPDATE diafan_images SET alt1 = "'.$res['name1'].' '.$id.'", sort = "'.$id.'" WHERE id = "'.$id.'"');
				
				copy($image['src'], $_SERVER['DOCUMENT_ROOT'].'/userfiles/original/'.$real_name.'.'.$real_ext);
				copy($image['src'], $_SERVER['DOCUMENT_ROOT'].'/userfiles/'.$this->_imageConfig['small']['folder'].'/'.$real_name.'.'.$real_ext);

				Customization::inc("includes/image.php");

				$cimages = DB::query('SELECT * FROM diafan_images_variations WHERE id IN (4, 6, 7)');
				while($cimg = DB::fetch_array($cimages))
				{
					$cc = unserialize($cimg['param']);
					copy($image['src'], ABSOLUTE_PATH.USERFILES.'/shop/'.$cimg['folder'].'/'.$real_name.'.'.$real_ext);
					Image::resize(ABSOLUTE_PATH.USERFILES.'/shop/'.$cimg['folder'].'/'.$real_name.'.'.$real_ext, $cc[0]['width'], $cc[0]['height'], $cimg['quality']);
				}

				unlink($image['src']);
				
				return 0;

			} else return 3;
		} else return 2;
	}

	public function _au_products($image)
	{ // shop
		$real_name = explode('.', $image['name']);
		unset($real_name[count($real_name) - 1]);

		$real_name	= implode($real_name);
		$real_ext	= pathinfo($image['name'], PATHINFO_EXTENSION);

		$real_name1 = str_replace('_', ' ', $real_name);

		$res = DB::fetch_array(DB::query('SELECT id, name1 FROM diafan_shop WHERE name1 = "'.$real_name1.'" AND cat_id = "8" AND trash = "0" AND act1 = "1" ORDER BY diafan_shop.id DESC'));
		//echo 'SELECT id, name1 FROM diafan_shop WHERE name1 = "'.$real_name1.'" AND cat_id = "8" AND trash = "1" AND act1 = "1"<br><br>';
		if($res)
		{
			if(!empty($this->_imageConfig))
			{
				$real_name = $res['id'].'_'.$real_name;
			//	echo 'SELECT id, name FROM diafan_images WHERE module_name = "shop" AND element_id = "'.$res['id'].'" AND name = "'.$real_name.'.'.$real_ext.'"<br><br>';
				$check = DB::fetch_array(DB::query('SELECT id, name FROM diafan_images WHERE module_name = "shop" AND element_id = "'.$res['id'].'" AND name = "'.$real_name.'.'.$real_ext.'"'));
				print_r($check);
				
				if($check)
				{
				
					DB::query('DELETE FROM diafan_images WHERE id = "'.$check['id'].'"');
					unlink($_SERVER['DOCUMENT_ROOT'].'/userfiles/original/'.$himg['name']);
					unlink($_SERVER['DOCUMENT_ROOT'].'/userfiles/small/'.$himg['name']);
					unlink($_SERVER['DOCUMENT_ROOT'].'/userfiles/shop/collection_element/'.$himg['name']);
					unlink($_SERVER['DOCUMENT_ROOT'].'/userfiles/shop/collection_element2/'.$himg['name']);
				}

				DB::query('INSERT INTO diafan_images (id, name, module_name, alt1, title1, element_id, param_id, size, sort, tmpcode, created, trash) VALUES (NULL, "'.$real_name.'.'.$real_ext.'", "shop", "'.$res['name1'].'", "", "'.$res['id'].'", "", "", "0", "", "'.time().'", "0")');

				$id = DB::last_id('images');

				DB::query('UPDATE diafan_images SET alt1 = "'.$res['name1'].' '.$id.'", sort = "'.$id.'" WHERE id = "'.$id.'"');
				//$real_name =  mb_convert_encoding($real_name, "windows-1251", "UTF-8");
				copy($image['src'], $_SERVER['DOCUMENT_ROOT'].'/userfiles/original/'.$real_name.'.'.$real_ext);
				copy($image['src'], $_SERVER['DOCUMENT_ROOT'].'/userfiles/'.$this->_imageConfig['small']['folder'].'/'.$real_name.'.'.$real_ext);
				//echo $_SERVER['DOCUMENT_ROOT'].'/userfiles/'.$this->_imageConfig['small']['folder'].'/'.$real_name.'.'.$real_ext;
				Customization::inc("includes/image.php");

				$cimages = DB::query('SELECT * FROM diafan_images_variations WHERE id IN (8, 9)');
				while($cimg = DB::fetch_array($cimages))
				{
					$cc = unserialize($cimg['param']);
					copy($image['src'], ABSOLUTE_PATH.USERFILES.'/shop/'.$cimg['folder'].'/'.$real_name.'.'.$real_ext);
					Image::resize(ABSOLUTE_PATH.USERFILES.'/shop/'.$cimg['folder'].'/'.$real_name.'.'.$real_ext, $cc[0]['width'], $cc[0]['height'], $cimg['quality']);
				}

				unlink($image['src']);

				return 0;

			} else return 3;
		} else return 2;
	}
}
?>