ALTER TABLE `user`
	ADD COLUMN `user_type` VARCHAR(50) NOT NULL AFTER `user_created_at`;