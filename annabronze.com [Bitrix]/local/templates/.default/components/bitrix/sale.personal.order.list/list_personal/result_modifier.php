<?
use Bitrix\Main,
    Bitrix\Main\Config,
    Bitrix\Main\Localization,
    Bitrix\Main\Loader,
    Bitrix\Main\Data,
    Bitrix\Sale;


foreach ($arResult['ORDERS'] as $key => $order) {


    $ORDER_ID = $order["ORDER"]["ID"];

    foreach ($order['PAYMENT'] as $keyPayment => $payment) {
        $payment['BUFFERED_OUTPUT'] = '';
        $payment['ERROR'] = '';
        $payment["PAY_SYSTEM"] = \Bitrix\Sale\PaySystem\Manager::getById($payment["PAY_SYSTEM_ID"]);
        $service = new \Bitrix\Sale\PaySystem\Service($payment["PAY_SYSTEM"]);
        if ($service) {
            $payment["CAN_REPAY"] = "Y";
            if ($service->getField("NEW_WINDOW") == "Y") {
                $payment["PAY_SYSTEM"]["PSA_ACTION_FILE"] = htmlspecialcharsbx($this->arParams["PATH_TO_PAYMENT"]) . '?ORDER_ID=' . urlencode(urlencode($this->dbResult["ACCOUNT_NUMBER"])) . '&PAYMENT_ID=' . $payment['ID'];
            } else {
                $handlerFolder = \Bitrix\Sale\PaySystem\Manager::getPathToHandlerFolder($service->getField('ACTION_FILE'));
                $pathToAction = \Bitrix\Main\Application::getDocumentRoot() . $handlerFolder;
                $pathToAction = str_replace("\\", "/", $pathToAction);
                while (substr($pathToAction, strlen($pathToAction) - 1, 1) == "/") {
                    $pathToAction = substr($pathToAction, 0, strlen($pathToAction) - 1);
                }
                if (file_exists($pathToAction)) {
                    if (is_dir($pathToAction) && file_exists($pathToAction . "/payment.php")) {
                        $pathToAction .= "/payment.php";
                    }
                    $payment["PAY_SYSTEM"]["PSA_ACTION_FILE"] = $pathToAction;
                }

                $orderObj = \Bitrix\Sale\Order::load($ORDER_ID);
                $paymentCollection = $orderObj->getPaymentCollection();

                //$paymentCollection = $this->order->getPaymentCollection();

                if ($paymentCollection) {


                    $listPayments = \Bitrix\Sale\Payment::getList(array(
                        'select' => array('ID'),
                        'filter' => array('ORDER_ID' => $ORDER_ID, 'PAY_SYSTEM_ID' => $payment["PAY_SYSTEM_ID"])
                    ));

                    while ($paymentTmp = $listPayments->fetch())
                    {
                        $PAYMENT_ID = $paymentTmp["ID"];
                    }


                    //$paymentItem = $paymentCollection->getItemById($payment['ID']);
                    $paymentItem = $paymentCollection->getItemById($PAYMENT_ID);////


                    if ($paymentItem) {

                        $initResult = $service->initiatePay($paymentItem, null, Sale\PaySystem\BaseServiceHandler::STRING);
                        if ($initResult->isSuccess()) {
                            $payment['BUFFERED_OUTPUT'] = $initResult->getTemplate();
                            $arResult['ORDERS'][$key]['PAYMENT'][$keyPayment]['BUFFERED_OUTPUT'] = $payment['BUFFERED_OUTPUT'];

                        } else {
                            $payment['ERROR'] = implode('\n', $initResult->getErrorMessages());
                        }
                    }
                }
            }

            $payment["PAY_SYSTEM"]["PSA_NEW_WINDOW"] = $payment["PAY_SYSTEM"]["NEW_WINDOW"];
        }

    }
}


if(LANGUAGE_ID==='en'){
    $arResult['INFO']['STATUS']["F"]["NAME"] = "Completed";
    $arResult['INFO']['STATUS']["N"]["NAME"] = "Placed, non paid";
    $arResult['INFO']['STATUS']["P"]["NAME"] = "Paid";
}



?>