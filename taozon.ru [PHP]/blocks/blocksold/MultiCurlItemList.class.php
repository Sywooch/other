<?php

class MultiCurlItemList extends GenerateBlock
{
    protected $_cache = CFG_CACHED; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'banners'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/main/';

    public function __construct()
    {
        parent::__construct(true);
    }

    protected function setVars()
    {
        global $otapilib;
        if(CFG_MULTI_CURL){
            $otapilib->InitMulti();
            
            if(isset($_SESSION[CFG_SITE_NAME.'loginUserData'])) $sid = $_SESSION[CFG_SITE_NAME.'loginUserData']['sid'];
            else $sid = session_id();

            $otapilib->BatchGetUserData($sid,'UserStatus,Basket,Note,SearchCategories');
            // Запрашиваем информацию о товарах в категории и передаем её в шаблон
            $cid = $_GET['cid'];
            $tmall = (isset($_GET['tmall']) && ($_GET['tmall'] == 'true')) ? $_GET['tmall'] : '';

            $categoryItemFilter = '<SearchItemsParameters>';
            if (!empty($_GET['cost']['from']))
                $categoryItemFilter .= '<MinPrice>' . $_GET['cost']['from'] . '</MinPrice>';
            if (!empty($_GET['cost']['to']))
                $categoryItemFilter .= '<MaxPrice>' . $_GET['cost']['to'] . '</MaxPrice>';
            if (!empty($_GET['count']['from']))
                $categoryItemFilter .= '<MinQuantity>' . $_GET['count']['from'] . '</MinQuantity>';
            if (!empty($_GET['count']['to']))
                $categoryItemFilter .= '<MaxQuantity>' . $_GET['count']['to'] . '</MaxQuantity>';
            if (!empty($_GET['rating']['from']))
                $categoryItemFilter .= '<MinVendorRating>' . $_GET['rating']['from'] . '</MinVendorRating>';
            if (!empty($_GET['rating']['to']))
                $categoryItemFilter .= '<MaxVendorRating>' . $_GET['rating']['to'] . '</MaxVendorRating>';
            if ($cid)
                $categoryItemFilter .= '<CategoryId>'.$cid.'</CategoryId>';
            if ($tmall)
                $categoryItemFilter .= '<IsTmall>true</IsTmall>';

            if (isset($_GET['filters'])) {
                $categoryItemFilter .= '<Configurators>';
                foreach ($_GET['filters'] as $pid => $vid) {
                    if ($vid && $pid!='StuffStatus')
                        $categoryItemFilter .= '<Configurator Pid="' . $pid . '" Vid="' . $vid . '" />';
                    elseif($pid=='StuffStatus' && $vid){
                        $stuff = '<StuffStatus>'.$vid.'</StuffStatus>';
                    }
                }
                $categoryItemFilter .= '<CategoryMode>Nothing</CategoryMode></Configurators>';
            }
            if (isset($stuff)) {
                $categoryItemFilter .= $stuff;
            }
            if (isset($_GET['sort_by'])) {
                $categoryItemFilter .= '<OrderBy>' . $_GET['sort_by'] . '</OrderBy>';
            }
            $categoryItemFilter .= '</SearchItemsParameters>';
            // Постараничный вывод
            $from = isset($_GET['from']) ? $_GET['from'] : 0;
            $perpage = isset($_GET['per_page']) ? $_GET['per_page'] : 16;
            global $otapilib;

            $otapilib->BatchSearchItemsFrame(session_id(), $categoryItemFilter, $from, $perpage, 'SubCategories,SearchProperties,RootPath');
        
            $otapilib->MultiDo();
        }
    }
}

?>