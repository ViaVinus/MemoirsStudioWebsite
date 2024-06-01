<?php
  // Database connection parameters
  $servername = 'localhost';
  $username = 'root'; 
  $password = '';
  $dbname = 'memoirsstudio';
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if service ID is provided and valid
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $service_id = $_GET['id'];
    
    // Prepare SQL statement to delete service
    $sql = "DELETE FROM services WHERE service_id = ?";

    // Prepare and bind parameter
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $service_id);

    if ($stmt->execute()) {
        // If deletion is successful, redirect to manage_services.php
        header("Location: manage_services.php");
        exit(); 
    } else {
        echo "Error deleting service: " . $conn->error;
    }
} else {
    echo "Invalid service ID";
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
