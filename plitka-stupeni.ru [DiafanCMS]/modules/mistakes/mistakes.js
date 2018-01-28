$(document).ready(function() {
    $('body').keypress(function(event) {
	if((event.ctrlKey) && ((event.keyCode == 0xA)||(event.keyCode == 0xD)))
	{
	    $('.mistakes_form input[name=selected_text]').val(getSelection());
	    $.prettyPhoto.open("#mistakes_comment");
	}
    });
    $('.mistakes_form input[type=button]').live('click', function(){
	var form = $(this).parents('form');
	form.find('input[name=url]').val(window.location.href);
	form.submit();
    });
    function getSelection() {
	return (!!document.getSelection) ? document.getSelection() :
	       (!!window.getSelection)   ? window.getSelection() :
	       document.selection.createRange().text;
    }
});