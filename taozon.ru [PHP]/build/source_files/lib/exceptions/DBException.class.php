<?php

class DBException extends Exception
{
    const CONNECTION_ERROR = 'CONNECTION_ERROR';
    const NO_CONNECTION = 'NO_CONNECTION';
    const CANNOT_CREATE_TABLE = 'CANNOT_CREATE_TABLE';
    const QUERY_ERROR = 'QUERY_ERROR';
}
