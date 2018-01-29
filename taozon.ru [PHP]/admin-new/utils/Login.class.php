<?php

class Login extends GeneralUtil
{
    protected $_template = 'index';
    protected $_template_path = 'authentication/';

    /**
     * @param RequestWrapper $request
     */
    public function defaultAction($request)
    {
        $pageUrl = new AdminUrlWrapper();
        $pageUrl->Set("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");

        if ($request->getMethod() == 'POST') {
            $res = self::checkCaptcha($request);
            if ($res && General::getConfigValue('auth_capcha_admin')) {
                $this->tpl->assign('error', Lang::get('incorrect_code'));
            }
            if (!$res || !General::getConfigValue('auth_capcha_admin'))  {
                try {
                    $this->authenticationListener->Authenticate($request);
                    $rolesProvider = new RolesProvider();
                    $rolesProvider->setUserRoleAndRights(Session::get('sid'));
                } catch (ServiceException $e) {
                    $this->tpl->assign('error', $e->getErrorMessage());
                    $this->tpl->assign('login', $request->post('login'));
                    $this->tpl->assign('password', $request->post('password'));
                }
            }
        }

        if ($this->authenticationListener->IsAuthenticated($request)) {
            if (! $request->get('referer')) {
                $path = RightsManager::defaultPath();
                $pageUrl->SetValue('cmd', $path['cmd']);
                $pageUrl->SetValue('do', $path['do']);
            } else {
                $pageUrl->Set("http://$_SERVER[HTTP_HOST]" . $request->get('referer'));
            }
            
            $request->LocationRedirect($pageUrl->Get());
        }

        print $this->fetchTemplateWithoutHeaderAndFooter();
    }

    /**
     * @param RequestWrapper $request
     */
    public function loginAjaxAction($request)
    {
        $res = self::checkCaptcha($request);
        if ($res && General::getConfigValue('auth_capcha_admin')) {
            $this->respondAjaxError(Lang::get('incorrect_code'));
        }
        if (!$res || !General::getConfigValue('auth_capcha_admin')) {
            try {
                $this->authenticationListener->Authenticate($request);
                $rolesProvider = new RolesProvider();
                $rolesProvider->setUserRoleAndRights(Session::get('sid'));
            } catch (ServiceException $e) {
                $this->respondAjaxError($e->getErrorMessage());
            }
        }

        Session::clearError();
        $this->sendAjaxResponse(array('message' => LangAdmin::get('Authentication_ajax_true')));
    }

    public function logoutAction ($request)
    {
        try {
            $this->authenticationListener->Logout($request);
        } catch (ServiceException $e) {
            $this->tpl->assign('error', $e->getMessage());
        }
    }

    private static function checkCaptcha($request)
    {
        $captchapath = '../lib/securimage/securimage.php';
        require_once $captchapath;
        $securimage = new Securimage();

        if ($securimage->check($request->post('ct_captcha')) == false) {
            return true;
        }

        return false;
    }
}
