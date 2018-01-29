<?php

OTBase::import('system.model.data_mappers.NewsletterMapper');
OTBase::import('system.model.data_mappers.SubscriberMapper');
OTBase::import('system.admin-new.controllers.*');

// НЕ УБИРАТЬ
// Это надо для супер-рассылок агентов, которые вставляют картинки base64-encoded
ini_set('memory_limit', '512M');

class Newsletters extends GeneralUtil {
    protected $_template = 'list';
    protected $_template_path = 'newsletters/';

    public function __construct()
    {
        parent::__construct();
        $this->dataMappper = new NewsletterMapper($this->cms);
        $this->entitiesList = new EntitiesList($this->dataMappper);
    }

    /**
     * @param RequestWrapper $request
     */
    public function defaultAction($request)
    {

        $newslettersPaginated = $this->entitiesList->getPaginatedList($request->getValue('page'), $request->getValue('perPage'));

        $this->tpl->assign('newsletterMapper', $this->dataMappper);
        $this->tpl->assign('newsletters', $newslettersPaginated['content']);
        $this->tpl->assign('totalCount', $newslettersPaginated['totalCount']);
        $this->tpl->assign('perPage', $newslettersPaginated['perPage']);
        $this->tpl->assign('paginator', new Paginator($newslettersPaginated['totalCount'], $newslettersPaginated['page'], $newslettersPaginated['perPage']));

        print $this->fetchTemplate();
    }

    /**
     * @param RequestWrapper $request
     */
    public function addAction($request)
    {
        $this->_template = 'edit_form';
        $newsletter = new NewsletterEntity();
        $this->tpl->assign('newsletter', $newsletter);
        print $this->fetchTemplate();
    }

    /**
     * @param RequestWrapper $request
     */
    public function editAction($request)
    {
        $this->_template = 'edit_form';
        $newsletter = $this->dataMappper->findById($request->getValue('id'));
        $this->tpl->assign('newsletter', $newsletter);
        print $this->fetchTemplate();
    }

    /**
     * @param RequestWrapper $request
     */
    public function deleteAction($request)
    {
        try {
            $this->dataMappper->remove($request->getValue('id'));
            $this->redirect('index.php?cmd=Newsletters');
        } catch (Exception $e) {
            Session::setError($e->getMessage());
            $this->redirect($request->env('HTTP_REFERER'));
        }
    }

    /**
     * @param RequestWrapper $request
     * @throws Exception
     */
    public function saveAction($request)
    {
        try {
            if ($request->getValue('id')) {
                $newsletter = $this->dataMappper->findById($request->getValue('id'));
            } else {
                $newsletter = new NewsletterEntity();
            }

            $newsletter->setTitle($request->getValue('title'));
            $newsletter->setText($request->getValue('text'));
            if ($request->getValue('send')) {
                $newsletter->setIsBeingSent(true);
            }

            $this->dataMappper->save($newsletter);
            $this->redirect('index.php?cmd=Newsletters');
        } catch (Exception $e) {
            Session::setError($e->getMessage());
            $this->redirect($request->env('HTTP_REFERER'));
        }
    }

    /**
     * @param RequestWrapper $request
     */
    public function configAction($request)
    {
        $this->_template = 'config';
        print $this->fetchTemplate();
    }

    /**
     * @param RequestWrapper $request
     */
    public function saveConfigAction($request)
    {
        $siteConfigRepository = new SiteConfigurationRepository($this->cms);
        foreach ($request->getAll() as $name => $value) {
            $siteConfigRepository->Set($name, $value);
        }
        $this->redirect($request->env('HTTP_REFERER'));
    }

    /**
     * @param RequestWrapper $request
     */
    public function testAction($request)
    {
        try {
            if (!General::getConfigValue('newsletter_from_email')) {
                throw new Exception('Не задан email отправителя в настройках рассылок');
            }
            if (!General::getConfigValue('newsletter_from_name')) {
                throw new Exception('Не задано имя отправителя в настройках рассылок');
            }
            if (!$request->getValue('test-email')) {
                throw new Exception('Не задан email получателя');
            }

            General::mail_utf8($request->getValue('test-email'), General::getConfigValue('notification_send_from_name'),
                General::getConfigValue('notification_send_from'), $request->getValue('title'),
                $request->getValue('text'));
            $this->sendAjaxResponse(array('error' => 'Ok'));
        } catch (Exception $e) {
            $this->respondAjaxError($e);
        }
    }
}