<?php
require 'connection.php';
// Simple login script for demonstration
$username = $_POST['name'];
$password = $_POST['pass'];

$result=mysqli_query($conn,"SELECT * FROM admins WHERE Name='$username' and Password='$password'");

// Hardcoded credentials for demonstration purposes
if (mysqli_num_rows($result) > 0) {
    header('Location: adminlogindata.php');
} else {
    echo "Invalid credentials";
}
?>