CREATE TABLE `pharmacies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pharmacy_name` varchar(200) DEFAULT NULL,
  `pharmacy_contact_person` varchar(200) DEFAULT NULL,
  `pharmacy_phone` varchar(20) DEFAULT NULL,
  `pharmacy_location` varchar(100) DEFAULT NULL,
  `pharmacy_latitude` varchar(20) DEFAULT NULL,
  `pharmacy_longitude` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1