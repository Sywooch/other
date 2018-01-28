var myPlacemarkFrom, myPlacemarkTo;
var coordsFrom, coordsTo;
var distance;
var country, region, city, address;
var route;

var directionsDisplay = new google.maps.DirectionsRenderer();
var directionsService = new google.maps.DirectionsService();

$(document).ready(function()
{
    $('#date').datepicker();
    $('#time').timepicker({timeFormat: "hh:mm", altFieldTimeOnly: true, amPmText: ['', '']});
    
    $('.load-photo').click(function(e)
    {
        e.preventDefault();
        
        $('#load-photo').click();
    
        return false; 
    });
    
    $('#load-photo').change(function()
    {
        text = $.trim($('#load-photo').val());
        slashIndex = text.lastIndexOf('\\') + 1;
        text = text.substr(slashIndex);
        
        $('.load-photo').val('Выбранное фото: ' + text);
    });
    
//    $('.from, .from-street').click(function() { if (!myPlacemarkFrom) { $('.fancybox').click(); } });
//    $('.to, .to-street').click(function() { if (!myPlacemarkTo) { $('.fancybox').click(); } });
    
    $('.to-street').on('blur', function() 
    { 
        if ($('.from').val().length && $('.from-street').val().length && $('.to').val().length && $('.to-street').val().length)
        {
            calcRoute();
        }
        else
        {
            // если нужно будет что-то сказать клиенту, что он не всё заполнил
        }
    });
    
    ymaps.ready(function () 
    {         
        // Устанавливаем ширину/высоту контейнера карты
        $('#inline1').css({width: $(window).width() - 400, height: $(window).height() - 200});
        $('.fancybox').fancybox(
        {
            afterShow: function ()
            {
                // Если карту не создали ранее
                if (!window.myMap)
                {
                    // Создаём её
                    window.myMap = new ymaps.Map("inline1", 
                    {
                        center: [ymaps.geolocation.latitude, ymaps.geolocation.longitude],
                        zoom: 10,
                        behaviors: ["scrollZoom", "drag"]
                    });
                    
                    // Добавляем на карту контролы
                    window.myMap.controls.add('zoomControl').add('miniMap').add('typeSelector').add('mapTools').add('searchControl');
                    
                    // Добавляем слушателя кликов по карте
                    window.myMap.events.add('click', function (e) 
                    {
                        // Если метка «От» ещё не создана – создаём
                        if (!myPlacemarkFrom) 
                        {
                            coordsFrom = e.get('coords');
                            myPlacemarkFrom = createPlacemark(coordsFrom, "A");
                            window.myMap.geoObjects.add(myPlacemarkFrom);
                            
                            // Добавляем слушателя передвижения метки «От»
                            myPlacemarkFrom.events.add('dragend', function () 
                            {    
                                coordsFrom = myPlacemarkFrom.geometry.getCoordinates();
                                
                                // Если обе метки установлены - считаем и актуализируем расстояние
                                if (myPlacemarkTo)       
                                {
                                    ymaps.route([[coordsFrom], [coordsTo]], {}).then(function (router) 
                                    {
                                        route = router;
                                        distance = route.getLength() * 0.001;
                                        $('#distance').val(Math.floor(distance));    
                                    });
                                }
                                
                                // Устанавливаем на форме адрес метки «От»
                                getAddress('from', coordsFrom);
                            });
                            
                            getAddress('from', coordsFrom);
                        }
                        // Если метка «До» ещё не создана – создаём
                        else if (!myPlacemarkTo)
                        {
                            coordsTo = e.get('coords');
                            myPlacemarkTo = createPlacemark(coordsTo, "B");
                            window.myMap.geoObjects.add(myPlacemarkTo);
                            
                            // Добавляем слушателя передвижения метки «До»
                            myPlacemarkTo.events.add('dragend', function () 
                            {
                                coordsTo = myPlacemarkTo.geometry.getCoordinates();
                                
                                // Если обе метки установлены - считаем и актуализируем расстояние
                                if (myPlacemarkFrom)
                                {
                                    ymaps.route([[coordsFrom], [coordsTo]], {}).then(function (router) 
                                    {
                                        route = router;
                                        distance = route.getLength() * 0.001;
                                        $('#distance').val(Math.floor(distance));    
                                    });
                                }
                                
                                // Устанавливаем на форме адрес метки «До»
                                getAddress('to', coordsTo);
                            });
                            
                            // Устанавливаем на форме адрес метки «От»
                            getAddress('to', coordsTo);
                        }
                        
                        // Если установлены обе метки -вычисляем и записываем расстояние
                        if (coordsFrom && coordsTo)
                        {
                            ymaps.route([[coordsFrom], [coordsTo]], {}).then(function (router) 
                            {
                                route = router;
                                distance = route.getLength() * 0.001;
                                $('#distance').val(Math.floor(distance));    
                            });
                            
                            //BuildRoute([[coordsFrom], [coordsTo]]);
                        }
                    });

                    // Функция создания метки
                    function createPlacemark(coords, icon_content) 
                    {
                        return new ymaps.Placemark(coords, 
                        {
                            iconContent: icon_content
                        }, 
                        {
                            draggable: true
                        });
                    }

                    // Фукнкция определения адреса по координатам (обратное геокодирование)
                    function getAddress(placemark, coords) 
                    {     
                        ymaps.geocode(coords).then(function (res) 
                        {
                            arr = [];
                            
                            id = 0;
                            res.geoObjects.each(function (obj) 
                            {
                                value = obj.properties.get('name');
                                
                                if (id == 0)
                                {
                                    $('#country_' + placemark).val(value);
                                }
                                
                                if (value.toLowerCase().indexOf("область") >= 0 || value.toLowerCase().indexOf("москва") >= 0)
                                {
                                    $('#region_' + placemark).val(value);
                                }
                                
                                arr.push(value);
                            });
                        });
                        
                        ymaps.geocode(coords, {json: false, kind: "locality", results: 1}).then(function (res) 
                        {
                            res.geoObjects.each(function (obj) 
                            {                                           
                                city = obj.properties.get('name');
                            });
                            
                            ymaps.geocode(coords, {json: false, kind: "house", results: 1}).then(function (res) 
                            {
                                res.geoObjects.each(function (obj) 
                                {
                                    address = obj.properties.get('name');
                                });
                                
                                if (placemark == 'from')
                                {
                                    $('input.from').val(city);
                                    $('input.from-street').val(address);
                                }
                                else if (placemark == 'to')
                                {
                                    $('input.to').val(city);
                                    $('input.to-street').val(address);
                                }
                            });
                        });
                        
                        $('#coords_' + placemark).val(coords);
                    }
                }
            },
            afterClose: function () 
            {
//                window.myMap.destroy();
//                window.myMap = null;
//                myPlacemarkFrom = null;
//                myPlacemarkTo = null;
            }
        });
    });
    
    function ClearRoute()
    {
        
    }
    
    function BuildRoute(points)
    {
        ymaps.route(points, 
        {
            // Опции маршрутизатора
            // автоматически позиционировать карту
            mapStateAutoApply: true 
        })
        .then(function (router) 
        {
            route = router;
            myMap.geoObjects.add(route);
            
            myPlacemarkFrom.events.add('dragend', function () 
            {    
                coordsFrom = myPlacemarkFrom.geometry.getCoordinates();
                
                // Если обе метки установлены - считаем и актуализируем расстояние
                if (myPlacemarkTo)       
                {
                    ymaps.route([[coordsFrom], [coordsTo]], {}).then(function (router) 
                    {
                        route = router;
                        distance = route.getLength() * 0.001;
                        $('#distance').val(Math.floor(distance));    
                    });
                }
                
                // Устанавливаем на форме адрес метки «От»
                getAddress('from', coordsFrom);
            });
            
            myPlacemarkTo.events.add('dragend', function () 
            {
                coordsTo = myPlacemarkTo.geometry.getCoordinates();
                
                // Если обе метки установлены - считаем и актуализируем расстояние
                if (myPlacemarkFrom)
                {
                    ymaps.route([[coordsFrom], [coordsTo]], {}).then(function (router) 
                    {
                        route = router;
                        distance = route.getLength() * 0.001;
                        $('#distance').val(Math.floor(distance));    
                    });
                }
                
                // Устанавливаем на форме адрес метки «До»
                getAddress('to', coordsTo);
            });
        }
        ,function (error) { alert("Возникла ошибка: " + error.message) }
        );   
    }
});

function calcRoute() 
{
    var start = $('input.from').val() + ', ' + $('input.from-street').val();
    var end   = $('input.to').val() + ', ' + $('input.to-street').val();
    
    var request = {
        origin:start, //точка, с которой будет начинаться маршрут
        destination:end,//точка, в которой будет заканчиваться маршрут
        //waypoints //массив точек, которые надо обойти 
        //optimizeWaypoints //признак возможности оптимизации точек в массиве. true, тогда для алгоритма будет не важен порядок обхода точек.

        travelMode: google.maps.DirectionsTravelMode.DRIVING//признак того, какой вид транспорта используется. Мы ищем маршрут для
    };
    
    // функция построения оптимального маршрута
    directionsService.route(request, function(response, status) 
    {
        console.log(response, status);
        
        tmpResponse = response;
        
        if (status == google.maps.DirectionsStatus.OK) 
        {
            leg_last = tmpResponse.routes[0].overview_path.length - 1;
            
            $('#coords_from').val(response.routes['0']['overview_path']['0'].k + ',' + response.routes['0']['overview_path']['0'].B);
            $('#coords_to').val(response.routes['0']['overview_path'][leg_last].k + ',' + response.routes['0']['overview_path'][leg_last].B);
    
            directionsDisplay.setDirections(response);
            computeTotalDistance(directionsDisplay.directions);
        }
    });
}

function computeTotalDistance(result)
{
    var total = 0;
    var myroute = result.routes[0];
    
    for (i = 0; i < myroute.legs.length; i++) 
    {
        total += myroute.legs[i].distance.value;
    }
    
    total = total / 1000;
    
    $('#distance').val(Math.floor(total));

    /*
    document.getElementById("total").innerHTML = "Расстояние пройденное техникой: " + total + " км";
    
    if(document.getElementById("tarif").value)
        document.getElementById("result").innerHTML = "Стоимость аренды техники: " + total * document.getElementById("tarif").value;
    else
        alert("Заполните поле \"Tариф (ставка за 1 километр)\", что бы узнать стоимость аренды техники");
    */
}