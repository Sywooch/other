$(function(){ 


$("#delivery_map").css({'left': '30px', 'top': '15px', 'width': '460px', 'height': screen.height-300});
var delivery_map = $("#delivery_map");
$(window).resize(function(){delivery_map.css({'width': '460px', 'height': screen.height-300});});
		
		
ymaps.ready(function(){
        map = new ymaps.Map("delivery_map", {
            center: [55.76, 37.64],
            zoom: 10
        });
		
		
		//alert("7");
		//map.enableScrollZoom();
		map.behaviors.enable('scrollZoom');
		//alert("4");
    	//map.addControl(new YMaps.ToolBar());
		map.behaviors.enable('toolBar');
    	//alert("5");
		//map.addControl(new YMaps.Zoom());
    	map.behaviors.enable('zoom');
    	//alert("6");
		//map.addControl(new YMaps.ScaleLine());
		map.behaviors.enable('scaleLine');
    	
   		//map.setCenter(new YMaps.GeoPoint(37.64, 55.76), 10);
		//alert("3");
       function makePolygon(zone_data)
		{	
			 
			var raw_points = zone_data.points.split("\n"),
				points = [],
				tmp_point = [];
			console.log(raw_points);	
			for (var i = 0, max_i = raw_points.length; i < max_i; i++) {
				tmp_point = raw_points[i].split(',');
				//alert(tmp_point[0]+' - '+tmp_point[1]);
				
				//points.push(new YMaps.GeoPoint(tmp_point[0],tmp_point[1]));
				points.push([tmp_point[1],tmp_point[0]]);
				
			}
			

/*
			var style = new YMaps.Style();
			style.polygonStyle = new YMaps.PolygonStyle();
			style.polygonStyle.fill = true;
			style.polygonStyle.outline = true;
			style.polygonStyle.strokeWidth = 1;
			style.polygonStyle.strokeColor = zone_data.border_color;
			style.polygonStyle.fillColor = zone_data.color;


			var polygon = new YMaps.Polygon(points, {
				style: style,
				hasHint: 1,
				hasBalloon: 1
			});
*/			
			
	
			
			//polygon.setHintContent(zone_data.title);
			//polygon.setBalloonContent(zone_data.content);



			
			// Создание многоугольника
 			polygon = new ymaps.Polygon([
      		// Координаты многоугольника 
      		points
			], {
      		/* Свойства многоугольника:
         	- контент хинта */
      		hintContent: zone_data.title,
			BalloonContent: zone_data.content     
    		}, {
      		/* Опции многоугольника:
         		- флаг использования заливки */ 
      		fill: true,
      		// - флаг отрисовки контурной линии
      		stroke: true,
      		// - ширина линии
      		strokeWidth: 1,             
      		// - цвет и прозрачность линии
      		strokeColor: zone_data.border_color,
      		// - цвет и прозрачность заливки
      		fillColor: zone_data.color
    		});
	
			
			//alert("00");
			//delete zone_data.points;
			//polygon.metaDataProperty = zone_data;
			return polygon;
		}
		$.getJSON('/delivery/get_zones/', function(data){
			
			
			for (var i = 0; i < data.length; i++) {
				 
				console.log(data[i]);
				var p = makePolygon(data[i]);
				
				console.log("=======");
				console.log(p);
				 
				//map.addOverlay(p);
				//myMap.geoObjects.add(p);
				map.geoObjects.add(p);
				
			}
		});	
	   
	   
	   
});



});


/*$(function(){ 



		$("#delivery_map").css({'width': '460px', 'height': $(window).height()-300});
		var delivery_map = $("#delivery_map");
    	$(window).resize(function(){delivery_map.css({'width': '460px', 'height': $(window).height()-300});});
    	
		
		var map = new YMaps.Map("delivery_map");
    	
		
		
		map.enableScrollZoom();
    	map.addControl(new YMaps.ToolBar());
    	map.addControl(new YMaps.Zoom());
    	map.addControl(new YMaps.ScaleLine());

   		map.setCenter(new YMaps.GeoPoint(37.64, 55.76), 10);
		/*
		function makePolygon(zone_data)
		{
			var raw_points = zone_data.points.split("\n"),
				points = [],
				tmp_point = [];
			for (var i = 0, max_i = raw_points.length; i < max_i; i++) {
				tmp_point = raw_points[i].split(',');
				points.push(new YMaps.GeoPoint(tmp_point[0],tmp_point[1]))
			}

			var style = new YMaps.Style();
			style.polygonStyle = new YMaps.PolygonStyle();
			style.polygonStyle.fill = true;
			style.polygonStyle.outline = true;
			style.polygonStyle.strokeWidth = 1;
			style.polygonStyle.strokeColor = zone_data.border_color;
			style.polygonStyle.fillColor = zone_data.color;

			var polygon = new YMaps.Polygon(points, {
				style: style,
				hasHint: 1,
				hasBalloon: 1
			});
			polygon.setHintContent(zone_data.title);
			polygon.setBalloonContent(zone_data.content);

			delete zone_data.points;
			polygon.metaDataProperty = zone_data;
			
			return polygon;
		}
		$.getJSON('/delivery/get_zones/', function(data){
			for (var i = 0; i < data.length; i++) {
				var p = makePolygon(data[i]);
				map.addOverlay(p);
				
			}
		});	
		*/
	

		


 

/*


});*/