CREATE TABLE `twii_follower` (
	`user_id` INT NOT NULL ,
	`follower_id` INT NOT NULL ,
	PRIMARY KEY ( `user_id` , `follower_id` )
) ENGINE = MYISAM ;