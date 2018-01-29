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

(function(){

var $ = jomsQuery;
if (!$ && joms) $ = joms.jQuery;
if (!$) $ = window.jQuery;

window.easyblogApp = {
	blog : {
		toggle: function( element ){
			if( $( element ).prev().css( 'display' ) == 'block' )
			{
				$( element ).prev().hide();
			}
			else
			{
				$( element ).prev().show();
			}
		}
	},

	spinner: {

		// toggle btw the spinner and save button
		show: function() {
			$('#comment-loading').show();
		},

		// toggle btw the spinner and save button
		hide: function() {
			$('#comment-loading').hide();
		}
	},
	element: {
		focus: function(element) {
			$( '#' + element ).focus();
		}
	},
	comment : {
		show: function(id) {

			// Show comments
			$( '#comments-wrapper' + id ).show();

			// show all reply container
			$('.reply_container').show();

			// Hide notifications
			$( '#comment-notify-' + id ).hide().html( '' );

			//prepare the comment input form
			$('#comment-add-form-' + id).show();
			$('#easyblog-app-wrapper #comment-form').show();

			var commentForm = $('#easyblog-app-wrapper #comment-form').clone();
			$('#easyblog-app-wrapper #comment-form').remove();

			$('#comment-add-form-' + id).addClass('comment-form-inline').append(commentForm);
            $('#blog_id').val(id);


		},
		/**
		 * Cancel comment submit
		 */
		cancel: function() {
			var id = $( '#blog_id').val();

			// Hide comment listings
			// $( '#comments-wrapper' + id ).hide();

			//revert the comment input form
			var commentForm = $('#easyblog-app-wrapper #comment-add-form-' + id + ' #comment-form').clone();
			$('#easyblog-app-wrapper #comment-add-form-' + id + ' #comment-form').remove();
			$('#easyblog-app-wrapper #comment-separator').after(commentForm);
			$('#easyblog-app-wrapper #comment-form').hide();

			$('#comment-reply-form-' + id).hide();
            $('#blog_id').val('');
            $('#comment').val('');
		},
		submit: function() {
			var formVars = jax.getFormValues('frmComment');

			easyblogApp.spinner.show();

			jax.call('community','plugins,easyblog,savecomment', formVars)
			return false;
		},
		add: function(id, comment) {
			$('#comments-wrapper' + id).prepend( comment );
		},
		notify: function( id , message , objClass ){
			var element	= $( '#comment-notify-' + id );
			element.html( message ).addClass( objClass ).show();
		}
	}
}

})();
