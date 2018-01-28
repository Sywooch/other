<?php
/**
* @package 		EasySocial
* @copyright	Copyright (C) 2010 - 2013 Stack Ideas Sdn Bhd. All rights reserved.
* @license 		Proprietary Use License http://stackideas.com/licensing.html
* @author 		Stack Ideas Sdn Bhd
*/
defined( '_JEXEC' ) or die( 'Unauthorized Access' );
?>
EasySocial.require()
.script( 'site/profile/profile' )
.done(function($){
	$('[data-profile]').implement(EasySocial.Controller.Profile);

	// Custom hack needed to bring the sidebar up when toggle is there
	var checkSidebarPosition = function() {
		var toggle = $('[data-sidebar-toggle]'),
			sidebar = $('[data-sidebar]');

		if(toggle.is(':visible')) {
			var container = $('<div>').addClass('es-container responsive').append(sidebar);

			toggle.after(container);
		} else {
			var container = $('.es-container.responsive'),
				origContainer = $('.es-container');

			origContainer.prepend(sidebar);
			container.remove();
		}
	};

	// Run once on document ready
	$(function() {
		checkSidebarPosition();
	});

	// Run everytime responsive is fired
	$('.es-responsive').on('responsive', function() {
		checkSidebarPosition();
	});
});
