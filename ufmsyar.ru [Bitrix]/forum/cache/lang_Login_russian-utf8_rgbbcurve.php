<?php
// Version: 2.0 RC2; Login

global $context;

// Important! Before editing these language files please read the text at the top of index.english.php.
// Registration agreement page.
$txt['registration_agreement'] = 'Регистрационное соглашение';
$txt['agreement_agree'] = 'Я принимаю соглашение.';
$txt['agreement_agree_coppa_above'] = 'Я принимаю соглашение и я старше %1$d лет.';
$txt['agreement_agree_coppa_below'] = 'Я принимаю соглашение и я младше %1$d лет.';

// Registration form.
$txt['registration_form'] = 'Регистрационная форма';
$txt['need_username'] = 'Вы не ввели имя пользователя.';
$txt['no_password'] = 'Вы не ввели пароль.';
$txt['incorrect_password'] = 'Неверный пароль';
$txt['choose_username'] = 'Имя пользователя';
$txt['maintain_mode'] = 'Техническое обслуживание';
$txt['registration_successful'] = 'Регистрация прошла успешно';
$txt['now_a_member'] = 'Поздравляем! Теперь Вы пользователь форума.';
// Use numeric entities in the below string.
$txt['your_password'] = 'и Ваш пароль';
$txt['valid_email_needed'] = 'Пожалуйста, введите действительный email адрес, %1$s.';
$txt['required_info'] = 'Необходимая информация';
$txt['identification_by_smf'] = 'Используется только для идентификации форумом.';
$txt['additional_information'] = 'Дополнительная информация';
$txt['warning'] = 'Внимание!';
$txt['only_members_can_access'] = 'Только зарегистрированные пользователи имеют доступ в этот раздел.';
$txt['login_below'] = 'Пожалуйста, войдите или';
$txt['register_an_account'] = 'зарегистрируйтесь';
$txt['login_with_forum'] = 'на %1$s.';
// Use numeric entities in the below two strings.
$txt['may_change_in_profile'] = 'Вы можете изменить это после того как войдете в настройки Вашего профиля, или посетите эту страницу после входа:';
$txt['your_username_is'] = 'Имя пользователя: ';

$txt['login_hash_error'] = 'Политика паролей была изменена. Пожалуйста, смените Ваш пароль.';

$txt['ban_register_prohibited'] = 'Извините, Вам запрещено регистрироваться на этом форуме.';
$txt['under_age_registration_prohibited'] = 'Извините, но пользователям, не достигшим %1$s лет не разрешено регистрироваться на этом форуме.';

$txt['activate_account'] = 'Активация учетной записи';
$txt['activate_success'] = 'Ваша учетная запись удачно активирована. Вы можете войти на форум.';
$txt['activate_not_completed1'] = 'Ваш email адрес должен быть проверен, прежде чем Вы сможете войти.';
$txt['activate_not_completed2'] = 'Отправить повторно письмо для активации?';
$txt['activate_after_registration'] = 'Большое спасибо за регистрацию. Через несколько минут Вы получите письмо с ссылкой для активации Вашей учетной записи.';
$txt['invalid_userid'] = 'Пользователь не существует';
$txt['invalid_activation_code'] = 'Неправильный код активации';
$txt['invalid_activation_username'] = 'Имя пользователя или email';
$txt['invalid_activation_new'] = 'Если Вы зарегистрировались и указали неправильный email адрес, напишите новый и укажите Ваш пароль.';
$txt['invalid_activation_new_email'] = 'Новый email адрес';
$txt['invalid_activation_password'] = 'Старый пароль';
$txt['invalid_activation_resend'] = 'Отправить повторно код активации';
$txt['invalid_activation_known'] = 'Если Вы знаете Ваш код активации, пожалуйста, наберите его здесь.';
$txt['invalid_activation_retry'] = 'Код активации';
$txt['invalid_activation_submit'] = 'Активировать';

$txt['coppa_no_concent'] = 'Администратор еще не получил согласия на Вашу регистрацию от родителей/опекуна.';
$txt['coppa_need_more_details'] = 'Нужны подробные детали?';

$txt['awaiting_delete_account'] = 'Ваша учетная запись была отмечена на удаление!<br />Если Вы хотите восстановить Вашу учетную запись, пожалуйста, реактивируйте Вашу учетную запись отметив &quot;Активировать мою учетную запись&quot; и войдите снова.';
$txt['undelete_account'] = 'Активировать мою учетную запись';

// Use numeric entities in the below three strings.
$txt['change_password'] = 'Информация о новом пароле';
$txt['change_password_login'] = 'Информация для входа на';
$txt['change_password_new'] = 'был изменен и пароль сброшен. Ниже приведена информация для входа.';

$txt['in_maintain_mode'] = 'Форум находится на Техническом Обслуживании.';

// These two are used as a javascript alert; please use international characters directly, not as entities.
$txt['register_agree'] = 'Пожалуйста, прочитайте соглашение прежде, чем Вы зарегистрируетесь.';
$txt['register_passwords_differ_js'] = 'Пароли не совпадают!';

$txt['approval_after_registration'] = 'Большое спасибо за регистрацию. Администратор должен подтвердить Вашу регистрацию, прежде чем Вы сможете использовать Вашу учетную запись. После подтверждения Вы получите письмо от Администратора.';

$txt['admin_settings_desc'] = 'Здесь Вы можете изменить настройки, связанные с регистрацией новых пользователей.';

$txt['setting_enableOpenID'] = 'Разрешить пользователям использовать OpenID для регистрации';

$txt['setting_registration_method'] = 'Метод регистрации для новых пользователей';
$txt['setting_registration_disabled'] = 'Регистрация запрещена';
$txt['setting_registration_standard'] = 'Мгновенная регистрация';
$txt['setting_registration_activate'] = 'Активация по e-mail';
$txt['setting_registration_approval'] = 'Одобрение пользователя';
$txt['setting_notify_new_registration'] = 'Уведомлять Администратора при регистрации новых пользователей';
$txt['setting_send_welcomeEmail'] = 'Отправлять приветствие новым пользователям';

$txt['setting_coppaAge'] = 'Минимальный возраст пользователя для успешной регистрации';
$txt['setting_coppaAge_desc'] = '(0 - без ограничения)';
$txt['setting_coppaType'] = 'Действия, выполняемые при регистрации пользователя моложе указанного возраста';
$txt['setting_coppaType_reject'] = 'Отменить регистрацию';
$txt['setting_coppaType_approval'] = 'Запросить подтверждение у родителей/опекуна';
$txt['setting_coppaPost'] = 'Email адрес, на который должно быть прислано одобрение о разрешении регистрации';
$txt['setting_coppaPost_desc'] = 'Только предупредить, если пользователь моложе установленного возраста';
$txt['setting_coppaFax'] = 'Номер факса, на который должно быть прислано одобрение о разрешении регистрации';
$txt['setting_coppaPhone'] = 'Ваш контактный номер для связи с родителями';

$txt['admin_register'] = 'Регистрация нового пользователя';
$txt['admin_register_desc'] = 'Здесь Вы можете зарегистрировать новых пользователей. Рекомендуется отправить детали пользователей на их email.';
$txt['admin_register_username'] = 'Имя пользователя';
$txt['admin_register_email'] = 'Email адрес';
$txt['admin_register_password'] = 'Пароль';
$txt['admin_register_username_desc'] = 'Имя нового пользователя';
$txt['admin_register_email_desc'] = 'Email адрес пользователя';
$txt['admin_register_password_desc'] = 'Пароль нового пользователя';
$txt['admin_register_email_detail'] = 'Отправить новый пароль пользователю';
$txt['admin_register_email_detail_desc'] = 'Требуется верный email адрес';
$txt['admin_register_email_activate'] = 'Требовать активации учетной записи';
$txt['admin_register_group'] = 'Основная группа пользователя';
$txt['admin_register_group_desc'] = 'Основная группа, к которой будет принадлежать новый пользователь';
$txt['admin_register_group_none'] = '(нет основной группы)';
$txt['admin_register_done'] = 'Пользователь %1$s удачно зарегистрирован!';

$txt['coppa_title'] = 'Форум с ограничением по возрасту';
$txt['coppa_after_registration'] = 'Большое спасибо за регистрацию на форуме ' . $context['forum_name_html_safe'] . '.<br /><br />Поскольку Вы младше  {MINIMUM_AGE} лет, мы должны получить от Вашего родителя или опекуна разрешение, прежде чем Вы сможете использовать Вашу учетную запись. Чтобы активировать учетную запись, пожалуйста, распечатайте эту форму:';
$txt['coppa_form_link_popup'] = 'Открыть форму в новом окне';
$txt['coppa_form_link_download'] = 'Загрузить форму как текстовый файл';
$txt['coppa_send_to_one_option'] = 'Попросите родителей/опекунов заполнить форму:';
$txt['coppa_send_to_two_options'] = 'Попросите родителей/опекунов отправить заполненную форму на email или факс, указанные ниже:';
$txt['coppa_send_by_post'] = 'Отправить по следующему адресу:';
$txt['coppa_send_by_fax'] = 'Отправить факс по следующему номеру:';
$txt['coppa_send_by_phone'] = 'Альтернатива, пускай родители позвонят Администратору форума по телефону {PHONE_NUMBER}.';

$txt['coppa_form_title'] = 'Форма одобрения для регистрации на ' . $context['forum_name_html_safe'];
$txt['coppa_form_address'] = 'Адрес';
$txt['coppa_form_date'] = 'Дата';
$txt['coppa_form_body'] = 'Я {PARENT_NAME},<br /><br /> разрешаю  {CHILD_NAME} (имя ребенка) зарегистрироваться на форуме: ' . $context['forum_name_html_safe'] . ', с именем пользователя: {USER_NAME}.<br /><br />Я понимаю, что введенная личная информация {USER_NAME} может быть показана другим пользователям форума.<br /><br />Подпись:<br />{PARENT_NAME} (Родитель/Опекун).';

$txt['visual_verification_sound_again'] = 'Проиграть снова';
$txt['visual_verification_sound_close'] = 'Закрыть окно';
$txt['visual_verification_sound_direct'] = 'Проблемы с прослушиванием? Попробуйте прямую ссылку для прослушивания';

// Use numeric entities in the below.
$txt['registration_username_available'] = 'Имя пользователя доступно';
$txt['registration_username_unavailable'] = 'Имя пользователя не доступно';
$txt['registration_username_check'] = 'Проверить доступность имени пользователя';
$txt['registration_password_short'] = 'Пароль слишком короткий';
$txt['registration_password_reserved'] = 'Ваш пароль содержит имя пользователя/email';
$txt['registration_password_numbercase'] = 'Пароль должен содержать большие и маленькие буквы, а также цифры';
$txt['registration_password_no_match'] = 'Пароли не совпадают';
$txt['registration_password_valid'] = 'Пароль правильный';

$txt['registration_errors_occurred'] = 'Следующие ошибки были обнаружены при регистрации. Пожалуйста исправьте их:';

$txt['authenticate_label'] = 'Способо авторизации';
$txt['authenticate_password'] = 'Пароль';
$txt['authenticate_openid'] = 'OpenID';
$txt['authenticate_openid_url'] = 'Адрес авторизации OpenID';

?>