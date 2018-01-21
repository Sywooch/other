<?php

  defined('_JEXEC') or die('Restricted access');
  define('_DG_VER', "1.8.4");
  require_once (JPATH_COMPONENT . DS . 'class.datsogallery.php');
  require (JPATH_COMPONENT . DS . 'config.datsogallery.php');
  $db = & JFactory::getDBO();
  $act = JRequest::getCmd('act');
  $task = JRequest::getCmd('task');
  $id = JRequest::getVar('id', 0, 'get', 'int');
  $catid = JRequest::getVar('catid', 0, '', 'int');
  $cid = JRequest::getVar( 'cid', array(0), '', 'array' );
  JArrayHelper::toInteger( $cid, array(0));
  $lang = & JFactory::getLanguage();
  $datsolang = strtolower( $lang->getBackwardLang());
  $dgtoolbar = '<link rel="stylesheet" href="' . JURI::base() . 'components/com_datsogallery/css/toolbar.css" type="text/css" />';
  $mainframe->addCustomHeadTag($dgtoolbar);
  $dhtmltooltip = "<script type=\"text/javascript\">
document.write('<div id=\"dhtmltooltip\"></div>');
document.write('<img id=\"dhtmlpointer\" src=\"" . $mainframe->getSiteURL() . "components/com_datsogallery/images/tip_arrow.gif\">');
</script>";
  $dhtmltooltip .= '<script type="text/javascript" src="' . $mainframe->getSiteURL() . '/components/com_datsogallery/libraries/dhtmltooltip.js"></script>';
  $dhtmltooltip .= '<link rel="stylesheet" href="' . $mainframe->getSiteURL() . 'components/com_datsogallery/css/dgstyle.css" type="text/css" />';
  $mainframe->addCustomHeadTag($dhtmltooltip);
  require_once (JApplicationHelper::getPath('admin_html'));
  if (file_exists(JPATH_COMPONENT_SITE . DS . 'language' . DS . $datsolang . '.php')) {
    require (JPATH_COMPONENT_SITE . DS . 'language' . DS . $datsolang . '.php');
  }
  else {
    require (JPATH_COMPONENT_SITE . DS . 'language' . DS . 'english.php');
  }
  switch ($act) {

    case "showcatg" :
      $task = "showcatg";
      break;

    case "comments" :
      $task = "comments";
      break;

    case "upload" :
      $task = "upload";
      break;

    case "batchupload" :
      $task = "batchupload";
      break;

    case "batchimport" :
      $task = "batchimport";
      break;

    case "settings" :
      $task = "settings";
      break;

    case "resetvotes" :
      $task = "resetvotes";
      break;

    case "rebuild" :
      $task = "rebuild";
      break;
  }
  switch ($task) {

    case "publish" :
      publishPicture($cid, 1, $option);
      break;

    case "unpublish" :
      publishPicture($cid, 0, $option);
      break;

    case 'movepic' :
      movePic($cid[0]);
      break;

    case 'movepicres' :
      movePicResult($cid);
      break;

    case "new" :
      showUpload($option);
      break;

    case "edit" :
      editPicture($cid[0], $option);
      break;

    case "remove" :
      removePicture();
      break;

    case "save" :
      savePicture($option);
      break;

    case "comments" :
      showComments($option);
      break;

    case "publishcmt" :
      publishComment($id, 1, $option);
      break;

    case "unpublishcmt" :
      publishComment($id, 0, $option);
      break;

    case "removecmt" :
      removeComment();
      break;

    case "upload" :
      showUpload($option);
      break;

    case "batchupload" :
      showBatchUpload($option);
      break;

    case "batchimport" :
      showBatchImport($option);
      break;

    case "resetvotes" :
      showVotes($option);
      break;

    case "reset" :
      resetVotes($option);
      break;

    case "rebuild" :
      showDGrebuild($option);
      break;

    case "startdgrebuild" :
      startDGrebuild($option);
      break;

    case 'savelaguage' :
      saveLanguage($option);
      break;

    case "uploadhandler" :
      require_once (JPATH_COMPONENT . DS . "images.datsogallery.php");
      $org_screenshot = @$_FILES['org_screenshot']['tmp_name'];
      $org_screenshot_name = @$_FILES['org_screenshot']['name'];
      $imagetype = array(1 => 'GIF', 2 => 'JPG', 3 => 'PNG');
      list($width, $height, $type, $attr) = getimagesize($org_screenshot);
      $imginfo = getimagesize($org_screenshot);
      if (!$imginfo) {
        $mainframe->redirect("index.php?option=com_datsogallery&act=upload", _DG_FILENAME_BAD . ' $org_screenshot');
        exit ();
      }
      $imginfo[2] = $imagetype[$imginfo[2]];
      if ($imginfo[2] != 'GIF' && $imginfo[2] != 'JPG' && $imginfo[2] != 'PNG') {
        $mainframe->redirect("index.php?option=com_datsogallery&act=upload", _DG_FILENAME_BAD . ' - $org_screenshot');
        exit ();
      }
      $org_screenshot_name = dgImgId($catid, $imginfo[2]);
      if ($org_screenshot)
        if ($ad_orgresize) {
          if (strlen($org_screenshot_name) > 0 and $org_screenshot_name != "none") {
            $img_info = getimagesize($org_screenshot);
            if ($img_info[0] > $ad_orgwidth or $img_info[1] > $ad_orgheight) {
              dgImageCreate($org_screenshot, JPATH_SITE . DS . $ad_pathoriginals . DS . $org_screenshot_name, $ad_orgwidth, $ad_orgheight, $ad_thumbquality, "1");
            }
            else {
              copy($org_screenshot, JPATH_SITE . DS . $ad_pathoriginals . DS . $org_screenshot_name);
            }
          }
        }
        if (!$ad_orgresize) {
          if (strlen($org_screenshot) > 0 and $org_screenshot != "none") {
            copy($org_screenshot, JPATH_SITE . DS . $ad_pathoriginals . DS . $org_screenshot_name);
          }
        }
        $img_info = getimagesize($org_screenshot);
      if ($img_info[0] > $ad_maxwidth or $img_info[1] > $ad_maxheight) {
        dgImageCreate($org_screenshot, JPATH_SITE . DS . $ad_pathimages . DS . $org_screenshot_name, $ad_maxwidth, $ad_maxheight, $ad_thumbquality, "1");
      }
      else {
        copy($org_screenshot, JPATH_SITE . DS . $ad_pathimages . DS . $org_screenshot_name);
      }
      dgImageCreate($org_screenshot, JPATH_SITE . DS . $ad_paththumbs . DS . $org_screenshot_name, $ad_thumbwidth, $ad_thumbheight, $ad_thumbquality, $ad_crsc);
      unlink($org_screenshot);
      $db = & JFactory::getDBO();
      $user = & JFactory::getUser();
      $row = new DatsoImages($db);
      if (!$row->bind( JRequest::get('post', 'approved owner published ordering'))) {
        return JError::raiseWarning( 500, $row->getError());
      }
      $db->setQuery("select ordering from #__datsogallery where catid='" . $row->catid . "' order by ordering desc limit 1");
      $ordering1 = $db->loadResult();
      $ordering = $ordering1 + 1;
      $row->ordering = $ordering;
      $row->imgdate = mktime( );
      $row->owner = $user->username;
      $row->published = 1;
      $row->approved = 1;
      $row->imgoriginalname = $org_screenshot_name;
      $row->imgfilename = $org_screenshot_name;
      $row->imgthumbname = $org_screenshot_name;
      $row->useruploaded = 0;
      if (!$row->store()) {
        JError::raiseError( 500, $row->getError());
      }
      $mainframe->redirect("index.php?option=com_datsogallery&act=pictures");
      break;

    case "batchuploadhandler" :
      @ini_set('max_execution_time', '240');
      $time_start = getmicrotime();
      $max_wait = @ini_get('max_execution_time') - 2;
      require_once (JPATH_COMPONENT . DS . "images.datsogallery.php");
      require_once (JPATH_ADMINISTRATOR . DS . 'includes' . DS . 'pcl' . DS . 'pclzip.lib.php');
      $dir = JPATH_SITE . DS . 'zipimport';
      $zipfile = new PclZip($_FILES['zippack']['tmp_name']);
      $ziplist = $zipfile->listContent();
      $zipfile->extract(PCLZIP_OPT_PATH, $dir);
      for ($i = 0; $i < sizeof($ziplist); $i++) {
        $origfilename = $ziplist[$i]['filename'];
        $imagetype = array(1 => 'GIF', 2 => 'JPG', 3 => 'PNG');
        $imginfo = getimagesize($dir . DS . $origfilename);
        $imginfo[2] = $imagetype[$imginfo[2]];
        $newfilename = dgImgId($catid, $imginfo[2]);
        $ad_pathoriginals = str_replace('/', DS, $ad_pathoriginals);
        $ad_pathimages = str_replace('/', DS, $ad_pathimages);
        $ad_paththumbs = str_replace('/', DS, $ad_paththumbs);
        if ($ad_orgresize) {
          $img_info = getimagesize($dir . DS . $origfilename);
          if ($img_info[0] > $ad_orgwidth or $img_info[1] > $origfilename) {
            dgImageCreate($dir . DS . $origfilename, JPATH_SITE . $ad_pathoriginals . DS . $newfilename, $ad_orgwidth, $ad_orgheight, $ad_thumbquality, "1");
          }
          else {
            copy($dir . DS . $origfilename, JPATH_SITE . $ad_pathoriginals . DS . $newfilename);
          }
        }
        if (!$ad_orgresize) {
          copy($dir . DS . $origfilename, JPATH_SITE . $ad_pathoriginals . DS . $newfilename);
        }
        dgImageCreate($dir . DS . $origfilename, JPATH_SITE . $ad_pathimages . DS . $newfilename, $ad_maxwidth, $ad_maxheight, $ad_thumbquality, "1");
        dgImageCreate($dir . DS . $origfilename, JPATH_SITE . $ad_paththumbs . DS . $newfilename, $ad_thumbwidth, $ad_thumbheight, $ad_thumbquality, $ad_crsc);
        unlink($dir . DS . $origfilename);
        $db = & JFactory::getDBO();
        $user = & JFactory::getUser();
        $row = new DatsoImages($db);
        if (!$row->bind( JRequest::get('post'))) {
          return JError::raiseWarning( 500, $row->getError());
        }
        $db->setQuery("select ordering from #__datsogallery where catid='" . $row->catid . "' order by ordering desc limit 1");
        $ordering1 = $db->loadResult();
        $ordering = $ordering1 + 1;
        $row->ordering = $ordering;
        $row->imgtitle = JRequest::getVar( 'gentitle' ) . '-' . $i;
        $row->imgtext = JRequest::getVar( 'gendesc' );
        $row->imgdate = mktime( );
        $row->owner = $user->username;
        $row->published = 1;
        $row->approved = 1;
        $row->imgoriginalname = $newfilename;
        $row->imgfilename = $newfilename;
        $row->imgthumbname = $newfilename;
        $row->useruploaded = 0;
        if (!$row->store()) {
          JError::raiseError( 500, $row->getError());
        }
        $time_end = getmicrotime();
        if ($max_wait < ($time_end - $time_start)) {
          $time = $time_end - $time_start;
          $timelimit = ini_get('max_execution_time');
          $mainframe->redirect("index.php?option=com_datsogallery&act=pictures", _DG_TIME_LIMIT_MSG1 . $timelimit . _DG_TIME_LIMIT_MSG2);
        }
      }
      $picsadded = count($ziplist);
      $mainframe->redirect("index.php?option=com_datsogallery&act=pictures", _DG_ADDED_IMAGES . "$picsadded");
      break;

    case "batchimporthandler" :
      @ini_set('max_execution_time', '360');
      $time_start = getmicrotime();
      $max_wait = @ini_get('max_execution_time') - 2;
      $dir = JPATH_SITE . DS . 'zipimport';
      $filelist = array();
      require_once (JPATH_COMPONENT . DS . "images.datsogallery.php");
      require_once (JPATH_ADMINISTRATOR . DS . 'includes' . DS . 'pcl' . DS . 'pclzip.lib.php');
      if (class_exists("PclZip")) {
        $directory_zip = opendir($dir);
        while ($file_name = readdir($directory_zip)) {
          $ext = strtolower( substr($file_name, - 4));
          if ($ext == ".zip") {
            $zipfile = new PclZip($dir . DS . $file_name);
            if ($zipfile->extract(PCLZIP_OPT_PATH, $dir) == TRUE) {
              unlink($dir . DS . $file_name);
            }
          }
        }
        closedir($directory_zip);
      }
      $compacttitle = strtolower( str_replace(' ', '', $gentitle));
      if ($directory_zip = opendir($dir)) {
        $i = 0;
        while ($file = readdir($directory_zip)) {
          if ($file != "." && $file != ".." && (strcasecmp($file, "index.html") != 0)) {
            $i++;
            $origfilename = $file;
            $imagetype = array(1 => 'GIF', 2 => 'JPG', 3 => 'PNG');
            $imginfo = getimagesize($dir . DS . $origfilename);
            $imginfo[2] = $imagetype[$imginfo[2]];
            $newfilename = dgImgId($catid, $imginfo[2]);
            $ad_pathoriginals = str_replace('/', DS, $ad_pathoriginals);
            $ad_pathimages = str_replace('/', DS, $ad_pathimages);
            $ad_paththumbs = str_replace('/', DS, $ad_paththumbs);
            if ($ad_orgresize) {
              $img_info = getimagesize($dir . DS . $origfilename);
              if ($img_info[0] > $ad_orgwidth or $img_info[1] > $origfilename) {
                dgImageCreate($dir . DS . $origfilename, JPATH_SITE . $ad_pathoriginals . DS . $newfilename, $ad_orgwidth, $ad_orgheight, $ad_thumbquality, "1");
              }
              else {
                copy($dir . DS . $origfilename, JPATH_SITE . $ad_pathoriginals . DS . $newfilename);
              }
            }
            if (!$ad_orgresize) {
              copy($dir . DS . $origfilename, JPATH_SITE . $ad_pathoriginals . DS . $newfilename);
            }
            dgImageCreate($dir . DS . $origfilename, JPATH_SITE . $ad_pathimages . DS . $newfilename, $ad_maxwidth, $ad_maxheight, $ad_thumbquality, "1");
            dgImageCreate($dir . DS . $origfilename, JPATH_SITE . $ad_paththumbs . DS . $newfilename, $ad_thumbwidth, $ad_thumbheight, $ad_thumbquality, $ad_crsc);
            unlink($dir . DS . $origfilename);
            $db = & JFactory::getDBO();
            $user = & JFactory::getUser();
            $row = new DatsoImages($db);
            if (!$row->bind( JRequest::get('post'))) {
              return JError::raiseWarning( 500, $row->getError());
            }
            $db->setQuery("select ordering from #__datsogallery where catid='" . $row->catid . "' order by ordering desc limit 1");
            $ordering1 = $db->loadResult();
            $ordering = $ordering1 + 1;
            $row->ordering = $ordering;
            $row->imgtitle = JRequest::getVar( 'gentitle' ) . '-' . $i;
            $row->imgtext = JRequest::getVar( 'gendesc' );
            $row->imgdate = mktime( );
            $row->owner = $user->username;
            $row->published = 1;
            $row->approved = 1;
            $row->imgoriginalname = $newfilename;
            $row->imgfilename = $newfilename;
            $row->imgthumbname = $newfilename;
            $row->useruploaded = 0;
            if (!$row->store()) {
              JError::raiseError( 500, $row->getError());
            }
            $time_end = getmicrotime();
            if ($max_wait < ($time_end - $time_start)) {
              $time = $time_end - $time_start;
              $timelimit = ini_get('max_execution_time');
              closedir($directory_zip);
              $mainframe->redirect("index.php?option=com_datsogallery&act=pictures", _DG_TIME_LIMIT_MSG1 . $timelimit . _DG_TIME_LIMIT_MSG2);
            }
          }
        }
      }
      closedir($directory_zip);
      $mainframe->redirect("index.php?option=com_datsogallery&act=pictures");
      break;

    case "settings" :
      showConfig($option);
      break;

    case "savesettings" :
      saveConfig($option);
      break;

    case "newcatg" :
      editCatg(0, $option);
      break;

    case "editcatg" :
      editCatg($cid[0], $option);
      break;

    case "showcatg" :
      viewCatg($option);
      break;

    case "savecatg" :
      saveCatg($option, $task);
      break;

    case "removecatg" :
      removeCatg($cid, $option);
      break;

    case "publishcatg" :
      publishCatg($cid, 1, $option);
      break;

    case "unpublishcatg" :
      publishCatg($cid, 0, $option);
      break;

    case "approvepic" :
      approvePicture($cid, 1, $option);
      break;

    case "rejectpic" :
      approvePicture($cid, 0, $option);
      break;

    case "orderup" :
      orderPic($cid[0], 1, $option);
      break;

    case "orderdown" :
      orderPic($cid[0], - 1, $option);
      break;

    case "saveorder" :
      saveOrder($cid);
      break;

    case "cancelcatg" :
      cancelCatg($option);
      break;

    case "orderupcatg" :
      orderCatg($cid[0], 1, $option);
      break;

    case "orderdowncatg" :
      orderCatg($cid[0], - 1, $option);
      break;

    case "cancel" :
      $mainframe->redirect("index.php?option=$option");
      break;

    default :
      showPictures($option);
      break;
  }

  function showPictures($option) {
    global $mainframe;
    $db = & JFactory::getDBO();
    $catid = $mainframe->getUserStateFromRequest($option . 'catid', 'catid', 0, 'int');
    $sort = $mainframe->getUserStateFromRequest("sort{$option}", 'sort', 0);
    $sorder = $mainframe->getUserStateFromRequest("sorder{$option}", 'sorder', 0);
    $search = $mainframe->getUserStateFromRequest($option . 'search', 'search', '', 'string');
    $search = JString::strtolower($search);
    $limit = $mainframe->getUserStateFromRequest( 'global.list.limit', 'limit', 20, 'int' );
    $limitstart = $mainframe->getUserStateFromRequest($option . '.limitstart', 'limitstart', 0, 'int');
    $where = array();
    if ($catid > 0) {
      $where[] = "catid='$catid'";
    }
    if ($sort == 1) {
      $where[] = "approved = 0";
    }
    if ($sort == 2) {
      $where[] = "approved = 1";
    }
    if ($sort == 3) {
      $where[] = "useruploaded = 1";
    }
    if ($sort == 4) {
      $where[] = "useruploaded = 0";
    }
    if ($sorder == 0) {
      $sortorder = "a.catid asc, a.ordering desc, imgdate desc, imgtitle asc";
    }
    if ($sorder == 1) {
      $sortorder = "a.catid asc, a.ordering asc, imgdate desc, imgtitle asc";
    }
    if ($search) {
      $where[] = "lower(imgtitle) like '%$search%' or lower(imgtext) like '%$search%'";
    }
    $group = "group by id";
    $db->setQuery( "select count(*) from #__datsogallery as a " . (count($where) ? ' where ' . implode(' and ', $where) : ''));
    $total = $db->loadResult();
    echo $db->getErrorMsg();
    if ($limit > $total) {
      $limitstart = 0;
    }
    $where[] = 'a.catid = cc.cid';
    $picincat = count($where) ? ' where ' . implode(' and ', $where) : '';
    $db->setQuery("select a.*, cc.name as category " . "from #__datsogallery as a, #__datsogallery_catg " . "as cc $picincat $group " . "order by $sortorder limit $limitstart, $limit");
    $rows = $db->loadObjectList();
    if ($db->getErrorNum()) {
      echo $db->stderr();
      return false;
    }
    $clist = ShowDropDownCategoryList($catid, 'catid', 'class="inputbox" size="1" onchange="document.adminForm.submit();"');
    $s_options[] = JHTML::_('select.option', _DG_SHOW_ALL_PICT, 0);
    $s_options[] = JHTML::_('select.option', "1", _DG_NOT_APPROVED);
    $s_options[] = JHTML::_('select.option', "2", _DG_APPROVED);
    $s_options[] = JHTML::_('select.option', "3", _DG_USER_UPLOAD_PIC);
    $s_options[] = JHTML::_('select.option', "4", _DG_ADMIN_UPLOAD_PIC);
    $slist = JHTML::_('select.genericlist', $s_options, 'sort', 'class="inputbox" size="1" onchange="document.adminForm.submit();"', 'value', 'text', $sort);
    jimport('joomla.html.pagination');
    $pageNav = new JPagination($total, $limitstart, $limit);
    datsogallery_html::showPictures($option, $rows, $clist, $slist, $search, $pageNav);
  }

  function orderPic($uid, $inc, $option) {
    global $mainframe;
    $db = & JFactory::getDBO();
    $db->setQuery("select catid from #__datsogallery where id=" . $uid);
    $piccatid = $db->loadResult();
    $db->setQuery("select ordering, id from #__datsogallery where id=" . $uid);
    $result = $db->query();
    $id1 = mysql_result($result, 0, 'id');
    $ordering1 = mysql_result($result, 0, 'ordering');
    if ($inc == 1) {
      $db->setQuery("select ordering, id from #__datsogallery where catid=" . $piccatid . " and ordering > " . $ordering1 . " order by ordering limit 1");
    }
    else {
      $db->setQuery("select ordering, id from #__datsogallery where catid=" . $piccatid . " and ordering < " . $ordering1 . " order by ordering desc limit 1");
    }
    $result = $db->query();
    $ordering2 = mysql_result($result, 0, 'ordering');
    $id2 = mysql_result($result, 0, 'id');
    $db->setQuery("update #__datsogallery set ordering=" . $ordering1 . " where id=" . $id2);
    $result = $db->query();
    $db->setQuery("update #__datsogallery set ordering=" . $ordering2 . " where id=" . $id1);
    $result = $db->query();
    $mainframe->redirect('index.php?option=com_datsogallery');
  }

  function saveOrder(& $cid) {
    global $mainframe;
    $db = & JFactory::getDBO();
    $total = count($cid);
    $order = JRequest::getVar( 'order', array(0), 'post', 'array' );
    JArrayHelper::toInteger( $order, array(0));
    $row = new DatsoImages($db);
    for ($i = 0; $i < $total; $i++) {
      $row->load( (int) $cid[$i] );
      if ($row->ordering != $order[$i]) {
        $row->ordering = $order[$i];
        if (!$row->store()) {
          JError::raiseError( 500, $db->getErrorMsg());
        }
      }
    }
    $mainframe->redirect('index.php?option=com_datsogallery', _DG_ORDERING_OK);
  }

  function removePicture() {
    global $mainframe;
    require (JPATH_COMPONENT . DS . 'config.datsogallery.php');
    $ad_pathoriginals = str_replace('/', DS, $ad_pathoriginals);
    $ad_pathimages = str_replace('/', DS, $ad_pathimages);
    $ad_paththumbs = str_replace('/', DS, $ad_paththumbs);
    $db = & JFactory::getDBO();
    $cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
    $option = JRequest::getCmd('option');
    JArrayHelper::toInteger($cid);
    if (count($cid) < 1) {
      $msg = JText::_('Select an item to delete');
      $mainframe->redirect('index.php?option=' . $option, $msg, 'error');
    }
    $cids = implode(',', $cid);
    for ($i = 0; $i < count($cid); $i++) {
      $db->setQuery("select * from #__datsogallery where id = " . $cid[$i]);
      $row = new DatsoImages($db);
      $row->load($cid[$i]);
      if (file_exists(JPATH_SITE . $ad_pathoriginals . DS . $row->imgoriginalname)) {
        removeFile($row->imgoriginalname, JPATH_SITE . $ad_pathimages . DS);
      }
      if (file_exists(JPATH_SITE . $ad_pathimages . DS . $row->imgfilename)) {
        removeFile($row->imgfilename, JPATH_SITE . $ad_pathimages . DS);
      }
      if (file_exists(JPATH_SITE . $ad_paththumbs . DS . $row->imgthumbname)) {
        removeFile($row->imgthumbname, JPATH_SITE . $ad_paththumbs . DS);
      }
    }
    $query = 'DELETE from #__datsogallery WHERE id IN ( ' . $cids . ' )';
    $db->setQuery($query);
    if (!$db->query()) {
      JError::raiseError( 500, $db->getErrorMsg());
      return false;
    }
    $msg = JText::sprintf( count($cid) . ' selected image(s) successfully removed' );
    $mainframe->redirect('index.php?option=' . $option, $msg);
  }

  function publishPicture($cid = null, $publish = 1, $option) {
    global $mainframe;
    $db = & JFactory::getDBO();
    if (!is_array($cid) || count($cid) < 1) {
      $action = $publish ? 'publish' : 'unpublish';
      echo "<script> alert('" . _DG_SELECT_AN_ITEM . " $action'); window.history.go(-1);</script>\n";
      exit;
    }
    $cids = implode(',', $cid);
    $db->setQuery("update #__datsogallery set published='$publish' where id IN ($cids)");
    if (!$db->query()) {
      echo "<script> alert('" . $db->getErrorMsg() . "'); window.history.go(-1); </script>\n";
      exit ();
    }
    $mainframe->redirect("index.php?option=$option");
  }

  function approvePicture($cid = null, $approve = 1, $option) {
    global $mainframe;
    $db = & JFactory::getDBO();
    if (!is_array($cid) || count($cid) < 1) {
      $action = $approve ? 'approve' : 'reject';
      echo "<script> alert('" . _DG_SELECT_AN_ITEM . " $action'); window.history.go(-1);</script>\n";
      exit;
    }
    $cids = implode(',', $cid);
    $db->setQuery("update #__datsogallery set approved='$approve' where id IN ($cids)");
    if (!$db->query()) {
      echo "<script> alert('" . $db->getErrorMsg() . "'); window.history.go(-1); </script>\n";
      exit ();
    }
    $mainframe->redirect("index.php?option=$option");
  }

  function editPicture($uid, $option) {
    global $mainframe;
    require (JPATH_COMPONENT . DS . 'config.datsogallery.php');
    $db = & JFactory::getDBO();
    $row = new DatsoImages($db);
    $row->load($uid);
    $clist = ShowDropDownCategoryList($row->catid, "catid", ' size="1"');
    $imgdir = JPath::clean(JPATH_SITE . $ad_pathimages);
    $imgFiles = JFolder::files($imgdir);
    $images = array(JHTML::_('select.option', '', _DG_SELECT_MED_PIC));
    foreach ($imgFiles as $file) {
      if (eregi("jpeg|gif|jpg|png", $file)) {
        $images[] = JHTML::_('select.option', $file);
      }
    }
    $imagelist = JHTML::_('select.genericlist', $images, 'imgfilename', "class=\"inputbox\" size=\"1\"" . " onchange=\"javascript:if (document.forms[0].imgfilename.options[selectedIndex].value!='') {document.imagelib3.src='..$ad_pathimages/' + document.forms[0].imgfilename.options[selectedIndex].value} else {document.imagelib3.src='../images/M_images/blank.png'}\"", 'value', 'text', $row->imgfilename);
    $thudir = JPath::clean(JPATH_SITE . $ad_paththumbs);
    $thuFiles = JFolder::files($thudir);
    $thumbs = array(JHTML::_('select.option', '', _DG_SELECT_THUMB_PIC));
    foreach ($thuFiles as $tfile) {
      if (eregi("jpeg|gif|jpg|png", $tfile)) {
        $thumbs[] = JHTML::_('select.option', $tfile);
      }
    }
    $thumblist = JHTML::_('select.genericlist', $thumbs, 'imgthumbname', "class=\"inputbox\" size=\"1\"" . " onchange=\"javascript:if (document.forms[0].imgthumbname.options[selectedIndex].value!='') {document.imagelib2.src='..$ad_paththumbs/' + document.forms[0].imgthumbname.options[selectedIndex].value} else {document.imagelib2.src='../images/M_images/blank.png'}\"", 'value', 'text', $row->imgthumbname);
    $orgdir = JPath::clean(JPATH_SITE . $ad_pathoriginals);
    $orgFiles = JFolder::files($orgdir);
    $originals = array(JHTML::_('select.option', '', _DG_SELECT_ORG_PIC));
    foreach ($orgFiles as $ofile) {
      if (eregi("jpeg|gif|jpg|png", $ofile)) {
        $originals[] = JHTML::_('select.option', $ofile);
      }
    }
    $originallist = JHTML::_('select.genericlist', $originals, 'imgoriginalname', "class=\"inputbox\" size=\"1\"" . " onchange=\"javascript:if (document.forms[0].imgoriginalname.options[selectedIndex].value!='') {document.imagelib.src='..$ad_pathoriginals/' + document.forms[0].imgoriginalname.options[selectedIndex].value} else {document.imagelib.src='../images/M_images/blank.png'}\"", 'value', 'text', $row->imgoriginalname);
    if (!$uid)
      $row->published = 0;
    datsogallery_html::editPicture($option, $row, $clist, $originallist, $imagelist, $thumblist, $ad_pathoriginals, $ad_pathimages, $ad_paththumbs, $ad_thumbwidth, $ad_thumbheight);
  }

  function savePicture($option) {
    global $mainframe;
    $db = & JFactory::getDBO();
    $post = JRequest::get('post');
    $post['imgtext'] = JRequest::getVar('imgtext', '', 'post', 'string', JREQUEST_ALLOWRAW);
    $row = new DatsoImages($db);
    if (!$row->bind($post)) {
      echo "<script> alert('" . $row->getError() . "'); window.history.go(-1); </script>\n";
      exit ();
    }
    $row->imgdate = mktime();
    $db->setQuery("select ordering from #__datsogallery where catid = '$catid' order by ordering desc limit 1");
    $ordering1 = $db->loadResult();
    $row->ordering = $ordering1 + 1;
    if (!$row->store()) {
      echo "<script> alert('" . $row->getError() . "'); window.history.go(-1); </script>\n";
      exit ();
    }
    $mainframe->redirect("index.php?option=$option");
  }

  function showUpload($option) {
    global $mainframe;
    $db = & JFactory::getDBO();
    $user = & JFactory::getUser();
    require_once (JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_datsogallery' . DS . 'config.datsogallery.php');
    $clist = ShowDropDownCategoryList(0, 'catid', ' class="inputbox" size="1" style="width:228;"');
    $imgtitle = JRequest::getVar('imgtitle');
    $imgtext = JRequest::getVar('imgtext');
    $imgauthor = JRequest::getVar('imgauthor');
    echo "<script type=\"text/javascript\">\n";
    echo "function BatchFormCheck(theForm) {\n";
    echo "var form = document.adminForm;\n";
    echo "if (form.title.value == \"\") {\n";
    echo "alert('" . _DG_PIC_MUST_HAVE_TITLE . "');\n";
    echo "return false;\n";
    echo "} else if (form.catid.value == \"0\") {\n";
    echo "alert('" . _DG_MUST_SELECT_CATEGORY . "');\n";
    echo "return false;\n";
    echo "} else if (form.org_screenshot.value == \"\") {\n";
    echo "alert('" . _DG_MUST_HAVE_FNAME . "');\n";
    echo "return false;\n";
    echo "} else {\n";
    echo "form.submit();\n";
    echo "dgLoading();\n";
    echo "}\n";
    echo "}\n";
    echo "</script>\n";
    echo "<script type=\"text/javascript\">\n";
    echo "var xmlhttp;\n";
    echo "try{xmlhttp = new XMLHttpRequest();}catch(e){\n";
    echo "try{xmlhttp = new ActiveXObject(\"Msxml2.XMLHTTP\");}catch(e){\n";
    echo "try{xmlhttp = new ActiveXObject(\"Microsoft.XMLHTTP\");}catch(e){}}}\n";
    echo "function dgLoading() {\n";
    echo "if(!xmlhttp)return alert(\"No Http Transport.\");\n";
    echo "xmlhttp.open(\"GET\",document.location.href,true);\n";
    echo "xmlhttp.onreadystatechange = function() {\n";
    echo "if (xmlhttp.readyState == 4) {\n";
    echo "document.getElementById(\"status\").innerHTML = '<img src=\"" . $livesite . "/components/com_datsogallery/images/loading.gif\" border=\"0\" align=\"absmiddle\">'\n";
    echo "}\n";
    echo "}\n";
    echo "xmlhttp.send(null);\n";
    echo "}\n";
    echo "</script>";
    echo "<form action='index.php?task=uploadhandler' method='post' name='adminForm' enctype='multipart/form-data' onSubmit=\"return BatchFormCheck(this)\">";
    echo "<table width='100%'><tr><td><fieldset><legend>&nbsp;" . _DG_UPLOAD_NEW_PIC . "&nbsp;</legend>\n";
    echo "<table class='adminlist'>\n";
    echo "<tr>\n";
    echo "<td align='right' width='20%'> <strong>" . _DG_TITLE . ":</strong></td>\n";
    echo "<td>\n";
    echo "<input class='inputbox' type='text' name='imgtitle' size='34' maxlength='100' value='" . htmlspecialchars($imgtitle, ENT_QUOTES) . "' />";
    echo "</td>\n";
    echo "</tr>\n";
    echo "<tr>\n";
    echo "<td align='right'><strong>" . _DG_CATEGORY . ":</strong></td>\n";
    echo "<td>\n";
    echo $clist . '&nbsp;' . dgTip(_DG_ALLOWED_CAT);
    echo "</td>\n";
    echo "</tr>\n";
    echo "<tr>\n";
    echo "<td align='right' valign='top'><strong>" . _DG_DESCRIPTION . ":</strong></td>\n";
    echo "<td>\n";
    echo "<textarea class='inputbox' cols='25' rows='5' name='imgtext'>";
    echo htmlspecialchars($imgtext, ENT_QUOTES);
    echo "</textarea>&nbsp;" . dgTip(_DG_OPT) . "";
    echo "</td>\n";
    echo "</tr>\n";
    echo "<tr>\n";
    echo "<td align='right'><strong>" . _DG_AUTHOR_OWNER . ":</strong></td>\n";
    echo "<td>\n";
    echo "<input class='inputbox' type='text' name='imgauthor' value='" . $imgauthor . "' size='34' maxlength='100' />&nbsp;" . dgTip(_DG_OPT) . "";
    echo "</td>\n";
    echo "</tr>\n";
    echo "<tr>\n";
    echo "<td align='right'><strong>" . _DG_PICTURE . ":</strong></td>\n";
    echo "<td>\n";
    echo "<input class='inputbox' type='file' name='org_screenshot'/> " . dgTip( _DG_MAX_FILESIZE_1 . ": <strong>" . ini_get('upload_max_filesize') . "</strong>" . _DG_MAX_FILESIZE_2 ) . "";
    echo "</td>\n";
    echo "</tr>\n";
    echo "<tr>\n";
    echo "<td></td>";
    echo "<td>\n";
    echo "<input type='hidden' name='option' value='$option' />";
    echo "<input type='hidden' name='approved' value='1' />";
    echo "<input type='hidden' name='owner' value='$user->name' />";
    echo "<input type='hidden' name='screenshot' value='ON' checked />";
    echo "<input type='hidden' name='thumbcreation' value='ON' checked /><br />";
    echo "<div id='status'><input type='submit' value='" . _DG_UPLOAD . "' class='button' /></div>";
    echo "</td>\n";
    echo "</tr>\n";
    echo "</table>\n";
    echo "</legend></td></tr></table>";
    echo "</form>";
  }

  function showBatchUpload($option) {
    global $mainframe;
    $db = & JFactory::getDBO();
    $gendesc = JRequest::getVar("gendesc");

    jimport('joomla.filesystem.folder');
    $path = JPATH_ROOT . DS . 'zipimport';
    if (!JFolder::exists($path)) {
     return JError::raiseWarning(-1, JText::_(_DG_ZIPIMPORT_NOT_EXIST_TIP));
    }
?>
<script type="text/javascript">
    function BatchFormCheck(theForm) {
        if (theForm.zippack.value == "") {
            alert("<?php echo _DG_ZIP_NOT_SELECTED; ?>");
            return false;
        } else if (theForm.catid.value == "0") {
            alert("<?php echo _DG_ONE_ERR; ?>");
            return false;
        } else if (theForm.gentitle.value == "") {
            alert("<?php echo _DG_TWO_ERR; ?>");
            return false;
        } else {
            dgLoading();
        }
    }
</script>
<script type="text/javascript">
    var xmlhttp;
    try {
        xmlhttp = new XMLHttpRequest();
    } catch(e) {
        try {
            xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
        } catch(e) {
            try {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            } catch(e) {}
        }
    }
    function dgLoading() {
        if (!xmlhttp) return alert("No Http Transport.");
        xmlhttp.open("GET", document.location.href, true);
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4) {
                document.getElementById("status").innerHTML = '<img src="<?php echo $mainframe->getSiteURL(); ?>/components/com_datsogallery/images/loading.gif" border="0" align="absmiddle">'
            }
        }
        xmlhttp.send(null);
    }
</script>

<table width='100%'>
  <tr>
    <td><fieldset>
        <legend>&nbsp;<?php echo _DG_UPLOAD_ZIP;?>&nbsp;</legend>
        <form action='index.php' method='post' name='adminForm' enctype='multipart/form-data' onsubmit='return BatchFormCheck(this)'>
          <table class='adminlist'>
            <tr>
              <td align='right' width='20%'><strong><?php echo _DG_IMAGE_PACK_FIL;?></strong></td>
              <td><input type='file' name='zippack' accept='application/zip, application/x-zip-compressed'>
                <?php echo dgTip( _DG_MAX_FILESIZE_1 . '&nbsp;<strong>' . ini_get('upload_max_filesize') . '</strong>&nbsp;' . _DG_MAX_FILESIZE_2 );?></td>
            </tr>
            <tr>
              <td align='right'><strong><?php echo _DG_CAT_PHOTO_ASS;?>:</strong></td>
              <td>
                      <?php

                        $catid = $mainframe->getUserStateFromRequest("catid{$option}", 'catid', 0);
                        $categories[] = JHTML::_('select.option', '0', _DG_SELECT_CAT);
                        $db->setQuery("select id as value, title as text from #__categories where section='com_datsogallery' order by ordering");
                        $categories = array_merge( $categories, $db->loadObjectList());
                        $clist = JHTML::_('select.genericlist', $categories, 'catid', 'class="inputbox" size="1" style="width:228;"', 'value', 'text', $catid);
                        $clist = ShowDropDownCategoryList(0, 'catid', ' class="inputbox" size="1" style="width:228;"');
                        echo $clist . '&nbsp;' . dgTip(_DG_ALLOWED_CAT);


                      ?>
              </td>
            </tr>
            <tr>
              <td align='right'><strong><?php echo _DG_GENERIC_TITLE;?>:</strong></td>
              <td><input type='text' name='gentitle' size='34' maxlength='256'>
                <?php echo dgTip(_DG_GENERIC_TITLE_BU_I);?></td>
            </tr>
            <tr>
              <td align='right' valign='top'><strong><?php echo _DG_GENERIC_DESC;?>:</strong></td>
              <td><textarea class='inputbox' cols='35' rows='10' name='gendesc'>
                   <?php echo htmlspecialchars($gendesc, ENT_QUOTES);?>
                  </textarea>&nbsp;<?php echo dgTip(_DG_OPT);?>
              </td>
            </tr>
            <tr>
              <td align='right'><strong><?php echo _DG_AUTHOR;?>:</strong></td>
              <td><input type='text' name='photocred' size='34' maxlength='256'>
                <?php echo dgTip(_DG_OPT);?></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan='2' align='left'><div id='status'>
                  <input type='submit' value='<?php echo _DG_UPLOAD;?>' class='button' />
                </div></td>
            </tr>
          </table>
          <input type='hidden' name='option' value='<?php echo $option;?>' />
          <input type='hidden' name='task' value='batchuploadhandler' />
        </form>
      </fieldset></td>
  </tr>
</table>
        <?php

        }

        function showBatchImport($option) {
          global $mainframe;
          $db = & JFactory::getDBO();
          $gendesc = JRequest::getVar('gendesc');

          jimport('joomla.filesystem.folder');
    $path = JPATH_ROOT . DS . 'zipimport';
    if (!JFolder::exists($path)) {
     return JError::raiseWarning(-1, JText::_(_DG_ZIPIMPORT_NOT_EXIST_TIP));
    }
        ?>
<script type=text/javascript>
    function BatchFormCheck(theForm) {
        if (theForm.catid.value == '0') {
            alert('<?php echo _DG_ONE_ERR;?>');
            return false;
        } else if (theForm.gentitle.value == '') {
            alert('<?php echo _DG_TWO_ERR;?>');
            return false;
        } else {
            dgLoading();
        }
    }
</script>
<script type=text/javascript>
    var xmlhttp;
    try {
        xmlhttp = new XMLHttpRequest();
    } catch(e) {
        try {
            xmlhttp = new ActiveXObject(Msxml2.XMLHTTP);
        } catch(e) {
            try {
                xmlhttp = new ActiveXObject(Microsoft.XMLHTTP);
            } catch(e) {}
        }
    }
    function dgLoading() {
        if (!xmlhttp) return alert("No Http Transport.");
        xmlhttp.open(GET, document.location.href, true);
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4) {
                document.getElementById(status).innerHTML = '<img src="<?php echo $mainframe->getSiteURL();?>/components/com_datsogallery/images/loading.gif border=0 align=absmiddle>'
            }
        }
        xmlhttp.send(null);
    }
</script>
<table width='100%'>
  <tr>
    <td><fieldset>
        <legend>&nbsp;<?php echo _DG_IMPORT_ZIP;?>&nbsp;</legend>
        <form action='index.php' method='post' name='adminForm' enctype='multipart/form-data' onsubmit='return BatchFormCheck(this)'>
          <table width='100%' class='adminlist'>
            <tr>
              <td align='right' width='20%'><strong><?php echo _DG_CAT_PHOTO_ASS;?>:</strong></td>
              <td>
                      <?php

                        $catid = $mainframe->getUserStateFromRequest("catid{$option}", 'catid', 0);
                        $categories[] = JHTML::_('select.option', '0', _DG_SELECT_CAT);
                        $db->setQuery("select id AS value, title AS text from #__categories" . "\nwhere section='com_datsogallery' order by ordering");
                        $categories = array_merge( $categories, $db->loadObjectList());
                        $clist = JHTML::_('select.genericlist', $categories, 'catid', 'class="inputbox" size="1" style="width:228;"', 'value', 'text', $catid);
                        $clist = ShowDropDownCategoryList(0, 'catid', ' class="inputbox" size="1" style="width:228;"');
                        echo $clist . '&nbsp;' . dgTip(_DG_ALLOWED_CAT);


                      ?>
             </td>
            </tr>
            <tr>
              <td align='right'><strong><?php echo _DG_GENERIC_TITLE;?>:</strong></td>
              <td><input type=text name=gentitle size=34 maxlength=256>
                <?php echo dgTip(_DG_GENERIC_TITLE_BI_I);?></td>
            </tr>
            <tr>
              <td align='right' valign='top'><strong><?php echo _DG_GENERIC_DESC;?>:</strong></td>
              <td><textarea class='inputbox' cols='35' rows='10' name='gendesc'>
                  <?php echo htmlspecialchars($gendesc, ENT_QUOTES);?>
                  </textarea>
                <?php echo dgTip(_DG_OPT);?>
              </td>
            </tr>
            <tr>
              <td align='right'><strong><?php echo _DG_AUTHOR;?>:</strong></td>
              <td><input type=text name=photocred size=34 maxlength=256>
                <?php echo dgTip(_DG_OPT);?></td>
            </tr>
            <tr>
              <td colspan='2' align='left'><br>
                <div id='status'>
                  <input type='submit' value='<?php echo _DG_ZIP_IMPORT;?>' class='button' />
                </div>
                <input type='hidden' name='option' value='<?php echo $option;?>' />
                <input type='hidden' name='task' value='batchimporthandler' /></td>
            </tr>
          </table>
        </form>
      </fieldset></td>
  </tr>
</table>
        <?php

        }

        function showConfig($option) {
          global $mainframe;
          $db = & JFactory::getDBO();
          require (JPATH_COMPONENT . DS . 'config.datsogallery.php');
          $arr_ad_category = explode(",", $ad_category);
          $clist = testCat($arr_ad_category, "ad_category[]", $extras = "multiple  size=\"6\"", $levellimit = "4");


        ?>
<script type='text/javascript'>
    function submitbutton(pressbutton) {
        var form = document.adminForm;
        if (pressbutton == 'cancel') {
            submitform(pressbutton);
            return;
        }
        if (pressbutton == 'savesettings') {
            submitform(pressbutton);
        }
        if (pressbutton == 'savelaguage') {
            submitform(pressbutton);
        }
    }
</script>
<form action='index.php' method='post' name='adminForm'>
        <?php

          $yesno[] = JHTML::_('select.option', '0', _DG_NO);
          $yesno[] = JHTML::_('select.option', '1', _DG_YES);
          if ($ad_protect) {
            dgProtect($ad_pathoriginals);
          }
          else {
            dgUnprotect($ad_pathoriginals);
          }
          if (file_exists(JPATH_SITE . DS . $ad_pathoriginals . DS . '.htaccess')) {
            $img = dgTip(_DG_PROTECT_YES, 'dg-lock-icon.png');
          }
          else {
            $img = dgTip(_DG_PROTECT_NO, 'dg-lock-open-icon.png');
          }
          jimport('joomla.html.pane');
          $tabs = & JPane::getInstance( 'tabs', array('startOffset' => 0));
          echo $tabs->startPane("settings");
          echo $tabs->startPanel(_DG_DIRS, "tab1");
          echo "<table width='100%'>\n";
          echo "<tr>\n";
          echo "<td><fieldset><legend>&nbsp;" . _DG_DIRS2 . "&nbsp;</legend>";
          echo "<table class=\"adminlist\">\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td width=\"20%\" align=\"left\" valign=\"top\"><strong>" . _DG_ORG_PIC_PATH . ":</strong></td>\n";
          echo "<td width=\"20%\" align=\"left\" valign=\"top\">\n";
          echo "<input type=\"text\" name=\"ad_pathoriginals\" value=" . $ad_pathoriginals . " size=\"42\"></td>\n";
          echo "<td width=\"3%\" align=\"left\">\n";
          writDir($ad_pathoriginals);
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_ORG_PIC_PATH_I) . "</td>\n";
          echo "<td align=\"left\" valign=\"top\">&nbsp;</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td width=\"20%\" align=\"left\" valign=\"top\"><strong>" . _DG_MED_PIC_PATH . ":</strong></td>\n";
          echo "<td width=\"20%\" align=\"left\" valign=\"top\">\n";
          echo "<input type=\"text\" name=\"ad_pathimages\" value=" . $ad_pathimages . " size=\"42\"></td>\n";
          echo "<td width=\"3%\" align=\"left\">\n";
          writDir($ad_pathimages);
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_MED_PIC_PATH_I) . "</td>\n";
          echo "<td align=\"left\" valign=\"top\">&nbsp;</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td width=\"20%\" align=\"left\" valign=\"top\"><strong>" . _DG_THUMB_PIC_PATH . ":</strong></td>\n";
          echo "<td width=\"20%\" align=\"left\" valign=\"top\">\n";
          echo "<input type=\"text\" name=\"ad_paththumbs\" value=" . $ad_paththumbs . " size=\"42\"></td>\n";
          echo "<td width=\"3%\" align=\"left\">\n";
          writDir($ad_paththumbs);
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_THUMB_PIC_PATH_I) . "</td>\n";
          echo "<td align=\"left\" valign=\"top\">&nbsp;</td>\n";
          echo "</tr>";
          jimport('joomla.filesystem.folder');
          $path = JPATH_ROOT . DS . 'zipimport';
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td width=\"20%\" align=\"left\" valign=\"top\"><strong>"._DG_PATH_TO_ZIPIMPORT.":</strong></td>\n";
          echo "<td width=\"20%\" align=\"left\" valign=\"top\">\n";
          echo "<input type=\"text\" value=\"/zipimport\" size=\"42\" disabled></td>\n";
          echo "<td width=\"3%\" align=\"left\">\n";
          if (JFolder::exists($path)) {
            writDir('zipimport');
          } else {
            echo dgTip(_DG_ZIPIMPORT_NOT_EXIST_TIP, 'dg-error-icon.png', '', '#', 0);
          }
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_PATH_TO_ZIPIMPORT_TIP) . "</td>\n";
          echo "<td align=\"left\" valign=\"top\">&nbsp;</td>\n";
          echo "</tr>";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_PROTECT_ORIGINALS . ":</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">\n";
          $yn_ad_protect = JHTML::_('select.genericlist', $yesno, 'ad_protect', 'class=\"inputbox\"', 'value', 'text', $ad_protect);
          echo $yn_ad_protect;
          echo "</td>\n";
          echo "<td width=\"3%\" align=\"left\">" . $img . "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_PROTECT_ORIGINALS_I) . "</td>\n";
          echo "<td></td>";
          echo "</tr>\n";
          echo "</table>";
          echo "</td></tr></table></fieldset>";
          echo $tabs->endPanel();
          echo $tabs->startPanel(_DG_PROCESSING, "tab2");
          echo "<table width='100%'>\n";
          echo "<tr>\n";
          echo "<td><fieldset><legend>&nbsp;" . _DG_PROCESSING2 . "&nbsp;</legend>";
          echo "<table class=\"adminlist\">\n";
          if (function_exists('exif_read_data')) {
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_EXIF . ":</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">";
          $yn_ad_exif = JHTML::_('select.genericlist', $yesno, 'ad_exif', 'class="inputbox"', 'value', 'text', $ad_exif);
          echo $yn_ad_exif;
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_EXIF_I) . "</td>\n";
          echo "<td align=\"left\" valign=\"top\">&nbsp;</td>\n";
          echo "</tr>\n";
          } else {
          $ad_exif = 0;
          }
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_ALLOW_ORGRESIZE . ":</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">\n";
          $yn_ad_orgresize = JHTML::_('select.genericlist', $yesno, 'ad_orgresize', 'class=\"inputbox\"', 'value', 'text', $ad_orgresize);
          echo $yn_ad_orgresize;
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_ALLOW_ORGRESIZE_I) . "</td>\n";
          echo "<td></td>";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_ORGWIDTH . ":</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">\n";
          echo "<input type=\"text\" name=\"ad_orgwidth\" value=" . $ad_orgwidth . " size=\"5\">&nbsp;<strong>px</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_ORGWIDTH_I) . "</td>\n";
          echo "<td align=\"left\" valign=\"top\">&nbsp;</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_ORGHIGHT . ":</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">\n";
          echo "<input type=\"text\" name=\"ad_orgheight\" value=" . $ad_orgheight . " size=\"5\">&nbsp;<strong>px</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_ORGHIGHT_I) . "</td>\n";
          echo "<td align=\"left\" valign=\"top\">&nbsp;</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_MAX_WIDTH . ":</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">\n";
          echo "<input type=\"text\" name=\"ad_maxwidth\" value=" . $ad_maxwidth . " size=\"5\">&nbsp;<strong>px</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_MAX_WIDTH_IMAGE) . "</td>\n";
          echo "<td align=\"left\" valign=\"top\">&nbsp;</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_MAX_HIGHT . ":</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">\n";
          echo "<input type=\"text\" name=\"ad_maxheight\" value=" . $ad_maxheight . " size=\"5\">&nbsp;<strong>px</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_MAX_HIGHT_IMAGE) . "</td>\n";
          echo "<td align=\"left\" valign=\"top\">&nbsp;</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_THUMBNAIL_WIDTH . ":</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">\n";
          echo "<input type=\"text\" name=\"ad_thumbwidth\" value=" . $ad_thumbwidth . " size=\"5\">&nbsp;<strong>px</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_WIDTH_THUMBNAIL_CREAT) . "</td>\n";
          echo "<td align=\"left\" valign=\"top\">&nbsp;</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_THUMBNAIL_HEIGHT . ":</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">\n";
          echo "<input type=\"text\" name=\"ad_thumbheight\" value=" . $ad_thumbheight . " size=\"5\">&nbsp;<strong>px</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_HEIGHT_THUMBNAIL_CREAT) . "</td>\n";
          echo "<td align=\"left\" valign=\"top\">&nbsp;</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td width=\"20%\" align=\"left\" valign=\"top\"><strong>" . _DG_SKETCHING_METHOD . "</strong></td>\n";
          echo "<td width=\"20%\" align=\"left\" valign=\"top\">";
          $crsc[] = JHTML::_('select.option', '0', _DG_CROP_METHOD);
          $crsc[] = JHTML::_('select.option', '1', _DG_SCALE_METHOD);
          $cs_ad_crsc = JHTML::_('select.genericlist', $crsc, 'ad_crsc', 'class="inputbox"', 'value', 'text', $ad_crsc);
          echo $cs_ad_crsc;
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_SKETCHING_METHOD_I) . "</td>\n";
          echo "<td></td>";
          echo "</tr>";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_THUMBNAIL_QUALIT . ":</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">\n";
          echo "<input type=\"text\" name=\"ad_thumbquality\" value=" . $ad_thumbquality . " size=\"5\">&nbsp;<strong>%</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_THUMBNAIL_QUALIT_I) . "</td>\n";
          echo "<td align=\"left\" valign=\"top\">&nbsp;</td>\n";
          echo "</tr>\n";
          echo "</table>";
          echo "</td></tr></table></fieldset>";
          echo $tabs->endPanel();
          echo $tabs->startPanel(_DG_VIEW, "tab3");
          echo "<table width='100%'>\n";
          echo "<tr>\n";
          echo "<td><fieldset><legend>&nbsp;" . _DG_VIEW_DETAILS . "&nbsp;</legend>";
          echo "<table class=\"adminlist\">\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td width=\"20%\" align=\"left\" valign=\"top\"><strong>" . _DG_SHOW_DETAILS . "</strong></td>\n";
          echo "<td width=\"20%\" align=\"left\" valign=\"top\">";
          $yn_ad_showdetail = JHTML::_('select.genericlist', $yesno, 'ad_showdetail', 'class="inputbox"', 'value', 'text', $ad_showdetail);
          echo $yn_ad_showdetail;
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_SHOW_DETAILS_I) . "</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_DESCRIPTION . ":</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">\n";
          $yn_ad_showimgtext = JHTML::_('select.genericlist', $yesno, 'ad_showimgtext', 'class=\"inputbox\"', 'value', 'text', $ad_showimgtext);
          echo $yn_ad_showimgtext;
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_DESCRIPTION_I) . "</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_DATE_ADD . ":</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">\n";
          $yn_ad_showfimgdate = JHTML::_('select.genericlist', $yesno, 'ad_showfimgdate', 'class=\"inputbox\"', 'value', 'text', $ad_showfimgdate);
          echo $yn_ad_showfimgdate;
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_DATE_ADD_I) . "</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_HITS . ":</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">\n";
          $yn_ad_showimgcounter = JHTML::_('select.genericlist', $yesno, 'ad_showimgcounter', 'class=\"inputbox\"', 'value', 'text', $ad_showimgcounter);
          echo $yn_ad_showimgcounter;
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_HITS_I) . "</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_RATING . ":</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">\n";
          $yn_ad_showfrating = JHTML::_('select.genericlist', $yesno, 'ad_showfrating', 'class=\"inputbox\"', 'value', 'text', $ad_showfrating);
          echo $yn_ad_showfrating;
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_RATING_I) . "</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_SIZE . ":</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">\n";
          $yn_ad_showres = JHTML::_('select.genericlist', $yesno, 'ad_showres', 'class=\"inputbox\"', 'value', 'text', $ad_showres);
          echo $yn_ad_showres;
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_SIZE_I) . "</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_FILESIZE . ":</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">\n";
          $yn_ad_showfimgsize = JHTML::_('select.genericlist', $yesno, 'ad_showfimgsize', 'class=\"inputbox\"', 'value', 'text', $ad_showfimgsize);
          echo $yn_ad_showfimgsize;
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_FILESIZE_I) . "</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_AUTHOR_OWNER . ":</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">\n";
          $yn_ad_showimgauthor = JHTML::_('select.genericlist', $yesno, 'ad_showimgauthor', 'class=\"inputbox\"', 'value', 'text', $ad_showimgauthor);
          echo $yn_ad_showimgauthor;
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_AUTHOR_OWNER_I) . "</td>\n";
          echo "</tr>\n";
          echo "<tr>\n";
          echo "<th colspan=\"3\">\n";
          echo "<div align=\"left\">" . _DG_VIEW_NAV_PANEL . "</div>\n";
          echo "</th>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_SHOW_PANEL . "</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">";
          $yn_ad_showpanel = JHTML::_('select.genericlist', $yesno, 'ad_showpanel', 'class="inputbox"', 'value', 'text', $ad_showpanel);
          echo $yn_ad_showpanel;
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_SHOW_PANEL_I) . "</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_SHOW_USERPANEL . "</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">";
          $yn_ad_userpannel = JHTML::_('select.genericlist', $yesno, 'ad_userpannel', 'class="inputbox"', 'value', 'text', $ad_userpannel);
          echo $yn_ad_userpannel;
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_SHOW_USERPANEL_I) . "</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_SHOW_SPECIALPANEL . "</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">";
          $yn_ad_special = JHTML::_('select.genericlist', $yesno, 'ad_special', 'class="inputbox"', 'value', 'text', $ad_special);
          echo $yn_ad_special;
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_SHOW_SPECIALPANEL_I) . "</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_SHOW_RATINGPANEL . "</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">";
          $yn_ad_rating = JHTML::_('select.genericlist', $yesno, 'ad_rating', 'class="inputbox"', 'value', 'text', $ad_rating);
          echo $yn_ad_rating;
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_SHOW_RATINGPANEL_I) . "</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_SHOW_NEWPANEL . "</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">";
          $yn_ad_lastadd = JHTML::_('select.genericlist', $yesno, 'ad_lastadd', 'class="inputbox"', 'value', 'text', $ad_lastadd);
          echo $yn_ad_lastadd;
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_SHOW_NEWPANEL_I) . "</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_SHOW_LASTCOMMENTPANEL . "</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">";
          $yn_ad_lastcomment = JHTML::_('select.genericlist', $yesno, 'ad_lastcomment', 'class="inputbox"', 'value', 'text', $ad_lastcomment);
          echo $yn_ad_lastcomment;
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_SHOW_LASTCOMMENTPANEL_I) . "</td>\n";
          echo "</tr>\n";
          echo "<tr>\n";
          echo "<th colspan=\"3\">\n";
          echo "<div align=\"left\">" . _DG_VIEW_OPTIONAL . "</div>\n";
          echo "</th>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_SHOW_TITLE_COM . ":</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">";
          $yn_ad_comtitle = JHTML::_('select.genericlist', $yesno, 'ad_comtitle', 'class="inputbox"', 'value', 'text', $ad_comtitle);
          echo $yn_ad_comtitle;
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_SHOW_TITLE_COM_I) . "</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_USE_PNTHUMB . ":</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">";
          $yn_ad_pnthumb = JHTML::_('select.genericlist', $yesno, 'ad_pnthumb', 'class="inputbox"', 'value', 'text', $ad_pnthumb);
          echo $yn_ad_pnthumb;
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_USE_PNTHUMB_I) . "</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_SHOW_POWERED . "</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">";
          $yn_ad_powered = JHTML::_('select.genericlist', $yesno, 'ad_powered', 'class="inputbox"', 'value', 'text', $ad_powered);
          echo $yn_ad_powered;
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_SHOW_POWERED_I) . "</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_SHOW_PICINCAT . "</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">";
          $yn_ad_picincat = JHTML::_('select.genericlist', $yesno, 'ad_picincat', 'class="inputbox"', 'value', 'text', $ad_picincat);
          echo $yn_ad_picincat;
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_SHOW_PICINCAT_I) . "</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_COLUMNS_IN_SUBCAT . "</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">\n";
          echo "<input type=\"text\" name=\"ad_ncsc\" value=\"" . $ad_ncsc . "\" size=\"5\">\n";
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_COLUMNS_IN_SUBCAT_I) . "</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\"   >\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_COLUMNS_IN_SUBCAT_TH . "</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">\n";
          echo "<input type=\"text\" name=\"ad_cp\" value=\"" . $ad_cp . "\" size=\"5\">\n";
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_COLUMNS_IN_SUBCAT_TH_I) . "</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_CATS_PERPAGE . "</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">\n";
          echo "<input type=\"text\" name=\"ad_catsperpage\" value=\"" . $ad_catsperpage . "\" size=\"5\">\n";
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_CATS_PERPAGE_I) . "</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_DISPLAY_PIC . "</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">\n";
          echo "<input type=\"text\" name=\"ad_perpage\" value=\"" . $ad_perpage . "\" size=\"5\">\n";
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_DISPLAY_PIC_I) . "</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td width=\"20%\" align=\"left\" valign=\"top\"><strong>" . _DG_SORTBY . ":</strong></td>\n";
          echo "<td width=\"20%\" align=\"left\" valign=\"top\">";
          $sortby[] = JHTML::_('select.option', 'ASC', _DG_SORTBYASC);
          $sortby[] = JHTML::_('select.option', 'DESC', _DG_SORTBYDESC);
          $sb_ad_sortby = JHTML::_('select.genericlist', $sortby, 'ad_sortby', 'class="inputbox"', 'value', 'text', $ad_sortby);
          echo $sb_ad_sortby;
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_SORTBY_I) . "</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_DISPLAY_TOP . "</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">\n";
          echo "<input type=\"text\" name=\"ad_toplist\" value=\"" . $ad_toplist . "\" size=\"5\">\n";
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_DISPLAY_TOP_I) . "</td>\n";
          echo "</tr>\n";
          echo "</td></tr></table></fieldset>";
          echo "</tr>\n";
          echo "</table>";
          echo $tabs->endPanel();
          echo $tabs->startPanel(_DG_UPBYUSER, "tab4");
          echo "<table width='100%'>\n";
          echo "<tr>\n";
          echo "<td><fieldset><legend>&nbsp;" . _DG_USER_UPLOAD_SETTING . "&nbsp;</legend>";
          echo "<table class=\"adminlist\">\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_ADMIN_APPRO_NEEDED . ":</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">";
          $yn_ad_approve = JHTML::_('select.genericlist', $yesno, 'ad_approve', 'class="inputbox"', 'value', 'text', $ad_approve);
          echo $yn_ad_approve;
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_USER_UPLOAD_NEDD_APPROVAL) . "</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td width=\"20%\" align=\"left\" valign=\"top\"><strong>" . _DG_MAX_NR_IMAGES . ":</strong></td>\n";
          echo "<td width=\"20%\" align=\"left\" valign=\"top\">\n";
          echo "<input type=\"text\" name=\"ad_maxuserimage\" value=\"" . $ad_maxuserimage . "\" size=\"5\">\n";
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_MAX_ALLOWED_PICS) . "</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_MAX_SIZE_IMAGE . ":</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">\n";
          echo "<input type=\"text\" name=\"ad_maxfilesize\" value=\"" . $ad_maxfilesize . "\" size=\"5\"></td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_MAX_ALLOWED_FILESIZE) . "</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_ALLOWED_CAT . ":</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">" . $clist . "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_ALLOWED_CAT_I) . "</td>\n";
          echo "</tr>\n";
          echo "</table>";
          echo "</td></tr></table></fieldset>";
          echo $tabs->endPanel();
          echo $tabs->startPanel(_DG_RATE, "tab5");
          echo "<table width='100%'>\n";
          echo "<tr>\n";
          echo "<td><fieldset><legend>&nbsp;" . _DG_RATE_SETTING . "&nbsp;</legend>";
          echo "<table class=\"adminlist\">\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td width=\"20%\" align=\"left\" valign=\"top\"><strong>" . _DG_ALLOW_RATING . ":</strong></td>\n";
          echo "<td width=\"20%\" align=\"left\" valign=\"top\">";
          $yn_ad_showrating = JHTML::_('select.genericlist', $yesno, 'ad_showrating', 'class="inputbox"', 'value', 'text', $ad_showrating);
          echo $yn_ad_showrating;
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_ALLOW_RATING_I) . "</td>\n";
          echo "</tr>\n";
          echo "</table>";
          echo "</td></tr></table></fieldset>";
          echo $tabs->endPanel();
          echo $tabs->startPanel(_DG_COMMENT1, "tab6");
          echo "<table width='100%'>\n";
          echo "<tr>\n";
          echo "<td><fieldset><legend>&nbsp;" . _DG_COMMENT_SETTING . "&nbsp;</legend>";
          echo "<table class=\"adminlist\">\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_ALLOW_COMM . ":</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">";
          $yn_ad_showcomment = JHTML::_('select.genericlist', $yesno, 'ad_showcomment', 'class="inputbox"', 'value', 'text', $ad_showcomment);
          echo $yn_ad_showcomment;
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_ALLOW_COMM_I) . "</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td width=\"20%\" align=\"left\" valign=\"top\"><strong>" . _DG_ANONYM_COMM . ":</strong></td>\n";
          echo "<td width=\"20%\" align=\"left\" valign=\"top\">";
          $yn_ad_anoncomment = JHTML::_('select.genericlist', $yesno, 'ad_anoncomment', 'class="inputbox"', 'value', 'text', $ad_anoncomment);
          echo $yn_ad_anoncomment;
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_ANONYM_COMM_I) . "</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_ALLOW_BB_COD . ":</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">";
          $yn_ad_bbcodesupport = JHTML::_('select.genericlist', $yesno, 'ad_bbcodesupport', 'class="inputbox"', 'value', 'text', $ad_bbcodesupport);
          echo $yn_ad_bbcodesupport;
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_ALLOW_BB_COD_I) . "</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_SECURITY . ":</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">";
          $yn_ad_security = JHTML::_('select.genericlist', $yesno, 'ad_security', 'class="inputbox"', 'value', 'text', $ad_security);
          echo $yn_ad_security;
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_SECURITY_I) . "</td>\n";
          echo "</tr>\n";
          $db->setQuery( "SELECT id FROM `#__components` WHERE `option` = 'com_community' AND `parent` = 0 AND `enabled` = 1" );
	      $result = $db->loadResult();
          if ($result){
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_JS_AVATAR . ":</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">";
          $yn_ad_js = JHTML::_('select.genericlist', $yesno, 'ad_js', 'class="inputbox"', 'value', 'text', $ad_js);
          echo $yn_ad_js;
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_JS_AVATAR_I) . "</td>\n";
          echo "</tr>\n";
          } else {
          $ad_js = 0;
          }
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td width=\"20%\" align=\"left\" valign=\"top\"><strong>" . _DG_NAME_OR_USER . ":</strong></td>\n";
          echo "<td width=\"20%\" align=\"left\" valign=\"top\">";
          $name_or_user[] = JHTML::_('select.option', 'user', _DG_AS_USER);
          $name_or_user[] = JHTML::_('select.option', 'name', _DG_AS_NAME);
          $un_ad_name_or_user = JHTML::_('select.genericlist', $name_or_user, 'ad_name_or_user', 'class="inputbox"', 'value', 'text', $ad_name_or_user);
          echo $un_ad_name_or_user;
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_NAME_OR_USER_I) . "</td>\n";
          echo "</tr>";
          echo "</table>";
          echo "</td></tr></table></fieldset>";
          echo $tabs->endPanel();
          echo $tabs->startPanel(_DG_OPTION, "tab7");
          echo "<table width='100%'>\n";
          echo "<tr>\n";
          echo "<td><fieldset><legend>&nbsp;" . _DG_OPTION2 . "&nbsp;</legend>";
          echo "<table class=\"adminlist\">\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td width=\"20%\" align=\"left\" valign=\"top\"><strong>" . _DG_USE_LIGHTBOX . ":</strong></td>\n";
          echo "<td width=\"20%\" align=\"left\" valign=\"top\">";
          $yn_ad_lightbox = JHTML::_('select.genericlist', $yesno, 'ad_lightbox', 'class="inputbox"', 'value', 'text', $ad_lightbox);
          echo $yn_ad_lightbox;
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_USE_LIGHTBOX_I) . "</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td width=\"20%\" align=\"left\" valign=\"top\"><strong>" . _DG_LIGHTBOX_FOR_ALL . ":</strong></td>\n";
          echo "<td width=\"20%\" align=\"left\" valign=\"top\">";
          $yn_ad_lightbox_fa = JHTML::_('select.genericlist', $yesno, 'ad_lightbox_fa', 'class="inputbox"', 'value', 'text', $ad_lightbox_fa);
          echo $yn_ad_lightbox_fa;
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_LIGHTBOX_FOR_ALL_I) . "</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td width=\"20%\" align=\"left\" valign=\"top\"><strong>" . _DG_USE_WATERMARK . "</strong></td>\n";
          echo "<td width=\"20%\" align=\"left\" valign=\"top\">";
          $yn_ad_showwatermark = JHTML::_('select.genericlist', $yesno, 'ad_showwatermark', 'class="inputbox"', 'value', 'text', $ad_showwatermark);
          echo $yn_ad_showwatermark;
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_USE_WATERMARK_I) . "</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_USE_DOWNLOAD . "</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">";
          $yn_ad_showdownload = JHTML::_('select.genericlist', $yesno, 'ad_showdownload', 'class="inputbox"', 'value', 'text', $ad_showdownload);
          echo $yn_ad_showdownload;
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_USE_DOWNLOAD_I) . "</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_PUB_DOWNLOAD . ":</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">";
          $yn_ad_downpub = JHTML::_('select.genericlist', $yesno, 'ad_downpub', 'class="inputbox"', 'value', 'text', $ad_downpub);
          echo $yn_ad_downpub;
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_PUB_DOWNLOAD_I) . "</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_ALLOW_SLIDESHOW . ":</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">";
          $yn_ad_slideshow = JHTML::_('select.genericlist', $yesno, 'ad_slideshow', 'class="inputbox"', 'value', 'text', $ad_slideshow);
          echo $yn_ad_slideshow;
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_SHOW_SLIDESHOW_BUTON_USER) . "</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_SHOW_SEARCH . ":</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">";
          $yn_ad_search = JHTML::_('select.genericlist', $yesno, 'ad_search', 'class="inputbox"', 'value', 'text', $ad_search);
          echo $yn_ad_search;
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_SHOW_SEARCH_I) . "</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_USE_PATHWAY . "</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">";
          $yn_ad_pathway = JHTML::_('select.genericlist', $yesno, 'ad_pathway', 'class="inputbox"', 'value', 'text', $ad_pathway);
          echo $yn_ad_pathway;
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_USE_PATHWAY_I) . "</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_SHOW_SEND2FRIEND . "</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">";
          $yn_ad_showsend2friend = JHTML::_('select.genericlist', $yesno, 'ad_showsend2friend', 'class="inputbox"', 'value', 'text', $ad_showsend2friend);
          echo $yn_ad_showsend2friend;
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_SHOW_SEND2FRIEND_I) . "</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_SHOW_INFORMER . ":</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">";
          $yn_ad_showinformer = JHTML::_('select.genericlist', $yesno, 'ad_showinformer', 'class="inputbox"', 'value', 'text', $ad_showinformer);
          echo $yn_ad_showinformer;
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_SHOW_INFORMER_I) . "</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td width=\"20%\" align=\"left\" valign=\"top\"><strong>" . _DG_LIST_OF_PERIODS . ":</strong></td>\n";
          echo "<td width=\"20%\" align=\"left\" valign=\"top\">";
          $periods[] = JHTML::_('select.option', '1', _DG_PS_SECOND);
          $periods[] = JHTML::_('select.option', '60', _DG_PS_MINUTE);
          $periods[] = JHTML::_('select.option', '3600', _DG_PS_HOUR);
          $periods[] = JHTML::_('select.option', '86400', _DG_PS_DAY);
          $periods[] = JHTML::_('select.option', '604800', _DG_PS_WEEK);
          $periods[] = JHTML::_('select.option', '2629744', _DG_PS_MONTH);
          $periods[] = JHTML::_('select.option', '31556926', _DG_PS_YEAR);
          $ps_ad_periods = JHTML::_('select.genericlist', $periods, 'ad_periods', 'class="inputbox"', 'value', 'text', $ad_periods);
          echo $ps_ad_periods;
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_LIST_OF_PERIODS_I) . "</td>\n";
          echo "</tr>";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_META_GENERATOR . ":</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">";
          $yn_ad_metagen = JHTML::_('select.genericlist', $yesno, 'ad_metagen', 'class="inputbox"', 'value', 'text', $ad_metagen);
          echo $yn_ad_metagen;
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_META_GENERATOR_I) . "</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_WORDS2IGNORE . "</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">\n";
          echo getWords($option);
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_WORDS2IGNORE_I) . "</td>\n";
          echo "</td></tr>";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_BOOKMARKER . ":</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">";
          $yn_ad_bookmarker = JHTML::_('select.genericlist', $yesno, 'ad_bookmarker', 'class="inputbox"', 'value', 'text', $ad_bookmarker);
          echo $yn_ad_bookmarker;
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_BOOKMARKER_TIP) . "</td>\n";
          echo "</tr>\n";
          echo "<tr align=\"left\" valign=\"middle\">\n";
          echo "<td align=\"left\" valign=\"top\"><strong>" . _DG_BOOKMARKER_SERVICES . ":</strong></td>\n";
          echo "<td align=\"left\" valign=\"top\">";
          echo "<table width=\"100%\" class=\"adminlist\"><tr><td width='50%'>";
          echo '<img style="vertical-align:bottom;padding:1px;" align="baseline" src="'.JURI::root()."components/com_datsogallery/images/bookmarker/google.png".'" title="Google" alt="" />';
          $yn_ad_google = JHTML::_('select.booleanlist', 'ad_google', 'class="inputbox"', $ad_google);
          echo $yn_ad_google;
          echo '<br /><img style="vertical-align:bottom;padding:1px;" align="baseline" src="'.JURI::root()."components/com_datsogallery/images/bookmarker/facebook.png".'" title="Facebook" alt="" />';
          $yn_ad_facebook = JHTML::_('select.booleanlist', 'ad_facebook', 'class="inputbox"', $ad_facebook);
          echo $yn_ad_facebook;
          echo '<br /><img style="vertical-align:bottom;padding:1px;" align="baseline" src="'.JURI::root()."components/com_datsogallery/images/bookmarker/twitter.png".'" title="Twitter" alt="" />';
          $yn_ad_twitter = JHTML::_('select.booleanlist', 'ad_twitter', 'class="inputbox"', $ad_twitter);
          echo $yn_ad_twitter;
          echo '<br /><img style="vertical-align:bottom;padding:1px;" align="baseline" src="'.JURI::root()."components/com_datsogallery/images/bookmarker/myspace.png".'" title="Myspace" alt="" />';
          $yn_ad_myspace = JHTML::_('select.booleanlist', 'ad_myspace', 'class="inputbox"', $ad_myspace);
          echo $yn_ad_myspace;
          echo '<br /><img style="vertical-align:bottom;padding:1px;" align="baseline" src="'.JURI::root()."components/com_datsogallery/images/bookmarker/linkedin.png".'" title="Linkedin" alt="" />';
          $yn_ad_linkedin = JHTML::_('select.booleanlist', 'ad_linkedin', 'class="inputbox"', $ad_linkedin);
          echo $yn_ad_linkedin;
          echo '<br /><img style="vertical-align:bottom;padding:1px;" align="baseline" src="'.JURI::root()."components/com_datsogallery/images/bookmarker/yahoo.png".'" title="Yahoo" alt="" />';
          $yn_ad_yahoo = JHTML::_('select.booleanlist', 'ad_yahoo', 'class="inputbox"', $ad_yahoo);
          echo $yn_ad_yahoo;
          echo "</td><td width='50%'>";
          echo '<img style="vertical-align:bottom;padding:1px;" align="baseline" src="'.JURI::root()."components/com_datsogallery/images/bookmarker/digg.png".'" title="Digg" alt="" />';
          $yn_ad_digg = JHTML::_('select.booleanlist', 'ad_digg', 'class="inputbox"', $ad_digg);
          echo $yn_ad_digg;
          echo '<br /><img style="vertical-align:bottom;padding:1px;" align="baseline" src="'.JURI::root()."components/com_datsogallery/images/bookmarker/delicious.png".'" title="Del.icoi.us" alt="" />';
          $yn_ad_del = JHTML::_('select.booleanlist', 'ad_del', 'class="inputbox"', $ad_del);
          echo $yn_ad_del;
          echo '<br /><img style="vertical-align:bottom;padding:1px;" align="baseline" src="'.JURI::root()."components/com_datsogallery/images/bookmarker/windows.png".'" title="Windows Live" alt="" />';
          $yn_ad_live = JHTML::_('select.booleanlist', 'ad_live', 'class="inputbox"', $ad_live);
          echo $yn_ad_live;
          echo '<br /><img style="vertical-align:bottom;padding:1px;" align="baseline" src="'.JURI::root()."components/com_datsogallery/images/bookmarker/furl.png".'" title="Furl" alt="" />';
          $yn_ad_furl = JHTML::_('select.booleanlist', 'ad_furl', 'class="inputbox"', $ad_furl);
          echo $yn_ad_furl;
          echo '<br /><img style="vertical-align:bottom;padding:1px;" align="baseline" src="'.JURI::root()."components/com_datsogallery/images/bookmarker/reddit.png".'" title="Reddit" alt="" />';
          $yn_ad_reddit = JHTML::_('select.booleanlist', 'ad_reddit', 'class="inputbox"', $ad_reddit);
          echo $yn_ad_reddit;
          echo '<br /><img style="vertical-align:bottom;padding:1px;" align="baseline" src="'.JURI::root()."components/com_datsogallery/images/bookmarker/technorati.png".'" title="Technorati" alt="" />';
          $yn_ad_technorati = JHTML::_('select.booleanlist', 'ad_technorati', 'class="inputbox"', $ad_technorati);
          echo $yn_ad_technorati;
          echo "</td></tr></table>";
          echo "</td>\n";
          echo "<td align=\"left\" valign=\"top\">" . dgTip(_DG_BOOKMARKER_SERVICES_TIP) . "</td>\n";
          echo "</tr>\n";
          echo "</table>";
          echo "</td></tr></table></fieldset>";
          echo $tabs->endPanel();
          echo $tabs->startPanel(_DG_LANG, "tab8");
          echo showLanguage($option);
          echo $tabs->endPanel();
          echo $tabs->startPanel(_DG_COMPONENT_INFO, "tab9");


        ?>
<table width='100%'>
<tr>
  <td><fieldset>
    <legend>&nbsp;
            <?php

              echo _DG_COMPONENT_INFO1;


            ?>
    &nbsp;</legend>
    <table>
    <tr align="left" valign="middle">
      <td width="15%" align="left" valign="top"><a href="http://www.datso.fr" target="_blank">
       <img src="components/com_datsogallery/images/datsogallery-box.png" alt="" title="DATSOGALLERY BOX" width="200" height="180" align="middle" border="0" hspace="5" vspace="5" /></a>
      </td>
      <td width="25%" align="left" valign="top">
      <p><font color='#808080'>
                  <?php

                    $c = _DG_VER;
                    $xmlfile = "http://www.datso.fr/latest/com_datsogallery_latest.xml";
                    $v = getDatso($xmlfile, 'version');
                    $c = _DG_VER;
                    if (empty ($v)) {
                      $latest_version = 'n/a';
                    }
                    else {
                      $pot = array(1000000000, 10000000, 100000, 1);
                      $wv = explode('.', $v);
                      $wvd = 0;
                      foreach ($wv as $i => $d) {
                        $wvd = $wvd + $d * $pot[$i];
                      }
                      $cv = explode('.', $c);
                      $cvd = 0;
                      foreach ($cv as $i => $d) {
                        $cvd = $cvd + $d * $pot[$i];
                      }
                      if ($wvd > $cvd) {
                        $latest_version = "<h3>" . _DG_VERSION_AVAILABLE . "<a href=\"http://www.datso.fr/\">$v</a></h3>";
                      }
                      else {
                        $latest_version = "<h3>" . _DG_VERSION_INSTALLED . _DG_VER . "</h3>";
                        ;
                      }
                    }
                    echo $latest_version;


                  ?>
          </font></p>
        <ul>
          <li><a href='http://www.datso.fr/news.html'>
                    <?php

                      echo _DG_NEWS;


                    ?>
            </a></li>
          <li><a href='http://www.datso.fr/downloads.html'>
                    <?php

                      echo _DG_CHECK_MODS_AND_PGS;


                    ?>
            </a></li>
          <li><a href='http://www.datso.fr/flash-training.html'>
                    <?php

                      echo _DG_FLASH_DEMO;


                    ?>
            </a></li>
        </ul>
</td>
<td align="left" valign="top"></td>
</tr>
</table>
</fieldset>
</td>
</tr>
</table>
        <?php

          echo $tabs->endPanel();
        ?>
<input type='hidden' name='option' value='<?php echo $option; ?>' />
<input type='hidden' name='act' value='' />
</form>
        <?php

          echo $tabs->endPane();


        }

        $ad_cr = "DatsoGallery " . _DG_VER . "<br />By <a href='http://www.datso.fr'>Andrey Datso</a>";

        function saveConfig($option) {
          global $mainframe;
          $ad_category = JRequest::getVar( 'ad_category', array(0), 'post', 'array' );
          $configfile = JPATH_COMPONENT . DS . 'config.datsogallery.php';
          @chmod($configfile, 0766);
          $permission = is_writable($configfile);
          if (!$permission) {
            $mainframe->redirect("index.php?option=$option&act=config", _DG_CONFIG_NO_WRITE);
            break;
          }
          $ad_category = implode(",", $ad_category);
          $config = "<?php\n";
          $config .= "defined( '_JEXEC' ) or die( 'Restricted access' );\n";
          $config .= "\$ad_pathoriginals = \"" . JRequest::getVar('ad_pathoriginals', '/images/stories/dg_originals', 'post', 'string') . "\";\n";
          $config .= "\$ad_pathimages = \"" . JRequest::getVar('ad_pathimages', '/images/stories/dg_pictures', 'post', 'string') . "\";\n";
          $config .= "\$ad_paththumbs = \"" . JRequest::getVar('ad_paththumbs', '/images/stories/dg_thumbnails', 'post', 'string') . "\";\n";
          $config .= "\$ad_protect = \"" . JRequest::getVar('ad_protect', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_orgresize = \"" . JRequest::getVar('ad_orgresize', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_orgwidth = \"" . JRequest::getVar('ad_orgwidth', '800', 'post', 'int') . "\";\n";
          $config .= "\$ad_orgheight = \"" . JRequest::getVar('ad_orgheight', '800', 'post', 'int') . "\";\n";
          $config .= "\$ad_thumbwidth = \"" . JRequest::getVar('ad_thumbwidth', '100', 'post', 'int') . "\";\n";
          $config .= "\$ad_thumbheight = \"" . JRequest::getVar('ad_thumbheight', '100', 'post', 'int') . "\";\n";
          $config .= "\$ad_crsc = \"" . JRequest::getVar('ad_crsc', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_thumbquality = \"" . JRequest::getVar('ad_thumbquality', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_showdetail = \"" . JRequest::getVar('ad_showdetail', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_showrating = \"" . JRequest::getVar('ad_showrating', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_showcomment = \"" . JRequest::getVar('ad_showcomment', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_pathway = \"" . JRequest::getVar('ad_pathway', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_showpanel = \"" . JRequest::getVar('ad_showpanel', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_userpannel = \"" . JRequest::getVar('ad_userpannel', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_special = \"" . JRequest::getVar('ad_special', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_rating = \"" . JRequest::getVar('ad_rating', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_lastadd = \"" . JRequest::getVar('ad_lastadd', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_lastcomment = \"" . JRequest::getVar('ad_lastcomment', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_showinformer = \"" . JRequest::getVar('ad_showinformer', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_periods = \"" . JRequest::getVar('ad_periods', '12', 'post', 'int') . "\";\n";
          $config .= "\$ad_search = \"" . JRequest::getVar('ad_search', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_comtitle = \"" . JRequest::getVar('ad_comtitle', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_showsend2friend = \"" . JRequest::getVar('ad_showsend2friend', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_picincat = \"" . JRequest::getVar('ad_picincat', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_powered = \"" . JRequest::getVar('ad_powered', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_showwatermark = \"" . JRequest::getVar('ad_showwatermark', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_showdownload = \"" . JRequest::getVar('ad_showdownload', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_downpub = \"" . JRequest::getVar('ad_downpub', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_anoncomment = \"" . JRequest::getVar('ad_anoncomment', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_perpage = \"" . JRequest::getVar('ad_perpage', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_catsperpage = \"" . JRequest::getVar('ad_catsperpage', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_sortby = \"" . JRequest::getVar('ad_sortby', 'ASC', 'post', 'word') . "\";\n";
          $config .= "\$ad_toplist = \"" . JRequest::getVar('ad_toplist', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_slideshow = \"" . JRequest::getVar('ad_slideshow', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_bbcodesupport = \"" . JRequest::getVar('ad_bbcodesupport', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_approve = \"" . JRequest::getVar('ad_approve', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_maxuserimage = \"" . JRequest::getVar('ad_maxuserimage', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_maxfilesize = \"" . JRequest::getVar('ad_maxfilesize', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_maxwidth = \"" . JRequest::getVar('ad_maxwidth', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_maxheight = \"" . JRequest::getVar('ad_maxheight', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_category = \"" . $ad_category . "\";\n";
          $config .= "\$ad_ncsc = \"" . JRequest::getVar('ad_ncsc', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_cr = \"DatsoGallery<br />By <a href='http://www.datso.fr'>Andrey Datso</a>\";\n";
          $config .= "\$ad_showimgtext = \"" . JRequest::getVar('ad_showimgtext', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_showfimgdate = \"" . JRequest::getVar('ad_showfimgdate', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_showimgcounter = \"" . JRequest::getVar('ad_showimgcounter', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_showfrating = \"" . JRequest::getVar('ad_showfrating', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_showres = \"" . JRequest::getVar('ad_showres', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_showfimgsize = \"" . JRequest::getVar('ad_showfimgsize', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_showimgauthor = \"" . JRequest::getVar('ad_showimgauthor', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_cp = \"" . JRequest::getVar('ad_cp', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_security = \"" . JRequest::getVar('ad_security', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_lightbox = \"" . JRequest::getVar('ad_lightbox', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_lightbox_fa = \"" . JRequest::getVar('ad_lightbox_fa', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_name_or_user = \"" . JRequest::getVar('ad_name_or_user', 'login', 'post', 'word') . "\";\n";
          $config .= "\$ad_metagen = \"" . JRequest::getVar('ad_metagen', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_js = \"" . JRequest::getVar('ad_js', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_exif = \"" . JRequest::getVar('ad_exif', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_pnthumb = \"" . JRequest::getVar('ad_pnthumb', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_bookmarker = \"" . JRequest::getVar('ad_bookmarker', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_google = \"" . JRequest::getVar('ad_google', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_facebook = \"" . JRequest::getVar('ad_facebook', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_twitter = \"" . JRequest::getVar('ad_twitter', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_myspace = \"" . JRequest::getVar('ad_myspace', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_linkedin = \"" . JRequest::getVar('ad_linkedin', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_yahoo = \"" . JRequest::getVar('ad_yahoo', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_digg = \"" . JRequest::getVar('ad_digg', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_del = \"" . JRequest::getVar('ad_del', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_live = \"" . JRequest::getVar('ad_live', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_furl = \"" . JRequest::getVar('ad_furl', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_reddit = \"" . JRequest::getVar('ad_reddit', 0, 'post', 'int') . "\";\n";
          $config .= "\$ad_technorati = \"" . JRequest::getVar('ad_technorati', 0, 'post', 'int') . "\";\n";
          $config .= "?>";
          if ($fp = fopen("$configfile", "w")) {
            fputs( $fp, $config, strlen($config));
            fclose($fp);
          }
          saveWords($option);
          $mainframe->redirect("index.php?option=$option&task=settings", _DG_SETT_SAVED);
        }

        function publishComment($cid = null, $publish = 1, $option) {
          global $mainframe;
          $db = & JFactory::getDBO();
          if (!is_array($cid) || count($cid) < 1) {
            $action = $publish ? 'publish' : 'unpublish';
            echo "<script> alert('" . _DG_SELECT_AN_ITEM . " $action'); window.history.go(-1);</script>\n";
            exit;
          }
          $cids = implode(',', $cid);
          $db->setQuery("update #__datsogallery_comments set published='$publish' where cmtid in ($cids)");
          if (!$db->query()) {
            echo "<script> alert('" . $db->getErrorMsg() . "'); window.history.go(-1); </script>\n";
            exit ();
          }
          $mainframe->redirect("index.php?option=$option&task=comments");
        }

        function removeComment() {
          global $mainframe;
          $db = & JFactory::getDBO();
          $id = JRequest::getVar( 'id', array(), 'post', 'array' );
          $option = JRequest::getCmd('option');
          if (count($id) < 1) {
            $msg = JText::_('Select an item to delete');
            $mainframe->redirect('index.php?option=' . $option . '&task=comments', $msg, 'error');
          }
          $ids = implode(',', $id);
          $db->setQuery('delete from #__datsogallery_comments where cmtid in (' . $ids . ')');
          if (!$db->query()) {
            JError::raiseError( 500, $db->getErrorMsg());
            return false;
          }
          $mainframe->redirect('index.php?option=' . $option . '&task=comments');
        }

        function showComments($option) {
          global $mainframe;
          $db = & JFactory::getDBO();
          $limit = $mainframe->getUserStateFromRequest("viewlistlimit", 'limit', 10);
          $limitstart = $mainframe->getUserStateFromRequest("view{$option}limitstart", 'limitstart', 0);
          $search = $mainframe->getUserStateFromRequest($option . 'search', 'search', '', 'string');
          $search = JString::strtolower($search);
          $where = array();
          if ($search) {
            $where[] = "lower(cmttext) like '%$search%' or lower(cmtname) like '%$search%' ";
          }
          $db->setQuery( "select count(*) from #__datsogallery_comments AS a" . (count($where) ? "\nwhere " . implode(' AND ', $where) : ""));
          $total = $db->loadResult();
          echo $db->getErrorMsg();
          if ($limit > $total) {
            $limitstart = 0;
          }
          $db->setQuery( "select * from #__datsogallery_comments " . (count($where) ? "\nwhere " . implode(' AND ', $where) : "") . " order by cmtdate DESC " . " LIMIT $limitstart, $limit " );
          $rows = $db->loadObjectList();
          if ($db->getErrorNum()) {
            echo $db->stderr();
            return false;
          }
          jimport('joomla.html.pagination');
          $pageNav = new JPagination($total, $limitstart, $limit);
          datsogallery_html::showComments($option, $rows, $search, $pageNav);
        }

        function viewCatg($option) {
          global $mainframe;
          $db = & JFactory::getDBO();
          $limit = $mainframe->getUserStateFromRequest("viewlistlimit", 'limit', 10);
          $limitstart = $mainframe->getUserStateFromRequest("view{$option}limitstart", 'limitstart', 0);
          $search = $mainframe->getUserStateFromRequest("search{$option}", 'search', '');
          $search = $db->getEscaped( trim( strtolower($search)));
          $where = "";
          if ($search) {
            $where = " where a.name like '%$search%' or a.description like '%$search%'";
          }
          $db->setQuery(" select count(*) from #__datsogallery_catg AS a $where ");
          $total = $db->loadResult();
          jimport('joomla.html.pagination');
          $pageNav = new JPagination($total, $limitstart, $limit);
          $db->setQuery(" select a.*, g.name AS groupname " . " from #__datsogallery_catg AS a " . " left join #__groups AS g on g.id = a.access " . " $where " . " order by a.ordering desc " . " limit $pageNav->limitstart, $pageNav->limit");
          $rows = $db->loadObjectList();
          datsogallery_html::showCatgs($rows, $search, $pageNav, $option);
        }

        function editCatg($uid, $option) {
          global $mainframe;
          $db = & JFactory::getDBO();
          $row = new DatsoCategories($db);
          $row->load($uid);
          $parent = $row->parent;
          $orders = JHTML::_('list.genericordering', 'select ordering as value, name as text from #__datsogallery_catg order by ordering desc');
          $orderlist = JHTML::_( 'select.genericlist', $orders, 'ordering', 'class="inputbox"', 'value', 'text', intval($row->ordering));
          $yesno[] = JHTML::_('select.option', '0', _DG_NO);
          $yesno[] = JHTML::_('select.option', '1', _DG_YES);
          $publist = JHTML::_('select.genericlist', $yesno, 'published', 'class="inputbox"', 'value', 'text', $row->published);
          $db->setQuery("select id as value, name as text from #__groups order by id");
          $groups = $db->loadObjectList();
          $glist = JHTML::_( 'select.genericlist', $groups, 'access', 'class="inputbox"', 'value', 'text', intval($row->access));
          $Lists["catgs"] = ShowDropDownCategoryList($parent, 'parent', '', $uid);
          datsogallery_html::editCatg($row, $publist, $option, $glist, $Lists, $orderlist);
        }

        function saveCatg($option, $task) {
          global $mainframe;
          $db = & JFactory::getDBO();
          $post = JRequest::get('post');
          $post['description'] = JRequest::getVar('description', '', 'post', 'string', JREQUEST_ALLOWRAW);
          $row = new DatsoCategories($db);
          if (!$row->bind($post)) {
            JError::raiseError( 500, $row->getError());
          }
          if (!$row->check()) {
            JError::raiseError( 500, $row->getError());
          }
          $db->setQuery("select ordering from #__datsogallery_catg order by ordering desc");
          $ordering = $db->loadResult();
          $row->ordering = $ordering + 1;
          if (!$row->store()) {
            JError::raiseError( 500, $row->getError());
          }
          $mainframe->redirect("index.php?option=" . $option . "&task=showcatg");
        }

        function publishCatg($cid = null, $publish = 1, $option) {
          global $mainframe;
          $db = & JFactory::getDBO();
          if (!is_array($cid) || count($cid) < 1) {
            $action = $publish ? 'publish' : 'unpublish';
            echo "<script> alert('" . _DG_SELECT_AN_ITEM . " $action'); window.history.go(-1);</script>\n";
            exit;
          }
          $cids = implode(',', $cid);
          $db->setQuery("update #__datsogallery_catg set published='$publish' where cid in ($cids)");
          if (!$db->query()) {
            echo "<script> alert('" . $db->getErrorMsg() . "'); window.history.go(-1); </script>\n";
            exit ();
          }
          if (count($cid) == 1) {
            $row = new DatsoCategories($db);
            $row->checkin($cid[0]);
          }
          $mainframe->redirect("index.php?option=$option&task=showcatg");
        }

        function removeCatg($cid, $option) {
          global $mainframe;
          $db = & JFactory::getDBO();
          if (count($cid)) {
            $cids = implode(',', $cid);
            foreach ($cid as $cc) {
              $db->setQuery("delete from #__datsogallery_catg where cid=$cc");
              $db->query();
              echo $db->getErrorMsg();
            }
          }
          $mainframe->redirect("index.php?option=$option&task=showcatg", $error);
        }

        function cancelCatg($option) {
          global $mainframe;
          $post = JRequest::get('post');
          $row = new DatsoCategories($db);
          $row->bind($post);
          $mainframe->redirect("index.php?option=$option&task=showcatg");
        }

        function ShowCategoryPath($cat) {
          global $mainframe;
          $db = & JFactory::getDBO();
          $cat = intval($cat);
          $parent = 1000;
          while ($parent) {
            $db->setQuery("select * from #__datsogallery_catg where cid=$cat");
            $rows = $db->loadObjectList();
            $row = & $rows[0];
            $parent = @$row->parent;
            $name = @$row->name;
            if (empty ($path)) {
              $path = $name;
            }
            else {
              $path = $name . ' &raquo; ' . $path;
            }
            $cat = $parent;
          }
          return $path . " ";
        }

        function SortCatArray($a, $b) {
          return strcmp($a->name, $b->name);
        }

        function ShowDropDownCategoryList( $cat, $cname = "catid", $extra = null, $orig = null ) {
        $db = & JFactory::getDBO( );
        $db->setQuery( "SELECT cid, parent,name,'0' as ready
            FROM #__datsogallery_catg" );
        $rows = $db->loadObjectList( "cid" );
        if ($cname == 'parent' && $orig != null) {
          $ignore = array();
        }
        $output = "<select name=\"$cname\" class=\"inputbox\" $extra >\n";
        $output .= "  <option value=\"0\"></option>\n";
        if (count( $rows ) == 0) {
          $output .= "</select>\n";
          return $output;
        }
        foreach ($rows as $key => $obj) {
          $parent = $obj->parent;
          if ($cname == 'parent' && $orig != null) {
            if ($parent == $orig || in_array( $parent, $ignore )) {
              if (!in_array( $key, $ignore )) {
                $ignore[] = $key;
                continue;
              }
            }
            else {
              $parentcat = null;
              $parentcats = array();
              $parentcat = $rows[$key]->parent;
              while ($parentcat != 0 && $parentcat != $orig) {
                $parentcat = $rows[$parentcat]->parent;
                $parentcats[] = $parentcat;
              }
              if (!empty ($parentcats) && in_array( $orig, $parentcats )) {
                $ignore[] = $key;
                $ignore = array_merge( $ignore, $parentcats );
                $parentcats = array();
                continue;
              }
            }
          }
          if ($parent != 0) {
            if ($rows[$parent]->ready) {
              $rows[$key]->name = $rows[$parent]->name . ' &raquo; ' . $rows[$key]->name;
            }
            else {
              while ($parent != 0) {
                $rows[$key]->name = $rows[$parent]->name . ' &raquo; ' . $rows[$key]->name;
                if ($rows[$parent]->ready) {
                  break;
                }
                else {
                  $parent = $rows[$parent]->parent;
                }
              }
            }
          }
          $rows[$key]->ready = "1";
        }
        if ($cname == 'parent' && $orig != null) {
          foreach ($ignore as $catignore) {
            unset ($rows[$catignore]);
          }
        }
        usort( $rows, "SortCatArray" );
        foreach ($rows as $key => $obj) {
          if ($cname != 'parent' || ($cname == 'parent' && $obj->cid != $orig)) {
            $output .= "<option value=\"" . $obj->cid . "\"";
            if ($cat == $obj->cid) {
              $output .= " selected=\"selected\"";
            }
            $output .= ">" . $obj->name . "</option>\n";
          }
        }
        $output .= "</select>\n";
        $rows = array();
        return $output;
      }

        function orderCatg($uid, $inc, $option) {
          $mainframe = & JFactory::getApplication('administrator');
          $database = & JFactory::getDBO();
          $db = & JFactory::getDBO();
          $fp = new DatsoCategories($db);
          $fp->load($uid);
          $fp->move($inc);
          $fp->reorder();
          $mainframe->redirect("index.php?option=$option&task=showcatg");
        }

        function showVotes($option) {
          echo "<script type=\"text/javascript\">\n";
          echo "function confirmSubmit()\n";
          echo "{\n";
          echo "var agree=confirm('" . _DG_SURE_RESET_VOTES . "');\n";
          echo "if (agree)\n";
          echo "return true ;\n";
          echo "else\n";
          echo "return false ;\n";
          echo "}\n";
          echo "</script>";
          echo "<table width='100%'>\n";
          echo "<tr>\n";
          echo "<td><fieldset><legend>&nbsp;" . _DG_RESET_VOTES_TITLE . "&nbsp;</legend>";
          echo "<form action='index.php?task=reset' name='adminForm' method='post'>\n";
          echo "<table class='adminlist'>\n";
          echo "<tr>\n";
          echo "<td><span style='display:block;text-align:center;width:300px'><p>";
          echo _DG_RESET_VOTES_DESCRIPTION;
          echo "<input type='hidden' name='option' value='$option' />";
          echo "</p><p><img src='./images/trash.png' width='48' height='48' alt='' /></p>";
          echo "<p><input type='submit' name='reset' value='" . _DG_RESET . "' onclick='return confirmSubmit()' />";
          echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='button' value='" . _DG_CANCEL_TB . "' onclick='javascript:history.go(-1);' />";
          echo "</p></span></td>\n";
          echo "</tr>\n";
          echo "</table>";
          echo "</form>\n";
          echo "</td></tr></table></fieldset>";
        }

        function resetVotes($option) {
          global $mainframe;
          $db = & JFactory::getDBO();
          $db->setQuery("delete from #__datsogallery_votes");
          if (!$db->query()) {
            echo "<script> alert('" . $db->getErrorMsg() . "'); window.history.go(-1); </script>\n";
          }
          $db->setQuery("update #__datsogallery set imgvotes='0', imgvotesum='0'");
          if (!$db->query()) {
            echo "<script> alert('" . $db->getErrorMsg() . "'); window.history.go(-1); </script>\n";
          }
          $mainframe->redirect("index.php?option=com_datsogallery&act=pictures", _DG_RESET_FINISHED);
        }

        function testCat($cat, $cname, $extras = "", $levellimit = "4") {
          global $mainframe;
          $db = & JFactory::getDBO();
          $db->setQuery("select cid as id, parent, name from #__datsogallery_catg order by ordering");
          $items = $db->loadObjectList();
          $children = array();
          foreach ($items as $v) {
            $pt = $v->parent;
            $list = @$children[$pt] ? $children[$pt] : array();
            array_push($list, $v);
            $children[$pt] = $list;
          }
          $list = catTreeRecurse( 0, '', array(), $children );
          $items = array();
          $items[] = JHTML::_('select.option', '', ' ');
          foreach ($list as $item) {
            $items[] = JHTML::_('select.option', $item->id, $item->treename);
          }
          asort($items);
          $parlist = selectList2($items, $cname, 'class="inputbox" ' . $extras, 'value', 'text', $cat);
          return $parlist;
        }

        function catTreeRecurse($id, $indent = "&nbsp;&nbsp;&nbsp;", $list, & $children, $maxlevel = 9999, $level = 0, $seperator = " &raquo; ") {
          if (@$children[$id] && $level <= $maxlevel) {
            foreach ($children[$id] as $v) {
              $id = $v->id;
              $txt = $v->name;
              $pt = $v->parent;
              $list[$id] = $v;
              $list[$id]->treename = "$indent$txt";
              $list[$id]->children = count(@$children[$id]);
              $list = catTreeRecurse($id, "$indent$txt$seperator", $list, $children, $maxlevel, $level + 1);
            }
          }
          return $list;
        }

        function showDGrebuild($option) {
          global $mainframe;
          $db = & JFactory::getDBO();
          $catid = JRequest::getVar('catid', 0, '', 'int');
          require (JPATH_COMPONENT . DS . 'config.datsogallery.php');
          $db->setQuery("select imgthumbname from #__datsogallery order by rand() limit 1");
          $thumb = $db->loadResult();
          $imgprev = $mainframe->getSiteURL() . $ad_paththumbs . '/' . $thumb;
          echo "<table width='100%'>\n";
          echo "<tr>\n";
          echo "<td><fieldset><legend>&nbsp;" . _DG_THUMB_REBUILD_TITLE . "&nbsp;</legend>";
          echo "<form action='index.php?task=startdgrebuild' name='adminForm' method='post'>\n";
          echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
          echo "<tr>\n";
          echo "<td width='20%'><div align='center'>";
          echo "<img src='$imgprev' id='dg-image' alt='' />";
          echo "</div></td>\n";
          echo "<td width='80%'>";
          echo "<fieldset><legend>" . _DG_THUMB_REBUILD_TITLE . "</legend>\n";
          echo "<table class='adminlist'><tr><td><p>";
          echo _DG_THUMB_REBUILD_DESCRIPTION;
          echo "<strong>" . _DG_THUMBS_IS . "&nbsp;&nbsp;";
          $clist = ShowDropDownCategoryList($catid, 'catid', 'class="inputbox" size="1"');
          echo is_writable(JPATH_SITE . DS . $ad_paththumbs . DS . $thumb) ? '<strong><font color="green"> ' . _DG_WRITEABLE . '</font></strong><br /><br />' . $clist . '' : '<strong><font color="red"> ' . _DG_UNWRITEABLE . '</font></strong><br /><br />';
          echo "<input type='hidden' name='option' value='$option' />";
          echo "&nbsp;<input type='submit' name='startdgrebuild' value='" . _DG_BEGIN . "' class='button' />";
          echo "</p></td></tr></table>";
          echo "</fieldset>\n";
          echo "</td>\n";
          echo "</tr>\n";
          echo "</table>";
          echo "</form>\n";
          echo "</td></tr></table></fieldset>";
        }

        function startDGrebuild($option) {
          global $mainframe;
          $db = & JFactory::getDBO();
          require (JPATH_COMPONENT . DS . 'config.datsogallery.php');
          require_once (JPATH_COMPONENT . DS . 'images.datsogallery.php');
          $catid = JRequest::getVar('catid', 0, '', 'int');
          $ad_pathoriginals = str_replace('/', DS, $ad_pathoriginals);
          $ad_paththumbs = str_replace('/', DS, $ad_paththumbs);
          $orgls = JPATH_SITE . $ad_pathoriginals . DS;
          $thmbs = JPATH_SITE . $ad_paththumbs . DS;
          $db->setQuery("select * from #__datsogallery where catid=$catid");
          $pics = $db->loadObjectList();
          if ($pics[0] != "") {
            foreach ($pics as $pic) {
              dgImageCreate($orgls . $pic->imgoriginalname, $thmbs . $pic->imgthumbname, $ad_thumbwidth, $ad_thumbheight, $ad_thumbquality, $ad_crsc);
            }
          }
          $mainframe->redirect("index.php?option=$option&act=rebuild", _DG_THUMB_REBUILD_END);
        }

        function selectList2(& $arr, $tag_name, $tag_attribs, $key, $text, $selected) {
          reset($arr);
          $html = "\n<select name=\"$tag_name\" $tag_attribs>";
          for ($i = 0, $n = count($arr); $i < $n; $i++) {
            $k = $arr[$i]->$key;
            $t = $arr[$i]->$text;
            $id = @$arr[$i]->id;
            $extra = '';
            $extra .= $id ? " id=\"" . $arr[$i]->id . "\"" : '';
            if (is_array($selected)) {
              foreach ($selected as $obj) {
                $k2 = $obj;
                if ($k == $k2) {
                  $extra .= " selected=\"selected\"";
                  break;
                }
              }
            }
            else {
              $extra .= ($k == $selected ? " selected=\"selected\"" : '');
            }
            $html .= "\n\t<option value=\"" . $k . "\"$extra>" . $t . "</option>";
          }
          $html .= "\n</select>\n";
          return $html;
        }

        function GetNumberOfLinks($cat) {
          global $mainframe;
          $db = & JFactory::getDBO();
          $queue[] = intval($cat);
          while (list($key, $cat) = each($queue)) {
            $db->setQuery("select cid from #__datsogallery_catg where parent=$cat and published=1");
            $result = $db->query();
            $total = mysql_num_rows($result);
            $j = 0;
            while ($j < $total) {
              $val = mysql_fetch_row($result);
              $queue[] = $val[0];
              $j++;
            }
          }
          reset($queue);
          $query = "select count(*) from #__datsogallery  where ( 0!=0";
          while (list($key, $cat) = each($queue)) {
            $query .= " or catid = $cat";
          }
          $query = $query . " ) and published=1 and approved = 1";
          $db->setQuery($query);
          $result = $db->query();
          $val = mysql_fetch_row($result);
          return $val[0];
        }

        function showLanguage($option) {
          $lang = & JFactory::getLanguage();
          $datsolang = strtolower( $lang->getBackwardLang());
          if (file_exists(JPATH_SITE . DS . 'components' . DS . 'com_datsogallery' . DS . 'language' . DS . $datsolang . '.php')) {
            $file = JPATH_SITE . DS . 'components' . DS . 'com_datsogallery' . DS . 'language' . DS . $datsolang . '.php';
          }
          else {
            $file = JPATH_SITE . DS . 'components' . DS . 'com_datsogallery' . DS . 'language' . DS . 'english.php';
          }
          echo showSource($file, $option);
        }

        function saveLanguage($option) {
          global $mainframe;
          $lang = & JFactory::getLanguage();
          $datsolang = strtolower( $lang->getBackwardLang());
          $file = JRequest::getVar('file', 'post');
          $filecontent = JRequest::getVar('filecontent', '', 'post', 'string', JREQUEST_ALLOWRAW);
          if (!$filecontent) {
            $mainframe->redirect("index.php?option=" . $option . "&act=settings", _DG_LANG_EMPTY);
          }
          if (file_exists(JPATH_SITE . DS . 'components' . DS . 'com_datsogallery' . DS . 'language' . DS . $datsolang . '.php')) {
            $file = JPATH_SITE . DS . 'components' . DS . 'com_datsogallery' . DS . 'language' . DS . $datsolang . '.php';
          }
          else {
            $file = JPATH_SITE . DS . 'components' . DS . 'com_datsogallery' . DS . 'language' . DS . 'english.php';
          }
          $enable_write = JRequest::getVar('enable_write', 'post', 0);
          $oldperms = fileperms($file);
          if ($enable_write)
            @chmod($file, $oldperms | 0222);
          clearstatcache();
          if (is_writable($file) == false) {
            $mainframe->redirect("index.php?option=" . $option . "&act=settings", _DG_LANG_IS_NOT_WRITEABLE);
          }
          if ($fp = fopen($file, "w")) {
            fputs($fp, $filecontent);
            fclose($fp);
            if ($enable_write) {
              @chmod($file, $oldperms);
            }
            else {
              if (JRequest::getVar('disable_write', 'post', 0))
                @chmod($file, $oldperms & 0777555);
            }
            $mainframe->redirect("index.php?option=" . $option . "&act=settings", _DG_LANG_SAVED);
          }
          else {
            if ($enable_write)
              @chmod($file, $oldperms);
            $mainframe->redirect("index.php?option=" . $option, _DG_LANG_IS_NOT_WRITEABLE);
          }
        }

        function showSource($file, $option) {
          global $mainframe;
          $lang = & JFactory::getLanguage();
          $datsolang = strtolower( $lang->getBackwardLang());
          $f = fopen($file, "r");
          $filecontent = fread( $f, filesize($file));
          $filecontent = htmlspecialchars($filecontent);
          echo "<form action='index.php' name='adminForm' method='post'>\n";
          echo "<table cellpadding='4' cellspacing='0' border='0' width='100%' class='adminlist'>\n";
          echo "<tr>\n";
          echo "<th colspan='4'>";
          echo _DG_LANG_FILE . $datsolang . ".php " . _DG_LANG_IS . " :";
          echo is_writable($file) ? '<font color="green"> ' . _DG_WRITEABLE . '</font>' : '<font color="red"> ' . _DG_UNWRITEABLE . '</font>';
          echo "</th>\n";
          echo "<tr>\n";
          echo "<td><textarea cols='100' rows='20' name='filecontent'>" . $filecontent . "</textarea>\n";
          echo "</td>\n";
          echo "</tr>";
          echo "<tr><td>";
          if (JPath::canChmod($file)) {
            if (is_writable($file)) {
              echo "<input type=\"checkbox\" id=\"disable_write\" name=\"disable_write\" value=\"1\"/>\n";
              echo "<label for=\"disable_write\"><b>" . _DG_MAKE_UNWRITEABLE . "</b></label>";
            }
            else {
              echo "<input type=\"checkbox\" id=\"enable_write\" name=\"enable_write\" value=\"1\"/>\n";
              echo "<label for=\"enable_write\"><b>" . _DG_OVERRRIDE_UNWRITEABLE . "</b></label>";
            }
          }
          echo "</td>";
          echo "</tr>\n";
          echo "</table>\n";
          echo "<input type='hidden' name='file' value='" . $file . "' />\n";
          echo "<input type='hidden' name='option' value='" . $option . "' />";
          echo "<input type='hidden' name='task' value='' />\n";

          echo "</form>\n";
        }

        function getWords($option) {
          $lang = & JFactory::getLanguage();
          $datsolang = strtolower( $lang->getBackwardLang());
          $filewords = JPATH_SITE . DS . 'components' . DS . 'com_datsogallery' . DS . 'words2ignore-' . $datsolang . '.txt';
          if (!file_exists($filewords)) {
            //$commonwords = '$commonwords';
            $words = "the a if i you to when of if ...";
            $filewords = fopen($filewords, 'w+');
            fwrite($filewords, pack("CCC",0xef,0xbb,0xbf));
            if (!fwrite($filewords,$words));
            fclose($filewords);
          }
          $filewords = JPATH_SITE . DS . 'components' . DS . 'com_datsogallery' . DS . 'words2ignore-' . $datsolang . '.txt';

          echo showWords($filewords, $option);
        }

        function showWords($filewords, $option) {
          global $mainframe;
          $lang = & JFactory::getLanguage();
          $datsolang = strtolower( $lang->getBackwardLang());
          $f = fopen($filewords, "r");
          $filesource = fread( $f, filesize($filewords));
          $filesource = htmlspecialchars($filesource);
?>
<table cellpadding='4' cellspacing='0' border='0' width='100%'>
  <th colspan='4'> <?php echo _DG_LANG_FILE .'words2ignore-'. $datsolang . '.txt' . _DG_LANG_IS . ' :'; ?> <?php echo is_writable($filewords) ? '<font color="green">' . _DG_WRITEABLE . '</font>' : '<font color="red">' . _DG_UNWRITEABLE . '</font>'; ?> </th>
  <tr>
    <td><textarea cols='42' rows='10' name='filesource'><?php echo $filesource; ?></textarea></td>
  </tr>
</table>
<?php
        }

        function saveWords($option) {
          global $mainframe;
          $lang = & JFactory::getLanguage();
          $datsolang = strtolower( $lang->getBackwardLang());
          $filewords = JRequest::getVar('filewords', 'post');
          $filesource = JRequest::getVar('filesource', '', 'post', 'string', JREQUEST_ALLOWRAW);

          //if (file_exists(JPATH_SITE . DS . 'components' . DS . 'com_datsogallery' . DS . 'words2ignore-' . $datsolang . '.txt')) {
            $filewords = JPATH_SITE . DS . 'components' . DS . 'com_datsogallery' . DS . 'words2ignore-' . $datsolang . '.txt';
//          }
//          else {
//            $filewords = JPATH_SITE . DS . 'components' . DS . 'com_datsogallery' . DS . 'english.txt';
//          }

          clearstatcache();

          if ($fp = fopen($filewords, "w")) {
            fputs($fp, $filesource);
            fclose($fp);
          }
        }

        function movePic($cid) {
          global $mainframe;
          $db = & JFactory::getDBO();
          $catid = JRequest::getVar('catid', 0, '', 'int');
          $cid = JRequest::getVar( 'cid', array(0), '', 'array' );
          if (count($cid) > 0)
            $cids = implode(',', $cid);
          $db->setQuery("SELECT * FROM #__datsogallery WHERE id in ($cids)");
          if ($db->query()) {
            $rows = $db->loadObjectList();
            $options = array(JHTML::_('select.option', '1', '_DATSOGALLERY_SELECT_CAT'));
            $lists['catgs'] = ShowDropDownCategoryList($catid, 'catid', 'class="inputbox" size="1" ');
            datsogallery_html::movePic($rows, $lists);
          }
        }

        function movePicResult($id) {
          global $mainframe;
          $db = & JFactory::getDBO();
          $id = JRequest::getVar( 'id', array(0), '', 'array' );
          $movepic = JRequest::getVar('catid', 'post');
          if (!$movepic || $movepic == 0) {
            echo "<script> alert('" . _DG_MUST_SELECT_CATEGORY . "'); window.history.go(-1);</script>\n";
            exit;
          }
          else {
            $pic = new DatsoImages($db);
            $pic->dgMove($id, $movepic);
            $ids = implode(',', $id);
            $total = count($id);
            $cat = new DatsoCategories($db);
            $cat->load($movepic);
            $msg = $total . _DG_TOTAL_PICS_MOVED . $cat->name;
            $mainframe->redirect('index.php?option=com_datsogallery&task=pictures', $msg);
          }
        }

        function writDir($folder, $relative = 1) {
          $writeable = dgTip(_DG_DIR_IS_WRITEABLE, 'dg-accept-icon.png');
          $unwriteable = dgTip(_DG_DIR_IS_UNWRITEABLE, 'dg-exclamation-icon.png');
          if ($relative) {
            echo is_writable("../$folder") ? $writeable : $unwriteable;
          }
          else {
            echo is_writable("$folder") ? $writeable : $unwriteable;
          }
        }

        function dgProtect($dirtoprotect) {
          require_once (JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_datsogallery' . DS . 'config.datsogallery.php');
          $htaccess = "Order Deny,Allow\nDeny from All";
          $wf = fopen(JPATH_SITE . DS . $dirtoprotect . "/.htaccess", "w+");
          if (!fwrite($wf, $htaccess))
          ;
          fclose($wf);
        }

        function dgUnprotect($dirtounprotect) {
          require_once (JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_datsogallery' . DS . 'config.datsogallery.php');
          if (file_exists(JPATH_SITE . DS . $dirtounprotect . "/.htaccess")) {
            unlink(JPATH_SITE . DS . $dirtounprotect . "/.htaccess");
          }
        }

        function dgTip($dgtip, $image = 'dg-info-icon.png', $text = '', $href = '#', $link = 0) {
          global $mainframe;
          if (!$text) {
            $image = $mainframe->getSiteURL() . 'components/com_datsogallery/images/' . $image;
            $text = '<img src="' . $image . '" border="0" alt="dgtip"/>';
          }
          $style = 'style="text-decoration: none; color: #333;"';
          if ($href) {
            $style = '';
          }
          else {
            $href = '#';
          }
          $mousover = 'showttip(\'' . jsspecialchars($dgtip) . '\');';
          $tip = "";
          if ($link) {
            $tip .= '<a href="' . $href . '" onmouseover="' . $mousover . '" onmouseout="hidettip();" ' . $style . '>' . $text . '</a>';
          }
          else {
            $tip .= '<span onmouseover="' . $mousover . '" onmouseout="hidettip();" ' . $style . '>' . $text . '</span>';
          }
          return $tip;
        }

        function removeFile($srcFilename, $srcFilePath) {
          $removeFilename = $srcFilePath . $srcFilename;
          if (unlink($removeFilename)) {
            return true;
          }
          else {
            return false;
          }
        }

        function dgImgId($catid, $imgext) {
          return substr( strtoupper( md5( uniqid( time()))), 5, 12 ) . '-' . $catid . '.' . strtolower($imgext);
        }

        function jsspecialchars($s) {
          $r = str_replace( array('\\', '"', "'"), array('\\\\', '&quot;', "&#039;"), $s );
          return htmlspecialchars($r, ENT_QUOTES);
        }

        function format_filesize($tfilesize) {
          global $dgfilesize;
          $format = array(_DG_FILESIZE_BYTES, _DG_FILESIZE_KB, _DG_FILESIZE_MB, _DG_FILESIZE_GB);
          $i = 0;
          while ($tfilesize >= 1024) {
            $i++;
            $tfilesize = $tfilesize / 1024;
          }
          return number_format( $tfilesize, ($i ? 2 : 0), ",", "." ) . " " . $format[$i];
        }

        function is_image($filename) {
          $ext = strtolower( strrchr($filename, "."));
          return ($ext == ".jpg" || $ext == ".jpeg" || $ext == ".png" || $ext == ".gif");
        }

        function is_zip($filename) {
          $ext = strtolower( strrchr($filename, "."));
          return ($ext == ".zip");
        }

        function getDatso($xmlfile, $element_name) {
          jimport('domit.xml_domit_lite_include');
          $xmlDoc = & new DOMIT_Lite_Document();
          $xmlDoc->resolveErrors(true);
          if (!@$xmlDoc->loadXML($xmlfile)) {
            return "Could not connect";
          }
          $element = & $xmlDoc->documentElement;
          $element = & $xmlDoc->getElementsByPath($element_name, 1);
          $result = $element ? $element->getText() : '';
          return $result;
        }

        function getmicrotime() {
          list($usec, $sec) = explode( " ", microtime());
          return ((float) $usec + (float) $sec);
        }

        echo "<br><div class='smallgrey' align='center'><br />" . $ad_cr . "</div>";


      ?>
