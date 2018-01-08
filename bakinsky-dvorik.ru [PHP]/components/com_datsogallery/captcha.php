<?php
  define('_JEXEC',1);
  header("Content-type: image/png");
  header('Cache-Control: no-store, no-cache, must-revalidate');
  $height=20;
  $width=55;
  $i_shield=imagecreate($width,$height);
  $black=imagecolorallocate($i_shield,255,255,255);
  $white=imagecolorallocate($i_shield,125,125,125);
  $dgrandom=$_GET['dgrandom'];
  imagestring($i_shield,5,5,2,$dgrandom,$white);
  imagepng($i_shield);
  imagedestroy($i_shield);