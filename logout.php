<?php

session_start();
$temp = $_SESSION['role'];
session_destroy();

if ($temp != "") {
    echo "You have been logged out.";
    echo "<br><a href=\"login.html\"><button>Log in</button></a>";
}
else {
    echo "You cannot log out, you were not logged in.";
    echo "<br><a href=\"login.html\"><button>Log in</button></a>";
}

?>

