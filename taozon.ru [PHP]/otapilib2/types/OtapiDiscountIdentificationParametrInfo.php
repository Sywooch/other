<?php

class OtapiDiscountIdentificationParametrInfo extends BaseOtapiType{
    /**
     * @return decimal
     */
    public function GetPurchaseVolume(){
        $value = isset($this->xmlData->PurchaseVolume) ? (string)$this->xmlData->PurchaseVolume : false;
        $propertyType = 'decimal';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
}