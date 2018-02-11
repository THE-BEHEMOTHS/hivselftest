ALTER TABLE `user`
	COMMENT='There are ',
	ADD COLUMN `user_username` VARCHAR(50) NOT NULL AFTER `user_email`,
	ADD UNIQUE INDEX `user_username` (`user_username`);