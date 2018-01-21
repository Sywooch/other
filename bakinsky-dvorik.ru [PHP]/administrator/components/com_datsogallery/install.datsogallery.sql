CREATE TABLE IF NOT EXISTS `#__datsogallery` (
  `id` int(11) NOT NULL auto_increment,
  `catid` int(11) NOT NULL default '0',
  `imgtitle` text NOT NULL,
  `imgauthor` varchar(50) default NULL,
  `imgtext` text NOT NULL,
  `imgdate` varchar(20) default NULL,
  `imgcounter` int(11) NOT NULL default '0',
  `imgdownloaded` int(11) NOT NULL default '0',
  `imgvotes` int(11) NOT NULL default '0',
  `imgvotesum` int(11) NOT NULL default '0',
  `published` tinyint(1) NOT NULL default '0',
  `ordering` int(11) NOT NULL default '0',
  `imgoriginalname` varchar(50) NOT NULL default '',
  `imgfilename` varchar(50) NOT NULL default '',
  `imgthumbname` varchar(50) NOT NULL default '',
  `checked_out` int(11) NOT NULL default '0',
  `owner` varchar(50) NOT NULL default '',
  `approved` int(1) NOT NULL default '0',
  `useruploaded` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;
      
CREATE TABLE IF NOT EXISTS `#__datsogallery_comments` (
  `cmtid` int(10) NOT NULL auto_increment,
  `cmtpic` int(10) NOT NULL default '0',
  `cmtip` varchar(15) NOT NULL default '',
  `cmtname` varchar(20) NOT NULL default '',
  `cmtmail` varchar(100) NOT NULL default '',
  `cmttext` text NOT NULL,
  `cmtdate` varchar(20) default NULL,
  `published` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`cmtid`)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__datsogallery_catg` (
  `cid` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `parent` varchar(255) NOT NULL default '0',
  `description` text,
  `ordering` int(11) NOT NULL default '0',
  `access` tinyint(3) unsigned NOT NULL default '0',
  `published` char(1) NOT NULL default '0',
  PRIMARY KEY  (`cid`)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__datsogallery_votes` (
  `vpic` int(11) NOT NULL auto_increment,
  `vip` varchar(15) default NULL,
  UNIQUE KEY `vpic` (`vpic`,`vip`)
) TYPE=MyISAM;