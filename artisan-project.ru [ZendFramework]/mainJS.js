$(document).ready(function () {
    'use strict';
    
    $('.fileStyle').styler({
        selectSearch: true
    });
    
    $('select').styler();
//$('#status').styler{('selectPlaceholder':'Все'});
	
	
	
	

    // $('input[type="checkbox"]').styler();


$(document).delegate('.submitsd', 'click', function () {
       $('.fomadsd').submit();

    });
    /*******************************checkbox***************style*/
    $(document).delegate('.checkBoxFalse', 'click', function () {
        $(this).parent().find('input').trigger('click');
        $(this).hide();
        $(this).siblings('.checkBoxTrue').show();
		$(this).parent().find('label input').removeAttr('disabled');
    });

    $(document).delegate('.checkBoxTrue', 'click', function () {
        $(this).parent().find('input').trigger('click');
        $(this).hide();
        $(this).siblings('.checkBoxFalse').show();
		$(this).parent().find('label input').prop('disabled','disabled');
		
    });
    /****************end***************checkbox***************style*/
    
    $('.jq-file__name').text('Выберите файл');
    $('.jq-file__browse').text('+');
    
    
    $(".datepicker").datepicker({
        monthNames: ['Январь', 'Февраль', 'Март', 'Апрель',
            'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь',
            'Октябрь', 'Ноябрь', 'Декабрь'],
        dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
        firstDay: 1,
        
        changeMonth: true,
        changeYear: true,

        dateFormat: 'dd.mm.yy',
        
        onClose: function (dateText, inst) {
			//alert(dateText);
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate',dateText);
			
			$(".submitsd").click();
        },
        onChangeMonthYear: function (year, month) {
            $("#startYear").val(year);
            $("#startMonth").val(month);
        }
		
		
		
		


    });
	
      $(".datepicker22").datepicker({
        monthNames: ['Январь', 'Февраль', 'Март', 'Апрель',
            'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь',
            'Октябрь', 'Ноябрь', 'Декабрь'],
        dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
        firstDay: 1,
        
        changeMonth: true,
        changeYear: true,

        dateFormat: 'yy.mm.dd',
        
        onClose: function (dateText, inst) {
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate', new Date(year, month, 1));
        },
        onChangeMonthYear: function (year, month) {
            $("#startYear").val(year);
            $("#startMonth").val(month);
			setTimeout(explode, 100);	
        },
		onSelect: function (dateText, inst) {
			//alert(dateText);
			$(".zf_date").val(dateText);
			//check_ship_time();
			//$(this).parent('form').submit();
			
				
			setTimeout(explode, 100);	
			
			
			
			
		
		}
		


    });
	
	
	
	
	
	function explode(){
  			
			//alert("123");
			var date = new Date();
			var m=date.getMonth();
			m=parseInt(m);	
			$(".ui-datepicker-month option").each(function(){
			
				
			var v=$(this).val();
			v=parseInt(v);
			
			var dis=v-m;
			dis=parseInt(dis);
			dis=Math.abs(dis); 
			
			
			if((dis>3) || (v<m)){
				
				$(this).prop('disabled', true);
			}
			
			
			});
		
		
			var cnt=1;
			$('.secondShipping.sendt .ui-datepicker-calendar .ui-datepicker-week-end').each(function(){
		
			if(cnt==2){
			
			var tmp=$(this).html();
		
			//alert(tmp);
			tmp=tmp.replace('<a','<span style="background-color:#bbbbbb;" ');
			tmp=tmp.replace('a>','span>');
			$(this).html(tmp);
			};
			
			cnt=cnt+1;
			if(cnt==3){ cnt=1; };
			});
			
			
			
			
			
			ch();
		
		var tmp=$('select[name="transport_company_id"]').val();
		//alert(tmp);
		var m=tmp.split(' ');
		console.log(m);
		
	
		//$('.secondShipping.sendt .ui-datepicker-calendar tbody tr td').eq(0).css('backgound-color','#013220');
		
		$('.secondShipping.sendt .ui-datepicker-calendar').removeClass('week1');
		$('.secondShipping.sendt .ui-datepicker-calendar').removeClass('week2');
		$('.secondShipping.sendt .ui-datepicker-calendar').removeClass('week3');
		$('.secondShipping.sendt .ui-datepicker-calendar').removeClass('week4');
		$('.secondShipping.sendt .ui-datepicker-calendar').removeClass('week5');
		$('.secondShipping.sendt .ui-datepicker-calendar').removeClass('week6');
		
		for (var i=0;i<m.length;i++) {
			$('.secondShipping.sendt .ui-datepicker-calendar').addClass('week'+m[i]);
			
					
		}
			
		//выходные дни
		
		
		//http://api1.vasha-ats.ru/daytype.php?date=2016-05-09
		
		
		//======
		var time15="15:00";
		$.ajax({
		  	url: "/time.php",
		  	type: "POST",
			async:false,
		 	success: function(data)	{
				time15=data;
		 					
			}
		
		});
		
		
		
		
		$('.secondShipping.sendt .ui-datepicker-calendar td').each(function(){
			
			
			var t=$(this);
			var data_month=t.attr('data-month');
			var data_year=t.attr('data-year');
			var data_day=t.find('a').html();
			if((typeof data_month == "undefined") || (typeof data_year == "undefined") || (typeof data_day == "undefined")){
				
				return;
			}
			
			
			data_month=parseInt(data_month);
			data_day=parseInt(data_day);
			data_month=data_month+1;
			
			if(data_month<10){  data_month='0'+data_month; }
			if(data_day<10){ data_day='0'+data_day; }
			
			var date=data_year+'-'+data_month+'-'+data_day;
			//alert(date);
			
			
			
			
			
			
			//отключить вчерашние дни
			var today = new Date();
			
			var m=today.getMonth();
			var d=today.getDate();
			var y=today.getFullYear();
			
			m=parseInt(m);
			d=parseInt(d);
			m=m+1;
			
			if(m<10){  m='0'+m; }
			if(d<10){ d='0'+d; }
			
			
			today=y+'-'+m+'-'+d;
			//alert(today);
			if(date <= today){
				var tmp=t.html();
				tmp=tmp.replace('<a','<span style="background-color:#bbbbbb;" ');
				tmp=tmp.replace('a>','span>');
				t.html(tmp);
				return;
			}
			
			
			
			//если сейчас больше 15:00, то отключить завтрашний день
			var time = new Date();
			time=time.getHours()+':'+time.getMinutes();
			
			if(time > time15){
				//выключаем завтрашний день
				//var d=date - today;
				
				var date2 = new Date(data_year,data_month-1,data_day),
      			today2 = new Date(y,m-1,d);
				//alert(date2);
			
				//alert(date2);
			
				var d = date2 - today2;
		  		if(d==86400000){
					var tmp=t.html();
					tmp=tmp.replace('<a','<span style="background-color:#bbbbbb;" ');
					tmp=tmp.replace('a>','span>');
					t.html(tmp);
					return;
				}
					
					
			}
			
			
			
			
			
			
			
			var params = {date:date};
			
					$.ajax({
		  				url: "/date.php",
		  				type: "POST",
		  				data: params,
						//async:false,
		 				success: function(data)	{
							//alert(data); 
		 					if(data == '1'){
								var tmp=t.html();
								tmp=tmp.replace('<a','<span style="background-color:#bbbbbb;" ');
								tmp=tmp.replace('a>','span>');
								t.html(tmp);
							}
							
						}
					});
			
			
			
			
			
	
			
			
			
			
			
			
			
			
			
			
			
		
		});
		
		
		//вернуть субботы	
		/*var cnt=1;
			$('.secondShipping.sendt .ui-datepicker-calendar .ui-datepicker-week-end').each(function(){
		
			if(cnt==1){
			
				$(this).find('span').css('background-color','#ffff00');
			
			};
			
			cnt=cnt+1;
			if(cnt==3){ cnt=1; };
			});	
		*/	
			
		
		
		//даты, когда отгрузка возможна
		$('.secondShipping.sendt .ui-datepicker-calendar td').each(function(){
			var b=$(this).find('a').css('background-color');
			 if((b=="rgba(0, 0, 0, 0)") || (b=="rgb(255, 240, 240)") || (b=="transparent")){ $(this).find('a').css('background-color','#ffff00'); }
		});
		
				
		$(".secondShipping.sendt .ui-datepicker-calendar td a").on({
    	mouseenter: function (e) {
			$('.secondShipping.sendt .block_date').html("<p>Имеются отгрузки:</p>");
        	var t=$(this);
			var data_month=t.parent().attr('data-month');
			var data_year=t.parent().attr('data-year');
			var data_day=t.html();
			if((typeof data_month == "undefined") || (typeof data_year == "undefined") || (typeof data_day == "undefined")){
				
				return;
			}
			
			
			data_month=parseInt(data_month);
			data_day=parseInt(data_day);
			data_month=data_month+1;
			
			if(data_month<10){  data_month='0'+data_month; }
			if(data_day<10){ data_day='0'+data_day; }
			
			var date=data_year+'-'+data_month+'-'+data_day;
			
	   		var params = {date:date};
			
					$.ajax({
		  				url: "/date_hover.php",
		  				type: "POST",
		  				data: params,
		 				success: function(data)	{
							if(data=='null'){
								return;	
							}else{
								$('.secondShipping.sendt .block_date').addClass('active'); 
								var p = $.parseJSON(data);
								
								var t="";
								for(var i=0;i<(p.length);i=i+1){
									if(i==(p.length-1)){
										t=t+p[i];
									}else{
										t=t+p[i]+", ";
									}
								}
								var h=$('.secondShipping.sendt .block_date').html();
								h=h+t;
								$('.secondShipping.sendt .block_date').html(h);
								
								$('.secondShipping.sendt .block_date').css('left',e.pageX);
								$('.secondShipping.sendt .block_date').css('top',e.pageY);
								
								
								
							}
		 					
							
						}
					});
					
		
    	},
    	mouseleave: function () {
    		$('.secondShipping.sendt .block_date').removeClass('active'); 
			$('.secondShipping.sendt .block_date').html("<p>Имеются отгрузки:</p>");

		}
		});	
	
		
		
		$(".otgruzkiPage form .datepicker22 a").on('click', function(){
			var color1=$(this).css('background-color');
			if(color1=="rgb(255, 255, 0)"){
				$("#success_modal").css("z-index","9999999999999");
				$("#success_modal").fadeIn(500);
				$("#success_modal .modal-title").html("Доставка в данный день является платной и стоимость доставки будет включена в счет администраторами дилерского отдела");
			}
		
		});
		
		
		
		
		
			
		// добавить год в селектор с месяцем
			var mdate = new Date(); 
			var y=mdate.getFullYear();
			$('.secondShipping.sendt .ui-datepicker-month option').each(function(){
				var h1=$(this).html();
				h1=h1+"  "+y;
				$(this).html(h1);
			});
			 
			
			
			
			
			
			
	}//explode()

		function ch(){
		$('.secondShipping.sendt .ui-datepicker-month').on('change', function() {
		
		ch();
		
		var tmp=$('select[name="transport_company_id"]').val();
		//alert(tmp);
		var m=tmp.split(' ');
		console.log(m);
		
	
		//$('.secondShipping.sendt .ui-datepicker-calendar tbody tr td').eq(0).css('backgound-color','#013220');
		
		$('.secondShipping.sendt .ui-datepicker-calendar').removeClass('week1');
		$('.secondShipping.sendt .ui-datepicker-calendar').removeClass('week2');
		$('.secondShipping.sendt .ui-datepicker-calendar').removeClass('week3');
		$('.secondShipping.sendt .ui-datepicker-calendar').removeClass('week4');
		$('.secondShipping.sendt .ui-datepicker-calendar').removeClass('week5');
		$('.secondShipping.sendt .ui-datepicker-calendar').removeClass('week6');
		
		for (var i=0;i<m.length;i++) {
			$('.secondShipping.sendt .ui-datepicker-calendar').addClass('week'+m[i]);
					
		}
			
		});
		
	}

	
	
	
    $(document).delegate('.dropButton', 'click', function () {
        var a = $('.dropped');
        
        a.slideToggle(100);
    });
    
    $('.dropped').slideUp(100);
    
    /*****************************/
    
    $(document).delegate('.sentClaim', 'click', function () {
        //window.open('pretenziiOdna.html');
    });
    
    
    /******************************/

    /********scrolll*/

    $('.claimPopUp .wrap').mCustomScrollbar({/****customize scrollbar*/
        scrollInertia: 0,
        mouseWheelPixels: 100,
        advanced:{updateOnContentResize:true},
        theme: "my-theme2"
    });

    $('.claimPopUp .tableWrap').mCustomScrollbar({/****customize scrollbar*/
        axis: "x",
        scrollInertia: 0,
        mouseWheelPixels: 100,
        advanced:{updateOnContentResize:true,
            autoExpandHorizontalScroll:true
        },
        theme: "my-theme3"
    });


    /*******end scrolll*/
    $('.header .box:last-child .block:last-child a').click(function(){
		
		if($('.header .box:last-child .block:last-child span').css('display')=="block"){
			$('.header .box:last-child .block:last-child span').fadeOut(500);	
		}else{
			$('.header .box:last-child .block:last-child span').fadeIn(500);	
		}
		
	});
	$('.editInfo').click(function(){
		$('.mainData').find('.dsd').removeAttr('disabled').removeAttr('style');
		$('.lichnyeDannye').find('.pair2').css("display", "inline");
		$('.editInfo').hide();
	});
	$('.ssasa').click(function(){
		$('.mainData').find('.dsd').prop('disabled','disabled').prop('style','color: rgb(0, 0, 0); border-color: transparent; background-color: rgb(249, 249, 249);');
		$('.lichnyeDannye').find('.pair2').css("display", "none");
		$('.editInfo').show();
	});
	
	
	
	$('.sendlk').click(function(){
		$.post("/profile/edit/", { title: $('input[name=title]').val(), city: $('input[name=city]').val(),login:$('input[name=login]').val(), description:$('input[name=description]').val(),mail: $('input[name=mail]').val(), phone: $('input[name=phone]').val() },function(data){
			if(data=="ok"){
				$.post("/profile/edit_inf/", { legal_entity: $('input[name=legal_entity]').val(), legal_address: $('input[name=legal_address]').val(),actual_address:$('input[name=actual_address]').val(), inn:$('input[name=inn]').val(),bik: $('input[name=bik]').val(), current_account: $('input[name=current_account]').val(), bank: $('input[name=bank]').val(),correspondent_account: $('input[name=correspondent_account]').val(), dop_title: $('input[name=title]').val(), dop_city: $('input[name=city]').val(),dop_login:$('input[name=login]').val(), dop_description:$('input[name=description]').val(),dop_mail: $('input[name=mail]').val(), dop_phone: $('input[name=phone]').val() },function(data2){
					if(data2=="ok"){
						alert(data2);
						document.location.href="/profile/";
					}
				});
			}
		});
		
	});
	
	$.post("test.php", { name: "John", time: "2pm" } );
	
	
	function d(th,n){
		$('form.complaint #deleted_files').val("");
		
  		var files=document.getElementById("file__"+n+"").files;
		var names="";
		for(var i=0;i<files.length;i++){
			names=names+"<p><span><span>"+files[i].name+"</span>  <a href='javascript:void(0)' class='closeButton'></a></span></p>";
			
		}
		//alert(names);
		var names1=$('form.complaint .files_list').html();
		
		names1=names1+names;
		$('form.complaint .files_list').html(names1);
		
		$('form.complaint .files_list p a').on('click', function(){
	
			$(this).parent().parent().fadeOut(500);
			var d=$(this).parent().find('span').html();
			var t=$('form.complaint #deleted_files').val();
			if(t==""){
				t=d;
			}else{
				t=t+","+d;
			}
			$('form.complaint #deleted_files').val(t);
			
			
			
			
		});
		
		
		//добавить новую кнопку и скрыть старую
		th.parent().css('display','none');
		th.parent().removeClass('show');
		th.parent().addClass('hide');
		
		var t=$("form.complaint .button_containers").html();
		
		//var count = $('form.complaint input.fileStyle').size();
		var count = th.attr('data-id');
		count=parseInt(count)+1;
		
		
		//t=t+'<div id="file_=_'+count+'-styler" class="jq-file fileStyle" style="display: inline-block; position: relative; overflow: hidden"><div class="jq-file__name">Выберите файл</div><div class="jq-file__browse">+</div><input class="fileStyle" type="file" id="file_=_'+count+'" name="file[]" multiple="" style="position: absolute; top: 0px; right: 0px; width: 100%; height: 100%; opacity: 0; margin: 0px; padding: 0px;"></div>';
		//$("form.complaint .button_containers").html(t);
		
		
		$('form.complaint input.fileStyle#file__'+count+'').removeClass('hide');
		$('form.complaint input.fileStyle#file__'+count+'').addClass('show');
		
		$('form.complaint #file__'+count+'-styler').removeClass('hide');
		$('form.complaint #file__'+count+'-styler').addClass('show');
		
		
		
		//$('form.complaint input.fileStyle#file__'+count+'').on('change', function(){
			
		//	d($(this),count);
			
		//});
		
		
		
		
	}
	
	
	//полный заголовок новости в ленте
var title_tmp="";	
var w="";
$('.container_feed .feed li a').hover(
function(){
w=$(this).width();
title_tmp=$(this).html();
var title_full=$(this).attr('data-h');
$(this).html(title_full);

$(this).parent().width(w);
$(this).css('position','absolute');
$(this).css('background-color','#FF9F00');
$(this).css('width','auto');
$(this).css('padding-right','20px');
$(this).css('margin-right','0px');

$(this).parent().find('span').css('margin-top','34px');
$('.container_feed .feed li').css('height','58px');
$(this).css('z-index','10');
},
function(){
	
$(this).html(title_tmp);
//$(this).css('position','relative');
//$(this).parent().find('span').css('margin-top','0px');
$(this).css('z-index','1');
$(this).width(w);
});
	
	
	
	
	
	
	
	//выбор файлов в претензии
	$('form.complaint input.fileStyle').change(function(){
		var count2=$(this).attr('data-id');
		d($(this),count2);
		
	});
	
	
	$('.oneClaim .message img').click(function(){
		$('#img').fadeIn(500);
		var t=$(this).attr('src');
		$('#img .modal-body').html('<img src="'+t+'" alt=""/>');
		$('#img .modal-title a').attr('href','/complaints/download?file_name='+t);
		var w=$('#img img').width();
		w=w+30;
		$('#img.modal .modal-dialog').width(w);
		
		
	});
	
	$('#img.modal .close').click(function(){
		$('#img').fadeOut(500);
	});
	
});

$(window).load(function () {

	var h=$("body").height();
  	var h2=screen.height;
	
	if(h < h2){
		$(".mainPart").css("min-height",(h2-580)+"px");	
	}
  
});




	





