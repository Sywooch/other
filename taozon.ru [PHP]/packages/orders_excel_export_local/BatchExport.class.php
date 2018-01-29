<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dima
 * Date: 18.07.13
 * Time: 14:45
 * To change this template use File | Settings | File Templates.
 */

class BatchExport {
    private $aSheet;
    private $objWriter;

    public function __construct($pExcel, $objWriter){
        $pExcel->setActiveSheetIndex(0);
        $this->aSheet = $pExcel->getActiveSheet();
        $this->objWriter = $objWriter;
    }

    public static function saveOrder($path, $orderId){
        global $otapilib;
        $otapilib->setResultInXMLOn();
        $otapilib->setErrorsAsExceptionsOn();
        $orderId = OrdersProxy::originOrderId($orderId);
        $orderInfo = $otapilib->GetSalesOrderDetailsForOperator(Session::get('sid'), $orderId, '', 0);
        $otapilib->setResultInXMLOff();

        $orderInfo->asXML($path . $orderId . '.xml');
    }

    public function batchExport($orders, $path){
        $number = 0;
        foreach($orders as $order){
            $this->appendHead($number);
            $number++;

            foreach($order->Result->SalesLinesList->SalesLine as $line){
                $col = 'A';
                $configArray = $this->parseConfigRow((string)$line->ConfigText);

                $this->appendCellToRow($number+1, $order->Result->SalesOrderInfo->Id, $col++);
                $this->appendCellToRow($number+1, $order->Result->SalesOrderInfo->CustName, $col++);

                $address = $order->Result->SalesOrderInfo->DeliveryAddress;
                $this->appendCellToRow($number+1, $address->Country.'; '.$address->City.'; '.$address->Address
                    .'; '.$address->PostalCode.'; '.$address->RegionName.'; '.$address->Phone, $col++);

                $this->appendCellToRow($number+1, $order->Result->SalesOrderInfo->DeliveryModeName, $col++);
                $this->appendCellToRow($number+1, $line->ItemExternalURL, $col++);
                $this->appendCellToRow($number+1, (string)$this->getConfigValue($configArray, 'цвет'), $col++);
                $this->appendCellToRow($number+1, (string)$this->getConfigValue($configArray, 'размер'), $col++);
                $this->appendCellToRow($number+1, $line->Qty, $col++);
                $this->appendCellToRow($number+1, $line->TaoBaoPrice, $col++);
                $this->appendCellToRow($number+1, $line->TaoBaoDelivery, $col++);
                $this->appendCellToRow($number+1, (float)str_replace(',','.',$line->TaoBaoDelivery)*(float)$line->Qty+
                    (float)str_replace(',','.',$line->TaoBaoPrice), $col);
                $number++;
            }
        }

        $this->setColumnStyles($number);
        $this->saveExportFile($path . 'export.xls');
        return '../cache/export.xls';
    }

    private function appendHead($number){
        $col = 'A';
        $this->appendCellToRow($number+1, 'Order id', $col++);
        $this->appendCellToRow($number+1, 'Full name', $col++);
        $this->appendCellToRow($number+1, 'Address', $col++);
        $this->appendCellToRow($number+1, 'Shippment Method', $col++);
        $this->appendCellToRow($number+1, 'Item', $col++);
        $this->appendCellToRow($number+1, '颜色分类', $col++);
        $this->appendCellToRow($number+1, '尺码', $col++);
        $this->appendCellToRow($number+1, 'Qty', $col++);
        $this->appendCellToRow($number+1, 'Original price (yuan)', $col++);
        $this->appendCellToRow($number+1, 'China delivery (yuan)', $col++);
        $this->appendCellToRow($number+1, 'Total price (yuan)', $col++);
        $this->aSheet->getStyle("A".($number+1).":K".($number+1))->getFont()->setBold(true);
        $this->aSheet->getStyle("A".($number+1).":K".($number+1))->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'FFFF00')
                )
            )
        );
    }

    private function parseConfigRow($configText)
    {
        $config = array();
        foreach(explode(';', $configText) as $configCouple){
            if (! $configCouple || (false === strpos($configCouple, ':'))) {
                continue;
            }
            list($key, $value) = explode(':', $configCouple);
            $config[$key] = $value;
        }
        return $config;
    }

    private function getConfigValue($configArray, $key){
        $value = '';

        foreach( $configArray as $k=>$v ){
            if(preg_match('/'.$key.'/iu', $k)){
                $value = $v;
                break;
            }
        }

        return $value;
    }

    private function appendCellToRow($row, $val, $col = ''){
        $column = $col ? $col : $this->aSheet->getHighestColumn();

        if($this->aSheet->cellExists($column.$row))
            $column++;
        $this->aSheet->setCellValue($column.$row,$val);
    }

    private function setColumnStyles($number){
        $col = 'A';
        $this->aSheet->getColumnDimension($col++)->setWidth(20);
        $this->aSheet->getColumnDimension($col++)->setWidth(20);
        $this->aSheet->getColumnDimension($col++)->setWidth(20);
        $this->aSheet->getColumnDimension($col++)->setWidth(20);
        $this->aSheet->getColumnDimension($col++)->setWidth(20);
        $this->aSheet->getColumnDimension($col++)->setWidth(20);
        $this->aSheet->getColumnDimension($col++)->setWidth(20);
        $this->aSheet->getColumnDimension($col++)->setWidth(20);
        $this->aSheet->getColumnDimension($col++)->setWidth(20);
        $this->aSheet->getColumnDimension($col++)->setWidth(20);
        $this->aSheet->getColumnDimension($col++)->setWidth(20);
        $this->aSheet->getColumnDimension($col++)->setWidth(20);
        for($i=0; $i<$number+1; ++$i) {
            $this->aSheet->getRowDimension($i)->setRowHeight(20);
        }
    }

    private function saveExportFile($path){
        $this->objWriter->save( $path );
    }
}