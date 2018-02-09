<?php
// Version: 2.0 RC2; ManageMembers

global $context;

// Important! Before editing these language files please read the text at the top of index.english.php.
$txt['groups'] = 'Группы';
$txt['viewing_groups'] = 'Просмотр групп пользователей';

$txt['membergroups_title'] = 'Управление группами пользователей';
$txt['membergroups_description'] = 'Группы пользователей имеют определенные параметры настройки и свои права доступа. Некоторые группы пользователей зависят от количества сообщений. Вы можете назначать группу пользователю зайдя в его профиль и изменив настройки учетной записи.';
$txt['membergroups_modify'] = 'Изменить';

$txt['membergroups_add_group'] = 'Добавить группу';
$txt['membergroups_regular'] = 'Основные группы';
$txt['membergroups_post'] = 'Группы основанные на количестве сообщений';

$txt['membergroups_group_name'] = 'Название новой группы';
$txt['membergroups_new_board'] = 'Доступные разделы';
$txt['membergroups_new_board_desc'] = 'Разделы доступные для группы пользователей';
$txt['membergroups_new_board_post_groups'] = '<em>Примечание: обычно, для того чтобы оставить сообщение не требуется особенных прав, потому как группа по умолчанию предоставляет эти права.</em>';
$txt['membergroups_new_as_inherit'] = 'наследовать из';
$txt['membergroups_new_as_type'] = 'по типу';
$txt['membergroups_new_as_copy'] = 'базируемая на';
$txt['membergroups_new_copy_none'] = '(нет)';
$txt['membergroups_can_edit_later'] = 'Вы можете отредактировать это позднее.';

$txt['membergroups_edit_group'] = 'Редактировать группы пользователей';
$txt['membergroups_edit_name'] = 'Название группы';
$txt['membergroups_edit_inherit_permissions'] = 'Наследуемые права доступа';
$txt['membergroups_edit_inherit_permissions_desc'] = 'Выберите &quot;Нет&quot;, чтобы разрешить группе иметь свои права доступа.';
$txt['membergroups_edit_inherit_permissions_no'] = 'Нет - Использовать уникальные права доступа';
$txt['membergroups_edit_inherit_permissions_from'] = 'Наследовать от';
$txt['membergroups_edit_hidden'] = 'Видимость';
$txt['membergroups_edit_hidden_no'] = 'Видимая';
$txt['membergroups_edit_hidden_boardindex'] = 'Видимая - кроме списка групп';
$txt['membergroups_edit_hidden_all'] = 'Невидимая';
// Do not use numeric entities in the below string.
$txt['membergroups_edit_hidden_warning'] = 'Вы уверены, что хотите запретить назначение этой группы в качестве основной для пользователей? \\n\\nЭто ограничит назначение группы только в качестве дополнительной.';
$txt['membergroups_edit_desc'] = 'Описание группы пользователей';
$txt['membergroups_edit_group_type'] = 'Тип группы пользователей';
$txt['membergroups_edit_select_group_type'] = 'Выбрать тип группы пользователей';
$txt['membergroups_group_type_private'] = 'Приватная <span class="smalltext">(Членство в группе присваивается вручную)</span>';
$txt['membergroups_group_type_request'] = 'По запросу <span class="smalltext">(Пользователь может сделать запрос на членство в группе)</span>';
$txt['membergroups_group_type_free'] = 'Свободная <span class="smalltext">(Пользователь может сам присоединится к данной группе)</span>';
$txt['membergroups_group_type_post'] = 'Основанная на количестве сообщений <span class="smalltext">(Членство в группе основано на количестве сообщений)</span>';
$txt['membergroups_min_posts'] = 'Требуемое количество сообщений';
$txt['membergroups_online_color'] = 'Цвет в списке online';
$txt['membergroups_star_count'] = 'Количество изображений(звезд)';
$txt['membergroups_star_image'] = 'Имя файла эмблемы';
$txt['membergroups_star_image_note'] = 'Вы можете использовать параметр $language для указания языка, если требуется';
$txt['membergroups_max_messages'] = 'Максимальное количество личных сообщений';
$txt['membergroups_max_messages_note'] = '0 - неограниченно';
$txt['membergroups_edit_save'] = 'Сохранить';
$txt['membergroups_delete'] = 'Удалить';
$txt['membergroups_confirm_delete'] = 'Вы уверены что хотите удалить эту группу?!';

$txt['membergroups_members_title'] = 'Показать всех пользователей группы';
$txt['membergroups_members_group_members'] = 'Пользователи группы';
$txt['membergroups_members_no_members'] = 'Эта группа сейчас пуста';
$txt['membergroups_members_add_title'] = 'Добавить пользователя в эту группу';
$txt['membergroups_members_add_desc'] = 'Список добавленных пользователей';
$txt['membergroups_members_add'] = 'Добавить пользователей';
$txt['membergroups_members_remove'] = 'Удалить из группы';
$txt['membergroups_members_last_active'] = 'Последняя активность';
$txt['membergroups_members_additional_only'] = 'Добавить только как дополнительную группу.';
$txt['membergroups_members_group_moderators'] = 'Модераторы группы';
$txt['membergroups_members_description'] = 'Описание';
// Use javascript escaping in the below.
$txt['membergroups_members_deadmin_confirm'] = 'Вы уверены, что хотите удалить самого себя из группы Администраторов?';

$txt['membergroups_postgroups'] = 'Группы пользователей, имеющие права на отсылку сообщений';
$txt['membergroups_settings'] = 'Свойства группы пользователей';
$txt['groups_manage_membergroups'] = 'Группы, которым разрешено изменять группы пользователей';
$txt['membergroups_select_permission_type'] = 'Установить права';
$txt['membergroups_images_url'] = '{theme URL}/images/';
$txt['membergroups_select_visible_boards'] = 'выбрать разделы';
$txt['membergroups_members_top'] = 'Пользователи';
$txt['membergroups_name'] = 'Название группы';
$txt['membergroups_stars'] = 'Эмблема';

$txt['admin_browse_approve'] = 'Пользователи, учетные записи которых, ожидают одобрения';
$txt['admin_browse_approve_desc'] = 'Здесь Вы можете управлять всеми пользователями, учетные записи которых ожидают одобрения.';
$txt['admin_browse_activate'] = 'Учетные записи пользователей, ожидающих активацию';
$txt['admin_browse_activate_desc'] = 'Список пользователей, ожидающих активацию.';
$txt['admin_browse_awaiting_approval'] = 'Ожидают одобрения (%1$d)';
$txt['admin_browse_awaiting_activate'] = 'Ожидают активации (%1$d)';

$txt['admin_browse_username'] = 'Имя пользователя';
$txt['admin_browse_email'] = 'Email адрес ';
$txt['admin_browse_ip'] = 'IP адрес';
$txt['admin_browse_registered'] = 'Зарегистрирован';
$txt['admin_browse_id'] = 'ID';
$txt['admin_browse_with_selected'] = 'С выделенными';
$txt['admin_browse_no_members_approval'] = 'Нет пользователей, ожидающих одобрения.';
$txt['admin_browse_no_members_activate'] = 'Нет пользователей, ожидающих активации.';

// Don't use entities in the below strings, except the main ones. (lt, gt, quot.)
$txt['admin_browse_warn'] = 'всех выделенных пользователей?';
$txt['admin_browse_outstanding_warn'] = 'всех пользователей к которым применимо?';
$txt['admin_browse_w_approve'] = 'Подтвердить';
$txt['admin_browse_w_activate'] = 'Активировать';
$txt['admin_browse_w_delete'] = 'Удалить';
$txt['admin_browse_w_reject'] = 'Отклонить';
$txt['admin_browse_w_remind'] = 'Уведомить';
$txt['admin_browse_w_approve_deletion'] = 'Подтвердить (Удаление учетной записи)';
$txt['admin_browse_w_email'] = 'и отправить email';
$txt['admin_browse_w_approve_require_activate'] = 'Одобрить и потребовать активацию';

$txt['admin_browse_filter_by'] = 'Фильтровать по';
$txt['admin_browse_filter_show'] = 'Отображение';
$txt['admin_browse_filter_type_0'] = 'Неактивированные учетные записи';
$txt['admin_browse_filter_type_2'] = 'Неактивированные изменения Email';
$txt['admin_browse_filter_type_3'] = 'Неодобренные новые учетные записи';
$txt['admin_browse_filter_type_4'] = 'Неодобренные  запросы на удаление учетных записей';
$txt['admin_browse_filter_type_5'] = 'Неодобренные учетные записи, не подходящие под возрастной ценз';

$txt['admin_browse_outstanding'] = 'Неактивированные пользователи';
$txt['admin_browse_outstanding_days_1'] = 'Со всеми пользователями зарегистрированными более';
$txt['admin_browse_outstanding_days_2'] = 'дней назад';
$txt['admin_browse_outstanding_perform'] = 'Выполнить следующие действия';
$txt['admin_browse_outstanding_go'] = 'Выполнить действие';

$txt['check_for_duplicate'] = 'Проверить на двойников';
$txt['dont_check_for_duplicate'] = 'Не проверять на двойников';
$txt['duplicates'] = 'Двойники';

$txt['not_activated'] = 'Не активированы';

?>