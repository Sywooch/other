<?php
#
# ��������� ������
#



$mod_name = 'shop';
$mod_title = "�������";







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





$SQL[] = "CREATE TABLE `se_{$mod_name}` (
  `id` int(11) NOT NULL auto_increment,
  `status` tinyint(1) NOT NULL default '0',
  `rectime` int(11) default NULL,
  `total` decimal(10,2) NOT NULL default '0.00',
  `goods` text NOT NULL,
  `hesh` varchar(32) default NULL,
  `user` text NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;";


$SQL[] = "CREATE TABLE `se_{$mod_name}_attend` (
  `good_id1` int(11) default NULL,
  `good_id2` int(11) default NULL,
  `count` int(11) default NULL
)";





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


$SQL['settings']['sett'][] = array( 'config_title'       => '�������� ������-��������',
                                      'config_description' => '� ���������� ������ ����� ���������� ������� ��� ���������� ������. ���� �� �������, �� ������� ��������� ���������!',
                                      'config_group_title' => '',
                                      'config_type'        => 'input',
                                      'config_key'         => $mod_name.'_modrecipient',
                                      'config_value'       => 'catalog',
                                      'config_default'     => 'catalog',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 1,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );





// �������� �������� � ������� ����������� �������
$SQL['menuname'] = "";

// ��������� ������������ ������������
$SQL['menurebuild'] = 0;

# ���������� �������, ������� ���������� ������� ��� �������� ������
# ���������� ��� ��������� � ����� �������
# ������� � ��������� ������ ��������� �������������
$del_tables =  array("se_".$mod_name."_attend");

?>