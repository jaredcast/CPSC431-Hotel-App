<?php
    session_start();
    $date = date("Y-m-d");
    echo $date;
    if (isset($_SESSION['role']) && $_SESSION['role'] == "admin")
    {
        echo "<h1>Create a Room</h1>";
    }
    else {
        echo "You are not logged in and not authorized to view this page.";
        session_destroy();
        echo "<p><a href=\"login.php\"><button>Return to Home</button></a></p>";
        exit;
    }
?>

<!DOCTYPE html>
<html> 
    <section id = "login_screen">
        <form method="post" enctype="multipart/form-data">
            <table style="border: 5px;">
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
                    <td><input type="date" id="start" name="start" min="<?php echo $date; ?>" max="12-31-2030"></td>                    
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
    </section>
</html>

<?php
    $tmp_name = "temp"; //Temporary filename

    $roomNum = $_POST['roomNum']; //db
    $price =  $_POST['price']; //db
    $beds = $_POST['beds']; //db
    $type = $_POST['type']; //db
    $roomdesc = $_POST['roomdesc']; //db
    $start = $_POST['start'];
    $end = $_POST['end'];

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
            $statement = $db->prepare($query);
            $statement->bind_param('ssssssss', $roomNum, $price, $beds, $type, $roomdesc, $start, $end, $filename);
            $statement->execute();
            if ($statement->affected_rows > 0) {
                echo "<p>Room successfully added.</p>";
            } else {
                echo "<p>An error has occurred with querying the database.</p>";
            }
            $db->close();
        }     
        else {
            echo "<p>Failed to upload the image.</p>";
            exit;
        }  
    }
    

?>