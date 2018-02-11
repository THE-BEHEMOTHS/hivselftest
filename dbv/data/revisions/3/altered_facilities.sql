ALTER TABLE `hivselftest`.`facilities` 
ADD COLUMN `description` TEXT NULL AFTER `county_name`,
ADD COLUMN `nearest_town` VARCHAR(150) NULL AFTER `description`;
