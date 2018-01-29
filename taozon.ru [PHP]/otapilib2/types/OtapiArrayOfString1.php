<?php

class OtapiArrayOfString1 extends BaseOtapiType{
    /**
     * @return string
     */
    public function GetType(){
        return isset($this->xmlData->Type) ? new UnboundedElementsIterator(
                $this->xmlData->Type,
                array(
                    'type' => 'scalarType',
                    'name' => 'string'
                )
            ) : array();
    }
}