<?php

class OldSubscribersRepository extends Repository
{
    public function findAll()
    {
        return $this->cms->queryMakeArray('SELECT * FROM subscription');
    }
}