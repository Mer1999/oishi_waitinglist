DROP TABLE `waitinglist`;
CREATE TABLE IF NOT EXISTS `waitinglist`(
   `customer_number` int NOT NULL AUTO_INCREMENT,
   `customer_name` VARCHAR(20) NOT NULL,
   `customer_phone` VARCHAR(10) NOT NULL,
   `customer_pp` INT NOT NULL,
   `submission_time` TIME NOT NULL,
   PRIMARY KEY ( `customer_number` )
)ENGINE=InnoDB DEFAULT CHARSET=utf8;