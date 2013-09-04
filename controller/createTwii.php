<?php
session_start();
include_once("./../model/dbConnect.php");
include_once("twiiOperation.php");

$userid = $_SESSION['userid'];
$body = substr($_POST['body'],0,140);


/**
 Call create POST to handle an now tweet
 */
create_post($userid,$body);
$_SESSION['message'] = "Created a new twii post";

header("Location:index.php");
?>