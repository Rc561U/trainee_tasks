CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `unique_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=latin1;

INSERT INTO `users` (`user_id`, `email`, `full_name`, `gender`, `status`) VALUES
	(145,'localhost@mail.neta','','Female','Active'),
	(147,'tes2221121t@email.comas','Jim Royal','Male','Active'),
	(149,'test2@email.co','Jim Roayal','Female','Active'),
	(150,'localhost@mail.net','Jim Royal','Male','Inactive');