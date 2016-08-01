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

CREATE TABLE `COMMITTEES` (
  `committee_ID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `shortname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `organ` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dualdel` tinyint(1) NOT NULL DEFAULT '0',
  `application` tinyint(1) NOT NULL DEFAULT '0',
  `chair` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Or USG for committee main page',
  `chair_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Or USG for committee main page',
  `chair_letter` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Or USG for committee main page',
  `crisis_director` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Enter Moderator for GA/Leave blank if none',
  `crisis_director_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Enter moderator for GA/ Leave blank if none',
  `crisis_director_letter` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Enter moderator for GA/ Leave blank if none',
  `Topic_A_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Use if there is only one topic',
  `Topic_A_summary` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Use if there is only one topic or for Committee Main Page',
  `Topic_B_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Leave blank if none',
  `Topic_B_summary` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Leave blank if none',
  `update_paper` varchar(500) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Update Paper Location',
  `vid_code` varchar(15) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The 11 character code for the youtube vid. Leave blank if none',
  `vid_code2` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `vid_code3` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `bg_cover` varchar(500) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Location of BG Cover',
  `bg_link` varchar(500) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Link to BG',
  `height` int(4) NOT NULL DEFAULT '1385' COMMENT 'Leave blank if none',
  `s1_points` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `s2_points` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `s3_points` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `s4_points` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `s5_points` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `s6_points` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `s1_attendance` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `s2_attendance` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `s3_attendance` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `s4_attendance` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `s5_attendance` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `s6_attendance` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `awards` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `location` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `closing_remarks` text COLLATE utf8_unicode_ci,
  UNIQUE KEY `Committee_ID` (`committee_ID`)
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