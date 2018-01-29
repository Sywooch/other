<?php
class TranslationsRepository extends Repository {
    /**
     * @var CMS
     */
    protected $cms;
    /**
     * @var LanguageRepository
     */
    protected $languageRepository;

    private $languages = array();

    public function __construct($cms){
        parent::__construct($cms);
        $this->languageRepository = new LanguageRepository($cms);
        $this->languages = $this->languageRepository->GetLanguages();
    }

    public function GetAllTranslationsByLangCodes(){
        $result = array();
        foreach($this->languages as $lang){
            $fromFile = $this->GetTranslationsFromFile($lang['lang_code']);
            $fromDB = $this->GetAllTranslationsFromDBByLang($lang['lang_code']);
            $result[$lang['lang_code']] = $this->MergeFileAndDBTranslations($fromFile, $fromDB);
        }
        return $result;
    }

    public function GetTranslationsFromFile($lang){
        $filePath = dirname(dirname(dirname(__FILE__))) . '/langs/'.$lang.'.xml';
        if(file_exists($filePath)){
            $result = array();
            $translations = simplexml_load_file($filePath);
            foreach($translations->key as $t){
                $result[(string)$t['name']] = array(
                    'translation' => (string)$t,
                    'from' => 'box'
                );
            }
            return $result;
        }
        else{
            return array();
        }
    }

    public function GetAllTranslationsFromDBByLang($langCode){
        $code = $this->cms->escape($langCode);
        return $this->cms->queryMakeArray("
            SELECT `sl`.`lang_code`, `sk`.`name` as `key`, `st`.`translation`
            FROM `site_translations` `st`
                INNER JOIN `site_langs` `sl` ON `sl`.`id` = `st`.`langid`
                INNER JOIN `site_translation_keys` `sk`  ON `sk`.`id` = `st`.`key`
            WHERE `sl`.`lang_code` = '$code'
        ", array('site_translations', 'site_langs', 'site_translation_keys'));
    }

    public function GetAllTranslationsFromDB(){
        return $this->cms->queryMakeArray("
            SELECT `sl`.`lang_code`, `sk`.`name` as `key`, `st`.`translation`
            FROM `site_translations` `st`
                INNER JOIN `site_langs` `sl` ON `sl`.`id` = `st`.`langid`
                INNER JOIN `site_translation_keys` `sk`  ON `sk`.`id` = `st`.`key`
        ", array('site_translations', 'site_langs', 'site_translation_keys'));
    }

    private function MergeFileAndDBTranslations($fromFile, $fromDB){
        $result = $fromFile;
        foreach($fromDB as $translation){
            $result[$translation['key']] = array(
                'translation' => (string)$translation['translation'],
                'from' => 'db'
            );
        }
        return $result;
    }

    public function GetAllTranslationsByKeys(){
        $result = array();
        $transByCodes = $this->GetAllTranslationsByLangCodes();

        foreach($transByCodes as $langCode => $transList){
            foreach($transList as $transKey => $trans){
                if(!isset($result[$transKey]))
                    $result[$transKey] = $this->GetTemplateArrayForKey();
                $result[$transKey][$langCode] = $trans;
            }
        }

        return $result;
    }

    private function GetTemplateArrayForKey(){
        $result = array();
        foreach($this->languages as $lang){
            $result[$lang['lang_code']] = array();
        }
        return $result;
    }

    public function DeleteTranslationsByKeyFromDB($code){
        $codeSafe = $this->cms->escape($code);
        $this->cms->query("
            DELETE FROM `site_translations`
            WHERE `key` IN (
                SELECT `id` FROM `site_translation_keys` WHERE `name` = '$codeSafe'
            )
       ");
    }

    public function GetTranslationsByKey($key){
        $code = $this->cms->escape($key);
        return $this->cms->queryMakeArray("
            SELECT `st`.`translation`, `sl`.`lang_code`
            FROM `site_translations` `st`
                INNER JOIN `site_langs` `sl` ON `sl`.`id` = `st`.`langid`
                INNER JOIN `site_translation_keys` `sk`  ON `sk`.`id` = `st`.`key`
            WHERE `sk`.`name` = '$code'
        ", array('site_translations', 'site_langs', 'site_translation_keys'));
    }

    public function AddTranslation($key, $translations){
        $keyId = $this->AddKey($key);
        foreach($translations as $lang=>$trans){
            $this->AddTranslationForLang($keyId, $lang, $trans);
        }
    }

    private function AddKey($key){
        $keySafe = $this->cms->escape($key);
        $exists = $this->cms->querySingleValue("
            SELECT COUNT(*) FROM `site_translation_keys` WHERE `name`='$keySafe'
        ");

        if($exists)
            return $this->cms->querySingleValue("
                    SELECT `id` FROM `site_translation_keys` WHERE `name`='$keySafe'
                ");

        $this->cms->query("INSERT INTO `site_translation_keys` SET `name`='$keySafe'");
        return $this->cms->insertedId();
    }

    private function AddTranslationForLang($keyId, $lang, $trans){
        if($trans){
            $langSafe = $this->cms->escape($lang);
            $q = $this->cms->querySingleValue("SELECT COUNT(`id`) FROM `site_langs` WHERE `lang_code`='$langSafe'");
            if(!$q)
                throw new Exception(LangAdmin::get('language_was_not_found'));

            $langId = $this->cms->querySingleValue("SELECT `id` FROM `site_langs` WHERE `lang_code`='$langSafe'");
            $transSafe = $this->cms->escape($trans);

            $this->cms->query("DELETE FROM `site_translations` WHERE `langid`='$langId' AND `key`='$keyId'");
            $this->cms->query("INSERT INTO `site_translations` SET `langid`='$langId', `key`='$keyId', `translation`='$transSafe'");
        }
    }
}