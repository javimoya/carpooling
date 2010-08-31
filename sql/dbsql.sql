
CREATE TABLE `users` (
  `id` bigint(20) NOT NULL auto_increment,
  `md5_id` varchar(200) collate latin1_general_ci NOT NULL default '',
  `user_name` varchar(200) collate latin1_general_ci NOT NULL default '',
  `user_email` varchar(220) collate latin1_general_ci NOT NULL default '',
  `user_level` tinyint(4) NOT NULL default '1',
  `pwd` varchar(220) collate latin1_general_ci NOT NULL default '',
  `date` datetime NOT NULL default '0000-00-00',
  `users_ip` varchar(200) collate latin1_general_ci NOT NULL default '',
  `approved` int(1) NOT NULL default '0',
  `activation_code` int(10) NOT NULL default '0',
  `banned` int(1) NOT NULL default '0',
  `ckey` varchar(220) collate latin1_general_ci NOT NULL default '',
  `ctime` varchar(220) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `user_email` (`user_email`),
  FULLTEXT KEY `idx_search` (`user_email`,`user_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=55 ;



        