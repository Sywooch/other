<?php
#
# ��������� ������
#



$mod_name = 'feedback';
$mod_title = "����� �������� �����";



/* ������� ���������� � ������ � ������� ������� */
$SQL[] = "INSERT INTO `se_modules` VALUES ('".$mod_name."', 1, '".$mod_title."', 1, 0, 0, '', 0, 1000);";



$SQL['settings']['group'] = array( 'config_title'       => '',
                                   'config_description' => '�����, ������ � ��������� ������',
                                   'config_group_title' => $mod_title,
                                   'config_group'       => $mod_title,
                                   'config_type'        => '',
                                   'config_key'         => '',
                                   'config_value'       => '',
                                   'config_default'     => '',
                                   'config_extra'       => '',
                                   'config_evalphp'     => '',
                                   'config_protected'   => 1,
                                   'config_position'    => 0,
                                   'config_start_group' => '',
                                   'config_end_group'   => 0, );


$SQL['settings']['sett'][] = array( 'config_title'       => '����������� ����� ����������',
                                      'config_description' => '���� �����, �� ����� ����� ���� �� "������� �������� �����".',
                                      'config_group_title' => '',
                                      'config_type'        => 'input',
                                      'config_key'         => $mod_name.'_email',
                                      'config_value'       => '',
                                      'config_default'     => '',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 1,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );


$SQL['settings']['sett'][] = array( 'config_title'       => '��������� ������',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      'config_type'        => 'input',
                                      'config_key'         => $mod_name.'_title',
                                      'config_value'       => '',
                                      'config_default'     => '��������� ����� ����� �������� �����',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 2,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );

$SQL['settings']['sett'][] = array( 'config_title'       => '������ ������������� ���������',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      'config_type'        => 'editor',
                                      'config_key'         => $mod_name.'_template',
                                      'config_value'       => '',
                                      'config_default'     => '<p>��������� ���� ������������ <b>{date}</b></p>
<p>&nbsp;</p>
<p>���: {name}<br />
E-mail: {email}</p>
<p>����� ���������:<br />
{text}</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>--<br />
� ���������, <a href="http://{host}">{host}</a></p>',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 3,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );




// �������� �������� � ������� ����������� �������
$SQL['menuname'] = $mod_title;

// ��������� ������������ ������������
$SQL['menurebuild'] = 0;

# ���������� �������, ������� ���������� ������� ��� �������� ������
# ���������� ��� ��������� � ����� �������
# ������� � ��������� ������ ��������� �������������
$del_tables =  array();

?>