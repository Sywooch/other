<?php

class OtapiItemPicture extends BaseOtapiType{
    /**
     * @return string
     */
    public function GetUrl(){
        $value = isset($this->xmlData->Url) ? (string)$this->xmlData->Url : false;
        $propertyType = 'string';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
    /**
     * @return boolean
     */
    public function IsMain(){
        $value = isset($this->xmlData->IsMain) ? (string)$this->xmlData->IsMain : false;
        $propertyType = 'boolean';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
}