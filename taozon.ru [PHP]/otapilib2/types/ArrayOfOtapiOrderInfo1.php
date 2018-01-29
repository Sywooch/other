<?php

class ArrayOfOtapiOrderInfo1 extends BaseOtapiType{
    /**
     * @return OtapiOrderInfo[]
     */
    public function GetOtapiOrderInfo(){
        return isset($this->xmlData->OtapiOrderInfo) ? new UnboundedElementsIterator(
                $this->xmlData->OtapiOrderInfo,
                array(
                    'type' => 'complexType',
                    'name' => 'OtapiOrderInfo'
                )
            ) : array();
    }
}