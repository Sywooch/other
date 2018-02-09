
    var flashvars = {};

    flashvars.initXML_path = "/data/xml/init.xml";
    var params = {};
    var attributes = {};
    swfobject.embedSWF("/data/swf/main.swf", "map-holder", "760", "700", "9.0.0", "expressInstall.swf", flashvars, params, attributes);

    $(document).ready(function()
    {
	$("#map").click(function()
	{ 
	    $("#map-background").show().next().show();
	    $("#map-background").css('opacity', .5);
	    $("#map-background").css('height', document.body.offsetHeight + 'px');
	});
	$("#interactive-map a").click(function()
	{
	    $("#map-background").hide().next().hide();
	});
    });
																				    