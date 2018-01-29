function tabs(pages) {

	pages.addClass("dyn-tabs");
	pages.first().show();

	var tabNavigation = jQuery('<ul id="tabs" />').insertBefore(pages.first());

	pages.each(function() {
		var listElement = jQuery("<li />");
		var label = jQuery(this).attr("title") ? jQuery(this).attr("title")
				: "Kein Label";
		listElement.text(label);
		tabNavigation.append(listElement);
	});

	var elements = tabNavigation.find("li");
	elements.first().addClass("current");
	
	elements.click(function() {		
		elements.removeClass("current");
		jQuery(this).addClass("current");
		pages.hide();
		pages.eq(jQuery(this).index()).fadeIn(200);
	});

}

jQuery(document).ready(function() {

	tabs(jQuery("#ui-tabs .tabs"));

});