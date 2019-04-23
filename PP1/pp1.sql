Create table registration
(
 `FirstName` varchar(39) NOT NULL,
 `LastName` varchar(39) NOT NULL,
 `email` varchar(50) NOT NULL,
 `password` varchar(40) NOT NULL,
 `passwordVerify` varchar(40) NOT NULL,
  primary key(email)
);