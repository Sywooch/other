#
#<?php die("Forbidden."); ?>

2014-11-08 21:19:46 ERROR vmError: exeSortSearchListQuery Table 'ru3topolya_mgl.im6qd_virtuemart_categories_ru_ru' doesn't exist SQL=SELECT  c.`virtuemart_category_id`, l.`category_description`, l.`category_name`, c.`ordering`, c.`published`, cx.`category_child_id`, cx.`category_parent_id`, c.`shared`  FROM `im6qd_virtuemart_categories_ru_ru` l
				  JOIN `im6qd_virtuemart_categories` AS c using (`virtuemart_category_id`)
				  LEFT JOIN `im6qd_virtuemart_category_categories` AS cx
				  ON l.`virtuemart_category_id` = cx.`category_child_id` 
 WHERE  cx.`category_parent_id` = 0

 ORDER BY category_name DESC
2014-11-08 21:20:04 ERROR vmError: exeSortSearchListQuery Table 'ru3topolya_mgl.im6qd_virtuemart_categories_ru_ru' doesn't exist SQL=SELECT  c.`virtuemart_category_id`, l.`category_description`, l.`category_name`, c.`ordering`, c.`published`, cx.`category_child_id`, cx.`category_parent_id`, c.`shared`  FROM `im6qd_virtuemart_categories_ru_ru` l
				  JOIN `im6qd_virtuemart_categories` AS c using (`virtuemart_category_id`)
				  LEFT JOIN `im6qd_virtuemart_category_categories` AS cx
				  ON l.`virtuemart_category_id` = cx.`category_child_id` 
 WHERE  cx.`category_parent_id` = 0

 ORDER BY category_name DESC
2014-11-08 21:22:14 ERROR vmError: exeSortSearchListQuery Table 'ru3topolya_mgl.im6qd_virtuemart_categories_ru_ru' doesn't exist SQL=SELECT  c.`virtuemart_category_id`, l.`category_description`, l.`category_name`, c.`ordering`, c.`published`, cx.`category_child_id`, cx.`category_parent_id`, c.`shared`  FROM `im6qd_virtuemart_categories_ru_ru` l
				  JOIN `im6qd_virtuemart_categories` AS c using (`virtuemart_category_id`)
				  LEFT JOIN `im6qd_virtuemart_category_categories` AS cx
				  ON l.`virtuemart_category_id` = cx.`category_child_id` 
 WHERE  cx.`category_parent_id` = 0

 ORDER BY c.ordering ASC
2014-11-08 21:22:14 ERROR vmError: exeSortSearchListQuery Table 'ru3topolya_mgl.im6qd_virtuemart_categories_ru_ru' doesn't exist SQL=SELECT  c.`virtuemart_category_id`, l.`category_description`, l.`category_name`, c.`ordering`, c.`published`, cx.`category_child_id`, cx.`category_parent_id`, c.`shared`  FROM `im6qd_virtuemart_categories_ru_ru` l
				  JOIN `im6qd_virtuemart_categories` AS c using (`virtuemart_category_id`)
				  LEFT JOIN `im6qd_virtuemart_category_categories` AS cx
				  ON l.`virtuemart_category_id` = cx.`category_child_id` 
 WHERE  c.`published` = 1  AND  cx.`category_parent_id` = 0

 ORDER BY c.ordering ASC
2014-11-08 21:24:39 ERROR vmError: VmTableData::store failed - Table 'ru3topolya_mgl.im6qd_virtuemart_categories_ru_ru' doesn't exist SQL=INSERT INTO `im6qd_virtuemart_categories_ru_ru` (`virtuemart_category_id`,`category_name`,`category_description`,`metadesc`,`metakey`,`customtitle`,`slug`) VALUES ('10','Тест-кат-1','<p>описание тестовой категории 1</p>','','','','тест-кат-1')
2014-11-08 21:24:39 ERROR vmError: exeSortSearchListQuery Table 'ru3topolya_mgl.im6qd_virtuemart_categories_ru_ru' doesn't exist SQL=SELECT  c.`virtuemart_category_id`, l.`category_description`, l.`category_name`, c.`ordering`, c.`published`, cx.`category_child_id`, cx.`category_parent_id`, c.`shared`  FROM `im6qd_virtuemart_categories_ru_ru` l
				  JOIN `im6qd_virtuemart_categories` AS c using (`virtuemart_category_id`)
				  LEFT JOIN `im6qd_virtuemart_category_categories` AS cx
				  ON l.`virtuemart_category_id` = cx.`category_child_id` 
 WHERE  cx.`category_parent_id` = 0

 ORDER BY category_name DESC
2014-11-08 21:24:44 ERROR vmError: exeSortSearchListQuery Table 'ru3topolya_mgl.im6qd_virtuemart_categories_ru_ru' doesn't exist SQL=SELECT  c.`virtuemart_category_id`, l.`category_description`, l.`category_name`, c.`ordering`, c.`published`, cx.`category_child_id`, cx.`category_parent_id`, c.`shared`  FROM `im6qd_virtuemart_categories_ru_ru` l
				  JOIN `im6qd_virtuemart_categories` AS c using (`virtuemart_category_id`)
				  LEFT JOIN `im6qd_virtuemart_category_categories` AS cx
				  ON l.`virtuemart_category_id` = cx.`category_child_id` 
 WHERE  cx.`category_parent_id` = 0

 ORDER BY category_name DESC