<?php
class UsrHistoryGen extends GenerateBlock {

    protected $_cache = false; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'usrhistorynew'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/main/';

	public function __construct() {
        parent::__construct(true);
    } 
	
	protected function setVars() {				      			
		try{
	    	$cms = new CMS();
        	$status = $cms->Check();
			if ($status)
        	{
				$cms->checkTable('userhistory');
				//Выдираем из базы данные по последним просмотренным
				$usrlogin = $_SESSION[CFG_SITE_NAME.'loginUserData']['username'];
				$res = mysql_query('SELECT * FROM `userhistory` WHERE `user` = "' . $usrlogin . '" ORDER BY `tme` DESC ');
				while ($row = mysql_fetch_assoc($res)) {
                	$tmp['id'] = $row['id'];
					$tmp['name'] = $row['name'];
					$tmp['price'] = $row['price'];
					$tmp['pic'] = $row['pic'];
					$userhistory[]=$tmp;
            	}
				$this->tpl->assign('userhistory', $userhistory);
			}
		}			
		catch(ServiceException $e){
    		Session::setError($e->getMessage(), $e->getErrorCode());
		}
		catch(Exception $e){
   			Session::setError($e->getMessage(), $e->getCode());
		}
	}	
	
}

class UsrHistory  {
    public static function ShowHistory(){ 	       
		 $p = new UsrHistoryGen();
		 print $p->Generate();		 
    }
	
	public static function AddItemHistory($nme,$id,$price,$pic){ 	       
		try{
			$cms = new CMS();
        	$status = $cms->Check();
			if ($status)
        	{
				$cms->checkTable('userhistory');
				//Добавляем в базу	
				$usrlogin = $_SESSION[CFG_SITE_NAME.'loginUserData']['username'];
				//проверка на старину	
				//Сколько уже помним
				$res = mysql_query('select count(name) from `userhistory` WHERE `user` = "' . $usrlogin . '"');
				$row  = mysql_fetch_array($res);
				$history_count = $row[0];	
				
				//проверяем смотрели ли ранее эу модель
				$res = mysql_query('select count(name) from `userhistory` WHERE `user` = "' . $usrlogin . '" AND `id` = "' . $id . '"');
				$row  = mysql_fetch_array($res);
				$view = $row[0];	
				if ($view==1) {
					//Смотрели
					mysql_query("UPDATE `userhistory` SET `tme` = '" . time() . "' WHERE `user` = '" . $usrlogin . "' AND `id` = '" . $id . "'");
				} else {	
					// Не смотрели		
					//Если меньше 10 то просто добавляем, если больше то обновляем самую старую
					if ($history_count<10) {
						mysql_query("INSERT INTO `userhistory` (`user`, `id` , `name` , `price` , `pic`, `tme`) VALUES ('" . $usrlogin . "','" . $id . "','" . $nme . "','" . $price . "','" . $pic . "','" . time() . "');");
					} else {
						$res = mysql_query('select id from `userhistory` WHERE `user` = "' . $usrlogin . '" ORDER BY `tme` ASC');
						$row  = mysql_fetch_array($res);
						$old_id = $row[0];
						mysql_query("UPDATE `userhistory` SET `id` = '" . $id . "' , `name` = '" . $nme . "' , `price` = '" . $price . "' , `pic` = '" . $pic . "', `tme` = '" . time() . "' WHERE `user` = '" . $usrlogin . "' AND `id` =  '" . $old_id . "' ");
					}
				}
				
			}
		}
		catch(ServiceException $e){
    		Session::setError($e->getMessage(), $e->getErrorCode());
		}
		catch(Exception $e){
   			Session::setError($e->getMessage(), $e->getCode());
		}		 
		 
    }
	
}


?>