<?php

$name=$_POST["call_order_name"];//���
$phone=$_POST["call_order_phone"];//�������
$mail=$_POST["call_order_mail"];//e-mail

//�������� e-mail ��������������

$date_pay=date("Y-m-d");
$time_pay=date("H:i:s");

$html='<hr size="1">
		<p>'.$date_pay.' - '.$time_pay.'</p>
		<p>���: '.$name.'</p>
		<p>�������: '.$phone.'</p>
		<p>E-mail: '.$mail.'</p>';
		
		

mail("gsu1234@mail.ru", "����� ������ �� �������� ������", $html, "Content-type: text/html; charset=utf-8");


header("Refresh: 2; URL=/");
echo'���� ������ ������� ����������. ������ �� ������ �������������� �� �������...';

?>