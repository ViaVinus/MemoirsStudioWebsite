<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize user input
    $name = htmlspecialchars($_POST["name"]);
    $address = htmlspecialchars($_POST["address"]);
    $contact = htmlspecialchars($_POST["number"]);
    $date = htmlspecialchars($_POST["date"]);
    $time = htmlspecialchars($_POST["time"]);
    $selectedServices = isset($_POST["select-services"]) ? htmlspecialchars($_POST["select-services"]) : "";

    // Database connection parameters
    $servername = 'localhost';
    $username = 'root'; 
    $password = '';
    $dbname = 'memoirsstudio';

    // Create connection
    $connection = new mysqli($servername, $username, $password, $dbname);
    if ($connection->connect_errno > 0) {
        // Error handling
        echo 'Failed to connect to MySQL: ' . $connection->connect_error;
        die();
    }

    // Prepare the SQL statement
    $sql = "INSERT INTO `booking` (`Name`, `Address`, `Contact Number`, `Date of Reservation`, `Time of Reservation`, `Select Services`)
        VALUES (?, ?, ?, ?, ?, ?)";

    // Create a prepared statement
    $stmt = $connection->prepare($sql);
    if (!$stmt) {
        // Error handling
        echo "Error preparing statement: " . $connection->error;
        die();
    }

    // Bind parameters
    $stmt->bind_param("ssssss", $name, $address, $contact, $date, $time, $selectedServices);

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "success"; // Send success response to AJAX
    } else {
        // Error handling
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();

    // Close connection
    $connection->close();
}
?>
