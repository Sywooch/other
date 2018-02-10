
jsBackend.search=
{
	init:function()
{
$synonymBox=$('input.synonymBox');
		if($synonymBox.length>0)
{
$synonymBox.multipleTextbox(
{
emptyMessage:jsBackend.locale.msg('NoSynonymsBox'),
addLabel:utils.string.ucfirst(jsBackend.locale.lbl('Add')),
removeLabel:utils.string.ucfirst(jsBackend.locale.lbl('DeleteSynonym'))
})}
		$('#searchModules input[type=checkbox]').on('change',function()
{
$this=$(this);
if($this.is(':checked')){$('#'+$this.attr('id')+'Weight').removeAttr('disabled').removeClass('disabled');}
else{$('#'+$this.attr('id')+'Weight').prop('disabled',true).addClass('disabled');}
})}
}
$(jsBackend.search.init);
