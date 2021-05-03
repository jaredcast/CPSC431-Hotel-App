<?php

session_start();
if (isset($_SESSION['role']) && $_SESSION['role'] == "guest")
{
    echo "You are already logged in.";
    echo "<p><a href=\"guesthome.php\"><button>Return to Guest Home</button></a></p>";
    exit;
}

else if (isset($_SESSION['role']) && $_SESSION['role'] == "admin")
{
    echo "You are already logged in.";
    echo "<p><a href=\"adminhome.php\"><button>Return to Admin Home</button></a></p>";
    exit;
}   
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8"/>
          <meta name = "viewport" content = "width=device-width, intitial-scale=1"/>
          <title>Tuffy Hotel Login</title>
          <!-- <link rel = "stylesheet" type = "text/css" href = "styles.css"/> -->
    </head>

  <body>
    <section id = "title">
        <p>Login</p>
    </section>

    <section id = "login_screen">
        <table style="border: 0px;">
            <form action="auth.php" method="post" enctype="multipart/form-data">
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" size="20" maxlength="100" /></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" size="20" maxlength="100" /></td>
                </tr>
                <tr>
                    <td colspan="6" style="text-align: center;"><input type="submit" name="submit" value="Login"></td>
                </tr> 
            </form>
                <tr>
                    <form action="signup.php" method="post" enctype="multipart/form-data">
                        <td colspan="6" style="text-align: center;"><input type="submit" name="submit" value="Sign up"/></td>
                    </form>
                </tr>
        </table>
    </section>
  </body>

</html>