<?php

/**
 * Избранные продавцы
 */
class FavouriteVendors extends GenerateBlock
{
    protected $_cache = false; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'favourite_vendors'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/main/'; //- путь к шаблону

    public function __construct(){
        global $otapilib;
        $otapilib->setErrorsAsExceptionsOn();
        parent::__construct();
    }

    /**
     * Получение списка продавцов
     */
    public function setVars(){
        global $otapilib;
        $vendors = array();

        $sid = Session::getUserOrGuestSession();

        try{
            $vendors = $otapilib->GetFavoriteVendors($sid);
        }
        catch(ServiceException $e){
            show_error($e->getMessage());
        }

        $this->tpl->assign('list', $vendors);
    }

    /**
     * Добавление продавца в избранное
     * @param string $id
     * @throws ServiceException
     */
    public function addAction($id){
        global $otapilib;

        $sid = Session::getUserOrGuestSession();

        try{
            $vendor = $otapilib->GetVendorInfo($id);
            $otapilib->AddVendorToFavorites($sid, $id, $this->generateAddXml($vendor));
        }
        catch(ServiceException $e){
            header('HTTP/1.1 500 ' . $e->getErrorCode());
            die($e->getMessage());
        }
        catch(Exception $e){
            header('HTTP/1.1 500 Site Error');
            die($e->getMessage());
        }
    }

    /**
     * Удаление продавца из избранного
     * @param string $id
     * @throws ServiceException
     */
    public function deleteAction($id){
        global $otapilib;
        $sid = Session::getUserOrGuestSession();

        try{
            $otapilib->RemoveVendorFromFavorites($sid, $id);
        }
        catch(ServiceException $e){
            Session::setError($e->getMessage(), $e->getErrorCode());
        }
        catch(Exception $e){
            Session::setError($e->getMessage(), $e->getCode());
        }
        header('Location: /favourite_vendors');
    }

    /**
     * Формирование XML для добавления продавца в избранное
     * @param array $vendor Информация о продавце
     * @return string итоговый XML
     */
    public function generateAddXml($vendor){
        $xml = new SimpleXMLElement('<Fields></Fields>');

        $fields = array('Id','Name','PictureUrl');
        $ratings = array('PositiveFeedbacks','TotalFeedbacks','Score', 'Level');
        foreach($fields as $field){
            $el = $xml->addChild('FieldInfo');
            $el->addAttribute('Name', htmlspecialchars($field));
            $el->addAttribute('Value', htmlspecialchars($vendor[$field]));
        }
        foreach($ratings as $field){
            $el = $xml->addChild('FieldInfo');
            $el->addAttribute('Name', htmlspecialchars($field));
            $el->addAttribute('Value', htmlspecialchars($vendor['Credit'][$field]));
        }

        return $xml->asXML();
    }
}
