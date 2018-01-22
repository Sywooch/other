(function($){
	$.fn.tmStickUp=function(options){ 
		
		var getOptions = {
			correctionSelector: $('.correctionSelector')
		}
		$.extend(getOptions, options); 

		var
			_this = $(this)
		,	_window = $(window)
		,	_document = $(document)
		,	thisOffsetTop = 0
		,	thisOuterHeight = 0
		,	thisMarginTop = 0
		,	thisPaddingTop = 0
		,	documentScroll = 0
		,	pseudoBlock
		,	lastScrollValue = 0
		,	scrollDir = ''
		,	tmpScrolled
		;

		init();
		function init(){
			thisOffsetTop = parseInt(_this.offset().top);
			thisMarginTop = parseInt(_this.css("margin-top"));
			thisOuterHeight = parseInt(_this.outerHeight(true));

			$('<div class="pseudoStickyBlock"></div>').insertAfter(_this);
			pseudoBlock = $('.pseudoStickyBlock');
			pseudoBlock.css({"position":"relative", "display":"block"});
			addEventsFunction();
		}//end init

		function addEventsFunction(){
			_document.bind('scroll', function() {
				tmpScrolled = $(this).scrollTop();
					if (tmpScrolled > lastScrollValue){
						scrollDir = 'down';
					} else {
						scrollDir = 'up';
					}
				lastScrollValue = tmpScrolled;

				correctionValue = getOptions.correctionSelector.outerHeight(true);
				documentScroll = parseInt(_window.scrollTop());

				if(thisOffsetTop - correctionValue < documentScroll){
					_this.addClass('isStuck');
					_this.css({position:"fixed", top:correctionValue});
					pseudoBlock.css({"height":thisOuterHeight});
				}else{
					_this.removeClass('isStuck');
					_this.css({position:"relative", top:0});
					pseudoBlock.css({"height":0});
				}
			}).trigger('scroll');
		}
	}//end tmStickUp function
})(jQuery);

/*
Plugin: jQuery Parallax
Version 1.1.3
Author: Ian Lunn
Twitter: @IanLunn
Author URL: http://www.ianlunn.co.uk/
Plugin URL: http://www.ianlunn.co.uk/plugins/jquery-parallax/
Dual licensed under the MIT and GPL licenses:
http://www.opensource.org/licenses/mit-license.php
http://www.gnu.org/licenses/gpl.html
*/
(function( $ ){
var $window = $(window);
var windowHeight = $window.height();
$window.resize(function () {
windowHeight = $window.height();
});
$.fn.parallax = function(xpos, speedFactor, outerHeight) {
var $this = $(this);
var getHeight;
var firstTop;
var paddingTop = 0;
//get the starting position of each element to have parallax applied to it
$this.each(function(){
firstTop = $this.offset().top;
});
if (outerHeight) {
getHeight = function(jqo) {
return jqo.outerHeight(true);
};
} else {
getHeight = function(jqo) {
return jqo.height();
};
}
// setup defaults if arguments aren't specified
if (arguments.length < 1 || xpos === null) xpos = "50%";
if (arguments.length < 2 || speedFactor === null) speedFactor = 0.1;
if (arguments.length < 3 || outerHeight === null) outerHeight = true;
// function to be called whenever the window is scrolled or resized
function update(){
var pos = $window.scrollTop();
$this.each(function(){
var $element = $(this);
var top = $element.offset().top;
var height = getHeight($element);
// Check if totally above or totally below viewport
if (top + height < pos || top > pos + windowHeight) {
return;
}
$this.css('backgroundPosition', xpos + " " + Math.round((firstTop - pos) * speedFactor) + "px");
});
}
$window.bind('scroll', update).resize(update);
update();
};
})(jQuery); 