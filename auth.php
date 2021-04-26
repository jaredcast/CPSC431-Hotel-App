<?php
$login = $_POST['submit']; //You must login before going in here.
$username = $_POST['username'];
$email = "";
$password = $_POST['password'];
$id = "";
$name = "";
$role = "";
$phone = "";



#echo $login;
if (isset($login)) {

    if ($username == "" || $password == "" || !isset($username) || !isset($password)) {
        echo "<p>You have not entered all the required details.<br /> Please go back and try again.</p>";
        echo "<p><a href=\"login.html\"><button>Return to Home</button></a></p>";
        exit;
    }

    @$db = new mysqli('mariadb', 'cs431s26', 'Uo3io9ve', 'cs431s26');
    if (mysqli_connect_errno()) {
        echo "<p>Error: Cannot connect to database!</p>";
        exit;
    }

    

    $loginQuery = "SELECT * FROM users WHERE username ='" .$username. "' AND password = '" .$password."'";
    #$loginQuery = "SELECT * FROM users WHERE username ='" .$username. "' AND password= '".$password."'";
    //$loginQuery = "SELECT * FROM users WHERE username = ? AND password = ? AND email = ?";
    echo $loginQuery ."<br>";
    #$result = $db->query($loginQuery);
    $statement = $db->prepare($loginQuery);
    $statement->execute();
    $statement->store_result();
    if ($statement->num_rows > 0)
    {
        // if they are in the database register the user id
        $statement->bind_result($id, $username, $email, $password, $name, $role, $phone); 
        echo "<br>LOGGING IN<br>";
        $statement->fetch();
        session_start(); //Start ur session
        //Set up session variables! pg480
        $_SESSION['id'] = $id;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        $_SESSION['name'] = $name;
        $_SESSION['role'] = $role;
        $_SESSION['phone'] = $phone;

        // echo "ID ". $id."<br>";
        // echo "USERNAME " .$username."<br>";
        // echo "NAME ". $name."<br>";
        // echo "ROLE ". $role."<br>";
        // echo "PHONE ". $phone."<br>"; 
        
        echo $_SESSION['id']."<br>";
        echo $_SESSION['username']."<br>";
        echo $_SESSION['email']."<br>";
        echo $_SESSION['password']."<br>";
        echo $_SESSION['name']."<br>";
        echo $_SESSION['role']."<br>";
        echo $_SESSION['phone']."<br>";
    }
    else {
        echo "Failed to log in. There is an error with your username or password.";
        session_destroy();
        echo "<p><a href=\"login.html\">Return to Home</a></p>";
        exit;
    }
    // else {
    //     echo "Failed to log in.";
    //     echo $statement->num_rows;
    //     session_destroy();
    // }
    if (isset( $_SESSION['username']) && isset($_SESSION['role'])) {
        echo "Logging in as " .$username;
        if ($_SESSION['role'] == "guest") {
            echo "<script> location.href='guesthome.php'; </script>"; //Take you to guest home
        }
        else if ($_SESSION['role'] == "admin") {
            echo "<script> location.href='adminhome.php'; </script>"; //Take you to admin home
        }
        else {
            echo "There was a problem with authenticating your role.";
            session_destroy();
            echo "<p><a href=\"login.html\">Return to Home</a></p>";
            exit;
        }
        exit;
    }
    else {
        echo "Failed to log in. There is an error with your username or password.";
        session_destroy();
        echo "<p><a href=\"login.html\">Return to Home</a></p>";
        exit;
    }
    echo $result;
}
else {
    echo "You are not logged in or authorized to see this page. Please try again later.";
    echo "<p><a href=\"login.html\">Return to Home</a></p>";
    // echo $login;
}

?>