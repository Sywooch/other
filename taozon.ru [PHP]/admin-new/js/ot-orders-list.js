var OrdersPage = Backbone.View.extend({
    "el": ".orders-common-wrapper",
    "events": {
        "click .checkAll"       : "toggleCheckAll",
        "click #restoreOrders"  : "bulkRestoreOrdersAction",
        "click #cancelOrders"   : "bulkCancelOrdersAction",

        "click #showAllFilters" : "showAllFilters",
        "change #periodFilter"  : "setPeriodFilter",

        "click .exportOrder"    : "exportOrderAction",
        "click .restoreOrder"   : "restoreOrderAction",
        "click .cancelOrder"    : "cancelOrderAction",

        "click .deleteItemFromOrder"    : "deleteItemFromOrderAction",
        "click .splitItemQuantity"      : "splitItemQuantityAction",
        "click .changeItemStatus A"     : "changeItemStatusAction",

        "click .itemRow span[data-target*=more-info]" : "toggleItemInfo",

        "click .orderRow .ot_show_goods_list" : "showOrderItemsList",
        "click a[href=#ot_goods_filter_tab]" : "showOrdersItemsTab",
        "click a[href=#ot_orders_filter_tab]" : "showOrdersListTab",

        "click a.showCustomerInfo" : "showCustomerInfoAction",

        "change input[type=checkbox]" : "updateSelectedRows",
        "click a.mergeOrders": "mergeOrders",
        
        "click .bulkChangeItemStatus A" : "bulkChangeItemStatusAction",
    },
    bulkChangeItemStatusAction: function(ev){
        ev.preventDefault();
        var target = this.$(ev.target);
        var button = target.parents('.btn-group:first').find('button');
        var items = {};
        var count = 0;
        
        $.each($('.goods-wrapper table tr.itemRow.selected_item:visible'), function(){
        	if (undefined == items[$(this).data('order-id')]) {
        		items[$(this).data('order-id')] = [];        		
        	}
        	items[$(this).data('order-id')].push($(this).attr('id'));
        	count++;
        });
        if (! count) {
            showError(trans.get('No_items_selected'));
            return;
        }
        button.addClass('disabled').find('i').attr('class', 'ot-preloader-micro');
        button.parent().removeClass('open');
        $.post(
            'index.php?cmd=orders&do=changeItemsStatus',
            {
                'orders'     : items,
                'status'    : target.data('status')
            },
            function (data) {
                button.removeClass('disabled').find('i').attr('class', 'icon-star-empty');
                if (! data.error) {
                    showMessage(data.message ? data.message : trans.get('Notify_success'));
                    window.location.reload();
                } else {
                    showError(data);
                }
            }, 'json'
        );
        return false;
    	
    },
    render: function()
    {
        return this;
    },
    initialize: function(){
        this.render();
    },
    showCustomerInfoAction: function(ev){
        ev.preventDefault();
        var itemRow = $(ev.target).closest('tr');
        $(ev.target).attr('class', 'ot-preloader-micro').empty();
        var orderId = itemRow.data('order-id');
        var order = Orders.get(orderId);
        var fillData = function (order) {
            var customerInfoHtml = '<a target="_blank" href="index.php?cmd=users&do=profile&id=' +
                order.get('custid') + '" title="Профиль пользователя">' + escapeData(order.get('custname')) +
                '</a><br/>' + order.get('useraccountavailableamount') + '&nbsp;' + order.get('currencysign');
            $('.itemRow[data-order-id="' + order.id + '"]').each(function (i, row) {
                $(row).find('.ot_operator_name').html(order.get('operatorname'));
                $(row).find('.ot_customer_info').html(customerInfoHtml);
            });
        }
        if (order && order.id === orderId) {
            fillData(order);
        } else {
            $.post('index.php?cmd=orders&do=getOrderInfo', {'orderId': orderId}, function (data) {
                if (data.error) {
                    showError(data);
                } else if (data.order) {
                    Orders.add(data.order);
                    fillData(Orders.get(orderId));
                }
            }, 'json');
        }
        return false;
    },
    showOrdersListTab: function(ev){
        var targetDiv = $($(ev.currentTarget).attr('href'));
        if (targetDiv.hasClass('orders-list-loaded')) {
            return;
        }
        var params = $.deparam.querystring();
        params['do'] = 'searchOrders';
        params['cmd'] = 'orders';
        $.post('index.php', params, function (data) {
            if (data.error) {
                showError(data);
            } else {
                if (data.html) {
                    targetDiv.find('tbody').empty().html(data.html);
                    targetDiv.addClass('orders-list-loaded');
                    targetDiv.find('.pagination-orders').html(data.pagination);
                    _.each(data.orders, function (order) {
                        Orders.add(order);
                    });
                    if ('function' === typeof window['initOrdersExportEvents']) {
                        initOrdersExportEvents();
                    }
                    if ('function' === typeof window['initOrdersItemsExportEvents']) {
                        initOrdersItemsExportEvents();
                    }
                }
            }
        }, 'json');
    },
    showOrdersItemsTab: function(ev){
        var targetDiv = $($(ev.currentTarget).attr('href'));
        if (targetDiv.hasClass('items-list-loaded')) {
            return;
        }
        var params = $.deparam.querystring();
        params['do'] = 'searchOrdersLines';
        params['cmd'] = 'orders';
        $.post('index.php', params, function (data) {
            if (data.error) {
                showError(data);
            } else {
                if (data.html) {
                    targetDiv.find('tbody').empty().html(data.html);
                    targetDiv.addClass('items-list-loaded');
                    targetDiv.find('.pagination-items').html(data.pagination);
                    _.each(data.items, function (item) {
                        OrdersItems.add(item);
                    });
                    if ('function' === typeof window['initOrdersExportEvents']) {
                        initOrdersExportEvents();
                    }
                    if ('function' === typeof window['initOrdersItemsExportEvents']) {
                        initOrdersItemsExportEvents();
                    }
                }
            }
        }, 'json');
    },
    showOrderItemsList: function(ev){
        var targetDiv = $($(ev.currentTarget).data('target'));
        if (targetDiv.find('> div.well').hasClass('items-list-loaded')) {
            return;
        }
        var orderRow = $(ev.target).closest('tr');
        var orderId = orderRow.attr('id');
        $.post('index.php?cmd=orders&do=getOrderItems', {id: orderId}, function (data) {
            if (data.error) {
                showError(data);
            } else {
                _.each(data.items, function (item) {
                    OrdersItems.add(item);
                });
                var order = Orders.get(orderId);
                order.set('numericId', orderRow.data('numeric-id'));
                var itemsListHtml = renderTemplate('orders/item/list', {
                    'items': data.items,
                    'order': order
                });
                targetDiv.find('.ot_items_list_content').replaceWith(itemsListHtml);
                targetDiv.find('> div.well').removeClass('well-transp').addClass('items-list-loaded');
            }
        }, 'json');
    },
    toggleItemInfo: function(ev){
        var targetDiv = $($(ev.currentTarget).data('target'));
        if (targetDiv.find('> div.well').hasClass('item-details-loaded')) {
            return;
        }
        var itemRow = $(ev.target).closest('tr');
        var item = OrdersItems.get(itemRow.attr('id'));
        item.set('imagePreview', itemRow.data('image-preview'));
        var itemPrice = parseFloat(item.get('newpricecust')) ? item.get('newpricecust') : item.get('pricecust');
        item.set('NewAmountCust', parseFloat(itemPrice * item.get('qty')));
        var config = item.get('configtext').split(';');
        var originalConfig = item.get('configexternaltextorig').split(';');
        item.set('config', _.filter(config.concat(originalConfig), function (configItem) {
            return configItem.length;
        }));

        $.get('templates/orders/item.html?' + Math.random(), function (tpl) {
            var itemDetailsHtml = _.template(tpl, {'item': item});
            targetDiv.html(itemDetailsHtml);

            // Вывести цену товара
            $.get('templates/inline_elements/text.html?' + Math.random(), function (tpl) {
                var itemPriceHtml = _.template(tpl, {
                    'name': 'newPrice',
                    'value': itemPrice,
                    'saveUrl': 'index.php?cmd=orders&do=changeItemPrice',
                    'parameters': {
                        'useLabel': false,
                        'useWrapper': false,
                        'pk': item.get('id') + '_' + item.get('orderid'),
                    }
                });
                targetDiv.find('.editablePrice').html(itemPriceHtml).find('a').editable({
                    inputclass: 'input-custom-mini',
                    clear: false,
                    success: function(data){
                        if (data && 'undefined' !== typeof data.amountcust) {
                            targetDiv.find('.amountcust span').html(
                                parseFloat(data.amountcust) + '&nbsp;' + item.get('internalpricecurrencycode')
                            );
                            var newStatusCode = 3; // Подтверждение цены
                            var newStatusName = itemRow.find('.changeItemStatus a[data-status=' + newStatusCode + ']').text();
                            itemRow.find('.statusName').text($.trim(newStatusName));
                            item.set('statusname', $.trim(newStatusName));
                            item.set('statusid', newStatusCode);
                            item.set('statuscode', newStatusCode);
                        }
                    }
                });
            });
        });
    },
    bulkRestoreOrdersAction: function(ev){
        ev.preventDefault();
        showError('bulkRestoreOrdersAction: Not implemented yet');
        return false;
    },
    bulkCancelOrdersAction: function(ev){
        ev.preventDefault();
        showError('bulkCancelOrdersAction: Not implemented yet');
        return false;
    },
    restoreOrderAction: function(ev){
        ev.preventDefault();
        modalDialog(trans.get('Confirm_needed'), trans.get('Really_restore_this_order'), function(dialog){
            var target = this.$(ev.target);
            var button = target.parents('ul:first').prev();
            button.addClass('disabled').find('i').attr('class', 'ot-preloader-micro');
            button.parent().removeClass('open');
            $.post(
                target.data('action'),
                {'id': target.parents('tr').attr('id')},
                function (data) {
                    button.removeClass('disabled').find('i').attr('class', 'icon-cog');
                    if (! data.error) {
                        showMessage(data.message ? data.message : trans.get('Notify_success'));
                        target.parents('tr').next().andSelf().remove();
                    } else {
                        showError(data);
                    }
                }, 'json'
            );
        });
        return false;
    },
    cancelOrderAction: function(ev){
        ev.preventDefault();
        modalDialog(trans.get('Confirm_needed'), trans.get('Really_cancel_this_order'), function(dialog){
            var target = this.$(ev.target);
            var button = target.parents('ul:first').prev();
            button.addClass('disabled').find('i').attr('class', 'ot-preloader-micro');
            button.parent().removeClass('open');
            $.post(
                target.data('action'),
                {'id': target.parents('tr').attr('id')},
                function (data) {
                    button.removeClass('disabled').find('i').attr('class', 'icon-cog');
                    if (! data.error) {
                        showMessage(data.message ? data.message : trans.get('Notify_success'));
                        target.parents('tr').next().andSelf().remove();
                    } else {
                        showError(data);
                    }
                }, 'json'
            );
        });
        return false;
    },
    deleteItemFromOrderAction: function(ev){
        ev.preventDefault();
        modalDialog(trans.get('Confirm_needed'), trans.get('Really_delete_this_item_from_order'), function(dialog){
            var target = this.$(ev.target);
            var button = target.parents('ul:first').prev();
            button.addClass('disabled').find('i').attr('class', 'ot-preloader-micro');
            button.parent().removeClass('open');
            $.post(
                target.data('action'),
                {'itemid': target.parents('tr').attr('id'), 'orderid': target.parents('tr').data('order-id')},
                function (data) {
                    button.removeClass('disabled').find('i').attr('class', 'icon-cog');
                    if (! data.error) {
                        showMessage(data.message ? data.message : trans.get('Notify_success'));
                        target.parents('tr').next().andSelf().remove();
                    } else {
                        showError(data);
                    }
                }, 'json'
            );
        }, {
           'confirm' : trans.get('Delete'),
        });
        return false;
    },
    changeItemStatusAction: function(ev){
        ev.preventDefault();
        var target = this.$(ev.target);
        var button = target.parents('.btn-group:first').find('button');
        button.addClass('disabled').find('i').attr('class', 'ot-preloader-micro');
        button.parent().removeClass('open');
        var itemRow = $(ev.target).closest('tr');
        var item = OrdersItems.get(itemRow.attr('id'));
        $.post(
            'index.php?cmd=orders&do=changeItemStatus',
            {
                'itemId'    : item.get('id'),
                'orderId'   : item.get('orderid'),
                'status'    : target.data('status'),
                'comment'   : item.get('operatorcomment'),
                'quantity'  : item.get('qty')
            },
            function (data) {
                button.removeClass('disabled').find('i').attr('class', 'icon-star-empty');
                if (! data.error) {
                    showMessage(data.message ? data.message : trans.get('Notify_success'));
                    // 13 - cancelled
                    if (target.data('status') == 13) {
                        itemRow.find('.exportOrderItem a').hide();
                        itemRow.find('input.for_group_action').attr('disabled', 'disabled');
                    } else {
                        itemRow.find('.exportOrderItem a').show();
                        itemRow.find('input.for_group_action').removeAttr('disabled');
                    }
                    itemRow.find('.statusName').text($.trim(target.text()));
                    item.set('statusname', $.trim(target.text()));
                    item.set('statusid', target.data('status'));
                    item.set('statuscode', target.data('status'));
                } else {
                    showError(data);
                }
            }, 'json'
        );
        return false;
    },
    splitItemQuantityAction: function(ev){
        ev.preventDefault();
        var itemRow = $(ev.target).closest('tr');
        var item = OrdersItems.get(itemRow.attr('id'));
        if (item.get('qty') <= 1) {
            return false;
        }
        modalDialog(
            trans.get('Split_item_suggestion'),
            '<input type="text" name="splitQuantity" value="1" />',
            function (dialog) {
                var splitQuantity = parseInt(dialog.find('input[name=splitQuantity]').val());
                if (splitQuantity < 1 || splitQuantity >= item.get('qty')) {
                    showError(trans.get('Incorrect_quantity'));
                    return false;
                }
                var target = this.$(ev.target);
                var button = target.parents('ul:first').prev();
                button.addClass('disabled').find('i').attr('class', 'ot-preloader-micro');
                button.parent().removeClass('open');
                $.post(
                    target.data('action'),
                    {
                        'itemId': item.get('id'),
                        'orderId': item.get('orderid'),
                        'splitQuantity': splitQuantity
                    },
                    function (data) {
                        button.removeClass('disabled').find('i').attr('class', 'icon-cog');
                        if (! data.error) {
                            showMessage(data.message ? data.message : trans.get('Notify_success'));
                            window.location.reload();
                        } else {
                            showError(data);
                        }
                    }, 'json'
                );
            }, {
               'confirm' : trans.get('Split'),
            }
        );
        return false;
    },
    showAllFilters: function(ev){
        ev.preventDefault();
        this.$('#filtersShort').fadeOut(100);
        this.$('#filtersAll').fadeIn(100);
        return false;
    },
    setPeriodFilter: function(ev){
        ev.preventDefault();
        var period = $(ev.target).val();
        if ('undefined' !== typeof periodsFilters[period]) {
            $('#date-start').datepicker('update', new Date(periodsFilters[period].start));
            $('#date-start-display').val($('#date-start').data('date'));
            $('#date-end').datepicker('update', new Date(periodsFilters[period].end));
            $('#date-end-display').val($('#date-end').data('date'));
        }
        return false;
    },
    toggleCheckAll: function(ev){
        var self = this.$(ev.target);
        self.parents('thead').next().find('input[type=checkbox]:not(:disabled)')
            .prop('checked', self.is(':checked'))
            .trigger('change');
    },
    updateSelectedRows: function(ev){
        var checkbox = $(ev.target);
        if (checkbox.hasClass('checkAll')) {
            return;
        }
        if (checkbox.is(':checked')) {
            checkbox.closest('tr').addClass('selected_item').next('tr').addClass('selected_item');
        } else {
            checkbox.closest('tr').removeClass('selected_item').next('tr').removeClass('selected_item');
        }
    },
    mergeOrders: function(e)
    {
        var tr = $(e.currentTarget).closest('tr');
        var orderId = $(tr).attr('id');
        var customerId = $(tr).attr('customerId');

        var dialog;
        var content = '<div class="editableform-loading"></div>';
        var onConfirmCallback = function (body) {
            var selected = $("input[type='radio']:checked", body);
            if (selected.length > 0) {
                var order2Id = $(selected).attr('id');
                //merge orders
                $.post('index.php?cmd=orders&do=mergeOrders',
                    {
                        'orderId': orderId,
                        'order2Id': order2Id
                    },
                    function (data) {
                        if (! data.error) {
                            if (data.result === 'ok') {
                                //redirect
                                window.location.href = 'index.php?cmd=orders&do=list';
                            } else {
                                showError(data.result);
                            }
                        } else {
                            showError(data.message);
                            dialog.find('.close').trigger('click');
                        }
                    },
                    'json'
                );
                return true;
            } else {
                showError(trans.get('Select_order_to_merge_please_or_click_Cancel'));
                return false;
            }
        };

        var onShowCallback = function (body) {
            $.post(
                'index.php?cmd=orders&do=getOrdersListForMerge',
                {
                    'orderId': orderId,
                    'customerId': customerId
                },
                function (data) {
                    if (! data.error) {
                        contents = data.orders;
                        body.html(contents);
                    } else {
                        showError(data);
                        dialog.find('.close').trigger('click');
                    }
                },
                'json'
            );
        };

        dialog = modalDialog(
            trans.get('Select_order_for_merge'),
            content,
            onConfirmCallback,
            {'confirm': trans.get('Merge'), 'cancel': trans.get('Cancel')},
            onShowCallback
        );
    }

});

$(function(){
    var O = new OrdersPage();
});
