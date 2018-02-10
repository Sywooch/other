
jsBackend.template=
{
	defaultPositions:new Array('','main','left','right','top'),

init:function()
{
		if($('#position1').length==0)jsBackend.template.addPosition();
		$('#position1').parent().find('.deletePosition').remove();
		$(document).on('click','#addPosition',jsBackend.template.addPosition);
$(document).on('click','.addBlock',jsBackend.template.addBlock);
$(document).on('click','.deletePosition',jsBackend.template.deletePosition);
$(document).on('click','.deleteBlock',jsBackend.template.deleteBlock)},

addBlock:function(e)
{
		e.preventDefault();
		var blockContainer=$('#type00').parent().clone();
		var positionIndex=$(this).parent().prevAll('input[id^=position]').attr('id').replace('position','');
var blockIndex=$(this).prevAll('div.defaultBlock').length;
		$('#type00',blockContainer).attr('id','type'+positionIndex+blockIndex).attr('name','type_'+positionIndex+'_'+blockIndex);
		blockContainer.insertBefore($(this))},

addPosition:function(e)
{
		if(e)e.preventDefault();
		var positionContainer=$('#position0').parent().clone();
		var index=$('#positionsList .position').length;
		$('input[id^=position]',positionContainer).attr('id','position'+index).attr('name','position_'+index);
$('label[for^=position]',positionContainer).attr('for','position'+index);
		$('.defaultBlocks > *:not(a.addBlock)',positionContainer).remove();
		$('#position'+index,positionContainer).val(jsBackend.template.defaultPositions[index]);
		positionContainer.show();
		positionContainer.insertAfter($('#positionsList .position:last'))},

deleteBlock:function(e)
{
		e.preventDefault();
		var blocksContainer=$(this).parent().parent();
		$(this).parent().remove();
		$('.defaultBlock',blocksContainer).each(function(i)
{
			var positionIndex=$(this).parent().prevAll('input[id^=position]').attr('id').replace('position','');
var blockIndex=$(this).prevAll('div.defaultBlock').length;
			$('select[id^=type]',this).attr('id','type'+positionIndex+blockIndex).attr('name','type_'+positionIndex+'_'+blockIndex)})},

deletePosition:function(e)
{
		e.preventDefault();
		var positionsContainer=$(this).parent().parent().parent();
		$(this).parent().parent().remove();
		$('.position',positionsContainer).each(function(i)
{
			var positionIndex=i;
			$('input[id^=position]',this).attr('id','position'+positionIndex).attr('name','position_'+positionIndex);
$('label[for^=position]',this).attr('for','position'+positionIndex);
			$('.defaultBlock',this).each(function(i)
{
				var blockIndex=$(this).prevAll('div.defaultBlock').length;
				$('select[id^=type]',this).attr('id','type'+positionIndex+blockIndex).attr('name','type_'+positionIndex+'_'+blockIndex)})})}
}
$(jsBackend.template.init);
