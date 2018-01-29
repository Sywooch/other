<?

class WebCron
{
    public function Process()
    {
        $last_time = @file_get_contents('cache/cron.txt');
        //if (!empty($last_time) && $last_time > time()-10*1) return; // 10 секунд
        if (!empty($last_time) && $last_time > time()-60*10) return; // 10 минут
        set_time_limit(10);
        ini_set('max_execution_time', 10);
        WebCron::InProgress();
        
        // Проверка смены статусов заказов и рассылка емайлов
        $this->CheckChangeStatuses();
    }
    
    public function CheckChangeStatuses()
    {
        // Только для залогиненых
        if(@$_SESSION[CFG_SITE_NAME.'loginUserData']['IsAuthenticated'])
        {
            $sid = $_SESSION[CFG_SITE_NAME.'loginUserData']['sid'];
        } else {
            return;
        }
        // Если нечего отсылать - выходим без дергания отапи
        if (isset($_SESSION['WebCron::CheckChangeStatuses']) && $_SESSION['WebCron::CheckChangeStatuses'] == 'skip') return;
        global $otapilib;
        $data = $otapilib->GetOrdersHistory($sid);
        if (empty($data))
        {
            $_SESSION['WebCron::CheckChangeStatuses'] = 'skip';
        } else {
            $_SESSION['WebCron::CheckChangeStatuses'] = 'work';
        }
        foreach($data as $notification)
        {
            require_once('admin/utils/Users.class.php');
            Users::sendEmailChangeStatus ($notification['OldStatus']['Name'], $notification['NewStatus']['Name'], '', 
                $notification['OrderId'],  $notification['OrderLineId'], $notification['UserInfo']['Email']);
            $otapilib->ClearOrdersHistory($sid, $notification['Id']);
        }
    }
    
    static function InProgress()
    {
        file_put_contents('cache/cron.txt', time());
    }
}

?>