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
		res += '�� ��������� ���� "���"<br>';
	}
	
//	if ($("#fname").val() == '')
//	{
//		res += '�� ��������� ���� "���"<br>';
//	}
	if ($("#email").val() == '')
	{
		res += '�� ��������� ���� "����� E-mail"<br>';
	}
	if ($("#phone").val() == '')
	{
		res += '�� ��������� ���� "�������"<br>';
	}
//	if ($("#pasport").val() == '')
//	{
//		res += '�� ��������� ���� "���������� ������"<br>';
//	}
//	if ($("#adress").val() == '')
//	{
//		res += '�� ��������� ���� "�����"<br>';
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
		res += '�� ��������� ���� "���������� ���� (���)"<br>';
	}
	
	if ($("#email").val() == '')
	{
		res += '�� ��������� ���� "����� E-mail"<br>';
	}
	if ($("#phone").val() == '')
	{
		res += '�� ��������� ���� "�������"<br>';
	}
	if ($("#company").val() == '')
	{
		res += '�� ��������� ���� "��������"<br>';
	}
//	if ($("#uradress").val() == '')
//	{
//		res += '�� ��������� ���� "����������� �����"<br>';
//	}
//
//	if ($("#inn").val() == '')
//	{
//		res += '�� ��������� ���� "���"<br>';
//	}
//	if ($("#kpp").val() == '')
//	{
//		res += '�� ��������� ���� "���"<br>';
//	}
//	if ($("#bank").val() == '')
//	{
//		res += '�� ��������� ���� "����"<br>';
//	}
//	if ($("#bik").val() == '')
//	{
//		res += '�� ��������� ���� "���"<br>';
//	}
//	if ($("#rschet").val() == '')
//	{
//		res += '�� ��������� ���� "�/�"<br>';
//	}
//	if ($("#cschet").val() == '')
//	{
//		res += '�� ��������� ���� "����/����"<br>';
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

