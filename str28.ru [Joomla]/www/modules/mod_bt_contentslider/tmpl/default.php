<?php

// no direct access 2
defined('_REXEC') or die('Restricted access');

?>

<?php if(count($list)>0) :?>
<div style="width:<?php echo $moduleWidthWrapper;?>">

	<div id="btcontentslider<?php echo $module->id; ?>" style="display:none" class="bt-cs<?php echo $moduleclass_sfx? ' bt-cs'.$params->get('moduleclass_sfx'):'';?>">
		<?php if( $next_back && $totalPages  > 1  ) : ?>
		<a class="next" href="#">Next</a> <a class="prev" href="#">Prev</a>
		<?php endif; ?>
		<?php 
			$add_style = "";
			if( trim($params->get('content_title')) ){
			$add_style= "border: 1px solid #CFCFCF;padding:10px 0px;";
		?>
		<h3>
			<span><?php echo $params->get('content_title') ?> </span>
		</h3>
		<?php } ?>
		<div class="slides_container" style="width:<?php echo $moduleWidth.";".$add_style;?>">

		<?php foreach( $pages as $key => $list ): ?>

			<div class="slide" style="width:<?php echo $moduleWidth;?>">

			<?php foreach( $list as $i => $row ): ?>

				<div class="bt-row <?php if($i==0) echo 'bt-row-first'; else if($i==count($list)-1) echo 'bt-row-last' ?>"  style="width:<?php echo $elementWidth;?>%" >

					<div class="bt-inner" style="margin-top:20px !important; ">
					
							<?php if( $row->thumbnail ): ?>
						<div style="text-align:center"><!--изображение-->
						<a target="<?php echo $openTarget; ?>"
							class="bt-image-link"
							title="<?php echo $row->title;?>" href="<?php echo $row->link;?>">
							<img <?php echo $imgClass ?> src="<?php echo $row->thumbnail; ?>" 
							alt="<?php echo $row->title?>"  
							style=" height:<?php echo $thumbHeight ;?>px; width:<?php echo $thumbWidth ;?>px;" title="<?php echo $row->title?>" />
						</a>
						</div><!--изображение-->
						<?php endif ; ?>
						
			


				<?php if( $show_category_name ): ?>
					<?php if($show_category_name_as_link) : ?>
						<a class="bt-category" style="font-size:12pt !important; font-family:'Arial' !important;
						font-color:black !important; " target="<?php echo $openTarget; ?>"
							title="<?php echo $row->category_title; ?>"
							href="<?php echo $row->categoryLink;?>"> <?php echo $row->category_title; ?>
						</a>
						<?php else :?>
						<span class="bt-category" style="font-size:12pt !important; font-family:'Arial' !important;
						font-color:black !important; " > <?php echo $row->category_title; ?> </span>
						<?php endif; ?>
						<?php endif; ?>

						<?php if( $showTitle ): ?>
						<a class="bt-title" style="font-size:12pt !important; font-family:'Arial' !important;
						font-color:black !important; margin-top:40px !important"  target="<?php echo $openTarget; ?>"
							title="<?php echo $row->title; ?>"
							href="<?php echo $row->link;?>"> 
							<span style="font-size:12pt !important; font-family:'Arial' !important;
							font-color:black !important;"> <?php echo $row->title_cut; ?> </span></a>
							<?php endif; ?>		
						
						
						
						
						
						<?php if( $showAuthor || $showDate ): ?>
						<div class="bt-extra">
						<?php if( $showAuthor ): ?>
							<span class="bt-author"><?php 	echo RText::sprintf('BT_CREATEDBY' ,
							JHtml::_('link',JRoute::_($row->authorLink),$row->author)); ?>
							</span>
							<?php endif; ?>
							<?php if( $showDate ): ?>
							<span class="bt-date"><?php echo RText::sprintf('BT_CREATEDON', $row->date); ?>
							</span>
							<?php endif; ?>
						</div>
						<?php endif; ?>

						<?php if( $show_intro ): ?>
						<div class="bt-introtext">
						<?php echo $row->description; ?>
						</div>
						<?php endif; ?>

						<?php if( $showReadmore ) : ?>
						<p class="readmore" style="color:yellow !important; border:0 !important">
							<a style="color:blue !important" 
							target="<?php echo $openTarget; ?>"
								title="<?php echo $row->title;?>"
								href="<?php echo $row->link;?>"> <?php echo RText::_('READ_MORE');?>
							</a>
						</p>
						<?php endif; ?>

					</div>
					<!-- bt-inner -->

				</div>
				<!-- bt-row -->
				<?php
				if($elementsPerCol > 1 && $i < count($list)-1){
					if(($i+1)%$elementsPerRow ==0){
						echo '<div class="bt-row-separate"></div>';
					}
				}
				?>

				<?php endforeach; ?>
				<div style="clear: both;"></div>

			</div>
			<!-- bt-main-element page	-->
			<?php endforeach; ?>

		</div>


	</div>
	<!-- bt-container -->


</div>
			<?php else : ?>
<div>No result...</div>
			<?php endif; ?>
<div style="clear: both;"></div>