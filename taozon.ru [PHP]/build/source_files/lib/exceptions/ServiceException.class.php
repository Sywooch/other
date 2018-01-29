<?php

class ServiceException extends Exception
{
    private $errorCode;

    public function __construct($message, $code){
        $this->errorCode = $code;
        parent::__construct($message);
    }

    public function getErrorCode(){
        return $this->errorCode;
    }
}
