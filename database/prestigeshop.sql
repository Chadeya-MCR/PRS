CREATE TABLE `customers` (
  `user_id` INT NOT NULL AUTO_INCREMENT , 
   `firstname` VARCHAR(50) NOT NULL , 
  `lastname` VARCHAR(50) NOT NULL ,
  `email` VARCHAR(100) NOT NULL , 
  `password` VARCHAR(255) NOT NULL ,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`user_id`), UNIQUE (`email`(100))) ENGINE = InnoDB;