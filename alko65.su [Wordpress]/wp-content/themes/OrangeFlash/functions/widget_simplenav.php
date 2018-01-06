<?php 

	/**

	 * Add function to widgets_init that'll load our widget.

	 * @since 0.1

	 */

	add_action( 'widgets_init', 'simplenav_load_widgets' );

	

	/**

	 * Register our widget.

	 * 'wordpressbling_SimpleNav_Widget' is the widget class used below.

	 *

	 * @since 0.1

	 */

	function simplenav_load_widgets() {

		register_widget( 'wordpressbling_SimpleNav_Widget' );

	}

	

	/**

	 * Example Widget class.

	 * This class handles everything that needs to be handled with the widget:

	 * the settings, form, display, and update.  Nice!

	 *

	 * @since 0.1

	 */

	class wordpressbling_SimpleNav_Widget extends WP_Widget {

	

		/**

		 * Widget setup.

		 */

		function wordpressbling_SimpleNav_Widget() {

			/* Widget settings. */

			$widget_ops = array( 'classname' => 'pages', 'description' => __('Displays a simple page and category navigation.', 'simplenav') );

	

			/* Widget control settings. */

			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'simplenav-widget' );

	

			/* Create the widget. */

			$this->WP_Widget( 'simplenav-widget', __('WebSource - SimpleNav', 'simplenav'), $widget_ops, $control_ops );

		}

	

		/**

		 * How to display the widget on the screen.

		 */

		function widget( $args, $instance ) {

			extract( $args );

	

			/* Our variables from the widget settings. */

			$page_title = $instance['page_title'];

			$cat_title = $instance['cat_title'];

	

			/* Before widget (defined by themes). */

			echo $before_widget;

	

			/* Display the page and categories menu. */

				echo '<div class="pages">';

				echo '<h4>'.$page_title.'</h4>';

				echo "<ul>";

				wp_list_pages('title_li=&depth=-1');

				echo "</ul>";

				echo "</div>";

				

				echo '<div class="categories">';

				echo '<h4>'.$cat_title.'</h4>';

				echo "<ul>";

				wp_list_categories('title_li=&hierarchical=0');

				echo "</ul>";

				echo "</div>";	

	

			/* After widget (defined by themes). */

			echo $after_widget;

		}

	

		/**

		 * Update the widget settings.

		 */

		function update( $new_instance, $old_instance ) {

			$instance = $old_instance;

	

			/* Strip tags for titles to remove HTML (important for text inputs). */

			$instance['page_title'] = strip_tags( $new_instance['page_title'] );

			$instance['cat_title'] = strip_tags( $new_instance['cat_title'] );

	

			return $instance;

		}

	

		/**

		 * Displays the widget settings controls on the widget panel.

		 * Make use of the get_field_id() and get_field_name() function

		 * when creating your form elements. This handles the confusing stuff.

		 */

		function form( $instance ) {

	

			/* Set up some default widget settings. */

			$defaults = array( 'title' => __('', 'simplenav'));

			$instance = wp_parse_args( (array) $instance, $defaults ); ?>

	

			<p>

				<label for="<?php echo $this->get_field_id( 'page_title' ); ?>"><?php _e('Pages Title:', 'hybrid'); ?></label>

				<input id="<?php echo $this->get_field_id( 'page_title' ); ?>" name="<?php echo $this->get_field_name( 'page_title' ); ?>" value="<?php echo $instance['page_title']; ?>" style="width:98%;" />

			</p>

			

			<p>

				<label for="<?php echo $this->get_field_id( 'cat_title' ); ?>"><?php _e('Categories Title:', 'hybrid'); ?></label>

				<input id="<?php echo $this->get_field_id( 'cat_title' ); ?>" name="<?php echo $this->get_field_name( 'cat_title' ); ?>" value="<?php echo $instance['cat_title']; ?>" style="width:98%;" />

			</p>

	

	

		<?php

		}

	}

?>