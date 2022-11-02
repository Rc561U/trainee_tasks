CREATE TABLE IF NOT EXISTS `authentication` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `email` varchar(100) NOT NULL,
    `name` varchar(100) NOT NULL,
    `password` varchar(60) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `unique_email` (`email`)
    ) ENGINE=InnoDB AUTO_INCREMENT=160 DEFAULT CHARSET=latin1;