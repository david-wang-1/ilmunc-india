CREATE TABLE `DELEGATIONS` (
  `delegation_ID` int(11) NOT NULL auto_increment,
  `school_name` varchar(100) collate utf8_unicode_ci NOT NULL,
  `address1` varchar(100) collate utf8_unicode_ci NOT NULL default '',
  `address2` varchar(100) collate utf8_unicode_ci NOT NULL default '',
  `city` varchar(50) collate utf8_unicode_ci NOT NULL default '',
  `state` varchar(30) collate utf8_unicode_ci NOT NULL default '',
  `zipcode` varchar(30) collate utf8_unicode_ci NOT NULL default '',
  `country` varchar(100) collate utf8_unicode_ci NOT NULL default '',
  `individual_prefix` varchar(4) collate utf8_unicode_ci default NULL,
  `individual_first_name` varchar(50) collate utf8_unicode_ci default NULL,
  `individual_last_name` varchar(50) collate utf8_unicode_ci default NULL,
  `username` varchar(30) collate utf8_unicode_ci NOT NULL default '',
  `registration_date` datetime NOT NULL,
  `expected_delegates` int(20) NOT NULL,
  `first_ilmunc` tinyint(1) NOT NULL default '0',
  `experience` mediumtext collate utf8_unicode_ci NOT NULL,
  `country_rqst1` varchar(200) collate utf8_unicode_ci default NULL COMMENT 'Country Requests',
  `country_rqst2` varchar(200) collate utf8_unicode_ci default NULL,
  `country_rqst3` varchar(200) collate utf8_unicode_ci default NULL,
  `country_rqst4` varchar(200) collate utf8_unicode_ci default NULL,
  `country_rqst5` varchar(200) collate utf8_unicode_ci default NULL,
  `country_rqst6` varchar(200) collate utf8_unicode_ci default NULL,
  `country_rqst7` varchar(200) collate utf8_unicode_ci default NULL,
  `country_rqst8` varchar(200) collate utf8_unicode_ci default NULL,
  `country_rqst9` varchar(200) collate utf8_unicode_ci default NULL,
  `country_rqst10` varchar(200) collate utf8_unicode_ci default NULL,
  `crisis_rqst1` varchar(200) collate utf8_unicode_ci default NULL,
  `crisis_rqst2` varchar(200) collate utf8_unicode_ci default NULL,
  `crisis_rqst3` varchar(200) collate utf8_unicode_ci default NULL,
  `crisis_rqst4` varchar(200) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`delegation_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `FACULTY` (
  `faculty_ID` int(11) NOT NULL auto_increment,
  `prefix` varchar(4) collate utf8_unicode_ci NOT NULL,
  `first_name` varchar(100) collate utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) collate utf8_unicode_ci NOT NULL,
  `room_preference` varchar(10) collate utf8_unicode_ci NOT NULL,
  `phone_number` varchar(30) collate utf8_unicode_ci NOT NULL,
  `email` varchar(50) collate utf8_unicode_ci NOT NULL default '',
  `delegation_ID` int(11) NOT NULL,
  `school_name` varchar(100) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`faculty_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `SECRETARIAT` (
  `secretariat_ID` int(11) NOT NULL auto_increment,
  `position` varchar(40) collate utf8_unicode_ci NOT NULL,
  `first_name` varchar(30) collate utf8_unicode_ci NOT NULL,
  `last_name` varchar(50) collate utf8_unicode_ci NOT NULL,
  `username` varchar(40) collate utf8_unicode_ci NOT NULL default '',
  `password` varchar(60) collate utf8_unicode_ci NOT NULL,
  `email` varchar(60) collate utf8_unicode_ci NOT NULL,
  `bio` text collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`secretariat_ID`),
  KEY `secretariat_ID` (`secretariat_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `SITE_UPDATES` (
  `update_ID` int(11) NOT NULL auto_increment,
  `type` varchar(40) collate utf8_unicode_ci NOT NULL,
  `date` varchar(40) collate utf8_unicode_ci NOT NULL,
  `title` varchar(150) collate utf8_unicode_ci NOT NULL,
  `text` mediumtext collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`update_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `USERS` (
  `user_ID` int(11) NOT NULL auto_increment,
  `email` varchar(50) collate utf8_unicode_ci NOT NULL default '',
  `username` varchar(30) collate utf8_unicode_ci NOT NULL default '',
  `password` varchar(50) collate utf8_unicode_ci NOT NULL default '',
  `role` varchar(10) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`user_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;