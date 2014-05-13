ALTER TABLE  `localities_thesaurus` ADD FOREIGN KEY (  `locality_id` ) REFERENCES  `yotellevo`.`localities` (
`id`
) ON DELETE RESTRICT ON UPDATE RESTRICT ;