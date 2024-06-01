
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

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $services = $_POST['services'];

    // Update the booking in the database
    $sql = "UPDATE booking SET `Name`=?, `Address`=?, `Contact Number`=?, `Date of Reservation`=?, `Time of Reservation`=?, `Select Services`=? WHERE id=?";
    $stmt = $connection->prepare($sql);

    if ($stmt === false) {
        die("Error preparing statement: " . $connection->error);
    }

    // Bind parameters and execute the statement
    $stmt->bind_param("ssssssi", $name, $address, $contact, $date, $time, $services, $id);
    if ($stmt->execute()) {
        echo "Booking updated successfully!";
    } else {
        echo "Error updating booking: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$connection->close();
?>
