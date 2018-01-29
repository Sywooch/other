<?php
class XEditableFields {
    private static $fields = array();
    private static $config;
    /**
     * @var AdminUrlWrapper
     */
    private static $pageUrl;

    public static function Init($configName, $pageUrl){
        self::$fields = array();
        self::$config = json_decode(file_get_contents(BASE_ADMIN_PATH . 'cfg/site_configuration/'.$configName.'.json'));
        self::$pageUrl = $pageUrl;
    }

    public static function Register($fieldName, $fieldValue, $parameters = array(), $valuesList = array()){
        try {
            $field = self::SearchFieldConfigByName($fieldName);
            $field->value = stripslashes((string)$fieldValue);
            $field->saveUrl = isset($field->saveUrl) ?
                self::PrepareSaveUrl($field->saveUrl) : self::PrepareDefaultSaveUrl();
            $field = self::LoadNotExistedParametersFromDefaults($field);
            $field->parameters = $parameters;
            if (count($valuesList)) {
                $field->valuesList = $valuesList;
            }
            self::$fields[] = $field;
        }
        catch (NotFoundException $e) {
            echo $e->getMessage();
            die();
        }
    }

    private static function SearchFieldConfigByName($name){
        foreach(self::$config->fields as $field){
            if($field->name == $name){
                return clone $field;
            }
        }
        throw new NotFoundException("Field $name not found in config");
    }

    private static function LoadNotExistedParametersFromDefaults($field){
        $defaults = isset(self::$config->defaultFieldsParameters->{$field->type}) ?
            self::$config->defaultFieldsParameters->{$field->type} : new stdClass();
        foreach($defaults as $key=>$value){
            if(isset($field->{$key}))
                continue;

            if(isset($value->trans))
                $value = LangAdmin::get($value->trans);
            $field->{$key} = $value;
        }
        return $field;
    }

    public static function GetFields(){
        //var_dump(self::$fields);die;
        return self::$fields;
    }

    private static function PrepareDefaultSaveUrl(){
        $defaultUrl = self::$config->defaultSaveUrl;
        return self::$pageUrl->AssignCmdAndDo($defaultUrl->cmd, $defaultUrl->do);
    }

    private static function PrepareSaveUrl($urlData){
        return self::$pageUrl->AssignCmdAndDo($urlData->cmd, $urlData->do);
    }
}