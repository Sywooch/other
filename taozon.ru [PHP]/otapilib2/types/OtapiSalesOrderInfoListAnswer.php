<?php

class OtapiSalesOrderInfoListAnswer extends OtapiAnswer{
    /**
     * @return ArrayOfOtapiOrderInfo2
     */
    public function GetResult(){
        $value = isset($this->xmlData->Result) ? $this->xmlData->Result : false;
        return new ArrayOfOtapiOrderInfo2($value);
    }
}