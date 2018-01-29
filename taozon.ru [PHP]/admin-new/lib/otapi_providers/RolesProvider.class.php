<?php

class RolesProvider
{
    /**
     * @var OTAPIlib
     */
    private $otapilib;

    public function __construct($otapilib = null)
    {
        $this->otapilib = is_null($otapilib) ? new OTAPIlib() : $otapilib;
        $this->otapilib->setErrorsAsExceptionsOn();
    }

    public function GetInstanceUserRoleList($sessionId)
    {
        return $this->otapilib->GetInstanceUserRoleList($sessionId);
    }

    public function GetAvailableRoleList($sessionId)
    {
        return $this->otapilib->GetAvailableRoleList($sessionId);
    }

    public function GetTemplateRoleList($sessionId)
    {
        return $this->otapilib->GetTemplateRoleList($sessionId);
    }

    public function AttachRightsToRole($sessionId, $roleName, $xmlIds)
    {
        return $this->otapilib->AttachRightsToRole($sessionId, $roleName, $xmlIds);
    }

    public function DeattachRightsFromRole($sessionId, $roleName, $xmlIds)
    {
        return $this->otapilib->DeattachRightsFromRole($sessionId, $roleName, $xmlIds);
    }

    public function CreateInstanceRoleFromTemplate($sessionId, $templateRoleName)
    {
        return $this->otapilib->CreateInstanceRoleFromTemplate($sessionId, $templateRoleName);
    }

    public function CreateInstanceRole($sessionId, $xml)
    {
        return $this->otapilib->CreateInstanceRole($sessionId, $xml);
    }

    public function DeleteInstanceRole($sessionId, $roleName)
    {
        return $this->otapilib->DeleteInstanceRole($sessionId, $roleName);
    }

    public function GetRightTree($sessionId, $roleName, $isTemplate)
    {
        return $this->otapilib->GetRightTree($sessionId, $roleName, $isTemplate);
    }

    public function GetOperatorRightTree($sessionId)
    {
        return $this->otapilib->GetOperatorRightTree($sessionId);
    }

    public function setUserRoleAndRights($sessionId)
    {
        /** Установка роли авторизованного пользователя */
        $rolesList = $this->GetInstanceUserRoleList($sessionId);
        RightsManager::setCurrentRole($rolesList);

        /** Установка прав авторизованного пользователя */
        $rights = $this->GetOperatorRightTree($sessionId);
        RightsManager::setCurrentRights($this->getRightsList($rights));
    }

    private function getRightsList($rights)
    {
        $rightsList = array();
        foreach ($rights as $item) {
            if ($item['isturnon'] == 'true') {
                $rightsList[] = $item['Name'];
                if (isset($item['item'])) {
                    $rightsList = array_merge($this->getRightsList($item['item']), $rightsList);
                }
            }
        }
        return $rightsList;
    }
}