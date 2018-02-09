function switchDisabledState(oControl, sContainerID, bInvert)
{
	try
	{
		var
			sDisabled = !oControl.checked && !bInvert || oControl.checked && bInvert ? 'disabled' : '',
			oContainer = document.getElementById(sContainerID),
			arSelect = oContainer.getElementsByTagName('select'),
			arInput = oContainer.getElementsByTagName('input'),
			arTextarea = oContainer.getElementsByTagName('textarea');

		for(var i = 0; i < arSelect.length; i ++)
		{
			arSelect[i].disabled = sDisabled;
		}
		for(var i = 0; i < arInput.length; i ++)
		{
			arInput[i].disabled = sDisabled;
		}
		for(var i = 0; i < arTextarea.length; i ++)
		{
			arTextarea[i].disabled = sDisabled;
		}
	}
	catch(ex)
	{
		alert(ex.message);
	}
}

function init()
{
	if(document.getElementById('structure-tree'))
	{
		var oTreeView = new clsTreeView(document.getElementById('structure-tree'));
		oTreeView.init();
	}

	if(document.getElementById('structure-tree-manage'))
	{
		var oTreeView = new clsTreeView(document.getElementById('structure-tree-manage'));
		oTreeView.init();
	}
}

var
	bMCEGzipInitialized = false;

function initMCEGZip()
{
	tinyMCE_GZ.init({
		plugins : "table,advimage,zoom,searchreplace,simplebrowser,contextmenu,paste,fullscreen,media",
		themes : 'simple,advanced',
		languages : 'en,ru',
		disk_cache : true,
		debug : false
	});
}

function initTinyMCE(sContainerID)
{
	tinyMCE.init({
		mode : "exact",
		elements : sContainerID,
		theme : "advanced",
		plugins : "table,advimage,zoom,searchreplace,simplebrowser,contextmenu,paste,fullscreen,media",
		theme_advanced_buttons1_add : "separator,forecolor,backcolor,separator,media",
		theme_advanced_buttons2_add_before: "cut,copy,paste,pastetext,pasteword,separator,search,replace,separator",
		theme_advanced_buttons3_add_before : "tablecontrols,separator",
		theme_advanced_buttons3_add : "advhr,separator,fullscreen",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_disable : "help,strikethrough,styleselect",
		plugin_insertdate_dateFormat : "%Y-%m-%d",
		plugin_insertdate_timeFormat : "%H:%M:%S",
		theme_advanced_blockformats : "h1,h2,h3,h4,h5,h6",
		paste_use_dialog : false,
		theme_advanced_resizing : true,
		theme_advanced_resize_horizontal : false,
		paste_auto_cleanup_on_paste : true,
		paste_convert_headers_to_strong : false,
		paste_strip_class_attributes : "all",
		paste_remove_spans : false,
		paste_remove_styles : false,
		language : "ru",
		file_browser_callback : "fileBrowserCallBack",
		apply_source_formatting : true,
		relative_urls : false,
		convert_urls : false,
		content_css : '../css/editor.css',
		extended_valid_elements : "iframe[src|width|height|name|align|style]"
	});
}

function fileBrowserCallBack(field_name, url, type, win)
{
	var connector = "../../../../filemanager/browser.html?Connector=connectors/php/connector.php";
	var enableAutoTypeSelection = true;

	var cType;
	tinyfck_field = field_name;
	tinyfck = win;

	switch(type)
	{
		case 'image':
			cType = 'Image';
			break;
		case 'flash':
			cType = 'Flash';
			break;
		case 'file':
			cType = 'File';
			break;
	}

	if(enableAutoTypeSelection && cType)
	{
		connector += '&Type=' + cType;
	}

	window.open(connector, 'tinyfck', 'modal,width=600,height=400');
}

function checkColumns(iPosition, oControl, sClassName)
{
	var
		oTable = utilsFindParent(oControl, 'table'),
		arCheckbox = oTable.getElementsByTagName('input');

	if(!sClassName)
	{
		sClassName = 'column';
	}

	for(var i = 0; i < arCheckbox.length; i ++)
	{
		if(arCheckbox[i].className == sClassName + iPosition)
		{
			arCheckbox[i].checked = oControl.checked;
		}
	}

}

function switchObjectDisplayProperty(sObjectID, oControl)
{
	var
		oObject = document.getElementById(sObjectID);

	if(!oObject)
		return;

	if(oObject.style.display == 'none')
	{
		if(oControl)
			oControl.innerHTML = '-';

		oObject.style.display = 'block';
	}
	else
	{
		if(oControl)
			oControl.innerHTML = '+';

		oObject.style.display = 'none';
	}
}

var arTable = false;

var iSortingColumnIndex = -1;
var iSortingDirection = 1;

var sUpArrow = '<span>&uarr;</span>';
var sDownArrow = '<span>&darr;</span>';

function sortTable(oEventSrc)
{
	oTable = utilsFindParent(oEventSrc, 'table');
	oTh = utilsFindParent(oEventSrc, 'th');

	iCurrentSortingIndex = oTh.cellIndex;

	for(var i = 0; i < oTable.rows[0].cells.length; i ++)
	{
		iArr = oTable.rows[0].cells[i].innerHTML.indexOf('<span>');
		if(iArr != -1)
			oTable.rows[0].cells[i].innerHTML = oTable.rows[0].cells[i].innerHTML.substring(0, iArr);
	}


	if(iCurrentSortingIndex == iSortingColumnIndex)
		iSortingDirection = iSortingDirection ? 0 : 1;
	else
		iSortingDirection = 1;

	oTable.rows[0].cells[iCurrentSortingIndex].innerHTML = oTable.rows[0].cells[iCurrentSortingIndex].innerHTML +
		(iSortingDirection ? sUpArrow : sDownArrow);

	iSortingColumnIndex = iCurrentSortingIndex;

	if(arTable == false)
	{
		arTable = new Array();
		for(var i = 1; i < oTable.rows.length; i ++)
		{
			arTable[i - 1] = new Array();
			for(var j = 0; j < oTable.rows[i].cells.length; j ++)
			{
				arTable[i - 1][j] = oTable.rows[i].cells[j].innerHTML;
			}
		}
	}
	for(var ii = arTable.length - 1; ii > 0; ii --)
	{
		for(var i = 0; i < ii; i ++)
		{
			if(arTable[i][iSortingColumnIndex] > arTable[i + 1][iSortingColumnIndex] && iSortingDirection ||
				arTable[i][iSortingColumnIndex] < arTable[i + 1][iSortingColumnIndex] && !iSortingDirection)
			{
				var tmp = arTable[i];
				arTable[i] = arTable[i + 1];
				arTable[i + 1] = tmp;
			}
		}
	}

	for(var i = 0; i < arTable.length; i ++)
	{
		for(var j = 0; j < oTable.rows[i + 1].cells.length; j ++)
		{
			oTable.rows[i + 1].cells[j].innerHTML = arTable[i][j];
		}
	}
}

utilsAttachEvent('onload', window, init);

