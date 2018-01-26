
jsBackend.settings=
{
init:function()
{
$('#facebookAdminIds').multipleTextbox(
{
emptyMessage:utils.string.ucfirst(jsBackend.locale.msg('NoAdminIds')),
addLabel:utils.string.ucfirst(jsBackend.locale.lbl('Add')),
removeLabel:utils.string.ucfirst(jsBackend.locale.lbl('Delete')),
canAddNew:true
});
$('#testEmailConnection').on('click',jsBackend.settings.testEmailConnection);
$('#activeLanguages input:checkbox').on('change',jsBackend.settings.changeActiveLanguage).change()},
changeActiveLanguage:function(e)
{
var $this=$(this);
		if(!$this.attr('disabled'))
{
			var $other=$('#'+$this.attr('id').replace('active_','redirect_'));
if($this.is(':checked'))$other.attr('disabled',false);
else $other.attr('checked',false).attr('disabled',true)}
},
testEmailConnection:function(e)
{
		e.preventDefault();
$spinner=$('#testEmailConnectionSpinner');
$error=$('#testEmailConnectionError');
$success=$('#testEmailConnectionSuccess');
$email=$('#settingsEmail');
		$spinner.show();
		$error.hide();
$success.hide();
		var settings={};
$.each($email.serializeArray(),function(){settings[this.name]=this.value;});
		$.ajax(
{
data:$.extend({fork:{action:'TestEmailConnection'}},settings),
success:function(data,textStatus)
{
				$spinner.hide();
				if(data.code==200)$success.show();
else $error.show()},
error:function(XMLHttpRequest,textStatus,errorThrown)
{
				$spinner.hide();
				$error.show()}
})}
}
$(jsBackend.settings.init);
