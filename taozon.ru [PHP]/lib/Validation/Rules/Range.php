<?php

/**
 * Проверка принадлежности диапазону значений
 */

class Range implements IRule
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
            if ($value < $this->min) {
                return false;
            }
        }

        if (!is_null($this->max)) {
            if ($value > $this->max) {
                return false;
            }
        }

        return true;
    }

    public function getMessage()
    {
        return 'Значение должно быть' .
               (is_null($this->min)?'':' от ' . $this->min) .
               (is_null($this->max)?'':' до ' . $this->max);
    }
}