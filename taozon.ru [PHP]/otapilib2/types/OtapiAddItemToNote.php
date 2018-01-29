<?php

class OtapiAddItemToNote extends BaseOtapiType{
    /**
     * @return string
     */
    public function GetInstanceKey(){
        $value = isset($this->xmlData->instanceKey) ? (string)$this->xmlData->instanceKey : false;
        $propertyType = 'string';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
    /**
     * @return string
     */
    public function GetSessionId(){
        $value = isset($this->xmlData->sessionId) ? (string)$this->xmlData->sessionId : false;
        $propertyType = 'string';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
    /**
     * @return string
     */
    public function GetItemId(){
        $value = isset($this->xmlData->itemId) ? (string)$this->xmlData->itemId : false;
        $propertyType = 'string';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
    /**
     * @return string
     */
    public function GetConfigurationId(){
        $value = isset($this->xmlData->configurationId) ? (string)$this->xmlData->configurationId : false;
        $propertyType = 'string';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
    /**
     * @return string
     */
    public function GetPrice(){
        $value = isset($this->xmlData->price) ? (string)$this->xmlData->price : false;
        $propertyType = 'string';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
    /**
     * @return int
     */
    public function GetQuantity(){
        $value = isset($this->xmlData->quantity) ? (string)$this->xmlData->quantity : false;
        $propertyType = 'int';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
    /**
     * @return string
     */
    public function GetCurrencyName(){
        $value = isset($this->xmlData->currencyName) ? (string)$this->xmlData->currencyName : false;
        $propertyType = 'string';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
    /**
     * @return string
     */
    public function GetFieldParameters(){
        $value = isset($this->xmlData->fieldParameters) ? (string)$this->xmlData->fieldParameters : false;
        $propertyType = 'string';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
}