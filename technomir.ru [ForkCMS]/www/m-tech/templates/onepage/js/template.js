jQuery(document).ready(function(){

	// Das ist Smooth linking
	jQuery('#navwrap a,#span a,#off-canvas-nav a').smoothScroll({
		offset: -60,
		easing: 'swing'
	});
	
	jQuery('#navwrap a').click(function() {
		jQuery('#navwrap a').parent().removeClass("active");
		jQuery(this).parent().addClass("active");
	});
	
	
  
	jQuery(".sidebar ul ul").addClass("nav-list");
	
	// Fixes default classes not applied to Joomal contact forms for open items
	jQuery(".zenslider").addClass("start");
	jQuery(".zenslider h3").click(function () {
		jQuery(this).parent().removeClass("start");
	});
	
	
	// Fixes default classes not applied to Joomal contact forms for open items
	jQuery(".accordion-toggle").prepend("<span class='accordion-icon'></span>");
		jQuery(".accordion-toggle").not(":first").addClass("collapsed");
	});
	

(function($){$.fn.lazyload=function(options){var settings={threshold:0,failurelimit:0,event:"scroll",effect:"show",container:window};if(options){$.extend(settings,options);}
var elements=this;if("scroll"==settings.event){$(settings.container).bind("scroll",function(event){var counter=0;elements.each(function(){if(!$.belowthefold(this,settings)&&!$.rightoffold(this,settings)){$(this).trigger("appear");}else{if(counter++>settings.failurelimit){return false;}}});var temp=$.grep(elements,function(element){return!element.loaded;});elements=$(temp);});}
return this.each(function(){var self=this;$(self).attr("original",$(self).attr("src"));if("scroll"!=settings.event||$.belowthefold(self,settings)||$.rightoffold(self,settings)){if(settings.placeholder){$(self).attr("src",settings.placeholder);}else{$(self).removeAttr("src");}
self.loaded=false;}else{self.loaded=true;}
$(self).one("appear",function(){if(!this.loaded){$("<img />").bind("load",function(){$(self).hide().attr("src",$(self).attr("original"))
[settings.effect](settings.effectspeed);self.loaded=true;}).attr("src",$(self).attr("original"));};});if("scroll"!=settings.event){$(self).bind(settings.event,function(event){if(!self.loaded){$(self).trigger("appear");}});}});};$.belowthefold=function(element,settings){if(settings.container===undefined||settings.container===window){var fold=$(window).height()+$(window).scrollTop();}
else{var fold=$(settings.container).offset().top+$(settings.container).height();}
return fold<=$(element).offset().top-settings.threshold;};$.rightoffold=function(element,settings){if(settings.container===undefined||settings.container===window){var fold=$(window).width()+$(window).scrollLeft();}
else{var fold=$(settings.container).offset().left+$(settings.container).width();}
return fold<=$(element).offset().left-settings.threshold;};$.extend($.expr[':'],{"below-the-fold":"$.belowthefold(a, {threshold : 0, container: window})","above-the-fold":"!$.belowthefold(a, {threshold : 0, container: window})","right-of-fold":"$.rightoffold(a, {threshold : 0, container: window})","left-of-fold":"!$.rightoffold(a, {threshold : 0, container: window})"});



})(jQuery);


(function(e){function s(e){return e.replace(/(:|\.)/g,"\\$1")}var t="1.4.11",n={exclude:[],excludeWithin:[],offset:0,direction:"top",scrollElement:null,scrollTarget:null,beforeScroll:function(){},afterScroll:function(){},easing:"swing",speed:400,autoCoefficent:2,preventDefault:!0},r=function(t){var n=[],r=!1,i=t.dir&&t.dir=="left"?"scrollLeft":"scrollTop";this.each(function(){if(this==document||this==window)return;var t=e(this);if(t[i]()>0)n.push(this);else{t[i](1);r=t[i]()>0;r&&n.push(this);t[i](0)}});n.length||this.each(function(e){this.nodeName==="BODY"&&(n=[this])});t.el==="first"&&n.length>1&&(n=[n[0]]);return n},i="ontouchend"in document;e.fn.extend({scrollable:function(e){var t=r.call(this,{dir:e});return this.pushStack(t)},firstScrollable:function(e){var t=r.call(this,{el:"first",dir:e});return this.pushStack(t)},smoothScroll:function(t){t=t||{};var n=e.extend({},e.fn.smoothScroll.defaults,t),r=e.smoothScroll.filterPath(location.pathname);this.unbind("click.smoothscroll").bind("click.smoothscroll",function(t){var i=this,o=e(this),u=n.exclude,a=n.excludeWithin,f=0,l=0,c=!0,h={},p=location.hostname===i.hostname||!i.hostname,d=n.scrollTarget||(e.smoothScroll.filterPath(i.pathname)||r)===r,v=s(i.hash);if(!n.scrollTarget&&(!p||!d||!v))c=!1;else{while(c&&f<u.length)o.is(s(u[f++]))&&(c=!1);while(c&&l<a.length)o.closest(a[l++]).length&&(c=!1)}if(c){n.preventDefault&&t.preventDefault();e.extend(h,n,{scrollTarget:n.scrollTarget||v,link:i});e.smoothScroll(h)}});return this}});e.smoothScroll=function(t,n){var r,i,s,o,u=0,a="offset",f="scrollTop",l={},c={},h=[];if(typeof t=="number"){r=e.fn.smoothScroll.defaults;s=t}else{r=e.extend({},e.fn.smoothScroll.defaults,t||{});if(r.scrollElement){a="position";r.scrollElement.css("position")=="static"&&r.scrollElement.css("position","relative")}}r=e.extend({link:null},r);f=r.direction=="left"?"scrollLeft":f;if(r.scrollElement){i=r.scrollElement;u=i[f]()}else i=e("html, body").firstScrollable();r.beforeScroll.call(i,r);s=typeof t=="number"?t:n||e(r.scrollTarget)[a]()&&e(r.scrollTarget)[a]()[r.direction]||0;l[f]=s+u+r.offset;o=r.speed;if(o==="auto"){o=l[f]||i.scrollTop();o/=r.autoCoefficent}c={duration:o,easing:r.easing,complete:function(){r.afterScroll.call(r.link,r)}};r.step&&(c.step=r.step);i.length?i.stop().animate(l,c):r.afterScroll.call(r.link,r)};e.smoothScroll.version=t;e.smoothScroll.filterPath=function(e){return e.replace(/^\//,"").replace(/(index|default).[a-zA-Z]{3,4}$/,"").replace(/\/$/,"")};e.fn.smoothScroll.defaults=n})(jQuery);