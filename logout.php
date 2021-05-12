<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
    		<link rel="stylesheet" type="text/css" href="stylesheet1.css" />
    		<title></title>
	</head>	
	<body>
    <header>
        <nav>
            <b>Tuffy Hotel Booking Website</b>
            <p>
                <a href = "login.php"> Log in </a>
                <a href = "logout.php"> Log Out </a>
                <a href = "signup.php"> Sign Up </a>
            </p> 
        </nav>
    </header>

<?php

session_start();
$temp = $_SESSION['role'];
session_destroy();

if ($temp != "") {
    echo "You have been logged out.";
    echo "<br><a href=\"login.php\"><button>Log in</button></a>";
}
else {
    echo "You cannot log out, you were not logged in.";
    echo "<br><a href=\"login.php\"><button>Log in</button></a>";
}

?>

