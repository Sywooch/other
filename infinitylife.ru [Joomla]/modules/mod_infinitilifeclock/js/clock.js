jQuery(function($) {
	// clock
	$(document).ready(function() {
		var newDate = new Date();
		newDate.setDate(newDate.getDate());
		setInterval( function() {
			var hours = new Date().getHours();
			var minutes = new Date().getMinutes();

			$('.datetime .date').html(( newDate.getDate() < 10 ? "0" : "" ) + newDate.getDate() + '.' + ( (newDate.getMonth()+1) < 10 ? "0" : "" ) + (newDate.getMonth()+1) + '.' + newDate.getFullYear());
			$(".datetime .time").html(( hours < 10 ? "0" : "" ) + hours + '<span class="clockpoint">:</span>' + ( minutes < 10 ? "0" : "" ) + minutes);
		},1000);
	}); 
});