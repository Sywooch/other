<?php
// No direct access to this file
defined('_REXEC') or die;
 
// import the list field type
jimport('retina.form.helper');
JFormHelper::loadFieldClass('list');
 
/**
 * PortfolioCategory Form Field class for the bt_portfolio component
 */
class JFormFieldPortfolioCategory extends JFormFieldList
{
	/**
	 * The field type.
	 *
	 * @var		string
	 */
	protected $type = 'PortfolioCategory';
 
	/**
	 * Method to get a list of options for a list input.
	 *
	 * @return	array		An array of JHtml options.
	 */
	protected function getOptions() 
	{	
		if(is_file(RPATH_admin.DS.'components'.DS.'com_bt_portfolio'.DS.'helpers'.DS.'helper.php')){
		JLoader::register('Bt_portfolioHelper', RPATH_admin.DS.'components'.DS.'com_bt_portfolio'.DS.'helpers'.DS.'helper.php');
		$options = Bt_portfolioHelper::getCategoryOptions();
		$options = array_merge(parent::getOptions(), $options);
		return $options;
		}
		else{
		return array();
		}
	}
	
}
