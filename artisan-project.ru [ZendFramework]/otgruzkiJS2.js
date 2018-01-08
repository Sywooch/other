$(document).ready(function () {
    'use strict';
    


	$(window).load(function () {
		
		
		
		var company=$("#company").val();
		
		$('.jq-selectbox.jqselect.last select[name="transport_company_id"] option').each(function(){
			var t=$(this).text();
			if(company==t){ 
				$(this).attr("selected", "selected");
				$('.jq-selectbox.jqselect.last .jq-selectbox__select-text').removeClass('placeholder');
				$('.jq-selectbox.jqselect.last .jq-selectbox__select-text').text(company);
				$(this).click();
				$('.jq-selectbox.jqselect.last ul li')
				
			};
		});
		
		$('.jq-selectbox.jqselect.last ul li').each(function(){
			var t=$(this).text();
			
			if(company==t){ 
				
				$(this).click();
			};
		});
		
		
		var date=$("#shipment_form_sdate").val();
		 
		var m=date.split('.');
		
		var year=m[0];
		var month=m[1];
		var day=m[2];
		
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
			
			if((data_year==year) && (data_month==month) && (data_day==day)){
				$('.secondShipping.sendt .ui-datepicker-calendar td').removeClass('ui-datepicker-current-day');
				$(this).addClass('ui-datepicker-current-day');	
			}
			
			
		});

		
		
		
		
		
		
		
	
	});
		
});



function edit_ship(id){

var type=$('#type_id').val();
var prep=$('select[name="prep_id"]').val();
var company=$('select[name="transport_company_id"] option:selected').text();
var comment=$('textarea[name="comment"]').val();
var date=$('#shipment_form_sdate').val();


	var params = {type:type,prep:prep,company:company,comment:comment,date:date,id:id};
			
					$.ajax({
		  				url: "/edit_ship.php",
		  				type: "POST",
		  				data: params,
		 				success: function(data)	{
							location.href='/shipment/archive';
		 					
							
						}
					});
			


}





