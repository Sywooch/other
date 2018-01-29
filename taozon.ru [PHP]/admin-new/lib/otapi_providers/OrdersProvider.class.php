<?php

OTBase::import('system.lib.Cache');
OTBase::import('system.lib.cache.Key');
OTBase::import('system.lib.cache.adapter.*');
OTBase::import('system.lib.service.OrderRecord');
OTBase::import('system.lib.service.OrderItemRecord');
OTBase::import('system.lib.service.PackageRecord');
OTBase::import('system.lib.service.ServiceRecord');
OTBase::import('system.lib.helpers.ProductsHelper');
OTBase::import('system.lib.otapi_providers.UserData');
OTBase::import('system.admin-new.lib.otapi_providers.UsersProvider');

class OrdersProvider
{
    /**
     * @var OTAPIlib
     */
    private $otapilib;

    private $registry;

    protected $activeStatuses = array(20=>20, 30=>30, 31=>31, 32=>32, 36=>36, 37=>37, 38=>38, 39=>39);

    /**
     * Статусы закупленных товаров. queryType = 2 при запросе GetSalesOrderDetailsForOperator
    **/
    protected $purchasedItemsStatuses = array(6, 7, 8, 9, 10);

    /**
     * Статусы готовых к закупу товаров. queryType = 1 при запросе GetSalesOrderDetailsForOperator
    **/
    protected $readyToBePurchasedItemsStatuses = array(2, 3);

    public function __construct($otapilib)
    {
        $this->otapilib = $otapilib;
        $this->ordersProxy = new OrdersProxy($this->otapilib);
    }

    public function SearchOrders($sessionId, $xml, $framePosition = 0, $frameSize = 18, $predefinedData = "")
    {
        $cacheKey = substr(md5(implode('/', array(__METHOD__, $xml, $framePosition, $frameSize))), 0, 10);
        if (! empty($this->registry[$cacheKey])) {
            return $this->registry[$cacheKey];
        }
        $result = $this->otapilib->SearchOrders($sessionId, $xml, $framePosition, $frameSize, $predefinedData);
        if (! empty($result)) {
            $orders = array();
            foreach ($result['Content'] as $order) {
                $order['normalizedId'] = OrdersProxy::normalizeOrderId($order['id']);
                $orders[$order['id']] = new OrderRecord($order);
            }
            $result['Content'] = $orders;
            $this->registry[$cacheKey] = $result;
        }

        return $result;
    }

    public function SearchOrderLines($sessionId, $xml, $framePosition = 0, $frameSize = 18, $predefinedData = "", $pageUrl = null)
    {
        $cacheKey = substr(md5(implode('/', array(__METHOD__, $xml, $framePosition, $frameSize))), 0, 10);
        if (! empty($this->registry[$cacheKey])) {
            return $this->registry[$cacheKey];
        }
        $result = $this->otapilib->SearchOrderLines($sessionId, $xml, $framePosition, $frameSize, $predefinedData);
        if (! empty($result)) {
            $items = array();
            foreach ($result['Content'] as $item) {
                $item['vendUrl'] = UrlGenerator::generateVendorUrl($item['vendnick']);
                $item['itemUrl'] = UrlGenerator::generateItemUrl($item['itemid']);
                $item['imageThumb'] = ProductsHelper::getImage($item, 100);
                $item['imageBig'] = ProductsHelper::getImage($item);
                $item['orderNumericId'] = OrdersProxy::getOrderNumericId($item['orderid']);
                if ($pageUrl && ProductsHelper::isWarehouseProduct($item)) {
                    $item['ItemExternalURL'] = $pageUrl->getWarehouseProductUrl($item);
                }
                $items[$item['id']] = new OrderItemRecord($item);
            }
            $result['Content'] = $items;
            $this->registry[$cacheKey] = $result;
        }

        return $result;
    }

    public function CancelSalesOrderForOperator($sessionId, $orderId)
    {
        $this->otapilib->CancelSalesOrderForOperator($sessionId, $orderId);

        $this->clearAccountInfoCacheByOrderId($sessionId, $orderId);
    }

    public function CancelLineSalesOrderForOperator($sessionId, $orderId, $itemId)
    {
        $this->otapilib->CancelLineSalesOrderForOperator ($sessionId, $orderId, $itemId);

        $this->clearAccountInfoCacheByOrderId($sessionId, $orderId);
    }

    public function SalesPaymentReserve($sessionId, $orderId, $amount)
    {
        $this->otapilib->SalesPaymentReserve($sessionId, $orderId, $amount);

        $this->clearAccountInfoCacheByOrderId($sessionId, $orderId);
    }

    public function GetSalesOrderDetailsForOperator($sessionId, $orderId, $filter, $queryType)
    {
        $orderInfo = $this->otapilib->GetSalesOrderDetailsForOperator($sessionId, $orderId, $filter, $queryType);
        if (empty($orderInfo)) {
            throw new ServiceException(__METHOD__, '', 'Could not find order #' . $orderId, 1);
        }
        return $orderInfo;
    }

    public function GetOrderStatusList($sessionId, $predefinedData = "")
    {
        $cacher = new Cache('GetOrderStatusList' . Session::getActiveAdminLang());
        if (! $cacher->has()) {
            $result = new ServiceRecord($this->otapilib->GetOrderStatusList($sessionId, $predefinedData));
            if (! $result->isEmpty()) {
                $cacher->set($result);
            }
        }
        return $cacher->get();
    }

    public function getItemsStatusList($sessionId, $predefinedData = "")
    {
        $cacher = new Cache('GetOrderLineStatusList' . Session::getActiveAdminLang());
        if (! $cacher->has()) {
            $result = new ServiceRecord($this->otapilib->GetOrderLineStatusList($sessionId, $predefinedData));
            if (! $result->isEmpty()) {
                $cacher->set($result);
            }
        }
        return $cacher->get();
    }

    public function getOrderInfo($sessionId, $orderId, $filter = '', $queryType = 0)
    {
        $cacheKey = implode('/', array(__METHOD__, $orderId));
        if (! empty($this->registry[$cacheKey])) {
            return $this->registry[$cacheKey];
        }
        $result = array();
        $raw = $this->GetSalesOrderDetailsForOperator($sessionId, $orderId, $filter, $queryType);
        if (! empty($raw)) {
            $items = array();
            foreach ($raw['saleslineslist'] as $item) {
                $item['orderId'] = $orderId;
                $item['vendUrl'] = UrlGenerator::generateVendorUrl($item['vendnick']);
                $item['itemUrl'] = UrlGenerator::generateItemUrl($item['itemid']);
                $item['imageThumb'] = ProductsHelper::getImage($item, 100);
                $item['imageBig'] = ProductsHelper::getImage($item);
                $item['orderNumericId'] = OrdersProxy::getOrderNumericId($orderId);
                $items[] = new OrderItemRecord($item);
            }
            $result = new OrderRecord($raw['salesorderinfo']);
            $result['items'] = $items;
            if (! $result->isEmpty()) {
                $this->registry[$cacheKey] = $result;
            }
            unset($raw, $items);
        }
        return $result;
    }

    public function getOrderPackages($sessionId, $orderId, array $orderItems = array())
    {
        $cacheKey = implode('/', array(__METHOD__, $orderId));
        if (! empty($this->registry[$cacheKey])) {
            return $this->registry[$cacheKey];
        }
        $packages = array();

        if (! RightsManager::hasRight(RightsManager::RIGHT_VIEWPACKAGE)) {
            return  $packages;
        }
        $raw = $this->otapilib->GetSalesPackageList($sessionId, $orderId);
        if (! empty($raw)) {
            foreach ($raw as $package) {
                $items = array();
                foreach ($package['Items'] as $key => $item) {
                    $itemInfo = array_filter(
                        $orderItems,
                        create_function('$a', 'return $a["id"] == ' . $item['OrderLineId'] . ';')
                    );
                    if (! empty($itemInfo)) {
                        $itemInfo = array_shift($itemInfo);
                        $item['BriefDescrTrans'] = $itemInfo['BriefDescrTrans'];
                        $item['LineNum'] = $itemInfo['LineNum'];
                        $item['orderId'] = $orderId;
                    }
                    $items[] = new OrderItemRecord($item);
                }
                unset($package['Items']);
                $package = new PackageRecord($package);
                $package['items'] = $items;
                $packages[] = $package;
            }
            $this->registry[$cacheKey] = $packages;
            unset($raw, $items, $orderItems);
        }
        return $packages;
    }

    public function getReadyToPurchaseOrderItems($sessionId, $orderId, $orderItems = array())
    {
        $cacheKey = implode('/', array(__METHOD__, $orderId));
        if (empty($this->registry[$cacheKey])) {
            if (empty($orderItems)) {
                $order = $this->getOrderInfo($sessionId, $orderId);
                $orderItems = $order->items;
            }
            foreach ($orderItems as $key => $item) {
                if (! in_array($item->statusCode, $this->readyToBePurchasedItemsStatuses)) {
                    unset($orderItems[$key]);
                }
            }
            $this->registry[$cacheKey] = $orderItems;
        }
        return $this->registry[$cacheKey];
    }

    public function getPurchasedOrderItems($sessionId, $orderId, $orderItems = array())
    {
        $cacheKey = implode('/', array(__METHOD__, $orderId));
        if (empty($this->registry[$cacheKey])) {
            if (empty($orderItems)) {
                $order = $this->getOrderInfo($sessionId, $orderId);
                $orderItems = $order->items;
            }
            foreach ($orderItems as $key => $item) {
                if (! in_array($item->statusCode, $this->purchasedItemsStatuses)) {
                    unset($orderItems[$key]);
                }
            }
            $this->registry[$cacheKey] = $orderItems;
        }
        return $this->registry[$cacheKey];
    }

    public function getOrdersByUserId($sessionId, $userId, $excludeOrder = null, $activeOnly = true, $offset = 0, $limit = 100, $returnWithCount = false)
    {
        $cacheKey = implode('/', array(__METHOD__, $userId, (int)$excludeOrder, (int)$activeOnly, $offset, $limit, $returnWithCount));
        if (! empty($this->registry[$cacheKey])) {
            return $this->registry[$cacheKey];
        }

        $xml = '<OrderSearchParameters><UserIdDelimitedList>' . (int)$userId . '</UserIdDelimitedList></OrderSearchParameters>';

        $result = array();
        $orders = $this->SearchOrders($sessionId, $xml, $offset, $limit);
        if (isset($orders['Content'])) {
            foreach ($orders['Content'] as $key => $order) {
                if ($activeOnly && !isset($this->activeStatuses[$order->statusCode])) {
                    unset($orders['Content'][$key]);
                    continue;
                }
                if ($excludeOrder && $order->id == $excludeOrder) {
                    unset($orders['Content'][$key]);
                    continue;
                }
            }
            $result = $returnWithCount ? $orders : $orders['Content'];
            $this->registry[$cacheKey] = $result;
        }
        return $result;
    }

    public function purchaseOrderItems($sessionId, $orderId, array $items)
    {
        $cacheKey = implode('/', array(__METHOD__, $orderId));
        if (! empty($this->registry[$cacheKey])) {
            return $this->registry[$cacheKey];
        }

        $xml = '<SalesLinePurchInfoList>';
        foreach ($items as $item) {
            $xml .= '<SalesLinePurchInfo>';
            $xml .= '<SalesId>' . $orderId . '</SalesId>';
            $xml .= '<SalesLineId>' . $item['id'] . '</SalesLineId>';
            $xml .= '<OperatorComment>' . $item['operatorcomment'] . '</OperatorComment>';
            $xml .= '<PurchPrice>' . (float)$item['pricecust'] . '</PurchPrice>';
            $xml .= '<PurchDelivery>' . (float)$item['pricecust'] . '</PurchDelivery>';
            $xml .= '<PurchQty>' . (int)$item['qty'] . '</PurchQty>';
            $xml .= '<VendPurchId>' . $item['vendid'] . '</VendPurchId>';
            $xml .= '<PurchaseStatus>1</PurchaseStatus>';
            $xml .= '</SalesLinePurchInfo> ';
        }
        $xml .= '</SalesLinePurchInfoList>';

        $this->registry[$cacheKey] = $this->otapilib->PurchaseItems($sessionId, $xml);

        return $this->registry[$cacheKey];
    }

    public function changeOrderItemsStatus($sessionId, $orderId, $itemId, $status)
    {
        $xml = '<OrderLineUpdateData><StatusId>'.$status.'</StatusId></OrderLineUpdateData>';
        return $this->otapilib->UpdateOrderLinesForOperator($sessionId, $orderId, implode(';', $itemId), $xml);
    }

    public function changeOrderItemPrice($sessionId, $orderId, $itemId, $itemNewPrice)
    {
        $xml = '<OrderLineUpdateData><InternalPrice>' . $itemNewPrice .
                    '</InternalPrice><StatusId>3</StatusId></OrderLineUpdateData>';
        return $this->otapilib->UpdateOrderLineForOperator($sessionId, $orderId, $itemId, $xml);
    }

    public function changeOrderItemConfig($sessionId, $orderId, $itemId, $configId)
    {
        $xml = '<OrderLineUpdateData><ConfigExternalId>' . $configId .
                    '</ConfigExternalId><StatusId>3</StatusId></OrderLineUpdateData>';
        return $this->otapilib->UpdateOrderLineForOperator($sessionId, $orderId, $itemId, $xml);
    }

    public function splitOrderItemQuantity($sessionId, $orderId, $itemId, $splitQuantity)
    {
        $xml = '<OrderLineSplitData><SeparatedItemsCount>' . $splitQuantity .
                   '</SeparatedItemsCount></OrderLineSplitData>';
        return $this->otapilib->SplitOrderLineForOperator($sessionId, $orderId, $itemId, $xml);
    }

    public function generateSearchParams($filters, $sort, $uids = '')
    {
        $xml = new SimpleXMLElement('<OrderSearchParameters></OrderSearchParameters>');

        if (! empty($filters['fromdate'])) {
            $xml->addChild('CreationDateFrom', $this->prepareDateForFilter($filters['fromdate']));
        }
        if (! empty($filters['todate'])) {
            $xml->addChild('CreationDateTo', $this->prepareDateForFilter($filters['todate'], true));
        }
        if (! empty($filters['orders_status'])) {
            $xml->addChild('StatusIdList');
            foreach ($filters['orders_status'] as $id => $item) {
                $xml->StatusIdList->addChild('Id', $id);
            }
        }
        if (! empty($filters['number'])) {
            $xml->addChild('Id', $filters['number']);
        }
        if (! empty($filters['client_surname'])) {
            $xml->addChild('RecipientLastName', htmlspecialchars($filters['client_surname']));
        }
        if ($uids) {
            $xml->addChild('UserIdDelimitedList', $uids);
        }
        if (! empty($filters['OrderIds'])) {
            $xml->addChild('OrderIds');
            foreach ($filters['OrderIds'] as $OrderId) {
                $xml->OrderIds->addChild('OrderId', $OrderId);
            }
        }

        $orderBy = array();
        foreach ($sort as $sortName => $sortVal) {
            $orderBy[] = $sortName . ':' . $sortVal;
        }
        $xml->addChild('OrderBy', implode(';', $orderBy));

        return trim(str_replace('<?xml version="1.0"?>', '', $xml->asXML()));
    }

    public function generateItemsSearchParams($filters, $sort, $uids = '')
    {
        $xmlOrders = new DOMDocument();
        $xmlOrders->loadXML($this->generateSearchParams($filters, $sort, $uids));
        $ordersNode = $xmlOrders->getElementsByTagName("OrderSearchParameters")->item(0);

        $xmlItems = new DOMDocument();
        $root = $xmlItems->createElement('OrderLineSearchParameters');
        $ordersNode = $xmlItems->importNode($ordersNode, true);
        $root->appendChild($ordersNode);

        if (! empty($filters['items_status'])) {
            $StatusIdList = $xmlItems->createElement('StatusIdList');
            foreach ($filters['items_status'] as $id => $item) {
                $StatusIdList->appendChild($xmlItems->createElement('Id', $id));
            }
            $root->appendChild($StatusIdList);
        }

        $xmlItems->appendChild($root);

        return trim(str_replace('<?xml version="1.0"?>', '', $xmlItems->saveXML()));
    }

    public function createPackage($sessionId, $orderId, $itemsIds = array())
    {
        if (! empty($itemsIds)) {
            $xml = new SimpleXMLElement('<PackageCreateData><OrderId>' . $orderId . '</OrderId><OrderLineIds></OrderLineIds></PackageCreateData>');

            foreach ($itemsIds as $itemId) {
                $xml->OrderLineIds->addChild('Id', $itemId);
            }

            $result = $this->otapilib->CreatePackageForOperator($sessionId, $xml->asXML());
        } else {
            $result = $this->otapilib->CreatePackage($sessionId, $orderId);
        }

        return is_array($result) && isset($result['id']) ? (int)$result['id'] : (int)$result;
    }

    public function moveItemsToPackage($sessionId, $itemsIds, $toPackageId)
    {
        $xml = new SimpleXMLElement('<PackageAdminUpdateInfo><OrderLineIds></OrderLineIds></PackageAdminUpdateInfo>');

        foreach ($itemsIds as $itemId) {
            $xml->OrderLineIds->addChild('Id', $itemId);
        }

        $xml = str_replace('<?xml version="1.0"?>', '', $xml->asXML());

        $result = $this->otapilib->UpdatePackage($sessionId, $toPackageId, $xml);

        return $result;
    }

    public function updatePackage($sessionId, $packageId, $request)
    {
        $xml = $this->generatePackageFields($request);

        $result = $this->otapilib->UpdatePackage($sessionId, $packageId, $xml);

        // TODO: Почему статус посылки меняется отдельным вызовом? - не реализовано в otapi.
        $packageStatus = $request->getValue('packageStatus');
        $currentPackageStatus = $request->getValue('currentPackageStatus');
        if ($request->valueExists('packageStatus') && ($packageStatus != $currentPackageStatus)) {
            $this->otapilib->ChangePackageStatus($sessionId, $packageId, $packageStatus, date('d.m.Y'), '');
        }

        return $result;
    }

    public function GetSalesPaymentInfo($sessionId, $orderId)
    {
        return new ServiceRecord($this->otapilib->GetSalesPaymentInfo($sid, $orderId));
    }

    private function clearAccountInfoCacheByOrderId($sessionId, $orderId)
    {
        $orderInfo = $this->GetSalesOrderDetailsForOperator($sessionId, $orderId, '', 1);

        // del cache AccountInfo for user
        $userData = new UserData();
        $userData->ClearAccountInfoCache();
        $userData->ClearAccountInfoCacheById($orderInfo['SalesOrderInfo']['CustId']);
    }

    private function prepareDateForFilter($date, $last = false)
    {
        if ($last) {
            return date("Y-m-d\T23:59:59", strtotime($date));
        } else {
            return date("Y-m-d\T00:00:00", strtotime($date));
        }
    }

    private function generatePackageFields($request)
    {
        $xmlParams = new SimpleXMLElement('<PackageAdminUpdateInfo></PackageAdminUpdateInfo>');
        if ($request->getValue('DeliveryTrackingNum')) {
            $xmlParams->addChild('DeliveryTrackingNum', htmlspecialchars($request->getValue('DeliveryTrackingNum')));
        }
        if ($request->getValue('Weight')) {
            $xmlParams->addChild('Weight', str_replace(',', '.', $request->getValue('Weight')));
        }
        if ($request->getValue('ManualPrice')) {
            $xmlParams->addChild('ManualPrice', 1);
        }
        if ($request->getValue('PriceInternal')) {
            $xmlParams->addChild('PriceInternal', (float)$request->getValue('PriceInternal'));
        }
        if ($request->getValue('DeliveryModeId')) {
            $xmlParams->addChild('DeliveryModeId', $request->getValue('DeliveryModeId'));
        }
        if ($request->getValue('DeliveryContactLastname')) {
            $xmlParams->addChild('DeliveryContactLastname', $request->getValue('DeliveryContactLastname'));
        }
        if ($request->getValue('DeliveryContactFirstname')) {
            $xmlParams->addChild('DeliveryContactFirstname', $request->getValue('DeliveryContactFirstname'));
        }
        if ($request->getValue('DeliveryContactMiddlename')) {
            $xmlParams->addChild('DeliveryContactMiddlename', $request->getValue('DeliveryContactMiddlename'));
        }
        if ($request->getValue('DeliveryContactPhone')) {
            $xmlParams->addChild('DeliveryContactPhone', htmlspecialchars($request->getValue('DeliveryContactPhone')));
        }
        if ($request->getValue('DeliveryCountry')) {
            $xmlParams->addChild('DeliveryCountry', htmlspecialchars($request->getValue('DeliveryCountry')));
        }
        if ($request->getValue('DeliveryCountryCode')) {
            $xmlParams->addChild('DeliveryCountryCode', htmlspecialchars($request->getValue('DeliveryCountryCode')));
        }
        if ($request->getValue('DeliveryPostalCode')) {
            $xmlParams->addChild('DeliveryPostalCode', htmlspecialchars($request->getValue('DeliveryPostalCode')));
        }
        if ($request->getValue('DeliveryRegionName')) {
            $xmlParams->addChild('DeliveryRegionName', $request->getValue('DeliveryRegionName'));
        }
        if ($request->getValue('DeliveryCity')) {
            $xmlParams->addChild('DeliveryCity', $request->getValue('DeliveryCity'));
        }
        if ($request->getValue('DeliveryAddress')) {
            $xmlParams->addChild('DeliveryAddress', $request->getValue('DeliveryAddress'));
        }
        if ($request->getValue('AdditionalInfo')) {
            $xmlParams->addChild('AdditionalInfo', $request->getValue('AdditionalInfo'));
        }

        $domdict = dom_import_simplexml($xmlParams);

        if ($request->getValue('packageSize')) {
            $size = $request->getValue('packageSize');
            $xml = new SimpleXMLElement('<Size></Size>');
            $xml->addChild('Length', (float)$size['Length']);
            $xml->addChild('Height', (float)$size['Height']);
            $xml->addChild('Width',  (float)$size['Width']);

            $domcat = dom_import_simplexml($xml);
            $domcat = $domdict->ownerDocument->importNode($domcat, true);
            $domdict->appendChild($domcat);
        }

        if ($request->getValue('packageItems')) {
            $xml = new SimpleXMLElement('<OrderLineIds></OrderLineIds>');
            foreach ($request->getValue('packageItems') as $key => $value) {
                $xml->addChild('Id',  $key);
            }
            $domcat = dom_import_simplexml($xml);
            $domcat = $domdict->ownerDocument->importNode($domcat, true);
            $domdict->appendChild($domcat);
        }

        if (CMS::IsFeatureEnabled('PassportData')) {
            if ($request->getValue('DeliveryContactPassportNumber')) {
                $xmlParams->addChild(
                    'DeliveryContactPassportNumber',
                    $request->getValue('DeliveryContactPassportNumber')
                );
            }
            if ($request->getValue('DeliveryContactRegistrationAddress')) {
                $xmlParams->addChild(
                    'DeliveryContactRegistrationAddress',
                    $request->getValue('DeliveryContactRegistrationAddress')
                );
            }
        }

        return str_replace('<?xml version="1.0"?>', '', $xmlParams->asXML());
    }

    public function MergeOrders($sessionId, $targetOrderId, $mergedOrderId, $predefinedData = ""){
        $result = $this->otapilib->MergeOrders($sessionId, $targetOrderId, $mergedOrderId, $predefinedData);
        if (!$result){
            $error = $this->otapilib->error_message;
            if (strpos($err, 'different')!== false)
            {
                $error = LangAdmin::get('merge_error_different');
            }
            if (strpos($err, 'not allows')!== false)
            {
                $error = LangAdmin::get('merge_error_not_allows');
            }
            if (strpos($err, 'itself')!== false)
            {
                $error = LangAdmin::get('merge_error_same');
            }
            if (strpos($err, 'not found')!== false)
            {
                $error = LangAdmin::get('merge_error_wrong_order');
            }
            return $error;
        }
        return 'ok';
    }

    public function GetPackageAvailableStatusList($sessionId, $packageId)
    {
        $cacher = new Cache('GetPackageAvailableStatusList' . Session::getActiveAdminLang());
        if (! $cacher->has()) {
            $result = new ServiceRecord($this->otapilib->GetPackageAvailableStatusList($sessionId, $packageId));
            if (! $result->isEmpty()) {
                $cacher->set($result);
            }
        }
        return $cacher->get();
    }

    public function getPackageAvailableStatusTranslation($sessionId, $packageId)
    {
        $packageStatuses = $this->GetPackageAvailableStatusList($sessionId, $packageId);

        foreach ($packageStatuses as $status) {
            if ($status['id'] == $packageId) {
                return $status['name'];
            }
        }
        return null;
    }
}