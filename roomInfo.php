<?php
    session_start();
    //echo "Logged in as " .$_SESSION['username'];
    $date = date("Y-m-d");
    $roomNum = $_POST['roomNum'];
    if (isset($_SESSION['role']) && $_SESSION['role'] == "admin")
    {
        echo "Viewing room number: " .htmlspecialchars($roomNum);
    }
    else {
        echo "You are not logged in and not authorized to view this page.";
        session_destroy();
        echo "<p><a href=\"login.php\"><button>Return to Login</button></a></p>";
        exit;
    }

    if (isset($roomNum)) {
        @$db = new mysqli('mariadb', 'cs431s26', 'Uo3io9ve', 'cs431s26');
        if (mysqli_connect_errno()) {
            echo "<p>Error: Cannot connect to database!</p>";
            exit;
        }

        // $bookingID = "";
        // $guestUsername = "";
        // $startDate = "";
        // $endDate = "";
        $query = "SELECT * FROM bookings WHERE roomNum = '" .$roomNum."'";
        echo $query;
        $stmt = $db->prepare($query);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($bookingID, $guestUsername, $roomNum, $startDate, $endDate);

        while ($stmt->fetch()) {
            echo "<tr><td>";
            echo "<p>Room num " . htmlspecialchars($roomNum);
            echo "<p>Username " . htmlspecialchars($guestUsername);
            echo "<p>Booking id " . htmlspecialchars($bookingID);
        }
    }
    else {
        echo "ERROR";
    }
    
    
?>