/**
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		
 */

var plg_quickicon_jupdatecheck_ajax_structure = {};

window.addEvent('domready', function(){
	plg_quickicon_jupdatecheck_ajax_structure = {
		onSuccess: function(msg, responseXML)
		{
			try {
				var updateInfoList = JSON.decode(msg, true);
			} catch(e) {
				// An error occured
				document.id('plg_quickicon_retinaupdate').getElements('img').setProperty('src',plg_quickicon_retinaupdate_img.ERROR);
				document.id('plg_quickicon_retinaupdate').getElements('span').set('html', plg_quickicon_retinaupdate_text.ERROR);
			}
			if (updateInfoList instanceof Array) {
				if (updateInfoList.length < 1) {
					// No updates
					document.id('plg_quickicon_retinaupdate').getElements('img').setProperty('src',plg_quickicon_retinaupdate_img.UPTODATE);
					document.id('plg_quickicon_retinaupdate').getElements('span').set('html', plg_quickicon_retinaupdate_text.UPTODATE);
				} else {
					var updateInfo = updateInfoList.shift();
					if (updateInfo.version != plg_quickicon_jupdatecheck_jversion) {
						var updateString = plg_quickicon_retinaupdate_text.UPDATEFOUND.replace("%s", updateInfo.version+"");
						document.id('plg_quickicon_retinaupdate').getElements('img').setProperty('src',plg_quickicon_retinaupdate_img.UPDATEFOUND);
						document.id('plg_quickicon_retinaupdate').getElements('span').set('html', updateString);
					} else {
						document.id('plg_quickicon_retinaupdate').getElements('img').setProperty('src',plg_quickicon_retinaupdate_img.UPTODATE);
						document.id('plg_quickicon_retinaupdate').getElements('span').set('html', plg_quickicon_retinaupdate_text.UPTODATE);
					}
				}
			} else {
				// An error occured
				document.id('plg_quickicon_retinaupdate').getElements('img').setProperty('src',plg_quickicon_retinaupdate_img.ERROR);
				document.id('plg_quickicon_retinaupdate').getElements('span').set('html', plg_quickicon_retinaupdate_text.ERROR);
			}
		},
		onFailure: function(req) {
			// An error occured
			document.id('plg_quickicon_retinaupdate').getElements('img').setProperty('src',plg_quickicon_retinaupdate_img.ERROR);
			document.id('plg_quickicon_retinaupdate').getElements('span').set('html', plg_quickicon_retinaupdate_text.ERROR);
		},
		url: plg_quickicon_retinaupdate_ajax_url
	};
	setTimeout("ajax_object = new Request(plg_quickicon_jupdatecheck_ajax_structure); ajax_object.send('eid=700&cache_timeout=3600');", 2000);
});