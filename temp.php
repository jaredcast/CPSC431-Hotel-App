<!DOCTYPE html>
<html>
    
    <section id = "login_screen">
        <form method="post" enctype="multipart/form-data">
            <table style="border: 0px;">
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" size="20" maxlength="100" /></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="text" name="email" size="20" maxlength="100" /></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="text" name="password" size="20" maxlength="100" /></td>
                </tr>
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="name" size="20" maxlength="100" /></td>
                </tr>
                <tr>
                    <td>Phone number:</td>
                    <td><input type="text" name="phone" size="20" maxlength="100" /></td>
                </tr>
                <tr>
                    <td>Role:</td>
                    <td>  
                        <label for="admin">Admin</label>
                        <input type="radio" id="admin" name="role" value="admin">
                        <label for="guest">Guest</label>
                        <input type="radio" id="guest" name="role" value="guest">
                    </td>
                </tr>
            </table>           
                <input type="submit" name="signup" value="Sign up"/>
        </form>
    </section>
</html>


<?php
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $role = $_POST['role'];
    $phone = $_POST['phone'];
    
    //$checkSet = isset($username, $email, $password, $name, $role, $phone);
    

    if (isset($_POST['signup']))
    {
        // if (!$username || !$email || !$password || !$name || !$role || !$phone) 
        // {
        //     echo "ERROR! MISSING DATA!";
        //     exit;
        // }
        
        if (!isset($_POST['username']) || !isset($_POST['email']) 
         || !isset($_POST['password']) || !isset($_POST['name'])
         || !isset($_POST['role']) || !isset($_POST['phone'])) {
            echo "<p>You have not entered all the required details.<br />
             Please go back and try again.</p>";
             $username = NULL;
            $email = NULL;
            $password = NULL;
            $name = NULL;
            $role = NULL;
            $phone = NULL;
            exit;
        }

        @$db = new mysqli('mariadb', 'cs431s26', 'Uo3io9ve', 'cs431s26');

        if (mysqli_connect_errno()) {
            echo "<p>ERROR! CAN'T CONNECT TO DATABASE.</p>";
            exit;
        }

        $query = "INSERT INTO users (username, email, password, name, role, phone) VALUES (?, ?, ?, ?, ?, ?)";
        $statement = $db->prepare($query);
        $statement->bind_param('ssssss', $username, $email, $password, $name, $role, $phone);
        $statement->execute();

        if ($statement->affected_rows > 0) {
            $uploadStatus = "<p>User successfully signed up.</p>";
            echo $query;

        } else {
            $uploadStatus = "<p>An error has occurred. A user already exists with either the selected username or email. They must be unique.</p>";
            echo $query;
        }
        echo $uploadStatus;
        $db->close();
    }
?>