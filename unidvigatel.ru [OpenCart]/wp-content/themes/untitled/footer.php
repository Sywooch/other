
                        </div>
                    </div>
                </div>
            </div><footer class="art-footer clearfix"><?php get_sidebar('footer'); ?><?php
global $theme_default_options;
echo do_shortcode(theme_get_option('theme_override_default_footer_content') ? theme_get_option('theme_footer_content') : theme_get_array_value($theme_default_options, 'theme_footer_content'));
?></footer>

    </div>
</div>


<script type="text/javascript"> _shcp = []; _shcp.push({widget_id : 553667, widget : "Chat", side : "right", position : "center", title : "онлайн заявка", title_offline : "оставить заявку" }); (function() { var hcc = document.createElement("script"); hcc.type = "text/javascript"; hcc.async = true; hcc.src = ("https:" == document.location.protocol ? "https" : "http")+"://widget.siteheart.com/apps/js/sh.js"; var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(hcc, s.nextSibling); })(); </script>

<div id="wp-footer">
	<?php wp_footer(); ?>
	<!-- <?php printf(__('%d queries. %s seconds.', THEME_NS), get_num_queries(), timer_stop(0, 3)); ?> -->
</div>
</body>
</html>
