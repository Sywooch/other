$(function () {
	'use strict';


var start_color=randomColor();





var el = $('.main-element');
var flag=0; //если здачение =1, то анимация в данный момент выполняется
el.css('background-color', start_color);

var end_color="";
var current_color=new Array();
var delta_1="";
var delta_2="";
var delta_3="";
var current_hex="";
var start_rgb=new Array();
var end_rgb=new Array();
var down=1;//основное направление движения
var down_delta=1;//направление текущего шага
var current_radius=0;

var step=5;//количество шагов, которое требуется для прохода пути
// 5 - для ПК, 2 - для мобильных

if(device.mobile()==true || device.tablet()==true){
	step=2;	
	
};
var startPos=0,
	self = $(this);


$(window).bind('touchstart', function(event) {
	var e = event.originalEvent;
    startPos = self.scrollTop() + e.touches[0].pageY;
});


$(window).bind('mousewheel touchmove', function (event, delta) {
	
	if(device.mobile()==true || device.tablet()==true){

		var e = event.originalEvent;
		if((startPos - e.touches[0].pageY)>0){
		//двинули пальцем вверх - фигуру поднимает наверх
			delta=1;			
			
		}else{
		//двинули пальцем вниз - фигуру тащим вниз
			delta=-1;
			
		}
		
	}
	
	
	if(flag==1){ return false; }
	
	var browserH=$(window).height(); //высота окна браузера
	//alert(browserH);
	//var change=Math.floor((browserH-40)/(parseInt(step)+1));
	var change=(browserH-40-el.height()-10)/(parseInt(step));
	//alert(change);
	
	var top=el.css('top');
	top=top.replace("px","");
	
	
	if(delta<0){
		
		down_delta=1;
		if(top/1+el.height()>=(browserH-20-change)){
			return false;
		}
		
		
	}else{
		down_delta=0;
		if(top<=20){
			return false;
		}
		

	}	
	
	
	
	
	
	
	if(end_color==""){ 
		end_color=randomColor(); 
	
	
		//получить промежуточные цвета
		start_rgb=hexDec(start_color);
		end_rgb=hexDec(end_color);
		
		delta_1=Math.floor(Math.abs(start_rgb[0]-end_rgb[0])/step);
		delta_2=Math.floor(Math.abs(start_rgb[1]-end_rgb[1])/step);
		delta_3=Math.floor(Math.abs(start_rgb[2]-end_rgb[2])/step);
		
		//alert("1="+delta_1+" "+delta_2+" "+delta_3);
		
		
		
		//if(delta<0){
		//	шаг вниз
		//если основное направление и направление текущего шага совпадают
		if(down_delta==down){
		
			
			if(start_rgb[0]>end_rgb[0]){
				current_color[0]=start_rgb[0]-delta_1/1;
			}else{
				current_color[0]=start_rgb[0]+delta_1/1;
			}
			
			if(start_rgb[1]>end_rgb[1]){
				current_color[1]=start_rgb[1]-delta_2/1;
			}else{
				current_color[1]=start_rgb[1]+delta_2/1;
			}
			
			if(start_rgb[2]>end_rgb[2]){
				current_color[2]=start_rgb[2]-delta_3/1;
			}else{
				current_color[2]=start_rgb[2]+delta_3/1;
			}
		
		}else{
			//основное направление и направление текущего шага не совпадают
			//например на пол пути решили шагнуть вверх 
			
			if(start_rgb[0]>end_rgb[0]){
				current_color[0]=start_rgb[0]+delta_1/1;
			}else{
				current_color[0]=start_rgb[0]-delta_1/1;
			}
			
			if(start_rgb[1]>end_rgb[1]){
				current_color[1]=start_rgb[1]+delta_2/1;
			}else{
				current_color[1]=start_rgb[1]-delta_2/1;
			}
			
			if(start_rgb[2]>end_rgb[2]){
				current_color[2]=start_rgb[2]+delta_3/1;
			}else{
				current_color[2]=start_rgb[2]-delta_3/1;
			}
			
			
		}
		
		//alert("1="+current_color[0]+" "+current_color[1]+" "+current_color[2]);
		
		current_hex=getHexColor('rgb('+current_color[0]+', '+current_color[1]+', '+current_color[2]+')');
		//alert("1="+current_hex);
	}else{
		
		//alert("2="+delta_1+" "+delta_2+" "+delta_3);
		
		
		//if(delta<0){
			//шаг вниз
		//если основное направление и направление текущего шага совпадают
		if(down_delta==down){			
		
			if(start_rgb[0]>end_rgb[0]){
				current_color[0]=current_color[0]-delta_1/1;
			}else{
				current_color[0]=current_color[0]+delta_1/1;
			}
			
			if(start_rgb[1]>end_rgb[1]){
				current_color[1]=current_color[1]-delta_2/1;
			}else{
				current_color[1]=current_color[1]+delta_2/1;
			}
			
			if(start_rgb[2]>end_rgb[2]){
				current_color[2]=current_color[2]-delta_3/1;
			}else{
				current_color[2]=current_color[2]+delta_3/1;
			}
		
		
		}else{
			////основное направление и направление текущего шага не совпадают
			
			if(start_rgb[0]>end_rgb[0]){
				current_color[0]=current_color[0]+delta_1/1;
			}else{
				current_color[0]=current_color[0]-delta_1/1;
			}
			
			if(start_rgb[1]>end_rgb[1]){
				current_color[1]=current_color[1]+delta_2/1;
			}else{
				current_color[1]=current_color[1]-delta_2/1;
			}
			
			if(start_rgb[2]>end_rgb[2]){
				current_color[2]=current_color[2]+delta_3/1;
			}else{
				current_color[2]=current_color[2]-delta_3/1;
			}
			
		}
		
		
		
		//alert("2="+current_color[0]+" "+current_color[1]+" "+current_color[2]);
		current_hex=getHexColor('rgb('+current_color[0]+', '+current_color[1]+', '+current_color[2]+')');	
		//alert("2="+current_hex);
	}
	
	
	var flag_color_end=0;	
	//alert(delta);
	
	
	if(delta<0){
		
		//alert( top/1+el.height()+" == "+(browserH-10) );
		
		if(top/1+el.height()<(browserH-20-change)){
			top=top/1+change;
		}else{
			flag_color_end=1; 
			return false;	
		}
		
		
		if(top/1+el.height()+change>(browserH-20)){
			flag_color_end=1;
					
			//достигли нижней крайней точки
			down=0;	
}
		current_radius=(current_radius/1)+(50/step);
		
	}else{
		if(top>20){
			top=top-change;
		}else{
			flag_color_end=1; 
			return false;	
		}
		
		
		if(top==20){
			flag_color_end=1;
			
			//достигли верхней крайней точки
			down=1;	
		}
		current_radius=current_radius-(50/step);
	}
	
	//перед запуском анимации отключить колёсико
	flag=1;
	
	//alert(top);
	
	el.animate({ 
	"top": top+"px", 
	"backgroundColor": current_hex, 
	"borderRadius": current_radius,
	"MozBorderRadius": current_radius, 
	"WebkitBorderRadius": current_radius,
	'borderBottomLeftRadius': current_radius,
    'borderBottomRightRadius': current_radius,
    'borderTopLeftRadius': current_radius,
    'borderTopRightRadius': current_radius,
	'MozBorderBottomLeftRadius': current_radius,
    'MozBorderBottomRightRadius': current_radius,
    'MozBorderTopLeftRadius': current_radius,
    'MozBorderTopRightRadius': current_radius,
	'WebkitBorderBottomLeftRadius': current_radius,
    'WebkitBorderBottomRightRadius': current_radius,
    'WebkitBorderTopLeftRadius': current_radius,
    'WebkitBorderTopRightRadius': current_radius
	
	}, 400, function() { flag=0; } );
	
	$(".block-final-color").css("background-color",end_color);
	//$("body").css("background-color",end_color);
	
	if(flag_color_end==1){
		
		start_color=end_color;
		end_color="";
	}
	




});




 
//получение RGB из HEX 
function hexDec(h){
var m=h.slice(1).match(/.{2}/g);
 
m[0]=parseInt(m[0], 16);
m[1]=parseInt(m[1], 16);
m[2]=parseInt(m[2], 16);
 
return m;
};

//получение HEX из RGB
function getHexColor(color){
    color = color.replace(/\s/g,"");
    var colorRGB = color.match(/^rgb\((\d{1,3}[%]?),(\d{1,3}[%]?),(\d{1,3}[%]?)\)$/i);
    var colorHEX = '';
    for (var i=1;  i<=3; i++){
        colorHEX += Math.round((colorRGB[i][colorRGB[i].length-1]=="%"?2.55:1)*parseInt(colorRGB[i])).toString(16).replace(/^(.)$/,'0$1');
    }
    return "#" + colorHEX;
}



});


