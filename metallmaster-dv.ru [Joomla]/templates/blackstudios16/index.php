<?php
/**
 * @project   BlackStudios Joomla! 1.6 Template
 * @version   1.0 March 22, 2011
 * @author    7Studio http://www.7studio.eu/
 * @copyright Copyright (C) 2007 - 2011 7Studio http://www.7studio.eu/
  Based on Gantry Framework
 * @package   Gantry Template - RocketTheme
 * @version   3.2 February 17, 2011
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2011 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Gantry uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
 *
 */
// no direct access
defined('_JEXEC') or die('Restricted index access');

// load and inititialize gantry class
require_once('lib/gantry/gantry.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $gantry->language; ?>" lang="<?php echo $gantry->language; ?>">
    <head>
        <?php
        $gantry->displayHead();
        $gantry->addStyles(array('template.css', 'joomla.css', 'style.css', 'NSP-GK4.css', 'k2.css'));
        ?>
        <script src="http://www.google.com/jsapi"></script> 
        <script type="text/javascript">  
  
            // Загружаем jQuery  
            //google.load("jquery", "1.7");
        </script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="/fancybox/fancybox/jquery.fancybox-1.3.4.pack.js" type="text/javascript"></script>
        <script src="/fancybox/fancybox/jquery.easing-1.3.pack.js" type="text/javascript"></script>
        <script src="/fancybox/fancybox/jquery.mousewheel-3.0.4.pack.js" type="text/javascript"></script>
        <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/main.js" type="text/javascript"></script>
        <link media="screen" type="text/css" href="/fancybox/fancybox/jquery.fancybox-1.3.4.css" rel="stylesheet" />
        <link rel="SHORTCUT ICON" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/favicon.ico" type="image/x-icon">
    </head>
    <body <?php echo $gantry->displayBodyTag(); ?>>
        <!-- Rating@Mail.ru counter -->
        <script type="text/javascript">//<![CDATA[
            (function(w,n,d,r,s){(new Image).src='http://d6.c7.b3.a2.top.mail.ru/counter?id=2324109;js=13'+
                    ((r=d.referrer)?';r='+escape(r):'')+((s=w.screen)?';s='+s.width+'*'+s.height:'')+';_='+Math.random();})(window,navigator,document);//]]>
        </script><noscript><div style="position:absolute;left:-10000px;"><img src="http://d6.c7.b3.a2.top.mail.ru/counter?id=2324109;js=na"
                                                                              style="border:0;" height="1" width="1" alt="Рейтинг@Mail.ru" /></div></noscript>
        <!-- //Rating@Mail.ru counter -->

        <div id="bg-bright">
            <?php /** Begin Drawer * */ if ($gantry->countModules('drawer')) : ?>
                <div id="rt-drawer">
                    <div class="rt-container">
                        <?php echo $gantry->displayModules('drawer', 'standard', 'standard'); ?>
                        <div class="clear"></div>
                    </div>
                </div>
            <?php /** End Drawer * */ endif; ?>
            <div id="bg-header">
                <?php /** Begin Top * */ if ($gantry->countModules('top')) : ?>
                    <div id="rt-top" <?php echo $gantry->displayClassesByTag('rt-top'); ?>>
                        <div class="rt-container">
                            <?php echo $gantry->displayModules('top', 'standard', 'standard'); ?>
                            <div class="clear"></div>
                        </div>
                    </div>
                <?php /** End Top * */ endif; ?>
                <?php /** Begin Header * */ if ($gantry->countModules('header')) : ?>
                    <div id="rt-header">
                        <div class="rt-container">
                            <?php echo $gantry->displayModules('header', 'standard', 'standard'); ?>
                            <div class="clear"></div>
                        </div>
                    </div>
                <?php /** End Header * */ endif; ?>
            </div>
            <?php /** Begin Navi * */ if ($gantry->countModules('navigation')) : ?>
                <div id="rt-navigation">
                    <div class="rt-container">
                        <?php echo $gantry->displayModules('navigation', 'basic', 'basic'); ?>
                        <div class="clear"></div>
                    </div>
                </div>
            <?php /** End Navi * */ endif; ?>
            <?php /** Begin Slider * */ if ($gantry->countModules('slider')) : ?>
                <div id="rt-slider">
                    <div class="rt-container">
                        <?php echo $gantry->displayModules('slider', 'basic', 'basic'); ?>
                        <div class="clear"></div>
                    </div>
                </div>
            <?php /** End Slider * */ endif; ?>
            <?php /** Begin Banner * */ if ($gantry->countModules('banner')) : ?>
                <div id="rt-banner">
                    <div class="rt-container">
                        <?php echo $gantry->displayModules('banner', 'basic', 'basic'); ?>
                        <div class="clear"></div>
                    </div>
                </div>
            <?php /** End Banner * */ endif; ?>
            <?php /** Begin Google Map * */ if ($gantry->countModules('google-map')) : ?>
                <div id="google-map">
                    <?php echo $gantry->displayModules('google-map', 'basic', 'basic'); ?>
                    <div class="clear"></div>
                    <div class="map-shadow"><img alt="map-shadow" src="templates/blackstudios16/images/map-shadow.png" style="position:absolute; top:0px!important; left:0px"/></div>	
                </div>
            <?php /** End Google Map * */ endif; ?>                           
            <?php /** Begin Showcase * */ if ($gantry->countModules('showcase')) : ?>
                <div id="rt-showcase">
                    <div class="rt-container">
                        <?php echo $gantry->displayModules('showcase', 'standard', 'standard'); ?>
                        <div class="clear"></div>
                    </div>
                </div>
            <?php /** End Showcase * */ endif; ?>
            <?php /** Begin Feature * */ if ($gantry->countModules('feature')) : ?>
                <div id="rt-feature">
                    <div class="rt-container">                            
                        <?php echo $gantry->displayModules('feature', 'standard', 'standard'); ?>
                        <div class="clear"></div>
                    </div>
                </div>
            <?php /** End Feature * */ endif; ?>
            <?php /** Begin Utility * */ if ($gantry->countModules('utility')) : ?>
                <div id="rt-utility">
                    <div class="rt-container">
                        <?php echo $gantry->displayModules('utility', 'standard', 'basic'); ?>
                        <div class="clear"></div>
                    </div>
                </div>
            <?php /** End Utility * */ endif; ?>
            <?php /** Begin Breadcrumbs * */ if ($gantry->countModules('breadcrumb')) : ?>
                <div id="rt-breadcrumbs">
                    <div class="rt-container">
                        <?php echo $gantry->displayModules('breadcrumb', 'standard', 'standard'); ?>
                        <div class="clear"></div>
                    </div>
                </div>
            <?php /** End Breadcrumbs * */ endif; ?>
            <?php /** Begin Main Top * */ if ($gantry->countModules('maintop')) : ?>
                <div id="rt-maintop">
                    <div class="rt-container">                            
                        <?php echo $gantry->displayModules('maintop', 'standard', 'standard'); ?>
                        <div class="clear"></div>
                    </div>
                </div>
            <?php /** End Main Top * */ endif; ?>
            <?php /** Begin Main Body * */ ?>
			
            <?php echo $gantry->displayMainbody('mainbody', 'sidebar', 'standard', 'standard', 'standard', 'standard', 'standard'); ?>
            
			<?php /** End Main Body * */ ?>              
            <?php /** Begin Main Bottom * */ if ($gantry->countModules('mainbottom')) : ?>
                <div id="rt-mainbottom">
                    <div class="rt-container">
                        <?php echo $gantry->displayModules('mainbottom', 'standard', 'standard'); ?>
                        <div class="clear"></div>
                    </div>
                </div>
            <?php /** End Main Bottom * */ endif; ?>
            <?php /** Begin Bottom * */ if ($gantry->countModules('bottom')) : ?>
                <div id="rt-bottom">
                    <div class="rt-container">
                        <?php echo $gantry->displayModules('bottom', 'standard', 'standard'); ?>
                        <div class="clear"></div>
                    </div>
                </div>
            <?php /** End Bottom * */ endif; ?>
            <?php /** Begin Footer * */ if ($gantry->countModules('footer')) : ?>
                <div id="rt-footer">
                    <div class="rt-container">
                        <?php echo $gantry->displayModules('footer', 'standard', 'standard'); ?>
                        <div class="clear"></div>
                    </div>
                </div>
            <?php /** End Footer * */ endif; ?>
            <?php /** Begin Copyright * */ if ($gantry->countModules('copyright')) : ?>
                <div id="rt-copyright">
                    <div class="rt-container">
                        <?php echo $gantry->displayModules('copyright', 'standard', 'standard'); ?>
                        <div class="clear"></div>
                    </div>
                </div>
            <?php /** End Copyright * */ endif; ?>
            <?php /** Begin Debug * */ if ($gantry->countModules('debug')) : ?>
                <div id="rt-debug">
                    <div class="rt-container">
                        <?php echo $gantry->displayModules('debug', 'standard', 'standard'); ?>
                        <div class="clear"></div>
                    </div>
                </div>
            <?php /** End Debug * */ endif; ?>
            <?php /** Begin Analytics * */ if ($gantry->countModules('analytics')) : ?>
                <?php echo $gantry->displayModules('analytics', 'basic', 'basic'); ?>
            <?php /** End Analytics * */ endif; ?>
            <?php
            /** Begin Popup * */
            echo $gantry->displayModules('popup', 'popup', 'standard');
            /** End Popup * */
            ?>
        </div>
</body>
</html>
<?php
$gantry->finalize();
?>