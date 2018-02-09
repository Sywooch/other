<?php

/**
 * @project  LikeBtn Like Button
 * @author   LikeBtn.com (info@likebtn.com)
 * @copyright (Copyright (C) 2013 by LikeBtn. All rights reserved.
 * @license GNU/GPL: http://www.gnu.org/copyleft/gpl.html
 */

defined('JPATH_PLATFORM') or die;

jimport('joomla.form.formfield');

/**
 * Provides LikeBtn settings for content types
 *
 * @package     Joomla.Plugin
 * @subpackage  Likebtn
 * @since       2.5.5
 */
class JFormFieldLikebtncontenttypesettings extends JFormField {

    // The field class must know its own type through the variable $type.
    protected $type = 'Likebtncontenttypesettings';

    public function getLabel() {

        // Run sunchronization
        require_once(dirname(__FILE__).'/../../likebtn.php');
        require_once(dirname(__FILE__).'/../../likebtn.class.php');
        $likebtn = new LikeBtn(plgContentLikebtn::getPluginParams());
        $likebtn->runSyncVotes();

        JLoader::register("plgContentLikebtn", JPATH_PLUGINS.DIRECTORY_SEPARATOR."content".DIRECTORY_SEPARATOR."likebtn".DIRECTORY_SEPARATOR."likebtn.php");

        $doc = &JFactory::getDocument();
        $doc->addScript(JURI::root() . "plugins/content/likebtn/assets/js/admin.js");
        $doc->addStyleSheet(JURI::root() . "plugins/content/likebtn/assets/css/admin.css");

        $language = &JFactory::getLanguage();
        $likebtn_website_locale = substr($language->getTag(), 0, 2);

        if (!in_array($likebtn_website_locale, plgContentLikebtn::$likebtn_website_locales)) {
            $likebtn_website_locale = 'en';
        }
        $doc->addScript('//likebtn.com/' . $likebtn_website_locale . '/js/donate_generator.js');

        // Get a db connection.
        $db = JFactory::getDbo();

        // K2
        jimport('joomla.application.component.controller');
        // Check if component is installed
        $db->setQuery("SELECT enabled FROM #__extensions WHERE name = 'com_k2'");
        $k2_enabled = $db->loadResult();
        if ($k2_enabled) {
            // Get K2 categories
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select(array('id', 'name'));
            $query->from('#__k2_categories');
            $query->where('published = 1');
            $query->order('ordering ASC');
            $db->setQuery($query);
            $k2_categories = $db->loadObjectList();

            $k2_categories_options = array();
            foreach ($k2_categories as $k2_category) {
                $selected = false;
                $k2_categories_options[] = JHtml::_(
                    'select.option',
                    (string) $k2_category->id,
                    $k2_category->name,
                    'value',
                    'text',
                    $selected
                );
            }
        }

        $content_types = plgContentLikebtn::getSupportedContentTypes($db, $k2_enabled);

        ?>
        <div class="tabbable tabs-left">
            <ul id="likebtnContentTypeButtonTabs" class="nav nav-tabs">
            <?php foreach ($content_types as $content_type_index => $content_type): ?>
                <?php
                $content_type_show = '0';
                if (!empty($this->value[$content_type->type_alias])) {
                    $content_type_show = $this->value[$content_type->type_alias]['show'];
                }
                ?>
                <li class="<?php if ($content_type_index == 0): ?>active<?php endif ?>"><a data-toggle="tab" href="#content_type_pane_<?php echo $content_type->type_id ?>"><?php echo $content_type->type_title ?> <span <?php if ($content_type_show == '1'): ?>class="icon-save"<?php endif ?>></span></a></li>
            <?php endforeach ?>
            </ul>
            <div id="likebtnContentTypeButtonTabContent" class="tab-content">
                <?php foreach ($content_types as $content_type_index => $content_type): ?>
                    <?php
                        $name_prefix = 'jform[params][' . plgContentLikebtn::ADMIN_FIELD_NAME . '][' . $content_type->type_alias . ']';

                        if (empty($this->value[$content_type->type_alias])) {
                            $this->value[$content_type->type_alias] = array();
                        }
                        if (empty($this->value[$content_type->type_alias]['settings'])) {
                            $this->value[$content_type->type_alias]['settings'] = array();
                        }
                        $value = plgContentLikebtn::prepareGeneralSettings($this->value[$content_type->type_alias]);
                        $value['settings'] = plgContentLikebtn::prepareSettings($this->value[$content_type->type_alias]['settings']);

                        // Build a list of content types.
                        $content_types_options = array();

                        $selected = false;
                        if (empty($this->value[$content_type->type_alias]['use_settings_from']) || (string) $this->value[$content_type->type_alias]['use_settings_from'] == '') {
                            $selected = true;
                        }
                        $content_types_options[] = JHtml::_(
                            'select.option',
                            '',
                            '',
                            'value',
                            'text',
                            $selected
                        );

                        foreach ($content_types as $sub_content_type) {
                            if ($sub_content_type->type_alias == $content_type->type_alias) {
                                continue;
                            }
                            $selected = false;
                            if (!empty($this->value[$content_type->type_alias]['use_settings_from']) &&
                                (string)$this->value[$content_type->type_alias]['use_settings_from'] == $sub_content_type->type_alias)
                            {
                                $selected = true;
                            }
                            $content_types_options[] = JHtml::_(
                                'select.option',
                                (string) $sub_content_type->type_alias,
                                $sub_content_type->type_title,
                                'value',
                                'text',
                                $selected
                            );
                        }

                        // Style list.
                        $style_options = plgContentLikebtn::getStyles();
                        // Language list.
                        $language_options = array();
                        $language_options['auto'] = 'auto - ' . JText::_('Detect from client browser');
                        $languages = plgContentLikebtn::getLanguages();
                        foreach ($languages as $language_code=>$language_info) {
                            $language_options[$language_code] = $language_info;
                        }

                        // Exclude categories
                        if ($content_type->type_alias == 'com_k2.item' && !empty($k2_categories_options)) {
                            // K2 categories
                            $exclude_categories_html = JHtml::_('select.genericlist', $k2_categories_options, $name_prefix . '[exclude_categories][]', array('multiple'=>true, 'class'=>'likebtn_select_category'), 'value', 'text', $value['exclude_categories']);
                        } else {
                            // Joomla categories
                            $exclude_categories_html = $this->getJHTMLSelectCategory('exclude_categories', $content_type->type_alias, $value['exclude_categories'], array('class'=>'likebtn_select_category'));
                        }
                    ?>

                    <div class="tab-pane <?php if ($content_type_index == 0): ?>active<?php endif ?>" id="content_type_pane_<?php echo $content_type->type_id ?>" >
                        <legend><?php echo $content_type->type_title; ?></legend>
                        <div class="control-group">
                           <strong><?php echo JText::_('PLG_LIKEBTN_BUTTONS_CONTENT_TYPE_NAME'); ?></strong>
                            &nbsp;&nbsp;&nbsp;
                            <span class="disabled readonly"><?php echo $content_type->type_alias; ?></span>
                        </div>
                        <div class="control-group">
                            <div class="control-label">
                                <label title=""><strong><?php echo JText::_('PLG_LIKEBTN_BUTTONS_SHOW'); ?></strong></label>
                            </div>
                            <div class="controls">
                                <?php echo $this->getJHTMLSelectRadio('show', $content_type->type_alias,  array(), $value['show'], array('onclick' => "contentTypeShowChange(this, '{$content_type->type_alias}', '{$content_type->type_id}')")); ?>
                            </div>
                        </div>
                        <div id="content_type_container_<?php echo $content_type->type_alias; ?>" <?php if ($value['show'] != '1'): ?>style="display:none"<?php endif ?> >
                            <?php if ($value['show']): ?>
                            <div class="control-group">
                                <div class="control-label">
                                    <label title=""><strong><?php echo JText::_('PLG_LIKEBTN_BUTTONS_USE'); ?></strong></label>
                                </div>
                                <div class="controls">
                                    <?php echo JHtml::_('select.genericlist', $content_types_options, $name_prefix . '[use_settings_from]', array('onchange' => "useSettingsFromChange(this, '{$content_type->type_alias}')"), 'value', 'text', $value['use_settings_from']); ?><br/>
                                    <span class="disabled readonly">
                                        <?php echo JText::_('PLG_LIKEBTN_BUTTONS_CHOOSE'); ?>
                                    </span>
                                </div>
                            </div>
                            <div class="alert alert-info">
                                <?php echo JText::_('PLG_LIKEBTN_BUTTONS_YOU_CAN_FIND_DESCRIPTION'); ?>
                            </div>
                            <div id="use_settings_from_container_<?php echo $content_type->type_alias; ?>" <?php if ($value['use_settings_from']): ?>style="display:none"<?php endif ?> class="use_settings_from_container">


                                <ul id="likebtnContentTypeSettings<?php echo $content_type->type_id ?>Tabs" class="nav nav-tabs">
                                        <li class="active"><a data-toggle="tab" href="#content_type_settings_pane_<?php echo $content_type->type_id ?>_display_conditions"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_DISPLAY'); ?></a></li>
                                        <li><a data-toggle="tab" href="#content_type_settings_pane_<?php echo $content_type->type_id ?>_style_and_language"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_STYLE'); ?></a></li>
                                        <li><a data-toggle="tab" href="#content_type_settings_pane_<?php echo $content_type->type_id ?>_appearance_and_behaviour"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_APPEARANCE'); ?></a></li>
                                        <li><a data-toggle="tab" href="#content_type_settings_pane_<?php echo $content_type->type_id ?>_voting"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_VOTING'); ?></a></li>
                                        <li><a data-toggle="tab" href="#content_type_settings_pane_<?php echo $content_type->type_id ?>_counter"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_COUNTER'); ?></a></li>
                                        <li><a data-toggle="tab" href="#content_type_settings_pane_<?php echo $content_type->type_id ?>_popup"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_POPUP'); ?></a></li>
                                        <li><a data-toggle="tab" href="#content_type_settings_pane_<?php echo $content_type->type_id ?>_statistics"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_SHARING'); ?></a></li>
                                        <li><a data-toggle="tab" href="#content_type_settings_pane_<?php echo $content_type->type_id ?>_loader"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_LOADER'); ?></a></li>
                                        <li><a data-toggle="tab" href="#content_type_settings_pane_<?php echo $content_type->type_id ?>_tooltips"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_TOOLTIPS'); ?></a></li>
                                        <li><a data-toggle="tab" href="#content_type_settings_pane_<?php echo $content_type->type_id ?>_domains"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_DOMAINS'); ?></a></li>
                                        <li><a data-toggle="tab" href="#content_type_settings_pane_<?php echo $content_type->type_id ?>_debugging"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_DEBUGGING'); ?></a></li>
                                        <li><a data-toggle="tab" href="#content_type_settings_pane_<?php echo $content_type->type_id ?>_labels"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_LABELS'); ?></a></li>
                                </ul>
                                <div id="likebtnContentTypeSettings<?php echo $content_type->type_id ?>TabContent" class="tab-content">
                                    <div class="tab-pane active" id="content_type_settings_pane_<?php echo $content_type->type_id ?>_display_conditions" >
                                        <div class="well well-small">
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title=""><?php echo JText::_('PLG_LIKEBTN_BUTTONS_CONTENT'); ?></label>
                                                </div>
                                                <div class="controls">
                                                    <?php /*echo JHtml::_('select.genericlist', $content_view_mode_options, $name_prefix . '[content_view_mode]', array(), 'value', 'text', $value['content_view_mode']);*/ ?>
                                                   <?php /*echo JHtml::_('select.radiolist', $content_view_mode_options, $name_prefix . '[content_view_mode]', null, 'value', 'text', $value['content_view_mode']);*/ ?>
                                                   <?php echo $this->getJHTMLSelectRadio('content_view_mode', $content_type->type_alias,  array('full'=>JText::_('PLG_LIKEBTN_BUTTONS_FULL'), 'excerpt'=>JText::_('PLG_LIKEBTN_BUTTONS_EXCERPT'), 'both'=>JText::_('PLG_LIKEBTN_BUTTONS_BOTH')), $value['content_view_mode']); ?>
                                                   <br/>
                                                   <span class="disabled readonly">
                                                       <?php echo JText::_('PLG_LIKEBTN_BUTTONS_CHOOSE_CONTENT'); ?>
                                                   </span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title=""><?php echo JText::_('PLG_LIKEBTN_BUTTONS_EXCLUDE'); ?></label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $exclude_categories_html; ?>
                                                    <br/>
                                                    <span class="disabled readonly">
                                                        <?php echo JText::_('PLG_LIKEBTN_BUTTONS_SELECT'); ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title=""><?php echo JText::_('PLG_LIKEBTN_BUTTONS_USER_AUTHORIZATION'); ?></label>
                                                </div>
                                                <div class="controls">
                                                   <?php echo $this->getJHTMLSelectRadio('user_logged_in', $content_type->type_alias,  array('logged_in'=>JText::_('PLG_LIKEBTN_BUTTONS_LOGGED_IN'), 'not_logged_in'=>JText::_('PLG_LIKEBTN_BUTTONS_NOT_LOGGED_IN'), 'all'=>JText::_('PLG_LIKEBTN_BUTTONS_FOR_ALL')), $value['user_logged_in']); ?>
                                                   <br/>
                                                   <span class="disabled readonly">
                                                       <?php echo JText::_('PLG_LIKEBTN_BUTTONS_SHOW_THE'); ?>
                                                   </span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title=""><?php echo JText::_('PLG_LIKEBTN_BUTTONS_POSITION'); ?></label>
                                                </div>
                                                <div class="controls">
                                                   <?php echo $this->getJHTMLSelectRadio('position', $content_type->type_alias,  array('top'=>JText::_('PLG_LIKEBTN_BUTTONS_TOP'), 'bottom'=>JText::_('PLG_LIKEBTN_BUTTONS_BOTTOM'), 'both'=>JText::_('PLG_LIKEBTN_BUTTONS_TOP_AND')), $value['position']); ?>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title=""><?php echo JText::_('PLG_LIKEBTN_BUTTONS_ALIGNMENT'); ?></label>
                                                </div>
                                                <div class="controls">
                                                   <?php echo $this->getJHTMLSelectRadio('alignment', $content_type->type_alias,  array('left'=>JText::_('PLG_LIKEBTN_BUTTONS_LEFT'), 'center'=>JText::_('PLG_LIKEBTN_BUTTONS_CENTER'), 'right'=>JText::_('PLG_LIKEBTN_BUTTONS_RIGHT')), $value['alignment']); ?>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title=""><?php echo JText::_('PLG_LIKEBTN_BUTTONS_INSERT'); ?></label>
                                                </div>
                                                <div class="controls">
                                                   <?php echo $this->getJHTMLText('html_before', $content_type->type_alias, $value['html_before']); ?>
                                                   <span class="disabled readonly">
                                                       <?php echo JText::_('PLG_LIKEBTN_BUTTONS_HTML_CODE_BEFORE'); ?>
                                                   </span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title=""><?php echo JText::_('PLG_LIKEBTN_BUTTONS_INSERT_AFTER'); ?></label>
                                                </div>
                                                <div class="controls">
                                                   <?php echo $this->getJHTMLText('html_after', $content_type->type_alias, $value['html_after'],  array('cols'=>30, 'rows'=>5)); ?>
                                                   <span class="disabled readonly">
                                                       <?php echo JText::_('PLG_LIKEBTN_BUTTONS_HTML_CODE_AFTER'); ?>
                                                   </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="content_type_settings_pane_<?php echo $content_type->type_id ?>_style_and_language" >
                                        <div class="well well-small">
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[style]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo JHtml::_('select.genericlist', $style_options, $name_prefix . '[settings][style]', array(), 'value', 'text', $value['settings']['style']); ?>
                                                    <span class="disabled readonly"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_STYLE'); ?></span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[lang]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo JHtml::_('select.genericlist', $language_options, $name_prefix . '[settings][lang]', array(), 'value', 'text', $value['settings']['lang']); ?>
                                                    <span class="disabled readonly"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_LANGUAGE'); ?></span>
                                                </div>
                                            </div>
                                            <div class="alert alert-info">
                                                <?php echo JText::_('PLG_LIKEBTN_BUTTONS_YOU_CAN_FIND'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="content_type_settings_pane_<?php echo $content_type->type_id ?>_appearance_and_behaviour" >
                                        <div class="well well-small">
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[show_like_label]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $this->getJHTMLSelectRadio('settings][show_like_label', $content_type->type_alias,  array(), $value['settings']['show_like_label']); ?>
                                                    <span class="disabled readonly"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_SHOW_LIKE_LABEL'); ?></span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[show_dislike_label]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $this->getJHTMLSelectRadio('settings][show_dislike_label', $content_type->type_alias,  array(), $value['settings']['show_dislike_label']); ?>
                                                    <span class="disabled readonly"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_SHOW_DISLIKE_LABEL'); ?></span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[like_enabled]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $this->getJHTMLSelectRadio('settings][like_enabled', $content_type->type_alias,  array(), $value['settings']['like_enabled']); ?>
                                                    <span class="disabled readonly"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_SHOW'); ?></span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[dislike_enabled]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $this->getJHTMLSelectRadio('settings][dislike_enabled', $content_type->type_alias,  array(), $value['settings']['dislike_enabled']); ?>
                                                    <span class="disabled readonly"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_SHOW_DISLIKE'); ?></span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[icon_like_show]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $this->getJHTMLSelectRadio('settings][icon_like_show', $content_type->type_alias,  array(), $value['settings']['icon_like_show']); ?>
                                                    <span class="disabled readonly"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_ICON_LIKE_SHOW'); ?></span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[icon_dislike_show]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $this->getJHTMLSelectRadio('settings][icon_dislike_show', $content_type->type_alias,  array(), $value['settings']['icon_dislike_show']); ?>
                                                    <span class="disabled readonly"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_ICON_DISLIKE_SHOW'); ?></span>
                                                </div>
                                            </div>

                                            <div class="alert alert-info">
                                                <?php echo JText::_('PLG_LIKEBTN_BUTTONS_YOU_CAN_FIND'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="content_type_settings_pane_<?php echo $content_type->type_id ?>_voting" >
                                        <div class="well well-small">
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[display_only]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $this->getJHTMLSelectRadio('settings][display_only', $content_type->type_alias,  array(), $value['settings']['display_only']); ?>
                                                    <span class="disabled readonly"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_VOTING_DISABLED'); ?></span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[unlike_allowed]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $this->getJHTMLSelectRadio('settings][unlike_allowed', $content_type->type_alias,  array(), $value['settings']['unlike_allowed']); ?>
                                                    <span class="disabled readonly"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_ALLOW_UNLIKE'); ?></span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[like_dislike_at_the_same_time]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $this->getJHTMLSelectRadio('settings][like_dislike_at_the_same_time', $content_type->type_alias,  array(), $value['settings']['like_dislike_at_the_same_time']); ?>
                                                    <span class="disabled readonly"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_UNLIKE_ALLOWED'); ?></span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[revote_period]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $this->getJHTMLText('settings][revote_period', $content_type->type_alias, $value['settings']['revote_period']); ?>
                                                    <span class="disabled readonly"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_REVOTE_PERIOD'); ?></span>
                                                </div>
                                            </div>

                                            <div class="alert alert-info">
                                                <?php echo JText::_('PLG_LIKEBTN_BUTTONS_YOU_CAN_FIND'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="content_type_settings_pane_<?php echo $content_type->type_id ?>_counter" >
                                        <div class="well well-small">
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[counter_type]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $this->getJHTMLSelectRadio('settings][counter_type', $content_type->type_alias,  array('number'=>JText::_('PLG_LIKEBTN_BUTTONS_NUMBER'), 'percent'=>JText::_('PLG_LIKEBTN_BUTTONS_PERCENT'), 'subtract_dislikes'=>JText::_('PLG_LIKEBTN_BUTTONS_SUBSTRACT_DISLIKES'), 'single_number'=>JText::_('PLG_LIKEBTN_BUTTONS_SINGLE_NUMBER')), $value['settings']['counter_type']); ?>
                                                    <span class="disabled readonly"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_COUNTER_TYPE'); ?></span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[counter_clickable]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $this->getJHTMLSelectRadio('settings][counter_clickable', $content_type->type_alias,  array(), $value['settings']['counter_clickable']); ?>
                                                    <span class="disabled readonly"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_VOTES_COUNTER'); ?></span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[counter_show]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $this->getJHTMLSelectRadio('settings][counter_show', $content_type->type_alias,  array(), $value['settings']['counter_show']); ?>
                                                    <span class="disabled readonly"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_COUNTER_SHOW'); ?></span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[counter_padding]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $this->getJHTMLText('settings][counter_padding', $content_type->type_alias, $value['settings']['counter_padding']); ?>
                                                    <span class="disabled readonly"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_COUNTER_PADDING'); ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[counter_zero_show]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $this->getJHTMLSelectRadio('settings][counter_zero_show', $content_type->type_alias,  array(), $value['settings']['counter_zero_show']); ?>
                                                    <span class="disabled readonly"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_COUNTER_ZERO_SHOW'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="content_type_settings_pane_<?php echo $content_type->type_id ?>_popup" >
                                        <div class="well well-small">
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[popup_enabled]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $this->getJHTMLSelectRadio('settings][popup_enabled', $content_type->type_alias,  array(), $value['settings']['popup_enabled']); ?>
                                                    <span class="disabled readonly"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_SHOW_POPUP'); ?> (VIP, ULTRA)</span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[popup_dislike]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $this->getJHTMLSelectRadio('settings][popup_dislike', $content_type->type_alias,  array(), $value['settings']['popup_dislike']); ?>
                                                    <span class="disabled readonly"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_OFFER_TO_SHARE_AFTER_DISLIKING'); ?></span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[popup_position]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $this->getJHTMLSelectRadio('settings][popup_position', $content_type->type_alias, array('top'=>JText::_('PLG_LIKEBTN_BUTTONS_POPUP_TOP'), 'right'=>JText::_('PLG_LIKEBTN_BUTTONS_POPUP_RIGHT'), 'bottom'=>JText::_('PLG_LIKEBTN_BUTTONS_POPUP_BOTTOM'), 'left'=>JText::_('PLG_LIKEBTN_BUTTONS_POPUP_LEFT')), $value['settings']['popup_position']); ?>
                                                    <span class="disabled readonly"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_POPUP_POSITION'); ?></span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[popup_style]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $this->getJHTMLSelectRadio('settings][popup_style', $content_type->type_alias,  array('light'=>JText::_('PLG_LIKEBTN_BUTTONS_LIGHT'), 'dark'=>JText::_('PLG_LIKEBTN_BUTTONS_DARK')), $value['settings']['popup_style']); ?>
                                                    <span class="disabled readonly"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_POPUP_STYLE'); ?></span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[popup_hide_on_outside_click]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $this->getJHTMLSelectRadio('settings][popup_hide_on_outside_click', $content_type->type_alias,  array(), $value['settings']['popup_hide_on_outside_click']); ?>
                                                    <span class="disabled readonly"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_POPUP_HIDE_ON_OUTSIDE_CLICK'); ?></span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[show_copyright]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $this->getJHTMLSelectRadio('settings][show_copyright', $content_type->type_alias,  array(), $value['settings']['show_copyright']); ?>
                                                    <span class="disabled readonly"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_SHOW_COPYRIGHT'); ?> (VIP, ULTRA)</span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[popup_html]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $this->getJHTMLText('settings][popup_html', $content_type->type_alias, $value['settings']['popup_html']); ?>
                                                    <span class="disabled readonly"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_POPUP_HTML'); ?> (PRO, VIP, ULTRA)</span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[popup_donate]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $this->getJHTMLText('settings][popup_donate', $content_type->type_alias, $value['settings']['popup_donate']); ?> <a href="javascript:likebtnDG('jform_params__content_type_settings__com_content_article__settings__popup_donate_', true);void(0);" title="<?php echo JText::_('PLG_LIKEBTN_BUTTONS_CONFIGURE_DONATE'); ?>"><img class="popup_donate_trigger" src="<?php echo JURI::root(); ?>plugins/content/likebtn/assets/images/popup_donate.png" alt="<?php echo JText::_('PLG_LIKEBTN_BUTTONS_CONFIGURE_DONATE'); ?>"></a>
                                                    <span class="disabled readonly"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_POPUP_DONATE'); ?> (VIP, ULTRA)</span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[popup_content_order]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $this->getJHTMLText('settings][popup_content_order', $content_type->type_alias, $value['settings']['popup_content_order']); ?>
                                                    <span class="disabled readonly"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_POPUP_CONTENT_ORDER'); ?></span>
                                                </div>
                                            </div>


                                            <div class="alert alert-info">
                                                <?php echo JText::_('PLG_LIKEBTN_BUTTONS_YOU_CAN_FIND'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="content_type_settings_pane_<?php echo $content_type->type_id ?>_statistics" >
                                        <div class="well well-small">
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[share_enabled]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $this->getJHTMLSelectRadio('settings][share_enabled', $content_type->type_alias,  array(), $value['settings']['share_enabled']); ?>
                                                    <span class="disabled readonly"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_OFFER_TO_SHARE'); ?> (PLUS, PRO, VIP, ULTRA)</span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[addthis_pubid]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $this->getJHTMLText('settings][addthis_pubid', $content_type->type_alias, $value['settings']['addthis_pubid']); ?>
                                                    <span class="disabled readonly"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_ADDTHIS'); ?> (PRO, VIP, ULTRA)<br/><br/><?php echo JText::_('PLG_LIKEBTN_BUTTONS_ALLOWS_TO_COLLECT'); ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[addthis_service_codes]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $this->getJHTMLText('settings][addthis_service_codes', $content_type->type_alias, $value['settings']['addthis_service_codes']); ?>
                                                    <span class="disabled readonly"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_ADDTHIS_CODES'); ?> (PRO, VIP, ULTRA)<br/><br/><?php echo JText::_('PLG_LIKEBTN_BUTTONS_SERVICE_CODES'); ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="content_type_settings_pane_<?php echo $content_type->type_id ?>_loader" >
                                        <div class="well well-small">
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[lazy_load]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $this->getJHTMLSelectRadio('settings][lazy_load', $content_type->type_alias,  array(), $value['settings']['lazy_load']); ?>
                                                    <span class="disabled readonly"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_LAZY_LOAD'); ?></span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[loader_show]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $this->getJHTMLSelectRadio('settings][loader_show', $content_type->type_alias,  array(), $value['settings']['loader_show']); ?>
                                                    <span class="disabled readonly"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_LOADER_SHOW'); ?></span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[loader_image]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $this->getJHTMLText('settings][loader_image', $content_type->type_alias, $value['settings']['loader_image']); ?>
                                                    <span class="disabled readonly"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_LOADER_IMG'); ?><br/><br/><?php echo JText::_('PLG_LIKEBTN_BUTTONS_LOADER_IMG_DESCRIPTION'); ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="content_type_settings_pane_<?php echo $content_type->type_id ?>_tooltips" >
                                        <div class="well well-small">
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[tooltip_enabled]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $this->getJHTMLSelectRadio('settings][tooltip_enabled', $content_type->type_alias,  array(), $value['settings']['tooltip_enabled']); ?>
                                                    <span class="disabled readonly"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_SHOW_TOOLTIPS'); ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="content_type_settings_pane_<?php echo $content_type->type_id ?>_domains" >
                                        <div class="well well-small">
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[domain_from_parent]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $this->getJHTMLSelectRadio('settings][domain_from_parent', $content_type->type_alias,  array(), $value['settings']['domain_from_parent']); ?>
                                                    <span class="disabled readonly"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_DOMAIN_FROM_PARENT'); ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="content_type_settings_pane_<?php echo $content_type->type_id ?>_debugging" >
                                        <div class="well well-small">
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[event_handler]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $this->getJHTMLText('settings][event_handler', $content_type->type_alias, $value['settings']['event_handler']); ?>
                                                    <span class="disabled readonly"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_CALLBACK'); ?><br/><br/>
                                                        <?php echo JText::_('PLG_LIKEBTN_BUTTONS_THE_PROVIDED_FUNCTION'); ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[info_message]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $this->getJHTMLSelectRadio('settings][info_message', $content_type->type_alias,  array(), $value['settings']['info_message']); ?>
                                                    <span class="disabled readonly"><?php echo JText::_('PLG_LIKEBTN_BUTTONS_INFO_MESSAGE'); ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="content_type_settings_pane_<?php echo $content_type->type_id ?>_labels" >
                                        <div class="well well-small">
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[i18n_like]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $this->getJHTMLText('settings][i18n_like', $content_type->type_alias, $value['settings']['i18n_like']); ?>
                                                    <span class="disabled readonly">
                                                        <?php echo JText::_('PLG_LIKEBTN_BUTTONS_LIKE_BUTTON_LABEL'); ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[i18n_dislike]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $this->getJHTMLText('settings][i18n_dislike', $content_type->type_alias, $value['settings']['i18n_dislike']); ?>
                                                    <span class="disabled readonly">
                                                        <?php echo JText::_('PLG_LIKEBTN_BUTTONS_DISLIKE_BUTTON_LABEL'); ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[i18n_after_like]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $this->getJHTMLText('settings][i18n_after_like', $content_type->type_alias, $value['settings']['i18n_after_like']); ?>
                                                    <span class="disabled readonly">
                                                        <?php echo JText::_('PLG_LIKEBTN_BUTTONS_AFTER_LIKE_BUTTON_LABEL'); ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[i18n_after_dislike]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $this->getJHTMLText('settings][i18n_after_dislike', $content_type->type_alias, $value['settings']['i18n_after_dislike']); ?>
                                                    <span class="disabled readonly">
                                                        <?php echo JText::_('PLG_LIKEBTN_BUTTONS_AFTER_DISLIKE_BUTTON_LABEL'); ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[i18n_like_tooltip]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $this->getJHTMLText('settings][i18n_like_tooltip', $content_type->type_alias, $value['settings']['i18n_like_tooltip']); ?>
                                                    <span class="disabled readonly">
                                                        <?php echo JText::_('PLG_LIKEBTN_BUTTONS_TOOLTIP'); ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[i18n_dislike_tooltip]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $this->getJHTMLText('settings][i18n_dislike_tooltip', $content_type->type_alias, $value['settings']['i18n_dislike_tooltip']); ?>
                                                    <span class="disabled readonly">
                                                        <?php echo JText::_('PLG_LIKEBTN_BUTTONS_DISLIKE_TOOLTIP'); ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[i18n_unlike_tooltip]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $this->getJHTMLText('settings][i18n_unlike_tooltip', $content_type->type_alias, $value['settings']['i18n_unlike_tooltip']); ?>
                                                    <span class="disabled readonly">
                                                        <?php echo JText::_('PLG_LIKEBTN_BUTTONS_TOOLTIP_AFTER_LIKING'); ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[i18n_undislike_tooltip]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $this->getJHTMLText('settings][i18n_undislike_tooltip', $content_type->type_alias, $value['settings']['i18n_undislike_tooltip']); ?>
                                                    <span class="disabled readonly">
                                                        <?php echo JText::_('PLG_LIKEBTN_BUTTONS_TOOLTIP_AFTER_DISLIKING'); ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[i18n_share_text]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $this->getJHTMLText('settings][i18n_share_text', $content_type->type_alias, $value['settings']['i18n_share_text']); ?>
                                                    <span class="disabled readonly">
                                                        <?php echo JText::_('PLG_LIKEBTN_BUTTONS_TEXT_SHARE'); ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[i18n_popup_close]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $this->getJHTMLText('settings][i18n_popup_close', $content_type->type_alias, $value['settings']['i18n_popup_close']); ?>
                                                    <span class="disabled readonly">
                                                        <?php echo JText::_('PLG_LIKEBTN_BUTTONS_POPUP_CLOSE'); ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[i18n_popup_text]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $this->getJHTMLText('settings][i18n_popup_text', $content_type->type_alias, $value['settings']['i18n_popup_text']); ?>
                                                    <span class="disabled readonly">
                                                        <?php echo JText::_('PLG_LIKEBTN_BUTTONS_POPUP_SHARING_DISABLED'); ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">
                                                    <label title="">[i18n_popup_donate]</label>
                                                </div>
                                                <div class="controls">
                                                    <?php echo $this->getJHTMLText('settings][i18n_popup_donate', $content_type->type_alias, $value['settings']['i18n_popup_donate']); ?>
                                                    <span class="disabled readonly">
                                                        <?php echo JText::_('PLG_LIKEBTN_BUTTONS_I18N_POPUP_DONATE'); ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clr"></div>
                            <div class="control-group">
                                <div class="control-label">
                                    <label title=""><?php echo JText::_('PLG_LIKEBTN_BUTTONS_DEMO'); ?></label>
                                </div>
                                <div class="controls">
                                    <?php echo plgContentLikebtn::getMarkup($content_type->type_alias, 'demo', array(), true, true); ?>
                                </div>
                            </div>
                            <?php else: ?>
                                <div class="alert alert-info">
                                    <?php echo JText::_('PLG_LIKEBTN_BUTTONS_SAVE'); ?>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="control-group" style="visibility:hidden">
                            - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
        <script type="text/javascript">
            loadJQuery();
        </script>
        <?php
    }

    /**
     * Get input html
     *
     * @return string
     */
    public function getInput() {
        return '';
    }

    /**
     * Get radio HTML
     *
     */
    public function getJHTMLSelectRadio($name, $type_alias, $options = array(), $selected=null, $attribs=null) {
        // Joomla 2.5
        JLoader::register("JFormFieldRadio", JPATH_LIBRARIES.DIRECTORY_SEPARATOR."joomla".DIRECTORY_SEPARATOR."form".DIRECTORY_SEPARATOR."fields".DIRECTORY_SEPARATOR."radio.php");

        $form_field = new JFormFieldRadio();
        if (!$options) {
            $options = array(
                '1' => JText::_('JYES'),
                '0' => JText::_('JNO'),
            );
        }
        $attribs['class'] = 'btn-group';
        $attribs['default'] = '0';
        return $this->getJHTMLInput($form_field, $name, $type_alias, 'radio', $selected, $attribs, $options);
    }

    /**
     * Get select HTML
     */
    public function getJHTMLSelectCategory($name, $type_alias, $selected=array(), $attribs=null, $options = array()) {
        // Joomla 2.5
        JLoader::register("JFormFieldCategory", JPATH_LIBRARIES.DIRECTORY_SEPARATOR."joomla".DIRECTORY_SEPARATOR."form".DIRECTORY_SEPARATOR."fields".DIRECTORY_SEPARATOR."category.php");

        $form_field = new JFormFieldCategory();
        $attribs['extension'] = 'com_content';
        $attribs['default'] = '0';
        $attribs['multiple'] = 'multiple';
        return $this->getJHTMLInput($form_field, $name, $type_alias, 'category', $selected, $attribs, $options);
    }

    /**
     * Get textarea HTML
     *
     */
    public function getJHTMLText($name, $type_alias, $selected=array(), $attribs=null) {
        // Joomla 2.5
        JLoader::register("JFormFieldText", JPATH_LIBRARIES.DIRECTORY_SEPARATOR."joomla".DIRECTORY_SEPARATOR."form".DIRECTORY_SEPARATOR."fields".DIRECTORY_SEPARATOR."text.php");

        $form_field = new JFormFieldText();
        return $this->getJHTMLInput($form_field, $name, $type_alias, 'text', $selected, $attribs);
    }

    /**
     * Get HTML of the field
     *
     */
    public function getJHTMLInput($form_field, $name, $type_alias, $type, $selected=array(), $attribs=array(), $options=array()) {

        $xml = '<field name="jform[params][' . plgContentLikebtn::ADMIN_FIELD_NAME . '][' . $type_alias . '][' . $name . ']" type="text' . $type . '" ';

        if (is_array($attribs)) {
            foreach ($attribs as $attr_name => $attr_value) {
                $xml .= " {$attr_name}=\"$attr_value\" ";
            }
        }
        if (empty($attribs['onclick'])) {
            $attribs['onclick'] = '';
        }
        if (count($options)) {
            $xml .= '>';
            foreach ($options as $key=>$value) {
                $xml .= '<option value="' . $key . '" onclick="' . $attribs['onclick'] . '">' . $value . '</option>';
            }
            $xml .= '</field>';
        } else {
            $xml .= '/>';
        }

        $form_field->setup(simplexml_load_string($xml), $selected);

        return $form_field->getInput();
    }

}