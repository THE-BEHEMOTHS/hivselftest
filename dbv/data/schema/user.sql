CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(36) NOT NULL,
  `user_firstname` varchar(150) NOT NULL,
  `user_lastname` varchar(150) NOT NULL,
  `user_email` varchar(200) NOT NULL,
  `user_password` varchar(120) NOT NULL,
  `user_avatar` text,
  `user_is_active` int(11) DEFAULT '1',
  `user_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uuid` (`uuid`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1