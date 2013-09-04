<?php
session_start();
include_once("dbConnect.php");
include_once("twiiOperation.php");

$id = $_GET['id'];
$followAction = $_GET['do'];

switch ($followAction){
	case "follow":
		follow($_SESSION['userid'],$id);
		$msg = "You now follow this user!";
	break;

	case "unfollow":
		unfollow($_SESSION['userid'],$id);
		$msg = "You no longer follow this user!";
	break;

}
$_SESSION['message'] = $msg;

header("Location:index.php");
?>