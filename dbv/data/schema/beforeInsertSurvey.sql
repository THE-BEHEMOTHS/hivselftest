CREATE DEFINER=`homestead`@`%` TRIGGER `hivselftest`.`beforeInsertSurvey` BEFORE INSERT ON `survey` FOR EACH ROW
BEGIN
	SET new.uuid := (SELECT UUID());
END