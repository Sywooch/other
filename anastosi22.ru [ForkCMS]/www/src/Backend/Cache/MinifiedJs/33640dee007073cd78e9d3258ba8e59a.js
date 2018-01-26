

(function($)
{
$.fn.doMeta=function(options)
{
		var defaults={};
		var options=$.extend(defaults,options);
		return this.each(function()
{
			$element=$(this);
$pageTitle=$('#pageTitle');
$pageTitleOverwrite=$('#pageTitleOverwrite');
$navigationTitle=$('#navigationTitle');
$navigationTitleOverwrite=$('#navigationTitleOverwrite');
$metaDescription=$('#metaDescription');
$metaDescriptionOverwrite=$('#metaDescriptionOverwrite');
$metaKeywords=$('#metaKeywords');
$metaKeywordsOverwrite=$('#metaKeywordsOverwrite');
$urlOverwrite=$('#urlOverwrite');
			$element.bind('keyup',calculateMeta);
			if($pageTitle.length>0&&$pageTitleOverwrite.length>0)
{
$pageTitleOverwrite.change(function(e)
{
if(!$element.is(':checked'))$pageTitle.val($element.val())})}
if($navigationTitle.length>0&&$navigationTitleOverwrite.length>0)
{
$navigationTitleOverwrite.change(function(e)
{
if(!$element.is(':checked'))$navigationTitle.val($element.val())})}
$metaDescriptionOverwrite.change(function(e)
{
if(!$element.is(':checked'))$metaDescription.val($element.val())});
$metaKeywordsOverwrite.change(function(e)
{
if(!$element.is(':checked'))$metaKeywords.val($element.val())});
$urlOverwrite.change(function(e)
{
if(!$element.is(':checked'))generateUrl($element.val())});
			function generateUrl(url)
{
				$.ajax(
{
data:
{
fork:{module:'Core',action:'GenerateUrl'},
url:url,
metaId:$('#metaId').val(),
baseFieldName:$('#baseFieldName').val(),
custom:$('#custom').val(),
className:$('#className').val(),
methodName:$('#methodName').val(),
parameters:$('#parameters').val()
},
success:function(data,textStatus)
{
url=data.data;
$('#url').val(url);
$('#generatedUrl').html(url)},
error:function(XMLHttpRequest,textStatus,errorThrown)
{
url=utils.string.urlDecode(utils.string.urlise(url));
$('#url').val(url);
$('#generatedUrl').html(url)}
})}
			function calculateMeta(e,element)
{
var title=(typeof element!='undefined')?element.val():$(this).val();
if($pageTitle.length>0&&$pageTitleOverwrite.length>0)
{
if(!$pageTitleOverwrite.is(':checked'))$pageTitle.val(title)}
if($navigationTitle.length>0&&$navigationTitleOverwrite.length>0)
{
if(!$navigationTitleOverwrite.is(':checked'))$navigationTitle.val(title)}
if(!$metaDescriptionOverwrite.is(':checked'))$metaDescription.val(title);
if(!$metaKeywordsOverwrite.is(':checked'))$metaKeywords.val(title);
if(!$urlOverwrite.is(':checked'))
{
if(typeof pageID=='undefined'||pageID!=1)
{
generateUrl(title)}
}
}
})}})(jQuery);

(function($)
{
$.fn.passwordGenerator=function(options)
{
		var defaults=
{
length:6,
uppercase:true,
lowercase:true,
numbers:true,
specialchars:false,
generateLabel:'Generate'
};
		var options=$.extend(defaults,options);
return this.each(function()
{
var id=$(this).attr('id');
			$(this).parent().after('<div class="buttonHolder"><a href="#" data-id="'+id+'" class="generatePasswordButton button"><span>'+options.generateLabel+'</span></a></div>');
$('.generatePasswordButton').live('click',generatePassword);
function generatePassword(e)
{
				e.preventDefault();
var currentElement=$('#'+$(this).data('id'));
				if(currentElement.attr('type')!='text')
{
					var newElement=$('<input value="" id="'+currentElement.attr('id')+'" name="'+currentElement.attr('name')+'" maxlength="'+currentElement.attr('maxlength')+'" class="'+currentElement.attr('class')+'" type="text">');
					newElement.insertBefore(currentElement);
					currentElement.remove()}
				else newElement=currentElement;
				var pass=generatePass(options.length,options.uppercase,options.lowercase,options.numbers,options.specialchars);
				newElement.val(pass).keyup()}
function generatePass(length,uppercase,lowercase,numbers,specialchars)
{
				var v=new Array('a','e','u','ae','ea');
				var c=new Array('b','c','d','g','h','j','k','m','n','p','r','s','t','u','v','w','tr','cr','fr','dr','wr','pr','th','ch','ph','st');
				var n=[];
n['a']=4;n['b']=8;n['e']=3;n['g']=6;n['l']=1;n['o']=0;n['s']=5;n['t']=7;n['z']=2;
				var s=[];
s['a']='@';s['i']='!';s['c']='ç';s['s']='$';s['g']='&';s['h']='#';s['l']='|';s['x']='%';
				var pass='';
var tmp='';
				for(i=0;i<length;i++)tmp+=c[Math.floor(Math.random()* c.length)]+v[Math.floor(Math.random()* v.length)];
				for(i=0;i<length;i++)
{
if(Math.floor(Math.random()*2))pass+=tmp.substr(i,1).toUpperCase();
else pass+=tmp.substr(i,1)}
				if(numbers)
{
tmp='';
for(var i in pass){
						if(typeof n[pass[i].toLowerCase()]!='undefined'&&(Math.floor(Math.random()*4)%3)==1)tmp+=n[pass[i].toLowerCase()];
else tmp+=pass[i]}
pass=tmp}
				if(specialchars)
{
tmp='';
for(var i in pass)
{
						if(typeof s[pass[i].toLowerCase()]!='undefined'&&(Math.floor(Math.random()*4)%2))tmp+=s[pass[i].toLowerCase()];
else tmp+=pass[i]}
pass=tmp}
				if(!uppercase)pass=pass.toLowerCase();
				if(!lowercase)pass=pass.toUpperCase();
				return pass}
})}})(jQuery);

(function($)
{
$.fn.inlineTextEdit=function(options)
{
		var defaults=
{
params:{},
current:{},
extraParams:{},
inputClasses:'inputText',
allowEmpty:false,
tooltip:'click to edit',
afterSave:null
};
		var options=$.extend(defaults,options);
		var editing=false;
		return this.each(function()
{
			var $this=$(this);
			$this.html('<span>'+$this.html()+'</span><span style="display: none;" class="inlineEditTooltip">'+options.tooltip+'</span>');
			$span=$this.find('span');
var element=$span.eq(0);
var tooltip=$span.eq(1);
			element.bind('click focus',createElement);
tooltip.bind('click',createElement);
$this.hover(
function()
{
$this.addClass('inlineEditHover');
tooltip.show()},
function()
{
$this.removeClass('inlineEditHover');
tooltip.hide()}
);
			function createElement()
{
				if(editing)return;
				editing=true;
				options.current.value=element.html();
				var $this=$(this);
				if($this.parent().data('id')!='')
{
options.current.extraParams=eval('('+$this.parent().data('id')+')')}
				element.addClass('inlineEditing');
				element.unbind('click').unbind('focus');
				options.current.value=utils.string.replaceAll(options.current.value,'"','&quot;');
				element.html('<input type="text" class="'+options.inputClasses+'" value="'+options.current.value+'" />');
				options.current.element=$(element.find('input')[0]);
				options.current.element.select();
				options.current.element.bind('blur',saveElement);
options.current.element.keyup(function(e)
{
					if(e.which==27)
{
						options.current.element.val(options.current.value);
						destroyElement()}
					if(e.which==13)saveElement()})}
			function destroyElement()
{
				var parent=options.current.element.parent();
				var newValue=options.current.element.val();
newValue=utils.string.replaceAll(newValue,'"','&quot;');
newValue=utils.string.replaceAll(newValue,'<','&lt;');
newValue=utils.string.replaceAll(newValue,'>','&gt;');
				parent.html(newValue).bind('click focus',createElement);
				parent.removeClass('inlineEditing');
				editing=false}
			function saveElement()
{
				if(!options.allowEmpty&&options.current.element.val()=='')
{
options.current.element.val(options.current.value)}
				if(options.current.element.val()!=options.current.value)
{
					options.current.extraParams['value']=options.current.element.val();
					$.ajax(
{
data:$.extend(options.params,options.current.extraParams),
success:function(data,textStatus)
{
							if(typeof options.afterSave=='function')eval(options.afterSave)($this);
							destroyElement()},
error:function(XMLHttpRequest,textStatus,errorThrown)
{
							options.current.element.val(options.current.value);
							destroyElement();
							jsBackend.messages.add('error',$.parseJSON(XMLHttpRequest.responseText).message)}
})}
				else destroyElement()}
})}})(jQuery);

(function($)
{
$.fn.keyValueBox=function(options)
{
		var defaults=
{
splitChar:',',
secondSplitChar:'|',
emptyMessage:'',
errorMessage:'Add the item before submitting',
addLabel:'add',
removeLabel:'delete',
params:{},
showIconOnly:true,
multiple:true
};
		var options=$.extend(defaults,options);
		return this.each(function()
{
			var id=$(this).attr('id');
var elements=get();
var blockSubmit=false;
var timer=null;
			$('label[for="'+id+'"]').attr('for','addValue-'+id);
			$(this.form).submit(function(e)
{
				$('#errorMessage-'+id).remove();
if(blockSubmit&&$('#addValue-'+id).val().replace(/^\s+|\s+$/g,'')!='')
{
					$('#addValue-'+id).parents('.oneLiner').append('<span style="display: none;" id="errorMessage-'+id+'" class="formError">'+options.errorMessage+'</span>');
					clearTimeout(timer);
					timer=setTimeout(function(){$('#errorMessage-'+id).show();},200)}
return!blockSubmit});
			var html='<div class="tagsWrapper">'+'	<div class="oneLiner">'+'		<p><input class="inputText dontSubmit" id="addValue-'+id+'" name="addValue-'+id+'" type="text" /></p>'+'		<div class="buttonHolder">'+'			<a href="#" id="addButton-'+id+'" class="button icon iconAdd disabledButton';
if(options.showIconOnly)html+=' iconOnly';
html+='">'+'				<span>'+options.addLabel+'</span>'+'			</a>'+'		</div>'+'	</div>'+'	<div id="elementList-'+id+'" class="tagList">'+'	</div>'+'</div>';
			$(this).css('visibility','hidden').css('position','absolute').css('top','-9000px').css('left','-9000px').attr('tabindex','-1');
			$(this).before(html);
			build();
			if(!$.isEmptyObject(options.params))
{
$('#addValue-'+id).autocomplete(
{
delay:200,
minLength:2,
source:function(request,response)
{
$.ajax(
{
data:$.extend(options.params,{term:request.term}),
success:function(data,textStatus)
{
								var realData=[];
								if(data.code!=200&&jsBackend.debug)
{
alert(data.message)}
if(data.code==200)
{
for(var i in data.data)
{
realData.push(
{
label:data.data[i].name,
value:data.data[i].value+options.secondSplitChar+data.data[i].name
})}
}
								response(realData)}
})}
})}
			$('#addValue-'+id).bind('keyup',function(e)
{
blockSubmit=true;
				var code=e.which;
				$('#errorMessage-'+id).remove();
				if(code==13||String.fromCharCode(code)==options.splitChar)
{
					$('#errorMessage-'+id).remove();
					e.preventDefault();
e.stopPropagation();
					add()}
				if($(this).val().replace(/^\s+|\s+$/g,'')=='')
{
blockSubmit=false;
$('#addButton-'+id).addClass('disabledButton')}
else $('#addButton-'+id).removeClass('disabledButton')});
			$('#addButton-'+id).bind('click',function(e)
{
				e.preventDefault();
e.stopPropagation();
				add()});
			$('.deleteButton-'+id).live('click',function(e)
{
				e.preventDefault();
e.stopPropagation();
				remove($(this).attr('rel'))});
			function add()
{
blockSubmit=false;
				var value=$('#addValue-'+id).val().replace(/^\s+|\s+$/g,'');
var inElements=false;
				value=$('<div />').text(value).html().replace('"','&quot;');
				if(value.split(options.secondSplitChar).length==1)value='';
				if(!options.multiple)elements=[];
				$('#addValue-'+id).val('').focus();
$('#addButton-'+id).addClass('disabledButton');
				$('#errorMessage-'+id).remove();
				if(value!='')
{
					for(var i in elements)
{
if(value==elements[i])inElements=true}
					if(!inElements)
{
						elements.push(value);
						$('#'+id).val(elements.join(options.splitChar));
						build()}
}
}
			function build()
{
				var html='';
				if(elements.length==0&&options.emptyMessage!='')html='<p class="helpTxt">'+options.emptyMessage+'</p>';
				else
{
					html='<ul>';
					for(var i in elements)
{
var humanValue=elements[i].split(options.secondSplitChar)[1];
html+='	<li><span><strong>'+humanValue+'</strong>'+'		<a href="#" class="deleteButton-'+id+'" rel="'+elements[i]+'" title="'+options.removeLabel+'">'+options.removeLabel+'</a></span>'+'	</li>'}
					html+='</ul>'}
				$('#elementList-'+id).html(html)}
			function get()
{
				var chunks=$('#'+id).val().split(options.splitChar);
var elements=[];
				for(var i in chunks)
{
value=chunks[i].replace(/^\s+|\s+$/g,'');
if(value!='')elements.push(value)}
return elements}
			function remove(value)
{
				var index=$.inArray(value,elements);
				if(index>-1)elements.splice(index,1);
				$('#'+id).val(elements.join(options.splitChar));
				build()}
})}})(jQuery);

(function($)
{
$.fn.tagBox=function(options)
{
		var defaults=
{
splitChar:',',
emptyMessage:'',
errorMessage:'Add the tag before submitting',
addLabel:'add',
removeLabel:'delete',
params:{},
canAddNew:false,
showIconOnly:true,
multiple:true
};
		var options=$.extend(defaults,options);
		return this.each(function()
{
			var id=$(this).attr('id');
var elements=get();
var blockSubmit=false;
var timer=null;
			$('label[for="'+id+'"]').attr('for','addValue-'+id);
			$(this.form).submit(function(e)
{
				$('#errorMessage-'+id).remove();
if(blockSubmit&&$('#addValue-'+id).val().replace(/^\s+|\s+$/g,'')!='')
{
					$('#addValue-'+id).parents('.oneLiner').append('<span style="display: none;" id="errorMessage-'+id+'" class="formError">'+options.errorMessage+'</span>');
					clearTimeout(timer);
					timer=setTimeout(function(){$('#errorMessage-'+id).show();},200)}
return!blockSubmit});
			var html='<div class="tagsWrapper">'+
'	<div class="oneLiner">'+
'		<p><input class="inputText dontSubmit" id="addValue-'+id+'" name="addValue-'+id+'" type="text" /></p>'+
'		<div class="buttonHolder">'+
'			<a href="#" id="addButton-'+id+'" class="button icon iconAdd disabledButton';
if(options.showIconOnly)html+=' iconOnly';
html+='">'+
'				<span>'+options.addLabel+'</span>'+
'			</a>'+
'		</div>'+
'	</div>'+
'	<div id="elementList-'+id+'" class="tagList">'+
'	</div>'+
'</div>';
			$(this).css('visibility','hidden').css('position','absolute').css('top','-9000px').css('left','-9000px').attr('tabindex','-1');
			$(this).before(html);
			build();
			if(!$.isEmptyObject(options.params))
{
$('#addValue-'+id).autocomplete(
{
delay:200,
minLength:2,
source:function(request,response)
{
$.ajax(
{
data:$.extend(options.params,{term:request.term}),
success:function(data,textStatus)
{
								var realData=[];
								if(data.code!=200&&jsBackend.debug)
{
alert(data.message)}
if(data.code==200)
{
for(var i in data.data)
{
realData.push(
{
label:data.data[i].name,
value:data.data[i].name
})}
}
								response(realData)}
})}
})}
			$('#addValue-'+id).bind('keyup',function(e)
{
blockSubmit=true;
				var code=e.which;
				$('#errorMessage-'+id).remove();
				if(code==13||$(this).val().indexOf(options.splitChar)!=-1)
{
					$('#errorMessage-'+id).remove();
					e.preventDefault();
e.stopPropagation();
					add()}
				if($(this).val().replace(/^\s+|\s+$/g,'')=='')
{
blockSubmit=false;
$('#addButton-'+id).addClass('disabledButton')}
else $('#addButton-'+id).removeClass('disabledButton')});
			$('#addButton-'+id).bind('click',function(e)
{
				e.preventDefault();
e.stopPropagation();
				add()});
			$('.deleteButton-'+id).live('click',function(e)
{
				e.preventDefault();
e.stopPropagation();
				remove($(this).data('id'))});
			function add()
{
blockSubmit=false;
				var value=$('#addValue-'+id).val().replace(/^\s+|\s+$/g,'').replace(options.splitChar,'');
var inElements=false;
				value=$('<div />').text(value).html().replace('"','&quot;');
				if(!options.multiple)elements=[];
				$('#addValue-'+id).val('').focus();
$('#addButton-'+id).addClass('disabledButton');
				$('#errorMessage-'+id).remove();
				if(value!='')
{
					for(var i in elements)
{
if(value==elements[i])inElements=true}
					if(!inElements)
{
						elements.push(value);
						$('#'+id).val(elements.join(options.splitChar));
						build()}
}
}
			function build()
{
				var html='';
				if(elements.length==0&&options.emptyMessage!='')html='<p class="helpTxt">'+options.emptyMessage+'</p>';
				else
{
					html='<ul>';
					for(var i in elements)
{
html+='	<li><span><strong>'+elements[i]+'</strong>'+
'		<a href="#" class="deleteButton-'+id+'" data-id="'+elements[i]+'" title="'+options.removeLabel+'">'+options.removeLabel+'</a></span>'+
'	</li>'}
					html+='</ul>'}
				$('#elementList-'+id).html(html)}
			function get()
{
				var chunks=$('#'+id).val().split(options.splitChar);
var elements=[];
				for(var i in chunks)
{
value=chunks[i].replace(/^\s+|\s+$/g,'');
if(value!='')elements.push(value)}
return elements}
			function remove(value)
{
				var index=$.inArray(String(value),elements);
				if(index>-1)elements.splice(index,1);
				$('#'+id).val(elements.join(options.splitChar));
				build()}
})}})(jQuery);

(function($)
{
$.fn.multipleSelectbox=function(options)
{
		var defaults=
{
splitChar:',',
emptyMessage:'',
addLabel:'add',
removeLabel:'delete',
showIconOnly:false,
afterAdd:null,
afterBuild:null,
maxItems:null
};
		var options=$.extend(defaults,options);
		return this.each(function()
{
			var id=$(this).attr('id');
var possibleOptions=$(this).find('option');
var elements=get();
var blockSubmit=false;
			$(this.form).submit(function()
{
return!blockSubmit});
			if($('#elementList-'+id).length>0)
{
$('#elementList-'+id).parent('.multipleSelectWrapper').remove()}
			var html='<div class="multipleSelectWrapper">'+
'	<div id="elementList-'+id+'" class="multipleSelectList">'+'	</div>'+
'	<div class="oneLiner">'+
'		<p>'+
'			<select class="select dontSubmit" id="addValue-'+id+'" name="addValue-'+id+'">';
for(var i=0;i<possibleOptions.length;i++)
{
html+='				<option value="'+$(possibleOptions[i]).attr('value')+'">'+$(possibleOptions[i]).html()+'</option>'}
html+='			</select>'+
'		</p>'+
'		<div class="buttonHolder">'+
'			<a href="#" id="addButton-'+id+'" class="button icon iconAdd';
if(options.showIconOnly)html+=' iconOnly';
html+='">'+
'				<span>'+options.addLabel+'</span>'+
'			</a>'+
'		</div>'+
'	</div>'+
'</div>';
			$(this).css('visibility','hidden').css('position','absolute').css('top','-9000px').css('left','-9000px').attr('tabindex','-1');
			$(this).before(html);
			build();
			$('#addButton-'+id).bind('click',function(e)
{
				e.preventDefault();
e.stopPropagation();
if(options.maxItems!==null&&elements.length>=options.maxItems)return;
				add()});
			$('.deleteButton-'+id).live('click',function(e)
{
				e.preventDefault();
e.stopPropagation();
				remove($(this).data('id'))});
			function add()
{
blockSubmit=false;
				var value=$('#addValue-'+id).val();
var inElements=false;
				value=$('<div />').text(value).html().replace('"','&quot;');
				$('#addValue-'+id).focus();
				if(value!=null&&value!='')
{
					for(var i in elements)
{
if(value==elements[i])inElements=true}
					if(!inElements)
{
						elements.push(value);
						$('#'+id).val(elements);
						if(options.afterAdd!=null){options.afterAdd(value);}
						build()}
}
}
			function build()
{
				var html='';
				if(elements.length==0&&options.emptyMessage!='')html='<p class="helpTxt">'+options.emptyMessage+'</p>';
				else
{
					html='<ul>';
					for(var i in elements)
{
html+='	<li class="oneLiner">'+
'		<p><span style="width: '+$('#'+id).width()+'px">'+$('#'+id+' option[value='+elements[i]+']').html()+'</span></p>'+
'		<div class="buttonHolder">'+
'			<a href="#" class="button icon iconDelete iconOnly deleteButton-'+id+'" data-id="'+elements[i]+'" title="'+options.removeLabel+'">'+
'				<span>'+options.removeLabel+'</span></a>'+
'			</a>'+
'		</div>'+
'	</li>';
						$('#addValue-'+id+' option[value='+elements[i]+']').prop('disabled',true)}
					html+='</ul>'}
				$('#elementList-'+id).html(html);
				$('#addButton-'+id).removeClass('disabledButton');
$('#addValue-'+id).removeClass('disabled').prop('disabled',false);
if($('#addValue-'+id+' option:enabled').length==0||(options.maxItems!==null&&elements.length>=options.maxItems))
{
$('#addButton-'+id).addClass('disabledButton');
$('#addValue-'+id).addClass('disabled').prop('disabled',true)}
$('#addValue-'+id).val($('#addValue-'+id+' option:enabled:first').attr('value'));
				if(options.afterBuild!=null){options.afterBuild(id);}
}
			function get()
{
				var chunks=$('#'+id).val();
var elements=[];
				for(var i in chunks)
{
value=chunks[i].replace(/^\s+|\s+$/g,'');
if(value!='')elements.push(value)}
return elements}
			function remove(value)
{
				var index=$.inArray(value.toString(),elements);
				if(index>-1)elements.splice(index,1);
				$('#'+id).val(elements);
$('#addValue-'+id+' option[value='+value+']').prop('disabled',false);
				build()}
})}})(jQuery);

(function($)
{
$.fn.multipleTextbox=function(options)
{
		var defaults={
splitChar:',',
emptyMessage:'',
addLabel:'add',
removeLabel:'delete',
params:{},
canAddNew:false,
showIconOnly:false,
afterBuild:null
};
		var options=$.extend(defaults,options);
		return this.each(function()
{
			var id=$(this).attr('id');
var elements=get();
var blockSubmit=false;
			$(this.form).submit(function()
{
return!blockSubmit});
			if($('#elementList-'+id).length>0)
{
$('#elementList-'+id).parent('.multipleTextWrapper').remove()}
			var html='<div class="multipleTextWrapper">'+'	<div id="elementList-'+id+'" class="multipleTextList">'+'	</div>'+'	<div class="oneLiner">'+'		<p><input class="inputText dontSubmit" id="addValue-'+id+'" name="addValue-'+id+'" type="text" /></p>'+'		<div class="buttonHolder">'+'			<a href="#" id="addButton-'+id+'" class="button icon iconAdd disabledButton';
if(options.showIconOnly)html+=' iconOnly';
html+='">'+'				<span>'+options.addLabel+'</span>'+'			</a>'+'		</div>'+'	</div>'+'</div>';
			$(this).css('visibility','hidden').css('position','absolute').css('top','-9000px').css('left','-9000px').attr('tabindex','-1');
			$(this).before(html);
			build();
			if(!$.isEmptyObject(options.params))
{
$('#addValue-'+id).autocomplete(
{
delay:200,
minLength:2,
source:function(request,response)
{
$.ajax(
{
data:$.extend(options.params,{term:request.term}),
success:function(data,textStatus)
{
								var realData=[];
								if(data.code!=200&&jsBackend.debug)
{
alert(data.message)}
if(data.code==200)
{
for(var i in data.data)
{
realData.push(
{
label:data.data[i].name,
value:data.data[i].name
})}
}
								response(realData)}
})}
})}
			$('#addValue-'+id).bind('keyup',function(e)
{
				blockSubmit=true;
				var code=e.which;
				if(code==13||$(this).val().indexOf(options.splitChar)!=-1)
{
					e.preventDefault();
e.stopPropagation();
					add()}
				if($(this).val().replace(/^\s+|\s+$/g,'')=='')
{
blockSubmit=false;
$('#addButton-'+id).addClass('disabledButton')}
else $('#addButton-'+id).removeClass('disabledButton')});
			$('#addValue-'+id).bind('blur',function(e){blockSubmit=false;add();});
			$('#addButton-'+id).bind('click',function(e)
{
				e.preventDefault();
e.stopPropagation();
				add()});
			$(document).on('click','.deleteButton-'+id,function(e)
{
				e.preventDefault();
e.stopPropagation();
				remove($(this).data('id'))});
			$(document).on('keyup','.inputField-'+id,function(e)
{
				elements=[];
				$('.inputField-'+id).each(function()
{
					var value=$(this).val().replace(/^\s+|\s+$/g,'');
					if(value=='')
{
$(this).parent().parent().remove()}
					else elements.push(value)});
				$('#'+id).val(elements.join(options.splitChar))});
			function add()
{
				blockSubmit=false;
				var value=$('#addValue-'+id).val().replace(/^\s+|\s+$/g,'');
var inElements=false;
				value=$('<div />').text(value).html().replace('"','&quot;');
				$('#addValue-'+id).val('').focus();
$('#addButton-'+id).addClass('disabledButton');
var values=value.split(options.splitChar);
for(var e in values){
value=values[e];
					if(value!='')
{
						for(var i in elements)
{
if(value==elements[i])inElements=true}
						if(!inElements)
{
							elements.push(value);
							$('#'+id).val(elements.join(options.splitChar));
							build()}
}
}
}
			function build()
{
				var html='';
				if(elements.length==0&&options.emptyMessage!='')html='<p class="helpTxt">'+options.emptyMessage+'</p>';
				else
{
					html='<ul>';
					for(var i in elements)
{
html+='	<li class="oneLiner">'+
'		<p><input class="inputText dontSubmit inputField-'+id+'" name="inputField-'+id+'[]" type="text" value="'+elements[i]+'" /></p>'+
'		<div class="buttonHolder">'+
'			<a href="#" class="button icon iconDelete iconOnly deleteButton-'+id+'" data-id="'+elements[i]+'" title="'+options.removeLabel+'"><span>'+options.removeLabel+'</span></a>'+
'		</div>'+
'	</li>'}
					html+='</ul>'}
				$('#elementList-'+id).html(html);
				if(options.afterBuild!=null){options.afterBuild(id);}
}
			function get()
{
				var chunks=$('#'+id).val().split(options.splitChar);
var elements=[];
				for(var i in chunks)
{
value=chunks[i].replace(/^\s+|\s+$/g,'');
if(value!='')elements.push(value)}
return elements}
			function remove(value)
{
				var index=$.inArray(value,elements);
				if(index>-1)elements.splice(index,1);
				$('#'+id).val(elements.join(options.splitChar));
				build()}
})}})(jQuery);
