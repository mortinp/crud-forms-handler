ALTER TABLE  `travels_by_email` CHANGE  `user_locality`  `user_origin` VARCHAR( 250 ) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL;
ALTER TABLE  `travels_by_email` ADD  `user_destination` VARCHAR( 250 ) NOT NULL AFTER  `user_origin`;
ALTER TABLE  `travels_by_email` ADD  `matched` VARCHAR( 250 ) NOT NULL AFTER  `user_destination`;