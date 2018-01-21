<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<script type="text/javascript">
var slideShowSpeed = 5000
var Pic = new Array()
var Descr = new Array()
var URL = new Array()
<?php
$i = 0;
$j = 0;
while ($i < count($fn_cache) && ($ft_cache)) {
  echo "Pic[$i] = '".$fn_cache[$i]."'\n";
  echo "Descr[$i] = '".$ft_cache[$i]."'\n";
  echo "URL[$i] = '".$url_cache[$i]."'\n";
  if (@$id_cache[$i] == $id) {
    $j = $i;
  }
  $i++;
}
?>

var t
var j = <?php echo "$j\n" ?>
var currentLocation = <?php echo "$j\n" ?>;
var p = Pic.length
var pos = j
var preLoad = new Array()

function preLoadPic(index) {
  if (Pic[index] != '') {
    window.status = 'Loading : ' + Pic[index]
    preLoad[index] = new Image()
    preLoad[index].src = Pic[index]
    Pic[index] = ''
    window.status = ''
  }
}

function runSlideShow() {
  if (preLoad[j]) {
    document.images.SlideShow.src = preLoad[j].src
    document.getElementById('ImgText').innerHTML = Descr[j]
  }
  currentLocation = j;
  j = j + 1
  if (j > (p - 1)) j = 0
  t = setTimeout('runSlideShow()', slideShowSpeed)
  preLoadPic(j)
}

function endSlideShow() {
  stopstatus = 1
  j = j - 1
  window.location = URL[j]
}

preLoadPic(j)
</script>
