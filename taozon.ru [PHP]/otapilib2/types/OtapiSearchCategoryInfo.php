<?php

class OtapiSearchCategoryInfo extends BaseOtapiType{
    /**
     * @return string
     */
    public function GetId(){
        $value = isset($this->xmlData->Id) ? (string)$this->xmlData->Id : false;
        $propertyType = 'string';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
    /**
     * @return string
     */
    public function GetExternalId(){
        $value = isset($this->xmlData->ExternalId) ? (string)$this->xmlData->ExternalId : false;
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
     * @return long
     */
    public function GetItemCount(){
        $value = isset($this->xmlData->ItemCount) ? (string)$this->xmlData->ItemCount : false;
        $propertyType = 'long';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
}