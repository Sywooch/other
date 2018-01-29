(function () {
    var rseslider = window.RSESlider = {
        init: function () {
            var b = $$('.rs_events_slider_timeline');
            if (!b.length) return;
            b.each(function (a, i) {
                rseslider.methodsAttach(a)
            })
        },
        methodsAttach: function (a) {
            var b = rseslider;
            b.adjustWidth(a);
            b.doScroller(a);
        },
        adjustWidth: function (c) {
            var settings = rseslider.settings[c.id],
				module = c.id.replace('rs_events_slider_timeline','').toInt();
			
			theli = $$('#rs_events_slider_timeline'+module+' ul li')[0];
			
			var theborder = theli.getStyle('border').toInt() * 2;
			var thepadding = theli.getStyle('padding').toInt() * 2;
			var themargin = theli.getStyle('margin-right').toInt();
			thewidth = Math.floor((settings['width'] - theborder*settings['events'] - themargin*(settings['events']-1) - thepadding*settings['events']) / settings['events']);
			
			$('rs_eventsslider_timeline'+module).setStyle('width',settings['width']+'px');
			$('rs_eventsslider_timeline'+module).setStyle('height',settings['height']+'px');
			$$('#rs_events_slider_timeline'+module+' ul li').setStyle('width',thewidth+'px');
			
			var d = c.getElement('.rs_events_slider_timeline_events');
            var e = d.getChildren(),
                size = 0;
            e.each(function (a, i) {
                var b = a.getStyle('margin-left').toInt(),
                    mr = a.getStyle('margin-right').toInt();
                size += a.getSize().x;
                size += b + mr;
            });
			
            d.setStyle('width', size)
        },
        doScroller: function (b) {
			var settings = rseslider.settings[b.id],
				c = b.getElement('.rs_events_slider_timeline_events'),
				module = b.id.replace('rs_events_slider_timeline','').toInt(),
				theelement = $('rseprobar'+module),
				datecontainer = $('rsepro_dates'+module);
			
			var d = {
                offset: settings['offset'],
				duration: settings['duration'],
                transition: settings['transition'],
				onComplete: function(a) {
					a.getNext('div').getElements('.rsepropanes div').each(function(el,i) {
						if (el.hasClass('active'))
							e.toElement(f[i * g],'x');
					});
				}
            };
			
			var e = new Fx.Scroll(b, d);
			var f = c.getElements('li');
			var g = settings['events'],
                panes = Math.ceil(f.length / g);
			
			if (panes > 1)
			{
				var h = theelement.getElements('.rsepropane'),
					dates = datecontainer.getElements('.rseprodate'),
					paneSize = h.length ? h[0].getSize().x / 2 : 0,
					knobSize = $$('.rsepropane')[0].getSize().x / 2,
					half = $$('.rsepropane')[0]['offsetWidth'] / 2;
					full = theelement['offsetWidth'] - $$('.rsepropane')[0]['offsetWidth'];
					min = 0;
					max = panes - 1;
					range = max - min;
					thesteps = (panes - 1) || full;
					stepSize = Math.abs(range) / thesteps;
					stepWidth = Number((stepSize * full / Math.abs(range)).toFixed(4));
				
				h.setStyles({
					'opacity': 0,
					'visibility': 'hidden'
				}).each(function (a, i) {
					var j = stepWidth * i + knobSize - paneSize;
					var size = stepWidth + knobSize - paneSize - 3;
					
					a.setStyle('left', j);
					a.getElement('span').setStyles({
						'width': size,
						'left': -(size / 2)
					});
					
					a.addEvent('click', function() {
						h.each(function(el) {
							el.removeClass('active');
						});
						
						dates.each(function (elem) {
							elem.removeClass('active');
						});
						
						a.addClass('active');
						dates[i].addClass('active');
						e.toElement(f[i * g],'x');
					});
				});
				
				dates.each(function (a, i) {
					var j = stepWidth * i + knobSize - paneSize;
					a.setStyle('left', j);
					
					a.addEvent('click', function() {
						dates.each(function(elm) {
							elm.removeClass('active');
						});
						a.addClass('active');
						
						h.each(function (el) {
							el.removeClass('active');
						});
						
						h[i].addClass('active');
						e.toElement(f[i * g],'x');
					});
				});
				
				h.fade('in');
			}
        }
    };
    rseslider.settings = {};
    window.addEvent('domready', rseslider.init)
})();