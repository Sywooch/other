/**
 * @package     Ghost_Russia.JoomlaSite
 * @subpackage  Templates.Ghost_Russia.mod_infinitilifeWeather.Script
 *
 * @copyright   Copyright (C) 2007 - 2015 Ghost_Russia. All rights reserved.
 * @author Vladislav Fursov
*/

jQuery(function($) {
	$(document).ready(function(){

		function NASort(a, b) {
			if (a.innerHTML == 'NA') {
				return 1;
			}
			else if (b.innerHTML == 'NA') {
				return -1;
			}
			return (a.innerHTML > b.innerHTML) ? 1 : -1;
		};

		$('#country').change(function(){
			$("#jform_params_Country").val($("#country option:selected").val());

			$("#city").empty();
            $("#city").trigger("liszt:updated");

			$.ajax({
				type: "POST",
				url: "/modules/mod_infinitilifeWeather/helpers/getcountry.php",
				data: "country_id="+$("#country option:selected").val(),
				success: function(html){
					$("#city").append(html);
                    $("#city").trigger("liszt:updated");

					$('#city option').sort(NASort).appendTo('#city');
				}
			});
			return false;
		});

		$('#city').change(function(){
			$("#jform_params_City").val($('#city').val());
			return false;
		});
	});
});