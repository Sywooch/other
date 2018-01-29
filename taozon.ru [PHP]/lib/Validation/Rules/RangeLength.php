<?php

/**
 * Проверка принадлежности диапазону значений длины строки
 */
class RangeLength implements IRule
{
    protected $min = null;
    protected $max = null;
    
    
    public function __construct($min = null, $max = null)
    {
        $this->min = $min;
        $this->max = $max;

    }
    
    public function test($value)
    {
        if (!is_null($this->min)) {
            if (mb_strlen($value) < $this->min) {
                return false;
            }
        }

        if (!is_null($this->max)) {
            if (mb_strlen($value) > $this->max) {
                return false;
            }
        }

        return true;
    }

    public function getMessage()
    {
        return 'Длина строки должна быть' . (is_null($this->min)?'':' от ' . $this->min) . (is_null($this->max)?'':' до ' . $this->max) . ' символов';
    }
}