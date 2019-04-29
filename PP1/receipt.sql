create table `receipt`(
  `email` varchar(30) not null,
  `car_id` int(11) not null,
  `start_date` TIMESTAMP not null,
  `balance` int(11) not null,
   PRIMARY KEY(email,car_id,start_date)
);