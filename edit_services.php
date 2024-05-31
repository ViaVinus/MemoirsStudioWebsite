<?php
$servername = 'localhost';
$username = 'admin'; 
$password = 'Memors123';
$dbname = 'memoirsstudio';
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if service ID is provided in the URL
if(isset($_GET['id'])) {
    $service_id = $_GET['id'];
    
    // Fetch service details from the database
    $sql = "SELECT * FROM services WHERE service_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $service_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if service exists
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Assign fetched values to variables
        $service_name = $row['service_name'];
        $service_description = $row['service_description'];
        $service_price = $row['service_price'];
        $service_image = $row['service_image'];
    } else {
        // Handle case where service ID is not found
        echo "Service not found";
        exit;
    }
} else {
    // Handle case where service ID is not provided in the URL
    echo "Service ID not provided";
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $service_name = isset($_POST['service_name']) ? $_POST['service_name'] : '';
    $service_description = isset($_POST['service_description']) ? $_POST['service_description'] : '';
    $service_price = isset($_POST['service_price']) ? $_POST['service_price'] : '';
    
    // Handle image upload if a new image is provided
if ($_FILES['service_image']['name']) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["service_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["service_image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    
    // Check file size
    if ($_FILES["service_image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    
    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["service_image"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["service_image"]["name"])) . " has been uploaded.";
            // Update the database with the new image path
            $service_image = basename($_FILES["service_image"]["name"]);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

    // Update the service details in the database
    $sql_update = "UPDATE services SET service_name=?, service_description=?, service_price=?, service_image=? WHERE service_id=?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("ssdsi", $service_name, $service_description, $service_price, $service_image, $service_id);
    
    if ($stmt_update->execute()) {
        header("Location: manage_services.php");
        exit;
    } else {
        echo "Error updating service: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Service</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
       body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
            background-image: url(green1.jpg);
        }

        .container {
            display: flex;
            flex-grow: 1; /* Fill remaining space */
        }

        .sidebar {
            background-color: white;
            padding: 30px;
            width: 250px;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between; /* Push content to the top and bottom */
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            font-weight: bold;
        }

        .sidebar ul li {
            margin-bottom: 30px;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #333;
            display: flex;
            align-items: center;
        }

        .sidebar ul li:hover {
            background-color: #C0C0C0;
        }

        .sidebar ul li a:hover {
            color: #000;
        }

        .sidebar ul li i {
            width: 20px;
            text-align: center;
            margin-right: 0px;
        }

        .sidebar ul li a i {
            display: inline-block;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 49px;
        }

        .main-content {
            flex-grow: 1; /* Fill remaining space */
            padding: 20px; /* Adjust padding as needed */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .admin-info {
            max-width: 889px; /* Increased max-width */
            width: 100%;
            margin-top: -300px; /* Center the form container horizontally */
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        input[type="file"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        img {
            max-width: 200px;
            height: auto;
            margin-bottom: 10px;
        }

        li {
            text-align: middle;
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <ul>
                <li><a href="Dashboard.php"><i class="fas fa-home"></i>&nbsp; Dashboard</a></li>
                <li><a href="manage_services.php"><i class="fas fa-cogs"></i>&nbsp; Services</a></li>
                <li><a href="new_services.php"><i class="fas fa-plus"></i>&nbsp; Add New Services</a></li>
                <li><a href="view_orders.php"><i class="fas fa-clipboard-list"></i>&nbsp; Reservations</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i>&nbsp; Log Out</a></li> 
            </ul>
        </div>
        <div class="main-content">
            <div class="admin-info">
                <div class="form-container">
                    <h1>Edit Service</h1>
                    <form action="edit_services.php?id=<?php echo $service_id; ?>" method="post" enctype="multipart/form-data">
                        <label for="service_name">Service Name:</label>
                        <input type="text" id="service_name" name="service_name" value="<?php echo $service_name; ?>" required>
                        
                        <label for="service_description">Description:</label>
                        <textarea id="service_description" name="service_description" rows="4" required><?php echo $service_description; ?></textarea>
                        
                        <label for="service_price">Price:</label>
                        <input type="number" id="service_price" name="service_price" step="0.01" value="<?php echo $service_price; ?>" required>
                        
                        <label for="service_image">Upload New Image:</label>
                        <input type="file" id="service_image" name="service_image" accept="image/*">
                        
                        <img src="uploads/<?php echo $service_image; ?>" alt="Current Image">
                
                        <!-- Hidden input field to pass service_id -->
                        <input type="hidden" name="service_id" value="<?php echo $service_id; ?>">
                        
                        <input type="submit" value="Update Service">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const toggleButton = document.getElementById("toggleSidebar");
        const sidebar = document.querySelector(".sidebar");
        const content = document.querySelector(".content");
        const todoToggle = document.getElementById("todoToggle");
        
        toggleButton.addEventListener("click", function() {
            sidebar.classList.toggle("sidebar-open");
            content.classList.toggle("content-open");
        });
    });
</script>
</body>
</html>