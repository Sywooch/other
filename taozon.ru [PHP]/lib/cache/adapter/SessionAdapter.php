<?php

OTBase::import('system.lib.Session');
OTBase::import('system.lib.cache.adapter.CacheAdapterInterface');

class SessionAdapter implements CacheAdapterInterface
{
    public function drop($key)
    {
        Session::clear($key);
    }

    public function get($key)
    {
        $data = Session::get($key);
        return $this->isSerialized($data) ? unserialize($data) : $data;
    }

    public function has($key)
    {
        return !! Session::get($key);
    }

    public function set($data, $key, $ttl)
    {
        Session::set($key, is_string($data) ? $data : serialize($data));
    }

    private function isSerialized($string)
    {
        return ($string == serialize(false) || @unserialize($string) !== false);
    }
}