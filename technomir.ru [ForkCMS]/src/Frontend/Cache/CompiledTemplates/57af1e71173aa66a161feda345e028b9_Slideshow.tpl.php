<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>


    <?php
					if(isset($this->variables['widgetGallery']) && count($this->variables['widgetGallery']) != 0 && $this->variables['widgetGallery'] != '' && $this->variables['widgetGallery'] !== false)
					{
						?>
        
            <div class="flex-container" id="flex<?php if(isset($this->variables['widgetGallery']) && array_key_exists('id', (array) $this->variables['widgetGallery'])) { echo $this->variables['widgetGallery']['id']; } else { ?>{$widgetGallery.id}<?php } ?>" style="max-width:<?php if(isset($this->variables['widgetGallery']) && array_key_exists('width', (array) $this->variables['widgetGallery'])) { echo $this->variables['widgetGallery']['width']; } else { ?>{$widgetGallery.width}<?php } ?>px">
                <div class="flexslider">
                    <div class="flexsliderwrap<?php if(isset($this->variables['widgetGallery']) && array_key_exists('id', (array) $this->variables['widgetGallery'])) { echo $this->variables['widgetGallery']['id']; } else { ?>{$widgetGallery.id}<?php } ?>">
                        <ul class="slides">
                        <?php
					if(!isset($this->variables['widgetSlideshow']))
					{
						?>{iteration:widgetSlideshow}<?php
						$this->variables['widgetSlideshow'] = array();
						$this->iterations['57af1e71173aa66a161feda345e028b9_Slideshow.tpl.php_1']['fail'] = true;
					}
				if(isset(${'widgetSlideshow'})) $this->iterations['57af1e71173aa66a161feda345e028b9_Slideshow.tpl.php_1']['old'] = ${'widgetSlideshow'};
				$this->iterations['57af1e71173aa66a161feda345e028b9_Slideshow.tpl.php_1']['iteration'] = $this->variables['widgetSlideshow'];
				$this->iterations['57af1e71173aa66a161feda345e028b9_Slideshow.tpl.php_1']['i'] = 1;
				$this->iterations['57af1e71173aa66a161feda345e028b9_Slideshow.tpl.php_1']['count'] = count($this->iterations['57af1e71173aa66a161feda345e028b9_Slideshow.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['57af1e71173aa66a161feda345e028b9_Slideshow.tpl.php_1']['iteration'] as ${'widgetSlideshow'})
				{
					if(!isset(${'widgetSlideshow'}['first']) && $this->iterations['57af1e71173aa66a161feda345e028b9_Slideshow.tpl.php_1']['i'] == 1) ${'widgetSlideshow'}['first'] = true;
					if(!isset(${'widgetSlideshow'}['last']) && $this->iterations['57af1e71173aa66a161feda345e028b9_Slideshow.tpl.php_1']['i'] == $this->iterations['57af1e71173aa66a161feda345e028b9_Slideshow.tpl.php_1']['count']) ${'widgetSlideshow'}['last'] = true;
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
						?><a href="<?php if(array_key_exists('link', (array) ${'widgetSlideshow'})) { echo ${'widgetSlideshow'}['link']; } else { ?>{$widgetSlideshow->link}<?php } ?>"><?php } ?>
                            <img src="/src/Frontend/Files/userfiles/images/slideshow/<?php if(array_key_exists('filename', (array) ${'widgetSlideshow'})) { echo ${'widgetSlideshow'}['filename']; } else { ?>{$widgetSlideshow->filename}<?php } ?>" alt="<?php if(array_key_exists('title', (array) ${'widgetSlideshow'})) { echo ${'widgetSlideshow'}['title']; } else { ?>{$widgetSlideshow->title}<?php } ?>" />
                            <?php
					if(isset(${'widgetSlideshow'}['link']) && count(${'widgetSlideshow'}['link']) != 0 && ${'widgetSlideshow'}['link'] != '' && ${'widgetSlideshow'}['link'] !== false)
					{
						?></a><?php } ?>
                            <?php
					if(isset(${'widgetSlideshow'}['title']) && count(${'widgetSlideshow'}['title']) != 0 && ${'widgetSlideshow'}['title'] != '' && ${'widgetSlideshow'}['title'] !== false)
					{
						?><p class="flex-caption"><?php if(array_key_exists('title', (array) ${'widgetSlideshow'})) { echo ${'widgetSlideshow'}['title']; } else { ?>{$widgetSlideshow->title}<?php } ?></p><?php } ?>
                            </li>
                        <?php
					$this->iterations['57af1e71173aa66a161feda345e028b9_Slideshow.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['57af1e71173aa66a161feda345e028b9_Slideshow.tpl.php_1']['fail']) && $this->iterations['57af1e71173aa66a161feda345e028b9_Slideshow.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:widgetSlideshow}<?php
					}
				if(isset($this->iterations['57af1e71173aa66a161feda345e028b9_Slideshow.tpl.php_1']['old'])) ${'widgetSlideshow'} = $this->iterations['57af1e71173aa66a161feda345e028b9_Slideshow.tpl.php_1']['old'];
				else unset($this->iterations['57af1e71173aa66a161feda345e028b9_Slideshow.tpl.php_1']);
				?>
                        </ul>
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
        function flex<?php if(isset($this->variables['widgetGallery']) && array_key_exists('id', (array) $this->variables['widgetGallery'])) { echo $this->variables['widgetGallery']['id']; } else { ?>{$widgetGallery.id}<?php } ?>() {
            $('.flexsliderwrap<?php if(isset($this->variables['widgetGallery']) && array_key_exists('id', (array) $this->variables['widgetGallery'])) { echo $this->variables['widgetGallery']['id']; } else { ?>{$widgetGallery.id}<?php } ?>').flexslider({
                controlsContainer: "#flex<?php if(isset($this->variables['widgetGallery']) && array_key_exists('id', (array) $this->variables['widgetGallery'])) { echo $this->variables['widgetGallery']['id']; } else { ?>{$widgetGallery.id}<?php } ?>",
                animation: "<?php if(isset($this->variables['widgetSlideshowSettings']) && array_key_exists('animation_type', (array) $this->variables['widgetSlideshowSettings'])) { echo $this->variables['widgetSlideshowSettings']['animation_type']; } else { ?>{$widgetSlideshowSettings.animation_type}<?php } ?>",
                slideDirection: "<?php if(isset($this->variables['widgetSlideshowSettings']) && array_key_exists('slide_direction', (array) $this->variables['widgetSlideshowSettings'])) { echo $this->variables['widgetSlideshowSettings']['slide_direction']; } else { ?>{$widgetSlideshowSettings.slide_direction}<?php } ?>",
                slideshowSpeed: <?php if(isset($this->variables['widgetSlideshowSettings']) && array_key_exists('slideshow_speed', (array) $this->variables['widgetSlideshowSettings'])) { echo $this->variables['widgetSlideshowSettings']['slideshow_speed']; } else { ?>{$widgetSlideshowSettings.slideshow_speed}<?php } ?>000,
                animationDuration:<?php if(isset($this->variables['widgetSlideshowSettings']) && array_key_exists('animation_duration', (array) $this->variables['widgetSlideshowSettings'])) { echo $this->variables['widgetSlideshowSettings']['animation_duration']; } else { ?>{$widgetSlideshowSettings.animation_duration}<?php } ?>000,
                directionNav:<?php if(isset($this->variables['widgetSlideshowSettings']) && array_key_exists('direct_navigation', (array) $this->variables['widgetSlideshowSettings'])) { echo $this->variables['widgetSlideshowSettings']['direct_navigation']; } else { ?>{$widgetSlideshowSettings.direct_navigation}<?php } ?>,
                controlNav:<?php if(isset($this->variables['widgetSlideshowSettings']) && array_key_exists('control_navigation', (array) $this->variables['widgetSlideshowSettings'])) { echo $this->variables['widgetSlideshowSettings']['control_navigation']; } else { ?>{$widgetSlideshowSettings.control_navigation}<?php } ?>,
                keyboardNav:<?php if(isset($this->variables['widgetSlideshowSettings']) && array_key_exists('keyboard_navigation', (array) $this->variables['widgetSlideshowSettings'])) { echo $this->variables['widgetSlideshowSettings']['keyboard_navigation']; } else { ?>{$widgetSlideshowSettings.keyboard_navigation}<?php } ?>,
                mousewheel:<?php if(isset($this->variables['widgetSlideshowSettings']) && array_key_exists('mousewheel_navigation', (array) $this->variables['widgetSlideshowSettings'])) { echo $this->variables['widgetSlideshowSettings']['mousewheel_navigation']; } else { ?>{$widgetSlideshowSettings.mousewheel_navigation}<?php } ?>,
                randomize:<?php if(isset($this->variables['widgetSlideshowSettings']) && array_key_exists('random_order', (array) $this->variables['widgetSlideshowSettings'])) { echo $this->variables['widgetSlideshowSettings']['random_order']; } else { ?>{$widgetSlideshowSettings.random_order}<?php } ?>,
                slideshow:<?php if(isset($this->variables['widgetSlideshowSettings']) && array_key_exists('auto_animate', (array) $this->variables['widgetSlideshowSettings'])) { echo $this->variables['widgetSlideshowSettings']['auto_animate']; } else { ?>{$widgetSlideshowSettings.auto_animate}<?php } ?>,
                animationLoop:<?php if(isset($this->variables['widgetSlideshowSettings']) && array_key_exists('animation_loop', (array) $this->variables['widgetSlideshowSettings'])) { echo $this->variables['widgetSlideshowSettings']['animation_loop']; } else { ?>{$widgetSlideshowSettings.animation_loop}<?php } ?>
            });
        };

        addLoadEvent(flex<?php if(isset($this->variables['widgetGallery']) && array_key_exists('id', (array) $this->variables['widgetGallery'])) { echo $this->variables['widgetGallery']['id']; } else { ?>{$widgetGallery.id}<?php } ?>);
    </script>
    <?php } ?>
