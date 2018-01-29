<?php


class CustomCurlRequest extends RollingCurlRequest
{
    public $url = false;
    public $method = 'POST';
    public $serviceMethod = '';
    public $parameters = array();
    public $post_data = null;
    public $headers = null;
    public $options = null;
    public $hash = null;
    public $typeName = null;

    function __construct($url, $method = "GET", $post_data = null, $headers = null, $options = null, $hash = null,
                         $typeName = '', $serviceMethod = '', $parameters = array())
    {
        $this->url = $url;
        $this->method = $method;
        $this->post_data = $post_data;
        $this->headers = $headers;
        $this->options = $options;
        $this->hash = $hash;
        $this->typeName = $typeName;
        $this->serviceMethod = $serviceMethod;
        $this->parameters = $parameters;
    }
}


class AbstractOTAPILib2 {

    protected static $serverUrl = '';

    protected static $curlTimeOut = 30;

    private static $responses = array();

    private static $windowSize = 0;

    /**
     * @var CustomCurlRequest[]
     */
    private static $requests = array();

    /**
     * @var timer[]
     */
    private static $timers = array();

    /**
     * @var RollingCurl
     */
    private static $curl = null;

    public static function init() {
        self::$serverUrl = defined('CFG_SERVICE_URL') ? CFG_SERVICE_URL : 'http://otapi.net/OtapiWebService2.asmx/';
        self::$windowSize = defined('CFG_MULTI_CURL') && CFG_MULTI_CURL ? 5 : 1;
    }

    /**
     * Данные по умолчанию для подключения к сервису
     * @param string $instanceKey
     * @return array $params
     */
    protected static function defaultLogin($instanceKey = '') {
        $params = array(
            'instanceKey' => $instanceKey ? $instanceKey : CFG_SERVICE_INSTANCEKEY
        );
        return $params;
    }

    /**
     * @param $output
     * @param $info
     * @param CustomCurlRequest $request
     * @throws Exception
     */
    public static function catchResponse($output, $info, $request)
    {
        $xml = simplexml_load_string($output);
        if (isset($xml->ErrorCode)
            && (string) $xml->ErrorCode != 'Ok'
            && (string) $xml->ErrorCode != 'BatchError') {

			unset(self::$requests[$request->hash]);
            throw new ServiceException($request->serviceMethod, $request->parameters, $xml->ErrorDescription, $xml->ErrorCode);
        }

		if (isset(self::$timers[$request->hash])) {
			$count = self::$timers[$request->hash];
			$totalTime = $count->end((string)$xml->RequestTimeStatistic . "\n");
			unset(self::$timers[$request->hash]);

            $basePath = dirname(dirname(__FILE__));
            if (file_exists($basePath . '/logs/writelog.php')) {
                require_once($basePath . '/logs/writelog.php');
                $logdata = array(
                    'servicename' => 'OTAPI',
                    'methodname' => $request->serviceMethod,
                    'request' => $request->parameters,
                    'response' => $output,
                    'time' => $totalTime,
                );
                @writeservicelog($logdata);
            }
		}
        unset(self::$requests[$request->hash]);

        $typeName = $request->typeName;
        self::$responses[$request->hash] = new $typeName($xml);
    }

    protected static function registerRequest($methodName, $parameters, $typeName, &$response)
    {
        if (self::$curl == null)
            self::$curl = new RollingCurl('AbstractOTAPILib2::catchResponse');
        $parameters += self::defaultLogin();
        $responseHash = md5(serialize(array('parameters' => $parameters, 'method' => $methodName)));
        self::$responses[$responseHash] = &$response;

        $referrer = isset($_SERVER['HTTP_HOST']) ? 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] : 'localhost';
        $request = new CustomCurlRequest(self::$serverUrl . $methodName, 'POST', http_build_query($parameters), null, array(
            CURLOPT_REFERER => $referrer
        ), $responseHash, $typeName, $methodName, $parameters);

        self::$curl->add($request);
        self::$requests[$responseHash] = $request;
        self::$timers[$responseHash] = new timer();

        if (self::$windowSize == 1) {
            self::makeRequests();
        }
    }

    public static function makeRequests()
    {
        if (!self::$requests)
            return false;
        foreach (self::$requests as $hash => $request) {
            $count = self::$timers[$hash];
            $count->start($request->serviceMethod, $request->parameters);
        }
        self::$curl->execute(self::$windowSize);
    }

}