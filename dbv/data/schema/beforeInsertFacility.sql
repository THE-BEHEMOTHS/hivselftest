CREATE DEFINER=`homestead`@`%` TRIGGER `beforeInsertFacility` BEFORE INSERT ON `facilities` FOR EACH ROW BEGIN
	SET new.uuid := (SELECT UUID());
END