var Blogs = new Backbone.Collection();
var ContentsBlog = Backbone.View.extend(
{
    "el": ".blog-wrapper",
    "events": {
		"click .save-post": "savePost",
		"click .ot_show_deletion_dialog_modal": "deletePost",
		"click #blog-category-delete": "deleteCategory",
		"click #blog-category-edit": "editCategory",
		"click #blog-category-add": "addCategory",
		"click #blog-category-save": "saveCategory",
		"click .add-item": "addProduct",
		"change #post-language": "changeLanguage",
        "change .ot_edit_post_form #post-title": "titleChange",
    },
    changeLanguage: function(skipselect)
    {
    	var lang = $('#post-language option:selected').attr('value');
    	
    	if (skipselect == true) {
        	$('#post-category option[value!="0"]').hide();
        	$('#post-category option[language="' + lang + '"]').show();
    	} else {
    		$('#post-category option').removeAttr('selected');
    		$('#post-category option[value!="0"]').hide();
    		$('#post-category option[language="' + lang + '"]').show();
    		$('#post-category option:first').attr('selected','selected');
    	}
    	
    	$('#blog-category-language option').removeAttr('selected');
    	$('#blog-category-language option').hide();
    	$('#blog-category-language option[value="' + lang + '"]').show();
    	$('#blog-category-language option[value="' + lang + '"]').attr('selected','selected');
    },
    addProduct: function (e)
    {   
        e.preventDefault();
        var target = this.$(e.target);        
        var itemData = $('.add-item-data').val();
        if (itemData == '') {
            showError(trans.get('Item_not_entered'));
            return false;
        }         
        var $button = target.button('loading');
        var action = target.data('action');
        $.post(
            action,
            { 
                id : itemData
            },
            function (data) {
                if (! data.error) {	
                    tinyMCE.editors[0].setContent(tinyMCE.editors[0].getContent() + data.content);				   
                    $button.button('reset');
				} else {
				    $button.button('reset');
                    showError(data);
				}
            }, 'json'
        );         
		return false;
    },
    deleteCategory: function(ev)
    {
    	var id = $('#post-category option:selected').attr('id');
    	modalDialog(trans.get('Confirm_needed'), trans.get('blog::Really_remove_selected_category'), function() {
    		$.post('index.php?cmd=blog&do=deleteCategory', { 'id' : id}, function (data) {
                if (data.result == 'ok') {
                	$('#post-category option:selected').remove();
                }
            }, 'json');    		
        }, {'confirm':trans.get('Delete'), 'cancel':trans.get('Cancel')});
    	
    	
    },
    editCategory: function(ev)
    {
    	$('#blog-category-mode').val('edit');
    	$('#blog-category-id').val($('#post-category option:selected').val());
    	$('#blog-category-name').val($('#post-category option:selected').text());
    	$('#blog-category-description').val($('#post-category option:selected').attr('description'));
    	$('#blog-category-language option').removeAttr('selected');
    	$('#blog-category-language option[value="' + $('#post-category option:selected').attr('language') + '"]').attr('selected', 'selected');
    },
    addCategory: function(ev)
    {
    	$('#blog-category-id').val(0);
    	$('#blog-category-name').val('');
    	$('#blog-category-description').val('');
    	$('#blog-category-language option').removeAttr('selected');
        $('#blog-category-language option:first').attr('selected','selected');
        this.changeLanguage();
    },
    saveCategory: function(ev)
    {
    	var id = $('#blog-category-id').val();
    	var name = $('#blog-category-name').val();
    	var description = $('#blog-category-description').val();
    	var language = $('#blog-category-language option:selected').attr('value');
    	
    	var errors = [];
    	if(!name || (name && !name.length)){
    		errors.push(trans.get('blog::Empty_category_name'));
    	} 
    	
    	if(errors.length > 0 ) {
    		var msg = errors.join('<br>');
    		showError(msg);
    		return;
    	}
    		
		$.post('index.php?cmd=blog&do=saveCategory', { 'id' : id, 'name': name, 'description': description, 'language': language  }, function (data) {
            if (data.result == 'ok') {
            	if (id != 0) {
            		$('#post-category option:selected').text(name);
            		$('#post-category option:selected').attr('description', description);
            		$('#post-category option:selected').attr('language', language);
            	} else {
            		$('#post-category option').removeAttr('selected');
            		$('#post-category').append('<option value="' + data.id +'" description="' + description +'" language="' + language +'" selected="selected">'+ name + '</option>');
            	}
            	$('#blog_category_form').removeClass('in');
            	$('#blog_category_form').css('height', '0px');
            	showMessage(trans.get('blog::Blog_category_saved_successfully'));
            }
        }, 'json');    		    	
    		
    	return false;
    	
    },
    deletePost: function(e)
    {
    	var tr = $(e.currentTarget).closest('tr');
    	var id = $(tr).attr('id');
    	
    	modalDialog(trans.get('Confirm_needed'), trans.get('blog::Really_remove_this_post'), function() {
    		$.post('index.php?cmd=blog&do=deleteBlogPost', { 'id' : id}, function (data) {
                if (data.result == 'ok') {
                	$(tr).remove();
                }
            }, 'json');    		
        }, {'confirm':trans.get('Delete'), 'cancel':trans.get('Cancel')});
    	
    },
    render: function()
    {
        return this;
    },
    initialize: function()
    {
        this.render();
        
        tinyMCE.init({
            mode : "exact",
            elements : "post-content,post-preview",
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
            extended_valid_elements : "hr[class|width|size|noshade],ul[class=listUL],ol[class=listOL]",
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
        
        $('#post-date')
            .datepicker({format: 'dd.mm.yyyy', weekStart: 1})
            .on('changeDate', function (ev) {
                startDate = new Date(ev.date);
                $('#post-date').datepicker('setValue', startDate);
                $('#post-date-display').val($('#post-date').data('date'));
                $('#post-date').datepicker('hide');
            });

        this.changeLanguage(true);
    },
    titleChange: function(event) 
    {
    	var value = $(event.currentTarget).val();
    	if (! $('.ot_edit_post_form  #page-title').attr('original-value')) {
    		$('.ot_edit_post_form  #page-title').val(value);
    	}
    	if (! $('.ot_edit_post_form #alias').attr('original-value')) {
    		$('.ot_edit_post_form #alias').val(this.cyr2lat(value));
    	}
    },
    savePost: function(e)
    {
        e.preventDefault();
        var target = this.$(e.target);        
    	var form = $('.ot_edit_post_form');    	
    	var content = tinyMCE.editors[0].getContent();
    	var preview = tinyMCE.editors[1].getContent(); 
    	$('#post-content', form).val(content);
    	$('#post-preview', form).val(preview);
        var $button = target.button('loading');
        $(form).ajaxSubmit({
            url     :   $(this).attr('action'),
            type    :   'POST',
            dataType:   'json',
            success :   function(data) {
                if(data && data.result && data.result == 'ok') {
                    showMessage(trans.get('blog::Post_saved_successfully'));
                    document.location.href = 'index.php?cmd=blog&do=default';
                } else {
                    showError(data);
                    $button.button('reset');
                }
            }
        });
        
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
    var P = new ContentsBlog();
});
