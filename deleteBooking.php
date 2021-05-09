<?php
    session_start();
    //echo "Logged in as " .$_SESSION['username'];
    $bookingID = $_POST['bookingID'];
    if (isset($_SESSION['role']) && $_SESSION['role'] == "admin")
    {
        echo "Deleting booking number: " .htmlspecialchars($bookingID) . "<br><br>";
    }
    else {
        echo "You are not logged in and not authorized to view this page.";
        session_destroy();
        echo "<p><a href=\"login.php\"><button>Return to Login</button></a></p>";
        exit;
    }

    if (isset($bookingID)) {
        @$db = new mysqli('mariadb', 'cs431s26', 'Uo3io9ve', 'cs431s26');
        if (mysqli_connect_errno()) {
            echo "<p>Error: Cannot connect to database!</p>";
            exit;
        }
        
        $query = "DELETE FROM bookings WHERE bookingID = '" .$bookingID."'";
        //echo $query;
        $stmt = $db->prepare($query);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            echo "<p>Booking successfully deleted.</p>";
            echo "<p><a href=\"viewRooms.php\"><button>Return to Viewing All Rooms</button></a></p>";
        } else {
            echo "<p>An error has occurred with querying the database.</p>";
        }
        $db->close();
    }
    else {
        echo "Error with booking ID.";
        exit;
    }
?>