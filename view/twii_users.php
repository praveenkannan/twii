<?php 
session_start();
include_once("./../model/dbConnect.php");
include_once("./../controller/twiiOperation.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Twii - Users Display</title>
</head>
<body>

<h1>Twii users</h1>

	<?php
	
		$users = twii_userList();
		$following = following($_SESSION['userid']);
		
		if (count($users)){
	?>
		<table border='1' cellspacing='2' cellpadding='5' width='100'>
	<?php
		foreach ($users as $key => $value){
			echo "<tr valign='top'>\n";
			echo "<td>".$key ."</td>\n";
			echo "<td>".$value;
			if (in_array($key,$following)){
				echo " <small>
				<a href='./../controller/followTwii.php?id=$key&followAction=unfollow'>unfollow</a>
				</small>";
			}else{
				echo " <small>
				<a href='./../controller/followTwii.php?id=$key&followAction=follow'>follow</a>
				</small>";
			}
			echo "</td>\n";
			echo "</tr>\n";
		}
	?>
		</table>
	<?php
		}else{
	?>
		<p><b>There are no users in the system!</b></p>
	<?php
		}
	?>
	
	
	<!-- -->
</body>
</html>