<?php

OTBase::import('system.lib.exceptions.ServiceException');

class ErrorHandler
{
    /**
     * @var AuthenticationListener
     */
    protected $authenticationListener;

    private static $errors = array();

    public function __construct($authenticationListener)
    {
        $this->authenticationListener = $authenticationListener;
    }

    public static function init()
    {
        set_error_handler(array('ErrorHandler', 'handle'), E_ALL);
    }

    public static function handle($errno, $errstr, $errfile, $errline, $errcontext)
    {
        $debugLevel = error_reporting();
        if ($debugLevel & $errno) {
            $exit = false;
            switch ($errno) {
                case E_USER_ERROR:
                    $type = 'Fatal Error';
                    $exit = true;
                break;
                case E_USER_WARNING:
                case E_WARNING:
                    $type = 'Warning';
                break;
                case E_USER_NOTICE:
                case E_NOTICE:
                case @E_STRICT:
                    $type = 'Notice';
                break;
                case @E_RECOVERABLE_ERROR:
                    $type = 'Catchable';
                break;
                default:
                    $type = 'Unknown Error';
                    $exit = true;
                break;
            }

            throw new ErrorException($type . ': ' . $errstr, 0, $errno, $errfile, $errline);
        }
        return false;
    }

    public function CheckSessionExpired($e, $request)
    {
        if ($e->getErrorCode() == 'SessionExpired') {
            $this->authenticationListener->Logout($request);
            return true;
        }
    }

    public function showErrorWithPNotify($errorException)
    {
        $E = new ErrorUtil();
        return $E->showErrorWithPNotify($errorException);
    }

    public static function registerError($errorException)
    {
        $request = new RequestWrapper();
        $isAjax = $request->isAjax();

        if (($errorException instanceof ServiceException) && ($errorException->getErrorCode() == 'SessionExpired')) {
            Session::clear('sid');
            $loginUrl = 'http://' . $request->env('HTTP_HOST') . '/' . $request->getUriPart(0) . '/?cmd=Login';
            if ($isAjax) {
                if ($request->getReferrer()) {
                    $loginUrl .= '&retpath=' . $request->getReferrer();
                }
                $message = 'Session expired. Relogin is required.';
                header('HTTP/1.1 500 ' . $message);
                $response = array(
                    'error' => 1,
                    'message' => $message,
                    'redirect' => $loginUrl,
                    'expired' => 1
                );
                echo json_encode($response);
            } else {
                header('Location: index.php?cmd=Login');
            }
            die();
        }

        $message = $errorException->getMessage();

        if (method_exists($errorException, 'getErrorCode') && $errorException->getErrorCode() === 'AccessDenied') {
            self::$errors[] = $errorException;
            Session::setError(LangAdmin::get('Action_not_allowed_for_user'));
            header('Location: ' . BASE_ADMIN_URL);
            die();
        }

        // Если мы в режиме разработки, то сразу показать исключение
        if (OTBase::isTest()) {
            $message = '<pre><h2>' . $errorException->getMessage() . "</h2>\n\n" . $errorException->getTraceAsString() . '</pre>';
            if (! $isAjax) {
                echo $message;
                die();
            }
        }

        if ($isAjax) {
            $message = '__FACEPALM__' . $message;
            $message = preg_replace('#[\r\n]+#si', '__newline__', $message);
            $message = str_replace('h2', 'b', $message);
            header('HTTP/1.1 500 ' . $message);
            die();
        }

        self::$errors[] = $errorException;
    }

    public static function showRegisteredErrorsWithPNotify()
    {
        $output = '';
        $E = new ErrorUtil();
        foreach (self::$errors as $error) {
            $output .= $E->showErrorWithPNotify($error);
        }

        return $output;
    }
}
