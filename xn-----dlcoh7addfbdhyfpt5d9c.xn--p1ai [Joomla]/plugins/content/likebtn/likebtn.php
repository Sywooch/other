<?php

/**
 * @project  LikeBtn Like Button
 * @author   LikeBtn.com (info@likebtn.com)
 * @copyright (Copyright (C) 2013 by LikeBtn. All rights reserved.
 * @license GNU/GPL: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.plugin.plugin');
jimport('joomla.plugin.helper');
jimport('joomla.html.parameter'); // < 3.0

// Content views
define('LIKEBTN_VIEW_CONTENT', 'article');
define('LIKEBTN_VIEW_K2_ITEM', 'item');
define('LIKEBTN_VIEW_K2_ITEMLIST', 'itemlist');
define('LIKEBTN_VIEW_VIRTUEMART', 'productdetails');
define('LIKEBTN_VIEW_FRONTPAGE', 'frontpage');
define('LIKEBTN_VIEW_FAVORITE', 'featured');
define('LIKEBTN_VIEW_CATEGORY', 'category');
define('LIKEBTN_VIEW_SECTION', 'section');

// Content types
define('LIKEBTN_CONTENT_TYPE_CUSTOM_ITEM', '');

// Process ajax requests
plgContentLikebtn::ajaxController();

class plgContentLikebtn extends JPlugin {

    const PLG_TYPE = 'content';
    const PLG_NAME = 'likebtn';

    // Shortcode switching off the likebtn
    const SHORTCODE_OFF = 'likebtn-off';
    const SHORTCODE = 'likebtn';

    // Content type settings admin field name.
    const ADMIN_FIELD_NAME = 'content_type_settings';

    // General settings.
    public static $likebtn_general_settings = array(
        'show' => '0',
        'use_settings_from' => '',
        'content_view_mode' => 'both',
        'exclude_categories' => array(),
        'user_logged_in' => 'all',
        'position' => 'bottom',
        'alignment' => 'left',
        'html_before' => '',
        'html_after' => '',
    );

    // LikeBtn settings.
    public static $likebtn_settings = array(
        "lang" => array("default" => "en"),
        "group_identifier " => array("default" => ""),
        //"local_domain" => array("default" => ''),
        //"subdirectory" => array("default" => ''),
        "domain_from_parent" => array("default" => '0'),
        "share_url" => array("default" => ''),
        "share_enabled" => array("default" => '1'),
        "item_url" => array("default" => ''),
        "item_title" => array("default" => ''),
        "item_description" => array("default" => ''),
        "item_image" => array("default" => ''),
        "show_like_label" => array("default" => '1'),
        "show_dislike_label" => array("default" => '0'),
        "popup_dislike" => array("default" => '0'),
        "like_enabled" => array("default" => '1'),
        "dislike_enabled" => array("default" => '1'),
        "icon_like_show" => array("default" => '1'),
        "icon_dislike_show" => array("default" => '1'),
        "lazy_load" => array("default" => '0'),
        "display_only" => array("default" => '0'),
        "unlike_allowed" => array("default" => '1'),
        "like_dislike_at_the_same_time" => array("default" => '0'),
        "revote_period" => array("default" => ''),
        "counter_type" => array("default" => "number"),
        "counter_clickable" => array("default" => '0'),
        "counter_show" => array("default" => "1"),
        "counter_padding" => array("default" =>''),
        "counter_zero_show" => array("default" =>'0'),
        "style" => array("default" => 'white'),
        "addthis_pubid" => array("default" => ''),
        "addthis_service_codes" => array("default" => ''),
        "loader_show" => array("default" => '0'),
        "loader_image" => array("default" => ''),
        "tooltip_enabled" => array("default" => '1'),
        "show_copyright" => array("default" => '1'),
        "popup_html" => array("default" => ''),
        "popup_donate" => array("default" => ''),
        "popup_content_order" => array("default" => 'popup_share,popup_donate,popup_html'),
        "popup_enabled" => array("default" => '1'),
        "popup_position" => array("default" => 'top'),
        "popup_style" => array("default" => 'light'),
        "popup_hide_on_outside_click" => array("default" => '1'),
        "event_handler" => array("default" => ''),
        "info_message" => array("default" => '1'),
        "i18n_like" => array("default" => ''),
        "i18n_dislike" => array("default" => ''),
        "i18n_after_like" => array("default" => ''),
        "i18n_after_dislike" => array("default" => ''),
        "i18n_like_tooltip" => array("default" => ''),
        "i18n_dislike_tooltip" => array("default" => ''),
        "i18n_unlike_tooltip" => array("default" => ''),
        "i18n_undislike_tooltip" => array("default" => ''),
        "i18n_share_text" => array("default" => ''),
        "i18n_popup_close" => array("default" => ''),
        "i18n_popup_text" => array("default" => ''),
        "i18n_popup_donate" => array("default" => '')
    );

    // LikeBtn styles.
    public static $likebtn_styles = array(
        "white" => "white",
        "lightgray" => "lightgray",
        "gray" => "gray",
        "black" => "black",
        "padded" => "padded",
        "drop" => "drop",
        "line" => "line",
        "github" => "github",
        "transparent" => "transparent",
        "youtube" => "youtube",
        "habr" => "habr",
        "heartcross" => "heartcross",
        "plusminus" => "plusminus",
        "google" => "google",
        "greenred" => "greenred",
        "large" => "large",
        "elegant" => "elegant",
        "disk" => "disk",
        "squarespace" => "squarespace",
        "slideshare" => "slideshare",
        "baidu" => "baidu",
        "uwhite" => "uwhite",
        "ublack" => "ublack",
        "uorange" => "uorange",
        "ublue" => "ublue",
        "ugreen" => "ugreen",
        "direct" => "direct",
        "homeshop" => "homeshop"
    );

    // languages
    public static $likebtn_languages = array(
        'en' => 'en - English',
        'ru' => 'ru - Русский (Russian)',
        'de' => 'de - Deutsch (German)',
        'ja' => 'ja - 日本語 (Japanese)',
        'uk' => 'uk - Українська мова (Ukrainian)',
        'kk' => 'kk - Қазақ тілі (Kazakh)',
        'nl' => 'nl - Nederlands (Dutch)',
        'hu' => 'hu - Magyar (Hungarian)',
        'sv' => 'sv - Svenska (Swedish)',
        'tr' => 'tr - Türkçe (Turkish)',
        'es' => 'es - Español (Spanish)',
    );

    // LikeBtn website locales available
    public static $likebtn_website_locales = array(
        'en', 'ru'
    );

    // Content types and their tables
    public static $content_type_table = array(
        'com_contact.contact' => 'contact_details',
        'com_banners.client' => 'banner_clients',
        'com_users.note' => 'user_notes',
        'com_k2.item' => 'k2_items'
    );

    public static $plugin_v = null;

    /**
     * Load the language file on instantiation.
     * Note this is only available in Joomla 3.1 and higher.
     * If you want to support 3.0 series you must override the constructor
     *
     * @var boolean
     * @since 3.1
     */
    protected $autoloadLanguage = true;

    // Items table
    const TABLE_LIKEBTN_ITEMS = 'likebtn_items';

    /**
     * All content
     */
    public function onContentPrepare($context, &$content, &$params, $page = 0)
    {
        // Miss K2
        if ($context == "com_virtuemart.productdetails" || strstr($context, 'com_k2.')) {
            return true;
        }

        return $this->renderLikeBtn($context, $content, $params, $page);
    }

    /**
     * K2, VirtueMart
     */
    function onContentAfterDisplay($context, &$content, &$params, $page = 0) {
        if ($context == "com_virtuemart.productdetails" || strstr($context, 'com_k2.')) {
            return $this->renderLikeBtn($context, $content, $params, $page);
        }
    }

    /*public function onK2AfterDisplayContent(&$content, &$params, $limitstart)
    {
        return $this->renderLikeBtn('com_k2.item', $content, $params);
    }*/

    /**
     * Render LikeBtn.
     */
    public function renderLikeBtn($context, &$content, &$params, $page = 0) {

        $view = JRequest::getCmd('view');
        $option = JRequest::getCmd('option');
        $use_content_type = null;

        // Consider content on main page to be articles
        // Consider content in *.category content type to be article
        if ($view == LIKEBTN_VIEW_FAVORITE || $view == LIKEBTN_VIEW_FRONTPAGE
            || $view == LIKEBTN_VIEW_CATEGORY || $view == LIKEBTN_VIEW_SECTION) {
            $context = 'com_content.article';
        }
        // Convert K2 itemlist to item
        if ($context == 'com_k2.itemlist') {
            $context = 'com_k2.item';
        }

        // Check if LikeBtn is disabled
        $is_off = false;
        if (isset($content->fulltext)) {
            if (strpos($content->fulltext, '{'.self::SHORTCODE_OFF.'}') !== false) {
                $content->fulltext = str_replace('{'.self::SHORTCODE_OFF.'}', '', $content->fulltext);
                $is_off = true;
            }
        }

        if (isset($content->text)) {
            if (strpos($content->text, '{'.self::SHORTCODE_OFF.'}') !== false) {
                $content->text = str_replace('{'.self::SHORTCODE_OFF.'}', '', $content->text);
                $is_off = true;
            }
        }
        if ($is_off) {
            return '';
        }

        if (!isset($content->id)) {
            return '';
        }

        // Process shortcodes
        $content = $this->processShortcodes($content, $context);

        $content_type_params = array();

        $content_type_settings = $this->params->get(self::ADMIN_FIELD_NAME);
        if (empty($content_type_settings)) {
            return '';
        }
        $content_type_settings = self::object2array($content_type_settings);

        // Determine content type.
        $real_content_type = $context;

        if (isset($content_type_settings[$real_content_type])) {
            $content_type_params = $content_type_settings[$real_content_type];
        }

        // Get content type whose settings should be copied
        if (!empty($content_type_params['use_settings_from'])) {
            $use_content_type = $content_type_params['use_settings_from'];
        }

        if ($use_content_type) {
            $content_type = $use_content_type;
        } else {
            $content_type = $real_content_type;
        }

        if ($content_type != $real_content_type) {
            if (isset($content_type_settings[$use_content_type])) {
                $content_type_params = $content_type_settings[$use_content_type];
            } else {
                return '';
            }
        }

        // Prepare settings
        $content_type_params = plgContentLikebtn::prepareGeneralSettings($content_type_params);

        // Check show.
        if ($content_type_params['show'] != '1') {
            return '';
        }

        // Check Content view mode.
        switch ($content_type_params['content_view_mode']) {
            case 'full':
                if (!isset($content->fulltext) || $view == LIKEBTN_VIEW_CATEGORY
                    || $view == LIKEBTN_VIEW_SECTION || $view == LIKEBTN_VIEW_K2_ITEMLIST)
                {
                    return '';
                }
                break;
            case 'excerpt':
                if (isset($content->fulltext) && $view != LIKEBTN_VIEW_CATEGORY
                    && $view != LIKEBTN_VIEW_SECTION && $view != LIKEBTN_VIEW_K2_ITEMLIST) {
                    return '';
                }
                break;
        }

        // Check exclude category.
        $catid = '';
        if (isset($content->catid)) {
            $catid = $content->catid;
        }
        $exclude_categories = is_array($content_type_params['exclude_categories']) ? $content_type_params['exclude_categories'] : array($content_type_params['exclude_categories']);

        if (in_array($catid, $exclude_categories)) {
            return '';
        }

        // Check user authorization.
        $user = JFactory::getUser();

        switch ($content_type_params['user_logged_in']) {
            case 'logged_in':
                if ($user->guest) {
                    return '';
                }
                break;
            case 'not_logged_in':
                if (!$user->guest) {
                    return '';
                }
                break;
        }

        if (empty($content_type_params['settings'])) {
            $content_type_params['settings'] = array();
        }

        $html = self::getMarkup($real_content_type, $content->id, $content_type_params['settings'], true, true, $content);

        if ($option == 'com_k2') {
            // K2
            // If extra content appended to content, the font size changes
            if ($content_type_params['position'] == 'top') {
                $content->text = $html . $content->text;
            } elseif ($content_type_params['position'] == 'bottom') {
                return $html;
            } else {
                $content->text = $html . $content->text;
                return $html;
            }
        } else {
            if ($content_type_params['position'] == 'top') {
                $content->text = $html . $content->text;
            } elseif ($content_type_params['position'] == 'bottom') {
                $content->text = $content->text . $html;
            } else {
                $content->text = $html . $content->text . $html;
            }
        }

        return '';
    }

    /**
     * Add custom fields in administration.
     * http://docs.joomla.org/Adding_custom_fields_to_core_components_using_a_plugin
     */
    function onContentPrepareForm($form, $data)
    {
        $display_custom_fields = false;

        $app = JFactory::getApplication();
        $content_type_alias = $app->input->get('option') . '.' . $app->input->get('view');

        $content_types = plgContentLikebtn::getSupportedContentTypes();
        foreach ($content_types as $content_type) {
            if ($content_type->type_alias == $content_type_alias) {
                $display_custom_fields = true;
                break;
            }
        }

        if (!$display_custom_fields || !$app->isAdmin()) {
            return true;
        }

        JForm::addFormPath(__DIR__ . '/forms');
        $form->loadFile('custom_fields', false);

        return true;
    }

    /**
     * Fetch custom fields.
     * http://docs.joomla.org/Adding_custom_fields_to_the_article_component
     */
    public function onContentPrepareData($context, $data)
    {
        $display_custom_fields = false;

        $app = JFactory::getApplication();
        if (!$app->isAdmin()) {
            return true;
        }

        $content_type_alias = $app->input->get('option') . '.' . $app->input->get('view');

        $content_types = plgContentLikebtn::getSupportedContentTypes();
        foreach ($content_types as $content_type) {
            if ($content_type->type_alias == $content_type_alias) {
                $display_custom_fields = true;
                break;
            }
        }

        if (!$display_custom_fields || !is_object($data)) {
            return true;
        }

        $content_id = isset($data->id) ? $data->id : 0;
        if (!$content_id) {
            return true;
        }

        // Load the data from the database.
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('likes, dislikes');
        $query->from('#__'.self::TABLE_LIKEBTN_ITEMS);
        $query->where('content_type = ' . $db->Quote($context));
        $query->where('content_id = ' . $db->Quote($content_id));
        $db->setQuery($query);
        $results = $db->loadRowList();

        // Check for a database error.
        if ($db->getErrorNum()) {
           return true;
        }

        if (isset($results[0])) {
            if (isset($results[0][0])) {
                $data->params['likebtn_likes'] = $results[0][0];
            }
            if (isset($results[0][1])) {
                $data->params['likebtn_dislikes'] = $results[0][1];
            }
        }

        return true;
    }

    /**
     *
     * Static functions.
     *
     */

    /**
     * Prepare general settings.
     */
    public static function prepareGeneralSettings($values)
    {
        foreach (self::$likebtn_general_settings as $option=>$default_value) {
            if (!isset($values[$option])) {
                $values[$option] = $default_value;
            }
        }
        return $values;
    }

    /**
     * Prepare LikeBtn settings.
     */
    public static function prepareSettings($settings)
    {
        foreach (self::$likebtn_settings as $option=>$option_info) {
            if (!isset($settings[$option])) {
                $settings[$option] = $option_info['default'];
            }
        }
        return $settings;
    }

    /**
     * Get LikeBtn styles.
     */
    public static function getStyles()
    {
        return self::getPluginParameter('param_styles', self::$likebtn_styles);
    }

    /**
     * Get LikeBtn languages.
     */
    public static function getLanguages()
    {
        return self::getPluginParameter('param_locales', self::$likebtn_languages);
    }

    /**
     * Get plugin parameter
     *
     * @param type $parameter
     * @param type $default
     * @return type
     */
    public static function getPluginParameter($parameter, $default)
    {
        $pluginParams = self::getPluginParams();
        return $pluginParams->get($parameter, $default);
    }

    /**
     * Set plugin parameter.
     * http://stackoverflow.com/questions/22236929/setting-persistent-plugin-parameters-in-joomla-3
     * http://stackoverflow.com/questions/22236929/setting-persistent-plugin-parameters-in-joomla-3
     */
    public static function setPluginParameter($name, $value)
    {
        if (class_exists('JTableExtension')) {
            $db = JFactory::getDBO();
            $extensionTable = new JTableExtension($db);
            //$pluginId = $extensionTable->find('element', self::PLG_NAME);
            $pluginId = self::getPluginId($db);
            if (empty($pluginId)) {
                return false;
            }
            $extensionTable->load($pluginId);

            $plugin = &JPluginHelper::getPlugin(self::PLG_TYPE, self::PLG_NAME);
            if (empty($plugin)) {
                return false;
            }
            $params = self::getPluginParams();

            $params->set($name, $value);
            $extensionTable->bind( array('params' => $params->toString()) );

            // check and store
            if (!$extensionTable->check()) {
                return false;
            }
            if (!$extensionTable->store()) {
                return false;
            }
            return true;
        }

        return false;
    }

    /**
     * Get plugin id.
     */
    public static function getPluginId($db){
        $sql = 'SELECT `extension_id` FROM `#__extensions` WHERE `element` = "'.self::PLG_NAME.'"';
        // AND `folder` = "my_plugin_folder"
        $db->setQuery($sql);
        $plg = $db->loadObject();

        if (!$plg) {
            return false;
        } else {
            return (int)$plg->extension_id;
        }
    }

    /**
     * Get all plugin parameters.
     */
    public static function getPluginParams()
    {
        $plugin = &JPluginHelper::getPlugin(self::PLG_TYPE, self::PLG_NAME);

        $params = null;
        if (!empty($plugin)) {
            $params = $plugin->params;
        }
        if (class_exists('JParameter')) {
            // < 3.0
            $pluginParams = new JParameter($params);
        } else {
            $pluginParams = new JRegistry;
            $pluginParams->loadString($params);
        }

        return $pluginParams;
    }

    /**
     * Get LikeBtn markup.
     */
    public static function getMarkup($content_type, $content_id, $values = array(), $include_content_parameters = true, $wrap = false, $content = null, $include_content_data = true)
    {
        $prepared_settings = array();

        $pluginParams = self::getPluginParams();

        $content_type_parameters = array();
        $content_type_settings = self::object2array($pluginParams->get(self::ADMIN_FIELD_NAME));

        if (!empty($content_type_settings) && isset($content_type_settings[$content_type])) {
            $content_type_parameters = $content_type_settings[$content_type];
        }

        // Prepare settings.
        if (empty($content_type_parameters['settings'])) {
            $content_type_parameters['settings'] = array();
        }
        $content_type_parameters['settings'] = plgContentLikebtn::prepareSettings($content_type_parameters['settings']);

        // Run sunchronization
        require_once(dirname(__FILE__).'/likebtn.class.php');
        $likebtn = new LikeBtn($pluginParams);
        $likebtn->runSyncVotes();

        $data = '';

        if ($values && isset($values['identifier'])) {
            $data .= 'data-identifier="' . htmlspecialchars($values['identifier']) . '" ';
        } else {
            $data .= 'data-identifier="' . $content_type . '_' . $content_id . '" ';
        }

        // Site ID
        if ($pluginParams->get('site_id')) {
            $data .= 'data-site_id="' . $pluginParams->get('site_id') . '" ';
        }

        // Set engine and plugin info
        $data .= ' data-engine="Joomla" ';
        $data .= ' data-engine_v="' . JVERSION . '" ';
        $plugin_v = self::getPluginV();
        if ($plugin_v) {
            $data .= ' data-plugin_v="' . $plugin_v . '" ';
        }

        // local_domain and subdirectory are kept for backward compatibility
        // Local domain
        /*if ($pluginParams->get('local_domain')) {
            $data .= 'data-local_domain="' . htmlspecialchars($pluginParams->get('local_domain')) . '" ';
        }

        // Website subdirectory
        if ($pluginParams->get('subdirectory')) {
            $data .= 'data-subdirectory="' . htmlspecialchars($pluginParams->get('subdirectory')) . '" ';
        }*/

        foreach (self::$likebtn_settings as $option_name => $option_info) {

            $option_value = '';

            if ($values && isset($values[$option_name])) {
                // If values passed.
                $option_value = $values[$option_name];
            } elseif ($include_content_parameters) {
                if (isset($content_type_parameters['settings']) && isset($content_type_parameters['settings'][$option_name])) {
                    $option_value = $content_type_parameters['settings'][$option_name];
                }
            }

            $option_value_prepared = self::prepareOption($option_name, $option_value);
            $prepared_settings[$option_name] = $option_value_prepared;

            // Do not add option if it has default value.
            if ($option_value != $option_info['default'] && $option_value !== '') {
                $data .= ' data-' . $option_name . '="' . $option_value_prepared . '" ';
            }
        }

        // Add share options
        if ($include_content_data) {

            $content_url = '';
            $content_title = '';

            // Get Content
            if ($content) {
                $content = self::object2array($content);
            } else {
                $content = self::getContent($content_type, $content_id);
            }

            // Get content data
            if (!empty($content)) {
                $content_title = $content['title'];

                // Get URL for Articles only
                if ($content_type == 'com_content.article') {
                    if (isset($content['catid'])) {
                        include_once(JPATH_BASE.'/components/com_content/helpers/route.php');
                        if (class_exists('JRoute') && method_exists('ContentHelperRoute', 'getArticleRoute')) {
                            $content_url = ContentHelperRoute::getArticleRoute($content_id, $content['catid']);
                            if ($content_url) {
                                $content_url = JRoute::_($content_url);
                            }
                        }
                    }
                } elseif (isset($content['link'])) {
                    // K2
                    $content_url = $content['link'];
                }

                // Relative to absolute
                if ($content_url) {
                    $content_url = preg_replace("/\/+/", '/', $content_url);
                    $content_url = self::getBaseUrl() . $content_url;
                }
            }

            if ($content_url && !$prepared_settings['item_url']) {
                $data .= ' data-item_url="' . $content_url . '" ';
            }

            if ($content_title && !$prepared_settings['item_title']) {
                $content_title = preg_replace('/\s+/', ' ', $content_title);
                //$content_title = htmlspecialchars(mb_substr($content_title, 0, self::ITEM_TITLE_MAX_LENGTH));
                $content_title = htmlspecialchars($content_title);
                $data .= ' data-item_title="' . $content_title . '" ';
            }
        }

        $markup = <<<MARKUP
<!-- LikeBtn.com BEGIN -->
<span class="likebtn-wrapper" {$data}></span>
<script type="text/javascript" src="//w.likebtn.com/js/w/widget.js" async="async"></script>
<script type="text/javascript">if (typeof(LikeBtn) != "undefined") { LikeBtn.init(); }</script>
<!-- LikeBtn.com END -->
MARKUP;

        // HTML before.
        $html_before = '';
        if (isset($values['html_before'])) {
            $html_before = $values['html_before'];
        } elseif (isset($content_type_parameters['html_before'])) {
            $html_before = $content_type_parameters['html_before'];
        }
        if (trim($html_before)) {
            $markup = $html_before . $markup;
        }

        // HTML after.
        $html_after = '';
        if (isset($values['html_after'])) {
            $html_after = $values['html_after'];
        } elseif (isset($content_type_parameters['html_after'])) {
            $html_after = $content_type_parameters['html_after'];
        }
        if (trim($html_before)) {
            $markup = $markup . $html_after;
        }

        if ($wrap) {
            // Alignment
            $alignment = 'left';
            if (isset($values['alignment'])) {
                $alignment = $values['alignment'];
            } elseif (isset($content_type_parameters['alignment'])) {
                $alignment = $content_type_parameters['alignment'];
            }
            if ($alignment == 'right') {
                $markup = '<div style="text-align:right;margin: 1px 0 3px;" class="likebtn_container">' . $markup . '</div>';
            } elseif ($alignment == 'center') {
                $markup = '<div style="text-align:center;margin: 1px 0 3px;" class="likebtn_container">' . $markup . '</div>';
            } else {
                $markup = '<div style="margin: 1px 0 3px;" class="likebtn_container">' . $markup . '</div>';
            }
        }

        return $markup;
    }

    /**
     * Prepare option value.
     */
    public static function prepareOption($option_name, $option_value)
    {
        $option_value_prepared = $option_value;

        // Format bool.
        if (isset(self::$likebtn_settings[$option_name]) &&
            in_array(self::$likebtn_settings[$option_name]['default'], array('1', '0'), true))
        {
            if (is_int($option_value)) {
                if ($option_value) {
                    $option_value_prepared = 'true';
                } else {
                    $option_value_prepared = 'false';
                }
            }
            if ($option_value === '1') {
                $option_value_prepared = 'true';
            }
            if ($option_value === '0' || $option_value === '') {
                $option_value_prepared = 'false';
            }
        }

        // Replace quotes with &quot; to avoid XSS.
        //$option_value_prepared = str_replace('"', '&quot;', $option_value_prepared);
        $option_value_prepared = htmlspecialchars($option_value_prepared);

        return $option_value_prepared;
    }

    /**
     * Convert object to array
     */
    public static function object2array($object) {
        if (is_object($object)) {
            foreach ($object as $key => $value) {
                $array[$key] = self::object2array($value);
            }
        } elseif (is_array($object)) {
            foreach ($object as $key => $value) {
                $array[$key] = self::object2array($value);
            }
        } else {
            return $object;
        }
        if (isset($array)) {
            return $array;
        }
    }

    /**
     * Get content.
     */
    public static function getContent($content_type, $content_id, $db = null)
    {
        $content = array();

        if (!$db) {
            $db = JFactory::getDbo();
        }

        $table = '';

        if (array_key_exists($content_type, self::$content_type_table)) {
            $table = self::$content_type_table[$content_type];
        } else {
            preg_match("/^com_([^\.]+)/", $content_type, $matches);
            if (!empty($matches[1])) {
                $table = $matches[1];
            }
        }

        // Get a db connection.
        try {
            $query = $db->getQuery(true);
            $query->select(array('*'));
            $query->from('#__'.$table);
            $query->where('id = ' . intval($content_id));
            $db->setQuery($query);

            // Load the results as a list of stdClass objects.
            $list = $db->loadObjectList();
        } catch (Exception $e) {}

        if (!empty($list[0])) {
            $content = self::object2array($list[0]);
        }

        return $content;
    }

    /**
     * Get site base url.
     */
    public static function getBaseUrl()
    {
        if (class_exists('JURI')) {
            $base = JURI::base();
            preg_match('~^(.*?//.*?)/.*~', $base, $matches);
            if (!empty($matches[1])) {
                return $matches[1];
            } else {
                return $base;
            }
        } elseif (!empty($_SERVER['HTTP_HOST'])) {
            return 'http://'.$_SERVER['HTTP_HOST'];
        }
    }
    /**
     * Get supported content types.
     */
    public static function getSupportedContentTypes($db = null, $k2_enabled = null)
    {
        $content_types = array();

        if ($db == null) {
            $db = JFactory::getDbo();
        }
        if ($k2_enabled == null) {
            $db->setQuery("SELECT enabled FROM #__extensions WHERE name = 'com_k2'");
            $k2_enabled = $db->loadResult();
        }

        $query = $db->getQuery(true);
        $query->select(array('type_id', 'type_title', 'type_alias'));
        $query->from('#__content_types');
        $query->where('type_alias not like "%.category"');
        $query->order('type_id ASC');
        // Reset the query using our newly populated query object.
        $db->setQuery($query);

        // Load the results as a list of stdClass objects.
        $content_types = $db->loadObjectList();

        // Joomla 2.5
        if (empty($content_types)) {
            $article_content_type = new stdClass();
            $article_content_type->type_title = JText::_('PLG_LIKEBTN_CONTENT_TYPE_ARTICLE');
            $article_content_type->type_alias = 'com_content.article';
            $article_content_type->type_id = 1;
            $content_types = array($article_content_type);
        }

        // Add K2 Article
        if ($k2_enabled) {
            $k2_item_content_type = new stdClass();
            $k2_item_content_type->type_title =  JText::_('PLG_LIKEBTN_CONTENT_TYPE_K2_ITEM');
            $k2_item_content_type->type_alias = 'com_k2.item';
            $k2_item_content_type->type_id = (int)$content_types[count($content_types)-1]->type_id + 1;
            $content_types[] = $k2_item_content_type;
        }

        return $content_types;
    }

    /**
     * Process shortcodes in content.
     */
    public function processShortcodes($content, $content_type)
    {
        $text = '';
        // Full
        if (isset($content->fulltext)) {
            $text = $content->fulltext;
        }
        // Excerpt
        if (isset($content->text)) {
            $text = $content->text;
        }

        $replacements = array();
        $regex = '/(?<!\<code\>)\{'.self::SHORTCODE.'([^}\n]*?)\}(?!\<\/code\>)/is';
        preg_match_all($regex, $text, $matches);

        // Found shortcodes
        if (!empty($matches[1])) {
            // Parse options
            foreach ($matches[1] as $index=>$params_str) {
                $regex_list[$index] = $regex;
                $replacements[$index] = '';

                $regex_params = '/(\w+)\s*=\s*\"(.*?)\"/si';
                preg_match_all($regex_params, $params_str, $matches_params);

                if (!count($matches_params)) {
                    continue;
                }

                $settings = array();
                foreach ($matches_params[1] as $matches_params_index=>$option) {
                    /*if (!isset(self::$likebtn_settings[$option]) || !isset($matches_params[2][$matches_params_index])) {
                        continue;
                    }*/
                    $settings[$option] = self::prepareOption($option, $matches_params[2][$matches_params_index]);
                }

                // Get button markup
                $markup = self::getMarkup($content_type, $content->id, $settings, false, false, null);
                $replacements[$index] = $markup;
            }

            $text = preg_replace($regex_list, $replacements, $text, 1);

            // Inject buttons into text
            if (isset($content->fulltext)) {
                $content->fulltext = $text;
            }
            if (isset($content->text)) {
                $content->text = $text;
            }
        }

        return $content;
    }

    /**
     * Statistics ajax.
     */
    public static function ajaxController()
    {
        $response = array(
            'success' => true,
            'data' => null
        );

        // Ajax request
        $method = JRequest::getVar('method');

        if (JRequest::getVar('action') != 'ajax' || !$method) {
            return false;
        }

        try {
            $result = call_user_func(array('plgContentLikebtn', 'ajax'.ucfirst($method)), $response);
        } catch (Exceptino $e) {}

        if (!empty($result)) {
            $response = $result;
        }

        ob_clean();
        echo json_encode($response);
        exit();
    }

    /**
     * Statistics ajax.
     */
    public static function ajaxStatistics($response)
    {
        $response['data'] = array(
            'rows' => array(),
            'total_found' => 0
        );
        $rows = array();

        $params = JRequest::getVar('params');

        $db = JFactory::getDbo();

        $query = $db->getQuery(true);
        $query->select('SQL_CALC_FOUND_ROWS content_type, content_id, identifier, url, likes, dislikes, likes_minus_dislikes');
        $query->from('#__'.self::TABLE_LIKEBTN_ITEMS);
        $query->where('content_type = ' . $db->Quote($params['content_type']));

        // Filter
        if (!empty($params['id'])) {
            $query->where('content_id = ' . $db->Quote($params['id']) . ' or identifier = ' . $db->Quote($params['id']));
        }

        // Order
        if (!empty($params['order_by'])) {
            $query->order($params['order_by'] . ' DESC');
        }

        $db->setQuery($query);
        $results = $db->loadObjectList();

        // Total found
        if (count($results)) {
            $query = $db->getQuery(true);
            $query->select('FOUND_ROWS() as total_found');
            $db->setQuery($query);
            $total_found = $db->loadObject();
            $response['data']['total_found'] = $total_found->total_found;
        } else {
            $response['data']['total_found'] = 0;
        }

        foreach ($results as $result) {
            $row = array(
                'id' => '',
                'title' => '',
                'link' => '',
                'thumbnail' => '',
                'likes' => $result->likes,
                'dislikes' => $result->dislikes,
                'likes_minus_dislikes' => $result->likes_minus_dislikes
            );
            $content = self::getContent($result->content_type, $result->content_id, $db);

            if (!empty($content)) {
                // Content item
                $row['id'] = $content['id'];

                if (isset($content['name'])) {
                    $row['title'] = $content['name'];
                } elseif (isset($content['title'])) {
                    $row['title'] = $content['title'];
                } elseif (isset($content['body'])) {
                    $row['title'] = $content['body'];
                }
                $row['link'] = $result->url;
            } else {
                // Custom item
                $row['id'] = '-';
                $row['title'] = $result->identifier;
                $row['link'] = $result->url;
            }

            $rows[] = $row;
        }

        $response['data']['rows'] = $rows;

        return $response;
    }

    /**
     * Get plugin version
     */
    public static function getPluginV()
    {
        if (self::$plugin_v) {
            return self::$plugin_v;
        }

        // Load the data from the database.
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('manifest_cache');
        $query->from('#__extensions');
        $query->where("element = 'likebtn'");
        $db->setQuery($query);
        $extensions = $db->loadObject();

        // Check for a database error.
        if ($db->getErrorNum()) {
           return null;
        }

        if (isset($extensions->manifest_cache)) {
            if (function_exists('json_decode')) {
                $manifest_cache = json_decode($extensions->manifest_cache, true);
                if (!empty($manifest_cache['version'])) {
                    return $manifest_cache['version'];
                }
            }
        }

        return null;
    }

    /**
    * getArticleUrl
    *
    * Gets the static url for the article
    *
    * @param object $article - Joomla article object
    * @return string returns the permalink of a particular post or page
    **/
    /*private function getArticleUrl(&$article)
    {
        if (!is_null($article))
        {
            require_once( JPATH_SITE . DS . 'components' . DS . 'com_content' . DS . 'helpers' . DS . 'route.php');
			if(isset($article->id) && isset($article->catid))
			{
				$url = JRoute::_(ContentHelperRoute::getArticleRoute($article->id, $article->catid));
				return JRoute::_($this->baseURL . $url, true, 0);
			}
			else
			{
			    return $this->baseURL;
			}
        }
    }*/
}
