$(function(){ 

$(window).load(function () {
var myMap;

$(window).resize(function(){ var h=$('.contacts_container').css('height');  $('.contacts_container .map').css('height',h); });

  
 
    ymaps.ready(function(){
		var h=$('.contacts_container').css('height');  
		
		$('.contacts_container .map').css('height',h); 
        myMap = new ymaps.Map("main_map", {
         
            center: [55.6135,37.6613],
			zoom: 15,
			controls: []
        });
		
		
		
			myMap.balloon.open(
				
				[55.613529,37.44833], {
				contentBody: '<img src="/public/site1/images/logo.png" />'
			 }, {
              
                closeButton: false
       		 });
    
        
    });
	
	
	
});		
	
});	