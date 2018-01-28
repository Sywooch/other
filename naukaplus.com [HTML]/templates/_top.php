<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title><? if ($template == 'catalog_item') { echo $parent_titles.' / '; } ?><?=$title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<?=$description?>
<?=$keywords?>

<link href="/style/style.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" href="/style/liMarquee.css">
<script type="text/javascript" src="/templates/js/jquery-1.9.0.min.js"></script>
<script type="text/javascript">
    var jquery_1_9_0 = jQuery;
</script>
<script type="text/javascript" src="/templates/js/jquery.liMarquee.js"></script>
<script type="text/javascript" src="/templates/js/jquery.js"></script>
<script type="text/javascript" src="/templates/js/catalog_jquery.treeview.js"></script>
<script type="text/javascript" src="/templates/js/catalog_init.js"></script>

<script type="text/javascript">
$(window).load(function(){

	var old_jQuery = jQuery;
	var $ = jQuery = jquery_1_9_0;
	$('.marquee').show();
	$('.marquee').liMarquee({
		scrollamount: '<?=$std->settings['header_marquee_speed']?>'
	});	
	var $ = jQuery = old_jQuery;
})
</script> 

<?php
$marquee_str = $std->settings['header_marquee'];
$len = strlen($marquee_str);
$spaces = $len/2;
for ($i =0; $i<$spaces; $i++)
	$marquee_str = '&nbsp'.$marquee_str;
?>

</head>
<body>
<div id="center"> 
<table border="0" cellpadding="0" cellspacing="0" width="1000">
	<tr>
		<td class="table_1"><table border="0" cellpadding="0" cellspacing="0" width="10"><tr><td></td></tr></table></td>
		<td class="table_2"><table border="0" cellpadding="0" cellspacing="0" width="780"><tr><td></td></tr></table></td>
		<td class="table_3"><table border="0" cellpadding="0" cellspacing="0" width="10"><tr><td></td></tr></table></td>
		<td class="table_4"><table border="0" cellpadding="0" cellspacing="0" width="200"><tr><td></td></tr></table></td>
		<td class="table_5"><table border="0" cellpadding="0" cellspacing="0" width="10"><tr><td></td></tr></table></td>
	</tr>
	<tr valign="top">
		<td class="table_6"><table border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table></td>
		<td id="gray-bg">