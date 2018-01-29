<?php

OTBase::import('system.admin-new.lib.otapi_providers.CallStatistics');
OTBase::import('system.admin-new.lib.otapi_providers.InstanceOptionsInfo');

class Reports extends GeneralUtil
{
    protected $_template = 'service_statistics';
    protected $_template_path = 'reports/';

    /**
     * @var CallStatistics
     */
    protected $callStatistics;

    /**
     * @var InstanceOptionsInfo
     */
    protected $instanceOptionsInfo;

    /**
     * @var InstanceBillingInfo
     */
    protected $InstanceBillingInfo;

    public function __construct()
    {
        parent::__construct();
        $this->callStatistics = new CallStatistics($this->otapilib);
        $this->instanceOptionsInfo = new InstanceOptionsInfo($this->otapilib);
        $this->InstanceBillingInfo = new InstanceBillingInfo($this->otapilib);
    }

    public function defaultAction($request)
    {
        try {
            $tarif = $this->instanceOptionsInfo->GetTariff(Session::get('sid'));
            $statistic = $this->callStatistics->GetCallStatistics();
        } catch (ServiceException $e) {
            $this->errorHandler->registerError($e);
        }

        $this->tpl->assign('tarif', $tarif);
        $this->tpl->assign('statistic', $statistic);
        print $this->fetchTemplate();
    }

    public function billingAction($request)
    {
        $this->_template = 'billing_info';
        try {
            $this->InstanceBillingInfo->initSearchBills(Session::get('sid'));
            $this->InstanceBillingInfo->initRateHistory(Session::get('sid'));
            $this->InstanceBillingInfo->initInstanceOptions(Session::get('sid'));
            $this->InstanceBillingInfo->initCalculateRent(Session::get('sid'));

            $this->InstanceBillingInfo->doRequests();

            $this->tpl->assign('bills', $this->InstanceBillingInfo->getBills()->GetResult()->GetContent());
            $this->tpl->assign('rateHistory', $this->InstanceBillingInfo->getRateHistory()->GetResult()->GetElements());
            $this->tpl->assign('rent', $this->InstanceBillingInfo->getCalculateRent()->GetResult()->GetTotalRent());

            $this->tpl->assign('rate', $this->InstanceBillingInfo->getInstanceOptions()->GetResult()->GetTariff());
            $this->tpl->assign('hosting', $this->InstanceBillingInfo->getInstanceOptions()->GetResult()->GetHosting());
        } catch (ServiceException $e) {
            $this->errorHandler->registerError($e);
        }

        print $this->fetchTemplate();
    }

    public function viewBillAction($request)
    {
        $this->_template = 'view_bill';
        try {
            $bill = $this->getOneBill($request->get('billId'));
            $this->InstanceBillingInfo->initCalculateRentToBill(
                Session::get('sid'),
                $bill->GetSettlingPeriod()->GetDateFrom(),
                $bill->GetSettlingPeriod()->GetDateTo()
            );
            $this->InstanceBillingInfo->doRequests();
            $this->tpl->assign('bill', $bill);
            $this->tpl->assign('rent', $this->InstanceBillingInfo->getCalculateRent()->GetResult()->GetTotalRent()->GetTurnover()->GetTransactions());
            $this->tpl->assign('autoPrint', $request->get('autoPrint'));
        } catch (ServiceException $e) {
            $this->errorHandler->registerError($e);
        }

        print $this->fetchTemplateWithoutHeaderAndFooter();
    }

    public function exportBillAction($request)
    {
        try {
            $bill = $this->getOneBill($request->get('billId'));
            $this->InstanceBillingInfo->initCalculateRentToBill(
                Session::get('sid'),
                $bill->GetSettlingPeriod()->GetDateFrom(),
                $bill->GetSettlingPeriod()->GetDateTo()
            );
            $this->InstanceBillingInfo->doRequests();
            $rent = $this->InstanceBillingInfo->getCalculateRent()->GetResult()->GetTotalRent()->GetTurnover()->GetTransactions();
            if ($bill) {
                $file = '../cache/bill-' . $request->get('billId') . '.xls';
                require_once CFG_APP_ROOT . '/lib/PhpExcel/PHPExcel.php';
                $pExcel = new PHPExcel();
                require_once CFG_APP_ROOT . '/lib/PhpExcel/PHPExcel/Writer/Excel5.php';
                $objWriter = new PHPExcel_Writer_Excel5($pExcel);
                $pExcel->setActiveSheetIndex(0);
                $aSheet = $pExcel->getActiveSheet();
                $aSheet->setTitle(LangAdmin::get('Bill_info'));

                $aSheet->setCellValue('A1', LangAdmin::get('Creation_date'));
                $aSheet->setCellValue('B1', LangAdmin::get('Pay_date'));
                $aSheet->setCellValue('C1', LangAdmin::get('Url_to_pay'));
                $aSheet->setCellValue('D1', LangAdmin::get('Payed_amount'));
                $aSheet->setCellValue('E1', LangAdmin::get('Amount_USD'));
                $aSheet->setCellValue('F1', LangAdmin::get('Amount_RUB'));
                $aSheet->setCellValue('G1', LangAdmin::get('Condition'));
                $aSheet->setCellValue('H1', LangAdmin::get('Bill_discription'));

                $aSheet->setCellValue('A2', date('d.m.Y', strtotime($bill->GetCreationDate())));
                $aSheet->setCellValue('B2', $bill->GetPaymentDate() ? date('d.m.Y', strtotime($bill->GetPaymentDate())) : '--');
                $aSheet->setCellValue('C2', $bill->GetPaymentUrl());
                $aSheet->setCellValue('D2', $bill->GetPaidSumInUSD()->asString() ? $bill->GetPaidSumInUSD()->asString() : '--');
                $aSheet->setCellValue('E2', $bill->GetSumToPayInUSD()->asString());
                $aSheet->setCellValue('F2', $bill->GetSumToPayInRUB()->asString());
                $aSheet->setCellValue('G2', $bill->GetStatus()->GetDescription());
                $aSheet->setCellValue('H2', $bill->GetDescription());

                $aSheet->setCellValue('A4', LangAdmin::get('Transactions_list'));
                $aSheet->setCellValue('A5', LangAdmin::get('Date'));
                $aSheet->setCellValue('B5', LangAdmin::get('user_login'));
                $aSheet->setCellValue('C5', LangAdmin::get('Amount'));
                $aSheet->setCellValue('D5', LangAdmin::get('Description'));
                foreach ($rent->GetTransactionInfo() as $i => $transaction) {
                    $aSheet->setCellValue('A'.(6+$i), date('d.m.Y H:i:s', strtotime($transaction->GetTransactionDateTime())));
                    $aSheet->setCellValue('B'.(6+$i), $transaction->GetUserLogin());
                    $aSheet->setCellValue('C'.(6+$i), $transaction->GetAmountInternal() * (-1));
                    $aSheet->setCellValue('D'.(6+$i), $transaction->GetTransactionType()->GetName().' '.$transaction->GetComment());
                }

                $aSheet->getColumnDimension('A')->setWidth(20);
                $aSheet->getColumnDimension('B')->setWidth(20);
                $aSheet->getColumnDimension('C')->setWidth(40);
                $aSheet->getColumnDimension('D')->setWidth(20);
                $aSheet->getColumnDimension('E')->setWidth(20);
                $aSheet->getColumnDimension('F')->setWidth(20);
                $aSheet->getColumnDimension('G')->setWidth(20);
                $aSheet->getColumnDimension('H')->setWidth(40);


                $objWriter->save($file);
                header("Content-Type: application/vnd.ms-excel; charset=utf-8");
                header('Content-Disposition: attachment; filename="' . $file . '"');
                readfile($file);
            } else {
                echo 'Информация по счету не найдена';
            }
        } catch (ServiceException $e) {
            $this->errorHandler->registerError($e);
        }
    }


    public function getStatisticAction($request)
    {
        try {
            $this->getWebUISettings();
            $statistic = $this->callStatistics->GetCallStatistics();
        } catch (ServiceException $e) {
            $this->respondAjaxError($e->getMessage());
        }

        $this->sendAjaxResponse($statistic);
    }

    public static function hasUnPayedBills()
    { 
        if (! RightsManager::isSuperAdmin()) {
            return false;
        }
        if (! self::isActionAllowed()) {
            return false;
        }
        $bills = new InstanceBillingInfo($this->otapilib);
        $bills->initSearchBills(Session::get('sid'));
        $bills->doRequests();
        $bills = $bills->getBills()->GetResult()->GetContent();
        $hasUnPayed = false;
        if (! empty($bills)) {
            foreach ($bills->GetItem() as $item) {
                if ($item->GetStatus()->GetName() != 'Paid') {
                    $hasUnPayed = true;
                    break;
                }
            }
        }
        return $hasUnPayed;
    }

    private function getOneBill($billId)
    {
        $bill = false;
        $this->InstanceBillingInfo->initSearchBills(Session::get('sid'));
        $this->InstanceBillingInfo->doRequests();
        foreach ($this->InstanceBillingInfo->getBills()->GetResult()->GetContent()->GetItem() as $item) {
            if ($item->GetId()->asString() == $billId) {
                $bill =  $item;
                break;
            }
        }
        return $bill;
    }

    public function operationLogAction($request)
    {
        $records = array();
        $this->_template = 'operation_log';
        try {
            $page = $this->getPageDisplayParams($request);

            $perpage = $page['limit'];
            $pageNum = $page['number'];
            $from = $page['offset'];
            $count = 0;

            $xmlSearchParameters = "";
            $logs = $this->getOtapilib()->SearchInstanceUserLogEntries(Session::get('sid'), $from, $perpage, $xmlSearchParameters);
            $types = $this->getOtapilib()->GetOperationTypes(Session::get('sid'));
            $opTypes = array();
            foreach ($types as $key => $type) {
                $opTypes[$type['name']] = $type['description'];
            } 

            if (array_key_exists('totalcount', $logs)) {
                $count = $logs['totalcount'];
            }
            if (array_key_exists('content', $logs)) {
                $records = $logs['content'];
                foreach ($records as $key => &$value) {
                    $opdescription = $opTypes[$value['operationtype']]; 
                    $value['operationtype'] = !empty($opdescription) ? $opdescription : $value['operationtype'];  
                }
            }

        } catch (ServiceException $e) {
            $this->errorHandler->registerError($e);
        }

        $this->tpl->assign('records', $records );
        $this->tpl->assign('paginator', new Paginator($count, $pageNum, $perpage));

        print $this->fetchTemplate();
    }
}
