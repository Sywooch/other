<?php
/**
 * @package		Retina.Site
 * @subpackage	com_contact
 * 
 * 
 */

// No direct access
defined('_REXEC') or die;
jimport('retina.application.component.view');

class ContactViewContact extends JView
{
	protected $state;
	protected $element;

	public function display()
	{
		// Get model data.
		$state = $this->get('State');
		$element = $this->get('element');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseWarning(500, implode("\n", $errors));
			return false;
		}

		$doc = JFactory::getDocument();
		$doc->setMetaData('Content-Type', 'text/directory', true);

		// Initialise variables.
		$app		= JFactory::getApplication();
		$params 	= $app->getParams();
		$user		= JFactory::getUser();
		$dispatcher =& JDispatcher::getInstance();

		// Compute lastname, firstname and middlename
		$element->name = trim($element->name);

		// "Lastname, Firstname Midlename" format support
		// e.g. "de Gaulle, Charles"
		$namearray = explode(',', $element->name);
		if (count($namearray) > 1 ) {
			$lastname = $namearray[0];
			$card_name = $lastname;
			$name_and_midname = trim($namearray[1]);

			$firstname = '';
			if (!empty($name_and_midname)) {
				$namearray = explode(' ', $name_and_midname);

				$firstname = $namearray[0];
				$middlename = (count($namearray) > 1) ? $namearray[1] : '';
				$card_name = $firstname . ' ' . ($middlename ? $middlename . ' ' : '') .  $card_name;
			}
		}
		// "Firstname Middlename Lastname" format support
		else {
			$namearray = explode(' ', $element->name);

			$middlename = (count($namearray) > 2) ? $namearray[1] : '';
			$firstname = array_shift($namearray);
			$lastname = count($namearray) ? end($namearray) : '';
			$card_name = $firstname . ($middlename ? ' ' . $middlename : '') . ($lastname ? ' ' . $lastname : '');
		}

		$rev = date('c', strtotime($element->modified));

		JResponse::setHeader('Content-disposition', 'attachment; filename="'.$card_name.'.vcf"', true);

		$vcard = array();
		$vcard[].= 'BEGIN:VCARD';
		$vcard[].= 'VERSION:3.0';
		$vcard[] = 'N:'.$lastname.';'.$firstname.';'.$middlename;
		$vcard[] = 'FN:'. $element->name;
		$vcard[] = 'TITLE:'.$element->con_position;
		$vcard[] = 'TEL;TYPE=WORK,VOICE:'.$element->telephone;
		$vcard[] = 'TEL;TYPE=WORK,FAX:'.$element->fax;
		$vcard[] = 'TEL;TYPE=WORK,MOBILE:'.$element->mobile;
		$vcard[] = 'ADR;TYPE=WORK:;;'.$element->address.';'.$element->suburb.';'.$element->state.';'.$element->postcode.';'.$element->country;
		$vcard[] = 'LABEL;TYPE=WORK:'.$element->address."\n".$element->suburb."\n".$element->state."\n".$element->postcode."\n".$element->country;
		$vcard[] = 'EMAIL;TYPE=PREF,INTERNET:'.$element->email_to;
		$vcard[] = 'URL:'.$element->webpage;
		$vcard[] = 'REV:'.$rev.'Z';
		$vcard[] = 'END:VCARD';

		echo implode("\n", $vcard);
		return true;
	}
}
