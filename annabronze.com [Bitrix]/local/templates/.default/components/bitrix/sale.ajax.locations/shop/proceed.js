var arCountriesWithCities = ["Россия", "Украина", "Казахстан"];//

if(languageId == 'en') {
    arCountriesWithCities = ["Russia", "Ukraine", "Kazakhstan"];
}


function getLocation(country_id, region_id, city_id, arParams, site_id)
{
	BX.showWait();
	$(".js-form__preload-container").addClass("is-loading");
	
	property_id = arParams.CITY_INPUT_NAME;
	
	function getLocationResult(res)
	{
		BX.closeWait();
		//$(".js-form__preload-container").removeClass("is-loading");


		$("#LOCATION_" + property_id).html(res);


		var valTmp = $("#ORDER_PROP_6 option:nth-child(2)").val();

		$("#ORDER_PROP_6 option:nth-child(2)").prop("selected", true);
		$("#ORDER_PROP_6 option:nth-child(2)").change();


	}

	arParams.COUNTRY = parseInt(country_id);
	arParams.REGION = parseInt(region_id);
	arParams.SITE_ID = site_id;


	var url = '/local/components/bitrix/sale.ajax.locations/templates/.default/ajax.php';
	BX.ajax.post(url, arParams, getLocationResult)
}

function getLocationByZip(zip, propertyId)
{
	BX.showWait();
	$(".js-form__preload-container").addClass("is-loading");

	property_id = propertyId;
	
	function getLocationByZipResult(res)
	{
		BX.closeWait();
		//$(".js-form__preload-container").removeClass("is-loading");
		
		var obContainer = document.getElementById('LOCATION_' + property_id);
		if (obContainer)
		{
			obContainer.innerHTML = res;
		}
	}

	var url = '/local/components/bitrix/sale.ajax.locations/templates/.default/ajax.php';
	BX.ajax.post(url, 'ZIPCODE=' + zip.value, getLocationByZipResult)
}


BX.addCustomEvent('onAjaxSuccess', function() {

	var activeCountry = $("#COUNTRYORDER_PROP_6 :selected").text();

	if(arCountriesWithCities.join().search(activeCountry) == -1){
		$("#ORDER_PROP_6").parents(".b-form__row").hide();
		$(".ORDER_PROP_INDEX").show();
		$(".ORDER_PROP_CITY").show();

	}else{
		$("#ORDER_PROP_6").parents(".b-form__row").show();
		$(".ORDER_PROP_INDEX").hide();
		$(".ORDER_PROP_CITY").hide();
	}



});



$(window).on("load", function () {

	var activeCountry = $("#COUNTRYORDER_PROP_6 :selected").text();

	if(arCountriesWithCities.join().search(activeCountry) == -1){
		$("#ORDER_PROP_6").parents(".b-form__row").hide();
		$(".ORDER_PROP_INDEX").show();
		$(".ORDER_PROP_CITY").show();

	}else{
		$("#ORDER_PROP_6").parents(".b-form__row").show();
		$(".ORDER_PROP_INDEX").hide();
		$(".ORDER_PROP_CITY").hide();
	}


});