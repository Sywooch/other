
jsBackend.templates=
{

init:function()
{
		jsBackend.templates.changeTemplate()},

changeTemplate:function()
{
		$('#theme').on('change',function()
{
			window.location.search='?theme='+$(this).val()})}
}
$(jsBackend.templates.init);
