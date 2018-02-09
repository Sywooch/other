<?php
// Version: 2.0 RC2; Admin

global $settings, $scripturl;

// Important! Before editing these language files please read the text at the top of index.english.php.
$txt['admin_boards'] = 'Разделы форума';
$txt['admin_users'] = 'Пользователи';
$txt['admin_newsletters'] = 'Рассылки';
$txt['admin_edit_news'] = 'Новости';
$txt['admin_groups'] = 'Группы пользователей';
$txt['admin_members'] = 'Управление пользователями';
$txt['admin_members_list'] = 'Ниже приведен список всех зарегистрированных пользователей на Вашем форуме.';
$txt['admin_next'] = 'Продолжить';
$txt['admin_censored_words'] = 'Нецензурные слова';
$txt['admin_censored_where'] = 'Напишите нецензурное слово слева, а замену его справа.';
$txt['admin_censored_desc'] = 'В силу того, что форум является общественным, возможно есть некоторые слова, которые, Вы желали бы запретить пользователям Вашего форума. Ниже Вы можете ввести любые слова, которые желаете подвергнуть цензуре каждый раз, когда их используют пользователи.<br />Пустое поле справа удалит слово.';
$txt['admin_reserved_names'] = 'Зарезервированные имена';
$txt['admin_template_edit'] = 'Редактировать темы оформления Вашего форума';
$txt['admin_modifications'] = 'Настройки модов';
$txt['admin_security_moderation'] = 'Безопасность и модерирование';
$txt['admin_server_settings'] = 'Настройки сервера';
$txt['admin_reserved_set'] = 'Зарезервированные имена';
$txt['admin_reserved_line'] = 'Одно зарезервированное имя в строке.';
$txt['admin_basic_settings'] = 'На этой странице Вы можете изменять основные настройки Вашего форума. Будьте очень осторожны, поскольку неправильные настройки могут привести форум в нерабочее состояние.  Также, обратите внимание, что некоторые из этих настроек (такие как формат времени) устанавливаются по умолчанию для всех пользователей или только для гостей.';
$txt['admin_maintain'] = 'Поставить форум на Техническое Обслуживание';
$txt['admin_title'] = 'Название форума';
$txt['admin_url'] = 'Адрес(URL) форума';
$txt['cookie_name'] = 'Имя Cookie';
$txt['admin_webmaster_email'] = 'Email адрес вебмастера';
$txt['boarddir'] = 'Абсолютный путь к директории с форумом';
$txt['sourcesdir'] = 'Абсолютный путь к директории Sources';
$txt['cachedir'] = 'Директория для кэша';
$txt['admin_news'] = 'Отображать новости';
$txt['admin_guest_post'] = 'Разрешить гостям оставлять сообщения';
$txt['admin_manage_members'] = 'Пользователи';
$txt['admin_main'] = 'Главный';
$txt['admin_config'] = 'Конфигурация';
$txt['admin_version_check'] = 'Детальная проверка версии';
$txt['admin_smffile'] = 'SMF файл';
$txt['admin_smfpackage'] = 'SMF пакет';
$txt['admin_maintenance'] = 'Обслуживание';
$txt['admin_image_text'] = 'Показывать кнопки вместо текста';
$txt['admin_credits'] = 'Благодарности';
$txt['admin_agreement'] = 'Показывать и требовать принятия регистрационного соглашения';
$txt['admin_agreement_default'] = 'По умолчанию';
$txt['admin_agreement_select_language'] = 'Язык для редактирования';
$txt['admin_agreement_select_language_change'] = 'Изменить';
$txt['admin_delete_members'] = 'Удалить выбранных пользователей';
$txt['admin_repair'] = 'Восстановить все разделы и темы';
$txt['admin_main_welcome'] = 'Это Ваш &quot;%1$s&quot;. Здесь Вы можете управлять настройками сервера, обслуживать форум, просматривать логи, устанавливать пакеты модификаций, управлять темами оформления и многое другое. <div style="margin-top: 1ex;">Если у Вас возникли проблемы, пожалуйста, посетите страницу &quot;Поддержка и благодарности&quot; . Если эта информация Вам не помогла, попробуйте обратиться на <a href="http://www.simplemachines.org/community/index.php" target="_blank">форум за помощью</a> с Вашей проблемой.</div> Возможно, Вы найдете ответы на Ваши вопросы или проблемы, нажав на  <img src="' . $settings['images_url'] . '/helptopics.gif" alt="%2$s" title="%3$s" border="0" />  знак для получения подробной информации.';
$txt['admin_news_desc'] = 'Пожалуйста, вписывайте по одной новости в каждую ячейку. Некоторые BBC теги, такие как <span title="Жирный!!">[b]</span>, <span title="Наклонный!!">[i]</span> и <span title="Подчеркнутый!!">[u]</span> разрешены в новостях, а также смайлы и HTML. Для того чтобы убрать новость, просто удалите текст в ячейке.';
$txt['administrators'] = 'Администраторы форума';
$txt['admin_reserved_desc'] = 'Зарезервированные имена будут препятствовать регистрации пользователей, либо при выборе отображаемого имени. Выберите настройки, которые Вы будете использовать, перед тем как принять изменения.';
$txt['admin_activation_email'] = 'Отослать email с кодом активации новым пользователям после регистрации';
$txt['admin_match_whole'] = 'Полное совпадение слова.';
$txt['admin_match_case'] = 'C учетом регистра.';
$txt['admin_check_user'] = 'Проверять имя пользователя.';
$txt['admin_check_display'] = 'Проверять отображаемое имя.';
$txt['admin_newsletter_send'] = 'Вы можете отослать email любому пользователю с этой страницы. Email адреса из выбранных групп пользователей будут показаны ниже, но Вы можете добавлять или удалять их по своему желанию. Убедитесь в том, что каждый адрес разделен как это показано на примере: \'адрес1; адрес2\'.';
$txt['admin_fader_delay'] = 'Задержка между показами новостей в новостной ленте';
$txt['admin_bbc'] = 'Показывать кнопки BBC на страницах отсылки сообщений и отсылки Личных сообщений';

$txt['admin_backup_fail'] = 'Невозможно создать резервную копию Settings.php - убедитесь, что файл Settings_bak.php существует и является записываемым.';
$txt['modSettings_info'] = 'Изменение или установка настроек управления форумом.';
$txt['database_server'] = 'Сервер базы данных MySQL';
$txt['database_user'] = 'Имя пользователя базы данных';
$txt['database_password'] = 'Пароль базы данных';
$txt['database_name'] = 'Имя базы данных';
$txt['registration_agreement'] = 'Регистрационное соглашение';
$txt['registration_agreement_desc'] = 'Это соглашение показывается, когда пользователь регистрируется на форуме и он должен принять его прежде чем начнет регистрацию.';
$txt['database_prefix'] = 'Префикс таблиц базы данных';
$txt['errors_list'] = 'Просмотр ошибок форума';
$txt['errors_found'] = 'Обнаружены следующие ошибки';
$txt['errors_fix'] = 'Вы хотите исправить эти ошибки';
$txt['errors_do_recount'] = 'Все ошибки исправлены, был создан раздел для потерянных сообщений! Пожалуйста, нажмите на кнопку ниже, чтобы пересчитать некоторые ключевые данные статистики.';
$txt['errors_recount_now'] = 'Пересчитать статистику';
$txt['errors_fixing'] = 'Исправление ошибок форума';
$txt['errors_fixed'] = 'Все ошибки исправлены! Пожалуйста, проверьте любые созданные категории, форумы или темы.';
$txt['attachments_avatars'] = 'Вложения и аватары';
$txt['attachments_desc'] = 'Здесь Вы можете администрировать вложенные файлы. Вы можете удалить вложения по размеру, по дате публикации. Статистика по вложениям предоставлена ниже.';
$txt['attachment_stats'] = 'Статистика вложенных файлов';
$txt['attachment_total'] = 'Всего вложений';
$txt['attachmentdir_size'] = 'Общий размер папки вложений';
$txt['attachmentdir_size_current'] = 'Общий размер текущей папки вложений';
$txt['attachment_space'] = 'Всего доступного места в папке вложений';
$txt['attachment_space_current'] = 'Всего доступного места в текущей папке вложений';
$txt['attachment_options'] = 'Управление вложенными файлами';
$txt['attachment_log'] = 'Логи вложений';
$txt['attachment_remove_old'] = 'Удалить вложения старше чем';
$txt['attachment_remove_size'] = 'Удалить вложения больше чем';
$txt['attachment_name'] = 'Имя файла';
$txt['attachment_file_size'] = 'Размер файла';
$txt['attachmentdir_size_not_set'] = 'Максимальный размер папки не установлен';
$txt['attachment_delete_admin'] = '[вложение удалено Администратором]';
$txt['live'] = 'Новости с Simple Machines...';
$txt['remove_all'] = 'Удалить все';
$txt['approve_new_members'] = 'Администратор должен одобрить всех новых пользователей';
$txt['agreement_not_writable'] = 'Внимание - agreement.txt не доступен на запись, любые изменения которые Вы произведете, не будут сохранены.';

$txt['version_check_desc'] = 'Здесь показываются версии установленных файлов, а напротив последние версии. Если любой из этих файлов устарел, Вы должны загрузить и обновится до последней версии с <a href="http://www.simplemachines.org/" target="_blank">www.simplemachines.org</a>.';
$txt['version_check_more'] = '(подробнее)';

$txt['lfyi'] = 'Невозможно соединиться с simplemachines.org для получения последних новостей.';

$txt['manage_calendar'] = 'Календарь';
$txt['manage_search'] = 'Поиск';

$txt['smileys_manage'] = 'Смайлы и иконки';
$txt['smileys_manage_info'] = 'Установка и добавление новых смайлов, а также управление иконками сообщений.';
$txt['package_info'] = 'Установка новых возможностей или изменение существующих осуществляется в этом разделе.';
$txt['theme_admin'] = 'Темы оформления';
$txt['theme_admin_info'] = 'Установка, настройка и управление темами оформления.';
$txt['registration_center'] = 'Регистрация';
$txt['member_center_info'] = 'Просмотр списка пользователей, поиск и управление пользователями, которые не активировали свою учетную запись.';

$txt['viewmembers_name'] = 'Имя пользователя (отображаемое)';
$txt['viewmembers_online'] = 'Последний визит';
$txt['viewmembers_today'] = 'Сегодня';
$txt['viewmembers_day_ago'] = 'день назад';
$txt['viewmembers_days_ago'] = 'дней назад';

$txt['display_name'] = 'Отображаемое имя';
$txt['email_address'] = 'Email адрес';
$txt['ip_address'] = 'IP адрес';
$txt['member_id'] = 'ID';

$txt['unknown'] = 'неизвестно';
$txt['security_wrong'] = 'Попытка войти под Администратором!' . "\n" . 'Referer: %1$s' . "\n" . 'User agent: %2$s' . "\n" . 'IP: %3$s';

$txt['email_as_html'] = 'Отправить в HTML формате. (включив эту опцию Вы можете отправлять email как обычный HTML.)';
$txt['email_parsed_html'] = 'Добавить &lt;br /&gt; и &amp;nbsp тэги в это сообщение.';
$txt['email_variables'] = 'В этом сообщении Вы можете использовать несколько &quot;вариантов&quot;.  Нажмите <a href="' . $scripturl . '?action=helpadmin;help=emailmembers" onclick="return reqWin(this.href);" class="help">здесь</a> для получения подробной информации.';
$txt['email_force'] = 'Отправить сообщение даже тем пользователям, которые отказались от получения новостей.';
$txt['email_as_pms'] = 'Отправить сообщение, этим группам используя Личные Сообщения.';
$txt['email_continue'] = 'Продолжить';
$txt['email_done'] = 'готово.';

$txt['ban_title'] = 'Список банов';
$txt['ban_ip'] = 'Бан по IP: (пример 192.168.12.213 или 128.0.*.*) - одно значение на строку';
$txt['ban_email'] = 'Бан по Email: (пример badguy@somewhere.com) - одно значение на строку';
$txt['ban_username'] = 'Бан по Имени Пользователя: (пример l33tuser) - одно значение на строку';

$txt['ban_description'] = 'Здесь Вы можете блокировать пользователей по IP адресу, имени хоста, имени пользователя или по email.';
$txt['ban_add_new'] = 'Добавить бан';
$txt['ban_banned_entity'] = 'Забаненные объекты';
$txt['ban_on_ip'] = 'Бан по IP адресу (пример 192.168.10-20.*)';
$txt['ban_on_hostname'] = 'Бан по имени хоста (пример *.mil)';
$txt['ban_on_email'] = 'Бан по Email адресу (пример *@badsite.com)';
$txt['ban_on_username'] = 'Бан по имени пользователя';
$txt['ban_notes'] = 'Примечания';
$txt['ban_restriction'] = 'Тип бана';
$txt['ban_full_ban'] = 'Полный бан';
$txt['ban_partial_ban'] = 'Частичный бан';
$txt['ban_cannot_post'] = 'Нельзя оставлять сообщения';
$txt['ban_cannot_register'] = 'Нельзя регистрироваться';
$txt['ban_cannot_login'] = 'Нельзя входить';
$txt['ban_add'] = 'Добавить';
$txt['ban_edit_list'] = 'Список банов';
$txt['ban_type'] = 'Тип банов';
$txt['ban_days'] = 'день(дней)';
$txt['ban_will_expire_within'] = 'Бан истекает через';
$txt['ban_added'] = 'Добавлено';
$txt['ban_expires'] = 'Заканчивается';
$txt['ban_hits'] = 'Хитов';
$txt['ban_actions'] = 'Действия';
$txt['ban_expiration'] = 'Заканчивается';
$txt['ban_reason_desc'] = 'Описание бана, отображается заблокированному пользователю.';
$txt['ban_notes_desc'] = 'Примечание может помочь другим пользователям, имеющим доступ к управлению банами.';
$txt['ban_remove_selected'] = 'Удалить выбранное';
// Escape any single quotes in here twice.. 'it\'s' -> 'it\\\'s'.
$txt['ban_remove_selected_confirm'] = 'Вы действительно хотите удалить выделенные баны?';
$txt['ban_modify'] = 'Изменить';
$txt['ban_name'] = 'Имя';
// Escape any single quotes in here twice.. 'it\'s' -> 'it\\\'s'.
$txt['ban_edit'] = 'Редактировать бан';
$txt['ban_add_notes'] = '<strong>Примечание</strong>: после создания бана Вы можете добавить в него дополнительные параметры, такие как IP адрес, Имя хоста и email адрес.';
$txt['ban_expired'] = 'Срок истек/отменен';
// Escape any single quotes in here twice.. 'it\'s' -> 'it\\\'s'.
$txt['ban_restriction_empty'] = 'Ограничение не выбрано.';

$txt['ban_triggers'] = 'Параметры';
$txt['ban_add_trigger'] = 'Добавить параметры бана';
$txt['ban_add_trigger_submit'] = 'Добавить';
$txt['ban_edit_trigger'] = 'Изменить';
$txt['ban_edit_trigger_title'] = 'Редактировать бан';
$txt['ban_edit_trigger_submit'] = 'Изменить';
$txt['ban_remove_selected_triggers'] = 'Удалить выделенные параметры банов';
$txt['ban_no_entries'] = 'В настоящее время нет ни одного действующего бана.';

// Escape any single quotes in here twice.. 'it\'s' -> 'it\\\'s'.
$txt['ban_remove_selected_triggers_confirm'] = 'Вы уверены, что хотите удалить выбранные баны?';
$txt['ban_trigger_browse'] = 'Параметры бана';
$txt['ban_trigger_browse_description'] = 'Здесь показаны все элементы бана, сгруппированные по IP адресу, Имени хоста, Email адресу и по Имени Пользователя.';

$txt['ban_log'] = 'Лог банов';
$txt['ban_log_description'] = 'В логах бана показаны все элементы, какие заблокированные пользователи входили на форум  (\'полный бан\' и \'без возможности зарегистрироваться\' только эти баны).';
$txt['ban_log_no_entries'] = 'В логах бана ничего нет.';
$txt['ban_log_ip'] = 'IP адрес';
$txt['ban_log_email'] = 'Email адрес';
$txt['ban_log_member'] = 'Пользователь';
$txt['ban_log_date'] = 'Дата';
$txt['ban_log_remove_all'] = 'Удалить все';
$txt['ban_log_remove_all_confirm'] = 'Вы уверены, что хотите удалить все логи бана?';
$txt['ban_log_remove_selected'] = 'Удалить выделенное';
$txt['ban_log_remove_selected_confirm'] = 'Вы уверены, что хотите удалить выделенные логи бана?';
$txt['ban_no_triggers'] = 'Нет параметров бана.';

$txt['settings_not_writable'] = 'Эти настройки не могут быть изменены, потому что Settings.php доступен только для чтения.';

$txt['maintain_title'] = 'Обслуживание форума';
$txt['maintain_info'] = 'Оптимизирование таблиц, создание резервных копий, проверка на ошибки и очистка форума осуществляется при помощи этой утилиты.';
$txt['maintain_sub_database'] = 'База данных';
$txt['maintain_sub_routine'] = 'Ремонт';
$txt['maintain_sub_members'] = 'Пользователи';
$txt['maintain_sub_topics'] = 'Удаление и перенос тем';
$txt['maintain_done'] = 'Задача \'%1$s\' успешно выполнена.';
$txt['maintain_no_errors'] = 'Ошибок не найдено!';

$txt['maintain_tasks'] = 'Диспетчер задач';
$txt['maintain_tasks_desc'] = 'Управление всем задачами SMF.';

$txt['scheduled_log'] = 'Логи диспетчера задач';
$txt['scheduled_log_desc'] = 'Список логов выполненных задач';
$txt['admin_log'] = 'Логи администрирования';
$txt['admin_log_desc'] = 'Список административных действий, выполненных администраторами Вашего форума.';
$txt['moderation_log'] = 'Логи модерации';
$txt['moderation_log_desc'] = 'Список модераторских действий, выполненных модераторами Вашего форума.';
$txt['spider_log_desc'] = 'Обзор записей относящихся к деятельности пауков поисковых машин на Вашем форуме.';
$txt['pruning_log_desc'] = 'Используйте эти инструменты для очистки от старых записей в различных журналах логов.';

$txt['mailqueue_title'] = 'Очередь сообщений';

$txt['db_error_send'] = 'Отправить email об ошибке соединения с MySQL';
$txt['db_persist'] = 'Использовать постоянное соединение с MySQL';
$txt['ssi_db_user'] = 'Имя пользователя базы данных для SSI:';
$txt['ssi_db_passwd'] = 'Пароль базы данных для SSI:';

$txt['default_language'] = 'Язык форума по умолчанию:';

$txt['maintenance_subject'] = 'Заголовок';
$txt['maintenance_message'] = 'Сообщение';

$txt['errlog_desc'] = 'Журнал логов ошибок отслеживает все ошибки на Вашем форуме. Для удаления любых ошибок из базы данных, выделите любую и нажмите кнопку %s.';
$txt['errlog_no_entries'] = 'Логов ошибок нет.';

$txt['theme_settings'] = 'Свойства темы оформления';
$txt['theme_current_settings'] = 'Текущая тема оформления';

$txt['dvc_your'] = 'Ваша версия';
$txt['dvc_current'] = 'Последняя версия';
$txt['dvc_sources'] = 'Sources';
$txt['dvc_default'] = 'Версия темы оформления по умолчанию';
$txt['dvc_templates'] = 'Текущая версия темы оформления';
$txt['dvc_languages'] = 'Языковые файлы';

$txt['smileys_default_set_for_theme'] = 'Выбрать смайлы по умолчанию для этой темы';
$txt['smileys_no_default'] = '(использовать смайлы по умолчанию)';

$txt['censor_test'] = 'Тестировать нецензурные слова';
$txt['censor_test_save'] = 'Тестировать';
$txt['censor_case'] = 'Не учитывать регистр букв';
$txt['censor_whole_words'] = 'Только слова целиком';

$txt['admin_confirm_password'] = '(повторите пароль)';
$txt['admin_incorrect_password'] = 'Некорректный пароль';

$txt['date_format'] = '(ГГГГ-ММ-ДД)';
$txt['undefined_gender'] = 'не указан';
$txt['age'] = 'Возраст пользователя';
$txt['activation_status'] = 'Статус активации';
$txt['activated'] = 'Активирован';
$txt['not_activated'] = 'Не активирован';
$txt['primary'] = 'Основная';
$txt['additional'] = 'Добавочная';
$txt['messenger_address'] = 'Адрес';
$txt['wild_cards_allowed'] = 'символы  * и ? разрешены';
$txt['search_for'] = 'Поиск';
$txt['member_part_of_these_membergroups'] = 'Пользователь входит в группу';
$txt['membergroups'] = 'Группы пользователей';
$txt['confirm_delete_members'] = 'Вы уверены, что хотите удалить выбранных пользователей?';

$txt['support_credits_title'] = 'Поддержка и благодарности';
$txt['support_credits_info'] = 'Обратитесь к поддержке, получите информацию по выпускам и версиям форума, если у вас возникли проблемы.';
$txt['support_title'] = 'Информационная поддержка';
$txt['support_versions_current'] = 'Последняя версия SMF';
$txt['support_versions_forum'] = 'Версия форума';
$txt['support_versions_php'] = 'Версия PHP';
$txt['support_versions_db'] = 'Версия %1$s';
$txt['support_versions_server'] = 'Версия Web сервера';
$txt['support_versions_gd'] = 'Версия GD';
$txt['support_versions'] = 'Информация о версиях';
$txt['support_resources'] = 'Средства поддержки';
$txt['support_resources_p1'] = 'Наше <a href="%1$s">Онлайновое руководство</a> предоставляет основную документацию по SMF. Это руководство содержит множество документов с ответами на вопросы поддержки и пояснения по <a href="%2$s">Возможностям</a>, <a href="%3$s">Настройкам</a>, <a href="%4$s">Темам оформления</a>, <a href="%5$s">Пакетам модификаций</a> и прочим вопросам. Руководство покрывает все аспекты использования SMF и позволяет быстро получить ответы на большинство вопросов.';
$txt['support_resources_p2'] = 'Если Вы не смогли найти ответы на свои вопросы в Онлайновом Руководстве, можете воспользоваться поиском по нашему <a href="%1$s">Сообществу Поддержки</a> или обратиться за помощью в <a href="%2$s">Английский</a> или один из множества <a href="%3$s">Интернациональных разделов поддержки</a>. Сообщество Поддержки SMF может использоваться для вопросов <a href="%4$s">поддержки</a>, <a href="%5$s">модификации</a> и многих других, таких как обсуждение SMF, поиск хостинга и обсуждение административных вопросов с другими администраторами форумов.';

$txt['support_latest'] = 'Поддержка и выпуски форума';
$txt['support_latest_fetch'] = 'Получение информации о поддержке...';

$txt['edit_permissions_info'] = 'Изменение ограничений и доступных возможностей глобально или для каждого раздела.';
$txt['membergroups_members'] = 'Обычные пользователи';
$txt['membergroups_guests'] = 'Гости';
$txt['membergroups_guests_na'] = 'нет';
$txt['membergroups_add_group'] = 'Добавить группу';
$txt['membergroups_permissions'] = 'Права доступа';

$txt['permitgroups_restrict'] = 'Ограниченный';
$txt['permitgroups_standard'] = 'Стандартный';
$txt['permitgroups_moderator'] = 'Модератор';
$txt['permitgroups_maintenance'] = 'Технический';
$txt['permitgroups_inherit'] = 'Наследовать';

$txt['confirm_delete_attachments_all'] = 'Вы уверены, что хотите удалить все вложения?';
$txt['confirm_delete_attachments'] = 'Вы уверены, что хотите удалить все выделенные вложения?';
$txt['attachment_manager_browse_files'] = 'Просмотр файлов';
$txt['attachment_manager_repair'] = 'Обслуживание';
$txt['attachment_manager_avatars'] = 'Аватары';
$txt['attachment_manager_attachments'] = 'Вложения';
$txt['attachment_manager_thumbs'] = 'Эскизы';
$txt['attachment_manager_last_active'] = 'Последняя активность';
$txt['attachment_manager_member'] = 'Пользователь';
$txt['attachment_manager_avatars_older'] = 'Удалить аватары пользователей, неактивных более чем';
$txt['attachment_manager_total_avatars'] = 'Всего аватаров';

$txt['attachment_manager_avatars_no_entries'] = 'Аватар нет.';
$txt['attachment_manager_attachments_no_entries'] = 'Вложений нет.';
$txt['attachment_manager_thumbs_no_entries'] = 'Эскизов нет.';

$txt['attachment_manager_settings'] = 'Свойства вложений';
$txt['attachment_manager_avatar_settings'] = 'Свойства аватаров';
$txt['attachment_manager_browse'] = 'Просмотр файлов';
$txt['attachment_manager_maintenance'] = 'Обслуживание файлов';
$txt['attachment_manager_save'] = 'Сохранить';

$txt['attachmentEnable'] = 'Вложения';
$txt['attachmentEnable_deactivate'] = 'Запретить вложения';
$txt['attachmentEnable_enable_all'] = 'Разрешить все вложения';
$txt['attachmentEnable_disable_new'] = 'Запретить новые вложения';
$txt['attachmentCheckExtensions'] = 'Проверять расширения вложений';
$txt['attachmentExtensions'] = 'Доступные расширения вложений';
$txt['attachmentRecodeLineEndings'] = 'Перекодировать символы конца строки в текстовых вложениях';
$txt['attachmentShowImages'] = 'Отображать прикрепленные картинки под сообщением';
$txt['attachmentEncryptFilenames'] = 'Шифровать имена закаченных файлов';
$txt['attachmentUploadDir'] = 'Папка вложений <div class="smalltext"><a href="' . $scripturl . '?action=admin;area=manageattachments;sa=attachpaths">Настройка нескольких папок вложений</a></div>';
$txt['attachmentUploadDir_multiple'] = 'Папка вложений';
$txt['attachmentUploadDir_multiple_configure'] = '<a href="' . $scripturl . '?action=admin;area=manageattachments;sa=attachpaths">[Настройка нескольких папок вложений]</a>';
$txt['attachmentDirSizeLimit'] = 'Максимальный размер папки вложений';
$txt['attachmentPostLimit'] = 'Максимальный размер вложения в одном сообщении';
$txt['attachmentSizeLimit'] = 'Максимальный размер вложения';
$txt['attachmentNumPerPostLimit'] = 'Максимальное количество вложений в сообщении';
$txt['attachmentThumbnails'] = 'Изменять размер изображения, при отображении под сообщением';
$txt['attachmentThumbWidth'] = 'Максимальная ширина эскиза';
$txt['attachmentThumbHeight'] = 'Максимальная высота эскиза';

$txt['attach_dir_does_not_exist'] = 'Не существует';
$txt['attach_dir_not_writable'] = 'Незаписываемая';
$txt['attach_dir_files_missing'] = 'Файлы потеряны ((<a href="' . $scripturl . '?action=admin;area=manageattachments;sa=repair;%2$s=%1$s">Восстановить</a>)';
$txt['attach_dir_unused'] = 'Не используется';
$txt['attach_dir_ok'] = 'ОК';

$txt['attach_path_manage'] = 'Управление путями папки вложений';
$txt['attach_paths'] = 'Путь папки вложений';
$txt['attach_current_dir'] = 'Текущая папка';
$txt['attach_path'] = 'Путь';
$txt['attach_current_size'] = 'Текущий размер (КБ)';
$txt['attach_num_files'] = 'Файлов';
$txt['attach_dir_status'] = 'Статус';
$txt['attach_add_path'] = 'Добавить путь';
$txt['attach_path_current_bad'] = 'Текущий путь папки вложений не существует.';

$txt['mods_cat_avatars'] = 'Аватары';
$txt['avatar_directory'] = 'Папка аватаров';
$txt['avatar_url'] = 'Адрес(URL) аватаров';
$txt['avatar_dimension_note'] = '(0 = без лимита)';
$txt['avatar_max_width_external'] = 'Максимальная ширина внешнего аватара';
$txt['avatar_max_height_external'] = 'Максимальная высота внешнего аватара';
$txt['avatar_action_too_large'] = 'Если аватар слишком большой...';
$txt['option_refuse'] = 'Запретить отображение';
$txt['option_html_resize'] = 'Позволить HTML изменять размеры';
$txt['option_js_resize'] = 'Изменить размер при помощи JavaScript';
$txt['option_download_and_resize'] = 'Загрузить и изменить размер (требуется GD модуль)';
$txt['avatar_max_width_upload'] = 'Максимальная ширина загруженного аватара';
$txt['avatar_max_height_upload'] = 'Максимальная высота загруженного аватара';
$txt['avatar_resize_upload'] = 'Изменить размеры больших аватаров';
$txt['avatar_resize_upload_note'] = '(требуется GD модуль)';
$txt['avatar_download_png'] = 'Использовать формат PNG для аватара с измененными размерами';
$txt['avatar_gd_warning'] = 'GD модуль не установлен. Некоторые аватары запрещены.';
$txt['avatar_external'] = 'Внешние аватары';
$txt['avatar_upload'] = 'Загруженные аватары';
$txt['avatar_server_stored'] = 'Аватары расположенные на сервере';
$txt['avatar_server_stored_groups'] = 'Группы пользователей, которым разрешено устанавливать аватары с сервера';
$txt['avatar_upload_groups'] = 'Группы пользователей, которым разрешено закачивать аватары на сервер';
$txt['avatar_external_url_groups'] = 'Группы пользователей, которым разрешено выбирать внешние аватары по адресу(URL)';
$txt['avatar_select_permission'] = 'Выбор групп';
$txt['avatar_download_external'] = 'Закачать аватар с адреса(URL)';
$txt['custom_avatar_enabled'] = 'Загрузить аватар в:';
$txt['option_attachment_dir'] = 'Папку вложений';
$txt['option_specified_dir'] = 'Другую папку';
$txt['custom_avatar_dir'] = 'Папка загрузки';
$txt['custom_avatar_dir_desc'] = 'Это не должны быть тем же, что и папка на сервере.';
$txt['custom_avatar_url'] = 'Адрес(URL) загрузки';
$txt['custom_avatar_check_empty'] = 'Выбранная директория для автаров возможно пуста или задана неверно. Пожалуйста, проверьте правильность указанных данных.';

$txt['repair_attachments'] = 'Обслуживание вложений';
$txt['repair_attachments_complete'] = 'Обслуживание закончено';
$txt['repair_attachments_complete_desc'] = 'Все выделенные ошибки были исправлены';
$txt['repair_attachments_no_errors'] = 'Ошибок не найдено!';
$txt['repair_attachments_error_desc'] = 'В ходе обслуживания были найдены ошибки. Выделите те ошибки которые Вы хотите исправить и нажмите продолжить.';
$txt['repair_attachments_continue'] = 'Продолжить';
$txt['repair_attachments_cancel'] = 'Отмена';
$txt['attach_repair_missing_thumbnail_parent'] = '%1$d эскизы не ассоциированы со своими полноразмерными изображениями';
$txt['attach_repair_parent_missing_thumbnail'] = '%1$d изображения не имеют эскизов, хотя указано обратное';
$txt['attach_repair_file_missing_on_disk'] = '%1$d вложения/аватары имеют ассоциативные ссылки, но отсутствуют на сервере';
$txt['attach_repair_file_wrong_size'] = '%1$d вложения/аватары имеют неправильный размер';
$txt['attach_repair_file_size_of_zero'] = '%1$d вложения/аватары имеют нулевой размер. (Подлежит удалению)';
$txt['attach_repair_attachment_no_msg'] = '%1$d вложения больше не ассоциировано с сообщением.';
$txt['attach_repair_avatar_no_member'] = '%1$d аватар больше не ассоциирован с пользователем';
$txt['attach_repair_wrong_folder'] = '%1$d вложения в несуществующей папке';

$txt['news_title'] = 'Новости и рассылка';
$txt['news_settings_desc'] = 'Здесь Вы можете изменить настройки и права доступа для новостей и рассылок.';
$txt['news_settings_submit'] = 'Сохранить';
$txt['news_mailing_desc'] = 'Из этого меню, Вы можете отправлять сообщения всем зарегистрированным пользователям. Вы можете редактировать лист рассылки или отправить сообщение всем. Полезно для рассылки важной информации и новостей.';
$txt['groups_edit_news'] = 'Группы, которым разрешено редактировать новости';
$txt['groups_send_mail'] = 'Группы, которым разрешено рассылать новостные сообщения с форума';
$txt['xmlnews_enable'] = 'Разрешить XML/RSS новости';
$txt['xmlnews_maxlen'] = 'Максимальная длина сообщения:<div class="smalltext">(0 без ограничения, но это плохая идея.)</div>';
$txt['editnews_clickadd'] = 'Нажмите сюда для добавления другого пункта.';
$txt['editnews_remove_selected'] = 'Удалить выделенные';
$txt['editnews_remove_confirm'] = 'Вы уверены, что хотите удалить выделенные новости?';
$txt['censor_clickadd'] = 'Нажмите сюда для добавления другого слова.';

$txt['layout_controls'] = 'Форум';
$txt['logs'] = 'Логи';
$txt['generate_reports'] = 'Генератор отчетов';

$txt['update_available'] = 'Доступно обновление!';
$txt['update_message'] = 'Вы используете устаревшую версию SMF, содержащую некоторые ошибки, эти ошибки исправлены в новой версии.
Мы рекомендуем Вам<a href="" id="update-link">обновить Ваш форум</a> до последней версии. Это займет всего несколько минут!';

$txt['manageposts'] = 'Сообщения и темы';
$txt['manageposts_title'] = 'Управление сообщениями и темами';
$txt['manageposts_description'] = 'Здесь Вы можете управлять всеми настройками, связанными с темами и сообщениями.';

$txt['manageposts_seconds'] = 'секунд';
$txt['manageposts_minutes'] = 'минут';
$txt['manageposts_characters'] = 'знаков';
$txt['manageposts_days'] = 'дней';
$txt['manageposts_posts'] = 'сообщений';
$txt['manageposts_topics'] = 'тем';

$txt['manageposts_settings'] = 'Настройка сообщений';
$txt['manageposts_settings_description'] = 'Здесь Вы можете установить все, что связано с сообщениями и их отправкой.';
$txt['manageposts_settings_submit'] = 'Сохранить';

$txt['manageposts_bbc_settings'] = 'BB код';
$txt['manageposts_bbc_settings_description'] = 'BB код может использоваться для оформления сообщений. Пример, жирного выделения слова  \'лошадь\' Вы можете написать так [b]лошадь[/b]. Все BB код тэги обрамлены квадратными скобками (\'[\' и \']\').';
$txt['manageposts_bbc_settings_title'] = 'Настройка BB кода';
$txt['manageposts_bbc_settings_submit'] = 'Сохранить';

$txt['manageposts_topic_settings'] = 'Настройки тем';
$txt['manageposts_topic_settings_description'] = 'Здесь Вы можете установить все настройки касающиеся тем.';
$txt['manageposts_topic_settings_submit'] = 'Сохранить';

$txt['removeNestedQuotes'] = 'Удалять вложенные цитаты при отправке сообщения';
$txt['enableEmbeddedFlash'] = 'Включить Flash в сообщениях';
$txt['enableEmbeddedFlash_warning'] = 'может быть риск в безопасности!';
$txt['enableSpellChecking'] = 'Разрешить проверку орфографии';
$txt['enableSpellChecking_warning'] = 'работает не на всех серверах!';
$txt['disable_wysiwyg'] = 'Запретить редактор WYSIWYG';
$txt['max_messageLength'] = 'Максимальный размер сообщения';
$txt['max_messageLength_zero'] = '0 - без ограничений.';
$txt['fixLongWords'] = 'Разбить слова длиннее чем';
$txt['fixLongWords_zero'] = '0 - запрещено';
$txt['fixLongWords_warning'] = 'это работает не на всех серверах!';
$txt['topicSummaryPosts'] = 'Количество отображаемых сообщений в теме';
$txt['spamWaitTime'] = 'Время между отправкой сообщений с одного IP';
$txt['edit_wait_time'] = 'Время редактирования сообщения';
$txt['edit_disable_time'] = 'Время, в течении которого разрешено редактировать сообщение';
$txt['edit_disable_time_zero'] = '0 запрещено';

$txt['enableBBC'] = 'Разрешить BB код';
$txt['enablePostHTML'] = 'Разрешить <em>основной</em> HTML в сообщениях';
$txt['autoLinkUrls'] = 'Автоматически вставлять ссылки URL';
$txt['disabledBBC'] = 'Разрешенные BB тэги';
$txt['bbcTagsToUse'] = 'Разрешить BB тэги';
$txt['bbcTagsToUse_select'] = 'Выбрать тэги, разрешенные для использования';
$txt['bbcTagsToUse_select_all'] = 'Выбрать все тэги';

$txt['enableStickyTopics'] = 'Разрешить прикрепленные темы';
$txt['enableParticipation'] = 'Разрешить иконки';
$txt['oldTopicDays'] = 'Время после которого тема считается устаревшей';
$txt['oldTopicDays_zero'] = '0 отключено';
$txt['defaultMaxTopics'] = 'Количество тем на странице';
$txt['defaultMaxMessages'] = 'Количество сообщений на странице темы';
$txt['hotTopicPosts'] = 'Количество сообщений для популярной темы';
$txt['hotTopicVeryPosts'] = 'Количество сообщений для очень популярной темы';
$txt['enableAllMessages'] = 'Максимальный размер темы для отображения &quot;Всех&quot; сообщений';
$txt['enableAllMessages_zero'] = '0 никогда не показывать &quot;Все&quot;';
$txt['disableCustomPerPage'] = 'Отключить возможность индивидуальной настройки количества тем/сообщений на странице';
$txt['enablePreviousNext'] = 'Разрешить ссылки предыдущая тема/следующая тема';

$txt['not_done_title'] = 'Не готово!';
$txt['not_done_reason'] = 'Чтобы избежать перегрузки сервера, процесс временно приостановлен. Все запустится через несколько секунд. Если это не произошло нажмите на кнопку продолжить.';
$txt['not_done_continue'] = 'Продолжить';

$txt['general_settings'] = 'Общие';
$txt['database_paths_settings'] = 'База Данных и Пути';
$txt['cookies_sessions_settings'] = 'Плюшки и сессии';
$txt['caching_settings'] = 'Кэширование';
$txt['load_balancing_settings'] = 'Балансировка нагрузки';

$txt['language_configuration'] = 'Настройка языков';
$txt['language_description'] = 'В этом разделе можно редактировать установленные в системе языки и устанавливать новые, скачанные с сайта автора.';
$txt['language_edit'] = 'Изменить язык';
$txt['language_add'] = 'Добавить язык';
$txt['language_settings'] = 'Настройки';

$txt['copyright_ends_in'] = 'Ваша подписка на удаление копирайта SMF истекает через <strong>%1$s</strong> дней.';
$txt['copyright_click_renew'] = 'Нажмите <a href="http://www.simplemachines.org/copyright/renew.php?key=%1$s" class="alert">сюда</a> для обновления';
$txt['copyright_removal'] = 'Удаление копирайта';
$txt['copyright_removal_desc'] = 'Чтобы удалить копирайт с Вашего SMF форума Вы должны купить код на сайте Simple Machines. Если Вы еще не приобрели код, пожалуйста, нажмите <a href="http://www.simplemachines.org/copyright/index.php">здесь</a>. Как только код будет введен и проверен, копирайт на Вашем форуме будет убран, пока Ваша подписка не закончится. Оставшееся время будет отображено в центре администрирования.';
$txt['copyright_code'] = 'Код копирайта';
$txt['copyright_proceed'] = 'Перейти';

$txt['advanced'] = 'Расширенный';
$txt['simple'] = 'Простой';

$txt['admin_news_select_recipients'] = 'Пожалуйста, выберите кто должен получить новости';
$txt['admin_news_select_group'] = 'Группы пользователей';
$txt['admin_news_select_group_desc'] = 'Пожалуйста, выберите группу пользователей, которым Вы хотели бы отправить новости.';
$txt['admin_news_select_members'] = 'Пользователи';
$txt['admin_news_select_members_desc'] = 'Дополнительные пользователи, которым будут отправлены новости.';
$txt['admin_news_select_excluded_members'] = 'За исключением пользователей';
$txt['admin_news_select_excluded_members_desc'] = 'Пользователи, которые не должны получать новости.';
$txt['admin_news_select_excluded_groups'] = 'За исключением групп';
$txt['admin_news_select_excluded_groups_desc'] = 'Выберите группы пользователей которые не должны получать новости.';
$txt['admin_news_select_email'] = 'Адреса Email';
$txt['admin_news_select_email_desc'] = 'Email адреса, куда отправляется сообщение, должны быть разделены точкой с запятой. (адрес1; адрес2)';
$txt['admin_news_select_override_notify'] = 'Отправить сообщение всем пользователям, без исключения';
// Use entities in below.
$txt['admin_news_cannot_pm_emails_js'] = 'Вы не можете отправить личное сообщение на email адрес. Если Вы продолжите все введенные email адреса будут проигнорированы.\\n\\nВы уверены, что хотите сделать это?';

$txt['mailqueue_browse'] = 'Обзор очереди';
$txt['mailqueue_settings'] = 'Настройки почты';

$txt['admin_search'] = 'Быстрый поиск';
$txt['admin_search_type_internal'] = 'Задача/Настройка';
$txt['admin_search_type_member'] = 'Пользователь';
$txt['admin_search_type_online'] = 'Документация Online';
$txt['admin_search_go'] = 'Искать';
$txt['admin_search_results'] = 'Результаты поиска';
$txt['admin_search_results_desc'] = 'Результаты для поиска: &quot;%1$s&quot;';
$txt['admin_search_results_again'] = 'Искать снова';
$txt['admin_search_results_none'] = 'Результатов не найдено!';

$txt['admin_search_section_sections'] = 'Секция';
$txt['admin_search_section_settings'] = 'Настройки';

$txt['core_settings_title'] = 'Основные настройки';
$txt['mods_cat_features'] = 'Настройки';
$txt['mods_cat_security_general'] = 'Основные настройки';
$txt['antispam_title'] = 'Антиспам';
$txt['mods_cat_modifications_misc'] = 'Настройка модификаций';
$txt['mods_cat_layout'] = 'Настройки отображения';
$txt['karma'] = 'Карма';
$txt['moderation_settings_short'] = 'Предупреждения';
$txt['signature_settings_short'] = 'Подписи';
$txt['custom_profile_shorttitle'] = 'Поля профиля';
$txt['pruning_title'] = 'Очистка логов';

$txt['boardsEdit'] = 'Управление разделами';
$txt['mboards_new_cat'] = 'Создать новую категорию';
$txt['manage_holidays'] = 'Управление праздниками';
$txt['calendar_settings'] = 'Настройки календаря';
$txt['search_weights'] = 'Параметры поиска';
$txt['search_method'] = 'Поисковое индексирование';

$txt['smiley_sets'] = 'Установленные смайлы';
$txt['smileys_add'] = 'Добавить смайлы';
$txt['smileys_edit'] = 'Изменить смайлы';
$txt['smileys_set_order'] = 'Установить набор смайлов';
$txt['icons_edit_message_icons'] = 'Изменить иконки сообщения';

$txt['membergroups_new_group'] = 'Добавить группу пользователей';
$txt['membergroups_edit_groups'] = 'Редактировать группы пользователей';
$txt['permissions_groups'] = 'Права доступа по группам';
$txt['permissions_boards'] = 'Права доступа по разделам';
$txt['permissions_profiles'] = 'Изменение профилей';
$txt['permissions_post_moderation'] = 'Премодерация сообщений';

$txt['browse_packages'] = 'Обзор пакетов';
$txt['download_packages'] = 'Загрузка пакетов';
$txt['installed_packages'] = 'Установленные пакеты';
$txt['package_file_perms'] = 'Права доступа на файлы';
$txt['package_settings'] = 'Настройки';
$txt['themeadmin_admin_title'] = 'Управление и установка';
$txt['themeadmin_list_title'] = 'Настройки тем оформления';
$txt['themeadmin_reset_title'] = 'Настройки пользователя';
$txt['themeadmin_edit_title'] = 'Изменение темы оформления';
$txt['admin_browse_register_new'] = 'Зарегистрировать нового пользователя';

$txt['search_engines'] = 'Поисковые системы';
$txt['spiders'] = 'Пауки';
$txt['spider_logs'] = 'Логи';
$txt['spider_stats'] = 'Статистика';

$txt['paid_subscriptions'] = 'Платная подписка';
$txt['paid_subs_view'] = 'Просмотр подписки';

?>