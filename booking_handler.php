<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters
    $servername = 'localhost';
    $username = 'root'; 
    $password = '';
    $dbname = 'memoirsstudio';

    $mysqli = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Process form data
    $booking_date = $_POST['booking_date'];
    $customer_name = $_POST['customer_name'];
    // Add more fields as needed

    // Prepare SQL statement to insert data into the bookings table
    $sql = "INSERT INTO bookings (booking_date, customer_name) VALUES (?, ?)";
    $stmt = $mysqli->prepare($sql);
    
    // Bind parameters and execute the statement
    $stmt->bind_param("ss", $booking_date, $customer_name);
    
    if ($stmt->execute()) {
        echo "Booking saved successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and database connection
    $stmt->close();
    $mysqli->close();
} else {
    // If the form is not submitted, redirect to the booking page or display an error message
    echo "Form submission error!";
}
?>
