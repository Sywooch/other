<?php
/**
 * Переписка с пользователем
 *
 * Шаблон вывода сообщения с одним пользователем
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

echo '<table>';
foreach($result['rows'] as $row)
{
	echo '<tr><td>';
	if (!empty($row['name']['avatar']))
	{
		echo '<img src="'.$row["name"]["avatar"].'" width="'.$row["name"]["avatar_width"].'" height="'.$row["name"]["avatar_height"].'" alt="'.$row["name"]["fio"].' ('.$row["name"]["name"].')">';
	}
	$user = $row['name']['fio'].' ('.$row['name']['name'].')';
	if(!empty($row['name']['user_page']))
	{
		$user='<a href="'.$row['name']['user_page'].'">'.$user.'</a>';
	}
	echo '
	</td>
	<td>
		<div><div>'.$user.'</div>'.$row['text'].'</div>
	</td>
	<td >'.$row['created'].'</td>
	</tr>';
}
echo '</table>';

echo $this->get('get', 'paginator', $result['paginator']); 

$this->get('form', 'messages', array("to" => $this->diafan->show, "redirect" => 1));