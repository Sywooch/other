<?php

class OtapiDataListOfString extends BaseOtapiType{
    /**
     * @return OtapiArrayOfString2
     */
    public function GetContent(){
        $value = isset($this->xmlData->Content) ? $this->xmlData->Content : false;
        return new OtapiArrayOfString2($value);
    }
}