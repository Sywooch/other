<!-- <meta content="text/html; charset=windows-1251" http-equiv="content-type" /> -->
<script language="javascript">
function ShowTab(i) {
	var sh = [ "sh", "sh-ooo" ]
	for(var u=0; u<sh.length; u++) {
	document.getElementById(sh[u]).style.display='none';
	}
	document.getElementById(i).style.display='block';
}
</script>

	<div class="atb">
		<div class="atitle"><h1>{title}</h1></div>
		<div class="pre-at atext">

			<div id="sh">
				<div class="at-menu"><a href="javascript:ShowTab('sh')" id="at-x">Для ИП</a><a href="javascript:ShowTab('sh-ooo')">Для ООО</a></div>
				{short-story}
			</div>

			<div id="sh-ooo" style="display:none;">
				<div class="at-menu"><a href="javascript:ShowTab('sh')">Для ИП</a><a href="javascript:ShowTab('sh-ooo')" id="at-x">Для ООО</a></div>
				[xfvalue_f-ooo]
			</div>

			<div class="t-clr at-but2" style="height:19px"><div class="at-share"><script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script><div class='yashare-auto-init' data-yashareL10n='ru' data-yashareType='none' data-yashareQuickServices='vkontakte,facebook,twitter,gplus' data-yashareImage='http://moedelo.org.ru/templates/Default/images/a4-logo.gif' data-yashareTitle='{title}' data-yashareDescription='{short-story limit="500"}'></div></div>[full-link]<img src="{THEME}/images/more.gif" title="Подробнее" alt="ПОДРОБНЕЕ">[/full-link][edit]<img src="{THEME}/images/edit.gif" title="Изменить" alt="ИЗМЕНИТЬ" >[/edit]</div>
		</div>
	</div>