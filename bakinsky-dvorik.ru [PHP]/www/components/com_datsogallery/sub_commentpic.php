<?php
  defined('_JEXEC') or die('Restricted access');
  $db=&JFactory::getDBO();
  require_once (JPATH_COMPONENT_ADMINISTRATOR.DS.'config.datsogallery.php');
  $Itemid=JRequest::getVar('Itemid');
  $catid=JRequest::getVar('catid');
  $cmtpic=JRequest::getVar('id');
  $cmtname=JRequest::getVar('cmtname');
  $cmtmail=JRequest::getVar('cmtmail');
  $vercode=JRequest::getVar('vercode');
  $codemd5=JRequest::getVar('codemd5');
  if($ad_security) {
    if((md5(trim(strtoupper($vercode)))==$codemd5)&&(!empty ($vercode))) {
      $cmtip=get_ip($_SERVER['REMOTE_ADDR']);
      $cmtdate=time();
      if($ad_bbcodesupport) {
        $cmttext=JRequest::getVar('cmttext','','post','string',JREQUEST_ALLOWHTML);
      }
      else{
        $cmttext=JRequest::getVar('cmttext','','post','string');
      }
      $cmtname=strip_tags($cmtname);
      $db->setQuery("INSERT INTO #__datsogallery_comments VALUES ('', '".$cmtpic."', '$cmtip', '$cmtname', '$cmtmail', '$cmttext', '$cmtdate', '1')");
      $db->query();
      $mainframe->redirect(JRoute::_("index.php?option=com_datsogallery&func=detail&catid=".$catid."&id=".$cmtpic."&Itemid=".$Itemid, false),_DG_COMM_SAVED, "notice");
    }
    else{
      $mainframe->redirect(JRoute::_("index.php?option=com_datsogallery&func=detail&catid=".$catid."&id=".$cmtpic."&Itemid=".$Itemid, false),_DG_SECURITY_NOT_VALUE, "error");
    }
  }
  else
    if(!$ad_security) {
      $cmtip=get_ip($_SERVER['REMOTE_ADDR']);
      $cmtdate=time();
      if($ad_bbcodesupport) {
        $cmttext=JRequest::getVar('cmttext','','post','string',JREQUEST_ALLOWHTML);
      }
      else{
        $cmttext=JRequest::getVar('cmttext','','post','string');
      }
      $cmtname=strip_tags($cmtname);
      $db->setQuery("INSERT INTO #__datsogallery_comments VALUES ('', '".$cmtpic."', '$cmtip', '$cmtname', '$cmtmail', '$cmttext', '$cmtdate', '1')");
      $db->query();
      $mainframe->redirect(JRoute::_("index.php?option=com_datsogallery&func=detail&catid=".$catid."&id=".$cmtpic."&Itemid=".$Itemid, false),_DG_COMM_SAVED, "notice");
    }
    else{
      $mainframe->redirect(JRoute::_("index.php?option=com_datsogallery&Itemid=".$Itemid, false),_DG_SPAM_DETECT, "notice");
  }