<?php

OTBase::import('system.model.entities.NewsletterMailEntity');
OTBase::import('system.model.data_mappers.Mapper');
OTBase::import('system.lib.Validation.*');
OTBase::import('system.lib.Validation.Rules.*');

class NewsletterMailMapper extends Mapper
{
    protected $tableName = 'newsletters_mails';

    protected $entityType = 'NewsletterMailEntity';

    protected $columnsMap = array(
        'id' => 'id',
        'newsletterId' => 'newsletterId',
        'subscriberId' => 'subscriberId',
        'sent' => 'sent',
        'status' => 'status',
    );

    /**
     * @param NewsletterMailEntity $entity
     */
    protected function createNew($entity)
    {
        $newsletterId = intval($entity->getNewsletterId());
        $subscriberId = intval($entity->getSubscriberId());
        $status = $this->cms->escape($entity->getStatus());
        $this->cms->query('
                INSERT INTO `' . $this->tableName . '` SET
                    newsletterId="' . $newsletterId . '",
                    subscriberId="' . $subscriberId . '",
                    sent="' . date('Y-m-d H:i:s') . '",
                    status="' . $status . '"
                ', array($this->tableName));
    }

    /**
     * @param NewsletterMailEntity $entity
     */
    protected function update($entity)
    {
        $newsletterId = intval($entity->getNewsletterId());
        $subscriberId = intval($entity->getSubscriberId());
        $sent = $entity->getSent()->format('Y-m-d H:i:s');
        $status = $this->cms->escape($entity->getStatus());
        $this->cms->query('
                INSERT INTO `' . $this->tableName . '` SET
                    newsletterId="' . $newsletterId . '",
                    subscriberId="' . $subscriberId . '",
                    sent="' . $sent . '",
                    status="' . $status . '"
                ', array($this->tableName));
    }

    /**
     * @return DateTime
     */
    public function findLastSentTime()
    {
        $date = $this->cms->querySingleValue('SELECT MAX(sent) FROM `' . $this->tableName . '`');
        if (empty($date)) {
            $date = time() - 24*60*60;
        } else {
            $date = strtotime($date);
        }
        return new DateTime(date('Y-m-d H:i:s', $date));
    }
}
