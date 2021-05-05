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
				<p>
					<a href = "homepage.html"> Hotel Booking Website </a>
				</p>
			</nav>
		</header>

<?php
    session_start();
    $date = date("Y-m-d");
    if (isset($_SESSION['role']) && $_SESSION['role'] == "guest")
    {
        echo "Finalizing your booking...<br>";
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
    
    if (isset($_POST['bookRoom']))
    {
        $temp = $_POST['bookRoom'];
        $roomNum = str_replace("Book Room ", "", $temp);

        @$db = new mysqli('mariadb', 'cs431s26', 'Uo3io9ve', 'cs431s26');
        if (mysqli_connect_errno()) {
            echo "<p>Error: Cannot connect to database!</p>";
            exit;
        }

        $query = "INSERT INTO bookings (guestUsername, roomNum, startDate, endDate) VALUES (?, ?, ?, ?)";
        $statement = $db->prepare($query);
        $statement->bind_param('ssss', $_SESSION['username'], $roomNum, $_SESSION['bookStart'], $_SESSION['bookEnd']);
        $statement->execute();
        if ($statement->affected_rows > 0) {
            echo "<p>Your booking was successfully added.</p>";
            echo "<p>" . $_SESSION['username'] . " is booked for Room Number " .$roomNum. " from " . $_SESSION['bookStart'] . " to " . $_SESSION['bookEnd']; 
        } else {
            echo "<p>An error has occurred with querying the database.</p>";
            echo "<p><a href=\"bookRoom.php\"><button>Return to Booking Screen</button></a></p>";
            exit;
        }

        $query2 = "SELECT * FROM rooms WHERE roomNum = '" . $roomNum . "'";
        $statement2 = $db->prepare($query2);
        $statement2->execute();
        $statement2->store_result();
        $statement2->bind_result($roomNum, $price, $beds, $type, $roomdesc, $start, $end, $filename);
        echo "<table>";
        //While the statement fetches different queries in the database, keep printing out the information.
        while($statement2->fetch()) {
            echo "<tr><td>";
            echo "<img src=\"uploads/" . $filename . "\"/><br>"; 
            echo "<p>Room: " . $roomNum . "<br>";
            echo "Price: " . $price . "<br>";
            echo "Beds: " . $beds . "<br>";
            echo "Type: " . $type . "<br>";
            echo "Description: " . $roomdesc . "<br>";
            echo "Start of stay: " . $_SESSION['bookStart'] . " <br>";
            echo "End of stay: " . $_SESSION['bookEnd'] . "<br></p></td></tr>";
        }
        $statement2->free_result();
        $db->close();
        }
    else {
        echo "Failed to book the room.";
    }

    
?>