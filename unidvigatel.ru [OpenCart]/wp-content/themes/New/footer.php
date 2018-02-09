

                        </div>
                    </div>
                </div>
            </div>
    </div>
<footer class="art-footer clearfix"><?php get_sidebar('footer'); ?>
  <div class="art-footer-inner"><?php
global $theme_default_options;
echo do_shortcode(theme_get_option('theme_override_default_footer_content') ? theme_get_option('theme_footer_content') : theme_get_array_value($theme_default_options, 'theme_footer_content'));
?></div>
</footer>

</div>



<div id="wp-footer">
	<?php wp_footer(); ?>
	<!-- <?php printf(__('%d queries. %s seconds.', THEME_NS), get_num_queries(), timer_stop(0, 3)); ?> -->
</div>
</body>
</html>

