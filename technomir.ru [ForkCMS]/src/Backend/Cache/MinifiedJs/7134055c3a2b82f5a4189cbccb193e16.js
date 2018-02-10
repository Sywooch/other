
jsBackend.extensions=
{
init:function()
{
jsBackend.extensions.themeSelection.init()}
}
jsBackend.extensions.themeSelection=
{
init:function()
{
		var listItems=$('#installedThemes li');
		listItems.on('click',function(e)
{
			var radiobutton=$(this).find('input:radio:first');
			radiobutton.prop('checked',true);
			if(radiobutton.is(':checked'))
{
				listItems.removeClass('selected');
				radiobutton.parent('li').addClass('selected')}
})}
}
$(jsBackend.extensions.init);
