<?php

class View
{
    /**
     * @param $templateName
     * @param $templateFileName
     * @param $templatePath
     * @param array $parameters
     * @return string
     */
    public static function fetchTemplate($templateName, $templateFileName, $templatePath, $parameters = array()){
        $HSTemplate_options = array(
            'template_path' => CFG_BASE_TPL_ROOT,
            'cache_path'    => CFG_APP_ROOT . '/cache',
            'debug'         => false,
        );
        $HSTemplate = new HSTemplate($HSTemplate_options);
        $templateDisplay = $HSTemplate->getDisplay($templateName, true);

        foreach($parameters as $key => $value) {
            $templateDisplay->assign($key, $value);
        }

        $tpl = CFG_TPL_ROOT . $templatePath;
        if (! file_exists($tpl . $templateFileName . '.html'))
        {
            $tpl = CFG_BASE_TPL_ROOT . $templatePath;
        }

        $templateDisplay->addTemplate($templateName, $templateFileName.'.html', $tpl);
        return $templateDisplay->fetch($templateName, false, true);
    }
}
