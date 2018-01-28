/**
 * @package		plg_easyblog
 * @copyright	Copyright (C) 2010 Stack Ideas Private Limited. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 *
 * EasyBlog is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

var easyblogApp = {
	blog : {
		toggle: function( element ){
			if( jQuery( element ).prev().css( 'display' ) == 'block' )
			{
				jQuery( element ).prev().hide();
			}
			else
			{
				jQuery( element ).prev().show();
			}
		}
	},

	spinner: {

		// toggle btw the spinner and save button
		show: function() {
			jQuery('#comment-loading').show();
		},

		// toggle btw the spinner and save button
		hide: function() {
			jQuery('#comment-loading').hide();
		}
	},
	element: {
		focus: function(element) {
			jQuery( '#' + element ).focus();
		}
	},
	comment : {
		show: function(id) {

			// Show comments
			jQuery( '#comments-wrapper' + id ).show();
			
			// show all reply container
			jQuery('.reply_container').show();

			// Hide notifications
			jQuery( '#comment-notify-' + id ).hide().html( '' );
			
			//prepare the comment input form
			jQuery('#comment-add-form-' + id).show();
			jQuery('#easyblog-app-wrapper #comment-form').show();
			
			var commentForm = jQuery('#easyblog-app-wrapper #comment-form').clone();
			jQuery('#easyblog-app-wrapper #comment-form').remove();

			jQuery('#comment-add-form-' + id).addClass('comment-form-inline').append(commentForm);
            jQuery('#blog_id').val(id);
            
            
		},
		/**
		 * Cancel comment submit
		 */
		cancel: function() {
			var id = jQuery( '#blog_id').val();
			
			// Hide comment listings
			// jQuery( '#comments-wrapper' + id ).hide();
			
			//revert the comment input form
			var commentForm = jQuery('#easyblog-app-wrapper #comment-add-form-' + id + ' #comment-form').clone();
			jQuery('#easyblog-app-wrapper #comment-add-form-' + id + ' #comment-form').remove();
			jQuery('#easyblog-app-wrapper #comment-separator').after(commentForm);
			jQuery('#easyblog-app-wrapper #comment-form').hide();

			jQuery('#comment-reply-form-' + id).hide();
            jQuery('#blog_id').val('');
            jQuery('#comment').val('');
		},
		submit: function() {
			var formVars = ejax.getFormVal('#frmComment');
			easyblogApp.spinner.show();
			
			ejax.load( 'entry', 'saveCBcomment' , formVars);
			return false;
		},
		add: function(id, comment) {
			jQuery('#comments-wrapper' + id).prepend( comment );
		},
		notify: function( id , message , objClass ){
			var element	= jQuery( '#comment-notify-' + id );
			element.html( message ).addClass( objClass ).show();
		}
	}
}