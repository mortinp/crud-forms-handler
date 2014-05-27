CREATE TABLE IF NOT EXISTS `pending_travels` (
  `id` char(36) CHARACTER SET ascii NOT NULL,
  `locality_id` bigint(20) unsigned NOT NULL,
  `where` varchar(250) NOT NULL,
  `direction` tinyint(4) NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  `people_count` int(11) NOT NULL,
  `contact` text NOT NULL,
  `need_modern_car` tinyint(1) NOT NULL,
  `need_air_conditioner` int(11) NOT NULL,
  `created` date NOT NULL,
  `created_from_ip` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `pending_travels_locality_fk` (`locality_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `pending_travels`
  ADD CONSTRAINT `pending_travels_ibfk_1` FOREIGN KEY (`locality_id`) REFERENCES `localities` (`id`)