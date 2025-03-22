-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2025 at 04:54 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `warning_letter_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `frm_letter_rule`
--

CREATE TABLE `frm_letter_rule` (
  `f_id` int(11) NOT NULL,
  `rule_id` int(11) DEFAULT NULL,
  `rule_name` text DEFAULT NULL,
  `rule_detail` text DEFAULT NULL,
  `letter_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `frm_target`
--

CREATE TABLE `frm_target` (
  `f_id` int(11) NOT NULL,
  `usr_id` int(11) NOT NULL,
  `usr_fname` varchar(255) NOT NULL,
  `usr_lname` varchar(255) NOT NULL,
  `usr_pos_name` varchar(255) NOT NULL,
  `usr_dep_name` text NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `letter_id` int(11) NOT NULL,
  `f_status` int(11) NOT NULL COMMENT '1 เซ็นแล้ว\r\n2 ยังไม่เซ็น',
  `f_image` text NOT NULL,
  `prefix_name` varchar(255) DEFAULT NULL,
  `date_sign` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `frm_witness`
--

CREATE TABLE `frm_witness` (
  `f_id` int(11) NOT NULL,
  `usr_id` int(11) NOT NULL,
  `usr_fname` varchar(255) NOT NULL,
  `usr_lname` varchar(255) NOT NULL,
  `usr_dep_name` varchar(255) NOT NULL,
  `usr_pos_name` varchar(255) NOT NULL,
  `f_status` int(11) NOT NULL,
  `f_image` text NOT NULL,
  `f_create` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `letter_id` int(11) NOT NULL,
  `prefix_name` varchar(255) DEFAULT NULL,
  `date_sign` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `letter_process`
--

CREATE TABLE `letter_process` (
  `bp_id` int(11) NOT NULL,
  `letter_id` int(11) DEFAULT NULL,
  `sender_name` varchar(255) DEFAULT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `receive_user` int(11) DEFAULT NULL,
  `receive_name` varchar(255) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `sender_date` date DEFAULT NULL,
  `sender_time` varchar(20) DEFAULT NULL,
  `receive_date` date DEFAULT NULL,
  `receive_time` varchar(20) DEFAULT NULL,
  `receive_status` varchar(1) DEFAULT NULL,
  `letter_step` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m_file_attach`
--

CREATE TABLE `m_file_attach` (
  `file_id` int(11) NOT NULL,
  `letter_id` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_tempname` varchar(255) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `create_user` int(11) DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  `update_user` int(11) DEFAULT NULL,
  `full_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m_letter`
--

CREATE TABLE `m_letter` (
  `letter_id` int(11) NOT NULL,
  `usr_id` int(11) DEFAULT NULL,
  `dep_id` int(11) DEFAULT NULL,
  `letter_number` varchar(50) DEFAULT NULL,
  `letter_count` int(11) DEFAULT NULL,
  `letter_year` int(11) DEFAULT NULL,
  `letter_write_address` text DEFAULT NULL,
  `letter_date` date DEFAULT NULL,
  `letter_name` text DEFAULT NULL,
  `letter_target` text DEFAULT NULL,
  `letter_detail` text DEFAULT NULL,
  `letter_status` int(11) DEFAULT NULL COMMENT '0 create\r\n1 ส่งให้ Hr\r\n2 อนุมัติ Hr\r\n3 ยกเลิก\r\n4 เสร็จสิ้น 5 ส่งกลับแก้ไข',
  `letter_reason` text DEFAULT NULL,
  `letter_type` int(11) DEFAULT NULL,
  `letter_type_name` varchar(255) DEFAULT NULL,
  `img_create` text DEFAULT NULL,
  `img_hr` text DEFAULT NULL,
  `hr_id` int(11) DEFAULT NULL,
  `hr_name` varchar(255) DEFAULT NULL,
  `hr_position` varchar(255) DEFAULT NULL,
  `hr_apporve_date` date DEFAULT NULL,
  `hr_appove_time` varchar(30) DEFAULT NULL,
  `hr_appove_status` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m_letter_type`
--

CREATE TABLE `m_letter_type` (
  `lt_id` int(11) NOT NULL,
  `letter_type_name` varchar(255) NOT NULL,
  `letter_type_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_letter_type`
--

INSERT INTO `m_letter_type` (`lt_id`, `letter_type_name`, `letter_type_status`) VALUES
(1, 'รับเรื่องร้องเรียน', 0);

-- --------------------------------------------------------

--
-- Table structure for table `m_menu`
--

CREATE TABLE `m_menu` (
  `menu_id` int(11) NOT NULL,
  `menu_name` text DEFAULT NULL,
  `menu_type` int(11) DEFAULT NULL COMMENT '1 admin\r\n2 member',
  `menu_image` text DEFAULT NULL,
  `menu_group` int(11) DEFAULT NULL,
  `menu_url` varchar(255) DEFAULT NULL,
  `manager_status` varchar(1) DEFAULT NULL,
  `order_menu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_menu`
--

INSERT INTO `m_menu` (`menu_id`, `menu_name`, `menu_type`, `menu_image`, `menu_group`, `menu_url`, `manager_status`, `order_menu`) VALUES
(1, 'ข้อมูลผู้ใช้งาน', 1, 'nc-single-02', 1, 'usr_main.php', NULL, 3),
(2, 'ตั้งค่าประเภทคำร้อง', 1, 'nc-align-left-2', 1, 'setup_letter_type.php', NULL, 6),
(3, 'ยื่นคำขอ', 2, 'nc-badge', 2, 'frmSend.php', 'Y', 1),
(4, 'ตั้งค่าหน่วยงาน/ฝ่าย', 1, 'nc-bank', 1, 'setup_department.php', NULL, 4),
(5, 'ตั้งค่าตำแหน่ง', 1, 'nc-album-2', 1, 'setup_postion.php', NULL, 5),
(6, 'อนุมัติ (Hr)', 1, 'nc-check-2', 1, 'approved_list.php', NULL, 2),
(7, 'ตั้งค่าข้อบังคับ', 1, 'nc-bullet-list-67', 1, 'RulePage.php', NULL, 7),
(8, 'รายงาน', 1, 'nc-bullet-list-67', 1, 'report.php', NULL, 8),
(9, 'ยื่นคำขอ', 2, 'nc-badge', 2, 'frmSend.php', NULL, 1),
(10, 'ยื่นคำขอ', 1, 'nc-badge', 2, 'frmSend.php', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_prefix`
--

CREATE TABLE `m_prefix` (
  `prefix_id` int(11) NOT NULL,
  `prefix_name` varchar(255) DEFAULT NULL,
  `prefix_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_prefix`
--

INSERT INTO `m_prefix` (`prefix_id`, `prefix_name`, `prefix_status`) VALUES
(1, 'นาย', 1),
(2, 'นางสาว', 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_rule`
--

CREATE TABLE `m_rule` (
  `rule_id` int(11) NOT NULL,
  `rule_name` varchar(255) DEFAULT NULL,
  `rule_status` varchar(1) DEFAULT NULL,
  `rule_detail` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_rule`
--

INSERT INTO `m_rule` (`rule_id`, `rule_name`, `rule_status`, `rule_detail`) VALUES
(1, '7.1.1 พนักงานต้องปฏิบัติตามระเบียบข้อบังคับ จรรยาบรรณ (Code of Conduct ) ระเบียบสัญญาจ้าง แรงงาน ประกาศ คําสั่ง นโยบาย และกฎเกณฑ์ต่างๆ ของบริษัท รวมทั้งคําสั่งอันชอบด้วยกฎหมาย และ ด้วยหน้าที่ของผู้บังคับบัญชา', 'Y', NULL),
(2, '7.1.2 พนักงานต้องเชื่อฟังและปฏิบัติตามคําสั่งของผู้บังคับบัญชาซึ่งเป็นผู้กําหนด', 'Y', 'เตือนด้วยวาจา'),
(3, '7.1.3 พนักงานต้องแจ้งการเปลี่ยนแปลงสถานภาพของตนเองให้บริษัท ทราบในกรณีเปลี่ยนชื่อ/นามสกุล ที่อยู่ อาศัย สมรส/หย่าร้าง มีบุตร บุคคลในครอบครัวเสียชีวิต เปลี่ยนบัตรประจําตัวประชาชน ทั้งนี้ภายใน 7 วันนับจากวันที่เปลี่ยนแปลงในแต่ละกรณี', 'Y', 'เตือนด้วยวาจา'),
(4, '7.1.4 พนักงานต้องแต่งกายมาทํางานตามที่บริษัทกําหนด หรือแต่งกายสุภาพเรียบร้อย', 'Y', 'เตือนด้วยวาจา'),
(5, '7.1.5 พนักงานต้องสนใจรับทราบและปฏิบัติตามคําสั่ง นโยบาย หรือประกาศของบริษัท โดยต้องรายงานเรื่องต่างๆ ที่อาจส่งผลให้บริษัทได้รับความเสียหายให้ผู้บังคับบัญชาได้รับทราบ', 'Y', 'เตือนด้วยลายลักษณ์อักษร'),
(6, '7.1.6 ห้ามพนักงานรับประทานอาหารเกินหรือนอกเหนือจากทางบริษัทกําหนดให้โดยไม่ได้รับอนุญาตเป็นกรณีพิเศษหรือไม่ได้ซื้อโดยจ่ายเงินที่เคาน์เตอร์', 'Y', 'เตือนด้วยลายลักษณ์อักษร'),
(7, '7.1.7 ห้ามพนักงานแจ้งหรือรายงานเท็จต่อผู้บังคับบัญชา', 'Y', 'เตือนด้วยลายลักษณ์อักษร'),
(8, '7.1.8 ห้ามพนักงานปิดประกาศ เขียนข้อความ จ่ายแจก เอกสาร หรือส่งข้อความอื่นใดทางอิเล็กทรอนิกส์ (Social Media) อันทําให้เกิดความเสียหายต่อบริษัท และ/หรือเกิดความเสียหายต่อพนักงานอื่นใด', 'Y', 'เตือนด้วยลายลักษณ์อักษร'),
(9, ' 7.1.9 ห้ามพนักงานนําบุคคลภายนอกหรือผู้ที่ไม่เกี่ยวข้องกับงานเข้ามาในสถานที่ของบริษัท โดยไม่ได้รับอนุญาต', 'Y', 'เตือนด้วยลายลักษณ์อักษร'),
(10, '7.1.10 ห้ามพนักงานช่วยเหลือ สนับสนุน ชักจูง รู้เห็นเป็นใจ หรือเพิกเฉยต่อการกระทําความผิดของพนักงานอื่น ', 'Y', 'เตือนด้วยลายลักษณ์อักษร'),
(11, '7.1.11 ห้ามพนักงานรับจ้างทํางานให้ผู้อื่น หรือดําเนินธุรกิจใดๆ อันอาจเป็นผลกระทบเวลาทํางาน หรือกิจการของบริษัท', 'Y', 'พักงานไม่รับค่าจ้าง'),
(12, '7.1.12 พนักงานต้องไม่ใช้เวลาทํางาน ต้อนรับหรือพบปะผู้มาเยือนในธุรกิจส่วนตัว หากมีความจําเป็น จะต้อง ได้รับอนุญาตจากผู้บังคับบัญชาก่อน และให้ใช้สถานที่ตามที่บริษัทจัดไว้ โดยใช้เวลาเท่าที่จําเป็น', 'Y', 'พักงานไม่รับค่าจ้าง'),
(13, '7.1.13 พนักงานต้องปฏิบัติตาม ระเบียบ คําสั่ง และนโยบายที่เกี่ยวข้องกับความปลอดภัยของอาหาร', 'Y', 'เตือนด้วยลายลักษณ์อักษร'),
(14, '7.1.14 พนักงานจะต้องบริการลูกค้าเต็มความสามารถ และจะต้องรักษาผลประโยชน์ของบริษัทอย่างสูงสุด', 'Y', 'เตือนด้วยลายลักษณ์อักษร'),
(15, '7.1.15 พนักงานต้องมาทํางานอย่างปกติและสม่ำเสมอตามวันและเวลาทํางานที่บริษัทประกาศหรือกําหนด ', 'Y', 'เตือนด้วยลายลักษณ์อักษร'),
(16, '7.1.16 พนักงานต้องมาปฏิบัติงานให้ตรงตามเวลา และไม่หยุดพัก หรือเลิกงานก่อนเวลาที่กําหนดและลงบันทึก เวลาทํางานตามที่บริษัทกําหนด', 'Y', 'เตือนด้วยลายลักษณ์อักษร'),
(17, '7.1.17 พนักงานที่บริษัทกําหนดให้บันทึกเวลาทํางาน ต้องบันทึกเวลาด้วยตนเองทุกครั้งเมื่อเข้าทํางาน เลิกงาน และ/หรือตามระเบียบฯ กําหนด ห้ามบันทึกเวลาการทํางานแทนผู้อื่น บันทึกเวลาไม่ตรงตามความเป็น จริงหรือยอมให้ผู้อื่นบันทึกเวลาการทํางานแทน', 'Y', 'พักงานไม่รับค่าจ้าง'),
(18, '7.1.18 พนักงานต้องปฏิบัติหน้าที่อย่างเต็มความสามารถด้วยความซื่อสัตย์สุจริต และขยันหมั่นเพียร ', 'Y', 'เตือนด้วยลายลักษณ์อักษร'),
(19, '7.1.19 พนักงานต้องปฏิบัติตามกฎแห่งความปลอดภัยในการทํางาน', 'Y', 'พักงานไม่รับค่าจ้าง'),
(20, '7.1.20 พนักงานต้องปฏิบัติงานด้วยความไม่ประมาทเลินเล่อ ไม่หยอกล้อหรือเล่นกันในเวลาทํางาน ', 'Y', 'พักงานไม่รับค่าจ้าง'),
(21, '7.1.21 พนักงานต้องไม่กระทําการใดๆ ที่เป็นการละทิ้งหน้าที่', 'Y', 'พักงานไม่รับค่าจ้าง'),
(22, '7.1.22 ห้ามพนักงานทํางานให้กับบุคคล หรือองค์กรอื่นใด ทั้งนี้ไม่ว่าจะได้รับค่าจ้าง หรือผลประโยชน์ตอบแทนหรือไม่', 'Y', 'ไล่ออก'),
(23, '7.1.23 พนักงานต้องไม่นอนหรือหลับในเวลาทํางาน', 'Y', 'เตือนด้วยลายลักษณ์อักษร'),
(24, '7.1.24 พนักงานต้องแนะนํา อํานวยความสะดวกแก่ลูกค้าและผู้ที่มาติดต่อกับบริษัทด้วยความสุภาพเรียบร้อย ', 'Y', 'เตือนด้วยวาจา'),
(25, '7.1.25 ห้ามพนักงานเล่น Social Media ใดๆ ในทางส่วนตัวขณะทํางาน', 'Y', 'เตือนด้วยวาจา'),
(26, '7.1.26 พนักงานต้องปฏิบัติตามคําสั่งของผู้บังคับบัญชา เมื่อมีคําสั่งให้ โยกย้าย รวมถึงการสับเปลี่ยนหน้าที่ ตําแหน่ง ตามที่บริษัทเห็นสมควร ซึ่งอาจให้ไปประจําหน่วยงานใด ไม่ว่าจะเป็นการชั่วคราวหรือเป็นการถาวร', 'Y', 'พักงานไม่รับค่าจ้าง'),
(27, '7.1.27 ห้ามพนักงานปิดประกาศ นัดพบ ประชุม อภิปรายภายในบริษัท รวมทั้งจําหน่ายจ่ายแจก เอกสารภายใน บริษัท โดยไม่ได้รับอนุญาตการรักษาความลับของบริษัท', 'Y', 'ไล่ออก'),
(28, '7.1.28 พนักงานต้องรักษาความลับของบริษัท ลูกค้า คู่สัญญา พนักงานอื่น หรือบุคคลใดๆ ที่เกี่ยวข้องกับบริษัท ', 'Y', 'ไล่ออก'),
(29, '7.1.29 พนักงานต้องไม่เปิดเผยข้อมูลความลับบริษัท หรือปกปิดข้อเท็จจริงอันอาจเป็นเหตุให้บริษัท ได้รับความเสียหายการรักษาผลประโยชน์ของบริษัท', 'Y', 'ไล่ออก'),
(30, '7.1.30 พนักงานต้องช่วยเหลือซึ่งกันและกันในการทํางานเพื่อประโยชน์ของบริษัท', 'Y', 'เตือนด้วยวาจา');

-- --------------------------------------------------------

--
-- Table structure for table `m_user`
--

CREATE TABLE `m_user` (
  `usr_id` int(11) NOT NULL COMMENT 'รหัสพนักงาน',
  `usr_username` varchar(50) DEFAULT NULL,
  `usr_password` text DEFAULT NULL,
  `usr_fname` varchar(255) DEFAULT NULL,
  `usr_lname` varchar(255) DEFAULT NULL,
  `usr_gender` int(11) DEFAULT NULL,
  `usr_email` varchar(50) DEFAULT NULL,
  `usr_tel` varchar(50) DEFAULT NULL,
  `dep_id` int(11) DEFAULT NULL,
  `usr_position` int(11) DEFAULT NULL,
  `usr_type` int(11) DEFAULT NULL,
  `usr_idcard` varchar(20) DEFAULT NULL,
  `usr_status` varchar(1) DEFAULT NULL,
  `prefix_id` int(11) DEFAULT NULL,
  `usr_year` int(11) DEFAULT NULL,
  `usr_count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_user`
--

INSERT INTO `m_user` (`usr_id`, `usr_username`, `usr_password`, `usr_fname`, `usr_lname`, `usr_gender`, `usr_email`, `usr_tel`, `dep_id`, `usr_position`, `usr_type`, `usr_idcard`, `usr_status`, `prefix_id`, `usr_year`, `usr_count`) VALUES
(1, 'admin', 'MQ==', 'Admin', 'SuperAdmin', 1, 'kriangkai', '11', 1, 5, 1, '111', 'Y', 1, 2024, 1);

-- --------------------------------------------------------

--
-- Table structure for table `usr_department`
--

CREATE TABLE `usr_department` (
  `dep_id` int(11) NOT NULL,
  `dep_name` varchar(400) DEFAULT NULL,
  `dep_status` int(11) DEFAULT NULL COMMENT '0 : unactive 1: active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usr_department`
--

INSERT INTO `usr_department` (`dep_id`, `dep_name`, `dep_status`) VALUES
(1, 'Hr', 1),
(3, 'IT', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usr_position`
--

CREATE TABLE `usr_position` (
  `pos_id` int(11) NOT NULL,
  `pos_name` varchar(255) NOT NULL,
  `pos_status` int(11) NOT NULL COMMENT '1 ใช้งาน 2 ไม่ใช้งาน',
  `is_manager` varchar(1) NOT NULL COMMENT 'N ไม่ใช่ผู้จัดการ  Y ผู้จัดการ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usr_position`
--

INSERT INTO `usr_position` (`pos_id`, `pos_name`, `pos_status`, `is_manager`) VALUES
(5, 'ผู้จัดการ', 1, 'Y'),
(6, 'พนักงาน', 1, '');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_user`
-- (See below for the actual view)
--
CREATE TABLE `view_user` (
`usr_fname` varchar(255)
,`usr_lname` varchar(255)
,`usr_id` int(11)
,`usr_type` int(11)
,`dep_name` varchar(400)
,`pos_name` varchar(255)
,`is_manager` varchar(1)
,`prefix_name` varchar(255)
,`dep_id` int(11)
,`usr_status` varchar(1)
,`fullname` text
,`usr_position` int(11)
,`prefix_id` int(11)
,`usr_tel` varchar(50)
,`usr_email` varchar(50)
,`usr_idcard` varchar(20)
);

-- --------------------------------------------------------

--
-- Structure for view `view_user`
--
DROP TABLE IF EXISTS `view_user`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_user`  AS SELECT `m_user`.`usr_fname` AS `usr_fname`, `m_user`.`usr_lname` AS `usr_lname`, `m_user`.`usr_id` AS `usr_id`, `m_user`.`usr_type` AS `usr_type`, `usr_department`.`dep_name` AS `dep_name`, `usr_position`.`pos_name` AS `pos_name`, `usr_position`.`is_manager` AS `is_manager`, `m_prefix`.`prefix_name` AS `prefix_name`, `m_user`.`dep_id` AS `dep_id`, `m_user`.`usr_status` AS `usr_status`, concat(`m_prefix`.`prefix_name`,`m_user`.`usr_fname`,' ',`m_user`.`usr_lname`) AS `fullname`, `m_user`.`usr_position` AS `usr_position`, `m_user`.`prefix_id` AS `prefix_id`, `m_user`.`usr_tel` AS `usr_tel`, `m_user`.`usr_email` AS `usr_email`, `m_user`.`usr_idcard` AS `usr_idcard` FROM (((`m_user` join `usr_position` on(`usr_position`.`pos_id` = `m_user`.`usr_position`)) join `usr_department` on(`usr_department`.`dep_id` = `m_user`.`dep_id`)) join `m_prefix` on(`m_prefix`.`prefix_id` = `m_user`.`prefix_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `frm_letter_rule`
--
ALTER TABLE `frm_letter_rule`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `frm_target`
--
ALTER TABLE `frm_target`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `frm_witness`
--
ALTER TABLE `frm_witness`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `letter_process`
--
ALTER TABLE `letter_process`
  ADD PRIMARY KEY (`bp_id`);

--
-- Indexes for table `m_file_attach`
--
ALTER TABLE `m_file_attach`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `m_letter`
--
ALTER TABLE `m_letter`
  ADD PRIMARY KEY (`letter_id`);

--
-- Indexes for table `m_letter_type`
--
ALTER TABLE `m_letter_type`
  ADD PRIMARY KEY (`lt_id`);

--
-- Indexes for table `m_menu`
--
ALTER TABLE `m_menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `m_prefix`
--
ALTER TABLE `m_prefix`
  ADD PRIMARY KEY (`prefix_id`);

--
-- Indexes for table `m_rule`
--
ALTER TABLE `m_rule`
  ADD PRIMARY KEY (`rule_id`);

--
-- Indexes for table `m_user`
--
ALTER TABLE `m_user`
  ADD PRIMARY KEY (`usr_id`);

--
-- Indexes for table `usr_department`
--
ALTER TABLE `usr_department`
  ADD PRIMARY KEY (`dep_id`);

--
-- Indexes for table `usr_position`
--
ALTER TABLE `usr_position`
  ADD PRIMARY KEY (`pos_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `frm_letter_rule`
--
ALTER TABLE `frm_letter_rule`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `frm_target`
--
ALTER TABLE `frm_target`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `frm_witness`
--
ALTER TABLE `frm_witness`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `letter_process`
--
ALTER TABLE `letter_process`
  MODIFY `bp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_file_attach`
--
ALTER TABLE `m_file_attach`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_letter`
--
ALTER TABLE `m_letter`
  MODIFY `letter_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_letter_type`
--
ALTER TABLE `m_letter_type`
  MODIFY `lt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `m_menu`
--
ALTER TABLE `m_menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `m_prefix`
--
ALTER TABLE `m_prefix`
  MODIFY `prefix_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `m_rule`
--
ALTER TABLE `m_rule`
  MODIFY `rule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `m_user`
--
ALTER TABLE `m_user`
  MODIFY `usr_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสพนักงาน', AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `usr_department`
--
ALTER TABLE `usr_department`
  MODIFY `dep_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `usr_position`
--
ALTER TABLE `usr_position`
  MODIFY `pos_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
