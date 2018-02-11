ALTER TABLE `survey` 
DROP COLUMN `kits`,
CHANGE COLUMN `gender` `gender` INT NULL DEFAULT 0 ;

ALTER TABLE `kits` 
CHANGE COLUMN `status` `status` INT(11) NULL DEFAULT 1 ;

