ALTER TABLE `warning_letter_system`.`m_letter_type` 
ADD COLUMN `detail_1` text NULL AFTER `letter_type_status`,
ADD COLUMN `detail_2` text NULL AFTER `detail_1`,
ADD COLUMN `detail_3` text NULL AFTER `detail_2`;

ALTER TABLE `warning_letter_system`.`m_letter` 
ADD COLUMN `type_detail_1` text NULL AFTER `hr_appove_status`,
ADD COLUMN `type_detail_2` text NULL AFTER `type_detail_1`,
ADD COLUMN `type_detail_3` text NULL AFTER `type_detail_2`;

ALTER TABLE `warning_letter_system`.`m_letter` 
ADD COLUMN `letter_date_do` date NULL AFTER `type_detail_3`;

CREATE OR REPLACE ALGORITHM = UNDEFINED DEFINER = `root`@`localhost` SQL SECURITY DEFINER VIEW `warning_letter_system`.`view_user` AS SELECT
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
	INNER JOIN m_prefix ON m_prefix.prefix_id = m_user.prefix_id;