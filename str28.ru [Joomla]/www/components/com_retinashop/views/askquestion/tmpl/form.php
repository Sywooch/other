<?php
/**
 *TODO Improve the CSS , ADD CATCHA ?
 * Show the form Ask a Question
 *
 * @package	Magazin
 * @subpackage
 * @author Kohl Patrick
 * @link http://www.retinashop.net
 * 
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * 
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
* @version $Id: default.php 2810 2011-03-02 19:08:24Z Milbo $
 */

// Check to ensure this file is included in Retina
defined ( '_REXEC' ) or die ( 'Restricted access' );
$min = rsConfig::get('asks_minimum_comment_length', 50);
$max = rsConfig::get('asks_maximum_comment_length', 2000) ;
rsJsApi::JvalideForm();
$document = JFactory::getDocument();
// $document->addScript(JURI::root(true).'/components/com_retinashop/retina_097115115101116115/js/jquery.validation.js');
$document->addScriptDeclaration('
	jQuery(function($){
			$("#askform").validationEngine("attach");
			$("#comment").keyup( function () {
				var result = $(this).val();
					$("#counter").val( result.length );
			});
	});
');
/* Let's see if we found the product */
if (empty ( $this->product )) {
	echo RText::_ ( 'COM_RETINASHOP_PRODUCT_NOT_FOUND' );
	echo '<br /><br />  ' . $this->continue_link_html;
} else { ?>

<div class="ask-a-question-view">
	<h1><?php echo RText::_('COM_RETINASHOP_PRODUCT_ASK_QUESTION')  ?></h1>

	<div class="product-summary">
		<div class="width70 floatleft">
			<h2><?php echo $this->product->product_name ?></h2>

			<?php // Product Short Description
			if (!empty($this->product->product_s_desc)) { ?>
				<div class="short-description">
					<?php echo $this->product->product_s_desc ?>
				</div>
			<?php } // Product Short Description END ?>

		</div>

		<div class="width30 floatleft center">
			<?php // Product Image
			echo $this->product->images[0]->displayMediaThumb('class="product-image"',false); ?>
		</div>

	<div class="clear"></div>
	</div>

	<div class="form-field">

		<form method="post" class="form-validate" action="<?php echo JRoute::_('index.php?option=com_retinashop&view=productdetails&retinashop_product_id='.$this->product->retinashop_product_id.'&retinashop_category_id='.$this->product->retinashop_category_id.'&tmpl=component') ; ?>" name="askform" id="askform">

			<label><?php echo RText::_('COM_RETINASHOP_USER_FORM_NAME')  ?> : <input type="text" class="validate[required,minSize[4],maxSize[64]]" value="<?php echo $this->user->name ?>" name="name" id="name" size="30"  validation="required name"/></label>
			<br />
			<label><?php echo RText::_('COM_RETINASHOP_USER_FORM_EMAIL')  ?> : <input type="text" class="validate[required,custom[email]]" value="<?php echo $this->user->email ?>" name="email" id="email" size="30"  validation="required email"/></label>
			<br/>
			<label>
				<?php
				$ask_comment = RText::sprintf('COM_RETINASHOP_ASK_COMMENT', $min, $max);
				echo $ask_comment;
				?>
				<br />
				<textarea title="<?php echo $ask_comment ?>" class="validate[required,minSize[<?php echo $min ?>],maxSize[<?php echo $max ?>]] field" id="comment" name="comment" rows="10"></textarea>
			</label>
			<div class="submit">
				<input class="highlight-button" type="submit" name="submit_ask" title="<?php echo RText::_('COM_RETINASHOP_ASK_SUBMIT')  ?>" value="<?php echo RText::_('COM_RETINASHOP_ASK_SUBMIT')  ?>" />

				<div class="width50 floatright right paddingtop">
					<?php echo RText::_('COM_RETINASHOP_ASK_COUNT')  ?>
					<input type="text" value="0" size="4" class="counter" ID="counter" name="counter" maxlength="4" readonly="readonly" />
				</div>
			</div>

			<input type="hidden" name="retinashop_product_id" value="<?php echo JRequest::getInt('retinashop_product_id',0); ?>" />
			<input type="hidden" name="tmpl" value="component" />
			<input type="hidden" name="view" value="productdetails" />
			<input type="hidden" name="option" value="com_retinashop" />
			<input type="hidden" name="retinashop_category_id" value="<?php echo JRequest::getInt('retinashop_category_id'); ?>" />
			<input type="hidden" name="task" value="mailAskquestion" />
			<?php echo JHTML::_( 'form.token' ); ?>
		</form>

	</div>

</div>

<?php } ?>
