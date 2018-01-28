<?php
/**
 * Модель модуля "On-line консультант"
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (! defined('DIAFAN'))
{
	include(dirname(dirname(dirname(__FILE__))).'/includes/404.php');
}

class Consultant_model extends Model
{
	/**
	 * Генерирует данные для шаблонной функции: on-line консультант
	 * @return string
	 */
	public function show_block()
	{
		if(! $this->diafan->configmodules("login", "consultant"))
		{
			return '';
		}
		$result = '
<!-- RedHelper -->
<link href="'.BASE_PATH.'modules/consultant/consultant.css" rel="stylesheet" type="text/css">';
$place = $this->diafan->configmodules("place", "consultant");
if(! in_array($place, array('top', 'left', 'right')))
{
	$place = 'left';
}
if($this->diafan->configmodules("small", "consultant"))
{
	$place .= '_small';
}
if($this->diafan->configmodules("color", "consultant"))
{
	$result .= '<style type="text/css">
	.redhlp_button_diafan_'.$place.' span
	{
	background-color:'.$this->diafan->configmodules("color", "consultant").' !important;
	}
	</style>';
}
$result  .= '<div class="redhlp_button_diafan_'.$place.' redhlp_button"><span class="offline"></span><span class="online"></span></div>
<script id="rhlpscrtg" type="text/javascript" charset="utf-8" async="async" 
	src="https://web.redhelper.ru/service/main.js?c='.$this->diafan->configmodules("login", "consultant").'">
</script>
<script>
redhlpSettings = {';
if($this->diafan->configmodules("chatX", "consultant"))
{
	$result .= "\n".'chatX: "'.str_replace(array('"', "\n"), '', $this->diafan->configmodules("chatX", "consultant")).'",'."\n";
}
if($this->diafan->configmodules("chatY", "consultant"))
{
	$result .= "\n".'chatY: "'.str_replace(array('"', "\n"), '', $this->diafan->configmodules("chatY", "consultant")).'",'."\n";
}
if($this->diafan->configmodules("header", "consultant"))
{
	$result .= "\n".'header: "'.str_replace(array('"', "\n"), '', $this->diafan->configmodules("header", "consultant")).'",'."\n";
}
if($this->diafan->configmodules("topText", "consultant"))
{
	$result .= "\n".'topText: "'.str_replace(array('"', "\n"), '', $this->diafan->configmodules("topText", "consultant")).'",'."\n";
}
if($this->diafan->configmodules("topText", "consultant"))
{
	$result .= "\n".'welcome: "'.str_replace(array('"', "\n"), '', $this->diafan->configmodules("welcome", "consultant")).'",'."\n";
}
if($this->diafan->configmodules("inviteTime", "consultant"))
{
	$result .= "\n".'inviteTime: '.intval($this->diafan->configmodules("inviteTime", "consultant")).','."\n";
}
if($this->diafan->configmodules("chatWidth", "consultant"))
{
	$result .= "\n".'chatWidth: '.intval($this->diafan->configmodules("chatWidth", "consultant")).','."\n";
}
if($this->diafan->configmodules("chatHeight", "consultant"))
{
	$result .= "\n".'chatHeight: '.intval($this->diafan->configmodules("chatHeight", "consultant")).','."\n";
}

	//$result .= "\n".'hideBadge: true,'."\n";
	$result .= '
}

</script>
<!--/Redhelper -->';
		return $result;
	}
}