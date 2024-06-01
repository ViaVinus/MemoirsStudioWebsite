<?php
if (isset($_GET['id'])) {
    $reservationId = $_GET['id'];

      // Database connection parameters
      $servername = 'localhost';
      $username = 'root'; 
      $password = '';
      $dbname = 'memoirsstudio';

    
    $connection = new mysqli($servername, $username, $password, $dbname);

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    
    $sql = "DELETE FROM booking WHERE id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $reservationId); 

    if ($stmt->execute()) {
    
        header("Location: view_orders.php");
        exit(); 
    } else {
        echo "Error deleting reservation: " . $stmt->error;
    }

    $stmt->close();
    $connection->close();
} else {
    echo "Reservation ID not provided";
}
?>
