<?php
class ReferalSystem
{
    public static function onPrivateOfficeMainPageRender($login,$id)
    {	
	   $cms = new CMS();
       $RefData = new ReferralUserManager($cms, new SupportRepository(new CMS()));
	   $RefCats = new ReferralCategoryManager($cms);

        try{
            $RefUser = $RefData->GetById($id);
			$RefUserCategory = $RefCats->GetById($RefUser->GetCategory());
            //Если юзер есть в реферале то выводим рефералку - нет знаит нет.
            $block = file_get_contents(dirname(__FILE__) . '/tpl/main.html');
			$link = base64_encode($login."|".$RefUser->GetId());			
            $block = str_replace(
                array(
                    '[+main_text+]', '[+url_text+]','[+url+]','[+balance_text+]','[+balance+]','[+category_text+]','[+category+]'
                ),
                array(
                    Lang::get('user_referal'),
                    Lang::get('referal_link'),
                    "http://".IDN::decodeIDN($_SERVER['HTTP_HOST'])."/register?refId=".$link,
                    Lang::get('balance'
                    ),
                    number_format((float)$RefUser->GetBalance(), (int)General::$siteConf['price_round_decimals'], '.', ' '),
                    Lang::get('category'),
                    $RefUserCategory->GetGroupName()
                ),
                $block
            );
            return $block;
        }
        catch(NotFoundException $e){
			$block = file_get_contents(dirname(__FILE__) . '/tpl/mainNoFound.html');
			$link = base64_encode($login."|".$id);
			$block = str_replace(
                array(
                    '[+main_text+]', '[+url_text+]','[+url+]'
                ),
                array(
                    Lang::get('user_referal'),
                    Lang::get('referal_link'),
                    "http://".IDN::decodeIDN($_SERVER['HTTP_HOST'])."/register?refId=".$link                 
                    
                ),
                $block
            );
            return $block;
			
        }

    }

    public static function onUserRegister($userInfo)
    {
        $refUserManager = new ReferralUserManager(new CMS());
        try{
            $referrerUser = $refUserManager->GetByLogin($userInfo['parent']);
        }
        catch(NotFoundException $e){
            $referrerUser = new ReferralUser(0);
			$refUserManager->Add($userInfo['parent'], $userInfo['parent_id'], $referrerUser->GetId());
			$referrerUser = $refUserManager->GetByLogin($userInfo['parent']);
        }
        catch(DBException $e){}
        return (bool) $refUserManager->Add($userInfo['username'], $userInfo['id'], $referrerUser->GetId());
    }

    public static function onRenderAddBestItemsForm(){

    }

    public static function onRegisterFormRender(){
		$refId = Cookie::get(REFERER_KEY, Session::get(REFERER_KEY));
        $refId = $refId ? $refId : RequestWrapper::get(REFERER_KEY);
        ob_start();
        include dirname(__FILE__) . '/tpl/register.php';
        $c = ob_get_contents();
        ob_end_clean();
        return $c;
    }
}

