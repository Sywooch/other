$(document).ready(function(){
// ---- TREE -----
$("#navigation").treeview({
animated: "normal", 
unique: true
});
// ---- TREE -----
document.getElementById("ex2").style.display = ''; 

});




function verifFormFiz()
{
	var res = '';

	if ($("#lname").val() == '')
	{
		res += 'Не заполнено поле "ФИО"<br>';
	}
	
//	if ($("#fname").val() == '')
//	{
//		res += 'Не заполнено поле "Имя"<br>';
//	}
	if ($("#email").val() == '')
	{
		res += 'Не заполнено поле "Адрес E-mail"<br>';
	}
	if ($("#phone").val() == '')
	{
		res += 'Не заполнено поле "Телефон"<br>';
	}
//	if ($("#pasport").val() == '')
//	{
//		res += 'Не заполнено поле "Паспортные данные"<br>';
//	}
//	if ($("#adress").val() == '')
//	{
//		res += 'Не заполнено поле "Адрес"<br>';
//	}



	if (res != '')
	{
		$("#error").html(res);
	}
	else
	{
		$("#ffiz").submit();
	}
}



function verifFormUr()
{
	var res = '';

	if ($("#lname").val() == '')
	{
		res += 'Не заполнено поле "Контактное лицо (ФИО)"<br>';
	}
	
	if ($("#email").val() == '')
	{
		res += 'Не заполнено поле "Адрес E-mail"<br>';
	}
	if ($("#phone").val() == '')
	{
		res += 'Не заполнено поле "Телефон"<br>';
	}
	if ($("#company").val() == '')
	{
		res += 'Не заполнено поле "Компания"<br>';
	}
//	if ($("#uradress").val() == '')
//	{
//		res += 'Не заполнено поле "Юридический адрес"<br>';
//	}
//
//	if ($("#inn").val() == '')
//	{
//		res += 'Не заполнено поле "ИНН"<br>';
//	}
//	if ($("#kpp").val() == '')
//	{
//		res += 'Не заполнено поле "КПП"<br>';
//	}
//	if ($("#bank").val() == '')
//	{
//		res += 'Не заполнено поле "Банк"<br>';
//	}
//	if ($("#bik").val() == '')
//	{
//		res += 'Не заполнено поле "БИК"<br>';
//	}
//	if ($("#rschet").val() == '')
//	{
//		res += 'Не заполнено поле "Р/С"<br>';
//	}
//	if ($("#cschet").val() == '')
//	{
//		res += 'Не заполнено поле "Корр/Счет"<br>';
//	}



	if (res != '')
	{
		$("#error").html(res);
	}
	else
	{
		$("#fur").submit();
	}
}

