CREATE TABLE `quotes` (
  `id` int(11) NOT NULL auto_increment,
  `content` text NOT NULL,
  `rating` int(11) NOT NULL default '0',
  `approval` tinyint(4) NOT NULL default '0',
  `check` int(11) NOT NULL default '0',
  `created` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=141 DEFAULT CHARSET=latin1
