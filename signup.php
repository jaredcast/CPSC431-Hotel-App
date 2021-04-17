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
    
    

    if (isset($_POST['signup']))
    {
        @$db = new mysqli('mariadb', 'cs431s26', 'Uo3io9ve', 'cs431s26');
        $query = "INSERT INTO users (username, email, password, name, role, phoneNum) VALUES (?, ?, ?, ?, ?, ?)";
        $statement = $db->prepare($query);
        $statement->bind_param('ssssss', $username, $email, $password, $name, $role, $phone);
        $statement->execute();

        if ($statement->affected_rows > 0) {
            $uploadStatus = "<p>User successfully signed up.</p>";
            echo $query;
        } else {
            $uploadStatus = "<p>An error has occurred. Missing data.</p>";
        }
        echo $uploadStatus;
        $db->close();
    }
?>