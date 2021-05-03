<?php
    session_start();
    if (isset($_SESSION['role']) && $_SESSION['role'] == "admin")
    {
        echo "Welcome, " .$_SESSION['name']. "! You are logged in as a " .$_SESSION['role'].".";
    }
    else if (isset($_SESSION['role']) && $_SESSION['role'] == "guest") {
        echo "Admin screen";
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
    <section id = "guest_menu">
    <table style="border: 0px;">
        <tr><td><a href="createRoom.php"><button>Create a Room</button></a></td></tr>
        <tr><td><a href="viewRooms.php"><button>View All Rooms</button></a></td></tr>
        <tr><td><a href="logout.php"><button>Log out</button></a></td></tr>
    </table>
    </section>
</html>