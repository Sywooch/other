
jsBackend.tags=
{
	init:function()
{
$dataGridTag=$('.dataGrid td.tag');
if($dataGridTag.length>0)$dataGridTag.inlineTextEdit({params:{fork:{action:'edit'}},tooltip:jsBackend.locale.msg('ClickToEdit')})}
}
$(jsBackend.tags.init);