<?php
#
#        ������������� ��������� ���������� ��� ������ ����������� �������
#
#  Modified         :
#  Version          : 1.0
#  Programmer                : Kormishin Vladimir
#


// ������
$_comeback_email["form"] = "admin@mail.ru";
$_comeback_email_from_name = "company";
$_comeback_email_from_mail = 'info@mail.ru';


// ������


// ���������
$_comeback_mailbody["form"] = <<<EOF
C�������� �� ����� �������� �����.

��� � �������:	{name}

Email:		{mail}

������: 		{your_q}


EOF;

// ��������� ��� ������
$_comeback_error['name'] = <<<EOF
�� �� �������� ���� ����� � �������
EOF;

$_comeback_error['mail'] = <<<EOF
�� �� �������� ���� Email
EOF;

$_comeback_error['your_q'] = <<<EOF
������� ������
EOF;


// ����� �������� ��� ������ ������
$_comeback_error['error'] = <<<EOF

<span style='color:red;'><li> {ERROR} </span>

EOF;

?>