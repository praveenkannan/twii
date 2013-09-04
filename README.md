twii
===
===	


A Simple client Server application demonstrating Twitter like system


Usage
====
* Requirement: classical LAMP stack installed and web server configured
* Get sourcecode: git clone https://github.com/praveenkannan/twii
* Configure the Databases as given below
* Copy this project into your webserver home page and load index.html page


DB Schema
=========
**User table**

	twii_user
	{
		`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
		`username` VARCHAR( 100 ) NOT NULL ,
		`email` VARCHAR( 100 ) NOT NULL ,
		`password` VARCHAR( 8 ) NOT NULL ,
	}

	mysql> desc twii_user
		+----------+--------------+------+-----+---------+----------------+
		| Field    | Type         | Null | Key | Default | Extra          |
		+----------+--------------+------+-----+---------+----------------+
		| id       | int(11)      | NO   | PRI | NULL    | auto_increment |
		| username | varchar(100) | NO   |     | NULL    |                |
		| email    | varchar(100) | NO   |     | NULL    |                |
		| password | varchar(8)   | NO   |     | NULL    |                |
		+----------+--------------+------+-----+---------+----------------+
	
	mysql> select * from twii_user;
		+----+----------+----------------+----------+
		| id | username | email          | password |
		+----+----------+----------------+----------+
		|  1 | user1    | user1@twii.com | password |
		|  2 | user2    | user2@twii.com | password |
		|  3 | user3    | user3@twii.com | password |
		|  4 | user4    | user4@twii.com | password |
		|  5 | user5    | user5@twii.com | password |
		+----+----------+----------------+----------+
		5 rows in set (0.00 sec)

**Follow Table:** To track the followers mappings

	twii_follower
	{
		`user_id` INT NOT NULL ,
		`follower_id` INT NOT NULL ,
		PRIMARY KEY ( `user_id` , `follower_id` )
	}
	
	mysql> desc twii_follower
		+-------------+---------+------+-----+---------+-------+
		| Field       | Type    | Null | Key | Default | Extra |
		+-------------+---------+------+-----+---------+-------+
		| user_id     | int(11) | NO   | PRI | NULL    |       |
		| follower_id | int(11) | NO   | PRI | NULL    |       |
		+-------------+---------+------+-----+---------+-------+
	
	mysql> select * from twii_follower;
		+---------+-------------+
		| user_id | follower_id |
		+---------+-------------+
		|       1 |           2 |
		|       1 |           3 |
		|       1 |           4 |
		|       1 |           5 |
		|       2 |           3 |
		|       2 |           4 |
		|       2 |           5 |
		+---------+-------------+
		7 rows in set (0.00 sec)

**Tweet:** tweets/posts
	
	twii_post
	{
		`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
		`user_id` INT NOT NULL ,
		`body` VARCHAR( 140 ) NOT NULL ,
		`timestamp` DATETIME NOT NULL
	}

	mysql> desc twii_post
		+-----------+--------------+------+-----+---------+----------------+
		| Field     | Type         | Null | Key | Default | Extra          |
		+-----------+--------------+------+-----+---------+----------------+
		| id        | int(11)      | NO   | PRI | NULL    | auto_increment |
		| user_id   | int(11)      | NO   |     | NULL    |                |
		| body      | varchar(140) | NO   |     | NULL    |                |
		| timestamp | datetime     | NO   |     | NULL    |                |
		+-----------+--------------+------+-----+---------+----------------+

	mysql> mysql> select * from twii_post;
		+----+---------+------------------------------------------------------+---------------------+
		| id | user_id | body                                                 | timestamp           |
		+----+---------+------------------------------------------------------+---------------------+
		|  1 |       1 | this is a sample post                                | 2013-09-03 22:54:48 |
		|  2 |       1 | yet another tweet                                    | 2013-09-03 23:45:17 |
		|  3 |       1 | it is a beautiful day                                | 2013-09-03 23:45:31 |
		|  4 |       2 | Saw rainbow today                                    | 2013-09-03 23:45:47 |
		|  5 |       3 | tiring trip to berkley adn return back. Took 3 hours | 2013-09-03 23:46:15 |
		|  6 |       3 | Fedrer loses USOPEN chance                           | 2013-09-03 23:46:40 |
		|  7 |       4 | Fedrer loses USOPEN chance                           | 2013-09-03 23:46:46 |
		|  8 |       5 | Fedrer loses USOPEN chance                           | 2013-09-03 23:46:51 |
		|  9 |       5 | Awesome weather in seattle today                     | 2013-09-03 23:47:05 |
		| 10 |       2 | Looking forward to thursday night football           | 2013-09-03 23:47:30 |
		+----+---------+------------------------------------------------------+---------------------+
		10 rows in set (0.00 sec)
		
Operations supported
====================
* add a tweet
* see your tweets
* see tweets of followers
* follow tweets
* unfollow tweets


DB configurations
=====

* UserName and Passwords

		example user name: user1
		example password: password
	
	This file has hard coded user and password to querry DB. Add your username and password. 
* create tables
		
		./model/db 
	has three sql queries to create tables. Execute those sql queries in order to create the DBs or exexute the twii_db.sql dump file.
	
		mysql -uroot < /model/twii_db.sql
		USE twii_db
	
---


