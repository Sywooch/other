<?php
include('cap.php');
include('smspilot.php');

if(isset($_POST['go']))
  {
     $f=fopen("conf/sett.txt","w");
     fwrite($f,$_POST['mail']."\r\n");

     if(isset($_POST['fam']))  fwrite($f,"checked\r\n");
     else  fwrite($f,"\r\n");

     if(isset($_POST['name']))  fwrite($f,"checked\r\n");
     else  fwrite($f,"\r\n");

     if(isset($_POST['us_mail']))  fwrite($f,"checked\r\n");
     else  fwrite($f,"\r\n");

      if(isset($_POST['fone']))  fwrite($f,"checked\r\n");
      else  fwrite($f,"\r\n");

      if(isset($_POST['adr']))  fwrite($f,"checked\r\n");
      else  fwrite($f,"\r\n");

       if(isset($_POST['metr']))  fwrite($f,"checked\r\n");
      else  fwrite($f,"\r\n");

      if(is_numeric($_POST['in_price']))  fwrite($f,$_POST['in_price']."\r\n");
     else  fwrite($f,"0\r\n");

      if($_POST['view_price']!="")  fwrite($f,$_POST['view_price']."\r\n");
     else  fwrite($f,"руб\r\n");

     if(is_numeric($_POST['in_price1']))  fwrite($f,$_POST['in_price1']."\r\n");
     else  fwrite($f,"0\r\n");
	 
	 if(isset($_POST['sms_active']))  fwrite($f,"checked\r\n");
      else  fwrite($f,"\r\n");

      if($_POST['sms_api']!="")  fwrite($f,$_POST['sms_api']."\r\n");
     else  fwrite($f,"\r\n");
	 
      if($_POST['sms_title']!="")  fwrite($f,$_POST['sms_title']."\r\n");
     else  fwrite($f,"\r\n");
	 
      if($_POST['sms_phone']!="")  fwrite($f,$_POST['sms_phone']."\r\n");
     else  fwrite($f,"\r\n");
	 
	// 14
	if (isset($_POST['street']))  fwrite($f,"checked\r\n");
	else fwrite($f,"\r\n");	 
	
	if (isset($_POST['house']))  fwrite($f,"checked\r\n");
	else fwrite($f,"\r\n");	 
	
	if (isset($_POST['korp']))  fwrite($f,"checked\r\n");
	else fwrite($f,"\r\n");	 	
	
	if (isset($_POST['apartment']))  fwrite($f,"checked\r\n");
	else fwrite($f,"\r\n");	 
	
	if (isset($_POST['intercom']))  fwrite($f,"checked\r\n");
	else fwrite($f,"\r\n");	 
	
	if (isset($_POST['floor']))  fwrite($f,"checked\r\n");
	else fwrite($f,"\r\n");	 
	
	if (isset($_POST['porch']))  fwrite($f,"checked\r\n");
	else fwrite($f,"\r\n");	 	

	// 21
	if (isset($_POST['metro']))  fwrite($f,"checked\r\n"); 
	else fwrite($f,"\r\n");	 
	
	// 22	
	if (isset($_POST['regular']))  fwrite($f,"checked\r\n"); 
	else fwrite($f,"\r\n");	 	
		
	fclose($f);
}

$conf=file("conf/sett.txt");
for($i=0; $i<count($conf); $i++) $conf[$i]=trim($conf[$i]);

if ($conf[11] != '') {
	if (!defined('SMSPILOT_APIKEY')) define('SMSPILOT_APIKEY', $conf[11]);
	$sms_balance = sms_balance();
	if ($sms_balance === false) {
		$sms_balance = '<span style="color:red;">Ошибка: неверный API-ключ</span>';
	} else {	
		if ($sms_balance > 0) {
			$sms_balance = "<span style='color:green;'>$sms_balance</span>";
		} else {
			$sms_balance = "<span style='color:red;'>$sms_balance</span>";
		}
		$sms_balance = 'Баланс: '.$sms_balance.' sms-кредитов';
	}
}
?>
<form  method="post">
<table CELLSPACING=0 align=center width=70%>
<tr>
  <td valign=top  >
      <input type="submit" value="сохранить" id=button name=go>
  </td>

</tr>
</table><br />

<table  id=tab1 CELLPADDING=10 CELLSPACING=0 align=center width=70%>
<tr>
  <td valign=top id=sett1  width=25%>
      e-mail, на который приходит заказ
  </td>

  <td valign=top id=sett2>
       <input name="mail" type="text" value="<? echo @$conf[0]?>">
  </td>
</tr>

<tr>
  <td valign=top   colspan=2 align=center bgcolor=#F8F8F8>
      ДАННЫЕ ДЛЯ ЗАКАЗА
  </td>
</tr>

<tr>
  <td valign=top id=sett1  width=25%>
      Фамилия
  </td>

  <td valign=top id=sett2>
       <input name="fam" type="checkbox" value="ON" <?php echo @$conf[1]  ?>>
  </td>
</tr>

<tr>
  <td valign=top id=sett1  width=25%>
      Имя
  </td>

  <td valign=top id=sett2>
       <input name="name" type="checkbox" value="ON" <?php echo @$conf[2]  ?>>
  </td>
</tr>

<tr>
  <td valign=top id=sett1  width=25%>
      e-mail
  </td>

  <td valign=top id=sett2>
       <input name="us_mail" type="checkbox" value="ON" <?php echo @$conf[3]  ?>>
  </td>
</tr>

<tr>
  <td valign=top id=sett1  width=25%>
     Телефон
  </td>

  <td valign=top id=sett2>
       <input name="fone" type="checkbox" value="ON" <?php echo @$conf[4]  ?>>
  </td>
</tr>

<tr>
	<td valign=top id=sett1  width=25%>Улица</td>
	<td valign=top id=sett2>
		<input name="street" type="checkbox" value="ON" <?php echo @$conf[14]  ?>>
	</td>
</tr>

<tr>
	<td valign=top id=sett1  width=25%>Дом №</td>
	<td valign=top id=sett2>
		<input name="house" type="checkbox" value="ON" <?php echo @$conf[15]  ?>>
	</td>
</tr>

<tr>
	<td valign=top id=sett1  width=25%>Корпус</td>
	<td valign=top id=sett2>
		<input name="korp" type="checkbox" value="ON" <?php echo @$conf[16]  ?>>
	</td>
</tr>

<tr>
	<td valign=top id=sett1  width=25%>Квартира</td>
	<td valign=top id=sett2>
		<input name="apartment" type="checkbox" value="ON" <?php echo @$conf[17]  ?>>
	</td>
</tr>

<tr>
	<td valign=top id=sett1  width=25%>Домофон</td>
	<td valign=top id=sett2>
		<input name="intercom" type="checkbox" value="ON" <?php echo @$conf[18]  ?>>
	</td>
</tr>

<tr>
	<td valign=top id=sett1  width=25%>Этаж</td>
	<td valign=top id=sett2>
		<input name="floor" type="checkbox" value="ON" <?php echo @$conf[19]  ?>>
	</td>
</tr>

<tr>
	<td valign=top id=sett1  width=25%>Подъезд №</td>
	<td valign=top id=sett2>
		<input name="porch" type="checkbox" value="ON" <?php echo @$conf[20]  ?>>
	</td>
</tr>

<tr>
	<td valign=top id=sett1  width=25%>Ближайшая станция метро</td>
	<td valign=top id=sett2>
		<input name="metro" type="checkbox" value="ON" <?php echo @$conf[21]  ?>>
	</td>
</tr>

<tr>
  <td valign=top id=sett1  width=25%>
     Вариант оплаты
  </td>

  <td valign=top id=sett2>
       <input name="adr" type="checkbox" value="ON" <?php echo @$conf[5]  ?>>
  </td>
</tr>

<tr>
  <td valign=top id=sett1  width=25%>
     Комментарий
  </td>

  <td valign=top id=sett2>
       <input name="metr" type="checkbox" value="ON" <?php echo @$conf[6]  ?>>
  </td>
</tr>


<tr>
	<td valign=top id=sett1  width=25%>Делали ли Вы ранее заказы в нашем ресторане?</td>
	<td valign=top id=sett2>
		<input name="regular" type="checkbox" value="ON" <?php echo @$conf[22]  ?>>
	</td>
</tr>

<tr>
  <td valign=top   colspan=2 align=center bgcolor=#F8F8F8>
      ДЕНЬГИ
  </td>
</tr>

<tr>
  <td valign=top id=sett1  width=25%>
     Доставка по Москве
  </td>

  <td valign=top id=sett2>
       <input name="in_price" type="text" value="<? echo @$conf[7]?>" size=3>
  </td>
</tr>


<tr>
  <td valign=top id=sett1  width=25%>
     Доставка по МО
  </td>

  <td valign=top id=sett2>
       <input name="in_price1" type="text" value="<? echo @$conf[9]?>" size=3>
  </td>
</tr>


<tr>
  <td valign=top id=sett1  width=25%>
     Сокращение для денежной единицы (напр. руб)
  </td>

  <td valign=top id=sett2>
       <input name="view_price" type="text" value="<? echo @$conf[8]?>" size=3>
  </td>
</tr>



<tr>
  <td valign=top   colspan=2 align=center bgcolor=#F8F8F8>
      СМС
  </td>
</tr>

<tr>
  <td valign=top id=sett1  width=25%>
    Слать СМС?
  </td>

  <td valign=top id=sett2>
     <input name="sms_active" type="checkbox" value="ON" <?php echo @$conf[10]  ?>>
  </td>
</tr>

<tr>
  <td valign=top id=sett1  width=25%>
     API-ключ www.smspilot.ru
  </td>

  <td valign=top id=sett2>
       <input name="sms_api" type="text" size="45" value="<? echo @$conf[11]?>" size=3>
	   <br>
	   <? echo @$sms_balance; ?>
  </td>
</tr>


<tr>
  <td valign=top id=sett1  width=25%>
     Название сайта
  </td>

  <td valign=top id=sett2>
       <input name="sms_title" type="text" size="45" value="<? echo @$conf[12]?>" size=3>
  </td>
</tr>

<tr>
  <td valign=top id=sett1  width=25%>
     Телефон, на который слать СМС
  </td>

  <td valign=top id=sett2>
       <input name="sms_phone" type="text" size="45" value="<? echo @$conf[13]?>" size=3>
	   <br>
	   11 цифр, пример: 79521234567
  </td>
</tr>

</table>

<br /><table  CELLSPACING=0 align=center width=70%>
<tr>
  <td valign=top  >
      <input type="submit" value="сохранить" id=button name=go>
  </td>

</tr>
</table>
 </form>

