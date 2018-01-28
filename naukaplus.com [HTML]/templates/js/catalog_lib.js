$(document).ready(function(){
	  
$('.MultiFile').MultiFile({ 
	accept:'jpg', max:100, STRING: { 
		remove:'�������',
		file:'$file', 
		selected:'�������: $file', 
		denied:'�������� ��� �����: $ext!', 
		duplicate:'���� ���� ��� ������:\n$file!' 
	} 
});		  
	  
$("#loading").ajaxStart(function(){
	$(this).show();
})
.ajaxComplete(function(){
	$(this).hide();
});
	  

$('#uploadForm').ajaxForm({
	beforeSubmit: function(a,f,o) {
		o.dataType = "html";

	},
	success: function(data) {
		var $out = $('#uploadOutput');
		if (typeof data == 'object' && data.nodeType)
			data = elementToString(data.documentElement, true);
		else if (typeof data == 'object')
			data = objToString(data);
		$out.empty();
		$out.append('<div><pre>'+ data +'</pre></div>');
	}
});
});