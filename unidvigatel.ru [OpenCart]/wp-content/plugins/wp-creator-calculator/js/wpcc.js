function wpcc_ajax_calculate(id){
	var wpcc_plugin_url = jQuery('#wpcc_form_url').val();
	var sirialize_form = 'form.wpcc_form_'+id;
	jQuery(".wpcc_result_"+id).html('<img src="'+wpcc_plugin_url+'images/loading.gif">');
	jQuery.post(wpcc_plugin_url+"action/wpcc_result.php", jQuery(sirialize_form).serialize(), function(html){
		jQuery(".wpcc_result_block_"+id).html(html);
	});
	return false;
}
function wpcc_ajax_mail(id){
	var wpcc_plugin_url = jQuery('#wpcc_form_url').val();
	var sirialize_form = 'form.wpcc_mail_form_'+id;
	jQuery(".wpcc_mail_info_"+id).show().html('<img src="'+wpcc_plugin_url+'images/loading.gif">');
	jQuery.post(wpcc_plugin_url+"action/wpcc_mail_send.php", jQuery(sirialize_form).serialize(), function(html){
		if(html != '') {
			var wpcc_obj = eval("(" + html + ")");
			
			if(wpcc_obj.error == '0') {
				jQuery(".wpcc_mail_"+id).hide();
				jQuery(".wpcc_mail_info_"+id).html(wpcc_obj.success);
			} else {
				jQuery(".wpcc_mail_info_"+id).html(wpcc_obj.error);
			}
		}
	});
	return false;
}