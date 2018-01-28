tinyMCE.init({
	// General options
	mode : "specific_textareas",
	editor_selector : "htmleditor",
	theme : "advanced",
	language : "ru",
	file_browser_callback : "images",
	convert_urls : false,
	plugins : "spellchecker,style,table,advhr,advimage,advlink,emotions,iespell,inlinepopups,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,xhtmlxtras,images,diafanimages",

	theme_advanced_buttons1  : "code,|,fullscreen,|,cut,copy,paste,pastetext,pasteword,|,print,|,undo,redo,|,search,replace,|,removeformat,cleanup,|,spellchecker,|,cite,abbr,acronym,del,ins",
	theme_advanced_buttons2 : "bold,italic,underline,strikethrough,|,sub,sup,|,forecolor,backcolor,|,numlist,bullist,|,outdent,indent,blockquote,|,justifyleft,justifycenter,justifyright,justifyfull,|,link,unlink,anchor",
	theme_advanced_buttons3 : "diafanimages,image,media,hr,iespell,emotions,charmap,|,styleselect,formatselect,fontselect,fontsizeselect",
	theme_advanced_buttons4 : "tablecontrols",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_statusbar_location : "bottom",
	theme_advanced_resizing : true,
	valid_elements : "*[*]"
});