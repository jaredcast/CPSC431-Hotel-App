<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
    		<link rel="stylesheet" type="text/css" href="stylesheet1.css" />
	</head>	
	<body>
    <header>
        <nav>
            <b>Tuffy Hotel Booking Website</b>
            <p>          
                <a href = "login.php"> Log in </a>
                <a href = "logout.php"> Log Out </a>
                <a href = "viewRooms.php"> View All Rooms </a>
                <a href = "createRoom.php"> Create a Room </a>
            </p>            
        </nav>
    </header>


<?php
    session_start();
    if (isset($_SESSION['role']) && $_SESSION['role'] == "admin")
    {
        echo "Welcome, " .$_SESSION['name']. "! You are logged in as a " .$_SESSION['role'].".";
    }
    else if (isset($_SESSION['role']) && $_SESSION['role'] == "guest") {
        echo "Admin screen";
    }
    else {
        echo "You are not logged in and not authorized to view this page.";
        session_destroy();
        echo "<p><a href=\"login.php\"><button>Return to Home</button></a></p>";
        exit;
    }
?>

<!DOCTYPE html>
<html>
    <br><br>
    <table>
        <tr><td><a href="createRoom.php"><button>Create a Room</button></a></td></tr>
        <tr><td><a href="viewRooms.php"><button>View All Rooms</button></a></td></tr>
        <tr><td><a href="logout.php"><button>Log out</button></a></td></tr>
    </table>
</html>