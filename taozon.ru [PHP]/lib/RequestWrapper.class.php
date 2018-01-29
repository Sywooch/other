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

    private $referrer;

    public function __construct($predefinedRequest = array()){
        $this->method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';
        $this->request = $predefinedRequest ? $predefinedRequest :
            ($this->method == 'POST' ? $_POST : $_GET);
        $this->referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
    }

    public static function path($qs = false)
    {
        return $qs ? self::env('REQUEST_URI') : preg_replace('/\?.+$/', '', self::env('REQUEST_URI'));
    }

    public static function getUriPart($index)
    {
        $path = trim(self::path(), '/ ');
        $parts = $path !== "" ? explode('/', $path) : array();
        return array_key_exists($index, $parts) ? $parts[$index] : null;
    }

    public function getMethod(){
        return $this->method;
    }

    /**
     * @param $key
     * @return bool|mixed
     */
    public function getValue($key, $default = null)
    {
        return array_key_exists($key, $this->request) ? $this->request[$key] : $default;
    }

    public function valueExists($key)
    {
        return array_key_exists($key, $this->request);
    }

    public static function getValueSafe($key){
        return isset($_GET[$key]) ? trim(htmlspecialchars(stripslashes(strip_tags($_GET[$key])))) : false;
    }
    
    public static function getRequestValueSafe($key){
        return isset($_REQUEST[$key]) ? trim(htmlspecialchars(stripslashes(strip_tags($_REQUEST[$key])))) : false;
    }

    public function escapeValue($value){
        return trim(htmlspecialchars(stripslashes(strip_tags($value))));
    }

    public function getAll(){
        return $this->request;
    }

    public function delete($key){
        if($this->method == 'GET')
            unset($_GET[$key]);
        else
            unset($_POST[$key]);
    }

    public static function get($key, $default = null)
    {
        return array_key_exists($key, $_GET) ? $_GET[$key] : $default;
    }

    public static function getParamExists($key)
    {
        return array_key_exists($key, $_GET);
    }

    public static function post($key, $default = null)
    {
        return array_key_exists($key, $_POST) ? $_POST[$key] : $default;
    }

    public static function request($key, $default = null)
    {
        return array_key_exists($key, $_REQUEST) ? $_REQUEST[$key] : $default;
    }

    public static function env($key, $default = null)
    {
        return array_key_exists($key, $_SERVER) ? $_SERVER[$key] : $default;
    }

    public static function isAjax()
    {
        return strtolower(self::env('HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest';
    }

    public static function LocationRedirect($url){
        header("Location: $url");
        die();
    }

    public function RedirectToReferrer(){
        header("Location: ".$this->referrer);
        die();
    }

    public function getReferrer(){
        return $this->referrer;
    }

    public function set($key, $value)
    {
        $this->request[$key] = $value;
    }
}