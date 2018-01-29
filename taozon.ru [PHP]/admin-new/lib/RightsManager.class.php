<?php

OTBase::import('system.lib.Cache');
OTBase::import('system.lib.cache.Key');
OTBase::import('system.admin-new.lib.otapi_providers.RolesProvider');

class RightsManager
{
    public static $rights = array();

    public static $role;

    // Полный список возможных прав
    const RIGHT_DISCOUNT                            = 'Discount';
    const RIGHT_VIEWDISCOUNTS                       = 'ViewDiscounts';
    const RIGHT_EDITDISCOUNTS                       = 'EditDiscounts';
    const RIGHT_MARKET                              = 'Market';
    const RIGHT_CDEKINTEGRATION                     = 'CDEKIntegration';
    const RIGHT_CURRENCYRATEENHANCE                 = 'CurrencyRateEnhance';
    const RIGHT_EDITPRICEFORMATION                  = 'EditPriceFormation';
    const RIGHT_VIEWPRICEFORMATION                  = 'ViewPriceFormation';
    const RIGHT_INSTANCEUSERSELFMANAGEMENT          = 'InstanceUserSelfManagement';
    const RIGHT_INSTANCEUSERSADMINISTRATION         = 'InstanceUsersAdministration';
    const RIGHT_VIEWINSTANCEADMINISTRATIONSETTINGS  = 'ViewInstanceAdministrationSettings';
    const RIGHT_EDITINSTANCEADMINISTRATIONSETTINGS  = 'EditInstanceAdministrationSettings';
    const RIGHT_BRANDSMANAGEMENT                    = 'BrandsManagement';
    const RIGHT_VIEWBRANDS                          = 'ViewBrands';
    const RIGHT_EDITBRANDS                          = 'EditBrands';
    const RIGHT_CATALOGMANAGEMENT                   = 'CatalogManagement';
    const RIGHT_EDITCATALOG                         = 'EditCatalog';
    const RIGHT_VIEWCATALOG                         = 'ViewCatalog';
    const RIGHT_SIMPLEPRICEFORMATION                = 'SimplePriceFormation';
    const RIGHT_VIEWCURRENCYRATESETTINGS            = 'ViewCurrencyRateSettings';
    const RIGHT_EDITCURRENCYRATESETTINGS            = 'EditCurrencyRateSettings';
    const RIGHT_ITEMRATINGMANAGEMENT                = 'ItemRatingManagement';
    const RIGHT_USERMANAGEMENT                      = 'UserManagement';
    const RIGHT_VIEWUSERS                           = 'ViewUsers';
    const RIGHT_EDITUSERS                           = 'EditUsers';
    const RIGHT_STATISTICSMANAGEMENT                = 'StatisticsManagement';
    const RIGHT_EDITSTATISTICSSETTINGS              = 'EditStatisticsSettings';
    const RIGHT_VIEWSTATISTICSSETTINGS              = 'ViewStatisticsSettings';
    const RIGHT_ORDERPACKAGEMANAGEMENT              = 'OrderPackageManagement';
    const RIGHT_VIEWPACKAGE                         = 'ViewPackage';
    const RIGHT_EDITPACKAGE                         = 'EditPackage';
    const RIGHT_ORDERPAYMENT                        = 'OrderPayment';
    const RIGHT_ORDER                               = 'Order';
    const RIGHT_ORDERDELIVERYMANAGEMENT             = 'OrderDeliveryManagement';
    const RIGHT_VIEWDELIVERYCALCULATOR              = 'ViewDeliveryCalculator';
    const RIGHT_EDITDELIVERYCALCULATOR              = 'EditDeliveryCalculator';
    const RIGHT_EDITORDER                           = 'EditOrder';
    const RIGHT_ADMINPANEL                          = 'AdminPanel';
    const RIGHT_EDITUSERPROFILES                    = 'EditUserProfiles';
    const RIGHT_VIEWUSERPROFILES                    = 'ViewUserProfiles';
    const RIGHT_VIEWINSTANCEUSERACTIONSLOG          = 'ViewInstanceUserActionsLog';
    const RIGHT_WAREHOUSE                           = 'Warehouse';
    const RIGHT_EDITWAREHOUSEINFO                   = 'EditWarehouseInfo';
    const RIGHT_VIEWWAREHOUSEINFO                   = 'ViewWarehouseInfo';
    const RIGHT_ORDERMANAGEMENT                     = 'OrderManagement';
    const RIGHT_VIEWORDERLINE                       = 'ViewOrderLine';
    const RIGHT_EDITORDERLINE                       = 'EditOrderLine';
    const RIGHT_VIEWORDER                           = 'ViewOrder';

    // Список контроллеров

    // Контент
    const CMD_CONTENT               = 'contents';
    const CMD_SUPPORT               = 'support';

    // Промо
    const CMD_PROMO                 = 'promo';
    const CMD_SUBSCRIBERS           = 'subscribers';
    const CMD_NEWSLETTERS           = 'newsletters';
    const CMD_REFERRAL              = 'referral';

    // Кофигурация сайта
    const CMD_SITE_CONF             = 'siteconfiguration';
    const CMD_TRANSLATIONS          = 'translations';
    const CMD_MULTILINGUALSETTINGS  = 'multilingualsettings';

    const CMD_ORDERS                = 'orders';
    const CMD_PRICING               = 'pricing';
    const CMD_USERS                 = 'users';

    const CMD_REPORTS               = 'reports';
    const CMD_SHIPMENT              = 'shipment';
    const CMD_IPACCESS              = 'ipaccess';
    const CMD_UPDATE                = 'update';

    // Товары на складе
    const CMD_WAREHOUSE             = 'warehouse';
    const CMD_WAREHOUSEPRODUCTS     = 'warehouseproducts';

    // Управление пользователями
    const CMD_ADMINISTRATORS        = 'administrators';
    const CMD_ROLES                 = 'roles';

    // Каталог
    const CMD_CATALOG               = 'catalog';
    const CMD_CATEGORIES            = 'categories';
    const CMD_PRISTROY              = 'pristroy';
    const CMD_REVIEWS               = 'reviews';
    const CMD_SETS                  = 'sets';
    const CMD_BRANDS                = 'brands';
    const CMD_RESTRICTIONS          = 'restrictions';

    const ACTION_DEFAULT        = 'default';
    const ACTION_VIEW           = 'view';
    const ACTION_ORDERS         = 'orders';
    const ACTION_OPERATIONLOG   = 'operationlog';
    const ACTION_BILLING        = 'billing';
    const ACTION_SYSTEM         = 'system';
    const ACTION_SOCIAL         = 'social';
    const ACTION_REFERRAL       = 'referral';
    const ACTION_SAVE           = 'save';

    // Шаблонные роли
    const ROLE_SUPERADMIN       = 'SuperAdmin';
    const ROLE_OPERATOR         = 'Operator';
    const ROLE_SUPEROPERATOR    = 'SuperOperator';
    const ROLE_CONTENTMANAGER   = 'ContentManager';
    const ROLE_SUPERMANAGER     = 'SuperManager';
    const ROLE_FINANCIER        = 'Financier';

    private static $availableRoles = array(
        self::ROLE_SUPERADMIN,
        self::ROLE_OPERATOR,
        self::ROLE_SUPEROPERATOR,
        self::ROLE_CONTENTMANAGER,
        self::ROLE_FINANCIER,
    );

    private static $dependencies = array(
        self::RIGHT_ORDERMANAGEMENT => array(
            self::CMD_ORDERS => array(),
            self::CMD_SITE_CONF => array(
                self::ACTION_ORDERS,
            ),
        ),
        self::RIGHT_VIEWORDER => array(
            self::CMD_ORDERS => array(),
            self::CMD_SITE_CONF => array(
                self::ACTION_ORDERS,
            ),
        ),
        self::RIGHT_CATALOGMANAGEMENT => array(
            self::CMD_CATEGORIES => array(),
            self::CMD_SETS => array(),
            self::CMD_REVIEWS => array(),
            self::CMD_BRANDS => array(),
            self::CMD_RESTRICTIONS => array(),
            self::CMD_PRISTROY => array(),
            self::CMD_CATALOG => array(),
        ),
        self::RIGHT_ORDERDELIVERYMANAGEMENT => array(
            self::CMD_SHIPMENT => array()
        ),
        self::RIGHT_SIMPLEPRICEFORMATION => array(
            self::CMD_PRICING => array()
        ),
        self::RIGHT_USERMANAGEMENT => array(
            self::CMD_USERS => array(),
            self::CMD_REPORTS => array(
                self::ACTION_OPERATIONLOG,
            ),
        ),
        self::RIGHT_STATISTICSMANAGEMENT => array(
            self::CMD_REPORTS => array(
                self::ACTION_DEFAULT,
            ),
        ),
        self::RIGHT_WAREHOUSE => array(
            self::CMD_WAREHOUSE => array(),
            self::CMD_WAREHOUSEPRODUCTS => array(),
        ),
    );

    private static $superAdminOnlyDeps = array(
        self::RIGHT_INSTANCEUSERSADMINISTRATION => array(
            self::CMD_ADMINISTRATORS => array(),
            self::CMD_ROLES => array(),
            self::CMD_UPDATE => array(),
            self::CMD_IPACCESS => array(),
            self::CMD_SITE_CONF => array(
                self::ACTION_SYSTEM,
            ),
        ),
    );

    // Зависимости, которые НЕ определены через права на сервисах
    private static $rolesDeps = array(
        self::ROLE_OPERATOR => array(
            'allowed' => array(
                self::CMD_SUPPORT => array(),
                self::CMD_REFERRAL => array(),
                self::CMD_PROMO => array(
                    self::ACTION_REFERRAL,
                ),
            ),
            'forbidden' => array(
                self::CMD_NEWSLETTERS => array(),
                self::CMD_USERS => array(),
                self::CMD_REPORTS => array(),
                self::CMD_PROMO => array(),
            ),
        ),
        self::ROLE_SUPEROPERATOR => array(
            'allowed' => array(
                self::CMD_SUPPORT => array(),
                self::CMD_REFERRAL => array(),
                self::CMD_PROMO => array(
                    self::ACTION_REFERRAL,
                ),
            ),
            'forbidden' => array(
                self::CMD_NEWSLETTERS => array(),
                self::CMD_REPORTS => array(),
                self::CMD_PROMO => array(),
            ),
        ),
        self::ROLE_CONTENTMANAGER => array(
            'allowed' => array(
                self::CMD_NEWSLETTERS => array(),
                self::CMD_PROMO => array(
                    self::ACTION_SOCIAL,
                    self::ACTION_DEFAULT,
                    self::ACTION_SAVE,
                ),
            ),
            'forbidden' => array(
                self::CMD_SUPPORT => array(),
                self::CMD_REFERRAL => array(),
                self::CMD_REPORTS => array(),
                self::CMD_PROMO => array(),
            ),
        ),
        self::ROLE_FINANCIER => array(
            'allowed' => array(
                self::CMD_REFERRAL => array(),
                self::CMD_PROMO => array(
                    self::ACTION_REFERRAL,
                ),
                self::CMD_REPORTS => array(
                    self::ACTION_DEFAULT,
                    self::ACTION_BILLING,
                ),
                self::CMD_SITE_CONF => array(
                    self::ACTION_ORDERS,
                    self::ACTION_DEFAULT,
                ),
            ),
            'forbidden' => array(
                self::CMD_SUPPORT => array(),
                self::CMD_PROMO => array(),
                self::CMD_NEWSLETTERS => array(),
                self::CMD_REPORTS => array(
                    self::ACTION_OPERATIONLOG,
                ),
            ),
        ),
    );

    // Список фич, отсутствие которых в правах юзера, говорит о том,
    // что фича ему недоступна, даже если глобальна она включена.
    public static $restrictedFeatures = array(
        'Discount',
        'Market',
        'CDEKIntegration',
        'CurrencyRateEnhance',
        'AdminPanel',
        'InstanceUsersAdministration',
        'Order',
        'Warehouse',
    );

    public static function defaultPath($restrictedCmd = null, $restrictedDo = null)
    {
        if (! Session::get('sid')) {
            return array(
                'cmd' => self::CMD_CONTENT,
                'do'  => self::ACTION_DEFAULT,
            );
        }

        if ($restrictedCmd) {
            $currentRole = self::getCurrentRole();
            $currentRole = preg_replace('#[^A-z]+#si', '', $currentRole);
            if (isset(self::$rolesDeps[$currentRole])) {
                $deps = self::$rolesDeps[$currentRole];
                if (isset($deps['allowed'])) {
                    if (isset($deps['allowed'][$restrictedCmd])) {
                        $allowedActions = $deps['allowed'][$restrictedCmd];
                        if (! empty($allowedActions)) {
                            return array(
                                'cmd' => $restrictedCmd,
                                'do'  => array_shift($allowedActions),
                            );
                        }
                    }
                }
            }
        }

        foreach (self::$dependencies as $right => $deps) {
            if (self::hasRight($right)) {
                foreach ($deps as $allowedCmd => $allowedActions) {
                    $action = ! empty($allowedActions) ? array_shift($allowedActions) : self::ACTION_DEFAULT;
                    if (! self::isManuallyForbidden($allowedCmd, $action)) {
                        return array(
                            'cmd' => $allowedCmd,
                            'do'  => $action,
                        );
                    }
                }
            }
        }

        return array(
            'cmd' => self::CMD_CONTENT,
            'do'  => self::ACTION_DEFAULT,
        );
    }

    public static function getAvailableRoles()
    {
        return self::$availableRoles;
    }

    /*
     *
     */
    public static function isAvailableCmd($cmd, $do = self::ACTION_DEFAULT)
    {
        $cmd = strtolower($cmd);
        $do  = strtolower($do);

        if (self::isAllowedForSuperAdminOnly($cmd, $do) && ! self::isSuperAdmin()) {
            return false;
        }

        if (self::isManuallyAllowed($cmd, $do)) {
            return true;
        }

        if (self::isManuallyForbidden($cmd, $do)) {
            return false;
        }

        if (self::isForbiddenByRoleRights($cmd, $do)) {
            return false;
        }

        return true;
    }

    private static function isAllowedForSuperAdminOnly($cmd, $do)
    {
        // Проверим действия доступные только суперадмину
        foreach (self::$superAdminOnlyDeps as $right => $deps) {
            if (isset($deps[$cmd])) {
                $actions = $deps[$cmd];
                // Ограничение на все действия контроллера
                if (empty($actions) && ! self::isSuperAdmin()) {
                    return true;
                }
                // Ограничение только на определенные действия контроллера
                if (($do != self::ACTION_DEFAULT && in_array($do, $actions)) && ! self::isSuperAdmin()) {
                    return true;
                }
            }
        }
        return false;
    }

    private static function isManuallyForbidden($cmd, $do)
    {
        $currentRole = self::getCurrentRole();
        $currentRole = preg_replace('#[^A-z]+#si', '', $currentRole);
        // Проверим вручную запрещенные действия для текущей роли
        if (isset(self::$rolesDeps[$currentRole])) {
            $deps = self::$rolesDeps[$currentRole];
            if (isset($deps['forbidden'])) {
                if (isset($deps['forbidden'][$cmd])) {
                    $actions = $deps['forbidden'][$cmd];
                    if (empty($actions)) {
                        return true;
                    }
                    if (in_array($do, $actions)) {
                        return true;
                    }
                }
            }
        }
        return false;
    }

    private static function isManuallyAllowed($cmd, $do)
    {
        $currentRole = self::getCurrentRole();
        $currentRole = preg_replace('#[^A-z]+#si', '', $currentRole);
        // Проверим вручную разрешенные действия для текущей роли
        if (isset(self::$rolesDeps[$currentRole])) {
            $deps = self::$rolesDeps[$currentRole];
            if (isset($deps['allowed'])) {
                if (isset($deps['allowed'][$cmd])) {
                    $actions = $deps['allowed'][$cmd];
                    if (empty($actions)) {
                        return true;
                    }
                    if (in_array($do, $actions)) {
                        return true;
                    }
                }
            }
        }
        return false;
    }

    private static function isForbiddenByRoleRights($cmd, $do)
    {
        // Проверим доступные действия для текущей роли, определенные на сервисах
        foreach (self::$dependencies as $right => $deps) {
            if (isset($deps[$cmd])) {
                $actions = $deps[$cmd];
                // Ограничение на все действия контроллера
                if (empty($actions) && ! self::hasRight($right)) {
                    return true;
                }

                // Ограничение только на определенные действия контроллера
                if (($do != self::ACTION_DEFAULT && in_array($do, $actions)) && ! self::hasRight($right)) {
                    return true;
                }
            }
        }
        return false;
    }

    /*
     *
     */
    public static function isFeatureAvailable($feature)
    {
        if (! in_array($feature, self::$restrictedFeatures)) {
            return true;
        }
        return self::hasRight($feature);
    }

    /*
     *
     */
    public static function hasRight ($rightName)
    {
        return in_array($rightName, self::getCurrentRights());
    }

    public static function getCurrentRole ()
    {
        if (Session::get('role')) {
            return Session::get('role');
        }
        return self::$role;
    }

    public static function setCurrentRole ($role)
    {
        if (! empty($role[0])) {
            self::$role = $role[0]['Name'];
            Session::set('role', self::$role);
        }
    }

    public static function getCurrentRights ()
    {
        if (! Session::get('sid')) {
            return array();
        }

        $cacher = new Cache('Rights' . RightsManager::getCurrentRole());

        if (! $cacher->has()) {
            $rolesProvider = new RolesProvider();
            $rolesProvider->setUserRoleAndRights(Session::get('sid'));
        }
        //var_dump($cacher->get());die();
        return $cacher->has() ? $cacher->get() : array();
    }

    public static function isSuperAdmin()
    {
        return self::getCurrentRole() === self::ROLE_SUPERADMIN;
    }

    public static function setCurrentRights ($rights)
    {
        $cacher = new Cache('Rights' . RightsManager::getCurrentRole());
        $cacher->set($rights);
    }

}
