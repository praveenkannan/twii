<?php


/**
 	This will just create a tweet and make a DB entry for the same
*/
function create_post($userId, $postData)
{
	$sql = "INSERT INTO twii_post (user_id, postData, timestamp)
                      VALUES ($userid, '". mysql_real_escape_string($postData). "',now())";
                      
	$result = myslq_query($sql);
}

/**
	twii_posts: returns all the tweets done by user $user_id with latest tweet first
*/
function twii_posts($userid){
	$posts = array();

	//GET the latest feed first
	/**
	Tested Example: 
	mysql> select body, timestamp from twii_post where user_id='1' order by timestamp desc;
	+-----------------------+---------------------+
	| body                  | timestamp           |
	+-----------------------+---------------------+
	| it is a beautiful day | 2013-09-03 23:45:31 |
	| yet another tweet     | 2013-09-03 23:45:17 |
	| this is a sample post | 2013-09-03 22:54:48 |
	+-----------------------+---------------------+
	3 rows in set (0.00 sec)
	*/
	$sql = "SELECT body, timestamp 
			FROM twii_post
	 		WHERE user_id = '$userid' 
	 		ORDER BY timestamp DESC";
	 		
	
	$result = mysql_query($sql);
	
	
	while($data = mysql_fetch_object($result)){
		$posts[] = array( 	'stamp' => $data->timestamp, 
							'userid' => $userid, 
							'body' => $data->body
					);
	}
	return $posts;
}

/**
	To list all the follower of a particulat user
*/
function twii_followers($userid){
	$users = array();

	/**
	Tested Example:
	mysql> select DISTINCT user_id from twii_follower where follower_id='5'
    -> ;
	+---------+
	| user_id |
	+---------+
	|       1 |
	|       2 |
	+---------+
	2 rows in set (0.00 sec)
	*/

	$sql = "SELECT DISTINCT user_id 
			FROM twii_follower
			WHERE follower_id = '$userid'";
	$result = mysql_query($sql);

	while($data = mysql_fetch_object($result)){
		array_push($users, $data->user_id);

	}

	return $users;

}

/**
	Get all the users using twii
	Design consideration:
		- Insted of making a blind query with this DB, if we consider shrading this DB then
		we could query users based on machine_index and then query the users.
		- LIMIT the users to querry and then create iterators
*/
function twii_userList(){
	$users = array();
	
	/**
	Tested example:
	mysql> select id, username from twii_user order by username;
	+----+----------+
	| id | username |
	+----+----------+
	|  1 | user1    |
	|  2 | user2    |
	|  3 | user3    |
	|  4 | user4    |
	|  5 | user5    |
	+----+----------+
	5 rows in set (0.00 sec)
	*/
	$sql = "SELECT id, username 
			FROM twii_user 
			ORDER BY username";
	$result = mysql_query($sql);

	while ($data = mysql_fetch_object($result)){
		$users[$data->id] = $data->username;
	}
	return $users;
}

/**
	Feeds of followers
	This is a very simple feeds function: There are lots of optimizations we can do on makign this better
	Some of the considerations we can make here are
	(i) Filters: Donot show all the feeds of all the followers, instead query
		- last x feeds
		- feeds of only last YY minutes and before
	(ii) Modify this function to have a listener which can listen to an PUSH based event system and update feeds
*/
function twii_followerFeed($userid) {
	$posts = array();

	//GET the latest feed first
	/**
		mysql> SELECT DISTINCT twii_post.user_id, twii_post.body, twii_post.timestamp 
			FROM twii_post 
				INNER JOIN twii_follower 
					ON twii_post.user_id = twii_follower.follower_id 
			WHERE twii_follower.user_id=1 
			ORDER BY timestamp DESC;
		+---------+------------------------------------------------------+---------------------+
		| user_id | body                                                 | timestamp           |
		+---------+------------------------------------------------------+---------------------+
		|       2 | Looking forward to thursday night football           | 2013-09-03 23:47:30 |
		|       5 | Awesome weather in seattle today                     | 2013-09-03 23:47:05 |
		|       5 | Fedrer loses USOPEN chance                           | 2013-09-03 23:46:51 |
		|       4 | Fedrer loses USOPEN chance                           | 2013-09-03 23:46:46 |
		|       3 | Fedrer loses USOPEN chance                           | 2013-09-03 23:46:40 |
		|       3 | tiring trip to berkley adn return back. Took 3 hours | 2013-09-03 23:46:15 |
		|       2 | Saw rainbow today                                    | 2013-09-03 23:45:47 |
		+---------+------------------------------------------------------+---------------------+
		7 rows in set (0.01 sec)
	*/
	$sql = "SELECT DISTINCT twii_post.user_id, twii_post.body, twii_post.timestamp 
			FROM twii_post
				INNER JOIN twii_follower 
					ON twii_post.user_id = twii_follower.follower_id
			WHERE twii_follower.user_id = $userid
			ORDER BY timestamp DESC";
	$result = mysql_query($sql);
	
	
	while($data = mysql_fetch_object($result)){
		$posts[] = array( 	'timestamp' => $data->timestamp, 
							'userid' => $userid, 
							'body' => $data->body
					);
	}
	return $posts;
}



function follow($me,$toFollow){
	$sql = "SELECT count(*) 
			FROM twii_follower 
			WHERE user_id='$toFollow' and follower_id='$me'";
	$result = mysql_query($sql);
	$count = mysql_fetch_row($result);
	
	//Call only when you have not followed the user	
	if ($count[0] == 0){
		$sql = "insert into following (user_id, follower_id) 
				values ($toFollow,$me)";

		$result = mysql_query($sql);
	}
}


function unfollow($me,$toUnFollow){
	$sql = "SELECT count(*) 
			FROM twii_follower 
			WHERE user_id='$toUnFollow' and follower_id='$me'";
	$result = mysql_query($sql);
	$count = mysql_fetch_row($result);
	
	//DELETE only when you have followed this user 
	if ($count[0] != 0){
		$sql = "DELETE FROM twii_follower 
				WHERE user_id='$toUnFollow' and follower_id='$me'
				limit 1";

		$result = mysql_query($sql);
	}
}

?>