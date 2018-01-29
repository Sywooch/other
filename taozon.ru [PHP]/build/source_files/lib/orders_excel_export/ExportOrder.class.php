<?php
class ExportOrder
{
    private static function checkAuth(){
        if(!Login::auth()){
            header('Location: /admin/index.php?expired');
            die();
        }
    }

    public static function onRenderAdminOrdersList(){
        return '<script type="text/javascript" src="../lib/orders_excel_export/js/onRenderAdminOrdersList.js"></script>';
    }

    public static function onExportOrder($orderId){
        global $otapilib;
        self::checkAuth();

        $sid = $_SESSION['sid'];
        $orderInfo = $otapilib->GetSalesOrderDetailsForOperator($sid, $orderId, '', 0);

        require_once CFG_APP_ROOT . '/lib/PhpExcel/PHPExcel.php';
        $pExcel = new PHPExcel();

        require_once CFG_APP_ROOT . '/lib/PhpExcel/PHPExcel/Writer/Excel5.php';
        $objWriter = new PHPExcel_Writer_Excel5($pExcel);

        require_once CFG_APP_ROOT . '/lib/PhpExcel/PHPExcel/Style/Color.php';

        require_once ORDER_EXPORT_PACKAGE_PATH . 'ExportExcel.class.php';
        $E = new ExportExcel($pExcel, $objWriter);
        $E->exportOrder($orderInfo);
    }
}
