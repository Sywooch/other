
jsBackend.translations=
{
init:function()
{
jsBackend.translations.controls.init()}
}
jsBackend.translations.controls=
{
init:function()
{
if($('select#application').length>0&&$('select#module').length>0)
{
			$('select#application').on('change',jsBackend.translations.controls.enableDisableModules);
			jsBackend.translations.controls.enableDisableModules()}
if($('.dataGrid td.translationValue').length>0)
{
			$('.dataGrid td.translationValue').inlineTextEdit(
{
params:{fork:{action:'SaveTranslation'}},
tooltip:jsBackend.locale.msg('ClickToEdit'),
afterSave:function(item)
{
if(item.find('span:empty').length==1)item.addClass('highlighted');
else item.removeClass('highlighted')}
});
			$('.dataGrid td.translationValue span:empty').parents('td.translationValue').addClass('highlighted')}
},
enableDisableModules:function()
{
		if($('select#application').val()=='Frontend')
{
			$('select#module option').prop('disabled',true);
			$('select#module option[value=Core]').prop('disabled',false).prop('selected',true)}
		else
{
$('select#module option').prop('disabled',false)}
}
}
$(jsBackend.translations.init);
