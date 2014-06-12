ALTER TABLE `travels`
  DROP `where`;
  
ALTER TABLE  `travels` ADD  `origin` VARCHAR( 250 ) NOT NULL AFTER  `id` ,
ADD  `destination` VARCHAR( 250 ) NOT NULL AFTER  `origin`
  
