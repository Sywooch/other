<?php

class OtapiArrayOfString3 extends BaseOtapiType{
    /**
     * @return string
     */
    public function GetString(){
        return isset($this->xmlData->string) ? new UnboundedElementsIterator(
                $this->xmlData->string,
                array(
                    'type' => 'scalarType',
                    'name' => 'string'
                )
            ) : array();
    }
}