<?php
/**
 * Ошибка 404. Доступ запрещен
 *
 * Шаблон оформления страниц 404 (Не найдено)
 *
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (! defined('DIAFAN'))
{
	include dirname(dirname(__FILE__)).'/includes/404.php';
}
?><html>
<head>
<title>Error 404. Страница не найдена.</title>
<meta http-equiv="Content-Type" content="text/html;  charset=utf-8">
<link href="<insert name="path">adm/css/errors.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="http://yandex.st/jquery/1.7.1/jquery.min.js" charset="UTF-8"></script>
</head>
<body bgcolor="#FFFFFF" text="#000000" topmargin="100">
<center>
<table width="550" border="0" cellpadding="3" cellspacing="0">
	<tr> 
		<td valign="top" align="right">
			<a href="http://cms.diafan.ru/" target="_blank"><img src="http://www.diafan.ru/logo.gif" border="0" vspace="5"></a>
		</td>
		<td valign="top">
			<font face="Verdana, Arial, Helvetica, sans-serif" size="2">
				<b><font color="#0000ff">Ошибка 404<br>
				Запрашиваемая страница не найдена!</font></b><br>
				Проверьте еще раз адрес страницы и введите его снова,<br>
				или нажмите кнопку <a href="javascript:history.back(-1)">Назад</a>, чтобы вернуться <br>
				на предыдущую и найти там ссылки на нужные данные.
			</font>
		</td>
	</tr>
</table>
</center>
</body>
