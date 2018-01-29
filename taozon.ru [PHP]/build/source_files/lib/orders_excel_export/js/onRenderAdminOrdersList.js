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
                        window.location = '../lib/orders_excel_export/export_order.php?id='+orderId;
                    })
            );
    });
});
