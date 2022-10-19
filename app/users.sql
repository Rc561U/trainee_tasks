CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `unique_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=latin1;

INSERT INTO `users` (`user_id`, `email`, `full_name`, `gender`, `status`) VALUES
	(101,'new@tes.ph','Jassy Sucker','Male','Inactive'),
	(102,'anotheronew@mail.com','Olya Kashanskaya','Female','Active'),
	(103,'ads@asd.lo','aaas asdsad','Female','Active'),
	(104,'l123ocalhost@mail.neta','Jim Royal','Male','Inactive'),
	(105,'dumb@dum.pe','Opla Laou','Male','Inactive'),
	(106,'localhost@mail.net','Jim Royal','Male','Inactive');