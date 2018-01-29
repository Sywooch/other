function OrderQueue(){
    this.queue = 0;
    this.orders = [];
    this.pop = function(){
        this.queue--;
        if(!this.queue){
            var that = this;
            $('.batch-export-single-order.success-export').each(function(){
                that.orders.push($(this).attr('data-order-id'));
            });
            $('.batch-export-single-order').removeClass('batch-export-single-order');
            this.exportOrders();
        }
    }
    this.push = function(){
        this.queue++;
    }
    this.exportOrders = function(){
        $.post('../packages/orders_excel_export_local/batch_export.php', {'orders': this.orders})
            .success(function(fileUrl){
                window.location = fileUrl;
            })
            .error(function(xhr, ajaxOptions, thrownError){
                handleAjaxError(xhr, ajaxOptions, thrownError);
            });
    }
}
var orderQueue = new OrderQueue();

(function( $ ) {
    $.fn.exportOrder = function() {
        var that = this;
        $(this).append(
            $('<img />')
                .attr({
                    'src': "css/i/ajax-loader.gif"
                })
                .addClass('batch-export-single-order')
        );

        $.get('../packages/orders_excel_export_local/save_order_info.php', {'orderId': $(that).attr('data-order-id')})
            .success(function(){
                orderQueue.pop();
                $(that).addClass('success-export').html($('<strong></strong>')
                    .css('color', 'green')
                    .text(trans.get('order_ready_for_export')));
            })
            .error(function(xhr, ajaxOptions, thrownError){
                orderQueue.pop();
                if(thrownError == 'SessionExpired'){
                    window.location = 'index.php?cmd=login';
                }
                else{
                    $(that).html($('<strong></strong>')
                        .css('color', 'red')
                        .html(thrownError + '<br />' + xhr.responseText));
                }
            });
    };
})(jQuery);

$(function(){
    $('#orders tr:gt(0)').each(function(){
        var orderId = $(this).find('td:first').find('a').text();

        $(this)
            .find('td:last')
            .append(
                $('<button></button>')
                    .text(trans.export)
                    .button()
                    .click(function(){
                        window.location = '../packages/orders_excel_export_local/export_order.php?id='+orderId;
                    })
            );
    });
    $('#filter-buttons')
        .append('<br />')
        .append('<br />')
        .append(
        $('<button></button>')
            .attr('class', 'ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only')
            .text(trans.get('orders_export'))
            .click(function(){
                $('#orders tr:gt(0)').each(function(){
                    $(this)
                        .find('td:last')
                        .append('<br /><br />')
                        .append($('<div></div>')
                            .attr({
                                'data-order-id': $(this).attr('data-order-id')
                            })
                            .addClass('batch-export-single-order'));
                });
                $('.batch-export-single-order').each(function(){
                    orderQueue.push();
                    $(this).exportOrder();
                });

                return false;
            })
    );
});

