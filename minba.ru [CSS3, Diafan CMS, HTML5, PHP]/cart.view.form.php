<?php
/**
 * Шаблон формы редактирования корзины товаров, оформления заказа
 *
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    5.4
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2015 OOO «Диафан» (http://www.diafan.ru/)
 */

if (! defined('DIAFAN'))
{
    $path = __FILE__; $i = 0;
	while(! file_exists($path.'/includes/404.php'))
	{
		if($i == 10) exit; $i++;
		$path = dirname($path);
	}
	include $path.'/includes/404.php';
}
if (empty($result["rows"]))
{
	echo '<p>'.$this->diafan->_('Корзина пуста.').' <a href="'.BASE_PATH_HREF.$result["shop_link"].'">'.$this->diafan->_('Перейти к покупкам.').'</a></p>';
	return;
}

//echo '<a name="top"></a>';

/*echo '<form action="" method="POST" style="padding:0px;">
<input type="hidden" name="module" value="cart">
<input type="hidden" name="action" value="recalc">
<input type="hidden" name="form_tag" value="'.$result["form_tag"].'">
<div class="errors error"'.($result["error"] ? '>'.$result["error"] : ' style="display:none">').'</div>
<div class="cart_table">';*/
echo $this->get('table', 'cart', $result); //вывод таблицы с товарами
//echo '</div>';
//echo '<div class="cart_recalc">';
// кнопка пересчитать
//echo '<input type="submit" value="'.$this->diafan->_('Пересчитать', false).'">';
//echo '</div>';
//echo '</form>';
if (empty($result["rows"]))
{
	echo '</div>';
	return false;
}

?>



<?php

echo '<h2>УКАЖИТЕ ПОЖАЛУЙСТА ВАШИ ДАННЫЕ</h2>
<form method="POST" action="" id="ofzakaz" enctype="multipart/form-data">
<input type="hidden" name="module" value="cart">
<input type="hidden" name="action" value="order">
<input type="hidden" name="tmpcode" value="'.md5(mt_rand(0, 9999)).'">';
echo '<div class="left">';
$required = false;
if (! empty($result["rows_param"]))
{
	foreach ($result["rows_param"] as $row)
	{
		if($row["required"])
		{
			$required = true;
		}
		$value = ! empty($result["user"]['p'.$row["id"]]) ? $result["user"]['p'.$row["id"]] : '';

		

		switch ($row["type"])
		{
			case 'title':
				echo '<div class="form-item">
						<label>'.$row["name"].':</label></div>';
				break;

			case 'text':
				echo '<div class="form-item">
						<label>'.$row["name"].($row["required"] ? '<span style="color:red;">*</span>' : '').':</label>
				<input type="text" class="form-text" name="p'.$row["id"].'" value="'.str_replace('"', '&quot;', $value).'"></div>';
				break;

			case "email":
				echo '<div class="form-item">
						<label>'.$row["name"].($row["required"] ? '<span style="color:red;">*</span>' : '').':</label>
				<input type="email" class="form-text" name="p'.$row["id"].'" value="'.str_replace('"', '&quot;', $value).'"></div>';
				break;

			case "phone":
				echo '<div class="form-item">
						<label>'.$row["name"].($row["required"] ? '<span style="color:red;">*</span>' : '').':</label>
				<input type="tel" name="p'.$row["id"].'" class="form-text" value="'.$value.'"></div>';
				break;

			case 'textarea':
				echo '<div class="form-item">
						<label>'.$row["name"].($row["required"] ? '<span style="color:red;">*</span>' : '').':</label>
				<textarea name="p'.$row["id"].'" class="form-text">'.str_replace(array('<', '>', '"'), array('&lt;', '&gt;', '&quot;'), $value).'</textarea></div>';
				break;

			case 'date':
			case 'datetime':
				$timecalendar  = true;
				echo '<div class="form-item">
						<label>'.$row["name"].($row["required"] ? '<span style="color:red;">*</span>' : '').':</label>
					<input type="text" class="form-text" name="p'.$row["id"].'" value="'.$value.'" class="timecalendar" showTime="'
					.($row["type"] == 'datetime'? 'true' : 'false').'"></div>';
				break;

			case 'numtext':
				echo '<div class="form-item">
						<label>'.$row["name"].($row["required"] ? '<span style="color:red;">*</span>' : '').':</label>
				<input type="number" class="form-text" name="p'.$row["id"].'" size="5" value="'.$value.'"></div>';
				break;

			case 'checkbox':
				echo '<input name="p'.$row["id"].'" id="cart_p'.$row["id"].'" value="1" type="checkbox" '.($value ? ' checked' : '').'><label for="cart_p'.$row["id"].'">'.$row["name"].($row["required"] ? '<span style="color:red;">*</span>' : '').'</label>';
				break;

			case 'select':
				echo '<div class="form-item">
						<label>'.$row["name"].($row["required"] ? '<span style="color:red;">*</span>' : '').':</label>
				<select name="p'.$row["id"].'" class="inpselect">
					<option value="">-</option>';
				foreach ($row["select_array"] as $select)
				{
					echo '<option value="'.$select["id"].'"'.($value == $select["id"] ? ' selected' : '').'>'.$select["name"].'</option>';
				}
				echo '</select></div>';
				break;


	
		}

		
		}

}echo '</div>';
echo '<div class="right">
					<img src="/images/ozinfo.jpg" alt="" title="" />
					<ul class="info tmp4">
						<li><span onclick="popup_info();">подробнее о доставке</span></li>
						<!--<a href="/deliver/"><li><a href="/pay/">подробнее об оплате</a></li>-->
					</ul>
				    <div class="form-item">';
					
					$captcha_cart = $this->diafan->_captcha->get("cart", '');
					echo $captcha_cart;
					
					
					//.$result["captcha"].
					
					
					echo '
						

					</div>
					<div class="form-item">
						<button type="submit" value="'.$this->diafan->_('ОТПРАВИТЬ ЗАКАЗ', false).'">ОТПРАВИТЬ ЗАКАЗ</button>
					</div>
				</div>
				<div class="clear"></div>';
				
?>


<script type="text/javascript">



</script>



<?php				
				
				
//echo '<input type="submit" value="'.$this->diafan->_('Продолжить', false).'">';
			

echo '</form>';
/*
if($result["show_auth"])
{
	echo '<div class="cart_autorization">';
	echo $this->diafan->_('Если Вы оформляли заказ на сайте ранее, просто введите логин и пароль:');
	echo '<br>';
	echo $this->get('show_login', 'registration', $result["show_login"]);
	echo '</div>';

	/*echo '<div class="cart_registration">';
	echo $this->diafan->_('Если Вы заполните форму регистрации, то при заказе в следующий раз Вам не придется повторно заполнять Ваши данные:');
	echo $this->get('form', 'registration', $result["registration"]);
	echo '</div>';
}*/
echo '</div>';
