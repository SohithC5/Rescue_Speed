<?php
require 'connection.php';
// Simple login script for demonstration
$username = $_POST['username'];
$password = $_POST['password'];

$result=mysqli_query($conn,"SELECT * FROM users WHERE Name='$username' and Password='$password'");

// Hardcoded credentials for demonstration purposes
if (mysqli_num_rows($result) > 0) {
    header('Location: index.php');
} else {
    echo "Invalid credentials";
}
?>




