<?php
/**
 * @package   T3 Blank
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die; ?>


<?php if ($this->checkSpotlight('bottom', 'bottom1, bottom2, bottom3, bottom4, bottom5, bottom6')) : ?>
	
	<section id="bottomrow">
	<a id="bottom-link" name="bottom-link"></a>
		<div class="zen-container">
	  		<?php $this->spotlight ('bottom', 'bottom1, bottom2, bottom3, bottom4, bottom5, bottom6')?>
	  	</div>
	</section>
<?php endif;?>