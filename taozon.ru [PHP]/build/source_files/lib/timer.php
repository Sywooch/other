<?php

class timer {
    
    protected $start_time = 0;
    protected $text ='';
    
    static public function getInstance()
    {
		static $obj_server;
		if (!isset($obj_server)){
			$obj_server = new self();
		}
		return $obj_server;
	}
    
    protected function count()
    {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }
    
    public function start($text = '', $params = array())
    {
        if(!is_array($params)) $params = array();
        unset($params['instanceKey']);
        $this->text = $text . 'Параметры: '.htmlspecialchars(json_encode($params));
        $this->start_time = $this->count();
    }
    
    public function end($text = '')
    {
        $run_time = $this->count() - $this->start_time;
        $this->log($run_time, $text);
    }
    
    protected function log($run_time, $text = '')
    {
        $somecontent = '['.date('Y-m-d H:i:s').'] '.$this->text.' — '.round($run_time, 2).' сек.'."\n";
        $GLOBALS['trace'][(string)$run_time.' '.rand(100000, 999999)] = $somecontent.' '.$text;
    }
    
    static function logXML($method, $params, $text)
    {
        $GLOBALS['traceXML'][] = array(
            'method' => $method,
            'info'    => $text,
            'params'  => $params
        );
    }
    
    public function endBlockLog($text = '')
    {
        //
    }
}
