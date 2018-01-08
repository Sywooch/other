<?php $menu = & JSite::getMenu(); ?>
<!DOCTYPE html>
<html>
<head><meta name='yandex-verification' content='7d5795459dbe69fb' >
<title> </title>
<jdoc:include type="head">
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/template.css" type="text/css" >
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/style.css" type="text/css" >
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/cart.css" type="text/css" >
<link rel="shortcut icon" href="templates/<?php echo $this->template ?>/images/favicon.ico" type="image/x-icon">
<script type="text/javascript">
function showHide() {
  if ( document.getElementById("call-fix").style.display == "none" )
    document.getElementById("call-fix").style.display = "block";
  else
    document.getElementById("call-fix").style.display = "none";
}
</script>

<!-- Add jQuery library -->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.min.js"></script>

<!-- Add fancyBox -->
<link rel="stylesheet" href="/templates/main/fancybox/source/jquery.fancybox.css?v=2.1.4" type="text/css" media="screen" >
<script type="text/javascript" src="/templates/main/fancybox/source/jquery.fancybox.pack.js?v=2.1.4"></script>

<!-- Optionally add helpers - button, thumbnail and/or media -->
<link rel="stylesheet" href="/templates/main/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" >
<script type="text/javascript" src="/templates/main/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="/templates/main/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.5"></script>

<link rel="stylesheet" href="/templates/main/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" >
<script type="text/javascript" src="/templates/main/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
<script type="text/javascript">
$(document).ready(function() {
	$(".fancybox").fancybox({
		autoPlay : 'true',
		playSpeed : '2000',
	});
});
</script>


<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-32913439-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<script type="text/javascript">
    var _alloka = {
        objects: {
            '004e0faffc025139': {
                block_class: 'phone_alloka'
            }
        },
        trackable_source_types: ['typein', 'referrer', 'utm']
    };
</script>
<script src="http://analytics.alloka.ru/v4/alloka.js" type="text/javascript"></script>
</head>

<?php if ($option == 'com_datsogallery') { ?>	
<body onLoad="stopstatus=0;runSlideShow();clearAttr();">
<?php } else { ?>
<body id="bod_st">
<a rel="nofollow" href="vk.com"></a>
<?php } ?>


<?php
$Itemid = JRequest::getInt( 'Itemid', 1, 'get' );
$option = JRequest::getVar('option', null); 
$view = JRequest::getVar('view', null); 
$document 	= & JFactory::getDocument();
$user = & JFactory::getUser();
/*
echo '<h1>';
echo $Itemid;
echo $option;
echo $view;
echo '</h1>';
*/
?>
	<div class="all">
		<div class="head">
<?php
$menu = & JSite::getMenu();
if ($menu->getActive() == $menu->getDefault()) {
// на главной
}
else {
// не на главной
echo ('<a href="" class="home_link"></a>');
}
?>

			<div class="head_contacts">
<jdoc:include type="modules" name="head_contacts" />
			</div>
		<div class="mainmenu">
<jdoc:include type="modules" name="mainmenu" />
<p id="inter">
<a class="fancybox" rel="gallery1" href="images/gallery/bakinsky_zal_sokolniki_1.jpg">Интерьер</a></p>
		</div>
<div class="plav_cart"><?
//��������� �������.
$strpath="bas/index.php";
$adrself=getcwd();
for($i=0; $i<100; $i++)
 {
    if(file_exists("public_html"))break;
    if (!file_exists($strpath)) chdir("..");
    else break;
 }
include ($strpath);
chdir($adrself);
 ?>
</div>
		</div>
		<div class="content">
			<div class="left_cont">
				<div class="menu-b">
<jdoc:include type="modules" name="info" />
				</div>
<div class="videotur"><h5>Виртуальный Тур по ресторану Бакинский Дворик</h5>
    <script src="http://lookon.ru/Scripts/widget?tourId=20a2a254f5b7&width=300&height=226&showType=fancy&nomap=false" type="text/javascript">
    </script>
</div>
				<div class="articles">
					<p class="title"><a href="/articles">Новостная лента</a></p>
<jdoc:include type="modules" name="articles" />
				</div>
				<div id="order-barb">

<jdoc:include type="modules" name="saslik" style="xhtml" />

				</div>
				<?php if ($Itemid != '2')     { ?>
				<div class="interier">
				<a rel="gallery1" href="images/gallery/bakinsky_zal_sokolniki_2.jpg">	<p class="title">Интерьер</p>
<jdoc:include type="modules" name="interier" /></a>
				</div>
				<?php } ?>				
				<div class="info">
<jdoc:include type="modules" name="info-text" />
				</div>
	
			</div>
			<div class="right_cont">
			
			<?php if ($Itemid == '2')     { ?><!--<noindex> -->
<div class="news">
<jdoc:include type="modules" name="news" />

<script type="text/javascript" src="//yandex.st/share/share.js"
charset="utf-8"></script>

<script type="text/javascript">
    document.write('<div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="button" data-yashareQuickServices="yaru,vkontakte,facebook,twitter,odnoklassniki,moimir,lj,moikrug,gplus"></'+'div>')
</script>

<!-- </noindex> -->

				</div>
				<div class="dostavka">
					<div class="d-inner"></div>
					<p class="title"><a href="/kavkazskaia-kukhnia-dostavka-na-dom-gotovykh-bliud">Доставка блюд</a></p>
					<div class="dostavka-i">
<jdoc:include type="modules" name="dostavka" />
					</div>			
					<div class="dostavka-b"></div>
					
				</div>
				
				<div class="vk" style="margin-top:-15px;"><!-- <noindex> -->
				<script type="text/javascript" src="//vk.com/js/api/openapi.js?84"></script>
<!-- DC Mobile Landing -->
<script type="text/javascript">(function(e,t,n,r,i){var s,o,u,a,f,l="length",c=[];t.referrer[l]&&c.push("r="+encodeURIComponent(t.referrer));if(t.cookie.indexOf(i)>-1){s=t.cookie.split(i+"="),o=1;s[l]===2&&(o=s.pop().split(";").shift());c.push("c="+encodeURIComponent(o))}u="";c[l]&&(u="?"+c.join("&"));a=t.createElement(n);a.src=r+u;a.async=!0;f=t.getElementsByTagName(n)[0];f.parentNode.insertBefore(a,f)})(window,document,"script","//www.delivery-club.ru/landing.js","dc_l_s");</script>
<!-- /DC Mobile Landing -->
<!-- VK Widget -->
<div id="vk_groups"></div>
<script type="text/javascript">
VK.Widgets.Group("vk_groups", {mode: 2, width: "590", height: "150"}, 49972252);
</script><!-- </noindex> -->
				</div>
				
				
			<?php } else { ?>
			<div class="shadow">
	<jdoc:include type="component" />
		</div>
			<?php } ?>
			</div>
		</div>
		
			<?php if ($Itemid == '2')     { ?>
		<div class="seo-text">
			<div class="col1">
							<?php if ($Itemid == '2')     { ?>
				<div class="interier">
					<a rel="gallery1" href="images/gallery/bakinsky_zal_sokolniki_2.jpg" class="fancybox"><p class="title"> Интерьер</p>
<jdoc:include type="modules" name="interier" /></a>
				</div>
				<?php } ?>				

<jdoc:include type="modules" name="seo-col1" />
				</div>
			<div class="col2">
<jdoc:include type="modules" name="seo-col2" />
			</div>
		</div>
			<?php } ?>
		
		<div class="empty"></div>
		<div class="footer">
			<div class="footmenu">
<jdoc:include type="modules" name="mainmenu" />
<p id="inter1"><a rel="gallery1" href="images/gallery/bakinsky_zal_sokolniki_3.jpg" class="fancybox">Интерьер</a></p>

			</div>
			<div class="foot-adr">
<jdoc:include type="modules" name="foot-adr" />
			</div>
			<div class="time">Пн-Вс круглосуточно</div>
			<div class="copyright">"Бакинский дворик" 2011-2013
			<?php if ($Itemid == '2')     { ?>
			<br>
			<a href="/sitemap.xml">карта сайта</a>
			<?php } ?>
			</div>
	


	
		<div id="counter"><!-- <noindex> -->
<!--LiveInternet counter--><script type="text/javascript"><!--
document.write("<a rel="nofollow" href='http://www.liveinternet.ru/click' "+
"target=_blank><img src='//counter.yadro.ru/hit?t44.18;r"+
escape(document.referrer)+((typeof(screen)=="undefined")?"":
";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
";"+Math.random()+
"' alt='' title='LiveInternet' "+
"border='0' width='31' height='31'><\/a>")
//--></script><!--/LiveInternet-->
<!--Rating@Mail.ru counter-->
<a target="_top" href="http://top.mail.ru/jump?from=1802588" rel="nofollow">
<img src="http://d1.c8.bb.a1.top.mail.ru/counter?id=1802588;t=109" 
height="18" width="88" alt="Рейтинг@Mail.ru"></a>
<!--// Rating@Mail.ru counter-->
<!-- begin of Top100 code -->
<script id="top100Counter" type="text/javascript" src="http://counter.rambler.ru/top100.jcn?2118648"></script><noscript><img src="http://counter.rambler.ru/top100.cnt?2118648" alt="" width="1" height="1"></noscript>
<!-- end of Top100 code -->
<!-- begin of Top100 logo -->
<a href="http://top100.rambler.ru/home?id=2118648" target="_blank" rel="nofollow"><img src="http://top100-images.rambler.ru/top100/b1.gif" alt="Rambler's Top100" width="88" height="31"></a>
<!-- end of Top100 logo -->
<!-- Yandex.Metrika informer -->
<a href="http://metrika.yandex.ru/stat/?id=3097021&amp;from=informer"
target="_blank" rel="nofollow"><img src="//bs.yandex.ru/informer/3097021/3_1_FFFFFFFF_EFEFEFFF_0_pageviews"
style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" onclick="try{Ya.Metrika.informer({i:this,id:3097021,type:0,lang:'ru'});return false}catch(e){}"></a>
<!-- /Yandex.Metrika informer -->

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter3097021 = new Ya.Metrika({id:3097021, enableAll: true, webvisor:true});
        } catch(e) {}
    });
    
    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/3097021" style="position:absolute; left:-9999px;" alt=""></div></noscript>
<!-- /Yandex.Metrika counter -->


</div>
		
		
		
		
		</div>
		
	</div><!-- </noindex> -->
 
 <div id="gall_module" style="display:none;">

<a class="fancybox" rel="gallery1" href="images/gallery/bakinsky_zal_sokolniki_3.jpg"></a>
<a class="fancybox" rel="gallery1" href="images/gallery/bakinsky_zal_sokolniki_4.jpg"></a>
<a class="fancybox" rel="gallery1" href="images/gallery/bakinsky_zal_sokolniki_5.jpg"></a>
<a class="fancybox" rel="gallery1" href="images/gallery/bakinsky_zal_sokolniki_6.jpg"></a>
<a class="fancybox" rel="gallery1" href="images/gallery/bakinsky_zal_sokolniki_7.jpg"></a>
<a class="fancybox" rel="gallery1" href="images/gallery/bakinsky_zal_sokolniki_8.jpg"></a>
<a class="fancybox" rel="gallery1" href="images/gallery/bakinsky_zal_sokolniki_9.jpg"></a>
<a class="fancybox" rel="gallery1" href="images/gallery/bakinsky_zal_sokolniki_10.jpg"></a>
<a class="fancybox" rel="gallery1" href="images/gallery/bakinsky_zal_sokolniki_11.jpg"></a>
<a class="fancybox" rel="gallery1" href="images/gallery/bakinsky_zal_sokolniki_12.jpg"></a>
<a class="fancybox" rel="gallery1" href="images/gallery/bakinsky_zal_sokolniki_13.jpg"></a>
<a class="fancybox" rel="gallery1" href="images/gallery/bakinsky_zal_sokolniki_14.jpg"></a>
<a class="fancybox" rel="gallery1" href="images/gallery/bakinsky_zal_sokolniki_15.jpg"></a>
<a class="fancybox" rel="gallery1" href="images/gallery/bakinsky_zal_sokolniki_16.jpg"></a>
<a class="fancybox" rel="gallery1" href="images/gallery/bakinsky_zal_sokolniki_17.jpg"></a>
<a class="fancybox" rel="gallery1" href="images/gallery/bakinsky_zal_sokolniki_18.jpg"></a>
<a class="fancybox" rel="gallery1" href="images/gallery/bakinsky_zal_sokolniki_19.jpg"></a>
<a class="fancybox" rel="gallery1" href="images/gallery/bakinsky_zal_sokolniki_20.jpg"></a>
<a class="fancybox" rel="gallery1" href="images/gallery/bakinsky_zal_sokolniki_21.jpg"></a>
<a class="fancybox" rel="gallery1" href="images/gallery/bakinsky_zal_sokolniki_23.jpg"></a>
<a class="fancybox" rel="gallery1" href="images/gallery/bakinsky_zal_sokolniki_24.jpg"></a>
<a class="fancybox" rel="gallery1" href="images/gallery/bakinsky_zal_sokolniki_26.jpg"></a>
<a class="fancybox" rel="gallery1" href="images/gallery/bakinsky_zal_sokolniki_28.jpg"></a>
<a class="fancybox" rel="gallery1" href="images/gallery/bakinsky_zal_sokolniki_29.jpg"></a>
<a class="fancybox" rel="gallery1" href="images/gallery/bakinsky_zal_sokolniki_30.jpg"></a>
<a class="fancybox" rel="gallery1" href="images/gallery/bakinsky_zal_sokolniki_31.jpg"></a>
<a class="fancybox" rel="gallery1" href="images/gallery/bakinsky_zal_sokolniki_33.jpg"></a>
<a class="fancybox" rel="gallery1" href="images/gallery/bakinsky_zal_sokolniki_36.jpg"></a>
<a class="fancybox" rel="gallery1" href="images/gallery/bakinsky_zal_sokolniki_37.jpg"></a>
<a class="fancybox" rel="gallery1" href="images/gallery/bakinsky_zal_sokolniki_38.jpg"></a>
<a class="fancybox" rel="gallery1" href="images/gallery/bakinsky_zal_sokolniki_39.jpg"></a>

</div>



</body>
</html>