CREATE TABLE IF NOT EXISTS `drivers_travels_by_email` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `driver_id` bigint(20) unsigned NOT NULL,
  `travel_id` bigint(20) unsigned NOT NULL,
  `sent` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `drivers_travels_by_email_driver_fk` (`driver_id`),
  KEY `drivers_travels_by_email_travel_fk` (`travel_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_bin AUTO_INCREMENT=15 ;

ALTER TABLE `drivers_travels_by_email`
  ADD CONSTRAINT `drivers_travels_by_email_ibfk_1` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`),
  ADD CONSTRAINT `drivers_travels_by_email_ibfk_2` FOREIGN KEY (`travel_id`) REFERENCES `travels_by_email` (`id`);