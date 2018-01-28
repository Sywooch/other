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
<script type="text/javascript">
EasyBlog.ready(function($){

	$( '#blogListItem' ).change( function(){

		var el 	= $( '#blogListItem option:selected' );

		window.location	= el.data( 'permalink' );
	})
});
</script>
<div class="ezb-mod ezblog-selectlist<?php echo $params->get( 'moduleclass_sfx' ) ?>">
	<select id="blogListItem">
		<option value="0"<?php echo is_null( $selected ) ? ' selected="selected"' : '';?>><?php echo JText::_( 'MOD_EASYBLOGLIST_SELECT_AN_ENTRY' ); ?></option>
		<?php foreach( $posts as $post){ ?>
		<option value="<?php echo $post->id;?>" data-permalink="<?php echo EasyBlogRouter::_( 'index.php?option=com_easyblog&view=entry&id=' . $post->id );?>"<?php echo $selected == $post->id ? ' selected="selected"' :'';?>><?php echo $post->title; ?></option>
		<?php } ?>
	</select>
</div>
