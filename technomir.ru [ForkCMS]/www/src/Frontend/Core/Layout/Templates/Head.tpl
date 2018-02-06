<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="{$LANGUAGE}" class="ie6"> <![endif]-->
<!--[if IE 7 ]> <html lang="{$LANGUAGE}" class="ie7"> <![endif]-->
<!--[if IE 8 ]> <html lang="{$LANGUAGE}" class="ie8"> <![endif]-->
<!--[if IE 9 ]> <html lang="{$LANGUAGE}" class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="{$LANGUAGE}"> <!--<![endif]-->
<head>
	{* Meta *}
	<meta charset="utf-8" />
	<meta name="generator" content="Fork CMS" />
	{$meta}
	{$metaCustom}
	<title>{$pageTitle}</title>
	{* Favicon and Apple touch icon *}
	<link href="/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
	<link rel="apple-touch-icon" href="/apple-touch-icon.png" />
	{* Windows 8 tile *}
	<meta name="application-name" content="{$siteTitle}"/>
	<meta name="msapplication-TileColor" content="#3380aa"/>
	<meta name="msapplication-TileImage" content="/tile.png"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	{* Stylesheets *}
{iteration:cssFiles}
	<link rel="stylesheet" href="{$cssFiles.file}" />
{/iteration:cssFiles}
	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
{* General Javascript *}
{iteration:jsFiles}
	<script src="{$jsFiles.file}"></script>
{/iteration:jsFiles}
{* Site wide HTML *}
{$siteHTMLHeader}
</head>