<?php
/**
 * Ошибка 503. Сервис недоступен
 *
 * Шаблон оформления страницы, выдаваемой, когда сайт временно отсключен администратором галкой в настройках сайта. Шаблонные теги не работают
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
<title>Error 503. Сервис недоступен</title>
<meta http-equiv="Content-Type" content="text/html;  charset=utf-8">
</head>
<body bgcolor="#FFFFFF" text="#000000" topmargin="100"><center>
<table width="550" border="0" cellpadding="3" cellspacing="0">
	<tr> 
		<td valign="top" align="right">
			<a href="http://cms.diafan.ru/" target="_blank"><img src="http://www.diafan.ru/logo.gif" border="0" vspace="5"></a>
		</td>
		<td valign="top">
			<font face="Verdana, Arial, Helvetica, sans-serif" size="2">
                                <b><font color="#0000ff">Error 503. Сервис недоступен.</font></b>
				<p>В связи с проведением технических работ сайт временно не доступен.<br>
                                Приносим свои извинения за предоставленные неудобства.</p>
			</font>
		</td>
	</tr>
</table>
</center>
</body>
