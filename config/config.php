<?php 
// Establish database connection
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "dms_db";

// Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);

// Online Database Include File
include_once '../database/database.php';

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} else {
  // echo "Connected successfully";
}
?>
