$(document).ready(function(){
    $("#tabs").bind("tabsselect", function(event, ui) { 
        var value=$(ui.panel).attr("id").replace("tabs-","");
        $("#type").val(value);
    });

    $("input[name='check_all_role']").live('change',function(){ 
        if($(this).attr('checked'))
        {
            $('.checkbox_'+$(this).attr('value')).each(function () {
                $(this).attr('checked','checked');
            });
        }
        else
        {
            $('.checkbox_'+$(this).attr('value')).each(function () {
                $(this).removeAttr('checked');
            });  
        }
    });
});
