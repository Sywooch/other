<?php
/**
 * Правило Int для валидатора.
**/
class Int implements IRule
{
    protected $message;

    public function test($value)
    {
        if (! is_numeric($value) || !($value == intval($value))) {
            $this->message = 'Значение не является целым числом';
        }

        return is_null($this->message);
    }

    public function getMessage()
    {
        return $this->message;
    }
}
