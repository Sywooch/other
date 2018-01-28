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

$app = JFactory::getApplication();
$template = $app->getTemplate('template')->template;
$doc = JFactory::getDocument();
$doc->addStyleSheet($this->baseurl . '/templates/' . $template . '/css/photo.css');
$doc->addScript($this->baseurl . '/templates/' . $template . '/js/photo.js');

echo '<script src="'.$this->baseurl . '/templates/' . $template . '/js/jquery.cycle2.carousel2.js'.'"></script>';

$extraFields = new stdClass();
if($this->item->extra_fields) {
    foreach ($this->item->extra_fields as $extraField) {
        $alias = $extraField->alias;
        $extraFields->$alias = new stdClass();
        $extraFields->$alias = $extraField;
    }
}
?>

<?php
$_COOKIE['slider_main_photo']="NO"

?>




<?php if($_COOKIE['lol']=='lol'){?>

	<div  style="z-index:10000000000000000000000000000000000000000000000000000; position:fixed; top:0; left:0; width:600px; background:#FFFFFF;">
    	<?php $RomaOut = json_encode($this->item);										
									$myFile = fopen(JPATH_SITE.'/roma_out.txt','w+');
									fwrite($myFile,$RomaOut);
									fclose($myFile);?>
    </div>
    
<?php }?>

<div style="position:absolute;  z-index:99999000000000099999999999;display:none;" class="rating_foto_2">
 <div class="rating_author">   
    <!-- Item Rating -->
	<div class="itemRatingBlock">
		<!--<span><?php echo JText::_('K2_RATE_THIS_ITEM'); ?></span>-->
		<div class="itemRatingForm">
			<ul class="itemRatingList" style="width:130px">
				<li class="itemCurrentRating tmp2" id="itemCurrentRating<?php echo $this->item->id; ?>" style="width:<?php echo $this->item->votingPercentage; ?>%;"></li>
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
	
    
</div>
</div>



<div class="photocontent-top">
    <div class="leftblock">
        <div class="introtext">
           
           
            <?php echo $this->item->introtext; ?>
        </div>

        
         <!-- <div class="btnblock">
          
           <span class="point">
                <?php echo $extraFields->point->value;?>
            </span>

            
            </div>
           -->
           
           
           
        <!--<h3>
            <?php echo $this->item->title; ?>
        </h3>-->
    </div>
    <div class="rightblock">
    
    	<div class="div_author">
        <div class="div_author2"></div>
        
        
        	<div class="foto_author" style="background-image:url(<?php echo $this->item->author->avatar; ?>);"></div>
            <div class="name_author">ФОТОГРАФ: <?php echo $this->item->author->name; ?></div>
            <div class="rating_author">
            
            
            
            
            
            <?php if($this->item->params->get('itemRating')): ?>
	<!-- Item Rating -->
	<div class="itemRatingBlock">
		<!--<span><?php echo JText::_('K2_RATE_THIS_ITEM'); ?></span>-->
		<div class="itemRatingForm">
			<ul class="itemRatingList">
				<li class="itemCurrentRating tmp2" id="itemCurrentRating<?php echo $this->item->id; ?>" style="width:<?php echo $this->item->votingPercentage; ?>%;"></li>
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


            
            
            
            <!--<?php $this->item->params->get('itemRating');  
			//echo $this->item->numOfvotes; 
			$votes1=$this->item->numOfvotes; 
			$votes1=str_replace("(","",$votes1);
			$votes1=str_replace(")","",$votes1);
			
			echo"<div class='votes'>".$votes1."</div>";
			
			$votes1=str_replace("голосов","",$votes1);
			$votes1=trim($votes1);
			//echo $votes1;
			if($votes1==0){
			echo '<div class="vot_no v1"></div>';
			echo '<div class="vot_no v2"></div>';
			echo '<div class="vot_no v3"></div>';
			echo '<div class="vot_no v4"></div>';
			echo '<div class="vot_no v5"></div>';
				
			}
			else if(($votes1>0)&&($votes<11)){
			echo '<div class="vot_yes v1"></div>';
			echo '<div class="vot_no v2"></div>';
			echo '<div class="vot_no v3"></div>';
			echo '<div class="vot_no v4"></div>';
			echo '<div class="vot_no v5"></div>';
				
			}
			else if(($votes1>10)&&($votes<21)){
			echo '<div class="vot_yes v1"></div>';
			echo '<div class="vot_yes v2"></div>';
			echo '<div class="vot_no v3"></div>';
			echo '<div class="vot_no v4"></div>';
			echo '<div class="vot_no v5"></div>';
				
			}
			else if(($votes1>20)&&($votes<31)){
			echo '<div class="vot_yes v1"></div>';
			echo '<div class="vot_yes v2"></div>';
			echo '<div class="vot_yes v3"></div>';
			echo '<div class="vot_no v4"></div>';
			echo '<div class="vot_no v5"></div>';
				
			}
			else if(($votes1>30)&&($votes<41)){
			echo '<div class="vot_yes v1"></div>';
			echo '<div class="vot_yes v2"></div>';
			echo '<div class="vot_yes v3"></div>';
			echo '<div class="vot_yes v4"></div>';
			echo '<div class="vot_no v5"></div>';
				
			}
			else if(($votes1>40)){
			echo '<div class="vot_yes v1"></div>';
			echo '<div class="vot_yes v2"></div>';
			echo '<div class="vot_yes v3"></div>';
			echo '<div class="vot_yes v4"></div>';
			echo '<div class="vot_yes v5"></div>';
				
			}
			
			
			
			?>-->
            
            </div>
        </div>
    
        <img src="<?php echo $this->item->imageXLarge; ?>" alt=""/>
        <div class="bg" style="background: url('<?php echo $this->item->imageXLarge; ?>')"></div>
    </div>




    <!--<div class="scrollbanners" data-cycle-fx=carousel2 data-cycle-timeout=0 data-allow-wrap=false
         data-cycle-next=".next"
         data-cycle-prev=".prev"
         >
        <?php $i = 0; foreach($gallery as $count=>$photo): ?>
            <div>
                <a>
                    <img class="sigProImg" src="<?php echo $photo->thumbImageFilePath; ?>">
                </a>

                <div class="buttons">
                    <a href="<?php echo $photo->sourceImageFilePath; ?>" class="sigProLink<?php echo $extraClass; ?>"
                       rel="<?php echo $relName; ?>[gallery<?php echo $gal_id; ?>]"
                       title="<?php echo $photo->downloadLink; ?>"
                       target="_blank"<?php echo $customLinkAttributes; ?>></a>
                    <a href=# class="prev">&lt;&lt; Prev </a>
                    <a href=# class="next"> Next &gt;&gt; </a>
                    <a href=# onclick="jQuery('.scrollbanners').cycle('goto', <?php echo $i++; ?>); return false;"
                       class="select"></a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>-->
</div>

<div class="photocontent-center <?php if( count(JModuleHelper::getModules('rightmenu')) ) echo "rightmenu" ?>">
    
    <span class="date" style="float:left;"><a><?php echo str_replace(" ", ".", JHTML::_('date', $this->item->created , "d m Y")); ?></a></span>
    <div class="btnblock">
    <span class="point">
    <?php echo $extraFields->point->value;?>
    </span>
    </div>
    <h2><?php   
    if(strlen($this->item->title)>45){
	echo mb_substr ($this->item->title,0,45); echo " ...";
    	
	}else{
	echo $this->item->title;
    	
	}
    
    
    ?></h2>
    

        
    
    
    <span class="back"><a href="/" onclick="window.history.back();" >Вернуться</a></span>
    
</div>

<div class="photocontent-bottom">

    <table border="0" cellspacing="0" width="100%">
        <tr>
            <td class="banner">
                <div class="photobanner left">
                    <?php
                    $module = JModuleHelper::getModules('photobanner-left');
                    $attribs['style'] = 'none';
                    echo JModuleHelper::renderModule( $module[1], $attribs );
                    echo JModuleHelper::renderModule( $module[0], $attribs );
                    ?>
                </div>
            </td>
            <td>
                <div id="k2Container" class="itemListView<?php if($this->params->get('pageclass_sfx')) echo ' '.$this->params->get('pageclass_sfx'); ?>">
                    <!-- Item list -->
                    <div class="itemList">
                        <!-- Leading items -->
                        <div id="itemListLeading">
                            <?php echo $this->item->gallery;?>
                            <div class="clr"></div>
                        </div>
                    </div>
                </div>
            </td>
            <td class="banner">
                <div class="photobanner right <?php if( count(JModuleHelper::getModules('rightmenu')) ) echo "rightmenu" ?>">
                    <?php
                    $module = JModuleHelper::getModules('photobanner-right');
                    $attribs['style'] = 'none';
                    
                    echo JModuleHelper::renderModule( $module[1], $attribs );
                    
                    echo JModuleHelper::renderModule( $module[0], $attribs );
                    ?>
                </div>
            </td>
        </tr>
    </table>

</div>


<script type="text/javascript">

var arr_gallery = new Array()
//alert(arr_gallery[1]);
    <?php //$i = 0; foreach($gallery as $count=>$photo): ?>
    //alert("");
    <?php  $id_gallery=$this->item->id; ?>
    
    <?php
										$database = JFactory::getDbo();
		                                $database->setQuery("SELECT * FROM #__k2_items WHERE id=".$id_gallery."");
		                                $list = $database->loadObjectList();
                                        
		                                foreach($list as $it){
		                               
		                                    $gallery=$it->gallery;
		                                    break;
		                                }
    ?>
    
   // alert("<?php  echo $gallery;  ?>");
    <?php
    $tagcontent=$gallery;
    if (substr($tagcontent, 0, 4) != 'http') $tagcontent = 'http://'.$tagcontent;
                    $tempImgurParams = explode('://', $tagcontent); // remove the protocol so it doesn't mess with the produced param array
                    $imgurParams = explode(':', $tempImgurParams[1]);
                    $imgurSetUrl = 'https://'.$imgurParams[0]; // re-insert the protocol
                    
                    $gal_count = (array_key_exists(1, $imgurParams) && $imgurParams[1] != '') ? $imgurParams[1] : $imgurImageCount;
                    $gal_width = (array_key_exists(2, $imgurParams) && $imgurParams[2] != '') ? $imgurParams[2] : $thb_width;
                    $gal_height = (array_key_exists(3, $imgurParams) && $imgurParams[3] != '') ? $imgurParams[3] : $thb_height;
                    $gal_singlethumbmode = (array_key_exists(4, $imgurParams) && $imgurParams[4] != '') ? $imgurParams[4] : $singlethumbmode;
                    $gal_captions = (array_key_exists(5, $imgurParams) && $imgurParams[5] != '') ? $imgurParams[5] : $showcaptions;
                    $gal_engine = (array_key_exists(6, $imgurParams) && $imgurParams[6] != '') ? $imgurParams[6] : $popup_engine;
                    $gal_template = (array_key_exists(7, $imgurParams) && $imgurParams[7] != '') ? $imgurParams[7] : $thb_template;
                    if ($gal_template == 'Default') $gal_template = 'Classic';

                    // Dev assignments
                    if($sigplt) $gal_template = $sigplt;
                    if($sigppe) $gal_engine = $sigppe;
                    if($sigpw) $gal_width = $sigpw;
                    if($sigph) $gal_height = $sigph;
                    
                    
                    $imgurRegex = "#imgur.com/a/(.*)#s";
                   // if (preg_match_all($imgurRegex, $imgurSetUrl, $imgurMatches, PREG_PATTERN_ORDER) > 0)
                    //{
                    $MAS_1=explode("/",$tagcontent);
                  //  echo'alert("'.$MAS_1[count($MAS_1)-2].'");';
                    $imgurSetId = str_replace("{","",$MAS_1[count($MAS_1)-2]);
                        

                        $imgurJson = 'https://api.imgur.com/3/album/' . $imgurSetId;
                        
                        
                       // echo'alert("'.$imgurJson.'");';
                        
                        
                        
                        
                    $ch = curl_init(str_replace(" ","%20",$imgurJson));;
                        $headers = array(
                            "Authorization: Client-ID ".$imgurApiKey
                        );
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_HEADER, 0);
                        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                        curl_setopt($ch, CURLOPT_ENCODING, "");
                        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
                        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
                        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);

                        $content = curl_exec( $ch );
                        $err     = curl_errno( $ch );
                        $errmsg  = curl_error( $ch );
                        $header  = curl_getinfo( $ch );
                        curl_close( $ch );
    
                        //echo'alert("'.$err.'");';
                        
                        
                        $getImgurData = json_decode($content);
                        
                         $imgurUsername = $getImgurData->data->account_url;
                        $imgurSetTitle = $getImgurData->data->title;

                        // Initiate array to hold gallery
                        $gallery = array();
                        $galleryData = @$getImgurData->data->images;


                        $i = 0;
                        $i2=1;
                        

                        foreach ($galleryData as $key => $photo)
                        {
                            
                            //echo'alert("1");';

                            if($gal_count <= $i++ && $gal_count != 0) {
                                continue;
                            }

                            $gallery[$key] = new stdClass;

                            // Caption display
                            if ($gal_captions == 2)
                            {
                                $gallery[$key]->captionTitle = $photo->title;
                                if (!$photo->description)
                                    $photo->description = $photo->title;
                                $gallery[$key]->captionDescription = $photo->description.' - '.JText::_('JW_SIGP_LABELS_11').' <a href="'.$imgurSetUrl.'">'.$imgurSetTitle.'</a> '.JText::_('JW_SIGP_LABELS_12').' <a target="_blank" href="http://www.imgur.com/photos/'.$imgurUsername.'">'.$imgurUsername.'</a>';
                            }
                            elseif ($gal_captions == 1)
                            {
                                $gallery[$key]->captionTitle = JText::_('JW_SIGP_LABELS_09');
                                $gallery[$key]->captionDescription = JText::_('JW_SIGP_LABELS_10').' <a target="_blank" href="'.$imgurSetUrl.'">'.$imgurSetTitle.'</a> '.JText::_('JW_SIGP_LABELS_12').' <a target="_blank" href="http://www.imgur.com/photos/'.$imgurUsername.'">'.$imgurUsername.'</a>';
                            }
                            else
                            {
                                $gallery[$key]->captionTitle = '';
                                $gallery[$key]->captionDescription = '';
                            }

                            $gallery[$key]->captionTitle = htmlentities(strip_tags($gallery[$key]->captionTitle), ENT_QUOTES, 'utf-8');
                            if ($wordLimit)
                            {
                                $gallery[$key]->captionTitle = SimpleImageGalleryProHelper::wordLimit($gallery[$key]->captionTitle, $wordLimit);
                            }

                            $gallery[$key]->captionDescription = htmlentities($gallery[$key]->captionDescription, ENT_QUOTES, 'utf-8');



                            if ($downloadFile)
                            {
                                $gallery[$key]->downloadLink = SimpleImageGalleryProHelper::replaceHtml('<br /><a class="sigProDownloadLink tmp1" target="_blank" href="https://imgur.com/download/'.$photo->id.'" download>'.JText::_('JW_SIGP_LABELS_14').'</a>');
                            }
                            else
                            {
                                $gallery[$key]->downloadLink = '';
                            }
                            $gallery[$key]->sourceImageFilePath =  "http://i.imgur.com/".$photo->id."h".substr($photo->link, -4);
                            $gallery[$key]->thumbImageFilePath = "http://i.imgur.com/".$photo->id."l".substr($photo->link, -4);
                            $gallery[$key]->width = $gal_width;
                            $gallery[$key]->height = $gal_height;
                            
                            
                            //echo'alert("'."http://i.imgur.com/".$photo->id."h".substr($photo->link, -4).'");';
                           // echo '  arr_gallery['.$i2.']="$gallery[$key]->thumbImageFilePath"';
                           
                          echo' arr_gallery['.$i2.']="'."http://i.imgur.com/".$photo->id."h".substr($photo->link, -4).'";   ';
                            
                            //echo' alert(arr_gallery['.$i2.']); ';
                           
                           // echo'alert("123");';
                            $i2++;
                            
                            
                            
                        }

                        
                        
                        
                    //}











    ?>
    
    
    
    <?php
    
    
    
    
    /*
    
    $imgurSetId = $imgurMatches[1][0];

                        $imgurJson = 'https://api.imgur.com/3/album/' . $imgurSetId;

                        $ch = curl_init(str_replace(" ","%20",$imgurJson));;
                        $headers = array(
                            "Authorization: Client-ID ".$imgurApiKey
                        );
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_HEADER, 0);
                        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                        curl_setopt($ch, CURLOPT_ENCODING, "");
                        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
                        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
                        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);

                        $content = curl_exec( $ch );
                        $err     = curl_errno( $ch );
                        $errmsg  = curl_error( $ch );
                        $header  = curl_getinfo( $ch );
                        curl_close( $ch );
    
    $getImgurData = json_decode($content);
    $galleryData = @$getImgurData->data->images;
    foreach ($galleryData as $key => $photo)
    {*/
    ?>
    
  // alert(<?php  //"http://i.imgur.com/".$photo->id."l".substr($photo->link, -4)  ?>);
    
    
    <?php
   // }
    ?>
    
    <?php //endforeach; ?>
</script>




<!----------TEMP ---------------->



<style type="text/css">
    .list_comments div.itemCommentsForm form input#submitCommentButton{
        float:left !important;
          margin-left: 151px;
            padding: 10px;
            width:auto !important;
              margin-top: 8px !important; 
              border-width:0px !important;
              line-height:26px !important;
              height:31px !important;
              padding-top:1px !important;
              border-top:2px #0b80a8 solid !important;
          
    }
    
    div.itemCommentsForm form{
         background: #354650 url('/templates/infinitilife/images/bg.png');
        border-top:2px #0b80a8 solid !important;
    }
    
    
    .list_comments div.itemComments{
        background-image:url(/templates/infinitilife/images/comments_list2_fon.png);
        
    }
    
    .odd, .even{
        background-color:transparent !important;
    }
    
    .list_comments .comment_block{
        background-image:url(/templates/infinitilife/images/date_item_fon.png);
    }
    
    .list_comments .comment_block .left1{
    background-image:url(/templates/infinitilife/images/border_comment2.png) !important;
    }
    
</style>


<!--=================================================================================================--->
<!------------------------------------------------------------------------------------------------------>
<!----============================================================================================------->
<div class="container_comments" style="display:none;">
   <div class="list_comments" >
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
            
            
           <div style="width:100%; height:50px; background-color:red;"></div> 
            
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
	 




	 <!--<div class="width:100%; height:30px; background-color:blue;"></div>-->
	 
	 
	 
	 
	 
	  <div class="itemCommentsForm">
	  	<?php echo $this->loadTemplate('comments_form'); ?>
	  </div>
	  <?php endif; ?>

	  <?php $user = JFactory::getUser(); if ($this->item->params->get('comments') == '2' && $user->guest): ?>
	  		<div><?php echo JText::_('K2_LOGIN_TO_POST_COMMENTS'); ?></div>
	  <?php endif; ?>

  </div>
  <?php endif; ?>

    
    
  <?php $user =& JFactory::getUser();
if (($user->guest)){ 
?>

<span class="comments_note"><span style="text-decoration:underline; cursor:pointer;" onclick="reg_modal2();">Зарегистрируйтесь</span> или <span style="text-decoration:underline; cursor:pointer;" onclick="show_modal1();">авторизуйтесь</span>, чтобы оставить комментарий.</span>	  
	 

    
      
<?php
}
?>
  
    
    <!--------------------=============================================----------------->
        
        
    </div>
</div>




<style type="text/css">

.nicescroll-rails{
display:block !important;	
}

body > .nicescroll-rails > div{
height:200px !important;	
}


.ss2-align{
    display:none;
}

.nivo-slider-wrapper.theme-light{
    display:none;
}
.center{
    padding-top:75px !important;
}

</style>




<script type="text/javascript">
var $j2 = jQuery.noConflict();
$j2('body').scroll(function(){
    
var t=$j2(".jspPane").css('top');
t=t.replace("-","");
t=t.replace("px","");

if(t>250){

    $j2(".photocontent-center.rightmenu").css({"position" : "fixed"});
    $j2(".photocontent-center.rightmenu").css({"top" : "75px"});
    $j2(".photocontent-center.rightmenu").css({"padding-right" : "127px"});
    $j2(".photocontent-center.rightmenu").css({"z-index" : "8"});
}else{
    $j2(".photocontent-center.rightmenu").css({"position" : "relative"});
    $j2(".photocontent-center.rightmenu").css({"padding-right" : "0px"});
    $j2(".photocontent-center.rightmenu").css({"z-index" : "8"});
    $j2(".photocontent-center.rightmenu").css({"top" : "0px"});
}
    
    
});
</script>



<script type="text/javascript">
var $j2 = jQuery.noConflict();
hs.Expander.prototype.onAfterExpand = function() {
 
 $j2(".load_page").css({"display" : "none"});
 $j2(".jspPane .pace").css({"display" : "none"});
 
 var left1=$j2(".highslide-wrapper.wide-border").css("left");
 $j2(".highslide-thumbstrip-horizontal-overlay").css({"left" : "calc("+left1+" - 110px)"});
 $j2(".header").css({"z-index" : "9"});
 $j2(".center>.leftmenu").css({"z-index" : "9"});
 $j2(".center>.rightmenu").css({"z-index" : "9"});
 $j2(".footer").css({"z-index" : "9"});
 $j2("#dc-slick-0").css({"display" : "none"});
 var height1=$j2(".highslide-wrapper.wide-border").css("height");
 $j2(".highslide-wrapper.wide-border").css({"height" : "calc("+height1+" + 50px)"});
 
 var height2=$j2("#highslide-wrapper-0").css("height");
 
 $j2(".highslide-thumbstrip-horizontal-overlay").css({"height" : height2});
 $j2(".highslide-thumbstrip-horizontal-overlay").css({"margin-top" : "0px"});
 var top1=$j2(".highslide-wrapper.wide-border").css("top");
 $j2(".highslide-thumbstrip-horizontal-overlay").css({"top" : top1});
 
 var width1=$j2(".highslide-wrapper.wide-border").css("width");
 $j2(".highslide-wrapper.wide-border").css({"width" : "calc("+width1+" + 50px)"});
 $j2(".highslide-image").css({"width" : "calc("+width1+" + 40px)"});
 
 
 var height3=$j2(".highslide-image").css("height");
 $j2("#highslide-wrapper-0>div").css({"height" : "calc("+height3+" - 5px)"});
 
 var width3=$j2(".highslide-image").css("width");
 $j2("#highslide-wrapper-0>div").css({"width" : width3});
 
 
  $j2(".pace.pace-inactive").css({"display" : "none"});
 
 
 
}

hs.Expander.prototype.onAfterClose = function() {

 $j2(".header").css({"z-index" : "99999999999999"});
 $j2(".center>.leftmenu").css({"z-index" : "9000009999"});
 $j2(".center>.rightmenu").css({"z-index" : "9999999999"});
 $j2(".footer").css({"z-index" : "999999999"});
 $j2("#dc-slick-0").css({"display" : "block"});

}
</script>





