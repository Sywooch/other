<?php

class TabsGenerator
{
    /**
     * @param string $tabsXMLPath
     * @param AdminUrlWrapper $pageUrl
     * @return string
     */
    public static function GetTabs($tabsXMLPath, $pageUrl)
    {
        return self::generateTabs($tabsXMLPath, $pageUrl, 'ot_sub_nav', 'nav nav-tabs');
    }

    /**
     * @param $tabsXMLPath
     * @param AdminUrlWrapper $pageUrl
     * @return mixed|string
     */
    public static function GetSubTabs($tabsXMLPath, $pageUrl)
    {
        return self::generateTabs($tabsXMLPath, $pageUrl, 'tabbable ot_sub_sub_nav', 'nav nav-pills');
    }

    private static function generateTabs($tabsXMLPath, $pageUrl, $cssMunuClass, $cssUlClass)
    {
        if (! file_exists($tabsXMLPath)) {
            return "File $tabsXMLPath does not exist";
        }

        $tabs = simplexml_load_file($tabsXMLPath);

        $menu = new SimpleXMLElement('<div></div>');
        $menu['class'] = $cssMunuClass;
        $ul = $menu->addChild('ul');
        $ul['class'] = $cssUlClass;

        foreach ($tabs->tab as $tab) {
            if (isset($tab['feature'])) {
                if (! CMS::IsFeatureEnabled((string) $tab['feature'])) {
                    continue;
                }
                if (! RightsManager::isFeatureAvailable((string)$tab['feature'])) {
                    continue;
                }
            }
            if (! RightsManager::isAvailableCmd((string)$tab['cmd'], (string)$tab['action'])) {
                continue;
            }

            $isActive = $tab->xpath('page[@data-action="' . $pageUrl->GetAction() . '" and @data-cmd="' . strtolower($pageUrl->GetCmd()) . '"]');
            if (!$isActive)
                $isActive = $tab->xpath('page[@data-action="*" and @data-cmd="' . strtolower($pageUrl->GetCmd()) . '"]');

            $li = $ul->addChild('li');
            if ($isActive) {
                $li['class'] = 'active';
            }

            $a = $li->addChild('a', LangAdmin::get((string)$tab['title']));
            if (empty($tab['disabled'])) {
                $a['href'] = $pageUrl->AssignCmdAndDo((string)$tab['cmd'], (string)$tab['action']);
            } else {
                $li['class'] = !empty($li['class']) ? $li['class'] . ' disabled' : 'disabled';
            }
        }

        return $menu->asXML();
    }
}
