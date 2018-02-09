<?php
// Version: 2.0 RC2; Profile

global $scripturl, $context;

// Important! Before editing these language files please read the text at the top of index.english.php.
$txt['no_profile_edit'] = 'Вы не можете изменять профиль данного пользователя.';
$txt['website_title'] = 'Название сайта';
$txt['website_url'] = 'Адрес(URL) сайта';
$txt['signature'] = 'Подпись';
$txt['profile_posts'] = 'Сообщений';
$txt['change_profile'] = 'Изменить профиль';
$txt['delete_user'] = 'Удалить пользователя';
$txt['current_status'] = 'Текущий статус:';
$txt['personal_text'] = 'Подпись под аватаром';
$txt['personal_picture'] = 'Аватар';
$txt['choose_avatar_gallery'] = 'Выбрать аватар из галереи';
$txt['picture_text'] = 'Аватар/Подпись под аватаром';
$txt['reset_form'] = 'Очистить';
$txt['preferred_language'] = 'Предпочитаемый язык';
$txt['age'] = 'Возраст';
$txt['no_pic'] = '(нет аватара)';
$txt['latest_posts'] = 'Последние ответы: ';
$txt['additional_info'] = 'Дополнительная информация';
$txt['avatar_by_url'] = 'Укажите ссылку(URL) на свой аватар. (например: <em>http://www.mypage.com/mypic.gif</em>)';
$txt['my_own_pic'] = 'Укажите ссылку(URL) на аватар';
$txt['date_format'] = 'Формат отображения даты';
$txt['time_format'] = 'Формат отображения времени';
$txt['display_name_desc'] = 'Имя, которое будет отображаться пользователям.';
$txt['personal_time_offset'] = 'Количество часов +/- к времени сервера.';
$txt['dob'] = 'День рождения';
$txt['dob_month'] = 'Месяц (ММ)';
$txt['dob_day'] = 'День (ДД)';
$txt['dob_year'] = 'Год (ГГГГ)';
$txt['password_strength'] = 'В целях безопасности, рекомендуется использовать не менее 6 символов, с использованием комбинации букв, цифр и спецсимволов.';
$txt['include_website_url'] = 'Название Вашего сайта.';
$txt['complete_url'] = 'Адрес(URL) Вашего сайта.';
$txt['your_icq'] = 'Номер ICQ.';
$txt['your_aim'] = 'Имя AOL Instant Messenger.';
$txt['your_yim'] = 'Имя Yahoo! Instant Messenger.';
$txt['sig_info'] = 'Подпись отображается под каждым Вашим сообщением. Вы можете использовать BB код и смайлы.';
$txt['max_sig_characters'] = 'Максимум символов: %1$d; осталось:';
$txt['send_member_pm'] = 'Отправить сообщение этому пользователю';
$txt['hidden'] = 'скрытый';
$txt['current_time'] = 'Текущее время форума';
$txt['digits_only'] = 'Поле количества сообщений, может содержать только цифры.';

$txt['language'] = 'Язык';
$txt['avatar_too_big'] = 'Слишком большое изображение. Попробуйте уменьшить его размер (max';
$txt['invalid_registration'] = 'Неправильная дата регистрации. Пример:';
$txt['msn_email_address'] = 'Ваш email адрес MSN клиента';
$txt['current_password'] = 'Ваш пароль';
// Don't use entities in the below string, except the main ones. (lt, gt, quot.)
$txt['required_security_reasons'] = 'В целях безопасности для принятия изменений необходимо ввести Ваш пароль.';

$txt['timeoffset_autodetect'] = '(автоопределение)';

$txt['secret_question'] = 'Секретный вопрос';
$txt['secret_desc'] = 'Чтобы помочь в восстановлении Вашего пароля, введите здесь секретный вопрос и ответ который знаете <strong>только</strong> Вы.';
$txt['secret_desc2'] = 'Будьте осторожны, не допускайте простых вопросов, на которые можно легко дать ответ!';
$txt['secret_answer'] = 'Ответ';
$txt['secret_ask'] = 'Задать мне секретный вопрос';
$txt['cant_retrieve'] = 'Вы не можете восстановить свой старый пароль, но Вы можете получить новый пароль по почте. Вы можете также установить новый пароль, ответив на секретный вопрос.';
$txt['incorrect_answer'] = 'Извините, но Вы не ввели правильную комбинацию секретного вопроса и ответа на него, указанного в Вашем профиле. Пожалуйста, вернитесь назад и используйте стандартный метод восстановления пароля.';
$txt['enter_new_password'] = 'Пожалуйста, введите ответ на Ваш вопрос и пароль, которым хотите пользоваться. Ваш пароль изменится на тот, который Вы выберите.';
$txt['password_success'] = 'Ваш пароль успешно изменён.<br />Нажмите <a href="' . $scripturl . '?action=login">сюда</a>, чтобы войти на форум.';
$txt['secret_why_blank'] = 'почему пусто?';

$txt['authentication_reminder'] = 'Восстановление параметров авторизации';
$txt['password_reminder_desc'] = 'Если Вы забыли Ваши параметры входа, не переживайте, их можно восстановить. Для этого введите, пожалуйста, ниже Ваше имя или пароль.';
$txt['authentication_options'] = 'Пожалуйста, выберите одну из двух опций ниже';
$txt['authentication_openid_email'] = 'Отправить мне на email адрес OpenID';
$txt['authentication_openid_secret'] = 'Ответить на &quot;секретный вопрос&quot; для восстановления моего OpenID';
$txt['authentication_password_email'] = 'Отправить мой новый пароль на email адрес';
$txt['authentication_password_secret'] = 'Установить новый пароль после ответа на мой &quot;секретный вопрос&quot;';
$txt['openid_secret_reminder'] = 'Пожалуйста введите ответ на вопрос ниже. Если Вы правильно ответите, будет показан Ваш OpenID.';
$txt['reminder_openid_is'] = 'OpenID для Вашей учетной записи:<br />&nbsp;&nbsp;&nbsp;&nbsp;<strong>%1$s</strong><br /><br />Пожалуйста, запишите его для дальнейшего использования.';
$txt['reminder_continue'] = 'Продолжить';

$txt['current_theme'] = 'Текущая тема оформления';
$txt['change'] = '(изменить)';
$txt['theme_preferences'] = 'Настройки темы оформления';
$txt['theme_forum_default'] = 'Тема оформления по умолчанию';
$txt['theme_forum_default_desc'] = 'Данная тема оформления используется на форуме по умолчанию.';

$txt['profileConfirm'] = 'Вы действительно хотите удалить данного пользователя?';

$txt['custom_title'] = 'Подпись над аватаром';

$txt['lastLoggedIn'] = 'Последняя активность';

$txt['notify_settings'] = 'Настройки уведомлений:';
$txt['notify_save'] = 'Сохранить';
$txt['notify_important_email'] = 'Получать новости, объявления и важные уведомления форума по e-mail.';
$txt['notify_regularity'] = 'Включить уведомления в темах и разделах';
$txt['notify_regularity_instant'] = 'Немедленно';
$txt['notify_regularity_first_only'] = 'Немедленно - но только о первом непрочитанном сообщении';
$txt['notify_regularity_daily'] = 'Ежедневно';
$txt['notify_regularity_weekly'] = 'Еженедельно';
$txt['auto_notify'] = 'Включить уведомление сразу после создания новой темы, либо после ответа в другую тему.';
$txt['notify_send_types'] = 'При включении уведомления в теме, уведомить меня при';
$txt['notify_send_type_everything'] = 'Ответе или изменении темы Модератором';
$txt['notify_send_type_everything_own'] = 'Изменении темы Модератором, если я автор';
$txt['notify_send_type_only_replies'] = 'Новых ответах';
$txt['notify_send_type_nothing'] = 'Никогда';
$txt['notify_send_body'] = 'При уведомлении на email о новом сообщении в теме, посылать мне это сообщение в теле письма.';

$txt['notifications_topics'] = 'Текущие уведомления в Темах';
$txt['notifications_topics_list'] = 'Вы получаете уведомления из следующих тем';
$txt['notifications_topics_none'] = 'Вы не получаете уведомлений.';
$txt['notifications_topics_howto'] = 'Чтобы получать уведомления о новых сообщениях, нажмите на кнопку &quot;Уведомлять&quot; в нужной Вам теме.';
$txt['notifications_boards'] = 'Текущие уведомления в Разделах';
$txt['notifications_boards_list'] = 'Вы получаете уведомления из следующих разделов';
$txt['notifications_boards_none'] = 'Вы не получаете уведомлений.';
$txt['notifications_boards_howto'] = 'Чтобы получать уведомления о новых темах в разделе, нажмите на кнопку &quot;Уведомлять&quot; на главной странице нужного Вам раздела.';
$txt['notifications_update'] = 'Отказаться от уведомлений';

$txt['statPanel_showStats'] = 'Статистика пользователя: ';
$txt['statPanel_users_votes'] = 'Количество голосов';
$txt['statPanel_users_polls'] = 'Количество созданных голосований';
$txt['statPanel_total_time_online'] = 'Общее время нахождения на форуме';
$txt['statPanel_noPosts'] = 'Нет сообщений';
$txt['statPanel_generalStats'] = 'Общая Информация';
$txt['statPanel_posts'] = 'сообщений';
$txt['statPanel_topics'] = 'тем';
$txt['statPanel_total_posts'] = 'Всего сообщений';
$txt['statPanel_total_topics'] = 'Количество начатых тем';
$txt['statPanel_votes'] = 'голосов';
$txt['statPanel_polls'] = 'опросов';
$txt['statPanel_topBoards'] = 'Активность в разделах (кол-во сообщений)';
$txt['statPanel_topBoardsActivity'] = 'Активность в разделах (% сообщений)';
$txt['statPanel_activityTime'] = 'Средняя активность пользователя по часам';
$txt['statPanel_timeOfDay'] = 'часы дня';

$txt['deleteAccount_warning'] = 'Внимание - Данное действие нельзя отменить!';
$txt['deleteAccount_desc'] = 'На этой странице Вы можете удалить пользовательскую учетную запись и ее сообщения.';
$txt['deleteAccount_member'] = 'Удалить этого пользователя';
$txt['deleteAccount_posts'] = 'Удалить сообщения этого пользователя';
$txt['deleteAccount_none'] = 'Не удалять';
$txt['deleteAccount_all_posts'] = 'Все сообщения';
$txt['deleteAccount_topics'] = 'Темы и ответы';
$txt['deleteAccount_confirm'] = 'Вы уверены, что хотите удалить этого пользователя?';
$txt['deleteAccount_approval'] = 'Модераторы форума должны одобрить удаление пользователя, после чего его учетная запись удалится.';

$txt['profile_of_username'] = 'Профиль пользователя %1$s';
$txt['profileInfo'] = 'Профиль пользователя';
$txt['showPosts'] = 'Просмотр сообщений';
$txt['showPosts_help'] = 'В этом разделе можно просмотреть все сообщения, сделанные этим пользователем.';
$txt['showMessages'] = 'Сообщения';
$txt['showTopics'] = 'Темы';
$txt['showAttachments'] = 'Вложения';
$txt['statPanel'] = 'Статистика';
$txt['editBuddyIgnoreLists'] = 'Списки Друзей/Игнорируемых';
$txt['editBuddies'] = 'Редактировать список друзей';
$txt['editIgnoreList'] = 'Редактировать список игнорируемых ';
$txt['trackUser'] = 'Проверка пользователя';
$txt['trackActivity'] = 'Активность';
$txt['trackIP'] = 'Проверить IP';

$txt['authentication'] = 'Авторизация';
$txt['change_authentication'] = 'В этом разделе Вы можете выбрать как входить на форум. Вы можете выбрать аккаунт OpenID для авторизации, или переключиться на пару логин-пароль.';

$txt['profileEdit'] = 'Изменить профиль';
$txt['account_info'] = 'На этой странице собрана информация, идентифицирующая Вас на форуме. В целях безопасности, для изменения этой информации Вам необходимо ввести пароль.';
$txt['forumProfile_info'] = 'На этой странице Вы можете изменить информацию о себе. Эта информация будет отображаться на ' . $context['forum_name_html_safe'] . '. Если Вы не считаете необходимым указывать какие-то данные - просто пропустите их, ничего здесь не является обязательным.';
$txt['theme'] = 'Внешний вид форума';
$txt['theme_info'] = 'На этой странице Вы можете изменить настройки внешнего вида форума.';
$txt['notification'] = 'Уведомления и email';
$txt['notification_info'] = 'Форум предоставляет возможность уведомлять Вас об ответах, о новых темах и важных объявлениях. Здесь Вы можете изменить эти настройки, или пересмотреть темы и форумы, уведомления которых, Вы получаете.';
$txt['groupmembership'] = 'Членство в группах';
$txt['groupMembership_info'] = 'В данном разделе Вашего профиля вы можете изменять Вашу принадлежность к группам.';
$txt['ignoreboards'] = 'Игнорирование разделов';
$txt['ignoreboards_info'] = 'Эта страница позволяет Вам игнорировать разделы форума. Когда раздел игнорируется, индикатор новых сообщений не будет отображаться на главной странице. Новые сообщения не будут отображаться при использовании функции "непрочитанные сообщения".';
$txt['pmprefs'] = 'Личные сообщения';

$txt['profileAction'] = 'Действия';
$txt['deleteAccount'] = 'Удалить учетную запись';
$txt['profileSendIm'] = 'Отправить личное сообщение';
$txt['profile_sendpm_short'] = 'Отправить личное сообщение';

$txt['profileBanUser'] = 'Банить пользователя';

$txt['display_name'] = 'Отображаемое имя';
$txt['enter_ip'] = 'Введите IP (диапазон)';
$txt['errors_by'] = 'Сообщения об ошибках пользователя - ';
$txt['errors_desc'] = 'В этой таблице отображаются сообщения об ошибках, вызванных данным пользователем.';
$txt['errors_from_ip'] = 'Сообщения об ошибках с IP адреса (диапазона)';
$txt['errors_from_ip_desc'] = 'В этом поле отображаются сообщения об ошибках полученные с IP адреса (диапазона).';
$txt['ip_address'] = 'IP адрес';
$txt['ips_in_errors'] = 'Использованные IP адреса в сообщениях об ошибках';
$txt['ips_in_messages'] = 'Использованные IP адреса в сообщениях';
$txt['members_from_ip'] = 'Пользователи с данного IP адреса (диапазона)';
$txt['members_in_range'] = 'Пользователи, находящиеся в том же диапазоне';
$txt['messages_from_ip'] = 'Сообщения оставленные с данного IP (диапазона)';
$txt['messages_from_ip_desc'] = 'В этом поле отображаются сообщения оставленные с данного IP адреса (диапазона).';
$txt['most_recent_ip'] = 'Последний использованный IP адрес';
$txt['why_two_ip_address'] = 'Почему здесь показано 2 IP адреса?';
$txt['no_errors_from_ip'] = 'Не найдено ни одного сообщения об ошибках с данного IP адреса (диапазона)';
$txt['no_errors_from_user'] = 'Не найдено ни одного сообщения об ошибках от данного пользователя';
$txt['no_members_from_ip'] = 'Не найдено пользователей с указанного IP адреса (диапазона)';
$txt['no_messages_from_ip'] = 'Не найдено сообщений с указанного IP адреса (диапазона)';
$txt['none'] = 'Отсутствуют';
$txt['own_profile_confirm'] = 'Вы уверены, что хотите удалить свою учетную запись?';
$txt['view_ips_by'] = 'Просмотр IP адресов пользователя - ';

$txt['avatar_will_upload'] = 'Загрузить аватар';

// Use numeric entities in the below three strings.
$txt['activate_changed_email'] = 'Вы изменили свой email адрес. Для подтверждения нового адреса на него отправлено письмо. Пройдите по указанной в письме ссылке, чтобы реактивировать учетную запись.';

$txt['no_reminder_email'] = 'Невозможно отправить письмо с напоминанием пароля.';
$txt['send_email'] = 'Отправить email';
$txt['to_ask_password'] = 'чтобы запросить пароль';

$txt['user_email'] = 'Ваше имя или email';

// Use numeric entities in the below two strings.
$txt['reminder_subject'] = 'Новый пароль для ' . $context['forum_name'];
$txt['reminder_mail'] = 'Это письмо было отправлено Вам с форума '.$context['forum_name'].' Вы воспользовались функцией восстановления пароля для Вашей учетной записи. Для того, чтобы установить новый пароль проследуйте по ссылке';
$txt['reminder_sent'] = 'Письмо успешно отправлено на указанный email адрес. Нажмите на ссылку в полученном письме, чтобы установить новый пароль.';
$txt['reminder_openid_sent'] = 'Ваш текущий OpenID отослан на email адрес.';
$txt['reminder_set_password'] = 'Установка пароля';
$txt['reminder_password_set'] = 'Пароль успешно установлен';
$txt['reminder_error'] = '%1$s неправильно ответил на секретный вопрос при попытке восстановления забытого пароля.';

$txt['registration_not_approved'] = 'Извините, данная учетная запись не одобрена Администратором. Если Вам необходимо изменить email адрес, пожалуйста, нажмите';
$txt['registration_not_activated'] = 'Извините, данная учетная запись не одобрена Администратором. Если Вам необходимо повторно отправить письмо с кодом активации, пожалуйста, нажмите';

$txt['primary_membergroup'] = 'Главная группа';
$txt['additional_membergroups'] = 'Дополнительные группы';
$txt['additional_membergroups_show'] = '[показать дополнительные группы]';
$txt['no_primary_membergroup'] = '(нет главной группы)';
$txt['deadmin_confirm'] = 'Вы уверены, что хотите снять с себя статус Администратора? Это действие не обратимо!';

$txt['account_activate_method_2'] = 'Учетную запись необходимо реактивировать после смены email адреса';
$txt['account_activate_method_3'] = 'Учетная запись не одобрена';
$txt['account_activate_method_4'] = 'Учетная запись ожидает одобрение на удаление';
$txt['account_activate_method_5'] = 'Учетная запись ожидает одобрение. Причина: возрастной ценз';
$txt['account_not_activated'] = 'Учетная запись не активирована';
$txt['account_activate'] = 'активировать';
$txt['account_approve'] = 'подтвердить';
$txt['user_is_banned'] = 'Пользователь забанен';
$txt['view_ban'] = 'Смотреть';
$txt['user_banned_by_following'] = 'Этот пользователь находится в бан листе.';
$txt['user_cannot_due_to'] = 'Пользователь не может %1$s в результате бана: &quot;%2$s&quot;';
$txt['ban_type_post'] = 'оставлять сообщения';
$txt['ban_type_register'] = 'регистрироваться';
$txt['ban_type_login'] = 'входить на форум';
$txt['ban_type_access'] = 'посещать форум';

$txt['show_online'] = 'Показывать другим пользователям Ваш онлайн статус на форуме?';

$txt['return_to_post'] = 'Возвращаться в тему после ответа.';
$txt['no_new_reply_warning'] = 'Не предупреждать о появившихся ответах во время написания собственного сообщения.';
$txt['posts_apply_ignore_list'] = 'Скрывать сообщения написанные пользователями из вашего списка игнорируемых.';
$txt['recent_posts_at_top'] = 'Показывать новые сообщения сверху.';
$txt['recent_pms_at_top'] = 'Показывать новые личные сообщения сверху.';
$txt['wysiwyg_default'] = 'Показывать WYSIWYG редактор по умолчанию при редактировании сообщения.';

$txt['timeformat_default'] = '(По умолчанию)';
$txt['timeformat_easy1'] = 'Месяц День, Год, ЧЧ:ММ:СС am/pm';
$txt['timeformat_easy2'] = 'Месяц День, Год, ЧЧ:ММ:СС (24 часа)';
$txt['timeformat_easy3'] = 'ГГГГ-ММ-ДД, ЧЧ:ММ:СС';
$txt['timeformat_easy4'] = 'ДД Месяц ГГГГ, ЧЧ:ММ:СС';
$txt['timeformat_easy5'] = 'ДД-ММ-ГГГГ, ЧЧ:ММ:СС';

$txt['poster'] = 'Автор';

$txt['board_desc_inside'] = 'Показывать описание раздела внутри самого раздела.';
$txt['show_children'] = 'Показывать подразделы на каждой странице главного раздела.';
$txt['use_sidebar_menu'] = 'Использовать боковое меню вместо выпадающего меню когда это возможно.';
$txt['show_no_avatars'] = 'Не показывать аватары других пользователей.';
$txt['show_no_signatures'] = 'Не показывать подписи других пользователей.';
$txt['show_no_censored'] = 'Оставить слова без цензуры.';
$txt['topics_per_page'] = 'Количество тем на странице:';
$txt['messages_per_page'] = 'Количество сообщений на странице:';
$txt['per_page_default'] = 'по умолчанию';
$txt['calendar_start_day'] = 'Первый день недели в календаре';
$txt['display_quick_reply'] = 'Форма быстрого ответа: ';
$txt['display_quick_reply1'] = 'не показывать';
$txt['display_quick_reply2'] = 'включить, по умолчанию свернута';
$txt['display_quick_reply3'] = 'включить, по умолчанию развернута';
$txt['display_quick_mod'] = 'Показывать функции быстрого модерирования';
$txt['display_quick_mod_none'] = 'не показывать';
$txt['display_quick_mod_check'] = 'ячейками';
$txt['display_quick_mod_image'] = 'значками';

$txt['whois_title'] = 'Проверить IP адрес через whois-сервер';
$txt['whois_afrinic'] = 'AfriNIC (Африка)';
$txt['whois_apnic'] = 'APNIC (Азиатско-Тихоокеанский регион)';
$txt['whois_arin'] = 'ARIN (Северная Америка, часть Карибских островов и Африка к югу от Сахары)';
$txt['whois_lacnic'] = 'LACNIC (Латинская Америка и Карибский регион)';
$txt['whois_ripe'] = 'RIPE (Европа, Ближний Восток и некоторые части Африки и Азии)';

$txt['moderator_why_missing'] = 'почему нет модератора разделов?';
$txt['username_change'] = 'изменить';
$txt['username_warning'] = 'Для изменения имен пользователей, форум должен изменить их пароли, они будут отправлены пользователям с их новыми именами.';

$txt['show_member_posts'] = 'Просмотр сообщений пользователя';
$txt['show_member_topics'] = 'Просмотр тем пользователя';
$txt['show_member_attachments'] = 'Просмотр вложений пользователя';
$txt['show_posts_none'] = 'У пользователя нет ни одного сообщения.';
$txt['show_topics_none'] = 'Пользователь еще не создал ни одной темы.';
$txt['show_attachments_none'] = 'У пользователя нет ни одного вложения.';
$txt['show_attach_filename'] = 'Название файла';
$txt['show_attach_downloads'] = 'Скачано';
$txt['show_attach_posted'] = 'Автор';

$txt['showPermissions'] = 'Права пользователя';
$txt['showPermissions_given'] = 'Разрешено';
$txt['showPermissions_denied'] = 'Запрещено';
$txt['showPermissions_permission'] = 'Права доступа(запрещающие права <del>зачеркнуты</del>)';
$txt['showPermissions_none_general'] = 'Пользователь не имеет специально установленных прав.';
$txt['showPermissions_none_board'] = 'Пользователь не имеет специально установленных прав в разделе.';
$txt['showPermissions_all'] = 'Пользователь имеет все права, так как он является Администратором.';
$txt['showPermissions_select'] = 'Специальные права в разделе';
$txt['showPermissions_general'] = 'Основные права пользователя';
$txt['showPermissions_global'] = 'Все разделы';
$txt['showPermissions_restricted_boards'] = 'Недоступные разделы';
$txt['showPermissions_restricted_boards_desc'] = 'Следующие разделы не доступны для данного пользователя';

$txt['local_time'] = 'Время';
$txt['posts_per_day'] = 'в день';

$txt['buddy_ignore_desc'] = 'Этот раздел предназначен для управления друзьями и игнорируемыми пользователями. Добавление пользователей в эти списки, позволит Вам управлять получением от них личных и email сообщений, в зависимости от выбранных настроек.';

$txt['buddy_add'] = 'Добавить в список друзей';
$txt['buddy_remove'] = 'Удалить из списка друзей';
$txt['buddy_add_button'] = 'Добавить';
$txt['no_buddies'] = 'Ваш список друзей пуст';

$txt['ignore_add'] = 'Добавить в список игнорируемых';
$txt['ignore_remove'] = 'Удалить из списка игнорируемых';
$txt['ignore_add_button'] = 'Добавить';
$txt['no_ignore'] = 'Ваш список игнорируемых пуст';

$txt['regular_members'] = 'Зарегистрированные пользователи';
$txt['regular_members_desc'] = 'Любой пользователь форума член этой группы.';
$txt['group_membership_msg_free'] = 'Ваше членство в группе пользователей обновлено.';
$txt['group_membership_msg_request'] = 'Ваш запрос обрабатывается, пожалуйста подождите.';
$txt['group_membership_msg_primary'] = 'Ваша главная группа была обновлена';
$txt['current_membergroups'] = 'Текущие группы';
$txt['available_groups'] = 'Доступные группы';
$txt['join_group'] = 'Присоединится к группе';
$txt['leave_group'] = 'Покинуть группу';
$txt['request_group'] = 'Запрос на членство в группу';
$txt['approval_pending'] = 'Ожидают одобрения';
$txt['make_primary'] = 'Сделать главной группой';

$txt['request_group_membership'] = 'Запрос на членство в группу пользователей';
$txt['request_group_membership_desc'] = 'Перед тем, как Вы присоединитесь к группе, запрос должен быть одобрен модератором. Пожалуйста, напишите причину по которой Вы хотите присоединится к группе.';
$txt['submit_request'] = 'Отправить запрос';

$txt['profile_updated_own'] = 'Ваш профиль был обновлен.';
$txt['profile_updated_else'] = 'Профиль %1$s был обновлен';

$txt['profile_error_signature_max_length'] = 'Ваша подпись не может быть длиннее %1$d символов';
$txt['profile_error_signature_max_lines'] = 'Ваша подпись не может содержать более %1$d строк';
$txt['profile_error_signature_max_image_size'] = 'Изображения в Вашей подписи не могут быть больше %1$dx%2$d пикселей';
$txt['profile_error_signature_max_image_width'] = 'Изображения в Вашей подписи не могут быть шире %1$d пикселей';
$txt['profile_error_signature_max_image_height'] = 'Изображения в Вашей подписи не могут быть выше %1$d пикселей';
$txt['profile_error_signature_max_image_count'] = 'Вы не можете использовать в подписи более %1$d изображений';
$txt['profile_error_signature_max_font_size'] = 'Размер шрифта в подписи не может быть больше %1$s';
$txt['profile_error_signature_max_smileys'] = 'Вы не можете использовать в подписи более %1$d смайлов';
$txt['profile_error_signature_disabled_bbc'] = 'Следующие BB коды запрещены в подписи: %1$s';

$txt['profile_view_warnings'] = 'Посмотреть предупреждения';
$txt['profile_issue_warning'] = 'Предупреждения';
$txt['profile_warning_level'] = 'Уровень предупреждений';
$txt['profile_warning_desc'] = 'В данном разделе Вы можете выставлять уровень предупреждения и отправлять уведомление если необходимо. Вы также можете проследить историю предупреждений и посмотреть текущий уровень предупреждения выставленный администратором.';
$txt['profile_warning_name'] = 'Имя пользователя';
$txt['profile_warning_impact'] = 'Результат';
$txt['profile_warning_reason'] = 'Причина предупреждения';
$txt['profile_warning_reason_desc'] = 'Обязательно и будет записано.';
$txt['profile_warning_effect_none'] = 'Нет.';
$txt['profile_warning_effect_watch'] = 'Пользователь будет добавлен в список наблюдения модератором.';
$txt['profile_warning_effect_own_watched'] = 'Вы в списке наблюдения Модераторов.';
$txt['profile_warning_is_watch'] = 'пользователь под наблюдением';
$txt['profile_warning_effect_moderation'] = 'Все сообщения пользователя будут модерируемыми.';
$txt['profile_warning_effect_own_moderated'] = 'Все ваши сообщения будут проверяться Модераторами.';
$txt['profile_warning_is_moderation'] = 'сообщения пользователя проходят модерацию';
$txt['profile_warning_effect_mute'] = 'Пользователь не сможет оставлять сообщения.';
$txt['profile_warning_effect_own_muted'] = 'Вы не сможете отправлять сообщения.';
$txt['profile_warning_is_muted'] = 'пользователь не может отправлять сообщения';
$txt['profile_warning_effect_text'] = 'Уровень >= %1$d: %2$s';
$txt['profile_warning_notify'] = 'Послать уведомление';
$txt['profile_warning_notify_template'] = 'Выбрать шаблон:';
$txt['profile_warning_notify_subject'] = 'Тема уведомления';
$txt['profile_warning_notify_body'] = 'Содержание уведомления';
$txt['profile_warning_notify_template_subject'] = 'Вы получили предупреждение';
// Use numeric entities in below string.
$txt['profile_warning_notify_template_outline'] = '{MEMBER},' . "\n\n" . 'Вы получили предупреждение за %1$s. Пожалуйста, соблюдайте правила форума, иначе мы предпримем другие меры.' . "\n\n" . '{REGARDS}';
$txt['profile_warning_notify_template_outline_post'] = '{MEMBER},' . "\n\n" . 'Вы получили предупреждение за %1$s в сообщении:' . "\n" . '{MESSAGE}.' . "\n\n" . 'Пожалуйста, соблюдайте правила форума, иначе мы предпримем другие меры.' . "\n\n" . '{REGARDS}';
$txt['profile_warning_notify_for_spamming'] = 'спам';
$txt['profile_warning_notify_title_spamming'] = 'СПАМ';
$txt['profile_warning_notify_for_offence'] = 'публикация оскорбительного материала';
$txt['profile_warning_notify_title_offence'] = 'Публикация оскорбительного материала';
$txt['profile_warning_notify_for_insulting'] = 'Оскорбление других пользователей и/или сотрудников';
$txt['profile_warning_notify_title_insulting'] = 'Оскорбление пользователей/сотрудников';
$txt['profile_warning_issue'] = 'Предупреждение';
$txt['profile_warning_max'] = '(Максимально 100)';
$txt['profile_warning_limit_attribute'] = 'Обратите внимание Вы не можете увеличить уровень предупреждения пользователя более чем  %1$d%% в период 24 часа.';
$txt['profile_warning_errors_occured'] = 'Предупреждение не было сделано по следующим причинам';
$txt['profile_warning_success'] = 'Предупреждение сделано';
$txt['profile_warning_new_template'] = 'Новый шаблон предупреждения.';

$txt['profile_warning_previous'] = 'Предыдущие предупреждения';
$txt['profile_warning_previous_none'] = 'Данный пользователь не получал предупреждений.';
$txt['profile_warning_previous_issued'] = 'Предупреждение от';
$txt['profile_warning_previous_time'] = 'Время';
$txt['profile_warning_previous_level'] = 'Баллы';
$txt['profile_warning_previous_reason'] = 'Причина';
$txt['profile_warning_previous_notice'] = 'Просмотреть уведомление отправляемое пользователю';

$txt['viewwarning'] = 'Показать Предупреждения';
$txt['profile_viewwarning_for_user'] = 'Предупреждения для %1$s';
$txt['profile_viewwarning_no_warnings'] = 'Пока еще не было предупреждений.';
$txt['profile_viewwarning_desc'] = 'Ниже приводится краткая информация о всех предупреждениях, которые были сделаны модераторами форума.';
$txt['profile_viewwarning_previous_warnings'] = 'Прошлые Предупреждения';
$txt['profile_viewwarning_impact'] = 'Последствия предупреждения';

$txt['subscriptions'] = 'Платная подписка';

$txt['pm_settings_desc'] = 'В этом разделе Вы можете изменять настройки личных сообщений, а также их отображение. Вы, также, можете создать список людей чьи личные сообщения отсылаемые Вам будут игнорироваться.';
$txt['email_notify'] = 'Уведомлять меня по email о появлении новых личных сообщений:';
$txt['email_notify_never'] = 'Никогда';
$txt['email_notify_buddies'] = 'Только от друзей';
$txt['email_notify_always'] = 'Всегда';

$txt['pm_receive_from'] = 'Получать личные сообщения от:';
$txt['pm_receive_from_everyone'] = 'Всех пользователей';
$txt['pm_receive_from_ignore'] = 'Всех пользователей, за исключением игнорируемых';
$txt['pm_receive_from_admins'] = 'Только Администраторов';
$txt['pm_receive_from_buddies'] = 'Только Друзей и Администраторов';

$txt['copy_to_outbox'] = 'По умолчанию, сохранять копии отправленных личных сообщений в папке Исходящие.';
$txt['popup_messages'] = 'Выводить всплывающее окно при появлении нового личного сообщения.';
$txt['pm_remove_inbox_label'] = 'Убирать ярлык Входящее при добавлении другого ярлыка';
$txt['pm_display_mode'] = 'Отображение личных сообщений';
$txt['pm_display_mode_all'] = 'Все сразу';
$txt['pm_display_mode_one'] = 'По одному';
$txt['pm_display_mode_linked'] = 'В древовидной форме';
// Use entities in the below string.
$txt['pm_recommend_enable_outbox'] = 'Чтобы максимально использовать настройки мы рекомендуем включить  &quot;Сохранять копии отправленных Личных Сообщений в папке Исходящие&quot;\\n\\nЭто поможет в общении, так как Вы сможете видеть все сообщения переписки.';

$txt['tracking'] = 'Проверить пользователя';
$txt['tracking_description'] = 'Данный раздел позволяет отслеживать действия пользователя, а также его IP адреса.';

$txt['trackEdits'] = 'Изменения профиля';
$txt['trackEdit_deleted_member'] = 'Пользователь удален';
$txt['trackEdit_no_edits'] = 'Для этого пользователя изменений не проводилось.';
$txt['trackEdit_action'] = 'Поле';
$txt['trackEdit_before'] = 'Предыдущее значение';
$txt['trackEdit_after'] = 'Последующее изменение';
$txt['trackEdit_applicator'] = 'Изменено';

$txt['trackEdit_action_real_name'] = 'Отображаемое имя пользователя';
$txt['trackEdit_action_usertitle'] = 'Подпись над аватаром';
$txt['trackEdit_action_member_name'] = 'Имя пользователя';
$txt['trackEdit_action_email_address'] = 'Email адрес';

?>