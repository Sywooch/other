<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

header( "Content-Type: text/html; charset=windows-1251" );
echo "<html>\n\t<head>\n\t\t<title>��������� �� ������ ����������</title>\n\t\t<meta http-equiv=\"content-type\" content=\"text/html; charset=windows-1251\" />\n\t\t<link type=\"text/css\" rel=\"stylesheet\" href=\"/css/payment.css\" />\n\t</head>\n\t<body class=\"payment\">\n\t\t<table class=\"receipt\" cellspacing=\"0\" cellpadding=\"0\">\n\t\t\t<tr>\n\t\t\t\t<td colspan=\"4\" class=\"header\"> ����� � ��-4�� (�����) </td>\n\t\t\t</tr>\n\t\t\t<tr>\n\t\t\t\t<td rowspan=\"6\" class=\"info\">\n\t\t\t\t\t<table style=\"height: 61mm; width: 49mm;\">\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t<td valign=\"top\">���������</td>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t<td valign=\"bottom\">������</td>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t</table>\n\t\t\t\t</td>\n\t\t\t\t<td colspan=\"3\" class=\"payment\">\n\t\t\t\t\t<b>������������ ����������:</b> ��� �� ����������� �������<br />\n\t\t\t\t\t(���������� ����������� ������������ ������ �� ����������� �������)<br />\n\t\t\t\t\t<b>���:</b> <span>7604083179</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\t\t\t\t\t<b>���:</b> <span>760401001</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\t\t\t\t\t<b>�����:</b> <span>78701000</span><br />\n\t\t\t\t\t<b>����� ����� ����������:</b> <span>40101810700000010010</span><br />\n\t\t\t\t\t<b>���� ����������:</b> ���� �� ����� ������ �� ����������� �������&nbsp;<br />\n\t\t\t\t\t<b>���:</b> <span>047888001</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\t\t\t\t\t<b>���:</b> <span>";
echo $_POST['kbk'];
echo "</span> <br />\n\t\t\t\t</td>\n\t\t\t</tr>\n\t\t\t<tr>\n\t\t\t\t<td colspan=\"3\" class=\"payer\">\n\t\t\t\t\t<span>�.�.�. �����������:</span> ";
echo $_POST['name'];
echo "\t\t\t\t</td>\n\t\t\t</tr>\n\t\t\t<tr>\n\t\t\t\t<td colspan=\"3\" class=\"payer\">\n\t\t\t\t\t<span>����� �����������:</span> ";
echo $_POST['address'];
echo "\t\t\t\t</td>\n\t\t\t</tr>\n\t\t\t<tr>\n\t\t\t\t<td colspan=\"3\" class=\"payer\">\n\t\t\t\t\t<span>��� �������:</span> ";
echo $_POST['type'];
echo "\t\t\t\t</td>\n\t\t\t</tr>\n\t\t\t<tr class=\"payer\">\n\t\t\t\t<td style=\"width: 18mm;\"> <b>����</b> </td>\n\t\t\t\t<td style=\"width: 25mm;\"> <b>�����</b> </td>\n\t\t\t\t<td style=\"width: 78mm;\"> <b>����������:</b> (�������) </td>\n\t\t\t</tr>\n\t\t\t<tr class=\"payer\">\n\t\t\t\t<td style=\"height: 8mm;\"> ";
echo date( "d.m.Y" );
echo " </td>\n\t\t\t\t<td style=\"height: 8mm;\"> ";
echo $_POST['amount'];
echo " ���. </td>\n\t\t\t\t<td style=\"height: 8mm;\"> &nbsp; </td>\n\t\t\t</tr>\n\t\t\t<tr>\n\t\t\t\t<td colspan=\"4\" class=\"header\"> ����� � ��-4�� (�����) </td>\n\t\t\t</tr>\n\t\t\t<tr>\n\t\t\t\t<td rowspan=\"6\" class=\"info\">\n\t\t\t\t\t<table style=\"height: 61mm; width: 49mm;\">\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t<td valign=\"top\">���������</td>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t<td valign=\"bottom\">������</td>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t</table>\n\t\t\t\t</td>\n\t\t\t\t<td colspan=\"3\" class=\"payment\">\n\t\t\t\t\t<b>������������ ����������:</b> ��� �� ����������� �������<br />\n\t\t\t\t\t(���������� ����������� ������������ ������ �� ����������� �������)<br />\n\t\t\t\t\t<b>���:</b> <span>7604083179</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\t\t\t\t\t<b>���:</b> <span>760401001</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\t\t\t\t\t<b>�����:</b> <span>78701000</span><br />\n\t\t\t\t\t<b>����� ����� ����������:</b> <span>40101810700000010010</span><br />\n\t\t\t\t\t<b>���� ����������:</b> ���� �� ����� ������ �� ����������� �������&nbsp;<br />\n\t\t\t\t\t<b>���:</b> <span>047888001</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\t\t\t\t\t<b>���:</b> <span>";
echo $_POST['kbk'];
echo "</span> <br />\n\t\t\t\t</td>\n\t\t\t</tr>\n\t\t\t<tr>\n\t\t\t\t<td colspan=\"3\" class=\"payer\">\n\t\t\t\t\t<span>�.�.�. �����������:</span> ";
echo $_POST['name'];
echo "\t\t\t\t</td>\n\t\t\t</tr>\n\t\t\t<tr>\n\t\t\t\t<td colspan=\"3\" class=\"payer\">\n\t\t\t\t\t<span>����� �����������:</span> ";
echo $_POST['address'];
echo "\t\t\t\t</td>\n\t\t\t</tr>\n\t\t\t<tr>\n\t\t\t\t<td colspan=\"3\" class=\"payer\">\n\t\t\t\t\t<span>��� �������:</span> ";
echo $_POST['type'];
echo "\t\t\t\t</td>\n\t\t\t</tr>\n\t\t\t<tr class=\"payer\">\n\t\t\t\t<td style=\"width: 18mm;\"> <b>����</b> </td>\n\t\t\t\t<td style=\"width: 25mm;\"> <b>�����</b> </td>\n\t\t\t\t<td style=\"width: 78mm;\"> <b>����������:</b> (�������) </td>\n\t\t\t</tr>\n\t\t\t<tr class=\"payer\">\n\t\t\t\t<td style=\"height: 8mm;\"> ";
echo date( "d.m.Y" );
echo " </td>\n\t\t\t\t<td style=\"height: 8mm;\"> ";
echo $_POST['amount'];
echo " ���. </td>\n\t\t\t\t<td style=\"height: 8mm;\"> &nbsp; </td>\n\t\t\t</tr>\n\t\t</table>\n\t</body>\n</html>";
?>
