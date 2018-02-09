<?php
/**
 * @package		EasyBlog
 * @copyright	Copyright (C) 2010 Stack Ideas Private Limited. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 *
 * EasyBlog is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

defined('_JEXEC') or die('Restricted access'); ?>

<div class="kmt-mod modKomentoComments kmt-mod-comments<?php echo $params->get( 'moduleclass_sfx' ) ?>">

<?php

$start_com=4;//номер стартового комментария
$end_com=0;//номер конечного комментария

$page=$_GET['page'];
$comments_2=$_GET['comments'];

if( $page==2 ){
$start_com=4;
$end_com=14;
}else{
	for($i=2;$i<$page;$i++){
	$start_com=$start_com+10;
	$end_com=$start_com+10;
	}

}
 

//echo $start_com."<br>";
//echo $end_com."<br>";

$count_comment=1;

?>


	<?php 
	$comments_tmp1=0;
	foreach( $comments as $row ) {
	$comments_tmp1++;
	
	}
	
	$_GET['comments'] = $comments_tmp1;
	//echo $_GET['comments'];
	?>

<?php

$main_count_com=1;
?>
	<?php foreach( $comments as $row ) {
	
if($page==1){  

	if($main_count_com==4){ break;}
	$main_count_com++;

 }else{
	
	if($count_comment<$start_com){ $count_comment++; continue; };
	if($count_comment>$end_com-1){ $count_comment++; break; };
	//echo $start_com."<br>";
	//echo $end_com."<br>";
	//echo $count_comment."<br>";
	$count_comment++;
	
	
	}
	
		// initialise current row component
		Komento::setCurrentComponent( $row->component );
		$config = Komento::getConfig();

		$row = Komento::getHelper( 'comment' )->process( $row );

		$row->comment = strip_tags( $row->comment );

		// trim comment length
		if( JString::strlen( $row->comment ) > $params->get( 'maxcommentlength' ) )
		{
			$row->comment = JString::substr( $row->comment, 0, $params->get( 'maxcommentlength' ) ) . '...';
		}

		// trim title length
		if( JString::strlen( $row->contenttitle ) > $params->get( 'maxtitlelength' ) )
		{
			$row->contenttitle = JString::substr( $row->contenttitle, 0, $params->get( 'maxtitlelength' ) ) . '...';
		}
	?>
    
    
    <table width="100%" border="0" style="box-shadow: 0 0 10px rgba(0,0,0,0.5);">

		<tr>
    	<td style="padding:10px; color:#767676; border-bottom: rgb(205, 206, 207) 1px solid;">
        Имя: <?php  $mas_name_tmp=explode("(", $row->name); 
		//  echo $row->name;  
		  $mas_name_tmp[1]=str_replace(")","",$mas_name_tmp[1]);  
		   echo $mas_name_tmp[1];
		  
		  ?>
        <br>Дата комментария: <?php  echo $row->created; 
		/*
		$date_1=str_replace("hour ago","",$row->created);
		$date_1=str_replace("hour","",$date_1);
		$date_1=str_replace("hours","",$date_1);
		$date_1=str_replace("ago","",$date_1);
		$date_1=str_replace("s","",$date_1); 
		$date_1=str_replace("about","",$date_1);
		$date_1=str_replace("day","",$date_1);
		$date_1=trim($date_1);
		//echo $date_1; echo" === ";
		
		//echo" - ";
		$date_2=str_replace("ago","",$row->created);
		$date_2=trim($date_2);
		//echo $date_2; echo" === ";
		
		
		$date = date('Y-m-d H:i:s'); //echo " = ".$date." = ";
		//echo"--".strtotime($date)."--";
		//echo"--".strtotime("-".$date_1, strtotime($date))."--";
		
		$pos = strrpos($row->created, "day");
		if ($pos === false) { 
			$new_date = date('d.m.Y H:i:s', strtotime("-".$date_1, strtotime($date)));
		}else{
		//	$date_1=$date_1*24; 
			//echo $date_1;
			$new_date = date('d.m.Y H:i:s', strtotime("-".$date_1." days", strtotime($date)));
			
			//$date = '2011-09-24';
			//$time = strtotime('-20 days', strtotime($date));
			//echo date('Y-m-j', $time);

		}
		
	
		//echo " = ".$new_date." = ";
		//echo $new_date;
		$new_date=substr($new_date, 0, 10); 
		echo $new_date;
		*/
		?></td>
  		</tr>
  		<tr>
    	<td style="text-align:justify; padding:10px;"><?php echo $row->comment; ?></td>
  		</tr>

    </table>
	<p>&nbsp;</p>
    




<!---------------------------->
		<div class="mod-item <?php echo 'kmt-' . $row->id; ?>" style="display:none">

			<?php if( $params->get( 'showavatar') || $params->get( 'showauthor') ){ ?>
			<div class="mod-comment-head clearfix">
				<i></i>

				<!-- Avatar -->
				<?php if( $params->get( 'showavatar' ) ){ ?>
				<div class="mod-avatar">
					<?php if( !Komento::getProfile( $row->created_by )->guest ) { ?>
						<a href="<?php echo Komento::getProfile( $row->created_by )->getProfileLink(); ?>">
					<?php } ?>
					<img src="<?php echo Komento::getProfile( $row->created_by )->getAvatar( $row->email ); ?>" class="avatar" width="30" />
					<?php if( !Komento::getProfile( $row->created_by )->guest ) { ?>
						</a>
					<?php } ?>
				</div>
				<?php } ?>

				<!-- Author -->
				<?php if( $params->get( 'showauthor' ) ){ ?>
					<?php if( $config->get( 'layout_avatar_integration' ) == 'gravatar' && !empty($row->url) ) { ?>
						<span class="kmt-author">
							<a href="<?php echo $row->url; ?>" target="_blank"><b><?php echo $row->name; ?></b></a>
						</span>
					<?php } else { ?>
						<span class="kmt-author">
							<?php if( !$row->author->guest ) { ?>
								<a href="<?php echo $row->author->getProfileLink(); ?>">
							<?php } ?>
								<b><?php echo $row->name; ?></b>
							<?php if( !$row->author->guest ) { ?>
								</a>
							<?php } ?>
						</span>
					<?php } ?>
				<?php } ?>
			</div>
			<?php } ?>

			<!-- Text -->
			<div class="mod-comment-text">
				<?php echo $row->comment; ?>

				<!-- Title -->
				<?php if( $params->get( 'showtitle' ) ) { ?>
				<div class="mod-comment-page">
					<?php if( $row->extension ) { ?>
						<a href="<?php echo $row->pagelink; ?>"><?php echo $row->contenttitle; ?></a><?php echo $params->get( 'showcomponent' ) ? ' ' . JText::sprintf( 'COM_KOMENTO_TITLE_IN_COMPONENT', $row->componenttitle ) : ''; ?>
					<?php } else { ?>
						<?php echo $row->contenttitle; ?>
					<?php } ?>
				</div>
				<?php } ?>
			</div>

			<div class="mod-comment-meta small">
				<!-- Time and Permalink -->
				<span class="mod-comment-time">
					<a class="mod-comment-permalink" href="<?php echo $row->permalink; ?>" alt="<?php echo JText::_( 'COM_KOMENTO_COMMENT_PERMANENT_LINK' ); ?>" title="<?php echo JText::_( 'COM_KOMENTO_COMMENT_PERMANENT_LINK' ); ?>"><?php echo $row->created; ?></a>
				</span>
			</div>

		</div>
 
<!---------------------------->      
        
        
        
        
	<?php } ?>
</div>



<?php
					$count_comments2=$_GET['comments'];
					$count_comments3=$count_comments2;
					?>

<?php
if($_GET['page']=="1"){

?>


                	<table width="100%" border="0" class="comments_buttons" style="margin-bottom:10px;">

  					<tr>

    				<td align="center" style="color:#494949; text-align:center;">&lt;
                    <strong>
                    <a href="/?page=1&comments=<?php echo $count_comments3; ?>">1</a>
                    </strong>
        			<?php  $count_comments2=$count_comments2-3; ?>
        			<?php 
					if($count_comments2<=10){
					
					echo " | <a href='/?page=2&comments=".$count_comments3."'>2</a>";
					
					}else{
					
					$count1=$count_comments2/10; 
					
					
					for($i=2;$i<=$count1+1;$i++){
						
						echo " | <a href='/?page=".$i."&comments=".$count_comments3."'>".$i."</a>";
						
					}
        
					}
					?>
       				 &gt;
        			<?php //echo $count_comments; ?>
        			</td>

  					</tr>

					</table>

<?php
}else{
?>
                    
<table width="100%" border="0" class="comments_buttons">

  					<tr>

    				<td align="center" style="color:#494949; text-align:center;">&lt;
                    <a href="/?page=1&comments=<?php echo $count_comments3; ?>">1</a>
        			<?php  $count_comments2=$count_comments2-3; ?>
        			<?php 
					if($count_comments2<=10){
					echo"<strong>";
					echo " | <a href='/?page=2&comments=".$count_comments3."'>2</a>";
					echo"</strong>";
					}else{
					
					$count1=$count_comments2/10; 
					
					
					for($i=2;$i<=$count1+1;$i++){
						if($_GET['page']==$i){
						echo"<strong>";
						}
						echo " | <a href='/?page=".$i."&comments=".$count_comments3."'>".$i."</a>";
						if($_GET['page']==$i){
						echo"</strong>";
						}
					}
        
					}
					?>
       				 &gt;
        			<?php //echo $count_comments; ?>
        			</td>

  					</tr>

					</table>
                
     
     
<?php
}
?>               
                    
