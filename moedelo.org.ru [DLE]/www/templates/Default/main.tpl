<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru" class="home">
<head>
{headers}
<meta name="robots" content="all" />
<meta name="revisit-after" content="5 days" />
<!-- <meta http-equiv="Content-Type" content="text/html; charset=windows-1251" /> -->
<!-- link rel="shortcut icon" href="{THEME}/images/favicon.ico" type="image/x-icon" -->
<link media="screen" href="{THEME}/style/styles.css" type="text/css" rel="stylesheet" />
<link media="screen" href="{THEME}/style/engine.css" type="text/css" rel="stylesheet" />
<link media="screen" href="{THEME}/style/core.css" type="text/css" rel="stylesheet" />
<!-- jbcallme -->
<script type="text/javascript" src="/jbcallme/js/jquery.js"></script>
<script type="text/javascript" src="/jbcallme/js/jquery.jbcallme.js"></script>
<link rel="stylesheet" type="text/css" href="/jbcallme/css/jquery.jbcallme.css">
    
<!-- Yandex.Metrika counter --><script type="text/javascript">(function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter4091107 = new Ya.Metrika({id:4091107, webvisor:true, clickmap:true, trackLinks:true, accurateTrackBounce:true}); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="//mc.yandex.ru/watch/4091107" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->
<script type="text/javascript">
$(function() {
    $(".um2-crs").jCarouselLite({
        btnNext: ".next",
        btnPrev: ".prev",
		visible: 6,[not-category=8,9,10,11,12,13,26,27,28,15,23,24,25]
    	auto: 5000,[/not-category]
    	speed: 600,[category=13,26,27,28]
		start: 1,[/category]
		pauseOnMouseOver: true
    });
    
    $("#callMeBtn").jbcallme();
    
   var obrz = $("#obratnayaSvaz").jbcallme({
        postfix: "callme_order",
        title: "Задайте нам свой вопрос",
        fields: {
            question: {
                label: "Ваш вопрос:",
                type: "textarea",
            },
            action: {
                type: "hidden",
                value: "obratnayaSvaz",
            },
        }});
    
    setTimeout(function() { obrz.click(); }, 45000);

});
</script>
<script type="text/javascript" src="{THEME}/js/jcarousellite.js"></script>
<script type="text/javascript" src="{THEME}/js/libs.js"></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-32830320-2', 'auto');
  ga('send', 'pageview');

</script>
</head>
<body>
{AJAX}


<!----insert---->


<header>
    <figure id="headerBackground"></figure>
    <div>
        <div id="fixedMenuRow1" class="">
            <nav class="left">
                <ul>
                    <li><a href="/prices">Тарифы</a></li>
                    <li><a href="/#/contacts" class="js-link">Контакты</a></li>
                </ul>
            </nav>
            <nav class="right">
                <ul>
                    <li><a href="https://www.moedelo.org/buro-authorization/" class="js-auth-link">Вход</a></li>
                    <li><a href="/registration">Регистрация</a></li>
                </ul>
            </nav>
            <a href="/#/" id="logo"><img src="http://buro.moedelo.org/style/img/logo-buro.svg " width="560" height="74"></a>
        </div>
        <h1 id="headerH1" style="opacity: 1;">
            <span>Онлайн забота о вашем бизнесе</span>
        </h1>
        <figure id="headerFigure" style="opacity: 1;">
            <ul>
                <li><a href="/#/revision" class="js-link">Оценим надёжность контрагента</a></li>
                <li><a href="/#/consulting" class="js-link">Проконсультируем по вопросам учёта, налогов и права</a></li>
                <li><a href="/#/documents" class="js-link">Подготовим документы</a></li>
                <li><a href="/#/revision" class="js-link">Предупредим о проверках</a></li>
            </ul>
        </figure>
        <nav id="fixedMenuRow2" class="">
            <ul>
                <li class="js-header-menu js-revision js-governmentRevision active">
                    <a href="/#/revision" class="js-link">
                        <i class="i-32"></i>
                        <span>Проверки</span>
                    </a>
                </li>
                <li class="js-header-menu js-documents">
                    <a href="/#/documents" class="js-link">
                        <i class="i-48"></i>
                        <span>Документы онлайн</span>
                    </a>
                </li>
                <li class="js-header-menu js-consulting">
                    <a href="/#/consulting" class="js-link">
                        <i class="i-9"></i>
                        <span>Консультации</span>
                    </a>
                </li>
                <li class="js-header-menu js-calculators">
                    <a href="/#/calculators" class="js-link">
                        <i class="i-39"></i>
                        <span>Калькуляторы</span>
                    </a>
                </li>
                <li class="js-header-menu js-reports">
                    <a href="/#/reports" class="js-link">
                        <i class="i-21"></i>
                        <span>Отчёты</span>
                    </a>
                </li>
                <li class="js-header-menu js-webinars">
                    <a href="/#/webinars" class="js-link">
                        <i class="i-40"></i>
                        <span>Вебинары</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</header>


<!----insert------>









<!------------->
<div class="u1-bg" align="center"style="background-color:red;  display:none;">
	<div class="t-950"><div class="um1" align="left"><a href="/login.html"
	target="_blank" style="float:right;">Войти в сервис</a><a href="/"
	[aviable=main]id="um1x"[/aviable]>Главная</a><a href="/for-bman/"
	[category=3,17,18,19,20,39]id="um1x"[/category]>Предпринимателям</a><a href="/for-buxg/"
	[category=16,21]id="um1x"[/category]>Бухгалтерам</a><a href="/pay.html"
	[static=pay]id="um1x"[/static]>Тарифы и оплата</a><a href="/resps/"
	[category=14]id="um1x"[/category]>Отзывы</a><a href="/contact/"
	[category=6]id="um1x"[/category]>Контакты</a></div></div>
</div>
<!------------>


<!----------->
<div class="u2-bg" align="center" style="background-color:yellow; display:none;">
	<div class="t-950">
		<div class="u2-c1" align="left">
			<a href="/"><img src="{THEME}/images/a4-logo.gif" width="406" height="87" border="0" alt="Моё дело - Иркутск" title="Моё дело - Иркутск | Иркутский региональный центр сопровождения малого бизнеса" /></a>
		</div><div class="u2-c2">
			<a href="/online-q/8-voprosy-on-line.html"><img src="{THEME}/images/a5-q[category=7]x[/category].gif" width="70" height="87" border="0" alt="Задать вопрос" title="Задать вопрос" /></a>
		</div><div class="u2-c2">
			<a href="/contact/"><img src="{THEME}/images/a6-z[category=6]x[/category].gif" width="72" height="87" border="0" alt="Записаться на приём" title="Записаться на приём" /></a>
		</div><div class="u2-c3" align="right">
        <img id="callMeBtn" src="{THEME}/images/a7-adtel.gif" width="278" height="87" alt="(3952) 723-053 | Иркутск, ул. Лермонтова, 134, оф. 206" title="+7 (3952) 723-053 | Иркутск, ул. Лермонтова, 134, оф. 206" />
		</div>
	</div>
</div>
<!----------->


[aviable=main]




<div class="u3-bg" align="center">
	<div class="u3-bg2">
		<div class="t-950"><a href="/super-paket/"><img src="{THEME}/images/b0-pic1.jpg" width="916" height="230" border="0" alt="Супер-Пакет для предпринимателей - в подарок! | Узнать подробнее.." title="Супер-Пакет для предпринимателей - в подарок! | Узнать подробнее.." /></a></div>
	</div>
</div>
[/aviable]


<!------------->

<div class="u4-bg" align="center"style="background-color:blue; display:none;">
	<div class="u4-bg3">
		<div class="t-950">

			<div class="um2-pre" align="center">
				<input class="prev" type="image" src="{THEME}/images/b3-left.gif" width="49" height="152" alt="&laquo;" title="&laquo; назад">
				<div class="um2-crs">
					<ul>
					<!--<li><a class="um2-c1[category=8]x[/category]" href="/super-paket/"><span>Супер-Пакет</span></a></li>-->
						<li><a class="um2-c2[category=9]x[/category]" href="/registr-ip/"><span>Регистрация<br />ИП</span></a></li>
						<li><a class="um2-c3[category=15]x[/category]" href="/registr-ooo/"><span>Регистрация<br />ООО</span></a></li>
						<li><a class="um2-c4[category=10]x[/category]" href="/new-stamp/"><span>Изготовление<br />печати</span></a></li>
						<li><a class="um2-c5[category=11]x[/category]" href="/open-rs/"><span>Открытие<br />расчетного<br />счета</span></a></li>
						<li><a class="um2-c6[category=12,23,24,25]x[/category]" href="/inet-buxg/"><span>Интернет-<br />бухгалтерия</span></a></li>
						<li><a class="um2-c7[category=13,26,27,28,29,30,31,32,33,34]x[/category]" href="/more/"><span>Прочие<br />услуги</span></a></li>
					</ul>
			  </div><input class="next" type="image" src="{THEME}/images/b3-right.gif" width="49" height="152" alt="&raquo;" title="вперед &raquo;">
				<div class="t-clr"></div>
			</div>

		</div>
	</div>
</div>
<!---------------->






<div align="center">
	<div class="t-950">
		<div class="m-c1[not-aviable=main|form|form2][not-category=3,16,17,18,19,20,21,5,22,35,12,23,24,25,13,26,27,28,29,30,31,32,33,34,36,37,38,39]x[/not-category][/not-aviable]" align="left">

{custom category="2" template="sh-news-m" aviable="main|form|form2" from="0" limit="3" fixed="yes" cache="yes"}
<table width="100%" border="0">
  <tr>
    <td width="50"><img src="http://moedelo.ucoz.com/avast.png" width="50" height="50"></td>
    <td valign="middle"> 
      <p><font face="Verdana" size="1">Для защиты Вашего компьютера рекомендуем установить <br>
        <a href="http://www.avast.com/ru-ru/get/IsbKLE35" target="_blank">бесплатный 
        антивирус <b>Avast</b></a>!</font></p>
      </td>
  </tr>
</table>
    <br>
[banner_ozon]
{banner_ozon}
[/banner_ozon]            
            <div [not-category=3,17,18,19,20,37,39]style="display:none"[/not-category]>
				<div class="lb-hm"><strong>Вопросы и ответы:</strong></div>
				<div class="lm1">
					<a href="/for-bman/bm-start/" [category=17]id="lm1x"[/category]><ul>• &nbsp;<li>Начинающим предпринимателям</li></ul></a>
					<a href="/for-bman/bm-reg-ip/" [category=18]id="lm1x"[/category]><ul>• &nbsp;<li>Регистрация ИП</li></ul></a>
                    <a href="/for-bman/bm-reg-ooo/" [category=37]id="lm1x"[/category]><ul>• &nbsp;<li>Регистрация ООО</li></ul></a>
					<a href="/for-bman/bm-law/" [category=19]id="lm1x"[/category]><ul>• &nbsp;<li>Юридические вопросы</li></ul></a>
					<a href="/for-bman/bm-envd/" [category=20]id="lm1x"[/category]><ul>• &nbsp;<li>ЕНВД</li></ul></a>
                    <a href="/for-bman/bm-psn/" [category=39]id="lm1x"[/category]><ul>• &nbsp;<li>ПСН</li></ul></a>
				</div>
			</div>

			<div [not-category=16,21]style="display:none"[/not-category]>
				<div class="lb-hm"><strong>Вопросы и ответы бухгалтерам:</strong></div>
				<div class="lm1">
					<a href="/for-buxg/bb-buxg/" [category=21]id="lm1x"[/category]><ul>• &nbsp;<li>Новости законодательства</li></ul></a>
				</div>
			</div>

			<div [not-category=5,22,35]style="display:none"[/not-category]>
				<div class="lb-hm"><strong>Наши партнеры:</strong></div>
				<div class="lm1">
					<a href="/partner/" [category=5]id="lm1x"[/category]><ul>• &nbsp;<li>Генеральные партнеры</li></ul></a>
					<a href="/partner-b/" [category=22]id="lm1x"[/category]><ul>• &nbsp;<li>Бизнес-партнеры</li></ul></a>
                    <a href="/partner-news/" [category=35]id="lm1x"[/category]><ul>• &nbsp;<li>Новости партнеров</li></ul></a>
				</div>
			</div>

			<div [not-category=12,23,24,25,36]style="display:none"[/not-category]>
				<div class="lb-hm"><strong>Интернет-Бухгалтерия:</strong></div>
				<div class="lm1">
					<a href="/inet-buxg/" [category=12]id="lm1x"[/category]><ul>• &nbsp;<li>Что такое Интернет-бухгалтерия?</li></ul></a>
					<a href="/inet-buxg/ib-why/" [category=23]id="lm1x"[/category]><ul>• &nbsp;<li>Преимущества сервиса "Моё дело"</li></ul></a>
					<a href="/inet-buxg/ib-features/" [category=24]id="lm1x"[/category]><ul>• &nbsp;<li>Возможности сервиса "Моё дело"</li></ul></a>
					<a href="/inet-buxg/ib-use/" [category=25]id="lm1x"[/category]><ul>• &nbsp;<li>Подключение к сервису "Моё дело"</li></ul></a>
                    <a href="/inet-buxg/ib-outsourcing/" [category=36]id="lm1x"[/category]><ul>• &nbsp;<li>Бухгалтерский аутсорсинг</li></ul></a>
				</div>
			</div>

			<div [not-category=13,26,27,28,29,30,31,32,33,34,38]style="display:none"[/not-category]>
				<div class="lb-hm"><strong>Прочие услуги:</strong></div>
				<div class="lm1">
                    <a href="/more/m-pos-terminal/" [category=29]id="lm1x"[/category]><ul>• &nbsp;<li>POS-терминал</li></ul></a>
				    <a href="/more/m-credit/" [category=26]id="lm1x"[/category]><ul>• &nbsp;<li>Кредитование</li></ul></a>
					<a href="/more/m-site/" [category=28]id="lm1x"[/category]><ul>• &nbsp;<li>Web-сайт</li></ul></a>
                    <a href="/more/m-hosting/" [category=38]id="lm1x"[/category]><ul>• &nbsp;<li>Хостинг</li></ul></a>
                    <a href="/more/m-redhelper/" [category=31]id="lm1x"[/category]><ul>• &nbsp;<li>Онлайн-консультант</li></ul></a>
                    <a href="/more/m-ads/" [category=27]id="lm1x"[/category]><ul>• &nbsp;<li>Реклама</li></ul></a>
                    <a href="/more/m-email/" [category=33]id="lm1x"[/category]><ul>• &nbsp;<li>E-mail рассылки</li></ul></a>
                    <a href="/more/m-zvonok/" [category=34]id="lm1x"[/category]><ul>• &nbsp;<li>Онлайн-звонок</li></ul></a>
				</div>
			</div>

			<div [aviable=main]style="display:none"[/aviable]>
				<div class="lb-hm"><strong>Получать новости на e-mail:</strong></div>
				<div class="pre-lb2 leftb">
					<form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=moedelo', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
						<input type="text" class="f_input3" name="email" value="ваш e-mail" onblur="if(this.value=='') this.value='ваш e-mail';" onfocus="if(this.value=='ваш e-mail') this.value='';" />
						<input type="hidden" value="moedelo" name="uri"/>
						<input type="hidden" name="loc" value="ru_RU"/>
						&nbsp;<input type="submit" class="bbcodes" value="ОК" />
					</form>
				</div>
			</div>

			<div class="t-h"></div>

		</div><div class="m-c2[not-aviable=main|form|form2][not-category=3,16,17,18,19,20,21,5,22,35,12,23,24,25,13,26,27,28,29,30,31,32,33,34,36,37,38,39]x[/not-category][/not-aviable]" align="left">
			[category=14]<div class="atext"><div class="at-menu" style="margin-top:13px;" align="center"><a href="/?do=form&id=10" style="width:924px">Добавить отзыв</a></div></div>[/category]
			{info} {content}
		</div>
	</div>
</div>
<div class="u5-bg" align="center">
	<div class="t-950" align="left">
		<div class="u5-c1">
			<div class="l-h">Моё дело - Иркутск</div>
			<div class="l-t">
				<span>- <a href="/">Главная</a></span>
				<span>- <a href="/about/">О компании</a></span>
				<span>- <a href="/partner/">Наши партнеры</a></span>
				<span>- <a href="/resps/">Отзывы клиентов</a></span>
				<span>- <a href="/contact/">Контакты</a></span>
			</div>
		</div><div class="u5-c1">
			<div class="l-h">&nbsp;</div>
			<div class="l-t">
				<span>- <a href="/news/">Архив новостей</a></span>
				<span>- <a href="/for-bman/">Предпринимателям</a></span>
				<span>- <a href="/for-buxg/">Бухгалтерам</a></span>
				<span>- <a href="/pay.html">Тарифы и оплата</a></span>
			</div>
		</div><div class="u5-c1">
			<div class="l-h">Услуги:</div>
			<div class="l-t">
				<span>- <a href="/super-paket/"><strong>Супер-пакет</strong></a></span>
				<span>- <a href="/registr-ip/">Регистрация ИП</a></span>
				<span>- <a href="/registr-ooo/">Регистрация ООО</a></span>
				<span>- <a href="/new-stamp/">Изготовление печати</a></span>
			</div>
		</div><div class="u5-c2">
			<div class="l-h">&nbsp;</div>
			<div class="l-t">
				<span>- <a href="/open-rs/">Открытие расчетного счета</a></span>
				<span>- <a href="/inet-buxg/">Интернет-бухгалтерия</a></span>
				<span>- <a href="/more/">Прочие услуги</a></span>
			</div>
		</div><div class="u5-c3" align="right">
			<div class="l-h">Мы в соц. сетях:</div>
			<div class="l-t">
				<span><a href="https://www.facebook.com/moedelo" target="_blank">Фейсбук</a></span>
                <span><a href="http://vk.com/moe_delo_irkutsk" target="_blank">ВКонтакте</a></span>
				<span><a href="https://plus.google.com/+MoedeloOrgRu/" target="_blank">Мы в Google+</a></span>
                <span><a href="https://twitter.com/moedelo_irkutsk" target="_blank">Твиттер</a></span>
			</div>
		</div>
	</div>
</div>
<div class="u6-bg" align="center">
	<div class="t-950">
		<div class="u6-c1" align="left">
			<div class="cpr">&copy; 2011-2013 <strong>Моё дело - Иркутск</strong> | <a href="http://moedelo.org.ru/">www.moedelo.org.ru</a></div>
		</div><div class="u6-c2">
				<div class="search-bg">
					<form action="" name="searchform" method="post">
						<input type="hidden" name="do" value="search" />
						<input type="hidden" name="subaction" value="search" />
						<div class="search-1"><input id="story" name="story" type="text" class="search_input" value="поиск.." onblur="if(this.value=='') this.value='поиск..';" onfocus="if(this.value=='поиск..') this.value='';" /></div><div class="search-2"><input title="Найти" type="image" src="{THEME}/images/spacer.gif" class="search_but" alt="&raquo;" /></div>
					</form>
				</div>
		</div><div class="u6-c2" align="right">
			<div class="cpr-phone"><span>Тел.: <font color="#77797D">+7 (3952)</font> </span>723-053</div>
		</div>
	</div>
</div>
<div style="position:absolute;top:-100px;left:-100px">
<!-- здесь код счетчиков-->
<!-- begin of Top100 code -->
<script id="top100Counter" type="text/javascript" src="http://counter.rambler.ru/top100.jcn?2498399"></script>
<noscript>
<a href="http://top100.rambler.ru/navi/2498399/">
<img src="http://counter.rambler.ru/top100.cnt?2498399" alt="Rambler's Top100" border="0" />
</a>
</noscript>
<!-- end of Top100 code -->    
</div>

<!--<script type="text/javascript">document.write('<script type="text/javascript" charset="utf-8" async="true" id="onicon_loader" src="http://cp.onicon.ru/js/simple_loader.js?site_id=54a3719172d22c98778b45cb&srv=2&' + (new Date).getTime() + '"></scr' + 'ipt>');</script>-->
    <button id="obratnayaSvaz" >Задайте нам свой вопрос!</button>
    
   <script src="/js/core.min.js"></script>

<script src="/js/vendor/jashkenas/underscore.min.js"></script>
<script src="/js/vendor/jashkenas/backbone.min.js"></script> 
    
</body>
</html>