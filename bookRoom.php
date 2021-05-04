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
    			if (isset($_SESSION['role']) && $_SESSION['role'] == "guest")
    			{
        			echo "Welcome, " .$_SESSION['name']. "! You are logged in as a " .$_SESSION['role'].".";
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
        		<form action = "bookRoom.php" method = "GET">
				Type: 
            			<td><select name="choice" onchange="this.form.submit();">
                			<option></option>
                    				<option value = "normal">Normal</option>
                    				<option value = "value">Value</option>
						                <option value = "deluxe">Deluxe</option>
                    				<option value = "penthouse">Penthouse</option>
                		</select>
            			</td>
        		</form>
		
		//Test for css grid
		<section id = "roomdetails">
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
			</div>

		

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
