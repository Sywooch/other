<?php

/**
 * Проверка совпадения значения
 */

class Password implements IRule
{
    protected $confirm;
    protected $regex;
    protected $message;
    
    public function __construct($confirm, $regex = null)
    {
        $this->confirm = $confirm;
        $this->regex = $regex;
    }

    public function test($value)
    {
        if(!trim($value)) {
            $this->message = 'Пароль не может быть пустым';
            return false;
        }
        
        if(!is_null($this->regex) && !preg_match($this->regex, $value)) {
            $this->message = 'Неправильный формат пароля';
            return false;
        }
        
        if((string) $value !== (string) $this->confirm) {
            $this->message = 'Пароли не совпадают';
            return false;
        }
        
        return true;
    }

    public function getMessage()
    {
        return $this->message;
    }
}