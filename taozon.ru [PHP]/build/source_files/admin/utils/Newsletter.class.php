<?php

class Newsletter  extends GeneralUtil{
	protected $_cache = false;
	protected $_life_time = 3600;
	protected $_template = 'index';
	protected $_template_path = 'subscribe/';
	/**
     * Public
     */
    public function defaultAction()
    {
		global $otapilib;
		$sid = @$_SESSION['sid'];
		$webui = $otapilib->GetWebUISettings($sid);
		if ($otapilib->error_message == 'SessionExpired' || $sid == '')
		{
			header('Location: index.php?expired');
			die;
		}
		if(!CMS::IsFeatureEnabled('Newsletter')){
			header('Location: index.php');
			die;
		}
		if (isset($_SESSION['arSubFilter'])&&!isset($_REQUEST['clearFilter']))
			$arFilter=$_SESSION['arSubFilter'];
		else
        	$arFilter=array();
		if (isset($_POST['submit'])){
			switch($_POST['submit']){
				case 'save':
						$this->_SavePublication($_POST['PublicationTitle'],$_POST['PublicationText']);
					break;
				case 'send':
					$this->_SavePublication($_POST['PublicationTitle'],$_POST['PublicationText']);
					$this->_SendPublication();
					break;
				case 'preview':
					break;
			}
		}
		else
		if (isset($_REQUEST['filter'])){
			if (isset($_REQUEST['filter_email'])) $arFilter['email'] = mysql_real_escape_string($_REQUEST['filter_email']);
			if (isset($_REQUEST['filter_name'])) $arFilter['name'] = mysql_real_escape_string($_REQUEST['filter_name']);
		}
		$_SESSION['arSubFilter'] = $arFilter;
		$perpage=32;
		if (isset($_GET['p']))
			$page=intval($_GET['p']);
		else
			$page=1;
		$from=($page-1)*$perpage;
		$this->tpl->assign('from', $from);
		$this->tpl->assign('perpage', $perpage);
		$this->tpl->assign('page', $page);
		$cms = new CMS();
        $status = $cms->Check();
        if ($status)
        {
			$status = $cms->checkTable('subscription');
			$this->tpl->assign('publication', $this->_GetPublication());
			$this->tpl->assign('needSendTo', $this->_NeedSendPublication());
			$this->tpl->assign('settings', $cms->getSiteConfig());
			$subscribers = $this->GetSubscribers($from,$perpage,$arFilter);
			$count = $subscribers['count'];
			unset($subscribers['count']);
			$this->tpl->assign('subscribers', $subscribers);
			$this->tpl->assign('count', $count);
		} else {
            include(TPL_DIR . 'cms.php');
            die;
        }
		$this->tpl->assign('pageurl', '/admin/index.php?cmd=newsletter');
		print $this->fetchTemplate();
	}
	public function importFormAction()
	{
		$this->_template='import';
		print $this->fetchTemplate();
	}

	public function deleteSubAction()
	{
		global $otapilib;
		$sid = @$_SESSION['sid'];
		if ($otapilib->error_message == 'SessionExpired' || $sid == '')
		{
			header('Location: index.php?expired');
			die;
		}
		$cms = new CMS();
		$status = $cms->Check();
		if ($status)
		{
			$email = mysql_real_escape_string($_GET['email']);
			$this->_DeleteSubscriber($email);
			echo 'Ok';

		}
		die;
	}
	public function saveSubAction()
	{
		global $otapilib;
		$sid = @$_SESSION['sid'];
		$webui = $otapilib->GetWebUISettings($sid);
		if ($otapilib->error_message == 'SessionExpired' || $sid == '')
		{
			die;
		}
		$cms = new CMS();
		$status = $cms->Check();
		if ($status)
		{
			$result = $this->_AddSubscriber($_POST);
			if ($result!==false)
				echo LangAdmin::get('saved');
		}
		die();
	}

	public function menuAction(){
        if (!Login::auth()){
            include(TPL_DIR.'login.php');
            return false;
        } 
        
        $cms = new CMS();
        if (!$cms->Check()){
            include(TPL_DIR . 'db_connection_fail.php');
            die;
        }
        
        $cms->checkTable('site_langs');
        $cms->checkTable('site_translations');
        $cms->checkTable('site_translation_keys');
        $langs = $cms->getLanguages();
        $current_lang = $this->setActiveLang();
        
        $all_docs = $cms->GetPagesByLang($current_lang);
        
        $cms->checkTable('site_blocks');
        $top_menu_json = $cms->getBlock('top_menu_'.$current_lang);
        
        $top_menu = array();
        if($top_menu_json){
            $top_menu = json_decode($top_menu_json);
        }
        
        include(TPL_DIR . 'menu/index.php');
    }

	private function GetSubscribers($from=0,$perpage=false,$arFilter=array(),$subscribe='news'){
		CMS::Check();
		$filter=array();
		if (isset ($arFilter['name'])&&!empty($arFilter['name']))
			$filter[]='`name` like "%'.$arFilter['name'].'%"';
		if (isset ($arFilter['email'])&&!empty($arFilter['email']))
			$filter[]='`email` like "%'.$arFilter['email'].'%"';
		$where='';
		if (!empty($filter))
			$where = ' AND '.implode(' AND ',$filter);
		$result=array();
		if ($perpage)
			$res = mysql_query('SELECT `user_id`,`email`,`name` FROM `subscription` WHERE `subscription`="'.$subscribe.'" '.$where.' ORDER BY `date` DESC LIMIT '.$from.','.$perpage);
		else
			$res = mysql_query('SELECT `user_id`,`email`,`name` FROM `subscription` WHERE `subscription`="'.$subscribe.'" '.$where.' ORDER BY `date` DESC ');
		while($row = mysql_fetch_assoc($res)){
			$result[]=array(
				'id'=>$row['user_id'],
				'email'=>$row['email'],
				'name'=>$row['name'],
			);
		}
		$res = mysql_query('SELECT COUNT(`email`) as count FROM `subscription` WHERE `subscription`="'.$subscribe.'" '.$where.' ');
		if(is_resource($res) && $row = mysql_fetch_assoc($res))
			$result['count']=$row['count'];
		else
			$result['count']=0;
		return $result;
	}
	private function _DeleteSubscriber($userEmail,$subscribe='news'){
		CMS::Check();
		$res = mysql_query('DELETE FROM `subscription` WHERE `subscription`="'.$subscribe.'" AND email="'.$userEmail.'"');
		return $res;
	}
	private function _SendPublication($subscribe='news'){
		CMS::Check();
		$res = mysql_query('UPDATE `subscription` SET `send`=1 WHERE `subscription`="'.$subscribe.'"');
		return $res;
	}
	private function _AddSubscriber($data,$subscribe='news'){
		CMS::Check();
		$data['email']=mysql_real_escape_string($data['email']);
		$data['name']=mysql_real_escape_string($data['name']);
		$arFields = array('subscription','email','name','date');
		$arInsert = array($subscribe,$data['email'],$data['name'],date('Y.m.d'));
		if (isset($data['id'])){
			$data['id']=mysql_real_escape_string($data['id']);
			$arFields[] = 'user_id';
			$arInsert[] = $data['id'];
		}
		$res = mysql_query('INSERT INTO `subscription`('.implode(',',$arFields).')'.
			' VALUES("'.implode('","',$arInsert).'") ON DUPLICATE KEY UPDATE'.
			' name="'.$data['name'].'"');
		return $res;
	}
	private function _SavePublication($title,$text,$subscribe='news'){
		file_put_contents(CFG_APP_ROOT.'/cache/'.$subscribe.'Publication.dat', serialize(array('title'=>$title,'text'=>$text)));
	}
	private function _GetPublication($subscribe='news'){
		if (file_exists(CFG_APP_ROOT.'/cache/'.$subscribe.'Publication.dat'))
			return unserialize(file_get_contents(CFG_APP_ROOT.'/cache/'.$subscribe.'Publication.dat'));
		else
			return array('title'=>'','text'=>'');
	}
	private function _NeedSendPublication($subscribe='news'){
		CMS::Check();
		$res = mysql_query('SELECT COUNT(`email`) as count FROM `subscription` WHERE `subscription`="'.$subscribe.'" AND send=1');
		if($row = mysql_fetch_assoc($res))
			return $row['count'];
		return 0;
	}
	public function saveSettingsAction(){
		if(!$this->checkAuth()) return false;
		foreach ($_POST as $key=>$value){
			$_POST[$key] = trim($value);
		}
		$errors=array();
		if (!isset($_POST['send_count'])||!is_numeric($_POST['send_count']))
			$errors['send_count']='Y';
		if (isset($_POST['smtp'])){
			if (!isset ($_POST['smtp_host'])||empty ($_POST['smtp_host']))
				$errors['smtp_host']='Y';
			if (!isset ($_POST['smtp_port'])||empty ($_POST['smtp_port']))
				$errors['smtp_port']='Y';
			if (!isset ($_POST['smtp_user'])||empty ($_POST['smtp_user']))
				$errors['smtp_user']='Y';
			if (!isset ($_POST['smtp_password'])||empty ($_POST['smtp_password']))
				$errors['smtp_password']='Y';
		}
		if (!empty($errors)){
			$this->tpl->assign('errors', $errors);
			$_REQUEST['active_tab']=3;
			$this->defaultAction();
			return;
		}
		if(!$this->cmsStatus)
			return $this->setErrorAndRedirect(LangAdmin::get('error_connecting_to_database'),
				'index.php?cmd=newsletter&active_tab=3');
		if (!isset($_POST['smtp'])) $_POST['smtp']=0;
		if (!isset($_POST['smtp_ssl'])) $_POST['smtp_ssl']=0;
		$this->cms->saveSiteConfig($_POST);
		header('Location: index.php?cmd=newsletter&active_tab=3');
	}

	public function exportAction(){
		@define('NO_DEBUG', 1);

		if (!Login::auth()){
			include(TPL_DIR.'login.php');
			return false;
		}
		$cms = new CMS();
		if (!$cms->Check()){
			include(TPL_DIR . 'db_connection_fail.php');
			die;
		}
		$fileName='subscribe';
		$subscribers = $this->GetSubscribers();
		unset ($subscribers['count']);
		$xml = new SimpleXMLElement('<translations/>');
		foreach($subscribers as $t){
			$el = $xml->addChild('key', htmlspecialchars($t['name']));
			$el->addAttribute('email', htmlspecialchars($t['email']));
			$el->addAttribute('id', htmlspecialchars($t['id']));
		}

		$dom = dom_import_simplexml($xml)->ownerDocument;
		$dom->formatOutput = true;
		file_put_contents('../files/'.$fileName.'.xml',$dom->saveXML());
		$file = '../files/'.$fileName.'.xml';
		header ("Content-Type: application/octet-stream");
		header ("Accept-Ranges: bytes");
		header ("Content-Length: ".filesize($file));
		header ("Content-Disposition: attachment; filename=".$file);
		readfile($file);
		unlink($file);
	}

	public function importAction(){
		@define('NO_DEBUG', 1);
		if (!Login::auth()){
			include(TPL_DIR.'login.php');
			return false;
		}
		$cms = new CMS();
		if (!$cms->Check()){
			include(TPL_DIR . 'db_connection_fail.php');
			die;
		}
		$fileName='subscribe';
		if (isset($_FILES['import_file'])&&$_FILES['import_file']['error']==0){
			if (end(explode(".", $_FILES['import_file']['name']))=='xml'){
				move_uploaded_file($_FILES['import_file']['tmp_name'], '../files/'.$fileName.'.xml');
			}
		}

		if(file_exists('../files/'.$fileName.'.xml')){
			$xml = simplexml_load_file('../files/'.$fileName.'.xml');
			foreach($xml->key as $k){
				$res = $this->_AddSubscriber(array('name'=>(string)$k[0],'email'=>$k['email'],'id'=>$k['id']));
			}
		}
		unlink('../files/'.$fileName.'.xml');
		header('Location: index.php?cmd=newsletter&active_tab=2');
	}

}

?>
