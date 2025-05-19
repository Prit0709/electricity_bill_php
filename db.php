<?php
$host = "localhost";
$username = "root";
$password = "";  // leave empty by default
$db = "electricity";  // DB name you created

$conn = new mysqli($host, $username, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
