<?php
/**
 * Шаблон reCAPTCHA
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

$text = '
<div class="captcha">
	<div id="recaptcha_div_'.$result["modules"].'"></div>
	<div class="recaptcha_show"><a href="javascript:void(0)" onclick="create_recaptcha(\'recaptcha_div_'.$result["modules"].'\');">'.$this->diafan->_('Показать каптчу').'</a></div>
	<div class="errors error_captcha"'.($result["error"] ? '>'.$result["error"] : ' style="display:none">').'</div>
</div>
<script type="text/javascript">
$(document).ready(function () {
create_recaptcha("recaptcha_div_'.$result["modules"].'");
});</script>';

return $text;