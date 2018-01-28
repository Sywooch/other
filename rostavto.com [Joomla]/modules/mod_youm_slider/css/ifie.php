<?php header("Content-type: text/css"); ?>
<?php
$script_path = dirname( dirname( $_SERVER['REQUEST_URI'] ) );
?>
#slides div.slide div.long_desc {
azimuth: expression(
this.pngSet?this.pngSet=true:(this.nodeName == "IMG" && this.src.toLowerCase().indexOf('.png')>-1?(this.runtimeStyle.backgroundImage = "none",
this.runtimeStyle.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + this.src + "', sizingMethod='image')",
this.src = "<?php echo $script_path; ?>/images/blank.gif"):(this.origBg = this.origBg? this.origBg :this.currentStyle.backgroundImage.toString().replace('url("','').replace('")',''),
this.runtimeStyle.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + this.origBg + "', sizingMethod='scale')",
this.runtimeStyle.backgroundImage = "none")),this.pngSet=true
);
}
