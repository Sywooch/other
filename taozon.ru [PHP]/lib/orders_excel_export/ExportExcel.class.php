<?php
class ExportExcel
{
    private $aSheet;
    private $objWriter;
    private $validImages = array('jpg', 'png', 'gif', 'bmp', 'jpeg');

    public function __construct($pExcel, $objWriter)
    {
        $pExcel->setActiveSheetIndex(0);
        $this->aSheet = $pExcel->getActiveSheet();
        $this->objWriter = $objWriter;
    }

    public function exportOrder($orderInfo, $saveToFile = false)
    {
        $this->aSheet->setTitle(Lang::get('item_list'));

        $lang = @$_SESSION['active_lang_admin'] ? @$_SESSION['active_lang_admin'] : 'ru';
        $config = simplexml_load_file(ORDER_EXPORT_PACKAGE_PATH.'config/export_'. $lang .'.xml');
        foreach ($config->header->column as $v) {
            $this->appendCellToRow(1, (string)$v);
        }

        $this->setColumnStyles();

        //

        $address = $orderInfo['SalesOrderInfo']['DeliveryAddress'];        
        foreach ($orderInfo['SalesLinesList'] as $number => $line) {
            $col = 'A';
            $configArray = $this->parseConfigRow($line['ConfigText']);
            $configArrayEx = $this->parseConfigRow($line['ConfigExternalTextOrig']);

            $this->appendCellToRow($number+2, $line['linenum'], $col++);
            $this->appendCellToRow($number+2, $address['Familyname'].' '.$address['Name'].' '.$address['Patername'], $col++);
            $this->appendCellToRow($number+2, $address['Country'].', '.$address['RegionName'].', '.$address['City']
                .', '.$address['PostalCode'].', '.$address['Address'].', '.$address['Phone'], $col++);
            $this->appendCellToRow($number+2, OrdersProxy::normalizeOrderId($orderInfo['SalesOrderInfo']['Id']), $col++);

            $url = ProductsHelper::isWarehouseProduct($line) ? ProductsHelper::getWarehouseProductUrl($line)  : $line['ItemExternalURL']; 
            $this->appendCellToRow($number+2, $url, $col++);
            $this->aSheet->getCell('E'.($number+2))->getHyperlink()->setUrl($url);

            $this->appendCellToRow($number+2, (string)$this->getConfigValue($configArray, 'цвет'), $col++);
            $this->appendCellToRow($number+2, (string)$this->getConfigValue($configArray, 'размер'), $col++);


            //$this->appendCellToRow($number+2, (string)$this->getConfigValue($configArrayEx, '颜色分类'), $col++); //Цвет
            //$this->appendCellToRow($number+2, (string)$this->getConfigValue($configArrayEx, '尺码'), $col++); //Размер
            //По старому не работает ибо Цвет и размер -  у китайцев по разному пишется в разных товарах.
            //Только перебор $configArrayEx - 1 : цвет, 2 : размер
            $foundConf = 0;
            foreach ($configArrayEx as $configCouple => $valueEx) {
                if (!$configCouple) {
                    continue;
                }
                if ($foundConf++ > 1) {
                    break;
                }
                $this->appendCellToRow($number+2, $valueEx , $col++);
            }
            for ($i = 0; $i < 2-$foundConf; $i++) {
                $this->appendCellToRow($number+2, '' , $col++);
            }

            $col_img = $col++;
            // download img
            $img_local = $this->_downloadItemImage($line['ItemImageURL']);

            if (file_exists($img_local) && @getimagesize($img_local)) {
                $objDrawing = new PHPExcel_Worksheet_Drawing();
                $objDrawing->setPath($img_local);
                $row = $number+2;
                $objDrawing->setCoordinates($col_img.$row);
                $objDrawing->setWorksheet($this->aSheet);
            }

            $this->appendCellToRow($number+2, $line['Qty'], $col++);
			$this->appendCellToRow($number+2, (string)$line['TaoBaoPrice'], $col++); //Цена без скидки
            $this->appendCellToRow($number+2, (string)$line['PriceCust'] . ' ' . (string)$line['CurrencyCust'], $col++); //Цена
            $this->appendCellToRow($number+2, (string)$line['TaoBaoDelivery'], $col++); //Доставка
			$this->appendCellToRow($number+2, (string)$line['TaoBaoDelivery']*(float)$line['Qty'], $col++); //Доставка общая
            $this->appendCellToRow($number+2, (string)$line['TaoBaoPriceWithDiscount']*(float)$line['Qty']
                + (string)$line['TaoBaoDelivery']*(float)$line['Qty'], $col++); //Итого (юани)

            $this->aSheet->getRowDimension($number+2)->setRowHeight(120);

        }

        $this->aSheet->getStyle('A1:P'.($number+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $this->aSheet->getStyle('J1:P'.($number+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->aSheet->getStyle('A1:J'.($number+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $this->aSheet->getStyle('A1:P'.($number+2))->applyFromArray(
            array('font' => array('size' => 10))
        );

        $this->saveExportFile(OrdersProxy::normalizeOrderId($orderInfo['SalesOrderInfo']['Id']), CFG_APP_ROOT . "/cache/".OrdersProxy::normalizeOrderId($orderInfo['SalesOrderInfo']['Id']).".xls");
    }

    private function parseConfigRow($configText)
    {
        $config = array();
        foreach (explode(';', $configText) as $configCouple) {
            if (! $configCouple || (false === strpos($configCouple, ':'))) {
                continue;
            }
            list($key, $value) = explode(':', $configCouple);
            $config[$key] = $value;
        }
        return $config;
    }

    private function _downloadItemImage($url)
    {

        $urlInfo = explode('/', $url);
        $itemName = end($urlInfo);
        $cacheDir = CFG_APP_ROOT.'/cache/';
        $downloadPath = $cacheDir.'orders_excel_export_new/';
        $this->_isDir($cacheDir);
        $this->_isDir($downloadPath);
        $this->_isDir($downloadPath.substr($itemName, 0, 4).'/');
        $img_local = $downloadPath.substr($itemName, 0, 4).'/'.$itemName;
        if (!file_exists($img_local) || !@getimagesize($img_local)) {
            @unlink($img_local);
            $this->_downloadImage($url, $img_local);
        }
        return $img_local;
    }

    private function _downloadImage($url, $img_local)
    {
        $pathInfo = explode('.',$img_local);
        
        if (! in_array(end($pathInfo), $this->validImages)) {
            return false;
        }

        $size = defined('CFG_CACHE_ADMIN_IMAGES_SIZE') ? CFG_CACHE_ADMIN_IMAGES_SIZE : 160;
        $ch = curl_init($url.'_'.$size.'x'.$size.'.jpg');

        $fp = fopen($img_local, 'wb');
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.112 Safari/534.30");
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);

        return true;
    }

    private function _isDir($path)
    {
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
    }

    private function getConfigValue($configArray, $key)
    {
        $value = '';

        foreach ($configArray as $k=>$v ) {
            if(preg_match('/'.$key.'/iu', $k)) {
                $value = $v;
                break;
            }
        }

        return $value;
    }

    private function appendCellToRow($row, $val, $col = '')
    {
        $column = $col ? $col : $this->aSheet->getHighestColumn();

        if($this->aSheet->cellExists($column.$row))
            $column++;
        $this->aSheet->setCellValue($column.$row,$val);
    }

    private function setColumnStyles()
    {
        $col = 'A';
        $this->aSheet->getColumnDimension($col++)->setWidth(5);
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

    private function saveExportFile($orderNumber, $saveToFile = false)
    {
        if (! $saveToFile) {
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="№'.$orderNumber.'.xls"');
            header('Cache-Control: max-age=0');
        }
        $this->objWriter->save( $saveToFile ? $saveToFile : 'php://output');
        if ($saveToFile) {
            header("Location: /cache/".$orderNumber.'.xls');
        }
    }

    public function batchExport($orders)
    {
        $number = 0;
        foreach ($orders as $order) {
            $col = 0;
            $this->appendCellToRow($number+2, 'Order id', $col++);
            $this->appendCellToRow($number+2, 'Full name', $col++);
            $this->appendCellToRow($number+2, 'Address', $col++);
            $this->appendCellToRow($number+2, 'Shippment Method', $col++);
            $this->appendCellToRow($number+2, 'Item', $col++);
            $this->appendCellToRow($number+2, '颜色分类', $col++);
            $this->appendCellToRow($number+2, '尺码', $col++);
            $this->appendCellToRow($number+2, 'Qty', $col++);
            $this->appendCellToRow($number+2, 'Original price (yuan)', $col++);
            $this->appendCellToRow($number+2, 'China delivery (yuan)', $col++);
            $this->appendCellToRow($number+2, 'Total price (yuan)', $col++);
            $number++;
        }
    }
}
