$(document).ready(function(){ 
		
    $(".remove-link").live('click',(function() { 
        $(this).parent().parent().remove();
    })) 
	 
	$(".add-link").live('click',(function() { 
		$('#optiontable').append('<tr><td class="left" style="padding:0.2em;">Option</td><td class="middle" style="padding:0.2em;"><input type="text" name="option" value="" size="30"/></td><td style="padding:0.2em;"><img class="remove-link" src="../wp-content/plugins/easy_wp_install/easybasket/welcome/del.png" width="24" height="24"/></td></tr>');
    })) 
})

