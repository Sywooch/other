<?php
/**
 * @package   T3 Blank
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die; ?>


<?php if ($this->checkSpotlight('grid2', 'grid5, grid6, grid7, grid8')) : ?>
<!-- Grid1 Row -->
<a id="grid2-link" name="grid2-link"><div id="span" class="sweb"><a href="#grid2-link"><span>Веб студия</span></a></div></a>
<section id="grid2wrap" class="clearfix">
	<div class="zen-container">
	  	<?php 
	  		$this->spotlight ('grid2', 'grid5, grid6, grid7, grid8')
	  	?>


<div class="hide4">
		<div class="row-fluid">
		<div class="span4 for"  onclick="return location.href = 'http://techno-mir.net/'">
		<span><img src="http://techno-mir.net/images/corpsite.jpg" alt="Корпоративный сайт" title="Корпоративный сайт"></span>
		</div>
		<div class="span4 for"  onclick="return location.href = 'http://techno-mir.net/'">
		<span><img src="http://techno-mir.net/images/visitsite.jpg" alt="Сайт визитка" title="Сайт визитка"></span>
		</div>
		<div class="span4 for"  onclick="return location.href = 'http://techno-mir.net/'">
		<span><img src="http://techno-mir.net/images/inetshop.jpg" alt="Интернет-магазин" title="Интернет-магазин" ></span>
</div>
</div>
</div>
<div class="hide5">
<div class="row-fluid">
		<div class="span3 five"  onclick="return location.href = 'http://techno-mir.net/'">
		<span><img src="http://techno-mir.net/images/visitsite.jpg" alt="Комплексная разработка дизайна компании" title="Комплексная разработка дизайна компании"></span>
		</div>
		<div class="span3 five"  onclick="return location.href = 'http://techno-mir.net/'">
		<span><img src="http://techno-mir.net/images/visitsite.jpg" alt="Дизайн сайта" title="Дизайн сайта"></span>
		</div>
		<div class="span3 five"  onclick="return location.href = 'http://techno-mir.net/'">
		<span><img src="http://techno-mir.net/images/visitsite.jpg" alt="Дизайн корпоративного стиля" title="Дизайн корпоративного стиля" ></span>
</div>
	<div class="span3 five"  onclick="return location.href = 'http://techno-mir.net/'">
		<span><img src="http://techno-mir.net/images/visitsite.jpg" alt="Дизайн логотипа" title="Дизайн логотипа"></span>
		</div>
</div>		
</div>
		
</div>
</section>
<?php endif;?>