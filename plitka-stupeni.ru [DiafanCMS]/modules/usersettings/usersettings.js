$(document).ready(function(){
	$('.usersettings_avatar_delete').live('click', function(){
		$.ajax({
			data: {
				action : "delete_avatar",
				module : "usersettings",
				ajax: 1
			},
			type : 'POST'
		});
		$(this).parents('.usersettings_avatar').html('');
		return false;
	});
    $("select[name=role_id]").live('change',function(){
        show_param_rele_rel(this);
    });
    show_param_rele_rel("select[name=role_id]");
});
function show_param_rele_rel(th)
{
    $('.param_role_rels').hide();
    $('.param_role_'+$(th).val()).show();
}