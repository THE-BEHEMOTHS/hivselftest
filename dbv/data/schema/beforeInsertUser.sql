CREATE DEFINER=`homestead`@`%` TRIGGER `beforeInsertUser` BEFORE INSERT ON `user` FOR EACH ROW BEGIN
	SET new.uuid := (SELECT uuid());
END