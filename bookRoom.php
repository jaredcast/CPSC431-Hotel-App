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
        			echo "<p><a href=\"login.html\"><button>Return to Home</button></a></p>";
        			exit;
    			}
		?>

		<div class = "showcase">
        <!-- <form action = "bookRoom.php" method = "GET">
        Type: 
                <td><select name="choice" onchange="this.form.submit();">
                    <option></option>
                            <option value = "normal">Normal</option>
                            <option value = "value">Value</option>
                                <option value = "deluxe">Deluxe</option>
                            <option value = "penthouse">Penthouse</option>
                </select>
                </td>
        </form> -->
        <form method="get" enctype="multipart/form-data">
            <table style="border: 5px;">
                    <tr>
                        <td>Minimum Price:</td>
                        <td><input type="number" name="maxPrice" min="1"/></td>
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
                        <td><input type="date" id="start" name="start" min="<?php echo $date; ?>" max="12-31-2030"></td>                    
                    </tr>
                    <tr>
                        <td><label for="start">End date:</label></td>
                        <td><input type="date" id="end" name="end"></td>
                    </tr>
            </table>  
            <input type="submit" name="searchRoom" value="Search for rooms"/>
        </form>
        
		
		<!-- <section id = "roomdetails">
			<div style ="margin: 0px 40px 0px 40px;" id = "test1">
				<p>Room: </p>
				<p>"Pic"</p>
				<p>Price: </p>
				<p>Type: </p>
				<p>Beds: </p>
				<p>Description: </p>
			</div>

			<div style ="margin: 0px 40px 0px 40px;" id = "test2">
				<p>Room: </p>
				<p>"Pic"</p>
				<p>Price: </p>
				<p>Type: </p>
				<p>Beds: </p>
				<p>Description: </p>
			</div>

			<div style ="margin: 0px 40px 0px 40px;" id = "test3">
				<p>Room: </p>
				<p>"Pic"</p>
				<p>Price: </p>
				<p>Type: </p>
				<p>Beds: </p>
				<p>Description: </p>
			</div> -->
	<?php
        //Connect to database
        @$db = new mysqli('mariadb', 'cs431s26', 'Uo3io9ve', 'cs431s26');
        if (mysqli_connect_errno()) {
            echo "<p>Error: Cannot connect to database!</p>";
            exit;
        }
   //Where I'm stuck ... I think it has to be with the query. Can't figure out the "WHERE" part
 	    $query = "SELECT roomNUM, price, beds, type, roomdesc, start, end, filename FROM rooms WHERE type = $choice ";
        $stmt = $db->prepare($query);
        //$stmt->bind_param($choice, Type);  
        $stmt->execute();
        $stmt->store_result();		
		$stmt->bind_result($roomNum, $price, $beds, $type, $roomdesc);

	//While the statement fetches different queries in the database, keep printing out the information.
            while($stmt->fetch()) {
                echo "Room: " . $roomNum . "<br>";
                echo "Price: " . $price . "<br>";
                echo "Beds: " . $beds . "<br>";
                echo "Type: " . $type . "<br>";
		            echo "Description: " . $roomdesc . "<br><br>";
            }
            $statement->free_result();
            $db->close();

	?>
		</section>
		<div>

	</body>
</html>