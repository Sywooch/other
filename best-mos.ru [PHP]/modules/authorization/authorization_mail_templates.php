<?php
#
#  ������������� ������ SiteMapClass
#
#  Modified         :
#  Version          : 1.0
#  Author           : Alexander Kirillin
#  Programmer                : Kormishin Vladimir
#  Copyright        : (c) ����������� �����������
#

$mail_auth_template['subject_1'] = "����������� �� {$host}";

$mail_auth_template['body_1'] = <<<EOF

������������!
�� ����� ������������� ����� �������.

���� ��������������� ������:

�����: {LOGIN}
������: {PASS}
E-mail: {MAIL}

--
� ���������, ����������� �����������
http://{$host}/

EOF;

$mail_auth_template['subject_2'] = "��� ������ �� {$host}";

$mail_auth_template['body_2'] = <<<EOF

������������!
�� ������ ������� �������� ���� ������ � ����� �������.

�����:  {LOGIN}
������: {PASS}

--
� ���������, ����������� �����������
http://{$host}/

EOF;


$mail_auth_template['subject_6'] = "������������� ����������� �� ����� {$host}";

$mail_auth_template['body_6'] = <<<EOF

����������, ����������� ����������� ����������� �����������.
��� ����� �������� �� ��������������� ������:
http://{$host}/authorization/approve/{REGKEY}/

���� ��� ��������� ������ � ��� �� ������ ��� ��
�� ������ ������������ ����������� - ������ ������� ���.

--
� ���������, ����������� �����������
http://{$host}/

EOF;


?>