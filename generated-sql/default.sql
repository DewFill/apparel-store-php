
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- brands
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `brands`;

CREATE TABLE `brands`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- cart_products
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `cart_products`;

CREATE TABLE `cart_products`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `user_id` int unsigned NOT NULL,
    `product_id` int unsigned NOT NULL,
    `size_id` int unsigned,
    `quantity` int unsigned DEFAULT 1 NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `user_product_size` (`user_id`, `product_id`, `size_id`),
    INDEX `user_id` (`user_id`),
    INDEX `product_id` (`product_id`),
    INDEX `cart_products_ibfk_3` (`size_id`),
    CONSTRAINT `cart_products_ibfk_1`
        FOREIGN KEY (`user_id`)
        REFERENCES `users` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT `cart_products_ibfk_2`
        FOREIGN KEY (`product_id`)
        REFERENCES `products` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT `cart_products_ibfk_3`
        FOREIGN KEY (`size_id`)
        REFERENCES `product_sizes` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- categories
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `name` (`name`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- order_products
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `order_products`;

CREATE TABLE `order_products`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `order_id` int unsigned NOT NULL,
    `product_id` int unsigned NOT NULL,
    `size_id` int unsigned,
    `quantity` int unsigned NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `order_products_ibfk_1` (`order_id`),
    INDEX `order_products_ibfk_2` (`product_id`),
    INDEX `size_id` (`size_id`),
    CONSTRAINT `order_products_ibfk_1`
        FOREIGN KEY (`order_id`)
        REFERENCES `orders` (`id`)
        ON UPDATE RESTRICT
        ON DELETE CASCADE,
    CONSTRAINT `order_products_ibfk_2`
        FOREIGN KEY (`product_id`)
        REFERENCES `products` (`id`)
        ON UPDATE RESTRICT
        ON DELETE CASCADE,
    CONSTRAINT `order_products_ibfk_3`
        FOREIGN KEY (`size_id`)
        REFERENCES `product_sizes` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- orders
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `user_id` int unsigned NOT NULL,
    `address` VARCHAR(255) NOT NULL,
    `full_name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `delivery_name` VARCHAR(255) NOT NULL,
    `delivery_price` DECIMAL(10,2) NOT NULL,
    `status` set('placed','completed') DEFAULT 'placed' NOT NULL,
    `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `orders_ibfk_1` (`user_id`),
    CONSTRAINT `orders_ibfk_1`
        FOREIGN KEY (`user_id`)
        REFERENCES `users` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- product_categories
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `product_categories`;

CREATE TABLE `product_categories`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `product_id` int unsigned NOT NULL,
    `category_id` int unsigned NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `product_category` (`product_id`, `category_id`),
    INDEX `product_categories_ibfk_1` (`category_id`),
    CONSTRAINT `product_categories_ibfk_1`
        FOREIGN KEY (`category_id`)
        REFERENCES `categories` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT `product_categories_ibfk_2`
        FOREIGN KEY (`product_id`)
        REFERENCES `products` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- product_images
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `product_images`;

CREATE TABLE `product_images`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `product_id` int unsigned NOT NULL,
    `image` LONGBLOB NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `product_id` (`product_id`),
    CONSTRAINT `product_images_ibfk_1`
        FOREIGN KEY (`product_id`)
        REFERENCES `products` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- product_rating
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `product_rating`;

CREATE TABLE `product_rating`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `product_id` int unsigned NOT NULL,
    `user_id` int unsigned NOT NULL,
    `rating` set('1','2','3','4','5') DEFAULT '' NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `product_id` (`product_id`),
    INDEX `user_id` (`user_id`),
    CONSTRAINT `product_rating_ibfk_2`
        FOREIGN KEY (`user_id`)
        REFERENCES `users` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT `product_rating_ibfk_3`
        FOREIGN KEY (`product_id`)
        REFERENCES `products` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- product_sizes
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `product_sizes`;

CREATE TABLE `product_sizes`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `product_id` int unsigned NOT NULL,
    `size` set('xs','s','m','l','xl','xxl','3xl') NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `product_size` (`product_id`, `size`),
    CONSTRAINT `product_sizes_ibfk_1`
        FOREIGN KEY (`product_id`)
        REFERENCES `products` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- products
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `article` BIGINT,
    `brand_id` int unsigned,
    `price` decimal(10,2) unsigned NOT NULL,
    `discount_price` decimal(10,2) unsigned,
    `description` VARCHAR(255),
    `copmosition` VARCHAR(255) COMMENT 'состав',
    `main_image` LONGBLOB NOT NULL,
    `background_color` VARCHAR(255) COMMENT 'цвет подложки товара',
    PRIMARY KEY (`id`),
    INDEX `brand_id` (`brand_id`),
    CONSTRAINT `products_ibfk_1`
        FOREIGN KEY (`brand_id`)
        REFERENCES `brands` (`id`)
        ON UPDATE CASCADE
        ON DELETE SET NULL
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- slides
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `slides`;

CREATE TABLE `slides`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `image` LONGBLOB NOT NULL COMMENT 'base 64 изображение',
    `url` VARCHAR(255) COMMENT 'ссылка при нажатии на слайд',
    `active` TINYINT(1) DEFAULT 1 NOT NULL COMMENT '1 - слайд показывается; 0 - слайд скрыт',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- user_adresses
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `user_adresses`;

CREATE TABLE `user_adresses`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `user_id` int unsigned NOT NULL,
    `region` VARCHAR(255) NOT NULL COMMENT 'регион',
    `city` VARCHAR(255) NOT NULL COMMENT 'город',
    `district` VARCHAR(255) NOT NULL COMMENT 'район',
    `street` VARCHAR(255) NOT NULL COMMENT 'улица',
    `zip_code` VARCHAR(255) NOT NULL COMMENT 'индекс',
    `house` VARCHAR(255) NOT NULL COMMENT 'номер дома',
    `apartment` VARCHAR(255) COMMENT 'номер квартиры',
    PRIMARY KEY (`id`),
    INDEX `user_adresses_ibfk_1` (`user_id`),
    CONSTRAINT `user_adresses_ibfk_1`
        FOREIGN KEY (`user_id`)
        REFERENCES `users` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- user_favorites
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `user_favorites`;

CREATE TABLE `user_favorites`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `user_id` int unsigned NOT NULL,
    `product_id` int unsigned NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `user_product` (`product_id`, `user_id`),
    INDEX `user_id` (`user_id`),
    INDEX `product_id` (`product_id`),
    CONSTRAINT `user_favorites_ibfk_1`
        FOREIGN KEY (`user_id`)
        REFERENCES `users` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT `user_favorites_ibfk_2`
        FOREIGN KEY (`product_id`)
        REFERENCES `products` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- users
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `main_address_id` int unsigned,
    `email` VARCHAR(249) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `name` VARCHAR(255),
    `surname` VARCHAR(255),
    `patronymic` VARCHAR(255),
    `phone_number` VARCHAR(255),
    `birthday` DATE,
    `gender` set('man','woman'),
    `username` VARCHAR(100),
    `status` tinyint unsigned DEFAULT 0 NOT NULL,
    `verified` tinyint unsigned DEFAULT 0 NOT NULL,
    `resettable` tinyint unsigned DEFAULT 1 NOT NULL,
    `roles_mask` int unsigned DEFAULT 0 NOT NULL,
    `registered` int unsigned NOT NULL,
    `last_login` int unsigned,
    `force_logout` mediumint unsigned DEFAULT 0 NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `email` (`email`),
    INDEX `users_ibfk_1` (`main_address_id`),
    CONSTRAINT `users_ibfk_1`
        FOREIGN KEY (`main_address_id`)
        REFERENCES `user_adresses` (`id`)
        ON UPDATE CASCADE
        ON DELETE SET NULL
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- users_confirmations
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `users_confirmations`;

CREATE TABLE `users_confirmations`
(
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `user_id` int unsigned NOT NULL,
    `email` VARCHAR(249) NOT NULL,
    `selector` VARCHAR(16) NOT NULL,
    `token` VARCHAR(255) NOT NULL,
    `expires` int unsigned NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `selector` (`selector`),
    INDEX `email_expires` (`email`, `expires`),
    INDEX `user_id` (`user_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- users_remembered
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `users_remembered`;

CREATE TABLE `users_remembered`
(
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `user` int unsigned NOT NULL,
    `selector` VARCHAR(24) NOT NULL,
    `token` VARCHAR(255) NOT NULL,
    `expires` int unsigned NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `selector` (`selector`),
    INDEX `user` (`user`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- users_resets
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `users_resets`;

CREATE TABLE `users_resets`
(
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `user` int unsigned NOT NULL,
    `selector` VARCHAR(20) NOT NULL,
    `token` VARCHAR(255) NOT NULL,
    `expires` int unsigned NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `selector` (`selector`),
    INDEX `user_expires` (`user`, `expires`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- users_throttling
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `users_throttling`;

CREATE TABLE `users_throttling`
(
    `bucket` VARCHAR(44) NOT NULL,
    `tokens` float unsigned NOT NULL,
    `replenished_at` int unsigned NOT NULL,
    `expires_at` int unsigned NOT NULL,
    PRIMARY KEY (`bucket`),
    INDEX `expires_at` (`expires_at`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
