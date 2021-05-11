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
                <a href = "signup.php"> Sign Up </a>
            </p>            
        </nav>
    </header>
    
<?php

session_start();
if (isset($_SESSION['role']) && $_SESSION['role'] == "guest")
{
    echo "You are already logged in.";
    echo "<br>Logged in as: " . htmlspecialchars($_SESSION['role']);
    echo "<p><a href=\"guesthome.php\"><button>Return to Guest Home</button></a></p>";
    exit;
}

else if (isset($_SESSION['role']) && $_SESSION['role'] == "admin")
{
    echo "You are already logged in.";
    echo "<br>Logged in as: " . htmlspecialchars($_SESSION['role']);
    echo "<p><a href=\"adminhome.php\"><button>Return to Admin Home</button></a></p>";
    exit;
}   
?>

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