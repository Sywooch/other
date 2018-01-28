<?php

/**
 * @package    Diafan.CMS
 *
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
if (!defined('DIAFAN'))
{
	include dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/includes/404.php';
}

/**
 * Шаблон квитации для физического лица
 */
?>
<html>
<head>
<title><?php echo $this->diafan->_('Квитанция для физических лиц', false);?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<STYLE type="text/css">
body
{
	font-family:Arial, Helvetica, sans-serif;
}

a
{
	color:#006400;
}

p
{
	padding: 5px 0px 0px 5px;
}

.vas ul
{
	padding: 0px 10px 0px 15px;
}

.vas li
{
	list-style-type:circle;
}

h3
{
	padding:0px 0px 0px 5px;
	font-size:100%; 
}

h1
{
	color:#006400;
	padding:0px 0px 0px 5px; 
	font-size:120%;
}

li
{
	list-style-type: none;
	padding-bottom:5px;
	padding: 6px 0px 0px 5px;
}

.main
{
	font-size:12px;
}

.list
{
	font-size:12px;
	padding: 6px 15px 0px 5px;
}

.main input
{
	font-size:12px;
	background-color:#CCFFCC;
}

.text14
{
	font-family:"Times New Roman", Times, serif;
	font-size:14px;
}
.text14 strong
{
	font-family:"Times New Roman", Times, serif;
	font-size:11px;
}

.link
{
	font-size:12px;
}

.link a
{
	text-decoration:none;
	color:#006400;
}

.link_u
{
	font-size:12px;
}
.link_u a
{
	color:#006400;
}
</STYLE>
</head>
<div class="text14">
<table width="720" bordercolor="#000000" style="border:#000000 1px solid;" cellpadding="0" cellspacing="0">
  <tr>

    <td width="220" valign="top" height="250" align="center" style="border-bottom:#000000 1px solid; border-right:#000000 1px solid;">&nbsp;<strong>Платеж</strong></td>
    <td valign="top" style="border-bottom:#000000 1px solid; border-right:#000000 1px solid;">
       <li><strong>Получатель: </strong> <font style="font-size:90%"> <u><?php echo $values["non_cash_name"];?></u></font><br />  
      <li><strong>КПП:</strong> <u><?php echo $values["non_cash_kpp"];?></u>
      <strong>ИНН:</strong> <u><?php echo $values["non_cash_inn"];?></u><font style="font-size:11px"> &nbsp;</font> <br />

     <li><strong>Код ОКАТО:</strong> <u><?php echo $values["non_cash_okato"];?></u>
      <strong>P/сч.:</strong> <u><?php echo $values["non_cash_rs"];?></u></li>
      <li> <strong>в:</strong> <font style="font-size:90%"><u><?php echo $values["non_cash_bank"];?></u></font><br /> 
     <li><strong>БИК:</strong> <u><?php echo $values["non_cash_bik"];?></u>
     <strong>К/сч.:</strong> <u><?php echo $values["non_cash_ks"];?></u><br />

     <li><strong>Код бюджетной классификации (КБК):</strong> <u><?php echo $values["non_cash_kbk"];?></u> 
     <li><strong>Платеж:</strong> <font style="font-size:90%"><?php echo $values["order_name"];?></font><br />
     <li><strong>Плательщик:</strong>  <u><?php echo $values["user_fio"];?></u><br />
     <li><strong>Сумма:</strong> <?php echo $values["summ_rub"];?> руб. <?php echo $values["summ_kop"];?> коп. &nbsp;&nbsp;&nbsp;&nbsp;<br /> 
    Подпись:________________________        Дата:
    &quot;<?php echo $values["date_d"];?>&quot; <?php echo $values["date_m"];?> <?php echo $values["date_y"];?> г. <br /><br /> 
    </td>

  </tr>
  <tr>
    <td width="220" valign="top" height="250" align="center" style="border-bottom:#000000 1px solid; border-right:#000000 1px solid;">&nbsp;<strong>Квитанция</strong></td>
    <td valign="top" style="border-bottom:#000000 1px solid; border-right:#000000 1px solid;">
       <li><strong>Получатель: </strong> <font style="font-size:90%"> <u><?php echo $values["non_cash_name"];?></u></font><br />  
      <li><strong>КПП:</strong> <u><?php echo $values["non_cash_kpp"];?></u>
      <strong>ИНН:</strong> <u><?php echo $values["non_cash_inn"];?></u><font style="font-size:11px"> &nbsp;</font> <br />

     <li><strong>Код ОКАТО:</strong> <u><?php echo $values["non_cash_okato"];?></u>
      <strong>P/сч.:</strong> <u><?php echo $values["non_cash_rs"];?></u></li>
      <li> <strong>в:</strong> <font style="font-size:90%"><u><?php echo $values["non_cash_bank"];?></u></font><br /> 
     <li><strong>БИК:</strong> <u><?php echo $values["non_cash_bik"];?></u>
     <strong>К/сч.:</strong> <u><?php echo $values["non_cash_ks"];?></u><br />

     <li><strong>Код бюджетной классификации (КБК):</strong> <u><?php echo $values["non_cash_kbk"];?></u> 
     <li><strong>Платеж:</strong> <font style="font-size:90%"><?php echo $values["order_name"];?></font><br />
     <li><strong>Плательщик:</strong>  <u><?php echo $values["user_fio"];?></u><br />
	 <li><strong>Сумма:</strong> <?php echo $values["summ_rub"];?> руб. <?php echo $values["summ_kop"];?> коп. &nbsp;&nbsp;&nbsp;&nbsp;<br /> 
    Подпись:________________________        Дата:
    &quot;<?php echo $values["date_d"];?>&quot; <?php echo $values["date_m"];?> <?php echo $values["date_y"];?> г. <br /><br /> 
    </td>
  </tr>
</table>
</div>
</html>
</body>