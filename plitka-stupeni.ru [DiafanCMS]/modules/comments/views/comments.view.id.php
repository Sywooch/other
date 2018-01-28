<?php
/**
 * Один комментарий
 * 
 * Шаблон вывода одного комментария
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (! defined('DIAFAN'))
{
	include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

$text = '<div class="comment">';
if (! empty($result["name"]))
{
	$text .= '<div class="comments_name">';
	if (! empty($result["name"]["avatar"]))
	{
		$text .= '<img src="'.$result["name"]["avatar"].'" width="'.$result["name"]["avatar_width"].'" height="'.$result["name"]["avatar_height"].'" alt="'.$result["name"]["fio"].' ('.$result["name"]["name"].')" class="avatar"> ';
	}
	if(array_key_exists('fio', $result["name"]) && array_key_exists('name', $result["name"])) 
	{
	    $name = $result["name"]["fio"].($result["name"]["name"] ? ' ('.$result["name"]["name"].')' : '');
	}
	else
	{
	    $name='';
	}
	
	if(! empty($result["name"]["user_page"]))
	{
		$name = '<a href="'.$result["name"]["user_page"].'">'.$name.'</a>';
	}
	$text .= $name.'</div>';
}
if ($result['date'])
{
	$text .= '<div class="comments_date">'.$result['date'].'</div>';
}

foreach ($result["params"] as $param)
{
	$text .= '<div class="comments_param'.($param["type"] == 'title' ? '_title' : '').'">'.$param["name"];
	if (! empty($param["value"]))
	{
		$text .=  ': <span class="comments_param_value">';
		if($param["type"] == "attachments")
		{
			foreach($param["value"] as $a)
			{
				if ($a["is_image"])
				{
					if($param["use_animation"])
					{
						$text .= ' <a href="'.$a["link"].'" rel="prettyPhoto[gallery'.$result["id"].'comments]"><img src="'.$a["link_preview"].'"></a> <a href="'.$a["link"].'" rel="prettyPhoto[gallery'.$result["id"].'comments_link]">'.$a["name"].'</a>';
					}
					else
					{
						$text .= ' <a href="'.$a["link"].'"><img src="'.$a["link_preview"].'"></a> <a href="'.$a["link"].'">'.$a["name"].'</a>';
					}
				}
				else
				{
					$text .= ' <a href="'.$a["link"].'">'.$a["name"].'</a>';
				}
			}
		}
		elseif($param["type"] == "images")
		{
			foreach($param["value"] as $img)
			{
				$text .= '<img src="'.$img["src"].'" width="'.$img["width"].'" height="'.$img["height"].'" alt="'.$img["alt"].'" title="'.$img["title"].'">';
			}
		}
		elseif (is_array($param["value"]))
		{
			foreach ($param["value"] as $p)
			{
				if ($param["value"][0] != $p)
				{
					$text .=  ', ';
				}
				if (is_array($p))
				{
					$text .=  $p["name"];
				}
				else
				{
					$text .=  $p;
				}
			}
		}
		else
		{
			$text .=  $param["value"];
		}
		$text .=  '</span>';
	}
	$text .=  '</div>';
}

$text .= '<div class="comments_text">'.$result['text']."</div>";

if($result["form"])
{
	$text .= '
	<a href="javascript:void(0)" class="comments_show_form">'.$this->diafan->_('Ответить').'</a>
	<div style="display:none;" class="comments_block_form comments'.$result["id"].'_block_form">';
	$text .= $this->get('form', 'comments', $result["form"]);
	$text .= '</div>';
}

if ($result["children"])
{
	$text .= '<div class="comments_level comments'.$result["id"].'_result">'.$this->get('list', 'comments', $result["children"]).'</div>';
}
else
{
	$text .= '<div class="comments_level comments'.$result["id"].'_result" style="display:none;"></div>';
}
$text .= '</div>';
return $text;
