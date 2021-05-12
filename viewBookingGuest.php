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
                <a href = "guesthome.php"> Guest Home </a>
                <a href = "bookRoom.php"> Book a room </a>
                <a href = "viewBookingGuest.php"> View bookings </a>
            </p>            
        </nav>
    </header>

<?php
    session_start();
    if (isset($_SESSION['role']) && $_SESSION['role'] == "guest")
    {
        echo "<div class = \"title\"><b>Your Booked Rooms</b><br>
        Logged in as " .$_SESSION['username']." </div>";

    }
    else if (isset($_SESSION['role']) && $_SESSION['role'] == "admin")
    {
        echo "<div class = \"title\"><b>Your Booked Rooms</b></div>";
        echo "Logged in as an admin";
    }
    else {
        echo "You are not logged in and not authorized to view this page.";
        session_destroy();
        echo "<p><a href=\"login.php\"><button>Return to Login</button></a></p>";
        exit;
    }

    @$db = new mysqli('mariadb', 'cs431s26', 'Uo3io9ve', 'cs431s26');
    if (mysqli_connect_errno()) {
        echo "<p>Error: Cannot connect to database!</p>";
        exit;
    }

    $sessionUsername = $_SESSION['username'];
    $query = "SELECT * FROM bookings WHERE guestUsername = '" .$sessionUsername."'";
    //echo $query;
    $stmt = $db->prepare($query);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($bookingID, $guestUsername, $roomNum, $guests, $startDate, $endDate);
    echo"<div class = \"gallery-container\">";
    while ($stmt->fetch()) {
        echo "<div class=\"booking\">";
        echo "<p style=\"padding-left: 30px;\" >Guest username: " . htmlspecialchars($guestUsername) . "<br>";
        echo "Booking ID: " . htmlspecialchars($bookingID) . "<br>";
        echo "Guests: " . htmlspecialchars($guests) . "<br>";
        echo "Dates: " .  htmlspecialchars($startDate) . " to " .  htmlspecialchars($endDate) . "<br>";
        $query2 = "SELECT * from rooms WHERE roomNum='".$roomNum."'";
        $stmt2 = $db->prepare($query2);
        $stmt2->execute();
        $stmt2->store_result();
        $stmt2->bind_result($roomNum, $price, $beds, $type, $roomdesc, $start, $end, $filename);
        $stmt2->fetch();
        echo "<img src=\"uploads/" . $filename . "\"/><br>";
        echo "<b>Room Number: " . htmlspecialchars($roomNum) . "</b><br>";
        echo "Price: " . htmlspecialchars($price) . "<br>";
        echo "Beds: " . htmlspecialchars($beds) . "<br>";
        echo "Room Type: " . htmlspecialchars($type) . "<br>";
        echo "Room Description: " . htmlspecialchars($roomdesc) . "<br>";
        echo "</div>";
        }
    echo "</div>";
    if ($stmt->affected_rows == 0) {
        echo "<p>No bookings found.</p>";
    }
    echo "</div>";
?>