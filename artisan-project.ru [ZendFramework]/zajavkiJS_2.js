
	var g1=0;

	
    function generate(layout) {
		location.href = "#";
        var n = noty({
            text        : 'ВЫ ХОТИТЕ ПОКИНУТЬ СТРАНИЦУ НЕ ОТПРАВИВ ЗАЯВКУ ?',
            type        : 'alert',
            dismissQueue: true,
            layout      : layout,
            theme       : 'defaultTheme',
            buttons     : [
                {addClass: 'btn btn-primary', text: 'Да', onClick: function ($noty) {
                    $noty.close();
                  
				  
				    
					noty({dismissQueue: true, force: true, layout: layout, theme: 'defaultTheme', text: 'You clicked "Ok" button', type: 'success'});
					
					
					
                }
                },
                {addClass: 'btn btn-danger', text: 'Нет', onClick: function ($noty) {
                    $noty.close();
                   
				   
				   
				    noty({dismissQueue: true, force: true, layout: layout, theme: 'defaultTheme', text: 'You clicked "Cancel" button', type: 'error'});
					
					
					
                }
                }
            ]
        });
        console.log('html: ' + n.options.id);
		return false;
    }





/*
window.onbeforeunload = function(e) {
e.preventDefault();



	generate('topCenter');



}
*/


/*



       if(allowPrompt) {
            if (!areYouReallySure && !internalLink && true) {
                location.href = "#";
      			generate('topCenter');
				return false;
				
		    }
        } else {
            allowPrompt = true;
        }
		
		







$(window).bind('beforeunload', function(e) {
                if(!$.browser.mozilla){ //
                    return "Внимание! \n\
Вы собираетесь покинуть  страницу. \n\n\
Подумайте еще раз!\n";
                }
            }); 
*/


/*$('.derses').submit(function() {
g1=1;	
 window.onbeforeunload = null;
});
*/


window.onbeforeunload = function(e) {
	return false;
    var msg = 'ВЫ ХОТИТЕ ПОКИНУТЬ СТРАНИЦУ НЕ ОТПРАВИВ ЗАЯВКУ ?';
    if(typeof e == "undefined")
        e = window.event;
    if(e)
        e.returnValue = msg;
    return msg;
}










	