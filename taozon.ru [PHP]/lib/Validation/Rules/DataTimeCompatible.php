<?php
/**
 * Правило DataTimeCompatible для валидатора.
**/
class DataTimeCompatible implements IRule
{
    protected $message;

    public function test($value)
    {
        try {
            new DateTime($value);
        } catch (Exception $e) {
            $this->message = 'Значение не является корректной датой/временем';
        }

        return is_null($this->message);
    }

    public function getMessage()
    {
        return $this->message;
    }
}
