<?php
	
OTBase::import('system.lib.Validation.*');
OTBase::import('system.lib.Validation.Rules.*');

class IpAccess extends GeneralUtil
{
    protected $_template = 'ipaccess';
    protected $_template_path = 'site_config/';
    
    /**
     * @var SiteConfigurationRepository
     */
    protected $siteConfigRepository;

    public function __construct()
	{
        parent::__construct();
        $this->siteConfigRepository = new SiteConfigurationRepository($this->cms);        
    }

    public function defaultAction($request)
	{
        $this->tpl->assign('ipList', $this->getIps());
        print $this->fetchTemplate();
    }
    
    public function addIpAction($request)
	{        
        $ip = $request->getValue('ip');
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $alowedIps = $this->getIps();
            $alowedIps[] = $ip;        
            $this->setIps(array_unique($alowedIps));		
            $this->sendAjaxResponse();
        } else {
            $this->respondAjaxError(LangAdmin::get('Entered_ip_is_incorrect'));
        }
        
    }
    
    public function deleteIpAction($request)
	{        
        $alowedIps = $this->getIps();
        $key = array_search($request->getValue('ip'), $alowedIps);
        if ($key !== false) {
            unset($alowedIps[$key]);
        }             
		$this->setIps($alowedIps);		
		$this->sendAjaxResponse();
    }
    
    private function getIps()
	{
        return unserialize($this->siteConfigRepository->Get('ip_access_to_search', serialize(array()), false));
    }
    
    private function setIps($alowedIps)
	{
        $this->siteConfigRepository->Set('ip_access_to_search', serialize($alowedIps));
    }
    
}
