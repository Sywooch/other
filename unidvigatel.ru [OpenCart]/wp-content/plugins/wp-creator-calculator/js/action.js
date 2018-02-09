jQuery(document).ready(function( $ ) {

	var wpcc_plugin_url = $('#PLUGIN_URL').val();
	var wpcc_id = $('#WPCC_ID_CAT').val();
	
	/* Nav */
	$('#wpcc_nav').change( function() {
		var this_val = $(this).val();
		$('.wpcc_content_block').hide();
		$('#'+this_val).show();
	});
	
	/* Row Setting */
	$('.wpcc_toggle').toggle( function() {
		$(this).css("background-image", "url('"+wpcc_plugin_url+"images/minus.gif')")
		$('.wpcc_row_setting_' + $(this).attr('rel')).show();
	}, function() {
		$(this).css("background-image", "url('"+wpcc_plugin_url+"images/plus.gif')")
		$('.wpcc_row_setting_' + $(this).attr('rel')).hide();
	});
	
	/* Drag and Drop*/
	$(".wpcc_row ul").sortable({
		opacity: 0.8, cursor: 'move', update: function() {
			var order = $(this).sortable("serialize") + '&update=update';
			$('#wpcc_result_row').fadeIn(500);
			$('#wpcc_loading_text_formul').fadeIn(500);
			$('#wpcc_loading_form_calc').fadeIn(500);
			$.post( wpcc_plugin_url+"action/wpcc_row_update.php", order, function(html){
				$('.wpcc_text_formul').load(wpcc_plugin_url+'action/wpcc_text_formul.php?wpcc_id='+wpcc_id);
				$('.wpcc_form_calc').load(wpcc_plugin_url+'action/wpcc_form_calc.php?wpcc_id='+wpcc_id);
				$('.wpcc_loading').fadeOut(500);
			});
		}							  
	});
	
	/* WPCC style prev */
	$(".wpcc_theme_label").hover( function() {
		var this_rel = $(this).attr('rel');
		$('.wpcc_theme_prev_'+this_rel).show();
	}, function() {
		$('.wpcc_theme_prev').hide();
	});
	
	/* Wpcc Old Data */
	$('.wpcc_show_old').toggle( function() {
		$('.wpcc_row_old').slideDown(500);
	}, function() {
		$('.wpcc_row_old').slideUp(500);
	});
	
});