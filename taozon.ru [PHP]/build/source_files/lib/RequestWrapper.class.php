<?php

class RequestWrapper
{
    /**
     * @var Метод запроса POST|GET
     */
    private $method;

    /**
     * @var Хранит в себе сам запрос
     */
    private $request;

    public function __construct($predefinedRequest = array()){
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->request = $predefinedRequest ? $predefinedRequest :
            ($_SERVER['REQUEST_METHOD'] == 'POST' ? $_POST : $_GET);
    }

    public function getValue($key){
        return isset($this->request[$key]) ? $this->request[$key] : false;
    }

    public static function getValueSafe($key){
        return isset($_GET[$key]) ? trim(htmlspecialchars(stripslashes(strip_tags($_GET[$key])))) : false;
    }

    public function getAll(){
        return $this->request;
    }

    public static function get($name){
        return isset($_GET[$name]) ? $_GET[$name] : '';
    }
    public static function post($name){
        return isset($_POST[$name]) ? $_POST[$name] : '';
    }
}