-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 02, 2020 at 06:43 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bankgojz_bov_site`
--

-- --------------------------------------------------------

--
-- Table structure for table `admininfo`
--

DROP TABLE IF EXISTS `admininfo`;
CREATE TABLE IF NOT EXISTS `admininfo` (
  `nf_ID` int(11) NOT NULL AUTO_INCREMENT,
  `nf_Date` date NOT NULL,
  `nf_Class` int(11) NOT NULL,
  `nf_Title` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `nf_Content` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `nf_Photo` varchar(200) DEFAULT NULL,
  `nf_WritingUserID` int(11) NOT NULL,
  `nf_EditingUserID` int(11) DEFAULT NULL,
  `nf_Active` tinyint(1) NOT NULL,
  `nf_AdminUserID` int(11) DEFAULT NULL,
  PRIMARY KEY (`nf_ID`),
  KEY `nf_WritingUserID` (`nf_WritingUserID`),
  KEY `nf_EditingUserID` (`nf_EditingUserID`),
  KEY `DeActivatingAdminWithInfo` (`nf_AdminUserID`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admininfo`
--

INSERT INTO `admininfo` (`nf_ID`, `nf_Date`, `nf_Class`, `nf_Title`, `nf_Content`, `nf_Photo`, `nf_WritingUserID`, `nf_EditingUserID`, `nf_Active`, `nf_AdminUserID`) VALUES
(1, '2019-08-17', 0, 'بنك المتطوعين', 'هو منظمة مجتمع مدني طوعية تأسس في مايو 2017م يسعى من خلال الاستراتيجيات المرسومة والرؤى والأهداف لإيجاد بيئة تطوعية أمثل وأكثر تنظيمًا تعمل على إرساء القيم التطوعية بشكلها الحقيقي، كما يساهم البنك في ابراز الجانب المهني والعملي والاجتماعي للتطوع من خلال نهج البنك المتبع في بناء الشراكات والمنصات التي يتيحها البنك في بناء القدرات والاستشارات للمتطوعين. ', NULL, 1, NULL, 1, NULL),
(2, '2019-08-17', 1, 'الأكثر فاعلية وذكاء في إدارة العمل التطوعي', NULL, NULL, 1, NULL, 1, NULL),
(3, '2019-08-17', 2, NULL, 'نعمل على إعادة ابتكار العمل التطوعي وترسيخه كثقافة تنموية في المجتمعات. من أجل ذلك، فإننا نقدم طرقاً ومعايير إبداعية لتنسيق وإدارة العمل التطوعي وبما يسهم في تعزيز كفاءة عملياته ومخرجاته ليكون قادراً على المساهمة في العمل التنموي. نحرص كثيراً ومن خلال تكنلوجيا تفاعلية وفريق عمل محترف ومبتكر على مساعدة شركاء التنمية من الاستفادة من المتطوعين بمختلف مجالاتهم التخصصية وأينما كانوا.', NULL, 1, NULL, 1, NULL),
(4, '2019-08-17', 3, 'بناء قاعدة بيانات للمتطوعين لتنسيق وتنظيم العمل التطوعي.', NULL, NULL, 1, NULL, 1, 1),
(5, '2019-08-17', 3, 'المساهمة في رفع قدرات المتطوعين في العمل المجتمعي والاستجابة الإنسانية والتنمية المستدامة.', NULL, NULL, 1, NULL, 1, NULL),
(6, '2019-08-17', 3, 'تعزيز فكر وجودة العمل التطوعي بين افراد المجتمع وتشجيعهم لاستثمار مهاراتهم واوقات فراغهم لخدمة الاخرين والوصول الى 5000 متطوع متفاعل', NULL, NULL, 1, NULL, 1, NULL),
(7, '2019-08-17', 3, 'تنظيم العمل التطوعي في إطار مؤسسي يضمن تحقيق اعلى مستوى من التكافل الاجتماعي.', NULL, NULL, 1, NULL, 1, NULL),
(8, '2019-08-17', 3, 'توحيد مواثيق التطوع والعمل مع الشركاء.', NULL, NULL, 1, NULL, 0, 1),
(9, '2019-08-17', 3, 'ادماج النوع الاجتماعي في العمل التطوعي بنسبة لا تقل عن 30%.', NULL, NULL, 1, NULL, 1, NULL),
(10, '2019-08-17', 3, 'ابراز اليمن من خلال رفع مستوى العمل التطوعي والإنساني على المستوى الإقليمي والدولي.', NULL, NULL, 1, NULL, 1, NULL),
(11, '2019-08-17', 3, 'المساهمة في إيجاد مظلة آمنة للمتطوعين.', NULL, NULL, 1, NULL, 1, NULL),
(12, '2019-08-17', 4, 'الإلتزام', 'الإلتزام هو القيمة الأساس التي يقوم عليها العمل التطوعي المثمر، ولذا فنحن ملتزمون بتحقيق رسالة البنك.', NULL, 1, NULL, 1, NULL),
(13, '2019-08-17', 4, 'المبادرة', 'كمتطوعين، فإننا نبادر دائماً من أجل إحداث أثر إيجابي في حياة مجتمعاتنا وبلا تردد.', NULL, 1, NULL, 1, NULL),
(14, '2019-08-17', 4, 'التطوع', 'التطوع قيمة تجمعنا، ونؤمن  بأنها المحرك الحقيقي للتنمية في أي مجتمع.', NULL, 1, NULL, 1, NULL),
(15, '2019-08-17', 4, 'العمل كفريق', 'نحن نعمل معاً بروح الفريق من أجل تمكين ثقافة التطوع في المجتمعات.', NULL, 1, NULL, 1, NULL),
(16, '2019-08-17', 4, 'الشراكة', 'العمل التطوعي يستفيد منه الجميع بلا إستثناء، ولذا فنحن نعمل مع الجميع وفي إطار شراكات بناءة.', NULL, 1, NULL, 1, NULL),
(17, '2019-08-17', 6, 'عبدالرحمن الكازمي', 'مجلس اعلى', '17_2019-08-17.jpg', 1, 1, 1, NULL),
(18, '2019-08-17', 6, 'راغد العبسي', '', '18_2019-08-17.jpg', 1, 1, 0, 1),
(19, '2019-08-17', 5, 'مجد الدهمشي', 'امناء', '19_2019-08-17.jpg', 1, 1, 1, 1),
(20, '2019-08-18', 8, 'عنوان مع الصورة', 'هيكل', '20_2019-08-18.jpg', 1, 1, 1, NULL),
(21, '2019-10-05', 5, 'hello omnaa', NULL, '21_2019-10-05.jpg', 1, NULL, 1, NULL),
(22, '2019-10-10', 7, 'محمد الجمحي', 'تنفذية', '22_2019-10-10.jpg', 1, 1, 1, NULL),
(23, '2019-10-10', 9, 'بنك الدواء اليمني', 'شركاء', '23_2019-10-10.jpg', 1, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `adminpost`
--

DROP TABLE IF EXISTS `adminpost`;
CREATE TABLE IF NOT EXISTS `adminpost` (
  `po_ID` int(11) NOT NULL AUTO_INCREMENT,
  `po_Title` varchar(100) CHARACTER SET utf8 NOT NULL,
  `po_WritingUserID` int(11) NOT NULL,
  `po_EditingUserID` int(11) DEFAULT NULL,
  `po_Date` datetime DEFAULT NULL,
  `po_Photo` varchar(200) DEFAULT NULL,
  `po_Content` varchar(1250) CHARACTER SET utf8 NOT NULL,
  `po_Active` tinyint(1) NOT NULL DEFAULT '1',
  `po_AdminUserID` int(11) DEFAULT NULL,
  PRIMARY KEY (`po_ID`),
  KEY `po_WritingUserID` (`po_WritingUserID`),
  KEY `po_EditingUserID` (`po_EditingUserID`),
  KEY `DeActivatingAdminWithPost` (`po_AdminUserID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminpost`
--

INSERT INTO `adminpost` (`po_ID`, `po_Title`, `po_WritingUserID`, `po_EditingUserID`, `po_Date`, `po_Photo`, `po_Content`, `po_Active`, `po_AdminUserID`) VALUES
(1, 'تدريب في المهارات الشخصية', 1, NULL, '2019-08-15 09:09:00', NULL, 'مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعَا طبيعيَا -إلى حد ما- للأحرف عوضًا عن استخدام \"هنا يوجد محتوى نصي، هنا يوجد محتوى نصي\" فتجعلها تبدو )أي الأحرف( وكأنها في أي محرك \"lorem ipsum\" نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل إفتراضي كنموذج عن النص، وإذا قمت بإدخال بحث ستظهر العديد من المواقع الحديثة العهد في نتائج البحث. على مدى السنين ظهرت نسخ جديدة ومختلفة من نص لوريم إيبسوم، أحيانًا عن طريق الصدفة، وأحيانًا عن عمد .كإدخال بعض العبارات الفكاهية إليها.', 1, NULL),
(2, 'Lorem ipsum EDITING dolor', 2, 2, '2019-08-14 06:20:17', '2_2019-08-16.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex eEDITINGa commodo consequat.', 1, 1),
(3, 'لمذا نحن هنا ?', 1, 1, '2019-08-16 00:00:00', '3_2020-09-11.jpeg', 'لتطوير الموقع', 1, 1),
(4, 'منشور جديد للبنك !', 1, 1, '2019-08-16 00:00:00', '', 'هنا محتوى المنشور الكبير الذي يتسع لعدد 1250 حرف ولا يمكن الزيادة عن ذلك بسبب الاكواد التي تم كتابتها بواسطة المخترفين لكي تكون مصادقة مع المستخدم وتقوم بالتحقق من كل البيانات المدخلة من قبل جميع المستخدمين لتجنب كافة الاخطاء.', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `adminuser`
--

DROP TABLE IF EXISTS `adminuser`;
CREATE TABLE IF NOT EXISTS `adminuser` (
  `au_ID` int(11) NOT NULL AUTO_INCREMENT,
  `au_UserName` varchar(70) CHARACTER SET utf8 NOT NULL,
  `au_Password` varchar(251) CHARACTER SET utf8 NOT NULL,
  `au_AccCreatedIn` date NOT NULL,
  `au_Authentication` varchar(700) NOT NULL,
  `auCreatedBy` int(11) NOT NULL,
  `au_AccActive` tinyint(1) NOT NULL,
  PRIMARY KEY (`au_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminuser`
--

INSERT INTO `adminuser` (`au_ID`, `au_UserName`, `au_Password`, `au_AccCreatedIn`, `au_Authentication`, `auCreatedBy`, `au_AccActive`) VALUES
(1, 'Admin', '$2y$10$pBVLthevdeQHhWhS6XmE6O0s8FMMJ/ho2DlRYX8uiLLbkSnuiSrQe', '2019-05-20', 'stopAgAcc=1,activeAgAcc=1,editAgAcc=1,stopAgPostChance=1,activeAgPostChance=1,stopChnApp=1,activeChnApp=1,stopVlAcc=1,activeVlAcc=1,editVlAcc=1,stopAdminAcc=1,activeAdminAcc=1,addAdminAcc=1,editAdminAcc=1,addPosts=1,editPosts=1,stopPost=1,activePost=1,editOtherUserPost=1,addBankInf=1,editBankInf=1,stopBankInf=1,activeBankInf=1,superUser=1', 0, 1),
(2, 'majd', '$2y$10$N4lNDk/VX01.mIKDRey5TeNNHIxUN96wSamc2gM4JHYWPyBpCEbya', '2019-08-15', 'stopAgAcc=1,activeAgAcc=1,editAgAcc=0,stopAgPostChance=0,activeAgPostChance=0,stopChnApp=0,activeChnApp=0,stopVlAcc=0,activeVlAcc=0,editVlAcc=0,stopAdminAcc=0,activeAdminAcc=1,addAdminAcc=0,editAdminAcc=0,addPosts=0,editPosts=0,stopPost=0,activePost=0,editOtherUserPost=0,addBankInf=0,editBankInf=0,stopBankInf=0,activeBankInf=0,superUser=0', 1, 1),
(3, 'Ali', '$2y$10$Opf7hzughep.uYGsJQkmX.H6a9OiLl8/cICRzdrP38dMmoAPD7gx2', '2019-08-15', 'superUser=0,', 1, 1),
(4, 'Nawar', '$2y$10$TadDV0EhLQ51qERTTsva2.IGRKk29Bf4/zWJtIEpDaexObe5mhsry', '2019-08-15', 'stopAgAcc=1,activeAgAcc=0,editAgAcc=0,stopAgPostChance=0,activeAgPostChance=1,stopChnApp=0,activeChnApp=0,stopVlAcc=0,activeVlAcc=0,editVlAcc=0,stopAdminAcc=0,activeAdminAcc=0,addAdminAcc=0,editAdminAcc=0,addPosts=1,editPosts=1,stopPost=0,activePost=0,editOtherUserPost=0,addBankInf=0,editBankInf=0,stopBankInf=1,activeBankInf=0,superUser=0', 1, 1),
(5, 'High Low', '$2y$10$v8iaAmmRQHSLyMvBGfizauq7bJEnPDc3SuMH0DczOVgiktD9Sad8u', '2019-08-15', 'stopAgAcc=1,activeAgAcc=0,stopVolAcc=1,activeVolAcc=0,stopAdminAcc=0,activeAdminAcc=1,addAdminAcc=0,editAdminAcc=0,stopChnApp=0,activeChnApp=0,addPosts=0,editPosts=0,editOtherUserPost=0,addBankInf=0,editBankInf=0,superUser=0,stopAgPostChance=0,activeAgPostChance=1', 1, 1),
(6, 'Hello There', '$2y$10$vhoY2YFUDGcHMF5m0H96G.8r0XsnzZUMtIE6F8M9T2CndPo5MtS4O', '2019-08-18', 'stopAgAcc=1,activeAgAcc=0,editAgAcc=0,stopAgPostChance=1,activeAgPostChance=0,stopChnApp=1,activeChnApp=0,stopVlAcc=1,activeVlAcc=0,editVlAcc=0,stopAdminAcc=1,activeAdminAcc=0,addAdminAcc=0,editAdminAcc=0,addPosts=0,editPosts=0,editOtherUserPost=1,addBankInf=0,editBankInf=0,superUser=0', 1, 0),
(7, 'abd', '$2y$10$7L0K9QjLczKrDwT0CMrSF.wsUHSRrt9Lg/l44h46uYopgj7Y9agye', '2019-08-18', 'stopAgAcc=0,activeAgAcc=1,editAgAcc=0,stopAgPostChance=0,activeAgPostChance=0,stopChnApp=0,activeChnApp=0,stopVlAcc=0,activeVlAcc=0,editVlAcc=0,stopAdminAcc=0,activeAdminAcc=0,addAdminAcc=0,editAdminAcc=0,addPosts=0,editPosts=0,stopPost=0,activePost=0,editOtherUserPost=0,addBankInf=0,editBankInf=0,stopBankInf=0,activeBankInf=0,superUser=0', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `agency`
--

DROP TABLE IF EXISTS `agency`;
CREATE TABLE IF NOT EXISTS `agency` (
  `ag_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ag_Name` varchar(70) CHARACTER SET utf8 NOT NULL,
  `ag_Appreviation` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ag_Password` varchar(100) CHARACTER SET utf8 NOT NULL,
  `ag_Photo` varchar(100) DEFAULT NULL,
  `ag_AccCreatedIn` date NOT NULL,
  `ag_Type` int(11) NOT NULL,
  `ag_Class` int(11) NOT NULL,
  `ag_Specialty` int(11) NOT NULL,
  `ag_PhoneNumber` int(25) NOT NULL,
  `ag_Email` varchar(50) NOT NULL,
  `ag_Branch` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `ag_Address` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `ag_SocialLinks` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `ag_AccActive` tinyint(1) NOT NULL,
  `ag_CanAddChance` tinyint(1) NOT NULL,
  `ag_AdminUserID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ag_ID`),
  KEY `ag_AdminUserID` (`ag_AdminUserID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agency`
--

INSERT INTO `agency` (`ag_ID`, `ag_Name`, `ag_Appreviation`, `ag_Password`, `ag_Photo`, `ag_AccCreatedIn`, `ag_Type`, `ag_Class`, `ag_Specialty`, `ag_PhoneNumber`, `ag_Email`, `ag_Branch`, `ag_Address`, `ag_SocialLinks`, `ag_AccActive`, `ag_CanAddChance`, `ag_AdminUserID`) VALUES
(1, 'UnitedNations', 'UN', '$2y$10$7Tu7kHqYoNzklaM95BunLuce.5sQNN3yOtR7dHegXxoCCy9l1T58G', 'UnitedNations_2020-09-14.jpeg', '2019-06-13', 0, 0, 3, 16174380, 'unitedNations@yahoo.com', 'dubi', 'شارع الستين - مركز  الاعمال اليمني', 'kfacebook.com/kaiianInitiative', 1, 1, 1),
(2, 'Unicef', 'UNF', '$2y$10$m6Hb5PMou3UxGievAGt3JObR0nXfBKgpfJKvfl6TpHwS/Bb3Iv3aK', 'KaiianInitiative_2019-08-07.jpg', '2019-06-13', 0, 0, 2, 651847987, 'unicef@yahoo.com', 'لا توجد لدينا اي فروع', 'شارع الستين - مركز نادي الاعمال اليمني', 'facebook.com/kaiianInitiative', 1, 1, 1),
(7, 'world food program', 'WFP', '$2y$10$IhP0HBjbNWoTCuB.TscIK..hGOCW4NT7UEFEzkwokgzwWQ914/MVy', 'agencyDefault.jpg', '2020-09-12', 0, 0, 3, 1617438, 'wfp@gmail.com', 'Adin', 'Sanaa', '', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `chance`
--

DROP TABLE IF EXISTS `chance`;
CREATE TABLE IF NOT EXISTS `chance` (
  `ch_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ch_agcID` int(11) NOT NULL,
  `ch_Title` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `ch_Type` int(11) NOT NULL,
  `ch_VolCapacity` int(11) NOT NULL,
  `ch_StartAt` date NOT NULL,
  `ch_EndAt` date NOT NULL,
  `ch_Location` int(11) DEFAULT NULL,
  `ch_Payment` tinyint(1) NOT NULL,
  `ch_Task` varchar(1250) CHARACTER SET utf8 DEFAULT NULL,
  `ch_PostedIn` date NOT NULL,
  `ch_Deadline` date NOT NULL,
  `ch_Terms` varchar(1250) CHARACTER SET utf8 DEFAULT NULL,
  `ch_Note` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `ch_FileLink` varchar(250) DEFAULT NULL,
  `ch_WorkField` int(11) NOT NULL,
  `ch_WorkSpecialty` int(11) NOT NULL,
  `ch_ActiveApply` tinyint(1) NOT NULL,
  `ch_AdminUserID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ch_ID`),
  KEY `ch_agcID` (`ch_agcID`),
  KEY `ch_AdminUserID` (`ch_AdminUserID`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chance`
--

INSERT INTO `chance` (`ch_ID`, `ch_agcID`, `ch_Title`, `ch_Type`, `ch_VolCapacity`, `ch_StartAt`, `ch_EndAt`, `ch_Location`, `ch_Payment`, `ch_Task`, `ch_PostedIn`, `ch_Deadline`, `ch_Terms`, `ch_Note`, `ch_FileLink`, `ch_WorkField`, `ch_WorkSpecialty`, `ch_ActiveApply`, `ch_AdminUserID`) VALUES
(3, 1, 'ارشاد وتوعية', 1, 5, '2019-09-19', '2021-09-27', 4, 1, 'هنا مهمة الفرصة', '2019-08-19', '2021-09-10', 'هنا شروط الفرصة', '', NULL, 1, 0, 0, NULL),
(4, 1, 'ادخال بيانات ', 4, 5, '2019-09-10', '2021-09-20', 0, 1, 'مهمة تدريب بكتابة المشاريع 01(&)مهمة تدريب بكتابة المشاريع 02(&)مهمة تدريب بكتابة المشاريع 03(&)مهمة تدريب بكتابة المشاريع 04', '2019-08-21', '2019-09-05', 'شرط تدريب بكتابة المشاريع 01(&)شرط تدريب بكتابة المشاريع 02(&)شرط تدريب بكتابة المشاريع 03', 'هنا يوجد ملاحظات لفرصة تدريب في كتابة المشاريع', '6_2019-08-21.docx', 1, 1, 1, 1),
(5, 1, 'تدريب في كتابة المشاريع', 4, 5, '2019-09-10', '2020-12-01', 0, 1, 'مهمة تدريب بكتابة المشاريع 01(&)مهمة تدريب بكتابة المشاريع 02(&)مهمة تدريب بكتابة المشاريع 03(&)مهمة تدريب بكتابة المشاريع 04', '2019-08-21', '2021-09-05', 'شرط تدريب بكتابة المشاريع 01(&)شرط تدريب بكتابة المشاريع 02(&)شرط تدريب بكتابة المشاريع 03', 'هنا يوجد ملاحظات لفرصة تدريب في كتابة المشاريع', '5_2019-08-21.pdf', 1, 1, 1, NULL),
(7, 1, 'تنسيق مشاريع', 2, 100, '2020-07-09', '2020-07-31', 3, 0, 'مهمة تدريب بكتابة المشاريع 01(&)مهمة تدريب بكتابة المشاريع 02(&)مهمة تدريب بكتابة المشاريع 03(&)مهمة تدريب بكتابة المشاريع 04', '2020-07-10', '2020-07-31', 'مهمة تدريب بكتابة المشاريع 01(&)مهمة تدريب بكتابة المشاريع 02(&)مهمة تدريب بكتابة المشاريع 03(&)مهمة تدريب بكتابة المشاريع 04', 'مهمة تدريب بكتابة المشاريع 01(&)مهمة تدريب بكتابة المشاريع 02(&)مهمة تدريب بكتابة المشاريع 03(&)مهمة تدريب بكتابة المشاريع 04', NULL, 0, 2, 1, NULL),
(11, 1, ' تدريب بكتابة المشاريع', 2, 6565, '2020-07-12', '2020-12-01', 3, 1, 'مهمة تدريب بكتابة المشاريع 01(&)مهمة تدريب بكتابة المشاريع 02(&)مهمة تدريب بكتابة المشاريع 03(&)مهمة تدريب بكتابة المشاريع 04', '2020-07-11', '2021-07-31', 'مهمة تدريب بكتابة المشاريع 01(&)مهمة تدريب بكتابة المشاريع 02(&)مهمة تدريب بكتابة المشاريع 03(&)مهمة تدريب بكتابة المشاريع 04', 'حبيب يا ليد', NULL, 2, 2, 1, NULL),
(12, 1, 'التنمية المستدامة', 1, 222, '2020-07-18', '2020-07-31', 5, 1, 'توزيع مواد غذائية للنازحين ', '2020-07-11', '2020-07-17', 'الانضباط', 'كن متعاون', NULL, 1, 0, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chanceapplication`
--

DROP TABLE IF EXISTS `chanceapplication`;
CREATE TABLE IF NOT EXISTS `chanceapplication` (
  `ap_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ap_chnID` int(11) NOT NULL,
  `ap_volID` int(11) NOT NULL,
  `ap_SubmitedIn` date NOT NULL,
  `ap_volRate` float DEFAULT NULL,
  `ap_volRateComment` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `ap_AcceptVol` tinyint(1) NOT NULL,
  `ap_read` int(11) NOT NULL,
  `ag_read` int(11) NOT NULL,
  PRIMARY KEY (`ap_ID`),
  KEY `ap_chnID` (`ap_chnID`),
  KEY `ap_volID` (`ap_volID`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chanceapplication`
--

INSERT INTO `chanceapplication` (`ap_ID`, `ap_chnID`, `ap_volID`, `ap_SubmitedIn`, `ap_volRate`, `ap_volRateComment`, `ap_AcceptVol`, `ap_read`, `ag_read`) VALUES
(7, 4, 1, '2019-09-03', 1, 'اداءه سيى جدا وغير من ضبط بالمواعيد', 0, 0, 0),
(8, 3, 1, '2019-09-07', 3.5, 'يتاخر دائما ولكن محترف في عملة', 1, 1, 0),
(9, 3, 2, '2019-09-07', 1, 'قليل خبرة ولا ينفع للعمل الجماعي', 0, 0, 0),
(11, 7, 1, '2020-07-10', 5, 'good', 1, 1, 0),
(14, 12, 1, '2020-07-11', 5, 'جميل جدا', 1, 1, 0),
(15, 11, 1, '2020-09-14', NULL, NULL, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `volunteer`
--

DROP TABLE IF EXISTS `volunteer`;
CREATE TABLE IF NOT EXISTS `volunteer` (
  `vl_ID` int(11) NOT NULL AUTO_INCREMENT,
  `vl_UserName` varchar(70) CHARACTER SET utf8 NOT NULL,
  `vl_Password` varchar(100) CHARACTER SET utf8 NOT NULL,
  `vl_Photo` varchar(100) DEFAULT NULL,
  `vl_AccCreatedIn` date NOT NULL,
  `vl_Email` varchar(50) NOT NULL,
  `vl_PhoneNumber` int(11) DEFAULT NULL,
  `vl_Gender` int(11) NOT NULL,
  `vl_BirthDate` date NOT NULL,
  `vl_Qualification` int(11) NOT NULL,
  `vl_Specialty` varchar(30) NOT NULL,
  `vl_Language` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `vl_Talent` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `vl_Skill` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `vl_locationGov` int(11) NOT NULL,
  `vl_LocationArea` int(11) NOT NULL,
  `vl_AccActive` tinyint(1) NOT NULL,
  `vl_AdminUserID` int(11) DEFAULT NULL,
  PRIMARY KEY (`vl_ID`),
  KEY `vl_AdminUserID` (`vl_AdminUserID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `volunteer`
--

INSERT INTO `volunteer` (`vl_ID`, `vl_UserName`, `vl_Password`, `vl_Photo`, `vl_AccCreatedIn`, `vl_Email`, `vl_PhoneNumber`, `vl_Gender`, `vl_BirthDate`, `vl_Qualification`, `vl_Specialty`, `vl_Language`, `vl_Talent`, `vl_Skill`, `vl_locationGov`, `vl_LocationArea`, `vl_AccActive`, `vl_AdminUserID`) VALUES
(1, 'Abdulrahman Hameed', '$2y$10$yEDq5Jd2PAWR/jaLaZidweIlZP5ZFbpyVE3IkAuIqZ9xlVRwNjVB6', 'Mohammed hasan_2020-09-16.jpg', '2019-06-13', 'abdu@gmail.com', 770094406, 0, '1995-01-18', 4, '3', 'العربية=1-English=3-الفرنسية=2', '5', '', 1, 1, 1, 1),
(2, 'zafer AlDhafer', '$2y$10$m6Hb5PMou3UxGievAGt3JObR0nXfBKgpfJKvfl6TpHwS/Bb3Iv3aK', 'MaleDefaultPic.jpg', '2019-06-28', 'zafer@gmail.com', 771454581, 0, '1994-11-13', 2, '4,3', 'العربية=1-English=4', '6', 'مهاراتي متعددة', 1, 0, 1, 1),
(3, 'Abdullah Abdulmalik', '$2y$10$/qWVYHtDdp.rTZIWY994u.MFG8fGW8wplMg4TvuKkyjcXpZJYD7uK', 'MaleDefaultPic.jpg', '2019-08-13', 'Abdullah@yahoo.com', NULL, 0, '2001-01-15', 1, '3', 'العربية=1-English=4', '5', 'many skills to count', 1, 0, 0, NULL),
(4, 'Rana Saleh', '$2y$10$x4Wtam2ddPpRbwJT/K8nhOGmWF0Fz80I3M.AP2kkK.HTMZtxowbvG', 'Rana Saleh_2020-09-16.jpg', '2019-08-13', 'Rana@gmail.com', NULL, 1, '1990-07-28', 2, '3', 'العربية=1-English=4', '3', '', 1, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `volunteer_experience`
--

DROP TABLE IF EXISTS `volunteer_experience`;
CREATE TABLE IF NOT EXISTS `volunteer_experience` (
  `vl_ExpID` int(11) NOT NULL AUTO_INCREMENT,
  `vl_volID` int(11) NOT NULL,
  `vl_ExpPosition` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `vl_ExpOrg` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `vl_ExpStart` date NOT NULL,
  `vl_ExpEnd` date NOT NULL,
  `vl_ExpField` int(11) NOT NULL,
  `vl_ExpSpec` int(11) NOT NULL,
  `vl_ExpDesc` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `vl_ExpSup` varchar(70) CHARACTER SET utf8 DEFAULT NULL,
  `vl_ExpSupEmail` varchar(50) NOT NULL,
  PRIMARY KEY (`vl_ExpID`),
  KEY `vl_volID` (`vl_volID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `volunteer_experience`
--

INSERT INTO `volunteer_experience` (`vl_ExpID`, `vl_volID`, `vl_ExpPosition`, `vl_ExpOrg`, `vl_ExpStart`, `vl_ExpEnd`, `vl_ExpField`, `vl_ExpSpec`, `vl_ExpDesc`, `vl_ExpSup`, `vl_ExpSupEmail`) VALUES
(1, 1, 'Programmer', 'LT-Mobile', '2019-07-25', '2019-12-09', 0, 0, 'gjhjhgjh', 'Mohammed Adurrah', 'nawar@yahho.com'),
(4, 2, 'me fuck', 'kyiuyiu', '2020-06-29', '2020-08-02', 4, 2, 'gfdfhgfhgfgdf', 'liuoiuoi', 'oiuoi@dsfd.dsf');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admininfo`
--
ALTER TABLE `admininfo`
  ADD CONSTRAINT `DeActivatingAdminWithInfo` FOREIGN KEY (`nf_AdminUserID`) REFERENCES `adminuser` (`au_ID`),
  ADD CONSTRAINT `EditingAdminWithInfo` FOREIGN KEY (`nf_EditingUserID`) REFERENCES `adminuser` (`au_ID`),
  ADD CONSTRAINT `WritingAdminWithInfo` FOREIGN KEY (`nf_WritingUserID`) REFERENCES `adminuser` (`au_ID`);

--
-- Constraints for table `adminpost`
--
ALTER TABLE `adminpost`
  ADD CONSTRAINT `DeActivatingAdminWithPost` FOREIGN KEY (`po_AdminUserID`) REFERENCES `adminuser` (`au_ID`),
  ADD CONSTRAINT `EditingAdminWithPost` FOREIGN KEY (`po_EditingUserID`) REFERENCES `adminuser` (`au_ID`),
  ADD CONSTRAINT `WritingAdminWithPost` FOREIGN KEY (`po_WritingUserID`) REFERENCES `adminuser` (`au_ID`);

--
-- Constraints for table `agency`
--
ALTER TABLE `agency`
  ADD CONSTRAINT `AdminDeactiveAgency` FOREIGN KEY (`ag_AdminUserID`) REFERENCES `adminuser` (`au_ID`) ON DELETE SET NULL;

--
-- Constraints for table `chance`
--
ALTER TABLE `chance`
  ADD CONSTRAINT `AdminDeactiveChance` FOREIGN KEY (`ch_AdminUserID`) REFERENCES `adminuser` (`au_ID`) ON DELETE SET NULL,
  ADD CONSTRAINT `AgencyWithChance` FOREIGN KEY (`ch_agcID`) REFERENCES `agency` (`ag_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chanceapplication`
--
ALTER TABLE `chanceapplication`
  ADD CONSTRAINT `ChanceWithApplication` FOREIGN KEY (`ap_chnID`) REFERENCES `chance` (`ch_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `VolunteerWithApplication` FOREIGN KEY (`ap_volID`) REFERENCES `volunteer` (`vl_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `volunteer`
--
ALTER TABLE `volunteer`
  ADD CONSTRAINT `AdminWithVolunteer` FOREIGN KEY (`vl_AdminUserID`) REFERENCES `adminuser` (`au_ID`) ON DELETE SET NULL;

--
-- Constraints for table `volunteer_experience`
--
ALTER TABLE `volunteer_experience`
  ADD CONSTRAINT `VolunteerWithExperience` FOREIGN KEY (`vl_volID`) REFERENCES `volunteer` (`vl_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
