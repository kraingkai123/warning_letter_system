INSERT INTO `warning_letter_system`.`m_menu`(`menu_id`, `menu_name`, `menu_type`, `menu_image`, `menu_group`, `menu_url`, `manager_status`, `order_menu`) VALUES (13, 'ตั้งค่ากระทำผิด', 1, 'nc-album-2', 1, 'setup_mistake.php', NULL, 12);

CREATE TABLE `warning_letter_system`.`mistake`  (
  `mistake_id` int NOT NULL AUTO_INCREMENT,
  `mistake_name` varchar(255) NULL,
  `mistake_status` varchar(1) NULL,
  PRIMARY KEY (`mistake_id`)
);
ALTER TABLE `warning_letter_system`.`m_letter` 
ADD COLUMN `mistake_id` int NULL AFTER `org_name`;
