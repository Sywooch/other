<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
$wpcc_id = intval($_POST['wpcc_form_id']);
	if ($wpcc_id > '0') {
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
				
		$return .= '</div>'."\n";
		
		if(get_option('wpcc_mail_check_'.$wpcc_id) == '1') {
			$return .= wpcc_mail_form($wpcc_sum, $wpcc_id);
		}
		
		echo $return;
	} else {
		echo 'No id';
	}
?>