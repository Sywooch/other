<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// Import library dependencies
jimport('joomla.event.plugin');
jimport('joomla.plugin.plugin');


$mainframe->registerEvent('onPrepareContent', 'plgSBMarks' );

function disp( &$article, &$params, $limitstart )
{
	$view = JRequest::getCmd('view');
	if ( ($view != 'article')
	|| JRequest::getBool('fullview')
	|| JRequest::getVar('print'))
		{
		        return null; exit;
		} 






global $mainframe;
        /* The url adress of page */
        $currurl = JURI::current();
        $content='';

	if ($params->get('sef')==0) $currurl= 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ;
	$currurl1 = $currurl;
	if ($params->get('shorturl')==1) {
        $ch = curl_init("http://0lv.ru/api.php?url=".$currurl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $currurl1 = curl_exec($ch);     
        curl_close($ch);
  }
  	if ($params->get('shorturl')==2) {
		$content.='<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>';
		
  		
  		}

	$baseurl = JURI::base();
	$document = &JFactory::getDocument();
	$title = $document->getTitle();
        /* vkontakte custom */
       $twitter=$params->get( 'twitter_login');
       $pretext=$params->get( 'pretext');
	$h=48;
	$h=$params->get( 'size');
	$b='#FDFFBC';
	$b=$params->get( 'background');
	$ic=$params->get( 'iconset');
	if ($ic=='set1-24.png') { $ic=1; } else $ic=2;
	$p=10;
	$p=$params->get( 'padd');
	if ($params->get( 'copy')==1) {
	$copy='<div class="butsclear"></div><div class="butscopy"><a href="http://www.joomla-wp.ru/index.php?/plaginy-joomla/plugin-russian-social-bookmarks-buttons.html">Поставить себе на сайт такой же плагин</a></div>'; }
	else { $copy=""; } ;


	   $content.= '
<style>
.butsclear  {
clear:both;
content:"";
display:block;
height:0;
font-size:0;
visibility:hidden;} 
.allbuts {display:block;float:left;}
.buttons{
font-size: 13px;            /* размер шрифта */
font-weight: bold;         /* стиль текста: жирный */			
padding:5px;               /* отступ от границ */';
if ($params->get( 'border')==1) $content.= 'border:1px solid #CCC;   /* толщина и цвет рамки */';
$content.= 
'background: '.$b.';   /* фоновый цвет */
display:block;
float:left;
}
.allbuts a { height:'.$h.'px ;width:'.$h.'px; display:block; float:left; padding-right:'.$p.'px;} 
.buttons .allbuts a div{
border: none;
opacity:1.0;                 /* непрозрачность: 100% */
}
 
.buttons .allbuts a:hover div{
border: none;
opacity:0.7;                 /* непрозрачность: 70% */
}
.buts'.$h.' {
background: url(/plugins/content/rusbuttons/set'.$ic.'-'.$h.'.png) no-repeat;
width:'.$h.'px;
height:'.$h.'px;
float:left;
display:block;
}
#ibuts2 {background-position:-'.($h*1).'px 0px;}
#ibuts3 {background-position:-'.($h*2).'px 0px;}
#ibuts4 {background-position:-'.($h*3).'px 0px;}
#ibuts5 {background-position:-'.($h*4).'px 0px;}
#ibuts6 {background-position:-'.($h*5).'px 0px;}
#ibuts7 {background-position:-'.($h*6).'px 0px;}
#ibuts8 {background-position:-'.($h*7).'px 0px;}
#ibuts9 {background-position:-'.($h*8).'px 0px;}
div.butscopy {font-size:8px; display:block;float:right; clear:left; }
div.butscopy a {color:lightgray;}
div.butscopy a:hover {color:gray;}
</style>
<div class="buttons"><div class="butspre">'.$pretext.'</div><div class="allbuts">
<a rel="nofollow" target="_blank" href="';
if ($params->get('shorturl')==2) { $content.='http://twitter.com/share?url=http%3A%2F%2Ft.co%2F9p0rrv&amp;counturl='.urlencode($currurl1).'&amp;text='.urlencode($twitter.' '.$title.': ');}
else { $content.='http://twitter.com/home?status='.urlencode($twitter.' '.$title.': '.$currurl1); }
$content.='" rel="nofollow" title="Добавить в Twitter"><div class="buts'.$h.'" id="ibuts1" title="Опубликовать в Twitter" alt="Опубликовать в Twitter"></div></a>
 
<a rel="nofollow" target="blank" href="http://www.facebook.com/sharer.php?u='.urlencode($currurl).'"><div class="buts'.$h.'" id="ibuts2"  title="Написать в Facebook" alt="Написать в Facebook" ></div></a>
 
<a rel="nofollow" target="_blank" href="http://vkontakte.ru/share.php?url='.urlencode($currurl).'" ><div class="buts'.$h.'" id="ibuts3"  title="Поделиться ВКонтакте" alt="Поделиться ВКонтакте" ></div></a>

 
<a rel="nofollow" target="_blank" href="http://www.google.com/buzz/post?url='.urlencode($currurl).'&title='.urlencode($title).'&srcURL='.$baseurl.'" ><div class="buts'.$h.'" id="ibuts4"  title="В Google Buzz" alt="В Google Buzz" ></div></a>
 
<a rel="nofollow" target="_blank" href="http://www.livejournal.com/update.bml?event='.urlencode($currurl).'&subject='.urlencode($title).'" ><div class="buts'.$h.'" id="ibuts5"  title="Записать себе в LiveJournal" alt="Записать себе в LiveJournal" ></div></a>
 
<a rel="nofollow" target="_blank" href="http://connect.mail.ru/share?share_url='.urlencode($currurl).'" ><div class="buts'.$h.'" id="ibuts6"  title="Показать В Моем Мире" alt="Показать В Моем Мире" ></div></a>
 
<a rel="nofollow" target="_blank" href="http://www.liveinternet.ru/journal_post.php?action=n_add&cnurl='.urlencode($currurl).'&cntitle='.urlencode($title).'" ><div class="buts'.$h.'" id="ibuts7"  title="В дневник на LI.RU" alt="В дневник на LI.RU" ></div></a>

 
<a rel="nofollow" target="_blank" href="http://my.ya.ru/posts_add_link.xml?URL='.urlencode($currurl).'&title='.urlencode($title).'" ><div class="buts'.$h.'" id="ibuts8"  title="Поделиться ссылкой на Я.ру" alt="Поделиться ссылкой на Я.ру"></div></a>

<a rel="nofollow" href="'.$currurl.'" target="_blank" class="soc-but-classmates" onclick="ODKL.Share(this);return false;"><div class="buts'.$h.'" id="ibuts9" title="Поделиться ссылкой в Одноклассниках" alt="Поделиться ссылкой в Одноклассниках"></div></a>
</div>'.$copy.'
</div><div class="butsclear"></div>';
return $content;



}



class plgcontentRusButtons extends JPlugin
{
    function plgcontentRusButtons (&$subject,$params)
    {
        parent::__construct ($subject,$params);
	$document = &JFactory::getDocument();
	$document->addScript( '/plugins/content/rusbuttons/odkl_share.js' );


    }

function onAfterDisplayContent( &$article, &$params, $limitstart )
{ 
	if ($this->params->get('showon') == 1 ) {
		$content = disp($article, $this->params, $limitstart );}
	return $content; 
}
}
function plgSBMarks( &$article, &$params, $limitstart )
{
	static $pluginParams = null;

	if(preg_match('{social}',$article->text))
	{

			$db = JFactory::getDBO();

			$plugin =& JPluginHelper::getPlugin('content', 'rusbuttons');
			$pluginParams = new JParameter( $plugin->params );


$content = disp( $article, $pluginParams, $limitstart );
		
		$article->text = str_replace('{social}',$content,$article->text);
	}
	return true;
} 






?>

