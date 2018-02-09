<?php
// Version: 2.0 RC2; Search

// Important! Before editing these language files please read the text at the top of index.english.php.
$txt['set_parameters'] = 'Параметры поиска';
$txt['choose_board'] = 'Выберите раздел, в котором будет производиться поиск';
$txt['all_words'] = 'По фразе целиком';
$txt['any_words'] = 'Любое из слов';
$txt['by_user'] = 'От пользователя';

$txt['search_post_age'] = 'Возраст сообщения';
$txt['search_between'] = 'между';
$txt['search_and'] = 'и';
$txt['search_options'] = 'Свойства';
$txt['search_show_complete_messages'] = 'Отображать результаты в виде сообщений';
$txt['search_subject_only'] = 'Искать только в названиях тем';
$txt['search_relevance'] = 'Совпадение';
$txt['search_date_posted'] = 'Дата сообщения';
$txt['search_order'] = 'Порядок сортировки';
$txt['search_orderby_relevant_first'] = 'Наиболее подходящие результаты первыми';
$txt['search_orderby_large_first'] = 'Наибольшие темы первыми';
$txt['search_orderby_small_first'] = 'Наименьшие темы первыми';
$txt['search_orderby_recent_first'] = 'Последние темы первыми';
$txt['search_orderby_old_first'] = 'Старые темы первыми';
$txt['search_visual_verification_label'] = 'Проверка';
$txt['search_visual_verification_desc'] = 'Для использования поиска пожалуйста введите код с изображения.';

$txt['search_specific_topic'] = 'Искать сообщения только в теме';

$txt['mods_cat_search'] = 'Поиск';
$txt['groups_search_posts'] = 'Группы пользователей с доступом к функции поиска';
$txt['simpleSearch'] = 'Разрешить простой поиск';
$txt['search_results_per_page'] = 'Максимум результатов на страницу';
$txt['search_weight_frequency'] = 'Релевантность поиска по количеству сообщений в теме';
$txt['search_weight_age'] = 'Релевантность поиска по возрасту последних сообщений';
$txt['search_weight_length'] = 'Релевантность поиска по величине темы';
$txt['search_weight_subject'] = 'Релевантность поиска по названию темы';
$txt['search_weight_first_message'] = 'Релевантность поиска по содержащимся первым сообщениям';
$txt['search_weight_sticky'] = 'Релевантность поиска по прикрепленным темам';

$txt['search_settings_desc'] = 'Здесь Вы можете изменять обычные настройки поиска.';
$txt['search_settings_title'] = 'Настройка поиска';

$txt['search_weights_desc'] = 'Здесь Вы можете изменять индивидуальные компоненты оценки совпадения по поиску.';
$txt['search_weights_title'] = 'Релевантность поиска';
$txt['search_weights_total'] = 'Всего';
$txt['search_weights_save'] = 'Сохранить';

$txt['search_method_desc'] = 'Здесь Вы можете установить параметры поиска.';
$txt['search_method_title'] = 'Метод поиска';
$txt['search_method_save'] = 'Сохранить';
$txt['search_method_messages_table_space'] = 'Размер сообщений в базе данных';
$txt['search_method_messages_index_space'] = 'Размер индексов в базе данных';
$txt['search_method_kilobytes'] = 'Кб';
$txt['search_method_fulltext_index'] = 'Полнотекстовое индексирование';
$txt['search_method_no_index_exists'] = 'не созданы';
$txt['search_method_fulltext_create'] = 'создать';
$txt['search_method_fulltext_cannot_create'] = 'невозможно создать индексы, максимальная длина сообщения - 65535, либо тип таблицы отличается от MyISAM';
$txt['search_method_index_already_exists'] = 'уже созданы';
$txt['search_method_fulltext_remove'] = 'удалить';
$txt['search_method_index_partial'] = 'уже созданы';
$txt['search_index_custom_resume'] = 'продолжить';
// This string is used in a javascript confirmation popup; don't use entities.
$txt['search_method_fulltext_warning'] = 'Для использования полнотекстового поиска, Вы должны создать полнотекстовые индексы!';

$txt['search_index'] = 'Поисковое индексирование';
$txt['search_index_none'] = 'Не использовать индексирование';
$txt['search_index_custom'] = 'Выборочное индексирование';
$txt['search_index_sphinx'] = 'Sphinx';
$txt['search_index_sphinx_desc'] = 'Только в панели администрирования разрешено переключать поисковые индексы. Чтобы настроить параметры Sphinx, используйте sphinx_config.php.';
$txt['search_index_label'] = 'Индексы';
$txt['search_index_size'] = 'Размер';
$txt['search_index_create_custom'] = 'создать';
$txt['search_index_custom_remove'] = 'удалить';
// This string is used in a javascript confirmation popup; don't use entities.
$txt['search_index_custom_warning'] = 'Для использования выборочного поиска, Вы должны создать выборочные индексы!';

$txt['search_force_index'] = 'Искать только по индексам';
$txt['search_match_words'] = 'Только слова целиком';
$txt['search_max_results'] = 'Максимум результатов для отображения';
$txt['search_max_results_disable'] = '(0 - без ограничений)';
$txt['search_floodcontrol_time'] = 'Время между отправкой поисковых запросов от одного пользователя';
$txt['search_floodcontrol_time_desc'] = '(0 - без ограничений, в секундах)';

$txt['search_create_index'] = 'Создание индексирования';
$txt['search_create_index_why'] = 'Для чего нужно поисковое индексирование?';
$txt['search_create_index_start'] = 'Создать';
$txt['search_predefined'] = 'Предустановленный профиль';
$txt['search_predefined_small'] = 'Малоразмерное индексирование';
$txt['search_predefined_moderate'] = 'Среднеразмерное индексирование';
$txt['search_predefined_large'] = 'Большеразмерное индексирование';
$txt['search_create_index_continue'] = 'Продолжить';
$txt['search_create_index_not_ready'] = 'SMF создает поисковые индексы сообщений. Чтобы предотвратить большую загрузку сервера, процесс создания индексирования был приостановлен. Процесс автоматически продолжится через несколько секунд. В случае полной остановки, нажмите на кнопку ниже.';
$txt['search_create_index_progress'] = 'Выполнено';
$txt['search_create_index_done'] = 'Индексы созданы!';
$txt['search_create_index_done_link'] = 'Продолжить';
$txt['search_double_index'] = 'Для Вашей таблицы сообщений созданы индексы двух разных типов. Для улучшения производительности рекомендуется удалить индексы неиспользуемого типа индексирования.';

$txt['search_error_indexed_chars'] = 'Неверное число символов индексации. Как минимум 3 символа необходимы для индексации.';
$txt['search_error_max_percentage'] = 'Неверный процент отсеивания слов. Используйте значение около 5%.';
$txt['error_string_too_long'] = 'Искомое слово должно быть длиннее %1$d символов.';

$txt['search_adjust_query'] = 'Уточните параметры поиска';
$txt['search_adjust_submit'] = 'Повторить поиск';
$txt['search_did_you_mean'] = 'Возможно Вы ищите';

$txt['search_example'] = '<em>Например: </em> "Доктор Хаус" -сериал';

$txt['search_engines_description'] = 'При помощи данной панели Вы можете выбрать насколько детальная информация об индексации Вашего форума поисковыми машинами Вам нужна, а также просмотреть логи посещений поисковыми роботами.';
$txt['spider_mode'] = 'Уровень отслеживания поисковых машин<div class="smalltext">Обратите внимание высокий уровень отслеживания приведет к росту нагрузки на сервер.</div>';
$txt['spider_mode_off'] = 'Запрещено';
$txt['spider_mode_standard'] = 'Стандартный - минимальное ведение логов об активности пауков.';
$txt['spider_mode_high'] = 'Высокий - обеспечивает более точную статистику.';
$txt['spider_mode_vhigh'] = 'Очень высокий - тоже что и &quot;Высокий&quot;, но с ведением логов о каждой посещенной странице.';
$txt['spider_settings_desc'] = 'В данном разделе Вы можете изменить настройки отслеживания поисковых систем. Обратите внимание, если Вы хотите настроить автоматическую чистку логов, то можете изменить настройки <a href="%1$s">здесь</a>';

$txt['spider_group'] = 'Назначить группу для пауков <div class="smalltext">Позволит Вам настроить доступ для пауков.</div>';
$txt['spider_group_none'] = 'Запрещено';

$txt['show_spider_online'] = 'Показывать пауков в списке Кто онлайн';
$txt['show_spider_online_no'] = 'Ни для кого';
$txt['show_spider_online_summary'] = 'Показывать количество пауков';
$txt['show_spider_online_detail'] = 'Показывать детали о пауках';
$txt['show_spider_online_detail_admin'] = 'Показывать детали о пауках - только админам';

$txt['spider_name'] = 'Название паука';
$txt['spider_last_seen'] = 'Последнее посещение';
$txt['spider_last_never'] = 'Никогда';
$txt['spider_agent'] = 'User Agent';
$txt['spider_ip_info'] = 'IP адреса';
$txt['spiders_add'] = 'Добавить нового паука';
$txt['spiders_edit'] = 'Изменить паука';
$txt['spiders_remove_selected'] = 'Удалить выделенных пауков';
$txt['spider_remove_selected_confirm'] = 'Вы уверены что хотите удалить этих пауков?\\n\\nВся статистика также будет удалена!';
$txt['spiders_no_entries'] = 'Ни одного паука не добавлено.';

$txt['add_spider_desc'] = 'На этой странице Вы можете изменять параметры пауков. Если user agent / IP адрес гостя будут совпадать с введенными ниже, то он будет опознан как паук поисковой системы и действия его будут записаны согласно настроек форума.';
$txt['spider_name_desc'] = 'Имя паука под которым он будет записан.';
$txt['spider_agent_desc'] = 'User agent связанный с этим пауком.';
$txt['spider_ip_info_desc'] = 'Список IP адресов связанных с этим пауком.';

$txt['spider'] = 'Паук';
$txt['spider_time'] = 'Время';
$txt['spider_viewing'] = 'Просмотров';
$txt['spider_logs_empty'] = 'На данный момент логов пауков нет.';
$txt['spider_logs_info'] = 'Обратите внимание, что регистрация всех действий паука будет записываться только если уровень слежения выставлен &quot;высокий&quot; или &quot;очень высокий&quot;. Детализация по всем действиям паука будет записана только если уровень слежения будет установлен &quot;очень высокий&quot;.';
$txt['spider_disabled'] = 'Запрещено';

$txt['spider_logs_delete'] = 'Удалить записи';
$txt['spider_logs_delete_older'] = 'Удалить все записи старше';
$txt['spider_logs_delete_day'] = 'дней.';
$txt['spider_logs_delete_submit'] = 'Удалить';
// Don't use entities in the below string.
$txt['spider_logs_delete_confirm'] = 'Вы уверены что хотите удалить все записи?';

$txt['spider_stats_select_month'] = 'Перейти к месяцу';
$txt['spider_stats_page_hits'] = 'Хитов';
$txt['spider_stats_no_entries'] = 'На данный момент нет статистики по посещениям пауков.';

?>