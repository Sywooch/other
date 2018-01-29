<?php

class THSNotifier {
    private static $notificationsRepository;
    private static $eventQueue = array();

    public static function run()
    {
        if (rand(0, 100) > 30) {
            return;
        }

        try {
            self::init();
            self::getHistory();
            self::clearEventQueue();
        } catch(Exception $e) {
        }
    }

    private  static function init()
    {
        self::$notificationsRepository = new THSNotificationsRepository(new CMS());
    }

    private  static function getHistory()
    {
        global $otapilib;
        $otapilib->setErrorsAsExceptionsOn();
        $history = $otapilib->GetOrdersHistory(Session::getUserSession());
        $ids = array();
        foreach ($history as $event) {
            self::processEvent($event);
            $ids[] = $event['Id'];
        }
        if ($ids) {
            $otapilib->ClearOrdersHistory(Session::getUserSession(), implode(';', $ids));
        }

        /** Обработка очереди событий */
        foreach (self::$eventQueue as $template => $orders) {
            foreach ($orders as $orderId=>$events) {
                /* возможно еще какие-то события будем объединять в дальнейшем */
                if ($template == 'on_order_line_status_changed') {
                    self::onLinesStatusChanged($orderId, $events);
                }

                /*if (count($events) == 1) {
                    if ($template == 'on_order_line_status_changed') {
                        self::onLineStatusChanged($event);
                    }
                } else {
                    if ($template == 'on_order_line_status_changed') {
                        self::onLinesStatusChanged($orderId, $events);
                    }
                }*/
            }
        }
    }

    private static function clearEventQueue () 
    {
        self::$eventQueue = array();
    }

    private static function processEvent($event)
    {
        if($event['OrderLineId'] == '0' && $event['NewStatus']['Id'] != 39){
            self::onOrderStatusChanged($event);
        } elseif($event['OrderLineId'] == '0' && $event['NewStatus']['Id'] == 39){
            self::onOrderSend($event);
        } else {
            self::$eventQueue['on_order_line_status_changed'][$event['OrderId']][] = $event;
        }
    }

    private static function onOrderSend ($event)
    {
        $orderId = OrdersProxy::normalizeOrderId('ORD-'.str_pad($event['OrderId'], 10, '0', STR_PAD_LEFT));
        Notifier::generalUserNotification($event['UserInfo']['Email'], 'on_order_send', Lang::get('order_status_changed', array('orderid' => $orderId)), array(
            'username' => $event['UserInfo']['Login'],
            'orderid' => $orderId,
            'oldstatus' => $event['OldStatus']['Name'],
            'newstatus' => $event['NewStatus']['Name'],
        ));
    }

    private static function onOrderStatusChanged ($event)
    {
        $orderId = OrdersProxy::normalizeOrderId('ORD-'.str_pad($event['OrderId'], 10, '0', STR_PAD_LEFT));
        Notifier::generalUserNotification($event['UserInfo']['Email'], 'on_order_status_changed', Lang::get('order_status_changed', array('orderid' => $orderId)), array(
            'username' => $event['UserInfo']['Login'],
            'orderid' => $orderId,
            'oldstatus' => $event['OldStatus']['Name'],
            'newstatus' => $event['NewStatus']['Name'],
        ));
    }

    private static function onLineStatusChanged ($event)
    {
        $orderId = OrdersProxy::normalizeOrderId('ORD-'.str_pad($event['OrderId'], 10, '0', STR_PAD_LEFT));
        $subject = Lang::get('order_line_status_changed', array(
            'orderid' => $orderId,
            'item' => $event['OrderId'].'-'.$event['OrderLineId']
        ));
        Notifier::generalUserNotification($event['UserInfo']['Email'], 'on_order_line_status_changed', $subject, array(
            'username' => $event['UserInfo']['Login'],
            'orderid' => $orderId,
            'oldstatus' => $event['OldStatus']['Name'],
            'newstatus' => $event['NewStatus']['Name'],
            'item' => $event['OrderId'].'-'.$event['OrderLineId']
        ));
    }

    private static function onLinesStatusChanged ($orderId, $events)
    {
        $orderId = OrdersProxy::normalizeOrderId('ORD-'.str_pad($orderId, 10, '0', STR_PAD_LEFT));
        $subject = Lang::get('order_line_status_changed_2', array(
            'orderid' => $orderId
        ));

        foreach ($events as &$event) {
            $event['username']  = $event['UserInfo']['Login'];
            $event['orderid']   = $orderId;
            $event['oldstatus'] = $event['OldStatus']['Name'];
            $event['newstatus'] = $event['NewStatus']['Name'];
            $event['item']      = $event['OrderId'].'-'.$event['OrderLineId'];
        }

        Notifier::generalUserNotification($events[0]['UserInfo']['Email'], 'on_order_lines_status_changed', $subject, array(
            'username' => $events[0]['UserInfo']['Login'],
            'orderid' => $orderId,
            'events' => $events
        ));
    }
}