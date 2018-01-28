<?php
/**
 * @package    Diafan.CMS
 * Admin bootstrap
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

$_GET["rewrite"] = preg_replace('/^'.ADMIN_FOLDER.'[\/]*/', '', $_GET["rewrite"]);
$_GET["rewrite"] = str_replace('adm/', '', $_GET["rewrite"]);

define('IS_ADMIN', 1);

Customization::inc('includes/core.php');

Customization::inc('adm/includes/init.php');

include_once ABSOLUTE_PATH.'plugins/encoding.php';

Customization::inc('includes/database.php');
DB::connect();

$diafan = new Init_admin();
$diafan->init();

/*echo '<!--';
print_r($_SESSION);
echo '-->';

$included_files = get_included_files();

foreach ($included_files as $filename) {
    echo "$filename\n";
}
*/
exit;
