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
                <a href = "adminhome.php"> Admin home </a>
                <a href = "viewRooms.php"> View All Rooms </a>
                <a href = "createRoom.php"> Create a Room </a>
            </p>            
        </nav>
    </header>

    <?php
    session_start();
    $date = date("Y-m-d");
    if (isset($_SESSION['role']) && $_SESSION['role'] == "admin")
    {
        echo "<div class = \"title\"><b>Create a Room</b></div>";
    }
    else {
        echo "You are not logged in and not authorized to view this page.";
        session_destroy();
        echo "<p><a href=\"login.php\"><button>Return to Login</button></a></p>";
        exit;
    }
?>

<!DOCTYPE html>
<html> 
    <form method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Room Number:</td>
                <td><input type="number" name="roomNum" min="1"/></td>
            </tr>
            <tr>
                <td>Price:</td>
                <td><input type="number" name="price" min="1"/></td>
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
                <td><input type="date" id="start" name="start" max="12-31-2030"></td>                    
            </tr>
            <tr>
                <td><label for="start">End date:</label></td>
                <td><input type="date" id="end" name="end"></td>
            </tr>
            <tr>
                <td>Description:</td>
                <td><textarea name="roomdesc" rows="10" cols="30"></textarea></td>
            </tr>
            <tr>
                <td>Room image:</td>
                <td><input type="file" name="imgUpload" id="imgUpload"></td>
            </tr>
        </table>           
            <input type="submit" name="newRoom" value="Create room"/>
    </form>
</body>
</html>

<?php
    echo "<p><a href=\"adminhome.php\"><button>Return to Admin Home</button></a></p>";

    $tmp_name = "temp"; //Temporary filename

    $roomNum = $_POST['roomNum']; //db
    $price =  $_POST['price']; //db
    $beds = $_POST['beds']; //db
    $type = $_POST['type']; //db
    $roomdesc = $_POST['roomdesc']; //db
    $start = $_POST['start'];
    $end = $_POST['end'];

    $roomdesc = strip_tags($roomdesc); //NO WRITING TAGS TO DATABASE AS DESCRIPTION


    //Image processing
    $filename = $_FILES["imgUpload"]["name"]; //db
    $imgType = $_FILES["imgUpload"]["type"];
    $errorImg = False;
    $uploadStatus = "temp";



    if (isset($_POST['newRoom']))
    {
        //Make sure everything is set
        if ($roomNum == "" || $price == "" || $beds == "" || $type == "" || $roomdesc == "" || $start == "" || $end == "" 
            || !isset($roomNum) || !isset($price) || !isset($beds) || !isset($type) || !isset($roomdesc) || !isset($start) || !isset($end)) {
            echo "<p>You have not entered all the required details.<br/> Please go back and try again.</p>";
            exit;
        }

        //Check image filetype
        if ($imgType && $imgType != 'image/png' && $imgType != 'image/jpg' && $imgType != 'image/jpeg' && $imgType != 'image/gif') {
            echo 'ERROR: NOT A PNG, JPEG, GIF, or JPG.';
            exit;
        }

        @$db = new mysqli('mariadb', 'cs431s26', 'Uo3io9ve', 'cs431s26');
        
        if (mysqli_connect_errno()) {
            echo "<p>Error: Cannot connect to database!</p>";
            exit;
        }

        //If moving the file worked
        if (move_uploaded_file($_FILES["imgUpload"]["tmp_name"],"uploads/".$filename)) {
            $query = "INSERT INTO rooms (roomNum, price, beds, type, roomdesc, start, end, filename) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            //Prepare insert statement
            $statement = $db->prepare($query); 
            //Bind variables to params
            $statement->bind_param('ssssssss', $roomNum, $price, $beds, $type, $roomdesc, $start, $end, $filename);             
            //Execute statement https://www.php.net/manual/en/mysqli-stmt.execute
            $statement->execute();
            if ($statement->affected_rows > 0) {
                echo "<p>Room successfully added.</p>";
            } else {
                echo "<p>An error has occurred with querying the database. A room with that room number already exists.</p>";
            }
            $db->close();
        }     
        else {
            echo "<p>Failed to upload the image.</p>";
            exit;
        }  
    }
    

?>