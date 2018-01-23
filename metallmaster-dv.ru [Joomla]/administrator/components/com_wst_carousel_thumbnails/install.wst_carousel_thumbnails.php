<?php

/**
 * WST Carousel Thumbnails - Extension for Joomla!
 * @package    Joomla
 * @license    GNU/GPL
 * @author NenadT & GoranR <nenadt@gmail.com>
*/

defined('_JEXEC') or die;

require_once(JPATH_SITE.'/administrator/components/com_wst_carousel_thumbnails/tables/wstcarouselthumbnails.php');
require_once(JPATH_SITE.'/administrator/components/com_wst_carousel_thumbnails/tables/wstcarouselthumbnailsimages.php');
$db	=& JFactory::getDBO();

$photo=new TableWstCarouselThumbnails($db);
$photo->id=null;
$photo->image_name="photo_001.jpg";
$photo->tooltip="Photo Title 01";
$photo->description="";
$photo->ordering=1;
$photo->published=1;
$photo->store();
$img=new TableWstCarouselThumbnailsImages($db);
$img->id=null;
$img->image_name="photo_001.jpg";
$img->store();

$photo=new TableWstCarouselThumbnails($db);
$photo->id=null;
$photo->image_name="photo_002.jpg";
$photo->tooltip="Photo Title 02";
$photo->description="";
$photo->ordering=2;
$photo->published=1;
$photo->store();
$img=new TableWstCarouselThumbnailsImages($db);
$img->id=null;
$img->image_name="photo_002.jpg";
$img->store();

$photo=new TableWstCarouselThumbnails($db);
$photo->id=null;
$photo->image_name="photo_003.jpg";
$photo->tooltip="Photo Title 03";
$photo->description="";
$photo->ordering=3;
$photo->published=1;
$photo->store();
$img=new TableWstCarouselThumbnailsImages($db);
$img->id=null;
$img->image_name="photo_003.jpg";
$img->store();

$photo=new TableWstCarouselThumbnails($db);
$photo->id=null;
$photo->image_name="photo_004.jpg";
$photo->tooltip="Photo Title 04";
$photo->description="";
$photo->ordering=4;
$photo->published=1;
$photo->store();
$img=new TableWstCarouselThumbnailsImages($db);
$img->id=null;
$img->image_name="photo_004.jpg";
$img->store();

$photo=new TableWstCarouselThumbnails($db);
$photo->id=null;
$photo->image_name="photo_005.jpg";
$photo->tooltip="Photo Title 05";
$photo->description="";
$photo->ordering=5;
$photo->published=1;
$photo->store();
$img=new TableWstCarouselThumbnailsImages($db);
$img->id=null;
$img->image_name="photo_005.jpg";
$img->store();

$photo=new TableWstCarouselThumbnails($db);
$photo->id=null;
$photo->image_name="photo_006.jpg";
$photo->tooltip="Photo Title 06";
$photo->description="";
$photo->ordering=6;
$photo->published=1;
$photo->store();
$img=new TableWstCarouselThumbnailsImages($db);
$img->id=null;
$img->image_name="photo_006.jpg";
$img->store();

$photo=new TableWstCarouselThumbnails($db);
$photo->id=null;
$photo->image_name="photo_007.jpg";
$photo->tooltip="Photo Title 07";
$photo->description="";
$photo->ordering=7;
$photo->published=1;
$photo->store();
$img=new TableWstCarouselThumbnailsImages($db);
$img->id=null;
$img->image_name="photo_007.jpg";
$img->store();

$photo=new TableWstCarouselThumbnails($db);
$photo->id=null;
$photo->image_name="photo_008.jpg";
$photo->tooltip="Photo Title 08";
$photo->description="";
$photo->ordering=8;
$photo->published=1;
$photo->store();
$img=new TableWstCarouselThumbnailsImages($db);
$img->id=null;
$img->image_name="photo_008.jpg";
$img->store();

$photo=new TableWstCarouselThumbnails($db);
$photo->id=null;
$photo->image_name="photo_009.jpg";
$photo->tooltip="Photo Title 09";
$photo->description="";
$photo->ordering=9;
$photo->published=1;
$photo->store();
$img=new TableWstCarouselThumbnailsImages($db);
$img->id=null;
$img->image_name="photo_009.jpg";
$img->store();

$photo=new TableWstCarouselThumbnails($db);
$photo->id=null;
$photo->image_name="photo_010.jpg";
$photo->tooltip="Photo Title 10";
$photo->description="";
$photo->ordering=10;
$photo->published=1;
$photo->store();
$img=new TableWstCarouselThumbnailsImages($db);
$img->id=null;
$img->image_name="photo_010.jpg";
$img->store();

$photo=new TableWstCarouselThumbnails($db);
$photo->id=null;
$photo->image_name="photo_011.jpg";
$photo->tooltip="Photo Title 11";
$photo->description="";
$photo->ordering=11;
$photo->published=1;
$photo->store();
$img=new TableWstCarouselThumbnailsImages($db);
$img->id=null;
$img->image_name="photo_011.jpg";
$img->store();

$photo=new TableWstCarouselThumbnails($db);
$photo->id=null;
$photo->image_name="photo_012.jpg";
$photo->tooltip="Photo Title 12";
$photo->description="";
$photo->ordering=12;
$photo->published=1;
$photo->store();
$img=new TableWstCarouselThumbnailsImages($db);
$img->id=null;
$img->image_name="photo_012.jpg";
$img->store();

$photo=new TableWstCarouselThumbnails($db);
$photo->id=null;
$photo->image_name="photo_013.jpg";
$photo->tooltip="Photo Title 13";
$photo->description="";
$photo->ordering=13;
$photo->published=1;
$photo->store();
$img=new TableWstCarouselThumbnailsImages($db);
$img->id=null;
$img->image_name="photo_013.jpg";
$img->store();

$photo=new TableWstCarouselThumbnails($db);
$photo->id=null;
$photo->image_name="photo_014.jpg";
$photo->tooltip="Photo Title 14";
$photo->description="";
$photo->ordering=14;
$photo->published=1;
$photo->store();
$img=new TableWstCarouselThumbnailsImages($db);
$img->id=null;
$img->image_name="photo_014.jpg";
$img->store();

$photo=new TableWstCarouselThumbnails($db);
$photo->id=null;
$photo->image_name="photo_015.jpg";
$photo->tooltip="Photo Title 15";
$photo->description="";
$photo->ordering=15;
$photo->published=1;
$photo->store();
$img=new TableWstCarouselThumbnailsImages($db);
$img->id=null;
$img->image_name="photo_015.jpg";
$img->store();

$photo=new TableWstCarouselThumbnails($db);
$photo->id=null;
$photo->image_name="photo_016.jpg";
$photo->tooltip="Photo Title 16";
$photo->description="";
$photo->ordering=16;
$photo->published=1;
$photo->store();

$photo=new TableWstCarouselThumbnails($db);
$photo->id=null;
$photo->image_name="photo_017.jpg";
$photo->tooltip="Photo Title 17";
$photo->description="";
$photo->ordering=17;
$photo->published=1;
$photo->store();
$img=new TableWstCarouselThumbnailsImages($db);
$img->id=null;
$img->image_name="photo_015.jpg";
$img->store();

$photo=new TableWstCarouselThumbnails($db);
$photo->id=null;
$photo->image_name="photo_018.jpg";
$photo->tooltip="Photo Title 18";
$photo->description="";
$photo->ordering=18;
$photo->published=1;
$photo->store();
$img=new TableWstCarouselThumbnailsImages($db);
$img->id=null;
$img->image_name="photo_018.jpg";
$img->store();

$photo=new TableWstCarouselThumbnails($db);
$photo->id=null;
$photo->image_name="photo_019.jpg";
$photo->tooltip="Photo Title 19";
$photo->description="";
$photo->ordering=19;
$photo->published=1;
$photo->store();
$img=new TableWstCarouselThumbnailsImages($db);
$img->id=null;
$img->image_name="photo_019.jpg";
$img->store();

$photo=new TableWstCarouselThumbnails($db);
$photo->id=null;
$photo->image_name="photo_020.jpg";
$photo->tooltip="Photo Title 20";
$photo->description="";
$photo->ordering=20;
$photo->published=1;
$photo->store();
$img=new TableWstCarouselThumbnailsImages($db);
$img->id=null;
$img->image_name="photo_020.jpg";
$img->store();