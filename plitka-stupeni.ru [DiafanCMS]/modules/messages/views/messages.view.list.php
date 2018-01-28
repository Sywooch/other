<?php
/**
 * Контакты
 *
 * Шаблон вывода списка контактов в модуле «Личные сообщения»
 *
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
if (!defined('DIAFAN'))
{
    include(dirname(dirname(dirname(__FILE__))).'/includes/404.php');
}

if (empty($result['rows']))
{
	echo $this->diafan->_('У Вас нет ни одного контакта. Чтобы вести приватную переписку с пользователем нужно на странице пользователя выбрать «Напишите сообщение».');
	return false;
}

echo '<table class="messages">';
foreach ($result['rows'] as $row)
{

	$user = $row['user']['fio'].' ('.$row['user']['name'].')';
	if(!empty($row['user']['user_page']))
	{
		$user = '<a href="'.$row['user']['user_page'].'">'.$user.'</a>';
	}
	$user .= '<br>'.$row['last_message']['created'];
	if (!empty($row['user']['avatar']))
	{
		$user = '<table><tr><td><img src="'.$row["user"]["avatar"].'" width="'.$row["user"]["avatar_width"].'" height="'.$row["user"]["avatar_height"].'" alt="'.$row["user"]["fio"].' ('.$row["user"]["name"].')" class="avatar"></td><td>'.$user.'</td></tr></table>';
	}
	echo '<tr><td>'.$user.'</td><td><a href="'.$row['link'].'">'.$row['last_message']['text'].'</a></td></tr>';
}
echo '</table>';