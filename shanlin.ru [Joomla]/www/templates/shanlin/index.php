<?php
defined('_JEXEC') or die;
JHtml::_('behavior.framework', true);
$app = JFactory::getApplication();
?>
<?php echo '<?'; ?>xml version="1.0" encoding="<?php echo $this->_charset ?>"?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
<head>
<meta name='yandex-verification' content='7587f8273e37d3a2' />
<meta name="google-site-verification" content="x3ruyaWROyPqgqwYbBp4hjzyl-ggbjuaVK5fQVxoiJo" />
<jdoc:include type="head" />

<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/general.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/template.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/menu.css" type="text/css" />

<?php
if($this->countModules('left and right') == 0) $contentwidth = "100";
if($this->countModules('left or right') == 1) $contentwidth = "80";
if($this->countModules('left and right') == 1) $contentwidth = "60";
?>
<meta name='yandex-verification' content='617f3b2364f7a01d' />
<meta name="mailru-domain" content="0CHNFk4mJYf1DQfd" />
</head>


<body>
<div id="page">
<?php if($this->countModules('header')) : ?>
	<div id="header "><jdoc:include type="modules" name="header" style="xhtml" /> </div>
<?php endif; ?>
<div id="main_banner">
<div class="main_banner"></div>
<div class="main_form">
<table class="tables" border="0" width="100%">
  <tr>
    <td align="center"><div class="phone">8-914-5-914-914</div></td>
  </tr>
  <tr>
    <td>
    	<div class="zvonok">Заказать бесплатный звонок прямо сейчас!</div><div class="form">


    		<jdoc:include type="modules" name="main_banner" style="xhtml" />


    	</div>
  	</td>
  </tr>
</table>
</div>
</div>

	<div id="shanlin_demo"><jdoc:include type="modules" name="shanlin_demo" style="xhtml" /></div>
    <div id="demo"><jdoc:include type="modules" name="demo" style="xhtml" /></div>
    <div id="map"><jdoc:include type="modules" name="map" style="xhtml" /></div>

<?php if($this->countModules('user3')) : ?>
	<div id="user3"><jdoc:include type="modules" name="user3" style="xhtml" /></div>
<?php endif; ?>


 <?php if($this->countModules('left')) : ?>
      <div id="left"><jdoc:include type="modules" name="left" style="xhtml" /></div>
<?php endif; ?>

<div id="content<?php echo $contentwidth; ?>">
	<jdoc:include type="message" />
	<jdoc:include type="component" style="xhtml" />
</div>

    <div id="slideshow"><jdoc:include type="modules" name="slideshow" style="xhtml" /></div>
    <div id="otziv"><jdoc:include type="modules" name="otziv" style="xhtml" /></div>

<?php if($this->countModules('right')) : ?>
	<div id="rigth"><jdoc:include type="modules" name="right" style="xhtml" /></div>
<?php endif; ?>




    <div id="message_title"><jdoc:include type="modules" name="message_title" style="xhtml" /></div>
    <div id="message"><jdoc:include type="modules" name="message" style="xhtml" /></div>
	<div id="footer"><jdoc:include type="modules" name="footer" style="xhtml" /></div>


</div>

<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter24407698 = new Ya.Metrika({id:24407698,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/24407698" style="position:absolute; left:-9999px;" alt="" /></div></noscript>

<script type="text/javascript">


</script>



</body>
</html>