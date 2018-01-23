<?php
/**
* @file
* @brief    Monials Fader module for Joomla
* @author   Gauti Creator
* @version  1.0
* @remarks  Copyright (C) 2012 Gauti Creator
* @remarks  Licensed under GNU/GPLv3, see http://www.gnu.org/licenses/gpl-3.0.html
*/
?>

<script type="text/javascript">
$wait_time=<?php echo $wait_time; ?>;
$fader_time=<?php echo $fader_time; ?>;
$jnc(document).ready(function(){
monialsfader();
});
function monialsfader() {
var $active = $jnc('#monials li.active');
var $next =  $active.next().length ? $active.next(): $jnc('#monials li:first');
<?php if($fade_blink==1) { ?>
$active.css({opacity: 1.0}).removeClass('active').animate({opacity: 0}, $fader_time/2, function(){
$next.css({opacity: 0.0}).addClass('active').animate({opacity: 1.0}, $fader_time/2);
});
<?php }else { ?>
$active.css({opacity: 1.0}).removeClass('active').animate({opacity: 0}, $fader_time/2);
$next.css({opacity: 0.0}).addClass('active').animate({opacity: 1.0}, $fader_time/2);
<?php } ?>
setTimeout(monialsfader, $wait_time);
}
</script>
<style>
<?php echo $font_import; ?>
#monialsfader{
width:<?php echo $mod_width; ?>;
height:<?php echo $mod_height; ?>;
margin:0 auto;
}
#monialsfader #inner-monialsfader{
width:100%;
position:relative;
overflow:hidden;
height:100%;
float:left;
}
#monialsfader #monials-top{
float:left;
position:absolute;
z-index:15;
left:<?php echo $qleft; ?>;
top:<?php echo $qtop; ?>;;
text-align: left;
}
#monialsfader ul#monials{
width:<?php echo $monials_width ?>;
height:<?php echo $monials_height ?>;
float:left;
position:relative;
list-style-type:none;
padding:15px 15px 15px 40px;
margin:0;
background:<?php echo $background; ?>;
border-radius:<?php echo $round_corner; ?>;
-moz-border-radius:<?php echo $round_corner; ?>;
-webkit-border-radius:<?php echo $round_corner; ?>;
}
#monialsfader #monials li{
width:<?php echo $monials_width ?>;
height:<?php echo $monials_height ?>;
position:absolute;
background:<?php echo $background; ?>;
opacity:0;
z-index:8;
}
#monialsfader #monials li.active {
z-index:10;
opacity:1;
}
#monialsfader #monials li h4{
width:<?php echo $titwid; ?>;
line-height:<?php echo $title_font_size; ?>;
color:<?php echo $title_color; ?>;
font-size:<?php echo $title_font_size; ?>;
text-align:<?php echo $title_text_align; ?>;
font-weight:<?php echo $title_font_weight; ?>;
font-style:<?php echo $title_font_style; ?>;
float:left;
font-family:<?php echo $title_font_a; ?>;
}
#monialsfader #monials li .testimonials{
width:<?php echo $testiwid; ?>;
color:<?php echo $testimonials_color; ?>;
font-size:<?php echo $testimonials_font_size; ?>;
text-align:<?php echo $testimonials_text_align; ?>;
font-weight:<?php echo $testimonials_font_weight; ?>;
font-style:<?php echo $testimonials_font_style; ?>;
font-family:<?php echo $testi_font_a; ?>;
float:left;
}
#monialsfader #monials li .imghol{
width:<?php echo $imgholwid; ?>;
float:left;
}
#monialsfader #monials li .img{
width:<?php echo $imgwid; ?>;
float:left;
text-align:center;
}
#monialsfader #monials li .img img{
width:<?php echo $imgwid; ?>;
}
#monialsfader #monials li .author,#monialsfader #monials li .date{
width:<?php echo $authorwid; ?>;
color:<?php echo $authors_color; ?>;
font-size:<?php echo $authors_font_size; ?>;
text-align:<?php echo $authors_text_align; ?>;
font-weight:<?php echo $authors_font_weight; ?>;
font-style:<?php echo $authors_font_style; ?>;
font-family:<?php echo $auth_font_a; ?>;
float:left;
}
#monialsfader #monials li .author{
padding:5px;
}
#monialsfader #bottom-link a{
width:100%;
color:<?php echo $link_color; ?>;
font-size:<?php echo $link_font_size; ?>;
text-align:<?php echo $link_text_align; ?>;
font-weight:<?php echo $link_font_weight; ?>;
font-style:<?php echo $link_font_style; ?>;
font-family:<?php echo $link_font_a; ?>;
float:left;
}
</style>
<div id="monialsfader">
<div id="inner-monialsfader">
<div id="monials-top">
<?php
echo $quote_link;
?>
</div>
<ul id="monials">
<?php if($image_s_no==0){ ?>
<li class="active">
<h4>
<?php
if(!empty($titles[0]))
echo $titles[0];
?>
</h4>
<div class="testimonials">
<?php
echo $testimonials[0];
?>
</div>
<div class="author">
<?php
if(!empty($authors[0]))
echo $authors[0];
?>
<?php
if(!empty($dates[0]))
echo $dates[0];
?>
</div>
</li>
<?php
for ($i=1; $i<sizeof($testimonials); $i++) {
if(!empty($testimonials[$i])){
?>
<li>
<h4>
<?php
if(!empty($titles[$i]))
echo $titles[$i];
?>
</h4>
<div class="testimonials">
<?php
echo $testimonials[$i];
?>
</div>
<div class="author">
<?php
if(!empty($authors[$i]))
echo $authors[$i];
?>
<br/>
<?php
if(!empty($dates[$i]))
echo $dates[$i];
?>
</div>
</li>
<?php
} } }
else{
?>
<li class="active">



<?php if($style<4){ ?>
<div class="imghol">
<?php if($style==0 || $style==2){ ?>
<div class="img">
<?php
if(!empty($images[0]))
echo modmonialsfaderHelper::img_url($images[0],$imgwidth);
?>
</div>
<div class="author">
<?php
if(!empty($authors[0]))
echo $authors[0];
?>
<br/>
<?php
if(!empty($dates[0]))
echo $dates[0];
?>
</div>
<?php } else{ ?>
<div class="author">
<?php
if(!empty($authors[0]))
echo $authors[0];
?>
<br/>
<?php
if(!empty($dates[0]))
echo $dates[0];
?>
</div>
<div class="img">
<?php
if(!empty($images[0]))
echo modmonialsfaderHelper::img_url($images[0],$imgwidth);
?>
</div>
<?php } ?>
</div>
<?php } ?>




<h4>
<?php
if(!empty($titles[0]))
echo $titles[0];
?>
</h4>
<div class="testimonials">
<?php
echo $testimonials[0];
?>
</div>



<?php if($style>3){ ?>
<div class="imghol">
<?php if($style==4 || $style==6){ ?>
<div class="img">
<?php
if(!empty($images[0]))
echo modmonialsfaderHelper::img_url($images[0],$imgwidth);
?>
</div>
<div class="author">
<?php
if(!empty($authors[0]))
echo $authors[0];
?>
<br/>
<?php
if(!empty($dates[0]))
echo $dates[0];
?>
</div>
<?php } else{ ?>
<div class="author">
<?php
if(!empty($authors[0]))
echo $authors[0];
?>
<br/>
<?php
if(!empty($dates[0]))
echo $dates[0];
?>
</div>
<div class="img">
<?php
if(!empty($images[0]))
echo modmonialsfaderHelper::img_url($images[0],$imgwidth);
?>
</div>
<?php } ?>
</div>
<?php } ?>




</li>
<?php
for ($i=1; $i<sizeof($testimonials); $i++) {
if(!empty($testimonials[$i])){
?>
<li>


<?php if($style<4){ ?>
<div class="imghol">
<?php if($style==0 || $style==2){ ?>
<div class="img">
<?php
if(!empty($images[$i]))
echo modmonialsfaderHelper::img_url($images[$i],$imgwidth);
?>
</div>
<div class="author">
<?php
if(!empty($authors[$i]))
echo $authors[$i];
?>
<br/>
<?php
if(!empty($dates[$i]))
echo $dates[$i];
?>
</div>
<?php } else{ ?>
<div class="author">
<?php
if(!empty($authors[$i]))
echo $authors[$i];
?>
<br/>
<?php
if(!empty($dates[$i]))
echo $dates[$i];
?>
</div>
<div class="img">
<?php
if(!empty($images[$i]))
echo modmonialsfaderHelper::img_url($images[$i],$imgwidth);
?>
</div>
<?php } ?>
</div>
<?php } ?>


<h4>
<?php
if(!empty($titles[$i]))
echo $titles[$i];
?>
</h4>
<div class="testimonials">
<?php
echo $testimonials[$i];
?>
</div>


<?php if($style>3){ ?>
<div class="imghol">
<?php if($style==4 || $style==6){ ?>
<div class="img">
<?php
if(!empty($images[$i]))
echo modmonialsfaderHelper::img_url($images[$i],$imgwidth);
?>
</div>
<div class="author">
<?php
if(!empty($authors[$i]))
echo $authors[$i];
?>
<br/>
<?php
if(!empty($dates[$i]))
echo $dates[$i];
?>
</div>
<?php } else{ ?>
<div class="author">
<?php
if(!empty($authors[$i]))
echo $authors[$i];
?>

<br/>
<?php
if(!empty($dates[$i]))
echo $dates[$i];
?>
</div>
<div class="img">
<?php
if(!empty($images[$i]))
echo modmonialsfaderHelper::img_url($images[$i],$imgwidth);
?>
</div>
<?php } ?>
</div>
<?php } ?>


</li>
<?php } } }?>
</ul>
</div>
<div id="bottom-link">
<?php echo $linktext; ?> 
<?php echo $callbacktext; ?> 
</div>
<div style="clear:both"></div>
</div>