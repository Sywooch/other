<?php
/**
 * @version		3.0.x
 * @package		Simple Image Gallery Pro
 * @author		JoomlaWorks - http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2014 JoomlaWorks Ltd. All rights reserved.
 * @license		http://www.joomlaworks.net/license
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$relName = 'fancybox-button';
$extraClass = 'fancybox-button';

$stylesheets = array(
	'fancybox/jquery.fancybox.css?v=2.1.5',
	'fancybox/helpers/jquery.fancybox-buttons.css?v=2.1.5',
	'fancybox/helpers/jquery.fancybox-thumbs.css?v=2.1.5'
);
$stylesheetDeclarations = array();
$scripts = array(
	'fancybox/lib/jquery.mousewheel-3.0.6.pack.js',
	'fancybox/jquery.fancybox.js?v=2.1.5',
	'fancybox/helpers/jquery.fancybox-buttons.js?v=2.1.5',
	'fancybox/helpers/jquery.fancybox-thumbs.js?v=2.1.5'
);

if(!defined('PE_FANCYBOX_LOADED')){
	define('PE_FANCYBOX_LOADED', true);
	$scriptDeclarations = array('
		jQuery.noConflict();
		jQuery(function($) {
			$("a.fancybox-button").fancybox({
			
		"imageScale" : true,
		
		"frameWidth" : 700, 
        "frameHeight" : 600,
		
		
		
		
		
		
		
		
		/*
			onStart		:	function() {
			return window.confirm("Continue?");
		    },
		    onCancel	:	function() {
			    alert("Canceled!");
		    },
		    onComplete	:	function() {
                alert("Completed!");
		    },
		    onCleanup	:	function() {
                return window.confirm("Close?");
		    },
		    onClosed	:	function() {
            alert("Closed!");
		}
			*/
			
			
			
			
				//padding: 0,
				//fitToView	: true,
				helpers		: {
					title	: { type : \'inside\' }, // options: over, inside, outside, float
					buttons	: {}
				},
				afterLoad : function() {
				
				    
				    $(".gallery_bar").css({"display" : "block"});
				    //alert($("div").is(".fancybox-skin"));
				    var t2=0;
				   var MyIntervalID3=setInterval( function() { var  width_1= $(".fancybox-skin").width();
				   
				  // $(".gallery_bar").width(width_1);
				   $(".gallery_bar").width(100);
				   
				   var height_new=$(".fancybox-wrap").css("height");
		         $(".gallery_bar").css({"height" : "calc("+height_new+" + 10px)"});
		         
		         var top_new=$(".fancybox-wrap").css("top");
		         $(".gallery_bar").css({"top" : "10px"});
				   
				   var left_1=$(".fancybox-wrap").css("left");
				   
				   
				   //$(".gallery_bar").css({"left" : left_1}); 
				   //$(".gallery_bar").css({"left" : "-100px"}); 
				   $(".gallery_bar").css({"left" : "calc("+left_1+" - 105px)"});
				   
				   var height_1=$(".fancybox-skin").height(); var top_1=$(".fancybox-wrap").css("top");  var sum=parseInt(height_1)+parseInt(top_1);  
				  // $(".gallery_bar").css({"top" : sum});
				   
				   var width_2=width_1/7;  $(".gallery_bar img").width(100); $(".gallery_bar img").css({"background-color" : "black"});
				   $(".gallery_bar img").css({"opacity" : "0.5"});
				   
				   $(".gallery_bar .blue_border").css({"opacity" : "1"});
				   
				   
				      width_2=width_2-2; $(".gallery_bar .blue_border").width(96); var left_2=(width_2/2)+2; 
				   $(".gallery_bar .blue_border").css({"margin-left" : "-"+left_2+"px"}); 
				    
				    var height_11=$(".fancybox-wrap").css("height");
				    var height_11=$(".fancybox-wrap").height();
				    //alert(height_11);
				    var height_2=height_11/7;
				    $(".gallery_bar img").height(height_2);
				    
				        
				    var  width_img= $(".gallery_bar .img").width();
				    
				    var num_el=$("img.img").length;
				     
				      var width_block2=(width_img*num_el)+100;
				      //$(".gallery_bar2").css({"width" : width_block2});
				      $(".gallery_bar2").css({"width" : "100px"});
				      
				     // alert(width_block2);
				      $(".gallery_bar2").css({"height" : width_block2+"px"});
				      
				      
				      
				      
				     //for(i1=0;i1<num_el;i1++){
				     //    $("img.img"+i1+"").css({"left" : img_left});
				     //    img_left=img_left+width_img;
				     //}
				        
				    //alert("1234");
				    
				    
				    
				    
				      
  var MyIntervalID=setInterval(function() { 
				
				
				var bl=$("img").is(".fancybox-image");
				
				
				if(bl==true){
				
				
				var t=0;
				var MyIntervalID2=setInterval(function() { 
				
				var className = $(".fancybox-image").attr("class");
				className=className.replace("fancybox-image","");
				    className=className.replace("img_big","");
				    var img_num=className.replace(" ","");
				 
				 
				 ////управление синей рамкой
				 $("img.img").css({"border" : "0px #0b80a8 solid"});
				 $("img.img").css({"width" : width_img+"px"});
				 
				// alert(width_img);
				 var temp_height=$("img.img").css("height");
				 temp_height=temp_height.replace("px","");
				 
				 //alert(temp_height);
				// $("img.img").css({"height" : "100%"});
				 
				 
				 $("img.img"+img_num+"").css({"border" : "2px #0b80a8 solid"});
				$("img.img"+img_num+"").css({"opacity" : "1"});
				
				
				width_img2=width_img-2;
				$("img.img"+img_num+"").css({"width" : width_img2+"px"});
				
			
				
					$("img.img"+img_num+"").css({"width" : "96px"});
				   
				//temp_height2=temp_height-2;
				//$("img.img"+img_num+"").css({"height" : "calc(100% - 4px)"});
				
				
			//	alert((parseInt(img_num)+2)+"  "+num_el);
				
				////управление сдвигом бара
				if( (img_num==0)||(img_num==1)||(img_num==2)||(img_num==3) ){
				    
				    
				}else if( ((parseInt(img_num)+2)==num_el) ){
				    alert("1");
				    //alert("===");
			        var sdvig1=(img_num-6)*(width_img);
			       // $(".gallery_bar2").css({"margin-left" : "-"+sdvig1+"px"});
				  //  $(".gallery_bar2").css({"margin-top" : "-"+sdvig1+"px"});
				    
				
				}else if( ((parseInt(img_num)+2)==(num_el-1)) ){
					alert("2");
				//alert("===");
				    var sdvig1=(img_num-5)*(width_img);
			       // $(".gallery_bar2").css({"margin-left" : "-"+sdvig1+"px"});
			//	 $(".gallery_bar2").css({"margin-top" : "-"+sdvig1+"px"});
				
				}else if( ((parseInt(img_num)+2)==(num_el-2)) ){
				alert("3");
				    var sdvig1=(img_num-4)*(width_img);
			      //  $(".gallery_bar2").css({"margin-left" : "-"+sdvig1+"px"});
				// $(".gallery_bar2").css({"margin-top" : "-"+sdvig1+"px"});
				
				}else{
				   // alert("4");
				   var height_img=$("img.img").height();
				    var sdvig1=(img_num-3)*height_img;
				    //var left_1_1=$(".gallery_bar2").css("left");
				    
				    
				    //$(".gallery_bar2").css({"margin-left" : "-"+sdvig1+"px"});
				     $(".gallery_bar2").css({"margin-top" : "-"+sdvig1+"px"});
				    
				    //alert(sdvig1);
				    //gallery_bar2
				    
				    
				    
				}
				
				
				
				
				 
				
				t=t+1;
				if(t==10){
				clearInterval (MyIntervalID2);    
				
				}
				
				}, 200);
				
				 
				clearInterval (MyIntervalID );
				}
				    
				    
				}, 200);
  
 
 
 
 
 
 
 
 

  
                //$(".gallery_bar").css({"left" : left_1});
    
                
				 t2=t2+1;
				// var bl2=$("div").is(".fancybox-wrap"); 
				var bl2=$("div").is(".fancybox-skin");
				//alert(bl2);
				
				if(bl2==true){
				
				clearInterval (MyIntervalID3);    
				
				}   
				        
				    } , 5);


				    
				    
				    
				//alert(arr_gallery[1]);
				
				
				
				
				var str1="<div class=\'blue_border\' style=\'display:none;\'></div><div class=\'bar_prev\'></div><div class=\'bar_next\'></div>";
				
				for(var k=0; k<arr_gallery.length; k++) {
				str1=str1+"<img onclick=\"select_img("+k+");\" class=\"img img"+k+"\" src=\'"+arr_gallery[k+1]+"\'/> ";
				//alert(str1);
				}
				
				$(".gallery_bar2").html(str1);
				
				
				    //alert("12345");
					//this.title = \'<b class="fancyboxCounter">Image \' + (this.index + 1) + \' of \' + this.group.length + \'</b>\' + (this.title ? this.title : \'\');
				
				
				//var left_1=$(".fancybox-wrap").css("left");
				  //  alert(left_1);
				
			
  	            
				    
				    
				},
				afterClose : function() {
                   //alert("12345");
                   $(".gallery_bar").css({"display" : "none"});
                    $(".list_comments2").css({"display" : "none"});
                    $(".black1").css({"display" : "none"});
                    
                    $(".header").css({"z-index" : "99999999999999"}); 
                     $(".center > .leftmenu").css({"z-index" : "9000009999"}); 
                     $(".center > .rightmenu").css({"z-index" : "9999999999"});
                     $(".footer").css({"z-index" : "99999999999"});
                     $(".rating_foto_2").css({"display" : "none"});
                    
		        },
		        afterShow : function() {
                
                
                
                var left_1=$(".fancybox-wrap").css("left");
				   
				   
				   //$(".gallery_bar").css({"left" : left_1});
                $(".gallery_bar").css({"left" : "calc("+left_1+" - 105px)"});
                
                var height_new=$(".fancybox-wrap").css("height");
		         $(".gallery_bar").css({"height" : "calc("+height_new+" + 10px)"});
				 
		         
		         var top_new=$(".fancybox-wrap").css("top");
		         $(".gallery_bar").css({"top" : "10px"});
		            
		            //black
		            $(".black1").css({"display" : "block"});
		            $(".black1").css({"z-index" : "99999999999"});
		            $(".black1").css({"border-top-width" : "2px"});
		            $(".black1").css({"border-bottom-width" : "2px"});
		            $(".black1").css({"border-left-width" : "5px"});
		            $(".black1").css({"border-right-width" : "5px"});
		            
		            var  width_12= $(".fancybox-skin").width();
		            $(".black1").width(width_12);
		            var left_12=$(".fancybox-wrap").css("left");
		         // alert(left_12);
		            $(".black1").css({"left" : left_12}); 
		            var height_12=$(".gallery_bar").css("height");
		            var bottom_12=$(".gallery_bar").css("bottom");
		            //alert(height_12);
		            //$(".black1").css({"bottom" : "calc("+height_12+" + "+bottom_12+")"}); 
		             $(".black1").css({"bottom" : "7px"});
		            var src=$("img.fancybox-image").attr("src");
		            $(".black1 .link").attr({"href":src});
		            
		            var rating_html = $(".rating_author").html();
		            
		            
		            //$(".black1 .votes1").html(rating_html);
		            
		            
		            $(".list_comments2").width(width_12);
		            var height_13=$(".fancybox-image").css("height");
		            $(".list_comments2").css({"height" : height_13}); 
		            
		            $(".list_comments2").css({"left" : "calc("+left_12+" + 5px)"}); 
					
					var top2=$(".fancybox-wrap.fancybox-desktop.fancybox-type-image.fancybox-opened").css("top");
					$(".list_comments2").css({"top" : "calc("+top2+" + 5px)"}); 
		            
		            
		            $(".header").css({"z-index" : "9"}); 
		            $(".center > .leftmenu").css({"z-index" : "9"}); 
                     $(".center > .rightmenu").css({"z-index" : "9"});
                     $(".footer").css({"z-index" : "9"});
                     $(".top").css({"display" : "none"});
                     $(".dc-slick.top .tab").css({"display" : "none"});
		            $("#fancybox-buttons").css({"z-index" : "0"});
		            
		             $(".rating_foto_2").css({"display" : "block"});
		             var bottom_wrap=$(".fancybox-wrap").css("bottom");
		             //alert(bottom_wrap);
		            $(".rating_foto_2").css({"bottom" : "calc("+bottom_wrap+" - 14px)"});
		            var bottom_wrap=$(".fancybox-wrap").css("right");
		            $(".rating_foto_2").css({"right" : "calc("+bottom_wrap+" + 10px)"});
		            
		            
		            
		            
		        }
			});
		});
	');
} else {
	$scriptDeclarations = array();
}

?>

<script type="text/javascript">
var $j2 = jQuery.noConflict();

$j2('.black1 .share').click(function(){ 

if($j2(".black1 .pluso").css("display")=="none"){

 $j2(".black1 .pluso").css({"display" : "block"});
 $j2(".black1 .comments").css({"display" : "none"});
 $j2(".black1 .votes1").css({"display" : "none"});
 
}else{
 $j2(".black1 .pluso").css({"display" : "none"});
 $j2(".black1 .comments").css({"display" : "block"});
 $j2(".black1 .votes1").css({"display" : "block"});
    
    
}


});


$j2('.black1 .comments').click(function(){ 
    
    
   var com1=$j2(".list_comments2").css("display");
   
 if(com1=='block'){
     $j2(".list_comments2").css({"display" : "none"});
 }else{
    

$j2(".list_comments2").css({"display" : "block"});

var comments_html = $j2(".container_comments").html();
$j2(".list_comments2").html(comments_html);

$j2(".list_comments div.itemComments ul.itemCommentsList li").css({"margin-top" : "5px"});

$j2(".list_comments .comment_block").css({"width" : "calc(100% - 129px)"}); 

$j2(".list_comments form .form_avatar").css({"margin-left" : "5px"});


//$j2(".list_comments2 .list_comments form textarea.inputbox").css({"margin-left" : "5px !important"});

//$j2(".list_comments2 .list_comments form textarea.inputbox").css({"width" : "calc(100% - 129px)  !important"});

var height_14=$j2(".list_comments2").css("height");

//alert(height_14);


$j2(".list_comments2").css({"display" : "block"});

$j2(".list_comments .itemCommentsList").css({"height" : "calc("+height_14+" - 187px)"});
$j2(".list_comments .itemCommentsList").css({"overflow" : "auto"});

$j2(".list_comments2").css({"overflow" : "hidden"});





}


});
    
</script>
<style type="text/css">
    .list_comments2 .list_comments form textarea.inputbox{
        margin-left: 12px !important;
  width: calc(100% - 147px) !important;
    }
    .list_comments div.itemCommentsForm form input#submitCommentButton{
        margin-left: 119px !important;
    }
    .list_comments div.itemCommentsForm form input#submitCommentButton{
        padding-top:5px !important;
    }
    
    div.itemCommentsPagination{
        display:none;
    }
    
</style>
