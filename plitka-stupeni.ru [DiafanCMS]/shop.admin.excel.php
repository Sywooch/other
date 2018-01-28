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
class Shop_admin_excel extends Frame_admin
{
	/**
	 * @var array настройки модуля
	 */
	public $config = array();

	/**
	 * Выводит список заказов
	 * @return void
	 */
	public function show()
	{	
		# print_r($this->diafan);
		if(isset($_POST['ef_upload']) && $_POST['ef_upload'] == 1)
		{
			$path = $_FILES['excel_file']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);
			
			if($ext == 'xls')
			{
				include_once('loader-excel_reader2.php');

				$data = new Spreadsheet_Excel_Reader($_FILES['excel_file']['tmp_name'], false, 'UTF-8');

				$cp = $data->rowcount(0);
				$colsp = $data->colcount(0);

				if($cp > 0)
				{
					DB::query('UPDATE diafan_shop SET act1 = "0"');
					DB::query('UPDATE diafan_shop_category SET act1 = "0"');
					DB::query('UPDATE {shop_param_select} SET act = "0"');
					DB::query('UPDATE diafan_shop_param_element SET value1 = "0" WHERE param_id = "8"');
					DB::query('TRUNCATE diafan_shop_param_element');

					$tmp_last_sort = 0;
					$tmp_last_sort_id = 0;

					for($i = 2; $i < $cp; $i++)
					{
						$country = $data->val($i, 2);
						$factory = $data->val($i, 3);
						$collection = $data->val($i, 4);
						$collection_price = $data->val($i, 12);
						$usefor = $data->val($i, 5);
						$material = $data->val($i, 6);
						
						$dop_parameter1=$rows[$i][26];//штук в коробке
							$dop_parameter2=$rows[$i][27];//кв.м. в коробке
							$dop_parameter3=$rows[$i][28];//вес коробки

						$order_ex = intval($data->val($i, 7));

						$element = $data->val($i, 8);
						$plitka_type = $data->val($i, 9);
						$price = $data->val($i, 10);
						$type_size = str_replace('.', '', $data->val($i, 11));
						$size = $data->val($i, 13).' '.$data->val($i, 14);

						$chpu_country		= $this->str2url($country);
						$chpu_factory		= $this->str2url($factory);
						$chpu_collection	= $this->str2url($collection);
						$chpu_element		= $this->str2url($element);
						
						if(!empty($country) && !empty($factory) && !empty($collection) && !empty($element))
						{
							// country
							$res = DB::fetch_array(DB::query('SELECT id FROM {shop_category} WHERE [name] = "'.$country.'" AND parent_id = "0"'));
							if(!$res)
							{
								DB::query('INSERT INTO diafan_shop_category (name1, act1, parent_id, site_id, title_meta1, admin_id, trash) VALUES ("'.$country.'", "1", "0", "29", "'.$country.'", "1", "0")');
								$id = DB::last_id('shop_category');
								DB::query('INSERT INTO diafan_rewrite (rewrite, module_name, site_id, cat_id, trash) VALUES ("'.$chpu_country.'", "shop", "29", "'.$id.'", "0")');
								$countryID = $id;
							} else {
								$countryID = $res['id'];
								$chp = DB::fetch_array(DB::query('SELECT rewrite FROM diafan_rewrite WHERE module_name = "shop" AND site_id = "29" AND cat_id = "'.$countryID.'"'));
								if($chp) $chpu_country = $chp['rewrite'];
								DB::query('UPDATE diafan_shop_category SET act1 = "1" WHERE id = "'.$countryID.'"');
							}

							// factory
							$res = DB::fetch_array(DB::query('SELECT id FROM {shop_category} WHERE [name] = "'.$factory.'" AND parent_id = "'.$countryID.'"'));
							if(!$res)
							{
								DB::query('INSERT INTO diafan_shop_category (name1, act1, parent_id, site_id, title_meta1, admin_id, trash) VALUES ("'.$factory.'", "1", "'.$countryID.'", "29", "'.$factory.'", "1", "0")');
								$id = DB::last_id('shop_category');
								DB::query('INSERT INTO diafan_rewrite (rewrite, module_name, site_id, cat_id, trash) VALUES ("'.$chpu_country.'/'.$chpu_factory.'", "shop", "29", "'.$id.'", "0")');
								$factoryID = $id;
							} else {
								$factoryID = $res['id'];
								$chp = DB::fetch_array(DB::query('SELECT rewrite FROM diafan_rewrite WHERE module_name = "shop" AND site_id = "29" AND cat_id = "'.$factoryID.'"'));
								if($chp) $chpu_factory = str_replace($chpu_country.'/', '', $chp['rewrite']);
								DB::query('UPDATE diafan_shop_category SET act1 = "1" WHERE id = "'.$factoryID.'"');
							}

							// collection
							$res = DB::fetch_array(DB::query('SELECT id FROM {shop} WHERE [name] = "'.$collection.'" AND cat_id = "'.$factoryID.'"'));
							if(!$res)
							{
								DB::query('INSERT INTO diafan_shop (name1, act1, cat_id, site_id, title_meta1, admin_id, trash) VALUES ("'.$collection.'", "1", "'.$factoryID.'", "29", "'.$collection.'", "1", "0")');
								$id = DB::last_id('shop');
								DB::query('INSERT INTO diafan_shop_category_rel (element_id, cat_id) VALUES ("'.$id.'", "'.$factoryID.'")');
								DB::query('INSERT INTO diafan_shop_category_rel (element_id, cat_id) VALUES ("'.$id.'", "'.$countryID.'")');
								DB::query('INSERT INTO diafan_rewrite (rewrite, module_name, site_id, element_id, trash) VALUES ("'.$chpu_country.'/'.$chpu_factory.'/'.$chpu_collection.'", "shop", "29", "'.$id.'", "0")');
								
								$collectionID = $id;

								if($tmp_last_sort_id == 0) $tmp_last_sort_id = $collectionID;

								if($tmp_last_sort_id != $collectionID)
								{
									DB::query('UPDATE {shop} SET order_ex = "'.$order_ex.'" WHERE id = "'.$collectionID.'"');
									$tmp_last_sort = $order_ex;
									$tmp_last_sort_id = $collectionID;
								} else {
									if($order_ex > $tmp_last_sort)
									{
										DB::query('UPDATE {shop} SET order_ex = "'.$order_ex.'" WHERE id = "'.$collectionID.'"');
										$tmp_last_sort = $order_ex;
									}
								}

								// DB::query('INSERT INTO diafan_shop_category_parents (element_id, parent_id) VALUES ("'.$collectionID.'", "'.$factoryID.'")');

								$usefor_tmp = explode(',', $usefor);
								if(count($usefor_tmp) > 1)
								{
									foreach($usefor_tmp as $val_usf)
									{
										$val_usf = trim($val_usf);

										$ges = DB::fetch_array(DB::query('SELECT id FROM diafan_shop_param_select WHERE name1 = "'.$val_usf.'" AND param_id = "2"'));
										if(!$ges)
										{
											DB::query('INSERT INTO diafan_shop_param_select (param_id, name1) VALUES ("2", "'.$val_usf.'")');
											$id = DB::last_id('shop_param_select');
											DB::query('UPDATE {shop_param_select} SET sort = "'.$pid.'" WHERE id="'.$pid.'"');
											DB::query('INSERT INTO diafan_rewrite (rewrite, module_name, site_id, param_id, trash) VALUES ("'.$this->str2url($val_usf).'", "shop", "29", "'.$id.'", "0")');
											$paramID = $id;
										} else $paramID = $ges['id'];

										DB::query('INSERT INTO diafan_shop_param_element (value1, param_id, element_id) VALUES ("'.$paramID.'", "2", "'.$collectionID.'")');
									}
								} else {
									$ges = DB::fetch_array(DB::query('SELECT id FROM diafan_shop_param_select WHERE name1 = "'.$usefor.'" AND param_id = "2"'));
									if(!$ges)
									{
										DB::query('INSERT INTO diafan_shop_param_select (param_id, name1) VALUES ("2", "'.$usefor.'")');
										$id = DB::last_id('shop_param_select');
										DB::query('UPDATE {shop_param_select} SET sort = "'.$pid.'" WHERE id="'.$pid.'"');
										DB::query('INSERT INTO diafan_rewrite (rewrite, module_name, site_id, param_id, trash) VALUES ("'.$this->str2url($usefor).'", "shop", "29", "'.$id.'", "0")');
										$paramID = $id;
									} else $paramID = $ges['id'];

									DB::query('INSERT INTO diafan_shop_param_element (value1, param_id, element_id) VALUES ("'.$paramID.'", "2", "'.$collectionID.'")');
								}

								if(!empty($collection_price))
								{
									DB::query('INSERT INTO diafan_shop_param_element (value1, param_id, element_id) VALUES ("'.$collection_price.'", "8", "'.$collectionID.'")');
									DB::query('INSERT INTO diafan_shop_param_element (value1, param_id, element_id) VALUES ("'.$type_size.'", "9", "'.$collectionID.'")');
								}

							} else {
								$collectionID = $res['id'];
								DB::query('UPDATE diafan_shop SET act1 = "1" WHERE id = "'.$collectionID.'"');

								$chp = DB::fetch_array(DB::query('SELECT rewrite FROM diafan_rewrite WHERE module_name = "shop" AND site_id = "29" AND element_id = "'.$collectionID.'"'));
								if($chp) $chpu_collection = str_replace($chpu_country.'/'.$chpu_factory.'/', '', $chp['rewrite']);
								
								// order ----------------------------------------------------------------
								if($tmp_last_sort_id == 0) $tmp_last_sort_id = $collectionID;

								if($tmp_last_sort_id != $collectionID && $order_ex != 0)
								{
									DB::query('UPDATE {shop} SET order_ex = "'.$order_ex.'" WHERE id = "'.$collectionID.'"');
									$tmp_last_sort = $order_ex;
									$tmp_last_sort_id = $collectionID;
								} else {
									if($order_ex > $tmp_last_sort && $order_ex != 0)
									{
										DB::query('UPDATE {shop} SET order_ex = "'.$order_ex.'" WHERE id = "'.$collectionID.'"');
										$tmp_last_sort = $order_ex;
									}
								}
								// -----------------------------------------------------------------------
								
								$usefor_tmp = explode(',', $usefor);
								if(count($usefor_tmp) > 1)
								{
									foreach($usefor_tmp as $val_usf)
									{
										$val_usf = trim($val_usf);
										$ges = DB::fetch_array(DB::query('SELECT id FROM diafan_shop_param_select WHERE name1 = "'.$val_usf.'" AND param_id = "2"'));
										if($ges)
										{
											DB::query('UPDATE {shop_param_select} SET act = "1" WHERE id="'.$ges['id'].'"');
											DB::query('INSERT INTO diafan_shop_param_element (value1, param_id, element_id) VALUES ("'.$ges['id'].'", "2", "'.$collectionID.'")');
										}
									}
								} else {
									$ges = DB::fetch_array(DB::query('SELECT id FROM diafan_shop_param_select WHERE name1 = "'.$usefor.'" AND param_id = "2"'));
									if($ges)
									{
										DB::query('UPDATE {shop_param_select} SET act = "1" WHERE id="'.$ges['id'].'"');
										DB::query('INSERT INTO diafan_shop_param_element (value1, param_id, element_id) VALUES ("'.$ges['id'].'", "2", "'.$collectionID.'")');
									}
								}

								if(!empty($collection_price))
								{
									$ges = DB::fetch_array(DB::query('SELECT id FROM diafan_shop_param_element WHERE element_id="'.$collectionID.'" AND param_id = "8"'));
									if($ges)
									{
										DB::query('UPDATE diafan_shop_param_element SET value1 = "'.$collection_price.'" WHERE element_id="'.$collectionID.'" AND param_id = "8"');
									} else {
										DB::query('INSERT INTO diafan_shop_param_element (value1, param_id, element_id) VALUES ("'.$collection_price.'", "8", "'.$collectionID.'")');
									}

									$ges = DB::fetch_array(DB::query('SELECT id FROM diafan_shop_param_element WHERE element_id="'.$collectionID.'" AND param_id = "9"'));
									if($ges)
									{
										DB::query('UPDATE diafan_shop_param_element SET value1 = "'.$type_size.'" WHERE element_id="'.$collectionID.'" AND param_id = "9"');
									} else {
										DB::query('INSERT INTO diafan_shop_param_element (value1, param_id, element_id) VALUES ("'.$type_size.'", "9", "'.$collectionID.'")');
									}
								}
							}

							// element
							$res = DB::fetch_array(DB::query('SELECT s.id FROM {shop} s 
																	LEFT JOIN {shop_rel} sr ON sr.rel_element_id = s.id
																WHERE sr.element_id = "'.$collectionID.'" AND s.[name] = "'.$element.'" AND s.cat_id = "8"'));
							if(!$res)
							{
								DB::query('INSERT INTO diafan_shop (name1, act1, cat_id, site_id, title_meta1, admin_id, trash) VALUES ("'.$element.'", "1", "8", "29", "'.$element.'", "1", "0")');
								$id = DB::last_id('shop');
								DB::query('INSERT INTO diafan_shop_category_rel (element_id, cat_id) VALUES ("'.$id.'", "8")');
								DB::query('INSERT INTO diafan_shop_rel (element_id, rel_element_id) VALUES ("'.$collectionID.'", "'.$id.'")');
								DB::query('INSERT INTO diafan_rewrite (rewrite, module_name, site_id, element_id, trash) VALUES ("'.$chpu_country.'/'.$chpu_factory.'/'.$chpu_collection.'/'.$chpu_element.'", "shop", "29", "'.$id.'", "0")');

								DB::query('INSERT INTO diafan_shop_price (good_id, price) VALUES ("'.$id.'", "'.$price.'")');
								$pid = DB::last_id('shop_price');
								DB::query('UPDATE diafan_shop_price SET price_id = "'.$pid.'" WHERE id = "'.$pid.'"');
								
								// DB::query('INSERT INTO diafan_shop_category_parents (element_id, parent_id) VALUES ("'.$id.'", "8")');

								DB::query('INSERT INTO diafan_shop_param_element (value1, param_id, element_id) VALUES ("'.$type_size.'", "5", "'.$id.'")');
								DB::query('INSERT INTO diafan_shop_param_element (value1, param_id, element_id) VALUES ("'.$size.'", "4", "'.$id.'")');

								$ges = DB::fetch_array(DB::query('SELECT id FROM diafan_shop_param_select WHERE name1 = "'.$material.'" AND param_id = "3"'));
								if(!$ges)
								{
									DB::query('INSERT INTO diafan_shop_param_select (param_id, name1) VALUES ("3", "'.$material.'")');
									$pid = DB::last_id('shop_param_select');
									DB::query('UPDATE {shop_param_select} SET sort = "'.$pid.'" WHERE id="'.$pid.'"');
									DB::query('INSERT INTO diafan_rewrite (rewrite, module_name, site_id, param_id, trash) VALUES ("'.$this->str2url($material).'", "shop", "29", "'.$pid.'", "0")');
									$paramID = $pid;
								} else $paramID = $ges['id'];

								DB::query('INSERT INTO diafan_shop_param_element (value1, param_id, element_id) VALUES ("'.$paramID.'", "3", "'.$id.'")');
								
								
/////////////////////
									$ges = DB::fetch_array(DB::query('SELECT id FROM diafan_shop_param_select WHERE name1 = "'.$dop_parameter1.'" AND param_id = "10"'));
									if(!$ges)
									{
										DB::query('INSERT INTO diafan_shop_param_select (param_id, name1) VALUES ("10", "'.$dop_parameter1.'")');
										$pid = DB::last_id('shop_param_select');
										DB::query('UPDATE {shop_param_select} SET sort = "'.$pid.'" WHERE id="'.$pid.'"');
										DB::query('INSERT INTO diafan_rewrite (rewrite, module_name, site_id, param_id, trash) VALUES ("'.$this->str2url($dop_parameter1).'", "shop", "29", "'.$pid.'", "0")');
										$paramID = $pid;
									} else $paramID = $ges['id'];

									DB::query('INSERT INTO diafan_shop_param_element (value1, param_id, element_id) VALUES ("'.$dop_parameter1.'", "10", "'.$id.'")');
///////////////////////		

/////////////////////
									$ges = DB::fetch_array(DB::query('SELECT id FROM diafan_shop_param_select WHERE name1 = "'.$dop_parameter2.'" AND param_id = "11"'));
									if(!$ges)
									{
										DB::query('INSERT INTO diafan_shop_param_select (param_id, name1) VALUES ("11", "'.$dop_parameter2.'")');
										$pid = DB::last_id('shop_param_select');
										DB::query('UPDATE {shop_param_select} SET sort = "'.$pid.'" WHERE id="'.$pid.'"');
										DB::query('INSERT INTO diafan_rewrite (rewrite, module_name, site_id, param_id, trash) VALUES ("'.$this->str2url($dop_parameter2).'", "shop", "29", "'.$pid.'", "0")');
										$paramID = $pid;
									} else $paramID = $ges['id'];

									DB::query('INSERT INTO diafan_shop_param_element (value1, param_id, element_id) VALUES ("'.$dop_parameter2.'", "11", "'.$id.'")');
///////////////////////		

/////////////////////
									$ges = DB::fetch_array(DB::query('SELECT id FROM diafan_shop_param_select WHERE name1 = "'.$dop_parameter3.'" AND param_id = "12"'));
									if(!$ges)
									{
										DB::query('INSERT INTO diafan_shop_param_select (param_id, name1) VALUES ("12", "'.$dop_parameter3.'")');
										$pid = DB::last_id('shop_param_select');
										DB::query('UPDATE {shop_param_select} SET sort = "'.$pid.'" WHERE id="'.$pid.'"');
										DB::query('INSERT INTO diafan_rewrite (rewrite, module_name, site_id, param_id, trash) VALUES ("'.$this->str2url($dop_parameter3).'", "shop", "29", "'.$pid.'", "0")');
										$paramID = $pid;
									} else $paramID = $ges['id'];

									DB::query('INSERT INTO diafan_shop_param_element (value1, param_id, element_id) VALUES ("'.$dop_parameter3.'", "12", "'.$id.'")');
///////////////////////											
									

								
								
								
								
								$plitka_type = mb_convert_case(trim($plitka_type), MB_CASE_LOWER, "UTF-8");

								$type_id = 0;

								if($plitka_type == 'настенная плитка' || $plitka_type == 'настенный керамогранит' || $plitka_type == 'клинкерная плитка') $type_id = 17;
								if($plitka_type == 'напольная плитка' || $plitka_type == 'напольный керамогранит' || $plitka_type == 'базовая плитка') $type_id = 18;
								
								/*
								if(strripos($plitka_type, 'настенная плитка') !== false) $type_id = 17;
								if(strripos($plitka_type, 'напольная плитка') !== false || strripos($plitka_type, 'базовая плитка') !== false || strripos($plitka_type == 'плитка напольная') !== false) $type_id = 18;
								*/

								if($type_id == 0) $type_id = 16;

								DB::query('INSERT INTO {shop_param_element} (value1, param_id, element_id) VALUES ("'.$type_id.'", "6", "'.$id.'")');
								DB::query('INSERT INTO {shop_param_element} (value1, param_id, element_id) VALUES ("'.$plitka_type.'", "7", "'.$id.'")');
							} else {
								DB::query('UPDATE diafan_shop SET act1 = "1" WHERE id = "'.$res['id'].'"');
								DB::query('UPDATE diafan_shop_price SET price = "'.$price.'" WHERE good_id = "'.$res['id'].'"');

								$ges = DB::fetch_array(DB::query('SELECT id FROM diafan_shop_param_select WHERE name1 = "'.$material.'" AND param_id = "3"'));
								if($ges)
								{
									DB::query('UPDATE {shop_param_select} SET act = "1" WHERE id="'.$ges['id'].'"');
								}
								
								$ges = DB::fetch_array(DB::query('SELECT id FROM diafan_shop_param_select WHERE name1 = "'.$dop_parameter1.'" AND param_id = "10"'));
									if($ges)
									{
										DB::query('UPDATE {shop_param_select} SET act = "1" WHERE id="'.$ges['id'].'"');
									}
									
									
									$ges = DB::fetch_array(DB::query('SELECT id FROM diafan_shop_param_select WHERE name1 = "'.$dop_parameter2.'" AND param_id = "11"'));
									if($ges)
									{
										DB::query('UPDATE {shop_param_select} SET act = "1" WHERE id="'.$ges['id'].'"');
									}
									
									
									$ges = DB::fetch_array(DB::query('SELECT id FROM diafan_shop_param_select WHERE name1 = "'.$dop_parameter3.'" AND param_id = "12"'));
									if($ges)
									{
										DB::query('UPDATE {shop_param_select} SET act = "1" WHERE id="'.$ges['id'].'"');
									}
								
								// ==============================================================================================================================================
								$mes = DB::num_rows(DB::query('SELECT id FROM {shop_param_element} WHERE element_id = "'.$res['id'].'"'));
								if($mes == 0)
								{
									DB::query('INSERT INTO diafan_shop_param_element (value1, param_id, element_id) VALUES ("'.$type_size.'", "5", "'.$res['id'].'")');
									DB::query('INSERT INTO diafan_shop_param_element (value1, param_id, element_id) VALUES ("'.$size.'", "4", "'.$res['id'].'")');
									$ges = DB::fetch_array(DB::query('SELECT id FROM diafan_shop_param_select WHERE name1 = "'.$material.'" AND param_id = "3"'));
									if(!$ges)
									{
										DB::query('INSERT INTO diafan_shop_param_select (param_id, name1) VALUES ("3", "'.$material.'")');
										$pid = DB::last_id('shop_param_select');
										DB::query('UPDATE {shop_param_select} SET sort = "'.$pid.'" WHERE id="'.$pid.'"');
										DB::query('INSERT INTO diafan_rewrite (rewrite, module_name, site_id, param_id, trash) VALUES ("'.$this->str2url($material).'", "shop", "29", "'.$pid.'", "0")');
										$paramID = $pid;
									} else $paramID = $ges['id'];

									DB::query('INSERT INTO diafan_shop_param_element (value1, param_id, element_id) VALUES ("'.$paramID.'", "3", "'.$res['id'].'")');


									
										$ges = DB::fetch_array(DB::query('SELECT id FROM diafan_shop_param_select WHERE name1 = "'.$dop_parameter1.'" AND param_id = "10"'));
										if(!$ges)
										{
											DB::query('INSERT INTO diafan_shop_param_select (param_id, name1) VALUES ("10", "'.$dop_parameter1.'")');
											$pid = DB::last_id('shop_param_select');
											DB::query('UPDATE {shop_param_select} SET sort = "'.$pid.'" WHERE id="'.$pid.'"');
											DB::query('INSERT INTO diafan_rewrite (rewrite, module_name, site_id, param_id, trash) VALUES ("'.$this->str2url($dop_parameter1).'", "shop", "29", "'.$pid.'", "0")');
											$paramID = $pid;
										} else $paramID = $ges['id'];

										DB::query('INSERT INTO diafan_shop_param_element (value1, param_id, element_id) VALUES ("'.$dop_parameter1.'", "10", "'.$res['id'].'")');
										
		
										
										
										$ges = DB::fetch_array(DB::query('SELECT id FROM diafan_shop_param_select WHERE name1 = "'.$dop_parameter2.'" AND param_id = "11"'));
										if(!$ges)
										{
											DB::query('INSERT INTO diafan_shop_param_select (param_id, name1) VALUES ("11", "'.$dop_parameter2.'")');
											$pid = DB::last_id('shop_param_select');
											DB::query('UPDATE {shop_param_select} SET sort = "'.$pid.'" WHERE id="'.$pid.'"');
											DB::query('INSERT INTO diafan_rewrite (rewrite, module_name, site_id, param_id, trash) VALUES ("'.$this->str2url($dop_parameter2).'", "shop", "29", "'.$pid.'", "0")');
											$paramID = $pid;
										} else $paramID = $ges['id'];

										DB::query('INSERT INTO diafan_shop_param_element (value1, param_id, element_id) VALUES ("'.$dop_parameter2.'", "11", "'.$res['id'].'")');
										
	
	
										
										
										$ges = DB::fetch_array(DB::query('SELECT id FROM diafan_shop_param_select WHERE name1 = "'.$dop_parameter3.'" AND param_id = "12"'));
										if(!$ges)
										{
											DB::query('INSERT INTO diafan_shop_param_select (param_id, name1) VALUES ("12", "'.$dop_parameter3.'")');
											$pid = DB::last_id('shop_param_select');
											DB::query('UPDATE {shop_param_select} SET sort = "'.$pid.'" WHERE id="'.$pid.'"');
											DB::query('INSERT INTO diafan_rewrite (rewrite, module_name, site_id, param_id, trash) VALUES ("'.$this->str2url($dop_parameter3).'", "shop", "29", "'.$pid.'", "0")');
											$paramID = $pid;
										} else $paramID = $ges['id'];

										DB::query('INSERT INTO diafan_shop_param_element (value1, param_id, element_id) VALUES ("'.$dop_parameter3.'", "12", "'.$res['id'].'")');
										
										



									$plitka_type = mb_convert_case(trim($plitka_type), MB_CASE_LOWER, "UTF-8");

									$type_id = 0;

									if($plitka_type == 'настенная плитка' || $plitka_type == 'настенный керамогранит' || $plitka_type == 'клинкерная плитка') $type_id = 17;
									if($plitka_type == 'напольная плитка' || $plitka_type == 'напольный керамогранит' || $plitka_type == 'базовая плитка') $type_id = 18;
									
									/*
									if(strripos($plitka_type, 'настенная плитка') !== false) $type_id = 17;
									if(strripos($plitka_type, 'напольная плитка') !== false || strripos($plitka_type, 'базовая плитка') !== false || strripos($plitka_type == 'плитка напольная') !== false) $type_id = 18;
									*/

									if($type_id == 0) $type_id = 16;

									DB::query('INSERT INTO {shop_param_element} (value1, param_id, element_id) VALUES ("'.$type_id.'", "6", "'.$res['id'].'")');
									DB::query('INSERT INTO {shop_param_element} (value1, param_id, element_id) VALUES ("'.$plitka_type.'", "7", "'.$res['id'].'")');
								}
								// ================================================================================================================================================
							}
						}
					}

					$res = DB::query('SELECT id FROM {shop_category} WHERE parent_id = "0"');
					while($elem = DB::fetch_array($res))
					{
						$count = DB::num_rows(DB::query('SELECT id FROM {shop_category} WHERE parent_id = "'.$elem['id'].'"'));
						DB::query('UPDATE {shop_category} SET count_children = "'.$count.'" WHERE id = "'.$elem['id'].'"');
					}

					DB::query('UPDATE {shop} SET order_ex = "9999" WHERE order_ex = "0" AND cat_id != "8"');
				}

			} else if($ext == 'xlsx'){
				

				include_once('simplexlsx.class.php');
					
				$xlsx = new SimpleXLSX($_FILES['excel_file']['tmp_name']);

				$rows = $xlsx->rows(1);		// берем все строки на первом листе

				$cp = count($rows);			// кол-во строк	
				$colsp = count($rows[0]);	// кол-во столбцов в строке
					
				if($cp > 0)
				{
						DB::query('UPDATE diafan_shop SET act1 = "0"');
						DB::query('UPDATE diafan_shop_category SET act1 = "0"');
						DB::query('UPDATE {shop_param_select} SET act = "0"');
						DB::query('UPDATE diafan_shop_param_element SET value1 = "0" WHERE param_id = "8"');
						DB::query('TRUNCATE diafan_shop_param_element');

						$tmp_last_sort = 0;
						$tmp_last_sort_id = 0;

						for($i = 1; $i < $cp; $i++)
						{
							 //echo '<pre>';
							 //print_r($rows[$i]);
							 //echo '</pre>';
							// echo "===================";
							# die();
							$country = $rows[$i][1];
							$factory = $rows[$i][2];
							$collection = $rows[$i][3];
							$collection_price = $rows[$i][11];
							$usefor = $rows[$i][4];
							$material = $rows[$i][5];
							
							$dop_parameter1=$rows[$i][26];//штук в коробке
							$dop_parameter2=$rows[$i][27];//кв.м. в коробке
							$dop_parameter3=$rows[$i][28];//вес коробки
							//echo "<br>".$dop_parameter1 ." - ".$dop_parameter2." - ".$dop_parameter3."<br>";
							
							
							$order_ex = intval($rows[$i][6]);

							$element = $rows[$i][7];
							$plitka_type = $rows[$i][8];
							$price = $rows[$i][9];
							$type_size = str_replace('.', '', $rows[$i][10]);
							$size = $rows[$i][12].' '.$rows[$i][13];

							$chpu_country		= $this->str2url($country);
							$chpu_factory		= $this->str2url($factory);
							$chpu_collection	= $this->str2url($collection);
							$chpu_element		= $this->str2url($element);

							if(!empty($country) && !empty($factory) && !empty($collection) && !empty($element))
							{
								// country
								$res = DB::fetch_array(DB::query('SELECT id FROM {shop_category} WHERE [name] = "'.$country.'" AND parent_id = "0"'));
								if(!$res)
								{
									DB::query('INSERT INTO diafan_shop_category (name1, act1, parent_id, site_id, title_meta1, admin_id, trash) VALUES ("'.$country.'", "1", "0", "29", "'.$country.'", "1", "0")');
									$id = DB::last_id('shop_category');
									DB::query('INSERT INTO diafan_rewrite (rewrite, module_name, site_id, cat_id, trash) VALUES ("'.$chpu_country.'", "shop", "29", "'.$id.'", "0")');
									$countryID = $id;
								} else {
									$countryID = $res['id'];
									$chp = DB::fetch_array(DB::query('SELECT rewrite FROM diafan_rewrite WHERE module_name = "shop" AND site_id = "29" AND cat_id = "'.$countryID.'"'));
									if($chp) $chpu_country = $chp['rewrite'];
									DB::query('UPDATE diafan_shop_category SET act1 = "1" WHERE id = "'.$countryID.'"');
								}

								// factory
								$res = DB::fetch_array(DB::query('SELECT id FROM {shop_category} WHERE [name] = "'.$factory.'" AND parent_id = "'.$countryID.'"'));
								if(!$res)
								{
									DB::query('INSERT INTO diafan_shop_category (name1, act1, parent_id, site_id, title_meta1, admin_id, trash) VALUES ("'.$factory.'", "1", "'.$countryID.'", "29", "'.$factory.'", "1", "0")');
									$id = DB::last_id('shop_category');
									DB::query('INSERT INTO diafan_rewrite (rewrite, module_name, site_id, cat_id, trash) VALUES ("'.$chpu_country.'/'.$chpu_factory.'", "shop", "29", "'.$id.'", "0")');
									$factoryID = $id;
								} else {
									$factoryID = $res['id'];
									$chp = DB::fetch_array(DB::query('SELECT rewrite FROM diafan_rewrite WHERE module_name = "shop" AND site_id = "29" AND cat_id = "'.$factoryID.'"'));
									if($chp) $chpu_factory =  str_replace($chpu_country.'/', '', $chp['rewrite']);
									DB::query('UPDATE diafan_shop_category SET act1 = "1" WHERE id = "'.$factoryID.'"');
								}

								// collection
								$res = DB::fetch_array(DB::query('SELECT id FROM {shop} WHERE [name] = "'.$collection.'" AND cat_id = "'.$factoryID.'"'));
								if(!$res)
								{
									DB::query('INSERT INTO diafan_shop (name1, act1, cat_id, site_id, title_meta1, admin_id, trash) VALUES ("'.$collection.'", "1", "'.$factoryID.'", "29", "'.$collection.'", "1", "0")');
									$id = DB::last_id('shop');
									DB::query('INSERT INTO diafan_shop_category_rel (element_id, cat_id) VALUES ("'.$id.'", "'.$factoryID.'")');
									DB::query('INSERT INTO diafan_shop_category_rel (element_id, cat_id) VALUES ("'.$id.'", "'.$countryID.'")');
									DB::query('INSERT INTO diafan_rewrite (rewrite, module_name, site_id, element_id, trash) VALUES ("'.$chpu_country.'/'.$chpu_factory.'/'.$chpu_collection.'", "shop", "29", "'.$id.'", "0")');
									
									$collectionID = $id;

									if($tmp_last_sort_id == 0) $tmp_last_sort_id = $collectionID;

									if($tmp_last_sort_id != $collectionID)
									{
										DB::query('UPDATE {shop} SET order_ex = "'.$order_ex.'" WHERE id = "'.$collectionID.'"');
										$tmp_last_sort = $order_ex;
										$tmp_last_sort_id = $collectionID;
									} else {
										if($order_ex > $tmp_last_sort)
										{
											DB::query('UPDATE {shop} SET order_ex = "'.$order_ex.'" WHERE id = "'.$collectionID.'"');
											$tmp_last_sort = $order_ex;
										}
									}

									// DB::query('INSERT INTO diafan_shop_category_parents (element_id, parent_id) VALUES ("'.$collectionID.'", "'.$factoryID.'")');
									$usefor_tmp = explode(',', $usefor);
									if(count($usefor_tmp) > 1)
									{
										foreach($usefor_tmp as $val_usf)
										{
											$val_usf = trim($val_usf);

											$ges = DB::fetch_array(DB::query('SELECT id FROM diafan_shop_param_select WHERE name1 = "'.$val_usf.'" AND param_id = "2"'));
											if(!$ges)
											{
												DB::query('INSERT INTO diafan_shop_param_select (param_id, name1) VALUES ("2", "'.$val_usf.'")');
												$id = DB::last_id('shop_param_select');
												DB::query('UPDATE {shop_param_select} SET sort = "'.$pid.'" WHERE id="'.$pid.'"');
												DB::query('INSERT INTO diafan_rewrite (rewrite, module_name, site_id, param_id, trash) VALUES ("'.$this->str2url($val_usf).'", "shop", "29", "'.$id.'", "0")');
												$paramID = $id;
											} else $paramID = $ges['id'];

											DB::query('INSERT INTO diafan_shop_param_element (value1, param_id, element_id) VALUES ("'.$paramID.'", "2", "'.$collectionID.'")');
										}
									} else {
										$ges = DB::fetch_array(DB::query('SELECT id FROM diafan_shop_param_select WHERE name1 = "'.$usefor.'" AND param_id = "2"'));
										if(!$ges)
										{
											DB::query('INSERT INTO diafan_shop_param_select (param_id, name1) VALUES ("2", "'.$usefor.'")');
											$id = DB::last_id('shop_param_select');
											DB::query('UPDATE {shop_param_select} SET sort = "'.$pid.'" WHERE id="'.$pid.'"');
											DB::query('INSERT INTO diafan_rewrite (rewrite, module_name, site_id, param_id, trash) VALUES ("'.$this->str2url($usefor).'", "shop", "29", "'.$id.'", "0")');
											$paramID = $id;
										} else $paramID = $ges['id'];

										DB::query('INSERT INTO diafan_shop_param_element (value1, param_id, element_id) VALUES ("'.$paramID.'", "2", "'.$collectionID.'")');
									}

									if(!empty($collection_price))
									{
										DB::query('INSERT INTO diafan_shop_param_element (value1, param_id, element_id) VALUES ("'.$collection_price.'", "8", "'.$collectionID.'")');
										DB::query('INSERT INTO diafan_shop_param_element (value1, param_id, element_id) VALUES ("'.$type_size.'", "9", "'.$collectionID.'")');
									}

								} else {
									$collectionID = $res['id'];
									DB::query('UPDATE diafan_shop SET act1 = "1" WHERE id = "'.$collectionID.'"');
									
									$chp = DB::fetch_array(DB::query('SELECT rewrite FROM diafan_rewrite WHERE module_name = "shop" AND site_id = "29" AND element_id = "'.$collectionID.'"'));
									if($chp) $chpu_collection = str_replace($chpu_country.'/'.$chpu_factory.'/', '', $chp['rewrite']);

									// order ----------------------------------------------------------------
									if($tmp_last_sort_id == 0) $tmp_last_sort_id = $collectionID;

									if($tmp_last_sort_id != $collectionID && $order_ex != 0)
									{
										DB::query('UPDATE {shop} SET order_ex = "'.$order_ex.'" WHERE id = "'.$collectionID.'"');
										$tmp_last_sort = $order_ex;
										$tmp_last_sort_id = $collectionID;
									} else {
										if($order_ex > $tmp_last_sort && $order_ex != 0)
										{
											DB::query('UPDATE {shop} SET order_ex = "'.$order_ex.'" WHERE id = "'.$collectionID.'"');
											$tmp_last_sort = $order_ex;
										}
									}
									// -----------------------------------------------------------------------

									$usefor_tmp = explode(',', $usefor);
									if(count($usefor_tmp) > 1)
									{
										foreach($usefor_tmp as $val_usf)
										{
											$val_usf = trim($val_usf);
											$ges = DB::fetch_array(DB::query('SELECT id FROM diafan_shop_param_select WHERE name1 = "'.$val_usf.'" AND param_id = "2"'));
											if($ges)
											{
												DB::query('UPDATE {shop_param_select} SET act = "1" WHERE id="'.$ges['id'].'"');
												DB::query('INSERT INTO diafan_shop_param_element (value1, param_id, element_id) VALUES ("'.$ges['id'].'", "2", "'.$collectionID.'")');
											}
										}
									} else {
										$ges = DB::fetch_array(DB::query('SELECT id FROM diafan_shop_param_select WHERE name1 = "'.$usefor.'" AND param_id = "2"'));
										if($ges)
										{
											DB::query('UPDATE {shop_param_select} SET act = "1" WHERE id="'.$ges['id'].'"');
											DB::query('INSERT INTO diafan_shop_param_element (value1, param_id, element_id) VALUES ("'.$ges['id'].'", "2", "'.$collectionID.'")');
										}
									}

									if(!empty($collection_price))
									{
										$ges = DB::fetch_array(DB::query('SELECT id FROM diafan_shop_param_element WHERE element_id="'.$collectionID.'" AND param_id = "8"'));
										if($ges)
										{
											DB::query('UPDATE diafan_shop_param_element SET value1 = "'.$collection_price.'" WHERE element_id="'.$collectionID.'" AND param_id = "8"');
										} else {
											DB::query('INSERT INTO diafan_shop_param_element (value1, param_id, element_id) VALUES ("'.$collection_price.'", "8", "'.$collectionID.'")');
										}

										$ges = DB::fetch_array(DB::query('SELECT id FROM diafan_shop_param_element WHERE element_id="'.$collectionID.'" AND param_id = "9"'));
										if($ges)
										{
											DB::query('UPDATE diafan_shop_param_element SET value1 = "'.$type_size.'" WHERE element_id="'.$collectionID.'" AND param_id = "9"');
										} else {
											DB::query('INSERT INTO diafan_shop_param_element (value1, param_id, element_id) VALUES ("'.$type_size.'", "9", "'.$collectionID.'")');
										}
									}
								}

								// element
								$res = DB::fetch_array(DB::query('SELECT s.id FROM {shop} s 
																		LEFT JOIN {shop_rel} sr ON sr.rel_element_id = s.id
																	WHERE sr.element_id = "'.$collectionID.'" AND s.[name] = "'.$element.'" AND s.cat_id = "8"'));
								if(!$res)
								{
									DB::query('INSERT INTO diafan_shop (name1, act1, cat_id, site_id, title_meta1, admin_id, trash) VALUES ("'.$element.'", "1", "8", "29", "'.$element.'", "1", "0")');
									$id = DB::last_id('shop');
									DB::query('INSERT INTO diafan_shop_category_rel (element_id, cat_id) VALUES ("'.$id.'", "8")');
									DB::query('INSERT INTO diafan_shop_rel (element_id, rel_element_id) VALUES ("'.$collectionID.'", "'.$id.'")');
									DB::query('INSERT INTO diafan_rewrite (rewrite, module_name, site_id, element_id, trash) VALUES ("'.$chpu_country.'/'.$chpu_factory.'/'.$chpu_collection.'/'.$chpu_element.'", "shop", "29", "'.$id.'", "0")');

									DB::query('INSERT INTO diafan_shop_price (good_id, price) VALUES ("'.$id.'", "'.$price.'")');
									$pid = DB::last_id('shop_price');
									DB::query('UPDATE diafan_shop_price SET price_id = "'.$pid.'" WHERE id = "'.$pid.'"');
									
									// DB::query('INSERT INTO diafan_shop_category_parents (element_id, parent_id) VALUES ("'.$id.'", "8")');

									DB::query('INSERT INTO diafan_shop_param_element (value1, param_id, element_id) VALUES ("'.$type_size.'", "5", "'.$id.'")');
									DB::query('INSERT INTO diafan_shop_param_element (value1, param_id, element_id) VALUES ("'.$size.'", "4", "'.$id.'")');





/////////////////////
									$ges = DB::fetch_array(DB::query('SELECT id FROM diafan_shop_param_select WHERE name1 = "'.$material.'" AND param_id = "3"'));
									if(!$ges)
									{
										DB::query('INSERT INTO diafan_shop_param_select (param_id, name1) VALUES ("3", "'.$material.'")');
										$pid = DB::last_id('shop_param_select');
										DB::query('UPDATE {shop_param_select} SET sort = "'.$pid.'" WHERE id="'.$pid.'"');
										DB::query('INSERT INTO diafan_rewrite (rewrite, module_name, site_id, param_id, trash) VALUES ("'.$this->str2url($material).'", "shop", "29", "'.$pid.'", "0")');
										$paramID = $pid;
									} else $paramID = $ges['id'];

									DB::query('INSERT INTO diafan_shop_param_element (value1, param_id, element_id) VALUES ("'.$paramID.'", "3", "'.$id.'")');
///////////////////////									
									

/////////////////////
									$ges = DB::fetch_array(DB::query('SELECT id FROM diafan_shop_param_select WHERE name1 = "'.$dop_parameter1.'" AND param_id = "10"'));
									if(!$ges)
									{
										DB::query('INSERT INTO diafan_shop_param_select (param_id, name1) VALUES ("10", "'.$dop_parameter1.'")');
										$pid = DB::last_id('shop_param_select');
										DB::query('UPDATE {shop_param_select} SET sort = "'.$pid.'" WHERE id="'.$pid.'"');
										DB::query('INSERT INTO diafan_rewrite (rewrite, module_name, site_id, param_id, trash) VALUES ("'.$this->str2url($dop_parameter1).'", "shop", "29", "'.$pid.'", "0")');
										$paramID = $pid;
									} else $paramID = $ges['id'];

									DB::query('INSERT INTO diafan_shop_param_element (value1, param_id, element_id) VALUES ("'.$dop_parameter1.'", "10", "'.$id.'")');
///////////////////////		

/////////////////////
									$ges = DB::fetch_array(DB::query('SELECT id FROM diafan_shop_param_select WHERE name1 = "'.$dop_parameter2.'" AND param_id = "11"'));
									if(!$ges)
									{
										DB::query('INSERT INTO diafan_shop_param_select (param_id, name1) VALUES ("11", "'.$dop_parameter2.'")');
										$pid = DB::last_id('shop_param_select');
										DB::query('UPDATE {shop_param_select} SET sort = "'.$pid.'" WHERE id="'.$pid.'"');
										DB::query('INSERT INTO diafan_rewrite (rewrite, module_name, site_id, param_id, trash) VALUES ("'.$this->str2url($dop_parameter2).'", "shop", "29", "'.$pid.'", "0")');
										$paramID = $pid;
									} else $paramID = $ges['id'];

									DB::query('INSERT INTO diafan_shop_param_element (value1, param_id, element_id) VALUES ("'.$dop_parameter2.'", "11", "'.$id.'")');
///////////////////////		

/////////////////////
									$ges = DB::fetch_array(DB::query('SELECT id FROM diafan_shop_param_select WHERE name1 = "'.$dop_parameter3.'" AND param_id = "12"'));
									if(!$ges)
									{
										DB::query('INSERT INTO diafan_shop_param_select (param_id, name1) VALUES ("12", "'.$dop_parameter3.'")');
										$pid = DB::last_id('shop_param_select');
										DB::query('UPDATE {shop_param_select} SET sort = "'.$pid.'" WHERE id="'.$pid.'"');
										DB::query('INSERT INTO diafan_rewrite (rewrite, module_name, site_id, param_id, trash) VALUES ("'.$this->str2url($dop_parameter3).'", "shop", "29", "'.$pid.'", "0")');
										$paramID = $pid;
									} else $paramID = $ges['id'];

									DB::query('INSERT INTO diafan_shop_param_element (value1, param_id, element_id) VALUES ("'.$dop_parameter3.'", "12", "'.$id.'")');
///////////////////////											
									
									
									
									
									
									
									$plitka_type = mb_convert_case(trim($plitka_type), MB_CASE_LOWER, "UTF-8");

									$type_id = 0;

									if($plitka_type == 'настенная плитка' || $plitka_type == 'настенный керамогранит' || $plitka_type == 'клинкерная плитка') $type_id = 17;
									if($plitka_type == 'напольная плитка' || $plitka_type == 'напольный керамогранит' || $plitka_type == 'базовая плитка') $type_id = 18;
									
									/*
									if(strripos($plitka_type, 'настенная плитка') !== false) $type_id = 17;
									if(strripos($plitka_type, 'напольная плитка') !== false || strripos($plitka_type, 'базовая плитка') !== false || strripos($plitka_type == 'плитка напольная') !== false) $type_id = 18;
									*/

									if($type_id == 0) $type_id = 16;

									DB::query('INSERT INTO {shop_param_element} (value1, param_id, element_id) VALUES ("'.$type_id.'", "6", "'.$id.'")');
									DB::query('INSERT INTO {shop_param_element} (value1, param_id, element_id) VALUES ("'.$plitka_type.'", "7", "'.$id.'")');
								} else {
									DB::query('UPDATE diafan_shop SET act1 = "1" WHERE id = "'.$res['id'].'"');
									DB::query('UPDATE diafan_shop_price SET price = "'.$price.'" WHERE good_id = "'.$res['id'].'"');




//////////////////////////////////////
									$ges = DB::fetch_array(DB::query('SELECT id FROM diafan_shop_param_select WHERE name1 = "'.$material.'" AND param_id = "3"'));
									if($ges)
									{
										DB::query('UPDATE {shop_param_select} SET act = "1" WHERE id="'.$ges['id'].'"');
									}
									
									$ges = DB::fetch_array(DB::query('SELECT id FROM diafan_shop_param_select WHERE name1 = "'.$dop_parameter1.'" AND param_id = "10"'));
									if($ges)
									{
										DB::query('UPDATE {shop_param_select} SET act = "1" WHERE id="'.$ges['id'].'"');
									}
									
									
									$ges = DB::fetch_array(DB::query('SELECT id FROM diafan_shop_param_select WHERE name1 = "'.$dop_parameter2.'" AND param_id = "11"'));
									if($ges)
									{
										DB::query('UPDATE {shop_param_select} SET act = "1" WHERE id="'.$ges['id'].'"');
									}
									
									
									$ges = DB::fetch_array(DB::query('SELECT id FROM diafan_shop_param_select WHERE name1 = "'.$dop_parameter3.'" AND param_id = "12"'));
									if($ges)
									{
										DB::query('UPDATE {shop_param_select} SET act = "1" WHERE id="'.$ges['id'].'"');
									}
/////////////////////////////////////////									
									
									// ==============================================================================================================================================
									$mes = DB::num_rows(DB::query('SELECT id FROM {shop_param_element} WHERE element_id = "'.$res['id'].'"'));
									if($mes == 0)
									{
										DB::query('INSERT INTO diafan_shop_param_element (value1, param_id, element_id) VALUES ("'.$type_size.'", "5", "'.$res['id'].'")');
										DB::query('INSERT INTO diafan_shop_param_element (value1, param_id, element_id) VALUES ("'.$size.'", "4", "'.$res['id'].'")');
										
										
										
										
										
										////////////////////////////////////
										
										$ges = DB::fetch_array(DB::query('SELECT id FROM diafan_shop_param_select WHERE name1 = "'.$material.'" AND param_id = "3"'));
										if(!$ges)
										{
											DB::query('INSERT INTO diafan_shop_param_select (param_id, name1) VALUES ("3", "'.$material.'")');
											$pid = DB::last_id('shop_param_select');
											DB::query('UPDATE {shop_param_select} SET sort = "'.$pid.'" WHERE id="'.$pid.'"');
											DB::query('INSERT INTO diafan_rewrite (rewrite, module_name, site_id, param_id, trash) VALUES ("'.$this->str2url($material).'", "shop", "29", "'.$pid.'", "0")');
											$paramID = $pid;
										} else $paramID = $ges['id'];

										DB::query('INSERT INTO diafan_shop_param_element (value1, param_id, element_id) VALUES ("'.$paramID.'", "3", "'.$res['id'].'")');
										
										
										
										$ges = DB::fetch_array(DB::query('SELECT id FROM diafan_shop_param_select WHERE name1 = "'.$dop_parameter1.'" AND param_id = "10"'));
										if(!$ges)
										{
											DB::query('INSERT INTO diafan_shop_param_select (param_id, name1) VALUES ("10", "'.$dop_parameter1.'")');
											$pid = DB::last_id('shop_param_select');
											DB::query('UPDATE {shop_param_select} SET sort = "'.$pid.'" WHERE id="'.$pid.'"');
											DB::query('INSERT INTO diafan_rewrite (rewrite, module_name, site_id, param_id, trash) VALUES ("'.$this->str2url($dop_parameter1).'", "shop", "29", "'.$pid.'", "0")');
											$paramID = $pid;
										} else $paramID = $ges['id'];

										DB::query('INSERT INTO diafan_shop_param_element (value1, param_id, element_id) VALUES ("'.$dop_parameter1.'", "10", "'.$res['id'].'")');
										
		
										
										
										$ges = DB::fetch_array(DB::query('SELECT id FROM diafan_shop_param_select WHERE name1 = "'.$dop_parameter2.'" AND param_id = "11"'));
										if(!$ges)
										{
											DB::query('INSERT INTO diafan_shop_param_select (param_id, name1) VALUES ("11", "'.$dop_parameter2.'")');
											$pid = DB::last_id('shop_param_select');
											DB::query('UPDATE {shop_param_select} SET sort = "'.$pid.'" WHERE id="'.$pid.'"');
											DB::query('INSERT INTO diafan_rewrite (rewrite, module_name, site_id, param_id, trash) VALUES ("'.$this->str2url($dop_parameter2).'", "shop", "29", "'.$pid.'", "0")');
											$paramID = $pid;
										} else $paramID = $ges['id'];

										DB::query('INSERT INTO diafan_shop_param_element (value1, param_id, element_id) VALUES ("'.$dop_parameter2.'", "11", "'.$res['id'].'")');
										
	
	
										
										
										$ges = DB::fetch_array(DB::query('SELECT id FROM diafan_shop_param_select WHERE name1 = "'.$dop_parameter3.'" AND param_id = "12"'));
										if(!$ges)
										{
											DB::query('INSERT INTO diafan_shop_param_select (param_id, name1) VALUES ("12", "'.$dop_parameter3.'")');
											$pid = DB::last_id('shop_param_select');
											DB::query('UPDATE {shop_param_select} SET sort = "'.$pid.'" WHERE id="'.$pid.'"');
											DB::query('INSERT INTO diafan_rewrite (rewrite, module_name, site_id, param_id, trash) VALUES ("'.$this->str2url($dop_parameter3).'", "shop", "29", "'.$pid.'", "0")');
											$paramID = $pid;
										} else $paramID = $ges['id'];

										DB::query('INSERT INTO diafan_shop_param_element (value1, param_id, element_id) VALUES ("'.$dop_parameter3.'", "12", "'.$res['id'].'")');
										
										
										
										//////////////////////////////////////////////

										$plitka_type = mb_convert_case(trim($plitka_type), MB_CASE_LOWER, "UTF-8");

										$type_id = 0;

										if($plitka_type == 'настенная плитка' || $plitka_type == 'настенный керамогранит' || $plitka_type == 'клинкерная плитка') $type_id = 17;
										if($plitka_type == 'напольная плитка' || $plitka_type == 'напольный керамогранит' || $plitka_type == 'базовая плитка') $type_id = 18;
										
										/*
										if(strripos($plitka_type, 'настенная плитка') !== false) $type_id = 17;
										if(strripos($plitka_type, 'напольная плитка') !== false || strripos($plitka_type, 'базовая плитка') !== false || strripos($plitka_type == 'плитка напольная') !== false) $type_id = 18;
										*/

										if($type_id == 0) $type_id = 16;

										DB::query('INSERT INTO {shop_param_element} (value1, param_id, element_id) VALUES ("'.$type_id.'", "6", "'.$res['id'].'")');
										DB::query('INSERT INTO {shop_param_element} (value1, param_id, element_id) VALUES ("'.$plitka_type.'", "7", "'.$res['id'].'")');
									}
									// ================================================================================================================================================
								}
							}
						}
					}

				$res = DB::query('SELECT id FROM {shop_category} WHERE parent_id = "0"');
				while($elem = DB::fetch_array($res))
				{
					$count = DB::num_rows(DB::query('SELECT id FROM {shop_category} WHERE parent_id = "'.$elem['id'].'"'));
					DB::query('UPDATE {shop_category} SET count_children = "'.$count.'" WHERE id = "'.$elem['id'].'"');
				}

				DB::query('UPDATE {shop} SET order_ex = "9999" WHERE order_ex = "0" AND cat_id != "8"');
			}
		}
		
		# include_once('collections.php');
		# include_once('tovar.php');
		/*
							foreach($tovar as $t)
							{
								$res = DB::fetch_array(DB::query('SELECT id FROM {shop} WHERE cat_id = "8" AND name1 = "'.$t['name'].'"'));
								if($res)
								{
									if(!empty($t['image']))
									{
										if(file_exists($_SERVER['DOCUMENT_ROOT'].'/userfiles/original/'.trim($t['image'])))
										{
											$ges = DB::fetch_array(DB::query('SELECT id FROM {images} WHERE `name`="'.trim($t['image']).'" AND `module_name`="shop" AND `element_id`="'.$res['id'].'"'));
											if(!$ges){
												DB::query('INSERT INTO {images} (`name`, `module_name`, `element_id`, created) VALUES ("'.trim($t['image']).'", "shop", "'.$res['id'].'", "'.time().'")');
												$id = DB::last_id('images');
												DB::query('UPDATE {images} SET sort = "'.$id.'" WHERE id = "'.$id.'"');
											} else {
												DB::query('UPDATE {images} SET sort = "'.$ges['id'].'", created = "'.time().'" WHERE id = "'.$ges['id'].'"');
											}
										}
									}
								}
							}
		*/
		/*
							foreach($collections as $coll)
							{

								$res = DB::fetch_array(DB::query('SELECT id FROM {shop} WHERE cat_id != "8" AND name1 = "'.$coll['name'].'"'));
								if($res)
								{
									$images = explode(',', $coll['images_b']);
									if(count($images) > 0)
									{
										foreach($images as $img)
										{
											if(!empty($img) && file_exists($_SERVER['DOCUMENT_ROOT'].'/userfiles/original/'.$img))
											{
												$ges = DB::fetch_array(DB::query('SELECT id FROM {images} WHERE `name`="'.trim($img).'" AND `module_name`="shop" AND `element_id`="'.$res['id'].'"'));
												if(!$ges){
													DB::query('INSERT INTO {images} (`name`, `module_name`, `element_id`, created) VALUES ("'.trim($img).'", "shop", "'.$res['id'].'", "'.time().'")');
													$id = DB::last_id('images');
													DB::query('UPDATE {images} SET sort = "'.$id.'" WHERE id = "'.$id.'"');
												} else {
													DB::query('UPDATE {images} SET sort = "'.$ges['id'].'", created = "'.time().'" WHERE id = "'.$ges['id'].'"');
												}
											}
										}
									}
								}
							}
							*/
		echo 'Загрузка прайс листа:<br>';
		echo '<form method="post" action="" enctype="multipart/form-data">';
		echo '<input type="file" name="excel_file"><br>';
		echo '<input type="hidden" name="ef_upload" value="1">';
		echo '<input type="submit" value="Загрузить">';
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
}
?>