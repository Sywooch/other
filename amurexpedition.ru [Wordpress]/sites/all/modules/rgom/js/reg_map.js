(function ($) {
	Drupal.behaviors.rgom_reg_map = {
    attach: function (context, settings) {
			var reg_osm_map = { "-102269":1, "-337422":2, "-1574364":85, "-144764":3, "-147166":4, "-140337":5, "-112819":6, "-83184":7, "-81997":8, "-72197":9, "-77665":10, "-115106":11, "-72181":12, "-147167":13, "-145730":14, "-85617":15, "-145454":16, "-109879":17, "-103906":18, "-81995":19, "-151233":20, "-109878":21, "-144763":22, "-115100":23, "-85963":24, "-108082":25, "-190090":26, "-140290":27, "-72223":28, "-176095":29, "-72169":30, "-151228":31, "-51490":32, "-2099216":33, "-274048":34, "-72195":35, "-89331":36, "-140294":37, "-140292":38, "-77669":39, "-72224":40, "-72182":41, "-115135":42, "-151225":43, "-155262":44, "-253256":45, "-145194":46, "-77677":47, "-145729":48, "-109876":49, "-253252":50, "-108083":51, "-393980":52, "-115136":53, "-3568873":84, "-115114":54, "-72196":55, "-151234":56, "-110032":57, "-79374":58, "-145195":59, "-190911":60, "-85606":61, "-71950":62, "-72194":63, "-72193":64, "-394235":65, "-79379":66, "-81996":67, "-108081":68, "-72180":69, "-2095259":70, "-140295":71, "-81993":72, "-140291":73, "-115134":74, "-72192":75, "-151223":76, "-140296":77, "-77687":78, "-109877":79, "-80513":80, "-151231":81, "-191706":82, "-81994":83 };
			
			$.extend($.fn.disableTextSelect = function() {
				return this.each(function(){ if($.browser.mozilla){ $(this).css('MozUserSelect','none'); } else if($.browser.msie){ $(this).bind('selectstart',function(){return false;}); } else { $(this).mousedown(function(){return false;}); }	});
			});
			
			var RegionClick = function (e, code) {
				if (!Drupal.settings.regions_info[reg_osm_map[code]]) return;
				
				if ($('html').attr('lang') == 'en') {
					if (Drupal.settings.regions_info[reg_osm_map[code]].link) window.open(Drupal.settings.regions_info[reg_osm_map[code]].link, '_blank');
				} else {
				  $('#reg_tooltip .content').html('<a href="'+Drupal.settings.regions_info[reg_osm_map[code]].link+'" target="_blank">'+Drupal.settings.regions_info[reg_osm_map[code]].dep+'</a><div class="contacts">'+Drupal.settings.regions_info[reg_osm_map[code]].contacts+'</div>');
				  $('#reg_tooltip').show();
				}
			};

			$('#reg_map').vectorMap({
				map: 'ru_reg_lcc_ru',
				backgroundColor: '#FFFFFF',
				regionStyle: {
					initial: {
						fill: '#8BAED8',
						"fill-opacity": 1,
						stroke: 'none',
						"stroke-width": 0,
						"stroke-opacity": 1
					},
					hover: {
						fill: "#02639A"
					},
					selected: {
						fill: "#02639A"
					}
				},
				onRegionOver: function (e, code) {

				},
				onRegionClick: RegionClick,
				onRegionLabelShow : function (e, label, code) {
					label[0].innerHTML = Drupal.settings.regions_info[reg_osm_map[code]].reg;					
				}
			});
			
			var reg_map = $('#reg_map').vectorMap('get', 'mapObject');

			// Workaround jVectorMap bug when region click event not fired
			$('#reg_map').on('click', function(e) {
			  if (~e.target.className.baseVal.indexOf('jvectormap-region')) {
					code = $(e.target).attr("data-code").toLowerCase();
					RegionClick(null, code);
					return false;
			  }
			});

			$("#reg_tooltip a.close").click(function() {
    		$("#reg_tooltip").hide();
			});

			$("#reg_list_wrapper #reg_list").on('change', function(event) {
				event.preventDefault();
				if (Drupal.settings.regions_info[this.value] && Drupal.settings.regions_info[this.value].link) window.open(Drupal.settings.regions_info[this.value].link, '_blank');
			});
	    
		}
	};
})(jQuery);
