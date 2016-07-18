$(document).ready(function () {
    'use strict';

    // $(document).delegate('.jq-checkbox', 'click', function () {
    //      if ($(this).find('input').is(':checked')) {
    //         alert('helo');
    //      }
    // });
    
    /*************************************************************************steps*
********************************************************************************/  
    
	
	
	$('.secondShipping .step2 input[type="checkbox"]').change(function() {
		var cnt=1;
		$('.secondShipping .step2 input[type="checkbox"]').each(function(){
			 //cnt=0;

			if($(this).is(':checked')){
				//cnt=1;				
			}else{
				cnt=0;	
			}
			
			
			
			
			//if($(this).is(':checked')=='false'){
			//	alert("f");	
			//}
		});
		
		
		if(cnt===0){
			//частичный выбор
			//alert("p");
			$('.otgruzkiPage #partially').val('1');
			
		}else{
			$('.otgruzkiPage #partially').val('0');
			
		}
		
	
	});
	   
	
    /***********************adding new shipping to the list************/
    $('.step1 input[type="checkbox"]').click(function () {
        var $name = $(this).siblings().find('.number').text(),
            $palceToInsert = $('.otgruzkiSecond .shippingList span'),
            added = $('.otgruzkiSecond .shippingList .number');

        if ($(this).is(':checked')) {
            $('<a href="javascript:void(0)" class="number" id="' + $name + '">' + $name + '</a>').insertAfter($palceToInsert);
        } else {
            for (var i = 0; i < added.length; i++) {
                if ($(added[i]).text() == $name) {
                    $(added[i]).remove();
                }
            }
        
		}
		
		
		
		//сделать все чебоксы активными
		//secondShipping  
		$(".secondShipping."+$name+" input[type='checkbox']").each(function(){
			
			//$(this).attr('checked', 'checked');
			
		});
		 
		$(".secondShipping."+$name+" .checkBoxTrue").each(function(){
		 	//$(this).css('display','block');
			$(this).css('top','9px');
			
		});
		
		$(".secondShipping."+$name+" .checkBoxFalse").each(function(){
			if($(this).hasClass('i_alert')==false){
				$(this).css('display','block');
			}
			$(this).css('top','9px');
		
		});
		
		$(".secondShipping."+$name+" input[type='number']").each(function(){
			//$(this).prop('disabled', false);
		});
		 	
		 
    });
	
	
	//$('form').submit(function(){
	//	var chk = $(this).find('input[type=checkbox]:checked').length;
		//alert(chk);
	//});
	
	
	
	
	
    
    
    $('.secondShipping .queue.step5 .radioBox input#all').click(function () {
    	$('.otgruzkiPage.otgruzkiSecond .step5 .bill .inputs input[type="number"]').prop('disabled', false);
		$('.otgruzkiPage.otgruzkiSecond .step5 .bill .imit').css('display','none');
    });
	
    $('.secondShipping .queue.step5 .radioBox input#part').click(function () {
    	$('.otgruzkiPage.otgruzkiSecond .step5 .bill .imit.checkBoxTrue').css('display','block');
		$('.otgruzkiPage.otgruzkiSecond .step5 .bill .inputs input[type="number"]').prop('disabled', false);
		$('.otgruzkiPage.otgruzkiSecond .step5 .bill .imit').css('top','9px');
		
    });
	
	
	$('.secondShipping .queue .radioBox input#part').click(function () {
		$(this).parent().parent().find('input[type="number"]').prop('disabled',false);
		$(this).parent().parent().find('.checkBoxWarning').fadeOut(100);
		
		$(this).parent().parent().find('input:checkbox').removeAttr("checked");
		
		
		/*$(this).parent().parent().find('.checkBoxTrue').removeClass('i_display');
		$(this).parent().parent().find('.checkBoxTrue').addClass('i_none');
		$(this).parent().parent().find('.checkBoxFalse').addClass('i_display');
		$(this).parent().parent().find('.checkBoxFalse').removeClass('i_none');
		*/
		$(this).parent().parent().find('.checkBoxTrue').fadeOut(100);
		$(this).parent().parent().find('.checkBoxFalse').fadeIn(100);
		
	});
	
	$('.secondShipping .queue .radioBox input#all').click(function () {
		$(this).parent().parent().find('input[type="number"]').prop('disabled',true);
		$(this).parent().parent().find('.checkBoxWarning').fadeIn(100);
		
		$(this).parent().parent().find('input:checkbox').prop("checked", true);
		
		
		/*$(this).parent().parent().find('.checkBoxTrue').removeClass('i_display');
		$(this).parent().parent().find('.checkBoxTrue').addClass('i_none');
		$(this).parent().parent().find('.checkBoxFalse').addClass('i_display');
		$(this).parent().parent().find('.checkBoxFalse').removeClass('i_none');
		*/
		$(this).parent().parent().find('.checkBoxTrue').fadeIn(100);
		$(this).parent().parent().find('.checkBoxFalse').fadeOut(100);
		
	});	
    
    /*************step3*******/
    function runStep3 (idNumber) {
        $('.otgruzkiPage.otgruzkiSecond .prev.thirdBtn').click(function () {
		//	alert("3");
        var $parentElementStep3 = $(this).closest('.step3'),
            $prevElement = $parentElementStep3.prev();
        
            /*console.log(idNumber);*/
        $('.otgruzkiPage.otgruzkiSecond .shippingList .details').removeClass('active');
        $('.otgruzkiPage.otgruzkiSecond .shippingList .number').removeClass('active');
        $(idNumber).addClass('active');
        $parentElementStep3.hide();
        $prevElement.show();
        
        })
    }
    /***********end********step3*/
    /**********************************1step*/
    $('.otgruzkiPage.otgruzkiSecond .firstBtn').click(function () {
		var id=$('.otgruzkiPage.otgruzkiSecond .shippingList .number:first');
		
		if(id.attr('id')){
		
			$('.secondShipping').hide();
			//$('.otgruzkiPage.otgruzkiSecond .shippingList .details').removeClass('active');
			$('.step1').hide();
			//$(id).removeClass('active');
			$('.' + $(id).attr('id') +' .queue').show();
			$('.' + $(id).attr('id')).show();
			$(id).addClass('active');
		}else{
			//alert('Необходимо выбрать счет.');
			$("#success_modal .modal-title").html("Необходимо выбрать счет.");
			$("#success_modal").fadeIn(500);
			
		}
	
	
    });  
	
 
    /******************end****************1step*/
    /****************************step2*/
	
	
	
	$('.otgruzkiPage.otgruzkiSecond .shippingList > span > a').click(function () {
		
		var id=$('.otgruzkiPage.otgruzkiSecond .shippingList .active');
		var next= $('.otgruzkiPage.otgruzkiSecond .shippingList .active').prev();

		if(next.attr('id')){
		
			$('.secondShipping').hide();
			//$('.otgruzkiPage.otgruzkiSecond .shippingList .details').removeClass('active');
			$('.step1').hide();
			$(id).removeClass('active');
			$('.' + $(next).attr('id') +' .queue').show();
			$('.' + $(next).attr('id')).show();
			$(next).addClass('active');
		}else{
			$('.otgruzkiPage.otgruzkiSecond .shippingList .active.number').removeClass('active');
			$('.secondShipping').hide();
			$('.step1').show();			
		}
	
		
	
		
	});	
	
	
	
    $('.otgruzkiPage.otgruzkiSecond .prev.secondBtn').click(function () {
		
		
		var id=$('.otgruzkiPage.otgruzkiSecond .shippingList .active');
		var next= $('.otgruzkiPage.otgruzkiSecond .shippingList .active').prev();

		if(next.attr('id')){
		
			$('.secondShipping').hide();
			//$('.otgruzkiPage.otgruzkiSecond .shippingList .details').removeClass('active');
			$('.step1').hide();
			$(id).removeClass('active');
			$('.' + $(next).attr('id') +' .queue').show();
			$('.' + $(next).attr('id')).show();
			$(next).addClass('active');
		}else{
			$('.otgruzkiPage.otgruzkiSecond .shippingList .active.number').removeClass('active');
			$('.secondShipping').hide();
			$('.step1').show();			
		}
	
		//сбросить чебоксы
		/*
		$("form input[type='checkbox']").each(function(){
			$(this).removeAttr("checked");
		});
		
		$("form .imit.checkBoxTrue").each(function(){
			$(this).css('display','none');
		});
		
		$("form .imit.checkBoxFalse").each(function(){
			$(this).css('display','block');
		});
		*/
	
	
        /*$('.otgruzkiPage.otgruzkiSecond .shippingList .active.number').removeClass('active');
        
        $('.otgruzkiPage.otgruzkiSecond .step2').hide();
        $('.otgruzkiPage.otgruzkiSecond .step1').show();*/
    });
    
	
	$('.details').click(function () {
	
	var id=$('.otgruzkiPage.otgruzkiSecond .shippingList .number:first');
		
	if(id.attr('id')){
	
		var id=$('.otgruzkiPage.otgruzkiSecond .shippingList .active.number');
		var next= $('.otgruzkiPage.otgruzkiSecond .shippingList .active.number').next();
		if(next.attr('id')){
			$('.secondShipping').hide();
			//$('.otgruzkiPage.otgruzkiSecond .shippingList .details').removeClass('active');
			$('.step1').hide();
			$(id).removeClass('active');
			$('.' + $(next).attr('id') +' .queue').show();
			$('.' + $(next).attr('id')).show();
			$(next).addClass('active');
		}else{
		$('.step1').hide();
			$('.otgruzkiPage.otgruzkiSecond .shippingList .active.number').removeClass('active');
			$('.secondShipping').hide();
			$('.sendt').show();			
		}
		
	}else{
		alert('Необходимо выбрать счет.');
	}		
		
		
		
		
	
    });
	
	$('.otgruzkiPage.otgruzkiSecond .next').click(function () {
		//перебрать поля ввода с метрами и сэмулировать на них потерю фокуса
		//alert("11");
		//$('input[name="count[]"]').each(function(indx, element){
		//	$(this).input();
		//	$(this).keypress();
		// });
	});
	
	
	$(".bill .checkBoxFalse").click(function () {
		$('input[name="count[]"]').each(function(indx, element){
			$(this).input();
			$(this).keypress();
		 });
	
	});
	
	
    $('.otgruzkiPage.otgruzkiSecond .next.secondBtn').click(function () {
	
		var id=$('.otgruzkiPage.otgruzkiSecond .shippingList .active.number');
		var next= $('.otgruzkiPage.otgruzkiSecond .shippingList .active.number').next();
		if(next.attr('id')){
			$('.secondShipping').hide();
			//$('.otgruzkiPage.otgruzkiSecond .shippingList .details').removeClass('active');
			$('.step1').hide();
			$(id).removeClass('active');
			$('.' + $(next).attr('id') +' .queue').show();
			$('.' + $(next).attr('id')).show();
			$(next).addClass('active');
		}else{
		$('.step1').hide();
			$('.otgruzkiPage.otgruzkiSecond .shippingList .active.number').removeClass('active');
			$('.secondShipping').hide();
			$('.sendt').show();			
		}
	
    })
    /******************end*************step2*/
    /************step2**alert******/
    $('.otgruzkiPage.otgruzkiSecond .step2.alert .prev.alertBtn').click(function () {
		//alert("2");
         var $a = $('.otgruzkiPage.otgruzkiSecond .shippingList .active.number').text(),
            $parentElement = $(this).closest('.' + $a);
        
        $parentElement.find('.step2').show();
        $parentElement.find('.step2.alert').hide();
    });
    
    $('.otgruzkiPage.otgruzkiSecond .step2.alert .next.alertBtn').click(function () {
        var $b = $('.otgruzkiPage.otgruzkiSecond .shippingList .active'),
            $a = $b.text(),
            $parentElement = $(this).closest('.' + $a);
        
        $parentElement.find('.step2.alert').hide();
        $parentElement.find('.step3').show();
        $('.otgruzkiPage.otgruzkiSecond .shippingList .active.number').removeClass('active');
        $('.otgruzkiPage.otgruzkiSecond .shippingList .details').addClass('active');
        
        runStep3($b);
    });
    /*end*****************step2 alert*/
    
    
    $(document).delegate('.otgruzkiPage.otgruzkiSecond .shippingList .number', 'click', function () {
        var a = $(this).text(),
            id = $(this).attr('id'),
            removeClass = $('.otgruzkiPage.otgruzkiSecond .shippingList .number'),
            paret = $(this).parent().parent().find('.' + a).find('.alert');
        

        for (var i = 0; i < removeClass.length; i++) {
            $(removeClass[i]).removeClass('active');
        }

       // alert(id);
		$('.secondShipping').hide();
        $('.otgruzkiPage.otgruzkiSecond .shippingList .details').removeClass('active');
        $('.step1').hide();
       // $('.otgruzkiPage.otgruzkiSecond .step1').hide();
       // $('.step3').hide();
        $('.' + id +' .queue').show();
		$('.' + id).show();
        $(this).addClass('active');
    });
    
    
    /************************************z-index click*/
    function zIndexCheck() {
        var $a = $('.step2.alert input[type="checkbox"]');
        for (var i = 0; i < $a.length; i++) {
            if ($($a[i]).is(':checked')) {
                $($a[i]).siblings().find('.shadow').removeClass('z');
                $($a[i]).siblings().find('.from').show();
                $($a[i]).siblings().find('.notChecked').hide();
                $($a[i]).siblings().find('.warning').show();
            } else {
                $($a[i]).siblings().find('.shadow').addClass('z');
                $($a[i]).siblings().find('.from').hide();
                $($a[i]).siblings().find('.notChecked').show();
                $($a[i]).siblings().find('.warning').hide();
            }
        }
    }


    
    /************************************radio click*/
    $('.step2.alert input[type="radio"]').click(function () {
      /*  var $a = $('.step2.alert input[type="checkbox"]'),
            $c = $('.step2.alert .checkBoxTrue'),
            $d = $('.step2.alert .checkBoxFalse'),
            $b = $('.step2.alert .imit');
        
        if($('#part').is(':checked')) {
            $b.show();
            $d.hide();
            $c.show();
			/*alert("1");
			$(".checkBoxWarning").fadeOut(100);
			$(".otgruzkiPage.otgruzkiSecond .queue.alert .bill.i_alert  input[type='checkbox']").removeAttr("checked");
			$(".bill.i_alert .checkBoxTrue.imit").removeClass("i_display");
			$(".bill.i_alert .checkBoxFalse.imit").css("display",'block');
			$(".bill.i_alert .checkBoxFalse.imit").removeClass("i_none");
			$('.otgruzkiPage.otgruzkiSecond .step2 .bill.i_alert .inputs input[type="number"]').prop('disabled', false);
			*/
	/*		
        } else {
            for (var i = 0; i < $a.length; i++) {
                $($a[i]).prop('checked', true);
            }
            $b.hide();
			
			/*$(".checkBoxWarning").fadeIn(100);
			$(".otgruzkiPage.otgruzkiSecond .queue.alert .bill.alert  input[type='checkbox']").attr("checked","checked");
			$(".bill.alert .checkBoxTrue.imit.alert").addClass("i_display");
			$(".bill.alert .checkBoxFalse.imit.alert").css("display",'none');
			$(".bill.alert .checkBoxFalse.imit.alert").addClass("i_none");
			$('.otgruzkiPage.otgruzkiSecond .step2 .bill.alert  .inputs input[type="number"]').prop('disabled', true);
			*/
	/*		
			
        }
        zIndexCheck();*/
		
		
		
		
		
    });
    
    /************************check alert click*/
    $('.step2.alert input[type="checkbox"]').click(zIndexCheck);
    
    
/****************end*********************************************************steps*
********************************************************************************/ 
    
    /*function test(b) {
        $(b).insertAfter('.first');
    }
    
    $('.bill input').click(function () {
        var a = $('.bill input:checkbox:checked').map(function () {
            return $(this).next("label").children();
        }).get();
        for (var i = 0; i < a.length; i++) {
            test($(a[i]));
        }
    });*/

/*********************************************************small popup*/
    $('a.pdf').click(function () {
        $(this).parent().find('.docPopUp').show();
        $('.shadowBoxPopUp').show();
    });
    
    $('.docPopUp .closeButton').click( function () {
        $('.shadowBoxPopUp').hide();
        $(this).closest('.docPopUp').hide();
    })
    /*************************end********************************small popup*/
	
	//$('#foo').on('click', function(){
  	//	alert('Вы нажали на элемент "foo"');
	//});
	
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
	
	
	$('.secondShipping.sendt .ui-datepicker-month').change(function() {
		
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
	
	$( 'select[name="transport_company_id"]' ).change(function() {
  		var tmp=$(this).val();
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
		
		
		
		//даты, когда отгрузка возможна
		$('.secondShipping.sendt .ui-datepicker-calendar td').each(function(){
			var b=$(this).find('a').css('background-color');
			if((b=="rgba(0, 0, 0, 0)") || (b=="rgb(255, 240, 240)") || (b=="transparent")){ $(this).find('a').css('background-color','#ffff00'); }
			
			/*
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
			*/
			
			
		});
		
		var company=$('select[name="transport_company_id"] option:selected').text();
		//alert(company);
		$('.secondShipping.sendt input#company').val(company);
		
		
		
	});
	
	
	$(".otgruzkiPage form input").keypress(function(e){
	   if(e.keyCode==13){
			return false;
		}
	});
	
	
	
	$(".otgruzkiPage form .datepicker22 a").click(function(){
		var color1=$(this).css('background-color');
		if(color1=="rgb(255, 255, 0)"){
			$("#success_modal").css("z-index","9999999999999");
			$("#success_modal").fadeIn(500);
			$("#success_modal .modal-title").html("Доставка в данный день является платной и стоимость доставки будет включена в счет администраторами дилерского отдела");
		}
		
	});
	
	
	
	
	
	$('.secondShipping.sendt .ui-datepicker-calendar td a').hover(
       
	   
	   function(e){ 
	   
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
						//dataType: 'json',
		 				success: function(data)	{
							//alert("="+data+"=");
							$('.secondShipping.sendt .block_date').html("<p>Имеются отгрузки:</p>");
							if(data=='null' || data==null){
								return;	
							}else{
								$('.secondShipping.sendt .block_date').html("<p>Имеются отгрузки:</p>");
								$('.secondShipping.sendt .block_date').addClass('active'); 
								var p = $.parseJSON(data);
								//var p=data;
								
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
								
								//alert(e.pageX);
								$('.secondShipping.sendt .block_date').css('left',e.pageX);
								$('.secondShipping.sendt .block_date').css('top',e.pageY);
								
								
								
							}
		 					
							
						}
					});
					
					
	   		
	   	
	   },
       function(){ 
	   
	   		$('.secondShipping.sendt .block_date').removeClass('active'); 
			$('.secondShipping.sendt .block_date').html("<p>Имеются отгрузки:</p>");
	   	
	   }
	);
	
	
	
	$('.secondShipping.sendt .ui-datepicker-calendar td a').click(function(){
		$('.secondShipping.sendt .block_date').removeClass('active'); 
	
	});
	
	
	
	
	
	$(window).load(function () {
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
			
			var b=$(this).find('a').css('background-color');
			//alert(b);
			if((b=="rgba(0, 0, 0, 0)") || (b=="rgb(255, 240, 240)") || (b=="transparent")){ $(this).find('a').css('background-color','#ffff00'); }
		
		});
		
		/*		//даты, когда отгрузка возможна
		$('.secondShipping.sendt .ui-datepicker-calendar td').each(function(){
			var b=$(this).find('a').css('background-color');
			if(b=="rgba(0, 0, 0, 0)"){ $(this).find('a').css('background-color','#ffff00'); }
			
			
			
			
		});
		*/
		
		
		
		// добавить год в селектор с месяцем
			var mdate = new Date(); 
			var y=mdate.getFullYear();
			$('.secondShipping.sendt .ui-datepicker-month option').each(function(){
				var h1=$(this).html();
				h1=h1+"  "+y;
				$(this).html(h1);
			});
			 
		
		
		
		
		
	});
	
	
	
	
	
	
	$('.ui-datepicker td a').click(function(){
		
		
		$('.secondShipping.sendt .ui-datepicker-calendar .ui-datepicker-week-end').each(function(){
		//	alert("1");
		
			//var tmp=$(this).html();
		
			//tmp=tmp.replace('<a','<span style="background-color:#bbbbbb;" ');
			//tmp=tmp.replace('a>','span>');
			//$(this).html(tmp);
		});
			
	});
	
	
	
	$('.sendt .jq-selectbox.jqselect #type_id').change(function(){
		
		var t=$('.sendt .jq-selectbox.jqselect #type_id').val();
		if((t == '4')){//(t == '2') || 
			$('.transport_company_container .dis').css('display','none');
			//$('select[name="transport_company_id"]').prop('disabled',false);	
			/*$('.jq-selectbox.jqselect.last').removeClass('disabled');*/
		}else{
			//$('select[name="transport_company_id"]').prop('disabled',true);	
			/*$('.jq-selectbox.jqselect.last').addClass('disabled');*/
			$('.transport_company_container .dis').css('display','block');
			$('select[name="transport_company_id"]').val('');
			
			$('.jq-selectbox.jqselect.last .jq-selectbox__select .jq-selectbox__select-text').html("Выберите...");
			$('.jq-selectbox.jqselect.last .jq-selectbox__select .jq-selectbox__select-text').addClass("placeholder");
			
			
			
		}
	});
	
	
	$('.otgruzkiPage.otgruzkiSecond form').submit(function(){
	
		//поснимать лишние чебоксы
		$('.secondShipping').each(function(){
			var log=0;
			var t1=$(this);
			$('a.number').each(function(){
				var id1=$(this).attr("id");	
				if(t1.hasClass(id1)){
					log=1;	
				}
			});
			if(log==0){
				$(this).find("input[type='checkbox']").each(function(){
					$(this).removeAttr("checked");
				});
			}
			
		});
		
		
		//return false;
		
		
		if($('.otgruzkiPage.otgruzkiSecond form #type_id').val()==""){
			//	alert("Не выбран вид отгрузки");
				
			$('#success_modal').fadeIn(500);
			$('#success_modal').css('z-index','99999');
			$('#success_modal .modal-title').html('Не выбран вид отгрузки');
			$('#success_modal .modal-title').css('color','red');
			$('.secondShipping.sendt #type_id-styler .placeholder').css('color','red');
			
		
				return false;
		}
		if($('.otgruzkiPage.otgruzkiSecond form select[name="prep_id"]').val()==""){
		//		alert("Не выбран вид подготовки");
		
			$('#success_modal').fadeIn(500);
			$('#success_modal').css('z-index','99999');
			$('#success_modal .modal-title').html('Не выбран вид подготовки');
			$('#success_modal .modal-title').css('color','red');
			$('select[name="prep_id"] + .jq-selectbox__select .placeholder').css('color','red');
			
				return false;
		}
		
		if($('.otgruzkiPage.otgruzkiSecond form #shipment_form_sdate').val()=="" || $('.otgruzkiPage.otgruzkiSecond form #shipment_form_sdate').val()=="NaN.NaN.NaN"){
				//alert("Не выбрана дата");
				
			$('#success_modal').fadeIn(500);
			$('#success_modal').css('z-index','99999');
			$('#success_modal .modal-title').html('Не выбрана дата');
			$('#success_modal .modal-title').css('color','red');
			$('.secondShipping.sendt .ui-datepicker-month').css('color','red');
				return false;
		}
		
		
		console.log(jQuery('.mainPart form').serializeArray());
		
		var log_tmp=0;
		$("form input[type='checkbox']").each(function(){
			if($(this).is(':checked')){
				log_tmp=1;	
				
			};
		});
		
		if(log_tmp==0){
			//alert("Нужно выбрать хотя бы один товар");
			
			$('#success_modal').fadeIn(500);
			$('#success_modal .modal-title').html('Нужно выбрать хотя бы один товар');
			$('#success_modal .modal-title').css('color','red');
			$('.otgruzkiPage.otgruzkiSecond .shippingList .number').css('color','red');
			
			return false;
		}
		
		
		
		
		
	
	});
	
	
	
	
	//пересчёт значений
	
	//-----------------------------------------------------------------
	
    $(document).delegate('input[name="count[]"]','input', function () {
	var t=$(this);
	function s1() {	
		var count_input = t;
        //alert(count_input);
		recalc_by_count(count_input);
		
		start_zero(t);
		
	}

	setTimeout(s1, 500);	
		
		//$(this).parent().parent().find('input[name="count_unit[]"]').keyup();
    });


  /*  $('input[name="count[]"]').click(function () {
	
	var t=$(this);
	function s1() {	
		var count_input = t;
        //alert(count_input);
		recalc_by_count(count_input);
		
		start_zero(t);
		
	}

	setTimeout(s1, 1000);	
		
		//$(this).parent().parent().find('input[name="count_unit[]"]').keyup();
    });
*/



	
	
		//$(document).delegate('.mCSB_container input[name="count[]"]','keypress', function (e) {
	$(document).delegate('input[name="count[]"]','keypress', function (e) {
		 
			if(e.keyCode==13){
			//var ewe=$(this).parent().parent().find('input[name="count_unit[]"]');
			//recalc_by_count2(ewe);
	     	// $(".addToTheListBtn").click();
			   e.preventDefault();
	     	   }
			   
			   
			   
		});





	
	$(document).delegate('input[name="count[]"]','keypress', function (e) {
	//	alert("3");
		
		
		

		
			if(e.keyCode==13){
			var ewe=$(this).parent().parent().parent().parent().find('input[name="count_unit[]"]');
			//recalc_by_count2(ewe);
			   e.preventDefault();
			    var a = $('.otgruzkiPage .bill input:checkbox:checked').closest('.itemWrap');
        
        	for (var i = 0; i < a.length; i++) {
			
			
			var ewe=$(a[i]).find('input[name="count_unit[]"]');
			recalc_by_count2(ewe);
           
        	};
       		calculateAdd();
			  // $(".addToTheListBtn").click();
	     	}
			   

		
		
			   
			   
			   
		});
		
		
		
		$(document).delegate('input[name="count[]"]','focusout', function (e) {
			var ewe=$(this).parent().parent().parent().parent().find('input[name="count_unit[]"]');
			//alert("1");
			
			//recalc_by_count2(ewe);
			   e.preventDefault();
			//alert("2");
			    var a = $('.otgruzkiPage .bill input:checkbox:checked').closest('.itemWrap');
        //alert("3");
        
		for (var i = 0; i < a.length; i++) {
			
			
			var ewe=$(a[i]).find('input[name="count_unit[]"]');
			recalc_by_count2(ewe);
           
        };
		
		
		//alert("4");
        calculateAdd();
		//alert("5");
			  // $(".addToTheListBtn").click();
	     
		 
			if($(this).parent().parent().parent().parent().find('input[name="count_pack[]"]').val() == '0'){
				$(this).parent().parent().parent().parent().find('input[name="count_pack[]"]').val("");
			}
			
			
		
		
		});	
		
		
		
		
		
		
		
		
	
	
	
	
	
	
	
	
	
	$(document).delegate('input[name="count_pack[]"]','keypress', function (e) {
			if(e.keyCode==13){
	     	// $(".addToTheListBtn").click();
			   e.preventDefault();
	     	   }
		});
	$(document).delegate('input[name="count_unit[]"]','keypress', function (e) {
			if(e.keyCode==13){
	     	// $(".addToTheListBtn").click();
			  e.preventDefault();
	     	   }
		});
	
	
	
	
	
	
	
	
	
	
	
	function start_zero(t){
		
		var tmp=t.val();
		
		if((tmp.length>1) && (tmp[0]=='0') && (tmp[1]!='.') && (tmp[1]!=',')){
			
			tmp=tmp.substring(1);
		}
		//убрать -
		tmp=tmp.replace(/-/g,"");
		
		t.val(tmp);
	}
	
	
	
    $(document).delegate('input[name="count_pack[]"]','input', function () {
   
    var t2=$(this);
    function s2() {
   
   
        var dimension = t2.parent().parent().parent().parent().find('input[name="count[]"]').attr('data');
        var count_in_pack = t2.attr('data');
        count_in_pack = parseFloat(count_in_pack);
        var unit_in_pack = t2.parent().parent().parent().parent().find('input[name="count_unit[]"]').attr('data');
//        unit_in_pack = parseFloat(unit_in_pack);
        var packs = t2.val();
        packs = parseInt(packs);
        var units_over = t2.parent().parent().parent().parent().find('input[name="count_unit[]"]').val();
        if (units_over == '') {
            units_over = 0
        } else {
            units_over = parseInt(units_over);
        }
        var count, unit_in_count;
        if (dimension == 'шт') {
            count = packs * unit_in_pack + units_over;
        }
        else {
            unit_in_count = unit_in_pack / count_in_pack;
            count = (packs * unit_in_pack + units_over) / unit_in_count;
            count = count.toFixed(4);
        }
		 //count = count.replace(',', '.');
        t2.parent().parent().parent().parent().find('input[name="count_unit[]"]').val(units_over);
		//alert("1");
		
		if(count>0){
			t2.parent().parent().parent().parent().find('input[name="count[]"]').val(count);
		}else{
			t2.parent().parent().parent().parent().find('input[name="count[]"]').val('');
		}
		
		
		start_zero(t2);
		//var count_input = $('input[name="count[]"]');
		//recalc_by_count(count_input);
        
		//$('.calculate .meters input.fileStyle').input();
		
		
		var t=t2.parent().parent().parent().parent().find('input[name="count[]"]');
		count_input(t);
		
		
		var tmp_v=t2.val();
		if(tmp_v==""){
			t2.parent().parent().parent().parent().find('input[name="count_unit[]"]').val('');
			t2.parent().parent().parent().parent().find('input[name="count_pack[]"]').val('');
		}
		
		
	}
	setTimeout(s2, 500);
		
    });

    $(document).delegate('input[name="count_unit[]"]','input', function () {
	
	var t3=$(this);
	function s3() {
		
        var dimension = t3.parent().parent().parent().parent().find('input[name="count[]"]').attr('data');
       var count_in_pack = t3.parent().parent().parent().parent().find('input[name="count_pack[]"]').attr('data');
       var count_in_pack = parseFloat(count_in_pack);
       var unit_in_pack = t3.attr('data');
       var unit_in_pack = parseFloat(unit_in_pack);
       var packs = t3.parent().parent().parent().parent().find('input[name="count_pack[]"]').val();
        if (packs == '') {
            packs = 0
        } else {
            packs = parseInt(packs);
        }
       var units_over = parseInt(t3.val());
        units_over = parseInt(units_over);
        if (units_over >= unit_in_pack) {
         var   packs_plus = Math.floor(units_over / unit_in_pack);
          var  units_minus = packs_plus * unit_in_pack;
            packs += packs_plus;
            units_over -= units_minus;
        }
        if (dimension == 'шт') {
           var count = packs * unit_in_pack + parseInt(units_over);
        }
        else {
          var  unit_in_count = unit_in_pack / count_in_pack;
         var   count = (packs * unit_in_pack + parseInt(units_over)) / unit_in_count;
            count = count.toFixed(4);
        }
		//count = count.replace(',', '.');
        t3.parent().parent().parent().parent().find('input[name="count_pack[]"]').val(packs);
        t3.parent().parent().parent().parent().find('input[name="count_unit[]"]').val(units_over);
		//alert("2");
		if(count>0){
			t3.parent().parent().parent().parent().find('input[name="count[]"]').val(count);
		}else{
			t3.parent().parent().parent().parent().find('input[name="count[]"]').val('');
		}
		start_zero(t3);
      	
	 	//var count_input = $('input[name="count[]"]');
		//recalc_by_count(count_input);
	  //$('.calculate .meters input.fileStyle').input();
	  
	  	var t=t3.parent().parent().parent().parent().find('input[name="count[]"]');
		count_input(t);
		
		var tmp_v=t3.val();
		if(tmp_v==""){
			t3.parent().parent().parent().parent().find('input[name="count[]"]').val('');
			t3.parent().parent().parent().parent().find('input[name="count_pack[]"]').val('');
		}
		
	}
	setTimeout(s3, 500);
	
	
	});
function recalc_by_count(count_input) {
	//alert("1");
        var dimension = count_input.attr('data');
		var count_in_pack = count_input.parent().parent().parent().parent().find('input[name="count_pack[]"]').attr('data');
		count_in_pack = parseFloat(count_in_pack);
        //alert(count_in_pack);
		var unit_in_pack = count_input.parent().parent().parent().parent().find('input[name="count_unit[]"]').attr('data');
        unit_in_pack = parseFloat(unit_in_pack);
        var count = count_input.val();
        if (count == '' || count == 0) {
            count_input.parent().parent().parent().parent().find('input[name="count_pack[]"]').val('');
            count_input.parent().parent().parent().parent().find('input[name="count_unit[]"]').val('');
        } else {
            count = count.replace(',', '.');
            count = parseFloat(count);
            var inf = count / count_in_pack;
            if (inf == Infinity) inf = 0;
            var packs = Math.floor(inf);
            if (dimension == 'шт') {
              var   units_over = count - packs * count_in_pack;
            }
            else {
//                count_over = count - (packs * count_in_pack).toFixed(4);
               var count_over = count - packs * count_in_pack;
                var unit_in_count = unit_in_pack / count_in_pack;
                if (unit_in_count == Infinity) unit_in_count = 0;
              var  units_over = Math.ceil((count_over * unit_in_count).toFixed(2));
            }
            if (units_over == unit_in_pack) {
                packs += 1;
                units_over = 0;
            }
            count_input.parent().parent().parent().parent().find('input[name="count_pack[]"]').val(packs);
            count_input.parent().parent().parent().parent().find('input[name="count_unit[]"]').val(units_over);
			//alert(count);
        }
		
		
    }
function recalc_by_count2(count_input) {
         var dimension = count_input.parent().parent().parent().parent().find('input[name="count[]"]').attr('data');
       var count_in_pack = count_input.parent().parent().parent().parent().find('input[name="count_pack[]"]').attr('data');
       var count_in_pack = parseFloat(count_in_pack);
       var unit_in_pack = count_input.attr('data');
       var unit_in_pack = parseFloat(unit_in_pack);
       var packs = count_input.parent().parent().parent().parent().find('input[name="count_pack[]"]').val();
        if (packs == '') {
            packs = 0
        } else {
            packs = parseInt(packs);
        }
       var units_over = parseInt(count_input.val());
        units_over = parseInt(units_over);
        if (units_over >= unit_in_pack) {
         var   packs_plus = Math.floor(units_over / unit_in_pack);
          var  units_minus = packs_plus * unit_in_pack;
            packs += packs_plus;
            units_over -= units_minus;
        }
        if (dimension == 'шт') {
           var count = packs * unit_in_pack + parseInt(units_over);
        }
        else {
          var  unit_in_count = unit_in_pack / count_in_pack;
         var   count = (packs * unit_in_pack + parseInt(units_over)) / unit_in_count;
            count = count.toFixed(2);
        }
		//count = count.replace(',', '.');
        count_input.parent().parent().parent().parent().find('input[name="count_pack[]"]').val(packs);
        count_input.parent().parent().parent().parent().find('input[name="count_unit[]"]').val(units_over);
		//alert("3");
		if(count>0){
			count_input.parent().parent().parent().parent().find('input[name="count[]"]').val(count);
		}else{
			count_input.parent().parent().parent().parent().find('input[name="count[]"]').val('');
		}
    }
    
    function calculateAdd () {
	/*$('.skidkabolit').hide();
	$('.postskidka').hide();
        var allBills = $('li.js .meters input.fileStyle'),
            bill = 0,
            weight = 0;
        
        for (var i = 0; i < allBills.length; i++) {
            var p = parseInt($(allBills[i]).closest('.shippingInfo').find('.formPrice .price').text());
            var t = $(allBills[i]).val() * p;
            var w = $(allBills[i]).val() * 13;
            
            bill = Math.floor(bill + t);
            weight = Math.floor(weight + w);
        }
            // bill = Math.floor(bill *0.97);
			 var discount = (100 - parseInt($('.sawe').attr('discount')))/100;
			 
			 var total_price = parseInt($('.sawe').attr('total_price'));
			 var account4extra_discount = parseInt($('.sawe').attr('account4extra_discount'));
			 
			 var extra_discount = (100 - parseInt($('.sawe').attr('extra_discount')))/100;
			
			if(account4extra_discount<bill){
				bill = Math.floor(bill *extra_discount);
				$('.skidkabolit').show();
			}else{
				bill = Math.floor(bill *discount);
				$('.postskidka i').html($('.sawe').attr('discount'));
				$('.postskidka').show();
			}
			 
			
			 
			 
        $('.novajaZajavka .sentForm .bill').html(bill);
        $('.novajaZajavka .sentForm .weight').html(weight);
*/
    }
    
    
	
	
	
	
    $(document).delegate('input.fileStyle', 'input', function () {
	//alert("5");
	/*var t4=$(this);
	
	function s4() {
	
        var a = t4.closest('.box').find('.remain .num').text() - t4.closest('.box').find('.remain .reserve').text(),
            p = parseInt(t4.closest('.shippingInfo').find('.formPrice .price').text()),
            b = t4.closest('.shippingInfo').find('.formPrice .lastPrice');
			var w =t4.closest('.box').find('.remain .willBe').text();
			t4.val(t4.val().replace(",", ".").replace("..", "."));
		
        if (t4.val() > a) {
			//alert(a+parseInt(w));
			//alert($(this).val()+"  "+a+"+"+parseInt(w));
			if(t4.val() < (a+parseInt(w))){
				//alert("EFCB00");
				t4.css({color : '#EFCB00'});
				t4.closest('.box').find('.remain .now').css({color : '#EFCB00', 'font-weight' : '700'});        
				$(b).html(Math.floor(t4.val() * p));
			}else{
				//alert("red");
				t4.css({color : 'red'});
				t4.closest('.box').find('.remain .now').css({color : 'red', 'font-weight' : '700'});        
				$(b).html(Math.floor(t4.val() * p));
			}
        } else {
			//alert("green");
            t4.css({color : 'green'});
            t4.closest('.box').find('.remain .now').css({color : 'green', 'font-weight' : '700'});
            
            $(b).html(Math.floor(t4.val() * p));            
        } 
		//alert($(this).attr('name'));
		
		if (t4.val() <= 0 && t4.attr('name')=='count_pack[]' ) {
            t4.val('0');
            $(b).html('0');
        }
		
		
		
	}
	setTimeout(s4, 500);
		
	*/	
		var val1=$(this).val();	
		var max1=$(this).attr('max');
		val1=parseInt(val1);
		max1=parseInt(max1);
		
		if(val1 > max1){
			$("#success_modal").fadeIn(200);
			$("#success_modal .modal-title").html("Введённое значение превышает максимально допустимое.");	
		}
		
		
		
    });
	
	
	
	
	function count_input(t){
		
	/*	
		
		
		var a = t.closest('.box').find('.remain .num').text() - t.closest('.box').find('.remain .reserve').text(),
            p = parseInt(t.closest('.shippingInfo').find('.formPrice .price').text()),
            b = t.closest('.shippingInfo').find('.formPrice .lastPrice');
			var w =t.closest('.box').find('.remain .willBe').text();
			t.val(t.val().replace(",", ".").replace("..", "."));
		
        if (t.val() > a) {
			//alert(a+parseInt(w));
			//alert($(this).val()+"  "+a+"+"+parseInt(w));
			if(t.val() < (a+parseInt(w))){
				//alert("EFCB00");
				t.css({color : '#EFCB00'});
				t.closest('.box').find('.remain .now').css({color : '#EFCB00', 'font-weight' : '700'});        
				$(b).html(Math.floor(t.val() * p));
			}else{
				//alert("red");
				t.css({color : 'red'});
				t.closest('.box').find('.remain .now').css({color : 'red', 'font-weight' : '700'});        
				$(b).html(Math.floor(t.val() * p));
			}
        } else {
			//alert("green");
            t.css({color : 'green'});
            t.closest('.box').find('.remain .now').css({color : 'green', 'font-weight' : '700'});
            
            $(b).html(Math.floor(t.val() * p));            
        } 
		//alert($(this).attr('name'));
		
		if (t.val() <= 0 && t.attr('name')=='count_pack[]' ) {
            t.val('0');
            $(b).html('0');
        }
		
		*/
	}
	
	
	
	
	
	
	
	
	
	
	//-----------------------------------------------------------------
	
	
	
});

function isright2(obj){
/*
function e1(){
var tmp=$(obj).val();
tmp=tmp.replace(".", ",");
tmp=tmp.replace("..", ".");
$(obj).val(tmp);
}
setTimeout(e1, 500);

*/



}

function isright(obj)
 {
 //obj.value= obj.value.replace(".", ",").replace("..", ".");

 var value= +obj.value.replace(/[^0-9.,]/g,'')||0;
//alert(value);
 var min = +obj.getAttribute('min');
 var max = +obj.getAttribute('max');
 obj.value = Math.min(max, Math.max(min, value));
 
 
 var tmp=$(obj).val();
tmp=tmp.replace(".", ",");
tmp=tmp.replace("..", ".");
$(obj).val(tmp);




var obj2=$(obj).parent().parent().parent().parent().find("input[name='count_pack[]']");

value=obj2.val();


 value= value.replace(/[^0-9.,]/g,'')||0;

 var min = obj2.attr('min');
 var max = obj2.attr('max');
 value = Math.min(max, Math.max(min, value));
 obj2.val(value);
 
 var tmp=$(obj2).val();
 
tmp=tmp.replace(".", ",");
tmp=tmp.replace("..", ".");
$(obj2).val(tmp);





obj2=$(obj).parent().parent().parent().parent().find("input[name='count_unit[]']");

value=obj2.val();


 value= value.replace(/[^0-9.,]/g,'')||0;

 var min = obj2.attr('min');
 var max = obj2.attr('max');
 value = Math.min(max, Math.max(min, value));
 obj2.val(value);
 
 var tmp=$(obj2).val();
 
tmp=tmp.replace(".", ",");
tmp=tmp.replace("..", ".");
$(obj2).val(tmp);







obj2=$(obj).parent().parent().parent().parent().find("input[name='count[]']");

value=obj2.val();


 value= value.replace(/[^0-9.,]/g,'')||0;

 var min = obj2.attr('min');
 var max = obj2.attr('max');
 value = Math.min(max, Math.max(min, value));
 obj2.val(value);
 
 var tmp=$(obj2).val();
 
tmp=tmp.replace(".", ",");
tmp=tmp.replace("..", ".");
$(obj2).val(tmp);






$(obj).input();


 
 }