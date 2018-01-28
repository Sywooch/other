<?php
/**
 * Блок на сайте
 * 
 * Шаблон
 * шаблонного тега <insert name="show_block" module="site" id="номер_страницы" [template="шаблон"]>:
 * выводит блок на сайте
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
if (!defined('DIAFAN'))
{
    include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

if (! $result)
{
	return;
}
if(! empty($result["name"]))
{
	echo '<div class="block_header">'.$result["name"].'</div>';
}
$this->htmleditor($result['text']);
