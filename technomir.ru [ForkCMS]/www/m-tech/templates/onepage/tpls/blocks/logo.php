<?php
/**
 * @package   T3 Blank
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$logotext = $this->params->get('logotext');
$logoclass = $this->params->get('logoclass', 'h2');
$tagline = $this->params->get('tagline');
$logotype = $this->params->get('jblogotype', 'text');
$logoalign= $this->params->get('logoalign', 'zenleft');
$logoimage = $logotype == 'image' ? $this->params->get('jblogoimage', '') : '';
$tagline_enable = $this->params->get('tagline_enable');
?>
<?php if($logotype !=="none") {?>
<!-- LOGO -->
<section id="logowrap">
	<div class="zen-container">
		<div class="row-fluid">
			<div class="span12">
			  <div class="logo logo-<?php echo $logotype ?> <?php echo $logoalign ?>">
				    <<?php echo $logoclass ?>>
				      <a href="<?php echo JURI::base(true) ?>" title="Мир технологий - мир ваших идей">
		    		    <span>
		        			<?php if($logotype == "text") { echo $logotext; } else { ?>
		        		<img src="<?php echo $logoimage ?>"/>
		        		<?php } ?>
		        		</span>
		      		</a>
		     	 </<?php echo $logoclass ?>>
		      
		     	<?php if($tagline_enable) {?>
		     		 <div id="tagline"><span><?php echo $tagline ?></span></div>
		     	<?php } ?>
		   
		  	</div>
		  </div>
	 </div>
</div>

<!-- MAIN NAVIGATION -->
<?php if($this->params->get('stickynav')) { ?>
  <nav id="navwrap" class="affix-top" data-spy="affix" data-offset-top="<?php echo $this->params->get('stickynavoffset');?>">
<?php } else { ?>
  <nav id="navwrap">
<?php } ?>
  <div class="zen-container">
  	<div class="row-fluid">
   		<div class="navwrapper navbar <?php echo $menualign ?>">
	
		<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
	        <span class="icon-list-ul"></span>
	      </button>
	
	    <div class="nav-collapse collapse<?php echo $this->getParam('navigation_collapse_showsub', 1) ? ' always-show' : '' ?> <?php echo $menualign; ?>">
			<?php if($this->params->get('onepage')) { ?>
			
			<ul class="nav">
				<li>
					<a href="#home-link"><?php // echo $this->params->get('homelink','home'); ?><img src="/images/minilogo.png"></a>
				</li>
				<?php // if ($this->checkSpotlight('banner', 'banner') && ($this->params->get('bannerlink') !=="")) : ?>
				<li style="display: none">
					<a href="#banner-link"><?php echo $this->params->get('bannerlink','banner'); ?></a>
				</li>
				<?php // endif; ?>
				<?php if ($this->checkSpotlight('tabs', 'tabs') && ($this->params->get('tabslink') !=="")) : ?>
				<li>
					<a href="#tabs-link"><?php echo $this->params->get('tabslink','tabs'); ?></a>
				</li>
				<?php endif; ?>
				<?php if ($this->checkSpotlight('grid1', 'grid1, grid2, grid3, grid4') && ($this->params->get('grid1link') !=="")) : ?>
				<li>
					<a href="#grid1-link"><?php echo $this->params->get('grid1link','grid1'); ?></a>
				</li>
				<?php endif; ?>
				<?php if ($this->checkSpotlight('grid2', 'grid5, grid6, grid7, grid8') && ($this->params->get('grid2link') !=="")) : ?>
				<li>
					<a href="#grid2-link"><?php echo $this->params->get('grid2link','grid2'); ?></a>
				</li>
				<?php endif; ?>
				<?php if ($this->checkSpotlight('grid3', 'grid9, grid10, grid11, grid12') && ($this->params->get('grid3link') !=="")) : ?>
				<li>
					<a href="#grid3-link"><?php echo $this->params->get('grid3link','grid3'); ?></a>
				</li>
				<?php endif; ?>
				<?php// if (!$hide_mainbody) : ?>
				<!--<li>
					<a href="#main-link"><?php //echo $this->params->get('mainlink','main'); ?></a>
				</li>-->
				<?php //endif; ?>
				<?php if ($this->checkSpotlight('grid4', 'grid13, grid14, grid15, grid16') && ($this->params->get('grid4link') !=="")) : ?>
				<li>
					<a href="#grid4-link"><?php echo $this->params->get('grid4link','grid4'); ?></a>
				</li>
				<?php endif; ?>
				<?php if ($this->checkSpotlight('grid5', 'grid17, grid18, grid19, grid20') && ($this->params->get('grid5link') !=="")) : ?>
				<li>
					<a href="#grid5-link"><?php echo $this->params->get('grid5link','grid5'); ?></a>
				</li>
				<?php endif; ?>
				<?php if ($this->checkSpotlight('grid6', 'grid21, grid22, grid23, grid24') && ($this->params->get('grid6link') !=="")) : ?>
				<li>
					<a href="#grid6-link"><?php echo $this->params->get('grid6link','grid6'); ?></a>
				</li>
				<?php endif; ?>
				<?php if ($this->checkSpotlight('bottom', 'bottom1, bottom2, bottom3, bottom4, bottom5, bottom6') && ($this->params->get('bottomlink') !=="")) : ?>
				<li>
					<a href="#bottom-link"><?php echo $this->params->get('bottomlink','bottom'); ?></a>
				</li>
				<?php endif; ?>
			</ul>
			<?php } else { ?>
							
				      <div class="nav-collapse collapse<?php echo $this->getParam('navigation_collapse_showsub', 1) ? ' always-show' : '' ?> <?php echo $menualign; ?>">
				     <?php if ($this->getParam('navigation_type') == 'megamenu') : ?>
				       <?php $this->megamenu($this->getParam('mm_type', 'mainmenu')) ?>
				     <?php else : ?>
				       <jdoc:include type="modules" name="<?php $this->_p('menu') ?>" style="raw" />
				     <?php endif ?>
				     </div>
				      <?php } ?>
	    </div>
	    
	   </div>
    </div>
  </div>
</nav>
<!-- //MAIN NAVIGATION -->
</section>
<!-- //LOGO -->
<?php } ?>