<?php

/**
 * @version		$Id$
 * @author		Joomlaites
 * @package		Joomlaites
 * @subpackage	mod_jimagerotator
 * @copyright	Copyright (C) 2015 Joomlaites. All rights reserved.
 * @license		License GNU General Public License version 2 or later; see LICENSE.txt, see LICENSE.php
 */
// no direct access
defined('JPATH_BASE') or die;

JFormHelper::loadFieldClass('list');

/**
 * Create Radio List Button. With the ability to show/hide sub-options.
 * Example xml:
 * <field
 * 	name="mod_js_show_hide"
 * 	type="JSList"
 * 	default="1"
 * 	label="MOD_JS_LABEL"
 * 	description="MOD_JS_DESC">
 * 	<option value="1" sub_fields="mod_yes_field_1,mod_yes_field_2">JYES</option>
 * 	<option value="0" sub_fields="mod_no_field_1,mod_no_field_2">JNO</option>
 * </field>
 */
class JFormFieldJSList extends JFormFieldList {

	/**
	 * The form field type.
	 *
	 * @var    string
	 */
	protected $type = 'JSList';

	/**
	 * Active sub-fields.
	 * 
	 * @var		string
	 */
	protected $active_sub_fields = '';

	/**
	 * List of all sub-fields
	 * 
	 * @var		string
	 */
	protected $sub_fields_list = array();

	/**
	 * Method to get the field input markup.
	 *
	 * @return  string  The field input markup.
	 *
	 * @since   11.1
	 */
	protected function getInput() {
		if (!defined('JS_MODULE_OPTIONS_ASSETS')) {
			define('JS_MODULE_OPTIONS_ASSETS', 1);
			$uri = str_replace("\\", "/", str_replace(JPATH_SITE, JURI::base(), dirname(__FILE__)));
			$uri = str_replace("/administrator/", "", $uri);
			JHTML::script($uri . '/js/jsoptions.js');
			//JHTML::stylesheet($uri.'/assets/css/chosen.css');
		}

		// Initialize variables.
		$html = array();
		$attr = '';

		// Initialize some field attributes.
		$attr .= $this->element['class'] ? ' class="' . (string) $this->element['class'] . '"' : '';

		// To avoid user's confusion, readonly="true" should imply disabled="true".
		if ((string) $this->element['readonly'] == 'true' || (string) $this->element['disabled'] == 'true') {
			$attr .= ' disabled="disabled"';
		}

		$attr .= $this->element['size'] ? ' size="' . (int) $this->element['size'] . '"' : '';
		$attr .= $this->multiple ? ' multiple="multiple"' : '';

		// Initialize JavaScript field attributes.
		$on_change = ' onchange="';
		// Add new script
		$on_change .= ' js_HideOptions(js_subfield_' . $this->element['name'] . ');';
		$on_change .= "js_ShowOptionsByControl('" . $this->element['name'] . "', js_subfield_" . $this->element['name'] . "_data);";
		
		$on_change .= $this->element['onchange'] ? (string) $this->element['onchange'] : '';

		$on_change .= '"';

		$attr .= $on_change;

		// Get the field options.
		$options = (array) $this->getOptions();

		// Create a read-only list (no name) with a hidden input to store the value.
		if ((string) $this->element['readonly'] == 'true') {
			$html[] = JHtml::_('select.genericlist', $options, '', trim($attr), 'value', 'text', $this->value, $this->id);
			$html[] = '<input type="hidden" name="' . $this->name . '" value="' . $this->value . '"/>';
		}
		// Create a regular list.
		else {
			$html[] = JHtml::_('select.genericlist', $options, $this->name, trim($attr), 'value', 'text', $this->value, $this->id);
		}

		$this->onload_script();

		return implode($html);
	}

	/**
	 * Method to get the script onload
	 * 
	 * @return blank
	 */
	private function onload_script() {
		?>
		<script type="text/javascript">
			var js_subfield_<?php echo $this->element['name']; ?> = "<?php echo implode(',', $this->sub_fields_list); ?>";
			var js_subfield_<?php echo $this->element['name']; ?>_data = new Array();
					
		<?php foreach ($this->sub_fields_list as $key => $value): ?>
					js_subfield_<?php echo $this->element['name']; ?>_data["<?php echo $key; ?>"] = "<?php echo $value; ?>";
		<?php endforeach; ?>
				window.addEvent('load', function() {
					js_HideOptions(js_subfield_<?php echo $this->element['name']; ?>);
					js_ShowOptions('<?php echo $this->active_sub_fields; ?>');
					
					if($('jform_params_show_image1').checked == false){
						js_HideOptions('thumbnail_mode,use_ratio,image_width,image_height');
					}
					if($('jform_params_display_form').get('value') == 'folder_image'){
						js_ShowOptions('thumbnail_mode,use_ratio,image_width,image_height');
						js_HideOptions('description_max_chars');
					}
				});
		</script>
		<?php
		return;
	}

	/**
	 * Override getOptions Method to get sub fields list.
	 *
	 * @return  array  The field option objects.
	 */
	protected function getOptions() {
		// Initialize variables.
		$options = array();

		foreach ($this->element->children() as $option) {

			// Only add <option /> elements.
			if ($option->getName() != 'option') {
				continue;
			}

			// Create a new option object based on the <option /> element.
			$tmp = JHtml::_(
							'select.option', (string) $option['value'], JText::alt(trim((string) $option), preg_replace('/[^a-zA-Z0-9_\-]/', '_', $this->fieldname)), 'value', 'text', ((string) $option['disabled'] == 'true')
			);

			// Set some option attributes.
			$tmp->class = (string) $option['class'];

			// Get sub_fields.
			$sub_fields = str_replace("\n", '', trim($option['sub_fields']));
			if (!empty($sub_fields)) {
				$this->sub_fields_list = array_merge($this->sub_fields_list, array((string) $option['value'] => $sub_fields));
			}

			// Check if it's selected
			if ($option["value"] == $this->value) {
				$this->active_sub_fields = $sub_fields;
			}

			// Set some JavaScript option attributes.
			$tmp->onclick = (string) $option['onclick'];

			// Add the option object to the result set.
			$options[] = $tmp;
		}

		reset($options);

		return $options;
	}

}