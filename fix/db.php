<?php
// Database credentials
$servername = "localhost";
$dbusername = "root";    // change if your MySQL username is different
$dbpassword = "";        // change if your MySQL password is set
$dbname = "plsp_db";    // your database name

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: set character set to utf8
$conn->set_charset("utf8");
?>
