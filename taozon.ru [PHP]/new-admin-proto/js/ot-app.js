
// OT application code in here.
$(document).ready( function () {

    //local help popup
//    $('.ot_inline_help').popover();
    $('.ot_inline_help').clickover();

    // popups for user info on discount page
    $('.info-discount-user').each(function(){
        var content = $(this).closest('tr').find('.user-discount-info').html();
        $(this).clickover({
            'content': content,
            'html': true,
            'trigger': 'click',
            'width': '300'
        });
    });

    // popups for item info on order page goods tab
    $('.ot_product_item_description_popup').each(function(){
        var content = $(this).closest('div').find('.ot_popup_product_item_description_info').html();
        $(this).clickover({
            'content': content,
            'html': true,
            'trigger': 'click',
            'width': '300'
        });
    });




    //modals
    $('.ot_show_modal_dialog').click(function(e){
        e.preventDefault();
        $('.ot_modal_dialog_window').modal('show');
    });

    $('.ot_show_delivery_tariff_modal').click(function(e){
        e.preventDefault();
        $('.ot_delivery_tariff_modal').modal('show');
    });

    $('.ot_show_deletion_dialog_modal').click(function(e){
        e.preventDefault();
        $('.ot_deletion_dialog_modal').modal('show');
    });

    $('.ot_show_order_item_photos_window').click(function(e){
        e.preventDefault();
        $('.ot_add_order_item_photos_window').modal('show');
    });

    $('.ot_show_packages_election_window').click(function(e){
        e.preventDefault();
        $('.ot_packages_election_window').modal('show');
    });

    $('.ot_show_edit_seller_dialog_modal').click(function(e){
        e.preventDefault();
        $('.ot_edit_seller_dialog_modal').modal('show');
    });

    $('.ot_show_edit_selections_product_window').click(function(e){
        e.preventDefault();
        $('.ot_edit_selections_product_dialog_window').modal('show');
    });

    $('.ot_show_settle_descr_window').click(function(e){
        e.preventDefault();
        $('.ot_settle_descr_window').modal('show');
    });

    $('.ot_show_settle_item_dicline_window').click(function(e){
        e.preventDefault();
        $('.ot_settle_item_dicline_window').modal('show');
    });

    $('.ot_show_crud_cat_item_window').click(function(e){
        e.preventDefault();
        $('.ot_crud_cat_item_window').modal('show');
    });

});

//loading state on a signup submit button
$('.btn.btn_preloader').click(function(){
     var $button = $(this).button('loading');
     setTimeout(function(){
     $button.button('reset');
     }, 2500);
 });


$('.ot_form_orders_filters .well').hover(
    function(){ $(this).addClass('well-white')
    },
    function(){ $(this).removeClass('well-white')
    }
);

