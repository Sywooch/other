
jsBackend.pages=
{
	init:function()
{
		jsBackend.pages.tree.init();
		if(typeof templates!='undefined')
{
			jsBackend.pages.extras.init();
jsBackend.pages.template.init()}
		$('#saveAsDraft').on('click',function(e)
{
$('form').append('<input type="hidden" name="status" value="draft" />');
$('form').submit()});
		if($('#title').length>0)$('#title').doMeta()}
}

jsBackend.pages.extras=
{
	init:function()
{
		$('#extraType').on('change',jsBackend.pages.extras.populateExtraModules);
$('#extraModule').on('change',jsBackend.pages.extras.populateExtraIds);
		$(document).on('click','a.addBlock',jsBackend.pages.extras.showAddDialog);
$(document).on('click','a.deleteBlock',jsBackend.pages.extras.showDeleteDialog);
$(document).on('click','.showEditor',jsBackend.pages.extras.editContent);
$(document).on('click','.toggleVisibility',jsBackend.pages.extras.toggleVisibility);
		jsBackend.pages.extras.sortable($('#templateVisualFallback div.linkedBlocks'))},
	addBlock:function(selectedExtraId,selectedPosition)
{
		var block=$('.contentBlock:first').clone();
		var index=$('.contentBlock').length;
		var blockHtml=$('textarea[id^=blockHtml]',block);
var blockExtraId=$('input[id^=blockExtraId]',block);
var blockPosition=$('input[id^=blockPosition]',block);
var blockVisibility=$('input[id^=blockVisible]',block);
		blockHtml.prop('id',blockHtml.prop('id').replace('0',index)).prop('name',blockHtml.prop('name').replace('0',index));
blockExtraId.prop('id',blockExtraId.prop('id').replace('0',index)).prop('name',blockExtraId.prop('name').replace('0',index));
blockPosition.prop('id',blockPosition.prop('id').replace('0',index)).prop('name',blockPosition.prop('name').replace('0',index));
blockVisibility.prop('id',blockVisibility.prop('id').replace('0',index)).prop('name',blockVisibility.prop('name').replace('0',index));
		blockPosition.val(selectedPosition);
		blockExtraId.val(selectedExtraId);
		block.appendTo($('#editContent'));
		var visible=blockVisibility.attr('checked');
		var addedVisual=jsBackend.pages.extras.addBlockVisual(selectedPosition,index,selectedExtraId,visible);
		if(typeof extrasById!='undefined'&&typeof extrasById[selectedExtraId]!='undefined')$('.blockContentHTML',block).hide();
		else $('.blockContentHTML',block).show();
		return addedVisual?index:false},
	addBlockVisual:function(position,index,extraId,visible)
{
		if(extraId!=0&&typeof extrasById[extraId]=='undefined')return false;
		if(extraId!=0)
{
			var editLink='';
if(extrasById[extraId].type=='block'&&extrasById[extraId].data.url)editLink=extrasById[extraId].data.url;
if(typeof extrasById[extraId].data.edit_url!='undefined'&&extrasById[extraId].data.edit_url)editLink=extrasById[extraId].data.edit_url;
			var title=extrasById[extraId].human_name;
var description=extrasById[extraId].path}
		else
{
			var editLink='';
var title=utils.string.ucfirst(jsBackend.locale.lbl('Editor'));
var description=utils.string.stripTags($('#blockHtml'+index).val()).substr(0,200)}
		var blockHTML='<div class="templatePositionCurrentType'+(visible?' ':' templateDisabled')+'" data-block-id="'+index+'">'+
'<span class="templateTitle">'+title+'</span>'+
'<span class="templateDescription">'+description+'</span>'+
'<div class="buttonHolder">'+
'<a href="'+(editLink?editLink:'#')+'" class="'+(extraId==0?'showEditor ':'')+'button icon iconOnly iconEdit'+'"'+(extraId!=0&&editLink?' target="_blank"':'')+(extraId!=0&&editLink?'':' onclick="return false;"')+((extraId!=0&&editLink)||extraId==0?'':'style="display: none;" ')+'><span>'+utils.string.ucfirst(jsBackend.locale.lbl('Edit'))+'</span></a>'+
'<a href="#" class="button icon iconOnly '+(visible?'iconVisible ':'iconInvisible ')+'toggleVisibility"><span>&nbsp;</span></a>'+
'<a href="#" class="deleteBlock button icon iconOnly iconDelete"><span>'+utils.string.ucfirst(jsBackend.locale.lbl('DeleteBlock'))+'</span></a>'+
'</div>'+
'</div>';
		$('#templatePosition-'+position+' .linkedBlocks').append(blockHTML);
		jsBackend.pages.extras.updatedBlock($('.templatePositionCurrentType[data-block-id='+index+']'));
return true},
	deleteBlock:function(index)
{
		$('.templatePositionCurrentType[data-block-id='+index+']').remove();
		$('[name=block_extra_id_'+index+']').parent('.contentBlock').remove();
		jsBackend.pages.extras.hideFallback();
		jsBackend.pages.extras.resetIndexes()},
	editContent:function(e)
{
		e.preventDefault();
		var index=$(this).parent().parent().attr('data-block-id');
		var previousContent=$('#blockHtml'+index).val();
		$('#blockHtml'+index).parent().parent().parent().after('<div id="blockPlaceholder"></div>');
		$('#blockHtml').dialog(
{
closeOnEscape:false,
draggable:false,
resizable:false,
modal:true,
width:940,
title:utils.string.ucfirst(jsBackend.locale.lbl('Editor')),
position:'center',
buttons:
[
{
text:utils.string.ucfirst(jsBackend.locale.lbl('OK')),
click:function()
{
						var content=$('#html').val();
						jsBackend.pages.extras.setContent(index,content);
						jsBackend.pages.template.original=false;
						$(this).dialog('close')}
},
{
text:utils.string.ucfirst(jsBackend.locale.lbl('Cancel')),
click:function()
{
						jsBackend.pages.extras.setContent(index,previousContent);
						$(this).dialog('close')}
}
],
			close:function(e,ui)
{
				$(this).dialog('destroy');
				var blockPlaceholder=$('#blockPlaceholder');
				$(this).insertBefore(blockPlaceholder);
				blockPlaceholder.remove()},
			open:function()
{
				CKEDITOR.instances['html'].setData(previousContent)}
})},
	hideFallback:function()
{
		if($('#templateVisualFallback .templatePositionCurrentType').length==0)$('#templateVisualFallback').hide()},
	populateExtraModules:function()
{
		var selectedType=$('#extraType').val();
		$('#extraModuleHolder').hide();
$('#extraExtraIdHolder').hide();
$('#extraModule').html('<option value="0">-</option>');
$('#extraExtraId').html('<option value="0">-</option>');
		if(selectedType=='widget'||selectedType=='block')
{
			for(var i in extrasData)
{
				if(typeof extrasData[i]['items'][selectedType]!='undefined')$('#extraModule').append('<option value="'+extrasData[i].value+'">'+extrasData[i].name+'</option>')}
			$('#extraModuleHolder').show()}
},
	populateExtraIds:function()
{
		var selectedType=$('#extraType').val();
var selectedModule=$('#extraModule').val();
		$('#extraExtraIdHolder').hide();
$('#extraExtraId').html('');
		if(typeof extrasData[selectedModule]!='undefined'&&typeof extrasData[selectedModule]['items'][selectedType]!='undefined')
{
if(extrasData[selectedModule]['items'][selectedType].length==1&&selectedType=='block')
{
$('#extraExtraId').append('<option selected="selected" value="'+extrasData[selectedModule]['items'][selectedType][0].id+'">'+extrasData[selectedModule]['items'][selectedType][0].label+'</option>')}
else
{
				for(var i in extrasData[selectedModule]['items'][selectedType])
{
					$('#extraExtraId').append('<option value="'+extrasData[selectedModule]['items'][selectedType][i].id+'">'+extrasData[selectedModule]['items'][selectedType][i].label+'</option>')}
				$('#extraExtraIdHolder').show()}
}
},
	resetIndexes:function()
{
		$('.contentBlock').addClass('reset');
						$('.templatePositionCurrentType').each(function(i)
{
			var oldIndex=$(this).attr('data-block-id');
var newIndex=i+1;
			$(this).attr('data-block-id',newIndex);
			var blockHtml=$('.reset [name=block_html_'+oldIndex+']');
var blockExtraId=$('.reset [name=block_extra_id_'+oldIndex+']');
var blockPosition=$('.reset [name=block_position_'+oldIndex+']');
var blockVisible=$('.reset [name=block_visible_'+oldIndex+']');
blockHtml.prop('id',blockHtml.prop('id').replace(oldIndex,newIndex)).prop('name',blockHtml.prop('name').replace(oldIndex,newIndex));
blockExtraId.prop('id',blockExtraId.prop('id').replace(oldIndex,newIndex)).prop('name',blockExtraId.prop('name').replace(oldIndex,newIndex));
blockPosition.prop('id',blockPosition.prop('id').replace(oldIndex,newIndex)).prop('name',blockPosition.prop('name').replace(oldIndex,newIndex));
blockVisible.prop('id',blockVisible.prop('id').replace(oldIndex,newIndex)).prop('name',blockVisible.prop('name').replace(oldIndex,newIndex));
			blockExtraId.parent('.contentBlock').removeClass('reset');
			blockPosition.val($(this).parent().parent().attr('data-position'))});
		$('.contentBlock').removeClass('reset')},
	setContent:function(index,content)
{
		if(content!=null)$('#blockHtml'+index).val(content);
		var description=utils.string.stripTags($('#blockHtml'+index).val()).substr(0,200);
$('.templatePositionCurrentType[data-block-id='+index+'] .templateDescription').html(description);
		jsBackend.pages.extras.updatedBlock($('.templatePositionCurrentType[data-block-id='+index+']'))},
	showAddDialog:function(e)
{
		e.preventDefault();
		position=$(this).parent().parent().attr('data-position');
		var hasModules=false;
		$('input[id^=blockExtraId]').each(function()
{
			var id=$(this).val();
			if(id!=''&&typeof extrasById[id]!='undefined'&&extrasById[id].type=='block')hasModules=true});
		$('#extraWarningAlreadyBlock').hide();
$('#extraWarningHomeNoBlock').hide();
		var enabled=true;
		if(hasModules)
{
			enabled=false;
			$('#extraWarningAlreadyBlock').show()}
		if(typeof pageID!='undefined'&&pageID==1)
{
			enabled=false;
			$('#extraWarningHomeNoBlock').show()}
		$('#extraType option[value=block]').attr('disabled',!enabled);
		$('#extraType').val('html');
$('#extraExtraId').val(0);
		jsBackend.pages.extras.populateExtraModules();
		if($('#addBlock').length>0)
{
$('#addBlock').dialog(
{
draggable:false,
resizable:false,
modal:true,
width:500,
buttons:
[
{
text:utils.string.ucfirst(jsBackend.locale.lbl('OK')),
click:function()
{
							var selectedExtraId=$('#extraExtraId').val();
							var index=jsBackend.pages.extras.addBlock(selectedExtraId,position);
							jsBackend.pages.template.original=false;
							$(this).dialog('close');
							if(index&&!(typeof extrasById!='undefined'&&typeof extrasById[selectedExtraId]!='undefined'))
{
$('.templatePositionCurrentType[data-block-id='+index+'] .showEditor').click()}
}
},
{
text:utils.string.ucfirst(jsBackend.locale.lbl('Cancel')),
click:function()
{
							$(this).dialog('close')}
}
]
})}
},
	showDeleteDialog:function(e)
{
		e.preventDefault();
		var element=$(this);
		if($('#confirmDeleteBlock').length>0)
{
$('#confirmDeleteBlock').dialog(
{
draggable:false,
resizable:false,
modal:true,
buttons:
[
{
text:utils.string.ucfirst(jsBackend.locale.lbl('OK')),
click:function()
{
							jsBackend.pages.extras.deleteBlock(element.parent().parent('.templatePositionCurrentType').attr('data-block-id'));
							jsBackend.pages.template.original=false;
							$(this).dialog('close')}
},
{
text:utils.string.ucfirst(jsBackend.locale.lbl('Cancel')),
click:function()
{
							$(this).dialog('close')}
}
]
})}
},
	sortable:function(element)
{
		element.sortable(
{
items:'.templatePositionCurrentType',
tolerance:'pointer',
placeholder:'dragAndDropPlaceholder',
forcePlaceholderSize:true,
connectWith:'div.linkedBlocks',
opacity:0.7,
delay:300,
stop:function(e,ui)
{
				jsBackend.pages.extras.resetIndexes();
				jsBackend.pages.extras.updatedBlock(ui.item);
				jsBackend.pages.extras.hideFallback();
				jsBackend.pages.template.original=false},
start:function(e,ui)
{
				if($(this).parents('#templateVisualLarge').length>0)
{
					$('div.linkedBlocks').sortable('option','connectWith','#templateVisualLarge div.linkedBlocks')}
else
{
					$('div.linkedBlocks').sortable('option','connectWith','div.linkedBlocks')}
				$('div.linkedBlocks').sortable('refresh')}
})},
	toggleVisibility:function(e)
{
		e.preventDefault();
		jsBackend.pages.template.original=false;
		var index=$(this).parent().parent().attr('data-block-id');
		var checkbox=$('#blockVisible'+index);
		var visible=checkbox.is(':checked');
		visible=!visible;
		checkbox.attr('checked',visible);
		$(this).removeClass('iconVisible').removeClass('iconInvisible');
$(this).parent().parent().removeClass('templateDisabled');
		if(visible)$(this).addClass('iconVisible');
else
{
$(this).addClass('iconInvisible');
$(this).parent().parent().addClass('templateDisabled')}
},
	updatedBlock:function(element)
{
element.effect('highlight')}
}

jsBackend.pages.template=
{
	original:true,
	init:function()
{
		$('#changeTemplate').on('click',jsBackend.pages.template.showTemplateDialog);
		jsBackend.pages.template.changeTemplate()},
	changeTemplate:function()
{
		var selected=$('#templateList input:radio:checked').val();
		var old=templates[$('#templateId').val()];
var current=templates[selected];
var i=0;
		$('#block-0').hide();
		$('#templateVisual').html(current.html);
$('#templateVisualLarge').html(current.htmlLarge);
$('#templateVisualFallback .linkedBlocks').children().remove();
$('#templateId').val(selected);
$('#templateLabel, #tabTemplateLabel').html(current.label);
		jsBackend.pages.extras.sortable($('#templateVisualLarge div.linkedBlocks'));
		$('#templateVisualFallback').hide();
		$('input[id^=blockPosition][value=fallback][id!=blockPosition0]').parent().remove();
		if(current!=old&&jsBackend.pages.template.original)$('input[id^=blockPosition][id!=blockPosition0]').parent().remove();
		$('#editContent .contentBlock').each(function(i)
{
			var index=$('input[id^=blockExtraId]',this).prop('id').replace('blockExtraId','');
var extraId=parseInt($('input[id^=blockExtraId]',this).val());
var position=$('input[id^=blockPosition]',this).val();
var html=$('textarea[id^=blockHtml]',this).val();
			if(index==0)return true;
			jsBackend.pages.template.original=false;
			if(current!=old&&$.inArray(extraId,old.data.default_extras[position])>=0&&html=='')$('input[id=blockPosition'+index+']',this).val('fallback')});
		newDefaults=[];
		if(current!=old||(typeof initDefaults!='undefined'&&initDefaults))
{
			if(typeof initDefaults!='undefined')initDefaults=false;
			for(var position in current.data.default_extras)
{
				for(var block in current.data.default_extras[position])
{
					extraId=current.data.default_extras[position][block];
					var existingBlock=null;
					var existingBlock=$('input[id^=blockPosition][value=fallback]:not(#blockPosition0)').parent().find('input[id^=blockExtraId][value='+extraId+']').parent();
					if(existingBlock.length==0)newDefaults.push(new Array(extraId,position));
					else $('input[id^=blockPosition]',existingBlock).val(position)}
}
}
		$('#editContent .contentBlock').each(function(i)
{
			var index=$('input[id^=blockExtraId]',this).prop('id').replace('blockExtraId','');
var extraId=parseInt($('input[id^=blockExtraId]',this).val());
var position=$('input[id^=blockPosition]',this).val();
var visible=$('input[id^=blockVisible]',this).attr('checked');
			if(index==0)return true;
			if($.inArray(position,current.data.names)<0)
{
				position='fallback';
				$('input[id=blockPosition'+index+']',this).val(position);
				$('#templateVisualFallback').show()}
			added=jsBackend.pages.extras.addBlockVisual(position,index,extraId,visible);
			if(!added)$(this).remove()});
		jsBackend.pages.extras.resetIndexes();
		for(var i in newDefaults)jsBackend.pages.extras.addBlock(newDefaults[i][0],newDefaults[i][1])},
	showTemplateDialog:function(e)
{
		e.preventDefault();
$('#chooseTemplate').dialog(
{
draggable:false,
resizable:false,
modal:true,
width:940,
buttons:
[
{
text:utils.string.ucfirst(jsBackend.locale.lbl('OK')),
click:function()
{
if($('#templateList input:radio:checked').val()!=$('#templateId').val())
{
							jsBackend.pages.template.changeTemplate()}
						$(this).dialog('close')}
},
{
text:utils.string.ucfirst(jsBackend.locale.lbl('Cancel')),
click:function()
{
						$(this).dialog('close')}
}
]
})}
}

jsBackend.pages.tree=
{
	init:function()
{
if($('#tree div').length==0)return false;
		if(!jQuery.support.opacity)$('#tree ul li[rel="hidden"]').addClass('treeHidden');
var openedIds=[];
if(typeof pageID!='undefined')
{
			var parents=$('#page-'+pageID).parents('li');
			var openedIds=['page-'+pageID];
			for(var i=0;i<parents.length;i++)openedIds.push($(parents[i]).prop('id'))}
		if(!utils.array.inArray('page-1',openedIds))openedIds.push('page-1');
var options=
{
ui:{theme_name:'fork'},
opened:openedIds,
rules:
{
multiple:false,
multitree:'all',
drag_copy:false
},
lang:{loading:utils.string.ucfirst(jsBackend.locale.lbl('Loading'))},
callback:
{
beforemove:jsBackend.pages.tree.beforeMove,
onselect:jsBackend.pages.tree.onSelect,
onmove:jsBackend.pages.tree.onMove
},
types:
{
'default':{renameable:false,deletable:false,creatable:false,icon:{image:'/src/Backend/Modules/Pages/Js/jstree/themes/fork/icons.gif'}},
'page':{icon:{position:'0 -80px'}},
'folder':{icon:{position:false}},
'hidden':{icon:{position:false}},
'home':{draggable:false,icon:{position:'0 -112px'}},
'pages':{icon:{position:false}},
'error':{draggable:false,max_children:0,icon:{position:'0 -160px'}},
'sitemap':{max_children:0,icon:{position:'0 -176px'}},
'redirect':{icon:{position:'0 -264px'}},
'direct_action':{max_children:0,icon:{position:'0 -280px'}}
},
plugins:
{
cookie:{prefix:'jstree_',types:{selected:false},options:{path:'/'}}
}
};
		$('#tree div').tree(options);
		$('.tree li.open').each(function()
{
			if($(this).find('ul').length==0)$(this).removeClass('open').addClass('leaf')});
		if(typeof selectedId!='undefined')$('#'+selectedId).addClass('selected')},
	beforeMove:function(node,refNode,type,tree)
{
		var currentPageID=$(node).prop('id').replace('page-','');
if(typeof refNode=='undefined')parentPageID=0;
else var parentPageID=$(refNode).prop('id').replace('page-','')
		if(parentPageID=='1')
{
if(type=='before')return false;
if(type=='after')return false}
		var result=false;
		$.ajax(
{
async:false,			data:
{
fork:{action:'GetInfo'},
id:currentPageID
},
error:function(XMLHttpRequest,textStatus,errorThrown)
{
if(jsBackend.debug)alert(textStatus);
result=false},
success:function(json,textStatus)
{
if(json.code!=200)
{
if(jsBackend.debug)alert(textStatus);
result=false}
else
{
if(json.data.allow_move=='Y')result=true}
}
});
		return result},
	onSelect:function(node,tree)
{
		var currentPageURL=window.location.pathname+window.location.search;
var newPageURL=$(node).find('a').prop('href');
		if(typeof newPageURL!='undefined'&&newPageURL!=currentPageURL)window.location=newPageURL},
	onMove:function(node,refNode,type,tree,rollback)
{
		var tree=tree.container.data('tree');
		var currentPageID=$(node).prop('id').replace('page-','');
		if(typeof refNode=='undefined')droppedOnPageID=0;
else var droppedOnPageID=$(refNode).prop('id').replace('page-','')
		$.ajax(
{
data:
{
fork:{action:'Move'},
id:currentPageID,
dropped_on:droppedOnPageID,
type:type,
tree:tree
},
success:function(json,textStatus)
{
if(json.code!=200)
{
if(jsBackend.debug)alert(textStatus);
					jsBackend.messages.add('error',jsBackend.locale.err('CantBeMoved'));
					$.tree.rollback(rollback)}
else
{
					jsBackend.messages.add('success',jsBackend.locale.msg('PageIsMoved').replace('%1$s',json.data.title))}
}
})}
}
$(jsBackend.pages.init);
