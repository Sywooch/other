<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>{$meta.title|default:$title|default:$page_content.title}</title>
	<meta name="keywords" content="{$meta.keywords}">
	<meta name="description" content="{$meta.description}">
	<meta name="author" content="{$meta.author}">
	<link rel="Shortcut Icon" href="/public/site/img/favicon.ico">
	<!-- CSS -->
{foreach from=$pageCSS item=item}
	<link href='{$item}' rel='stylesheet' type='text/css'>
{/foreach}
	<!-- JS -->
{foreach from=$pageJS item=item}
	<script src='{$item}' type='text/javascript'></script>
{/foreach}
	<!--zf::debug:head-->
</head>
<body class="auth">
<div class="logo">
    <img alt="Logo" src="/public/site/img/logo.jpg" align="top">
</div>
<div class="logo" style="margin-top:40px;">
Телефон: (495)933-5033<br>
E-mail: <a href="mailto:dealers@artisantiles.ru">dealers@artisantiles.ru</a>
</div>
<br clear="all">
<table id="auth_table">
	<tr>
        <td>
            {$page_content.content}
            <span class="error">{$auth_error}</span>
            <table>
                <tr>
                    <td>
                        <div class="rc10 tmp9">
                            {form name='login'}
                                {label name='login'}:<br> {input name='login'}<br><br><br>
                                {label name='pass'}:<br> {input name='pass'}<br><br><br>
                                <input type="submit" value="Войти" class="aikbf">
                            </form>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<!--zf::debug:body-->
</body>
</html>