<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();

//EVENT_TYPE RU
$MESS['ET_EVENT_NAME']      = 'FEEDBACK_FORM';
$MESS['RU_ET_NAME'] = 'Отправка сообщения через форму обратной связи';
$MESS['RU_ET_DESCRIPTION'] = '#AUTHOR_FIO# 			ФИО
#AUTHOR_NAME# 			Ваше Имя
#AUTHOR_LAST_NAME# 		Фамилия
#AUTHOR_SECOND_NAME# 	Отчество
#AUTHOR_EMAIL# 			E-mail
#AUTHOR_PERSONAL_MOBILE# Контактный телефон
#AUTHOR_WORK_COMPANY# 	Компания
#AUTHOR_POSITION# 		Должность
#AUTHOR_PROFESSION# 	Профессия
#AUTHOR_STATE# 			Область, район
#AUTHOR_CITY# 			Город
#AUTHOR_STREET# 		Улица
#AUTHOR_ADRESS# 		Адрес
#AUTHOR_PERSONAL_PHONE# Домашний телефон
#AUTHOR_WORK_PHONE# 	Рабочий телефон
#AUTHOR_FAX# 			Факс
#AUTHOR_MAILBOX# 		Почтовый ящик
#AUTHOR_WORK_MAILBOX# 	Рабочий почтовый ящик
#AUTHOR_SKYPE# 			Скайп
#AUTHOR_ICQ# 			Номер ICQ
#AUTHOR_WWW# 			Персональный сайт
#AUTHOR_WORK#_WWW 		Рабочий сайт
#AUTHOR_MESSAGE# 		Сообщение
#AUTHOR_NOTES# 			Заметки
#CUSTOM_FIELD_0#        Настраиваемое поле № 0
#CUSTOM_FIELD_1#        Настраиваемое поле № 1 и т.д.
#BRANCH_NAME#           Офис(филиал)
#FILES#                 Файлы
#PAGE_URL#              URL страницы
#PAGE_TITLE#            Заголовок страницы
#FORM_TITLE#            Заголовок формы
#HTTP_HOST#             Имя хоста/домена
#EMAIL_TO#              E-mail получателя письма
#EMAIL_FROM#            E-mail администратора из настроек главного модуля (не изменяется)
#DEFAULT_EMAIL_FROM#    E-mail адрес администратора(задается в настройках главного модуля) или посетителя(замена включается в настройках компонента)';


//EVENT_MESSAGE ADMIN
$MESS['EM_EMAIL_FROM']       = '#DEFAULT_EMAIL_FROM#';
$MESS['EM_EMAIL_TO']         = '#EMAIL_TO#';
$MESS['EM_SUBJECT_ADMIN']    = '#SITE_NAME#: Сообщение из расширенной формы обратной связи';
$MESS['EM_MESSAGE']          = 'Информационное сообщение сайта #SITE_NAME#
------------------------------------------

Вам было отправлено сообщение через форму обратной связи

Ниже перечислены все #МАКРОСЫ# обрабатываемые в данном модуле.
Все #МАКРОСЫ# соответствуют полям формы обратной связи и только для данного модуля "Расширенная форма обратной связи"

ФИО: #AUTHOR_FIO#
Ваше Имя: #AUTHOR_NAME#
Фамилия: #AUTHOR_LAST_NAME#
Отчество: #AUTHOR_SECOND_NAME#
E-mail: #AUTHOR_EMAIL#
Контактный телефон: #AUTHOR_PERSONAL_MOBILE#
Компания: #AUTHOR_WORK_COMPANY#
Должность: #AUTHOR_POSITION#
Профессия: #AUTHOR_PROFESSION#
Область, район: #AUTHOR_STATE#
Город: #AUTHOR_CITY#
Улица: #AUTHOR_STREET#
Адрес: #AUTHOR_ADRESS#
Домашний телефон: #AUTHOR_PERSONAL_PHONE#
Рабочий телефон: #AUTHOR_WORK_PHONE#
Факс: #AUTHOR_FAX#
Почтовый ящик: #AUTHOR_MAILBOX#
Рабочий почтовый ящик: #AUTHOR_WORK_MAILBOX#
Скайп: #AUTHOR_SKYPE#
Номер ICQ: #AUTHOR_ICQ#
Персональный сайт:#AUTHOR_WWW#
Рабочий сайт: #AUTHOR_WORK_WWW#
Тема сообщения: #AUTHOR_MESSAGE_THEME#
Сообщение: #AUTHOR_MESSAGE#
Заметки: #AUTHOR_NOTES#
E-mail администратора: #EMAIL_FROM#

Флажки: #CUSTOM_FIELD_0#
Переключатели: #CUSTOM_FIELD_1#
Текстовое поле: #CUSTOM_FIELD_2#
Дата: #CUSTOM_FIELD_3#
Интервал дат: #CUSTOM_FIELD_4#
Список опций: #CUSTOM_FIELD_5#
Группа опций: #CUSTOM_FIELD_6#
Текстовое поле: #CUSTOM_FIELD_7#

Офис(филиал): #BRANCH_NAME#


URL страницы:       #PAGE_URL#
Заголовок страницы: #PAGE_TITLE#
Заголовок формы:    #FORM_TITLE#
Имя хоста/домена:   #HTTP_HOST#


Файлы:
#FILES#


Сообщение сгенерировано автоматически.';

//EVENT_MESSAGE USER
$MESS['EM_SUBJECT_USER']    = '#SITE_NAME#: Копия сообщения из расширенной формы обратной связи';