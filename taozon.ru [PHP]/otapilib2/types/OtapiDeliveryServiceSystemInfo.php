<?php

class OtapiDeliveryServiceSystemInfo extends BaseOtapiType{
    /**
     * @return string
     */
    public function GetIntegrationType(){
        $value = isset($this->xmlData->IntegrationType) ? (string)$this->xmlData->IntegrationType : false;
        $propertyType = 'string';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
    /**
     * @return string
     */
    public function GetName(){
        $value = isset($this->xmlData->Name) ? (string)$this->xmlData->Name : false;
        $propertyType = 'string';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
    /**
     * @return boolean
     */
    public function IsAvailable(){
        $value = isset($this->xmlData->IsAvailable) ? (string)$this->xmlData->IsAvailable : false;
        $propertyType = 'boolean';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
    /**
     * @return boolean
     */
    public function IsPackageExportEnabled(){
        $value = isset($this->xmlData->IsPackageExportEnabled) ? (string)$this->xmlData->IsPackageExportEnabled : false;
        $propertyType = 'boolean';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
    /**
     * @return boolean
     */
    public function IsReceiptPrintEnabled(){
        $value = isset($this->xmlData->IsReceiptPrintEnabled) ? (string)$this->xmlData->IsReceiptPrintEnabled : false;
        $propertyType = 'boolean';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
}