<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */



get_header();

header("HTTP/1.1 301 Moved Permanently");
header("Location: ".get_bloginfo('url'));
exit();

get_footer();
