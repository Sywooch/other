<?php
/**
 * Класс-прослойка для нормализации данных заказов
 */
class OrdersProxy
{
    /**
     * @var OTAPIlib
     */
    protected $otapilib;

    public static function normalizeOrderId($orderId)
    {
        $normalizedOrderId = defined('CFG_PREFIX_REPLACE_ORD') ? str_replace('ORD', CFG_PREFIX_REPLACE_ORD, (string)$orderId) : (string)$orderId;

        return $normalizedOrderId;
    }

    public static function originOrderId($orderId)
    {
        $orderId = defined('CFG_PREFIX_REPLACE_ORD') ? str_replace(CFG_PREFIX_REPLACE_ORD, 'ORD', (string)$orderId) : (string)$orderId;

        return $orderId;
    }

    public static function getOrderNumericId($orderId)
    {
        $numericId = $orderId;
        if (preg_match('#[1-9]+#si', $orderId, $m, PREG_OFFSET_CAPTURE) && !empty($m[0]) && isset($m[0][1])) {
            $numericId = substr($orderId, $m[0][1]);
        }
        return $numericId;
    }

    /**
     * Конструктор класса.
     */
    public function __construct(OTAPIlib $otapilib)
    {
        $this->otapilib = $otapilib;
    }

    public function CreateSalesOrder($sessionId, $deliveryModeId, $comment, $weight)
    {
        $order = $this->otapilib->CreateSalesOrder($sessionId, $deliveryModeId, $comment, $weight);
        $order['id'] = self::normalizeOrderId($order['id']);
        $order['Id'] = self::normalizeOrderId($order['Id']);

        return $order;
    }

    public function CreateOrder($sessionId, $xmlParams)
    {
        $order = $this->otapilib->CreateOrder($sessionId, $xmlParams);
        $order['id'] = self::normalizeOrderId($order['id']);
        $order['Id'] = self::normalizeOrderId($order['Id']);

        return $order;
    }

    public function RecreateSalesOrder($sessionId, $orderId, $weight)
    {
        $order = $this->otapilib->RecreateSalesOrder($sessionId, $orderId, $weight);
        $order['id'] = self::normalizeOrderId($order['id']);
        $order['Id'] = self::normalizeOrderId($order['Id']);

        return $order;
    }

    public function GetSalesOrderDetails($sessionId, $orderId)
    {
        $order = $this->otapilib->GetSalesOrderDetails($sessionId, $orderId);
        $normalizedOrderId = self::normalizeOrderId($order['SalesOrderInfo']['id']);
        $order['SalesOrderInfo']['id'] = $normalizedOrderId;
        $order['SalesOrderInfo']['Id'] = $normalizedOrderId;
        $order['salesorderinfo']['id'] = $normalizedOrderId;
        $order['salesorderinfo']['Id'] = $normalizedOrderId;

        return $order;
    }
}
