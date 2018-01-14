<?php
/**
 * @version		2.6.x
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2014 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;


function close_tags($content)
    {
        $position = 0;
        $open_tags = array();
        //теги для игнорирования
        $ignored_tags = array('br', 'hr', 'img');

        while (($position = strpos($content, '<', $position)) !== FALSE)
        {
            //забираем все теги из контента
            if (preg_match("|^<(/?)([a-z\d]+)\b[^>]*>|i", substr($content, $position), $match))
            {
                $tag = strtolower($match[2]);
                //игнорируем все одиночные теги
                if (in_array($tag, $ignored_tags) == FALSE)
                {
                    //тег открыт
                    if (isset($match[1]) AND $match[1] == '')
                    {
                        if (isset($open_tags[$tag]))
                            $open_tags[$tag]++;
                        else
                            $open_tags[$tag] = 1;
                    }
                    //тег закрыт
                    if (isset($match[1]) AND $match[1] == '/')
                    {
                        if (isset($open_tags[$tag]))
                            $open_tags[$tag]--;
                    }
                }
                $position += strlen($match[0]);
            }
            else
                $position++;
        }
        //закрываем все теги
        foreach ($open_tags as $tag => $count_not_closed)
        {
            $content .= str_repeat("</{$tag}>", $count_not_closed);
        }

        return $content;
    }


function strip_words($string,$count){
   $result     = '';
   $counter_plus  = true;
   $counter = 0;
   $string_len = strlen($string);
   for($i=0; $i<$string_len; ++$i){
        $char = $string[$i];
        if($char == '<') $counter_plus = false;
        if($char == '>' and $string[$i+1] != '<'){
            $counter_plus = true;
            $counter--;
        }
        $result .= $char;
        if($counter_plus) $counter++;
        if($counter >= $count) {
            $pos_space = strpos($string, ' ', $i);
            $pos_tag = strpos($string, '<', $i);
            if ($pos_space == false) {
                $pos = strrpos($result, ' ');
                $result = substr($result, 0, strlen($result)-($i-$pos+1));
            } else {
                $pos = min($pos_space, $pos_tag);
                if ($pos != $i) {
                    $dop_str = substr($string, $i+1, $pos-$i-1);
                    $result .= $dop_str;
                } else {
                    $result = substr($result, 0, strlen($result)-1);
                }
            }
            break;
        }
   }
   return $result;
   }
/*
function html_cut($html, $size) {
    $html = iconv('UTF-8', 'cp1251', $html);
    $html = str_replace(" ", ' ', $html);
    $symbols = strip_tags($html);
    $symbols_len = strlen($symbols);
    if($symbols_len > $size) {
        $strip_text = strip_words($html,$size);
        $strip_text = $strip_text."...";
        $final_text = closetags($strip_text);
        $final_text_len = strlen($final_text);
    } else $final_text = $html;
    $final_text = iconv('cp1251', 'UTF-8', $final_text);
    return $final_text;
}
*/
?>

<?php
$app = JFactory::getApplication();
$template = $app->getTemplate('template')->template;
$doc = JFactory::getDocument();

$extraFields = new stdClass();
if($this->item->extra_fields) {
    foreach ($this->item->extra_fields as $extraField) {
        $alias = $extraField->alias;
        $extraFields->$alias = new stdClass();
        $extraFields->$alias = $extraField;
    }
}
?>

<?php if(JRequest::getInt('print')==1): ?>
<!-- Print button at the top of the print page only -->
<a class="itemPrintThisPage" rel="nofollow" href="#" onclick="window.print();return false;">
	<span><?php echo JText::_('K2_PRINT_THIS_PAGE'); ?></span>
</a>
<?php endif; ?>

<style type="text/css">
    .nivo-slider-wrapper.theme-light{
      
    }
    .ss2-align{
     
    }
    body > .nicescroll-rails{
        display:block !important;
    }
    .center > .content{
     /*   width:calc(100% + 16px) !important;*/
    }
	
	.jspPane{
	width:100% !important;	
	}
	
	
	
	.calendar_container.tmp0{
	display:none;	
	}
	
	.poster_items.tmp2{
	/*display:none;	*/
	visibility:hidden;
	}
	
	.main_afisha_banners.tmp1{
	display:none;	
	}
	
	.poster_items{
	padding-bottom:0px;	
	}
</style>

<div class="poster_detail tmp1" style="margin-top:54px;">

	<div class="calendar_top">
		<div class="calendar_container tmp1">
	<div class="calendar">
    	<div class="top">
        <div class="top2" id="top2_id">
        	<?php
			$time = date('d');
			
			
$day[0] = "ВС"; 
$day[1] = "ПН"; 
$day[2] = "ВТ"; 
$day[3] = "СР"; 
$day[4] = "ЧТ"; 
$day[5] = "ПТ"; 
$day[6] = "СБ"; 
			
			
			$day_1=date("w");
			
			
			if(($day_1==0)||($day_1==6)){
			$class="red";		
			}
			else{
			$class="";
			};
			
			echo '<a href="/afishi?day='.date("Y-m-d H:i:s").'"><div class="date '.$class.'" id="date_0" onclick="date(0, \''.date("Y-m-d H:i:s").'\');" style="width:100px !important;"><span class="date_num">'.$time.'</span>
			<span class="w_num">Сегодня</span>
			</div></a>';
			for($i=1;$i<90;$i++){
				$time = date('d', time()+(86400*$i));
				$day_1=date("w", time()+(86400*$i));
				
				if(($day_1==0)||($day_1==6)){
				$class="red";		
				}
				else{
				$class="";
				};
				
				echo '<a href="/afishi?day='.date("Y-m-d H:i:s", time()+(86400*$i)).'"><div class="date '.$class.'" id="date_'.$i.'" onclick="date('.$i.', \''.date("Y-m-d H:i:s", time()+(86400*$i)).'\');"><span class="date_num">'.$time.'</span>
				<span class="w_num">'.$day[$day_1]."</span>
				</div></a>";
			}
			
			
			?>
        </div>
        
        
        
        </div>
        
        <div class="bottom">
<!--<span class="date datepick"><a>Выбрать дату</a><input type="hidden" class="datepickhidden" value=""></span>
-->        
        
        <?php
		//вывод подкатегорий
		$database2 = JFactory::getDbo();
		$database2->setQuery("SELECT * FROM #__k2_categories WHERE parent=5");
		$list2 = $database2->loadObjectList();
 
		foreach($list2 as $it) { 
		
		echo'<span class="cat_name tmp9"><a href="/afishi/'.$it->alias.'?subcategory='.$it->id.'">'.$it->name.'</a></span>';
		
		}
		
		?> 
        
        
        </div>
        
        
        
        
    </div>
    
            <div class="button_right" onclick="c_right();"></div>
    		<div class="button_left" onclick="c_left();"></div>
</div>



	</div>


<script type="text/javascript">


function c_right(){
	var $j = jQuery.noConflict();
	//var len=$j('.calendar_container .top2').css('height');
	
	element = document.getElementById('top2_id');
	len = window.getComputedStyle(element).marginLeft;
	len=len.replace("px","");
	len=len-47;
	$j('.calendar_container .top2').css({'margin-left' : ''+len+'px'});

}

function c_left(){
	var $j = jQuery.noConflict();
		
	element = document.getElementById('top2_id');
	len = window.getComputedStyle(element).marginLeft;
	//alert(len);
	len=len.replace("px","");
	
	if(len!='0'){
		len=eval(len)+eval(47);
		//alert(len);
		$j('.calendar_container .top2').css({'margin-left' : ''+len+'px'});
	}



	
}
</script>


<!-- Start K2 Item Layout -->
<span id="startOfPageId<?php echo JRequest::getInt('id'); ?>"></span>


<div class="poster_head_block">
    <div class="left">  
    
    
    
    <?php if($this->item->params->get('itemRating')): ?>
	<!-- Item Rating -->
	<div class="itemRatingBlock">
		<!--<span><?php echo JText::_('K2_RATE_THIS_ITEM'); ?></span>-->
		<div class="itemRatingForm">
			<ul class="itemRatingList">
				<li class="itemCurrentRating" id="itemCurrentRating<?php echo $this->item->id; ?>" style="width:<?php echo $this->item->votingPercentage; ?>%;"></li>
				<li><a href="#" data-id="<?php echo $this->item->id; ?>" title="<?php echo JText::_('K2_1_STAR_OUT_OF_5'); ?>" class="one-star">1</a></li>
				<li><a href="#" data-id="<?php echo $this->item->id; ?>" title="<?php echo JText::_('K2_2_STARS_OUT_OF_5'); ?>" class="two-stars">2</a></li>
				<li><a href="#" data-id="<?php echo $this->item->id; ?>" title="<?php echo JText::_('K2_3_STARS_OUT_OF_5'); ?>" class="three-stars">3</a></li>
				<li><a href="#" data-id="<?php echo $this->item->id; ?>" title="<?php echo JText::_('K2_4_STARS_OUT_OF_5'); ?>" class="four-stars">4</a></li>
				<li><a href="#" data-id="<?php echo $this->item->id; ?>" title="<?php echo JText::_('K2_5_STARS_OUT_OF_5'); ?>" class="five-stars">5</a></li>
			</ul>
			<div id="itemRatingLog<?php echo $this->item->id; ?>" class="itemRatingLog"><?php  
			$votes=$this->item->numOfvotes;
			$votes=str_replace("(","",$votes);
			$votes=str_replace(")","",$votes);
			echo $votes;
			?></div>
			<div class="clr"></div>
		</div>
		<div class="clr"></div>
	</div>
	<?php endif; ?>

     <span class="date"><?php  //echo JHTML::_('date', $this->item->created , JText::_('DATE_FORMAT_LC2')); 
            
             $datetime = explode(" ",  $this->item->created);
    $date = explode("-", $datetime[0]);
    $time = explode(":", $datetime[1]);
    
     echo "<div class='date1'>".$date[2].".".$date[1].".".$date[0]."</div>";
            
            echo "<div class='time1'>".$time[0].":".$time[1]."</div>";
            
            
            
            ?>  <?php  echo "<div class='hits1'>".$this->item->hits."</div>";  ?></span>
            
            
        
    
    
    </div>
    
    
    
    <div class="right">
        
        
        <div class="right1">
        
        
        
        
        
        
        
        <?php if($this->item->params->get('itemTitle')): ?>
	  <!-- Item title -->
	  <h2 class="itemTitle">
			<?php if(isset($this->item->editLink)): ?>
			<!-- Item edit link -->
			<span class="itemEditLink">
				<a class="modal" rel="{handler:'iframe',size:{x:990,y:550}}" href="<?php echo $this->item->editLink; ?>">
					<?php echo JText::_('K2_EDIT_ITEM'); ?>
				</a>
			</span>
			<?php endif; ?>






  <?php

  $database2 = JFactory::getDbo();
		   $database2->setQuery("SELECT * FROM #__categories WHERE title='".($this->item->id)."'");
		    $list2 = $database2->loadObjectList();
		    $count=0;
		     foreach($list2 as $it) {
		      $count=1;
		      break;
		     }
		    if($count==1){
		    
  ?>
  




	  	<?php 
	  	//echo strlen($this->item->title);
	  	if((strlen($this->item->title)/2)>30){
	echo mb_substr ($this->item->title,0,30); echo " ...";
    	
	}else{
	echo $this->item->title;
    	
	}
    
	  	
	  	
	  //	echo $this->item->title; 
	  	
	  	
	  	
	  	?>


<?php
			}else{

?>

<style type="text/css">
.poster_detail .poster_head_block .right .right1 {
  width: 76%  !important;
  float: left;
  overflow: hidden;
}

.poster_detail .poster_head_block .right .right2 {
  width: 23% !important;
  float: right;
  overflow: hidden;
}

.poster_head_block .back {
  width: 100% !important;
  float: right;
  height: 100%;
  text-align: center;
}

</style>

	  	<?php 
	  //	echo strlen($this->item->title);
	  	if((strlen($this->item->title)/2)>45){
	echo mb_substr ($this->item->title,0,45); echo " ...";
    	
	}else{
	echo $this->item->title;
    	
	}
    
	  	
	  	
	  //	echo $this->item->title; 
	  	
	  	
	  	
	  	?>



<?php
			}

?>







</div>
<div class="right2">


	  	<?php if($this->item->params->get('itemFeaturedNotice') && $this->item->featured): ?>
	  	<!-- Featured flag -->
	  	<span>
		  	<sup>
		  		<?php echo JText::_('K2_FEATURED'); ?>
		  	</sup>
	  	</span>
	  	<?php endif; ?>

	  </h2>
	  <?php endif; ?>
        
        
        
      <span class="back"><a href="/" onclick="window.history.back();">Вернуться</a></span>
        
        <span class="head">Партнёры</span>
        
        </div>
        
        
        
    </div>
    
</div>



<div id="k2Container" style="height:440px;  overflow-y:hidden;" class="tmp1 itemView<?php echo ($this->item->featured) ? ' itemIsFeatured' : ''; ?><?php if($this->item->params->get('pageclass_sfx')) echo ' '.$this->item->params->get('pageclass_sfx'); ?>">

	<!-- Plugins: BeforeDisplay -->
	<?php echo $this->item->event->BeforeDisplay; ?>

	<!-- K2 Plugins: K2BeforeDisplay -->
	<?php echo $this->item->event->K2BeforeDisplay; ?>

	
  <!-- Plugins: AfterDisplayTitle -->
  <?php echo $this->item->event->AfterDisplayTitle; ?>

  <!-- K2 Plugins: K2AfterDisplayTitle -->
  <?php echo $this->item->event->K2AfterDisplayTitle; ?>

	<?php if(
		$this->item->params->get('itemFontResizer') ||
		$this->item->params->get('itemPrintButton') ||
		$this->item->params->get('itemEmailButton') ||
		$this->item->params->get('itemSocialButton') ||
		$this->item->params->get('itemVideoAnchor') ||
		$this->item->params->get('itemImageGalleryAnchor') ||
		$this->item->params->get('itemCommentsAnchor')
	): ?>
  <!--<div class="itemToolbar">
		<ul>
			<?php if($this->item->params->get('itemFontResizer')): ?>
			
			<li>
				<span class="itemTextResizerTitle"><?php echo JText::_('K2_FONT_SIZE'); ?></span>
				<a href="#" id="fontDecrease">
					<span><?php echo JText::_('K2_DECREASE_FONT_SIZE'); ?></span>
					<img src="<?php echo JURI::root(true); ?>/components/com_k2/images/system/blank.gif" alt="<?php echo JText::_('K2_DECREASE_FONT_SIZE'); ?>" />
				</a>
				<a href="#" id="fontIncrease">
					<span><?php echo JText::_('K2_INCREASE_FONT_SIZE'); ?></span>
					<img src="<?php echo JURI::root(true); ?>/components/com_k2/images/system/blank.gif" alt="<?php echo JText::_('K2_INCREASE_FONT_SIZE'); ?>" />
				</a>
			</li>
			<?php endif; ?>

			<?php if($this->item->params->get('itemPrintButton') && !JRequest::getInt('print')): ?>
			<li>
				<a class="itemPrintLink" rel="nofollow" href="<?php echo $this->item->printLink; ?>" onclick="window.open(this.href,'printWindow','width=900,height=600,location=no,menubar=no,resizable=yes,scrollbars=yes'); return false;">
					<span><?php echo JText::_('K2_PRINT'); ?></span>
				</a>
			</li>
			<?php endif; ?>

			<?php if($this->item->params->get('itemEmailButton') && !JRequest::getInt('print')): ?>
			<li>
				<a class="itemEmailLink" rel="nofollow" href="<?php echo $this->item->emailLink; ?>" onclick="window.open(this.href,'emailWindow','width=400,height=350,location=no,menubar=no,resizable=no,scrollbars=no'); return false;">
					<span><?php echo JText::_('K2_EMAIL'); ?></span>
				</a>
			</li>
			<?php endif; ?>

			<?php if($this->item->params->get('itemSocialButton') && !is_null($this->item->params->get('socialButtonCode', NULL))): ?>
			<li>
				<?php echo $this->item->params->get('socialButtonCode'); ?>
			</li>
			<?php endif; ?>

			<?php if($this->item->params->get('itemVideoAnchor') && !empty($this->item->video)): ?>
			<li>
				<a class="itemVideoLink k2Anchor" href="<?php echo $this->item->link; ?>#itemVideoAnchor"><?php echo JText::_('K2_MEDIA'); ?></a>
			</li>
			<?php endif; ?>

			<?php if($this->item->params->get('itemImageGalleryAnchor') && !empty($this->item->gallery)): ?>
			<li>
				<a class="itemImageGalleryLink k2Anchor" href="<?php echo $this->item->link; ?>#itemImageGalleryAnchor"><?php echo JText::_('K2_IMAGE_GALLERY'); ?></a>
			</li>
			<?php endif; ?>

			<?php if($this->item->params->get('itemCommentsAnchor') && $this->item->params->get('itemComments') && ( ($this->item->params->get('comments') == '2' && !$this->user->guest) || ($this->item->params->get('comments') == '1')) ): ?>
			<li>
				<?php if(!empty($this->item->event->K2CommentsCounter)): ?>
					<?php echo $this->item->event->K2CommentsCounter; ?>
				<?php else: ?>
					<?php if($this->item->numOfComments > 0): ?>
					<a class="itemCommentsLink k2Anchor" href="<?php echo $this->item->link; ?>#itemCommentsAnchor">
						<span><?php echo $this->item->numOfComments; ?></span> <?php echo ($this->item->numOfComments>1) ? JText::_('K2_COMMENTS') : JText::_('K2_COMMENT'); ?>
					</a>
					<?php else: ?>
					<a class="itemCommentsLink k2Anchor" href="<?php echo $this->item->link; ?>#itemCommentsAnchor">
						<?php echo JText::_('K2_BE_THE_FIRST_TO_COMMENT'); ?>
					</a>
					<?php endif; ?>
				<?php endif; ?>
			</li>
			<?php endif; ?>
		</ul>
		<div class="clr"></div>
  </div>-->
	<?php endif; ?>

	
  <div class="itemBody">

    <div class="list_comments" style="overflow:auto; ">
    
          
<?php $user =& JFactory::getUser();
        if (($user->guest)){ ?>
	  
      
      
      <span class="comments_note" style="color:black !important"><span style="text-decoration:underline; cursor:pointer;" onclick="reg_modal2();">Зарегистрируйтесь</span> или <span style="text-decoration:underline; cursor:pointer;" onclick="show_modal1();">авторизуйтесь</span>, чтобы оставить комментарий.</span>
      
    
	  <?php } ?>
    
    <!---------------------=============================================------------->
    
    <?php if($this->item->params->get('itemComments') && ($this->item->params->get('comments') == '1' || ($this->item->params->get('comments') == '2')) && empty($this->item->event->K2CommentsBlock)): ?>
  <!-- Item comments -->
  <a name="itemCommentsAnchor" id="itemCommentsAnchor"></a>

  <div class="itemComments">
      
<?php $user =& JFactory::getUser();
        if (($user->guest)){ ?>
	  
	  
	  <style type="text/css">
	      .itemCommentsForm{
	        display:none;     
	     
	      }
	      
	  </style>
	  
	  <?php } ?>



	  <?php if($this->item->params->get('commentsFormPosition')=='above' && $this->item->params->get('itemComments') && !JRequest::getInt('print') && ($this->item->params->get('comments') == '1' || ($this->item->params->get('comments') == '2' && K2HelperPermissions::canAddComment($this->item->catid)))): ?>
	  
	  
	  <?php //echo"========";   $user =& JFactory::getUser();
            //if (($user->guest)){ echo"123"; }else{ ?>
	  <div class="itemCommentsForm" style="background-color:red;">
	  	<?php echo $this->loadTemplate('comments_form'); ?>
	  </div>
	  <?php //} ?>
	  
	  
	  <?php endif; ?>

	  <?php if($this->item->numOfComments>0 && $this->item->params->get('itemComments') && ($this->item->params->get('comments') == '1' || ($this->item->params->get('comments') == '2'))): ?>
	  <h3 class="itemCommentsCounter">
	  	<span><?php echo $this->item->numOfComments; ?></span> <?php echo ($this->item->numOfComments>1) ? JText::_('K2_COMMENTS') : JText::_('K2_COMMENT'); ?>
	  </h3>

	  <ul class="itemCommentsList">
	    <?php foreach ($this->item->comments as $key=>$comment): ?>
	    <li class="<?php echo ($key%2) ? "odd" : "even"; echo (!$this->item->created_by_alias && $comment->userID==$this->item->created_by) ? " authorResponse" : ""; echo($comment->published) ? '':' unpublishedComment'; ?>">

	    	<span class="commentLink">
		    	<a href="<?php echo $this->item->link; ?>#comment<?php echo $comment->id; ?>" name="comment<?php echo $comment->id; ?>" id="comment<?php echo $comment->id; ?>">
		    		<?php echo JText::_('K2_COMMENT_LINK'); ?>
		    	</a>
		    </span>

				<?php if($comment->userImage): ?>
				<img src="<?php echo $comment->userImage; ?>" alt="<?php echo JFilterOutput::cleanText($comment->userName); ?>" width="<?php echo $this->item->params->get('commenterImgWidth'); ?>" />
				<?php endif; ?>

			
			
			<div class="comment_block">
			<div class="left1"></div>	

		    <span class="commentAuthorName">
			    <?php //echo JText::_('K2_POSTED_BY'); ?>
			    <?php if(!empty($comment->userLink)): ?>
			    <a href="<?php echo JFilterOutput::cleanText($comment->userLink); ?>" title="<?php echo JFilterOutput::cleanText($comment->userName); ?>" target="_blank" rel="nofollow">
			    	<?php echo $comment->userName; ?>
			    </a>
			    <?php else: ?>
			    <?php echo $comment->userName; ?>
			    <?php endif; ?>
		    </span>

		    <p><?php echo $comment->commentText; ?></p>
		    
		    
		    <span class="commentDate">
		    	<?php //echo JHTML::_('date', $comment->commentDate, JText::_('K2_DATE_FORMAT_LC22')); 
		    	
		    	$date_m=explode(" ",$comment->commentDate);
		    	//echo $date_m[0]."<br>";
		    	$date_m[0]=str_replace("-",".",$date_m[0]);
		    	
		    	echo $date_m[1]." ".$date_m[0];
		    	//echo $comment->commentDate;
		    	
		    	
		    	?>
		    </span>
		    
		    
		    </div>
		    
		    

				<?php if($this->inlineCommentsModeration || ($comment->published && ($this->params->get('commentsReporting')=='1' || ($this->params->get('commentsReporting')=='2' && !$this->user->guest)))): ?>
				<span class="commentToolbar">
					<?php if($this->inlineCommentsModeration): ?>
					<?php if(!$comment->published): ?>
					<a class="commentApproveLink" href="<?php echo JRoute::_('index.php?option=com_k2&view=comments&task=publish&commentID='.$comment->id.'&format=raw')?>"><?php echo JText::_('K2_APPROVE')?></a>
					<?php endif; ?>

					<a class="commentRemoveLink" href="<?php echo JRoute::_('index.php?option=com_k2&view=comments&task=remove&commentID='.$comment->id.'&format=raw')?>"><?php echo JText::_('K2_REMOVE')?></a>
					<?php endif; ?>

					<?php if($comment->published && ($this->params->get('commentsReporting')=='1' || ($this->params->get('commentsReporting')=='2' && !$this->user->guest))): ?>
					<a class="modal" rel="{handler:'iframe',size:{x:560,y:480}}" href="<?php echo JRoute::_('index.php?option=com_k2&view=comments&task=report&commentID='.$comment->id)?>"><?php echo JText::_('K2_REPORT')?></a>
					<?php endif; ?>

					<?php if($comment->reportUserLink): ?>
					<a class="k2ReportUserButton" href="<?php echo $comment->reportUserLink; ?>"><?php echo JText::_('K2_FLAG_AS_SPAMMER'); ?></a>
					<?php endif; ?>

				</span>
				<?php endif; ?>

				<div class="clr"></div>
	    </li>
	    <?php endforeach; ?>
	  </ul>

	  <div class="itemCommentsPagination">
	  	<?php echo $this->pagination->getPagesLinks(); ?>
	  	<div class="clr"></div>
	  </div>
		<?php endif; ?>

		<?php if($this->item->params->get('commentsFormPosition')=='below' && $this->item->params->get('itemComments') && !JRequest::getInt('print') && ($this->item->params->get('comments') == '1' || ($this->item->params->get('comments') == '2' && K2HelperPermissions::canAddComment($this->item->catid)))): ?>
	  <div class="itemCommentsForm">
	  	<?php echo $this->loadTemplate('comments_form'); ?>
	  </div>
	  <?php endif; ?>

	  <?php $user = JFactory::getUser(); if ($this->item->params->get('comments') == '2' && $user->guest): ?>
	  		<div><?php echo JText::_('K2_LOGIN_TO_POST_COMMENTS'); ?></div>
	  <?php endif; ?>

  </div>
  <?php endif; ?>

    
    
    
    
    <!--------------------=============================================----------------->
        
        
    </div>






	  <!-- Plugins: BeforeDisplayContent -->
	  <?php echo $this->item->event->BeforeDisplayContent; ?>

	  <!-- K2 Plugins: K2BeforeDisplayContent -->
	  <?php echo $this->item->event->K2BeforeDisplayContent; ?>

	  <?php if($this->item->params->get('itemImage') && !empty($this->item->image)): ?>
	  <!-- Item Image -->
	  <div class="itemImageBlock">
	      
	      
	      
	      
	      
	      
	      
	      
	      
	      <!--video-->
	      
	      
	       
  <?php if($this->item->params->get('itemVideo') && !empty($this->item->video)): ?>
  <!-- Item video -->
  <a name="itemVideoAnchor" id="itemVideoAnchor"></a>

  <div class="itemVideoBlock detail_block1">
  	<h3><?php echo JText::_('K2_MEDIA'); ?></h3>

		<?php if($this->item->videoType=='embedded'): ?>
		<div class="itemVideoEmbedded">
			<?php echo $this->item->video; ?>
		</div>
		<?php else: ?>
		<span class="itemVideo"><?php echo $this->item->video; ?></span>
		<?php endif; ?>

	  <?php if($this->item->params->get('itemVideoCaption') && !empty($this->item->video_caption)): ?>
	  <span class="itemVideoCaption"><?php echo $this->item->video_caption; ?></span>
	  <?php endif; ?>

	  <?php if($this->item->params->get('itemVideoCredits') && !empty($this->item->video_credits)): ?>
	  <span class="itemVideoCredits"><?php echo $this->item->video_credits; ?></span>
	  <?php endif; ?>

	  <div class="clr"></div>
  </div>
  <?php endif; ?>

	      
	      
	      
	      
	      <!--video-->
	      
	      
	      
	      
	      
	      
	      
	      
	      
	      
	      
	      
	      
	      
	      
	      
		  <span class="itemImage">
		  	<a class="modal" rel="{handler: 'image'}" href="<?php echo $this->item->imageXLarge; ?>" title="<?php echo JText::_('K2_CLICK_TO_PREVIEW_IMAGE'); ?>">
		  		<img src="<?php echo $this->item->image; ?>" alt="<?php if(!empty($this->item->image_caption)) echo K2HelperUtilities::cleanHtml($this->item->image_caption); else echo K2HelperUtilities::cleanHtml($this->item->title); ?>" style="width:<?php /*echo $this->item->imageWidth;*/ echo "40%"; ?>; height:auto;" />
		  	</a>
		  </span>

		  <?php if($this->item->params->get('itemImageMainCaption') && !empty($this->item->image_caption)): ?>
		  <!-- Image caption -->
		  <span class="itemImageCaption"><?php echo $this->item->image_caption; ?></span>
		  <?php endif; ?>

		  <?php if($this->item->params->get('itemImageMainCredits') && !empty($this->item->image_credits)): ?>
		  <!-- Image credits -->
		  <span class="itemImageCredits"><?php echo $this->item->image_credits; ?></span>
		  <?php endif; ?>

		  <div class="clr"></div>
	  </div>
	  <?php endif; ?>




<div class="itemHeader">

		<?php if($this->item->params->get('itemDateCreated')): ?>
		<!-- Date created -->
		<!--<span class="itemDateCreated" style="background-color:red;">
			<?php echo JHTML::_('date', $this->item->created , JText::_('K2_DATE_FORMAT_LC2')); ?>
		</span>-->
		<?php endif; ?>

	  

		<?php if($this->item->params->get('itemAuthor')): ?>
		<!-- Item Author -->
		<!--<span class="itemAuthor">
			<?php echo K2HelperUtilities::writtenBy($this->item->author->profile->gender); ?>&nbsp;
			<?php if(empty($this->item->created_by_alias)): ?>
			<a rel="author" href="<?php echo $this->item->author->link; ?>"><?php echo $this->item->author->name; ?></a>
			<?php else: ?>
			<?php echo $this->item->author->name; ?>
			<?php endif; ?>
		</span>-->
		<?php endif; ?>

  </div>











	  <?php if(!empty($this->item->fulltext)): ?>
	  <?php if($this->item->params->get('itemIntroText')): ?>
	  <!-- Item introtext -->
	  <div class="itemIntroText">
	  	<?php echo $this->item->introtext; ?>
	  </div>
	  <?php endif; ?>
	  <?php if($this->item->params->get('itemFullText')): ?>
	  <!-- Item fulltext -->
	  <div class="itemFullText tmp1">
      
      	
        
      	
      	
      	<div class="default">
	  	<?php echo $this->item->fulltext; ?>
	  	</div>
      </div>
	  <?php endif; ?>
	  <?php else: ?>
	  <!-- Item text -->
	  <div class="itemFullText tmp2">
      	
        <div class="description detail_block1">
        <?php echo $extraFields->infopmatsiya->value;?>
        </div>
        
        <div class="aktyopy detail_block1">
        <?php echo $extraFields->aktyopy->value;?>
        </div>
        
        <div class="tpeylep detail_block1">
        <?php echo $extraFields->tpeylep->value;?>
        </div>
        
        <div class="foto detail_block1">
        <?php echo $extraFields->foto->value;?>
        </div>
        
        <div class="paspisanieseansov detail_block1">
        <?php echo $extraFields->paspisanieseansov->value;?>
        </div>
        
        
        
        
        
        
      	<div class="default detail_block1">
	  	
	  	
	  	
	  	<?php   // echo $this->item->introtext; 
	  	
	  	$mas1=explode(" ",($this->item->introtext));
	  	//echo mb_substr(($this->item->introtext),0, 1500);
	  	$text2 = "";
	  	if(strlen($this->item->introtext)>700){
	  	/*    for($i=0;$i<109;$i++){ 
	  	        $text2 .= $mas1[$i]." "; 
	  	       
	  	        
	  	    }*/
	  	    //echo"</p>";
	  	    
	  	    $text2 = strip_words($this->item->introtext,700);
	  	    echo close_tags($text2)." ...  "; 
	  	    echo '<a href="#" onclick="overlay_desc();">ПОДРОБНЕЕ</a>';
	  	   
	  	}else{
	  	   
	  	    echo $this->item->introtext;
	  	    
	  	}
	  	
	  	?>
	  	
	  	
	  	
	  	
	  	
	  	</div>
      
      </div>
      
      <script type="text/javascript">
         function overlay_desc(){
             
             var $j2 = jQuery.noConflict();
    
             $j2(".overlay_desc").css({"display" : "block"});
             $j2(".desc_modal").css({"display" : "block"});
         }
          
      </script>
      
      
      
	  <?php endif; ?>

		<div class="clr"></div>

	  <?php if($this->item->params->get('itemExtraFields') && count($this->item->extra_fields)): ?>
	  <!-- Item extra fields -->
	  <!--<div class="itemExtraFields">
	  	<h3><?php echo JText::_('K2_ADDITIONAL_INFO'); ?></h3>
	  	<ul>
			<?php foreach ($this->item->extra_fields as $key=>$extraField): ?>
			<?php if($extraField->value != ''): ?>
			<li class="<?php echo ($key%2) ? "odd" : "even"; ?> type<?php echo ucfirst($extraField->type); ?> group<?php echo $extraField->group; ?>">
				<?php if($extraField->type == 'header'): ?>
				<h4 class="itemExtraFieldsHeader"><?php echo $extraField->name; ?></h4>
				<?php else: ?>
				<span class="itemExtraFieldsLabel"><?php echo $extraField->name; ?>:</span>
				<span class="itemExtraFieldsValue"><?php echo $extraField->value; ?></span>
				<?php endif; ?>
			</li>
			<?php endif; ?>
			<?php endforeach; ?>
			</ul>
	    <div class="clr"></div>
	  </div>-->
	  <?php endif; ?>

		<?php if($this->item->params->get('itemHits') || ($this->item->params->get('itemDateModified') && intval($this->item->modified)!=0)): ?>
		<!--<div class="itemContentFooter">

			<?php if($this->item->params->get('itemHits')): ?>
			<span class="itemHits">
				<?php echo JText::_('K2_READ'); ?> <b><?php echo $this->item->hits; ?></b> <?php echo JText::_('K2_TIMES'); ?>
			</span>
			<?php endif; ?>

			<?php if($this->item->params->get('itemDateModified') && intval($this->item->modified)!=0): ?>
			<span class="itemDateModified">
				<?php echo JText::_('K2_LAST_MODIFIED_ON'); ?> <?php echo JHTML::_('date', $this->item->modified, JText::_('K2_DATE_FORMAT_LC2')); ?>
			</span>
			<?php endif; ?>

			<div class="clr"></div>
		</div>-->
		<?php endif; ?>

	  <!-- Plugins: AfterDisplayContent -->
	  <?php echo $this->item->event->AfterDisplayContent; ?>

	  <!-- K2 Plugins: K2AfterDisplayContent -->
	  <?php echo $this->item->event->K2AfterDisplayContent; ?>

	  <div class="clr"></div>
  </div>
  
  
  
  
  
  
  
  
  
  
  
  <!-- мини-карусель партнёров -->
    <span id="delta"></span>
  <div class="banners_rotator" id="rotator">
      <div class="rotator_container">
       
  <?php

  $database2 = JFactory::getDbo();
		   $database2->setQuery("SELECT * FROM #__categories WHERE title='".($this->item->id)."'");
		    $list2 = $database2->loadObjectList();
		    $count=0;
		     foreach($list2 as $it) {
		      $count=1;
		      break;
		     }
		    if($count==1){
		    
  ?>
  
          
        
 <?php
    $database =& JFactory::getDBO();
//echo $this->item->id;



		$database->setQuery("SELECT * FROM #__categories WHERE title='".($this->item->id)."'");
		$list = $database->loadObjectList();
 
		foreach($list as $it) {
	
	
	
	    $cat_id=$it->id;
	
	
	
	
	
	
	
	
		}
		
	
	

			$database->setQuery("SELECT * FROM #__banners WHERE catid='".($cat_id)."' AND state='1'");
		$list = $database->loadObjectList();
 
		foreach($list as $it) {
	
		
		
		
		    $url=$it->params;
		    $m=explode('":"',$url);
		    $url=$m[1];
		    $m=explode('","',$url);
		    $url=$m[0];
		    $url=str_replace("\\","",$url);
		    
		    $width=$it->params;
		    $m=explode(',"',$width);
		    $width=$m[1];
		    $m=explode('":',$width);
		    $width=$m[1];
		    
		    $height=$it->params;
		    $m=explode(',"',$height);
		    $height=$m[2];
		    
		    $m=explode('":',$height);
		    $height=$m[1];
		   
		    
 ?>

  <?php
  if($it->clickurl==""){
	  
	  ?>
	<img src="<?php echo $url; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" alt="" title=""/>  
    <?php
  }else{
	?>  
   <a href="<?php echo $it->clickurl; ?>"><img src="<?php echo $url; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" alt="" title=""/></a>    
  
  <?php
  
  }
  
  ?>
 
 <?php
 	  	 
        
		}
        ?>
        

  <?php
	    }else{
  ?>
  
  <!--<style type="text/css">
      .poster_detail div.itemFullText{
          
        width: 58% !important;
      }
      
      .poster_detail div.itemBody{
       width:100% !important;   
      }
      
      
  </style>-->
  <style type="text/css">
      .poster_detail .banners_rotator{
          height:0px !important;
      }
      
      .poster_detail .poster_head_block .right .head{
          display:none;
      }
      
  </style>
  
  <?php
		    }
  ?>
  
    </div>
      
      
      
      
  </div>
  


<?php
  $database2 = JFactory::getDbo();
		   $database2->setQuery("SELECT * FROM #__categories WHERE title='".($this->item->id)."'");
		    $list2 = $database2->loadObjectList();
		    $count=0;
		     foreach($list2 as $it) {
		      $count=1;
		      break;
		     }
		    if($count==1){
?>


         

<script type="text/javascript">
    var $j = jQuery.noConflict();
//$j2('.rotator_container').animate({marginTop : '-100000000px'},30000000);
 /*  var top=$j('.rotator_container').css('margin-top');
                top=parseInt(top);
                var h1=$j('.rotator_container').height();
                var top2=Math.abs(top);
                
                
                if( (top2+300)>(h1/2) ){
                
                 var html1=$j('.rotator_container').html();
                 html1=html1+html1;
                 $j('.rotator_container').html(html1);
                
                } 
    */
	

MyIntervalID = setInterval(function() {
var top=$j('.rotator_container').css('margin-top');
$j('.rotator_container').css({"margin-top" : "calc("+top+" - 0.1px)"});
  //  $green.css('left', ++greenLeft);




var top=$j('.rotator_container').css('margin-top');
                top=parseInt(top);
                var h1=$j('.rotator_container').height();
                var top2=Math.abs(top);
                
                
                if( (top2+300)>(h1/2) ){
                
                 var html1=$j('.rotator_container').html();
                 html1=html1+html1;
                 $j('.rotator_container').html(html1);
                
                } 






}, 0.001);





$j(".rotator_container").mouseout(function (){ 

//setInterval(MyIntervalID);

MyIntervalID = setInterval(function() {
var top=$j('.rotator_container').css('margin-top');
$j('.rotator_container').css({"margin-top" : "calc("+top+" - 0.1px)"});
 

var top=$j('.rotator_container').css('margin-top');
                top=parseInt(top);
                var h1=$j('.rotator_container').height();
                var top2=Math.abs(top);
                
                
                if( (top2+300)>(h1/2) ){
                
                 var html1=$j('.rotator_container').html();
                 html1=html1+html1;
                 $j('.rotator_container').html(html1);
                
                } 








}, 0.001);







});



$j(".rotator_container").mouseover(function (){  //
clearInterval (MyIntervalID);

});

	
	
</script>










<script type="text/javascript"> 

var $j = jQuery.noConflict();
$j(document).ready(function(){

 var html1=$j('.rotator_container').html();

//alert(html1);
html1=html1+html1;
$j('.rotator_container').html(html1);

  

  $j('#rotator').bind('mousewheel', function(e){
        if(e.originalEvent.wheelDelta /120 > 0) {
           // alert('scrolling up !');
           
      var top=$j('.rotator_container').css('margin-top');
                top=parseInt(top);
                if(top<=0){
                top=top+5;
                
                $j('.rotator_container').css({'margin-top' : ''+top+'px'});
                }
        }
        else{
            //alert('scrolling down !');
            var top=$j('.rotator_container').css('margin-top');
                top=parseInt(top);
                var h1=$j('.rotator_container').height();
                var top2=Math.abs(top);
                
                
                if( (top2+300)>(h1/2) ){
                
                 var html1=$j('.rotator_container').html();
                 html1=html1+html1;
                 $j('.rotator_container').html(html1);
                
                }
                top=top-5;
                
                $j('.rotator_container').css({'margin-top' : ''+top+'px'});
            
        }
        
        return false;
        
    });
 
  
  
    

    });
</script>

  
  


<?php
}
?>





  
  
  
  

	<?php if($this->item->params->get('itemTwitterButton',1) || $this->item->params->get('itemFacebookButton',1) || $this->item->params->get('itemGooglePlusOneButton',1)): ?>
	<!-- Social sharing -->
	<!--<div class="itemSocialSharing">

		<?php if($this->item->params->get('itemTwitterButton',1)): ?>
		<div class="itemTwitterButton">
			<a href="https://twitter.com/share" class="twitter-share-button" data-count="horizontal"<?php if($this->item->params->get('twitterUsername')): ?> data-via="<?php echo $this->item->params->get('twitterUsername'); ?>"<?php endif; ?>>
				<?php echo JText::_('K2_TWEET'); ?>
			</a>
			<script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
		</div>
		<?php endif; ?>

		<?php if($this->item->params->get('itemFacebookButton',1)): ?>
		<div class="itemFacebookButton">
			<div id="fb-root"></div>
			<script type="text/javascript">
				(function(d, s, id) {
				  var js, fjs = d.getElementsByTagName(s)[0];
				  if (d.getElementById(id)) return;
				  js = d.createElement(s); js.id = id;
				  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
				  fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));
			</script>
			<div class="fb-like" data-send="false" data-width="200" data-show-faces="true"></div>
		</div>
		<?php endif; ?>

		<?php if($this->item->params->get('itemGooglePlusOneButton',1)): ?>
		<div class="itemGooglePlusOneButton">
			<g:plusone annotation="inline" width="120"></g:plusone>
			<script type="text/javascript">
			  (function() {
			  	window.___gcfg = {lang: 'en'}; // Define button default language here
			    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
			    po.src = 'https://apis.google.com/js/plusone.js';
			    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
			  })();
			</script>
		</div>
		<?php endif; ?>

		<div class="clr"></div>
	</div>-->
	<?php endif; ?>

  <?php if($this->item->params->get('itemCategory') || $this->item->params->get('itemTags') || $this->item->params->get('itemAttachments')): ?>
  <!--<div class="itemLinks">

		<?php if($this->item->params->get('itemCategory')): ?>
		<div class="itemCategory">
			<span><?php echo JText::_('K2_PUBLISHED_IN'); ?></span>
			<a href="<?php echo $this->item->category->link; ?>"><?php echo $this->item->category->name; ?></a>
		</div>
		<?php endif; ?>

	  <?php if($this->item->params->get('itemTags') && count($this->item->tags)): ?>
	  <div class="itemTagsBlock">
		  <span><?php echo JText::_('K2_TAGGED_UNDER'); ?></span>
		  <ul class="itemTags">
		    <?php foreach ($this->item->tags as $tag): ?>
		    <li><a href="<?php echo $tag->link; ?>"><?php echo $tag->name; ?></a></li>
		    <?php endforeach; ?>
		  </ul>
		  <div class="clr"></div>
	  </div>
	  <?php endif; ?>

	  <?php if($this->item->params->get('itemAttachments') && count($this->item->attachments)): ?>
	  <div class="itemAttachmentsBlock">
		  <span><?php echo JText::_('K2_DOWNLOAD_ATTACHMENTS'); ?></span>
		  <ul class="itemAttachments">
		    <?php foreach ($this->item->attachments as $attachment): ?>
		    <li>
			    <a title="<?php echo K2HelperUtilities::cleanHtml($attachment->titleAttribute); ?>" href="<?php echo $attachment->link; ?>"><?php echo $attachment->title; ?></a>
			    <?php if($this->item->params->get('itemAttachmentsCounter')): ?>
			    <span>(<?php echo $attachment->hits; ?> <?php echo ($attachment->hits==1) ? JText::_('K2_DOWNLOAD') : JText::_('K2_DOWNLOADS'); ?>)</span>
			    <?php endif; ?>
		    </li>
		    <?php endforeach; ?>
		  </ul>
	  </div>
	  <?php endif; ?>

		<div class="clr"></div>
  </div>-->
  <?php endif; ?>

  <?php if($this->item->params->get('itemAuthorBlock') && empty($this->item->created_by_alias)): ?>
  <!-- Author Block -->
  <!--<div class="itemAuthorBlock">

  	<?php if($this->item->params->get('itemAuthorImage') && !empty($this->item->author->avatar)): ?>
  	<img class="itemAuthorAvatar" src="<?php echo $this->item->author->avatar; ?>" alt="<?php echo K2HelperUtilities::cleanHtml($this->item->author->name); ?>" />
  	<?php endif; ?>

    <div class="itemAuthorDetails">
      <h3 class="itemAuthorName">
      	<a rel="author" href="<?php echo $this->item->author->link; ?>"><?php echo $this->item->author->name; ?></a>
      </h3>

      <?php if($this->item->params->get('itemAuthorDescription') && !empty($this->item->author->profile->description)): ?>
      <p><?php echo $this->item->author->profile->description; ?></p>
      <?php endif; ?>

      <?php if($this->item->params->get('itemAuthorURL') && !empty($this->item->author->profile->url)): ?>
      <span class="itemAuthorUrl"><?php echo JText::_('K2_WEBSITE'); ?> <a rel="me" href="<?php echo $this->item->author->profile->url; ?>" target="_blank"><?php echo str_replace('http://','',$this->item->author->profile->url); ?></a></span>
      <?php endif; ?>

      <?php if($this->item->params->get('itemAuthorEmail')): ?>
      <span class="itemAuthorEmail"><?php echo JText::_('K2_EMAIL'); ?> <?php echo JHTML::_('Email.cloak', $this->item->author->email); ?></span>
      <?php endif; ?>

			<div class="clr"></div>

			<?php echo $this->item->event->K2UserDisplay; ?>

    </div>
    <div class="clr"></div>
  </div>-->
  <?php endif; ?>

  <?php if($this->item->params->get('itemAuthorLatest') && empty($this->item->created_by_alias) && isset($this->authorLatestItems)): ?>
  <!-- Latest items from author -->
	<!--<div class="itemAuthorLatest">
		<h3><?php echo JText::_('K2_LATEST_FROM'); ?> <?php echo $this->item->author->name; ?></h3>
		<ul>
			<?php foreach($this->authorLatestItems as $key=>$item): ?>
			<li class="<?php echo ($key%2) ? "odd" : "even"; ?>">
				<a href="<?php echo $item->link ?>"><?php echo $item->title; ?></a>
			</li>
			<?php endforeach; ?>
		</ul>
		<div class="clr"></div>
	</div>-->
	<?php endif; ?>

	<?php
	/*
	Note regarding 'Related Items'!
	If you add:
	- the CSS rule 'overflow-x:scroll;' in the element div.itemRelated {…} in the k2.css
	- the class 'k2Scroller' to the ul element below
	- the classes 'k2ScrollerElement' and 'k2EqualHeights' to the li element inside the foreach loop below
	- the style attribute 'style="width:<?php echo $item->imageWidth; ?>px;"' to the li element inside the foreach loop below
	...then your Related Items will be transformed into a vertical-scrolling block, inside which, all items have the same height (equal column heights). This can be very useful if you want to show your related articles or products with title/author/category/image etc., which would take a significant amount of space in the classic list-style display.
	*/
	?>

  <?php if($this->item->params->get('itemRelated') && isset($this->relatedItems)): ?>
  <!-- Related items by tag -->
	<div class="itemRelated">
		<h3><?php echo JText::_("K2_RELATED_ITEMS_BY_TAG"); ?></h3>
		<ul>
			<?php foreach($this->relatedItems as $key=>$item): ?>
			<li class="<?php echo ($key%2) ? "odd" : "even"; ?>">

				<?php if($this->item->params->get('itemRelatedTitle', 1)): ?>
				<a class="itemRelTitle" href="<?php echo $item->link ?>"><?php echo $item->title; ?></a>
				<?php endif; ?>

				<?php if($this->item->params->get('itemRelatedCategory')): ?>
				<div class="itemRelCat"><?php echo JText::_("K2_IN"); ?> <a href="<?php echo $item->category->link ?>"><?php echo $item->category->name; ?></a></div>
				<?php endif; ?>

				<?php if($this->item->params->get('itemRelatedAuthor')): ?>
				<div class="itemRelAuthor"><?php echo JText::_("K2_BY"); ?> <a rel="author" href="<?php echo $item->author->link; ?>"><?php echo $item->author->name; ?></a></div>
				<?php endif; ?>

				<?php if($this->item->params->get('itemRelatedImageSize')): ?>
				<img style="width:<?php echo $item->imageWidth; ?>px;height:auto;" class="itemRelImg" src="<?php echo $item->image; ?>" alt="<?php K2HelperUtilities::cleanHtml($item->title); ?>" />
				<?php endif; ?>

				<?php if($this->item->params->get('itemRelatedIntrotext')): ?>
				<div class="itemRelIntrotext"><?php echo $item->introtext; ?></div>
				<?php endif; ?>

				<?php if($this->item->params->get('itemRelatedFulltext')): ?>
				<div class="itemRelFulltext"><?php echo $item->fulltext; ?></div>
				<?php endif; ?>

				<?php if($this->item->params->get('itemRelatedMedia')): ?>
				<?php if($item->videoType=='embedded'): ?>
				<div class="itemRelMediaEmbedded"><?php echo $item->video; ?></div>
				<?php else: ?>
				<div class="itemRelMedia"><?php echo $item->video; ?></div>
				<?php endif; ?>
				<?php endif; ?>

				<?php if($this->item->params->get('itemRelatedImageGallery')): ?>
				<div class="itemRelImageGallery"><?php echo $item->gallery; ?></div>
				<?php endif; ?>
			</li>
			<?php endforeach; ?>
			<li class="clr"></li>
		</ul>
		<div class="clr"></div>
	</div>
	<?php endif; ?>

	<div class="clr"></div>

  
  
  
  
 









  <?php if($this->item->params->get('itemImageGallery') && !empty($this->item->gallery)): ?>
  <!-- Item image gallery -->
  <a name="itemImageGalleryAnchor" id="itemImageGalleryAnchor"></a>
  <div class="itemImageGallery detail_block1">
	  <h3><?php echo JText::_('K2_IMAGE_GALLERY'); ?></h3>
	  <?php echo $this->item->gallery; ?>
  </div>
  <?php endif; ?>

  <?php if($this->item->params->get('itemNavigation') && !JRequest::getCmd('print') && (isset($this->item->nextLink) || isset($this->item->previousLink))): ?>
  <!-- Item navigation -->
  <!--<div class="itemNavigation">
  	<span class="itemNavigationTitle"><?php echo JText::_('K2_MORE_IN_THIS_CATEGORY'); ?></span>

		<?php if(isset($this->item->previousLink)): ?>
		<a class="itemPrevious" href="<?php echo $this->item->previousLink; ?>">
			&laquo; <?php echo $this->item->previousTitle; ?>
		</a>
		<?php endif; ?>

		<?php if(isset($this->item->nextLink)): ?>
		<a class="itemNext" href="<?php echo $this->item->nextLink; ?>">
			<?php echo $this->item->nextTitle; ?> &raquo;
		</a>
		<?php endif; ?>

  </div>-->
  <?php endif; ?>

  <!-- Plugins: AfterDisplay -->
  <?php echo $this->item->event->AfterDisplay; ?>

  <!-- K2 Plugins: K2AfterDisplay -->
  <?php echo $this->item->event->K2AfterDisplay; ?>

  <?php if($this->item->params->get('itemComments') && ( ($this->item->params->get('comments') == '2' && !$this->user->guest) || ($this->item->params->get('comments') == '1'))): ?>
  <!-- K2 Plugins: K2CommentsBlock -->
  <?php echo $this->item->event->K2CommentsBlock; ?>
  <?php endif; ?>

 
	<?php if(!JRequest::getCmd('print')): ?>
	<!--<div class="itemBackToTop">
		<a class="k2Anchor" href="<?php echo $this->item->link; ?>#startOfPageId<?php echo JRequest::getInt('id'); ?>">
			<?php echo JText::_('K2_BACK_TO_TOP'); ?>
		</a>
	</div>-->
	<?php endif; ?>

	<div class="clr"></div>
</div>
<!-- End K2 Item Layout -->

<div class="right_banners">
 
 
 
 
    
    
    <?php
    $database =& JFactory::getDBO();

		
		$database->setQuery("SELECT * FROM #__banners WHERE catid='21' AND state='1'");
		$list = $database->loadObjectList();
 
		foreach($list as $it) {
		    
		    $url=$it->params;
		    $m=explode('":"',$url);
		    $url=$m[1];
		    $m=explode('","',$url);
		    $url=$m[0];
		    $url=str_replace("\\","",$url);
		    
		    $width=$it->params;
		    $m=explode(',"',$width);
		    $width=$m[1];
		    $m=explode('":',$width);
		    $width=$m[1];
		    
		    $height=$it->params;
		    $m=explode(',"',$height);
		    $height=$m[2];
		    
		    $m=explode('":',$height);
		    $height=$m[1];
		   
		    
 ?>

 
 
  <?php
  if($it->clickurl==""){
	  
	  ?>
	<img src="<?php echo $url; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" alt="" title=""/>  
    <?php
  }else{
	?>  
   <a href="<?php echo $it->clickurl; ?>"><img src="<?php echo $url; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" alt="" title=""/></a>    
  
  <?php
  
  }
  
  ?>
 
 <?php
 	  	 
        
		}
        ?>
        
        


 
 
 
 
 
 
 
 
     
 <?php
    $database =& JFactory::getDBO();

		
		$database->setQuery("SELECT * FROM #__banners WHERE catid='17' AND state='1'");
		$list = $database->loadObjectList();
 
		foreach($list as $it) {
		    
		    $url=$it->params;
		    $m=explode('":"',$url);
		    $url=$m[1];
		    $m=explode('","',$url);
		    $url=$m[0];
		    $url=str_replace("\\","",$url);
		    
		    $width=$it->params;
		    $m=explode(',"',$width);
		    $width=$m[1];
		    $m=explode('":',$width);
		    $width=$m[1];
		    
		    $height=$it->params;
		    $m=explode(',"',$height);
		    $height=$m[2];
		    
		    $m=explode('":',$height);
		    $height=$m[1];
		   
		    
 ?>

  <?php
  if($it->clickurl==""){
	  
	  ?>
	<img src="<?php echo $url; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" alt="" title=""/>  
    <?php
  }else{
	?>  
   <a href="<?php echo $it->clickurl; ?>"><img src="<?php echo $url; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" alt="" title=""/></a>    
  
  <?php
  
  }
  
  ?>
 
 <?php
 	  	 
        
		}
        ?>
        
        



</div>


<div class="bottom_submenu">
<div class="left">
<span onclick="treyler();" class="treyler">Посмотреть трейлер</span>
</div>
   

<div class="right">
<span onclick="opis();" style="text-decoration:underline;" class="opis">Описание</span>
<span>|</span>
<span onclick="info();" class="info">Информация</span>
<span style="display:none;">|</span>
<span onclick="akt();" class="akt">Актёры</span>
<span style="display:none;">|</span>
<span onclick="foto();" class="foto">Фото</span>
<span style="display:none;">|</span>
<span onclick="seans();" class="seans">Расписание сеансов</span>

<a class="sigProCommLink" style="cursor:pointer;" onclick="list_comments_in();">Комментарии</a>
</div>


 


</div>



<script type="text/javascript">
var $j = jQuery.noConflict();

function list_comments_in(){
$list=$j(".poster_detail .itemBody .list_comments").css('display');
if($list=="none"){
	$j(".poster_detail .itemBody .list_comments").css({'display' : 'block'});
    

}else{
	$j(".poster_detail .itemBody .list_comments").css({'display' : 'none'});
}

}
</script>


<script type="text/javascript">
var $j = jQuery.noConflict();
function opis(){
	$j(".poster_detail .detail_block1").css({'display' : 'none'});
	$j(".poster_detail .itemFullText .default").css({'display' : 'block'});
	$j(".bottom_submenu span").css({'text-decoration' : 'none'});
	$j(".bottom_submenu .opis").css({'text-decoration' : 'underline'});
	$j(".poster_detail .banners_rotator").css({'display' : 'block'});
	$j(".itemBody").css({'display' : 'block'});
	$j(".itemImageBlock .itemVideoBlock").css({'display' : 'none'});
	$j(".itemImageBlock .itemImage").css({'display' : 'block'});
}
function info(){
	$j(".poster_detail .detail_block1").css({'display' : 'none'});
	$j(".poster_detail .itemFullText .description").css({'display' : 'block'});
	$j(".bottom_submenu span").css({'text-decoration' : 'none'});
	$j(".bottom_submenu .info").css({'text-decoration' : 'underline'});
	$j(".poster_detail .banners_rotator").css({'display' : 'block'});
	$j(".itemBody").css({'display' : 'block'});
	$j(".itemImageBlock .itemVideoBlock").css({'display' : 'none'});
	$j(".itemImageBlock .itemImage").css({'display' : 'block'});
}
function akt(){
	$j(".poster_detail .detail_block1").css({'display' : 'none'});
	$j(".poster_detail .itemFullText .aktyopy").css({'display' : 'block'});	
	$j(".bottom_submenu span").css({'text-decoration' : 'none'});
	$j(".bottom_submenu .akt").css({'text-decoration' : 'underline'});
	$j(".poster_detail .banners_rotator").css({'display' : 'block'});
	$j(".itemBody").css({'display' : 'block'});
	$j(".itemImageBlock .itemVideoBlock").css({'display' : 'none'});
}
function treyler(){
    var t=$j(".poster_detail .itemVideoBlock").css('display');
   
  if(t=='none'){
  
	    $j(".itemImageBlock .itemImage").css({'display' : 'none'});
	    $j(".itemImageBlock .itemVideoBlock").css({'display' : 'block'});
	    $j(".default.detail_block1").css({'display' : 'block'});
	    
	    //$j(".poster_detail .detail_block1").css({'display' : 'none'});
	    
	    //$j(".poster_detail .detail_block1").css({'display' : 'none'});
	    //$j(".poster_detail .detail_block1").css({'display' : 'none'});
	    //$j(".itemBody").css({'display' : 'none'});
	    
	    //$j(".poster_detail .itemVideoBlock").css({'display' : 'block'});
	    $j(".bottom_submenu span").css({'text-decoration' : 'none'});
	    $j(".bottom_submenu .treyler").css({'text-decoration' : 'underline'});	
	    //$j(".poster_detail .banners_rotator").css({'display' : 'none'});
	    $j(".bottom_submenu .treyler").html("Вернуться к описанию");
	  
  }else{
    $j(".bottom_submenu .treyler").html("Посмотреть трейлер");  
        $j(".poster_detail .detail_block1").css({'display' : 'none'});
	$j(".poster_detail .itemFullText .default").css({'display' : 'block'});
	$j(".bottom_submenu span").css({'text-decoration' : 'none'});
	$j(".bottom_submenu .opis").css({'text-decoration' : 'underline'});
	$j(".poster_detail .banners_rotator").css({'display' : 'block'});
	$j(".itemBody").css({'display' : 'block'});
	$j(".itemImageBlock .itemVideoBlock").css({'display' : 'none'});
	$j(".itemImageBlock .itemImage").css({'display' : 'block'});
    
  }
	
}
function foto(){
	$j(".poster_detail .detail_block1").css({'display' : 'none'});
	$j(".poster_detail .itemImageGallery").css({'display' : 'block'});
	$j(".bottom_submenu span").css({'text-decoration' : 'none'});
	$j(".bottom_submenu .foto").css({'text-decoration' : 'underline'});	
	$j(".poster_detail .banners_rotator").css({'display' : 'none'});
	$j(".itemBody").css({'display' : 'block'});
	$j(".itemImageBlock .itemVideoBlock").css({'display' : 'none'});
	$j(".itemImageBlock .itemImage").css({'display' : 'block'});
}
function seans(){
	$j(".poster_detail .detail_block1").css({'display' : 'none'});
	$j(".poster_detail .itemFullText .paspisanieseansov").css({'display' : 'block'});
	$j(".bottom_submenu span").css({'text-decoration' : 'none'});
	$j(".bottom_submenu .seans").css({'text-decoration' : 'underline'});
	$j(".poster_detail .banners_rotator").css({'display' : 'block'});	
	$j(".itemBody").css({'display' : 'block'});
	$j(".itemImageBlock .itemVideoBlock").css({'display' : 'none'});
}

</script>


<div class="poster_items">
<?php
$database = JFactory::getDbo();
$database->setQuery("SELECT * FROM #__k2_items WHERE catid=5 AND published=1 AND trash=0 ORDER BY publish_up DESC");
$list = $database->loadObjectList();
$id_tmp=0;
 
foreach($list as $it) { 
   
   
   $hash = md5('Image'.$it->id);
	//echo $hash;
?>


<?php

//echo $it->publish_up;
//echo"<br>";
//echo $it->publish_down;
//echo"<br>";
$today=date("Y-m-d H:i:s");
//echo $today;

$result=(($it->publish_up)<$today);
$result2=($today<($it->publish_down));

if(($result==true)&&($result2==true)){
	

?>
<?php
//$alias1=str_replace("vse/","",$it->alias);
//$cat_alias=str_replace("vse","",$cat_alias);
$alias1=$it->alias;
if($cat_alias==""){
    
    $cat_alias="vse";
}
$link1=str_replace("//","/","/afishi/".$cat_alias."/".$alias1);

?>  
    


<div class="poster_img tmp331" id="<?php echo "i_".$id_tmp; $id_tmp++;  ?>">
<div class="black_shadow_1">
    
    
</div>
<div class="poster_img2" style="background-image:url(/media/k2/items/src/<?php echo $hash;?>.jpg);">
<a href="<?php echo $link1; ?>" style="width:100%; height:100%; display:block;"></a>
</div>
</div>



<script type="text/javascript">
    var $j = jQuery.noConflict();
 var temp_width=$j(".poster_img").css("width");
$j(".poster_img").css({"height" : "calc("+temp_width+" * 1)"});	


    
</script>




<?php
}
?>



<?php	
	
	
}

?>

























<!-- поиск по подкатегориям --->


<?php


if( (isset($_GET['subcategory'])) ){
    

}else{

// получение идентификаторов дочерних категорий категории Афиши
$database->setQuery("SELECT * FROM #__k2_categories WHERE parent=5 AND published=1 AND trash=0");
$list = $database->loadObjectList();


$m1=0;
$sql1="";
 
foreach($list as $it) { 

$sub_cat_id_m[$m1]=$it->id;

$sql1=$sql1.$sub_cat_id_m[$m1].",";
//echo $sub_cat_id_m[$m1]." = ";


$m1++;
    
}//foreach($list as $it) 



$sql1=substr_replace($sql1, '', strrpos($sql1, ','));

//echo "=======".$sql1;


    $database2 = JFactory::getDbo();
     $database2->setQuery("SELECT * FROM #__k2_items WHERE catid IN (".$sql1.") AND trash=0 ORDER BY publish_down,publish_up ");
     
    $list2 = $database2->loadObjectList();
    
    foreach($list2 as $it2) {
    
       $hash2 = md5('Image'.$it2->id);
    
    
    
    ?>
    
    
    
    
    
    
    
    
    
    
    
    
    
  
<?php

//echo $it->publish_up;
//echo"<br>";
//echo $it->publish_down;
//echo"<br>";


if( (isset($_GET['day'])) ){
    
$today=$_GET['day'];
//echo $today;
}
else{
$today=date("Y-m-d H:i:s");
}//echo $today;

$result=(($it2->publish_up)<$today);
$result2=($today<($it2->publish_down));

for($i_1=0;$i_1<30;$i_1++){
//$tmp_date=("Y-m-d H:i:s", time()+(86400*$i_1));
$day_7=date("Y-m-d H:i:s", time()+(86400*$i_1));


$result=(($it2->publish_up)<$day_7);
$result2=($day_7<($it2->publish_down));

if(($result==true)&&($result2==true)){ break; };
}






if(($result==true)&&($result2==true)){
	

?>










    
<?php

$catid=$it2->catid;

 $database3 = JFactory::getDbo();
     $database3->setQuery("SELECT * FROM #__k2_categories WHERE id='".$catid."'  ");
     
    $list3 = $database3->loadObjectList();
    
    foreach($list3 as $it3) {
        $cat_alias=$it3->alias;
    }



?>
    

<!--
    -->
    
    
    
    
<?php
//$alias1=str_replace("vse/","",$it2->alias);
//$cat_alias=str_replace("vse","",$cat_alias);
$alias1=$it2->alias;
//$cat_alias=$cat_alias;
$link1=str_replace("//","/","/afishi/".$cat_alias."/".$alias1);
?>  
    
    
    
    
<div class="poster_img tmp34" >
<div class="black_shadow_1">
    
    
</div>    

<div class="poster_img2" style="background-image:url(/media/k2/items/src/<?php echo $hash2;?>.jpg);">
<a href="<?php echo $link1; ?>" style="width:100%; height:100%; display:block;"></a>
</div>
</div>
 

<script type="text/javascript">
var $j2 = jQuery.noConflict();
    var temp_width=$j2(".poster_img").css("width");
    //alert(temp_width);
    //var temp_height=temp_width*2;
    
     $j2(".poster_img").css({"height" : "calc("+temp_width+" * 1)"});
    
    
</script>




<?php
}
?>


  
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <?php
    
    
    
    
    
   // }
    
    
}






}


?>






















</div>







</div>




<div id="sbox-overlay" class="overlay_desc" aria-hidden="false" tabindex="-1" style="z-index: 65555; opacity: 0.7; width: 100%; height: 100%; 
display:none; position:fixed;" onclick="hide_overlay();">
    
    
    
    
    
</div>


<div id="sbox-window"  role="dialog" aria-hidden="false" class="shadow desc_modal" style="z-index: 65557;  width:600px; height: auto; display:none; left:50%; margin-left:-300px; top:30px;">
        <div id="sbox-content" style="opacity: 1; padding-top:5px; padding-bottom:5px; padding-left:10px; padding-right:10px;" class="sbox-content-image" >
        
        <?php echo $this->item->introtext;
        ?>
        </div>
        
    </div>

<script type="text/javascript">
    function hide_overlay(){
    var $j2 = jQuery.noConflict();
  
    
     $j2(".overlay_desc").css({"display" : "none"});
     
    $j2(".desc_modal").css({"display" : "none"});
    
   
    }
</script>

<style type="text/css">
    .shadow.desc_modal p{
        padding-top:0px;
        margin-top:0px;
    }
    #djslider-loader125{
        display:none !important;
    }
    
    
</style>


<script type="text/javascript">
var $j2 = jQuery.noConflict();
$j2(window).resize(function(){


  var h1=$j2(".poster_detail span.itemImage img").css("height");
 $j2(".poster_detail #k2Container").css({"height" : "calc("+h1+" + 20px)"});
    
    
});

$j2(document).ready(function(){


//var item_height=$j2(".poster_img").offsetWidth();


//alert(item_height);
//var h1=$j2(".poster_detail div.itemImageBlock").height();
//alert(h1);
// $j2(".poster_detail #k2Container").css({"height" : "calc("+h1+" + 10px)"});
});

</script>


<script type="text/javascript">

//var $j2 = jQuery.noConflict();

//$j2(document).ready(function(){

//alert("123");

////alert($j2);
//$j2(".poster_detail .poster_img2").css({"height" : ""+item_height+""});

//poster_img2
//});

</script>









<script type="text/javascript">
var $j2 = jQuery.noConflict();
$j2('body').scroll(function(){
    
var t=$j2(".jspPane").css('top');
t=t.replace("-","");
t=t.replace("px","");

if(t>3){

    $j2(".calendar_top").css({"position" : "fixed"});
    $j2(".calendar_top").css({"top" : "0px"});
    $j2(".calendar_top").css({"padding-right" : "157px"});
    $j2(".calendar_top").css({"z-index" : "10"});
    $j2(".calendar_top").css({"width" : "100%"});
      
    
}else{
    $j2(".calendar_top").css({"position" : "static"});
    $j2(".calendar_top").css({"padding-right" : "0px"});
    $j2(".calendar_top").css({"z-index" : "10"});
    $j2(".calendar_top").css({"top" : "0px"});
}
    
    
});
</script>


<style type="text/css">
.center{
padding-top:0px;	
}

</style>


<script type='text/javascript' src='/js/resize_window.js'></script>

