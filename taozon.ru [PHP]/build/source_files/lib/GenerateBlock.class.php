<?php
class GenerateBlock
{
    //в наследнике должны быть определены следующие свойства
    
    protected $_cache = false; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = ''; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = ''; //- путь к шаблону
    
    /**
     * @var HSTemplate
     */
    protected $tpl;

    /**
     * Конструктор класса.
     *
     */
    public function __construct()
    {
        $this->initTemplate();
        if ((isset($this->_cache)) && ($this->_cache == true))
        {
            $this->initCache();
        }
    }

    protected function initCache()
    {
        //
        global $otapilib;
        if(!$otapilib->error_message)
    	    $this->tpl->setCache($this->_template.@$this->_hash, $this->_life_time);
    }

    protected function initTemplate()
    {
        //
        global $HSTemplate;
        $this->tpl = $HSTemplate->getDisplay($this->_template, true);
    }

    /**
     * Генерит блок для странички.
     *
     * @return string
     */
    public function Generate($args = false)
    {
        if (!$this->tpl->isCached())
        {
            if (method_exists($this, 'setVars'))
            {
                $this->setVars($args);
            }
            $tpl = CFG_TPL_ROOT . $this->_template_path;
            if (!file_exists($tpl.$this->_template.'.html'))
            {
                $tpl = CFG_BASE_TPL_ROOT . $this->_template_path;
            }
            //print $tpl.$this->_template.'.html<br><br>';
            $this->tpl->addTemplate($this->_template, $this->_template.'.html', $tpl);
        }
        if ((isset($this->_cache)) && ($this->_cache == false))
        {
            $this->tpl->unsetCache($this->_template.@$this->_hash);
        }
        return $this->tpl->fetch();
    }

}
?>