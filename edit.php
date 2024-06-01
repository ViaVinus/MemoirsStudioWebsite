<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Page</title>
        <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    h2{
    text-align: center;
    }
    .container {
    max-width: 1000px;
    padding: 20px;
    background-image: url(../images/green1.jpg); 
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
    .input-group {
        margin-bottom: 20px;
    }

    .input-group label {
        display: block;
        margin-bottom: 5px;
        width: 700px;   
    }

    .input-group input {
        width: calc(100% - 10px); 
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        font-family: 'Courier New', Courier, monospace;
        font-weight: bold;
    }

    .btn-submit {
        align: center;
        background-color: #4CAF50;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        
    }

    .btn-submit:hover {
        background-color: #45a049;
        
    }
</style>

    </head>
    <body>

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
    // Retrieve bookings from the database
    $sql = "SELECT `id`, `Name`, `Address`, `Contact Number`, `Date of Reservation`, `Time of Reservation`, `Select Services` FROM booking";
    $result = $connection->query($sql);

    if ($result === false) {
        // Handle the error - for example, logging it or displaying a user-friendly message
        die("Error executing query: " . $connection->error);
    }

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<a href='edit.php?id=" . urlencode($row['id']) . 
        "&name=" . urlencode($row['Name']) . 
        "&address=" . urlencode($row['Address']) . 
        "&contact=" . urlencode($row['Contact Number']) . 
        "&date=" . urlencode($row['Date of Reservation']) . 
        "&time=" . urlencode($row['Time of Reservation']) . 
        "&services=" . urlencode($row['Select Services']) . "'></a><br>";


        }
    } else {
        echo "0 results";
    }

    // Retrieve information from URL parameters if they are set
$id = isset($_GET['id']) ? $_GET['id'] : '';
$name = isset($_GET['name']) ? $_GET['name'] : '';
$address = isset($_GET['address']) ? $_GET['address'] : '';
$contact = isset($_GET['contact']) ? $_GET['contact'] : '';
$date = isset($_GET['date']) ? $_GET['date'] : '';
$time = isset($_GET['time']) ? $_GET['time'] : '';
$services = isset($_GET['services']) ? $_GET['services'] : '';
$servicesArray = explode(", ", $services);


    ?>

    <div class="container">
        <h2>Edit Booking</h2>
        
        <form action="update.php" method="POST" class="contact-form">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
            
            <div class="input-group"> <!-- Adjusted here -->
                <label for="name">Full Name:</label>
                <input type="text" name="name" placeholder="Name" required value="<?php echo htmlspecialchars($name); ?>">
            </div>
            
            <div class="input-group"> <!-- Adjusted here -->
                <label for="address">Address:</label>
                <input type="text" name="address" placeholder="Address" required value="<?php echo htmlspecialchars($address); ?>">
            </div>
            
            <div class="input-group"> <!-- Adjusted here -->
                <label for="number">Contact Number:</label>
                <input type="tel" name="contact" placeholder="Contact Number" required value="<?php echo htmlspecialchars($contact); ?>">
            </div>
            
            <div class="input-group"> <!-- Adjusted here -->
                <label for="date">Date of Reservation:</label>
                <input type="date" name="date" placeholder="Date of Reservation" required value="<?php echo htmlspecialchars($date); ?>">
            </div>
            
            <div class="input-group"> <!-- Adjusted here -->
                <label for="time">Time of Reservation:</label>
                <input type="time" name="time" placeholder="Time of Reservation" required value="<?php echo htmlspecialchars($time); ?>">
            </div>
            
            <div class="input-group"> <!-- Adjusted here -->
                <label for="select-services">Select Services:</label>
                <input type="text" id="select-services" name="services" placeholder="Select Services" required value="<?php echo htmlspecialchars($services); ?>">
            </div>
            <div id="service-options" class="service-options">
                <div>
                    <input type="checkbox" id="service1" name="service1" value="Solo" <?php echo in_array('Solo', $servicesArray) ? 'checked' : ''; ?>>
                    <label for="service1">Solo Package</label>
                </div>
                <div>
                    <input type="checkbox" id="service2" name="service2" value="Duo" <?php echo in_array('Duo', $servicesArray) ? 'checked' : ''; ?>>
                    <label for="service2">Duo Package</label>
                </div>
                <div>
                    <input type="checkbox" id="service3" name="service3" value="Group" <?php echo in_array('Group', $servicesArray) ? 'checked' : ''; ?>>
                    <label for="service3">Group Package</label>
                </div>
                <div>
                    <input type="checkbox" id="service4" name="service4" value="Birthday" <?php echo in_array('Birthday', $servicesArray) ? 'checked' : ''; ?>>
                    <label for="service4">Birthday Package</label>
                </div>
                <div>
                    <input type="checkbox" id="service5" name="service5" value="Special Birthday" <?php echo in_array('Special Birthday', $servicesArray) ? 'checked' : ''; ?>>
                    <label for="service5">Special Birthday Package</label>
                </div>
            
            <button type="submit" class="btn-submit">Update Booking</button>
        </form>
    </div>

    <script>
        
            function updateSelectedServices() {
                var checkboxes = document.querySelectorAll('#service-options input[type="checkbox"]:checked');
                var selectedServices = Array.from(checkboxes).map(checkbox => checkbox.value).join(", ");
                document.getElementById("select-services").value = selectedServices;
            }

            document.querySelectorAll('#service-options input[type="checkbox"]').forEach(checkbox => {
                checkbox.addEventListener('change', updateSelectedServices);
            });

            window.onload = updateSelectedServices; // Ensures the input field is synchronized with pre-selected checkboxes on page load
        </script>
    </body>
    </html>
