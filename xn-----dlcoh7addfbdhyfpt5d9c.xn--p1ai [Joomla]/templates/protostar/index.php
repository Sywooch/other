<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$app             = JFactory::getApplication();
$doc             = JFactory::getDocument();
$user            = JFactory::getUser();
$this->language  = $doc->language;
$this->direction = $doc->direction;

// Getting params from template
$params = $app->getTemplate(true)->params;

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->get('sitename');

if($task == "edit" || $layout == "form" )
{
	$fullWidth = 1;
}
else
{
	$fullWidth = 0;
}

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');
$doc->addScript('templates/' . $this->template . '/js/template.js');

// Add Stylesheets
$doc->addStyleSheet('templates/' . $this->template . '/css/template.css');

// Load optional RTL Bootstrap CSS
JHtml::_('bootstrap.loadCss', false, $this->direction);

// Adjusting content width
if ($this->countModules('position-7') && $this->countModules('position-8'))
{
	$span = "span6";
}
elseif ($this->countModules('position-7') && !$this->countModules('position-8'))
{
	$span = "span9";
}
elseif (!$this->countModules('position-7') && $this->countModules('position-8'))
{
	$span = "span9";
}
else
{
	$span = "span12";
}

// Logo file or site title param
if ($this->params->get('logoFile'))
{
	$logo = '<img src="' . JUri::root() . $this->params->get('logoFile') . '" alt="' . $sitename . '" />';
}
elseif ($this->params->get('sitetitle'))
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . htmlspecialchars($this->params->get('sitetitle')) . '</span>';
}
else
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . $sitename . '</span>';
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">
	<jdoc:include type="head" />
	<?php // Use of Google Font ?>
	<?php if ($this->params->get('googleFont')) : ?>
		<link href='//fonts.googleapis.com/css?family=<?php echo $this->params->get('googleFontName'); ?>' rel='stylesheet' type='text/css' />
		<style type="text/css">
			h1,h2,h3,h4,h5,h6,.site-title{
				font-family: '<?php echo str_replace('+', ' ', $this->params->get('googleFontName')); ?>', sans-serif;
			}
			
			.page-header{
			display:none;
			}
		</style>
	<?php endif; ?>
	<?php // Template color ?>
	<?php if ($this->params->get('templateColor')) : ?>
	<style type="text/css">
		body.site
		{
			border-top: 3px solid <?php echo $this->params->get('templateColor'); ?>;
			background-color: <?php echo $this->params->get('templateBackgroundColor'); ?>
		}
		a
		{
			color: <?php echo $this->params->get('templateColor'); ?>;
		}
		.navbar-inner, .nav-list > .active > a, .nav-list > .active > a:hover, .dropdown-menu li > a:hover, .dropdown-menu .active > a, .dropdown-menu .active > a:hover, .nav-pills > .active > a, .nav-pills > .active > a:hover,
		.btn-primary
		{
			background: <?php echo $this->params->get('templateColor'); ?>;
		}
		.navbar-inner
		{
			-moz-box-shadow: 0 1px 3px rgba(0, 0, 0, .25), inset 0 -1px 0 rgba(0, 0, 0, .1), inset 0 30px 10px rgba(0, 0, 0, .2);
			-webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, .25), inset 0 -1px 0 rgba(0, 0, 0, .1), inset 0 30px 10px rgba(0, 0, 0, .2);
			box-shadow: 0 1px 3px rgba(0, 0, 0, .25), inset 0 -1px 0 rgba(0, 0, 0, .1), inset 0 30px 10px rgba(0, 0, 0, .2);
		}
	</style>
	<?php endif; ?>
	<!--[if lt IE 9]>
		<script src="<?php echo $this->baseurl; ?>/media/jui/js/html5.js"></script>
	<![endif]-->
    
    <!--[if lt IE 9]><script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <link rel="stylesheet" href="/templates/protostar/css/style.css" media="screen">
    <!--[if lte IE 7]><link rel="stylesheet" href="style.ie7.css" media="screen" /><![endif]-->
    <link rel="stylesheet" href="/templates/protostar/css/style.responsive.css" media="all">
    
    <script src="/templates/protostar/js/jquery.js"></script>
    <script src="/templates/protostar/js/script.js"></script>
    <script src="/templates/protostar/js/script.responsive.js"></script>
    
    
    
<style>.art-content .art-postcontent-0 .layout-item-0 { border-top-style:solid;border-right-style:solid;border-bottom-style:solid;border-left-style:solid;border-width:0px;border-top-color:#CFD8E2;border-right-color:#CFD8E2;border-bottom-color:#CFD8E2;border-left-color:#CFD8E2;  border-collapse: separate; border-radius: 10px;  }

.art-content .art-postcontent-0 .layout-item-1 { border-top-style:solid;border-right-style:solid;border-bottom-style:solid;border-left-style:solid;border-width:0px;border-color:#FFFFFF; color: #000000; background: ; padding-top: 14px;padding-right: 10px;padding-bottom: 10px;padding-left: 10px; border-radius: 10px;  }
.art-content .art-postcontent-0 .layout-item-2 { padding-right: 10px;padding-left: 10px;  }
.art-content .art-postcontent-0 .layout-item-3 { border-top-style:solid;border-right-style:solid;border-bottom-style:solid;border-left-style:solid;border-width:0px;border-top-color:#CFD8E2;border-right-color:#CFD8E2;border-bottom-color:#CFD8E2;border-left-color:#CFD8E2;  border-collapse: separate;  }
.art-content .art-postcontent-0 .layout-item-4 { color: #000000;
/* padding: 15px; */
padding-left: 37px;
padding-right: 37px;  }
.art-content .art-postcontent-0 .layout-item-5 { margin-top: 10px;margin-bottom: 10px;  }
.art-content .art-postcontent-0 .layout-item-6 { border-top-style:solid;border-right-style:solid;border-bottom-style:solid;border-left-style:solid;border-width:0px;border-top-color:#CFD8E2;border-right-color:#CFD8E2;border-bottom-color:#CFD8E2;border-left-color:#CFD8E2; color: #000000; background: ; border-spacing: 15px 0px; border-collapse: separate; border-radius: 15px;  }
.art-content .art-postcontent-0 .layout-item-7 { color: #000000; background: ; padding-top: 10px;padding-right: 10px;padding-bottom: 10px;padding-left: 10px; border-radius: 15px;  }
.art-content .art-postcontent-0 .layout-item-8 { color: #000000;
/* background: #007CC3; */
padding-top: 10px;
padding-right: 10px;
padding-bottom: 10px;
padding-left: 10px;
border-radius: 15px;
box-shadow: 0 0 10px rgba(0,0,0,0.5);
border: 2px solid #009EFA;
}
.art-content .art-postcontent-0 .layout-item-9 { border-top-style:solid;border-right-style:solid;border-bottom-style:solid;border-left-style:solid;border-width:0px;border-top-color:#CFD8E2;border-right-color:#CFD8E2;border-bottom-color:#CFD8E2;border-left-color:#CFD8E2; color: #000000;  border-spacing: 15px 0px; border-collapse: separate; border-radius: 15px;  }
.art-content .art-postcontent-0 .layout-item-10 { border-right-style:solid;
border-right-width:1px;
border-right-color:#CFD8E2; 
color: #000000; background: #007CC3;background: rgba(0, 124, 195, 0.4); padding-top: 10px;padding-right: 10px;padding-bottom: 10px;padding-left: 10px;   }
.ie7 .art-post .art-layout-cell {border:none !important; padding:0 !important; }
.ie6 .art-post .art-layout-cell {border:none !important; padding:0 !important; }

</style>

    
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>

<body class="site <?php echo $option
	. ' view-' . $view
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task')
	. ($itemid ? ' itemid-' . $itemid : '')
	. ($params->get('fluidContainer') ? ' fluid' : '');
?>">

	<!-- Body -->
    
	<div id="art-main">
		<div class="art-sheet clearfix">
        
        
        
        <!--<div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>">-->
       
			<!-- Header -->
			<!--<header class="header" role="banner">
				<div class="header-inner clearfix">
					<a class="brand pull-left" href="<?php echo $this->baseurl; ?>">
						<?php echo $logo; ?>
						<?php if ($this->params->get('sitedescription')) : ?>
							<?php echo '<div class="site-description">' . htmlspecialchars($this->params->get('sitedescription')) . '</div>'; ?>
						<?php endif; ?>
					</a>
					<div class="header-search pull-right">
						<jdoc:include type="modules" name="position-0" style="none" />
					</div>
				</div>
			</header>-->
			<?php if ($this->countModules('position-1')) : ?>
				<nav class="navigation" role="navigation">
					<jdoc:include type="modules" name="position-1" style="none" />
				</nav>
			<?php endif; ?>
			<jdoc:include type="modules" name="banner" style="xhtml" />
			<div class="row-fluid">
				<?php if ($this->countModules('position-8')) : ?>
					<!-- Begin Sidebar -->
					<!--<div id="sidebar" class="span3">
						<div class="sidebar-nav">
							<jdoc:include type="modules" name="position-8" style="xhtml" />
						</div>
					</div>-->
					<!-- End Sidebar -->
				<?php endif; ?>
				<main id="content" role="main" class="<?php echo $span; ?>">
					<!-- Begin Content -->
					<jdoc:include type="modules" name="position-3" style="xhtml" />
					<jdoc:include type="message" />
					<jdoc:include type="component" />
                    
                    
                   

                    
                    
                    
					<jdoc:include type="modules" name="position-2" style="none" />
                    
                    
                    
                    
                    
					<!-- End Content -->
				</main>
				<?php //if ($this->countModules('position-7')) : ?>
					<!--<div id="aside" class="span3">
						<!-- Begin Right Sidebar -->
						<!--<jdoc:include type="modules" name="position-7" style="well" />
						<!-- End Right Sidebar -->
					<!--</div>-->
				<?php //endif; ?>
			</div>
            
		</div>
        
        
        
        
         <!--comments-->
         <div class="art-sheet clearfix">
      	 <div class="art-layout-wrapper">
       	<div class="art-content-layout">
        <div class="art-content-layout-row">
        <div class="art-layout-cell art-content"><article class="art-post art-article">
                           
                                               
        <div class="art-postcontent art-postcontent-0 clearfix">
        <div style="padding-left:30px;">
        <span style="font-size: 28px;">Комментарии</span>
        <p>&nbsp;</p>
		<div style=" padding-right:30px;">
		
        
    
<!--===== form ======--->





        
        
        
		</div>

		<div>
    	<div>
    	<div style="width: 100%; padding-left:30px;" >

		</div>
        
        
        
        
    <!--===== comments ======--->    
        
        
        
		<table width="100%" border="0">
  		<tr>
    	<td align="center" style="color:#494949; text-align:center;">&lt; <strong> 1</strong> | 2 | 3 | 4 &gt;</td>
  		</tr>
		</table>
        
        
   
   
   
   
   
   
        
        
        
        
    	</div>
    	</div>
		</div>
		</div>


		</article></div>
    	</div>
    	</div>
    	</div>
    	</div>
		<!--comments-->
    
    
    
    
    
    
    
        
    <!--footer-->    
    <footer class="art-footer">
  	<div class="art-footer-inner">
  	<div style="text-align: center;">Поделиться

	<script type="text/javascript">(function(w,doc) {
	if (!w.__utlWdgt ) {
    	w.__utlWdgt = true;
    	var d = doc, s = d.createElement('script'), g = 'getElementsByTagName';
    	s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
    	s.src = ('https:' == w.location.protocol ? 'https' : 'http')  + '://w.uptolike.com/widgets/v1/uptolike.js';
    	var h=d[g]('body')[0];
    	h.appendChild(s);
	}})(window,document);
	</script>
	<div data-share-size="30" data-like-text-enable="false" data-background-alpha="0.0" data-pid="1327051" data-mode="share" data-background-color=		"#ffffff" data-share-shape="rectangle" data-share-counter-size="10" data-icon-color="#ffffff" data-text-color="#000000" data-buttons-color="#ffffff" data-counter-background-color="#ffffff" data-share-counter-type="disable" data-orientation="horizontal" data-following-enable="false" data-sn-ids="fb.vk.ok.gp." data-selection-enable="true" data-exclude-show-more="true" data-share-style="6" data-counter-background-alpha="1.0" 	data-top-button="false" class="uptolike-buttons" ></div>
	</div>
	<p style="text-align: right; line-height: 0.5;"><span style="font-size: 12px;">Амурское региональное отделение</span></p><p style="text-align: 	right;"><span style="font-size: 12px;">Общероссийской общественной организации малого и среднего предпринимательства "ОПОРА РОССИИ"</span></p><p style="text-align: right; line-height: 0.5;"><span style="font-size: 12px;"><a style="line-height: 0.5; color:#6986A5; font-size:12px;" href="http://www.opora-amur.ru">www.opora-amur.ru</a></span></p>
	<p style="font-size:9px; line-height:60px;">Cайт создан компанией <a style="font-size:9px; href="http://alternativ-dv.ru">ExpertWeb </a>© 2014 Все права защищены.</p>
  	</div>
	</footer>    
    <!--footer--> 
        
	</div>
	
    
    <!-- Footer -->
	<!--
    <footer class="footer" role="contentinfo">
		<div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>">
			<hr />
			<jdoc:include type="modules" name="footer" style="none" />
			<p class="pull-right">
				<a href="#top" id="back-top">
					<?php echo JText::_('TPL_PROTOSTAR_BACKTOTOP'); ?>
				</a>
			</p>
			<p>
				&copy; <?php echo date('Y'); ?> <?php echo $sitename; ?>
			</p>
		</div>
	</footer>
	<jdoc:include type="modules" name="debug" style="none" />
    -->
    
    
    <script type="text/javascript" charset="UTF-8" async="" src="http://w.uptolike.com/widgets/v1/uptolike.js"></script>
    <div id="art-resp">
    	<div id="art-resp-m"></div>
        <div id="art-resp-t"></div>
    </div>
    
</body>
</html>
