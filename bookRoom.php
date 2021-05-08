<?php
$roomNum = $_POST['roomNum'];
$price = $_POST['price'];
$beds = $_POST['beds'];
$type = $_POST['type'];
$roomdesc = $_POST['roomdesc'];
$start = $_POST['start'];
$end = $_POST['end'];
$filename = $_FILES["imgupload"]["name"];
$choice = $_GET['choice'];

?>

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
                echo "Booking a room<br><br>";
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

        <form method="post" enctype="multipart/form-data">
                <table style="border: 5px;">
                        <tr>
                            <td>Minimum Price:</td>
                            <td><input type="number" name="minPrice" min="1"/></td>
                        </tr>
                        <tr>
                            <td>Maximum Price:</td>
                            <td><input type="number" name="maxPrice" min="1"/></td>
                        </tr>
                        <tr>
                            <td>Beds:</td>
                            <td><input type="number" name="beds" min="1"/></td>
                        </tr>
                        <tr>
                            <td>Type:</td>
                            <td>                          
                                <input type="radio" id="value" name="type" value="value">
                                <label for="value">Value</label>
                        
                                <input type="radio" id="normal" name="type" value="normal">
                                <label for="normal">Normal</label>
                    
                                <input type="radio" id="deluxe" name="type" value="deluxe">
                                <label for="deluxe">Deluxe</label>
                        
                                <input type="radio" id="penthouse" name="type" value="penthouse">
                                <label for="penthouse">Penthouse</label>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="start">Start date:</label></td>
                            <!-- <td><input type="date" id="start" name="start" min="<?php echo $date; ?>" max="12-31-2030"></td>                     -->
                            <td><input type="date" id="start" name="start" max="12-31-2030"></td>                    
                        </tr>
                        <tr>
                            <td><label for="start">End date:</label></td>
                            <td><input type="date" id="end" name="end"></td>
                        </tr>
                </table>  
                <input type="submit" name="searchRoom" value="Search for rooms"/>
        </form>
        
	<div class = "showcase">	
		<?php
            $bookMinPrice =  $_POST['minPrice'];
            $bookMaxPrice =  $_POST['maxPrice'];
            $bookBeds =  $_POST['beds'];
            $bookType =  $_POST['type'];
            $bookStart =  $_POST['start'];
            $bookEnd =  $_POST['end'];

            //Set temp session variables
            $_SESSION['bookMinPrice'] = $bookMinPrice;
            $_SESSION['bookMaxPrice'] = $bookMaxPrice;
            $_SESSION['bookBeds'] = $bookBeds;
            $_SESSION['bookType'] = $bookType;
            $_SESSION['bookStart'] = $bookStart;
            $_SESSION['bookEnd'] = $bookEnd;
            
            // echo empty($beds);
            if (isset($_POST['searchRoom'])) {               
        	    //Connect to database
                #if ($start == "" || $end == "" || !isset($start) || !isset($end))
                if (empty($start) || empty($end))
                {
                    echo "<p>Error, missing dates.</p>";
                    exit;
                }

                @$db = new mysqli('mariadb', 'cs431s26', 'Uo3io9ve', 'cs431s26');
                if (mysqli_connect_errno()) {
                    echo "<p>Error: Cannot connect to database!</p>";
                    exit;
                }

                $query = "SELECT * FROM rooms WHERE start >= '" . $bookStart . "' AND end >= '" .$bookEnd. "'"; //End date needs to be extended past how long the guest wants to stay. Availability
                //echo $query;

                //Add anything needed to query.
                if (!empty($bookMinPrice)) {
                    $query .= " AND price >= '" .$mibookMinPricenPrice. "'";
                }
                if (!empty($bookMaxPrice)) {
                    $query .= " AND price <= '" .$bookMaxPrice. "'";
                }
                if (!empty($bookBeds)) {
                    $query .= " AND beds = '" .$bookBeds. "'";
                }
                if (!empty($bookType)) {
                    $query .= " AND type = '" .$bookType. "'";
                }
                // echo "Query : " . $query;
                // SELECT * FROM rooms WHERE start >= '2021-05-05' AND end >= '2021-07-20' AND price <= '10000'

                $stmt = $db->prepare($query);
                //$stmt->bind_param($choice, Type);  
                $stmt->execute();
                $stmt->store_result();		
                $stmt->bind_result($roomNum, $price, $beds, $type, $roomdesc, $startAvail, $endAvail, $filename);

                echo "<table>";
                //While the statement fetches different queries in the database, keep printing out the information.
                //Show the info for each hotel room that matches.
                while($stmt->fetch()) {
                    echo "<tr><td>";
                    echo "<img src=\"uploads/" . $filename . "\"/><br>"; 
                    echo "<p>Room: " . htmlspecialchars($roomNum) . "<br>";
                    echo "Price: " . htmlspecialchars($price) . "<br>";
                    echo "Beds: " . htmlspecialchars($beds) . "<br>";
                    echo "Type: " . htmlspecialchars($type) . "<br>";
                    echo "Description: " . htmlspecialchars($roomdesc) . "<br>";
                    echo "Starting availability: " . htmlspecialchars($startAvail) . " <br>";
                    echo "Ending availability: " . htmlspecialchars($endAvail). "<br>";
                    echo "<form action = 'createBooking.php' method='post' enctype='multipart/form-data'>";
                    echo "<input type='submit' name='bookRoom' value='Book Room'/>";
                    echo "<input type='hidden' name='roomNum' value='".$roomNum."'/>"; //hidden - Anything submitted can be accessed thru post. Used to go to createBooking.php
                    echo "</form>";
                    echo "</p></td></tr>";
                }
                $statement->free_result();
                $db->close();
                //hidden input types
            }
		?>
		
	</div>
	</body>
</html>
