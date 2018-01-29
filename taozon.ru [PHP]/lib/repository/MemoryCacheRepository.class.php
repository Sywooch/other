<?php
class MemoryCacheRepository extends Repository 
{
    public function Add($key, $cacheEntity, $lifeTime)
    {
        $key = $this->cms->escape($key);
        $this->cms->query("REPLACE INTO `memory_cache` SET `session_id` = '$key', `cache_entity` = '$cacheEntity',
            `expires` = " . (time()+$lifeTime));
    }

    public function DeleteOld()
    {
        $oldFiles = $this->cms->queryMakeArray("SELECT * FROM `memory_cache` WHERE `expires` <= " . time());
        $this->cms->query("DELETE FROM `memory_cache` WHERE `expires` <= " . time());
        return $oldFiles;
    }

    public function IsValid($key)
    {
        $key = $this->cms->escape($key);
        $isValid = $this->cms->querySingleValue("SELECT COUNT(*) FROM `memory_cache` WHERE `session_id` = '$key'
            AND `expires` > " . time());
        return $isValid;
    }
    
    /**
     * Продлевает время жизни кэша
     */
    public function updateLifeTime($key, $ttl = 600)
    {
        $key = $this->cms->escape($key);
        $this->cms->query("UPDATE `memory_cache` SET `expires` = " . (time()+$ttl) . " WHERE `session_id` = '$key'");
    }
}
