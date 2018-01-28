<!-- <meta content="text/html; charset=windows-1251" http-equiv="content-type" /> -->
<script language="javascript">
function ShowPage(i) {
	var sh = [ "st-t", "st-p" ]
	for(var u=0; u<sh.length; u++) {
	document.getElementById(sh[u]).style.display='none';
	}
	document.getElementById(i).style.display='block';
}
</script>

<div id="st-t">
	{custom id="11" template="sh-tariff"}
</div>

<div id="st-p" style="display:none;">
	<div class="atb">
		<div class="atitle"><h1>{description}</h1></div>
		<div class="pre-at atext">

			<div class="at-menu"><a href="javascript:ShowPage('st-t')">Тарифы</a><a href="javascript:ShowPage('st-p')" id="at-x">Способы оплаты</a></div>
			{static}

			<div class="t-clr at-but2" style="height:19px"><div class="at-share"><script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script><div class='yashare-auto-init' data-yashareL10n='ru' data-yashareType='none' data-yashareQuickServices='vkontakte,facebook,twitter,gplus' data-yashareImage='http://moedelo.org.ru/templates/Default/images/a4-logo.gif' data-yashareTitle='{description}' data-yashareDescription='{static}'></div></div></div></div>

		</div>
	</div>
</div>
