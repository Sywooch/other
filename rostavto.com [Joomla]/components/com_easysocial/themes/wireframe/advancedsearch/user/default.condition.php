<?php
/**
* @package		EasySocial
* @copyright	Copyright (C) 2010 - 2013 Stack Ideas Sdn Bhd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* EasySocial is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/
defined( '_JEXEC' ) or die( 'Unauthorized Access' );
?>
<span<?php echo isset( $show ) && $show === false ? ' style="display:none;"' : '';?> data-itemCondition>

	<?php if( $condition->input == 'text' ){ ?>
		<input data-condition type="text" class="form-control input-sm" name="conditions[]" placeholder="<?php echo JText::_( 'Enter some value' , true );?>" value="<?php echo $selected;?>" />
	<?php } ?>

	<?php if( $condition->input == 'date' ){ ?>
		<?php echo $this->html( 'form.calendar' , 'conditions[]' , $selected , '' , array( 'data-condition' ) ); ?>
	<?php } ?>

	<?php if( $condition->input == 'dates' ){ ?>
		<input data-condition type="hidden" class="form-control input-sm" name="conditions[]" value="<?php echo $selected;?>" />
		<?php
			$data[0] = '';
			$data[1] = '';

			if( $selected )
			{
				$tmp = explode( '|', $selected );
				$data[0] = $tmp[0];
				$data[1] = $tmp[1];
			}
		?>

		<?php echo $this->html( 'form.calendar' , 'frmStart', $data[0], 'frmStart', array( 'data-start' ) ); ?>
		<?php echo $this->html( 'form.calendar' , 'frmEnd', $data[1], 'frmEnd', array( 'data-end' ) ); ?>
	<?php } ?>


	<?php if( $condition->input == 'gender' ){ ?>
		<select autocomplete="off" class="form-control input-sm" name="conditions[]" data-condition >
			<option value="1" <?php echo ( $selected == '1' ) ? ' selected="selected"' : ''; ?> ><?php echo JText::_( 'Male' ); ?></option>
			<option value="2" <?php echo ( $selected == '2' ) ? ' selected="selected"' : ''; ?>><?php echo JText::_( 'Female' ); ?></option>
		</select>
	<?php } ?>

</span>
