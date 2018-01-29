<?php
/**
 * Правило Float для валидатора.
**/
class Float implements IRule
{
    protected $message;

    public function test($value)
    {
        if (! is_numeric($value) || !($value == floatval($value))) {
            $this->message = 'Значение не является числом с плавающей точкой';
        }

        return is_null($this->message);
    }

    public function getMessage()
    {
        return $this->message;
    }
}
