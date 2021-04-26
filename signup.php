<!DOCTYPE html>
<html> 
    <section id = "login_screen">
        <form method="post">
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
                    <td><input type="password" name="password" size="20" maxlength="100" /></td>
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
    

    if (isset($_POST['signup']))
    {
        // Check if POST variable is set, then check if POST variable is empty
        // if (!isset($_POST['username']) || !isset($_POST['email']) 
        //  || !isset($_POST['password']) || !isset($_POST['name'])
        //  || !isset($_POST['role']) || (!isset($_POST['phone']) || $phone == "" )) {
        //     echo "<p>You have not entered all the required details.<br />
        //      Please go back and try again.</p>";
        //     exit;
        //  }

        //  if (!isset($username) || !isset($email) 
        //  || !isset($password) || !isset($name)
        //  || !isset($role) || (!isset($phone)) {
        //     echo "<p>You have not entered all the required details.<br />
        //      Please go back and try again.</p>";
        //     exit;
        //  }

        if ($username == "" || $email == "" || $password == "" || $name == "" || $role == "" || $phone == ""
            || !isset($username) || !isset($email) || !isset($password) || 
            !isset($name) || !isset($role) || (!isset($phone))) {
            echo "<p>You have not entered all the required details.<br /> Please go back and try again.</p>";
            exit;
        }

        @$db = new mysqli('mariadb', 'cs431s26', 'Uo3io9ve', 'cs431s26');
        $query = "INSERT INTO users (username, email, password, name, role, phone) VALUES (?, ?, ?, ?, ?, ?)";
        $statement = $db->prepare($query);
        $statement->bind_param('ssssss', $username, $email, $password, $name, $role, $phone);
        $statement->execute();

        if ($statement->affected_rows > 0) {
            echo "<p>User successfully signed up.</p>";
            echo "<p><a href=\"login.html\"><button>Back to log in</button></a></p>";
            //echo $query;
        } else {
            echo "<p>An error has occurred. Missing data.</p>";
            }
        $db->close();
    }


    // if (!$username)
    // {
    //     echo "Username not set";
    // }
    // if (!$email)
    // {
    //     echo "email not set";
    // }
    // if (!$password)
    // {
    //     echo "password not set";
    // }
    // if (!$name)
    // {
    //     echo "name not set";
    // }
    // if (!$role)
    // {
    //     echo "role not set";
    // }
    // if (!$phone)
    // {
    //     echo "phone not set";
    // }

    // if (!isset($username))
    // {
    //     echo "Username not set ";
    // }
    // if (!isset($email))
    // {
    //     echo "email not set ";
    // }
    // if (!isset($password))
    // {
    //     echo "password not set ";
    // }
    // if (!isset($name))
    // {
    //     echo "name not set ";
    // }
    // if (!isset($role))
    // {
    //     echo "role not set ";
    // }
    // if (!isset($phone))
    // {
    //     echo "phone not set ";
    // }
?>


