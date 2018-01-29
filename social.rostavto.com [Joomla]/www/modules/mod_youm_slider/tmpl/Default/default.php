<?php

/*======================================================================*\

|| #################################################################### ||

|| # Copyright (C) 2006-2010 Youjoomla LLC. All Rights Reserved.        ||

|| # This file may not be redistributed in whole or significant part. # ||

|| # ---------------- THIS IS NOT FREE SOFTWARE ---------------- #      ||

|| # http://www.youjoomla.com | http://www.youjoomla.com/license.html # ||

|| #################################################################### ||

\*======================================================================*/

// no direct access

defined('_JEXEC') or die('Restricted access'); ?>



<div id="YJT_container" style="height:<?php echo $player_height ?>px; width:<?php echo $full_player_width ?>;">

	<!-- navigator -->

	<div id="navigator_outer" style="height:<?php echo $player_height ?>px; width:<?php echo  $playlist_width ?>px;">

		<ul id="navigator">

<?php foreach ($youmslides as $youmslide):?>

			<li class="element" style="height:<?php echo $player_height / $visibleItems  ?>px">

				<div class="inner" style="width:<?php echo $playlist_width ?>px;height:<?php echo $player_height / $visibleItems   ?>px">

                	<div class="inner_over" style="width:<?php echo $playlist_width ?>px;height:<?php echo $player_height / $visibleItems -8  ?>px">

					<?php if ($show_thumb==1){if(isset($youmslide['img_url']) && $youmslide['img_url'] != "") echo $youmslide['img_tumb'];} ?>

					<span class="title"><?php echo  $youmslide['title'] ?></span>

					<p class="desc" style="width:<?php if($show_thumb==1 && isset($youmslide['img_url']) && $youmslide['img_url'] != ""){echo $desc_width;}else{echo $playlist_width - 10;} ?>px;"><?php echo $youmslide['intronav'] ?></p>

                    </div>

				</div>

			</li>

<?php endforeach;?>		

		</ul>

	</div>	

	<!-- end of navigator, start slides -->

	<div id="slides" style="height:<?php echo $player_height ?>px; width:100%;">

<?php foreach ($youmslides as $youmslide):?>

		<div class="slide" style="height:<?php echo $player_height ?>px; width:<?php echo $slide_width  ?>px;">

			<a href="<?php echo $youmslide['link'] ?>" title=""><?php if(isset($youmslide['img_url']) && $youmslide['img_out'] != "") echo $youmslide['img_out'] ?></a>

			<div class="long_desc" style="width:<?php echo $intro_desc_width ?>;height:<?php echo $intro_desc_height ?>;">

				<h1><?php echo  $youmslide['title'] ?></h1>

				<?php echo $youmslide['intro'] ?>

					</div>

		</div>

        <?php endforeach;?>	

	</div>	

</div>