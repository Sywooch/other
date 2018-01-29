<?php

/**
 * Shows count of service calls
 */
class ServiceCallCounter extends GeneralUtil
{
    protected $_cache = false; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'index'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = 'service_calls/'; //- путь к шаблону
    protected $tpl;

    public function defaultAction(){
        $this->checkAuth();
        print $this->fetchTemplate();
    }

    public function getCountAction(){
        global $otapilib;
        $result = $otapilib->GetCallStatistics();
        print json_encode($result);

        die();
    }
}
