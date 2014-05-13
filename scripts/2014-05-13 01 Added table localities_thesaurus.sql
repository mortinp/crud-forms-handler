CREATE TABLE IF NOT EXISTS `localities_thesaurus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `locality_id` bigint(20) unsigned NOT NULL,
  `fake_name` varchar(250) COLLATE latin1_bin NOT NULL,
  `real_name` varchar(250) COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin AUTO_INCREMENT=1 ;