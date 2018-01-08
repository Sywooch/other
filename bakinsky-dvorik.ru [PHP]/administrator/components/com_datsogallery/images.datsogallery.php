<?php

  defined('_JEXEC') or die('Restricted access');

  function dgImageCreate($srcfile, $destfile, $max_width, $max_height, $ad_thumbquality, $ad_crsc = false)
  {
    @ini_set("memory_limit", "400M");
    list($src_width, $src_height, $type) = getimagesize($srcfile);
    switch ($type)
    {

      case 1 :
        $srcimage = imagecreatefromgif($srcfile);
        break;

      case 2 :
        $srcimage = imagecreatefromjpeg($srcfile);
        break;

      case 3 :
        $srcimage = imagecreatefrompng($srcfile);
        break;

      default :
        echo "Not supported file type";
        return false;
    }
    if ($ad_crsc == true)
    {
      if ($src_width > $src_height)
      {
        $image_width = $max_width;
        $image_height = floor( $src_height * ($max_width / $src_width));
      }
      else
        if ($src_width < $src_height)
        {
          $image_height = $max_height;
          $image_width = floor( $src_width * ($max_height / $src_height));
        }
        else
        {
          $image_width = $max_height;
          $image_height = $max_height;
      }
      $destimage = imagecreatetruecolor($image_width, $image_height);
      if (!fastimagecopyresampled($destimage, $srcimage, 0, 0, 0, 0, $image_width, $image_height, $src_width, $src_height))
      {
        return false;
      }
    }
    else
      if ($ad_crsc == false)
      {
        $ratio = $max_width / $max_height;
        if ($ratio > 1)
        {
          if ($src_width > $src_height)
          {
            $image_width = $max_width;
            $image_height = ceil( $max_width * ($src_height / $src_width));
            if ($image_height > $max_width)
            {
              $image_height = $max_width;
              $image_width = ceil( $max_width * ($src_width / $src_height));
            }
          }
          else
          {
            $image_height = $max_width;
            $image_width = ceil( $max_width * ($src_height / $src_width));
            if ($image_width > $max_width)
            {
              $image_width = $max_width;
              $image_height = ceil( $max_width * ($src_height / $src_width));
            }
            $off_h = ($src_height - $src_width) / 2;
          }
          $destimage = imagecreatetruecolor($max_width, $max_height);
          if (!fastimagecopyresampled($destimage, $srcimage, 0, 0, 0, $off_h, $image_width, $image_height, $src_width, $src_height))
          {
            return false;
          }
        }
        else
        {
          if ($src_width > $src_height)
          {
            $off_w = ($src_width - $src_height) / 2;
            $off_h = 0;
            $src_width = $src_height;
          }
          else
            if ($src_height > $src_width)
            {
              $off_w = 0;
              $off_h = ($src_height - $src_width) / 2;
              $src_height = $src_width;
            }
            else
            {
              $off_w = 0;
              $off_h = 0;
          }
          $destimage = imagecreatetruecolor($max_width, $max_height);
          if (!fastimagecopyresampled($destimage, $srcimage, 0, 0, $off_w, $off_h, $max_width, $max_height, $src_width, $src_height))
          {
            return false;
          }
        }
      }
      imagedestroy($srcimage);
    switch ($type)
    {

      case 1 :
        imagegif($destimage, $destfile);
        break;

      case 2 :
        imagejpeg($destimage, $destfile, $ad_thumbquality);
        break;

      case 3 :
        imagepng($destimage, $destfile);
        break;

      default :
        echo _DG_FOUR_ERR;
        return false;
    }
    imagedestroy($destimage);
    return true;
  }

  function fastimagecopyresampled(&$dst_image, $src_image, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h, $quality = 3)
  {
    if ( empty ($src_image) || empty ($dst_image) || $quality <= 0 )
    {
      return false;
    }
    if ( $quality < 5 && ( ($dst_w * $quality) < $src_w || ($dst_h * $quality) < $src_h ))
    {
      $temp = imagecreatetruecolor($dst_w * $quality + 1, $dst_h * $quality + 1);
      imagecopyresized($temp, $src_image, 0, 0, $src_x, $src_y, $dst_w * $quality + 1, $dst_h * $quality + 1, $src_w, $src_h);
      imagecopyresampled($dst_image, $temp, $dst_x, $dst_y, 0, 0, $dst_w, $dst_h, $dst_w * $quality, $dst_h * $quality);
      imagedestroy($temp);
    }
    else
      imagecopyresampled($dst_image, $src_image, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);
    return true;
  }

?>