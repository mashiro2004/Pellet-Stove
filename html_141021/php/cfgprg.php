<?php
$servername = "localhost";
$username = "stufa";
$password = "PasswordUserStufa2021!";
$dbname = "stufa";
 
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
 
?>