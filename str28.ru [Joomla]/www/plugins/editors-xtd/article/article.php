<?php


// no direct access 2
defined('_REXEC') or die;

/**
 * Editor Article buton
 *
 * @package		retina.Plugin
 * @subpackage	Editors-xtd.article
 * @since 1.5
 */
class plgButtonArticle extends JPlugin
{
	/**
	 * Constructor
	 *
	 * @access      protected
	 * @param       object  $subject The object to observe
	 * @param       array   $config  An array that holds the plugin configuration
	 * @since       1.5
	 */
	public function __construct(& $subject, $config)
	{
		parent::__construct($subject, $config);
		$this->loadLanguage();
	}


	/**
	 * Display the button
	 *
	 * @return array A four element array of (article_id, article_title, category_id, object)
	 */
	function onDisplay($name)
	{
		/*
		 * Javascript to insert the link
		 * View element calls jSelectArticle when an article is clicked
		 * jSelectArticle creates the link tag, sends it to the editor,
		 * and closes the select frame.
		 */
		$js = "
		function jSelectArticle(id, title, catid, object, link) {
			var tag = '<a href=\"' + link + '\">' + title + '</a>';
			jInsertEditorText(tag, '".$name."');
			SqueezeBox.close();
		}";

		$doc = JFactory::getDocument();
		$doc->addScriptDeclaration($js);

		JHtml::_('behavior.modal');

		/*
		 * Use the built-in element view to select the article.
		 * Currently uses blank class.
		 */
		$link = 'index.php?option=com_content&amp;view=articles&amp;layout=modal&amp;tmpl=component&amp;'.JSession::getFormToken().'=1';

		$button = new JObject();
		$button->set('modal', true);
		$button->set('link', $link);
		$button->set('text', RText::_('PLG_ARTICLE_BUTTON_ARTICLE'));
		$button->set('name', 'article');
		$button->set('options', "{handler: 'iframe', size: {x: 770, y: 400}}");

		return $button;
	}
}
