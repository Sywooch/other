$(document).ready(function () {
    'use strict';
	
	var g1=0;
	
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
	$('.fabricio66').hide();
	$('.colllection2').hide();
	$('.arts2').hide();
	$('.namma2').hide();
	
	//$(document).delegate('.mCSB_container input[name="count[]"]','keypress', function (e) {
	$(document).delegate('input[name="count[]"]','keypress', function (e) {
		//alert("2");
			if(e.keyCode==13){
			//var ewe=$(this).parent().parent().find('input[name="count_unit[]"]');
			//recalc_by_count2(ewe);
	     	// $(".addToTheListBtn").click();
			   e.preventDefault();
	     	   }
			   
			   
			   
		});
	
	$(document).delegate('.adding input[name="count[]"]','keypress', function (e) {
		//alert("3");
		
		
		

		
			if(e.keyCode==13){
			var ewe=$(this).parent().parent().find('input[name="count_unit[]"]');
			//recalc_by_count2(ewe);
			   e.preventDefault();
			    var a = $('.novajaZajavka .item input:checkbox:checked').closest('.itemWrap');
        
        	for (var i = 0; i < a.length; i++) {
			
			
			var ewe=$(a[i]).find('input[name="count_unit[]"]');
			recalc_by_count2(ewe);
           
        	};
       		calculateAdd();
			  // $(".addToTheListBtn").click();
	     	}
			   

		
		
			   
			   
			   
		});
		
		
		
		$(document).delegate('.adding input[name="count[]"]','focusout', function (e) {
			var ewe=$(this).parent().parent().find('input[name="count_unit[]"]');
			//alert("1");
			
			//recalc_by_count2(ewe);
			   e.preventDefault();
			//alert("2");
			    var a = $('.novajaZajavka .item input:checkbox:checked').closest('.itemWrap');
        //alert("3");
        
		for (var i = 0; i < a.length; i++) {
			
			
			var ewe=$(a[i]).find('input[name="count_unit[]"]');
			recalc_by_count2(ewe);
           
        };
		
		
		//alert("4");
        calculateAdd();
		//alert("5");
			  // $(".addToTheListBtn").click();
	     
		 
			if($(this).parent().parent().find('input[name="count_pack[]"]').val() == '0'){
				$(this).parent().parent().find('input[name="count_pack[]"]').val("");
			}
		
		});	
		
		
		
		
		
		
		
		
	
	
	
	
	
	
	
	
	
	$(document).delegate('input[name="count_pack[]"]','keypress', function (e) {
			if(e.keyCode==13){
	     	// $(".addToTheListBtn").click();
			   e.preventDefault();
	     	   }
		calculateAdd();	   
		});
	$(document).delegate('input[name="count_unit[]"]','keypress', function (e) {
			if(e.keyCode==13){
	     	// $(".addToTheListBtn").click();
			  e.preventDefault();
	     	   }
		calculateAdd();
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
   
   
        var dimension = t2.parent().parent().find('input[name="count[]"]').attr('data');
        var count_in_pack = t2.attr('data');
        count_in_pack = parseFloat(count_in_pack);
        var unit_in_pack = t2.parent().parent().find('input[name="count_unit[]"]').attr('data');
//        unit_in_pack = parseFloat(unit_in_pack);
        var packs = t2.val();
        packs = parseInt(packs);
        var units_over = t2.parent().parent().find('input[name="count_unit[]"]').val();
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
        t2.parent().parent().find('input[name="count_unit[]"]').val(units_over);
		//alert("1");
		
		if(count>0){
			t2.parent().parent().find('input[name="count[]"]').val(count);
		}else{
			t2.parent().parent().find('input[name="count[]"]').val('');
		}
		
		
		start_zero(t2);
		//var count_input = $('input[name="count[]"]');
		//recalc_by_count(count_input);
        
		//$('.calculate .meters input.fileStyle').input();
		
		
		var t=t2.parent().parent().find('input[name="count[]"]');
		count_input(t);
		
		
		var tmp_v=t2.val();
		if(tmp_v==""){
			t2.parent().parent().find('input[name="count_unit[]"]').val('');
			t2.parent().parent().find('input[name="count_pack[]"]').val('');
		}
		
	calculateAdd();	
	}
	setTimeout(s2, 500);
		
    });

    $(document).delegate('input[name="count_unit[]"]','input', function () {
	
	var t3=$(this);
	function s3() {
		
        var dimension = t3.parent().parent().find('input[name="count[]"]').attr('data');
       var count_in_pack = t3.parent().parent().find('input[name="count_pack[]"]').attr('data');
       var count_in_pack = parseFloat(count_in_pack);
       var unit_in_pack = t3.attr('data');
       var unit_in_pack = parseFloat(unit_in_pack);
       var packs = t3.parent().parent().find('input[name="count_pack[]"]').val();
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
        t3.parent().parent().find('input[name="count_pack[]"]').val(packs);
        t3.parent().parent().find('input[name="count_unit[]"]').val(units_over);
		//alert("2");
		if(count>0){
			t3.parent().parent().find('input[name="count[]"]').val(count);
		}else{
			t3.parent().parent().find('input[name="count[]"]').val('');
		}
		start_zero(t3);
      	
	 	//var count_input = $('input[name="count[]"]');
		//recalc_by_count(count_input);
	  //$('.calculate .meters input.fileStyle').input();
	  
	  	var t=t3.parent().parent().find('input[name="count[]"]');
		count_input(t);
		
		var tmp_v=t3.val();
		if(tmp_v==""){
			t3.parent().parent().find('input[name="count[]"]').val('');
			t3.parent().parent().find('input[name="count_pack[]"]').val('');
		}
	calculateAdd();	
	}
	setTimeout(s3, 500);
	
	
	});
function recalc_by_count(count_input) {
	
        var dimension = count_input.attr('data');
		var count_in_pack = count_input.parent().parent().find('input[name="count_pack[]"]').attr('data');
		count_in_pack = parseFloat(count_in_pack);
        //alert(count_in_pack);
		var unit_in_pack = count_input.parent().parent().find('input[name="count_unit[]"]').attr('data');
        unit_in_pack = parseFloat(unit_in_pack);
        var count = count_input.val();
        if (count == '' || count == 0) {
            count_input.parent().parent().find('input[name="count_pack[]"]').val('');
            count_input.parent().parent().find('input[name="count_unit[]"]').val('');
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
            count_input.parent().parent().find('input[name="count_pack[]"]').val(packs);
            count_input.parent().parent().find('input[name="count_unit[]"]').val(units_over);
			//alert(count);
        }
		
	calculateAdd();	
    }
function recalc_by_count2(count_input) {
         var dimension = count_input.parent().parent().find('input[name="count[]"]').attr('data');
       var count_in_pack = count_input.parent().parent().find('input[name="count_pack[]"]').attr('data');
       var count_in_pack = parseFloat(count_in_pack);
       var unit_in_pack = count_input.attr('data');
       var unit_in_pack = parseFloat(unit_in_pack);
       var packs = count_input.parent().parent().find('input[name="count_pack[]"]').val();
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
        count_input.parent().parent().find('input[name="count_pack[]"]').val(packs);
        count_input.parent().parent().find('input[name="count_unit[]"]').val(units_over);
		//alert("3");
		if(count>0){
			count_input.parent().parent().find('input[name="count[]"]').val(count);
		}else{
			count_input.parent().parent().find('input[name="count[]"]').val('');
		}
    }
    $('.itemsQueue, .underTheOrderList').mCustomScrollbar({/****customize scrollbar*/
            scrollInertia: 0,
            mouseWheelPixels: 100,
            advanced:{updateOnContentResize:true},
            theme: "my-theme"
        });
    
    
    /********pics toggle*/
    $(document).delegate('.novajaZajavka .showHidePics', 'click', function () {
        var a = $('.novajaZajavka .item input[type="checkbox"]:checked');
        // , marginTop : "-27px"
        

        if($(this).is(':checked')){
            $(this).closest('.itemsBox').find('.itemsQueue .imgBox, .underTheOrder .imgBox').hide()
            $('.novajaZajavka .adding .item .shippingInfo .formPrice').css({width : '100%'});

            // $(a).closest('.item').find('.formPrice').css({marginTop :'-32px'});
          
        } else {
            $(this).closest('.itemsBox').find('.itemsQueue .imgBox, .underTheOrder .imgBox').show();
            $('.novajaZajavka .adding .item .shippingInfo .formPrice').css({width : '45%'});

            // $(a).closest('.item').find('.formPrice').css({marginTop :'inherit'});

        }
    });
    
    
    /********************************calculate sum*/
    
    function calculateAdd () {
	$('.skidkabolit').hide();
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

    }
    
    
    $(document).delegate('.calculate .meters input.fileStyle', 'input', function () {
	
	var t4=$(this);
	
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
		
		
	calculateAdd();	
	}
	setTimeout(s4, 500);
		
		
		
    });
	
	
	
	
	function count_input(t){
		
		
		
		
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
	calculateAdd();	
	}
	
    
    
    /******************************************adding to the list*/
    $(document).delegate('.novajaZajavka .item input[type="checkbox"]', 'click', function () {
		
        if($(this).is(':checked')){
            $(this).closest('.item').find('.remain').show();
            $(this).closest('.item').find('.formPrice .result').show();
            $(this).closest('.item').find('.inputs').css({display : 'table'});
        } else {
            $(this).closest('.item').find('.remain').hide();
            $(this).closest('.item').find('.inputs').hide();
            $(this).closest('.item').find('.formPrice .result').hide();
			$(this).parent().find('input[type="number"]').val("");
			$(this).parent().find('input[type="text"]').val("");
        }
    });
    
    function addElement (b) {
        var $li = $('ol.adding li.js:last');
        
        $(b).appendTo($li[0]);
        /*$(b).find('input[type="checkbox"]').prop('checked', false);*/
        // $(b).find('input[type="checkbox"]').hide();

        $(b).find('.imit').hide();
        $(b).find('.removeFromList').show();
        // $('.js .calculate input[type="number"]').prop('disabled', true);
        
        $('#adding li.js .imgBox').show();
        
        $('.novajaZajavka .sentForm p').show();
        
        $(b).find('.underTheOrderMarker').show();
        
        /******bugH*/
        var $li2 = $('li.js:not(:has(*))');
        for (var i = 0; i < $li2.length; i++) {
            $($li2[i]).remove();
        }
        /****end bugH*/
        
        calculateAdd();
        
    }
    
    function createLi(b) {
        $('.novajaZajavka #adding .basement').before('<li class="js"></li>');
        
        addElement(b);
    }
    
	
	 $(document).delegate('.fabricio', 'change', function () {
        //обнулить поля ввода
		clear_inputs();
		
		if($('.fabricio option:selected').val()==""){
			//очистить результаты поиска
			$("#mCSB_1_container").html("");	
			$(".novajaZajavka .itemsQueue").animate({height: "0px"}, 1000);
			$('#colllection').html("").trigger('refresh');
			return false;
		}
		
		
		
        //alert($('#fabricio option:selected').val());
		 $.post("/requests?fabrics="+$('#fabricio option:selected').val()+"&rtupe="+$('#rtype').val(), function(data) {
			$('#colllection').html(data).trigger('refresh');
			//alert(data);
		});
        
    });
	
	
	
	
	$(document).delegate('.fabricio66', 'change', function () {
        //обнулить поля ввода
		clear_inputs2();
		
		
		if($('.fabricio66 option:selected').val()==""){
			//очистить результаты поиска
			$("#mCSB_2_container").html("");	
			$(".novajaZajavka .underTheOrderList").animate({height: "0px"}, 1000);
			$('#colllection2').html("").trigger('refresh');
			return false;
		}
		
        //alert($('#fabricio option:selected').val());
		 $.post("/requests?fabrics="+$('#fabricio66 option:selected').val()+"&rtupe="+$('#rtype').val(), function(data) {
			$('#colllection2').html(data).trigger('refresh');
			//alert(data);
		});
        
    });
	
	$(document).delegate('select[name="status"]', 'change', function () {
        
		$('.zajavki .filter input[type="text"]').val('');
		
		$('.submitsd').click();

        
    });
	
	$(document).delegate('input[name="id"]','keypress', function (e) {
			if(e.keyCode==13){
			$('.submitsd').click();
	     	   }
			   
			  
		});
		$(document).delegate('input[name="account_number"]','keypress', function (e) {
			if(e.keyCode==13){
			$('.submitsd').click();
	     	   }
			   
			//if($('input[name="account_number"]').val()==""){
			//	$('.jq-selectbox ul li:first').removeClass('sel');
	   		//	$('.jq-selectbox ul li:first').removeClass('selected'); 
				
			//};   
		});
		
		
		
		
		$(document).delegate('input[name="id"]','keyup', function (e) {
			//alert($('input[name="id"]').val());
			if($('input[name="id"]').val()==""){
				$('.jq-selectbox ul li:first').removeClass('sel');
	   			$('.jq-selectbox ul li:first').removeClass('selected'); 
			}; 
		});
		
		
		$(document).delegate('input[name="account_number"]','keyup', function (e) {
			if($('input[name="account_number"]').val()==""){
				$('.jq-selectbox ul li:first').removeClass('sel');
	   			$('.jq-selectbox ul li:first').removeClass('selected'); 
			};
		});
		
		
		
	 $(document).delegate('.colllection', 'change', function () {
        //обнулить поля ввода
		clear_inputs();
		
		if($('#colllection option:selected').val()==""){
			//очистить результаты поиска
			$("#mCSB_1_container").html("");	
			$(".novajaZajavka .itemsQueue").animate({height: "0px"}, 1000);
			return false;
		}
		
		var pronxx='';
		if($(".onOrder").hasClass("active")){pronxx="&zakaz=1"}
        //alert($('#fabricio option:selected').val());
		 $.post("/requests?colllection="+$('#colllection option:selected').val()+pronxx+"&rtupe="+$('#rtype').val(), function(data) {
			//$('#colllection').html(data).trigger('refresh');
			//alert(data);
			if($(".inStock").hasClass("active")){
			$('.itemsQueue .mCSB_container').html(data);
			setTimeout("$('.itemsQueue').mCustomScrollbar('update')",100);
		//	alert(data);
			if($(".showHidePics").prop("checked")==true){
				//скрыть картинки
				$(".box.imgBox").css('display','none');
				$(".formPrice").css('width','100%');
			
			};
			
			$(".novajaZajavka .itemsQueue").animate({height: "400px"}, 1000);
			
			//var tmp=$("#mCSB_1_container").html();
			//tmp=tmp.replace(/\s*/g,'')
			//alert(tmp);
			//if(tmp==""){
			//	$(".novajaZajavka .underTheOrderList").animate({height: "0px"}, 1000);
			//}else{
				$(".novajaZajavka .underTheOrderList").animate({height: "400px"}, 1000);
			//}
			
			
			}
			if($(".onOrder").hasClass("active")){
			//alert(data);	
			$('.underTheOrderList .mCSB_container').html(data);
			setTimeout("$('.underTheOrderList').mCustomScrollbar('update')",100);
			if($(".showHidePics").prop("checked")==true){
				//скрыть картинки
				$(".box.imgBox").css('display','none');
				$(".formPrice").css('width','100%');
			
			};
			
			//tmp=$("#mCSB_2_container").html();
			//tmp=tmp.replace(/\s*/g,'')
			//alert(tmp);
			//if(tmp==""){
			//	$(".novajaZajavka .itemsQueue").animate({height: "0px"}, 1000);
			//}else{
				$(".novajaZajavka .itemsQueue").animate({height: "400px"}, 1000);	
			//}
			
			
			$(".novajaZajavka .underTheOrderList").animate({height: "400px"}, 1000);

		//	alert(data);
			}
		});
		//++++++++++++++++
		/*
		$('.novajaZajavka .adding .item .checkBoxTrue').on('click',function(){
		alert("1");
	
     	//alert($(this).prop("checked"));
		//if($(this).prop("checked")==false){
			
		//	$(this).parent().find('input[type="text"]').val("");	
		//}
		
		});
		*/
		
		
		
		
		
        
    });


	 $(document).delegate('.colllection2', 'change', function () {
        //обнулить поля ввода
		clear_inputs2();
		
		
		if($('#colllection2 option:selected').val()==""){
			//очистить результаты поиска
			$("#mCSB_2_container").html("");	
			$(".novajaZajavka .underTheOrderList").animate({height: "0px"}, 1000);
			return false;
		}
		
		
		var pronxx='';
		if($(".onOrder").hasClass("active")){pronxx="&zakaz=1"}
        //alert($('#fabricio option:selected').val());
		 $.post("/requests?colllection="+$('#colllection2 option:selected').val()+pronxx+"&rtupe="+$('#rtype').val(), function(data) {
			//$('#colllection').html(data).trigger('refresh');
			//alert(data);
			if($(".inStock").hasClass("active")){
			$('.itemsQueue .mCSB_container').html(data);
			setTimeout("$('.itemsQueue').mCustomScrollbar('update')",100);
		//	alert(data);
			if($(".showHidePics").prop("checked")==true){
				//скрыть картинки
				$(".box.imgBox").css('display','none');
				$(".formPrice").css('width','100%');
			
			};
			
			$(".novajaZajavka .itemsQueue").animate({height: "400px"}, 1000);
			
			//var tmp=$("#mCSB_1_container").html();
			//tmp=tmp.replace(/\s*/g,'')
			//alert(tmp);
			//if(tmp==""){
			//	$(".novajaZajavka .underTheOrderList").animate({height: "0px"}, 1000);
			//}else{
				$(".novajaZajavka .underTheOrderList").animate({height: "400px"}, 1000);
			//}
			
			
			}
			if($(".onOrder").hasClass("active")){
			//alert(data);	
			$('.underTheOrderList .mCSB_container').html(data);
			setTimeout("$('.underTheOrderList').mCustomScrollbar('update')",100);
			if($(".showHidePics").prop("checked")==true){
				//скрыть картинки
				$(".box.imgBox").css('display','none');
				$(".formPrice").css('width','100%');
			
			};
			
			//tmp=$("#mCSB_2_container").html();
			//tmp=tmp.replace(/\s*/g,'')
			//alert(tmp);
			//if(tmp==""){
			//	$(".novajaZajavka .itemsQueue").animate({height: "0px"}, 1000);
			//}else{
				$(".novajaZajavka .itemsQueue").animate({height: "400px"}, 1000);	
			//}
			
			
			$(".novajaZajavka .underTheOrderList").animate({height: "400px"}, 1000);

		//	alert(data);
			}
		});
		//++++++++++++++++
		/*
		$('.novajaZajavka .adding .item .checkBoxTrue').on('click',function(){
		alert("1");
	
     	//alert($(this).prop("checked"));
		//if($(this).prop("checked")==false){
			
		//	$(this).parent().find('input[type="text"]').val("");	
		//}
		
		});
		*/
		
		
		
		
		
        
    });



	$(document).delegate('.arts','keypress', function (e) {
			if(e.keyCode==13){
	     	$(".searstr").click();
			   e.preventDefault();
	     	   }
		});
	
	$(document).delegate('.arts2','keypress', function (e) {
			if(e.keyCode==13){
	     	$(".searstr").click();
			   e.preventDefault();
	     	   }
		});
	
	
	$(document).delegate('.namma','keypress', function (e) {
			if(e.keyCode==13){
	     	$(".searstr").click();
			   e.preventDefault();
	     	   }
		});
	
$(document).delegate('.namma2','keypress', function (e) {
			if(e.keyCode==13){
	     	$(".searstr").click();
			   e.preventDefault();
	     	   }
		});
	


     $(document).delegate('.searstr', 'click', function () {
		var pronxx="";
		 if($(".onOrder").hasClass("active")){pronxx="&zakaz=1&rtupe=reservation"}
		 
		 if($(".inStock").hasClass("active")){
		 	var arts=$(".arts").val();
			var namma=$(".namma").val();
		 }
		 if($(".onOrder").hasClass("active")){
		 	var arts=$(".arts2").val();
			var namma=$(".namma2").val();
		 }
		 
			$.post("/requests?searts=1"+pronxx, {arts:arts,namma:namma,rtupe:$('#rtype').val()},function(data) {
			if($(".inStock").hasClass("active")){
			$('.itemsQueue .mCSB_container').html(data);
			setTimeout("$('.itemsQueue').mCustomScrollbar('update')",100);
			}
			if($(".onOrder").hasClass("active")){
			$('.underTheOrderList .mCSB_container').html(data);
			setTimeout("$('.underTheOrderList').mCustomScrollbar('update')",100);;

			}
		});
		
		$(".novajaZajavka .itemsQueue").animate({height: "400px"}, 1000);
		$(".novajaZajavka .underTheOrderList").animate({height: "400px"}, 1000);
		
		//сбросить селекты
		var selectbox1 = $('#fabricio');
		var selectbox2 = $('#colllection');
		selectbox1.prop('selectedIndex',0);
        selectbox2.prop('selectedIndex',0);
		$(".jq-selectbox__select-text").html("Выберите...");
		$(".jq-selectbox__dropdown ul li").removeClass("sel");
		$(".jq-selectbox__dropdown ul li").removeClass("selected");
		selectbox1 = $('#fabricio66');
		selectbox2 = $('#colllection2');
		selectbox1.prop('selectedIndex',0);
        selectbox2.prop('selectedIndex',0);
		$("#colllection-styler .jq-selectbox__dropdown ul").html('');//<li class="selected sel">Выберите</li>
		$("#colllection2-styler .jq-selectbox__dropdown ul").html('');
		
		$("#colllection-styler .jq-selectbox__dropdown").css('padding','0px');
		$("#colllection2-styler .jq-selectbox__dropdown").css('padding','0px');
	 });
	
	
	var g_tmp1=[];
    $(document).delegate('.novajaZajavka .addToTheListBtn', 'click', function () {
        
		
				
		
		
        var a = $('.novajaZajavka .item input:checkbox:checked').closest('.itemWrap');
        
		if(a.length==0){
			$("#success_modal").fadeIn(500);
			$("#success_modal .modal-title").html("Выберите хотя бы один товар");
		}
		
		//alert(a[a.length-1].innerHTML);
		var t1=a[a.length-1].innerHTML;
		var reg = t1.match(/<p>(.*?)<\/p>/);
		
		for(var i2=0;i2<g_tmp1.length;i2=i2+1){
			
			
			 
			
			//alert("=");
			//alert(g_tmp1[i2]);
			//alert(a[a.length-1].innerHTML);
			//alert("=");
			
			if(g_tmp1[i2]==reg[0]){
				
				$('.request_alert').fadeIn(500);
				
				
				return;
			}
		}
		
        for (var i = 0; i < a.length; i++) {
			//alert(a[i].innerHTML);
			//проверить, не добавляли ли уже такую позицию
			//console.log(a[i].innerHTML);
			//alert(a[i].innerHTML);
			var log=0;
			//alert(g_tmp1.length);
			//for(var i2=0;i2<g_tmp1.length;i2=i2+1){
				//alert("=");
				//alert(g_tmp1[i2]);
				//alert(a[i].innerHTML);
				//alert("=");
				
			//	if(g_tmp1[i2]==a[i].innerHTML){
			//		log=1;	
			//	}
			//}
			
			
			//if(log==1){
			//такой элемент был ранее добавлен
			//	alert("1");	
			//	return;
			//}
			
			
			
			
			
			var ewe=$(a[i]).find('input[name="count_unit[]"]');
			recalc_by_count2(ewe);
            createLi($(a[i]));
			g_tmp1.push(reg[0]);
			
			
			
			
			
        };
		
		
		var selectbox1 = $('#fabricio');
		var selectbox2 = $('#colllection');
		selectbox1.prop('selectedIndex',0);
        selectbox2.prop('selectedIndex',0);
		$(".jq-selectbox__select-text").html("Выберите...");
		$(".jq-selectbox__dropdown ul li").removeClass("sel");
		$(".jq-selectbox__dropdown ul li").removeClass("selected");
		$(".novajaZajavka .itemsQueue #mCSB_1_container").html("");
		$(".novajaZajavka .underTheOrderList #mCSB_2_container").html("");
		
		//сворачивание
		$(".novajaZajavka .itemsQueue").animate({height: "0px"}, 1000);
		$(".novajaZajavka .underTheOrderList").animate({height: "0px"}, 1000);
		
		//если есть товары под заказ, со скидкой или на распродаже, то вывести сообщение
		if( ($("span").is(".underTheOrderMarker")) || ($("span").is(".sale")) || ($("span").is(".action")) ){
			
			$('.text_pod_zakaz').fadeIn(500);
		}else{
			$('.text_pod_zakaz').fadeOut(500);
			
		}
		
		$('.novajaZajavka .basement .itemsBox .filter input').val("");
		
		
		
    });

    // function run () {
    //     $('.itemsQueue, .underTheOrderList').mCustomScrollbar({/****customize scrollbar*/
    //         scrollInertia: 0,
    //         mouseWheelPixels: 100,
    //         advanced:{updateOnContentResize:true},
    //         theme: "my-theme"
    //     });
    //     alert('hello');
    // }

    /************end******************************adding to the list*/
    /******************************************remove from the list*/
    
	$(".request_alert .modal-header .close").click(function () {
		$(".request_alert").fadeOut(500);
	});
	
	
    $(document).delegate('.novajaZajavka .adding .item .removeFromList', 'click', function () {

        $(this).hide();
        
        $(this).closest('li').remove();
        
        var $liJs = $('li.js');
        if ($liJs.length == 0) {
            $('.novajaZajavka .sentForm p').hide();
        }
        
        var checkElementType = $(this).closest('.itemWrap').find('.underTheOrderMarker');
        if(checkElementType.length > 0) {
            $(this).closest('.itemWrap').appendTo('.underTheOrderList #mCSB_2_container');
        } else {
            $(this).closest('.itemWrap').appendTo('.itemsQueue #mCSB_1_container');
        }
        
        $(this).closest('.itemWrap').find('.underTheOrderMarker').hide();
        
        // $(this).closest('.itemWrap').find('input[type="checkbox"]').show();
        $(this).closest('.itemWrap').find('.imit.checkBoxTrue').show();
        
        $('.itemsQueue .calculate input.fileStyle, .underTheOrderList .calculate input.fileStyle').prop('disabled', false);
        
        /**************dublicate*/
        if($('.novajaZajavka .showHidePics').is(':checked')){
            $('.novajaZajavka .showHidePics').closest('.itemsBox').find('.itemsQueue .imgBox, .underTheOrder .imgBox').hide();
            $('.novajaZajavka .adding .item .shippingInfo .formPrice').css({width : '100%'});
        } else {
            $('.novajaZajavka .showHidePics').closest('.itemsBox').find('.itemsQueue .imgBox, .underTheOrder .imgBox').show();
            $('.novajaZajavka .adding .item .shippingInfo .formPrice').css({width : '45%'});
        }
        
        calculateAdd();
		
		
		//если есть товары под заказ, со скидкой или на распродаже, то вывести сообщение
		if( ($("span").is(".underTheOrderMarker")) || ($("span").is(".sale")) || ($("span").is(".action")) ){
			
			$('.text_pod_zakaz').fadeIn(500);
		}else{
			$('.text_pod_zakaz').fadeOut(500);
			
		}
		
		

    })
    
    
    
    $(document).delegate('.novajaZajavka .abort', 'click', function () {
        var a = $('.novajaZajavka li.js .itemWrap');
        
        $('.novajaZajavka .sentForm p').hide();
        
        
        
        for (var i = 0; i < a.length; i++) {
            $(a[i]).find('.item .removeFromList').hide();
            $(a[i]).closest('li').remove();
            
            var checkElementType = $(a[i]).find('.underTheOrderMarker');
            if(checkElementType.length > 0) {
                $(a[i]).appendTo('.underTheOrderList #mCSB_2_container');
            } else {
                $(a[i]).appendTo('.itemsQueue #mCSB_1_container');
            }
            
            /*$(a[i]).appendTo('.itemsQueue');*/
            // $(a[i]).find('input[type="checkbox"]').show();
            $(a[i]).find('.imit.checkBoxTrue').show();

            $('.calculate input.fileStyle').prop('disabled', false);
            
            /**************dublicate*/
            if($('.novajaZajavka .showHidePics').is(':checked')){
                $('.novajaZajavka .showHidePics').closest('.itemsBox').find('.itemsQueue .imgBox, .underTheOrder .imgBox').hide();
                $('.novajaZajavka .adding .item .shippingInfo .formPrice').css({width : '100%'});
            } else {
                $('.novajaZajavka .showHidePics').closest('.itemsBox').find('.itemsQueue .imgBox, .underTheOrder .imgBox').show();
                $('.novajaZajavka .adding .item .shippingInfo .formPrice').css({width : '45%'});
            }
        }
        
        $('.underTheOrder .underTheOrderMarker').hide();
        
        calculateAdd();
    });
    /*************end*****************************remove from the list*/
    /********types toggle*/
    
    $(document).delegate('.novajaZajavka .adding .inStock', 'click', function () {
        $(this).addClass('active');
        $(this).siblings().removeClass('active');
        $('#rtype').val('order');
        $('.novajaZajavka .underTheOrderList').hide();
		
		var tmp=$("#mCSB_1_container").html();
		tmp=tmp.replace(/\s*/g,'')
		
		
		//if(tmp==""){
			//$('.novajaZajavka .itemsQueue').hide();
			
		//}else{
			$('.novajaZajavka .itemsQueue').show();
		//}
		
		 $('.fabricio').show();
		 $('.fabricio66').hide();
		 
		 $('.colllection').show();
		 $('.colllection2').hide();
		 $('.arts').show();
		 $('.arts2').hide();
		 $('.namma').show();
		 $('.namma2').hide();
		 
		 
		 $('.itemsBox').addClass('inStock_1');
		 $('.itemsBox').removeClass('onOrder_1');
		$('.novajaZajavka .basement .itemsBox .filter .ff li:nth-child(3) p').html('Артикул "Артисан"');
		
		var tmp=$("#mCSB_1_container").html();
		tmp=tmp.replace(/\s*/g,'')
		if(tmp==""){
			$(".novajaZajavka .itemsQueue").animate({height: "0px"}, 1000);
		}else{
			$(".novajaZajavka .itemsQueue").animate({height: "400px"}, 1000);
		}
		
		
		//сброс соседней вкладки
		clear_inputs2();
		$("#mCSB_2_container").html("");
		$("#fabricio66").prop('selectedIndex',0);   
		var selectbox1 = $('#fabricio66');
		var selectbox2 = $('#colllection2');
		selectbox1.prop('selectedIndex',0);
        selectbox2.prop('selectedIndex',0);
		$("#colllection2-styler .jq-selectbox__select-text").html("Выберите...");
		$("#colllection2-styler .jq-selectbox__dropdown ul li").removeClass("sel");
		$("#colllection2-styler .jq-selectbox__dropdown ul li").removeClass("selected");
		$("#fabricio66-styler .jq-selectbox__select-text").html("Выберите...");
		$("#fabricio66-styler .jq-selectbox__dropdown ul li").removeClass("sel");
		$("#fabricio66-styler .jq-selectbox__dropdown ul li").removeClass("selected");
		
		
    });
    
    $(document).delegate('.novajaZajavka .adding .onOrder', 'click', function () {
        $(this).addClass('active');
        $(this).siblings().removeClass('active');
        $('#rtype').val('reservation');
        $('.novajaZajavka .itemsQueue').hide();
        
		var tmp=$("#mCSB_2_container").html();
		tmp=tmp.replace(/\s*/g,'')
		
		
		//if(tmp==""){
			//$(".novajaZajavka .underTheOrderList").hide();
			
		//}else{
			$('.novajaZajavka .underTheOrderList').show();
			
		//}
		
		$('.fabricio66').show();
		$('.fabricio').hide();
		
		$('.colllection2').show();
		$('.colllection').hide();
		$('.arts2').show();
		$('.arts').hide();
		$('.namma2').show();
		$('.namma').hide();
		
		
		
        $('.itemsBox').addClass('onOrder_1');
		$('.itemsBox').removeClass('inStock_1');
		$('.novajaZajavka .basement .itemsBox .filter .ff li:nth-child(3) p').html('Заводской артикул');
        
		var tmp=$("#mCSB_2_container").html();
		tmp=tmp.replace(/\s*/g,'')
		if(tmp==""){
			$(".novajaZajavka .underTheOrderList").animate({height: "0px"}, 1000);
		}else{
			$(".novajaZajavka .underTheOrderList").animate({height: "400px"}, 1000);
		}
		
		
		//сброс соседней вкладки
		clear_inputs();
		$("#mCSB_1_container").html("");
		$("#fabricio").prop('selectedIndex',0);   
		var selectbox1 = $('#fabricio');
		var selectbox2 = $('#colllection');
		selectbox1.prop('selectedIndex',0);
        selectbox2.prop('selectedIndex',0);
		$("#colllection-styler .jq-selectbox__select-text").html("Выберите...");
		$("#colllection-styler .jq-selectbox__dropdown ul li").removeClass("sel");
		$("#colllection-styler .jq-selectbox__dropdown ul li").removeClass("selected");
		$("#fabricio-styler .jq-selectbox__select-text").html("Выберите...");
		$("#fabricio-styler .jq-selectbox__dropdown ul li").removeClass("sel");
		$("#fabricio-styler .jq-selectbox__dropdown ul li").removeClass("selected");
		
		
    });
    
    /*****end types toggle*/
    
    
    
    $('.derses').submit(function() {
		 window.onbeforeunload = null;
			g1=1;
			//проверка на смешанную заявку
				
				if(($(".derses .adding .nalMarker").length) && ($(".derses .adding .underTheOrderMarker").length)){
					
					$("#rtype").val('mixed');
						
				}
				
				
				
				
				if($(".sentForm .bill").html()=="0" && $("#adding .js").length!=0 && $(".sentForm .weight").html()=="0"){
					$("#success_modal").fadeIn(500);
					$("#success_modal .modal-title").html('Необходимо указать количество в выбранных позициях.');	
					return false;
				}
				
				
				//если не добавлен ни один товар
				if($(".sentForm .bill").html()=="0" && $("#adding .js").length==0 && $(".sentForm .weight").html()=="0"){
					$("#success_modal").fadeIn(500);
					$("#success_modal .modal-title").html('Необходимо выбрать хотя бы один товар.');	
					return false;
				}
		

		
		
		
				  var total_price = parseInt($('.sawe').attr('total_price'));
				  var bill = parseInt($('.novajaZajavka .sentForm .bill').html());
			if((bill<total_price) && ($('.underTheOrderList').css('display')=='none')){
				
				$("#success_modal").fadeIn(500);
				$("#success_modal .modal-title").html('Минимальная сумма заказа '+total_price+'. Для уточнения обратитесь к администратору дилерского отдела.');
				
				
				
				
				return false;
			}else{
	
	
	
	                if($(".fabricio222 :selected").val()!=""){
						return true;
					}else{
						$(".fabricio222").focus();
						
						$("#success_modal").fadeIn(500);
						$("#success_modal .modal-title").html("Необходимо выбрать Юр. лицо");
						
						
						return false;
					};
			}
			
				
				
				
	});
    
    
    
    
    
    
    
    /*********************************************************small popup*/
    $('.zajavki a.pdf').click(function () {
        $(this).parent().find('.docPopUp').show();
        $('.shadowBoxPopUp').show();
    });
    
    $('.docPopUp .closeButton').click( function () {
        $('.shadowBoxPopUp').hide();
        $(this).closest('.docPopUp').hide();
    })
    /*************************end********************************small popup*/
    
    
    /*********************************************************big popup*/    
    $('.zajavki .oneClaim .identificator .number').click( function () {
        var a = $('.zajavki .oneClaim .identificator .number'),
            cruticalMass = a.length - 2,
            test = $(this).parent().find('.claimPopUp');

        
        $(this).addClass('active');
        
        for (var i = 0; i < a.length; i++) {
            if ($(a[i]).hasClass('active')) {
                if (i >= cruticalMass) {
                    $(this).parent().find('.claimPopUp').addClass('last');
                }
            } 
        }
        $.post("/requests/show/id/"+$(this).attr('ids')+"/ajax/1/", function(data) {
			data=data.replace('ajax','');
			data=data.replace(/=1/g,'');
			test.html(data);
			//alert(data);
		});
        
        $(this).parent().find('.claimPopUp').show();
        $('.shadowBoxPopUp').show();
       // $('body').css({overflow : 'hidden'});

        scroll(test);

    });
    
   // $(document).on('.claimPopUp .closeButton','click', function () {
		$(document).delegate('.claimPopUp .closeButton', 'click', function () {
        $('.shadowBoxPopUp').hide();
        $(this).closest('.claimPopUp').hide();
        
        $(this).closest('.identificator').find('.number.active').removeClass('active');
        $('body').css({overflow : 'visible'});
    })
	
	
	
	
	
	$(document).delegate('.filter .arts', 'input', function () {
		$('input.namma').val("");

    });
	$(document).delegate('.filter .arts2', 'input', function () {
		$('input.namma2').val("");

    });
	
	$(document).delegate('.filter .namma', 'input', function () {
		$('input.arts').val("");

    });
	$(document).delegate('.filter .namma2', 'input', function () {
		$('input.arts2').val("");

    });
	
	
	$(document).delegate('.zajavki .filter input[name="id"]', 'input', function () {
		//сбросить соседние поля
		$('.zajavki .filter input[name="account_number"]').val("");
		$('.zajavki .filter input[name="cdate"]').val("");
		
		var selectbox1 = $('.zajavki .filter select[name="status"]');
		selectbox1.prop('selectedIndex',0);
        $(".zajavki .filter .jq-selectbox__select-text").html("Все");
		$(".zajavki .filter .jq-selectbox__dropdown ul li").removeClass("sel");
		$(".zajavki .filter .jq-selectbox__dropdown ul li").removeClass("selected");
				
		
    });
		
	
	$(document).delegate('.zajavki .filter input[name="account_number"]', 'input', function () {
		//сбросить соседние поля
		$('.zajavki .filter input[name="id"]').val("");
		$('.zajavki .filter input[name="cdate"]').val("");
		
		var selectbox1 = $('.zajavki .filter select[name="status"]');
		selectbox1.prop('selectedIndex',0);
        $(".zajavki .filter .jq-selectbox__select-text").html("Все");
		$(".zajavki .filter .jq-selectbox__dropdown ul li").removeClass("sel");
		$(".zajavki .filter .jq-selectbox__dropdown ul li").removeClass("selected");
				
		
    });	

		
	$(document).delegate('.zajavki .filter input[name="cdate"]', 'focus', function () {
		//сбросить соседние поля
		$('.zajavki .filter input[name="id"]').val("");
		$('.zajavki .filter input[name="account_number"]').val("");
		
		var selectbox1 = $('.zajavki .filter select[name="status"]');
		selectbox1.prop('selectedIndex',0);
        $(".zajavki .filter .jq-selectbox__select-text").html("Все");
		$(".zajavki .filter .jq-selectbox__dropdown ul li").removeClass("sel");
		$(".zajavki .filter .jq-selectbox__dropdown ul li").removeClass("selected");
				
		
    });	
	
	
	
	
	

	
	
	

    function scroll (a) {
        var b = parseInt($(a).offset().top) - 30;

        $('body').animate({
            scrollTop: b
        }, 500);

    }
    /************************end*********************************big popup*/
    
  	
    
    
})

	
	function button_more(){
		
		var cnt=0;
		$('.oneClaim').each(function(i,elem) {
			if($(this).css('display')=='none'){
				cnt++;	
			}
			
		});
		//alert(cnt);
			if((cnt<10)&&(cnt!=0)){
				$('.moreBtns .more').html("Ещё "+cnt);
			}else if(cnt==0){
				$('.moreBtns .more').fadeOut(500);
			}		
		
	}

	
	$(window).load(function () {
		button_more();
		
		
		
		$('.zajavki .filter .jq-selectbox__dropdown li:first-child').click(function(){
		var t=$('.zajavki select[name="status"] option:selected').text();
		var text1=$('.zajavki input[name="id"]').val();
		var text2=$('.zajavki input[name="account_number"]').val();
		var text3=$('.zajavki input[name="cdate"]').val();

		//alert(text1);
		//alert(text2);
		//alert(text3);
		
		
		if((t=="Все") && (text1!="" || text2!="" || text3!="")){
		//сброс фильтра
		location.href="/requests/archive/";
		
		}
		});
		
		
		
		
			// добавить год в селектор с месяцем
			var mdate = new Date(); 
			var y=mdate.getFullYear();
			$('.zajavki #ui-datepicker-div .ui-datepicker-month option').each(function(){
				
				var h1=$(this).html();
				h1=h1+"  "+y;
				$(this).html(h1);
			});
			 
		
		
		
		
		
		
	});

	function second_passed_1() {
		
		//$('.ui-datepicker-month option').on('each', function(){
		//	alert("=");	
		//});
		var date = new Date();
		var m=date.getMonth();
		var y=date.getFullYear();
		m=parseInt(m);	
		
		
		
		$(".ui-datepicker-month option").each(function(){
			var v=$(this).val();
			v=parseInt(v);
			
			var dis=v-m;
			dis=parseInt(dis);
			dis=Math.abs(dis); 
			
			
			if(dis>=6){
				
				$(this).prop('disabled', true);
			}
			
			
			
			var h1=$(this).html();
				h1=h1+"  "+y;
				$(this).html(h1);
			
		});
		
		
		
			 
		
		
		
		
		
							
	
	}

	
	$('.zajavki .filter input[name="cdate"]').focus(function(){
		
		setTimeout(second_passed_1, 500);
		
	});
	
	
	

	
	
	
	 function requests_more(){
	 var data1 = $('.zajavki a.more').attr('data-number');	
	 	
	 data1=parseInt(data1);
	 //alert(data1);
	 for(i=data1;i<=(data1+10);i++){
	 	$('.zajavki .queueClaims .oneClaim:nth-child('+i+')').fadeIn(500);
	 }
	 data1=data1+10;
	 $('.zajavki a.more').attr('data-number',data1);
	 	
	 button_more();
	 	
	}
	
	
	
	
	
	 function requests_more2(){
	 var data1 = $('.otgruzkiPage a.more').attr('data-number');	
	 	
	 data1=parseInt(data1);
	 //alert(data1);
	 for(i=data1;i<=(data1+10);i++){
	 	$('.otgruzkiPage .oneClaim:nth-child('+i+')').fadeIn(500);
	 }
	 data1=data1+10;
	 $('.otgruzkiPage a.more').attr('data-number',data1);
	 	
	 button_more();
	 	
	}
	
	
	
	function clear_inputs(){
		$('input.arts').val("");
		$('input.namma').val("");
		
	};
	
	function clear_inputs2(){

		$('input.arts2').val("");
		$('input.namma2').val("");
		
	};
	
	
	
	

	