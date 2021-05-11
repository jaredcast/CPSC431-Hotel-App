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
            <h1>Hotel Booking Website</h1>
            <p>
                <a href = "login.php"> Log in </a>
                <a href = "logout.php"> Log Out </a>
                <a href = "bookRoom.php"> Book a room </a>
            </p> 
        </nav>
    </header>
    
<?php
    session_start();
    if (isset($_SESSION['role']) && $_SESSION['role'] == "guest")
    {
        echo "Welcome, " .htmlspecialchars($_SESSION['name']). "! You are logged in as a " .htmlspecialchars($_SESSION['role']).".";
    }
    else if (isset($_SESSION['role']) && $_SESSION['role'] == "guest") {
        echo "Admin screen";
    }
    else {
        echo "You are not logged in and not authorized to view this page.";
        session_destroy();
        echo "<p><a href=\"login.php\"><button>Return to Login</button></a></p>";
        exit;
    }
?>

<!DOCTYPE html>
<html>
    <table>
        <tr><td><a href = "bookRoom.php"><input type="submit" name="bookroom" value="Book a room"/></td></tr>
        <tr><td><input type="submit" name="asdf" value="asdf"/></td></tr>
        <tr><td><a href="logout.php"><button>Log out</button></a></td></tr>
    </table>
</html>