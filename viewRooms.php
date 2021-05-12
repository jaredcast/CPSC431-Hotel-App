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
                <a href = "adminhome.php"> Admin home </a>
                <a href = "viewRooms.php"> View All Rooms </a>
                <a href = "createRoom.php"> Create a Room </a>
            </p>            
        </nav>
    </header>

<?php
    session_start();
    if (isset($_SESSION['role']) && $_SESSION['role'] == "admin")
    {
        echo "<div class = \"title\"><b>View rooms</b></div>";
    }
    else {
        echo "You are not logged in and not authorized to view this page.";
        session_destroy();
        echo "<p><a href=\"login.php\"><button>Return to Login</button></a></p>";
        exit;
    }


    //Connect to database
    @$db = new mysqli('mariadb', 'cs431s26', 'Uo3io9ve', 'cs431s26');
    if (mysqli_connect_errno()) {
        echo "<p>Error: Cannot connect to database!</p>";
        exit;
    }
    $query = "SELECT * FROM rooms ORDER BY roomNum";
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->store_result();
    $statement->bind_result($roomNum, $price, $beds, $type, $roomdesc, $start, $end, $filename);
    echo "<p>Number of rooms found: ".$statement->num_rows."</p>";
    echo"<div class = \"gallery-container\">";
    while($statement->fetch()) {
        echo "<div class=\"booking\">";
        echo "<img src=\"uploads/" . $filename . "\"/><br>";
        echo "<b>Room Number: " . htmlspecialchars($roomNum) . "</b><br>";
        echo "Price: " . htmlspecialchars($price) . "<br>";
        echo "Beds: " . htmlspecialchars($beds) . "<br>";
        echo "Room Type: " . htmlspecialchars($type) . "<br>";
        echo "Room Description: " . htmlspecialchars($roomdesc) . "<br>";
        echo "Start date: " . htmlspecialchars($start) . "<br>";
        echo "End date: " . htmlspecialchars($end) . "<br>";
        echo "<form action = 'bookingInfo.php?".$roomNum."' method='post' enctype='multipart/form-data'>";
        echo "<input type='submit' name='viewRoom' value='View room bookings'/>";
        echo "<input type='hidden' name='roomNum' value='".$roomNum."'/>";
        echo "</form>";
        echo "</div>";
        // echo "<br><br>";
        // echo "<form action=\"\" method=\"POST\">
        // <input type=\"submit\" name=\"submit\" value=\"".$roomNum."\">
        // </form>";
    }
    echo "</div>";
?>