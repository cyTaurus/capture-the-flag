<?php


error_reporting(E_ALL);
ini_set("display_errors", 1);

$conn = new mysqli("localhost", "root", "", "injection_users");

$user = $_POST['user'];
$pass = $_POST['pass'];

$sql = "SELECT * FROM users WHERE username = '$user' AND password = '$pass'";
echo "<pre>$sql</pre>";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Login erfolgreich!<br>";
    echo "FLAG{basic_sql_bypass}";
} else {
    echo "Login fehlgeschlagen.";
}
?>
