<?php
class ExportOrderLocal
{
    private static function checkAuth(){
        if(!Login::auth()){
            header('Location: /admin/index.php?expired');
            die();
        }
    }

    public static function onRenderAdminOrdersList(){
        return '<script type="text/javascript" src="../packages/orders_excel_export_local/js/onRenderAdminOrdersList.js"></script>';
    }

    public static function onExportOrder($orderId){
        global $otapilib;
        self::checkAuth();

        $sid = $_SESSION['sid'];
        $orderInfo = $otapilib->GetSalesOrderDetailsForOperator($sid, $orderId, '', 0);

        if (!General::getSiteConfig('export_canceled_items'))
            $orderInfo = Plugins::invokeEvent('ExportOrderCut', array('mass' => $orderInfo));


        require_once CFG_APP_ROOT . '/lib/PhpExcel/PHPExcel.php';
        $pExcel = new PHPExcel();

        require_once CFG_APP_ROOT . '/lib/PhpExcel/PHPExcel/Writer/Excel5.php';
        $objWriter = new PHPExcel_Writer_Excel5($pExcel);

        require_once CFG_APP_ROOT . '/lib/PhpExcel/PHPExcel/Style/Color.php';

        require_once ORDER_EXPORT_PACKAGE_PATH . 'ExportExcelLocal.class.php';
        $E = new ExportExcelLocal($pExcel, $objWriter);
        $E->exportOrder($orderInfo);
    }

    public static function onBatchExportOrders($orders){
        $ordersData = array();
        foreach($orders as $orderId){
            if(!file_exists(CACHE_PATH . $orderId . '.xml')) continue;
            $ordersData[] = simplexml_load_file(CACHE_PATH . $orderId . '.xml');
        }

        require_once CFG_APP_ROOT . '/lib/PhpExcel/PHPExcel.php';
        $pExcel = new PHPExcel();

        require_once CFG_APP_ROOT . '/lib/PhpExcel/PHPExcel/Writer/Excel5.php';
        $objWriter = new PHPExcel_Writer_Excel5($pExcel);

        require_once CFG_APP_ROOT . '/lib/PhpExcel/PHPExcel/Style/Color.php';

        require_once ORDER_EXPORT_PACKAGE_PATH . 'BatchExport.class.php';
        $E = new BatchExport($pExcel, $objWriter);
        return $E->batchExport($ordersData, CACHE_PATH);
    }
}
