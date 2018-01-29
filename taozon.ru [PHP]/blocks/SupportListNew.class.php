<?php

class SupportListNew extends GenerateBlock
{
    protected $_cache = false; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'supportlistnew'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/main/';
    private $userData;

    public function __construct()
    {
        parent::__construct(true);
        $this->userData = new UserData();
    }

    protected function setVars()
    {
        $sid = Session::getUserOrGuestSession();        
		if (Session::get(Session::getHttpHost() . 'isMayAuthenticated')) {
            //Считаем что авторизованы
            $allUserNoteData = $this->otapilib->BatchGetUserData($sid, 'UserStatus,Note');                
            if ($allUserNoteData['Status']['IsSessionExpired'] == 'false') {
                Session::set(Session::getHttpHost() . 'isMayAuthenticated', true);                
            } else {
                Session::clearUserData();                
            }
            $allNote = $allUserNoteData['Note'];
        } else {
            //Неавторизованы или неизвестно (все равно вызовем просто GetNote :) )
            $allNote = $this->otapilib->GetNote($sid);	
        }
        
		$url = $_SERVER['REQUEST_URI'];
        

        if($this->request->valueExists('clear')) {
            $isdeleted = $this->otapilib->ClearNote($sid);
            if ($isdeleted) {
                $allNote = array();
            }
        }
		
		if (isset($_POST['per_page'])) {
			if(isset($_GET['per_page'])) {
			     $url = str_replace('&per_page=' . $_GET['per_page'], '', $url);
			}
			$url .= '&per_page=' . $_POST['per_page'];
		}
		
		if (! empty($_POST))
			header('Location: ' . $url);			
        
		
        if ($allNote === false) show_error($this->otapilib->error_message);
			
		// Постараничный вывод
        $perpage = (isset($_SESSION['perpage']) && !empty($_SESSION['perpage'])) ? $_SESSION['perpage'] : 16;
        $page = (int)$this->request->get('page', 1);
        $from = ($page - 1) * $perpage;
		
        if (isset($_GET['per_page'])){
			$url = str_replace('&from=' . $from, '', $url);
			$perpage = $_GET['per_page'];
			$_SESSION['perpage'] = $perpage;
		}
		
        
        $url = str_replace('&from=' . $from, '', $url);
		
        $this->tpl->assign('list', $allNote);
        $this->tpl->assign('from', $from);
        $this->tpl->assign('perpage', $perpage);
        $this->tpl->assign('pageUrl', $url);
        $this->tpl->assign('paginatorFav', new Paginator(count($allNote), $page, $perpage));
    }

    static function AddItemToNote($otapilib1, $id, $quantity)
    {
        global $otapilib;

        $sid = Session::getUserOrGuestSession();

        return $otapilib->AddItemToNote(
            $sid, $id, $quantity,
            $_GET['itemTitle'], $_GET['configurationId'], @$_GET['promoId'], $_GET['categoryId'], $_GET['categoryName'],
            $_GET['price'], $_GET['currencyName'],
            '', $_GET['pictureURL'], $_GET['vendorId'],
            $_GET['itemConfiguration'], $_GET['weight']);
    }

    /**
     * @param RequestWrapper $request
     */
    public function addAction($request)
    {
        $this->otapilib->setErrorsAsExceptionsOn();

        try {
            $res = $this->otapilib->AddItemToNote(
                Session::getUserOrGuestSession(),
                $request->getValue('id'),
                $request->getValue('quantity'),
                $request->getValue('itemTitle'),
                $request->getValue('configurationId'),
                $request->getValue('promoId'),
                $request->getValue('categoryId'),
                $request->getValue('categoryName'),
                $request->getValue('price'),
                $request->getValue('currencyName'),
                $request->getValue('externalURL'),
                $request->getValue('pictureURL'),
                $request->getValue('vendorId'),
                $request->getValue('itemConfiguration'),
                $request->getValue('weight')
            );

            $items = $this->otapilib->GetNote(Session::getUserOrGuestSession());
            $this->userData->ClearUserDataCache();

            print json_encode(array('Success'=>'Ok', 'Count' => count($items), 'itemId' => $res));
        }
        catch(ServiceException $e){
            header('HTTP/1.1 500 ' . $e->getErrorCode());
			if ($e->getErrorCode()=='NotAvailable') {	
			   $error = Lang::get('NotAvailable');
			} else {
				$error = $e->getMessage();
			}			
            die($error);
        }
        catch(Exception $e){
            header('HTTP/1.1 500 ' . $e->getCode());
            die($e->getMessage());
        }
    }
    
    public function deleteGroupOrItemAction($request)
    {
        $sid = Session::getUserOrGuestSession();
        if ($this->request->valueExists('del')) {            
            $isdeleted = $this->otapilib->RemoveItemFromNote($sid, $this->request->get('del'));
            
        }
        if($this->request->valueExists('delGroup')){            
            $itms = explode("|", $this->request->get('delGroup'));
            foreach ($itms as $key => $value) {
                $isdeleted = $this->otapilib->RemoveItemFromNote($sid, $value); 
            }			            
        }
        $this->userData->ClearUserDataCache();
        self::LocationRedirect('index.php?p=supportlist');
    }

    static function removeItem($otapilib, $id)
    {       
        $otapilib->RemoveItemFromNote(Session::getUserOrGuestSession(), $id);
        $userData = new UserData();
        $userData->ClearUserDataCache();
    }

    static function editItemQuantity($otapilib, $id, $quantity)
    {
        $sid = Session::getUserOrGuestSession();
        $res = $otapilib->EditNoteItemQuantity($sid, $id, $quantity);
        if ($res) {
            print json_encode($otapilib->GetNote($sid));
        }
    }

    static function editItemComment($otapilib, $id, $comment)
    {
        // удалить файл кеша корзины и избранного
        $fileMysqlMemoryCache = new FileAndMysqlMemoryCache(new CMS());
        $fileMysqlMemoryCache->DelCacheEl('BatchGetUserData:' . Session::getUserOrGuestSession());

        $fields = '<Fields><FieldInfo Name="Comment" Value="' . $comment . '"/></Fields>';

        return $otapilib->EditNoteItemFields(Session::getUserOrGuestSession(), $id, $fields);
    }

    static function moveToBasket($id)
    {
        global $otapilib;
        $sid = Session::getUserOrGuestSession();
        $otapilib->MoveItemFromNoteToBasket($sid, $id);
        $userData = new UserData();
        $userData->ClearUserDataCache();
        return true;
    }
	public static function LocationRedirect($url) 
	{		
        header("Location: $url");
        die();
    }
}
