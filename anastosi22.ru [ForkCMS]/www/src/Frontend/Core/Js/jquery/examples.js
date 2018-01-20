$(document).ready(function () {
     $('#fullpage').fullpage({
        verticalCentered: false,
        anchors: ['homePage', 'worksPage', 'mastersPage', 'sendPage', 'contactPage', 'lastPage'],
        menu: '#menu',
        continuousVertical: false
    });
        
	function onLoad(f){
    var map = $('#map1');
    if (onLoad.loaded)
       window.setTimeout(f, 0);
       $('#insertMap').html(map);
    }
onLoad.loaded = false;
onLoad(function(){ onLoad.loaded = true;});

});
