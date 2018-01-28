<?php
/**
 * Форма оформления заказа
 *
 * Шаблон вывода формы редактирования корзины товаров, оформления заказа
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
if (!defined('DIAFAN'))
{
    include dirname(dirname(dirname(__FILE__))) . '/includes/404.php';
}

echo '<script type="text/javascript" src="' . BASE_PATH . 'modules/cart/cart.js"></script>';
if(!empty($result["rows"])){
	echo '<a name="top"></a>
	<div class="cart_order">';

	echo '<form action="" method="POST" enctype="multipart/form-data" class="cart_table_form">
	<input type="hidden" name="module" value="cart">
	<input type="hidden" name="action" value="recalc">
	<input type="hidden" name="ajax" value="">
	<div class="cart_table">';
	echo $this->get('table', 'cart', $result); //вывод таблицы с товарами
	echo '</div>';
	# <div class="errors error_table"' . ($result["error_table"] ? '>' . $result["error_table"] : ' style="display:none">') . '</div>';
	echo '<div class="cart_recalc">';
	// кнопка пересчитать
	# echo '<span class="button_wrap"><input type="submit" class="btn" value="' . $this->diafan->_('Пересчитать', false) . '"></span>';
	echo '</div>';
	echo '</form>';
} else {
	echo '<center><i>«В корзине пусто»</i></center>';
	return false;
}
if (empty($result["rows"]))
{
	echo '</div>';
	return false;
}

if($result["show_auth"])
{
	echo '<div class="cart_autorization" style="margin:15px 0 10px 0px;"><br><br>';
	echo $this->diafan->_('Если Вы оформляли заказ на сайте ранее, просто введите логин и пароль:');
	echo '<br>';
	echo $this->get('show_login_cart', 'registration', $result["show_login"]);
	echo '</div>';

	echo '<div class="cart_registration" style="margin:15px 0 10px 0px;">';
	echo $this->diafan->_('Если Вы заполните форму регистрации, то при заказе в следующий раз Вам не придется повторно заполнять Ваши данные:');
	$this->get('form', 'registration', $result["registration"]);
	echo '</div>';
}

echo '
<div class="title_cart_form"><span class="span">Оформить заказ</span></div>
<form method="POST" action="" class="cart_form ajax">
<input type="hidden" name="module" value="cart">
<input type="hidden" name="action" value="order">
<input type="hidden" name="ajax" value=""><br><br>';

if (! empty($result["rows_param"]))
{
	foreach ($result["rows_param"] as $row)
	{
		$value = ! empty($result["user"]['p'.$row["id"]]) ? $result["user"]['p'.$row["id"]] : '';

		echo '<div class="order_form_param'.$row["id"].'">';

		switch ($row["type"])
		{
			case 'title':
				echo '<div class="infoform">'.$row["name"].':</div>';
				break;

			case 'text':
			case "email":
				if($row["name"]=='Улица, проспект и пр.') {
				$style=' id="street" ';
				}
				else {
				$style='';
				}
				echo '<div class="infofield">'.$row["name"].($row["required"] ? '<font color="red">*</font>' : '').':</div>
				<input type="text"'.$style.'name="p'.$row["id"].'" size="40" value="'.$value.'" class="inptext">';
				break;

			case 'textarea':
				echo '<div class="infofield">'.$row["name"].($row["required"] ? '<font color="red">*</font>' : '').':</div>
				<textarea name="p'.$row["id"].'" class="inptext" rows="10" cols="30">'.$value.'</textarea>';
				break;

			case 'date':
			case 'datetime':
				$timecalendar  = true;
				echo '<div class="infofield">'.$row["name"].($row["required"] ? '<font color="red">*</font>' : '').':</div>
					<input type="text" name="p'.$row["id"].'" size="20" value="'.$value.'" class="inptext timecalendar" showTime="'
					.($row["type"] == 'datetime'? 'true' : 'false').'">';
				break;

			case 'numtext':
				echo '<div class="infofield">'.$row["name"].($row["required"] ? '<font color="red">*</font>' : '').':</div>
				<input type="text" name="p'.$row["id"].'" size="5" value="'.$value.'" class="inpnum">';
				break;

			case 'checkbox':
				echo '<div class="infofield"><input type="checkbox" name="p'.$row["id"].'" value="1" class="inpcheckbox"'.($value ? ' checked' : '').'>
				'.$row["name"].($row["required"] ? '<font color="red">*</font>' : '').'</div>';
				break;

			case 'select':
				echo '<div class="infofield">'.$row["name"].($row["required"] ? '<font color="red">*</font>' : '').':</div>
				<select name="p'.$row["id"].'" class="inpselect">
					<option value="">-</option>';
				foreach ($row["select_array"] as $select)
				{
					echo '<option value="'.$select["id"].'"'.($value == $select["id"] ? ' selected' : '').'>'.$select["name"].'</option>';
				}
				echo '</select>';
				break;

			case 'multiple':
				echo '<div class="infofield">'.$row["name"].($row["required"] ? '<font color="red">*</font>' : '').':</div>';
				foreach ($row["select_array"] as $select)
				{
					echo '<br><input name="p'.$row["id"].'[]" value="'.$select["id"].'" type="checkbox" class="inpcheckbox"'.($value && in_array($select["id"], $value) ? ' checked' : '').'> '.$select["name"];
				}
				break;

			case "attachments":
				echo '<div class="infofield">'.$row["name"].($row["required"] ? '<font color="red">*</font>' : '').':</div>';
				echo '<div class="inpattachment"><input type="file" name="attachments'.$row["id"].'[]" class="inpfiles" max="'.$row["max_count_attachments"].'"></div>';
				echo '<div class="inpattachment" style="display:none"><input type="file" name="hide_attachments'.$row["id"].'[]" class="inpfiles" max="'.$row["max_count_attachments"].'"></div>';
				if ($row["attachment_extensions"])
				{
					echo '<div class="attachment_extensions">('.$this->diafan->_('Доступные типы файлов').': '.$row["attachment_extensions"].')</div>';
				}
				break;

			case "images":
				echo '<div class="infofield">'.$row["name"].($row["required"] ? '<font color="red">*</font>' : '').':</div>';
				echo '<input type="file" name="images'.$row["id"].'" class="inpfiles">';
				break;
		}	
		
		echo '<div class="order_form_param_text">'.$row["text"].'</div>
		</div>
		<div class="errors error_p'.$row["id"].'"'.($result["error_p".$row["id"]] ? '>'.$result["error_p".$row["id"]] : ' style="display:none">').'</div>';

		if($row['id'] == 2)
		{
			if(! empty($result["payments"]))
			{
				echo '<div class="order_form_param-1">';
				echo '<div class="infofield">'.$this->diafan->_('Способ оплаты').':</div>';
				echo '<select name="payment_id">';
				echo '<option value="" selected></option>';
				foreach($result["payments"] as $row)
				{
					echo '<option value="'.$row['id'].'">'.$row['name'].'</div>';
				}
				echo '</select>';
				echo '</div>';
				/*
				echo '<div class="infofield sposob" ><span class="span">'.$this->diafan->_('Способ оплаты').':</span></div>
				<div class="cart_payments">';
				foreach($result["payments"] as $row)
				{
					echo '<div class="cart_payment"><input name="payment_id" value="'.$row['id'].'" type="radio" '.($row == $result["payments"][0] ? 'checked' : '').'> '.$row['name'];
					if(! empty($row['text']))
					{
						echo '<div class="cart_payment_text">'.$row['text'].'</div>';
					}
					echo '</div>';
				}
				echo '</div>';
				*/
			}
		}
	}
	if(! empty($result["subscribe_in_order"]))
	{
		echo '<div class="infofield">' . $this->diafan->_('Подписаться на новости') . '</div><input type="checkbox" checked name="subscribe_in_order">';
	}
}

echo '<div class="cart_form_bottm">';
echo '<a href="javascript:void(0)" class="clear-cart-form">Очистить форму</a>';
echo '<span class="button_wrap"><input type="submit" value="'.$this->diafan->_('Продолжить', false).'" class="btn"></span>';
echo '</div>';
echo '<div class="errors error"'.($result["error"] ? '>'.$result["error"] : ' style="display:none">').'</div>';
# <div class="required_field"> '.$this->diafan->_('Поля, отмеченные звездочкой обязательны для заполнения').'</div>
echo '</form>';
echo '</div>';
?>
<script type="text/javascript">
$(document).ready(function(){
	$('.clear-cart-form').click(function(){
		$('.inptext').each(function(){ $(this).val(''); });
		$('select[name="payment_id"]').val('');
	});
});
</script>
<?

?>