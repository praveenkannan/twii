<html>

<head>
login page
</head>

<body>
<?php


set_include_path(get_include_path() . PATH_SEPARATOR . './model');
set_include_path(get_include_path() . PATH_SEPARATOR . './view');

// Inialize session
session_start();

// Include database connection settings
include_once('./model/dbConnect.php');

// Retrieve username and password from database according to user's input
$login = mysql_query("SELECT * FROM twii_user WHERE (username = '" . mysql_real_escape_string($_POST['username']) . "') and (password = '" . mysql_real_escape_string($_POST['password']) . "')");

var_dump($login);

// Check username and password match
if (mysql_num_rows($login) == 1) {
	// Set username session variable
	$_SESSION['username'] = $_POST['username'];
	// Jump to secured page
	header('Location: ./view/secureTwii.php');
}
else {
	// Jump to login page
	header('Location: ./view/landing.html');
}

?>

</body>
</html>