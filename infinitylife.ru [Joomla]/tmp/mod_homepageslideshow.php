<?php
/**
* @Copyright Copyright (C) 2010- xml/swf
* @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
**/
/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Restricted access' ); 
require_once (dirname(__FILE__).DS.'noimage_functions.php');

$bannerWidth                   = intval($params->get( 'bannerWidth', 760 ));
$bannerHeight                  = intval($params->get( 'bannerHeight', 220 ));
$backgroundColor         = trim($params->get( 'backgroundColor', '#FFFFFF' ));
$wmode                 = trim($params->get( 'wmode', 'transparent' ));
$imagewidth                 = trim($params->get( 'imagewidth', '510' ));
$baseColor                 = trim($params->get( 'baseColor', '0x92BB38' ));
$xml_fname = $params->get( 'xml_fname', 'a' );
$catppv_id = 'xml/' . $xml_fname;

$module_path = dirname(__FILE__).DS;
if (!is_dir($module_path . 'xml/')) {
	mkdir($module_path . 'xml/', 0777);
}


if (!function_exists('create_product_xmlhome_files')) {
function create_product_xmlhome_files($params, &$catppv_id)
{


$descbox_visible = trim($params->get('descbox_visible', 'yes'));

if($descbox_visible == 'yes'){
	$generate_descbox_visible = 'true';
}else{
		$generate_descbox_visible = 'false';
}


$xml_category_data = '<?xml version="1.0" encoding="iso-8859-1"?>

<slideshow >
	<baseDef autoSlideTime="'.intval($params->get( 'autoSlideTime', 10 )).'"   gradientColor1="'.trim($params->get('gradientColor1', '0xE1ED91')).'"  showPlay="'.trim($params->get('showPlay', '1')).'"  gradientColor2="'.trim($params->get('gradientColor2', '0xAFCB5A')).'"  menuColor="'.trim($params->get('menuColor', '0xebf3e0')).'" menuOverColor="'.trim($params->get('menuOverColor', '0x7DAA20')).'" menuTextColor= "'.trim($params->get('menuTextColor', '0x21428c')).'" menuOverTextColor="'.trim($params->get('menuOverTextColor', '0xffffff')).'" transitionTime="'.trim($params->get('transitionTime', '1')).'" menutransition="'.trim($params->get('menutransition', '0.2')).'" menuScrollSpeed ="'.trim($params->get('menuScrollSpeed', '15')).'" boxwidth="'.trim($params->get('boxwidth', '250')).'" boxheight="'.trim($params->get('boxheight', '160')).'" infoFontSizeBig="'.trim($params->get('infoFontSizeBig', '12')).'" infoFontSizeSmall="'.trim($params->get('infoFontSizeSmall', '16')).'" menuFontSize="'.trim($params->get('menuFontSize','12')).'"
	transform="null" 
	transition="'.trim($params->get('transition', 'left')).'"
	transition_type="'.trim($params->get('transition_type', 'easeIn')).'"
	cornerRadius="'.trim($params->get('cornerRadius', '55')).'"
	box_x="'.trim($params->get('box_x', '270')).'"
	box_y="'.trim($params->get('box_y', '50')).'"
	button_width="'.trim($params->get('button_width', '100')).'"
	description_box_visible="'.$generate_descbox_visible.'"
	/>';		
		
$pic        = trim($params->get('pic', '' )); 
$pic_arr    = explode("\n",$pic);
$menutxt        = trim($params->get('menutxt', '' )); 
$menutxt_arr    = explode("\n",$menutxt);
$bigtext        = trim($params->get('bigtext', '' ));
$bigtext_arr    = explode("\n",$bigtext);
$stext        = trim($params->get('stext', '' ));
$stext_arr    = explode("\n",$stext);
$links        = trim($params->get('links', '' ));
$links_arr    = explode("\n",$links);


$exist_url = JURI::root();

$server_path = getCurUrl($exist_url);

foreach($pic_arr as $curr_k=>$curr_pic) {
	$xml_category_data .= '	<pic url="'.trim($links_arr[$curr_k]).'" target="'.$params->get('target', '_blank').'"  
	FindMoreColorBack="'.$params->get('FindMoreColorBack', '0x095373').'"  FindMoreColorText="'.$params->get('FindMoreColorText', '0xffffff').'" FindMoreAlpha="'.$params->get('FindMoreAlpha', '0.3').'" FindMoreButtonColor="'.$params->get('FindMoreButtonColor', '0x38c0fb').'" FindMoreButtonTextColor ="'.$params->get('FindMoreButtonTextColor', '0xffffff').'" ';

if (false === strpos($curr_pic, '://')) {

	$xml_category_data .= ' pic="'.trim($server_path.$curr_pic).'">';
}else{
		$xml_category_data .= ' pic="'.trim($curr_pic).'">';
}


	$xml_category_data .=  '<FindMoreName><![CDATA['.$params->get('FindMoreName', 'View More').']]></FindMoreName> ';
	
if ($params->get( 'showDesBigTxt', '1' ) == 1) {

			$FindMoreText = '<![CDATA['.trim($bigtext_arr[$curr_k]).']]>';
	}else{
	$FindMoreText = '';
	}
	$xml_category_data .=  '<FindMoreText>'.$FindMoreText.'</FindMoreText> ';

	if ($params->get( 'showDesSmlTxt', '1' ) == 1) {
		$FindMoreSText = '<![CDATA['.trim($stext_arr[$curr_k]).']]>';
	}else{
	$FindMoreSText = '';
	}
	$xml_category_data .=  '<FindMoreSText>'.$FindMoreSText.'</FindMoreSText> ';

	$xml_category_data .=  '<menuText><![CDATA['.trim($menutxt_arr[$curr_k]).']]></menuText>
		</pic>	
';
}
$xml_category_data .= "	
</slideshow>";

$module_path = dirname(__FILE__).DS;
$catppv_id .= md5($xml_category_data);

if (!file_exists($module_path . $catppv_id . '.swf')) {
	copy($module_path . 'mod_homepageslideshow.swf', $module_path . $catppv_id . '.swf');

	///////// set chmod 0777 for creating .xml file  if server is not windows
	$os_string = php_uname('s');
	$cnt = substr_count($os_string, 'Windows');
	if($cnt =='0'){
		@chmod($module_path . $catppv_id . '.swf', 0644);
	}

}

$xml_categories_filename = $module_path.$catppv_id.'.xml';
if (!file_exists($xml_categories_filename)) {
	$xml_categories_file = fopen($xml_categories_filename,'w');
	fwrite($xml_categories_file, $xml_category_data);
	
///////// set chmod 0777 for creating .xml file  if server is not windows
	$os_string = php_uname('s');
	$cnt = substr_count($os_string, 'Windows');
	if($cnt =='0'){
		@chmod($xml_categories_filename, 0777);
	}


	fclose($xml_categories_file);
}

}
}

create_product_xmlhome_files($params, $catppv_id);
$exist_url = JURI::root();

$server_path = getCurUrl($exist_url);

?>
<script type="text/javascript" src="<?php echo $server_path?>modules/mod_homepageslideshow/swfobject.js"></script>
<script type="text/javascript">

		var flashvars = {
			maxwidth: "<?php echo $bannerWidth;?>",
			maxheight: "<?php echo $bannerHeight; ?>",
			imagewidth: "<?php echo $imagewidth; ?>",
			baseColor: "<?php echo $baseColor; ?>",
			xmlfileurl: "<?php echo $server_path; ?>modules/mod_homepageslideshow/<?php echo $catppv_id; ?>.xml"
		};
		var params = {
			bgcolor: "<?php echo $backgroundColor; ?>",
			wmode  : "<?php echo $wmode;?>"
		};
		
		var attributes = {
			id: "homepage_slideshow"
		};
		
		
		swfobject.embedSWF("<?php echo $server_path?>modules/mod_homepageslideshow/<?php echo $catppv_id; ?>.swf", "homepageSlideshow", "<?php echo $bannerWidth;?>px", "<?php echo $bannerHeight; ?>px", "10.0.0", false, flashvars, params, attributes);

</script>
<div id="homepageSlideshow"></div>
