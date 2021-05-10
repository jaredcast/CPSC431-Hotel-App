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
    
    if (isset($_POST['bookRoom']) && isset($_POST['roomNum'])) //Check if both POST values are set
    {
        // $temp = $_POST['bookRoom'];
        // $roomNum = str_replace("Book Room ", "", $temp); //change after hidden
        $roomNum = $_POST['roomNum']; //Get the room number from before.

        @$db = new mysqli('mariadb', 'cs431s26', 'Uo3io9ve', 'cs431s26');
        if (mysqli_connect_errno()) {
            echo "<p>Error: Cannot connect to database!</p>";
            exit;
        }

        //Insert new booking
        $query = "INSERT INTO bookings (guestUsername, roomNum, guests, startDate, endDate) VALUES (?, ?, ?, ?, ?)";
        $statement = $db->prepare($query);
        $statement->bind_param('sssss', $_SESSION['username'], $roomNum, $_SESSION['bookGuests'], $_SESSION['bookStart'], $_SESSION['bookEnd']);
        $statement->execute();

        //Summarize the booking if it went through. If not, there was a conflicting error
        if ($statement->affected_rows > 0) {
            echo "<p>Your booking was successfully added.</p>";
            echo "<p>" . $_SESSION['username'] . " is booked for Room Number " .$roomNum. " from " . $_SESSION['bookStart'] . " to " . $_SESSION['bookEnd'] . " with " . $_SESSION['bookGuests'] . " guests."; 
        } else {
            echo "<p>An error has occurred with querying the database.</p>";
            echo "<p><a href=\"bookRoom.php\"><button>Return to Booking Screen</button></a></p>";
            exit;
        }

        //Use this query to show the info of the room that was just booked. Although, show the length of the stay.
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
            echo "<p>Room: " . htmlspecialchars($roomNum) . "<br>";
            echo "Price: " . htmlspecialchars($price) . "<br>";
            echo "Beds: " . htmlspecialchars($beds) . "<br>";
            echo "Type: " . htmlspecialchars($type) . "<br>";
            echo "Description: " . htmlspecialchars($roomdesc) . "<br>";
            echo "Guests: " . htmlspecialchars($_SESSION['bookGuests']) . " <br>";
            echo "Start of stay: " . htmlspecialchars($_SESSION['bookStart']) . " <br>";
            echo "End of stay: " . htmlspecialchars($_SESSION['bookEnd']) . "<br></p></td></tr>";
        }
        echo "</table>";
        $statement2->free_result();
        $db->close();

        echo "<p><a href=\"guesthome.php\"><button>Return to Guest Home</button></a></p>";
        }
    else {
        echo "Failed to book the room.";
    }

    
?>