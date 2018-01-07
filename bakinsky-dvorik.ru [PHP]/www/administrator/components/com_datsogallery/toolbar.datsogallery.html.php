<?php

defined('_JEXEC') or die('Restricted access');

class menudatsogallery {

   function NEW_CTG_MENU() {
      JToolBarHelper :: title(JText :: _(_DG_ADD_CAT), 'tb-addcategory');
      JToolBarHelper :: save('savecatg', _DG_SAVEPIC_TB);
      JToolBarHelper :: spacer();
      JToolBarHelper :: cancel('cancelcatg', _DG_CANCEL_TB);
   }

   function EDIT_MENU() {
      JToolBarHelper :: title(JText :: _(_DG_NSDES), 'tb-editimage');
      JToolBarHelper :: save('save', _DG_SAVEPIC_TB);
      JToolBarHelper :: spacer();
      JToolBarHelper :: cancel('cancel', _DG_CANCEL_TB);
   }

   function MOVE_PIC_MENU() {
      JToolBarHelper :: title(JText :: _(_DG_MASS_MOVING_OF_PICS), 'tb-move');
      JToolBarHelper :: save('movepicres', _DG_SAVEPIC_TB);
      JToolBarHelper :: spacer();
      JToolBarHelper :: cancel('cancel', _DG_CANCEL_TB);
   }

   function EDIT_CTG_MENU() {
      JToolBarHelper :: title(JText :: _(_DG_EDIT_CAT), 'tb-editcategory');
      JToolBarHelper :: save('savecatg', _DG_SAVEPIC_TB);
      JToolBarHelper :: spacer();
      JToolBarHelper :: cancel('cancelcatg', _DG_CANCEL_TB);
   }

   function CTG_MENU() {
      JToolBarHelper :: title(JText :: _(_DG_CAT_MANAGER), 'tb-categories');
      JToolBarHelper :: publishList('publishcatg', _DG_PUBLISHCAT_TB);
      JToolBarHelper :: spacer();
      JToolBarHelper :: unpublishList('unpublishcatg', _DG_UNPUBLISHCAT_TB);
      JToolBarHelper :: spacer();
      JToolBarHelper :: addNew('newcatg', _DG_ADDNEWCAT_TB);
      JToolBarHelper :: spacer();
      JToolBarHelper :: editList('editcatg', _DG_EDITCAT_TB);
      JToolBarHelper :: spacer();
      JToolBarHelper :: deleteList('', 'removecatg', _DG_REMOVECAT_TB);
   }

   function DATSOMAIN_MENU() {
      JToolBarHelper :: title(JText :: _(_DG_PICS_MANAGER_TITLE), 'tb-images');
      JToolBarHelper :: publishList('publish', _DG_PUBLISHPIC_TB);
      JToolBarHelper :: spacer();
      JToolBarHelper :: unpublishList('unpublish', _DG_UNPUBLISHPIC_TB);
      JToolBarHelper :: spacer();
      JToolBarHelper :: custom('movepic', 'move.png', 'move.png', _DG_MOVE_PICS);
      JToolBarHelper :: spacer();
      JToolBarHelper :: custom('approvepic', 'apply.png', 'apply.png', _DG_APPROVEPIC_TB);
      JToolBarHelper :: spacer();
      JToolBarHelper :: addNew('new', _DG_ADDNEWPIC_TB);
      JToolBarHelper :: spacer();
      JToolBarHelper :: editList('edit', _DG_EDITPIC_TB);
      JToolBarHelper :: spacer();
      JToolBarHelper :: deleteList('', 'remove', _DG_DELETEPIC_TB);
   }

   function CONFIG_MENU() {
      JToolBarHelper :: title(JText :: _(_DG_CONFIG_DATSOGALLERY), 'tb-config');
      JToolBarHelper :: save('savesettings', _DG_SAVESETTINGS_TB);
      JToolBarHelper :: spacer();
      JToolBarHelper :: apply('savelaguage', _DG_LANG);
      JToolBarHelper :: spacer();
      JToolBarHelper :: cancel();
   }

   function COMMENTS_MENU() {
      JToolBarHelper :: title(JText :: _(_DG_COMMENTS_MANAGER_TITLE), 'tb-comments');
      JToolBarHelper :: publishList('publishcmt', _DG_PUBLISHCMT_TB);
      JToolBarHelper :: spacer();
      JToolBarHelper :: unpublishList('unpublishcmt', _DG_UNPUBLISHCMT_TB);
      JToolBarHelper :: spacer();
      JToolBarHelper :: deleteList('', 'removecmt', _DG_REMOVECMT_TB);
   }

   function REBUILD_MENU() {
      JToolBarHelper :: title(JText :: _(_DG_THUMB_REBUILD_INFO), 'tb-rebuild');
      JToolBarHelper :: back();
   }

   function NEW_MENU() {
      JToolBarHelper :: title(JText :: _(_DG_NORMAL_UPLOAD_TITLE), 'tb-newimage');
      JToolBarHelper :: back();
   }

   function BATCHUPLOAD_MENU() {
      JToolBarHelper :: title(JText :: _(_DG_UPLOAD_ZIP), 'tb-batchupload');
      JToolBarHelper :: back();
   }

   function BATCHIMPORT_MENU() {
      JToolBarHelper :: title(JText :: _(_DG_IMPORT_ZIP), 'tb-batchimport');
      JToolBarHelper :: back();
   }

   function RESETVOTES_MENU() {
      JToolBarHelper :: title(JText :: _(_DG_RESET_VOTES_TITLE), 'tb-resetvotes');
      JToolBarHelper :: back();
   }

}

?>
