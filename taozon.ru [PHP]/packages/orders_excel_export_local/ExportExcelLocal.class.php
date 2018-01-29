<?php
class ExportExcelLocal
{
    private $aSheet;
    private $objWriter;

    public function __construct($pExcel, $objWriter){
        $pExcel->setActiveSheetIndex(0);
        $this->aSheet = $pExcel->getActiveSheet();
        $this->objWriter = $objWriter;
    }

    public function exportOrder($orderInfo, $saveToFile = false){
        $this->aSheet->setTitle(Lang::get('item_list'));

        $lang = @$_SESSION['active_lang_admin'] ? @$_SESSION['active_lang_admin'] : 'ru';

        $this->setColumnStyles();

        //

        $address = $orderInfo['SalesOrderInfo']['DeliveryAddress'];

        foreach($orderInfo['SalesLinesList'] as $number => $line){
            $col = 'A';
            $configArray = $this->parseConfigRow($line['ConfigText']);
            $configArrayEx = $this->parseConfigRow($line['ConfigExternalTextOrig']);

            $this->appendCellToRow($number+1, $address['Familyname'].' '.$address['Name'].' '.$address['Patername'], $col++);
            $this->appendCellToRow($number+1, $address['Country'].', '.$address['RegionName'].', '.$address['City']
                .', '.$address['PostalCode'].', '.$address['Address'].', '.$address['Phone'], $col++);
            $this->appendCellToRow($number+1, $orderInfo['SalesOrderInfo']['Id'], $col++);

            $this->appendCellToRow($number+1, $line['ItemExternalURL'], $col++);
            $this->aSheet->getCell('D'.($number+1))->getHyperlink()->setUrl($line['ItemExternalURL']);

            $this->appendCellToRow($number+1, (string)$this->getConfigValue($configArray, 'цвет'), $col++);
            $this->appendCellToRow($number+1, (string)$this->getConfigValue($configArray, 'размер'), $col++);


            //$this->appendCellToRow($number+2, (string)$this->getConfigValue($configArrayEx, '颜色分类'), $col++); //Цвет
            //$this->appendCellToRow($number+2, (string)$this->getConfigValue($configArrayEx, '尺码'), $col++); //Размер
            //По старому не работает ибо Цвет и размер -  у китайцев по разному пишется в разных товарах.
            //Только перебор $configArrayEx - 1 : цвет, 2 : размер
            $foundConf = 0;
            foreach($configArrayEx as $configCouple => $valueEx){
                if(!$configCouple) continue;
                if($foundConf++ > 1) break;
                $this->appendCellToRow($number+1, $valueEx , $col++);
            }
            for($i = 0; $i < 2-$foundConf; $i++){
                $this->appendCellToRow($number+1, '' , $col++);
            }

            $this->appendCellToRow($number+1, $line['ItemImageURL'], $col++);
            $this->aSheet->getCell('G'.($number+1))->getHyperlink()->setUrl($line['ItemImageURL']);
            $this->appendCellToRow($number+1, $line['Qty'], $col++);
			$this->appendCellToRow($number+1, (string)$line['TaoBaoPriceWithDiscount'], $col++); //Цена без скидки
            $this->appendCellToRow($number+1, (string)$line['TaoBaoPrice'], $col++); //Цена
            $this->appendCellToRow($number+1, (string)$line['TaoBaoDelivery'], $col++); //Доставка
            $this->appendCellToRow($number+1, (string)$line['TaoBaoPrice']*(float)$line['Qty']
                + (string)$line['TaoBaoDelivery'], $col++); //Итого (юани)

            $this->aSheet->getRowDimension($number+1)->setRowHeight(20);
        }

        $this->saveExportFile($orderInfo['SalesOrderInfo']['Id'], $saveToFile);
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

    private function setColumnStyles(){
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
    }

    private function saveExportFile($orderNumber, $saveToFile = false){
        if(!$saveToFile){
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="№'.$orderNumber.'.xls"');
            header('Cache-Control: max-age=0');
        }
        $this->objWriter->save( $saveToFile ? $saveToFile : 'php://output');
    }

    public function batchExport($orders){
        $number = 0;
        foreach($orders as $order){
            $col = 0;
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
            $number++;
        }
    }
}
