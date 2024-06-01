<?php
  // Database connection parameters
  $servername = 'localhost';
  $username = 'root'; 
  $password = '';
  $dbname = 'memoirsstudio';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM services";
$result = $conn->query($sql);

$services = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $services[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($services);
?>
