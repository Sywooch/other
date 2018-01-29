<?php

class OtapiContentTypesAnswer extends OtapiAnswer{
    /**
     * @return OtapiArrayOfString3
     */
    public function GetResult(){
        $value = isset($this->xmlData->Result) ? $this->xmlData->Result : false;
        return new OtapiArrayOfString3($value);
    }
}