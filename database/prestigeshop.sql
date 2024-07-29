CREATE TABLE IF NOT EXISTS `prestigeshop`.`customers` (
    `user_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `firstname` VARCHAR(50) NOT NULL,
    `lastname` VARCHAR(50) NOT NULL,
    `address` VARCHAR(50) NOT NULL,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `prestigeshop`.`admin` (
    `admin_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `customers` (`user_id`)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `prestigeshop`.`category` (
    `category_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `category_name` VARCHAR(100) NOT NULL
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `subcategory` (
    `subcategory_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `subcategory_name` VARCHAR(100) NOT NULL,
    `category_id` INT NOT NULL,
    CONSTRAINT `fk_category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`)
) ENGINE = InnoDB;

CREATE TABLE `prestigeshop`.`products` (
    `product_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `product_name` VARCHAR(100) NOT NULL,
    `stock` INT NOT NULL,
    `sold_count` INT NOT NULL,
    `price` DECIMAL(10,2) NOT NULL,
    `brand` VARCHAR(100) NOT NULL,
    `description` VARCHAR(255) NOT NULL,
    `subcategory_id` INT NOT NULL,
    CONSTRAINT `fk_subcategory_id` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategory` (`subcategory_id`)
) ENGINE = InnoDB;

