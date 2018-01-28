$(document).ready(function() {
    
    $('.input_search').focus(search_focus_event);
    
    $('.input_search').blur(search_blur_event); 
    
    function search_focus_event(){
        if(! $(this).attr("val"))
        {
            $(this).attr("val", $(this).val());
        }
        $(this).val('');
    }
    
    function search_blur_event()
    {
        if($(this).val())
        {
            return;
        }
        if($(this).attr("val"))
        {
            $(this).val($(this).attr("val"));
        }
        else
        {
            $(this).val('');
        }
    }
});