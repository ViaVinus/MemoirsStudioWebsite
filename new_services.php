<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $service_name = $_POST["service_name"];
    $service_description = nl2br($_POST["service_description"]);
    $service_price = $_POST["service_price"];
    $service_image = $_FILES["service_image"]["name"]; 

    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    $target_file = $target_dir . basename($_FILES["service_image"]["name"]);

    if (move_uploaded_file($_FILES["service_image"]["tmp_name"], $target_file)) {
          // Database connection parameters
    $servername = 'localhost';
    $username = 'root'; 
    $password = '';
    $dbname = 'memoirsstudio';
          
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO services (service_name, service_description, service_price, service_image) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssds", $service_name, $service_description, $service_price, $service_image);

        if ($stmt->execute()) {
            $conn->close();
            header("Location: manage_services.php");
            exit(); 
        } else {
            echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
    } else {
        echo "<p>Sorry, there was an error uploading your file.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Service</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
     body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-image: url(green1.jpg);
            transition: margin-left 0.3s;
        }

        .header {
            background-color: #4F6F52;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            justify-content: flex-start; /* Align items to the left */
            align-items: center;
        }

        .header a {
            color: #fff;
            text-decoration: none;
            margin-right: 10px;
        }

        .header a:hover {
            background-color: #0C0C0C; 
        }

        .content {
            display: flex;
            flex: 1;
            transition: margin-left 0.3s;
            overflow-x: hidden; 
        }

      .sidebar {
            background-color: white;
            padding: 30px;
            width: 250px;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease-in-out;
            position: absolute;
            height: 100%;
            left: -250px;
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
            margin-right: 10px;
        }

        .sidebar ul li a i {
            display: inline-block;
        }

        .sidebar-open {
            left: 0;
        }
        .content-open {
            margin-left: 0; 
        }

        .admin-info {
            padding: 20px;
        }


        h1 {
            text-align:center;
         margin-left:500px;
        }
        textarea {
    resize: vertical;
    min-height: 100px;
    white-space: pre-line; 
    font-size: 18px; 
}
form {
            width: 80%;
            max-width: 600px;
            background-color: #f9f9f9;
            padding: 50px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top:50px;
            margin-left:300px;
        }

        label {
            display: block;
            margin-bottom: 4px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-weight: bold;
        }

        input[type="file"] {
            margin-top: 5px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            margin-top:20px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            margin-top: 10px;
        }
         li{
            text-align:middle;
            padding: 10px;
         }
     @media screen and (max-width: 768px) {
    .header {
        flex-direction: row;
        justify-content: space-between;
        padding: 10px;
        margin-left: 0;
        margin-right: 0;
    }
     h1 {
        text-align: center;
        margin-left: 0;
    }

    .sidebar {
        position: absolute;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 150px;
        height: 100%;
        transform: translateX(-250px);
        transition: transform 0.3s ease-in-out;
    }

    .sidebar-open {
        transform: translateX(0);
    }

    .content {
        flex-direction: column;
        margin-top: 0px;
        transform: translateX(0);
        transition: none;
    }

    .main-content {
        transition: all 0.3s ease-in-out;
    }

    .main-content-collapsed {
        margin-left: 0px;
        margin-top:0px;
    }

    form {
        width: 100%;
        max-width: 100%;
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 0px;
        margin-left:-0px;
        margin-right:-10px;
    }

   h1 {
        font-size: 24px;
   }
        
}
    </style>
</head>
<body>
<header class="header">
        <button id="toggleSidebar" class="sidebar-toggle-icon"><i class="fas fa-bars"></i></button>
    </header>
    <div class="content">
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
            <h1>Add New Service</h1>
            <form action="new_services.php" method="post" enctype="multipart/form-data">
                <label for="service_name">Service Name:</label><br>
                <input type="text" id="service_name" name="service_name" required><br><br>
                
                <label for="service_description">Description:</label><br>
                <textarea id="service_description" name="service_description" rows="4" required style="white-space: pre-line;"></textarea>
                
                <label for="service_price">Price:</label><br>
                <input type="number" id="service_price" name="service_price" step="0.01" required><br><br>
                
                <label for="service_image">Upload Image:</label><br>
                <input type="file" id="service_image" name="service_image" accept="image/*" required><br><br>
                
                <input type="submit" value="Add Service">
            </form>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                echo "<p>Service Name: " . $service_name . "</p>";
                echo "<p>Service Description: " . $service_description . "</p>";
                echo "<p>Service Price: " . $service_price . "</p>";
                echo "<p>Service Image: " . $service_description . "</p>";
            }
            ?>
           
        <script>
             document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            var sidebar = document.querySelector('.sidebar');
            var mainContent = document.querySelector('.main-content');

            if (sidebar.classList.contains('sidebar-open')) {
                sidebar.classList.remove('sidebar-open');
                mainContent.style.marginLeft = '0';
            } else {
                sidebar.classList.add('sidebar-open');
                mainContent.style.marginLeft = '250px';
            }
        });
    });
        </script>
    </body>
    </html> 
      