<?php 



// THEME OPTIONS



$themename = "Orange Flash";

$shortname = "wordpressbling";



$categories = get_categories('hide_empty=0&orderby=name');

$wp_cats = array();

foreach ($categories as $category_list ) {

       $wp_cats[$category_list->cat_ID] = $category_list->cat_name;

}

array_unshift($wp_cats, "Choose a category"); 



$options = array (

 

array( "name" => $themename." Options",

	"type" => "title"),

 

array( "name" => "General",

	"type" => "section"),

array( "type" => "open"),	



array( "name" => "Logo URL",

	"desc" => "Enter the link to your logo image. Max width of the image: 480px.",

	"id" => $shortname."_logo",

	"type" => "text",

	"std" => "http://wordpressbling.com/images/logo_orangeflash.png"),


array( "name" => "Rss",

	"desc" => "Enter the RSS feed URL here:",

	"id" => $shortname."_rss",

	"type" => "text",

	"std" => "http://feeds.feedburner.com/WordpressBling"),
	
	
array( "name" => "Facebook",

	"desc" => "Enter the Facebook URL here:",

	"id" => $shortname."_facebook",

	"type" => "text",

	"std" => "http://www.facebook.com/wordpressbling"),


array( "name" => "Twitter",

	"desc" => "Enter the Twitter URL here:",

	"id" => $shortname."_twitter",

	"type" => "text",

	"std" => "http://twitter.com/wordpressbling"),
	
array( "name" => "Mail",

	"desc" => "Enter the Twitter URL here:",

	"id" => $shortname."_mail",

	"type" => "text",

	"std" => "http://feedburner.google.com/fb/a/mailverify?uri=WordpressBling&loc=en_US"),	
	

array( "type" => "close"),



array( "name" => "Homepage",

	"type" => "section"),

array( "type" => "open"),	



array( "name" => "Featured category",

	"desc" => "Choose a category from which featured posts are drawn for the homepage slider.",

	"id" => $shortname."_feat",

	"type" => "select",

	"options" => $wp_cats,

	"std" => "Choose a category"),	

	

array( "name" => "Featured posts",

	"desc" => "Enter number of posts to be displayed in homepage slider. (max: 10)",

	"id" => $shortname."_slidernum",

	"type" => "text",

	"std" => "10"),	
	
array( "name" => "Display social sharing bar",

	"desc" => "Check to enable a social sharing bar on single posts.",

	"id" => $shortname."_social",

	"type" => "checkbox",

	"std" => "checked"),
	
array( "name" => "Excerpt limit",

	"desc" => "Enter number of characters you would like the excerpt to be generated to if no custom excerpt is set.",

	"id" => $shortname."_excerptLimit",

	"type" => "text",

	"std" => "90"),
	
array( "name" => "Banner Image Height",

	"desc" => "Enter the height you would like the banner images to be.",

	"id" => $shortname."_bannerHeight",

	"type" => "text",

	"std" => "100"),
	

array( "name" => "Latest Articles",

	"desc" => "Enter number of posts to be displayed in Latest Articles section.",

	"id" => $shortname."_latest",

	"type" => "text",

	"std" => "4"),

array( "name" => "Latest Articles Layout",

	"desc" => "Choose how you would like to display the posts.",

	"id" => $shortname."_postLayout",

	"type" => "select",

	"options" => array("One post per width", "Two posts per width"),

	"std" => "Choose a category"),	
			

array( "name" => "Older Articles",

	"desc" => "Enter number of posts to be displayed in Older Articles section.",

	"id" => $shortname."_next",

	"type" => "text",

	"std" => "4"),



array( "type" => "close"),



array( "name" => "Tabs widget",

	"type" => "section"),

array( "type" => "open"),



array( "name" => "Display tabs widget",

	"desc" => "Check to enable tabs widget in the sidebar.",

	"id" => $shortname."_displaytabs",

	"type" => "checkbox",

	"std" => "checked"),

array( "name" => "Excerpt limit",

	"desc" => "Enter number of characters you would like the excerpt to be generated to",

	"id" => $shortname."_widgetLimit",

	"type" => "text",

	"std" => "50"),

array( "name" => "Popular posts",

	"desc" => "Enter number of posts to be displayed in Popular posts tab.",

	"id" => $shortname."_wpop",

	"type" => "text",

	"std" => "3"),	

	

array( "name" => "Latest posts",

	"desc" => "Enter number of posts to be displayed in Latests posts tab.",

	"id" => $shortname."_wlate",

	"type" => "text",

	"std" => "4"),	

	

array( "name" => "Recent comments",

	"desc" => "Enter number of comments to be displayed in Recent comments tab.",

	"id" => $shortname."_wcom",

	"type" => "text",

	"std" => "3"),			



array( "type" => "close"),



array( "name" => "Footer",

	"type" => "section"),

array( "type" => "open"),	

	

array( "name" => "Copyright Info",

	"desc" => "Enter copyright info or other information to be displayed in the footer (left side).",

	"id" => $shortname."_fleft",

	"type" => "text",

	"std" => "&copy; 2011 wordpressbling.com"),

			


array( "type" => "close"),

 

array( "name" => "Advertisement",

	"type" => "section"),

array( "type" => "open"),	





array( "name" => "Ad 1 (125x125) - Image",

	"desc" => "Enter image URL for the ad.",

	"id" => $shortname."_ad1img",

	"type" => "text",

	"std" => "http://woothemes.com/ads/125x125a.jpg"),	

	

array( "name" => "Ad 1 (125x125) - URL",

	"desc" => "Enter URL for the ad.",

	"id" => $shortname."_ad1url",

	"type" => "text",

	"std" => "http://www.woothemes.com/amember/go.php?r=37667&i=b29"),	

	

array( "name" => "Ad 2 (125x125) - Image",

	"desc" => "Enter image URL for the ad.",

	"id" => $shortname."_ad2img",

	"type" => "text",

	"std" => "http://flexithemes.com/wp-content/partners/fta.gif"),	

	

array( "name" => "Ad 2 (125x125) - URL",

	"desc" => "Enter URL for the ad.",

	"id" => $shortname."_ad2url",

	"type" => "text",

	"std" => "http://flexithemes.com/?partner=930"),	



array( "name" => "Ad 3 (125x125) - Image",

	"desc" => "Enter image URL for the ad.",

	"id" => $shortname."_ad3img",

	"type" => "text",

	"std" => "http://envato.s3.amazonaws.com/referrer_adverts/3d_125x125_v4.gif"),	

	

array( "name" => "Ad 3 (125x125) - URL",

	"desc" => "Enter URL for the ad.",

	"id" => $shortname."_ad3url",

	"type" => "text",

	"std" => "http://themeforest.net?ref=kevintruong"),

	

array( "name" => "Ad 4 (125x125) - Image",

	"desc" => "Enter image URL for the ad.",

	"id" => $shortname."_ad4img",

	"type" => "text",

	"std" => "http://tracking.hostgator.com/img/Discount_Shared/Hostgator-new-_AN-125x125.gif"),	

	

array( "name" => "Ad 4 (125x125) - URL",

	"desc" => "Enter URL for the ad.",

	"id" => $shortname."_ad4url",

	"type" => "text",

	"std" => "http://secure.hostgator.com/~affiliat/cgi-bin/affiliates/clickthru.cgi?id=kevintruong"),				


array( "name" => "Ad 5 (125x125) - Image",

	"desc" => "Enter image URL for the ad.",

	"id" => $shortname."_ad5img",

	"type" => "text",

	"std" => "http://wordpressbling.com/ads/1.gif"),	

	

array( "name" => "Ad 5 (125x125) - URL",

	"desc" => "Enter URL for the ad.",

	"id" => $shortname."_ad5url",

	"type" => "text",

	"std" => "http://wordpressbling.com/"),				


array( "name" => "Ad 6 (125x125) - Image",

	"desc" => "Enter image URL for the ad.",

	"id" => $shortname."_ad6img",

	"type" => "text",

	"std" => "http://wordpressbling.com/ads/2.png"),	

	

array( "name" => "Ad 6 (125x125) - URL",

	"desc" => "Enter URL for the ad.",

	"id" => $shortname."_ad6url",

	"type" => "text",

	"std" => "http://wordpressbling.com"),	
	
	
	array( "name" => "Ad 7 (125x125) - Image",

	"desc" => "Enter image URL for the ad.",

	"id" => $shortname."_ad7img",

	"type" => "text",

	"std" => "http://wordpressbling.com/ads/3.gif"),	

	

array( "name" => "Ad 7 (125x125) - URL",

	"desc" => "Enter URL for the ad.",

	"id" => $shortname."_ad7url",

	"type" => "text",

	"std" => "http://wordpressbling.com/"),	
	
	
array( "name" => "Ad 8 (125x125) - Image",

	"desc" => "Enter image URL for the ad.",

	"id" => $shortname."_ad8img",

	"type" => "text",

	"std" => "http://wordpressbling.com/ads/4.png"),	

	

array( "name" => "Ad 8 (125x125) - URL",

	"desc" => "Enter URL for the ad.",

	"id" => $shortname."_ad8url",

	"type" => "text",

	"std" => "http://wordpressbling.com"),				


array( "type" => "close")

);





function mytheme_add_admin() {

 

global $themename, $shortname, $options;

 

if ( $_GET['page'] == basename(__FILE__) ) {

 

	if ( 'save' == $_REQUEST['action'] ) {

 

		foreach ($options as $value) {

		update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }

 

	header("Location: admin.php?page=theme_options.php&saved=true");

die;

 

} 

else if( 'reset' == $_REQUEST['action'] ) {

 

	foreach ($options as $value) {

		delete_option( $value['id'] ); }

 

	header("Location: admin.php?page=theme_options.php&reset=true");

die;

 

}

}

 

add_menu_page($themename, $themename, 'administrator', basename(__FILE__), 'mytheme_admin');

}



function mytheme_add_init() {



$file_dir=get_bloginfo('template_directory');

wp_enqueue_style("functions", $file_dir."/functions/functions.css", false, "1.0", "all");

wp_enqueue_script("rm_script", $file_dir."/functions/rm_script.js", false, "1.0");



}

function mytheme_admin() {

 

global $themename, $shortname, $options;

$i=0;

 

if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p><img src="http://wordpressbling.com/wp-content/uploads/2011/06/logo.png" ></div>';

if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';

 

?>
<div class="wrap lm_wrap"><h2>NEW THEMES FROM WordpressBling.Com</h2>
<p>To easily check new themes from WordpressBling.Com</p>
<iframe src="http://wordpressbling.com/category/wordpress-themes" width="100%" height="450"></iframe></div>
<div class="wrap rm_wrap">

<h2><?php echo $themename; ?> Settings</h2>

 

<div class="rm_opts">

<form method="post">

<?php foreach ($options as $value) {

switch ( $value['type'] ) {

 

case "open":

?>

 

<?php break;

 

case "close":

?>

 

</div>

</div>

<br />



 

<?php break;

 

case "title":

?>

<p>To easily use the <?php echo $themename;?> theme, you can use the menu below.</p>



 

<?php break;

 

case 'text':

?>



<div class="rm_input rm_text">

	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>

 	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />

 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>

 

 </div>

<?php

break;

 

case 'textarea':

?>



<div class="rm_input rm_textarea">

	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>

 	<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rowordpressbling=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?></textarea>

 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>

 

 </div>

  

<?php

break;

 

case 'select':

?>



<div class="rm_input rm_select">

	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>

	

<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">

<?php foreach ($value['options'] as $option) { ?>

		<option <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?>

</select>



	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>

</div>

<?php

break;

 

case "checkbox":

?>



<div class="rm_input rm_checkbox">

	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>

	

<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>

<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />





	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>

 </div>

<?php break; 

case "section":



$i++;



?>



<div class="rm_section">

<div class="rm_title"><h3><img src="<?php bloginfo('template_directory')?>/functions/images/trans.png" class="inactive" alt="""><?php echo $value['name']; ?></h3><span class="submit"><input name="save<?php echo $i; ?>" type="submit" value="Save changes" />

</span><div class="clearfix"></div></div>

<div class="rm_options">

<?php break; } } ?>

<input type="hidden" name="action" value="save" />

</form>

<form method="post">

<p class="submit">

<input name="reset" type="submit" value="Reset" />

<input type="hidden" name="action" value="reset" />

</p>

</form>

<div style="font-size:9px; margin-bottom:10px;">For support related issues visit the <a href="http://wordpressbling.com/" >wordpressbling.com</a></div>

</div> 
<?php }

add_action('admin_init', 'mytheme_add_init');

add_action('admin_menu', 'mytheme_add_admin');

global $options; foreach ($options as $value) { if (get_option( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_option( $value['id'] ); } }

?>