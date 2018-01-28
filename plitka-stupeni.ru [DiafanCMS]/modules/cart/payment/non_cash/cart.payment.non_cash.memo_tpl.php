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
	include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

/**
 * Шаблон товарного чека
 */
?>

<html>
<head>
<title><?php echo $this->diafan->_('Товарный чек', false);?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<STYLE type="text/css">
body
{
	font-family: Arial, Helvetica, sans-serif;
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

table td{
	border:#000000 1px solid;
	padding: 5px;
}
</STYLE>
</head>
<body>
<div class="text14">
<p><?php echo BASE_URL;?><br><font size="5"><?php echo TITLE;?></font></p><br>
<h1 style="width:720px; text-align: center;"><?php echo $this->diafan->_('Товарный чек', false);?> № <?php echo $values["order_id"];?>  <?php echo $this->diafan->_('от', false);?> &quot;<?php echo $values["date_d"];?>&quot; <?php echo $values["date_m"];?> <?php echo $values["date_y"];?> г.<h1>
<table width="720" bordercolor="#000000" style="border:#000000 1px solid;" cellpadding="0" cellspacing="0">
	<?php
		echo '
		<tr><td><b>'.$this->diafan->_('Наименование', false).'</b></td>
		<td><b>'.$this->diafan->_('Ед. изм.', false).'</b></td>
		<td><b>'.$this->diafan->_('Кол-во', false).'</b></td>
		<td><b>'.$this->diafan->_('Цена, руб.', false).'</b></td>
		<td><b>'.$this->diafan->_('Сумма, руб.', false).'</b></td></tr>';
		foreach($values["goods"] as $row)
		{
			echo '<tr>';
			
			echo '<td>'.$row['name'].'</td>
			<td>'.$this->diafan->_('шт.', false).'</td>
			<td>'.$row['count_goods'].'</td>
			<td>'.$row["price"].'</td>
			<td>'.$row["summ"].'</td>';
			
			echo '</tr>';
		}
		if(!empty($values["delivery"]))
		{
			echo '<td>'.$this->diafan->_('Доставка', false).'</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>'.$values["delivery"]['price'].'</td>';
		}
		echo '<tr><td>'.$this->diafan->_('Итого', false).'</td><td>&nbsp;</td><td><b>'.$values['count_goods'].'</b></td><td>&nbsp;</td><td><b>'.$values['summ'].'</b></td></tr>';
	?>
<table>
<div class="itogo" style="width:720px; text-align: left; padding: 30px 0 0 0;"><?php echo $this->diafan->_('Итого', false);?>: <u><?php echo $values['str_summ'];?></u>   <br>
<?php echo $this->diafan->_('Подпись', false);?> _____________________<br>
<?php echo $this->diafan->_('МП', false);?></div>

<div style="padding-top:40px;"><hr>
<?php echo $this->diafan->_('Покупатель', false);?>: <?php echo $user_fio;?><br>
<?php echo $this->diafan->_('Телефон', false);?>: <?php echo (!empty($user_phone) ? $user_phone : '');?><br>
<?php echo $this->diafan->_('Адрес доставки', false);?>: <?php echo (!empty($user_index) ? $user_index.', ' : '');
echo (!empty($user_city) ? $user_city.', ' : '');
echo (!empty($user_street) ? $user_street.', ' : '');
echo (!empty($user_dom) ? $this->diafan->_('д.', false).' '.$user_dom.', ' : '');
echo (!empty($user_kv) ? $this->diafan->_('кв.', false).' '.$user_kv.' ' : '');
?>
</div>
</div>
</body>
</html>