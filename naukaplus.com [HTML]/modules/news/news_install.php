<?php
#
# ��������� ������
#



$mod_name = 'news';
$mod_title = "�������";







/* ������� ���������� � ������ � ������� ������� */
$SQL[] = "INSERT INTO `se_modules` VALUES (
	'".$mod_name."', 	/* �������� ������ */
	1, 			/* ���������� ������ */
	'".$mod_title."', 	/* �������� ������ � �������� */
	1, 			/* ������������ ��������� ������ ��� ������������ ���� */
	0, 			/* ������� ����� ��� ����� � ������� */
	0, 			/* ������ �������� ������ ���� */
	'', 			/* ���������� ��� �������� � ������� (���������� ��� ������� ����) */
	1, 			/* ��������� ����� �� �������� ������ */
	1000			/* ������� � ������ ������� (������ � ����� ������) */
);";



/* �������� ������� */
$SQL[] = "CREATE TABLE `se_".$mod_name."` (
  `id` int(11) NOT NULL auto_increment,
  `pid` int(11) NOT NULL default '0',
  `is_active` smallint(1) NOT NULL default '0',
  `is_best` tinyint(1) default '0',
  `is_sheet` tinyint(1) default '1',
  `is_redirect` tinyint(1) NOT NULL default '0',
  `timestamp` int(11) default NULL,
  `lastmodified` int(11) default NULL,
  `alias` varchar(60) NOT NULL default '',
  `title` varchar(255) NOT NULL default '',
  `h1` varchar(255) default NULL,
  `menu` varchar(255) NOT NULL default '',
  `sbody` text,
  `body` longtext NOT NULL,
  `author` varchar(255) NOT NULL default '',
  `description` varchar(255) default NULL,
  `keywords` varchar(255) default NULL,
  `template` varchar(255) NOT NULL default '',
  `owner` varchar(255) NOT NULL default '',  
  `item_order` int(3) NOT NULL default '0',
  `img` varchar(255) NOT NULL default '',  
  `price` decimal(10,2) default '0',  
  `item_count` int(11) default '0',
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`),
  KEY `is_active` (`is_active`),
  KEY `is_best` (`is_best`),
  KEY `is_sheet` (`is_sheet`)
) ENGINE=MyISAM;";








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



$SQL['settings']['sett'][] = array( 'config_title'       => '��� ��������',
                                      'config_description' => '���������� ���������� ������',
                                      'config_group_title' => '',
                                      'config_type'        => 'dropdown',
                                      'config_key'         => $mod_name.'_type',
                                      'config_value'       => '',
                                      'config_default'     => '0',
                                      'config_extra'       => '0=��� ���� � ����������
1=� ����, �� ��� ����
2=� ����������� � �����',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 0,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );



$SQL['settings']['sett'][] = array( 'config_title'       => '������������ �����������',
                                      'config_description' => '���� ��, �� � ����� ����������� ������ ������, � �������� /cache/ �������� HTML ������������� ��������� ������� ������',
                                      'config_group_title' => '',
                                      'config_type'        => 'yes_no',
                                      'config_key'         => $mod_name.'_cache',
                                      'config_value'       => '',
                                      'config_default'     => '1',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 1,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );



$SQL['settings']['sett'][] = array( 'config_title'       => '���������� ������� �� �������� ������',
                                      'config_description' => '������������ ���������� ������� ��� ������ ���������������� �����. ���� ������� ������, ���������� ������������ �����',
                                      'config_group_title' => '',
                                      'config_type'        => 'input',
                                      'config_key'         => $mod_name.'_count_onpage',
                                      'config_value'       => '',
                                      'config_default'     => '15',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 2,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );


$SQL['settings']['sett'][] = array( 'config_title'       => '���������� ������� � ��������',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      'config_type'        => 'dropdown',
                                      'config_key'         => $mod_name.'_levels',
                                      'config_value'       => '',
                                      'config_default'     => '1',
                                      'config_extra'       => '0=����������� ��� (������� �������)
1=���� ������� � �������� (�������, �������, ������)
2=��� ������ (������� �������)',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 3,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );


$SQL['settings']['sett'][] = array( 'config_title'       => '������ ������������ �������',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      'config_type'        => 'dropdown',
                                      'config_key'         => $mod_name.'_typeadd',
                                      'config_value'       => '',
                                      'config_default'     => '1',
                                      'config_extra'       => '0=��������� ������ � ����� ������ (�������)
1=��������� ������ � ������ ������ (�������)',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 4,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );



$SQL['settings']['sett'][] = array( 'config_title'       => '��������� ����������� ������ - ��� ��������?',
                                      'config_description' => '���������� ��������� ������� �������������� ���������� SQL ��������',
                                      'config_group_title' => '',
                                      'config_type'        => 'dropdown',
                                      'config_key'         => $mod_name.'_last_type',
                                      'config_value'       => '',
                                      'config_default'     => '2',
                                      'config_extra'       => '0=�� �������� �����
1=�������� �� ���� ��������� �����
2=�������� ������ �� ������� �������� �����
3=�������� ������ �� ������� �������� ������
4=�������� �� ��������� ������',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 5,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );	

$SQL['settings']['sett'][] = array( 'config_title'       => '��������� ����������� ������ - ������� ��������?',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      'config_type'        => 'input',
                                      'config_key'         => $mod_name.'_last_count',
                                      'config_value'       => '',
                                      'config_default'     => '3',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 6,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );




$SQL['settings']['sett'][] = array( 'config_title'       => '������ ������ - ��� ��������?',
                                      'config_description' => '���������� ��������� ������� �������������� ���������� SQL ��������',
                                      'config_group_title' => '',
                                      'config_type'        => 'dropdown',
                                      'config_key'         => $mod_name.'_best_type',
                                      'config_value'       => '',
                                      'config_default'     => '0',
                                      'config_extra'       => '0=�� �������� �����
1=�������� �� ���� ��������� �����
2=�������� ������ �� ������� �������� �����
3=�������� ������ �� ������� �������� ������
4=�������� ������ �� ���� ��������� ������',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 7,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );

$SQL['settings']['sett'][] = array( 'config_title'       => '������ ������ - ������� ��������?',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      'config_type'        => 'input',
                                      'config_key'         => $mod_name.'_best_count',
                                      'config_value'       => '',
                                      'config_default'     => '3',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 8,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );





$SQL['settings']['sett'][] = array( 'config_title'       => '������� �������� �����������',
                                      'config_description' => '������ ���������� ���� ����������� ����������� �������� ������� ����. �� ��� �� ������ ����������, ������� ����� ���������.',
                                      'config_group_title' => '',
                                      'config_type'        => 'yes_no',
                                      'config_key'         => $mod_name.'_save_imgsource',
                                      'config_value'       => '',
                                      'config_default'     => '1',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 9,
                                      'config_start_group' => ' ',
                                      'config_end_group'   => 0, );

$SQL['settings']['sett'][] = array( 'config_title'       => '������� ���� - ��� �������',
                                      'config_description' => '������� ���� ��� ����������� �� �������� ������',
                                      'config_group_title' => '',
                                      'config_type'        => 'dropdown',
                                      'config_key'         => $mod_name.'_img_typeresize',
                                      'config_value'       => '',
                                      'config_default'     => '2',
                                      'config_extra'       => '1=������ �� ������� �������
2=������ �� ������
3=������ �� ������
4=���������� � ��������
0=�� ���������',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 10,
                                      'config_start_group' => ' ',
                                      'config_end_group'   => 0, );

$SQL['settings']['sett'][] = array( 'config_title'       => '������� ���� - ������ ��������� �������',
                                      'config_description' => '��������� ����� � ��������',
                                      'config_group_title' => '',
                                      'config_type'        => 'input',
                                      'config_key'         => $mod_name.'_img_size',
                                      'config_value'       => '',
                                      'config_default'     => '500',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 11,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );


$SQL['settings']['sett'][] = array( 'config_title'       => '������� ���� - ����������� ��������',
                                      'config_description' => '100 - ������ ��������, 0 - ������',
                                      'config_group_title' => '',
                                      'config_type'        => 'input',
                                      'config_key'         => $mod_name.'_img_quality',
                                      'config_value'       => '',
                                      'config_default'     => '90',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 12,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );

$SQL['settings']['sett'][] = array( 'config_title'       => '������ - ��� �������',
                                      'config_description' => '����������� ���� ��� ������������ � ������� � � ���������',
                                      'config_group_title' => '',
                                      'config_type'        => 'dropdown',
                                      'config_key'         => $mod_name.'_th_typeresize',
                                      'config_value'       => '',
                                      'config_default'     => '4',
                                      'config_extra'       => '1=������ �� ������� �������
2=������ �� ������
3=������ �� ������
4=���������� � ��������
0=�� ���������',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 13,
                                      'config_start_group' => ' ',
                                      'config_end_group'   => 0, );

$SQL['settings']['sett'][] = array( 'config_title'       => '������ - ����� �������',
                                      'config_description' => '��������� ����� � ��������',
                                      'config_group_title' => '',
                                      'config_type'        => 'input',
                                      'config_key'         => $mod_name.'_th_size',
                                      'config_value'       => '',
                                      'config_default'     => '96',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 14,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );


$SQL['settings']['sett'][] = array( 'config_title'       => '������ - ����������� ��������',
                                      'config_description' => '100 - ������ ��������, 0 - ������',
                                      'config_group_title' => '',
                                      'config_type'        => 'input',
                                      'config_key'         => $mod_name.'_th_quality',
                                      'config_value'       => '',
                                      'config_default'     => '80',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 15,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );


$SQL['settings']['sett'][] = array( 'config_title'       => '������� ��������� - ������� ��������?',
                                      'config_description' => '���������� ������� ���������� ������������ �������. ��������� ������ ������ �� ��������� ������ � ����� �����. ������ "0", �� ��������� "������� ����������".',
                                      'config_group_title' => '',
                                      'config_type'        => 'input',
                                      'config_key'         => $mod_name.'_history',
                                      'config_value'       => '',
                                      'config_default'     => '0',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 16,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );


$SQL['settings']['sett'][] = array( 'config_title'       => '����������� ���� �� ��������� ������',
                                      'config_description' => '����������� ��� ������� ������� �������',
                                      'config_group_title' => '',
                                      'config_type'        => 'yes_no',
                                      'config_key'         => $mod_name.'_menu',
                                      'config_value'       => '',
                                      'config_default'     => '0',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 17,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );





// �������� �������� � ������� ����������� �������
$SQL['menuname'] = $mod_title;

// ��������� ������������ ������������
$SQL['menurebuild'] = 1;

# ���������� �������, ������� ���������� ������� ��� �������� ������
# ���������� ��� ��������� � ����� �������
# ������� � ��������� ������ ��������� �������������
$del_tables =  array();

?>