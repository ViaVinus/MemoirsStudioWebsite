<?php
$servername = 'localhost';
$username = 'admin'; 
$password = 'Memors123';
$dbname = 'memoirsstudio';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>