<!-- <!DOCTYPE html>
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
</html> -->


<?php
//$new = htmlspecialchars("<a href='test'>Test</a>", ENT_QUOTES);
//echo $new; // &lt;a href=&#039;test&#039;&gt;Test&lt;/a&gt;

//CSS
// echo "<br>";
// echo "strip_tags: " .strip_tags("<style>body {background-color: black;}</style>");
// echo "<br>";
// echo "htmlspecialchars: " .htmlspecialchars("<style>body {background-color: black;}</style>");

//JS
// echo "<script>window.alert('hi');</script>";
// echo htmlspecialchars("<script>window.alert('hi');</script>");
// echo "<br>";
// echo strip_tags("<script>window.alert('hi');</script>");

//HTML
// echo "<h1>HTML injection</h1>";
// echo "<br>";
// echo "html special chars" .htmlspecialchars("<h1>HTML injection</h1>");

//SQL
// $a = 'How are you?';

// if (strpos($a, 'are') !== false) {
//     echo 'true';
// }
    
//     echo "HI";


$value = "h1HTMLinjectionh1";
$pat = "^a-zA-Z\d\s:";
if (preg_match("/^[a-zA-Z0-9]+$/", $value))
{
  echo "Match";
}
else {
    echo "No match";
}

$email = "Temp@gmail.com";
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "ERROR: Invalid email.";
    exit;
}

?>