CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `unique_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=latin1;

INSERT INTO `users` (`user_id`, `email`, `full_name`, `gender`, `status`) VALUES
	(123,'ads@asd.loadaas','Name Surname','Male','Inactive'),
	(125,'ads@asd.load','Jim Royal','Male','Active'),
	(128,'localhost@mail.neta','Jim Royal','Male','Inactive');