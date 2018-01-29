<?php

class ImageSearchLocal extends GenerateBlock
{
protected $_cache = false; //- кэшируем или нет.
protected $_life_time = 3600; //- время на которое будем кешировать
protected $_template = 'imagesearch'; //- шаблон, на основе которого будем собирать блок
protected $_template_path = '/imagesearch/';

protected function setVars()
{ 
//здесь весь php код
}

}