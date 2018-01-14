<?php
#
# ������������� ������
#
#  Modified         :
#  Version          : 1.0
#  Author           : Alexander Kirillin
#  Programmer                : Kormishin Vladimir
#  Copyright        : (c) ����������� �����������
#


/* �������� ������� */
$SQL[] = "CREATE TABLE `se_news` (
  `id` bigint(20) NOT NULL auto_increment,
  `timestamp` int(11) NOT NULL default '0',
  `lastmodified` int(11) NOT NULL default '0',
  `alias` varchar(60) NOT NULL default '',
  `title` varchar(255) NOT NULL default '',
  `sbody` text,
  `body` longtext NOT NULL,
  `author` varchar(60) default NULL,
  `description` varchar(255) default NULL,
  `keywords` varchar(255) default NULL,
  `is_active` smallint(1) NOT NULL default '0',
  `pid` int(11) NOT NULL default '0',
  `item_order` int(11) NOT NULL default '0',
  `owner` varchar(255) NOT NULL default '',
  `img` varchar(10) NOT NULL default '',
  PRIMARY KEY  (`id`)
)";

$SQL[] = "CREATE TABLE `se_news_cats` (
  `id` int(11)  auto_increment,
  `title` varchar(50) NOT NULL default '',
  `item_order` INT(3) DEFAULT '0' NOT NULL,
  `is_active` INT(1) DEFAULT '1' NOT NULL,
  `pid` TINYINT( 1 ) DEFAULT '-1' NOT NULL,
    PRIMARY KEY  (`id`)

);";
$SQL[] = "CREATE TABLE `se_news_relations_cats` (
  `id_news` int(11) NOT NULL default '0',
  `id_cats` int(11) NOT NULL default '0'

)";

$SQL[] = "INSERT INTO `se_modules` VALUES ('news', 1, '�������', 1, 0, 0, 'a:5:{i:0;s:4:\"news\";i:1;s:8:\"news_add\";i:2;s:8:\"news_del\";i:3;s:11:\"news_active\";i:4;s:8:\"news_cat\";}', 1, 1000);";


$SQL['settings']['group'] = array( 'config_title'       => '',
                                   'config_description' => '��������� ������ ��������.',
                                   'config_group_title' => '�������',
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

$SQL['settings']['sett'][] = array(   'config_title'       => '����������  �������� �� �� ��������� �������',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      //'config_group'       => '',
                                      'config_type'        => 'input',
                                      'config_key'         => 'news_on_non_news_page',
                                      'config_value'       => '',
                                      'config_default'     => '3',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 1,
                                      'config_start_group' => '��������� ������',
                                      'config_end_group'   => 0, );

$SQL['settings']['sett'][] = array(   'config_title'       => '����������  �������� �� ������� ��������� �������',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      //'config_group'       => '',
                                      'config_type'        => 'input',
                                      'config_key'         => 'news_count_on_main_page',
                                      'config_value'       => '5',
                                      'config_default'     => '5',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 2,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );

$SQL['settings']['sett'][] = array(   'config_title'       => '���������� ������� ������� ��������� ����� � ������� ���������',
                                      'config_description' => '< 6 5 4 > �������� = 1 (������� = 5)',
                                      'config_group_title' => '',
                                      //'config_group'       => '',
                                      'config_type'        => 'input',
                                      'config_key'         => 'news_count_near_select_page',
                                      'config_value'       => '',
                                      'config_default'     => '1',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 3,
                                      'config_start_group' => '',
                                      'config_end_group'   => 1, );

$SQL['settings']['sett'][] = array( 'config_title'       => '������ ������� �������� �������',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      //'config_group'       => '',
                                      'config_type'        => 'input',
                                      'config_key'         => 'news_big_width',
                                      'config_value'       => '',
                                      'config_default'     => '',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 4,
                                      'config_start_group' => 'BIG',
                                      'config_end_group'   => 0, );


$SQL['settings']['sett'][] = array( 'config_title'       => '������ ������� �������� �������',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      //'config_group'       => '',
                                      'config_type'        => 'input',
                                      'config_key'         => 'news_big_height',
                                      'config_value'       => '',
                                      'config_default'     => '',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 5,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );

$SQL['settings']['sett'][] = array( 'config_title'       => '������ ������� �������� �������',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      //'config_group'       => '',
                                      'config_type'        => 'dropdown',
                                      'config_key'         => 'news_big_resize',
                                      'config_value'       => '',
                                      'config_default'     => '0',
                                      'config_extra'       => "0=�� ������
1=������ W ���������������
2=������ H ���������������
3=�����������������",
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 6,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );

$SQL['settings']['sett'][] = array( 'config_title'       => '�����',
                                      'config_description' => '������������ ������ � ��� ������ ���� ������ ������������������ ������',
                                      'config_group_title' => '',
                                      //'config_group'       => '',
                                      'config_type'        => 'dropdown',
                                      'config_key'         => 'news_big_method',
                                      'config_value'       => '',
                                      'config_default'     => '1',
                                      'config_extra'       => "1=���������� �������� � �������� ������� �� ������������ �������
2=������ �� ������� �������, ���������� � ������ ���������� ������� �������
3=������ �� ������� �������, ���������� � ������ ���� ���������� ������� �������",
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 7,
                                      'config_start_group' => '',
                                      'config_end_group'   => 1, );

$SQL['settings']['sett'][] = array( 'config_title'       => '������ �������� �������� �������',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      //'config_group'       => '',
                                      'config_type'        => 'input',
                                      'config_key'         => 'news_th_width',
                                      'config_value'       => '',
                                      'config_default'     => '320',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 8,
                                      'config_start_group' => 'IMG',
                                      'config_end_group'   => 0, );

$SQL['settings']['sett'][] = array( 'config_title'       => '������ �������� �������� �������',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      //'config_group'       => '',
                                      'config_type'        => 'input',
                                      'config_key'         => 'news_th_height',
                                      'config_value'       => '',
                                      'config_default'     => '240',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 9,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );

$SQL['settings']['sett'][] = array( 'config_title'       => '������ �������� �������',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      //'config_group'       => '',
                                      'config_type'        => 'dropdown',
                                      'config_key'         => 'news_th_resize',
                                      'config_value'       => '',
                                      'config_default'     => '0',
                                      'config_extra'       => "0=�� ������
1=������ W ���������������
2=������ H ���������������
3=�����������������",
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 10,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );

$SQL['settings']['sett'][] = array( 'config_title'       => '�����',
                                      'config_description' => '������������ ������ � ��� ������ ���� ������ ������������������ ������',
                                      'config_group_title' => '',
                                      //'config_group'       => '',
                                      'config_type'        => 'dropdown',
                                      'config_key'         => 'news_th_method',
                                      'config_value'       => '',
                                      'config_default'     => '1',
                                      'config_extra'       => "1=���������� �������� � �������� ������� �� ������������ �������
2=������ �� ������� �������, ���������� � ������ ���������� ������� �������
3=������ �� ������� �������, ���������� � ������ ���� ���������� ������� �������",
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 11,
                                      'config_start_group' => '',
                                      'config_end_group'   => 1, );

$SQL['settings']['sett'][] = array( 'config_title'       => '������ ������� �������',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      //'config_group'       => '',
                                      'config_type'        => 'input',
                                      'config_key'         => 'news_av_width',
                                      'config_value'       => '',
                                      'config_default'     => '120',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 12,
                                      'config_start_group' => 'AV',
                                      'config_end_group'   => 0, );

$SQL['settings']['sett'][] = array( 'config_title'       => '������ ������� �������',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      //'config_group'       => '',
                                      'config_type'        => 'input',
                                      'config_key'         => 'news_av_height',
                                      'config_value'       => '',
                                      'config_default'     => '90',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 13,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );

$SQL['settings']['sett'][] = array( 'config_title'       => '������ ������� �������',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      //'config_group'       => '',
                                      'config_type'        => 'dropdown',
                                      'config_key'         => 'news_av_resize',
                                      'config_value'       => '',
                                      'config_default'     => '0',
                                      'config_extra'       => "0=�� ������
1=������ W ���������������
2=������ H ���������������
3=�����������������",
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 14,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );

$SQL['settings']['sett'][] = array( 'config_title'       => '�����',
                                      'config_description' => '������������ ������ � ��� ������ ���� ������ ������������������ ������',
                                      'config_group_title' => '',
                                      //'config_group'       => '',
                                      'config_type'        => 'dropdown',
                                      'config_key'         => 'news_av_method',
                                      'config_value'       => '',
                                      'config_default'     => '1',
                                      'config_extra'       => "1=���������� �������� � �������� ������� �� ������������ �������
2=������ �� ������� �������, ���������� � ������ ���������� ������� �������
3=������ �� ������� �������, ���������� � ������ ���� ���������� ������� �������",
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 15,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );



$SQL['settings']['sett'][] = array( 'config_title'       => '������������ ���������',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      //'config_group'       => '',
                                      'config_type'        => 'dropdown',
                                      'config_key'         => 'news_gen_calendar',
                                      'config_value'       => '',
                                      'config_default'     => '0',
                                      'config_extra'       => "0=���
                                      1=��",
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 16,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );



$SQL['settings']['sett'][] = array( 'config_title'       => '��������� ��������',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      //'config_group'       => '',
                                      'config_type'        => 'dropdown',
                                      'config_key'         => 'news_gen_cat',
                                      'config_value'       => '',
                                      'config_default'     => '0',
                                      'config_extra'       => "0=���
                                      1=��",
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 17,
                                      'config_start_group' => '',
                                      'config_end_group'   => 1, );

$SQL['menuname'] = "�������";

# ���������� �������, ������� ���������� ������� ��� �������� ������, ������� � ��������� ������ ������� �������������, ���������� ��� ���������, ����� �������
$del_tables =  array('news_cats', 'news_relations_cats');

?>
