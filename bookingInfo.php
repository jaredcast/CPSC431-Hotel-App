<?php
    session_start();
    //echo "Logged in as " .$_SESSION['username'];
    $date = date("Y-m-d");
    $roomNum = $_POST['roomNum'];
    
    if (isset($_SESSION['role']) && $_SESSION['role'] == "admin")
    {
        echo "Viewing bookings with room number: " .htmlspecialchars($roomNum) . "<br><br>";
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
        //echo $query;
        $stmt = $db->prepare($query);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($bookingID, $guestUsername, $roomNum, $guests, $startDate, $endDate);

        while ($stmt->fetch()) {
            echo "<tr><td>";
            echo "<p>Guest username: " . htmlspecialchars($guestUsername) . "<br>";
            echo "Booking ID: " . htmlspecialchars($bookingID) . "<br>";
            echo "Guests: " . htmlspecialchars($guests) . "<br>";
            echo "Dates: " .  htmlspecialchars($startDate) . " to " .  htmlspecialchars($endDate) . "<br>";
            $query2 = "SELECT * from users WHERE username='".$guestUsername."'";
            $stmt2 = $db->prepare($query2);
            $stmt2->execute();
            $stmt2->store_result();
            $stmt2->bind_result($id, $username, $email, $password, $name, $role, $phone);
            $stmt2->fetch();

            echo "Full Name: " .htmlspecialchars($name) . "</br>";
            echo "Email: " .htmlspecialchars($email) . "</br>";
            echo "Phone: " .htmlspecialchars($phone) . "</p>";
            echo "</td></tr>";
            echo "<form action = 'deleteBooking.php?id=".$roomNum."' method='post' enctype='multipart/form-data'>";
            echo "<input type='submit' name='delBooking' value='Delete booking'/>";
            echo "<input type='hidden' name='bookingID' value='".$bookingID."'/>";
            echo "</form>";
        }
        if ($stmt->affected_rows == 0) {
            echo "<p>No bookings found.</p>";
        }

        echo "<p><a href=\"viewRooms.php\"><button>Return to Viewing All Rooms</button></a>   ";
        echo "<a href=\"adminhome.php\"><button>Return to Admin Home</button></a></p>";
    }
    else {
        echo "Error obtaining room data.";
        echo "<p><a href=\"viewRooms.php\"><button>Return to Viewing All Rooms</button></a></p>";
        echo "<p><a href=\"adminhome.php\"><button>Return to Admin Home</button></a></p>";
    }
    
    
?>