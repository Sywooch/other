<?php
// Version: 2.0 RC2; Wireless

// Important! Before editing these language files please read the text at the top of index.english.php.
$txt['wireless_error_home'] = 'Главная страница форума';

$txt['wireless_options'] = 'Дополнительные варианты';
$txt['wireless_options_login'] = 'Войти';
$txt['wireless_options_logout'] = 'Выйти';

$txt['wireless_navigation'] = 'Навигация';
$txt['wireless_navigation_up'] = 'На уровень вверх';
$txt['wireless_navigation_next'] = 'Следующая страница';
$txt['wireless_navigation_prev'] = 'Предыдущая страница';
$txt['wireless_navigation_index'] = 'Главная страница сообщений';
$txt['wireless_navigation_topic'] = 'Назад в форум';

$txt['wireless_pm_inbox'] = 'ЛС входящие';
$txt['wireless_pm_inbox_new'] = 'ЛС входящие (<span style="color: red;">новых: %1$d</span>)';
$txt['wireless_pm_by'] = 'От';
$txt['wireless_pm_add_buddy'] = 'Добавить друга';
$txt['wireless_pm_select_buddy'] = 'Выбрать друга';
$txt['wireless_pm_search_member'] = 'Найти пользователя';
$txt['wireless_pm_search_name'] = 'Имя';
$txt['wireless_pm_no_recipients'] = 'Нет получателей';
$txt['wireless_pm_reply'] = 'Ответить';
$txt['wireless_pm_reply_all'] = 'Ответить всем';
$txt['wireless_pm_reply_to'] = 'Ответить';

$txt['wireless_recent_unread_posts'] = 'Непрочитанные сообщения';
$txt['wireless_recent_unread_replies'] = 'Непрочитанные ответы';

$txt['wireless_display_edit'] = 'Изменить';
$txt['wireless_display_moderate'] = 'Модерирование';
$txt['wireless_display_sticky'] = 'Прикрепить';
$txt['wireless_display_unsticky'] = 'Открепить';
$txt['wireless_display_lock'] = 'Заблокировать';
$txt['wireless_display_unlock'] = 'Разблокировать';

$txt['wireless_end_code'] = 'Конец кода';
$txt['wireless_end_quote'] = 'Конец цитаты';

$txt['wireless_profile_pm'] = 'Отправить ЛС';
$txt['wireless_ban_ip'] = 'Забанить по IP';
$txt['wireless_ban_hostname'] = 'Забанить по имени хоста';
$txt['wireless_ban_email'] = 'Забанить по email адресу';
$txt['wireless_additional_info'] = 'Дополнительная информация';
$txt['wireless_go_to_full_version'] = 'Перейти к полной версии';

// Version: 2.0 RC2; Index

global $forum_copyright, $forum_version, $webmaster_email, $scripturl, $context, $boardurl;

/* Important note about language files in SMF 2.0 upwards:
	1) All language entries in SMF 2.0 are cached. All edits should therefore be made through the admin menu. If you do
	   edit a language file manually you will not see the changes in SMF until the cache refreshes. To manually refresh
	   the cache go to Admin => Maintenance => Clean Cache.

	2) Please also note that strings should use single quotes, not double quotes for enclosing the string
	   except for line breaks.

*/
// Locale (strftime, pspell_new) and spelling. (pspell_new, can be left as '' normally.)
// For more information see:
//   - http://www.php.net/function.pspell-new
//   - http://www.php.net/function.setlocale
// Again, SPELLING SHOULD BE '' 99% OF THE TIME!!  Please read this!
$txt['lang_locale'] = 'ru_RU.utf8';
$txt['lang_dictionary'] = 'ru';
$txt['lang_spelling'] = '';

// Ensure you remember to use uppercase for character set strings.
$txt['lang_character_set'] = 'UTF-8';
// Character set and right to left?
$txt['lang_rtl'] = false;
// Capitalize day and month names?
$txt['lang_capitalize_dates'] = true;

$txt['days'] = array('Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота');
$txt['days_short'] = array('Вс.', 'Пн.', 'Вт.', 'Ср.', 'Чт.', 'Пт.', 'Сб.');
// Months must start with 1 => 'January'. (or translated, of course.)
$txt['months'] = array(1 => 'Января', 'Февраля', 'Марта', 'Апреля', 'Мая', 'Июня', 'Июля', 'Августа', 'Сентября', 'Октября', 'Ноября', 'Декабря');
$txt['months_titles'] = array(1 => 'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь');
$txt['months_short'] = array(1 => 'Янв.', 'Фев.', 'Март', 'Апр.', 'Май', 'Июнь', 'Июль', 'Авг.', 'Сен.', 'Окт.', 'Нояб.', 'Дек.');

$txt['newmessages0'] = 'новое';
$txt['newmessages1'] = 'новых';
$txt['newmessages3'] = 'Новых';
$txt['newmessages4'] = ',';

$txt['admin'] = 'Админ';
$txt['moderate'] = 'Модерация';

$txt['save'] = 'Сохранить';

$txt['modify'] = 'Изменить';
$txt['forum_index'] = '%1$s - Главная страница';
$txt['members'] = 'Пользователей';
$txt['board_name'] = 'Название раздела';
$txt['posts'] = 'Сообщений';

$txt['member_postcount'] = 'Сообщений';
$txt['no_subject'] = '(Нет темы)';
$txt['view_profile'] = 'Просмотр профиля';
$txt['guest_title'] = 'Гость';
$txt['author'] = 'Автор';
$txt['on'] = '';
$txt['remove'] = 'Удалить';
$txt['start_new_topic'] = 'Новая тема';

$txt['login'] = 'Войти';
// Use numeric entities in the below string.
$txt['username'] = 'Имя пользователя';
$txt['password'] = 'Пароль';

$txt['username_no_exist'] = 'Такого пользователя не существует.';
$txt['no_user_with_email'] = 'Пользователя с таким email не существует.';

$txt['board_moderator'] = 'Модератор';
$txt['remove_topic'] = 'Удалить тему';
$txt['topics'] = 'Тем';
$txt['modify_msg'] = 'Редактировать сообщение';
$txt['name'] = 'Имя';
$txt['email'] = 'Email';
$txt['subject'] = 'Тема';
$txt['message'] = 'Сообщение';
$txt['redirects'] = 'Редиректов';
$txt['quick_modify'] = 'Изменить';

$txt['choose_pass'] = 'Пароль';
$txt['verify_pass'] = 'Подтвердите пароль';
$txt['position'] = 'Статус';

$txt['profile_of'] = 'Просмотр профиля';
$txt['total'] = 'Всего';
$txt['posts_made'] = 'Сообщений';
$txt['website'] = 'Сайт';
$txt['register'] = 'Регистрация';
$txt['warning_status'] = 'Статус предупреждения';
$txt['user_warn_watch'] = 'Пользователь в модераторском списке наблюдения';
$txt['user_warn_moderate'] = 'Сообщение пользователя поставлено в очередь для одобрения';
$txt['user_warn_mute'] = 'Пользователь забанен из-за сообщения';
$txt['warn_watch'] = 'Под наблюдением';
$txt['warn_moderate'] = 'Модерируемый';
$txt['warn_mute'] = 'Запрещено оставлять сообщения';

$txt['message_index'] = 'Сообщения';
$txt['news'] = 'Новости';
$txt['home'] = 'Начало';

$txt['lock_unlock'] = 'Заблокировать/Разблокировать тему';
$txt['post'] = 'Отправить';
$txt['error_occured'] = 'Ошибка!';
$txt['at'] = 'в';
$txt['logout'] = 'Выйти';
$txt['started_by'] = 'Автор';
$txt['replies'] = 'Ответов';
$txt['last_post'] = 'Последний ответ';
$txt['admin_login'] = 'Вход для Администратора';
// Use numeric entities in the below string.
$txt['topic'] = 'Тема';
$txt['help'] = 'Помощь';
$txt['notify'] = 'Уведомлять';
$txt['unnotify'] = 'Не уведомлять';
$txt['notify_request'] = 'Вы хотите получить уведомление по email, когда кто-либо ответит в этой теме?';
// Use numeric entities in the below string.
$txt['regards_team'] = "С Уважением,\nАдминистрация форума " . $context['forum_name'] . '';
$txt['notify_replies'] = 'Уведомить о новых ответах';
$txt['move_topic'] = 'Переместить тему';
$txt['move_to'] = 'Переместить в';
$txt['pages'] = 'Страниц';
$txt['users_active'] = 'Пользователи за последние %1$d минут';
$txt['personal_messages'] = 'Личные сообщения';
$txt['reply_quote'] = 'Процитировать';
$txt['reply'] = 'Ответ';
$txt['reply_noun'] = 'Ответ';
$txt['approve'] = 'Одобрить';
$txt['approve_all'] = 'одобрить все';
$txt['awaiting_approval'] = 'Ожидают одобрения';
$txt['attach_awaiting_approve'] = 'Вложения ожидающие одобрения';
$txt['post_awaiting_approval'] = 'Обратите внимание: Данное сообщение ожидает одобрения модератора.';
$txt['there_are_unapproved_topics'] = 'В данном разделе ожидают одобрения %1$s тем и %2$s сообщений. Нажмите <a href="%3$s">здесь</a> для просмотра.';

$txt['msg_alert_none'] = 'Нет сообщений...';
$txt['msg_alert_you_have'] = 'у Вас';
$txt['msg_alert_messages'] = 'сообщений';
$txt['remove_message'] = 'Удалить сообщение';

$txt['online_users'] = 'Пользователи Online';
$txt['personal_message'] = 'Личное сообщение';
$txt['jump_to'] = 'Перейти в';
$txt['go'] = 'да';
$txt['are_sure_remove_topic'] = 'Вы уверены, что хотите удалить эту тему?';
$txt['yes'] = 'Да';
$txt['no'] = 'Нет';

$txt['search_end_results'] = 'Конец результатов';
$txt['search_no_results'] = 'Извините, ничего не найдено';
$txt['search_on'] = 'от';

$txt['search'] = 'Поиск';
$txt['all'] = 'Все';

$txt['back'] = 'Назад';
$txt['password_reminder'] = 'Напомнить пароль';
$txt['topic_started'] = 'Тема начата';
$txt['title'] = 'Название';
$txt['post_by'] = 'Отправлено';
$txt['memberlist_searchable'] = 'Поиск пользователей.';
$txt['welcome_member'] = 'Добро пожаловать';
$txt['admin_center'] = 'Центр администрирования';
$txt['last_edit'] = 'Последнее редактирование';
$txt['notify_deactivate'] = 'Вы хотите отключить уведомление для этой темы?';

$txt['recent_posts'] = 'Последние сообщения';

$txt['location'] = 'Расположение';
$txt['gender'] = 'Пол';
$txt['date_registered'] = 'Дата регистрации';

$txt['recent_view'] = 'Последние сообщения на форуме.';
$txt['recent_updated'] = 'Самое последнее сообщение';

$txt['male'] = 'Мужской';
$txt['female'] = 'Женский';

$txt['error_invalid_characters_username'] = 'Недопустимый символ в имени пользователя.';

$txt['welcome_guest'] = 'Добро пожаловать, <strong>%1$s</strong>. Пожалуйста, <a href="' . $scripturl . '?action=login">войдите</a> или <a href="' . $scripturl . '?action=register">зарегистрируйтесь</a>.';
$txt['login_or_register'] = 'Пожалуйста, <a href="' . $scripturl . '?action=login">войдите</a> или <a href="' . $scripturl . '?action=register">зарегистрируйтесь</a>.';
$txt['welcome_guest_activate'] = '<br />Вам не пришло <a href="' . $scripturl . '?action=activate">письмо с кодом активации?</a>';
$txt['hello_member'] = 'Здравствуйте,';
// Use numeric entities in the below string.
$txt['hello_guest'] = 'Добро пожаловать,';
$txt['welmsg_hey'] = 'Здравствуйте,';
$txt['welmsg_welcome'] = 'Добро пожаловать,';
$txt['welmsg_please'] = 'Пожалуйста,';
$txt['select_destination'] = 'Пожалуйста, выберите назначение';

// Escape any single quotes in here twice.. 'it\'s' -> 'it\\\'s'.
$txt['posted_by'] = 'Автор';

$txt['icon_smiley'] = 'Улыбающийся';
$txt['icon_angry'] = 'Злой';
$txt['icon_cheesy'] = 'Веселый';
$txt['icon_laugh'] = 'Смеющийся';
$txt['icon_sad'] = 'Грустный';
$txt['icon_wink'] = 'Подмигивающий';
$txt['icon_grin'] = 'Усмешка';
$txt['icon_shocked'] = 'Шокированный';
$txt['icon_cool'] = 'Крутой';
$txt['icon_huh'] = 'Непонимающий';
$txt['icon_rolleyes'] = 'Строит глазки';
$txt['icon_tongue'] = 'Показывает язык';
$txt['icon_embarrassed'] = 'Обеспокоенный';
$txt['icon_lips'] = 'Рот на замке';
$txt['icon_undecided'] = 'В замешательстве';
$txt['icon_kiss'] = 'Целующий';
$txt['icon_cry'] = 'Плачущий';

$txt['moderator'] = 'Модератор';
$txt['moderators'] = 'Модераторы';

$txt['mark_board_read'] = 'Отметить весь раздел прочитанным';
$txt['views'] = 'Просмотров';
$txt['new'] = 'Новый';

$txt['view_all_members'] = 'Все пользователи';
$txt['view'] = 'Смотреть';

$txt['viewing_members'] = 'Просматривает список пользователей %1$s из %2$s';
$txt['of_total_members'] = '%1$s всего пользователей';

$txt['forgot_your_password'] = 'Забыли пароль?';

$txt['date'] = 'Дата';
// Use numeric entities in the below string.
$txt['from'] = 'От';
$txt['check_new_messages'] = 'Проверить новые сообщения';
$txt['to'] = 'Кому';

$txt['board_topics'] = 'Тем';
$txt['members_title'] = 'Пользователи';
$txt['members_list'] = 'Список пользователей';
$txt['new_posts'] = 'Новые сообщения';
$txt['old_posts'] = 'Нет новых сообщений';
$txt['redirect_board'] = 'Переадресование';

$txt['sendtopic_send'] = 'Отправить';

$txt['time_offset'] = 'Часовой пояс';
$txt['or'] = 'или';

$txt['no_matches'] = 'Извините, ничего не найдено';

$txt['notification'] = 'Уведомления';

$txt['your_ban'] = 'Извините %1$s, Вы забанены и не можете оставлять сообщения на форуме!';
$txt['your_ban_expires'] = 'Ваш бан истекает через %1$s';
$txt['your_ban_expires_never'] = 'Вы забанены навсегда.';
$txt['ban_continue_browse'] = 'Вы можете продолжать пользоваться форумом как гость.';

$txt['mark_as_read'] = 'Отметить все сообщения прочитанными';

$txt['hot_topics'] = 'Популярная тема (более %1$d ответов)';
$txt['very_hot_topics'] = 'Очень популярная тема (более %1$d ответов)';
$txt['locked_topic'] = 'Заблокированная тема';
$txt['normal_topic'] = 'Обычная тема';
$txt['participation_caption'] = 'Тема с Вашими ответами';

$txt['go_caps'] = 'Перейти';

$txt['print'] = 'Печать';
$txt['profile'] = 'Профиль';
$txt['topic_summary'] = 'Сообщения в этой теме';
$txt['not_applicable'] = 'не указан';
$txt['message_lowercase'] = 'сообщение';
$txt['name_in_use'] = 'Это имя уже используется другим пользователем.';

$txt['total_members'] = 'Всего пользователей';
$txt['total_posts'] = 'Всего сообщений';
$txt['total_topics'] = 'Всего тем';

$txt['mins_logged_in'] = 'Продолжительность сессии (в минутах)';

$txt['preview'] = 'Предварительный просмотр';
$txt['always_logged_in'] = 'Запомнить';

$txt['logged'] = 'Записан';
// Use numeric entities in the below string.
$txt['ip'] = 'IP';

$txt['www'] = 'WWW';

$txt['by'] = 'от';

$txt['hours'] = 'часов';
$txt['days_word'] = 'дней';

$txt['newest_member'] = ', наш новый пользователь.';

$txt['search_for'] = 'Искать';

$txt['aim'] = 'AIM';
// In this string, please use +'s for spaces.
$txt['aim_default_message'] = 'Привет. Вы здесь?';
$txt['aim_title'] = 'AOL клиент';
$txt['icq'] = 'ICQ';
$txt['icq_title'] = 'ICQ клиент';
$txt['msn'] = 'MSN';
$txt['msn_title'] = 'MSN клиент';
$txt['yim'] = 'YIM';
$txt['yim_title'] = 'Yahoo клиент';

$txt['maintain_mode_on'] = 'Форум находится на \'Техническом обслуживании\'.';

$txt['read'] = 'Прочитано';
$txt['times'] = 'раз';

$txt['forum_stats'] = 'Статистика форума';
$txt['latest_member'] = 'Последний пользователь';
$txt['total_cats'] = 'Всего категорий';
$txt['latest_post'] = 'Последнее сообщение';

$txt['you_have'] = 'У Вас';
$txt['click'] = 'Нажать';
$txt['here'] = 'здесь';
$txt['to_view'] = 'для просмотра.';

$txt['total_boards'] = 'Всего разделов';

$txt['print_page'] = 'Печать страницы';

$txt['valid_email'] = 'E-mail должен быть существующим.';

$txt['geek'] = 'Я форумный маньяк!!';
$txt['info_center_title'] = '%1$s - Информационный центр';

$txt['send_topic'] = 'Отправить эту тему';

$txt['sendtopic_title'] = 'Отправить ссылку на эту тему &quot;%1$s&quot; другу.';
$txt['sendtopic_sender_name'] = 'Ваше имя';
$txt['sendtopic_sender_email'] = 'Ваш email';
$txt['sendtopic_receiver_name'] = 'Имя получателя';
$txt['sendtopic_receiver_email'] = 'E-mail получателя';
$txt['sendtopic_comment'] = 'Добавить комментарий';

$txt['allow_user_email'] = 'Разрешить пользователям отправлять Вам email';

$txt['check_all'] = 'Выделить Все';

// Use numeric entities in the below string.
$txt['database_error'] = 'Ошибка базы данных';
$txt['try_again'] = 'Пожалуйста, повторите еще раз. Если ошибка продолжает повторятся, обратитесь к Администратору.';
$txt['file'] = 'Файл';
$txt['line'] = 'Строка';
// Use numeric entities in the below string.
$txt['tried_to_repair'] = 'SMF обнаружил и пытается автоматически исправить ошибку в Вашей базе данных. Если проблема осталась или Вы продолжаете получать письма, пожалуйста, обратитесь к Вашему хостеру.';
$txt['database_error_versions'] = '<strong>Примечание:</strong> Возможно Вашей базе данных <em>требуется </em>обновление.  Версия файлов Вашего форума %1$s, тогда как версия Вашей базы данных %2$s. Для устранения ошибки обновите, пожалуйста, форум.';
$txt['template_parse_error'] = 'Ошибка шаблона!';
$txt['template_parse_error_message'] = 'Возможно что-то случилось на форуме с системой шаблонов. Это временная проблема, пожалуйста, возвращайтесь чуть позже и попробуйте снова. Если Вы увидите это сообщение снова, пожалуйста, обратитесь к Администратору форума.<br /><br />Вы также можете попробовать <a href="javascript:location.reload();">обновить страницу</a>.';
$txt['template_parse_error_details'] = 'Проблема с загрузкой <tt><strong>%1$s</strong></tt> шаблона или языкового файла.  Пожалуйста, проверьте синтаксис и попробуйте снова - запомните, одинарные кавычки (<tt>\'</tt>) нельзя ставить после слэша (<tt>\\</tt>). Чтобы увидеть более подробную информацию об ошибке PHP, попытайтесь <a href="' . $boardurl . '%1$s">запустить непосредственно сам файл</a>.<br /><br />Также Вы можете <a href="javascript:location.reload();">обновить страницу</a> или <a href="' . $scripturl . '?theme=1">использовать тему по умолчанию</a>.';

$txt['today'] = '<strong>Сегодня</strong> в ';
$txt['yesterday'] = '<strong>Вчера</strong> в ';
$txt['new_poll'] = 'Новое голосование';
$txt['poll_question'] = 'Вопрос';
$txt['poll_vote'] = 'Голосовать';
$txt['poll_total_voters'] = 'Всего голосов';
$txt['shortcuts'] = 'подсказка: нажмите alt+s чтобы подтвердить/отправить или alt+p чтобы предварительно просмотреть сообщение';
$txt['shortcuts_firefox'] = 'подсказка: нажмите shift+alt+s чтобы подтвердить/отправить или shift+alt+p для предварительного просмотра сообщения';
$txt['poll_results'] = 'Посмотреть результаты';
$txt['poll_lock'] = 'Заблокировать голосование';
$txt['poll_unlock'] = 'Разблокировать голосование';
$txt['poll_edit'] = 'Редактировать голосование';
$txt['poll'] = 'Голосование';
$txt['one_day'] = '1 день';
$txt['one_week'] = '1 неделя';
$txt['one_month'] = '1 месяц';
$txt['forever'] = 'Навсегда';
$txt['quick_login_dec'] = 'Войти';
$txt['one_hour'] = '1 час';
$txt['moved'] = 'Перенесено';
$txt['moved_why'] = 'Пожалуйста, укажите причину перемещения данной темы.';
$txt['board'] = 'Раздел';
$txt['in'] = 'в';
$txt['sticky_topic'] = 'Прикрепленная тема';

$txt['delete'] = 'Удалить';

$txt['your_pms'] = 'Ваши личные сообщения';

$txt['kilobyte'] = 'кБ';

$txt['more_stats'] = '[Подробная статистика]';

// Use numeric entities in the below three strings.
$txt['code'] = 'Код';
$txt['code_select'] = '[Выделить]';
$txt['quote_from'] = 'Цитата';
$txt['quote'] = 'Цитировать';

$txt['merge_to_topic_id'] = 'ID темы с которой объединить';
$txt['split'] = 'Разделить тему';
$txt['merge'] = 'Объединить тему';
$txt['subject_new_topic'] = 'Название для новой темы';
$txt['split_this_post'] = 'Отделить только это сообщение.';
$txt['split_after_and_this_post'] = 'Отделить это и последующие сообщения.';
$txt['select_split_posts'] = 'Отделить выделенные сообщения.';
$txt['new_topic'] = 'Новая тема';
$txt['split_successful'] = 'Тема успешно разделена на две.';
$txt['origin_topic'] = 'Исходная тема';
$txt['please_select_split'] = 'Пожалуйста, выберите сообщения, которые необходимо отделить.';
$txt['merge_successful'] = 'Темы успешно объединены.';
$txt['new_merged_topic'] = 'Новая объединенная тема';
$txt['topic_to_merge'] = 'Тема для объединения';
$txt['target_board'] = 'Раздел для новой темы';
$txt['target_topic'] = 'Объединить с темой';
$txt['merge_confirm'] = 'Вы уверены, что хотите объединить тему?';
$txt['with'] = 'с';
$txt['merge_desc'] = 'Эта функция объединяет две темы в одну. Сообщения будут упорядочены по дате. Самое раннее сообщение будет первым в объединённой теме.';

$txt['set_sticky'] = 'Прикрепить тему';
$txt['set_nonsticky'] = 'Открепить тему';
$txt['set_lock'] = 'Заблокировать тему';
$txt['set_unlock'] = 'Разблокировать тему';

$txt['search_advanced'] = 'Расширенный поиск';

$txt['security_risk'] = 'РИСК БЕЗОПАСНОСТИ:';
$txt['not_removed'] = 'ВЫ НЕ УДАЛИЛИ ';
$txt['not_removed_extra'] = '%1$s это резервная копия %2$s, которая была создана не форумом. Она доступна напрямую и может использоваться для получения несанкционированного доступа к вашему форуму. Следует удалить ее немедленно.';

$txt['cache_writable_head'] = 'Предупреждение о низкой производительности';
$txt['cache_writable'] = 'Директория для кэширования не доступна для записи - это значительно снизит производительность работы Вашего форума.';

$txt['page_created'] = 'Страница сгенерирована за ';
$txt['seconds_with'] = ' секунд. Запросов: ';
$txt['queries'] = '.';

$txt['report_to_mod_func'] = 'Используйте эту функцию для информирования Модераторов и Администраторов об оскорбительных сообщениях.<br /><em>Пожалуйста, обратите внимание на то, что Ваш email будет показан Модераторам, если Вы используете эту функцию.</em>';

$txt['online'] = 'Онлайн';
$txt['offline'] = 'Оффлайн';
$txt['pm_online'] = 'Личное сообщение (Онлайн)';
$txt['pm_offline'] = 'Личное сообщение (Оффлайн)';
$txt['status'] = 'Статус';

$txt['go_up'] = 'Вверх';
$txt['go_down'] = 'Вниз';

$forum_copyright = '<a href="http://www.simplemachines.org/" title="Simple Machines Forum" target="_blank" class="new_win">Powered by %1$s</a> |
 <a href="http://www.simplemachines.org/about/copyright.php" title="Free Forum Software" target="_blank" class="new_win">SMF &copy; 2006&ndash;2009, Simple Machines LLC</a>';

$txt['birthdays'] = 'Дни рождения:';
$txt['events'] = 'События:';
$txt['birthdays_upcoming'] = 'Ближайшие дни рождения:';
$txt['events_upcoming'] = 'Ближайшие события:';
// Prompt for holidays in the calendar, leave blank to just display the holiday's name.
$txt['calendar_prompt'] = '';
$txt['calendar_month'] = 'Месяц:';
$txt['calendar_year'] = 'Год:';
$txt['calendar_day'] = 'День:';
$txt['calendar_event_title'] = 'Название события';
$txt['calendar_event_options'] = 'Настройки события';
$txt['calendar_post_in'] = 'Отправить в:';
$txt['calendar_edit'] = 'Редактировать событие';
$txt['event_delete_confirm'] = 'Удалить это событие?';
$txt['event_delete'] = 'Удалить событие';
$txt['calendar_post_event'] = 'Добавить событие';
$txt['calendar'] = 'Календарь';
$txt['calendar_link'] = 'Ссылка на календарь';
$txt['calendar_upcoming'] = 'Календарь предстоящих событий';
$txt['calendar_today'] = 'Календарь на Сегодня';
$txt['calendar_week'] = 'Неделя';
$txt['calendar_week_title'] = 'Неделя %1$d из %2$d';
$txt['calendar_numb_days'] = 'Количество дней:';
$txt['calendar_how_edit'] = 'как отредактировать это событие?';
$txt['calendar_link_event'] = 'Ссылка на событие';
$txt['calendar_confirm_delete'] = 'Вы уверены, что хотите удалить это событие?';
$txt['calendar_linked_events'] = 'Ссылки на связанные события';
$txt['calendar_click_all'] = 'нажмите сюда для просмотра %1$s';

$txt['moveTopic1'] = 'Выберите тему для перенаправления';
$txt['moveTopic2'] = 'Изменить название темы';
$txt['moveTopic3'] = 'Новая тема';
$txt['moveTopic4'] = 'Изменить название темы в каждом сообщении';
$txt['move_topic_unapproved_js'] = 'Предупреждение! Данная тема не одобрена.\\n\\nНе рекомендуется создавать тему перенаправления если Вы сразу не одобрите тему.';

$txt['theme_template_error'] = 'Невозможно загрузить \'%1$s\' шаблон.';
$txt['theme_language_error'] = 'Невозможно загрузить \'%1$s\' языковой файл.';

$txt['parent_boards'] = 'Подразделы';

$txt['smtp_no_connect'] = 'Ошибка подключения к SMTP серверу';
$txt['smtp_port_ssl'] = 'Неверно указан SMTP порт; Для SSL серверов он должен быть 465.';
$txt['smtp_bad_response'] = 'Не могу получить ответ с почтового сервера';
$txt['smtp_error'] = 'Проблема с отправкой почты. Ошибка: ';
$txt['mail_send_unable'] = 'Невозможно отправить почту по указанному адресу \'%1$s\'';

$txt['mlist_search'] = 'Поиск пользователей';
$txt['mlist_search_again'] = 'Искать еще раз';
$txt['mlist_search_email'] = 'Поиск по email';
$txt['mlist_search_messenger'] = 'Искать по имени ICQ, AIM, MSN, YIM';
$txt['mlist_search_group'] = 'Искать по статусу';
$txt['mlist_search_name'] = 'Искать по имени';
$txt['mlist_search_website'] = 'Искать по названию сайта';
$txt['mlist_search_results'] = 'Искать';
$txt['mlist_search_by'] = 'Поиск %1$s';
$txt['mlist_menu_view'] = 'Просмотр списка пользователей';

$txt['attach_downloaded'] = 'загружено';
$txt['attach_viewed'] = 'просмотрено';
$txt['attach_times'] = 'раз';

$txt['settings'] = 'Настройки';
$txt['never'] = 'Никогда';
$txt['more'] = 'еще';

$txt['hostname'] = 'Хост';
$txt['you_are_post_banned'] = 'Извините %1$s, но Вы забанены и не можете принимать и отсылать личные сообщения на этом форуме.';
$txt['ban_reason'] = 'Причина';

$txt['tables_optimized'] = 'Таблицы базы данных оптимизированы';

$txt['add_poll'] = 'Добавить голосование';
$txt['poll_options6'] = 'Вы можете выбрать %1$s вариантов ответа.';
$txt['poll_remove'] = 'Удалить голосование';
$txt['poll_remove_warn'] = 'Вы уверены, что хотите удалить голосование??';
$txt['poll_results_expire'] = 'Результаты будут показаны, после того как голосование будет окончено';
$txt['poll_expires_on'] = 'Голосование заканчивается';
$txt['poll_expired_on'] = 'Голосование закончилось';
$txt['poll_change_vote'] = 'Удалить Голос';
$txt['poll_return_vote'] = 'Настройка Голосования';
$txt['poll_cannot_see'] = 'В данный момент Вы не можете просмотреть результаты голосования.';

$txt['quick_mod_approve'] = 'Одобрить выделенные';
$txt['quick_mod_remove'] = 'Удалить выделенные';
$txt['quick_mod_lock'] = 'Заблокировать выделенные';
$txt['quick_mod_sticky'] = 'Прикрепить выделенные';
$txt['quick_mod_move'] = 'Переместить выделенные в';
$txt['quick_mod_merge'] = 'Соединить выделенные';
$txt['quick_mod_markread'] = 'Пометить выделенные как прочитанные';
$txt['quick_mod_go'] = 'Вперед!';
$txt['quickmod_confirm'] = 'Вы уверены?';

$txt['spell_check'] = 'Проверка орфографии';

$txt['quick_reply'] = 'Быстрый ответ';
$txt['quick_reply_desc'] = 'С <em>быстрым ответом</em> Вы также можете использовать BB код и смайлы.';
$txt['quick_reply_warning'] = 'Внимание: эта тема заблокирована! Ответить в ней может только модератор или администратор форума.';
$txt['quick_reply_verification'] = 'После отправки Вашего сообщения Вы будете перенаправлены на страницу полного ответа чтобы подтвердить его %1$s.';
$txt['quick_reply_verification_guests'] = '(требуется для всех гостей)';
$txt['quick_reply_verification_posts'] = '(требуется для всех пользователей у которых менее %1$d сообщений)';
$txt['wait_for_approval'] = 'Обратите внимание: Данное сообщение не будет отображаться пока модератор не одобрит его.';

$txt['notification_enable_board'] = 'Вы уверены, что хотите получать уведомления при создании новых тем в данном разделе форума?';
$txt['notification_disable_board'] = 'Отключить уведомление?';
$txt['notification_enable_topic'] = 'Вы уверены, что хотите получать уведомления при новых ответах в этой теме?';
$txt['notification_disable_topic'] = 'Отключить уведомление?';

$txt['report_to_mod'] = 'Сообщить модератору';
$txt['issue_warning_post'] = 'Сделать предупреждение из-за данного сообщения';

$txt['unread_topics_visit'] = 'Непрочитанные темы';
$txt['unread_topics_visit_none'] = 'Нет непрочитанных тем с момента Вашего последнего посещения.  <a href="' . $scripturl . '?action=unread;all">Просмотреть все непрочитанные темы</a>.';
$txt['unread_topics_all'] = 'Все непрочитанные темы';
$txt['unread_replies'] = 'Непрочитанные темы';

$txt['who_title'] = 'Кто онлайн';
$txt['who_and'] = ' и ';
$txt['who_viewing_topic'] = ' смотрят эту тему.';
$txt['who_viewing_board'] = ' смотрят этот раздел.';
$txt['who_member'] = 'Пользователь';

// No longer used by default theme, but for backwards compat
$txt['powered_by_php'] = 'Powered by PHP';
$txt['powered_by_mysql'] = 'Powered by MySQL';
$txt['valid_css'] = 'Valid CSS!';

// Current footer strings
$txt['valid_html'] = 'Valid HTML 4.01!';
$txt['valid_xhtml'] = 'Valid XHTML 1.0!';
$txt['wap2'] = 'WAP2';
$txt['rss'] = 'RSS';
$txt['xhtml'] = 'XHTML';
$txt['html'] = 'HTML';

$txt['guest'] = 'Гость';
$txt['guests'] = 'Гостей';
$txt['user'] = 'Пользователь';
$txt['users'] = 'Пользователей';
$txt['hidden'] = 'Скрытый';
$txt['buddy'] = 'Друг';
$txt['buddies'] = 'Друзья';
$txt['most_online_ever'] = 'Максимум онлайн за все время';
$txt['most_online_today'] = 'Максимум онлайн сегодня';

$txt['merge_select_target_board'] = 'Выбрать раздел для объединённой темы';
$txt['merge_select_poll'] = 'Выбрать голосование, для объединённой темы';
$txt['merge_topic_list'] = 'Выбрать темы для объединения';
$txt['merge_select_subject'] = 'Название объединённой темы';
$txt['merge_custom_subject'] = 'Выбрать название';
$txt['merge_enforce_subject'] = 'Изменить тему у всех сообщений';
$txt['merge_include_notifications'] = 'Включить Уведомления?';
$txt['merge_check'] = 'Объединить?';
$txt['merge_no_poll'] = 'Нет голосования';

$txt['response_prefix'] = 'Re: ';
$txt['current_icon'] = 'Иконка';
$txt['message_icon'] = 'Иконка сообщения';

$txt['smileys_current'] = 'Текущий набор смайлов';
$txt['smileys_none'] = 'Нет смайлов';
$txt['smileys_forum_board_default'] = 'Форум/Раздел по умолчанию';

$txt['search_results'] = 'Результаты поиска';

$txt['totalTimeLogged1'] = 'Общее время, проведенное на форуме: ';
$txt['totalTimeLogged2'] = ' дней, ';
$txt['totalTimeLogged3'] = ' часов и ';
$txt['totalTimeLogged4'] = ' минут.';
$txt['totalTimeLogged5'] = 'д ';
$txt['totalTimeLogged6'] = 'ч ';
$txt['totalTimeLogged7'] = 'м';

$txt['approve_thereis'] = '<b>Внимание!</b>';
$txt['approve_thereare'] = '<b>Внимание!</b>';
$txt['approve_member'] = 'Один пользователь';
$txt['approve_members'] = 'пользователи';
$txt['approve_members_waiting'] = 'ожидают одобрения.';

$txt['notifyboard_turnon'] = 'Вы хотите получать уведомления о новых темах в этом разделе?';
$txt['notifyboard_turnoff'] = 'Вы не хотите получать уведомления о новых темах в этом разделе?';

$txt['activate_code'] = 'Ваш код активации';

$txt['find_members'] = 'Поиск пользователей';
$txt['find_username'] = 'Отображаемое имя, имя пользователя или email адрес';
$txt['find_buddies'] = 'Отображать только друзей?';
$txt['find_wildcards'] = 'Доступные символы для поиска по маске: *, ?';
$txt['find_no_results'] = 'Ничего не найдено';
$txt['find_results'] = 'Результаты';
$txt['find_close'] = 'Закрыть';

$txt['unread_since_visit'] = 'Показать новые сообщения с Вашего последнего визита.';
$txt['show_unread_replies'] = 'Показать новые ответы на Ваши сообщения.';

$txt['change_color'] = 'Изменить цвет';

$txt['quickmod_delete_selected'] = 'Удалить выбранные';

// In this string, don't use entities. (&amp;, etc.)
$txt['show_personal_messages'] = 'Вы получили одно или несколько личных сообщений.\\nПросмотреть их (в новом окне)?';

$txt['previous_next_back'] = '&laquo; предыдущая тема';
$txt['previous_next_forward'] = 'следующая тема &raquo;';

$txt['movetopic_auto_board'] = '[РАЗДЕЛ ФОРУМА]';
$txt['movetopic_auto_topic'] = '[ССЫЛКА НА ТЕМУ]';
$txt['movetopic_default'] = 'Тема перенесена в ' . $txt['movetopic_auto_board'] . ".\n\n" . $txt['movetopic_auto_topic'];

$txt['upshrink_description'] = 'Свернуть/Развернуть.';

$txt['mark_unread'] = 'Отметить непрочитанной';

$txt['ssi_not_direct'] = 'Пожалуйста, не обращайтесь напрямую к файлу SSI.php через адрес(URL), возможно, Вы захотите использовать путь (%1$s) или добавить ?ssi_function=something.';
$txt['ssi_session_broken'] = 'SSI.php не может загрузить сессию! Возможно это проблема связана с выходом или другими функциями - пожалуйста убедитесь что SSI.php вставлен в самом начале перед всеми другими скриптами!';

// Escape any single quotes in here twice.. 'it\'s' -> 'it\\\'s'.
$txt['preview_title'] = 'Предварительный просмотр';
$txt['preview_fetch'] = 'Ожидание предварительного просмотра...';
$txt['preview_new'] = 'Новое сообщение';
$txt['error_while_submitting'] = 'Следующие ошибки возникли при попытке отправки сообщения:';
$txt['error_old_topic'] = 'Предупреждение: в данной теме не было сообщений более %1$d дней.<br />Если Вы не уверены что хотите ответить, то лучше создайте новую тему.';

$txt['split_selected_posts'] = 'Выбранные сообщения';
$txt['split_selected_posts_desc'] = 'Ниже находятся сообщения, формирующие тему после разделения.';
$txt['split_reset_selection'] = 'снять выделение';

$txt['modify_cancel'] = 'Отменить';
$txt['mark_read_short'] = 'Пометить прочитанными';

$txt['pm_short'] = 'Личные сообщения';
$txt['pm_menu_read'] = 'Прочитать Ваши сообщения';
$txt['pm_menu_send'] = 'Отправить сообщение';

$txt['hello_member_ndt'] = 'Здравствуйте,';

$txt['unapproved_posts'] = 'Неодобренные сообщения (Тем: %1$d, Сообщений: %2$d)';

$txt['ajax_in_progress'] = 'Загружается...';

$txt['mod_reports_waiting'] = 'В настоящее время отчет %1$d у модератора на рассмотрении.';

$txt['view_unread_category'] = 'Непрочитанные сообщения';
$txt['verification'] = 'Визуальная проверка';
$txt['visual_verification_description'] = 'Наберите символы отображаемые на изображении';
$txt['visual_verification_sound'] = 'Прослушать';
$txt['visual_verification_request_new'] = 'Запросить другое изображение';

// Sub menu labels
$txt['summary'] = 'Основная информация';
$txt['account'] = 'Настройки учетной записи';
$txt['forumprofile'] = 'Профиль';

$txt['modSettings_title'] = 'Характеристики и настройки';
$txt['package'] = 'Пакеты модификаций';
$txt['errlog'] = 'Логи ошибок форума';
$txt['edit_permissions'] = 'Права доступа';
$txt['mc_unapproved_attachments'] = 'Неодобренные вложения';
$txt['mc_unapproved_poststopics'] = 'Неодобренные сообщения и темы';
$txt['mc_reported_posts'] = 'Уведомления о сообщениях';
$txt['modlog_view'] = 'Логи модерации';
$txt['calendar_menu'] = 'Просмотр календаря';

//!!! Send email strings - should move?
$txt['send_email'] = 'Отправить Email';
$txt['send_email_disclosed'] = 'Обратите внимание, Ваш email будет виден получателю.';
$txt['send_email_subject'] = 'Тема сообщения';

$txt['ignoring_user'] = 'Вы игнорируете данного пользователя.';
$txt['show_ignore_user_post'] = 'Отобразить сообщение.';

$txt['spider'] = 'Паук';
$txt['spiders'] = 'Пауков';
$txt['openid'] = 'OpenID';

$txt['downloads'] = 'Скачано';
$txt['filesize'] = 'Размер файла';
$txt['subscribe_webslice'] = 'Добавить веб-фрагмент в браузер';

// Restore topic
$txt['restore_topic'] = 'Восстановить тему';
$txt['restore_message'] = 'Восстановить сообщение';
$txt['quick_mod_restore'] = 'Восстановить выделенные сообщения';

// Editor prompt.
$txt['prompt_text_email'] = 'Введите e-mail адрес.';
$txt['prompt_text_ftp'] = 'Ведите ftp адрес';
$txt['prompt_text_url'] = 'Введите адрес ссылки.';
$txt['prompt_text_img'] = 'Ведите местонахождение картинки.';

// Escape any single quotes in here twice.. 'it\'s' -> 'it\\\'s'.
$txt['autosuggest_delete_item'] = 'Удалить';

// Debug related - when $db_show_debug is true.
$txt['debug_templates'] = 'Шаблонов: ';
$txt['debug_subtemplates'] = 'Дополнительных шаблонов: ';
$txt['debug_language_files'] = 'Языковых файлов: ';
$txt['debug_stylesheets'] = 'Файлов стилей: ';
$txt['debug_files_included'] = 'Подключено файлов: ';
$txt['debug_kb'] = 'KB.';
$txt['debug_show'] = 'показать';
$txt['debug_cache_hits'] = 'Попаданий в кэш: ';
$txt['debug_cache_seconds_bytes'] = '%1$s сек. - %2$s байт';
$txt['debug_cache_seconds_bytes_total'] = '%1$s сек. для %2$s байт';
$txt['debug_queries_used'] = 'Запросов в БД: %1$d.';
$txt['debug_queries_used_and_warnings'] = 'Запросов в БД: %1$d, %2$d предупреждений.';
$txt['debug_query_in_line'] = 'файл <em>%1$s</em>, строка <em>%2$s</em>, ';
$txt['debug_query_which_took'] = 'длительность %1$s сек.';
$txt['debug_query_which_took_at'] = 'что заняло %1$s сек. и запросов: %2$s.';
$txt['debug_show_queries'] = '[Показать Запросы]';
$txt['debug_hide_queries'] = '[Скрыть Запросы]';

// Version: 2.0 RC1; Modifications


?>