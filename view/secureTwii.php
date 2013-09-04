<?php 
session_start();
include_once('./../model/dbConnect.php');
include_once('./../controller/twiiOperation.php');

$_SESSION['userid'] = 1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Twii Dev - Index Landing Page</title>
</head>

<body>
	<?php
	if (isset($_SESSION['message'])){
		echo "<b>". $_SESSION['message']."</b>";
		unset($_SESSION['message']);
	}
	?>	
	
	
	<!-- new FORM to seek twii post from User -->
	<form method='post' action='./../controller/createTwii.php'>
		<p>Twii:</p>
			<textarea name='body' rows='5' cols='100' wrap=VIRTUAL></textarea>
		<p><input type='submit' value='submit'/></p>
	</form>

	<!--Showing posts from followers -->
	<?php
		$posts = twii_followerFeed($_SESSION['userid']);
		
		if (count($posts)){
	?>
	<table border='1' cellspacing='0' cellpadding='5' width='200'>
		<?php
			foreach ($posts as $key => $list){
				echo "<tr valign='top'>\n";
				echo "<td>".$list['userid'] ."</td>\n";
				echo "<td>".$list['postBody'] ."<br/>\n";
				echo "<small>".$list['timeStamp'] ."</small></td>\n";
				echo "</tr>\n";
			}
		?>
	</table>
	<?php
		}else{
		?>
		<p><b>No twii's from your followers</b></p>
	<?php
	}
	?>
	
	<!--Showing past posts from the User -->
	<?php
		$posts = twii_posts($_SESSION['userid']);
		
		if (count($posts)){
	?>
	<table border='1' cellspacing='0' cellpadding='5' width='200'>
		<?php
			foreach ($posts as $key => $list){
				echo "<tr valign='top'>\n";
				echo "<td>".$list['userid'] ."</td>\n";
				echo "<td>".$list['postBody'] ."<br/>\n";
				echo "<small>".$list['timeStamp'] ."</small></td>\n";
				echo "</tr>\n";
			}
		?>
	</table>
	<?php
		}else{
		?>
		<p><b>No twii's from you to show</b></p>
	<?php
	}
	?>
	
</body>
</html>