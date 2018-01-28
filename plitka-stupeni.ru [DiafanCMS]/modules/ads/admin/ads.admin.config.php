<?php
/**
 * @package    Diafan.CMS
 *
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
if (!defined('DIAFAN'))
{
    include dirname(dirname(dirname(__FILE__))) . '/includes/404.php';
}

/**
 * Ads_admin_config
 *
 * Конфигурация объявлений
 */
class Ads_admin_config extends Frame_admin
{
	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'base' => array (
			'nastr' => array(
				'type' => 'numtext',
				'name' => 'Количество объявлений на странице',
			),
			'hr1' => 'hr',
			'format_date' => array(
				'type' => 'select',
				'name' => 'Формат даты',
			),
			'hr2' => 'hr',
			'cat' => array(
				'type' => 'checkbox',
				'name' => 'Использовать категории',
			),
			'count_list' => array(
				'type' => 'numtext',
				'name' => 'Количество объявлений в списке категорий',
				'help' => 'Для первой страницы модуля, где выходят по несколько объявлений из всех категорий.',
			),
			'count_child_list' => array(
				'type' => 'numtext',
				'name' => 'Количество объявлений в списке вложенной категории',
				'help' => 'Для первой страницы модуля и для страницы категории',
			),
			'children_elements' => array(
				'type' => 'checkbox',
				'name' => 'Показывать объявления подкатегорий',
				'help' => 'Для списков объявлений, если перейти в категорию имеющую подкатегории. Если не отмечена, в категории будет просто список подкатегорий. Если отмечена, в категории будут показаны объявления из вложенных подкатегорий.',
			),
			'hr3' => 'hr',
			'search_text' => array(
				'type' => 'checkbox',
				'name' => 'Искать по описанию',
			),
			'search_name' => array(
				'type' => 'checkbox',
				'name' => 'Искать по названию',
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
			'hr4' => 'hr',
			'comments' => array(
				'type' => 'module',
				'name' => 'Подключить комментарии к объявлениям',
			),
			'tags' => array(
				'type' => 'module',
				'name' => 'Подключить теги',
			),
			'rating' => array(
				'type' => 'module',
				'name' => 'Показывать рейтинг объявлений',
			),
			'keywords' => array(
				'type' => 'module',
				'name' => 'Подключить перелинковку',
			),
			'hr5' => 'hr',
			'rel_two_sided' => array(
				'type' => 'checkbox',
				'name' => 'В блоке похожих объявлений связь двусторонняя',
			),
			'format_date' => array(
				'type' => 'select',
				'name' => 'Формат даты',
			),
			'only_user' => array(
				'type' => 'checkbox',
				'name' => 'Добавлять объявления могут только зарегистрированные пользователи',
			),
			'hr6' => 'hr',
			'captcha' => array(
				'type' => 'checkbox',
				'name' => 'Использовать защитный код (каптчу)',
			),
			'add_message' => array(
				'type' => 'textarea',
				'name' => 'Сообщение после отправки',
				'multilang' => true,
			),
			'premoderation' => array(
				'type' => 'checkbox',
				'name' => 'Предмодерация объявлений',
			),
			'hr7' => 'hr',
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
			'theme_list_param' => array(
				'type' => 'none',
				'name' => 'Шаблон для списка элементов с одинаковой характеристикой',
				'help' => 'Параметр для разработчиков! Не устанавливайте, если не уверены в результате.',
			),
			'view_list_param' => array(
				'type' => 'none',
			),
			'theme_list_search' => array(
				'type' => 'none',
				'name' => 'Шаблон для поиска элементов',
				'help' => 'Параметр для разработчиков! Не устанавливайте, если не уверены в результате.',
			),
			'view_list_search' => array(
				'type' => 'none',
			),
			'theme_list_my' => array(
				'type' => 'none',
				'name' => 'Шаблон для объявлений пользователя',
				'help' => 'Параметр для разработчиков! Не устанавливайте, если не уверены в результате.',
			),
			'view_list_my' => array(
				'type' => 'none',
			),
			'hr_admin_page' => 'hr',
			'admin_page'     => array(
				'type' => 'checkbox',
				'name' => 'Отдельный пункт в меню администрирования для каждого раздела сайта',
			),
		),
		'images' => array (
			'images' => array(
				'type' => 'module',
				'name' => 'Использовать изображения',
			),
		),
		'send_mails' => array (
			'emailconf' => array(
				'type' => 'function',
				'name' => 'E-mail, указываемый в обратном адресе пользователю',
			),
			'email' => array(
				'type' => 'none',
				'name' => 'впишите e-mail',
			),
			'hr8' => 'hr',
			'sendmailadmin' => array(
				'type' => 'checkbox',
				'name' => 'Уведомлять о поступлении новых объявлений на e-mail',
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
			'hr9' => 'hr',
			'sendsmsadmin' => array(
				'type' => 'checkbox',
				'name' => 'Уведомлять о поступлении новых объявлений по SMS',
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
		),
	);

	/**
	 * @var array названия табов
	 */
	public $tabs_name = array(
		'base' => 'Основные настройки',
		'images' => 'Изображения',
		'send_mails' => 'Сообщения и уведомления',
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
		'cat' => array(
			'count_list',
			'children_elements',
			'count_child_list',
			'title_tpl_cat',
			'keywords_tpl_cat',
			'descr_tpl_cat',
		),
		'sendmailadmin' => array(
			'emailconfadmin',
			'email_admin',
			'subject_admin',
			'message_admin',
		),		
		'sendsmsadmin' => array(
			'sms_admin',
			'sms_message_admin',
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

	/**
	 * Редактирование поля "Шаблон страницы для разных ситуаций"
	 * @return void
	 */
	public function edit_config_variable_themes()
	{
		$themes = $this->diafan->get_themes();
		$views = $this->diafan->get_views($this->diafan->module);

		echo '<tr>
					<td colspan="2">
						<hr color="#ddd" size="1" noshade="">
					</td>
				</tr>
		<tr id="theme_list">
			<td class="td_first">
				'.$this->diafan->variable_name("theme_list").'
			</td>
			<td>
				<select name="theme_list">
					<option value="">'.(! empty($themes['site.php']) ? $themes['site.php'] : 'site.php').'</option>';
		foreach ($themes as $key => $value)
		{
			if ($key == 'site.php')
				continue;
			echo '<option value="'.$key.'"'.( $this->diafan->values["theme_list"] == $key ? ' selected' : '' ).'>'.$value.'</option>';
		}
		echo '
				</select>
				<select name="view_list">
					<option value="">'.(! empty($views['list']) ? $views['list'] : $this->diafan->module.'.view.list.php').'</option>';
		foreach ($views as $key => $value)
		{
			if ($key == 'list')
			{
				continue;
			}
			echo '<option value="'.$key.'"'.( $this->diafan->values["view_list"] == $key ? ' selected' : '' ).'>'.$value.'</option>';
		}
		echo '
				</select>
				'.$this->diafan->help("theme_list").'
			</td>
		</tr>

		<tr id="theme_first_page">
			<td class="td_first">
				'.$this->diafan->variable_name("theme_first_page").'
			</td>
			<td>
				<select name="theme_first_page">
					<option value="">'.(! empty($themes['site.php']) ? $themes['site.php'] : 'site.php').'</option>';
		foreach ($themes as $key => $value)
		{
			if ($key == 'site.php')
				continue;
			echo '<option value="'.$key.'"'.( $this->diafan->values["theme_first_page"] == $key ? ' selected' : '' ).'>'.$value.'</option>';
		}
		echo '
				</select>
				<select name="view_first_page">
					<option value="">'.(! empty($views['first_page']) ? $views['first_page'] : $this->diafan->module.'.view.first_page.php').'</option>';
		foreach ($views as $key => $value)
		{
			if ($key == 'first_page')
			{
				continue;
			}
			echo '<option value="'.$key.'"'.( $this->diafan->values["view_first_page"] == $key ? ' selected' : '' ).'>'.$value.'</option>';
		}
		echo '
				</select>
				'.$this->diafan->help("theme_first_page").'
			</td>
		</tr>

		<tr id="theme_id">
			<td class="td_first">
				'.$this->diafan->variable_name("theme_id").'
			</td>
			<td>
				<select name="theme_id">
					<option value="">'.(! empty($themes['site.php']) ? $themes['site.php'] : 'site.php').'</option>';
		foreach ($themes as $key => $value)
		{
			if ($key == 'site.php')
				continue;
			echo '<option value="'.$key.'"'.( $this->diafan->values["theme_id"] == $key ? ' selected' : '' ).'>'.$value.'</option>';
		}
		echo '
				</select>
				<select name="view_id">
					<option value="">'.(! empty($views['id']) ? $views['id'] : $this->diafan->module.'.view.id.php').'</option>';
		foreach ($views as $key => $value)
		{
			if ($key == 'id')
			{
				continue;
			}
			echo '<option value="'.$key.'"'.( $this->diafan->values["view_id"] == $key ? ' selected' : '' ).'>'.$value.'</option>';
		}
		echo '
				</select>
				'.$this->diafan->help("theme_id").'
			</td>
		</tr>
		<tr id="theme_list_param">
			<td class="td_first">
				'.$this->diafan->variable_name("theme_list_param").'
			</td>
			<td>
				<select name="theme_list_param">
					<option value="">'.(! empty($themes['site.php']) ? $themes['site.php'] : 'site.php').'</option>';
		foreach ($themes as $key => $value)
		{
			if ($key == 'site.php')
				continue;
			echo '<option value="'.$key.'"'.( $this->diafan->values["theme_list_param"] == $key ? ' selected' : '' ).'>'.$value.'</option>';
		}
		echo '
				</select>
				<select name="view_list_param">
					<option value="">'.(! empty($views['list']) ? $views['list'] : $this->diafan->module.'.view.list.php').'</option>';
		foreach ($views as $key => $value)
		{
			if ($key == 'list')
			{
				continue;
			}
			echo '<option value="'.$key.'"'.( $this->diafan->values["view_list_param"] == $key ? ' selected' : '' ).'>'.$value.'</option>';
		}
		echo '
				</select>
				'.$this->diafan->help("theme_list_param").'
			</td>
		</tr>
		<tr id="theme_list_search">
			<td class="td_first">
				'.$this->diafan->variable_name("theme_list_search").'
			</td>
			<td>
				<select name="theme_list_search">
					<option value="">'.(! empty($themes['site.php']) ? $themes['site.php'] : 'site.php').'</option>';
		foreach ($themes as $key => $value)
		{
			if ($key == 'site.php')
				continue;
			echo '<option value="'.$key.'"'.( $this->diafan->values["theme_list_search"] == $key ? ' selected' : '' ).'>'.$value.'</option>';
		}
		echo '
				</select>
				<select name="view_list_search">
					<option value="">'.(! empty($views['list']) ? $views['list'] : $this->diafan->module.'.view.list.php').'</option>';
		foreach ($views as $key => $value)
		{
			if ($key == 'list')
			{
				continue;
			}
			echo '<option value="'.$key.'"'.( $this->diafan->values["view_list_search"] == $key ? ' selected' : '' ).'>'.$value.'</option>';
		}
		echo '
				</select>
				'.$this->diafan->help("theme_list_search").'
			</td>
		</tr>';
	}
}