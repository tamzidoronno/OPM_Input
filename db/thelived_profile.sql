-- Adminer 4.2.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `area_of_interest`;
CREATE TABLE `area_of_interest` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `courses` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `area_of_interest` (`id`, `courses`) VALUES
(1,	'Combat Communication'),
(2,	'Cellular Communication'),
(3,	'SAT Communication'),
(4,	'Microwave Communication'),
(5,	'Soft-Switched Telephony'),
(6,	'Programming & Database Management'),
(7,	'Networking & Server Management'),
(8,	'Digital Forensic'),
(9,	'Reverse Engineering'),
(10,	'Cyber Security'),
(11,	'COMMSEC'),
(12,	'Power Energy');

DROP TABLE IF EXISTS `case_info`;
CREATE TABLE `case_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `lawyer_id` int(11) NOT NULL,
  `receive_date` date NOT NULL,
  `location` int(11) NOT NULL,
  `recours` smallint(4) NOT NULL,
  `aj` smallint(4) NOT NULL,
  `convocation` date NOT NULL,
  `doc_last_date` date NOT NULL,
  `payment` text NOT NULL,
  `question` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `dossier` varchar(60) NOT NULL,
  `rdv` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `case_info` (`id`, `client_id`, `lawyer_id`, `receive_date`, `location`, `recours`, `aj`, `convocation`, `doc_last_date`, `payment`, `question`, `status`, `created_date`, `created_by`, `modified`, `modified_by`, `attachment`, `dossier`, `rdv`) VALUES
(1,	1,	2,	'2015-02-02',	1,	1,	1,	'2015-02-04',	'2015-02-20',	'xxasdsad',	'sdsdsdsd',	1,	'2015-02-04 08:08:19',	1,	'2015-02-11 00:00:00',	1,	'',	'',	'0000-00-00'),
(12,	4,	2,	'2015-02-02',	2,	2,	2,	'1970-01-01',	'2015-02-03',	'test',	'',	1,	'0000-00-00 00:00:00',	1,	'2015-03-09 14:28:48',	1,	'',	'',	'0000-00-00'),
(9,	4,	2,	'2015-02-02',	2,	2,	2,	'1970-01-01',	'2015-02-03',	'test',	'',	1,	'0000-00-00 00:00:00',	1,	'2015-03-09 14:48:26',	1,	'',	'',	'0000-00-00'),
(10,	4,	2,	'2015-02-02',	2,	2,	2,	'0000-00-00',	'2015-02-03',	'test',	'',	1,	'0000-00-00 00:00:00',	1,	'2015-03-09 14:56:31',	1,	'',	'12324',	'0000-00-00'),
(13,	4,	2,	'2015-02-02',	2,	2,	2,	'0000-00-00',	'2015-02-03',	'test',	'',	1,	'0000-00-00 00:00:00',	1,	'2015-02-28 00:00:00',	1,	'',	'',	'0000-00-00'),
(14,	4,	3,	'2015-02-02',	2,	2,	2,	'0000-00-00',	'2015-02-03',	'test',	'',	1,	'0000-00-00 00:00:00',	1,	'2015-02-28 00:00:00',	1,	'',	'',	'0000-00-00'),
(15,	4,	2,	'2015-02-02',	2,	2,	2,	'0000-00-00',	'2015-02-03',	'test',	'',	1,	'0000-00-00 00:00:00',	1,	'2015-02-28 00:00:00',	1,	'',	'',	'0000-00-00'),
(16,	5,	2,	'2015-01-14',	1,	1,	1,	'2015-09-15',	'2015-04-22',	'asdfsdf',	'asdfsdfsdf',	1,	'0000-00-00 00:00:00',	1,	'2015-03-07 06:49:27',	1,	'',	'',	'0000-00-00'),
(17,	6,	2,	'2015-03-07',	1,	1,	1,	'0000-00-00',	'2015-07-17',	'sfsd',	'sdfgdfg',	1,	'0000-00-00 00:00:00',	2,	'2015-03-10 06:26:09',	1,	'1425963314.jpg',	'23568',	'0000-00-00'),
(18,	7,	3,	'2015-03-07',	1,	1,	1,	'2015-03-07',	'2015-03-19',	'',	'',	0,	'0000-00-00 00:00:00',	1,	'2015-03-07 09:15:44',	1,	'',	'',	'0000-00-00'),
(19,	8,	4,	'2015-03-10',	1,	1,	1,	'2015-03-26',	'0000-00-00',	'jgjhg',	'kjhkjh',	1,	'0000-00-00 00:00:00',	1,	'2015-03-10 06:31:26',	1,	'1425965486.jpg',	'98556',	'0000-00-00'),
(20,	9,	4,	'2015-03-10',	1,	1,	1,	'0000-00-00',	'0000-00-00',	'',	'',	1,	'0000-00-00 00:00:00',	1,	'2015-03-10 06:32:13',	1,	'1425965533.',	'3546',	'0000-00-00'),
(21,	10,	2,	'2015-03-10',	1,	1,	1,	'0000-00-00',	'0000-00-00',	'',	'',	1,	'0000-00-00 00:00:00',	1,	'2015-03-11 05:27:18',	1,	'1426048038.pdf',	'7657444',	'2015-03-11'),
(22,	11,	6,	'2015-03-10',	1,	1,	1,	'0000-00-00',	'0000-00-00',	'',	'',	1,	'0000-00-00 00:00:00',	1,	'2015-03-10 06:34:51',	1,	'1425965691.jpg',	'3435',	'0000-00-00'),
(23,	12,	6,	'2015-03-11',	1,	1,	1,	'2015-03-11',	'0000-00-00',	'',	'',	1,	'0000-00-00 00:00:00',	6,	'2015-03-11 06:17:07',	6,	'',	'234234',	'2015-03-11'),
(24,	13,	6,	'2015-03-11',	1,	1,	1,	'2015-03-11',	'0000-00-00',	'',	'',	1,	'0000-00-00 00:00:00',	6,	'2015-03-11 06:18:39',	6,	'',	'345345',	'2015-03-11'),
(25,	14,	6,	'2015-03-19',	1,	1,	1,	'2015-03-20',	'2015-03-31',	'sdfsdf',	'sdfsdf',	1,	'0000-00-00 00:00:00',	6,	'2015-03-19 11:58:18',	6,	'',	'435325',	'2015-03-27'),
(26,	15,	6,	'2015-03-19',	1,	1,	1,	'2015-03-20',	'0000-00-00',	'',	'',	1,	'0000-00-00 00:00:00',	6,	'2015-03-19 12:04:06',	6,	'',	'33234',	'2015-03-20'),
(27,	16,	6,	'2015-03-19',	1,	1,	1,	'2015-03-21',	'0000-00-00',	'',	'',	1,	'0000-00-00 00:00:00',	6,	'2015-03-19 12:07:43',	6,	'',	'234234',	'2015-03-20');

DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `clients` (`id`, `name`, `phone`, `created_date`) VALUES
(1,	'test test',	'123456',	'2015-02-03 00:00:00'),
(4,	'Rakib',	'123456',	'0000-00-00 00:00:00'),
(5,	'afsdf',	'22535',	'0000-00-00 00:00:00'),
(6,	'mmnj',	'23525',	'0000-00-00 00:00:00'),
(7,	'vasvf',	'1234',	'0000-00-00 00:00:00'),
(8,	'sdfdh',	'25345',	'0000-00-00 00:00:00'),
(9,	'dasf',	'3525',	'0000-00-00 00:00:00'),
(10,	'sadfsdf',	'52435',	'0000-00-00 00:00:00'),
(11,	'sdf',	'223',	'0000-00-00 00:00:00'),
(12,	'fasdf',	'23443',	'0000-00-00 00:00:00'),
(13,	'werewr',	'234234',	'0000-00-00 00:00:00'),
(14,	'sfsaf',	'2342',	'0000-00-00 00:00:00'),
(15,	'New',	'1234',	'0000-00-00 00:00:00'),
(16,	'asdad',	'234234',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `educational_qualification`;
CREATE TABLE `educational_qualification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `BA_No` int(11) NOT NULL,
  `BA_No_Type` varchar(10) NOT NULL,
  `Qualification` varchar(10) NOT NULL,
  `Institute` varchar(50) NOT NULL,
  `Division_Subject` varchar(20) NOT NULL,
  `Result` varchar(5) NOT NULL,
  `Year_Of_Passing` int(11) NOT NULL,
  `Any_Achivement` text NOT NULL,
  `Remarks` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `educational_qualification_ibfk_1` (`BA_No_Type`,`BA_No`),
  CONSTRAINT `educational_qualification_ibfk_1` FOREIGN KEY (`BA_No_Type`, `BA_No`) REFERENCES `profile` (`BA_No_Type`, `BA_No`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `educational_qualification` (`id`, `BA_No`, `BA_No_Type`, `Qualification`, `Institute`, `Division_Subject`, `Result`, `Year_Of_Passing`, `Any_Achivement`, `Remarks`) VALUES
(25,	5757,	'BA',	'',	'',	'',	'',	0,	'',	''),
(34,	10452,	'BSS',	'BSc',	'YUUY',	'',	'FDGFD',	0,	'DGFD',	'RSGRS'),
(75,	999,	'BA',	'SSC',	'Abc',	'Dhaka',	'4.99',	2005,	'',	''),
(76,	999,	'BA',	'HSC',	'Xyz',	'Dhaka',	'4.75',	2007,	'',	''),
(77,	999,	'BA',	'BSc',	'WWW',	'Dhaka',	'5.00',	2011,	'',	''),
(78,	999,	'BA',	'PhD',	'ddfd',	'',	'',	0,	'',	''),
(79,	5555,	'BA',	'SSC',	'test',	'test',	'test',	454,	'test',	'test'),
(80,	5555,	'BA',	'HSC',	'test',	'test',	'test',	544,	'test',	'test'),
(81,	9281,	'BA',	'SSC',	'Police Line School',	'Science',	'A+',	2007,	'NA',	'NA'),
(82,	9128,	'BA',	'HSC',	'NGDC',	'Science',	'A+',	2010,	'NA',	'NA'),
(83,	9298,	'BA',	'SSC',	'Police Line School',	'Science',	'A+',	2007,	'NA',	'NA'),
(84,	9298,	'BA',	'HSC',	'NGDC',	'Science',	'A+',	2009,	'NA',	'NA'),
(85,	9298,	'BA',	'BSc',	'BUP',	'Military Science',	'3.35',	2014,	'NA',	'NA'),
(86,	322232,	'BSS',	'SSC',	'ins',	'div',	'4.9',	2010,	'acv',	'test'),
(87,	322232,	'BSS',	'HSC',	'ins2',	'div2',	'4.50',	2012,	'acv2',	'test2'),
(88,	4545,	'BA',	'SSC',	'ins',	'div',	'2.44',	2018,	'any ach',	'test'),
(89,	4545,	'BA',	'HSC',	'ins2',	'div2',	'4.55',	3018,	'acv2',	'test2'),
(90,	4545,	'BA',	'SSC',	'ins',	'div',	'2.44',	2018,	'any ach',	'test'),
(91,	4545,	'BA',	'HSC',	'ins2',	'div2',	'4.55',	3018,	'acv2',	'test2'),
(92,	4545,	'BA',	'SSC',	'ins',	'div',	'2.44',	2018,	'any ach',	'test'),
(93,	4545,	'BA',	'HSC',	'ins2',	'div2',	'4.55',	3018,	'acv2',	'test2'),
(94,	56757,	'BA',	'HSC',	'ins',	'div',	'3.77',	2017,	'any3',	'remark');

DROP TABLE IF EXISTS `educational_qualification_temp`;
CREATE TABLE `educational_qualification_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `BA_No` int(11) NOT NULL,
  `BA_No_Type` varchar(10) NOT NULL,
  `Qualification` varchar(10) NOT NULL,
  `Institute` varchar(50) NOT NULL,
  `Division_Subject` varchar(20) NOT NULL,
  `Result` varchar(5) NOT NULL,
  `Year_Of_Passing` int(11) NOT NULL,
  `Any_Achivement` text NOT NULL,
  `Remarks` text NOT NULL,
  `flag` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `educational_qualification_ibfk_1` (`BA_No_Type`,`BA_No`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `educational_qualification_temp` (`id`, `BA_No`, `BA_No_Type`, `Qualification`, `Institute`, `Division_Subject`, `Result`, `Year_Of_Passing`, `Any_Achivement`, `Remarks`, `flag`) VALUES
(43,	2147483647,	'BSS',	'SSC',	'f',	'fsfs',	'88',	77,	'',	'',	0),
(44,	222222222,	'BA',	'SSC',	'inst',	'div',	'resul',	0,	'any5',	'rem',	0),
(45,	888888888,	'BA',	'SSC',	'hbj',	'jh',	'3',	324,	'any',	'remark',	0),
(46,	564565,	'BA',	'SSC',	'institute',	'division',	'4',	2017,	'acv',	'',	0),
(47,	564565,	'BA',	'HSC',	'institure2',	'div2',	'5',	2018,	'acv2',	'remark',	0);

DROP TABLE IF EXISTS `foreign_assignments`;
CREATE TABLE `foreign_assignments` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `BA_No_Type` varchar(5) NOT NULL,
  `BA_No` int(11) NOT NULL,
  `Assignments` text NOT NULL,
  `Assignment_Details` text NOT NULL,
  `Country` varchar(50) NOT NULL,
  `From_Date_FA` date NOT NULL,
  `To_Date_FA` date NOT NULL,
  `Duration_FA` int(11) NOT NULL,
  `Remarks_FA` text NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `foreign_assignments` (`Id`, `BA_No_Type`, `BA_No`, `Assignments`, `Assignment_Details`, `Country`, `From_Date_FA`, `To_Date_FA`, `Duration_FA`, `Remarks_FA`) VALUES
(23,	'BA',	5757,	'Course',	'',	'0',	'0000-00-00',	'0000-00-00',	0,	''),
(36,	'BA',	999,	'PSI',	'test',	'0',	'0000-00-00',	'0000-00-00',	0,	''),
(37,	'BA',	5555,	'Visit',	'adsdsa',	'232',	'2018-11-09',	'2018-12-03',	0,	'asds'),
(38,	'BA',	9281,	'Training',	'EWS',	'0',	'2018-09-29',	'2018-10-21',	21,	'Good'),
(39,	'BA',	9128,	'Training',	'EWS',	'0',	'2018-10-17',	'2018-10-24',	21,	'Good'),
(40,	'BA',	9298,	'Training',	'EW System',	'0',	'2018-10-01',	'2018-10-19',	3,	'NA'),
(41,	'BSS',	322232,	'Training',	'assign',	'0',	'2018-11-15',	'2018-11-24',	3,	'test6'),
(42,	'BSS',	322232,	'Visit',	'assign2',	'0',	'2018-11-15',	'2018-11-30',	9,	'test99'),
(43,	'BA',	4545,	'PSI',	'assign',	'0',	'2018-11-15',	'2018-11-29',	3,	'test6'),
(44,	'BA',	4545,	'PSI',	'assign',	'0',	'2018-11-15',	'2018-11-29',	3,	'test6'),
(45,	'BA',	4545,	'PSI',	'assign',	'0',	'2018-11-15',	'2018-11-29',	3,	'test6');

DROP TABLE IF EXISTS `foreign_assignments_temp`;
CREATE TABLE `foreign_assignments_temp` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `BA_No_Type` varchar(5) NOT NULL,
  `BA_No` int(11) NOT NULL,
  `Assignments` text NOT NULL,
  `Assignment_Details` text NOT NULL,
  `Country` varchar(50) NOT NULL,
  `From_Date_FA` date NOT NULL,
  `To_Date_FA` date NOT NULL,
  `Duration_FA` int(11) NOT NULL,
  `Remarks_FA` text NOT NULL,
  `flag` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `foreign_assignments_temp` (`Id`, `BA_No_Type`, `BA_No`, `Assignments`, `Assignment_Details`, `Country`, `From_Date_FA`, `To_Date_FA`, `Duration_FA`, `Remarks_FA`, `flag`) VALUES
(18,	'',	0,	'',	'',	'',	'0000-00-00',	'0000-00-00',	0,	'',	0),
(19,	'',	0,	'',	'',	'',	'0000-00-00',	'0000-00-00',	0,	'',	0),
(20,	'',	0,	'',	'',	'',	'0000-00-00',	'0000-00-00',	0,	'',	0),
(21,	'BA',	222222222,	'PSI',	'assign',	'country',	'2018-11-01',	'0000-00-00',	8,	'tre',	0),
(22,	'BA',	222222222,	'PSI',	'assign',	'country',	'2018-11-01',	'2018-11-16',	8,	'tre',	0),
(23,	'BA',	888888888,	'Course',	'details',	'country',	'2018-11-08',	'2018-11-30',	2,	'remak',	0),
(24,	'BA',	564565,	'Seminar',	'assign',	'country',	'2018-11-28',	'2018-11-30',	2,	'remark',	0);

DROP TABLE IF EXISTS `military_courses`;
CREATE TABLE `military_courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `BA_No_Type` varchar(10) NOT NULL,
  `BA_No` int(11) NOT NULL,
  `Name_Of_The_Course` varchar(20) NOT NULL,
  `Location` varchar(30) NOT NULL,
  `Duration` int(11) NOT NULL,
  `Result` varchar(5) NOT NULL,
  `Year` int(11) NOT NULL,
  `Position` varchar(10) NOT NULL,
  `Any_Achivements` text NOT NULL,
  `Any_Observation_Remarks` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `military_courses_ibfk_1` (`BA_No_Type`,`BA_No`),
  CONSTRAINT `military_courses_ibfk_1` FOREIGN KEY (`BA_No_Type`, `BA_No`) REFERENCES `profile` (`BA_No_Type`, `BA_No`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `military_courses` (`id`, `BA_No_Type`, `BA_No`, `Name_Of_The_Course`, `Location`, `Duration`, `Result`, `Year`, `Position`, `Any_Achivements`, `Any_Observation_Remarks`) VALUES
(24,	'BA',	5757,	'',	'',	0,	'',	0,	'',	'',	''),
(31,	'BSS',	10452,	'HRTR',	'REE',	0,	'JNKJ',	0,	'BKJB',	'JKB',	'KJB'),
(57,	'BA',	999,	'Xyz',	'Cumilla',	24,	'',	0,	'1',	'',	''),
(58,	'BA',	999,	'Qwe',	'Savar',	8,	'',	0,	'1',	'',	''),
(59,	'BA',	5555,	'test',	'test',	0,	'tetet',	222,	'tet',	'dfdf',	'dffd'),
(60,	'BA',	9281,	'BCC',	'SI&T',	3,	'',	0,	'18',	'',	'NA'),
(61,	'BA',	9128,	'BCC',	'SI&T',	6,	'',	0,	'75',	'',	''),
(62,	'BA',	9298,	'OWC',	'SI&T',	7,	'',	0,	'NA',	'',	''),
(63,	'BA',	9298,	'BCC',	'SI&T',	7,	'',	0,	'NA',	'',	'NA'),
(64,	'BSS',	322232,	'name',	'locat',	4,	'3.8',	217,	'test11',	'acv33',	'rem11'),
(65,	'BSS',	322232,	'name2',	'locat2',	5,	'4',	267,	'test55',	'acv44',	'rem22'),
(66,	'BA',	4545,	'name1',	'locatio',	3,	'2.5',	3432,	'test',	'any ach',	'remark3'),
(67,	'BA',	4545,	'name1',	'locatio',	3,	'2.5',	3432,	'test',	'any ach',	'remark3'),
(68,	'BA',	4545,	'name1',	'locatio',	3,	'2.5',	3432,	'test',	'any ach',	'remark3'),
(69,	'BA',	56757,	'name',	'location',	34,	'45',	5454,	'test',	'tesrt',	'test');

DROP TABLE IF EXISTS `military_courses_temp`;
CREATE TABLE `military_courses_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `BA_No_Type` varchar(10) NOT NULL,
  `BA_No` int(11) NOT NULL,
  `Name_Of_The_Course` varchar(20) NOT NULL,
  `Location` varchar(30) NOT NULL,
  `Duration` int(11) NOT NULL,
  `Result` varchar(5) NOT NULL,
  `Year` int(11) NOT NULL,
  `Position` varchar(10) NOT NULL,
  `Any_Achivements` text NOT NULL,
  `Any_Observation_Remarks` text NOT NULL,
  `flag` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `military_courses_ibfk_1` (`BA_No_Type`,`BA_No`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `military_courses_temp` (`id`, `BA_No_Type`, `BA_No`, `Name_Of_The_Course`, `Location`, `Duration`, `Result`, `Year`, `Position`, `Any_Achivements`, `Any_Observation_Remarks`, `flag`) VALUES
(18,	'',	0,	'',	'',	0,	'',	0,	'',	'',	'',	0),
(19,	'BA',	888888888,	'name',	'location',	20,	'43',	435,	'position',	'acv',	'remark',	0),
(20,	'BA',	564565,	'name',	'locs',	2,	'22',	2016,	'positon',	'',	'remark',	0);

DROP TABLE IF EXISTS `officer_skills`;
CREATE TABLE `officer_skills` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `BA_No_Type` varchar(10) NOT NULL,
  `BA_No` int(11) NOT NULL,
  `Communication_Topic` text NOT NULL,
  `Transmission_System_Topic` varchar(150) NOT NULL,
  `Programming_Language_Topic` varchar(150) NOT NULL,
  `Database_Management_System_Topic` varchar(150) NOT NULL,
  `Server_Management_Topic` varchar(150) NOT NULL,
  `Networking_Topic` varchar(150) NOT NULL,
  `Digital_Forensic_Topic` varchar(150) NOT NULL,
  `Cyber_Security_Topic` varchar(150) NOT NULL,
  `SIGINT_Topic` varchar(150) NOT NULL,
  `Power_Energy_Topic` varchar(150) NOT NULL,
  `Reverse_Engineering_Topic` varchar(150) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

INSERT INTO `officer_skills` (`Id`, `BA_No_Type`, `BA_No`, `Communication_Topic`, `Transmission_System_Topic`, `Programming_Language_Topic`, `Database_Management_System_Topic`, `Server_Management_Topic`, `Networking_Topic`, `Digital_Forensic_Topic`, `Cyber_Security_Topic`, `SIGINT_Topic`, `Power_Energy_Topic`, `Reverse_Engineering_Topic`) VALUES
(5,	'BA',	9281,	'Combat Communication,Cellular Communication,SAT Communication,Microwave Communication',	'Optical Fibre Transmission,Soft-Switched Telephony',	'',	'',	'',	'',	'',	'CEH,CISA,CISM,CISSP',	'EW,COMMINT,ELINT',	'',	''),
(6,	'BA',	9128,	'Cellular Communication,SAT Communication',	'Optical Fibre Transmission',	'',	'',	'',	'',	'',	'',	'',	'',	'Reverse Logistics Data Analyst,Hardware Reverse Engineering,GREM,'),
(7,	'BA',	5757,	'SAT Communication',	'Optical Fibre Transmission',	'ASP',	'',	'',	'',	'',	'',	'',	'',	''),
(8,	'BA',	5555,	'Combat Communication,Cellular Communication,SAT Communication',	'Optical Fibre Transmission,Soft-Switched Telephony,sadasd',	'C/C++/C#,PHP,ASP,JAVA,Android,IOS,sdsad',	'SQL,MySqli,Oracle,SQLite,asdas',	'Linux Server,Windows Server,sadsadas',	'CCNA(Cisco),CCNP(Cisco,CCIE(Cisco),JNCIE-ENT(Juniper),sadasdsa',	'CMI,CFS,sdsadas',	'CEH,CISA,CISM,CISSP,sdasdas',	'EW,COMMINT,ELINT,asdasds',	'Solar Energy,Renewable Energy,sadasdas',	'Reverse Logistics Data Analyst,Hardware Reverse Engineering,GREM,sadsadsd'),
(10,	'BA',	999,	'Combat Communication,Cellular Communication',	'Optical Fibre Transmission',	'',	'',	'',	'',	'',	'',	'',	'',	''),
(11,	'BSS',	10452,	'Cellular Communication',	'',	'PHP',	'',	'',	'',	'',	'',	'',	'',	''),
(12,	'BA',	9298,	'Cellular Communication',	'Optical Fibre Transmission',	'PHP,ASP,JAVA',	'Oracle,SQLite,sdasd',	'Linux Server,Windows Server,sadsa',	'CCNP(Cisco,CCIE(Cisco)',	'CMI,CFS,sads',	'CISA,CISM,sadas',	'',	'dsfsdfds',	'Reverse Logistics Data Analyst,Hardware Reverse Engineering,GREM,dsfdsf'),
(13,	'BSS',	322232,	'Cellular Communication,SAT Communication, ',	'Optical Fibre Transmission, ',	'PHP,ASP,JAVA',	'MySqli,Oracle',	'Windows Server',	'CCIE(Cisco)',	'CMI',	'CISA',	'COMMINT',	'Renewable Energy',	'Hardware Reverse Engineering,'),
(14,	'BA',	4545,	'Combat Communication,SAT Communication, ',	' ',	'',	'',	'',	'',	'',	'',	'',	'',	''),
(15,	'BA',	4545,	'Combat Communication,SAT Communication, ',	' ',	'',	'',	'',	'',	'',	'',	'',	'',	''),
(16,	'BA',	4545,	'Combat Communication,SAT Communication, ',	' ',	'',	'',	'',	'',	'',	'',	'',	'',	''),
(17,	'BA',	56757,	' ',	' ',	'ASP,Android',	'',	'',	'',	'',	'',	'',	'',	'');

DROP TABLE IF EXISTS `officer_skills_temp`;
CREATE TABLE `officer_skills_temp` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `BA_No_Type` varchar(10) NOT NULL,
  `BA_No` int(11) NOT NULL,
  `Communication_Topic` text NOT NULL,
  `Transmission_System_Topic` varchar(150) NOT NULL,
  `Programming_Language_Topic` varchar(150) NOT NULL,
  `Database_Management_System_Topic` varchar(150) NOT NULL,
  `Server_Management_Topic` varchar(150) NOT NULL,
  `Networking_Topic` varchar(150) NOT NULL,
  `Digital_Forensic_Topic` varchar(150) NOT NULL,
  `Cyber_Security_Topic` varchar(150) NOT NULL,
  `SIGINT_Topic` varchar(150) NOT NULL,
  `Power_Energy_Topic` varchar(150) NOT NULL,
  `Reverse_Engineering_Topic` varchar(150) NOT NULL,
  `flag` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `officer_skills_temp` (`Id`, `BA_No_Type`, `BA_No`, `Communication_Topic`, `Transmission_System_Topic`, `Programming_Language_Topic`, `Database_Management_System_Topic`, `Server_Management_Topic`, `Networking_Topic`, `Digital_Forensic_Topic`, `Cyber_Security_Topic`, `SIGINT_Topic`, `Power_Energy_Topic`, `Reverse_Engineering_Topic`, `flag`) VALUES
(15,	'BA',	222222222,	'Cellular Communication',	'Optical Fibre Transmission',	'ASP',	'MySqli',	'Windows Server',	'CCNP(Cisco',	'CFS',	'CISA',	'COMMINT',	'Solar Energy',	'Hardware Reverse Engineering,',	0),
(16,	'BA',	888888888,	'Microwave Communication',	'',	'JAVA',	'SQLite',	'',	'CCNP(Cisco',	'CMI',	'CEH',	'',	'Renewable Energy',	'',	0),
(17,	'BA',	564565,	'Cellular Communication',	'Optical Fibre Transmission',	'C/C++/C#',	'SQL',	'Linux Server',	'CCNA(Cisco)',	'CMI',	'CEH',	'EW',	'Solar Energy',	'Reverse Logistics Data Analyst,',	0);

DROP TABLE IF EXISTS `primaryinfo`;
CREATE TABLE `primaryinfo` (
  `BA_No_Type` varchar(30) NOT NULL,
  `BA_No` int(11) NOT NULL,
  `Rank` varchar(30) NOT NULL,
  `Course_Type` varchar(30) NOT NULL,
  `Course` int(11) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `date` datetime NOT NULL,
  `token` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `primaryinfo` (`BA_No_Type`, `BA_No`, `Rank`, `Course_Type`, `Course`, `Email`, `date`, `token`) VALUES
('BA',	5,	'Capt',	'Spl',	56,	'nadimhossen5@gmail.com',	'0000-00-00 00:00:00',	''),
('BSS',	6,	'Maj',	'Spl',	4,	'nadimhossen@live.com',	'0000-00-00 00:00:00',	'QlNTNg=='),
('BSS',	6,	'Maj',	'Spl',	4,	'nadimhossen@live.com',	'2018-11-06 15:18:43',	'QlNTNg=='),
('BA',	3,	'Lt',	'L/C',	3,	'nadimhossen5@gmail.com',	'2018-11-06 15:29:26',	'QkEz'),
('BSS',	55,	'Maj',	'Spl',	4,	'nadimhossen@live.com',	'2018-11-06 15:49:50',	'QlNTNTU='),
('BSS',	5,	'Lt Col',	'Spl',	43,	'nadim@gmail.com',	'2018-11-06 15:50:33',	'QlNTNQ=='),
('BSS',	4,	'Maj',	'Spl',	4,	'nadimhossen5@gmail.com',	'2018-11-06 15:25:56',	'QlNTNA=='),
('BSS',	22,	'Col',	'Spl',	3,	'nadimhossen5@gmail.com',	'2018-11-06 15:46:38',	'QlNTMjI='),
('BA',	3434,	'Lt',	'L/C',	3434,	'neshmedia.bd@gmail.com',	'2018-11-06 16:28:31',	'QkEzNDM0'),
('BA',	34,	'Maj',	'Spl',	33,	'nadimhossen5@gmail.com',	'2018-11-08 05:10:41',	'QkEzNA=='),
('BSS',	34343,	'Capt',	'Spl',	7667,	'tarekcse2k9@gmail.com',	'2018-11-11 15:25:59',	'QlNTMzQzNDM='),
('BA',	45454,	'Maj',	'Spl',	34343,	'neshmedia.bd@gmail.com',	'2018-11-13 04:27:05',	'QkE0NTQ1NA=='),
('BA',	10,	'Lt',	'L/C',	10,	'test@test.com',	'2018-11-13 06:26:37',	'QkExMA=='),
('BA',	54,	'Lt',	'L/C',	45,	'test@test.com',	'2018-11-13 06:32:05',	'QkE1NA=='),
('BA',	1,	'Lt',	'L/C',	1,	'test@test.com',	'2018-11-13 06:32:21',	'QkEx'),
('BA',	1,	'Lt',	'L/C',	0,	'test@test.com',	'2018-11-13 06:33:59',	'QkEx'),
('BA',	1,	'Lt',	'L/C',	1,	'test@test.com',	'2018-11-13 06:35:46',	'QkEx'),
('BA',	123,	'Lt',	'L/C',	123,	'neshmedia.programmer@gmail.com',	'2018-11-13 06:46:11',	'QkExMjM='),
('BSS',	3434,	'Capt',	'Spl',	45454,	'neshmedia.bd@gmail.com',	'2018-11-15 04:42:41',	'QlNTMzQzNA=='),
('BSS',	45,	'Lt Col',	'Spl',	54,	'ntfertegr@gmail.com',	'2018-11-15 06:06:25',	'QlNTNDU='),
('BA',	333,	'Lt',	'L/C',	343,	'n@gmail.com',	'2018-11-15 06:55:22',	'QkEzMzM='),
('BA',	323,	'Lt',	'L/C',	343,	'n123@gmail.com',	'2018-11-15 07:02:28',	'QkEzMjM='),
('BA',	4353,	'Lt',	'L/C',	3242,	'nadimhossen5@gmail.com',	'2018-11-15 07:06:37',	'QkE0MzUz'),
('BA',	4543,	'Lt',	'L/C',	3432,	'nadimhossen5@gmail.com',	'2018-11-15 13:36:14',	'QkE0NTQz'),
('BA',	4353453,	'Lt',	'L/C',	45,	'nadimhossen5@gmail.com',	'2018-11-15 13:49:01',	'QkE0MzUzNDUz'),
('BSS',	322232,	'Lt',	'L/C',	4343,	'nadimhossen5@gmail.com',	'2018-11-15 14:05:47',	'QlNTMzIyMjMy'),
('BA',	54321,	'Lt',	'Spl',	444,	'nadimhossen5@gmail.com',	'2018-11-16 13:09:20',	'QkE1NDMyMQ=='),
('BA',	4545,	'Lt',	'L/C',	543543,	'nadimhossen5@gmail.com',	'2018-11-16 14:09:53',	'QkE0NTQ1'),
('BA',	56757,	'Lt',	'Spl',	54656,	'nadimhossen5@gmail.com',	'2018-11-16 14:50:52',	'QkE1Njc1Nw=='),
('BSS',	455443,	'Lt',	'Spl',	5434,	'nadimhossen5@gmail.com',	'2018-11-16 15:03:59',	'QlNTNDU1NDQz'),
('BA',	345343,	'Lt',	'L/C',	4543,	'nadimhossen5@gmail.com',	'2018-11-17 04:36:02',	'QkEzNDUzNDM='),
('BA',	4543532,	'Lt',	'L/C',	434,	'nadimhossen5@gmail.com',	'2018-11-17 08:49:40',	'QkE0NTQzNTMy'),
('BSS',	34093,	'Lt',	'L/C',	3213,	'nadimhossen5@gmail.com',	'2018-11-17 16:35:18',	'QlNTMzQwOTM='),
('BA',	111111,	'Lt',	'Spl',	4636,	'nadimhossen5@gmail.com',	'2018-11-17 17:46:37',	'QkExMTExMTE='),
('BSS',	2147483647,	'Lt',	'L/C',	6776,	'nadimhossen5@gmail.com',	'2018-11-17 18:05:24',	'QlNTNjU1NzY3Njc2NTY='),
('BA',	222222222,	'Lt',	'L/C',	675,	'nadimhossen5@gmail.com',	'2018-11-17 18:23:36',	'QkEyMjIyMjIyMjI='),
('BA',	888888888,	'Lt',	'L/C',	32742387,	'nadimhossen5@gmail.com',	'2018-11-17 18:52:05',	'QkE4ODg4ODg4ODg='),
('BA',	564565,	'Lt',	'Spl',	54545,	'nadimhossen5@gmail.com',	'2018-11-19 04:32:53',	'QkE1NjQ1NjU=');

DROP TABLE IF EXISTS `profile`;
CREATE TABLE `profile` (
  `BA_No_Type` varchar(10) NOT NULL,
  `BA_No` int(11) NOT NULL,
  `Name` varchar(35) NOT NULL,
  `Rank` varchar(20) NOT NULL,
  `Course_Type` varchar(30) NOT NULL,
  `Course` int(11) NOT NULL,
  `Present_Posting` varchar(30) NOT NULL,
  `Contact_No` bigint(20) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `First_Choice` varchar(30) NOT NULL,
  `Second_Choice` varchar(30) NOT NULL,
  `Image` mediumtext NOT NULL,
  `Dir_Comment` text NOT NULL,
  PRIMARY KEY (`BA_No_Type`,`BA_No`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `profile` (`BA_No_Type`, `BA_No`, `Name`, `Rank`, `Course_Type`, `Course`, `Present_Posting`, `Contact_No`, `Email`, `First_Choice`, `Second_Choice`, `Image`, `Dir_Comment`) VALUES
('BA',	999,	'Test',	'Lt',	'L/C',	1,	'1',	1,	'test@test.com',	'Combat Communication',	'',	'1541505946.jpg',	'test'),
('BA',	4545,	'Nadim',	'Lt',	'BA',	0,	'test',	1744910825,	'nadimhossen5@gmail.com',	'Digital Forensic',	'Combat Communication',	'',	'362750'),
('BA',	5555,	'Abdur Rahman',	'Col',	'L/C',	45,	'8 Sig Bn',	1743695847,	'0',	'Reverse Engineering',	'Digital Forensic',	'1541507148.jpg',	'23232'),
('BA',	5757,	'Sabbir',	'Maj',	'L/C',	53,	'10 Signal Bn',	123568974,	'0',	'Soft-Switched Telephony',	'SAT Communication',	'',	'0'),
('BA',	9128,	'Md. Toufiqul Huda',	'Capt',	'Spl',	42,	'Bogura',	1743629087,	'0',	'Combat Communication',	'Networking & Server Management',	'1541507674.png',	'323'),
('BA',	9281,	'Md. Tarek Aziz',	'Capt',	'Spl',	44,	'10 Signal Bn',	1743629087,	'0',	'Combat Communication',	'',	'1541507640.png',	'ererere'),
('BA',	9298,	'Sanjoy',	'Lt',	'L/C',	74,	'11 Sig Bn',	1746985632,	'sanjoy@gmail.com',	'Combat Communication',	'Networking & Server Management',	'1541507744.png',	'dsfdsfds'),
('BA',	56757,	'Nadim',	'Lt',	'BA',	56757,	'test',	5654654,	'nadimhossen5@gmail.com',	'Cyber Security',	'Combat Communication',	'',	'3631712'),
('BSS',	10452,	'MAHBUBUR RAHMAN',	'Capt',	'Spl',	43,	'BMA',	1743629087,	'TAREKCSE2K9GMAIL.COM',	'Combat Communication',	'Cyber Security',	'',	''),
('BSS',	322232,	'nadim',	'Lt',	'',	0,	'test',	453543,	'nadimhossen5@gmail.com',	'Combat Communication',	'',	'',	'4823551');

DROP TABLE IF EXISTS `profile_temp`;
CREATE TABLE `profile_temp` (
  `BA_No_Type` varchar(10) NOT NULL,
  `BA_No` int(11) NOT NULL,
  `Name` varchar(35) NOT NULL,
  `Rank` varchar(20) NOT NULL,
  `Course_Type` varchar(30) NOT NULL,
  `Course` int(11) NOT NULL,
  `Present_Posting` varchar(30) NOT NULL,
  `Contact_No` bigint(20) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `First_Choice` varchar(30) NOT NULL,
  `Second_Choice` varchar(30) NOT NULL,
  `Image` mediumtext NOT NULL,
  `Dir_Comment` text NOT NULL,
  `flag` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`BA_No_Type`,`BA_No`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `profile_temp` (`BA_No_Type`, `BA_No`, `Name`, `Rank`, `Course_Type`, `Course`, `Present_Posting`, `Contact_No`, `Email`, `First_Choice`, `Second_Choice`, `Image`, `Dir_Comment`, `flag`) VALUES
('BA',	222222222,	'nadim',	'Lt',	'BA',	222222222,	'posting',	657657657,	'nadimhossen5@gmail.com',	'Programming & Database Managem',	'',	'1542479129.png',	'',	0),
('BA',	888888888,	'',	'Lt',	'L/C',	32742387,	'',	0,	'nadimhossen5@gmail.com',	'Reverse Engineering',	'',	'',	'',	0),
('BA',	564565,	'Nadim Hossen',	'Lt',	'Spl',	54545,	'posting',	1744910825,	'nadimhossen5@gmail.com',	'Microwave Communication',	'',	'1542602183.jpg',	'',	0);

DROP TABLE IF EXISTS `publications_articles_thesis_projects`;
CREATE TABLE `publications_articles_thesis_projects` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `BA_No_Type` varchar(10) NOT NULL,
  `BA_No` int(11) NOT NULL,
  `Name_Of_The_Topic` text NOT NULL,
  `Publishing_Authority` text NOT NULL,
  `Abstract` varchar(50) NOT NULL,
  `Year_Of_Passing_PP` int(11) NOT NULL,
  `Remarks_PP` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `publications_articles_thesis_projects` (`Id`, `BA_No_Type`, `BA_No`, `Name_Of_The_Topic`, `Publishing_Authority`, `Abstract`, `Year_Of_Passing_PP`, `Remarks_PP`) VALUES
(17,	'BA',	5757,	'',	'',	'0',	0,	'0'),
(20,	'BSS',	10452,	'JB',	'KBJ',	'0',	0,	'0'),
(30,	'BA',	999,	'test',	'test',	'0',	0,	'0'),
(31,	'BA',	5555,	'sadasd',	'sadsad',	'2323',	2323,	'0'),
(32,	'BA',	9281,	'Cryptology',	'IEEE',	'0',	2014,	'0'),
(33,	'BA',	9128,	'Cryptology',	'IEEE',	'0',	2014,	'0'),
(34,	'BSS',	322232,	'Name Of The Topic',	'pub',	'0',	2013,	'0'),
(35,	'BSS',	322232,	'Name Of The Topic',	'pyb5',	'0',	45353,	'0'),
(36,	'BSS',	322232,	'Name Of The Topic',	'pub',	'0',	2013,	'0'),
(37,	'BSS',	322232,	'Name Of The Topic',	'pyb5',	'0',	45353,	'0'),
(38,	'BA',	4545,	'gdf',	'gdf',	'0',	543,	'0'),
(39,	'BA',	4545,	'gdf',	'gdf',	'0',	543,	'0'),
(40,	'BA',	4545,	'gdf',	'gdf',	'0',	543,	'0'),
(41,	'BA',	56757,	'Name Of The Topic',	'test',	'rted',	54654,	'test');

DROP TABLE IF EXISTS `publications_articles_thesis_projects_temp`;
CREATE TABLE `publications_articles_thesis_projects_temp` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `BA_No_Type` varchar(10) NOT NULL,
  `BA_No` int(11) NOT NULL,
  `Name_Of_The_Topic` text NOT NULL,
  `Publishing_Authority` text NOT NULL,
  `Abstract` varchar(50) NOT NULL,
  `Year_Of_Passing_PP` int(11) NOT NULL,
  `Remarks_PP` varchar(50) NOT NULL,
  `flag` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `publications_articles_thesis_projects_temp` (`Id`, `BA_No_Type`, `BA_No`, `Name_Of_The_Topic`, `Publishing_Authority`, `Abstract`, `Year_Of_Passing_PP`, `Remarks_PP`, `flag`) VALUES
(17,	'BA',	888888888,	'name',	'pos',	'abs',	87,	'hdhgf',	0);

DROP TABLE IF EXISTS `rdv`;
CREATE TABLE `rdv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `case_id` int(11) NOT NULL,
  `rdv_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `rdv` (`id`, `case_id`, `rdv_date`) VALUES
(1,	1,	'2015-02-12'),
(9,	15,	'2015-02-25'),
(10,	16,	'2015-03-19'),
(11,	17,	'2015-03-18'),
(12,	17,	'2015-04-15'),
(13,	18,	'2015-03-07'),
(14,	18,	'2015-03-17');

DROP TABLE IF EXISTS `specialized_certified_qualification`;
CREATE TABLE `specialized_certified_qualification` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `BA_No_Type` varchar(10) NOT NULL,
  `BA_No` int(11) NOT NULL,
  `Name_Of_The_Qualification` varchar(50) NOT NULL,
  `Institution_SQ` varchar(50) NOT NULL,
  `Result_SQ` varchar(50) NOT NULL,
  `Year_Of_Participation_SQ` varchar(50) NOT NULL,
  `Remarks_SQ` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

INSERT INTO `specialized_certified_qualification` (`Id`, `BA_No_Type`, `BA_No`, `Name_Of_The_Qualification`, `Institution_SQ`, `Result_SQ`, `Year_Of_Participation_SQ`, `Remarks_SQ`) VALUES
(18,	'BA',	5757,	'',	'',	'',	'',	''),
(21,	'BSS',	10452,	'KJB',	'KJB',	'KJ',	'BK',	'JBK'),
(31,	'BA',	999,	'test',	'test',	'',	'',	''),
(32,	'BA',	5555,	'sadasd',	'asdasd',	'asdasd',	'3232',	'asdsadas'),
(33,	'BA',	9281,	'CCNA',	'CISCO Academy',	'Pass',	'2014',	'NA'),
(34,	'BA',	9128,	'CCNA',	'CISCO Academy',	'Pass',	'2014',	''),
(35,	'BSS',	322232,	'Name Of The Qualification1',	'Name Of The Qualification 3',	'4.9',	'2012',	'test77'),
(36,	'BSS',	322232,	'Name Of The Qualification3',	'Name Of The Qualification4',	'5',	'2012',	'rtes88'),
(37,	'BA',	4545,	'Qualification',	'gfd',	'4.5',	'5443',	'test'),
(38,	'BA',	4545,	'Qualification',	'gfd',	'4.5',	'5443',	'test'),
(39,	'BA',	4545,	'Qualification',	'gfd',	'4.5',	'5443',	'test');

DROP TABLE IF EXISTS `specialized_certified_qualification_temp`;
CREATE TABLE `specialized_certified_qualification_temp` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `BA_No_Type` varchar(10) NOT NULL,
  `BA_No` int(11) NOT NULL,
  `Name_Of_The_Qualification` varchar(50) NOT NULL,
  `Institution_SQ` varchar(50) NOT NULL,
  `Result_SQ` varchar(50) NOT NULL,
  `Year_Of_Participation_SQ` varchar(50) NOT NULL,
  `Remarks_SQ` varchar(50) NOT NULL,
  `flag` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `specialized_certified_qualification_temp` (`Id`, `BA_No_Type`, `BA_No`, `Name_Of_The_Qualification`, `Institution_SQ`, `Result_SQ`, `Year_Of_Participation_SQ`, `Remarks_SQ`, `flag`) VALUES
(8,	'BA',	888888888,	'name',	'ins',	'2.9',	'2389',	'remark',	0);

DROP TABLE IF EXISTS `un_mission`;
CREATE TABLE `un_mission` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `BA_No_Type` varchar(10) NOT NULL,
  `BA_No` int(11) NOT NULL,
  `Mission_Name` text NOT NULL,
  `Country_UNM` text NOT NULL,
  `Year_UNM` int(11) NOT NULL,
  `Details` text NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `un_mission` (`Id`, `BA_No_Type`, `BA_No`, `Mission_Name`, `Country_UNM`, `Year_UNM`, `Details`) VALUES
(22,	'BA',	5757,	'',	'',	0,	''),
(25,	'BSS',	10452,	'K',	'JBK',	0,	'JB'),
(36,	'BA',	999,	'test',	'test',	0,	''),
(37,	'BA',	5555,	'sadasd',	'sadasd',	0,	'sadas'),
(38,	'BA',	9281,	'BANSIG',	'Mali',	2015,	'NA'),
(39,	'BA',	9298,	'BANSIG 2',	'Mali',	2018,	'NA'),
(40,	'BA',	4545,	'name1',	'country',	2015,	'test'),
(41,	'BA',	4545,	'name1',	'country',	2015,	'test'),
(42,	'BA',	4545,	'name1',	'country',	2015,	'test'),
(43,	'BA',	56757,	'mission',	'desh',	543,	'v');

DROP TABLE IF EXISTS `un_mission_temp`;
CREATE TABLE `un_mission_temp` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `BA_No_Type` varchar(10) NOT NULL,
  `BA_No` int(11) NOT NULL,
  `Mission_Name` text NOT NULL,
  `Country_UNM` text NOT NULL,
  `Year_UNM` int(11) NOT NULL,
  `Details` text NOT NULL,
  `flag` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `un_mission_temp` (`Id`, `BA_No_Type`, `BA_No`, `Mission_Name`, `Country_UNM`, `Year_UNM`, `Details`, `flag`) VALUES
(11,	'BA',	888888888,	'name',	'country',	1234,	'details',	0);

DROP TABLE IF EXISTS `usergroup`;
CREATE TABLE `usergroup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `permission` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `usergroup` (`id`, `title`, `permission`) VALUES
(1,	'Super User',	'1'),
(2,	'Lawyer',	''),
(3,	'Client',	'');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(64) NOT NULL,
  `usergroup` tinyint(1) NOT NULL,
  `status` tinyint(2) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `users` (`id`, `email`, `password`, `usergroup`, `status`, `created_date`, `modified`) VALUES
(2,	'neshmedia.test@gmail.com',	'e10adc3949ba59abbe56e057f20f883e',	2,	1,	'2015-03-02 13:40:50',	'0000-00-00 00:00:00'),
(3,	'test@test.com',	'e10adc3949ba59abbe56e057f20f883e',	2,	1,	'2015-03-02 16:23:55',	'0000-00-00 00:00:00'),
(4,	'julien@test.com',	'e10adc3949ba59abbe56e057f20f883e',	2,	1,	'2015-03-03 18:24:15',	'0000-00-00 00:00:00'),
(6,	'test2@test.com',	'e10adc3949ba59abbe56e057f20f883e',	2,	1,	'2015-03-09 17:48:21',	'0000-00-00 00:00:00'),
(7,	'admin',	'21232f297a57a5a743894a0e4a801fc3',	1,	1,	'2018-10-25 19:59:33',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `user_info`;
CREATE TABLE `user_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `phone` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `user_info` (`id`, `user_id`, `first_name`, `last_name`, `phone`) VALUES
(1,	1,	'Rafiqul',	'Islam',	'123456'),
(2,	2,	'Demo',	'Lawyer',	'1234567'),
(3,	3,	'Vincent',	'',	'123147'),
(4,	4,	'Julien',	'',	'12346'),
(6,	6,	'llk',	'jdg',	'889'),
(7,	7,	'',	'',	'');

-- 2018-11-29 09:36:10
