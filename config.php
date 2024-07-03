<?php
$servername = "localhost";
$username = "user";
$password = "2001";
$dbname = "Siber_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
