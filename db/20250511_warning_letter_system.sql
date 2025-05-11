/*
 Navicat Premium Data Transfer

 Source Server         : local host my com
 Source Server Type    : MySQL
 Source Server Version : 100432
 Source Host           : localhost:3306
 Source Schema         : warning_letter_system

 Target Server Type    : MySQL
 Target Server Version : 100432
 File Encoding         : 65001

 Date: 11/05/2025 12:59:34
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for frm_letter_rule
-- ----------------------------
DROP TABLE IF EXISTS `frm_letter_rule`;
CREATE TABLE `frm_letter_rule`  (
  `f_id` int NOT NULL AUTO_INCREMENT,
  `rule_id` int NULL DEFAULT NULL,
  `rule_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `rule_detail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `letter_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`f_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of frm_letter_rule
-- ----------------------------

-- ----------------------------
-- Table structure for frm_target
-- ----------------------------
DROP TABLE IF EXISTS `frm_target`;
CREATE TABLE `frm_target`  (
  `f_id` int NOT NULL AUTO_INCREMENT,
  `usr_id` int NOT NULL,
  `usr_fname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `usr_lname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `usr_pos_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `usr_dep_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  `letter_id` int NOT NULL,
  `f_status` int NOT NULL COMMENT '1 เซ็นแล้ว\r\n2 ยังไม่เซ็น',
  `f_image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `prefix_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `date_sign` date NULL DEFAULT NULL,
  PRIMARY KEY (`f_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of frm_target
-- ----------------------------

-- ----------------------------
-- Table structure for frm_witness
-- ----------------------------
DROP TABLE IF EXISTS `frm_witness`;
CREATE TABLE `frm_witness`  (
  `f_id` int NOT NULL AUTO_INCREMENT,
  `usr_id` int NOT NULL,
  `usr_fname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `usr_lname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `usr_dep_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `usr_pos_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `f_status` int NOT NULL,
  `f_image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `f_create` timestamp NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  `letter_id` int NOT NULL,
  `prefix_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `date_sign` date NULL DEFAULT NULL,
  PRIMARY KEY (`f_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of frm_witness
-- ----------------------------

-- ----------------------------
-- Table structure for letter_process
-- ----------------------------
DROP TABLE IF EXISTS `letter_process`;
CREATE TABLE `letter_process`  (
  `bp_id` int NOT NULL AUTO_INCREMENT,
  `letter_id` int NULL DEFAULT NULL,
  `sender_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `sender_id` int NULL DEFAULT NULL,
  `receive_user` int NULL DEFAULT NULL,
  `receive_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `comment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `sender_date` date NULL DEFAULT NULL,
  `sender_time` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `receive_date` date NULL DEFAULT NULL,
  `receive_time` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `receive_status` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `letter_step` int NULL DEFAULT NULL,
  PRIMARY KEY (`bp_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of letter_process
-- ----------------------------

-- ----------------------------
-- Table structure for m_file_attach
-- ----------------------------
DROP TABLE IF EXISTS `m_file_attach`;
CREATE TABLE `m_file_attach`  (
  `file_id` int NOT NULL AUTO_INCREMENT,
  `letter_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `file_tempname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `create_date` date NULL DEFAULT NULL,
  `create_user` int NULL DEFAULT NULL,
  `update_date` date NULL DEFAULT NULL,
  `update_user` int NULL DEFAULT NULL,
  `full_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`file_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_file_attach
-- ----------------------------

-- ----------------------------
-- Table structure for m_letter
-- ----------------------------
DROP TABLE IF EXISTS `m_letter`;
CREATE TABLE `m_letter`  (
  `letter_id` int NOT NULL AUTO_INCREMENT,
  `usr_id` int NULL DEFAULT NULL,
  `dep_id` int NULL DEFAULT NULL,
  `letter_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `letter_count` int NULL DEFAULT NULL,
  `letter_year` int NULL DEFAULT NULL,
  `letter_write_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `letter_date` date NULL DEFAULT NULL,
  `letter_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `letter_target` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `letter_detail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `letter_status` int NULL DEFAULT NULL COMMENT '0 create\r\n1 ส่งให้ Hr\r\n2 อนุมัติ Hr\r\n3 ยกเลิก\r\n4 เสร็จสิ้น 5 ส่งกลับแก้ไข',
  `letter_reason` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `letter_type` int NULL DEFAULT NULL,
  `letter_type_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `img_create` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `img_hr` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `hr_id` int NULL DEFAULT NULL,
  `hr_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `hr_position` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `hr_apporve_date` date NULL DEFAULT NULL,
  `hr_appove_time` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `hr_appove_status` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `letter_date_do` date NULL DEFAULT NULL,
  `letter_time` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `type_detail_1` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `type_detail_3` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `manager_id` int NULL DEFAULT NULL,
  `manager_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `manager_pos` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `manager_sign_date` date NULL DEFAULT NULL,
  `target_date` date NULL DEFAULT NULL,
  `manager_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `type_detail_2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  PRIMARY KEY (`letter_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_letter
-- ----------------------------

-- ----------------------------
-- Table structure for m_letter_type
-- ----------------------------
DROP TABLE IF EXISTS `m_letter_type`;
CREATE TABLE `m_letter_type`  (
  `lt_id` int NOT NULL AUTO_INCREMENT,
  `letter_type_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `letter_type_status` int NOT NULL,
  `detail_1` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `detail_2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `detail_3` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  PRIMARY KEY (`lt_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_letter_type
-- ----------------------------
INSERT INTO `m_letter_type` VALUES (1, 'รับเรื่องร้องเรียน', 1, 'กระทำผิดวันที่ XXXX  เวลา TTTT', 'รับเรื่องร้องเรียน (2)', 'รับเรื่องร้องเรียน (3)');
INSERT INTO `m_letter_type` VALUES (9, '1', 1, '', '', '');
INSERT INTO `m_letter_type` VALUES (10, '1', 1, '', '', '');
INSERT INTO `m_letter_type` VALUES (11, '1ๅๅ', 1, '2ๅๅ', '3--', '4ภภภ');

-- ----------------------------
-- Table structure for m_menu
-- ----------------------------
DROP TABLE IF EXISTS `m_menu`;
CREATE TABLE `m_menu`  (
  `menu_id` int NOT NULL AUTO_INCREMENT,
  `menu_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `menu_type` int NULL DEFAULT NULL COMMENT '1 admin\r\n2 member',
  `menu_image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `menu_group` int NULL DEFAULT NULL,
  `menu_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `manager_status` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `order_menu` int NULL DEFAULT NULL,
  PRIMARY KEY (`menu_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_menu
-- ----------------------------
INSERT INTO `m_menu` VALUES (1, 'ข้อมูลผู้ใช้งาน', 1, 'nc-single-02', 1, 'usr_main.php', NULL, 3);
INSERT INTO `m_menu` VALUES (2, 'ตั้งค่าประเภทคำร้อง', 1, 'nc-align-left-2', 1, 'setup_letter_type.php', NULL, 6);
INSERT INTO `m_menu` VALUES (3, 'คำร้องขอ', 2, 'nc-badge', 2, 'frmSend.php', 'Y', 1);
INSERT INTO `m_menu` VALUES (4, 'ตั้งค่าหน่วยงาน/ฝ่าย', 1, 'nc-bank', 1, 'setup_department.php', NULL, 4);
INSERT INTO `m_menu` VALUES (5, 'ตั้งค่าตำแหน่ง', 1, 'nc-album-2', 1, 'setup_postion.php', NULL, 5);
INSERT INTO `m_menu` VALUES (6, 'อนุมัติเอกสาร', 1, 'nc-check-2', 1, 'approved_list.php', NULL, 2);
INSERT INTO `m_menu` VALUES (7, 'ตั้งค่าข้อบังคับ', 1, 'nc-bullet-list-67', 1, 'RulePage.php', NULL, 7);
INSERT INTO `m_menu` VALUES (8, 'รายงาน', 1, 'nc-bullet-list-67', 1, 'report.php', NULL, 8);
INSERT INTO `m_menu` VALUES (9, 'คำร้องขอ', 2, 'nc-badge', 2, 'frmSend.php', NULL, 1);
INSERT INTO `m_menu` VALUES (10, 'คำร้องขอ', 1, 'nc-badge', 2, 'frmSend.php', NULL, 1);

-- ----------------------------
-- Table structure for m_prefix
-- ----------------------------
DROP TABLE IF EXISTS `m_prefix`;
CREATE TABLE `m_prefix`  (
  `prefix_id` int NOT NULL AUTO_INCREMENT,
  `prefix_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `prefix_status` int NULL DEFAULT NULL,
  PRIMARY KEY (`prefix_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_prefix
-- ----------------------------
INSERT INTO `m_prefix` VALUES (1, 'นาย', 1);
INSERT INTO `m_prefix` VALUES (2, 'นางสาว', 1);

-- ----------------------------
-- Table structure for m_rule
-- ----------------------------
DROP TABLE IF EXISTS `m_rule`;
CREATE TABLE `m_rule`  (
  `rule_id` int NOT NULL AUTO_INCREMENT,
  `rule_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `rule_status` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `rule_detail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  PRIMARY KEY (`rule_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 34 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_rule
-- ----------------------------
INSERT INTO `m_rule` VALUES (1, '7.1.1 พนักงานต้องปฏิบัติตามระเบียบข้อบังคับ จรรยาบรรณ (Code of Conduct ) ระเบียบสัญญาจ้าง แรงงาน ประกาศ คําสั่ง นโยบาย และกฎเกณฑ์ต่างๆ ของบริษัท รวมทั้งคําสั่งอันชอบด้วยกฎหมาย และ ด้วยหน้าที่ของผู้บังคับบัญชา', 'Y', '');
INSERT INTO `m_rule` VALUES (2, '7.1.2 พนักงานต้องเชื่อฟังและปฏิบัติตามคําสั่งของผู้บังคับบัญชาซึ่งเป็นผู้กําหนด', 'Y', 'เตือนด้วยวาจา');
INSERT INTO `m_rule` VALUES (3, '7.1.3 พนักงานต้องแจ้งการเปลี่ยนแปลงสถานภาพของตนเองให้บริษัท ทราบในกรณีเปลี่ยนชื่อ/นามสกุล ที่อยู่ อาศัย สมรส/หย่าร้าง มีบุตร บุคคลในครอบครัวเสียชีวิต เปลี่ยนบัตรประจําตัวประชาชน ทั้งนี้ภายใน 7 วันนับจากวันที่เปลี่ยนแปลงในแต่ละกรณี', 'Y', 'เตือนด้วยวาจา');
INSERT INTO `m_rule` VALUES (4, '7.1.4 พนักงานต้องแต่งกายมาทํางานตามที่บริษัทกําหนด หรือแต่งกายสุภาพเรียบร้อย', 'Y', 'เตือนด้วยวาจา');
INSERT INTO `m_rule` VALUES (5, '7.1.5 พนักงานต้องสนใจรับทราบและปฏิบัติตามคําสั่ง นโยบาย หรือประกาศของบริษัท โดยต้องรายงานเรื่องต่างๆ ที่อาจส่งผลให้บริษัทได้รับความเสียหายให้ผู้บังคับบัญชาได้รับทราบ', 'Y', 'เตือนด้วยลายลักษณ์อักษร');
INSERT INTO `m_rule` VALUES (6, '7.1.6 ห้ามพนักงานรับประทานอาหารเกินหรือนอกเหนือจากทางบริษัทกําหนดให้โดยไม่ได้รับอนุญาตเป็นกรณีพิเศษหรือไม่ได้ซื้อโดยจ่ายเงินที่เคาน์เตอร์', 'Y', 'เตือนด้วยลายลักษณ์อักษร');
INSERT INTO `m_rule` VALUES (7, '7.1.7 ห้ามพนักงานแจ้งหรือรายงานเท็จต่อผู้บังคับบัญชา', 'Y', 'เตือนด้วยลายลักษณ์อักษร');
INSERT INTO `m_rule` VALUES (8, '7.1.8 ห้ามพนักงานปิดประกาศ เขียนข้อความ จ่ายแจก เอกสาร หรือส่งข้อความอื่นใดทางอิเล็กทรอนิกส์ (Social Media) อันทําให้เกิดความเสียหายต่อบริษัท และ/หรือเกิดความเสียหายต่อพนักงานอื่นใด', 'Y', 'เตือนด้วยลายลักษณ์อักษร');
INSERT INTO `m_rule` VALUES (9, ' 7.1.9 ห้ามพนักงานนําบุคคลภายนอกหรือผู้ที่ไม่เกี่ยวข้องกับงานเข้ามาในสถานที่ของบริษัท โดยไม่ได้รับอนุญาต', 'Y', 'เตือนด้วยลายลักษณ์อักษร');
INSERT INTO `m_rule` VALUES (10, '7.1.10 ห้ามพนักงานช่วยเหลือ สนับสนุน ชักจูง รู้เห็นเป็นใจ หรือเพิกเฉยต่อการกระทําความผิดของพนักงานอื่น ', 'Y', 'เตือนด้วยลายลักษณ์อักษร');
INSERT INTO `m_rule` VALUES (11, '7.1.11 ห้ามพนักงานรับจ้างทํางานให้ผู้อื่น หรือดําเนินธุรกิจใดๆ อันอาจเป็นผลกระทบเวลาทํางาน หรือกิจการของบริษัท', 'Y', 'พักงานไม่รับค่าจ้าง');
INSERT INTO `m_rule` VALUES (12, '7.1.12 พนักงานต้องไม่ใช้เวลาทํางาน ต้อนรับหรือพบปะผู้มาเยือนในธุรกิจส่วนตัว หากมีความจําเป็น จะต้อง ได้รับอนุญาตจากผู้บังคับบัญชาก่อน และให้ใช้สถานที่ตามที่บริษัทจัดไว้ โดยใช้เวลาเท่าที่จําเป็น', 'Y', 'พักงานไม่รับค่าจ้าง');
INSERT INTO `m_rule` VALUES (13, '7.1.13 พนักงานต้องปฏิบัติตาม ระเบียบ คําสั่ง และนโยบายที่เกี่ยวข้องกับความปลอดภัยของอาหาร', 'Y', 'เตือนด้วยลายลักษณ์อักษร');
INSERT INTO `m_rule` VALUES (14, '7.1.14 พนักงานจะต้องบริการลูกค้าเต็มความสามารถ และจะต้องรักษาผลประโยชน์ของบริษัทอย่างสูงสุด', 'Y', 'เตือนด้วยลายลักษณ์อักษร');
INSERT INTO `m_rule` VALUES (15, '7.1.15 พนักงานต้องมาทํางานอย่างปกติและสม่ำเสมอตามวันและเวลาทํางานที่บริษัทประกาศหรือกําหนด ', 'Y', 'เตือนด้วยลายลักษณ์อักษร');
INSERT INTO `m_rule` VALUES (16, '7.1.16 พนักงานต้องมาปฏิบัติงานให้ตรงตามเวลา และไม่หยุดพัก หรือเลิกงานก่อนเวลาที่กําหนดและลงบันทึก เวลาทํางานตามที่บริษัทกําหนด', 'Y', 'เตือนด้วยลายลักษณ์อักษร');
INSERT INTO `m_rule` VALUES (17, '7.1.17 พนักงานที่บริษัทกําหนดให้บันทึกเวลาทํางาน ต้องบันทึกเวลาด้วยตนเองทุกครั้งเมื่อเข้าทํางาน เลิกงาน และ/หรือตามระเบียบฯ กําหนด ห้ามบันทึกเวลาการทํางานแทนผู้อื่น บันทึกเวลาไม่ตรงตามความเป็น จริงหรือยอมให้ผู้อื่นบันทึกเวลาการทํางานแทน', 'Y', 'พักงานไม่รับค่าจ้าง');
INSERT INTO `m_rule` VALUES (18, '7.1.18 พนักงานต้องปฏิบัติหน้าที่อย่างเต็มความสามารถด้วยความซื่อสัตย์สุจริต และขยันหมั่นเพียร ', 'Y', 'เตือนด้วยลายลักษณ์อักษร');
INSERT INTO `m_rule` VALUES (19, '7.1.19 พนักงานต้องปฏิบัติตามกฎแห่งความปลอดภัยในการทํางาน', 'Y', 'พักงานไม่รับค่าจ้าง');
INSERT INTO `m_rule` VALUES (20, '7.1.20 พนักงานต้องปฏิบัติงานด้วยความไม่ประมาทเลินเล่อ ไม่หยอกล้อหรือเล่นกันในเวลาทํางาน ', 'Y', 'พักงานไม่รับค่าจ้าง');
INSERT INTO `m_rule` VALUES (21, '7.1.21 พนักงานต้องไม่กระทําการใดๆ ที่เป็นการละทิ้งหน้าที่', 'Y', 'พักงานไม่รับค่าจ้าง');
INSERT INTO `m_rule` VALUES (22, '7.1.22 ห้ามพนักงานทํางานให้กับบุคคล หรือองค์กรอื่นใด ทั้งนี้ไม่ว่าจะได้รับค่าจ้าง หรือผลประโยชน์ตอบแทนหรือไม่', 'Y', 'ไล่ออก');
INSERT INTO `m_rule` VALUES (23, '7.1.23 พนักงานต้องไม่นอนหรือหลับในเวลาทํางาน', 'Y', 'เตือนด้วยลายลักษณ์อักษร');
INSERT INTO `m_rule` VALUES (24, '7.1.24 พนักงานต้องแนะนํา อํานวยความสะดวกแก่ลูกค้าและผู้ที่มาติดต่อกับบริษัทด้วยความสุภาพเรียบร้อย ', 'Y', 'เตือนด้วยวาจา');
INSERT INTO `m_rule` VALUES (25, '7.1.25 ห้ามพนักงานเล่น Social Media ใดๆ ในทางส่วนตัวขณะทํางาน', 'Y', 'เตือนด้วยวาจา');
INSERT INTO `m_rule` VALUES (26, '7.1.26 พนักงานต้องปฏิบัติตามคําสั่งของผู้บังคับบัญชา เมื่อมีคําสั่งให้ โยกย้าย รวมถึงการสับเปลี่ยนหน้าที่ ตําแหน่ง ตามที่บริษัทเห็นสมควร ซึ่งอาจให้ไปประจําหน่วยงานใด ไม่ว่าจะเป็นการชั่วคราวหรือเป็นการถาวร', 'Y', 'พักงานไม่รับค่าจ้าง');
INSERT INTO `m_rule` VALUES (27, '7.1.27 ห้ามพนักงานปิดประกาศ นัดพบ ประชุม อภิปรายภายในบริษัท รวมทั้งจําหน่ายจ่ายแจก เอกสารภายใน บริษัท โดยไม่ได้รับอนุญาตการรักษาความลับของบริษัท', 'Y', 'ไล่ออก');
INSERT INTO `m_rule` VALUES (28, '7.1.28 พนักงานต้องรักษาความลับของบริษัท ลูกค้า คู่สัญญา พนักงานอื่น หรือบุคคลใดๆ ที่เกี่ยวข้องกับบริษัท ', 'Y', 'ไล่ออก');
INSERT INTO `m_rule` VALUES (29, '7.1.29 พนักงานต้องไม่เปิดเผยข้อมูลความลับบริษัท หรือปกปิดข้อเท็จจริงอันอาจเป็นเหตุให้บริษัท ได้รับความเสียหายการรักษาผลประโยชน์ของบริษัท', 'Y', 'ไล่ออก');
INSERT INTO `m_rule` VALUES (30, '7.1.30 พนักงานต้องช่วยเหลือซึ่งกันและกันในการทํางานเพื่อประโยชน์ของบริษัท', 'Y', 'เตือนด้วยวาจา');

-- ----------------------------
-- Table structure for m_user
-- ----------------------------
DROP TABLE IF EXISTS `m_user`;
CREATE TABLE `m_user`  (
  `usr_id` int NOT NULL AUTO_INCREMENT COMMENT 'รหัสพนักงาน',
  `usr_username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `usr_password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `usr_fname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `usr_lname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `usr_gender` int NULL DEFAULT NULL,
  `usr_email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `usr_tel` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `dep_id` int NULL DEFAULT NULL,
  `usr_position` int NULL DEFAULT NULL,
  `usr_type` int NULL DEFAULT NULL,
  `usr_idcard` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `usr_status` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `prefix_id` int NULL DEFAULT NULL,
  `usr_year` int NULL DEFAULT NULL,
  `usr_count` int NULL DEFAULT NULL,
  PRIMARY KEY (`usr_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_user
-- ----------------------------
INSERT INTO `m_user` VALUES (1, 'admin', 'MQ==', 'Admin', 'SuperAdmin', 1, 'kriangkai', '11', 1, 5, 1, '111', 'Y', 1, 2024, 1);

-- ----------------------------
-- Table structure for usr_department
-- ----------------------------
DROP TABLE IF EXISTS `usr_department`;
CREATE TABLE `usr_department`  (
  `dep_id` int NOT NULL AUTO_INCREMENT,
  `dep_name` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `dep_status` int NULL DEFAULT NULL COMMENT '0 : unactive 1: active',
  PRIMARY KEY (`dep_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of usr_department
-- ----------------------------
INSERT INTO `usr_department` VALUES (1, 'Hr', 1);
INSERT INTO `usr_department` VALUES (3, 'IT', 1);

-- ----------------------------
-- Table structure for usr_position
-- ----------------------------
DROP TABLE IF EXISTS `usr_position`;
CREATE TABLE `usr_position`  (
  `pos_id` int NOT NULL AUTO_INCREMENT,
  `pos_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pos_status` int NOT NULL COMMENT '1 ใช้งาน 2 ไม่ใช้งาน',
  `is_manager` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'N ไม่ใช่ผู้จัดการ  Y ผู้จัดการ',
  PRIMARY KEY (`pos_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of usr_position
-- ----------------------------
INSERT INTO `usr_position` VALUES (5, 'ผู้จัดการ', 1, 'Y');
INSERT INTO `usr_position` VALUES (6, 'พนักงาน', 1, '');

-- ----------------------------
-- View structure for view_user
-- ----------------------------
DROP VIEW IF EXISTS `view_user`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `view_user` AS SELECT
	usr_fname,
	usr_lname,
	usr_id,
	usr_type,
	dep_name,
	pos_name,
	is_manager,
	prefix_name,
	m_user.dep_id,
	usr_status,
	CONCAT(prefix_name,usr_fname,' ',usr_lname) as fullname,usr_position,m_user.prefix_id,
	usr_tel,usr_email,usr_idcard,
	usr_username
FROM
	m_user
	INNER JOIN usr_position ON usr_position.pos_id = m_user.usr_position
	INNER JOIN usr_department ON usr_department.dep_id = m_user.dep_id
	INNER JOIN m_prefix ON m_prefix.prefix_id = m_user.prefix_id ;

SET FOREIGN_KEY_CHECKS = 1;
