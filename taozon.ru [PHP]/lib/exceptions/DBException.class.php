<?php

class DBException extends Exception
{
    const CONNECTION_ERROR = 'CONNECTION_ERROR';
    const NO_CONNECTION = 'NO_CONNECTION';
    const CANNOT_CREATE_TABLE = 'CANNOT_CREATE_TABLE';
    const QUERY_ERROR = 'QUERY_ERROR';

    public function __construct($message = '', $code = 0, $where = '', $params = array()){
        ErrorLog::WriteErrorLog($where,$params,$message, 'DBError');
        parent::__construct($message, $code);
    }
}
