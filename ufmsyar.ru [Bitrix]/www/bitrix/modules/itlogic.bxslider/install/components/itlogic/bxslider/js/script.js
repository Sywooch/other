function slider(settings){
	//console.log(settings);
	$('.bxslider').bxSlider({
		speed				:	(isNaN(settings.SLIDER_SPEED)) ? 500 : parseInt(settings.SLIDER_SPEED),
		mode				:	settings.SLIDER_MODE,
		slideWidth			:	parseInt(settings.SLIDER_WIDTH),
		hideControlOnEnd	:	(settings.SLIDER_HIDECONTROLONEND=="Y") ? true : false,
		infiniteLoop		:	(settings.SLIDER_HIDECONTROLONEND=="Y") ? false : true,
		captions			:	(settings.SLIDER_CAPTIONS=="Y") ? true : false,
		auto				:	(settings.SLIDER_AUTO=="Y") ? true : false,
		autoStart			:	(settings.SLIDER_AUTO=="Y") ? true : false,
		autoControls		:	(settings.SLIDER_AUTO_CONTROLS=="Y") ? true : false,
		responsive			:	(settings.SLIDER_RESPONSIVE=="Y") ? true : false,
	});	
}