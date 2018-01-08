<?php

defined('_JEXEC') or die('Direct Access to this location is not allowed.');

global $mainframe;
$db = & JFactory::getDBO();
$user = & JFactory::getUser();
require (JPATH_COMPONENT_ADMINISTRATOR.DS.'config.datsogallery.php');
$ad_pathimages = str_replace('/', DS, $ad_pathimages);
$ad_pathoriginals = str_replace('/', DS, $ad_pathoriginals);
$pic = "";
$path = "";
$id = 0;
$mid = JRequest::getVar('mid', 0, 'get', 'int');
$oid = JRequest::getVar('oid', 0, 'get', 'int');
if ($mid) {
  $pic = "imgfilename";
  $path = JPATH_SITE.$ad_pathimages.DS;
  $id = $mid;
}
else
  if ($oid) {
    $pic = "imgoriginalname";
    $path = JPATH_SITE.$ad_pathoriginals.DS;
    $id = $oid;
  }
  if ($id) {
    $db->setQuery("select c.access from #__datsogallery_catg as c left join #__datsogallery as a on a.catid = c.cid where a.id = $id");
    $c_access = $db->loadResult();
    if ($user->get('aid') < $c_access) {
      exit;
    }
    else {
      $db->setQuery("select a.$pic from #__datsogallery as a where a.id = $id");
      $pic = $db->loadResult();
    }
    $img_info = getimagesize($path.$pic);
    if (!$img_info) {
      exit;
    }
    else {
      $watermark = JPATH_COMPONENT.DS.'images'.DS.'watermark.png';
      $watermark = imagecreatefrompng($watermark);
      $watermark_width = imagesx($watermark);
      $watermark_height = imagesy($watermark);
      $image = imagecreatetruecolor($watermark_width, $watermark_height);
      list($src_width, $src_height, $type) = getimagesize($path.$pic);
      switch ($type) {
        case 1 :
          $image = imagecreatefromgif($path.$pic);
          break;
        case 2 :
          $image = imagecreatefromjpeg($path.$pic);
          break;
        case 3 :
          $image = imagecreatefrompng($path.$pic);
          break;
        default :
          echo _DG_FOUR_ERR;
          return false;
      }
      $dest_x = $src_width - $watermark_width - 10;
      $dest_y = $src_height - $watermark_height - 10;
      header("Content-type: image/jpeg");
      header('Content-Transfer-Encoding: binary');
      imagecopyresampled($image, $watermark, $dest_x, $dest_y, 0, 0, $watermark_width, $watermark_height, $watermark_width, $watermark_height);
      ob_clean();
      imagejpeg($image, '', $ad_thumbquality);
      imagedestroy($image);
      imagedestroy($watermark);
      exit;
    }
  }

  ?>