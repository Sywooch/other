<?php

if (! defined('DIAFAN'))
{
	include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

if ($result)
{
	foreach ($result as $row)
	{
		echo '<p style="margin-left:'.$row["margin"].'px;"><a href="'.BASE_PATH_HREF.$row["link"].'">'.$row["name"].'</a></p>';
	}
}