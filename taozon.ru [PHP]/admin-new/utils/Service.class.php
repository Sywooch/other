<?php
class Service extends GeneralUtil {
    protected $_cache = false;
    protected $_life_time = 3600;
    protected $_template = 'add_inline_field';
    protected $_template_path = 'service/';

    public function addInlineFieldAction(){
        $langsXML = simplexml_load_file(BASE_ADMIN_PATH . 'langs/ru.xml');

        print $this->fetchTemplate();
    }
}