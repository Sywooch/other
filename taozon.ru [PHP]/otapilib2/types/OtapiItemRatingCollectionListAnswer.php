<?php

class OtapiItemRatingCollectionListAnswer extends OtapiAnswer{
    /**
     * @return OtapiArrayOfItemRatingCollection
     */
    public function GetResult(){
        $value = isset($this->xmlData->Result) ? $this->xmlData->Result : false;
        return new OtapiArrayOfItemRatingCollection($value);
    }
}