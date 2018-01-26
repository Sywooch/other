<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>


    <?php
					if(isset($this->variables['widgetGallery']) && count($this->variables['widgetGallery']) != 0 && $this->variables['widgetGallery'] != '' && $this->variables['widgetGallery'] !== false)
					{
						?>
        
            <h3>
                <?php echo $this->variables['widgetGallery']['title']; ?>
            </h3>

        
		<div id="slideshow">
        <img class="sliderh1" src="/src/Frontend/Core/Layout/images/workings.png" alt="Наши работы" />
            <div class="flex-container" id="flex<?php echo $this->variables['widgetGallery']['id']; ?>" style="max-width:<?php echo $this->variables['widgetGallery']['width']; ?>px">
                <div class="flexslider">
                    <div class="flexsliderwrap<?php echo $this->variables['widgetGallery']['id']; ?>">
                        <ul class="slides">
                        <?php
				if(isset(${'widgetSlideshow'})) $this->iterations['f9241a608d03194ab8e1590499cc3d76_Slideshow.tpl.php_1']['old'] = ${'widgetSlideshow'};
				$this->iterations['f9241a608d03194ab8e1590499cc3d76_Slideshow.tpl.php_1']['iteration'] = $this->variables['widgetSlideshow'];
				$this->iterations['f9241a608d03194ab8e1590499cc3d76_Slideshow.tpl.php_1']['i'] = 1;
				$this->iterations['f9241a608d03194ab8e1590499cc3d76_Slideshow.tpl.php_1']['count'] = count($this->iterations['f9241a608d03194ab8e1590499cc3d76_Slideshow.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['f9241a608d03194ab8e1590499cc3d76_Slideshow.tpl.php_1']['iteration'] as ${'widgetSlideshow'})
				{
					if(!isset(${'widgetSlideshow'}['first']) && $this->iterations['f9241a608d03194ab8e1590499cc3d76_Slideshow.tpl.php_1']['i'] == 1) ${'widgetSlideshow'}['first'] = true;
					if(!isset(${'widgetSlideshow'}['last']) && $this->iterations['f9241a608d03194ab8e1590499cc3d76_Slideshow.tpl.php_1']['i'] == $this->iterations['f9241a608d03194ab8e1590499cc3d76_Slideshow.tpl.php_1']['count']) ${'widgetSlideshow'}['last'] = true;
					if(isset(${'widgetSlideshow'}['formElements']) && is_array(${'widgetSlideshow'}['formElements']))
					{
						foreach(${'widgetSlideshow'}['formElements'] as $name => $object)
						{
							${'widgetSlideshow'}[$name] = $object->parse();
							${'widgetSlideshow'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
                            <li>
                            <?php
					if(isset(${'widgetSlideshow'}['link']) && count(${'widgetSlideshow'}['link']) != 0 && ${'widgetSlideshow'}['link'] != '' && ${'widgetSlideshow'}['link'] !== false)
					{
						?><a href="<?php echo ${'widgetSlideshow'}['link']; ?>"><?php } ?>
                            <img src="/src/Frontend/Files/userfiles/images/slideshow/<?php echo ${'widgetSlideshow'}['filename']; ?>" alt="<?php echo ${'widgetSlideshow'}['title']; ?>" />
                            <?php
					if(isset(${'widgetSlideshow'}['link']) && count(${'widgetSlideshow'}['link']) != 0 && ${'widgetSlideshow'}['link'] != '' && ${'widgetSlideshow'}['link'] !== false)
					{
						?></a><?php } ?>
                            <?php
					if(isset(${'widgetSlideshow'}['title']) && count(${'widgetSlideshow'}['title']) != 0 && ${'widgetSlideshow'}['title'] != '' && ${'widgetSlideshow'}['title'] !== false)
					{
						?><p class="flex-caption"><?php echo ${'widgetSlideshow'}['title']; ?></p><?php } ?>
                            </li>
                        <?php
					$this->iterations['f9241a608d03194ab8e1590499cc3d76_Slideshow.tpl.php_1']['i']++;
				}
				if(isset($this->iterations['f9241a608d03194ab8e1590499cc3d76_Slideshow.tpl.php_1']['old'])) ${'widgetSlideshow'} = $this->iterations['f9241a608d03194ab8e1590499cc3d76_Slideshow.tpl.php_1']['old'];
				else unset($this->iterations['f9241a608d03194ab8e1590499cc3d76_Slideshow.tpl.php_1']);
				?>
                        </ul>
                    </div>
                </div>
            </div>
		</div>
        <script type="text/javascript">
        // loading multiple onload functions when using multiple widgets on one page
        function addLoadEvent(func) {
            var oldonload = window.onload;
                if (typeof window.onload != 'function') {
                    window.onload = func;
                } else {
                    window.onload = function() {
                    if (oldonload) {
                        oldonload();
                    }
                func();
                }
            }
        }

        // set custom slideshow options
        function flex<?php echo $this->variables['widgetGallery']['id']; ?>() {
            $('.flexsliderwrap<?php echo $this->variables['widgetGallery']['id']; ?>').flexslider({
                controlsContainer: "#flex<?php echo $this->variables['widgetGallery']['id']; ?>",
                animation: "<?php echo $this->variables['widgetSlideshowSettings']['animation_type']; ?>",
                slideDirection: "<?php echo $this->variables['widgetSlideshowSettings']['slide_direction']; ?>",
                slideshowSpeed: <?php echo $this->variables['widgetSlideshowSettings']['slideshow_speed']; ?>000,
                animationDuration:<?php echo $this->variables['widgetSlideshowSettings']['animation_duration']; ?>000,
                directionNav:<?php echo $this->variables['widgetSlideshowSettings']['direct_navigation']; ?>,
                controlNav:<?php echo $this->variables['widgetSlideshowSettings']['control_navigation']; ?>,
                keyboardNav:<?php echo $this->variables['widgetSlideshowSettings']['keyboard_navigation']; ?>,
                mousewheel:<?php echo $this->variables['widgetSlideshowSettings']['mousewheel_navigation']; ?>,
                randomize:<?php echo $this->variables['widgetSlideshowSettings']['random_order']; ?>,
                slideshow:<?php echo $this->variables['widgetSlideshowSettings']['auto_animate']; ?>,
                animationLoop:<?php echo $this->variables['widgetSlideshowSettings']['animation_loop']; ?>
            });
        };

        addLoadEvent(flex<?php echo $this->variables['widgetGallery']['id']; ?>);
    </script>

    <?php } ?>
