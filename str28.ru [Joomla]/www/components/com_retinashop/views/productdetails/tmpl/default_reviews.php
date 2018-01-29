<?php
/**
 *
 * Show the product details page
 *
 * @package	Magazin
 * @subpackage
 * @author Max Milbers, Valerie Isaksen
 * @link http://www.retinashop.net
 * 
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * 
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default_reviews.php 5671 2012-03-15 13:06:26Z Milbo $
 */

// Check to ensure this file is included in Retina
defined ( '_REXEC' ) or die ( 'Restricted access' );


// Customer Reviews
	if($this->allowRating || $this->showReview) {
		$maxrating = rsConfig::get('rs_maximum_rating_scale',5);
		$ratingsShow = rsConfig::get('rs_num_ratings_show',3); // TODO add  rs_num_ratings_show in rsConfig
		//$starsPath = JURI::root().rsConfig::get('retina_097115115101116115_general_path').'images/stars/';
		$stars = array();
		$showall = JRequest::getBool('showall', false);
		$ratingWidth = $maxrating*24;
		for ($num=0 ; $num <= $maxrating; $num++  ) {
			$stars[]='
				<span title="'.(RText::_("COM_RETINASHOP_RATING_TITLE") . $num . '/' . $maxrating).'" class="rsicon ratingbox" style="display:inline-block;width:'. 24 * $maxrating .'px;">
					<span class="stars-orange" style="width:'. (24 * $num).'px">
					</span>
				</span>';
		} ?>


					
					

	<div class="customer-reviews">
		<form method="post" action="<?php echo JRoute::_('index.php?option=com_retinashop&view=productdetails&retinashop_product_id='.$this->product->retinashop_product_id.'&retinashop_category_id='.$this->product->retinashop_category_id) ; ?>" name="reviewForm" id="reviewform">
	<?php
	}

	if($this->showReview) {

		?>
		<h4><?php echo RText::_('COM_RETINASHOP_REVIEWS') ?></h4>

		<div class="list-reviews">
			<?php
			$i=0;
			$review_editable=true;
			$reviews_published=0;
			if ($this->rating_reviews) {
				foreach($this->rating_reviews as $review ) {
					if ($i % 2 == 0) {
						$color = 'normal';
					} else {
						$color = 'highlight';
					}

					/* Check if user already commented */
	 				// if ($review->retinashop_userid == $this->user->id ) {
					if ($review->created_by == $this->user->id && !$review->review_editable) {
	 					$review_editable = false;
	 				}
					?>

					<?php // Loop through all reviews
					if (!empty($this->rating_reviews) && $review->published) {
					    $reviews_published++;
					    ?>
					<div class="<?php echo $color ?>">
						<span class="date"><?php echo JHTML::date($review->created_on, RText::_('DATE_FORMAT_LC')); ?></span>
						<span class="vote"><?php echo $stars[$review->vote] ?></span>
						<blockquote><?php echo $review->comment; ?></blockquote>
						<span class="bold"><?php echo $review->customer ?></span>
					</div>
					<?php
					}
					$i++ ;
					if ( $i == $ratingsShow && !$showall) {
						/* Show all reviews ? */
						if ( $reviews_published >= $ratingsShow ) {
							$attribute = array('class'=>'details', 'title'=>RText::_('COM_RETINASHOP_MORE_REVIEWS'));
							echo JHTML::link($this->more_reviews, RText::_('COM_RETINASHOP_MORE_REVIEWS'),$attribute);
						}
						break;
					}
				}

			} else {
				// "There are no reviews for this product" ?>
				<span class="step"><?php echo RText::_('COM_RETINASHOP_NO_REVIEWS') ?></span>
			<?php
			}  ?>
		<div class="clear"></div>
		</div>

		<?php // Writing A Review
		if($this->allowReview ) { ?>
		<div class="write-reviews">

			<?php // Show Review Length While Your Are Writing
			$reviewJavascript = "
			function check_reviewform() {
				var form = document.getElementById('reviewform');

				var ausgewaehlt = false;

				// for (var i=0; i<form.vote.length; i++) {
					// if (form.vote[i].checked) {
						// ausgewaehlt = true;
					// }
				// }
					// if (!ausgewaehlt)  {
						// alert('".RText::_('COM_RETINASHOP_REVIEW_ERR_RATE',false)."');
						// return false;
					// }
					//else 
					if (form.comment.value.length < ". rsConfig::get('reviews_minimum_comment_length', 100).") {
						alert('". addslashes( RText::sprintf('COM_RETINASHOP_REVIEW_ERR_COMMENT1_JS', rsConfig::get('reviews_minimum_comment_length', 100)) )."');
						return false;
					}
					else if (form.comment.value.length > ". rsConfig::get('reviews_maximum_comment_length', 2000).") {
						alert('". addslashes( RText::sprintf('COM_RETINASHOP_REVIEW_ERR_COMMENT2_JS', rsConfig::get('reviews_maximum_comment_length', 2000)) )."');
						return false;
					}
					else {
						return true;
					}
				}

				function refresh_counter() {
					var form = document.getElementById('reviewform');
					form.counter.value= form.comment.value.length;
				}
				jQuery(function($) {
					var steps = ".$maxrating.";
					var parentPos= $('.write-reviews .ratingbox').position();
					var boxWidth = $('.write-reviews .ratingbox').width();// nbr of total pixels
					var starSize = (boxWidth/steps);
					var ratingboxPos= $('.write-reviews .ratingbox').offset();
					
					$('.write-reviews .ratingbox').mousemove( function(e){
						var span = $(this).children();
						var dif = e.pageX-ratingboxPos.left; // nbr of pixels
						difRatio = Math.floor(dif/boxWidth* steps )+1; //step
						span.width(difRatio*starSize);
						$('#vote').val(difRatio);
						//console.log('note = ', difRatio);
					});
				});
				
				
				";
			$document = JFactory::getDocument();
			$document->addScriptDeclaration($reviewJavascript);

			if($this->showRating) {
				if($this->allowRating && $review_editable) { ?>
					<h4><?php echo RText::_('COM_RETINASHOP_WRITE_REVIEW')  ?><span><?php echo RText::_('COM_RETINASHOP_WRITE_FIRST_REVIEW') ?></span></h4>
					<span class="step"><?php echo RText::_('COM_RETINASHOP_RATING_FIRST_RATE') ?></span>
					<div class="rating">
							<label for="vote"><?php echo $stars[ $maxrating ]; ?></label>
							<input type="hidden" id="vote" value="<?php echo $maxrating ?>" name="vote">
					</div>

					<?php

				}
			}
			if($review_editable ) { ?>
				<span class="step"><?php echo RText::sprintf('COM_RETINASHOP_REVIEW_COMMENT', rsConfig::get('reviews_minimum_comment_length', 100), rsConfig::get('reviews_maximum_comment_length', 2000)); ?></span>
				<br />
				<textarea class="retinashop" title="<?php echo RText::_('COM_RETINASHOP_WRITE_REVIEW') ?>" class="inputbox" id="comment" onblur="refresh_counter();" onfocus="refresh_counter();" onkeyup="refresh_counter();" name="comment" rows="5" cols="60"><?php if(!empty($this->review->comment))echo $this->review->comment; ?></textarea>
				<br />
				<span><?php echo RText::_('COM_RETINASHOP_REVIEW_COUNT') ?>
				<input type="text" value="0" size="4" class="rs-default" name="counter" maxlength="4" readonly="readonly" />
				</span>
				<br /><br />
				<input class="highlight-button" type="submit" onclick="return( check_reviewform());" name="submit_review" title="<?php echo RText::_('COM_RETINASHOP_REVIEW_SUBMIT')  ?>" value="<?php echo RText::_('COM_RETINASHOP_REVIEW_SUBMIT')  ?>" />
			<?php
			} else {
				echo '<strong>'.RText::_('COM_RETINASHOP_DEAR').$this->user->name.',</strong><br />' ;
				echo RText::_('COM_RETINASHOP_REVIEW_ALREADYDONE');
			}
			?></div><?php
		}
	}

	if($this->allowRating || $this->showReview) {
	?>
			<input type="hidden" name="retinashop_product_id" value="<?php echo $this->product->retinashop_product_id; ?>" />
			<input type="hidden" name="option" value="com_retinashop" />
			<input type="hidden" name="retinashop_category_id" value="<?php echo JRequest::getInt('retinashop_category_id'); ?>" />
			<input type="hidden" name="retinashop_rating_review_id" value="0" />
			<input type="hidden" name="task" value="review" />
		</form>
	</div>
	<?php
	}
