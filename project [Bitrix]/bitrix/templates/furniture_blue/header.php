<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?
IncludeTemplateLangFile(__FILE__);
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>


<!--[if lt IE 9]><script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <link href="/booklet/jquery.booklet.latest.css" type="text/css" rel="stylesheet" media="screen, projection, tv" />



<!--preload images-->
<script type="text/javascript">
im = new Image()
im.src = "/press_button_images/press_home.png"

im2 = new Image()
im2.src = "/press_button_images/press_kniga.png"

im3 = new Image()
im3.src = "/press_button_images/press_1.png"
im4 = new Image()
im4.src = "/press_button_images/press_2.png"
im5 = new Image()
im5.src = "/press_button_images/press_3.png"
im6 = new Image()
im6.src = "/press_button_images/press_4.png"
im7 = new Image()
im7.src = "/press_button_images/press_5.png"

im8 = new Image()
im8.src = "/press_button_images/press_6.png"

im9 = new Image()
im9.src = "/press_button_images/press_7_150.png"
im10 = new Image()
im10.src = "/press_button_images/press_7_160.png"
im11 = new Image()
im11.src = "/press_button_images/press_7_180.png"
im12 = new Image()
im12.src = "/press_button_images/press_7_200.png"
im13 = new Image()
im13.src = "/press_button_images/press_7_220.png"



</script>


<!--preload images-->




<!--jquery-->
<script type="text/javascript" src="/js/jquery.min.js"></script>
<!--jquery-->




	<meta property="og:title" content="" >
	        <meta property="og:type" content="article">
			<meta property="og:description" content="Тонкости, хитрости и секреты Internet" >
	        <meta property="og:image" content="./files/assets/flash/pages/page0001_s.jpg" >
	        <meta property="og:determiner" content="auto" >
	        <meta name="viewport" content="initial-scale=1.0"/><script type="text/javascript"> 
	  		var assetsFolder = '../assets';
	  		var mobileFolder = 'files/mobile';
    		var SEOFolder = 'files/assets/basic-html';
    		var filesFolderName	 = 'files/flash';
	  		var projectGUID = '1c64e31ab939d4902a3d258008b24e5f';
    		var documentBackColor = '8C857B';
			var flashContainerName = 'flashbook';
					
			function outputStatus(e) {
				if(!e.success){ 	
					if(document.getElementById("flash-notification")) {
						document.getElementById("flash-notification").style.display = 'none';
					}
					
					window.location.replace("./files/assets/basic-html/index.html" + window.location.hash + "#noFlash");
					
				}
			}</script>
    <script type="text/javascript" src="files/flash/swfobject.js"> </script>
    <script type="text/javascript" src="files/flash/swfaddress.js"> </script>
    <script type="text/javascript" src="files/flash/fbscript.js"> </script>
    <script type="text/javascript" src="files/flash/checkflash.js"> </script>
    <style type="text/css">
			/*html, body, div, span, applet, object, iframe,
			h1, h2, h3, h4, h5, h6, p, blockquote, pre,
			a, abbr, acronym, address, big, cite, code,
			del, dfn, em, font, img, ins, kbd, q, s, samp,
			small, strike, sub, sup, tt, var,
			dl, dt, dd, ol, ul, li,
			fieldset, form, label, legend,
			table, caption, tbody, tfoot, thead, tr, th, td {
			
				border: 0;
				outline: 0;
			
			}
			:focus {
				outline: 0;
			}*/

			html { width :100%;height:100%;}
			/*body{font-family:Lucida Grande,Helvetica,Lucida Sans,Arial,sans-serif;margin:0;font-size:12px;color:#3f5154;background:#d1e1e8}*/
			.flashbook-content {width : 724px; height: 200px; margin: 20px auto; padding: 10px; text-align: left; background:#f0f0f0;border:1px solid #ccc;border-radius:5px;padding:20px;}
			.placeholder-text{background:url('files/flash/flash.gif') no-repeat #f5e9e9;border:1px solid #d0c1c1;border-radius:5px;min-height:50px;padding:11px 13px 11px 83px}
			.placeholder-text a{color:#a24c4c}
			/*h4{color:#303030;font-size:14px;text-align:left; margin: 0px;}
			p{color:#464646;font-size:11px;font-weight:bold;text-align:left;}
			p a{color:#0768b3;text-decoration:underline}*/
			</style>

<?$APPLICATION->ShowHead();?>
<link href="<?=SITE_TEMPLATE_PATH?>/common.css" type="text/css" rel="stylesheet" />
<link href="<?=SITE_TEMPLATE_PATH?>/colors.css" type="text/css" rel="stylesheet" />

	<!--[if lte IE 6]>
	<style type="text/css">
		
		#banner-overlay { 
			background-image: none;
			filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=SITE_TEMPLATE_PATH?>images/overlay.png', sizingMethod = 'crop'); 
		}
		
		div.product-overlay {
			background-image: none;
			filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?=SITE_TEMPLATE_PATH?>images/product-overlay.png', sizingMethod = 'crop');
		}
		
	</style>
	<![endif]-->

	<title><?$APPLICATION->ShowTitle()?></title>
	<link rel="shortcut icon" type="image/x-icon" href="<?=SITE_TEMPLATE_PATH?>/favicon.ico" />
</head>


<body  style="margin:0; padding:0; border:0; background-color:#f0f0f0;" >

<div id="big_foto" onclick="hide_foto();" name="big_foto" align="center" style=" cursor:pointer; padding: 0px; margin: 0px; border: 0px; width: 100%; height: 100%; position: fixed; 
z-index: 999999999999999999999999999998989898989898989899; display: none;  background-position: 50% 50%; background-repeat:no-repeat;" 
class="big_foto_fon">
<div id="big_foto2"  style=" cursor:pointer; padding: 0px; margin: 0px; border: 0px; width: 100%; height: 100%; position: fixed; 
z-index: 999999999999999999999999999998989898989898989899;  background-position: 50% 50%; background-repeat: no-repeat no-repeat; ">

</div>
 </div>



<div align="center" style="width:100%;  margin:0; padding:0; border:0;">

<div align="center" style="width:1658px; ">
 
<div style="width:1658px;   background-color:transparent;   float:left; position:relative; display:inline;  " class="div_1680_2" >
<div align="left" style="width:1658px; background-color:transparent;   float:left; position:relative; display:inline;  " class="div_1680"> 

<!--left div-->
<div align="center" style="width:329px; height:1000px; background-color:transparent; float:left;">
<div style="width:329px; height:379px; background-color:transparent; border-bottom:0px yellow solid;"></div>
<div align="left" style="width:329px; height:70px; ">
<div style="width:88px; height:70px; float:left; "></div>












</div>

</div>
<!--left div-->

<!--center div -->
<div align="center" style="width:1000px; height:100%; background-color:transparent; float:left;">
<!----=========================================-->


<div style="width:100%; height:300px; background-color:transparent;">
<div id="panel"><?$APPLICATION->ShowPanel();?></div>
</div>

<div align="center" style="width:100%; height:140px; background-color:transparent;">
<div style="width:100%; height:85px;"></div>
<div style="width:100%; height:46px;background-color:transparent;">


<!--to home2-->
<?
$CurrPage = $APPLICATION->GetCurPage(true);
if($CurrPage=="/index.php"){

}else{


echo'<a href="/"><div id="div_66" style="width:229px; height:46px; float:left; " class="div_6" onclick="div_6();" onmousedown="div_6();"></div></a>

<script type="text/javascript">
function div_6(){

$("#div_66").css("background-image", "url(/press_button_images/press_6.png)");

}
</script>

';
};

?>
<!--to home2-->

</div>

</div>


<div id="page-wrapper" style="margin-bottom:0px !important;">




		<div id="content" style="background-color:transparent; margin-top:0px !important; width:1000px !important; ">



		<div align="center" id="workarea" style="width:100% !important;">