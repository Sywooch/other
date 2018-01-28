<?php
/**
 * @package    Diafan.CMS
 *
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (! defined('DIAFAN'))
{
	include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

/**
 * Faq_admin_config
 *
 * Настройки модуля "Вопрос-Ответ"
 */
class Faq_admin_config extends Frame_admin
{
	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'config' => array (
			'nastr' => array(
				'type' => 'numtext',
				'name' => 'Количество вопросов на странице',
			),
			'only_user' => array(
				'type' => 'checkbox',
				'name' => 'Только для зарегистрированных пользователей',
			),
			'hr1' => 'hr',
			'cat' => array(
				'type' => 'checkbox',
				'name' => 'Использовать категории',
			),
			'count_list' => array(
				'type' => 'numtext',
				'name' => 'Количество вопросов в списке категорий',
			),
			'count_child_list' => array(
				'type' => 'numtext',
				'name' => 'Количество вопросов в списке вложенной категории',
				'help' => 'Для первой страницы модуля и для страницы категории',
			),
			'children_elements' => array(
				'type' => 'checkbox',
				'name' => 'Показывать вопросы подкатегорий',
			),
			'hr_count' => 'hr',
			'counter' => array(
				'type' => 'checkbox',
				'name' => 'Счетчик просмотров',
			),
			'counter_site' => array(
				'type' => 'checkbox',
				'name' => 'Выводить счетчик на сайте',
			),
			'hr2' => 'hr',
			'captcha' => array(
				'type' => 'checkbox',
				'name' => 'Использовать защитный код (каптчу)',
			),
			'format_date' => array(
				'type' => 'select',
				'name' => 'Формат даты',
			),
			'add_message' => array(
				'type' => 'textarea',
				'name' => 'Сообщение после отправки',
				'multilang' => true,
			),
			'error_insert_message' => array(
				'type' => 'text',
				'name' => 'Ваше сообщение уже имеется в базе',
				'multilang' => true,
			),
			'hr3' => 'hr',
			'attachments' => array(
				'type' => 'module',
				'name' => 'Разрешить добавление файлов',
			),
			'attachments_access_admin' => array(
				'type' => 'none',
			),
			'hr4' => 'hr',
			'subject' => array(
				'type' => 'text',
				'name' => 'Тема письма для ответа',
				'multilang' => true,
			),
			'message' => array(
				'type' => 'textarea',
				'name' => 'Сообщение для ответа',
				'multilang' => true,
			),
			'emailconf' => array(
				'type' => 'select',
				'name' => 'E-mail, указываемый в обратном адресе пользователю',
			),
			'email' => array(
				'type' => 'none',
				'name' => 'впишите e-mail',
			),
			'hr5' => 'hr',
			'sendmailadmin' => array(
				'type' => 'checkbox',
				'name' => 'Уведомлять о поступлении новых вопросов на e-mail',
			),
			'emailconfadmin' => array(
				'type' => 'function',
				'name' => 'E-mail для уведомлений администратора',
			),
			'email_admin' => array(
				'type' => 'none',
				'name' => 'впишите e-mail',
			),
			'subject_admin' => array(
				'type' => 'text',
				'name' => 'Тема письма для уведомлений',
			),
			'message_admin' => array(
				'type' => 'textarea',
				'name' => 'Сообщение для уведомлений',
			),
			'hr6' => 'hr',
			'sendsmsadmin' => array(
				'type' => 'checkbox',
				'name' => 'Уведомлять о поступлении новых вопросов по SMS',
			),
			'sms_admin' => array(
				'type' => 'text',
				'name' => 'Номер телефона в федеральном формате',
			),
			'sms_message_admin' => array(
				'type' => 'textarea',
				'name' => 'Сообщение для уведомлений',
				'help' => 'Не более 800 символов',
			),
			'hr7' => 'hr',
			'comments' => array(
				'type' => 'module',
				'name' => 'Показывать комментарии к вопросам',
			),
			'tags' => array(
				'type' => 'module',
				'name' => 'Подключить теги',
			),
			'rating' => array(
				'type' => 'module',
				'name' => 'Показывать рейтинг вопросов',
			),
			'keywords' => array(
				'type' => 'module',
				'name' => 'Подключить перелинковку',
			),
			'rel_two_sided' => array(
				'type' => 'checkbox',
				'name' => 'В блоке похожих вопросов связь двусторонняя',
			),
			'hr8' => 'hr',
			'title_tpl' => array(
				'type' => 'text',
				'name' => 'Шаблон для автоматического генерирования Title',
				'help' => 'Если шаблон задан, то заголовок автоматически генерируется по шаблону. В шаблон можно добавить %title - заданный заголовок, %name - название, %category - название категории, %parent_category - название категории верхнего уровня',
				'multilang' => true
			),
			'title_tpl_cat' => array(
				'type' => 'text',
				'name' => 'Шаблон для автоматического генерирования Title для категории',
				'help' => 'Если шаблон задан, то заголовок автоматически генерируется по шаблону. В шаблон можно добавить %title - заданный заголовок, %name - название категории, %parent - название категории верхнего уровня',
				'multilang' => true
			),
			'keywords_tpl' => array(
				'type' => 'text',
				'name' => 'Шаблон для автоматического генерирования Keywords',
				'help' => 'Если шаблон задан, то поле Keywords автоматически генерируется по шаблону. В шаблон можно добавить %keywords - заданные ключевые слова, %name - название, %category - название категории, %parent_category - название категории верхнего уровня',
				'multilang' => true
			),
			'keywords_tpl_cat' => array(
				'type' => 'text',
				'name' => 'Шаблон для автоматического генерирования Keywords для категории',
				'help' => 'Если шаблон задан, то поле Keywords автоматически генерируется по шаблону. В шаблон можно добавить %keywords - заданные ключевые слова, %name - название категории, %parent - название категории верхнего уровня',
				'multilang' => true
			),
			'descr_tpl' => array(
				'type' => 'text',
				'name' => 'Шаблон для автоматического генерирования Description',
				'help' => 'Если шаблон задан, то поле Description автоматически генерируется по шаблону. В шаблон можно добавить %descr - заданное описание, %name - название, %category - название категории, %parent_category - название категории верхнего уровня',
				'multilang' => true
			),
			'descr_tpl_cat' => array(
				'type' => 'text',
				'name' => 'Шаблон для автоматического генерирования Description для категории',
				'help' => 'Если шаблон задан, то поле Description автоматически генерируется по шаблону. В шаблон можно добавить %descr - заданное описание, %name - название категории, %parent - название категории верхнего уровня',
				'multilang' => true
			),
			'themes' => array(
				'type' => 'function',
			),
			'theme_list' => array(
				'type' => 'none',
				'name' => 'Шаблон для списка элементов',
				'help' => 'Параметр для разработчиков! Не устанавливайте, если не уверены в результате.',
			),
			'view_list' => array(
				'type' => 'none',
			),
			'theme_first_page' => array(
				'type' => 'none',
				'name' => 'Шаблон для первой страницы модуля (если подключены категории)',
				'help' => 'Параметр для разработчиков! Не устанавливайте, если не уверены в результате.',
			),
			'view_first_page' => array(
				'type' => 'none',
			),
			'theme_id' => array(
				'type' => 'none',
				'name' => 'Шаблон для страницы элемента',
				'help' => 'Параметр для разработчиков! Не устанавливайте, если не уверены в результате.',
			),
			'view_id' => array(
				'type' => 'none',
			),
			'hr_admin_page' => 'hr',
			'admin_page'     => array(
				'type' => 'checkbox',
				'name' => 'Отдельный пункт в меню администрирования для каждого раздела сайта',
			),
		),
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'element_site', // делит элементы по разделам (страницы сайта, к которым прикреплен модуль)
		'config', // файл настроек модуля
	);

	/**
	 * @var array зависимости между полями
	 */
	public $show_tr_click_checkbox = array(
		'sendmailadmin' => array(
			'emailconfadmin',
			'subject_admin',
			'message_admin',
		),
		'sendsmsadmin' => array(
			'sms_admin',
			'sms_message_admin',
		),
		'cat' => array(
			'count_list',
			'children_elements',
			'count_child_list',
			'title_tpl_cat',
			'keywords_tpl_cat',
			'descr_tpl_cat',
		),
		'counter' => array(
			'counter_site',
		),
	);

	/**
	 * @var array значения списков
	 */
	public $select_arr = array(
		'format_date' => array(
			0 => '1.05.2009',
			1 => '1 мая 2008 г.',
			2 => '1 мая',
			3 => '1 мая 2008, понедельник',
			4 => 'не отображать',
		),
	);

	/**
	 * Подготавливает конфигурацию модуля
	 * @return void
	 */
	public function prepare_config()
	{
		if(! SMS)
		{
			$this->diafan->variable("sendsmsadmin", "disabled", true);
			$name = $this->diafan->variable("sendsmsadmin", "name").'<br>'.$this->diafan->_('Необходимо %sнастроить%s SMS-уведомления.', '<a href="'.BASE_PATH_HREF.'config/">', '</a>');
			$this->diafan->variable("sendsmsadmin", "name", $name);
			$this->diafan->configmodules("sendsmsadmin", $this->diafan->module, $this->diafan->site, _LANG, 0);
		}
	}
}