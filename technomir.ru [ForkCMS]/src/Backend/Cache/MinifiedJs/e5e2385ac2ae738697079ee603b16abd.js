
jsBackend.groups=
{
	init:function()
{
		$hide=$('.hide');
$container=$('.container');
$containerLabel=$('.container span label');
$moduleDataGridBody=$('.module .datagridHolder .dataGrid tbody');
$groupHolderDataGridBody=$('.groupHolder .dataGrid tbody');
$dataGridTd=$('.dataGrid tbody tr td');
$selectAll=$('.selectAll');
$hide.each(jsBackend.groups.hide);
$container.click(jsBackend.groups.clickHandler);
$containerLabel.each(jsBackend.groups.mouseHandler);
$moduleDataGridBody.each(jsBackend.groups.selectionPermissions);
$groupHolderDataGridBody.each(jsBackend.groups.selectionWidgets)
$dataGridTd.click(jsBackend.groups.selectHandler);
$selectAll.click(jsBackend.groups.selectAll)},
	hide:function()
{
		$this=$(this);
		$this.hide()},
	clickHandler:function(e)
{
		e.preventDefault();
		$this=$(this);
		if($this.hasClass('iconCollapsed'))
{
			$this.next('.datagridHolder').show();
			$this.attr('title','close');
			$this.addClass('iconExpanded');
$this.removeClass('iconCollapsed')}
		else
{
			$this.next('.datagridHolder').hide();
			$this.attr('title','open');
			$this.addClass('iconCollapsed');
$this.removeClass('iconExpanded')}
},
	selectHandler:function()
{
		$this=$(this);
		if($this.parent('tr').parent('tbody').parent('.dataGrid').parent('.datagridHolder').parent('.module').html()!==null)$this.parent('tr').parent('tbody').each(jsBackend.groups.selectionPermissions);
		else $this.parent('tr').parent('tbody').each(jsBackend.groups.selectionWidgets)},
	selectionPermissions:function()
{
		var allChecked=true;
var noneChecked=true;
$this=$(this);
		$this.find('tr td input').each(function()
{
			if(!$(this).prop('checked'))allChecked=false;
			else noneChecked=false});
		if(!allChecked&&!noneChecked)
{
			$this.parent('table').parent('div').parent('li').find('input').get(0).checked=false;
$this.parent('table').parent('div').parent('li').find('input').get(0).indeterminate=true}
		if(allChecked)
{
			$this.parent('table').parent('div').parent('li').find('input').get(0).indeterminate=false;
$this.parent('table').parent('div').parent('li').find('input').get(0).checked=true}
		if(noneChecked)
{
			$this.parent('table').parent('div').parent('li').find('input').get(0).indeterminate=false;
$this.parent('table').parent('div').parent('li').find('input').get(0).checked=false}
},
	selectionWidgets:function()
{
		var allChecked=true;
$this=$(this);
		$this.find('tr td input').each(function()
{
			if(!$(this).attr('checked'))allChecked=false});
		if(allChecked)$this.parent('table').find('thead tr th span span input').attr('checked','checked');
		else $this.parent('table').find('thead tr th span span input').removeAttr('checked')},
	mouseHandler:function()
{
		$this=$(this);
		$this.mouseover(function()
{
			$this.css('cursor','pointer');
$this.css('cursor','hand')})},
	selectAll:function()
{
		$this=$(this);
		if($this.prop('checked'))
{
			$this.next('a').next('div').find('table tbody tr td input').each(function()
{
				$(this).attr('checked','checked').parents('tr').addClass('selected')})}
		else
{
			$this.next('a').next('div').find('table tbody tr td input').each(function()
{
				$(this).removeAttr('checked').parents('tr').removeClass('selected')})}
}
}
$(jsBackend.groups.init);