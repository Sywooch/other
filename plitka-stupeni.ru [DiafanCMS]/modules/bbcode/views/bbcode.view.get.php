<?php
/**
 * Шаблон поля, для ввода сообщения
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (! defined('DIAFAN'))
{
	include dirname(dirname(dirname(dirname(__FILE__)))).'/includes/404.php';
}

$text = '
<div class="bbcode_toolbar">
	<img class="bbutton" src="'.BASE_PATH.'modules/bbcode/img/bold.gif" name="btnBold" title="Bold" onClick="doAddTags(\'[b]\', \'[/b]\', \''.$result["tag"].'\')">
	<img class="bbutton" src="'.BASE_PATH.'modules/bbcode/img/italic.gif" name="btnItalic" title="Italic" onClick="doAddTags(\'[i]\', \'[/i]\', \''.$result["tag"].'\')">
	<img class="bbutton" src="'.BASE_PATH.'modules/bbcode/img/underline.gif" name="btnUnderline" title="Underline" onClick="doAddTags(\'[u]\',\'[/u]\',\''.$result["tag"].'\')">
	<img class="bbutton" src="'.BASE_PATH.'modules/bbcode/img/link.gif" name="btnLink" title="Insert URL Link" onClick="doURL(\''.$result["tag"].'\')">
	<img class="bbutton" src="'.BASE_PATH.'modules/bbcode/img/picture.gif" name="btnPicture" title="Insert Image" onClick="doImage(\''.$result["tag"].'\')">
	<img class="bbutton" src="'.BASE_PATH.'modules/bbcode/img/ordered.gif" name="btnList" title="Ordered List" onClick="doList(\'[LIST=1]\',\'[/LIST]\',\''.$result["tag"].'\')">
	<img class="bbutton" src="'.BASE_PATH.'modules/bbcode/img/unordered.gif" name="btnList" title="Unordered List" onClick="doList(\'[LIST]\',\'[/LIST]\',\''.$result["tag"].'\')">
	<img class="bbutton" src="'.BASE_PATH.'modules/bbcode/img/quote.gif" name="btnQuote" title="Quote" onClick="doAddTags(\'[quote]\',\'[/quote]\',\''.$result["tag"].'\')">
	<img class="bbutton" src="'.BASE_PATH.'modules/bbcode/img/code.gif" name="btnCode" title="Code" onClick="doAddTags(\'[code]\',\'[/code]\',\''.$result["tag"].'\')">
</div>
<div class="bbcode_toolbar">
	<img class="smile" src="'.BASE_PATH.'modules/bbcode/smiles/smile.gif" onClick="doSmile(\'smile\',\''.$result["tag"].'\')">
	<img class="smile" src="'.BASE_PATH.'modules/bbcode/smiles/wink.gif" onClick="doSmile(\'wink\',\''.$result["tag"].'\')">
	<img class="smile" src="'.BASE_PATH.'modules/bbcode/smiles/acute.gif" onClick="doSmile(\'acute\',\''.$result["tag"].'\')">
	<img class="smile" src="'.BASE_PATH.'modules/bbcode/smiles/bad.gif" onClick="doSmile(\'bad\',\''.$result["tag"].'\')">
	<img class="smile" src="'.BASE_PATH.'modules/bbcode/smiles/biggrin.gif" onClick="doSmile(\'biggrin\',\''.$result["tag"].'\')">
	<img class="smile" src="'.BASE_PATH.'modules/bbcode/smiles/blum.gif" onClick="doSmile(\'blum\',\''.$result["tag"].'\')">
	<img class="smile" src="'.BASE_PATH.'modules/bbcode/smiles/blush.gif" onClick="doSmile(\'blush\',\''.$result["tag"].'\')">
	<img class="smile" src="'.BASE_PATH.'modules/bbcode/smiles/bomb.gif" onClick="doSmile(\'bomb\',\''.$result["tag"].'\')">
	<img class="smile" src="'.BASE_PATH.'modules/bbcode/smiles/boredom.gif" onClick="doSmile(\'boredom\',\''.$result["tag"].'\')">
	<img class="smile" src="'.BASE_PATH.'modules/bbcode/smiles/bye.gif" onClick="doSmile(\'bye\',\''.$result["tag"].'\')">
	<img class="smile" src="'.BASE_PATH.'modules/bbcode/smiles/clapping.gif" onClick="doSmile(\'clapping\',\''.$result["tag"].'\')">
	<img class="smile" src="'.BASE_PATH.'modules/bbcode/smiles/cool.gif" onClick="doSmile(\'cool\',\''.$result["tag"].'\')">
	<img class="smile" src="'.BASE_PATH.'modules/bbcode/smiles/cray.gif" onClick="doSmile(\'cray\',\''.$result["tag"].'\')">
	<img class="smile" src="'.BASE_PATH.'modules/bbcode/smiles/dance.gif" onClick="doSmile(\'dance\',\''.$result["tag"].'\')">
<br>
	<img class="smile" src="'.BASE_PATH.'modules/bbcode/smiles/diablo.gif" onClick="doSmile(\'diablo\',\''.$result["tag"].'\')">
	<img class="smile" src="'.BASE_PATH.'modules/bbcode/smiles/drinks.gif" onClick="doSmile(\'drinks\',\''.$result["tag"].'\')">
	<img class="smile" src="'.BASE_PATH.'modules/bbcode/smiles/empathy.gif" onClick="doSmile(\'empathy\',\''.$result["tag"].'\')">
	<img class="smile" src="'.BASE_PATH.'modules/bbcode/smiles/flag_of_truce.gif" onClick="doSmile(\'flag_of_truce\',\''.$result["tag"].'\')">
	<img class="smile" src="'.BASE_PATH.'modules/bbcode/smiles/good.gif" onClick="doSmile(\'good\',\''.$result["tag"].'\')">
	<img class="smile" src="'.BASE_PATH.'modules/bbcode/smiles/help.gif" onClick="doSmile(\'help\',\''.$result["tag"].'\')">
	<img class="smile" src="'.BASE_PATH.'modules/bbcode/smiles/hi.gif" onClick="doSmile(\'hi\',\''.$result["tag"].'\')">
	<img class="smile" src="'.BASE_PATH.'modules/bbcode/smiles/i_am_so_happy.gif" onClick="doSmile(\'i_am_so_happy\',\''.$result["tag"].'\')">
	<img class="smile" src="'.BASE_PATH.'modules/bbcode/smiles/lol.gif" onClick="doSmile(\'lol\',\''.$result["tag"].'\')">
	<img class="smile" src="'.BASE_PATH.'modules/bbcode/smiles/nea.gif" onClick="doSmile(\'nea\',\''.$result["tag"].'\')">
	<img class="smile" src="'.BASE_PATH.'modules/bbcode/smiles/negative.gif" onClick="doSmile(\'negative\',\''.$result["tag"].'\')">
	<img class="smile" src="'.BASE_PATH.'modules/bbcode/smiles/new_russian.gif" onClick="doSmile(\'new_russian\',\''.$result["tag"].'\')">
</div>
<textarea name="'.$result["name"].'" id="'.$result["tag"].'" class="inptext">'.$result["value"].'</textarea>';

if(empty($GLOBALS["include_bbcode_js"]))
{
	$GLOBALS["include_bbcode_js"] = true;
	$text .= '<script type="text/javascript" src="'.BASE_PATH.'modules/bbcode/bbcode.js"></script>';
}
return $text;