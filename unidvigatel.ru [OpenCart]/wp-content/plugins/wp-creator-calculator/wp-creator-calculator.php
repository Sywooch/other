<?php
/*
Plugin Name: wp-creator-calculator
Plugin URI: http://www.zetrider.ru/wp-creator-calculator.html
Description: Creating forms calculator, the introduction of the template and write
Version: 3.1
Author: ZetRider
Author URI: http://www.zetrider.ru
Author Email: ZetRider@bk.ru
*/
/*  Copyright 2012  zetrider  (email: zetrider@bk.ru)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

global $wpdb;

load_plugin_textdomain('wpcc', PLUGINDIR.'/'.dirname(plugin_basename(__FILE__)). '/lang/');
// _e("","wpcc")
// __("","wpcc")

$WPCC_PLUGIN_URL = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));

/* Table */
$sql = sprintf("
CREATE TABLE IF NOT EXISTS wp_wpcc (
	wpcc_id INT NOT NULL AUTO_INCREMENT,
	PRIMARY KEY(wpcc_id),
	wpcc_cat INT NOT NULL,
	wpcc_name VARCHAR(255) NOT NULL,
	wpcc_type VARCHAR(10) NOT NULL,
	wpcc_to VARCHAR(5) NOT NULL,
	wpcc_af VARCHAR(5) NOT NULL,
	wpcc_price VARCHAR(255) NOT NULL,
	wpcc_value VARCHAR(255) NOT NULL,
	wpcc_text TEXT NOT NULL,
	wpcc_sess_id VARCHAR(255) NOT NULL,
	wpcc_sess_res VARCHAR(255) NOT NULL,
	wpcc_jq_id VARCHAR(255) NOT NULL,
	wpcc_order INT NOT NULL
) ENGINE=MyISAM CHARACTER SET=utf8;
");
$result = $wpdb->query($sql);

/* Session Start Init */
function wpcc_session_start() {
	if(get_option('wpcc_stars_session') == '1') {
		session_start();
	}
	//unset($_SESSION['wpcc_1']); 
	//session_destroy();
}
add_action('init', 'wpcc_session_start');
/* jQuery connect */
function wpcc_jquery_connect() {
	if(get_option('wpcc_connect_jquery') == '1') {
		wp_enqueue_script("jquery");
	}
}
add_action('init', 'wpcc_jquery_connect');

/* Menu and Admin Script*/
function wpcc_menu(){
	global $WPCC_PLUGIN_URL;
	$ico 	= $WPCC_PLUGIN_URL."images/wpcc.png";
	$page = add_menu_page('WPCC', 'WPCC', 'manage_options', 'wpcc', 'wpcc_setting', "$ico");
	add_action('admin_print_scripts-' . $page, 'wpcc_admin_scripts');
}	add_action('admin_menu', 'wpcc_menu');

function wpcc_admin_scripts() {
	wp_enqueue_script('wpcc-admin-ajax');
	wp_enqueue_script('wpcc-admin-script');
	wp_enqueue_script('wpcc-admin-script-ui');
	wp_enqueue_style('wpcc-admin-style');
}
function wpcc_script_admin_init() {
	global $WPCC_PLUGIN_URL;
	wp_register_script('wpcc-admin-script', $WPCC_PLUGIN_URL.'js/action.js');
	wp_register_script('wpcc-admin-script-ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.js');
	wp_register_script('wpcc-admin-ajax', $WPCC_PLUGIN_URL.'js/wpcc.js');
	wp_register_style('wpcc-admin-style', $WPCC_PLUGIN_URL.'style.css');
}	add_action('admin_init', 'wpcc_script_admin_init');

/* WPCC Script */
function wpcc_add_script() {
	global $WPCC_PLUGIN_URL;
	echo "<script type='text/javascript' src='".$WPCC_PLUGIN_URL."js/wpcc.js'></script> \n";
} add_action( 'wp_head', 'wpcc_add_script' );

/* ... */
function wpcc_sql_query($str='') {
    $str = stripslashes($str);
    $str = mysql_real_escape_string($str);
	$str = trim($str);
	return $str;
}
/* ... */
function wpcc_get_form($str='') {
    $str = stripslashes($str);
	$str = trim($str);
	$str = htmlspecialchars($str);
	return $str;
}
/* Check calculator */
function wpcc_check_id($wpcc_id) {
	global $wpdb;
	$res = $wpdb->get_results("SELECT wpcc_id FROM wp_wpcc WHERE wpcc_cat = '' AND wpcc_id = '$wpcc_id' ORDER BY wpcc_name");
	if(count($res) > 0) {
		return true;
	} else {
		return false;
	}
}
/* Check Old Version */
function wpcc_old_version() {
	global $wpdb;
	if(get_option('wpcc_check_old') != '1') {
	$db_old = $wpdb->prefix.'calculator';
	if($_POST['wpcc_old_delete'] != '') {
		$res = $wpdb->get_results("SELECT `calc_id` FROM `$db_old` ORDER BY `calc_id`");
		if(count($res) > 0) {
			foreach ($res as $row) {
				delete_option('calc_action'.$row->calc_id);
				delete_option('calc_submit'.$row->calc_id);
				delete_option('calc_finishsumm'.$row->calc_id);
				delete_option('calc_finishsumm_after'.$row->calc_id);
			}
				delete_option('calc_style');
				delete_option('calc_copyright');
				$res = $wpdb->query("DROP TABLE $db_old");
				update_option( 'wpcc_check_old', '1' );
		}		
	}

		$res = $wpdb->get_results("SELECT * FROM `$db_old` ORDER BY `calc_id`");
		if (count($res) > 0) {
			$return .= '<i>'.__("On your site found an older version of the database plug-in, which is not compatible with version 3.0.", "wpcc").'<br><b class="wpcc_show_old">'.__("Show data from the old version of the plugin", "wpcc").'</b></i><br>';
			$return .= '<div class="wpcc_row_old" style="display:none;">';
			$return .= '<ul>';
			foreach ($res as $row) {
				$return .= '<li class="wpcc_radius_all"><b>Calc ID '.$row->calc_id.':</b> ';
				$return .= 'Type: '.$row->calc_type.', ';
				if($row->calc_title != '') { $return .= 'Title: '.$row->calc_title.', '; }
				if($row->calc_to != '') { $return .= 'To: '.$row->calc_to.', '; }
				if($row->calc_after != '') { $return .= 'After '.$row->calc_after.', '; }
				if($row->calc_sort != '') { $return .= 'Order: '.$row->calc_sort.', '; }
				if($row->calc_price != '') { $return .= 'Price: '.$row->calc_price.', '; }
				if($row->calc_valueinput != '') { $return .= 'Value: '.$row->calc_valueinput.', '; }
				if($row->calc_morefield != '') { $return .= 'List: '.$row->calc_morefield.', '; }
				if($row->calc_text != '') { $return .= 'Text: '.wpcc_get_form($row->calc_text); }
				$return .= '</li>';
			}
			$return .= '</ul>';
			$return .= '
			<form method="post">
			<input type="submit" name="wpcc_old_delete" value="'.__("I rewrote everything, you can delete the old version forever.", "wpcc").'" class="button-primary">
			</form>
			</div>
			<hr><br style="clear:both;">
			';
		} else {
			update_option( 'wpcc_check_old', '1' );
			$return = false;
		}
	} else { $return = false; }
	return $return;
}
/* WPCC Form Mail */
function wpcc_mail_form($wpcc_sum = '', $wpcc_id='') {
	$wpcc_id = intval($wpcc_id);
	
	if($wpcc_sum == '') { // ...
		$wpcc_sum = $_POST['wpcc_mail_sum'];
	}
	
	if($wpcc_id > '0') {
			if(get_option('wpcc_ajax_'.$wpcc_id) == '1') {
				$return .= '<div class="wpcc_mail_info wpcc_mail_info_'.$wpcc_id.'" style="display:none;"></div>'."\n";
			} else {
				$wpcc_mail_send_arr = wpcc_mail_send($wpcc_id,$_POST);
				if($wpcc_mail_send_arr['error'] != '' && $wpcc_mail_send_arr['error'] != '0') { $wpcc_mail_send = $wpcc_mail_send_arr['error']; } else { $wpcc_mail_send = $wpcc_mail_send_arr['success']; }
				$return .= '<div class="wpcc_mail_info wpcc_mail_info_'.$wpcc_id.'" '.(($_POST['wpcc_mail_send'] != '')?'style="display:block;"':'style="display:none";').' id="wpcc_mail_ancor_'.$wpcc_id.'">'.$wpcc_mail_send.'</div>'."\n";
			}
			if($wpcc_mail_send_arr['success'] == '') {
				$return .= '<div class="wpcc_mail wpcc_mail_'.$wpcc_id.'">'."\n";
				$return .='<form method="post" action="#wpcc_mail_ancor_'.$wpcc_id.'" class="wpcc_mail_form wpcc_mail_form_'.$wpcc_id.'">'."\n";
				//if($_SESSION['wpcc_'.$wpcc_id]['sum'] != '') { $return .='<div class="wpcc_mail_sum">'.get_option('wpcc_text_to_'.$wpcc_id).' '.$_SESSION['wpcc_'.$wpcc_id]['sum'].' '.get_option('wpcc_text_af_'.$wpcc_id).'</div>'."\n"; }
				$return .='<div class="wpcc_mail_sum">'.get_option('wpcc_text_to_'.$wpcc_id).' '.$wpcc_sum.' '.get_option('wpcc_text_af_'.$wpcc_id).'</div>'."\n";
				$return .='<div class="wpcc_mail_text">'.get_option('wpcc_mail_text_'.$wpcc_id).'</div>'."\n";
				if(get_option('wpcc_mail_firstname_'.$wpcc_id) != '') {
					$return .= '<div class="wpcc_mail_row"><b>'.get_option('wpcc_mail_firstname_'.$wpcc_id).'</b><input type="text" name="mail_author" class="wpcc_mail_author" value="'.(($wpcc_mail_send_arr['success'] == '')? wpcc_get_form($_POST['mail_author']) : '').'"></div>'."\n";
				}
				if(get_option('wpcc_mail_emailwho_'.$wpcc_id) != '') {
					$return .= '<div class="wpcc_mail_row"><b>'.get_option('wpcc_mail_emailwho_'.$wpcc_id).'</b><input type="text" name="mail_email" class="wpcc_mail_email" value="'.(($wpcc_mail_send_arr['success'] == '')? wpcc_get_form($_POST['mail_email']) : '').'"></div>'."\n";
				}
				if(get_option('wpcc_mail_phone_'.$wpcc_id) != '') {
					$return .= '<div class="wpcc_mail_row"><b>'.get_option('wpcc_mail_phone_'.$wpcc_id).'</b><input type="text" name="mail_phone" class="wpcc_mail_phone" value="'.(($wpcc_mail_send_arr['success'] == '')? wpcc_get_form($_POST['mail_phone']) : '').'"></div>'."\n";
				}
				if(get_option('wpcc_mail_comment_'.$wpcc_id) != '') {
					$return .= '<div class="wpcc_mail_row"><b>'.get_option('wpcc_mail_comment_'.$wpcc_id).'</b><textarea name="mail_text" class="wpcc_mail_textarea" maxlength="2500">'.(($wpcc_mail_send_arr['success'] == '')? wpcc_get_form($_POST['mail_text']) : '').'</textarea></div>'."\n";
				}
				$return .= '<input type="hidden" name="wpcc_mail_sum" value="'.$wpcc_sum.'">'."\n";
				$return .= '<input type="hidden" name="wpcc_mail_send_id" value="'.$wpcc_id.'">'."\n";
				if(get_option('wpcc_ajax_'.$wpcc_id) == '1') {
					$return .= '<input type="submit" name="wpcc_mail_send" class="wpcc_mail_send wpcc_mail_send_'.$wpcc_id.'" value="'.__("Send","wpcc").'" onclick="wpcc_ajax_mail('.$wpcc_id.'); return false;">'."\n";
				} else {
					$return .= '<input type="submit" name="wpcc_mail_send" class="wpcc_mail_send wpcc_mail_send_'.$wpcc_id.'" value="'.__("Send","wpcc").'">'."\n";
				}
				$return .= '</form>'."\n";
				$return .= '</div>'."\n";
			}
	} else {
		$return = false;
	}
	return $return;
}
/* json Russian letters */
function json_encode_cyr($str) {
	$arr_replace_utf = array('\u0410', '\u0430','\u0411','\u0431','\u0412','\u0432',
	'\u0413','\u0433','\u0414','\u0434','\u0415','\u0435','\u0401','\u0451','\u0416',
	'\u0436','\u0417','\u0437','\u0418','\u0438','\u0419','\u0439','\u041a','\u043a',
	'\u041b','\u043b','\u041c','\u043c','\u041d','\u043d','\u041e','\u043e','\u041f',
	'\u043f','\u0420','\u0440','\u0421','\u0441','\u0422','\u0442','\u0423','\u0443',
	'\u0424','\u0444','\u0425','\u0445','\u0426','\u0446','\u0427','\u0447','\u0428',
	'\u0448','\u0429','\u0449','\u042a','\u044a','\u042d','\u044b','\u042c','\u044c',
	'\u042d','\u044d','\u042e','\u044e','\u042f','\u044f');
	$arr_replace_cyr = array('А', 'а', 'Б', 'б', 'В', 'в', 'Г', 'г', 'Д', 'д', 'Е', 'е',
	'Ё', 'ё', 'Ж','ж','З','з','И','и','Й','й','К','к','Л','л','М','м','Н','н','О','о',
	'П','п','Р','р','С','с','Т','т','У','у','Ф','ф','Х','х','Ц','ц','Ч','ч','Ш','ш',
	'Щ','щ','Ъ','ъ','Ы','ы','Ь','ь','Э','э','Ю','ю','Я','я');
	$json_encode = json_encode($str);
	$str_replace = str_replace($arr_replace_utf,$arr_replace_cyr,$json_encode);
	return $str_replace;
}
/* WPCC Send Mail */
function wpcc_mail_send($wpcc_id, $POST='') {
	if(!empty($POST['wpcc_mail_send_id']) && get_option('wpcc_mail_check_'.$wpcc_id)) {
		$wpcc_mail_sum = $POST['wpcc_mail_sum'];
		
		if(get_option('wpcc_mail_firstname_'.$wpcc_id) != '') {
			$mail_author = $POST['mail_author'];
			if ($mail_author == '') {
				$return['error'] .= get_option('wpcc_mail_error_author_none_'.$wpcc_id).'<br>'; // zzzzz
			} elseif (mb_strlen($first_name) > 100) {
				$return['error'] .= get_option('wpcc_mail_error_author_max_'.$wpcc_id)."<br>";
			}
		} else {
			$mail_author = __("Anonym", "wpcc");
		}
		
		if(get_option('wpcc_mail_emailwho_'.$wpcc_id) != '') {
			$mail_email = $POST['mail_email'];
			if ($mail_email == '') { 
				$return['error'] .= get_option('wpcc_mail_error_email_none_'.$wpcc_id).'<br>'; 
			} elseif (!preg_match("/^[-0-9a-z_\.]+@[-0-9a-z_^\.]+\.[-0-9a-z_]{2,6}$/i", $mail_email)) { 
				$return['error'] .= get_option('wpcc_mail_error_email_err_'.$wpcc_id).'<br>'; 
			}
		} else {
			$mail_email = get_option('admin_email');
		}
		
		if(get_option('wpcc_mail_phone_'.$wpcc_id) != '') {
			$mail_phone = $POST['mail_phone'];
			if (!preg_match ('/^[0-9-+\s()]+$/', $mail_phone) && $mail_phone != '') {
				$return['error'] .= get_option('wpcc_mail_error_email_err_'.$wpcc_id)."<br>";
			} elseif (mb_strlen($mail_phone) > 35) {
				$return['error'] .= get_option('wpcc_mail_error_phone_max_'.$wpcc_id)."<br>";
			}
		} else {
			$mail_phone = '...';
		}
				
		if(get_option('wpcc_mail_comment_'.$wpcc_id)) {
			$mail_text = htmlspecialchars($POST['mail_text']);
			if (mb_strlen($mail_text) > 2500) {
				$return['error'] .= get_option('wpcc_mail_error_text_'.$wpcc_id)."<br>";
			}
		} else {
			$mail_text = '...';
		}
		
		if(get_option('wpcc_mail_subject_'.$wpcc_id) != '') { 
			$mail_subject = get_option('wpcc_mail_subject_'.$wpcc_id). __(' from ', 'wpcc') .$mail_author;
		} else {
			$mail_subject = __('Calculating the cost of ', 'wpcc').$mail_author;
		}
		
		$mail_body = get_option('wpcc_mail_text_adm_'.$wpcc_id).'<hr>';
		if(get_option('wpcc_mail_firstname_'.$wpcc_id) != '') {
			$mail_body .= get_option('wpcc_mail_firstname_'.$wpcc_id).': '.$mail_author.'<br>';
		}
		if(get_option('wpcc_mail_emailwho_'.$wpcc_id) != '') {
			$mail_body .= get_option('wpcc_mail_emailwho_'.$wpcc_id).': '.$mail_email.'<br>';
		}
		if(get_option('wpcc_mail_phone_'.$wpcc_id) != '') {
			$mail_body .= get_option('wpcc_mail_phone_'.$wpcc_id).': '.$mail_phone.'<br>';
		}
		if(get_option('wpcc_mail_comment_'.$wpcc_id)) {
			$mail_body .= get_option('wpcc_mail_comment_'.$wpcc_id).': '.$mail_text.'<br>';
		}
		$mail_body .= get_option('wpcc_text_to_'.$wpcc_id).' '.$wpcc_mail_sum.' '.get_option('wpcc_text_af_'.$wpcc_id).'<br><hr>';
		$mail_body .= __("Calculating from the site:","wpcc").' <a href="'.get_option('siteurl').'" target="_blank">'.get_option('blogname').'</a><br>';

		if($return == '') {
			//add_filter('wp_mail_content_type',create_function('', 'return "text/html";'));
			$mail_headers  = 'From: '.$mail_author.' <'.$mail_email.'>'."\r\n"; 
			$mail_headers .= 'Content-Type: text/html'."\r\n";
			
			wp_mail( get_option('wpcc_mail_emailto_'.$wpcc_id), $mail_subject, $mail_body, $mail_headers );
			
			$return['error'] = '0';
			$return['success'] = get_option('wpcc_mail_text_success_'.$wpcc_id);
		}
		
		if(get_option('wpcc_ajax_'.$wpcc_id) == '1') {
			return json_encode_cyr($return);
		} else {
			return $return;
		}
	} else {
		return false;
	}
}
/* WPCC Parser Array Value */
function wpcc_parsing_post($wpcc_id, $post='') {
	global $wpdb;
	if(!empty($post)) {
	
		$wpcc_id = intval($wpcc_id);
		if($wpcc_id == '0' && $post['wpcc_this_id'] != '') {
			$wpcc_id = intval($post['wpcc_this_id']);
		}
		
		if(get_option('wpcc_stars_session') == '1') {
			unset($_SESSION['wpcc_'.$wpcc_id]); 
			//session_destroy();
		}
		
/* For all data */
		$wpcc_structure				= $_POST['wpcc_structure'];
		$wpcc_structure_id			= $_POST['wpcc_structure_id'];
		$wpcc_structure_id_arr		= explode(',', $wpcc_structure_id);
				
		/* Form the array */
		if(!empty($wpcc_structure)) {
			foreach ($wpcc_structure as $k => $v) {
				$wpcc_query = $wpdb->get_row("SELECT `wpcc_id`, `wpcc_to`, `wpcc_af`, `wpcc_value`, `wpcc_order` FROM `wp_wpcc` WHERE `wpcc_id` = '$k' AND `wpcc_cat` = '$wpcc_id'"); // Условие с номером калькулятора
				
				$v = trim($v);
				$v = preg_replace('/[^0-9,.]/', '', $v);
				$v = str_replace(',','.', $v);
				
				if($v == '') {
					$return[$wpcc_query->wpcc_order] .= $wpcc_query->wpcc_to.$wpcc_query->wpcc_value.$wpcc_query->wpcc_af;
					$_SESSION['wpcc_'.$wpcc_id][$wpcc_query->wpcc_id] = $wpcc_query->wpcc_value;
				} else {
					$return[$wpcc_query->wpcc_order] .= $wpcc_query->wpcc_to.$v.$wpcc_query->wpcc_af;
					$_SESSION['wpcc_'.$wpcc_id][$wpcc_query->wpcc_id] = $v;
				}
				$wpcc_array_diff[] = $k;
			}
			
			/* We are looking for missing or empty values​​, differences in the array */
			$wpcc_array_diff_full = array_diff($wpcc_structure_id_arr, $wpcc_array_diff);
			
			if(!empty($wpcc_array_diff_full)) {
				foreach($wpcc_array_diff_full as $array_diff_v) {
					$wpcc_query = $wpdb->get_row("SELECT `wpcc_id`, `wpcc_to`, `wpcc_af`, `wpcc_value`, `wpcc_order` FROM `wp_wpcc` WHERE `wpcc_id` = '$array_diff_v'"); // Условие с номером калькулятора
					$return[$wpcc_query->wpcc_order] .= $wpcc_query->wpcc_to.$wpcc_query->wpcc_value.$wpcc_query->wpcc_af;
					$_SESSION['wpcc_'.$wpcc_id][$wpcc_query->wpcc_id] = $wpcc_query->wpcc_value;
				}
			}
		}
		
/* For the input field */
		$wpcc_structure_inputtext 	= $_POST['wpcc_structure_inputtext'];
		if(!empty($wpcc_structure_inputtext)) {
			/* Form the array */
			foreach ($wpcc_structure_inputtext as $k => $v) {
				$wpcc_query = $wpdb->get_row("SELECT `wpcc_id`, `wpcc_to`, `wpcc_af`, `wpcc_value`, `wpcc_text`, `wpcc_price`, `wpcc_order` FROM `wp_wpcc` WHERE `wpcc_id` = '$k' AND `wpcc_cat` = '$wpcc_id'"); // Условие с номером калькулятора
				
				$v = trim($v);
				$v = preg_replace('/[^0-9,.]/', '', $v);
				$v = str_replace(',','.', $v);
				
				if($v == '') {
					$return[$wpcc_query->wpcc_order] .= $wpcc_query->wpcc_to.'('.$wpcc_query->wpcc_value.$wpcc_query->wpcc_text.$wpcc_query->wpcc_price.')'.$wpcc_query->wpcc_af;
					eval ('$inputtext_eval = '.$wpcc_query->wpcc_value.$wpcc_query->wpcc_text.$wpcc_query->wpcc_price.';');
					$_SESSION['wpcc_'.$wpcc_id][$wpcc_query->wpcc_id] = $wpcc_query->wpcc_value;
					$_SESSION['wpcc_'.$wpcc_id][$wpcc_query->wpcc_id.'_sum'] = $inputtext_eval;
				} else {
					$return[$wpcc_query->wpcc_order] .= $wpcc_query->wpcc_to.'('.$v.$wpcc_query->wpcc_text.$wpcc_query->wpcc_price.')'.$wpcc_query->wpcc_af;
					eval ('$inputtext_eval = '.$v.$wpcc_query->wpcc_text.$wpcc_query->wpcc_price.';');;
					$_SESSION['wpcc_'.$wpcc_id][$wpcc_query->wpcc_id] = $v;
					$_SESSION['wpcc_'.$wpcc_id][$wpcc_query->wpcc_id.'_sum'] = $inputtext_eval;
				}
			}
		}
/* Sort an array by key */
		if(!empty($return)) { ksort($return); }
		return $return;
	} else {
		return false;
	}
}

/* If Action next page, write Session */
function wpcc_parsing_post_session() {
	if(get_option('wpcc_stars_session') == '1') {
		wpcc_parsing_post('0', $_POST);
	}
}
add_action('init', 'wpcc_parsing_post_session');

/* WPCC ShortCode */
function wpcc_shortcode($atts) {
	global $wpdb, $WPCC_PLUGIN_URL;
	extract(shortcode_atts(array('id' => "1", 'moderator' => "false"), $atts));
	
	$wpcc_id = intval($id);
	
	$wpcc_action = get_option('wpcc_action_'.$wpcc_id);
	if(get_option('wpcc_submit_'.$wpcc_id)) { $wpcc_submit = get_option('wpcc_submit_'.$wpcc_id); } else { $wpcc_submit = 'Расчитать'; }
	
	$res = $wpdb->get_results("SELECT * FROM wp_wpcc WHERE `wpcc_cat` = '$wpcc_id' ORDER BY `wpcc_order`");

	if (count($res) == 0){
		$return .= __("Formula is empty", "wpcc")."<br>"; 
	} else {
		$return .= '<link rel="stylesheet" href="'.get_option('wpcc_theme_'.$wpcc_id).'" type="text/css" media="screen" />';
		$return .= "\n".'<div class="wpcc wpcc_'.$wpcc_id.'">'."\n";
		$return .= '<form method="POST" action="'.$wpcc_action.'" class="wpcc_form wpcc_form_'.$wpcc_id.'">'."\n";

		foreach ($res as $row) {

			if ($row->wpcc_type == "textblock") {
				$return .= '<div class="wpcc_description wpcc_description_'.$row->wpcc_id.'">'.$row->wpcc_name.'</div>'."\n";
				$return .= '<div class="wpcc_text wpcc_text_'.$row->wpcc_id.'">';
				$return .= preg_replace("|\[session id=\"(.*)\"\](.*)\[/session\]|e", "\$_SESSION['wpcc_\\1']['\\2']", $row->wpcc_text);
				$return .= "</div>\n";
			}

			if ($row->wpcc_type == "select") {
				$return .= '<div class="wpcc_description wpcc_description_'.$row->wpcc_id.'">'.$row->wpcc_name.'</div>'."\n";
				$return .= '<select name="wpcc_structure['.$row->wpcc_id.']" class="wpcc_select wpcc_select_'.$row->wpcc_id.'">'."\n";
				if($row->wpcc_text != '') {
					$select_arr = explode(';', $row->wpcc_text);
					$select_arr_count = count($select_arr);
					$select_count = '0';
					foreach ($select_arr as $select_row) {
					$select_count++;
							/* a Value */
							preg_match_all('#\[(.*?)\]#is', $select_row, $select_price_result, PREG_PATTERN_ORDER);
							$select_price = $select_price_result[1][0];
						if($select_arr_count != $select_count) {  /* a temporary solution */
							$select_row = $select_row.';';
						}
						$return .= str_replace(array('[',']:',';'), array('<option value="','"'.((get_option('wpcc_ltd_'.$wpcc_id) == '1' && $select_price == $_POST['wpcc_structure'][$row->wpcc_id])?' selected':'').'>',"</option>"), $select_row);
					}
				}
				/* $return .= str_replace(array('[',']:',';'), array('<option value="','">',"</option>\n"), $row->wpcc_text); */
				$return .= "\n</select>\n";
			}

			if ($row->wpcc_type == "checkbox") {
				$return .= '<div class="wpcc_description wpcc_description_'.$row->wpcc_id.'">'.$row->wpcc_name.'</div>'."\n";
				$return .= '<input type="checkbox" name="wpcc_structure['.$row->wpcc_id.']" value="'.$row->wpcc_price.'" class="wpcc_checkbox wpcc_checkbox_'.$row->wpcc_id.'" '.((get_option('wpcc_ltd_'.$wpcc_id)=='1' && $row->wpcc_price == $_POST['wpcc_structure'][$row->wpcc_id])?'checked':'').'>'."\n";
			}

			if ($row->wpcc_type == "radio") {
				$radio_i = '1';
				$return .= '<div class="wpcc_description wpcc_description_'.$row->wpcc_id.'">'.$row->wpcc_name.'</div>'."\n";
				if($row->wpcc_text != '') {
					$radio_arr = explode(';', $row->wpcc_text);
					$radio_arr_count = count($radio_arr);
					$radio_count = '1';
					$radio_count_point = '0';
					foreach ($radio_arr as $radio_row) {
						$radio_count_point++;
							/* a Value */
							preg_match_all('#\[(.*?)\]#is', $radio_row, $radio_price_result, PREG_PATTERN_ORDER);
							$radio_price = $radio_price_result[1][0];
						if($radio_arr_count != $radio_count_point) { /* a temporary solution */
							$radio_row = $radio_row.';';
						}
							/* Checked */
							if(get_option('wpcc_ltd_'.$wpcc_id) == '1' && $radio_price == $_POST['wpcc_structure'][$row->wpcc_id]) {
								$radio_checked = 'checked';
							} elseif($_POST['wpcc_structure'][$row->wpcc_id] == '' && $radio_count == '1') {
								$radio_checked = 'checked';
							}  elseif($_POST['wpcc_structure'][$row->wpcc_id] != '' && get_option('wpcc_ltd_'.$wpcc_id) == '2' && $radio_count == '1') {
								$radio_checked = 'checked';
							} else { $radio_checked = ''; }
						
						$return .= str_replace(array('[',']:',';'), array('<label class="wpcc_radio wpcc_radio_'.$row->wpcc_id.'"><input type="radio" name="wpcc_structure['.$row->wpcc_id.']" value="','" '.$radio_checked.'> ',"</label>"), $radio_row);
						$radio_count++;
					}
				}
				$return .= "\n";
			}
			
			if ($row->wpcc_type == "inputtext") {
				/* onkeyup="wpcc_jq_keyup('.$row->wpcc_id.')" */
				$return .= '<div class="wpcc_description wpcc_description_'.$row->wpcc_id.'">'.$row->wpcc_name.'</div>'."\n";
				$return .= '<input type="text" name="wpcc_structure_inputtext['.$row->wpcc_id.']" value="'.((get_option('wpcc_ltd_'.$wpcc_id)=='1' && $_POST['wpcc_structure_inputtext'][$row->wpcc_id] != '')?wpcc_get_form($_POST['wpcc_structure_inputtext'][$row->wpcc_id]):'').'" class="wpcc_inputtext wpcc_inputtext_'.$row->wpcc_id.'" id="wpcc_jq_'.$row->wpcc_id.'">'."\n";
			}
			
			if ($row->wpcc_type == "hidden") {
				$return .= '<input type="hidden" name="wpcc_structure['.$row->wpcc_id.']" value="'.$row->wpcc_price.'" >'."\n";	
			}
			
			if ($row->wpcc_type == "session") {
				$wpcc_session = $_SESSION['wpcc_'.$row->wpcc_sess_id][$row->wpcc_sess_res];
				if ($wpcc_session != ''){
					$return .= '<input type="hidden" name="wpcc_structure['.$row->wpcc_id.']" value="'.$wpcc_session.'" >'."\n";	
				} else {
					$return .= '<input type="hidden" name="wpcc_structure['.$row->wpcc_id.']" value="'.$row->wpcc_value.'" >'."\n";	
				}
			}
			
			if ($row->wpcc_type == "jquery") {
				$return .= '<script>jQuery(document).ready(function( $ ) { $("#wpcc_jq_'.$row->wpcc_jq_id.'").keyup(function(){ $("#wpcc_jq_get_'.$row->wpcc_id.'").val($(this).val()); }); });</script>'."\n";
				$return .= '<input type="hidden" id="wpcc_jq_get_'.$row->wpcc_id.'" name="wpcc_structure['.$row->wpcc_id.']" value="">'."\n";	
			}
			
			if ($row->wpcc_type != "textblock" && $row->wpcc_type != "inputtext") { 
				$wpcc_structure_id .= $row->wpcc_id.',';
			}
		}
		$wpcc_structure_id = mb_substr($wpcc_structure_id, 0, -1);
		$return .= '<input type="hidden" name="wpcc_structure_id" value="'.$wpcc_structure_id.'">'."\n";
		$return .= '<input type="hidden" name="wpcc_this_id" value="'.$wpcc_id.'">'."\n";
		if(get_option('wpcc_ajax_'.$wpcc_id) == '1') {
			$return .= '<input type="hidden" name="wpcc_form_id" id="wpcc_form_id" value="'.$wpcc_id.'">'."\n";
			$return .= '<input type="hidden" name="wpcc_form_url" id="wpcc_form_url" value="'.$WPCC_PLUGIN_URL.'">'."\n";
			$return .= '<input type="submit" value="'.$wpcc_submit.'" name="wpcc_calculate" class="wpcc_submit wpcc_submit_'.$wpcc_id.'" onclick="wpcc_ajax_calculate('.$wpcc_id.'); return false;">'."\n";
		} else {
			$return .= '<input type="submit" value="'.$wpcc_submit.'" name="wpcc_calculate" class="wpcc_submit wpcc_submit_'.$wpcc_id.'">'."\n";
		}
		$return .= "</form> \n";
	}
	$return .= '<div class="wpcc_result_block wpcc_result_block_'.$wpcc_id.'">';
	
	if ($_POST['wpcc_calculate'] != '') {
		$return .= '<div class="wpcc_result wpcc_result_'.$wpcc_id.'">';
		$wpcc_parsing_post = wpcc_parsing_post($wpcc_id, $_POST);
		if(!empty($wpcc_parsing_post)) {
			foreach($wpcc_parsing_post as $eval_row) {
				$eval_return .= $eval_row;
			}
		} else {
			$eval_return = '0';
		}
		
		$return .= get_option('wpcc_text_to_'.$wpcc_id).' ';
			eval('$return .= '.$eval_return.'; $wpcc_sum = '.$eval_return.';');
			$_SESSION['wpcc_'.$wpcc_id]['sum'] = $wpcc_sum;
		$return .= ' '.get_option('wpcc_text_af_'.$wpcc_id).'';
		
		if ($moderator == 'true') {
			echo '<h3>$_SESSION:</h3>';
			echo '<pre>';
			print_r($_SESSION);
			echo '</pre>';
			echo '<h3>ksort(array()):</h3>';
			echo '<pre>';
			print_r($wpcc_parsing_post);
			echo '</pre>';
			echo '<hr>';
		}
		$return .= '</div>'."\n";
	}
	
	if ($_POST['wpcc_calculate'] != '' || $_POST['wpcc_mail_send'] != '') {
		if(get_option('wpcc_mail_check_'.$wpcc_id) == '1') {
			$return .= wpcc_mail_form($wpcc_sum, $wpcc_id);
		}
	}
	
	$return .='</div>'."\n";
	$return .='</div>'."\n";
return $return;
}
add_shortcode('wpcc', 'wpcc_shortcode');

/* wpcc Setting */
function wpcc_setting() {
	global $wpdb, $WPCC_PLUGIN_URL;
	
	$wpcc_id = intval($_GET['wpcc_id']);
		
/* Add new calculator */
if($_POST['wpcc_new'] != '') {
	
	$wpcc_name = wpcc_sql_query($_POST['wpcc_name']);
	if($wpcc_name == '') {
		$result .= '<p><strong>'.__("You forgot to enter the name of the calculator", "wpcc").'</strong></p>';
	} elseif (!preg_match ("/^[a-zA-Zа-яА-Я0-9\s-]+$/u", $wpcc_name)) {
		$result .= '<p><strong>'.__("The name of the calculator can be used only: English characters, Russian characters, spaces and dashes", "wpcc").'</strong></p>';
	} else {
		$wpcc_new = $wpdb->query("INSERT INTO `wp_wpcc` (`wpcc_name`) VALUES('$wpcc_name')");
		$wpcc_new_id = $wpdb->insert_id;
		/* Setting Calc*/
		update_option( 'wpcc_submit_'.$wpcc_new_id, __("Calculate", "wpcc") );
		update_option( 'wpcc_text_to_'.$wpcc_new_id, __("The result: ", "wpcc") );
		update_option( 'wpcc_text_af_'.$wpcc_new_id, __(" $", "wpcc") );
		update_option( 'wpcc_ajax_'.$wpcc_new_id, '2' );
		update_option( 'wpcc_action_'.$wpcc_new_id, '' );
		update_option( 'wpcc_ltd_'.$wpcc_new_id, '1' );
		update_option( 'wpcc_connect_jquery', '1' );
		update_option( 'wpcc_stars_session', '1' );
		/* Setting Mail */
		update_option( 'wpcc_mail_check_'.$wpcc_new_id, '2' );
		update_option( 'wpcc_mail_subject_'.$wpcc_new_id, __("Calculation", "wpcc") );
		update_option( 'wpcc_mail_text_adm_'.$wpcc_new_id, __("The calculation of the value of the site, information about the user:", "wpcc") );
		update_option( 'wpcc_mail_text_success_'.$wpcc_new_id, __("Thank you! Your account sent! The site administration will contact you shortly.", "wpcc") );
		update_option( 'wpcc_mail_text_'.$wpcc_new_id, __("Send an application administrator?", "wpcc") );
		update_option( 'wpcc_mail_emailto_'.$wpcc_new_id, get_option('admin_email') );
		update_option( 'wpcc_mail_firstname_'.$wpcc_new_id, __("Your Name and Surname", "wpcc") );
		update_option( 'wpcc_mail_emailwho_'.$wpcc_new_id, __("Your E-Mail", "wpcc") );
		update_option( 'wpcc_mail_phone_'.$wpcc_new_id, __("Your Phone", "wpcc") );
		update_option( 'wpcc_mail_comment_'.$wpcc_new_id, __("Your comment", "wpcc") );
		/* Theme */
		update_option( 'wpcc_theme_'.$wpcc_new_id, $WPCC_PLUGIN_URL.'theme/mini/style.css' );
		/* Mail msg */
		update_option( 'wpcc_mail_error_author_none_'.$wpcc_new_id, __("You forgot to enter the First Name Last Name", "wpcc") );
		update_option( 'wpcc_mail_error_author_max_'.$wpcc_new_id, __("Too long name and surname! No more than 100 characters", "wpcc") );
		update_option( 'wpcc_mail_error_email_none_'.$wpcc_new_id, __("Did you forget to include your E-Mail", "wpcc") );
		update_option( 'wpcc_mail_error_email_err_'.$wpcc_new_id, __("Incorrectly Set E-Mail. Example email: admin@zetrider.ru", "wpcc") );
		update_option( 'wpcc_mail_error_phone_err_'.$wpcc_new_id, __("Erroneously listed phone number, you can use numbers, spaces, dashes and brackets", "wpcc") );
		update_option( 'wpcc_mail_error_phone_max_'.$wpcc_new_id, __("Phone is too long! No more than 35 characters.", "wpcc") );
		update_option( 'wpcc_mail_error_text_'.$wpcc_new_id, __("Message is too long, not more than 2500 characters!", "wpcc") );
		
		$result = '<p><strong>'.__("Calculator has been successfully created", "wpcc").', <a href="admin.php?page=wpcc&wpcc_id='.$wpcc_new_id.'">'.__("proceed to fill the", "wpcc").'</a>.</strong></p>';
	}
}
/* Add new row */
if($_POST['wpcc_add'] != '' || $_POST['wpcc_update'] != '') {
	
	$wpcc_cat = $wpcc_id;
	$wpcc_name = $_POST['wpcc_name'];
	$wpcc_type = $_POST['wpcc_type'];
	$wpcc_to = $_POST['wpcc_to'];
	$wpcc_af = $_POST['wpcc_af'];
	
	$wpcc_price = $_POST['wpcc_price'];
	$wpcc_price = trim($wpcc_price);
	$wpcc_price = str_replace(',', '.', $wpcc_price);
	
	$wpcc_value = $_POST['wpcc_value'];
	$wpcc_text = $_POST['wpcc_text'];
	
	$wpcc_sess_id = intval($_POST['wpcc_sess_id']);
	$wpcc_sess_res = $_POST['wpcc_sess_res'];
	$wpcc_jq_id = $_POST['wpcc_jq_id'];
	
	$wpcc_order_row = $wpdb->get_row("SELECT `wpcc_order` FROM `wp_wpcc` ORDER BY `wpcc_order` DESC LIMIT 1");
	if (count($wpcc_order_row) == '0') { $wpcc_order = "1"; } else { $wpcc_order = $wpcc_order_row->wpcc_order + 1; }
	
	if($_POST['wpcc_add'] != '') {
		$wpcc_add = $wpdb->query("
		INSERT INTO `wp_wpcc` 
		(`wpcc_cat`, `wpcc_name`, `wpcc_type`, `wpcc_to`, `wpcc_af`, `wpcc_price`, `wpcc_value`, `wpcc_text`, `wpcc_sess_id`, `wpcc_sess_res`, `wpcc_jq_id`, `wpcc_order`) 
		VALUES ('$wpcc_cat', '$wpcc_name', '$wpcc_type', '$wpcc_to', '$wpcc_af', '$wpcc_price', '$wpcc_value', '$wpcc_text', '$wpcc_sess_id', '$wpcc_sess_res', '$wpcc_jq_id', '$wpcc_order')
		");
	}
	if($_POST['wpcc_update'] != '') {
		$wpcc_row_id = intval($_POST['wpcc_row_id']);
		$wpcc_update = $wpdb->query("UPDATE `wp_wpcc` SET `wpcc_name` = '$wpcc_name', `wpcc_to` = '$wpcc_to', `wpcc_af` = '$wpcc_af', `wpcc_price` = '$wpcc_price', `wpcc_value` = '$wpcc_value', `wpcc_text` = '$wpcc_text', `wpcc_sess_id` = '$wpcc_sess_id', `wpcc_jq_id` = '$wpcc_jq_id' WHERE `wpcc_id` = '$wpcc_row_id'");
	}

}

/* Del Calc */
if($_POST['wpcc_del'] != '') {
	/* Del Row db_WPCC */
	$wpcc_delete = $wpdb->query("DELETE FROM `wp_wpcc` WHERE `wpcc_id` = '$wpcc_id' OR `wpcc_cat` = '$wpcc_id'");
	/* Del Setting Calc */
	$delete_option_arr = array('wpcc_submit_'.$wpcc_id,'wpcc_text_to_'.$wpcc_id,'wpcc_text_af_'.$wpcc_id,'wpcc_ajax_'.$wpcc_id,'wpcc_action_'.$wpcc_id,'wpcc_ltd_'.$wpcc_id,'wpcc_mail_check_'.$wpcc_id,'wpcc_mail_subject_'.$wpcc_id,'wpcc_mail_text_adm_'.$wpcc_id,'wpcc_mail_text_success_'.$wpcc_id,'wpcc_mail_text_'.$wpcc_id,'wpcc_mail_emailto_'.$wpcc_id,'wpcc_mail_firstname_'.$wpcc_id,'wpcc_mail_emailwho_'.$wpcc_id,'wpcc_mail_phone_'.$wpcc_id,'wpcc_mail_comment_'.$wpcc_id,'wpcc_theme_'.$wpcc_id,'wpcc_mail_error_author_none_'.$wpcc_id,'wpcc_mail_error_author_max_'.$wpcc_id,'wpcc_mail_error_email_none_'.$wpcc_id,'wpcc_mail_error_email_err_'.$wpcc_id,'wpcc_mail_error_phone_err_'.$wpcc_id,'wpcc_mail_error_phone_max_'.$wpcc_id,'wpcc_mail_error_text_'.$wpcc_id);
	foreach ($delete_option_arr as $delete_option) {
		delete_option($delete_option);
	}
}
/* Del Row */
if($_POST['wpcc_delete'] != '') {
	$wpcc_row_id = intval($_POST['wpcc_row_id']);
	$wpcc_delete = $wpdb->query("DELETE FROM `wp_wpcc` WHERE `wpcc_id` = '$wpcc_row_id'");
}
/* wpcc convert name row */
function wpcc_name_row($wpcc_name) {
	if($wpcc_name == 'textblock') {
		return __("Text block", "wpcc");
	} elseif($wpcc_name == 'select') {
		return __("Select list", "wpcc");	
	} elseif($wpcc_name == 'checkbox') {
		return __("Checkbox", "wpcc");	
	} elseif($wpcc_name == 'radio') {
		return __("Radio Button", "wpcc");	
	} elseif($wpcc_name == 'inputtext') {
		return __("Input field text", "wpcc");	
	} elseif($wpcc_name == 'hidden') {
		return __("Hidden field", "wpcc");	
	} elseif($wpcc_name == 'session') {
		return '$_SESSION';	
	} elseif($wpcc_name == 'jquery') {
		return 'JQuery';	
	} else {
		return '...';	
	}
}
/* wpcc row add and edit */
function wpcc_row_field($type, $id='') {
	global $wpdb;
	if($type == 'textblock') {
		$field_arr = array('1', '7');
	} elseif($type == 'select') {
		$field_arr = array('1', '2', '3', '8');
	} elseif($type == 'checkbox') {
		$field_arr = array('1', '2', '3', '4', '5');
	} elseif($type == 'radio') {
		$field_arr = array('1', '2', '3', '8');
	} elseif($type == 'inputtext') {
		$field_arr = array('1', '2', '3', '4', '5', '6');
	} elseif($type == 'hidden') {
		$field_arr = array('2', '3', '5');
	} elseif($type == 'session') {
		$field_arr = array('2', '3', '4', '9', '10');
	} elseif($type == 'jquery') {
		$field_arr = array('2', '3', '4', '11');
	}
	
	$id = intval($id);
	if($id != '0') {
		$wpcc_res = $wpdb->get_row("SELECT * FROM `wp_wpcc` WHERE `wpcc_id` = '$id'");
	} else {
		$wpcc_res = new stdClass();
		$wpcc_res->wpcc_name = '';
		$wpcc_res->wpcc_to = '';
		$wpcc_res->wpcc_af = '';
		$wpcc_res->wpcc_price = '';
		$wpcc_res->wpcc_value = '';
		$wpcc_res->wpcc_text = '';
		$wpcc_res->wpcc_sess_id = '';
		$wpcc_res->wpcc_sess_res = '';
		$wpcc_res->wpcc_jq_id = '';
	}

	foreach ($wpcc_res as $wpcc_row) {
		$field['1'] = '<b class="wpcc_strong">'.__("Title", "wpcc").':</b> <input type="text" name="wpcc_name" maxlength="255" class="wpcc_input" value="'.$wpcc_res->wpcc_name.'"><br>';
		$field['2'] = '<b class="wpcc_strong">'.__("Sign to", "wpcc").':</b> <input type="text" name="wpcc_to" maxlength="5" class="wpcc_input" value="'.$wpcc_res->wpcc_to.'"><br>';
		$field['3'] = '<b class="wpcc_strong">'.__("Sign after", "wpcc").':</b> <input type="text" name="wpcc_af" maxlength="5" class="wpcc_input" value="'.$wpcc_res->wpcc_af.'"><br>';
		$field['4'] = '<b class="wpcc_strong">'.__("Default value", "wpcc").':</b> <input type="text" name="wpcc_value" maxlength="255" class="wpcc_input" value="'.$wpcc_res->wpcc_value.'"><br>';
		$field['5'] = '<b class="wpcc_strong">'.__("Price field", "wpcc").':</b> <input type="text" name="wpcc_price" maxlength="255" class="wpcc_input" value="'.$wpcc_res->wpcc_price.'"><br>';
		$field['6'] = '<b class="wpcc_strong">'.__("Action", "wpcc").':</b> <input type="text" name="wpcc_text" maxlength="255" class="wpcc_input" value="'.$wpcc_res->wpcc_text.'"><br>';
		$field['7'] = '<b class="wpcc_strong">'.__("Text", "wpcc").':</b> <textarea name="wpcc_text" maxlength="65535" class="wpcc_textarea">'.wpcc_get_form($wpcc_res->wpcc_text).'</textarea><br>';
		$field['8'] = '<b class="wpcc_strong">'.__("List", "wpcc").':<br> [100]:title;<br>[200]:title;</b> <textarea name="wpcc_text" maxlength="65535" class="wpcc_textarea">'.wpcc_get_form($wpcc_res->wpcc_text).'</textarea><br>';
		$field['9'] = '<b class="wpcc_strong">'.__("ID Calculator", "wpcc").':</b> <input type="text" name="wpcc_sess_id" maxlength="255" class="wpcc_input" value="'.$wpcc_res->wpcc_sess_id.'"><br>';
		$field['10'] = '<b class="wpcc_strong">'.__("ID field or the sum", "wpcc").':</b> <input type="text" name="wpcc_sess_res" maxlength="255" class="wpcc_input" value="'.$wpcc_res->wpcc_sess_res.'"><br>';
		$field['11'] = '<b class="wpcc_strong">'.__("ID field", "wpcc").':</b> <input type="text" name="wpcc_jq_id" maxlength="255" class="wpcc_input" value="'.$wpcc_res->wpcc_jq_id.'"><br>';
	}
	
	foreach ($field_arr as $field_row) {
		$return .= $field[$field_row];
	}
	return $return;
}
?>
<div class="wrap wpcc_wrap">
<?php echo wpcc_old_version(); ?>
<noscript><?php _e("Your browser does not support JavaScript, plug-in will not work correctly.", "wpcc"); ?><hr style="clear:both;"></noscript>
<input type="hidden" name="PLUGIN_URL" id="PLUGIN_URL" value="<?php echo $WPCC_PLUGIN_URL; ?>">
<input type="hidden" name="WPCC_ID_CAT" id="WPCC_ID_CAT" value="<?php echo $wpcc_id; ?>">

	<h2 style="float:left;">WPCC</h2>
	
	<form class="wpcc_menu">
		<select size="1" name="wpcc_menu" onchange="self.location.href=this.form.wpcc_menu.options[this.form.wpcc_menu.selectedIndex].value;">
			<option value="admin.php?page=wpcc"><?php _e("Select the calculator", "wpcc"); ?></option>
			<option value="admin.php?page=wpcc&action=new" <?php if($_GET['action'] == 'new') { echo 'selected'; } ?>><?php _e("Add a new calculator", "wpcc"); ?></option>
			<?php
			$wpcc_menu = $wpdb->get_results("SELECT `wpcc_id`, `wpcc_name` FROM `wp_wpcc` WHERE `wpcc_cat` = '0' ORDER BY `wpcc_name`");
			if(count($wpcc_menu) != 0)  {
				foreach ($wpcc_menu as $wpcc_menu_row) {
					echo '<option value="admin.php?page=wpcc&wpcc_id='.$wpcc_menu_row->wpcc_id.'" '.(($wpcc_menu_row->wpcc_id == $wpcc_id)?'selected':'').' >[ID-'.$wpcc_menu_row->wpcc_id.'] '.$wpcc_menu_row->wpcc_name.'</option>';
				}
			}
			?>
		</select>
	</form>
	<?php if($_GET['wpcc_id'] != '' && wpcc_check_id($wpcc_id) == true) { ?>
	<form class="wpcc_menu">
		<select id="wpcc_nav">
			<option value="wpcc_main"><?php _e("Calculator Menu", "wpcc"); ?></option>
			<option value="wpcc_textblock"><?php _e("Add a Text Block", "wpcc"); ?></option>
			<option value="wpcc_select"><?php _e("Add a Select List", "wpcc"); ?></option>
			<option value="wpcc_checkbox"><?php _e("Add Checkbox", "wpcc"); ?></option>
			<option value="wpcc_radio"><?php _e("Add a Radio Button", "wpcc"); ?></option>
			<option value="wpcc_inputtext"><?php _e("Add a Input field text", "wpcc"); ?></option>
			<option value="wpcc_hidden"><?php _e("Add a Hidden field", "wpcc"); ?></option>
			<option value="wpcc_session"><?php _e('Add a $_SESSION field', 'wpcc'); ?></option>
			<option value="wpcc_jquery"><?php _e("Add d jQuery field", "wpcc"); ?></option>
			<option value="wpcc_design"><?php _e("Customize Design", "wpcc"); ?></option>
			<option value="wpcc_mail"><?php _e("Options Mail", "wpcc"); ?></option>
			<option value="wpcc_setting"><?php _e("Options Calculator", "wpcc"); ?></option>
		</select>
	</form>
	<div class="wpcc_shortcode"><b><?php _e("Shortcode", "wpcc"); ?>:</b> [wpcc id="<?php echo $wpcc_id; ?>"]</div>	
	<?php } elseif($_GET['wpcc_id'] == '' && $_GET['action'] == '') { ?>
	<br style="clear:both">
	<a href="http://www.zetrider.ru/" target="_blank"><img src="<?php echo $WPCC_PLUGIN_URL; ?>images/wpcc30.jpg"></a><br style="clear:both;">
	<?php }?>
	
	<br style="clear:both">
	<?php if($result != '') { echo '<div id="setting-error-settings_updated" class="updated settings-error">'.$result.'</div>'; } ?>
	
	<?php if($_GET['action'] == 'new' && $wpcc_new_id == '') { ?>
	<form method="post">
		<input type="text" name="wpcc_name" class="wpcc_input" value="<?php if(wpcc_get_form($_POST['wpcc_name']) == '') { echo __("Name", "wpcc"); } else { echo wpcc_get_form($_POST['wpcc_name']); } ?>" onblur="if (this.value == '')  {this.value = '<?php _e("Name", "wpcc"); ?>';}" onfocus="if (this.value == '<?php _e("Name", "wpcc"); ?>') {this.value = '';}"><br>
		<input type="submit" name="wpcc_new" value="<?php _e("Add", "wpcc"); ?>" class="button-primary">
	</form>
	<?php
	}
	if($_GET['wpcc_id'] != '' && wpcc_check_id($wpcc_id) == true) {
	?>
	<div class="wpcc_content">
		<div class="wpcc_content_block" id="wpcc_main" style="display:block;">
			<a href="http://wordpress.org/extend/plugins/wp-creator-calculator/" target="_blank"><img src="<?php echo $WPCC_PLUGIN_URL; ?>images/wpo.jpg"></a>
			<a href="http://www.zetrider.ru/" target="_blank"><img src="<?php echo $WPCC_PLUGIN_URL; ?>images/zwd.jpg"></a><br style="clear:both;">
			<a href="http://www.ttweb.ru/" target="_blank"><img src="<?php echo $WPCC_PLUGIN_URL; ?>images/stt.jpg"></a>
			<a href="http://www.zetrider.ru/donate" target="_blank"><img src="<?php echo $WPCC_PLUGIN_URL; ?>images/dwy.jpg"></a>
		</div>
		<div class="wpcc_content_block" id="wpcc_textblock">
			<form method="post">
				<?php echo wpcc_row_field('textblock'); ?>
				<input type="hidden" name="wpcc_type" value="textblock">
				<input type="submit" name="wpcc_add" value="<?php _e("Add", "wpcc"); ?>" class="button-primary">
			</form>
		</div>
		<div class="wpcc_content_block" id="wpcc_select">
			<form method="post">
				<?php echo wpcc_row_field('select'); ?>
				<input type="hidden" name="wpcc_type" value="select">
				<input type="submit" name="wpcc_add" value="<?php _e("Add", "wpcc"); ?>" class="button-primary">
			</form>
		</div>
		<div class="wpcc_content_block" id="wpcc_checkbox">
			<form method="post">
				<?php echo wpcc_row_field('checkbox'); ?>
				<input type="hidden" name="wpcc_type" value="checkbox">
				<input type="submit" name="wpcc_add" value="<?php _e("Add", "wpcc"); ?>" class="button-primary">
			</form>
		</div>
		<div class="wpcc_content_block" id="wpcc_radio">
			<form method="post">
				<?php echo wpcc_row_field('radio'); ?>
				<input type="hidden" name="wpcc_type" value="radio">
				<input type="submit" name="wpcc_add" value="<?php _e("Add", "wpcc"); ?>" class="button-primary">
			</form>
		</div>
		<div class="wpcc_content_block" id="wpcc_inputtext">
			<form method="post">
				<?php echo wpcc_row_field('inputtext'); ?>
				<input type="hidden" name="wpcc_type" value="inputtext">
				<input type="submit" name="wpcc_add" value="<?php _e("Add", "wpcc"); ?>" class="button-primary">
			</form>
		</div>
		<div class="wpcc_content_block" id="wpcc_hidden">
			<form method="post">
				<?php echo wpcc_row_field('hidden'); ?>
				<input type="hidden" name="wpcc_type" value="hidden">
				<input type="submit" name="wpcc_add" value="<?php _e("Add", "wpcc"); ?>" class="button-primary">
			</form>
		</div>
		<div class="wpcc_content_block" id="wpcc_session">
			<form method="post">
				<?php echo wpcc_row_field('session'); ?>
				<input type="hidden" name="wpcc_type" value="session">
				<input type="submit" name="wpcc_add" value="<?php _e("Add", "wpcc"); ?>" class="button-primary">
			</form>
		</div>
		<div class="wpcc_content_block" id="wpcc_jquery">
			<form method="post">
				<?php echo wpcc_row_field('jquery'); ?>
				<input type="hidden" name="wpcc_type" value="jquery">
				<input type="submit" name="wpcc_add" value="<?php _e("Add", "wpcc"); ?>" class="button-primary">
			</form>
		</div>
		<div class="wpcc_content_block" id="wpcc_design">
			<form method="post" action="options.php">
				<?php
				wp_nonce_field('update-options');
				$wpcc_theme_id = 'wpcc_theme_'.$wpcc_id;
				?>
				<label><input type="radio" name="<?php echo $wpcc_theme_id;?>" value="0" <?php if(get_option($wpcc_theme_id) == '0') { echo 'checked'; } ?>><?php _e("None design", "wpcc"); ?></label><hr>
				<label class="wpcc_theme_label" rel="1"><input type="radio" name="<?php echo $wpcc_theme_id;?>" value="<?php echo $WPCC_PLUGIN_URL;?>theme/default/style.css" <?php if(get_option($wpcc_theme_id) == $WPCC_PLUGIN_URL.'theme/default/style.css') { echo 'checked'; } ?>><span class="wpcc_theme_prev wpcc_theme_prev_1"><img src="<?php echo $WPCC_PLUGIN_URL;?>theme/default/images.jpg"></span><?php _e("Sceleton", "wpcc"); ?></label><hr>
				<label class="wpcc_theme_label" rel="2"><input type="radio" name="<?php echo $wpcc_theme_id;?>" value="<?php echo $WPCC_PLUGIN_URL;?>theme/mini/style.css" <?php if(get_option($wpcc_theme_id) == $WPCC_PLUGIN_URL.'theme/mini/style.css') { echo 'checked'; } ?>><span class="wpcc_theme_prev wpcc_theme_prev_2"><img src="<?php echo $WPCC_PLUGIN_URL;?>theme/mini/images.jpg"></span><?php _e("Minimaism", "wpcc"); ?></label><hr>
				<input type="hidden" name="action" value="update" />
				<input type="hidden" name="page_options" value="<?php echo $wpcc_theme_id;?>" />
				<input type="submit" name="update" value="<?php _e("Save", "wpcc"); ?>" class="button-primary">
			</form>
		</div>
		<div class="wpcc_content_block" id="wpcc_mail">
			<form method="post" action="options.php">
				<?php
				wp_nonce_field('update-options');
				$wpcc_mail_check_id = 'wpcc_mail_check_'.$wpcc_id;
				$wpcc_mail_subject_id = 'wpcc_mail_subject_'.$wpcc_id;
				$wpcc_mail_text_adm_id = 'wpcc_mail_text_adm_'.$wpcc_id;
				$wpcc_mail_text_success_id = 'wpcc_mail_text_success_'.$wpcc_id;
				$wpcc_mail_text_id = 'wpcc_mail_text_'.$wpcc_id;
				$wpcc_mail_emailto_id = 'wpcc_mail_emailto_'.$wpcc_id;
				$wpcc_mail_firstname_id = 'wpcc_mail_firstname_'.$wpcc_id;
				$wpcc_mail_emailwho_id = 'wpcc_mail_emailwho_'.$wpcc_id;
				$wpcc_mail_phone_id = 'wpcc_mail_phone_'.$wpcc_id;
				$wpcc_mail_comment_id = 'wpcc_mail_comment_'.$wpcc_id;
				
				$wpcc_mail_error_author_none_id = 'wpcc_mail_error_author_none_'.$wpcc_id;
				$wpcc_mail_error_author_max_id = 'wpcc_mail_error_author_max_'.$wpcc_id;
				$wpcc_mail_error_email_none_id = 'wpcc_mail_error_email_none_'.$wpcc_id;
				$wpcc_mail_error_email_err_id = 'wpcc_mail_error_email_err_'.$wpcc_id;
				$wpcc_mail_error_phone_err_id = 'wpcc_mail_error_phone_err_'.$wpcc_id;
				$wpcc_mail_error_phone_max_id = 'wpcc_mail_error_phone_max_'.$wpcc_id;
				$wpcc_mail_error_text_id = 'wpcc_mail_error_text_'.$wpcc_id;
				?>
				<b class="wpcc_strong"><?php _e("Enable sending emails?", "wpcc"); ?></b>
				<select name="<?php echo $wpcc_mail_check_id; ?>" class="wpcc_input">
					<option value="1" <?php if(get_option($wpcc_mail_check_id) == '1') { echo 'selected'; } ?>><?php _e("Yes", "wpcc"); ?></option>
					<option value="2" <?php if(get_option($wpcc_mail_check_id) == '2' || get_option($wpcc_mail_check_id) == '') { echo 'selected'; } ?>><?php _e("No", "wpcc"); ?></option>
				</select>
				<br><br>
				<b class="wpcc_strong"><?php _e("Subject", "wpcc"); ?></b> <input type="text" name="<?php echo $wpcc_mail_subject_id; ?>" class="wpcc_input" value="<?php echo get_option($wpcc_mail_subject_id); ?>"><br><br>
				<b class="wpcc_strong"><?php _e("The text of the letter", "wpcc"); ?>:</b> <textarea name="<?php echo $wpcc_mail_text_adm_id; ?>" maxlength="65535" class="wpcc_textarea"><?php echo wpcc_get_form(get_option($wpcc_mail_text_adm_id)); ?></textarea><br><br>
				<b class="wpcc_strong"><?php _e("Text before sending the form", "wpcc"); ?>:</b> <textarea name="<?php echo $wpcc_mail_text_id; ?>" maxlength="65535" class="wpcc_textarea"><?php echo wpcc_get_form(get_option($wpcc_mail_text_id)); ?></textarea><br><br>
				<b class="wpcc_strong"><?php _e("The text successfully sent", "wpcc"); ?>:</b> <textarea name="<?php echo $wpcc_mail_text_success_id; ?>" maxlength="65535" class="wpcc_textarea"><?php echo wpcc_get_form(get_option($wpcc_mail_text_success_id)); ?></textarea><br><br>
				<b class="wpcc_strong"><?php _e("At what E-Mail to send a request", "wpcc"); ?>:</b> <input type="text" name="<?php echo $wpcc_mail_emailto_id; ?>" class="wpcc_input" value="<?php echo get_option($wpcc_mail_emailto_id); ?>"><br><br>
				<b class="wpcc_strong"><?php _e("Field Name Last Name", "wpcc"); ?>:</b> <input type="text" name="<?php echo $wpcc_mail_firstname_id; ?>" class="wpcc_input" value="<?php echo get_option($wpcc_mail_firstname_id); ?>"><br><br>
				<b class="wpcc_strong"><?php _e("Field Contact E-Mail", "wpcc"); ?>:</b> <input type="text" name="<?php echo $wpcc_mail_emailwho_id; ?>" class="wpcc_input" value="<?php echo get_option($wpcc_mail_emailwho_id); ?>"><br><br>
				<b class="wpcc_strong"><?php _e("Field Contact Phone", "wpcc"); ?>:</b> <input type="text" name="<?php echo $wpcc_mail_phone_id; ?>" class="wpcc_input" value="<?php echo get_option($wpcc_mail_phone_id); ?>"><br><br>
				<b class="wpcc_strong"><?php _e("Field Comment", "wpcc"); ?>:</b> <input type="text" name="<?php echo $wpcc_mail_comment_id; ?>" class="wpcc_input" value="<?php echo get_option($wpcc_mail_comment_id); ?>"><br><br>
				<b class="wpcc_strong"><?php _e("Error: can not put a name", "wpcc"); ?>:</b> <input type="text" name="<?php echo $wpcc_mail_error_author_none_id; ?>" class="wpcc_input" value="<?php echo get_option($wpcc_mail_error_author_none_id); ?>"><br><br>
				<b class="wpcc_strong"><?php _e("Error: The long name", "wpcc"); ?>:</b> <input type="text" name="<?php echo $wpcc_mail_error_author_max_id; ?>" class="wpcc_input" value="<?php echo get_option($wpcc_mail_error_author_max_id); ?>"><br><br>
				<b class="wpcc_strong"><?php _e("Error: not entered Email", "wpcc"); ?>:</b> <input type="text" name="<?php echo $wpcc_mail_error_email_none_id; ?>" class="wpcc_input" value="<?php echo get_option($wpcc_mail_error_email_none_id); ?>"><br><br>
				<b class="wpcc_strong"><?php _e("Error: Incorrect Email", "wpcc"); ?>:</b> <input type="text" name="<?php echo $wpcc_mail_error_email_err_id; ?>" class="wpcc_input" value="<?php echo get_option($wpcc_mail_error_email_err_id); ?>"><br><br>
				<b class="wpcc_strong"><?php _e("Error: Incorrect phone", "wpcc"); ?>:</b> <input type="text" name="<?php echo $wpcc_mail_error_phone_err_id; ?>" class="wpcc_input" value="<?php echo get_option($wpcc_mail_error_phone_err_id); ?>"><br><br>
				<b class="wpcc_strong"><?php _e("Error: The longest phone", "wpcc"); ?>:</b> <input type="text" name="<?php echo $wpcc_mail_error_phone_max_id; ?>" class="wpcc_input" value="<?php echo get_option($wpcc_mail_error_phone_max_id); ?>"><br><br>
				<b class="wpcc_strong"><?php _e("Error: long comment", "wpcc"); ?>:</b> <input type="text" name="<?php echo $wpcc_mail_error_text_id; ?>" class="wpcc_input" value="<?php echo get_option($wpcc_mail_error_text_id); ?>"><br><br>
				<input type="hidden" name="action" value="update" />
				<input type="hidden" name="page_options" value="<?php echo $wpcc_mail_check_id.','.$wpcc_mail_subject_id.','.$wpcc_mail_text_adm_id.','.$wpcc_mail_text_id.','.$wpcc_mail_text_success_id.','.$wpcc_mail_emailto_id.','.$wpcc_mail_firstname_id.','.$wpcc_mail_emailwho_id.','.$wpcc_mail_phone_id.','.$wpcc_mail_comment_id.','.$wpcc_mail_error_author_none_id.','.$wpcc_mail_error_author_max_id.','.$wpcc_mail_error_email_none_id.','.$wpcc_mail_error_email_err_id.','.$wpcc_mail_error_phone_err_id.','.$wpcc_mail_error_phone_max_id.','.$wpcc_mail_error_text_id; ?>" />
				<input type="submit" name="update" value="<?php _e("Save", "wpcc"); ?>" class="button-primary">
			</form>							 
		</div>
		<div class="wpcc_content_block" id="wpcc_setting">
			<form method="post" action="options.php">
				<?php
				wp_nonce_field('update-options');
				$wpcc_submit_id = 'wpcc_submit_'.$wpcc_id;
				$wpcc_text_to_id = 'wpcc_text_to_'.$wpcc_id;
				$wpcc_text_af_id = 'wpcc_text_af_'.$wpcc_id;
				$wpcc_ajax_id = 'wpcc_ajax_'.$wpcc_id;
				$wpcc_action_id = 'wpcc_action_'.$wpcc_id;
				$wpcc_ltd_id = 'wpcc_ltd_'.$wpcc_id;
				?>

				<b class="wpcc_strong"><?php _e("The name of the button","wpcc"); ?>:</b> <input type="text" name="<?php echo $wpcc_submit_id; ?>" class="wpcc_input" value="<?php echo get_option($wpcc_submit_id); ?>"><br><br>
				<b class="wpcc_strong"><?php _e("The text to the amount","wpcc"); ?>:</b> <input type="text" name="<?php echo $wpcc_text_to_id; ?>" class="wpcc_input" value="<?php echo get_option($wpcc_text_to_id); ?>"><br><br>
				<b class="wpcc_strong"><?php _e("Text after the amount of","wpcc"); ?>:</b> <input type="text" name="<?php echo $wpcc_text_af_id; ?>" class="wpcc_input" value="<?php echo get_option($wpcc_text_af_id); ?>"><br><br>
				<b class="wpcc_strong"><?php _e("AJAX calculations?","wpcc"); ?><br><small>(<?php _e("without rebooting","wpcc"); ?>)</small></b>
				<select name="<?php echo $wpcc_ajax_id; ?>" class="wpcc_input">
					<option value="1" <?php if(get_option($wpcc_ajax_id) == '1' || get_option($wpcc_ajax_id) == '') { echo 'selected'; } ?>><?php _e("Yes","wpcc"); ?></option>
					<option value="2" <?php if(get_option($wpcc_ajax_id) == '2') { echo 'selected'; } ?>><?php _e("No","wpcc"); ?></option>
				</select>
				<br><br>
				<b class="wpcc_strong"><?php _e("Action form","wpcc"); ?>:</b> <input type="text" name="<?php echo $wpcc_action_id; ?>" class="wpcc_input" value="<?php echo get_option($wpcc_action_id); ?>"><br><br>
				<b class="wpcc_strong"><?php _e("Remember the selected data","wpcc"); ?>:</b>
				<select name="<?php echo $wpcc_ltd_id; ?>" class="wpcc_input">
					<option value="1" <?php if(get_option($wpcc_ltd_id) == '1' || get_option($wpcc_ltd_id) == '') { echo 'selected'; } ?>><?php _e("Yes","wpcc"); ?></option>
					<option value="2" <?php if(get_option($wpcc_ltd_id) == '2') { echo 'selected'; } ?>><?php _e("No","wpcc"); ?></option>
				</select>
				<br><br>
				<b class="wpcc_strong"><?php _e("Connect Jquery","wpcc"); ?>:</b>
				<select name="wpcc_connect_jquery" class="wpcc_input">
					<option value="1" <?php if(get_option('wpcc_connect_jquery') == '1' || get_option('wpcc_connect_jquery') == '') { echo 'selected'; } ?>><?php _e("Yes","wpcc"); ?></option>
					<option value="2" <?php if(get_option('wpcc_connect_jquery') == '2') { echo 'selected'; } ?>><?php _e("No","wpcc"); ?></option>
				</select>
				<br><br>
				<b class="wpcc_strong"><?php _e('Start $ _SESSION',"wpcc"); ?>:</b>
				<select name="wpcc_stars_session" class="wpcc_input">
					<option value="1" <?php if(get_option('wpcc_stars_session') == '1' || get_option('wpcc_stars_session') == '') { echo 'selected'; } ?>><?php _e("Yes","wpcc"); ?></option>
					<option value="2" <?php if(get_option('wpcc_stars_session') == '2') { echo 'selected'; } ?>><?php _e("No","wpcc"); ?></option>
				</select>
				<br><br>
				<input type="hidden" name="action" value="update" />
				<input type="hidden" name="page_options" value="<?php echo $wpcc_submit_id.','.$wpcc_text_to_id.','.$wpcc_text_af_id.','.$wpcc_ajax_id.','.$wpcc_action_id.','.$wpcc_ltd_id; ?>,wpcc_connect_jquery,wpcc_stars_session" />
				<input type="submit" name="update" value="<?php _e("Save", "wpcc"); ?>" class="button-primary">
			</form>
			<br>
			<form method="post">
				<input type="submit" name="wpcc_del" value="<?php _e("Remove calculator","wpcc"); ?>" class="button-primary">
			</form>
		</div>
	</div>
	<br class="clear">
	<hr>
	
	<h2 class="wpcc_title"><span><?php _e("Added fields","wpcc"); ?></span></h2><div class="wpcc_loading" id="wpcc_result_row" style="float:left;"></div><br>
	<div class="wpcc_row">
			<?php
			$wpcc_row_arr = $wpdb->get_results("SELECT * FROM `wp_wpcc` WHERE `wpcc_cat` = '$wpcc_id' ORDER BY `wpcc_order`");
			if(count($wpcc_row_arr) > '0') {
				echo '<ul>';
				foreach($wpcc_row_arr as $wpcc_row) {
					echo '<li id="arrayorder_'.$wpcc_row->wpcc_id.'" class="wpcc_radius_all"><b class="wpcc_toggle" rel="'.$wpcc_row->wpcc_id.'"></b><small>[ID-'.$wpcc_row->wpcc_id.']</small> '.wpcc_name_row($wpcc_row->wpcc_type).'
					<div class="wpcc_row_setting wpcc_row_setting_'.$wpcc_row->wpcc_id.'">
						<form method="post">
							'.wpcc_row_field($wpcc_row->wpcc_type, $wpcc_row->wpcc_id).'
							<input type="hidden" name="wpcc_row_id" value="'.$wpcc_row->wpcc_id.'">
							<input type="hidden" name="wpcc_type" value="'.$wpcc_row->wpcc_type.'">
							<input type="submit" name="wpcc_update" value="'.__("Update","wpcc").'" class="button-primary">
							<input type="submit" name="wpcc_delete" value="'.__("Remove","wpcc").'" class="button-primary">
						</form>
					</div>
					</li>';
				}
				echo '</ul>';
			} else {
				echo __("Formula is empty", "wpcc");
			}
			?>
	</div>
	<hr>
	<h2 class="wpcc_title"><span><?php _e("Text is the formula", "wpcc"); ?></span></h2><div class="wpcc_loading" id="wpcc_loading_text_formul" style="float:left;"></div><br>
		<div class="wpcc_text_formul">
			<?php echo file_get_contents ($WPCC_PLUGIN_URL."action/wpcc_text_formul.php?wpcc_id=".$wpcc_id); ?>
		</div>
	<hr>
	<h2 class="wpcc_title"><span><?php _e("Preview calculator", "wpcc"); ?></span></h2><div class="wpcc_loading" id="wpcc_loading_form_calc" style="float:left;"></div><br>
	<div class="wpcc_form_calc">
			<?php echo do_shortcode('[wpcc id="'.$wpcc_id.'" moderator="true"]'); ?>
	</div>


	<?php } ?>
	
	
<br class="clear">
</div>
<?php
}

function WPCC_Widget_function($wpcc_id) {
	$wpcc_id = intval($wpcc_id);
	if($wpcc_id > '0') {
		$return .= '<div class="wpcc_widget wpcc_widget_'.$wpcc_id.'">';
		$return .= do_shortcode('[wpcc id="'.$wpcc_id.'"]');
		$return .= '</div>';
	} else {
		$return = 'Error...';
	}
	return $return;
}
class WPCC_Widget extends WP_Widget {
	function WPCC_Widget() {	parent::WP_Widget(false, $name = 'WPCC Widget');	}
	function widget($args, $instance) {
		extract( $args );
		echo $before_title;
		echo $instance['title'];
		echo $after_title;
		echo $before_widget;
		echo WPCC_Widget_function($instance['wpcc_id']);
		echo $after_widget;
	}
	function update($new_instance, $old_instance) {	return $new_instance; }
	function form($instance) {
	global $wpdb;
	$title = esc_attr($instance['title']);
	$wpcc_id = esc_attr($instance['wpcc_id']);

?>
	<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e("Title", "wpcc"); ?>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</label>
	</p>
	
	<p>
		<label><?php _e("Calculator", "wpcc"); ?>:</label>
		<select name="<?php echo $this->get_field_name('wpcc_id'); ?>" style="width:170px;">
			<option value="0"><?php _e("Select the calculator", "wpcc"); ?></option>
			<?php
			$wpcc_menu = $wpdb->get_results("SELECT `wpcc_id`, `wpcc_name` FROM `wp_wpcc` WHERE `wpcc_cat` = '0' ORDER BY `wpcc_name`");
			if(count($wpcc_menu) != 0)  {
				foreach ($wpcc_menu as $wpcc_menu_row) {
					echo '<option value="'.$wpcc_menu_row->wpcc_id.'" '.(($wpcc_menu_row->wpcc_id == $wpcc_id)?'selected':'').' >[ID-'.$wpcc_menu_row->wpcc_id.'] '.$wpcc_menu_row->wpcc_name.'</option>';
				}
			}
			?>
		</select>
	</p>
<?php
	}
}
add_action('widgets_init', create_function('', 'return register_widget("WPCC_Widget");'));
?>