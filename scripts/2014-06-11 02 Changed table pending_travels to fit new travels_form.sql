ALTER TABLE `pending_travels`
  DROP `where`;
  
ALTER TABLE  `pending_travels` ADD  `origin` VARCHAR( 250 ) NOT NULL AFTER  `id` ,
ADD  `destination` VARCHAR( 250 ) NOT NULL AFTER  `origin`