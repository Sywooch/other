<?php

class RecoveryEmail extends GenerateBlock
{
    protected $_cache = false; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'recovery_email'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/users/';
    
    public function __construct()
    {
        parent::__construct(true);
    }
    
    protected function setVars()
    {
        $args = func_get_args();
        $this->tpl->assign('url', $_SERVER['HTTP_HOST'].''.dirname($_SERVER['PHP_SELF']).'/');
        $this->tpl->assign('mode', $args[0][0]);
        
        switch($args[0][0]){
            case 'code':
                $this->tpl->assign('code', $_SERVER['HTTP_HOST'].''.dirname($_SERVER['PHP_SELF']).'/index.php?p=login&code='.$args[0][1]);                
                break;
            case 'userdata':
                $this->tpl->assign('username', $args[0][1]);
                $this->tpl->assign('password', $args[0][2]);
                break;
        }
        
    }
}

?>