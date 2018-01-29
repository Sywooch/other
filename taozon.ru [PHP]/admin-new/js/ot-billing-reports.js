var BillingPage = Backbone.View.extend({
    "el": $("#billing-view-wrapper")[0],
    "events": {
        "click .collapseBills": "collapseBills"
    },
	collapseBills: function (e) {
        e.preventDefault();               
        var target = this.$(e.target);
        if (! $('.ot_show_all_bills').attr('opened')) { 
            target.html(trans.get('Hide_payed_bills'));            
            $('.ot_show_all_bills').show();//.css('height','auto');
            $('.ot_show_all_bills').attr('opened','1');
        } else {            
            target.html(trans.get('Show_payed_bills'));            
            $('.ot_show_all_bills').hide();//.css('height','0px');
            $('.ot_show_all_bills').removeAttr('opened');
        }
        
        return false;
    }
});

$(function(){
    new BillingPage();	
});
