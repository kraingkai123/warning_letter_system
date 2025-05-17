ALTER TABLE `warning_letter_system`.`usr_department` 
ADD COLUMN `org_status` varchar(1) NULL COMMENT 'Y : สาขา' AFTER `dep_status`


INSERT INTO `warning_letter_system`.`m_menu`(`menu_id`, `menu_name`, `menu_type`, `menu_image`, `menu_group`, `menu_url`, `manager_status`, `order_menu`) VALUES (11, 'เซ็นเอกสาร', 1, 'nc-badge', 1, 'signBook.php', NULL, 11);
INSERT INTO `warning_letter_system`.`m_menu`(`menu_id`, `menu_name`, `menu_type`, `menu_image`, `menu_group`, `menu_url`, `manager_status`, `order_menu`) VALUES (12, 'เซ็นเอกสาร', 2, 'nc-badge', 2, 'signBook.php', 'N', 11);


ALTER TABLE `warning_letter_system`.`m_letter` 
ADD COLUMN `org_id` int NULL AFTER `type_detail_2`,
ADD COLUMN `org_name` varchar(255) NULL AFTER `org_id`;