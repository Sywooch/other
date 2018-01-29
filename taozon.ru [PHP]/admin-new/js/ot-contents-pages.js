var Contents = new Backbone.Collection();
var ContentsPage = Backbone.View.extend(
{
    "el": ".contents-wrapper",
    "events": {
		"click #ot-content-pages-tab li.edit-page": "editPage",
		"click #ot-content-pages-tab li.delete-page": "removeContentPage",
		"click #ot-content-pages-tab li.add-page": "addContentPage",
		"click #ot-content-service-pages-tab a.edit-page": "editPage",
		"click .ot-edit-page-form .btn-primary": "savePage",
		"change .ot-edit-page-form #page-level" : "changePageLevel",		
		"keypress .ot-edit-page-form #title": "titlePressKey",
		"change .ot-edit-page-form #title": "titleChange",
    },
    changePageLevel: function(e)
    {
    	var value = $('option:selected',$(e.currentTarget)).val();
    	if (value == 'page') {
    		$('.page-menu-section').show();
    		$('.page-parent-section').hide();
    	} else {
    		$('.page-menu-section').hide();
    		$('.page-parent-section').show();
    	}
    },
    savePage: function(e)
    {
    	var form = $(e.currentTarget).closest('form');
    	var content = tinyMCE.editors[0].getContent();//$('.confirmDialog .modal-body #seoText1').html()); 
    	$('#page-content', form).val(content);
    	
    	$(form).ajaxSubmit({
            url     :   $(this).attr('action'),
            type    :   'POST',
            dataType:   'json',
            success :   function(data) {
            	if(data && data.result && data.result == 'ok') {
            		showMessage(trans.get('contents::Page_saved_successfully'));
            		document.location.href = 'index.php?cmd=contents&do=default';
            	} else {
            		showError(data);
            	}
             }
        });
    },
    render: function()
    {
    	return this;
    },
    titlePressKey: function(event) 
    {
    	var char = '';
    	if (event.which == null) {  // IE
    		if (event.keyCode < 32) {
    			return null; // спец. символ
    		} 
    		char = String.fromCharCode(event.keyCode)
    	}
    	if (event.which != 0 && event.charCode != 0) { // все кроме IE
    		if (event.which < 32) return null; // спец. символ
    		char = String.fromCharCode(event.which); // остальные
    	}
    	
    	var value = $(event.currentTarget).val() + char;
    	if (! $('.ot-edit-page-form  #page-title').attr('original-value')) {
    		$('.ot-edit-page-form  #page-title').val(value);
    	}
    	if (! $('.ot-edit-page-form  #titleh1').attr('original-value')) {
    		$('.ot-edit-page-form  #titleh1').val(value);
    	}
    	if (! $('.ot-edit-page-form  #alias').attr('original-value')) {
    		$('.ot-edit-page-form  #alias').val(this.cyr2lat(value));
    	}
    },
    titleChange: function(event) 
    {
    	var value = $(event.currentTarget).val();
    	if (! $('.ot-edit-page-form  #page-title').attr('original-value')) {
    		$('.ot-edit-page-form  #page-title').val(value);
    	}
    	if (! $('.ot-edit-page-form  #titleh1').attr('original-value')) {
    		$('.ot-edit-page-form  #titleh1').val(value);
    	}
    	if (! $('.ot-edit-page-form  #alias').attr('original-value')) {
    		$('.ot-edit-page-form  #alias').val(this.cyr2lat(value));
    	}
    },
    initialize: function()
    {
    	var self = this;
        this.render();
        
        tinyMCE.init({
            mode : "exact",
            elements : "page-content",
            theme : "advanced",
            height: 230,
            plugins : "table,heading,advhr,advimage,advlink,paste,fullscreen,noneditable,contextmenu,inlinepopups,emotions,media,insertdatetime,nonbreaking",
            theme_advanced_buttons1_add_before : "newdocument,separator",
            theme_advanced_buttons1_add_before : "fontselect,fontsizeselect,h1,h2,h3,h4,h5,h6,separator",
            theme_advanced_buttons2_add : "separator,forecolor,backcolor,liststyle,separator,insertdate,inserttime",
            theme_advanced_buttons2_add_before: "cut,copy,paste,pastetext,pasteword,separator",
            theme_advanced_buttons3_add_before : "tablecontrols,separator",
            theme_advanced_buttons3_add : "flash,advhr,emotions,media,nonbreaking,separator,fullscreen",
            theme_advanced_toolbar_location : "top",
            theme_advanced_toolbar_align : "left",
            extended_valid_elements : "hr[class|width|size|noshade],ul[class=listUL],ol[class=listOL],script[language|type|src], object[width|height|classid|codebase|embed|param],param[name|value],embed[param|src|type|width|height|flashvars|wmode], iframe[src|style|width|height|scrolling|marginwidth|marginheight|frameborder]",
            media_strict: false,
            file_browser_callback : "ajaxfilemanager",
            paste_use_dialog : false,
            theme_advanced_resizing : true,
            theme_advanced_resize_horizontal : true,
            apply_source_formatting : true,
            force_br_newlines : true,
            forced_root_block : "div",
            force_p_newlines : false,
            relative_urls : true,
            heading_clear_tag : "p",
            content_css : "../css/style.css"
        });
        var a = $('#activeLanguagesContainer ul.dropdown-menu li a[data-value=""]');
        var li = $(a).closest('li');
        $(li).remove();
    },
    editPage: function(e)
    {
    	
    	var tr = $(e.currentTarget).closest('tr');
    	var pageId = $(tr).attr('id');
    	document.location.href = 'index.php?cmd=contents&do=editPage&id='+pageId;
    	return false;
    },
    removeContentPage: function(e)
    {
    	var tr = $(e.currentTarget).closest('tr');
    	var pageId = $(tr).attr('id');
    	
    	modalDialog(trans.get('Confirm_needed'), trans.get('contents::Really_remove_this_page'), function() {
    		$.post('index.php?cmd=contents&do=deletePage', { 'id' : pageId}, function (data) {
                if (data.result == 'ok') {
                	$(tr).remove();
                }
            }, 'json');    		
        });
    },
    addContentPage: function(e)
    {
    	var tr = $(e.currentTarget).closest('tr');
    	var id = $(tr).attr('id');
    	
    	document.location.href = 'index.php?cmd=contents&do=addNewPage&parentId='+id + '&type=sub_page';
    	return false;
    },
    cyr2lat: function(str) {
    	 
        var cyr2latChars = new Array(
    ['а', 'a'], ['б', 'b'], ['в', 'v'], ['г', 'g'],
    ['д', 'd'],  ['е', 'e'], ['ё', 'yo'], ['ж', 'zh'], ['з', 'z'],
    ['и', 'i'], ['й', 'y'], ['к', 'k'], ['л', 'l'],
    ['м', 'm'],  ['н', 'n'], ['о', 'o'], ['п', 'p'],  ['р', 'r'],
    ['с', 's'], ['т', 't'], ['у', 'u'], ['ф', 'f'],
    ['х', 'h'],  ['ц', 'c'], ['ч', 'ch'],['ш', 'sh'], ['щ', 'shch'],
    ['ъ', ''],  ['ы', 'y'], ['ь', ''],  ['э', 'e'], ['ю', 'yu'], ['я', 'ya'],
     
    ['А', 'A'], ['Б', 'B'],  ['В', 'V'], ['Г', 'G'],
    ['Д', 'D'], ['Е', 'E'], ['Ё', 'YO'],  ['Ж', 'ZH'], ['З', 'Z'],
    ['И', 'I'], ['Й', 'Y'],  ['К', 'K'], ['Л', 'L'],
    ['М', 'M'], ['Н', 'N'], ['О', 'O'],  ['П', 'P'],  ['Р', 'R'],
    ['С', 'S'], ['Т', 'T'],  ['У', 'U'], ['Ф', 'F'],
    ['Х', 'H'], ['Ц', 'C'], ['Ч', 'CH'], ['Ш', 'SH'], ['Щ', 'SHCH'],
    ['Ъ', ''],  ['Ы', 'Y'],
    ['Ь', ''],
    ['Э', 'E'],
    ['Ю', 'YU'],
    ['Я', 'YA'],
     
    ['a', 'a'], ['b', 'b'], ['c', 'c'], ['d', 'd'], ['e', 'e'],
    ['f', 'f'], ['g', 'g'], ['h', 'h'], ['i', 'i'], ['j', 'j'],
    ['k', 'k'], ['l', 'l'], ['m', 'm'], ['n', 'n'], ['o', 'o'],
    ['p', 'p'], ['q', 'q'], ['r', 'r'], ['s', 's'], ['t', 't'],
    ['u', 'u'], ['v', 'v'], ['w', 'w'], ['x', 'x'], ['y', 'y'],
    ['z', 'z'],
     
    ['A', 'A'], ['B', 'B'], ['C', 'C'], ['D', 'D'],['E', 'E'],
    ['F', 'F'],['G', 'G'],['H', 'H'],['I', 'I'],['J', 'J'],['K', 'K'],
    ['L', 'L'], ['M', 'M'], ['N', 'N'], ['O', 'O'],['P', 'P'],
    ['Q', 'Q'],['R', 'R'],['S', 'S'],['T', 'T'],['U', 'U'],['V', 'V'],
    ['W', 'W'], ['X', 'X'], ['Y', 'Y'], ['Z', 'Z'],
     
    [' ', '-'],['0', '0'],['1', '1'],['2', '2'],['3', '3'],
    ['4', '4'],['5', '5'],['6', '6'],['7', '7'],['8', '8'],['9', '9'],
    ['-', '-']
     
        );
     
        var newStr = new String();
     
        for (var i = 0; i < str.length; i++) {
     
            ch = str.charAt(i);
            var newCh = '';
     
            for (var j = 0; j < cyr2latChars.length; j++) {
                if (ch == cyr2latChars[j][0]) {
                    newCh = cyr2latChars[j][1];
     
                }
            }
            newStr += newCh;
     
        }
        return newStr.replace(/[-]{2,}/gim, '-').replace(/\n/gim, '');
    }
});

$(function()
{
    var P = new ContentsPage();
});
