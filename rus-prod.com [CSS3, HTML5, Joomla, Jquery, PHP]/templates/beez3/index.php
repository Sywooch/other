<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.beez3
 * 
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

JLoader::import('joomla.filesystem.file');

// Check modules
$showRightColumn = ($this->countModules('position-3') or $this->countModules('position-6') or $this->countModules('position-8'));
$showbottom      = ($this->countModules('position-9') or $this->countModules('position-10') or $this->countModules('position-11'));
$showleft        = ($this->countModules('position-4') or $this->countModules('position-7') or $this->countModules('position-5'));

if ($showRightColumn == 0 and $showleft == 0)
{
	$showno = 0;
}

JHtml::_('behavior.framework', true);

// Get params
$color          = $this->params->get('templatecolor');
$logo           = $this->params->get('logo');
$navposition    = $this->params->get('navposition');
$headerImage    = $this->params->get('headerImage');
$doc            = JFactory::getDocument();
$app            = JFactory::getApplication();
$templateparams	= $app->getTemplate(true)->params;
$config         = JFactory::getConfig();
$bootstrap      = explode(',', $templateparams->get('bootstrap'));
$jinput         = JFactory::getApplication()->input;
$option         = $jinput->get('option', '', 'cmd');

if (in_array($option, $bootstrap))
{
	// Load optional rtl Bootstrap css and Bootstrap bugfixes
	JHtml::_('bootstrap.loadCss', true, $this->direction);
}

$doc->addStyleSheet($this->baseurl . '/templates/system/css/system.css');
$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/position.css', $type = 'text/css', $media = 'screen,projection');
$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/layout.css', $type = 'text/css', $media = 'screen,projection');
$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/print.css', $type = 'text/css', $media = 'print');
$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/general.css', $type = 'text/css', $media = 'screen,projection');
$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/' . htmlspecialchars($color) . '.css', $type = 'text/css', $media = 'screen,projection');

if ($this->direction == 'rtl')
{
	$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/template_rtl.css');
	if (file_exists(JPATH_SITE . '/templates/' . $this->template . '/css/' . $color . '_rtl.css'))
	{
		$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/' . htmlspecialchars($color) . '_rtl.css');
	}
}

JHtml::_('bootstrap.framework');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/javascript/md_stylechanger.js', 'text/javascript');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/javascript/hide.js', 'text/javascript');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/javascript/respond.src.js', 'text/javascript');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/javascript/template.js', 'text/javascript');

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
	<head>
		<?php require __DIR__ . '/jsstrings.php';?>

		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=3.0, user-scalable=yes"/>
		<meta name="HandheldFriendly" content="true" />
		<meta name="apple-mobile-web-app-capable" content="YES" />

		<jdoc:include type="head" />

		<!--[if IE 7]>
		<link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/ie7only.css" rel="stylesheet" type="text/css" />
		<![endif]-->
        <link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,300italic,400italic,500italic,700italic&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
	</head>
	<body id="shadow">
    
    
    
		<?php if ($color == 'image'):?>
			<style type="text/css">
				.logoheader {
					background:url('<?php echo $this->baseurl . '/' . htmlspecialchars($headerImage); ?>') no-repeat right;
				}
				body {
					background: <?php echo $templateparams->get('backgroundcolor'); ?>;
				}
			</style>
		<?php endif; ?>

		<div id="all">
			<div id="back">
				<header id="header">
					<div class="logoheader">
						<h1 id="logo">
                        <span class="txt1">АМУР ТОРГ</span>
                        <span class="txt2">ТОРГОВАЯ КОМПАНИЯ</span>
                        <span class="txt3">Импорт и экспорт<br>продовольственной продукции</span>
                        
                        
                        
                        
						<?php if (!$logo AND $templateparams->get('sitetitle')) : ?>
							<?php echo htmlspecialchars($templateparams->get('sitetitle')); ?>
						<?php elseif (!$logo AND $config->get('sitename')) : ?>
							<?php echo htmlspecialchars($config->get('sitename')); ?>
						<?php endif; ?>
						</h1>
                        
                        <jdoc:include type="modules" name="position-menu" />
                        
                        <div class="lng"></div>
					</div><!-- end logoheader -->
					<ul class="skiplinks">
						<li><a href="#main" class="u2"><?php echo JText::_('TPL_BEEZ3_SKIP_TO_CONTENT'); ?></a></li>
						<li><a href="#nav" class="u2"><?php echo JText::_('TPL_BEEZ3_JUMP_TO_NAV'); ?></a></li>
						<?php if ($showRightColumn) : ?>
							<li><a href="#right" class="u2"><?php echo JText::_('TPL_BEEZ3_JUMP_TO_INFO'); ?></a></li>
						<?php endif; ?>
					</ul>
					<h2 class="unseen"><?php echo JText::_('TPL_BEEZ3_NAV_VIEW_SEARCH'); ?></h2>
					<h3 class="unseen"><?php echo JText::_('TPL_BEEZ3_NAVIGATION'); ?></h3>
					<jdoc:include type="modules" name="position-1" />
					<div id="line">
						<div id="fontsize"></div>
						<h3 class="unseen"><?php echo JText::_('TPL_BEEZ3_SEARCH'); ?></h3>
						<jdoc:include type="modules" name="position-0" />
					</div> <!-- end line -->
				</header><!-- end header -->
                
                <div class="prodict_slide">
                	<div class="product_content">
                    
                    </div>
                </div>
                
                <div class="fotogallery">
                
                </div>
                        
                        
				<div id="<?php echo $showRightColumn ? 'contentarea2' : 'contentarea'; ?>">
					<div id="breadcrumbs">
						<jdoc:include type="modules" name="position-2" />
					</div>

					<?php if ($navposition == 'left' and $showleft) : ?>
						<nav class="left1 <?php if ($showRightColumn == null) { echo 'leftbigger';} ?>" id="nav">
							<jdoc:include type="modules" name="position-7" style="beezDivision" headerLevel="3" />
							<jdoc:include type="modules" name="position-4" style="beezHide" headerLevel="3" state="0 " />
							<jdoc:include type="modules" name="position-5" style="beezTabs" headerLevel="2"  id="3" />
						</nav><!-- end navi -->
					<?php endif; ?>

					<div id="<?php echo $showRightColumn ? 'wrapper' : 'wrapper2'; ?>" <?php if (isset($showno)){echo 'class="shownocolumns"';}?>>
                    
                    
                    	
                        
                        
                    
						<div id="main">
                        
                        	<span class="head1">Импорт и экспорт<br>продовольственной продукции</span>
                            <div class="div_slider"></div>
							<div class="div_button">
                            	<input type="button" value="Заказать сейчас" class="button"/>
                                <span>Заполните форму вашими данными и отправьте нам. В течении рабочего дня наш<br>менеджер свяжется с вами для уточнения всех деталей</span>
                            </div>
                            
                            <div class="div_info">
                            	<div class="line"></div>
                                <span class="txt1">Торговая компания<br>"Амур Торг"</span>
                                
                                <ul>
                                <li>Стабильность работы;</li>
                                <li>Оперативность обработки заказа;</li>
                                <li>Индивидуальный подход;</li>
                                <li>Высокие гарантии сохранности грузов;</li>
                                </ul>
                                
                                <span class="txt2">Мы являемся официальными поставщиками</span>
                                <span class="txt3">Выбирая нас как надёжного партнёра на долгие годы, вы получаете<br>невероятные ощущения от преимущества</span>
                                
                                <div class="info2">
                                	<div class="img1"></div>
                                	<span class="info_head1">Организации доставки</span>
                                    <span class="info_head2">Простота оформления заказа</span>
                                    <span class="info_txt1">Интуитивно понятный пользовательский интерфейс и возможности управления DIGITS обеспечивают простоту подготовки и скармливания тренировочных наборов данных.</span>
                                    <span class="info_txt2">Интуитивно понятный пользовательский интерфейс и возможности управления DIGITS обеспечивают простоту подготовки и скармливания тренировочных наборов данных.</span>
                                </div>
                                
                            </div>
                            
                            
                            <span class="head_parters">Наши партнёры</span>
                            <div class="head_line2"><div></div></div>
                            <span class="head_brands">Бренды и компании экспортируемой продукции</span>
                            
                            <div class="div_brands">
                            	
                                <div class="brand brand1"></div>
								<div class="brand brand2"></div>
                                <div class="brand brand3"></div>
                                <div class="brand brand4"></div>	
								                                
                                
                                
                            </div>
                            
                            
                            <span class="head_responses">Отзывы о нашей компании</span>
                            <div class="head_line2"><div></div></div>
                            <span class="head_brands">Мы дорожим нашей репутацией и стремимся постоянно улучшать работу</span>
                            <div class="div_responses">
                            
                            </div>
                            
                            
                            <span class="head_responses">Наши контакты</span>
                            <div class="head_line2"><div></div></div>
                            <span class="head_brands">Обращайтесь в нашу службу обратной связи, мы всегда поможем!</span>
                            
							<?php if ($this->countModules('position-12')) : ?>
								<div id="top">
									<jdoc:include type="modules" name="position-12" />
								</div>
							<?php endif; ?>

							<jdoc:include type="message" />
							<jdoc:include type="component" />

						</div><!-- end main -->
					</div><!-- end wrapper -->

					<?php if ($showRightColumn) : ?>
						<div id="close">
							<a href="#" onclick="auf('right')">
							<span id="bild">
								<?php echo JText::_('TPL_BEEZ3_TEXTRIGHTCLOSE'); ?>
							</span>
							</a>
						</div>

						<aside id="right">
							<h2 class="unseen"><?php echo JText::_('TPL_BEEZ3_ADDITIONAL_INFORMATION'); ?></h2>
							<jdoc:include type="modules" name="position-6" style="beezDivision" headerLevel="3" />
							<jdoc:include type="modules" name="position-8" style="beezDivision" headerLevel="3" />
							<jdoc:include type="modules" name="position-3" style="beezDivision" headerLevel="3" />
						</aside><!-- end right -->
					<?php endif; ?>

					<?php if ($navposition == 'center' and $showleft) : ?>
						<nav class="left <?php if ($showRightColumn == null) { echo 'leftbigger'; } ?>" id="nav" >

							<jdoc:include type="modules" name="position-7"  style="beezDivision" headerLevel="3" />
							<jdoc:include type="modules" name="position-4" style="beezHide" headerLevel="3" state="0 " />
							<jdoc:include type="modules" name="position-5" style="beezTabs" headerLevel="2"  id="3" />

						</nav><!-- end navi -->
					<?php endif; ?>

					<div class="wrap"></div>
				</div> <!-- end contentarea -->
			</div><!-- back -->
		</div><!-- all -->

		<div id="footer-outer">
			<div id="footer-inner">
			
			<img src="/templates/beez3/images/pic1.png" class="pic pic1"/>
            <img src="/templates/beez3/images/pic2.png" class="pic pic2"/>
            <img src="/templates/beez3/images/pic3.png" class="pic pic3"/>
            <img src="/templates/beez3/images/pic4.png" class="pic pic4"/>
            <img src="/templates/beez3/images/pic5.png" class="pic pic5"/>
            <img src="/templates/beez3/images/pic6.png" class="pic pic6"/>
            <img src="/templates/beez3/images/pic7.png" class="pic pic7"/>
			<span class="hd hd1">Юридический адрес</span>
            <span class="hd hd2">Контактные телефоны</span>
            <span class="hd hd3">Электронная почта</span>
            <span class="hd hd4">Skype</span>
            <span class="hd hd5">QQ</span>
            <span class="hd hd6">WeChact</span>
            <span class="hd hd7">Weibo</span>
            <span class="txt txt1">675000 Россия,<br>Благовещенск ул. Ленина, 1</span>
            <span class="txt txt2">+7 (914) 424-21-24<br>(4162) 98-42-35</span>
            <span class="txt txt3">site@mail.ru<br>zakaz@website.ru</span>
            <span class="txt txt4">amurtorg-2015<br>rusproduct12</span>
            <span class="txt txt5">124124124<br>757414164</span>
            <span class="txt txt6">amurtorg-2015<br>rusproduct12</span>
            <span class="txt txt7">amurtorg-2015<br>rusproduct12</span>
            
			<!--
			<?php if ($showbottom) : ?>
				

					<div id="bottom">
						<div class="box box1"> <jdoc:include type="modules" name="position-9" style="beezDivision" headerlevel="3" /></div>
						<div class="box box2"> <jdoc:include type="modules" name="position-10" style="beezDivision" headerlevel="3" /></div>
						<div class="box box3"> <jdoc:include type="modules" name="position-11" style="beezDivision" headerlevel="3" /></div>
					</div>

				</div>
			<?php endif; ?>

			<div id="footer-sub">
				<footer id="footer">
					<jdoc:include type="modules" name="position-14" />
				</footer><!-- end footer -->
            <!--    
			-->
            </div>
            
            
		</div>
        
        
        <div class="footer2">
        	<div class="footer2_content">
            	<span class="copy">2015 &copy; amur-torg.ru | Амур Торг - Импорт и экспорт продовольственной продукции</span>
                <jdoc:include type="modules" name="position-menu-footer" />
                <div class="lng"></div>
            </div>
        </div>
        
        
        
        
        
		<jdoc:include type="modules" name="debug" />
        
        
        
        
        
	</body>
</html>
