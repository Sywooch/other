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
<!--
<div class="form-group">
	<div class="form-inline">
		<input type="text" class="form-control input-sm" placeholder="First Name" style="width: 49%; margin-bottom: 4px;"value="">
		<input type="text" class="form-control input-sm" placeholder="Last Name" style="width: 49%; margin-bottom: 4px;"value="">
	</div>
</div>
<div class="form-group">
	<input type="text" placeholder="Your Email" name="email" class="form-control input-sm">
</div>
<div class="form-group">
	<input type="text" placeholder="Re-enter Email" name="email" class="form-control input-sm">
</div>
<div class="form-group">
	<input type="password" placeholder="New Password" name="email" class="form-control input-sm">
</div>
<div class="form-group">
	<label for="">Birthday: </label>
	<div class="data form-inline">
		<input type="text" style="width:50px;" data-field-birthday-day="" placeholder="DD" value="" name="" class="form-control input-sm">
		<select class="form-control input-sm" data-field-birthday-month="" name="">
			<option selected="selected" value="">Month</option>
			<option value="1">January</option>
			<option value="2">February</option>
			<option value="3">March</option>
			<option value="4">April</option>
			<option value="5">May</option>
			<option value="6">June</option>
			<option value="7">July</option>
			<option value="8">August</option>
			<option value="9">September</option>
			<option value="10">October</option>
			<option value="11">November</option>
			<option value="12">December</option>
		</select>
		<input type="text" style="width:70px;" data-field-birthday-year="" placeholder="YYYY" value="" name="" class="form-control input-sm">
	</div>
</div>
<div class="form-group">
	<label class="radio-inline">
	  <input type="radio" value="Male" id="gender"> Male
	</label>
	<label class="radio-inline">
	  <input type="radio" value="Female" id="gender"> Female
	</label>
</div>
<div class="form-group">
	<p class="help-block">By clicking Sign Up, you agree to our Terms and that you have read our Data Use Policy, including our Cookie Use.</p>
</div>
-->

<div class="form-group"
	data-field
	data-field-<?php echo $field->id; ?>
	data-registrationmini-field
	data-registrationmini-field-<?php echo $field->id; ?>
>
		<?php echo $this->includeTemplate( $subNamespace ); ?>
</div>
