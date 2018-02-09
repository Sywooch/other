<?php
// Version: 2.0 RC2; ManageSettings

global $scripturl;

// Important! Before editing these language files please read the text at the top of index.english.php.
$txt['modSettings_desc'] = 'Этот раздел позволяет изменять настройки различных функций и основные параметры Вашего форума. Пожалуйста, просмотрите <a href="' . $scripturl . '?action=admin;area=theme;sa=settings;th=%1$s;%3$s=%2$s">настройки темы оформления</a> для изменения дополнительных параметров. Вы можете просмотреть краткое описание каждой настройки, нажав на кнопку (?) рядом с ней.';
$txt['security_settings_desc'] = 'В данном разделе Вы можете выставить настройки безопасности и модерирования Вашего форума, включая настройки антиспама.';
$txt['modification_settings_desc'] = 'Данный раздел содержит настройки модов установленных на Ваш форум';

$txt['modification_no_misc_settings'] = 'Установленных модов, имеющих настройки, в данном разделе нет.';

$txt['pollMode'] = 'Голосования';
$txt['disable_polls'] = 'Запретить голосования';
$txt['enable_polls'] = 'Разрешить голосования';
$txt['polls_as_topics'] = 'Отображать существующие голосования как темы';
$txt['allow_guestAccess'] = 'Разрешить гостям просматривать форум';
$txt['userLanguage'] = 'Разрешить пользователям выбирать язык форума';
$txt['allow_editDisplayName'] = 'Разрешить пользователям изменять отображаемое имя';
$txt['allow_hideOnline'] = 'Разрешить пользователям не являющимися Администраторами скрывать свой онлайн статус';
$txt['guest_hideContacts'] = 'Не показывать информацию пользователей гостям форума';
$txt['titlesEnable'] = 'Разрешить подпись под аватаром';
$txt['enable_buddylist'] = 'Разрешить список друзей/игнорируемых';
$txt['default_personal_text'] = 'Подпись под аватаром по умолчанию';
$txt['number_format'] = 'Формат чисел по умолчанию';
$txt['time_format'] = 'Формат времени по умолчанию';
$txt['setting_time_offset'] = 'Разница во времени <div class="smalltext">(изменяется и в профилях пользователей.)</div>';
$txt['setting_default_timezone'] = 'Временная зона сервера';
$txt['failed_login_threshold'] = 'Количество неудачных попыток входа';
$txt['lastActive'] = 'Время, в течении которого, пользователь считается активным';
$txt['trackStats'] = 'Включить подробную статистику';
$txt['hitStats'] = 'Включить статистику просмотров (статистика должна быть включена)';
$txt['enableCompressedOutput'] = 'Использовать сжатие трафика';
$txt['disableTemplateEval'] = 'Отключить проверку шаблонов темы оформления';
$txt['databaseSession_enable'] = 'Хранить сессии в Базе Данных';
$txt['databaseSession_loose'] = 'Разрешать браузерам возвращаться на кэшированную страницу';
$txt['databaseSession_lifetime'] = 'Продолжительность сессии в секундах:';
$txt['enableErrorLogging'] = 'Включить протоколирование ошибок';
$txt['enableErrorQueryLogging'] = 'Включать в лог ошибок текст SQL-запроса к базе данных';
$txt['pruningOptions'] = 'Разрешить выполнять очистку логов';
$txt['pruneErrorLog'] = 'Удалять записи в логе ошибок старше <div class="smalltext">(0 - запретить)</div>';
$txt['pruneModLog'] = 'Удалять записи в  логе модерации старше <div class="smalltext">(0 - запретить)</div>';
$txt['pruneBanLog'] = 'Удалять логи бана старше:<div class="smalltext">(0 - запретить)</div>';
$txt['pruneReportLog'] = 'Удалять записи в логе докладов модератору старше <div class="smalltext">(0 - запретить)</div>';
$txt['pruneScheduledTaskLog'] = 'Удалять записи в логе диспетчера задач старше<div class="smalltext">(0 - запретить)</div>';
$txt['pruneSpiderHitLog'] = 'Удалять записи в логе активности поисковых машин старше<div class="smalltext">(0 - запретить)</div>';
$txt['cookieTime'] = 'Время действия cookies (в минутах):';
$txt['localCookies'] = 'Использовать локальное хранение cookies<div class="smalltext">(SSI с этой функцией работать не будет.)</div>';
$txt['globalCookies'] = 'Использовать независимые cookies для субдоменов<div class="smalltext">(сначала отключите локальное хранение cookies!)</div>';
$txt['secureCookies'] = 'Принудительные шифрованные Cookies<div class="smalltext">(Доступно только при HTTPS - соединении!)</div>';
$txt['securityDisable'] = 'Отключить проверку пароля для Администраторов';
$txt['send_validation_onChange'] = 'Требовать одобрения учетной записи после смены email адреса';
$txt['approveAccountDeletion'] = 'Запрашивать одобрение Администратора, когда пользователь удаляет учетную запись';
$txt['autoOptMaxOnline'] = 'Максимум пользователей Online во время оптимизации:<div class="smalltext">(0 - без ограничения.)</div>';
$txt['autoFixDatabase'] = 'Автоматически восстанавливать поврежденные таблицы';
$txt['allow_disableAnnounce'] = 'Разрешить пользователям отказываться от уведомлений форума';
$txt['disallow_sendBody'] = 'Не отправлять текст сообщения в уведомлениях';
$txt['queryless_urls'] = 'Разрешить дружественные URL <div class="smalltext"><strong>Только для Apache/Lighttpd!</strong></div>';
$txt['max_image_width'] = 'Максимальная ширина прикрепляемых изображений (0 = отменить)';
$txt['max_image_height'] = 'Максимальная высота прикрепляемых изображений (0 = отменить)';
$txt['enableReportPM'] = 'Разрешить сообщать о личных сообщениях';
$txt['max_pm_recipients'] = 'Максимальное количество получателей при отправке личного сообщения<div class="smalltext">(0 - без ограничений, на Администраторов не распространяется)</div>';
$txt['pm_posts_verification'] = 'Количество сообщений, после которого пользователи не будут вводить код при отсылке личных сообщений <div class="smalltext">(0 - без ограничений, на Администраторов не распространяется)</div>.';
$txt['pm_posts_per_hour'] = 'Количество личных сообщений которое может отослать пользователь в течение одного часа.<div class="smalltext">(0 - без ограничений, на Модераторов не распространяется)</div>';
$txt['compactTopicPagesEnable'] = 'Ограничить количество отображаемых страниц';
$txt['contiguous_page_display'] = 'Формат отображения нескольких страниц:';
$txt['to_display'] = 'для отображения';
$txt['todayMod'] = 'Разрешить функцию &quot;Сегодня&quot;';
$txt['today_disabled'] = 'Запретить';
$txt['today_only'] = 'Только Сегодня';
$txt['yesterday_today'] = 'Сегодня и Вчера';
$txt['topbottomEnable'] = 'Отображать кнопки ВВЕРХ/ВНИЗ';
$txt['onlineEnable'] = 'Отображать статус онлайн/оффлайн в сообщениях пользователей';
$txt['enableVBStyleLogin'] = 'Показывать функцию быстрого входа на форум на каждой странице';
$txt['defaultMaxMembers'] = 'Количество пользователей на страницу (в списке пользователей)';
$txt['timeLoadPageEnable'] = 'Отображать время, затраченное на создание страницы';
$txt['disableHostnameLookup'] = 'Не отображать названия хостов пользователей';
$txt['who_enabled'] = 'Разрешить список "Пользователи Онлайн"';
$txt['make_email_viewable'] = 'Разрешить отображать e-mail адреса пользователей';
$txt['meta_keywords'] = 'Ключевые слова соответствующие форуму (тег "meta keywords"). <div class="smalltext">Предназначено для поисковых роботов. Оставить пустым для использования значений по умолчанию.</div>';

$txt['karmaMode'] = 'Функция кармы';
$txt['karma_options'] = 'Отменить|Отображать общую карму|Отображать отдельно плюс/минус';
$txt['karmaMinPosts'] = 'Минимальное количество сообщений для изменения кармы пользователей';
$txt['karmaWaitTime'] = 'Время ожидания в часах';
$txt['karmaTimeRestrictAdmins'] = 'Ограничить Администраторов временем ожидания';
$txt['karmaLabel'] = 'Название кармы';
$txt['karmaApplaudLabel'] = 'Метка для прибавления кармы';
$txt['karmaSmiteLabel'] = 'Метка для уменьшения кармы';

$txt['caching_information'] = '<div class="aligncenter underline"><strong>Внимание! Прежде чем задействовать эту функцию, прочтите следующую информацию.</strong></div><br />
	SMF поддерживает кэширование с помощью акселераторов. Поддерживаются следующие акселераторы:<br />
	<ul class="normallist"> 
		<li>APC</li>
		<li>eAccelerator</li>
		<li>Turck MMCache</li>
		<li>Memcached</li>
		<li>Zend Platform/Performance Suite (Не Zend Optimizer)</li> 
		<li>XCache</li>
	</ul>
	Кэширование будет работать лучше, если PHP скомпилирован с поддержкой одного из упомянутых выше оптимизаторов или на сервере доступен memcached.
	Если ни один из оптимизаторов не установлен, SMF будет использовать собственное кэширование на файлах.<br /><br />
	SMF поддерживает несколько уровней кэширования. Чем выше уровень, тем больше загрузка процессора сервера. Если Ваш сервер поддерживает кэширование, рекомендуется сначала попробовать первый уровень.
	<br /><br />
	Обратите внимание: если Вы используете memcached, ниже Вы должны указать некоторые настройки. Вводите их через запятую, как показано на примере:
	<br />
	&quot;сервер1,сервер2,сервер3:порт,сервер4&quot;<br /><br />
	Если порт не указан, SMF будет использовать порт по умолчанию - 11211. SMF будет пытаться автоматически сбалансировать нагрузку между серверами.
	<br /><br />
	%1$s
	<hr />';

$txt['detected_no_caching'] = '<strong class="alert">На Вашем сервере не обнаружено поддерживаемых SMF акселераторов.</strong>';
$txt['detected_APC'] = '<strong style="color: green">На Вашем сервере установлен APC.</strong>';
$txt['detected_eAccelerator'] = '<strong style="color: green">На Вашем сервере установлен eAccelerator.</strong>';
$txt['detected_MMCache'] = '<strong style="color: green"На Вашем сервере установлен MMCache.</strong>';
$txt['detected_Zend'] = '<strong style="color: green">На Вашем сервере установлен Zend Accelerator.</strong>';
$txt['detected_Memcached'] = '<strong style="color: green">На Вашем сервере установлен Memcached.</strong>';
$txt['detected_XCache'] = '<strong style="color: green">На Вашем сервере установлен XCache.</strong>';

$txt['cache_enable'] = 'Уровень кэширования';
$txt['cache_off'] = 'Кэширование отключено';
$txt['cache_level1'] = 'Уровень 1 (Рекомендуется)';
$txt['cache_level2'] = 'Уровень 2';
$txt['cache_level3'] = 'Уровень 3 (Не рекомендуется)';
$txt['cache_memcached'] = 'Настройка Memcache:';

$txt['loadavg_warning'] = '<span class="error">Внимание: приведенные ниже настройки изменяйте с осторожностью. Установка любой из них в слишком маленькое значение может сделать форум <strong>неработоспособным</strong>!</span>';
$txt['loadavg_enable'] = 'Включить балансировку нагрузки по среднему значению (load averages)';
$txt['loadavg_auto_opt'] = 'Порог для отключения автоматической оптимизации базы данных';
$txt['loadavg_search'] = 'Порог для отключения поиска';
$txt['loadavg_allunread'] = 'Порог для отключения функции "Все непрочитанные сообщения"';
$txt['loadavg_unreadreplies'] = 'Порог для отключения функции "Непрочитанные ответы"';
$txt['loadavg_show_posts'] = 'Порог для отключения функции "Показать сообщения пользователя"';
$txt['loadavg_forum'] = 'Порог для <strong>полного</strong> отключения форума';

$txt['setting_password_strength'] = 'Требования к длине пароля пользователей';
$txt['setting_password_strength_low'] = 'Низкое - минимум 4 символа';
$txt['setting_password_strength_medium'] = 'Среднее - не может совпадать с именем пользователя';
$txt['setting_password_strength_high'] = 'Высокое - сочетание различных символов';

$txt['antispam_Settings'] = 'Антиспам проверка';
$txt['antispam_Settings_desc'] = 'Этот раздел позволяет настроить проверку контрольным кодом, чтобы определить что пользователь человек (а не БОТ), и настроить где и как применять.';
$txt['setting_reg_verification'] = 'Требовать проверку на странице регистрации';
$txt['posts_require_captcha'] = 'Количество попыток после которых пользователь должен пройти проверку кодом для отправки сообщения';
$txt['posts_require_captcha_desc'] = '(0 - без ограничений, на модераторов не распространяется)';
$txt['search_enable_captcha'] = 'Использовать код проверки при поиске гостями';
$txt['setting_guests_require_captcha'] = 'Гости смогут воспользоваться поиском только после прохождения проверки кодом';
$txt['setting_guests_require_captcha_desc'] = '(Устанавливается автоматически, если установлено минимальное количество предыдущих попыток)';

$txt['configure_verification_means'] = 'Настройка метода проверки кодом';
$txt['setting_qa_verification_number'] = 'Количество проверочных вопросов';
$txt['setting_qa_verification_number_desc'] = '(0 - запретить; или введите количество)';
$txt['configure_verification_means_desc'] = '<span class="smalltext">Включение проверки антиспама требуется для того, чтобы отсеять при вводе данных различных ботов и роботов. Помните, что пользователь будет вынужден пройти <em>ВСЕ</em> проверки, которые вы разрешите, как проверку ввода значений с картинки, так и ответы на вопросы.</span>';
$txt['setting_visual_verification_type'] = 'Сложность изображения визуальной проверки';
$txt['setting_visual_verification_type_desc'] = 'Более сложное изображение тяжелее обходить ботам';
$txt['setting_image_verification_off'] = 'Запретить';
$txt['setting_image_verification_vsimple'] = 'Очень простое - Обычный текст на изображении';
$txt['setting_image_verification_simple'] = 'Простое - Цветные символы, без шума';
$txt['setting_image_verification_medium'] = 'Среднее - Накладывать шум и линии на цветные символы';
$txt['setting_image_verification_high'] = 'Высокое - Наклонные символы, со значительными шумами и линиями';
$txt['setting_image_verification_extreme'] = 'Очень высокое - Наклонные символы, шум, линии и блоки';
$txt['setting_image_verification_sample'] = 'Пример';
$txt['setting_image_verification_nogd'] = '<strong>Обратите внимание:</strong> так как на данном сервере не установлена библиотека GD, то настройки сложности ничего не изменят.';
$txt['setup_verification_questions'] = 'Проверочные вопросы';
$txt['setup_verification_questions_desc'] = '<span class="smalltext">Если вы хотите, чтобы пользователи отвечали на проверочные вопросы, чтобы отсеять на этом этапе роботов и ботов, то введите вопросы и ответы на них в таблице ниже. Вы можете использовать BB-коды для форматирования вопросов, они не учитываются системой. Ответы от пользователей буду приниматься в регистронезависимом виде.</span>';
$txt['setup_verification_question'] = 'Вопрос';
$txt['setup_verification_answer'] = 'Ответ';
$txt['setup_verification_add_more'] = 'Добавить еще один вопрос';

$txt['moderation_settings'] = 'Настройки системы предупреждений';
$txt['setting_warning_enable'] = 'Разрешить систему предупреждения пользователей';
$txt['setting_warning_watch'] = 'Уровень предупреждения - пользователь под наблюдением<div class="smalltext">Уровень предупреждения пользователя после которого он становится под наблюдением - 0 - запретить.</div>';
$txt['setting_warning_moderate'] = 'Уровень предупреждения - премодерация сообщений<div class="smalltext">Уровень предупреждения пользователя после которого все сообщения требуют модерации - 0 - запретить.</div>';
$txt['setting_warning_mute'] = 'Уровень предупреждения - пользователь молчит<div class="smalltext">Уровень предупреждения пользователя после которого пользователь не может оставлять сообщения - 0 - запретить.</div>';
$txt['setting_user_limit'] = 'Максимальное количество балов предупреждений в день<div class="smalltext">Данное значение определяет максимально количество балов предупреждения, которое может выставить пользователю модератор в течении 24 часов - 0 - без ограничений.</div>';
$txt['setting_warning_decrement'] = 'Уменьшение количества балов предупреждений каждые 24 часа<div class="smalltext">Применяется только к тем пользователям, у которых не было предупреждений 24 часа - 0 - запретить.</div>';
$txt['setting_warning_show'] = 'Пользователи которые могут видеть статус предупреждений. <div class="smalltext">Если запрещено, то только Модераторы смогут видеть статус предупреждений.</div>';
$txt['setting_warning_show_mods'] = 'Только модераторы';
$txt['setting_warning_show_user'] = 'Модераторы и предупреждаемые пользователи';
$txt['setting_warning_show_all'] = 'Все пользователи';

$txt['signature_settings'] = 'Настройка подписей';
$txt['signature_settings_desc'] = 'Используйте данные настройки для определения вида подписи пользователя в SMF.';
$txt['signature_settings_warning'] = 'Обратите внимание, что по умолчанию эти настройки не применяются к уже существующим подписям. Нажмите <a href="' . $scripturl . '?action=admin;area=featuresettings;sa=sig;apply;%2$s=%1$s">сюда</a> для применения настроек ко всем существующим подписям.';
$txt['signature_enable'] = 'Разрешить подписи';
$txt['signature_max_length'] = 'Максимальное количество символов<div class="smalltext">(0 - без ограничений)</div>';
$txt['signature_max_lines'] = 'Максимально количество строк<div class="smalltext">(0 - без ограничений)</div>';
$txt['signature_max_images'] = 'Максимальное количество изображений<div class="smalltext">(0 - без ограничений - смайлы не учитываются)</div>';
$txt['signature_max_smileys'] = 'Максимальное количество смайлов<div class="smalltext">(0 - без ограничений)</div>';
$txt['signature_max_image_width'] = 'Максимальная ширина изображения в подписи (пикселей)<div class="smalltext">(0 - без ограничений)</div>';
$txt['signature_max_image_height'] = 'Максимальная высота изображения в подписи (пикселей)<div class="smalltext">(0 - без ограничений)</div>';
$txt['signature_max_font_size'] = 'Максимальный размер шрифта в подписи<div class="smalltext">(0 - без ограничений)</div>';
$txt['signature_bbc'] = 'Разрешенные BB тэги';

$txt['custom_profile_title'] = 'Расширенные поля профиля';
$txt['custom_profile_desc'] = 'В данном разделе Вы можете создавать свои собственные поля профиля с учетом требований Вашего форума';
$txt['custom_profile_active'] = 'Активное';
$txt['custom_profile_fieldname'] = 'Название поля';
$txt['custom_profile_fieldtype'] = 'Тип поля';
$txt['custom_profile_make_new'] = 'Новое поле';
$txt['custom_profile_none'] = 'Вы еще не создали дополнительные поля профиля!';
$txt['custom_profile_icon'] = 'Иконка';

$txt['custom_profile_type_text'] = 'Текст';
$txt['custom_profile_type_textarea'] = 'Многострочный текст';
$txt['custom_profile_type_select'] = 'Список выбора';
$txt['custom_profile_type_radio'] = 'Выбор варианта';
$txt['custom_profile_type_check'] = 'Переключатель';

$txt['custom_add_title'] = 'Добавить поле профиля';
$txt['custom_edit_title'] = 'Изменить поле профиля';
$txt['custom_edit_general'] = 'Настройки отображения';
$txt['custom_edit_input'] = 'Настройки ввода';
$txt['custom_edit_advanced'] = 'Расширенные настройки';
$txt['custom_edit_name'] = 'Название';
$txt['custom_edit_desc'] = 'Описание';
$txt['custom_edit_profile'] = 'Раздел профиля';
$txt['custom_edit_profile_desc'] = 'Раздел профиля для изменения настроек.';
$txt['custom_edit_profile_none'] = 'Нет';
$txt['custom_edit_registration'] = 'Отображать при регистрации';
$txt['custom_edit_registration_disable'] = 'Нет';
$txt['custom_edit_registration_allow'] = 'Да';
$txt['custom_edit_registration_require'] = 'Да, обязательное';
$txt['custom_edit_display'] = 'Отображать при просмотре темы';
$txt['custom_edit_picktype'] = 'Тип поля';

$txt['custom_edit_max_length'] = 'Максимальная длина';
$txt['custom_edit_max_length_desc'] = '(0 - без ограничений)';
$txt['custom_edit_dimension'] = 'Измерение';
$txt['custom_edit_dimension_row'] = 'Рядов';
$txt['custom_edit_dimension_col'] = 'Столбцов';
$txt['custom_edit_bbc'] = 'Разрешить BB коды';
$txt['custom_edit_options'] = 'Настройки';
$txt['custom_edit_options_desc'] = 'Оставьте поле выбора пустым для удаления. Будет выбран параметр по умолчанию.';
$txt['custom_edit_options_more'] = 'Дополнительно';
$txt['custom_edit_default'] = 'Значение по умолчанию';
$txt['custom_edit_active'] = 'Активное';
$txt['custom_edit_active_desc'] = 'Если не выбрать, данное поле никому отображаться не будет.';
$txt['custom_edit_privacy'] = 'Права на изменение и просмотр';
$txt['custom_edit_privacy_desc'] = 'Кто может просматривать и изменять данное поле.';
$txt['custom_edit_privacy_all'] = 'Пользователи могут просматривать, владелец изменять';
$txt['custom_edit_privacy_see'] = 'Пользователи могут просматривать, только администратор может изменять';
$txt['custom_edit_privacy_owner'] = 'Пользователи не могут видеть это поле; владелец и администраторы могут редактировать его.';
$txt['custom_edit_privacy_none'] = 'Данное поле видно только администратору';
$txt['custom_edit_can_search'] = 'Выдается в поиске';
$txt['custom_edit_can_search_desc'] = 'По данному полю можно искать в списке пользователей.';
$txt['custom_edit_mask'] = 'Маска';
$txt['custom_edit_mask_desc'] = 'Текстовым полям можно задать маску для проверки вводимых данных.';
$txt['custom_edit_mask_email'] = 'Проверка Email';
$txt['custom_edit_mask_number'] = 'Числовая';
$txt['custom_edit_mask_nohtml'] = 'Без HTML';
$txt['custom_edit_mask_regex'] = 'Регулярные выражения в маске (Для экспертов)';
$txt['custom_edit_enclose'] = 'Показывать с дополнительным текстом (По желанию)';
$txt['custom_edit_enclose_desc'] = '<strong>Настоятельно</strong> рекомендуется использовать маску для проверки вводимых пользователем данных.';

$txt['custom_edit_placement'] = 'Выберите размещение';
$txt['custom_edit_placement_standard'] = 'Стандартное (с названием поля)';
$txt['custom_edit_placement_withicons'] = 'Рядом с иконками';
$txt['custom_edit_placement_abovesignature'] = 'Над подписью';
$txt['custom_profile_placement'] = 'Размещение';
$txt['custom_profile_placement_standard'] = 'Стандартное';
$txt['custom_profile_placement_withicons'] = 'Рядом с иконками';
$txt['custom_profile_placement_abovesignature'] = 'Над подписью';

// Use numeric entities in the string below!
$txt['custom_edit_delete_sure'] = 'Вы уверены что хотите удалить это поле - все текущие данные пользователей будут потеряны!';

$txt['standard_profile_title'] = 'Стандартные поля профиля';
$txt['standard_profile_field'] = 'Поле';

$txt['core_settings_welcome_msg'] = 'Добро Пожаловать на Ваш новый форум';
$txt['core_settings_welcome_msg_desc'] = 'Для начала, мы предлагаем выбрать Вам какие возможности форума SMF Вы хотите включить. Мы рекомендуем включать только то, что Вам действительно необходимо!';
$txt['core_settings_item_cd'] = 'Календарь';
$txt['core_settings_item_cd_desc'] = 'Данная возможность позволяет Вам и Вашим пользователям просматривать и создавать события в календаре, просматривать дни рождения и многое другое.';
$txt['core_settings_item_cp'] = 'Расширенные поля профиля';
$txt['core_settings_item_cp_desc'] = 'Данная возможность позволяет Вам скрывать стандартные поля профиля, добавлять дополнительные поля при регистрации и создавать новые поля профиля для Вашего форума.';
$txt['core_settings_item_k'] = 'Карма';
$txt['core_settings_item_k_desc'] = 'Карма - это возможность, позволяющая отображать популярность (или уровень доверия) пользователя. Если разрешено, пользователи могут \'прибавлять\' или \'убавлять\' карму другим пользователям, таким образом и подсчитывается популярность.';
$txt['core_settings_item_ml'] = 'Логи модерации';
$txt['core_settings_item_ml_desc'] = 'Разрешив логи модерации Вы сможете вести логи всех действий модераторов на форуме.';
$txt['core_settings_item_pm'] = 'Премодерация сообщений';
$txt['core_settings_item_pm_desc'] = 'Премодерация сообщений позволяет выбранным группам пользователей в разделах оставлять сообщения требующие одобрение сообщений до их публикации на форуме. После включения данной возможности настройте соответствующие права доступа.';
$txt['core_settings_item_ps'] = 'Платная подписка';
$txt['core_settings_item_ps_desc'] = 'Платная подписка позволяет пользователям оплачивая подписку изменить членство в группе, а также изменить права доступа.';
$txt['core_settings_item_rg'] = 'Генератор отчетов';
$txt['core_settings_item_rg_desc'] = 'Данная административная настройка позволяет генерировать отчеты (которые можно распечатать) для представления текущих настроек форума - особенно полезно для больших форумов.';
$txt['core_settings_item_sp'] = 'Поисковые системы';
$txt['core_settings_item_sp_desc'] = 'Данная возможность позволяет Администраторам отслеживать активность поисковых систем на форуме.';
$txt['core_settings_item_w'] = 'Система предупреждений';
$txt['core_settings_item_w_desc'] = 'Данный комплекс функций позволяет Администраторам и Модераторам выдавать пользователям предупреждения, а также включает в себя дополнительную  функциональность для автоматического удаления некоторых прав пользователей, в зависимости от увеличения уровня выданных им предупреждений. Обратите внимание для получения полной функциональности функция &quot;Премодерация сообщений&quot; должна быть включена.';
$txt['core_settings_switch_on'] = 'Нажмите чтобы Включить';
$txt['core_settings_switch_off'] = 'Нажмите чтобы Выключить';
$txt['core_settings_enabled'] = 'Включено';
$txt['core_settings_disabled'] = 'Выключено';

$txt['languages_lang_name'] = 'Название языка';
$txt['languages_locale'] = 'Локаль';
$txt['languages_default'] = 'По умолчанию';
$txt['languages_character_set'] = 'Кодировка';
$txt['languages_users'] = 'Пользователей';
$txt['language_settings_writable'] = 'Предупреждение: Settings.php незаписываемый, настройки языка по умолчанию не будут сохранены.';
$txt['edit_languages'] = 'Изменить языки';
$txt['lang_file_not_writable'] = '<strong>Предупреждение:</strong> Главный языковой файл (%1$s) не доступен для записи. Вы должны сделать его записываемым до внесения изменений.';
$txt['lang_entries_not_writable'] = '<strong>Предупреждение:</strong> Языковой файл который вы пытаетесь изменить (%1$s) не доступен для записи. Вы должны сделать его записываемым до внесения изменений.';
$txt['languages_ltr'] = 'Справа налево';

$txt['add_language'] = 'Добавить язык';
$txt['add_language_smf'] = 'Загрузить с Simple Machines';
$txt['add_language_smf_browse'] = 'Наберите название языка для поиска или оставьте пустым для поиска всех доступных.';
$txt['add_language_smf_install'] = 'Установить';
$txt['add_language_smf_found'] = 'Следующие языки были найдены. Нажмите на ссылку "Установить" для установки необходимого языка, после чего воспользуетесь менеджером пакетов для установки.';
$txt['add_language_error_no_response'] = 'Сайт Simple Machines не отвечает. Пожалуйста попробуйте позже.';
$txt['add_language_error_no_files'] = 'Файлов не найдено.';
$txt['add_language_smf_desc'] = 'Описание';
$txt['add_language_smf_utf8'] = 'UTF-8';
$txt['add_language_smf_version'] = 'Версия';

$txt['edit_language_entries_primary'] = 'Ниже приведены настройки для главного языка. Важно выставить правильную локаль - для Linux-серверов, обычно, ru_RU.CP1251 или ru_RU.UTF8';
$txt['edit_language_entries'] = 'Изменить языковые переменные';
$txt['edit_language_entries_file'] = 'Выберите переменную для изменения';
$txt['languages_dictionary'] = 'Словарь';
$txt['languages_spelling'] = 'Проверка орфографии';
$txt['languages_for_pspell'] = 'Это для <a href="http://www.php.net/function.pspell-new" target="_blank" class="new_win">pSpell</a> - если установлено';
$txt['languages_rtl'] = 'Включить режим &quot;Справа налево&quot;';

$txt['lang_file_desc_index'] = 'Общие строки';
$txt['lang_file_desc_EmailTemplates'] = 'Шаблоны сообщений';

$txt['languages_download'] = 'Скачать языковой пакет';
$txt['languages_download_note'] = 'Эта страница содержит список всех файлов, которые содержатся в языковом пакет, и некоторую полезную информацию о каждом из них. Все файлы, которые отмечены, будут скопированы.';
$txt['languages_download_info'] = '<strong>Обратите внимание:</strong> Файлы имеющие статус &quot;Незаписываемые&quot; означает что SMF не скопирует файлы в папку и должны будете сделать их записываемым используя FTP клиент или же прописать параметры подключения вверху страницы.<br />
	Информация о версии файлов показывает последнюю версию SMF для которой было сделано обновление. Если индикатор зеленый это означает что текущая версия новее чем текущая ваша. Если индикатор красный то Ваша текущая версия пакета новее.<br />
	Если файл уже существует на Вашем форуме в столбце &quot;Уже существует&quot; будет одно из значений. &quot;Одинаковый&quot; означате что файл уже существует в идентичном виде и перезаписывать его необязательно. &quot;Другой&quot; означает что содержимое различно и перезапись оптимальное решение.';

$txt['languages_download_main_files'] = 'Главные файлы';
$txt['languages_download_filename'] = 'Имя файла';
$txt['languages_download_dest'] = 'Путь';
$txt['languages_download_writable'] = 'Записываемая';
$txt['languages_download_version'] = 'Версия';
$txt['languages_download_older'] = 'Установленная версия файлов новее, перезапись не рекомендуется.';
$txt['languages_download_exists'] = 'Уже существует';
$txt['languages_download_exists_same'] = 'Одинаковые';
$txt['languages_download_exists_different'] = 'Другой';
$txt['languages_download_copy'] = 'Копировать';
$txt['languages_download_not_chmod'] = 'Вы не можете продолжить процесс установки пока выделенные файлы не станут записываемыми.';
$txt['languages_download_illegal_paths'] = 'Пакет содержит неверные пути установки - пожалуйста свяжитесь с Simple Machines';
$txt['languages_download_complete'] = 'Установка завершена';
$txt['languages_download_complete_desc'] = 'Языковой пакет успешно установлен. Пожалуйста нажмите <a href="%1$s">сюда</a> для возврата на страницу языков';
$txt['languages_delete_confirm'] = 'Вы уверены что хотите удалить этот языковой пакет?';

?>