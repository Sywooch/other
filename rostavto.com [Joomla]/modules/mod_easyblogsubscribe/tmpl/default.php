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
 
defined('_JEXEC') or die('Restricted access');
?>
<div class="ezb-mod mod_easyblogsubscribe<?php echo $params->get( 'moduleclass_sfx' ) ?>">
<?php if( $params->get( 'type' , 'link' ) == 'link' ){ ?>
	<div>
		<a href="javascript:void(0);" onclick="eblog.subscription.show('site');"><?php echo JText::_( 'MOD_SUBSCRIBE_MESSAGE' );?></a>
	</div>
<?php } else { ?>
	<script type="text/javascript">
	EasyBlog.ready(function($){

		$( 'a.subscribe-link' ).bind( 'click' , function(){
			eblog.loader.loading( 'eblog_loader' );
			ejax.load( 'subscription', 'submitForm', 'site' , ejax.getFormVal('#subscribe-blog-module') );

		});

	});
	</script>
	<form name="subscribe-blog" id="subscribe-blog-module" method="post">
	<table border="0">
		<tr>
			<td>
				<?php echo JText::_( 'MOD_EASYBLOGSUBSCRIBE_YOUR_NAME' ); ?>
			</td>
			<td>
				<input type="text" name="esfullname" class="inputbox" id="esfullname" />
			</td>
		</tr>
		<tr>
			<td>
				<?php echo JText::_( 'MOD_EASYBLOGSUBSCRIBE_YOUR_EMAIL' ); ?>
			</td>
			<td>
				<input type="text" name="email" id="email" class="inputbox" />
			</td>
		</tr>
		<tr>
			<td colspan="2" style="text-align: right;">
				<a href="javascript:void(0);" class="subscribe-link"><?php echo JText::_( 'MOD_EASYBLOGSUBSCRIBE_SUBSCRIBE_BUTTON' );?></a>
			</td>
		</tr>
	</table>
	</form>
<?php } ?>
</div>