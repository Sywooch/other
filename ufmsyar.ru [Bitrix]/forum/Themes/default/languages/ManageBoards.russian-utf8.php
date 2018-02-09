<?php
// Version: 2.0 RC2; ManageBoards

// Important! Before editing these language files please read the text at the top of index.english.php.
$txt['boards_and_cats'] = 'Управление Разделами и Категориями';
$txt['order'] = 'Расположение';
$txt['full_name'] = 'Название';
$txt['name_on_display'] = 'Название, которое будет отображаться на главной странице.';
$txt['boards_and_cats_desc'] = 'Здесь Вы можете редактировать разделы и категории Вашего форума. Модераторы разделов прописываются в список через запятую, например <em>&quot;username&quot;, &quot;username&quot;</em> (Указывайте реальные имена пользователей, а не отображаемые!).<br />Чтобы создать новый раздел, нажмите кнопку "Добавить раздел". Для создания подраздела форума выберите "Подраздел..." в меню Расположение.';
$txt['parent_members_only'] = 'Обычные пользователи';
$txt['parent_guests_only'] = 'Гости';
$txt['catConfirm'] = 'Вы действительно хотите удалить эту категорию?';
$txt['boardConfirm'] = 'Вы действительно хотите удалить этот раздел?';

$txt['catEdit'] = 'Редактировать категорию';
$txt['collapse_enable'] = 'Сворачиваемая';
$txt['collapse_desc'] = 'Позволить пользователям сворачивать эту категорию';
$txt['catModify'] = '(изменить)';

$txt['mboards_order_after'] = 'После ';
$txt['mboards_order_inside'] = 'В ';
$txt['mboards_order_first'] = 'На первом месте';

$txt['mboards_new_board'] = 'Добавить раздел';
$txt['mboards_new_cat_name'] = 'Новая категория';
$txt['mboards_add_cat_button'] = 'Добавить категорию';
$txt['mboards_new_board_name'] = 'Новый раздел';

$txt['mboards_name'] = 'Название';
$txt['mboards_modify'] = 'изменить';
$txt['mboards_permissions'] = 'права';
// Don't use entities in the below string.
$txt['mboards_permissions_confirm'] = 'Вы уверены, что хотите переключить данный раздел на локальные права доступа?';

$txt['mboards_delete_cat'] = 'Удалить категорию';
$txt['mboards_delete_board'] = 'Удалить раздел';

$txt['mboards_delete_cat_contains'] = 'Удаление этой категории приведёт к удалению содержащихся в ней разделов, а также тем, сообщений и вложений';
$txt['mboards_delete_option1'] = 'Удалить категорию и все разделы, находящиеся в ней.';
$txt['mboards_delete_option2'] = 'Удалить категорию и перенести все разделы в';
$txt['mboards_delete_board_contains'] = 'Удаление этого раздела перенесёт подразделы, включая все темы, сообщения и вложения, находящиеся внутри';
$txt['mboards_delete_board_option1'] = 'Удалить раздел и сконвертировать его подразделы в разделы (поднять подразделы на уровень выше).';
$txt['mboards_delete_board_option2'] = 'Удалить раздел и переместить его подразделы в';
$txt['mboards_delete_what_do'] = 'Пожалуйста, выберите действия, которые будут произведены с этими разделами';
$txt['mboards_delete_confirm'] = 'Подтвердить';
$txt['mboards_delete_cancel'] = 'Отмена';

$txt['mboards_category'] = 'Категория';
$txt['mboards_description'] = 'Описание';
$txt['mboards_description_desc'] = 'Небольшое описание раздела.';
$txt['mboards_groups'] = 'Группы пользователей.';
$txt['mboards_groups_desc'] = 'Группы пользователей, которые имеют доступ к разделу.<br /><em>Напоминание: если группа пользователей отмечена галочкой, это означает, что она имеет доступ к разделу.</em>';
$txt['mboards_groups_post_group'] = 'Эта группа может отправлять сообщения.';
$txt['mboards_moderators'] = 'Модераторы';
$txt['mboards_moderators_desc'] = 'Пользователи, имеющие специальные привилегии в данном разделе - модераторские права. Заметьте, что Администраторы не должны быть в этих списках.';
$txt['mboards_count_posts'] = 'Подсчитывать сообщения';
$txt['mboards_count_posts_desc'] = 'Прибавляет сообщения, оставленные в этом разделе, к общему числу сообщений пользователей.';
$txt['mboards_unchanged'] = 'По умолчанию';
$txt['mboards_theme'] = 'Тема оформления раздела';
$txt['mboards_theme_desc'] = 'Эта функция позволяет изменять тему оформления форума внутри только этого раздела.';
$txt['mboards_theme_default'] = '(оставить по умолчанию.)';
$txt['mboards_override_theme'] = 'Заменять тему оформления пользователя';
$txt['mboards_override_theme_desc'] = 'Если пользователь использует свою тему оформления, зайдя в этот раздел, его тема поменяется на установленную Вами.';

$txt['mboards_redirect'] = 'Перенаправлять на вебадрес';
$txt['mboards_redirect_desc'] = 'Разрешить данную опцию, перенаправлять всех кто нажмет на раздел на другой вебадрес.';
$txt['mboards_redirect_url'] = 'Адрес(URL) перенаправления пользователей';
$txt['mboards_redirect_url_desc'] = 'Пример: &quot;http://www.simplemachines.org&quot;.';
$txt['mboards_redirect_reset'] = 'Сбросить счетчик перенаправлений';
$txt['mboards_redirect_reset_desc'] = 'При выборе счетчик перенаправлений будет сброшел на 0.';
$txt['mboards_current_redirects'] = 'Текущее количество перенаправлений: %1$s';
$txt['mboards_redirect_disabled'] = 'Обратите внимание: Раздел должен быть пустым чтобы разрешить данную опцию.';
$txt['mboards_redirect_disabled_recycle'] = 'Примечание: Вы не можете установить перенаправление у раздела для удаленных тем.';

$txt['mboards_order_before'] = 'До';
$txt['mboards_order_child_of'] = 'Подраздел';
$txt['mboards_order_in_category'] = 'В Категории';
$txt['mboards_current_position'] = 'Текущая позиция';
$txt['no_valid_parent'] = 'Раздел %1$s не имеет правильной корневой категории. Используйте функцию \'поиск и устранение ошибок\', чтобы исправить эту ошибку.';

$txt['mboards_recycle_disabled_delete'] = 'Примечание: Вы должны выбрать другой раздел для хранения удаленных сообщений, перед тем как удалить этот.';

$txt['mboards_settings_desc'] = 'Редактировать общие настройки Разделов и Категорий.';
$txt['groups_manage_boards'] = 'Группы пользователей, которым разрешено редактировать Разделы и Категории';
$txt['mboards_settings_submit'] = 'Сохранить';
$txt['recycle_enable'] = 'Разрешить восстановление удаленных тем';
$txt['recycle_board'] = 'Раздел для удаленных тем';
$txt['recycle_board_unselected_notice'] = 'Вы включили возможность восстановления удаленных темы не указав раздел для их хранения. Эта функция не будет включена до тех пор, пока Вы не укажете раздел для хранения удаленных тем.
';
$txt['countChildPosts'] = 'Добавлять количество сообщений в дочерних подразделах к общей статистике родительского раздела';
$txt['allow_ignore_boards'] = 'Разрешить игнорировать разделы';

$txt['mboards_select_destination'] = 'Выберите назначение для раздела \'<strong>%1$s</strong>\'';
$txt['mboards_cancel_moving'] = 'Отменить перемещение';
$txt['mboards_move'] = 'переместить';

$txt['mboards_no_cats'] = 'Не создано ни одной категории или раздела.';

?>