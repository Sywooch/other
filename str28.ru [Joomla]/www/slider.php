<?php 

//JHtml::_('behavior.framework', true);

?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
        <head>
		
		
		<!--slider for main-->
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/css_slider/global.css"/>

<script type="text/javascript" src="<?php echo $this->baseurl ?>/js_slider/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $this->baseurl ?>/js_slider/slides.min.jquery.js"></script>
<!--<script type="text/javascript" src="<?php echo $this->baseurl ?>/js_slider/jquery-1.8.2.js"></script>-->
<script type="text/javascript" src="<?php echo $this->baseurl ?>/js_slider/jquery.highlight.js"></script>


<script type="text/javascript">
		$(function(){
			// Set starting slide to 1
			var startSlide = 1;
			// Get slide number if it exists
			if (window.location.hash) {
			//	startSlide = window.location.hash.replace('#','');
			}
			// Initialize Slides
			$('#slides').slides({
				preload: true,
				preloadImage: '<?php echo $this->baseurl ?>/img_slider/loading.gif',
				generatePagination: true,
				play: 3000,
				pause: 3000,
				hoverPause: true,
				// Get the starting slide
				start: startSlide,
				animationComplete: function(current){
					// Set the slide number as a hash
				//	window.location.hash = '#' + current;
				}
			});
		});
	</script>
<!--[if IE 7]>
<style type="text/css">
.pagination {
	width:280px;
	position:absolute;
	z-index:9000;
	margin-top:-65px;
    margin-left:320px;
	 background-image:url(<?php echo $this->baseurl ?>/img_slider/pagination_fon.png);
 background-repeat:no-repeat;
 background-position:0px 42px;
padding-left:10px;
 
}

.pagination li {
	float:left;
	 z-index:9000;
	margin-top:47px;
	margin-left:0px;
	list-style:none;
   
}


</style>
<![endif]-->
	
	
	
<!--slider for main-->

   </head>
   
   <body>
   
<?php


//slider for main
		echo"<div align=\"left\" style=\"width:100%; height:600px; background-color:transparent; position:absolute;
		border:0px black solid; border-left:0px; border-right:0px;
		  margin-top:490px; z-index:90000000000000;\"><!---->
		<div style=\"width:942px; height:600px; border-left:1px black solid; border-right:1px black solid; background-color:transparent;
		left:50%; position:relative; margin-left:-471px; \"><!---->
		
		<div style=\"width:926px; float:left; height:600px; margin-left:13px; border:0px blue solid;\"><!---->
<div class=\"new_slider\" ><!----><!--слайдер-->
<div class=\"new_slider_2\" style=\" padding-top:0px; padding-left:0px; border:0px black solid; \"><!---->";


echo"
<div style=\"height:600px; width:926px; background-color:yellow;  \"><!--5--><!--слайдер-->";
echo"
<div id=\"container\" style=\"background-color:blue;\"><!--6-->
		<div id=\"example\" style=\"background-color:lime;\"><!--7-->
			<div id=\"slides\" style=\"background-color:red;\"><!--8-->
				<div class=\"slides_container\"><!--9-->
					<div class=\"slide\">
						<img src=\"".$this->baseurl."/img_slider/slides/index/1.jpg\" alt=\"\"/>
					</div>
					<div class=\"slide\">
						<img src=\"".$this->baseurl."/img_slider/slides/index/2.jpg\" alt=\"\"/>
					</div>
					<div class=\"slide\">
						<img src=\"".$this->baseurl."/img_slider/slides/index/3.jpg\" alt=\"\"/>						
					</div>
					<div class=\"slide\">
						<img src=\"".$this->baseurl."/img_slider/slides/index/4.jpg\" alt=\"\"/>					
					</div>
					<div class=\"slide\">
						<img src=\"".$this->baseurl."/img_slider/slides/index/5.jpg\" alt=\"\"/>						
					</div>
					
				</div><!--9-->
				
				
			</div><!--8-->
			
			
		</div><!--7-->
</div><!--6-->";
echo"</div><!--5--><!--слайдер-->";


echo"
</div><!---->

</div><!---->

</div><!---->

	
		
		</div>  <!---->
		  
		 
		  </div><!---->";
		  // left:50%; margin-left:-471px;

?>
<!--slider for main-->

   
   
   
   
   </body>