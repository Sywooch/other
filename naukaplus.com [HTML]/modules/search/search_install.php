<?php
#
#  ������������� ������
#



$mod_name = 'search';
$mod_title = "����� �� �����";



/* ������� ���������� � ������ � ������� ������� */
$SQL[] = "INSERT INTO `se_modules` VALUES (
	'".$mod_name."', 	/* �������� ������ */
	1, 			/* ���������� ������ */
	'".$mod_title."', 	/* �������� ������ � �������� */
	0, 			/* ������������ ��������� ������ ��� ������������ ���� */
	0, 			/* ������� ����� ��� ����� � ������� */
	0, 			/* ������ �������� ������ ���� */
	'', 			/* ���������� ��� �������� � ������� (���������� ��� ������� ����) */
	0, 			/* ��������� ����� �� �������� ������ */
	1000			/* ������� � ������ ������� (������ � ����� ������) */
);";



$SQL['settings']['group'] = array( 'config_title'       => '',
                                   'config_description' => '',
                                   'config_group_title' => $mod_title,
                                   'config_group'       => '',
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


$SQL['settings']['sett'][] = array( 'config_title'       => '���������� �������� � ������ ��������� �������',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      //'config_group'       => '',
                                      'config_type'        => 'input',
                                      'config_key'         => 'search_leave_out',
                                      'config_value'       => '',
                                      'config_default'     => '5',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 1,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );

$SQL['settings']['sett'][] = array( 'config_title'       => '���������� ������� ����������� ������ �� ��������',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      //'config_group'       => '',
                                      'config_type'        => 'input',
                                      'config_key'         => 'search_count_on_page',
                                      'config_value'       => '',
                                      'config_default'     => '15',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 2,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );

$SQL['settings']['sett'][] = array( 'config_title'       => '���������� ������� ���������� � ������ �� ������ ��������',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      //'config_group'       => '',
                                      'config_type'        => 'input',
                                      'config_key'         => 'search_cut_count',
                                      'config_value'       => '',
                                      'config_default'     => '100',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 3,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );

// �������� �������� � ������� ����������� �������
$SQL['menuname'] = '';

// ��������� ������������ ������������
$SQL['menurebuild'] = 0;

# ���������� �������, ������� ���������� ������� ��� �������� ������
# ���������� ��� ��������� � ����� �������
# ������� � ��������� ������ ��������� �������������
$del_tables =  array();


?>