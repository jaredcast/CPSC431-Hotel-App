<?php
    session_start();
    if (isset($_SESSION['role']) && $_SESSION['role'] == "guest")
    {
        echo "Welcome, " .$_SESSION['name']. "! You are logged in as a " .$_SESSION['role'].".";
    }
    else if (isset($_SESSION['role']) && $_SESSION['role'] == "guest") {
        echo "Admin screen";
    }
    else {
        echo "You are not logged in and not authorized to view this page.";
        session_destroy();
        echo "<p><a href=\"login.html\"><button>Return to Home</button></a></p>";
        exit;
    }
?>

<!DOCTYPE html>
<html>
    <section id = "guest_menu">
    <table style="border: 0px;">
        <tr><td><a href = "bookRoom.php"><input type="submit" name="bookroom" value="Book a room"/></td></tr>
        <tr><td><input type="submit" name="asdf" value="asdf"/></td></tr>
        <tr><td><a href="logout.php"><button>Log out</button></a></td></tr>
    </table>
    </section>
</html>
