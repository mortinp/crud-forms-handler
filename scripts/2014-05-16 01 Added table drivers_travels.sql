CREATE TABLE IF NOT EXISTS `drivers_travels` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `driver_id` bigint(20) unsigned NOT NULL,
  `travel_id` bigint(20) unsigned NOT NULL,
  `sent` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin AUTO_INCREMENT=1 ;

ALTER TABLE  `yotellevo`.`drivers_travels` ADD INDEX  `drivers_travels_driver_fk` (  `driver_id` );

ALTER TABLE  `drivers_travels` ADD FOREIGN KEY (  `driver_id` ) REFERENCES  `yotellevo`.`drivers` (
`id`
) ON DELETE RESTRICT ON UPDATE RESTRICT ;

ALTER TABLE  `yotellevo`.`drivers_travels` ADD INDEX  `drivers_travels_travel_fk` (  `travel_id` );

ALTER TABLE  `drivers_travels` ADD FOREIGN KEY (  `travel_id` ) REFERENCES  `yotellevo`.`travels` (
`id`
) ON DELETE RESTRICT ON UPDATE RESTRICT ;