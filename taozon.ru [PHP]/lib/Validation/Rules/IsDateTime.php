<?php

class IsDateTime implements IRule {
    protected $message;

    public function test($value)
    {
        if (!($value instanceof DateTime)) {
            $this->message = 'Значение не является объектом даты/временем';
            return false;
        } else {
            return true;
        }
    }

    public function getMessage()
    {
        return $this->message;
    }
}
