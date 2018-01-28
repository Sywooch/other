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
        title: "������� ��� ���� ������",
        fields: {
            question: {
                label: "��� ������:",
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
                    <li><a href="/prices">������</a></li>
                    <li><a href="/#/contacts" class="js-link">��������</a></li>
                </ul>
            </nav>
            <nav class="right">
                <ul>
                    <li><a href="https://www.moedelo.org/buro-authorization/" class="js-auth-link">����</a></li>
                    <li><a href="/registration">�����������</a></li>
                </ul>
            </nav>
            <a href="/#/" id="logo"><img src="http://buro.moedelo.org/style/img/logo-buro.svg " width="560" height="74"></a>
        </div>
        <h1 id="headerH1" style="opacity: 1;">
            <span>������ ������ � ����� �������</span>
        </h1>
        <figure id="headerFigure" style="opacity: 1;">
            <ul>
                <li><a href="/#/revision" class="js-link">������ ��������� �����������</a></li>
                <li><a href="/#/consulting" class="js-link">���������������� �� �������� �����, ������� � �����</a></li>
                <li><a href="/#/documents" class="js-link">���������� ���������</a></li>
                <li><a href="/#/revision" class="js-link">����������� � ���������</a></li>
            </ul>
        </figure>
        <nav id="fixedMenuRow2" class="">
            <ul>
                <li class="js-header-menu js-revision js-governmentRevision active">
                    <a href="/#/revision" class="js-link">
                        <i class="i-32"></i>
                        <span>��������</span>
                    </a>
                </li>
                <li class="js-header-menu js-documents">
                    <a href="/#/documents" class="js-link">
                        <i class="i-48"></i>
                        <span>��������� ������</span>
                    </a>
                </li>
                <li class="js-header-menu js-consulting">
                    <a href="/#/consulting" class="js-link">
                        <i class="i-9"></i>
                        <span>������������</span>
                    </a>
                </li>
                <li class="js-header-menu js-calculators">
                    <a href="/#/calculators" class="js-link">
                        <i class="i-39"></i>
                        <span>������������</span>
                    </a>
                </li>
                <li class="js-header-menu js-reports">
                    <a href="/#/reports" class="js-link">
                        <i class="i-21"></i>
                        <span>������</span>
                    </a>
                </li>
                <li class="js-header-menu js-webinars">
                    <a href="/#/webinars" class="js-link">
                        <i class="i-40"></i>
                        <span>��������</span>
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
	target="_blank" style="float:right;">����� � ������</a><a href="/"
	[aviable=main]id="um1x"[/aviable]>�������</a><a href="/for-bman/"
	[category=3,17,18,19,20,39]id="um1x"[/category]>����������������</a><a href="/for-buxg/"
	[category=16,21]id="um1x"[/category]>�����������</a><a href="/pay.html"
	[static=pay]id="um1x"[/static]>������ � ������</a><a href="/resps/"
	[category=14]id="um1x"[/category]>������</a><a href="/contact/"
	[category=6]id="um1x"[/category]>��������</a></div></div>
</div>
<!------------>


<!----------->
<div class="u2-bg" align="center" style="background-color:yellow; display:none;">
	<div class="t-950">
		<div class="u2-c1" align="left">
			<a href="/"><img src="{THEME}/images/a4-logo.gif" width="406" height="87" border="0" alt="�� ���� - �������" title="�� ���� - ������� | ��������� ������������ ����� ������������� ������ �������" /></a>
		</div><div class="u2-c2">
			<a href="/online-q/8-voprosy-on-line.html"><img src="{THEME}/images/a5-q[category=7]x[/category].gif" width="70" height="87" border="0" alt="������ ������" title="������ ������" /></a>
		</div><div class="u2-c2">
			<a href="/contact/"><img src="{THEME}/images/a6-z[category=6]x[/category].gif" width="72" height="87" border="0" alt="���������� �� ����" title="���������� �� ����" /></a>
		</div><div class="u2-c3" align="right">
        <img id="callMeBtn" src="{THEME}/images/a7-adtel.gif" width="278" height="87" alt="(3952) 723-053 | �������, ��. ����������, 134, ��. 206" title="+7 (3952) 723-053 | �������, ��. ����������, 134, ��. 206" />
		</div>
	</div>
</div>
<!----------->


[aviable=main]




<div class="u3-bg" align="center">
	<div class="u3-bg2">
		<div class="t-950"><a href="/super-paket/"><img src="{THEME}/images/b0-pic1.jpg" width="916" height="230" border="0" alt="�����-����� ��� ���������������� - � �������! | ������ ���������.." title="�����-����� ��� ���������������� - � �������! | ������ ���������.." /></a></div>
	</div>
</div>
[/aviable]


<!------------->

<div class="u4-bg" align="center"style="background-color:blue; display:none;">
	<div class="u4-bg3">
		<div class="t-950">

			<div class="um2-pre" align="center">
				<input class="prev" type="image" src="{THEME}/images/b3-left.gif" width="49" height="152" alt="&laquo;" title="&laquo; �����">
				<div class="um2-crs">
					<ul>
					<!--<li><a class="um2-c1[category=8]x[/category]" href="/super-paket/"><span>�����-�����</span></a></li>-->
						<li><a class="um2-c2[category=9]x[/category]" href="/registr-ip/"><span>�����������<br />��</span></a></li>
						<li><a class="um2-c3[category=15]x[/category]" href="/registr-ooo/"><span>�����������<br />���</span></a></li>
						<li><a class="um2-c4[category=10]x[/category]" href="/new-stamp/"><span>������������<br />������</span></a></li>
						<li><a class="um2-c5[category=11]x[/category]" href="/open-rs/"><span>��������<br />����������<br />�����</span></a></li>
						<li><a class="um2-c6[category=12,23,24,25]x[/category]" href="/inet-buxg/"><span>��������-<br />�����������</span></a></li>
						<li><a class="um2-c7[category=13,26,27,28,29,30,31,32,33,34]x[/category]" href="/more/"><span>������<br />������</span></a></li>
					</ul>
			  </div><input class="next" type="image" src="{THEME}/images/b3-right.gif" width="49" height="152" alt="&raquo;" title="������ &raquo;">
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
      <p><font face="Verdana" size="1">��� ������ ������ ���������� ����������� ���������� <br>
        <a href="http://www.avast.com/ru-ru/get/IsbKLE35" target="_blank">���������� 
        ��������� <b>Avast</b></a>!</font></p>
      </td>
  </tr>
</table>
    <br>
[banner_ozon]
{banner_ozon}
[/banner_ozon]            
            <div [not-category=3,17,18,19,20,37,39]style="display:none"[/not-category]>
				<div class="lb-hm"><strong>������� � ������:</strong></div>
				<div class="lm1">
					<a href="/for-bman/bm-start/" [category=17]id="lm1x"[/category]><ul>� &nbsp;<li>���������� ����������������</li></ul></a>
					<a href="/for-bman/bm-reg-ip/" [category=18]id="lm1x"[/category]><ul>� &nbsp;<li>����������� ��</li></ul></a>
                    <a href="/for-bman/bm-reg-ooo/" [category=37]id="lm1x"[/category]><ul>� &nbsp;<li>����������� ���</li></ul></a>
					<a href="/for-bman/bm-law/" [category=19]id="lm1x"[/category]><ul>� &nbsp;<li>����������� �������</li></ul></a>
					<a href="/for-bman/bm-envd/" [category=20]id="lm1x"[/category]><ul>� &nbsp;<li>����</li></ul></a>
                    <a href="/for-bman/bm-psn/" [category=39]id="lm1x"[/category]><ul>� &nbsp;<li>���</li></ul></a>
				</div>
			</div>

			<div [not-category=16,21]style="display:none"[/not-category]>
				<div class="lb-hm"><strong>������� � ������ �����������:</strong></div>
				<div class="lm1">
					<a href="/for-buxg/bb-buxg/" [category=21]id="lm1x"[/category]><ul>� &nbsp;<li>������� ����������������</li></ul></a>
				</div>
			</div>

			<div [not-category=5,22,35]style="display:none"[/not-category]>
				<div class="lb-hm"><strong>���� ��������:</strong></div>
				<div class="lm1">
					<a href="/partner/" [category=5]id="lm1x"[/category]><ul>� &nbsp;<li>����������� ��������</li></ul></a>
					<a href="/partner-b/" [category=22]id="lm1x"[/category]><ul>� &nbsp;<li>������-��������</li></ul></a>
                    <a href="/partner-news/" [category=35]id="lm1x"[/category]><ul>� &nbsp;<li>������� ���������</li></ul></a>
				</div>
			</div>

			<div [not-category=12,23,24,25,36]style="display:none"[/not-category]>
				<div class="lb-hm"><strong>��������-�����������:</strong></div>
				<div class="lm1">
					<a href="/inet-buxg/" [category=12]id="lm1x"[/category]><ul>� &nbsp;<li>��� ����� ��������-�����������?</li></ul></a>
					<a href="/inet-buxg/ib-why/" [category=23]id="lm1x"[/category]><ul>� &nbsp;<li>������������ ������� "�� ����"</li></ul></a>
					<a href="/inet-buxg/ib-features/" [category=24]id="lm1x"[/category]><ul>� &nbsp;<li>����������� ������� "�� ����"</li></ul></a>
					<a href="/inet-buxg/ib-use/" [category=25]id="lm1x"[/category]><ul>� &nbsp;<li>����������� � ������� "�� ����"</li></ul></a>
                    <a href="/inet-buxg/ib-outsourcing/" [category=36]id="lm1x"[/category]><ul>� &nbsp;<li>������������� ����������</li></ul></a>
				</div>
			</div>

			<div [not-category=13,26,27,28,29,30,31,32,33,34,38]style="display:none"[/not-category]>
				<div class="lb-hm"><strong>������ ������:</strong></div>
				<div class="lm1">
                    <a href="/more/m-pos-terminal/" [category=29]id="lm1x"[/category]><ul>� &nbsp;<li>POS-��������</li></ul></a>
				    <a href="/more/m-credit/" [category=26]id="lm1x"[/category]><ul>� &nbsp;<li>������������</li></ul></a>
					<a href="/more/m-site/" [category=28]id="lm1x"[/category]><ul>� &nbsp;<li>Web-����</li></ul></a>
                    <a href="/more/m-hosting/" [category=38]id="lm1x"[/category]><ul>� &nbsp;<li>�������</li></ul></a>
                    <a href="/more/m-redhelper/" [category=31]id="lm1x"[/category]><ul>� &nbsp;<li>������-�����������</li></ul></a>
                    <a href="/more/m-ads/" [category=27]id="lm1x"[/category]><ul>� &nbsp;<li>�������</li></ul></a>
                    <a href="/more/m-email/" [category=33]id="lm1x"[/category]><ul>� &nbsp;<li>E-mail ��������</li></ul></a>
                    <a href="/more/m-zvonok/" [category=34]id="lm1x"[/category]><ul>� &nbsp;<li>������-������</li></ul></a>
				</div>
			</div>

			<div [aviable=main]style="display:none"[/aviable]>
				<div class="lb-hm"><strong>�������� ������� �� e-mail:</strong></div>
				<div class="pre-lb2 leftb">
					<form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=moedelo', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
						<input type="text" class="f_input3" name="email" value="��� e-mail" onblur="if(this.value=='') this.value='��� e-mail';" onfocus="if(this.value=='��� e-mail') this.value='';" />
						<input type="hidden" value="moedelo" name="uri"/>
						<input type="hidden" name="loc" value="ru_RU"/>
						&nbsp;<input type="submit" class="bbcodes" value="��" />
					</form>
				</div>
			</div>

			<div class="t-h"></div>

		</div><div class="m-c2[not-aviable=main|form|form2][not-category=3,16,17,18,19,20,21,5,22,35,12,23,24,25,13,26,27,28,29,30,31,32,33,34,36,37,38,39]x[/not-category][/not-aviable]" align="left">
			[category=14]<div class="atext"><div class="at-menu" style="margin-top:13px;" align="center"><a href="/?do=form&id=10" style="width:924px">�������� �����</a></div></div>[/category]
			{info} {content}
		</div>
	</div>
</div>
<div class="u5-bg" align="center">
	<div class="t-950" align="left">
		<div class="u5-c1">
			<div class="l-h">�� ���� - �������</div>
			<div class="l-t">
				<span>- <a href="/">�������</a></span>
				<span>- <a href="/about/">� ��������</a></span>
				<span>- <a href="/partner/">���� ��������</a></span>
				<span>- <a href="/resps/">������ ��������</a></span>
				<span>- <a href="/contact/">��������</a></span>
			</div>
		</div><div class="u5-c1">
			<div class="l-h">&nbsp;</div>
			<div class="l-t">
				<span>- <a href="/news/">����� ��������</a></span>
				<span>- <a href="/for-bman/">����������������</a></span>
				<span>- <a href="/for-buxg/">�����������</a></span>
				<span>- <a href="/pay.html">������ � ������</a></span>
			</div>
		</div><div class="u5-c1">
			<div class="l-h">������:</div>
			<div class="l-t">
				<span>- <a href="/super-paket/"><strong>�����-�����</strong></a></span>
				<span>- <a href="/registr-ip/">����������� ��</a></span>
				<span>- <a href="/registr-ooo/">����������� ���</a></span>
				<span>- <a href="/new-stamp/">������������ ������</a></span>
			</div>
		</div><div class="u5-c2">
			<div class="l-h">&nbsp;</div>
			<div class="l-t">
				<span>- <a href="/open-rs/">�������� ���������� �����</a></span>
				<span>- <a href="/inet-buxg/">��������-�����������</a></span>
				<span>- <a href="/more/">������ ������</a></span>
			</div>
		</div><div class="u5-c3" align="right">
			<div class="l-h">�� � ���. �����:</div>
			<div class="l-t">
				<span><a href="https://www.facebook.com/moedelo" target="_blank">�������</a></span>
                <span><a href="http://vk.com/moe_delo_irkutsk" target="_blank">���������</a></span>
				<span><a href="https://plus.google.com/+MoedeloOrgRu/" target="_blank">�� � Google+</a></span>
                <span><a href="https://twitter.com/moedelo_irkutsk" target="_blank">�������</a></span>
			</div>
		</div>
	</div>
</div>
<div class="u6-bg" align="center">
	<div class="t-950">
		<div class="u6-c1" align="left">
			<div class="cpr">&copy; 2011-2013 <strong>�� ���� - �������</strong> | <a href="http://moedelo.org.ru/">www.moedelo.org.ru</a></div>
		</div><div class="u6-c2">
				<div class="search-bg">
					<form action="" name="searchform" method="post">
						<input type="hidden" name="do" value="search" />
						<input type="hidden" name="subaction" value="search" />
						<div class="search-1"><input id="story" name="story" type="text" class="search_input" value="�����.." onblur="if(this.value=='') this.value='�����..';" onfocus="if(this.value=='�����..') this.value='';" /></div><div class="search-2"><input title="�����" type="image" src="{THEME}/images/spacer.gif" class="search_but" alt="&raquo;" /></div>
					</form>
				</div>
		</div><div class="u6-c2" align="right">
			<div class="cpr-phone"><span>���.: <font color="#77797D">+7 (3952)</font> </span>723-053</div>
		</div>
	</div>
</div>
<div style="position:absolute;top:-100px;left:-100px">
<!-- ����� ��� ���������-->
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
    <button id="obratnayaSvaz" >������� ��� ���� ������!</button>
    
   <script src="/js/core.min.js"></script>

<script src="/js/vendor/jashkenas/underscore.min.js"></script>
<script src="/js/vendor/jashkenas/backbone.min.js"></script> 
    
</body>
</html>