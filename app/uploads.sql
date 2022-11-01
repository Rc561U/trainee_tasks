CREATE TABLE IF NOT EXISTS `uploads` (
    `id` int NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    `size` int NOT NULL,
    `mime` int NOT NULL,
    `path` varchar(120) NOT NULL,
    `created_date` int DEFAULT NULL,
    `height` int DEFAULT NULL,
    `weight` int DEFAULT NULL,
    `upload_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `key_name` (`name`)
    ) ENGINE=InnoDB  DEFAULT CHARSET=latin1;