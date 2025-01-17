<?php
// Start a session
session_start();

// Database connection parameters
$servername = "sql.freedb.tech";
$username = "freedb_dmp_master";
$password = "8@YASU8ypbA2uA%";
$dbname = "freedb_dmp_db";

// Create a new MySQLi instance
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
   
}

// Check if the POST data is set
if(isset($_POST['uname'], $_POST['pass'])) {
    // Get the posted username and password
    $username = $_POST['uname'];
    $password = $_POST['pass'];

    // Prepare a SQL statement to check if the username and password exist
    $sql = "SELECT * FROM admin WHERE username = ? AND password = ? AND status = ?";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $status = 0; // Assuming status is an integer
    $stmt->bind_param("ssi", $username, $password, $status);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if a row was returned
    if ($result->num_rows > 0) {
        // Fetch the user data
        $row = $result->fetch_assoc();

        // Set session variables
        $_SESSION['id'] = $row['id'];
        $_SESSION['fname'] = $row['fname'];
        $_SESSION['lname'] = $row['lname'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['contact'] = $row['contact'];
        $_SESSION['img'] = $row['img'];
        $_SESSION['username'] = $username;
        $_SESSION['loggedin'] = true;

        // Respond with '1' to indicate successful login
        echo '1';
    } else {
        // Respond with '0' to indicate failed login
        echo '0';
    }
} else {
    // Respond with '0' to indicate failed login
    echo '0';
}
?>
