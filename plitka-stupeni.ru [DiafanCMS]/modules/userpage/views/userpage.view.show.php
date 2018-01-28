<?php
/**
 * Страница пользователя
 * 
 * Шаблон страницы пользователя
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
if (!defined('DIAFAN'))
{
    include(dirname(dirname(dirname(__FILE__))) . '/includes/404.php');
}

echo '<div class="user_page"><table><tr>';
if (!empty($result['avatar']))
{
	echo '<td><img src="' . BASE_PATH . USERFILES.'/avatar/' . $result["name"] . '.png" width="' . $result["avatar_width"] . '" height="' . $result["avatar_height"] . '" alt="' . $result["fio"] . ' (' . $result["name"] . ')" class="user_page_avatar"></td>';
}
echo '<td>' . $result['fio'] . ' (' . $result['name'] . ')<br>' . $this->diafan->_('Дата регистрации') . ': ' . $result['created'] . '</td></tr></table>';

echo '<table>';
foreach ($result['param'] as $row)
{
	if($row['type'] == 'title')
	{
		echo '<tr><td><b>' . $row['name'] . '</b></td><td></td></tr>';
		continue;
	}
	if (empty($row['value']))
	{
		if($row['type'] == 'checkbox')
		{
			echo '<tr><td>' . $row['name'] . '</td><td></td></tr>';
		}
		continue;
	}
	echo '<tr><td>' . $row['name'] . ':</td><td>';
	switch ($row['type'])
	{
		case 'select':
			echo $row['value'][0];
			break;
		case 'multiple':
			echo implode(',', $row['value']);
			break;
		case "attachments":
			foreach($row['value'] as $a)
			{
				if ($a["is_image"])
				{
					if($row["use_animation"])
					{
						echo ' <a href="'.$a["link"].'" rel="prettyPhoto[galleryUsers]"><img src="'.$a["link_preview"].'"></a> <a href="'.$a["link"].'" rel="prettyPhoto[galleryUsers_link]">'.$a["name"].'</a>';
					}
					else
					{
						echo ' <a href="'.$a["link"].'"><img src="'.$a["link_preview"].'"></a> <a href="'.$a["link"].'">'.$a["name"].'</a>';
					}
				}
				else
				{
					echo ' <a href="'.$a["link"].'">'.$a["name"].'</a>';
				}
				echo '<br>';
			}
			break;
		case "images":
			foreach($row["value"] as $img)
			{
				echo '<img src="'.$img["src"].'" width="'.$img["width"].'" height="'.$img["height"].'" alt="'.$img["alt"].'" title="'.$img["title"].'">';
			}
			break;
		default:
			echo $row['value'];
	}
	echo '</td></tr>';
}

echo '</table>';

if ($result['form_messages'])
{
	$this->diafan->_tpl->get('form', 'messages', array("to" => $result['id']));
}

echo '</div>';