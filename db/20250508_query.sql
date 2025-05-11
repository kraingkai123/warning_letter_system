ALTER TABLE `warning_letter_system`.`m_letter` 
ADD COLUMN `manager_id` int NULL AFTER `type_detail_3`,
ADD COLUMN `manager_name` varchar(255) NULL AFTER `manager_id`,
ADD COLUMN `manager_pos` varchar(255) NULL AFTER `manager_name`,
ADD COLUMN `manager_sign_date` date NULL AFTER `manager_pos`,
ADD COLUMN `target_date` date NULL AFTER `manager_sign_date`;

ALTER TABLE `warning_letter_system`.`m_letter` 
ADD COLUMN `manager_image` varchar(255) NULL AFTER `target_date`;