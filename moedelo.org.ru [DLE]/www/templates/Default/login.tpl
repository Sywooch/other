<!-- <meta http-equiv="Content-Type" content="text/html; charset=windows-1251" /> -->

[not-group=5]

<div class="logintext">[admin-link]<a href="{admin-link}" target="_blank">админка</a> | [/admin-link]<a href="{profile-link}">мой профиль (<b>{login}</b>)</a> | <b><a href="{logout-link}">выйти</a></b></div>

[/not-group]
[group=5]

<form method="post" action="">
	<div class="trs-up t-top t-ie"><span>
		<div align="left" class="u-shlt u-shl">E-mail:</div></span><span><div align="left"><input type="text" name="login_name" id="login_name" class="l-fields" /></div></span><span>
		<div align="left" class="u-shlt u-shp">Пароль:</div></span><span><div align="left"><input type="password" name="login_password" id="login_password" class="l-fields" /></div></span>
		<span><input onclick="submit();" name="image" type="image" src="{THEME}/images/a9-lb.gif" class="l-but" alt="Войти" title="Войти" /></span>
	</div>
	<input name="login" type="hidden" id="login" value="submit" />			
</form>

[/group]