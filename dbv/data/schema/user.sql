CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(36) NOT NULL,
  `user_firstname` varchar(150) NOT NULL,
  `user_lastname` varchar(150) NOT NULL,
  `user_email` varchar(200) NOT NULL,
  `user_username` varchar(50) DEFAULT NULL,
  `user_password` varchar(120) DEFAULT NULL,
  `user_avatar` text,
  `user_is_active` int(11) DEFAULT '1',
  `user_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_type` varchar(50) NOT NULL,
  `user_reset_token` text,
  `user_activation_token` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uuid` (`uuid`),
  UNIQUE KEY `user_email` (`user_email`),
  UNIQUE KEY `user_username` (`user_username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='There are '