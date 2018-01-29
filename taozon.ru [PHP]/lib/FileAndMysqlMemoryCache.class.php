<?php

class FileAndMysqlMemoryCache implements ICache {
    /**
     * @var CMS
     */
    protected $cms;

    /**
     * @var MemoryCacheRepository
     */
    protected $memoryCache;

    /**
     * @param CMS $cms
     */
    public function __construct($cms){
        $this->cms = $cms;
        $this->cms->checkTable('memory_cache');

        $this->memoryCache = new MemoryCacheRepository($this->cms);

        if(rand(0,1000) < 10){
            $oldCacheFiles = $this->memoryCache->DeleteOld();
            foreach($oldCacheFiles as $f){
                $this->DelCacheEl($f['cache_entity'].':'.$f['session_id']);
            }
        }
    }

    public function AddCacheEl($key, $life_time = 21600, $value){
        list($cacheDir, $cacheFile, $realKey, $cacheEntity) = $this->GetCacheDirAndFileNameFromKey($key);

        $createDirResult = !file_exists($cacheDir) ? mkdir($cacheDir, 0777, true) : true;
        if(!$createDirResult)
            throw new Exception('Cache dir was not created');

        file_put_contents($cacheDir . '/' . $cacheFile, $value);

        $this->memoryCache->Add($realKey, $cacheEntity, $life_time);
    }

    public function DelCacheEl($key)
    {
        list($cacheDir, $cacheFile) = $this->GetCacheDirAndFileNameFromKey($key);
        if(file_exists($cacheDir . '/' . $cacheFile)){
            unlink($cacheDir . '/' . $cacheFile);
        }
        if(file_exists($cacheDir) && count(scandir($cacheDir)) == 2){
            rmdir($cacheDir);
        }
    }

    public function GetCacheEl($key)
    {
        list($cacheDir, $cacheFile) = $this->GetCacheDirAndFileNameFromKey($key);
        return file_get_contents($cacheDir . '/' . $cacheFile);
    }

    public function Exists($key){
        list($cacheDir, $cacheFile, $realKey) = $this->GetCacheDirAndFileNameFromKey($key);
        return file_exists($cacheDir . '/' . $cacheFile) && $this->memoryCache->IsValid($realKey);
    }

    private function GetCacheDirAndFileNameFromKey($key){
        list($directory, $cacheKey) = explode(':', $key);
        $cacheKeyHash = md5($cacheKey);

        $cacheDir = CFG_APP_ROOT . '/cache/' . $directory . '/' . substr($cacheKeyHash, 0, 2) . '/' . substr($cacheKeyHash, 2, 2);

        return array(
            $cacheDir,
            $cacheKeyHash . '.dat',
            $cacheKey,
            $directory
        );
    }
    
    /**
     * Продлевает время жизни кэша
     */
    public function updateLifeTime($key, $ttl = 600)
    {
        $this->memoryCache->updateLifeTime($key, $ttl);
    }
}