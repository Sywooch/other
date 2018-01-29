<?php

class Regexp implements IRule
{
    protected $regexp;

    public function __construct($regexp)
    {
        $this->regexp = $regexp;
    }

    public function test($value)
    {
        return preg_match($this->regexp, $value);
    }

    public function getMessage()
    {
        return 'Значение не подходит под формат';
    }
}