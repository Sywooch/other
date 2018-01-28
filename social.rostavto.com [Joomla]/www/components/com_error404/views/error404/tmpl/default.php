<?php

// No direct access

defined('_JEXEC') or die('Restricted access');
//ob_start();
header("HTTP/1.1 404 Not Found",false,404);

$texte=$this->texte;
$site_web=$this->site_web;
$afficher_web=$this->afficher_web;
$to=$this->to;
$sujet=$this->sujet;
$use_google_search=$this->use_google_search;
$texte_erreur=$this->texte_erreur;
//echo "test : $texte - $to - $sujet"; //for debugging


?>
<div class="err-all">

<div class="err-text">
<?php echo $texte_erreur; ?>
</div>

<div class="err-url">
<p align="center"><?php if ($afficher_web=="0") {?><a href="<?php echo $site_web; ?>"><?php echo JTEXT::_("COM_ERROR404_ACCUEIL");?></a><?php } ?></p>
</div>
<p>&nbsp;</p>
<?php if ($use_google_search=="0") {?>
<div align="center">
<style type="text/css">
  #goog-wm { }
  #goog-wm h3.closest-match { }
  #goog-wm h3.closest-match a { }
  #goog-wm h3.other-things { }
  #goog-wm ul li { }
  #goog-wm li.search-goog { display: block; }
</style>
<script type="text/javascript">
  var GOOG_FIXURL_LANG = '<?php echo JTEXT::_("COM_ERROR404_LANGUE");?>';
  var GOOG_FIXURL_SITE = '<?php echo $site_web;?>';
</script>
<script type="text/javascript"
  src="http://linkhelp.clients.google.com/tbproxy/lh/wm/fixurl.js">
</script></div>
<?php } ?>
</div>
