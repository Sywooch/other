<?
class CResizeImage { 
  function ResizeImageGet($file, $arSize) { 
    
    $cahe=true;  
    $FileNameSymbols = "0123456789_-qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";
    $ROOT_DIR = $_SERVER["DOCUMENT_ROOT"];

    $FullFilePath = $ROOT_DIR.$file;
    $PathToSave = "/upload/resize_cache";   

    $pos = strrpos($file, '.'); 
    if ($pos) $Ext = substr($file, $pos+1); else $Ext = "jpg"; 

    $ResizedFileName = md5($file).".".strtolower($Ext);
    $ResizedFileRootPath = $ROOT_DIR.$PathToSave."/_thumbs/".$ResizedFileName;
   
    $CurrentDir = $ROOT_DIR;
    
  	$uploadDirName = $ROOT_DIR.$PathToSave."/_thumbs";
  	@mkdir($uploadDirName, 0755);
    	
  	if ($cache==0) @unlink($ResizedFileRootPath);

    if (!is_array($arSize)) $arSize = array(); 
    if (!array_key_exists("width", $arSize) || IntVal($arSize["width"]) <= 0) $arSize["width"] = 0; 
    if (!array_key_exists("height", $arSize) || IntVal($arSize["height"]) <= 0) $arSize["height"] = 0; 
    $arSize["width"] = IntVal($arSize["width"]); 
    $arSize["height"] = IntVal($arSize["height"]); 

    $imageFile = $file; 

    if ($arSize["width"]>0){ 
      if ($arSize["height"]>0) $mode = "box"; 
      else $mode = "width"; 
    }else $mode = "height"; 
      
    $size = $arSize; 

    $cacheImageFile = "/upload/resize_cache/_thumbs/".$arSize["width"]."x".$arSize["height"].$arSize['full'].$arSize['mode']."/".$ResizedFileName;
    $cacheImageFileCheck = $cacheImageFile; 
                                                                   
    if (!file_exists($_SERVER["DOCUMENT_ROOT"].$cacheImageFileCheck)){  
      $cacheImageFileTmp =strtolower($ROOT_DIR.$cacheImageFile);
      if (CResizeImage::ResizeImage($_SERVER["DOCUMENT_ROOT"].$imageFile, $mode, $size, $cacheImageFileTmp, $quality=100)){ 
        $cacheImageFile = SubStr($cacheImageFileTmp, StrLen($_SERVER["DOCUMENT_ROOT"]));
        $not_from_cache = true; 
        $resized = true; 
      } else {   
        $cacheImageFile = $imageFile;
      } 
      $cacheImageFileCheck = $cacheImageFile; 
    } else {                                                       
      $resized = true;
      $ef=$_SERVER["DOCUMENT_ROOT"].$cacheImageFileCheck;
      // Определяем расширение файла
      $pos = strrpos($ef, '.'); 
      if ($pos) $Ext=substr($ef, $pos+1); else $Ext = "jpg"; 
                      
      if ($arSize['show']=='y'){
        switch (strtolower($Ext)) 
        { 
          case "jpg":   
          case "jpeg":header("Content-type: image/jpg");readfile($ef); break; 
          case "gif": header("Content-type: image/gif");readfile($ef); break; 
          case "png": header("Content-type: image/png");readfile($ef); break; 
          default: return false; 
        }
      }
    } 

    $arImageSize = getimagesize($_SERVER["DOCUMENT_ROOT"].$cacheImageFileCheck);

    return array( 
       "SRC" => $cacheImageFileCheck,   
       "WIDTH" => IntVal($arImageSize[0]),   
       "HEIGHT" => IntVal($arImageSize[1]), 
       "CONTENT_TYPE" => $arImageSize["mime"], 
       "RESIZED" => ($resized)? true : false, 
       "FROM_CACHE" => ($not_from_cache)? false : true, 
    ); 
   } 

  // Изменение размеров картинки 
  // Входящий файл, режим (ширина/высота), размер, выходной файл 
  function ResizeImage($infile, $Mode, $Size, $outfile, $quality=100){ 
    if (CopyDirFiles($infile, $outfile)){
      
    
      $TheImage = getimagesize($infile); 
    
      switch ($TheImage["mime"]) 
      { 
        case  "image/gif": $im=imagecreatefromGif($infile); break; 
        case  "image/png": $im=imagecreatefromPng($infile); break; 
        case  "image/jpeg":$im=imagecreatefromJpeg($infile); break; 
        default: return false;   
      } 
       
      //$Size['full']='y';
      $stx=0;
      $sty=0;
      $w=intval($Size['width']); 
      $h=intval($Size['height']); 
      $sw=imagesx($im);
      $sh=imagesy($im);
      switch ($Mode) 
      { 
        case "height":
          $k=$h/$sh;
          $w=intval($sw*$k); 
          break; 
        case "width":
          $k=$w/$sw; 
          $h=intval($sh*$k); 
          break;
        case "box":
          $pr=$w/$h;
          $spr=$sw/$sh;
          if (isset($Size['full'])){
            if (!($spr<=$pr)) $k=$w/$sw; else $k=$h/$sh; 
          }else{
            if ($spr<=$pr) $k=$w/$sw; else $k=$h/$sh; 
          }
          break; 
        default: $k=$h/$sh; 
      } 
      
      $nw=intval($sw*$k);
      $nh=intval($sh*$k);
      
      switch ($Size['mode']){ 
        case "t":
          $stx=intval(($w-$nw)/2);
          $sty=0;
          break;
        case "r":
          $stx=intval(($w-$nw));
          $sty=intval(($h-$nh)/2);
          break;
        case "l":
          $stx=0;
          $sty=intval(($h-$nh)/2);
          break;
        case "b":
          $stx=intval(($w-$nw)/2);
          $sty=intval(($h-$nh));
          break;
        case "tl":
          $stx=0;
          $sty=0;
          break;
        case "tr":
          $stx=intval(($w-$nw));
          $sty=0;
          break;
        case "bl":
          $stx=0;
          $sty=intval(($h-$nh));
          break;
        case "br":
          $stx=intval(($w-$nw));
          $sty=intval(($h-$nh));
          break;
        default:
          $stx=intval(($w-$nw)/2);
          $sty=intval(($h-$nh)/2);
      }
      
      $im1=imagecreatetruecolor($w,$h);      
      
      $cw=intval($sw/3);
      $ch=intval($sh/3);
      $imc=imagecreatetruecolor($cw,$ch);      
      imagecopyresampled($imc,$im,0,0,0,0,$cw,$ch,$sw,$sh);
      
      //$bg=imagecolorat($imc,0,0);
      //$bg=0xFFFFFF;          
      $bg=0x1a3754;
	  imagefill($im1,0,0,$bg);
      
      imagecopyresampled($im1,$im,$stx,$sty,0,0,$nw,$nh,$sw,$sh);
              
      // Определяем расширение файла 
      $pos = strrpos($outfile, '.'); 
      if ($pos) $Ext = substr($outfile, $pos+1); else $Ext = "jpg"; 
            
      switch (strtolower($Ext)) 
      { 
        case "jpg":   
        case "jpeg": $rez = imageJpeg($im1, $outfile, $quality); break; 
        case "gif": $rez = imageGif($im1, $outfile); break; 
        case "png": $rez = imagePng($im1, $outfile); break; 
        default: return false; 
      } 
      
      if ($Size['show']=='y'){
        switch (strtolower($Ext)) 
        { 
          case "jpg":   
          case "jpeg":header("Content-type: image/jpg");imageJpeg($im1, null, $quality); break; 
          case "gif": header("Content-type: image/gif");imageGif($im1); break; 
          case "png": header("Content-type: image/png");imagePng($im1); break; 
          default: return false; 
        } 
      }
      
      imagedestroy($im); 
      imagedestroy($im1); 
      
      return ($rez)? true : false; 
    } 
  } 
} 

function GetImgByParam($param){
  $res_img=CResizeImage::ResizeImageGet($param['file'],$param);
  return $res_img['SRC'];
} 

?>