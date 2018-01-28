<?php
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.view');
jimport('joomla.application.component.content');

class CollectiveViewCollective extends JView
{

    const CONTENT_CATEGORY_ID = 26;
    const CONTENT_STATE = 1;

    const API_KEY = 'cw.1.1.20140612T123842Z.1b418307a178d6c3.1129de8e5775482bcd9e43eaddc02a61c3cef4c1';
    const URL_API = 'http://cleanweb-api.yandex.ru/1.0/';


    public $fieldTitle;
    public $fieldText;
    public $fieldCaptcha;

    public $captchaSrc;


    protected $errors = array();
    protected $messages = array();


    private function createCaptcha()
    {
        $messages = $errors = array();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_URL, self::URL_API . 'get-captcha?' . 'key=' . urlencode(self::API_KEY) . '&id=null&type=estd');
        $response = new SimpleXMLElement(curl_exec($ch));
        $captcha_url = $response->url;
        $captcha_id = (string)$response->captcha;
        curl_close($ch);
        $_SESSION['captcha'] = $captcha_id;
        return $captcha_url;
    }


    private function validateCaptcha($captcha_value)
    {
        $captcha = $_SESSION['captcha'];
        if (isset($_POST['feedback-submit'])) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPGET, true);
            curl_setopt($ch, CURLOPT_URL, self::URL_API . 'check-captcha?' . 'key=' . urlencode(self::API_KEY) . '&id=null&captcha=' . $captcha . '&value=' . $captcha_value . '');
            $response = new SimpleXMLElement(curl_exec($ch));
            if (!isset($response->ok))
                $this->errors[] = 'Неверный защитный код';
            curl_close($ch);
        }
    }

    function display($tpl = null)
    {
        function _f($string)
        {
            return stripslashes(trim(htmlspecialchars($string)));
        }

        $user = JFactory::getUser();

        $created_by = $user->get('id');
        if ($created_by == 0) {
            echo '<h2>Для публикации новостей необходимо выполнить вход<h2>';
            return;
        }

        if (isset($_POST['feedback-submit'])) {

            $this->fieldTitle = isset($_POST['title']) ? _f($_POST['title']) : null;
            $this->fieldText = isset($_POST['text']) ? _f($_POST['text']) : null;
            $this->fieldCaptcha = isset($_POST['captcha']) ? _f($_POST['captcha']) : null;

            if (empty($this->fieldTitle))
                $this->errors['title'] = 'Введите заголовок';

            if (empty($this->fieldText))
                $this->errors['text'] = 'Введите текст';

            if (empty($this->fieldCaptcha))
                $this->errors['captcha'] = 'Введите защитный код';
            else
                $this->validateCaptcha($this->fieldCaptcha);
	    
	    
	    
            if (count($this->errors) == 0) {

                require_once(JPATH_ADMINISTRATOR . '/components/com_content/models/article.php');

                $new_article1 = new ContentModelArticle();
                $new_article = $new_article1->getTable();

                $data = array(
                    // 'id' => false,
                    'title' => $this->fieldTitle,
                    'alias' => $this->generateNewTitle($new_article, (string)self::CONTENT_CATEGORY_ID, $this->fieldTitle),
                    'title_alias'=> $this->generateNewTitle($new_article, (string)self::CONTENT_CATEGORY_ID, $this->fieldTitle),
                    // 'introtext' => $this->fieldText,
                    'fulltext' => $this->fieldText,
                    'state' => self::CONTENT_STATE,
                    'catid' => (string)self::CONTENT_CATEGORY_ID,
                    'created_by' => $created_by,
                    'access' => 1,
                    'asset_id' => 1,
                );

                $new_article->bind($data);

                if (!$new_article->check()) {
                    return false;
                }

                if (!$new_article->store()) {
                    return false;
                }

               if($new_article->save($data))

                $this->messages['success'] = 'Новость опубликована';
                else{
                $this->errors['error'] = 'Новость не опубликована';
            
            var_dump($new_article);die();
            }}

        }

        $this->captchaSrc = $this->createCaptcha();
        parent::display($tpl);
    }


    protected function generateNewTitle($table, $category_id, $title)
    {
        $alias = JFilterOutput::stringURLSafe($title);
        while ($table->load(array('alias' => $alias, 'catid' => $category_id))) {
            $alias = JString::increment($alias, 'dash');
        }
        return $alias;
    }

}