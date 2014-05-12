ALTER TABLE  `yotellevo`.`drivers` ADD UNIQUE  `drivers_username_unique` (  `username` );
ALTER TABLE  `yotellevo`.`users` ADD UNIQUE  `users_username_unique` (  `username` );
ALTER TABLE  `yotellevo`.`drivers_localities` ADD UNIQUE  `drivers_localities_unique` (  `driver_id` ,  `locality_id` );
ALTER TABLE  `yotellevo`.`pending_users` ADD UNIQUE  `pending_users_username_unique` (  `username` );