CREATE TABLE `flags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `enabled` enum('N','Y') NOT NULL,
  `user_ids` text NOT NULL,
  `group_ids` text NOT NULL,
  `ip_addresses` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM