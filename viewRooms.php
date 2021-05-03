<?php
    session_start();
    if (isset($_SESSION['role']) && $_SESSION['role'] == "admin")
    {
        echo "<h1>View Rooms</h1>";
    }
    else {
        echo "You are not logged in and not authorized to view this page.";
        session_destroy();
        echo "<p><a href=\"login.php\"><button>Return to Home</button></a></p>";
        exit;
    }


    //Connect to database
    @$db = new mysqli('mariadb', 'cs431s26', 'Uo3io9ve', 'cs431s26');
    if (mysqli_connect_errno()) {
        echo "<p>Error: Cannot connect to database!</p>";
        exit;
    }
    $query = "SELECT * FROM rooms";
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->store_result();
    $statement->bind_result($roomNum, $price, $beds, $type, $roomdesc, $start, $end, $filename);
    echo "<p>Number of rooms found: ".$statement->num_rows."</p>";

    while($statement->fetch()) {
        echo "<img src=\"uploads/" . $filename . "\"/><br>";
        echo "Room Number: " . $roomNum . "<br>";
        echo "Price: " . $price . "<br>";
        echo "Beds: " . $beds . "<br>";
        echo "Room Type: " . $type . "<br>";
        echo "Room Description: " . $roomdesc . "<br>";
        echo "Start date: " . $start . "<br>";
        echo "End date: " . $end . "<br>";
        echo "<br><br>";
        // echo "<form action=\"\" method=\"POST\">
        // <input type=\"submit\" name=\"submit\" value=\"".$roomNum."\">
        // </form>";
    
    }
    // if (isset($_POST['submit'])) {
    //     echo "Yes";
    //     echo $roomNum;
    //   }

?>

<!-- 
function update_book($oldisbn, $isbn, $title, $author, $catid,
                     $price, $description) {
// change details of book stored under $oldisbn in
// the database to new details in arguments

   $conn = db_connect();

   $query = "update books
             set isbn= '".$conn->real_escape_string($isbn)."',
             title = '".$conn->real_escape_string($title)."',
             author = '".$conn->real_escape_string($author)."',
             catid = '".$conn->real_escape_string($catid)."',
             price = '".$conn->real_escape_string($price)."',
             description = '".$conn->real_escape_string($description)."'
             where isbn = '".$conn->real_escape_string($oldisbn)."'";

   $result = @$conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }
}
 -->