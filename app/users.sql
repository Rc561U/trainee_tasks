CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `unique_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=160 DEFAULT CHARSET=latin1;

INSERT INTO `users` (`user_id`, `email`, `full_name`, `gender`, `status`) VALUES
	(152,'localhost@mail.nets','Jim Royal','Male','Active'),
	(157,'ads@asd.lo','Jim Royal','Male','Inactive'),
	(158,'localhost@mail.net','Jim Royal','Male','Active'),
	(159,'st@mail.net','Name Surname','Male','Active');