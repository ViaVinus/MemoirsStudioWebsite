<?php
  // Database connection parameters
  $servername = 'localhost';
  $username = 'root'; 
  $password = '';
  $dbname = 'memoirsstudio';

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Retrieve id from the URL
$id = $_GET['id'] ?? ''; // Retrieve the id parameter

// Construct the SQL DELETE query using prepared statement
$sql = "DELETE FROM booking WHERE `id` = ?";

// Prepare SQL statement
$stmt = $connection->prepare($sql);
if (!$stmt) {
    die('MySQL prepare error: ' . $connection->error);
}

// Bind id parameter to the prepared statement as an integer
$stmt->bind_param('i', $id); // 'i' for integer, assuming id is an integer

// Execute the query
if ($stmt->execute()) {
    // Redirect back to the view page after successful deletion
    header("Location: view.php");
} else {
    echo "Error deleting record: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$connection->close();
?>
