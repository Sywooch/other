<?php
class Discount {
    /**
     * @var OTAPIlib
     */
    protected $otapilib;

    

    public function __construct(){
        $this->otapilib = new OTAPIlib();
        $this->otapilib->setErrorsAsExceptionsOn();
    }

    public function getDiscountData(){
		try{
        	$sessionId = Session::getUserOrGuestSession();
			$userdiscount = false;		
			if(CMS::IsFeatureEnabled('Discount'))
                	$userdiscount = $this->otapilib->GetDiscountGroup($sessionId); 
        	return $userdiscount;
		}
		catch(ServiceException $e){
            Session::setError($e->getMessage(), $e->getErrorCode());
        }
        catch(Exception $e){
            Session::setError($e->getMessage(), $e->getCode());
        }
    }    
}