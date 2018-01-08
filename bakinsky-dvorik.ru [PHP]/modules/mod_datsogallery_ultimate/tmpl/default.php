<?php
  defined('_JEXEC') or die('Restricted access');
  require (JPATH_ADMINISTRATOR.DS.'components'.DS.'com_datsogallery'.DS.'config.datsogallery.php');
  $document = & JFactory::getDocument();
  $option = JRequest::getCmd('option');
  $show_titles = $params->get('show_titles',1);
  $limit_chars = (int) $params->get('limit_chars');
  $image_width = $params->get('image_width');
  $image_height = $params->get('image_height');
  $cropratio = $params->get('cropratio');
  $image_quality = $params->get('image_quality');
  $slideshow = $params->get('slideshow',0);
  $picturepath = JURI::base(true).$ad_pathimages."/";
  $originalpath = JURI::base(true).$ad_pathoriginals."/";
  $body = JResponse::getBody();
  if (stristr($body,'clearbox.js') && stristr($body,'clearbox.css')) {
    $body = preg_replace("/<script.*?clearbox?\.js.*?<\/script>/i",'',$body);
    $body .= preg_replace("/<link.*?clearbox?\.css.*?/i",'',$body);
  }
  JResponse::setBody($body);
  if ($slideshow) {
    if ($option != 'com_datsogallery') {
      $document->addScript(JURI::base(true).'components/com_datsogallery/libraries/clearbox/js/clearbox.js');
      $document->addCustomTag("<script type='text/javascript'>
  var CB_PicDir='".JURI::base(true)."/components/com_datsogallery/libraries/clearbox/pic/';
  </script>\n");
      $document->addStyleSheet(JURI::base(true).'/components/com_datsogallery/libraries/clearbox/css/clearbox.css');
    }
  }
  if (count($items)) {
    foreach ($items as $item) {
      $item->imgtitle = short_name($item->imgtitle,$limit_chars);
      if ($slideshow) {
        if ($params->get('mode') == 'med') {
          $img1 = "$picturepath$item->imgfilename";
        }
        else {
          $img1 = "$originalpath$item->imgoriginalname";
        }
        echo "<div class='".$params->get('view').$params->get('mod_id')."'>";
      ?>
      <a href='<?php echo $img1;?>' rel='clearbox[Pic,,3,,start]'>
      <img src="<?php echo JURI::base();?>modules/mod_datsogallery_ultimate/cache.php/<?php echo $item->imgfilename;?>?width=<?php echo $image_width;?>&amp;height=<?php echo $image_height;?>&amp;cropratio=<?php echo $cropratio;?>&amp;image=<?php echo $ad_pathimages.'/'.$item->imgfilename;?>" class="dgu_img<?php echo $params->get('mod_id');?>" alt="<?php echo $item->imgtitle;?>" /></a>
<?php if ($show_titles) {?>
      <div align="center"><?php echo $item->imgtitle;?></div>
      <?php }?>
          <?php
            echo "</div>";
          }
          else {
           // echo "<div class='".$params->get('view').$params->get('mod_id')."'>";
          ?>
       <a href='/images/stories/dg_originals/A9C2F4E50920-1.jpg' rel='clearbox[Pic,,3,,start]'>
      <img src="<?php echo JURI::base();?>modules/mod_datsogallery_ultimate/cache.php/<?php echo $item->imgfilename;?>?width=<?php echo $image_width;?>&amp;height=<?php echo $image_height;?>&amp;cropratio=<?php echo $cropratio;?>&amp;image=<?php echo $ad_pathimages.'/'.$item->imgfilename;?>" class="dgu_img<?php echo $params->get('mod_id');?>" alt="<?php echo $item->imgtitle;?>" /></a>
<?php if ($show_titles) {?>
      <div align="center"><?php echo $item->imgtitle;?></div>
      <?php }?>
          <?php
           // echo "</div>";
          }
        }
      }
      else {
        echo JText::_('PICTURES WAS NOT FOUND');
      }