/*
 * Translated default messages for the jQuery validation plugin.
 * Locale: RU (Russian; русский язык)
 */
$.extend($.validator.messages, {
	required: "<span>Заполнение обязательно!</span>",
	remote: "<span>Пожалуйста, введите правильное значение.</span>",
	email: "<span>Введите корректный адрес почты.</span>",
	url: "<span>Пожалуйста, введите корректный URL.</span>",
	date: "<span>Пожалуйста, введите корректную дату.</span>",
	dateISO: "<span>Пожалуйста, введите корректную дату в формате ISO.</span>",
	phoneNL: "<span>Введите корректный телефон.</span>",
	number: "<span>Пожалуйста, введите число.</span>",
	digits: "<span>Пожалуйста, вводите только цифры.</span>",
	creditcard: "Пожалуйста, введите правильный номер кредитной карты.",
	equalTo: "<span>Пожалуйста, введите такое же значение ещё раз.</span>",
	extension: "<span>Пожалуйста, выберите файл с правильным расширением.</span>",
	maxlength: $.validator.format("Пожалуйста, введите не больше {0} символов."),
	minlength: $.validator.format("Пожалуйста, введите не меньше {0} символов."),
	rangelength: $.validator.format("Пожалуйста, введите значение длиной от {0} до {1} символов."),
	range: $.validator.format("Пожалуйста, введите число от {0} до {1}."),
	max: $.validator.format("Пожалуйста, введите число, меньшее или равное {0}."),
	min: $.validator.format("Пожалуйста, введите число, большее или равное {0}.")
});
