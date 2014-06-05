ALTER TABLE  `travels_by_email` ADD  `need_modern_car` BOOLEAN NOT NULL AFTER  `drivers_sent_count` ,
ADD  `need_air_conditioner` BOOLEAN NOT NULL AFTER  `need_modern_car`;