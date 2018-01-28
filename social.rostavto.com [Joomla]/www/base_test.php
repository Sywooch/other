<?php
/**
 * @package		Joomla.Site
 * @copyright	Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// Set flag that this is a parent file.




$dbh=mysql_connect("89.111.176.156","c5597_root","cGsQuABdVrSa") or die ("Невозможно соединиться с сервером.");

mysql_select_db("c5597_rost") or die ("Невозможно подключиться к базе.");
mysql_query("set character_set_results='utf8'");
			mysql_query("SET NAMES utf8");
			
mysql_query ("SET COLLATION_CONNECTION=utf8");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");


$result = mysql_list_tables($dbname); 
 while ($row = mysql_fetch_row($result)) 
       echo $row[0]."<br>";







?>