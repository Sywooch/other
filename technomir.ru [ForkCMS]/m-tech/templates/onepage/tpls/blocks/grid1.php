<?php

/**

 * @package   T3 Blank

 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.

 * @license   GNU General Public License version 2 or later; see LICENSE.txt

 */



defined('_JEXEC') or die; ?>




<?php if ($this->checkSpotlight('grid1', 'grid1, grid2, grid3, grid4')) : ?>
<!-- Grid1 Row -->
<a id="grid1-link" name="grid1-link"><div id="span" class="automatiz"><a href="#grid1-link"><span>Автоматизация</span></a></div></a>
<section id="grid1wrap" class="clearfix">
	<div class="zen-container">
	  <?php 
	  	$this->spotlight ('grid1', 'grid1, grid2, grid3, grid4')
	  ?>
		<div class="hide">
		<div class="row-fluid">
		<div class="span6 one">
		<a id="roz" title="Розничная торговля">
        <img alt="Розничная торговля" src="http://techno-mir.net/images/roznica.jpg"><br /><br />
        <span class="button">Розничная торговля</span></a>
		</div>
		<div class="span6 one">
		<a id="opt" title="Оптовая торговля">
        <img alt="Оптовая торговля" src="http://techno-mir.net/images/opt.jpg"><br /><br />
        <span class="button">Оптовая торговля</span></a>
		</div></div>
		<div class="hide2">
		<div class="row-fluid">
		<div class="span4 two" onclick="return location.href = 'automatisation/roznitsa/73-kafe-i-restorany'">
		<span><img src="http://techno-mir.net/images/cafe.jpg" alt="Кафе и рестораны" title="Кафе и рестораны"></span>
		</div>
		<div class="span4 two" onclick="return location.href = 'automatisation/roznitsa/74-magaziny'">
		<span><img src="http://techno-mir.net/images/shop.jpg" alt="Магазины" title="Магазины"></span>
		</div>
		<div class="span4 two" onclick="return location.href = 'automatisation/roznitsa/75-sfery-uslug'">
		<span><img src="http://techno-mir.net/images/uslugi.jpg" alt="Сферы услуг" title="Сферы услуг" ></span>
		</div>
		</div>
		</div>
		<div class="hide3">
		<div class="row-fluid">
		<div class="span3 two" onclick="return location.href = 'automatisation/opt/76-kompleksnoe-vnedrenie'">
		<span><img src="http://techno-mir.net/images/complex.jpg" alt="Комплексное внедрение" title="Комплексное внедрение"></span>
		</div>
		<div class="span3 two" onclick="return location.href = 'automatisation/opt/77-optovo-roznichnaya-torgovlya'">
		<span><img src="http://techno-mir.net/images/opt-roz.jpg" alt="Оптово-розничная торговля" title="Оптово-розничная торговля"></span>
		</div>
		<div class="span3 two" onclick="return location.href = 'automatisation/opt/78-byudzhetirovanie'">
		<span><img src="http://techno-mir.net/images/budget.jpg" alt="Бюджетирование" title="Бюджетирование" ></span>
		</div>
		<div class="span3 two" onclick="return location.href = 'automatisation/opt/79-logistika'">
		<span><img src="http://techno-mir.net/images/logist.jpg" alt="Логистика" title="Логистика" ></span>
		</div>
		</div>
		</div>
		</div>
  </div>
</section>
<?php endif ?>