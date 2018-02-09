<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

header( "Content-Type: text/html; charset=windows-1251" );
echo "<html>\n\t<head>\n\t\t<title>Квитанция об уплате госпошлины</title>\n\t\t<meta http-equiv=\"content-type\" content=\"text/html; charset=windows-1251\" />\n\t\t<link type=\"text/css\" rel=\"stylesheet\" href=\"/css/payment.css\" />\n\t</head>\n\t<body class=\"payment\">\n\t\t<table class=\"receipt\" cellspacing=\"0\" cellpadding=\"0\">\n\t\t\t<tr>\n\t\t\t\t<td colspan=\"4\" class=\"header\"> Форма № ПД-4сб (налог) </td>\n\t\t\t</tr>\n\t\t\t<tr>\n\t\t\t\t<td rowspan=\"6\" class=\"info\">\n\t\t\t\t\t<table style=\"height: 61mm; width: 49mm;\">\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t<td valign=\"top\">Извещение</td>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t<td valign=\"bottom\">Кассир</td>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t</table>\n\t\t\t\t</td>\n\t\t\t\t<td colspan=\"3\" class=\"payment\">\n\t\t\t\t\t<b>Наименование получателя:</b> УФК по Ярославской области<br />\n\t\t\t\t\t(Управление Федеральной миграционной службы по Ярославской области)<br />\n\t\t\t\t\t<b>ИНН:</b> <span>7604083179</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\t\t\t\t\t<b>КПП:</b> <span>760401001</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\t\t\t\t\t<b>ОКТМО:</b> <span>78701000</span><br />\n\t\t\t\t\t<b>Номер счета получателя:</b> <span>40101810700000010010</span><br />\n\t\t\t\t\t<b>Банк получателя:</b> ГРКЦ ГУ БАНКА РОССИИ ПО ЯРОСЛАВСКОЙ ОБЛАСТИ&nbsp;<br />\n\t\t\t\t\t<b>БИК:</b> <span>047888001</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\t\t\t\t\t<b>КБК:</b> <span>";
echo $_POST['kbk'];
echo "</span> <br />\n\t\t\t\t</td>\n\t\t\t</tr>\n\t\t\t<tr>\n\t\t\t\t<td colspan=\"3\" class=\"payer\">\n\t\t\t\t\t<span>Ф.И.О. плательщика:</span> ";
echo $_POST['name'];
echo "\t\t\t\t</td>\n\t\t\t</tr>\n\t\t\t<tr>\n\t\t\t\t<td colspan=\"3\" class=\"payer\">\n\t\t\t\t\t<span>Адрес плательщика:</span> ";
echo $_POST['address'];
echo "\t\t\t\t</td>\n\t\t\t</tr>\n\t\t\t<tr>\n\t\t\t\t<td colspan=\"3\" class=\"payer\">\n\t\t\t\t\t<span>Вид платежа:</span> ";
echo $_POST['type'];
echo "\t\t\t\t</td>\n\t\t\t</tr>\n\t\t\t<tr class=\"payer\">\n\t\t\t\t<td style=\"width: 18mm;\"> <b>Дата</b> </td>\n\t\t\t\t<td style=\"width: 25mm;\"> <b>Сумма</b> </td>\n\t\t\t\t<td style=\"width: 78mm;\"> <b>Плательщик:</b> (подпись) </td>\n\t\t\t</tr>\n\t\t\t<tr class=\"payer\">\n\t\t\t\t<td style=\"height: 8mm;\"> ";
echo date( "d.m.Y" );
echo " </td>\n\t\t\t\t<td style=\"height: 8mm;\"> ";
echo $_POST['amount'];
echo " руб. </td>\n\t\t\t\t<td style=\"height: 8mm;\"> &nbsp; </td>\n\t\t\t</tr>\n\t\t\t<tr>\n\t\t\t\t<td colspan=\"4\" class=\"header\"> Форма № ПД-4сб (налог) </td>\n\t\t\t</tr>\n\t\t\t<tr>\n\t\t\t\t<td rowspan=\"6\" class=\"info\">\n\t\t\t\t\t<table style=\"height: 61mm; width: 49mm;\">\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t<td valign=\"top\">Квитанция</td>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t<td valign=\"bottom\">Кассир</td>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t</table>\n\t\t\t\t</td>\n\t\t\t\t<td colspan=\"3\" class=\"payment\">\n\t\t\t\t\t<b>Наименование получателя:</b> УФК по Ярославской области<br />\n\t\t\t\t\t(Управление Федеральной миграционной службы по Ярославской области)<br />\n\t\t\t\t\t<b>ИНН:</b> <span>7604083179</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\t\t\t\t\t<b>КПП:</b> <span>760401001</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\t\t\t\t\t<b>ОКТМО:</b> <span>78701000</span><br />\n\t\t\t\t\t<b>Номер счета получателя:</b> <span>40101810700000010010</span><br />\n\t\t\t\t\t<b>Банк получателя:</b> ГРКЦ ГУ БАНКА РОССИИ ПО ЯРОСЛАВСКОЙ ОБЛАСТИ&nbsp;<br />\n\t\t\t\t\t<b>БИК:</b> <span>047888001</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\t\t\t\t\t<b>КБК:</b> <span>";
echo $_POST['kbk'];
echo "</span> <br />\n\t\t\t\t</td>\n\t\t\t</tr>\n\t\t\t<tr>\n\t\t\t\t<td colspan=\"3\" class=\"payer\">\n\t\t\t\t\t<span>Ф.И.О. плательщика:</span> ";
echo $_POST['name'];
echo "\t\t\t\t</td>\n\t\t\t</tr>\n\t\t\t<tr>\n\t\t\t\t<td colspan=\"3\" class=\"payer\">\n\t\t\t\t\t<span>Адрес плательщика:</span> ";
echo $_POST['address'];
echo "\t\t\t\t</td>\n\t\t\t</tr>\n\t\t\t<tr>\n\t\t\t\t<td colspan=\"3\" class=\"payer\">\n\t\t\t\t\t<span>Вид платежа:</span> ";
echo $_POST['type'];
echo "\t\t\t\t</td>\n\t\t\t</tr>\n\t\t\t<tr class=\"payer\">\n\t\t\t\t<td style=\"width: 18mm;\"> <b>Дата</b> </td>\n\t\t\t\t<td style=\"width: 25mm;\"> <b>Сумма</b> </td>\n\t\t\t\t<td style=\"width: 78mm;\"> <b>Плательщик:</b> (подпись) </td>\n\t\t\t</tr>\n\t\t\t<tr class=\"payer\">\n\t\t\t\t<td style=\"height: 8mm;\"> ";
echo date( "d.m.Y" );
echo " </td>\n\t\t\t\t<td style=\"height: 8mm;\"> ";
echo $_POST['amount'];
echo " руб. </td>\n\t\t\t\t<td style=\"height: 8mm;\"> &nbsp; </td>\n\t\t\t</tr>\n\t\t</table>\n\t</body>\n</html>";
?>
