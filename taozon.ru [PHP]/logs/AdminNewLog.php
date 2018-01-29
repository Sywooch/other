<?php

class AdminNewLog extends Log {
    protected $notificationUrl = 'http://support.opentao.net/log_analyzer/on_ready_admin_new_log';
    protected $beginTime;
    protected $loadingTime;

    protected $filePath;
    protected $backupPath;

    public function __construct($request = null){
        $this->request = $request ? $request : new RequestWrapper();
        $this->filePath = dirname(__FILE__) . '/log.admin_new.dat';
        $this->backupPath = dirname(__FILE__) . '/log.admin_new.ready.dat';

        $this->Create();
    }

    public function CompleteClose(){
        $this->Stop();
        $this->Write();
        if($this->Size() > 100){
            $this->Release();
        }
    }
}