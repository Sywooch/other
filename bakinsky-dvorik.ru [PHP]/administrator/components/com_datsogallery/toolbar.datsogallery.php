<?php
	/**************************************************************************\
	**   DatsoGallery - A Joomla! Gallery Component                           **
	**   Copyright (C) 2006-2009  by Andrey Datso. Distribution prohibited!   **
	**   Homepage   : http://www.datso.fr                                     **
	\**************************************************************************/
	
	defined( '_JEXEC' ) or die( 'Restricted access' );
	
	require_once( $mainframe->getPath( 'toolbar_html' ) );
	
	if ($act) $task = $act;
	
	switch ($task) {
    case "movepic":
    menudatsogallery::MOVE_PIC_MENU();
    break;
	
	case "newcatg":
	menudatsogallery::NEW_CTG_MENU();
	break;
	
	case "showcatg":
	menudatsogallery::CTG_MENU();
	break;
	
	case "edit":
	menudatsogallery::EDIT_MENU();
	break;
	case "editcatg":
	menudatsogallery::EDIT_CTG_MENU();
	break;
	
	case "settings":
	menudatsogallery::CONFIG_MENU();
	break;

    case "rebuild":
	menudatsogallery::REBUILD_MENU();
	break;

    case "new":
    case "upload":
    case "uploadhandler":
	menudatsogallery::NEW_MENU();
	break;

    case "batchupload":
    case "batchuploadhandler":
	menudatsogallery::BATCHUPLOAD_MENU();
	break;

    case "batchimport":
    case "batchimporthandler":
	menudatsogallery::BATCHIMPORT_MENU();
	break;

    case "resetvotes":
	menudatsogallery::RESETVOTES_MENU();
	break;

	case "comments":
	menudatsogallery::COMMENTS_MENU();
	break;
	
	default:
	menudatsogallery::DATSOMAIN_MENU();
	break;
	}
?>
