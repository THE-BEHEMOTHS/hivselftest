CREATE DEFINER=`root`@`localhost` TRIGGER `beforeInsertSurvey` BEFORE INSERT ON `survey`
 FOR EACH ROW BEGIN
	SET new.uuid := (SELECT uuid());
END