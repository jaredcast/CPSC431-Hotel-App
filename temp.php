


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

// $username = "May Eleven <h1>";
// if (preg_match("/^[a-zA-Z0-9]+$/", $username) == 0) {
//     echo "ERROR: Invalid character in username field.";
//     exit;
// }
// else {
//     echo "OK";
// }
// echo strip_tags($username);
// echo "hello";
$new = htmlspecialchars("<a href='test'>Test</a>", ENT_QUOTES);
echo
echo $new;
?>