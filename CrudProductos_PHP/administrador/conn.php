<?php
$servername = "localhost";
$username = "root";
$password = "";
$bdd = "sistema";

// Create connection
$conn = new mysqli($servername, $username, $password, $bdd);

// Check connection
if (!$conn) {
  die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";
?>