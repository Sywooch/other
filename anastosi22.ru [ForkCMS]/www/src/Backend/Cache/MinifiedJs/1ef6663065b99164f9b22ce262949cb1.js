
jsBackend.formBuilder=
{

formId:null,

init:function()
{
		$selectMethod=$('select#method');
$formId=$('#formId');
		jsBackend.formBuilder.fields.init();
		jsBackend.formBuilder.formId=$formId.val();
		if($selectMethod.length>0)
{
jsBackend.formBuilder.handleMethodField();
$(document).on('change','select#method',jsBackend.formBuilder.handleMethodField)}
$('#email').multipleTextbox(
{
emptyMessage:jsBackend.locale.msg('NoEmailaddresses'),
addLabel:utils.string.ucfirst(jsBackend.locale.lbl('Add','core')),
removeLabel:utils.string.ucfirst(jsBackend.locale.lbl('Delete')),
canAddNew:true
})},

handleMethodField:function()
{
		$selectMethod=$('select#method');
$emailWrapper=$('#emailWrapper');
		if($selectMethod.val()=='database_email')$emailWrapper.slideDown();
		else $emailWrapper.slideUp()}
}
jsBackend.formBuilder.fields=
{

defaultErrorMessages:{},

paramsDelete:'',
paramsGet:'',
paramsSave:'',
paramsSequence:'',

init:function()
{
		jsBackend.formBuilder.fields.paramsDelete={fork:{action:'DeleteField'}};
jsBackend.formBuilder.fields.paramsGet={fork:{action:'GetField'}};
jsBackend.formBuilder.fields.paramsSave={fork:{action:'SaveField'}};
jsBackend.formBuilder.fields.paramsSequence={fork:{action:'Sequence'}};
		if(typeof defaultErrorMessages!='undefined')jsBackend.formBuilder.fields.defaultErrorMessages=defaultErrorMessages;
		jsBackend.formBuilder.fields.bindDialogs();
jsBackend.formBuilder.fields.bindValidation();
jsBackend.formBuilder.fields.bindEdit();
jsBackend.formBuilder.fields.bindDelete();
jsBackend.formBuilder.fields.bindDragAndDrop()},

bindDelete:function()
{
		$(document).on('click','.deleteField',function(e)
{
			e.preventDefault();
			var id=$(this).attr('rel');
			if(id!='')
{
				$.ajax(
{
data:$.extend({},jsBackend.formBuilder.fields.paramsDelete,
{
form_id:jsBackend.formBuilder.formId,
field_id:id
}),
success:function(data,textStatus)
{
						if(data.code==200)
{
							$('#fieldHolder-'+id).fadeOut(200,function()
{
								$(this).remove();
								jsBackend.formBuilder.fields.toggleNoItems()})}
						else jsBackend.messages.add('error',textStatus);
						if(data.code!=200&&jsBackend.debug){alert(data.message);}
}
})}
})},

bindDialogs:function()
{
		$('.dialog').each(function()
{
			var id=$(this).attr('id');
			if(id!='')
{
				$('#'+id).dialog(
{
autoOpen:false,
draggable:false,
resizable:false,
modal:true,
width:400,
buttons:
[
{
text:utils.string.ucfirst(jsBackend.locale.lbl('Save')),
click:function()
{
								switch(id)
{
case 'textboxDialog':
jsBackend.formBuilder.fields.saveTextbox();
break;
case 'textareaDialog':
jsBackend.formBuilder.fields.saveTextarea();
break;
case 'headingDialog':
jsBackend.formBuilder.fields.saveHeading();
break;
case 'paragraphDialog':
jsBackend.formBuilder.fields.saveParagraph();
break;
case 'submitDialog':
jsBackend.formBuilder.fields.saveSubmit();
break;
case 'dropdownDialog':
jsBackend.formBuilder.fields.saveDropdown();
break;
case 'radiobuttonDialog':
jsBackend.formBuilder.fields.saveRadiobutton();
break;
case 'checkboxDialog':
jsBackend.formBuilder.fields.saveCheckbox();
break}
}
},
{
text:utils.string.ucfirst(jsBackend.locale.lbl('Cancel')),
click:function()
{
$(this).dialog('close')}
}
],
					open:function(e)
{
						if(id=='dropdownDialog')
{
$('input#dropdownValues').multipleTextbox(
{
splitChar:'|',
emptyMessage:jsBackend.locale.msg('NoValues'),
addLabel:utils.string.ucfirst(jsBackend.locale.lbl('Add')),
removeLabel:utils.string.ucfirst(jsBackend.locale.lbl('Delete')),
showIconOnly:true,
afterBuild:jsBackend.formBuilder.fields.multipleTextboxCallback
})}
else if(id=='radiobuttonDialog')
{
$('input#radiobuttonValues').multipleTextbox(
{
splitChar:'|',
emptyMessage:jsBackend.locale.msg('NoValues'),
addLabel:utils.string.ucfirst(jsBackend.locale.lbl('Add')),
removeLabel:utils.string.ucfirst(jsBackend.locale.lbl('Delete')),
showIconOnly:true,
afterBuild:jsBackend.formBuilder.fields.multipleTextboxCallback
})}
else if(id=='checkboxDialog')
{
$('input#checkboxValues').multipleTextbox(
{
splitChar:'|',
emptyMessage:jsBackend.locale.msg('NoValues'),
addLabel:utils.string.ucfirst(jsBackend.locale.lbl('Add')),
removeLabel:utils.string.ucfirst(jsBackend.locale.lbl('Delete')),
showIconOnly:true,
afterBuild:jsBackend.formBuilder.fields.multipleTextboxCallback
})}
						if($(this).find(':input:visible').length>0)$(this).find(':input:visible')[0].focus();
						jsBackend.formBuilder.fields.toggleValidationErrors(id)},
					beforeclose:function(e)
{
						jsBackend.formBuilder.fields.toggleNoItems();
						jsBackend.formBuilder.fields.resetDialog(id);
						jsBackend.formBuilder.fields.toggleValidationErrors(id)}
})}
});
		$(document).on('click','.openFieldDialog',function(e)
{
			e.preventDefault();
			var id=$(this).attr('rel');
			if(id!='')$('#'+id).dialog('open')})},

bindDragAndDrop:function()
{
		$('#fieldsHolder').sortable(
{
items:'div.field',
handle:'span.dragAndDropHandle',
containment:'#fieldsHolder',
stop:function(e,ui)
{
				var rowIds=$(this).sortable('toArray');
var newIdSequence=[];
				for(var i in rowIds)newIdSequence.push(rowIds[i].split('-')[1]);
				$.ajax(
{
data:$.extend({},jsBackend.formBuilder.fields.paramsSequence,
{
form_id:jsBackend.formBuilder.formId,
new_id_sequence:newIdSequence.join('|')
}),
success:function(data,textStatus)
{
						if(data.code!=200)
{
							$(this).sortable('cancel');
							jsBackend.messages.add('error','alter sequence failed.')}
						if(data.code!=200&&jsBackend.debug)alert(data.message)},
error:function(XMLHttpRequest,textStatus,errorThrown)
{
						$(this).sortable('cancel');
						jsBackend.messages.add('error','alter sequence failed.');
						if(jsBackend.debug)alert(textStatus)}
})}
})},

bindEdit:function()
{
		$(document).on('click','.editField',function(e)
{
			e.preventDefault();
			var id=$(this).attr('rel');
			if(id!='')
{
				$.ajax(
{
data:$.extend({},jsBackend.formBuilder.fields.paramsGet,
{
form_id:jsBackend.formBuilder.formId,
field_id:id
}),
success:function(data,textStatus)
{
						if(data.code==200)
{
							if(data.data.field.settings==null)data.data.field.settings={};
if(data.data.field.settings.default_values==null)data.data.field.settings.default_values='';
							if(data.data.field.type=='textbox')
{
								$('#textboxId').val(data.data.field.id);
$('#textboxLabel').val(utils.string.htmlDecode(data.data.field.settings.label));
$('#textboxValue').val(utils.string.htmlDecode(data.data.field.settings.default_values));
if(data.data.field.settings.reply_to&&data.data.field.settings.reply_to==true)$('#textboxReplyTo').prop('checked',true);
$.each(data.data.field.validations,function(k,v)
{
									if(k=='required')
{
$('#textboxRequired').prop('checked',true);
$('#textboxRequiredErrorMessage').val(utils.string.htmlDecode(v.error_message))}
									else
{
$('#textboxValidation').val(v.type);
$('#textboxErrorMessage').val(utils.string.htmlDecode(v.error_message))}
});
								$('#textboxDialog').dialog('open')}
							else if(data.data.field.type=='textarea')
{
								$('#textareaId').val(data.data.field.id);
$('#textareaLabel').val(utils.string.htmlDecode(data.data.field.settings.label));
$('#textareaValue').val(utils.string.htmlDecode(data.data.field.settings.default_values));
$.each(data.data.field.validations,function(k,v)
{
									if(k=='required')
{
$('#textareaRequired').prop('checked',true);
$('#textareaRequiredErrorMessage').val(utils.string.htmlDecode(v.error_message))}
									else
{
$('#textareaValidation').val(v.type);
$('#textareaErrorMessage').val(utils.string.htmlDecode(v.error_message))}
});
								$('#textareaDialog').dialog('open')}
							else if(data.data.field.type=='dropdown')
{
								$('#dropdownId').val(data.data.field.id);
$('#dropdownLabel').val(utils.string.htmlDecode(data.data.field.settings.label));
$('#dropdownValues').val(data.data.field.settings.values.join('|'));
$.each(data.data.field.validations,function(k,v)
{
									if(k=='required')
{
$('#dropdownRequired').prop('checked',true);
$('#dropdownRequiredErrorMessage').val(utils.string.htmlDecode(v.error_message))}
									else
{
$('#dropdownValidation').val(v.type);
$('#dropdownErrorMessage').val(utils.string.htmlDecode(v.error_message))}
});
								if(typeof data.data.field.settings.default_values!='undefined')
{
									var html='<option value="'+data.data.field.settings.default_values+'"';
html+=' selected="selected">';
html+=data.data.field.settings.default_values+'</option>';
$('#dropdownDefaultValue').append(html)}
								$('#dropdownDialog').dialog('open')}
							else if(data.data.field.type=='radiobutton')
{
								$('#radiobuttonId').val(data.data.field.id);
$('#radiobuttonLabel').val(utils.string.htmlDecode(data.data.field.settings.label));
$('#radiobuttonValues').val(data.data.field.settings.values.join('|'));
$.each(data.data.field.validations,function(k,v)
{
									if(k=='required')
{
$('#radiobuttonRequired').prop('checked',true);
$('#radiobuttonRequiredErrorMessage').val(utils.string.htmlDecode(v.error_message))}
									else
{
$('#radiobuttonValidation').val(v.type);
$('#radiobuttonErrorMessage').val(utils.string.htmlDecode(v.error_message))}
});
								if(typeof data.data.field.settings.default_values!='undefined')
{
									var html='<option value="'+data.data.field.settings.default_values+'"';
html+=' selected="selected">';
html+=data.data.field.settings.default_values+'</option>';
$('#radiobuttonDefaultValue').append(html)}
								$('#radiobuttonDialog').dialog('open')}
							else if(data.data.field.type=='checkbox')
{
								$('#checkboxId').val(data.data.field.id);
$('#checkboxLabel').val(utils.string.htmlDecode(data.data.field.settings.label));
$('#checkboxValues').val(data.data.field.settings.values.join('|'));
$.each(data.data.field.validations,function(k,v)
{
									if(k=='required')
{
$('#checkboxRequired').prop('checked',true);
$('#checkboxRequiredErrorMessage').val(utils.string.htmlDecode(v.error_message))}
									else
{
$('#checkboxValidation').val(v.type);
$('#checkboxErrorMessage').val(utils.string.htmlDecode(v.error_message))}
});
								if(typeof data.data.field.settings.default_values!='undefined')
{
									var html='<option value="'+data.data.field.settings.default_values+'"';
html+=' selected="selected">';
html+=data.data.field.settings.default_values+'</option>';
$('#checkboxDefaultValue').append(html)}
								$('#checkboxDialog').dialog('open')}
							else if(data.data.field.type=='heading')
{
								$('#headingId').val(data.data.field.id);
$('#heading').val(utils.string.htmlDecode(data.data.field.settings.values));
								$('#headingDialog').dialog('open')}
							else if(data.data.field.type=='paragraph')
{
								$('#paragraphId').val(data.data.field.id);
$('#paragraph').val(data.data.field.settings.values);
								$('#paragraphDialog').dialog('open')}
							else if(data.data.field.type=='submit')
{
								$('#submitId').val(data.data.field.id);
$('#submit').val(utils.string.htmlDecode(data.data.field.settings.values));
								$('#submitDialog').dialog('open')}
							jsBackend.formBuilder.fields.handleValidation('.validation')}
						else jsBackend.messages.add('error',textStatus);
						if(data.code!=200&&jsBackend.debug)alert(data.message)}
})}
})},

bindValidation:function()
{
		$('.validation').each(function()
{
			var wrapper=this;
			jsBackend.formBuilder.fields.handleValidation(wrapper);
			$(wrapper).find('select:first').on('change',function(){jsBackend.formBuilder.fields.handleValidation(wrapper);});
$(wrapper).find('input:checkbox').on('change',function(){jsBackend.formBuilder.fields.handleValidation(wrapper);})})},

handleValidation:function(wrapper)
{
		var required=$(wrapper).find('input:checkbox');
var validation=$(wrapper).find('select').first();
		if($(required).is(':checked'))
{
			$(wrapper).find('.validationRequiredErrorMessage').slideDown();
			if($(wrapper).find('.validationRequiredErrorMessage input:visible:first').val()=='')
{
$(wrapper).find('.validationRequiredErrorMessage input:visible:first').val(jsBackend.formBuilder.fields.defaultErrorMessages.required)}
}
else $(wrapper).find('.validationRequiredErrorMessage').slideUp();
		if($(validation).val()!='')
{
			$(wrapper).find('.validationErrorMessage').slideDown();
			$(wrapper).find('.validationErrorMessage input:visible:first').val(jsBackend.formBuilder.fields.defaultErrorMessages[$(validation).val()])}
else $(wrapper).find('.validationErrorMessage').slideUp()},

multipleTextboxCallback:function(id)
{
		var items=$('#'+id).val().split('|');
var defaultElement=$('select[rel='+id+']');
var selectedValue=$(defaultElement).find(':selected').val();
		$(defaultElement).find('option[value!=]').remove();
		$(items).each(function(k,v)
{
			if(v!='')
{
				var html='<option value="'+v+'"';
if(selectedValue==v){html+=' selected="selected"';}
html+='>'+v+'</option>';
				$(defaultElement).append(html)}
})},

resetDialog:function(id)
{
		$('#'+id).find(':input').val('').removeAttr('checked').removeAttr('selected');
		jsBackend.formBuilder.fields.handleValidation('#'+id+' .validation');
		$('#'+id+' .formError').html('');
		$('#'+id+' .tabs').tabs('select',0)},

saveCheckbox:function()
{
		var fieldId=$('#checkboxId').val();
var type='checkbox';
var label=$('#checkboxLabel').val();
var values=$('#checkboxValues').val();
var defaultValue=$('#checkboxDefaultValue').val();
var required=($('#checkboxRequired').is(':checked')?'Y':'N');
var requiredErrorMessage=$('#checkboxRequiredErrorMessage').val();
		$.ajax(
{
data:$.extend({},jsBackend.formBuilder.fields.paramsSave,
{
form_id:jsBackend.formBuilder.formId,
field_id:fieldId,
type:type,
label:label,
values:values,
default_values:defaultValue,
required:required,
required_error_message:requiredErrorMessage
}),
success:function(data,textStatus)
{
				if(data.code==200)
{
					$('.formError').html('');
					if(typeof data.data.errors!='undefined')
{
						if(typeof data.data.errors.label!='undefined'){$('#checkboxLabelError').html(data.data.errors.label);}
if(typeof data.data.errors.values!='undefined')$('#checkboxValuesError').html(data.data.errors.values);
if(typeof data.data.errors.required_error_message!='undefined')$('#checkboxRequiredErrorMessageError').html(data.data.errors.required_error_message);
if(typeof data.data.errors.error_message!='undefined')$('#checkboxErrorMessageError').html(data.data.errors.error_message);
						jsBackend.formBuilder.fields.toggleValidationErrors('checkboxDialog')}
					else
{
						jsBackend.formBuilder.fields.setField(data.data.field_id,data.data.field_html);
						$('#checkboxDialog').dialog('close')}
}
				else jsBackend.messages.add('error',textStatus);
				if(data.code!=200&&jsBackend.debug)alert(data.message)}
})},

saveDropdown:function()
{
		var fieldId=$('#dropdownId').val();
var type='dropdown';
var label=$('#dropdownLabel').val();
var values=$('#dropdownValues').val();
var defaultValue=$('#dropdownDefaultValue').val();
var required=($('#dropdownRequired').is(':checked')?'Y':'N');
var requiredErrorMessage=$('#dropdownRequiredErrorMessage').val();
		$.ajax(
{
data:$.extend({},jsBackend.formBuilder.fields.paramsSave,
{
form_id:jsBackend.formBuilder.formId,
field_id:fieldId,
type:type,
label:label,
values:values,
default_values:defaultValue,
required:required,
required_error_message:requiredErrorMessage
}),
success:function(data,textStatus)
{
				if(data.code==200)
{
					$('.formError').html('');
					if(typeof data.data.errors!='undefined')
{
						if(typeof data.data.errors.label!='undefined')$('#dropdownLabelError').html(data.data.errors.label);
if(typeof data.data.errors.values!='undefined')$('#dropdownValuesError').html(data.data.errors.values);
if(typeof data.data.errors.required_error_message!='undefined')$('#dropdownRequiredErrorMessageError').html(data.data.errors.required_error_message);
if(typeof data.data.errors.error_message!='undefined')$('#dropdownErrorMessageError').html(data.data.errors.error_message);
						jsBackend.formBuilder.fields.toggleValidationErrors('dropdownDialog')}
					else
{
						jsBackend.formBuilder.fields.setField(data.data.field_id,data.data.field_html);
						$('#dropdownDialog').dialog('close')}
}
				else jsBackend.messages.add('error',textStatus);
				if(data.code!=200&&jsBackend.debug)alert(data.message)}
})},

saveHeading:function()
{
		var fieldId=$('#headingId').val();
var type='heading';
var value=$('#heading').val();
		$.ajax(
{
data:$.extend({},jsBackend.formBuilder.fields.paramsSave,
{
form_id:jsBackend.formBuilder.formId,
field_id:fieldId,
type:type,
values:value
}),
success:function(data,textStatus)
{
				if(data.code==200)
{
					$('.formError').html('');
					if(typeof data.data.errors!='undefined')
{
						if(typeof data.data.errors.values!='undefined')$('#headingError').html(data.data.errors.values);
						jsBackend.formBuilder.fields.toggleValidationErrors('headingDialog')}
					else
{
						jsBackend.formBuilder.fields.setField(data.data.field_id,data.data.field_html);
						$('#headingDialog').dialog('close')}
}
				else jsBackend.messages.add('error',textStatus);
				if(data.code!=200&&jsBackend.debug)alert(data.message)}
})},

saveParagraph:function()
{
		var fieldId=$('#paragraphId').val();
var type='paragraph';
var value=$('#paragraph').val();
		$.ajax(
{
data:$.extend({},jsBackend.formBuilder.fields.paramsSave,
{
form_id:jsBackend.formBuilder.formId,
field_id:fieldId,
type:type,
values:value
}),
success:function(data,textStatus)
{
				if(data.code==200)
{
					$('.formError').html('');
					if(typeof data.data.errors!='undefined')
{
						if(typeof data.data.errors.values!='undefined')$('#paragraphError').html(data.data.errors.values);
						jsBackend.formBuilder.fields.toggleValidationErrors('paragraphDialog')}
					else
{
						jsBackend.formBuilder.fields.setField(data.data.field_id,data.data.field_html);
						$('#paragraphDialog').dialog('close')}
}
				else jsBackend.messages.add('error',textStatus);
				if(data.code!=200&&jsBackend.debug)alert(data.message)}
})},

saveRadiobutton:function()
{
		var fieldId=$('#radiobuttonId').val();
var type='radiobutton';
var label=$('#radiobuttonLabel').val();
var values=$('#radiobuttonValues').val();
var defaultValue=$('#radiobuttonDefaultValue').val();
var required=($('#radiobuttonRequired').is(':checked')?'Y':'N');
var requiredErrorMessage=$('#radiobuttonRequiredErrorMessage').val();
		$.ajax(
{
data:$.extend({},jsBackend.formBuilder.fields.paramsSave,
{
form_id:jsBackend.formBuilder.formId,
field_id:fieldId,
type:type,
label:label,
values:values,
default_values:defaultValue,
required:required,
required_error_message:requiredErrorMessage
}),
success:function(data,textStatus)
{
				if(data.code==200)
{
					$('.formError').html('');
					if(typeof data.data.errors!='undefined')
{
						if(typeof data.data.errors.label!='undefined')$('#radiobuttonLabelError').html(data.data.errors.label);
if(typeof data.data.errors.values!='undefined')$('#radiobuttonValuesError').html(data.data.errors.values);
if(typeof data.data.errors.required_error_message!='undefined')$('#radiobuttonRequiredErrorMessageError').html(data.data.errors.required_error_message);
if(typeof data.data.errors.error_message!='undefined')$('#radiobuttonErrorMessageError').html(data.data.errors.error_message);
						jsBackend.formBuilder.fields.toggleValidationErrors('radiobuttonDialog')}
					else
{
						jsBackend.formBuilder.fields.setField(data.data.field_id,data.data.field_html);
						$('#radiobuttonDialog').dialog('close')}
}
				else jsBackend.messages.add('error',textStatus);
				if(data.code!=200&&jsBackend.debug)alert(data.message)}
})},

saveSubmit:function()
{
		var fieldId=$('#submitId').val();
var type='submit';
var value=$('#submit').val();
		$.ajax(
{
data:$.extend({},jsBackend.formBuilder.fields.paramsSave,
{
form_id:jsBackend.formBuilder.formId,
field_id:fieldId,
type:type,
values:value
}),
success:function(data,textStatus)
{
				if(data.code==200)
{
					if(typeof data.data.errors!='undefined')
{
						if(typeof data.data.errors.values!='undefined')$('#submitError').html(data.data.errors.values);
						jsBackend.formBuilder.fields.toggleValidationErrors('submitDialog')}
					else
{
						$('#submitField').val(value);
						$('#submitDialog').dialog('close')}
					jsBackend.formBuilder.fields.toggleValidationErrors('submitDialog')}
				else jsBackend.messages.add('error',textStatus);
				if(data.code!=200&&jsBackend.debug)alert(data.message)}
})},

saveTextarea:function()
{
		var fieldId=$('#textareaId').val();
var type='textarea';
var label=$('#textareaLabel').val();
var value=$('#textareaValue').val();
var required=($('#textareaRequired').is(':checked')?'Y':'N');
var requiredErrorMessage=$('#textareaRequiredErrorMessage').val();
var validation=$('#textareaValidation').val();
var validationParameter=$('#textareaValidationParameter').val();
var errorMessage=$('#textareaErrorMessage').val();
		$.ajax(
{
data:$.extend({},jsBackend.formBuilder.fields.paramsSave,
{
form_id:jsBackend.formBuilder.formId,
field_id:fieldId,
type:type,
label:label,
default_values:value,
required:required,
required_error_message:requiredErrorMessage,
validation:validation,
validation_parameter:validationParameter,
error_message:errorMessage
}),
success:function(data,textStatus)
{
				if(data.code==200)
{
					$('.formError').html('');
					if(typeof data.data.errors!='undefined')
{
						if(typeof data.data.errors.label!='undefined')$('#textareaLabelError').html(data.data.errors.label);
if(typeof data.data.errors.required_error_message!='undefined')$('#textareaRequiredErrorMessageError').html(data.data.errors.required_error_message);
if(typeof data.data.errors.error_message!='undefined')$('#textareaErrorMessageError').html(data.data.errors.error_message);
if(typeof data.data.errors.validation_parameter!='undefined')$('#textareaValidationParameterError').html(data.data.errors.validation_parameter);
						jsBackend.formBuilder.fields.toggleValidationErrors('textareaDialog')}
					else
{
						jsBackend.formBuilder.fields.setField(data.data.field_id,data.data.field_html);
						$('#textareaDialog').dialog('close')}
}
				else jsBackend.messages.add('error',textStatus);
				if(data.code!=200&&jsBackend.debug)alert(data.message)}
})},

saveTextbox:function()
{
		var fieldId=$('#textboxId').val();
var type='textbox';
var label=$('#textboxLabel').val();
var value=$('#textboxValue').val();
var replyTo=($('#textboxReplyTo').is(':checked')?'Y':'N');
var required=($('#textboxRequired').is(':checked')?'Y':'N');
var requiredErrorMessage=$('#textboxRequiredErrorMessage').val();
var validation=$('#textboxValidation').val();
var validationParameter=$('#textboxValidationParameter').val();
var errorMessage=$('#textboxErrorMessage').val();
		$.ajax(
{
data:$.extend({},jsBackend.formBuilder.fields.paramsSave,
{
form_id:jsBackend.formBuilder.formId,
field_id:fieldId,
type:type,
label:label,
default_values:value,
reply_to:replyTo,
required:required,
required_error_message:requiredErrorMessage,
validation:validation,
validation_parameter:validationParameter,
error_message:errorMessage
}),
success:function(data,textStatus)
{
				if(data.code==200)
{
					$('.formError').html('');
					if(typeof data.data.errors!='undefined')
{
						if(typeof data.data.errors.label!='undefined')$('#textboxLabelError').html(data.data.errors.label);
if(typeof data.data.errors.required_error_message!='undefined')$('#textboxRequiredErrorMessageError').html(data.data.errors.required_error_message);
if(typeof data.data.errors.error_message!='undefined')$('#textboxErrorMessageError').html(data.data.errors.error_message);
if(typeof data.data.errors.validation_parameter!='undefined')$('#textboxValidationParameterError').html(data.data.errors.validation_parameter);
						jsBackend.formBuilder.fields.toggleValidationErrors('textboxDialog')}
					else
{
						jsBackend.formBuilder.fields.setField(data.data.field_id,data.data.field_html);
						$('#textboxDialog').dialog('close')}
}
				else jsBackend.messages.add('error',textStatus);
				if(data.code!=200&&jsBackend.debug)alert(data.message)}
})},

setField:function(fieldId,fieldHTML)
{
		if($('#fieldHolder-'+fieldId).length>=1)
{
			$('#fieldHolder-'+fieldId).after(fieldHTML);
			$('#fieldHolder-'+fieldId+':first').remove()}
		else
{
			if($('#fieldsHolder .field').length>=1)$('#fieldsHolder .field:last').after(fieldHTML);
			else $('#fieldsHolder').prepend(fieldHTML)}
		$('#fieldHolder-'+fieldId).effect("highlight",{},3000)},

toggleNoItems:function()
{
		var rowCount=$('#fieldsHolder .field').length;
		if(rowCount>=1)$('#noFields').hide();
		else $('#noFields').show()},

toggleValidationErrors:function(id)
{
		$('#'+id+' .ui-tabs-nav a').parent().removeClass('ui-state-error');
		$('#'+id+' .tabs .ui-tabs-panel').each(function()
{
			var tabId=$(this).attr('id');
			$(this).find('.formError').each(function()
{
				if($(this).html()!='')$('#'+id+' .ui-tabs-nav a[href="#'+tabId+'"]').parent().addClass('ui-state-error')})});
		$("#"+id).find('.formError').each(function()
{
			if($(this).html()!='')$(this).show();
			else $(this).hide()})}
}
$(jsBackend.formBuilder.init);
