-- Adminer 4.2.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `educational_qualification_primary`;
CREATE TABLE `educational_qualification_primary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `BA_No` int(11) NOT NULL,
  `BA_No_Type` varchar(10) NOT NULL,
  `Qualification` text NOT NULL,
  `Institute` text NOT NULL,
  `Division_Subject` text NOT NULL,
  `Result` text NOT NULL,
  `Year_Of_Passing` text NOT NULL,
  `Any_Achivement` text NOT NULL,
  `Remarks` text NOT NULL,
  `Dir_key` text NOT NULL,
  `flag` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `educational_qualification_ibfk_1` (`BA_No_Type`,`BA_No`),
  CONSTRAINT `educational_qualification_primary_ibfk_1` FOREIGN KEY (`BA_No_Type`, `BA_No`) REFERENCES `profile_primary` (`BA_No_Type`, `BA_No`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `educational_qualification_primary` (`id`, `BA_No`, `BA_No_Type`, `Qualification`, `Institute`, `Division_Subject`, `Result`, `Year_Of_Passing`, `Any_Achivement`, `Remarks`, `Dir_key`, `flag`) VALUES
(20,	322232,	'BSS',	'r3u383',	'd4l4k4',	'84g4n4',	'w2t2y2',	'u2v2q2o2',	'54a4n4',	'o4c4k4k4',	'715454',	1),
(21,	322232,	'BSS',	'g3u383',	'd4l4k4q2',	'84g4n4q2',	'w2t2u2o2',	'u2v2q2q2',	'54a4n4q2',	'o4c4k4k4q2',	'715454',	1),
(22,	54321,	'BA',	'1515d3',	'n5s5p4t4e4s4g4o4d4',	'i5n5s4',	'4404w2',	'4424v253',	'f5s5v4',	'w5j5j4',	'874221',	1),
(23,	54321,	'BA',	'v41594',	'n5s5p4t4v2',	'i5n5s4z2',	'6404z2',	'4424v213',	'f5s5v4z2',	'w5j5j4z2',	'874221',	1),
(24,	4545,	'BA',	'p3q3l4',	'b4h4x5',	'64c406',	's2p264s2',	's2r234w2',	'34h4368254k5m5',	'm484x5k4',	'362750',	1),
(25,	4545,	'BA',	'e3q3l4',	'b4h4x5q2',	'64c406q2',	'u2p274t2',	't2r234w2',	'346406q2',	'm484x5k4u2',	'362750',	1),
(26,	56757,	'BA',	'h3v3l4',	'e4m4x5',	'94h406',	'w2u294y2',	'v2w234y2',	'64m436u2',	'n4d4r544w5d4',	'3631712',	1),
(27,	455443,	'BSS',	'u4v3g3',	'p5e4d4',	'p5c4f4',	'a413v2x2',	'940323t2w2',	'j5m4y4',	'06d4m43494t5',	'4773142',	1),
(28,	345343,	'BA',	't3q3f3',	'f4h4r4',	'a4c4u4w2',	'y2',	'w2r2x2v2',	'74h4x4w2',	'o484l484o4o5',	'6971237',	1),
(29,	345343,	'BA',	'i3q3f3',	'f4h4r4x2',	'a4c4u4x2',	'z2p213',	'w2r2x2x2',	'74h4x4x2',	'o484l484o4o574',	'6971237',	1),
(30,	4543532,	'BA',	'h3n373',	'e4e4j434',	'949434z5u2',	'w2s2m284',	'x2t2r244v2',	'64e4p4',	'n454d4e5l4o524',	'3687306',	1),
(31,	4543532,	'BA',	'b3n334',	'e4e4j474',	'9494m424',	'w2s2q2',	'w2s2q244',	'64e4p434',	'n454d4e5l4o5',	'3687306',	1),
(32,	34093,	'BSS',	't3o3a3',	'f4f4m4',	'a4a4p4',	'w2n203',	'w2p2s213',	'w2q2r243',	'o464g484z5j4',	'8022038',	1),
(33,	3409387,	'BSS',	'050573',	'm5r5j4',	'h5m5m4',	'44z3s2d4',	'3414p294',	'e5r5p494',	'v5i5d4j5n4d4',	'4033390',	1),
(34,	3409387,	'BSS',	'p40573',	'm5r5j494',	'h5m5m484',	'54',	'3414p2d4',	'e5r5p484',	'v5i5d4j5n4d4q2',	'4033390',	1),
(35,	3409376,	'BSS',	'93p3k5',	'c4g40603',	'74b436',	'x2x2a4',	'x2x29413y2u2',	'd4a4o5',	'd4d4p5',	'4864553',	1),
(36,	3409376,	'BSS',	'q3p3o4',	'e4c4p5',	'd4a4r5',	'z2x2',	'z2x2',	'd4a4',	'b4c4o5',	'4864553',	1),
(37,	2147483647,	'BSS',	'35t3g3',	'p5k4s4z2',	'k5f4v4',	'64u2y253',	'84x2z203x2',	'h5k4y4',	'y5b4m494i4',	'7195150',	1),
(38,	2147483647,	'BSS',	'x4t3c4',	'06b4s4s4',	'06b4s4s4',	'84z20313',	'94y233',	'h5k4y4y2',	'y5b4m494p4p544',	'7195150',	1),
(39,	111111,	'BA',	'u3w3b3',	'94f4',	'b4',	'z203x2',	'z203x244',	'84n4t4',	'p4e4h4e5q4h4',	'3944654',	1),
(40,	2147483647,	'BSS',	'n325g3',	'94t5s4',	'44o5v4',	'u2',	'w2a443d4',	'14t5y4',	'i4k5m4',	'3276353',	1),
(41,	2147483647,	'BSS',	'c325g3',	'94t5s494',	'm4o5',	'x2',	'w2a463d4',	'14t5y4a4',	'i4k5m474',	'3276353',	1),
(42,	2147483647,	'BSS',	't3u3e3',	'c4',	'c4q4d4x5',	'2333',	'1323',	'',	'',	'5468666',	1),
(43,	222222222,	'BA',	'351583',	'p5s5k4o4',	'k5n5n4',	'y5j5k4p4j4o4',	'56j524m4',	'h5s5q4x2',	'y5j5e4',	'5163356',	1),
(44,	888888888,	'BA',	'q335m4',	'b4i5p5',	'd4o5',	'u2',	'u26474',	'44u546',	'l4l5s584k4j4',	'5065585',	1),
(45,	564565,	'BA',	's315m4',	'e4s5y5q4a4m4q41684',	'94n516f4k4b4k4v5',	'x2',	'v2244413',	'64h516',	'',	'3712072',	1),
(46,	564565,	'BA',	'h315m4',	'e4s5y5q4a4m4q4z584u2',	'94n516w2',	'y2',	'v2244423',	'64h516w2',	'n4j5s574j4d4',	'3712072',	1);

DROP TABLE IF EXISTS `foreign_assignments_primary`;
CREATE TABLE `foreign_assignments_primary` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `BA_No_Type` varchar(5) NOT NULL,
  `BA_No` int(11) NOT NULL,
  `Assignments` text NOT NULL,
  `Assignment_Details` text NOT NULL,
  `Country` text NOT NULL,
  `From_Date_FA` date NOT NULL,
  `To_Date_FA` date NOT NULL,
  `Duration_FA` int(11) NOT NULL,
  `Remarks_FA` text NOT NULL,
  `flag` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `foreign_assignments_primary` (`Id`, `BA_No_Type`, `BA_No`, `Assignments`, `Assignment_Details`, `Country`, `From_Date_FA`, `To_Date_FA`, `Duration_FA`, `Remarks_FA`, `flag`) VALUES
(23,	'BSS',	322232,	'Training',	'assign',	'ban',	'2018-11-15',	'2018-11-24',	3,	'test6',	1),
(24,	'BSS',	322232,	'Visit',	'assign2',	'ban2',	'2018-11-15',	'2018-11-30',	9,	'test99',	1),
(25,	'BA',	54321,	'Seminar',	'assign',	'test',	'2018-11-05',	'2018-11-30',	3,	'test',	1),
(26,	'BA',	4545,	'PSI',	'assign',	'test',	'2018-11-15',	'2018-11-29',	3,	'test6',	1),
(27,	'BA',	56757,	'Course',	'test',	'test',	'2018-11-14',	'2018-11-21',	4,	'test',	1),
(28,	'BSS',	455443,	'Course',	'assign',	'rest',	'2018-11-14',	'2018-11-30',	2,	'remark',	1),
(29,	'BA',	345343,	'Training',	'assign',	'dash',	'2018-11-05',	'2018-11-23',	3,	'remarksw22',	1),
(30,	'BA',	345343,	'Seminar',	'assig3',	'dash2',	'2018-11-01',	'2018-11-30',	4,	'remarks2',	1),
(31,	'BA',	4543532,	'Training',	'assign',	'country',	'2018-11-01',	'2018-11-30',	2,	'remark',	1),
(32,	'BSS',	34093,	'Seminar',	'details',	'country',	'2018-11-05',	'2018-11-27',	0,	'remakr',	1),
(33,	'BSS',	3409387,	'Course',	'details',	'country',	'2018-11-07',	'2018-11-30',	0,	'remark3',	1),
(34,	'BSS',	3409376,	'Visit',	'jh',	'uh',	'2018-11-26',	'2018-11-12',	0,	'kjh',	1),
(35,	'BSS',	2147483647,	'PSI',	'assign',	'county',	'2018-11-21',	'2018-11-20',	0,	'remark',	1),
(36,	'BA',	111111,	'Course',	'xv',	'fd',	'2018-11-07',	'2018-11-30',	0,	'remrk',	1),
(37,	'BSS',	2147483647,	'PSI',	'assign',	'country',	'2018-11-05',	'2018-11-30',	0,	'remarkvhj',	1),
(38,	'BSS',	2147483647,	'Training',	'jh',	'hj',	'2018-11-13',	'2018-11-15',	0,	' b',	1),
(39,	'BA',	222222222,	'PSI',	'assign',	'country',	'2018-11-01',	'2018-11-16',	8,	'tre',	1),
(40,	'BA',	888888888,	'Course',	'details',	'country',	'2018-11-08',	'2018-11-30',	2,	'remak',	1),
(41,	'BA',	564565,	'Seminar',	'assign',	'country',	'2018-11-28',	'2018-11-30',	2,	'remark',	1);

DROP TABLE IF EXISTS `military_courses_primary`;
CREATE TABLE `military_courses_primary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `BA_No_Type` varchar(10) NOT NULL,
  `BA_No` int(11) NOT NULL,
  `Name_Of_The_Course` text NOT NULL,
  `Location` text NOT NULL,
  `Duration` text NOT NULL,
  `Result` text NOT NULL,
  `Year` text NOT NULL,
  `Position` text NOT NULL,
  `Any_Achivements` text NOT NULL,
  `Any_Observation_Remarks` text NOT NULL,
  `Dir_key` text NOT NULL,
  `flag` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `military_courses_ibfk_1` (`BA_No_Type`,`BA_No`),
  CONSTRAINT `military_courses_primary_ibfk_1` FOREIGN KEY (`BA_No_Type`, `BA_No`) REFERENCES `profile_primary` (`BA_No_Type`, `BA_No`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `military_courses_primary` (`id`, `BA_No_Type`, `BA_No`, `Name_Of_The_Course`, `Location`, `Duration`, `Result`, `Year`, `Position`, `Any_Achivements`, `Any_Observation_Remarks`, `Dir_key`, `flag`) VALUES
(12,	'BSS',	322232,	'i484e454',	'g4m44414k4',	'w2',	'v2t2x2',	'u2w2w2',	'o4c4k4k4p2w2',	'54a4n4r2r2',	'm4c4e4p2p2',	'715454',	1),
(13,	'BSS',	322232,	'i484e454q2',	'g4m44414k4x2',	'x2',	'w2',	'u213w2',	'o4c4k4k4t203',	'54a4n4s2s2',	'm4c4e4q2q2',	'715454',	1),
(14,	'BA',	54321,	's5f5j4e4',	'q5t594a4p4',	'44',	'3404w2',	'4444w2x2',	'y5j5p4t4',	'f5s5v4a484u4f2t2',	'w5j5j4a4n4j4x2',	'874221',	1),
(15,	'BA',	4545,	'g444r554t2',	'e4i4h514o4q5t5',	't2',	's2p274',	't2v254q2',	'm484x5k4',	'34h4368254k5m5',	'k484r514m4s554',	'362750',	1),
(16,	'BA',	56757,	'j494r584',	'h4n4h544y5b4h4s5',	'w203',	'x213',	'y20374v2',	'p4d4x5n4',	'p4d4x5l4y5',	'p4d4x5n4',	'3631712',	1),
(17,	'BA',	345343,	'k444l4c4v2',	'i4i4b484q4m5w5u5g2y2',	'x2',	'x2p213',	'w2r2x2x2',	'm4i4r4g4q4m5w5u5',	'74h4x4f274g536',	'o484l484o4o506',	'6971237',	1),
(18,	'BA',	345343,	'k444l4c4w2',	'i4i4b484q4m5w5u5y2',	'y2',	'x2p253',	'v2t2z2y2',	'm4i4r4g4q4m5w5u5y2',	'74h4x48494f594',	'o484l484o4o594',	'6971237',	1),
(19,	'BA',	4543532,	'j414d4i5',	'h4f434e5n4m5s5l4',	'x2',	'x2',	'w2s2r244v2',	'p454j4x5',	'6434m4',	'n454d4e5l4o5',	'3687306',	1),
(20,	'BSS',	34093,	'k424g4c464',	'i4g4648416h4j4f484',	'a4m4l48416h4j4f4',	'v2n2u2',	'w2p2s223',	'm4g4m4g416h4j4f4',	'7444p4x2',	'o464g484z5j4n4r2',	'8022038',	1),
(21,	'BSS',	3409387,	'r5e5d4n5u2',	'p5s534j5p4b4f4h4w2',	'h5y5i4j5p4b4f4h4f2r2',	'24z3r2',	'3414p2e4',	't5s5j4r5p4b4f4h4',	'e5r5p4q36454m4',	's5f5j4n5n4o414n4g4h4k4',	'4033390',	1),
(22,	'BSS',	3409376,	'b4c4o5g4e4',	'e4a4s5',	'd4a4o5',	'z2x2b4',	'z2w2c443',	'd4a4o5',	'g4g4j5',	'g4g4j5',	'4864553',	1),
(23,	'BSS',	3409376,	'b4c4o5x4p4l403',	'h4g4p5i4',	'e4c4s5',	'z2y2',	'03y2c443',	'e4c4p5',	'g4f4v5a4',	'd4a4p5i4',	'4864553',	1),
(24,	'BSS',	2147483647,	'u574m4d4',	's5l4c494',	'k5r4',	'64u2y253',	'64u2y243',	'w5l4s4h4r4n5s5k4',	'h5k4y4g284h5z5',	'y5b4m494p4p5',	'7195150',	1),
(25,	'BSS',	2147483647,	'u574m4d4x2',	'v594a4z2',	'k5r4z2',	'74w22303',	'74w22303y2',	'w5c4d4',	'h5k4y4',	'',	'7195150',	1),
(26,	'BA',	111111,	't4f484',	'e4f484',	'd4',	'z203x2',	'y213x244',	'r4c4',	'a4c474',	't4d4n4',	'3944654',	1),
(27,	'BSS',	2147483647,	'e4g5m4m5',	'a4n5h436',	'4406t4',	'u294',	'v29433c4u2',	'g4u5s4',	'14t5y4',	'i4k5m4i5i4s5',	'3276353',	1),
(28,	'BA',	888888888,	'h4h5s5c4',	'f4v5i584m4h4w5j4',	't244',	'v274',	'v27484',	'j4v5y5g4m4h4w5j4',	'44j516',	'l4l5s584k4j4',	'5065585',	1),
(29,	'BA',	564565,	'j4f5s5b4',	'h4t5i5p4',	'v2',	'v244',	'v2244403',	'l4t5y5f4l4h4j4',	'',	'n4j5s574j4d4',	'3712072',	1);

DROP TABLE IF EXISTS `officer_skills_primary`;
CREATE TABLE `officer_skills_primary` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `BA_No_Type` varchar(10) NOT NULL,
  `BA_No` int(11) NOT NULL,
  `Communication_Topic` text NOT NULL,
  `Transmission_System_Topic` text NOT NULL,
  `Programming_Language_Topic` text NOT NULL,
  `Database_Management_System_Topic` text NOT NULL,
  `Server_Management_Topic` text NOT NULL,
  `Networking_Topic` text NOT NULL,
  `Digital_Forensic_Topic` text NOT NULL,
  `Cyber_Security_Topic` text NOT NULL,
  `SIGINT_Topic` text NOT NULL,
  `Power_Energy_Topic` text NOT NULL,
  `Reverse_Engineering_Topic` text NOT NULL,
  `flag` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

INSERT INTO `officer_skills_primary` (`Id`, `BA_No_Type`, `BA_No`, `Communication_Topic`, `Transmission_System_Topic`, `Programming_Language_Topic`, `Database_Management_System_Topic`, `Server_Management_Topic`, `Networking_Topic`, `Digital_Forensic_Topic`, `Cyber_Security_Topic`, `SIGINT_Topic`, `Power_Energy_Topic`, `Reverse_Engineering_Topic`, `flag`) VALUES
(22,	'BSS',	322232,	'Cellular Communication,SAT Communication',	'Optical Fibre Transmission',	'PHP,ASP,JAVA',	'MySqli,Oracle',	'Windows Server',	'CCIE(Cisco)',	'CMI',	'CISA',	'COMMINT',	'Renewable Energy',	'Hardware Reverse Engineering,',	1),
(23,	'BA',	54321,	'Combat Communication,Cellular Communication',	'',	'',	'MySqli,Oracle',	'',	'',	'',	'',	'',	'Solar Energy',	'Hardware Reverse Engineering,',	1),
(24,	'BA',	4545,	'Combat Communication,SAT Communication',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	1),
(25,	'BA',	56757,	'',	'',	'ASP,Android',	'',	'',	'',	'',	'',	'',	'',	'',	1),
(26,	'BSS',	455443,	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	1),
(27,	'BA',	345343,	'Combat Communication,SAT Communication',	'Optical Fibre Transmission',	'ASP,Android',	'',	'',	'',	'',	'',	'',	'',	'',	1),
(28,	'BA',	4543532,	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	1),
(29,	'BSS',	34093,	'Combat Communication,Cellular Communication',	'Optical Fibre Transmission',	'C/C++/C#,PHP',	'MySqli',	'',	'',	'',	'',	'',	'',	'Reverse Logistics Data Analyst,',	1),
(30,	'BSS',	3409387,	'Combat Communication,SAT Communication',	'Optical Fibre Transmission',	'ASP,JAVA',	'',	'',	'',	'',	'',	'',	'',	'',	1),
(31,	'BSS',	3409376,	'Cellular Communication',	'Soft-Switched Telephony',	'Android',	'SQL',	'',	'',	'',	'',	'',	'',	'',	1),
(32,	'BSS',	2147483647,	'Combat Communication',	'Optical Fibre Transmission',	'C/C++/C#,ASP,Android',	'SQL,MySqli',	'',	'',	'',	'',	'',	'',	'',	1),
(33,	'BA',	111111,	'',	'',	'PHP,JAVA,Android',	'',	'',	'',	'',	'',	'',	'',	'',	1),
(34,	'BSS',	2147483647,	'Combat Communication,Cellular Communication',	'Optical Fibre Transmission',	'C/C++/C#,PHP,ASP',	'SQL,MySqli',	'Windows Server',	'CCNP(Cisco',	'CMI',	'CISA',	'COMMINT',	'Solar Energy',	'Hardware Reverse Engineering,',	1),
(35,	'BSS',	2147483647,	'Cellular Communication',	'Optical Fibre Transmission',	'C/C++/C#',	'MySqli',	'Linux Server',	'CCNA(Cisco)',	'CMI',	'CEH',	'EW',	'Solar Energy',	'Reverse Logistics Data Analyst,',	1),
(36,	'BA',	222222222,	'Cellular Communication',	'Optical Fibre Transmission',	'ASP',	'MySqli',	'Windows Server',	'CCNP(Cisco',	'CFS',	'CISA',	'COMMINT',	'Solar Energy',	'Hardware Reverse Engineering,',	1),
(37,	'BA',	888888888,	'Microwave Communication',	'',	'JAVA',	'SQLite',	'',	'CCNP(Cisco',	'CMI',	'CEH',	'',	'Renewable Energy',	'',	1),
(38,	'BA',	564565,	'Cellular Communication',	'Optical Fibre Transmission',	'C/C++/C#',	'SQL',	'Linux Server',	'CCNA(Cisco)',	'CMI',	'CEH',	'EW',	'Solar Energy',	'Reverse Logistics Data Analyst,',	1);

DROP TABLE IF EXISTS `profile_primary`;
CREATE TABLE `profile_primary` (
  `BA_No_Type` varchar(10) NOT NULL,
  `BA_No` int(11) NOT NULL,
  `Name` text NOT NULL,
  `Rank` text NOT NULL,
  `Course_Type` text NOT NULL,
  `Course` text NOT NULL,
  `Present_Posting` text NOT NULL,
  `Contact_No` text NOT NULL,
  `Email` text NOT NULL,
  `First_Choice` text NOT NULL,
  `Second_Choice` text NOT NULL,
  `Image` text NOT NULL,
  `Dir_Comment` text NOT NULL,
  `flag` int(11) NOT NULL DEFAULT '0',
  `Dir_Key` text NOT NULL,
  PRIMARY KEY (`BA_No_Type`,`BA_No`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `profile_primary` (`BA_No_Type`, `BA_No`, `Name`, `Rank`, `Course_Type`, `Course`, `Present_Posting`, `Contact_No`, `Email`, `First_Choice`, `Second_Choice`, `Image`, `Dir_Comment`, `flag`, `Dir_Key`) VALUES
('BA',	4545,	'k344i594h4',	'i3n4',	'8383',	'u2w264t2',	'm484x5k4',	'q2s294s2w2e434q2y2x2b4',	'g444i594h4p5t5l4l4c4w5x2b3f4d424m5s5u2j5w5q5',	'Digital Forensic',	'',	'1542377585.jpg',	'362750',	1,	''),
('BA',	54321,	's5f5a4i4i4',	'u4y5',	'k4j4',	'7464x2z2u2',	'k5n5k4a4h4s4c4m4s4',	'24341313x253w2r243x2y2',	's5f5a4i4i4g4m4m4r4c4j48463n5k424m5s5r2k5g4m4',	'Cyber Security',	'',	'1542373975.jpg',	'874221',	1,	''),
('BA',	56757,	'n394i5c4r5',	'l3s4',	'b3d3',	'y22394w294',	'p4d4x5n4',	'y22374v284v2u2',	'j494i5c4r5a4h4x5q4j5j4235384t514p5i4m264w5f4',	'Cyber Security',	'',	'',	'3631712',	1,	''),
('BA',	111111,	'l4a484m5l4',	'n3t4',	'd3e3',	'w2y2t224x2v2',	'n4r494w5s4',	'1323w27413y2',	'l4a484m5l4e4n416r4j5v56453m5v52494d4n234h4f4',	'Cyber Security',	'',	'1542476941.jpg',	'',	1,	'3944654'),
('BA',	345343,	'o344c4g4j4l3t4v5r4s4l5j4',	'm3n4',	'c383',	'x2v213y2y244',	'm4i4r4r4f4r5o5',	'u2s233z2y2a4644443z294',	'k444c4g4j4l5w5z5r4e4u5y2k4g4g454h4i4v2a4o4i4',	'Reverse Engineering',	'',	'1542429931.jpg',	'6971237',	1,	''),
('BA',	564565,	'n3f5j5f4e4a2h3w5m4n4a4t5',	'l3y5',	's3u5r5',	'y26484y2u2',	'l4t5y5q4a4g4c4',	't234a4y2t2z2u254z2u2y2',	'j4f5j5f4e4a4k406m494j4845394m4i5m5f4m2a4m4u5',	'Microwave Communication',	'',	'1542602183.jpg',	'',	1,	'3712072'),
('BA',	4543532,	'',	'l3k4',	'b353',	'x2t2s244w24434',	'',	'',	'j41444m5g4l5s5q4z554f4648394i494q5r5z344i4u5',	'Combat Communication',	'',	'',	'',	1,	''),
('BA',	222222222,	'u5f554d4k4',	'w4y5',	'm4j4',	'6444r2u2x2u2q2r284',	'w5t5k4o4g4i474',	'a474w2y203z2u2u2d4',	'u5f554d4k4c4f4k41694n4w2c3a4r5g5c4i4u2k5s5v5',	'Programming & Database Management',	'',	'1542479129.png',	'',	1,	'5163356'),
('BA',	888888888,	'',	'j306',	'j334m4',	'u264a4z2s2z2d403',	'',	'',	'h4h5j5g4f4g4w5o4m4d4n4t243f4m4g5d4l4v244u5f4',	'Reverse Engineering',	'',	'',	'',	1,	'5065585'),
('BSS',	34093,	'o32474g4u5g2g3g416p454w5',	'm3l4',	'c3o3q3',	'x2t2r24384',	'',	'',	'k42474g4u5g4j4k416b4e4b4d3b4i4i5r5l44454k4l4',	'Programming & Database Management',	'',	'1542472760.png',	'test',	1,	''),
('BSS',	322232,	'i4845494d4',	'k3r4',	'a3u3o3',	'v2x2r2q2r2x2',	'o4c4k4k4',	'x223u2u2v20394x2u2w2b4',	'i4845494d4f4u5l4k474u50343a4h4f5b4q504j5k4u5',	'Reverse Engineering',	'Soft-Switched Telephony',	'1542369296.jpg',	'715454',	1,	''),
('BSS',	455443,	'w594d4b4h4',	'y4s4',	'o4v3w3',	'a41323u2w294',	'26d4s4m4',	'a42323u2y2b454',	'w594d4b4h4q5s5s4w5c4n4y283l5q564h4h4r294w5e4',	'Reverse Engineering',	'',	'',	'4773142',	1,	''),
('BSS',	3409376,	'h434l5h4h492d4t506o454v5',	'j3m4',	'93p345',	'u2u25453v2',	'j4k4m5o4j4k4p4n5v5c4',	'y2v2c423x2v203',	'h434l5h4h494k4x506a4e4a493k5g474i4p5z354w5i4',	'Cyber Security',	'',	'1542475236.png',	'',	1,	''),
('BSS',	3409387,	'r5e544r5i4a284i4q4l4b4u5',	't4x5',	'j405n3',	'4454o2f4w2',	't5v55416a4g4k4',	'a494t2d4w2z2w2',	'r5e544r5i4a4f4m4q474k494m4k5s5h5h4g4n2a4i4r5',	'Cyber Security',	'',	'1542474344.png',	'',	1,	''),
('BSS',	2147483647,	'y474d4h4k4',	'w4q4',	'm4t3w3',	'74y2x253y2',	'w5l4s4s4g4t5r5',	'a4z2132323745413',	'u574d4h4k4m5s5p4y5m5j46463l5m4i594i424a4x5e4',	'Soft-Switched Telephony',	'',	'1542476030.png',	'',	1,	'7195150');

DROP TABLE IF EXISTS `publications_articles_thesis_projects_primary`;
CREATE TABLE `publications_articles_thesis_projects_primary` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `BA_No_Type` varchar(10) NOT NULL,
  `BA_No` int(11) NOT NULL,
  `Name_Of_The_Topic` text NOT NULL,
  `Publishing_Authority` text NOT NULL,
  `Abstract` text NOT NULL,
  `Year_Of_Passing_PP` text NOT NULL,
  `Remarks_PP` text NOT NULL,
  `flag` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `publications_articles_thesis_projects_primary` (`Id`, `BA_No_Type`, `BA_No`, `Name_Of_The_Topic`, `Publishing_Authority`, `Abstract`, `Year_Of_Passing_PP`, `Remarks_PP`, `flag`) VALUES
(4,	'BSS',	322232,	'Name Of The Topic',	'pub',	'abs4',	'2013',	'testvbbc',	1),
(5,	'BSS',	322232,	'Name Of The Topic',	'pyb5',	'abs5',	'45353',	'testgtg',	1),
(6,	'BA',	54321,	'test',	'test',	'abst',	'3242',	'test',	1),
(7,	'BA',	4545,	'gdf',	'gdf',	'gfd',	'543',	'gds',	1),
(8,	'BA',	56757,	'Name Of The Topic',	'test',	'test',	'54654',	'test',	1),
(9,	'BSS',	455443,	'Name Of The Topic',	'pub',	'asb3',	'abs7',	'remark',	1),
(10,	'BA',	345343,	'Name Of The Topic',	'Publishing Authority',	'abs',	'3422',	'remarks2',	1),
(11,	'BSS',	3409387,	'mae',	'pub',	'abs',	'2017',	'remark',	1),
(12,	'BSS',	3409376,	'kjh',	'nkjb',	'jk',	'876',	'njk',	1),
(13,	'BSS',	2147483647,	'fdgfd',	'gdf',	'abd',	'6546',	'gfd',	1),
(14,	'BA',	111111,	'gfgdf',	'sdg',	'gf',	'5445',	'vg',	1),
(15,	'BSS',	2147483647,	'name4',	'authoabs',	'abs',	'675567',	'ghgf',	1),
(16,	'BA',	888888888,	'name',	'pos',	'abs',	'87',	'hdhgf',	1);

DROP TABLE IF EXISTS `specialized_certified_qualification_primary`;
CREATE TABLE `specialized_certified_qualification_primary` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `BA_No_Type` varchar(10) NOT NULL,
  `BA_No` int(11) NOT NULL,
  `Name_Of_The_Qualification` text NOT NULL,
  `Institution_SQ` text NOT NULL,
  `Result_SQ` text NOT NULL,
  `Year_Of_Participation_SQ` text NOT NULL,
  `Remarks_SQ` text NOT NULL,
  `flag` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

INSERT INTO `specialized_certified_qualification_primary` (`Id`, `BA_No_Type`, `BA_No`, `Name_Of_The_Qualification`, `Institution_SQ`, `Result_SQ`, `Year_Of_Participation_SQ`, `Remarks_SQ`, `flag`) VALUES
(4,	'BSS',	322232,	'Name Of The Qualification1',	'Name Of The Qualification 3',	'4.9',	'2012',	'test77',	1),
(5,	'BSS',	322232,	'Name Of The Qualification3',	'Name Of The Qualification4',	'5',	'2012',	'rtes88',	1),
(6,	'BA',	54321,	'Name Of The Qualification',	'inName Of The Qualification',	'2.9',	'2018',	'test',	1),
(7,	'BA',	4545,	'Qualification',	'gfd',	'4.5',	'5443',	'test',	1),
(8,	'BA',	345343,	'Name Of The Qualification3',	'institire',	'34',	'4533',	'remarks2',	1),
(9,	'BA',	345343,	'Name Of The Qualification3',	'insti7',	'323',	'4544',	'remark8',	1),
(10,	'BSS',	2147483647,	'name4',	'instite',	'56556',	'7665',	'remarjk',	1),
(11,	'BA',	888888888,	'name',	'ins',	'2.9',	'2389',	'remark',	1);

DROP TABLE IF EXISTS `un_mission_primary`;
CREATE TABLE `un_mission_primary` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `BA_No_Type` varchar(10) NOT NULL,
  `BA_No` int(11) NOT NULL,
  `Mission_Name` text NOT NULL,
  `Country_UNM` text NOT NULL,
  `Year_UNM` text NOT NULL,
  `Details` text NOT NULL,
  `flag` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `un_mission_primary` (`Id`, `BA_No_Type`, `BA_No`, `Mission_Name`, `Country_UNM`, `Year_UNM`, `Details`, `flag`) VALUES
(7,	'BSS',	322232,	'missn',	'testuy',	'2018',	'testyy',	1),
(8,	'BSS',	322232,	'missn',	'testh',	'2423',	'tast',	1),
(9,	'BA',	54321,	'mission',	'vasds',	'2017',	'details',	1),
(10,	'BA',	4545,	'name1',	'country',	'2015',	'test',	1),
(11,	'BA',	56757,	'mission',	'desh',	'543',	'v',	1),
(12,	'BA',	345343,	'mission',	'country2',	'2017',	'details',	1),
(13,	'BA',	345343,	'mission2',	'country4',	'2016',	'details3',	1),
(14,	'BSS',	34093,	'mission 2',	'country',	'2016',	'details',	1),
(15,	'BSS',	3409376,	'mjh',	'nb',	'786',	'mnb',	1),
(16,	'BSS',	2147483647,	'name',	'countre',	'8968',	'details',	1),
(17,	'BA',	888888888,	'name',	'country',	'1234',	'details',	1);

-- 2018-11-29 09:36:39
