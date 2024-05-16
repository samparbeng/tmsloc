<?php
define('DB_HOST1','localhost');
define('DB_USER1','root');
define('DB_PASS1','');
define('DB_NAME1','carrental');

// Create connection
$conn = new mysqli(DB_HOST1, DB_USER1, DB_PASS1, DB_NAME1);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>