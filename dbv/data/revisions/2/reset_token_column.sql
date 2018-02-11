ALTER TABLE `user`
	ADD COLUMN `user_reset_token` TEXT NULL DEFAULT NULL AFTER `user_type`;

ALTER TABLE `user`
	CHANGE COLUMN `user_username` `user_username` VARCHAR(50) NULL AFTER `user_email`,
	CHANGE COLUMN `user_password` `user_password` VARCHAR(120) NULL AFTER `user_username`;

ALTER TABLE `user`
	ADD COLUMN `user_activation_token` TEXT NULL AFTER `user_reset_token`;