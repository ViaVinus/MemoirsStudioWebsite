<?php
$servername = 'localhost';
$username = 'admin'; 
$password = 'Memors123';
$dbname = 'memoirsstudio';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM services";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            background-size: cover;
        }

        .header {
            background-color: #4F6F52;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            justify-content: flex-start;
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
            overflow-x: hidden;
            transition: all 0.3s ease-in-out;
        margin-top: 0px;
        transform: translateX(0);
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
            left: -250px; /* Initially hide the sidebar */
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


        .main-content {
            flex-grow: 1;
            padding: 80px;
            transition: all 0.3s ease-in-out;
            background-image: url(green1.jpg);
        }

        .main-content-expanded {
            margin-left: 0;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            max-width: 100%;
        }

        .box {
            background-color: #f9f9f9;
            border-radius: 15px;
            margin: 10px;
            padding: 20px;
            width: calc(33.33% - 20px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            box-sizing: border-box;
        }

        .service-group {
            display: flex;
            flex-wrap: wrap;
        }

        .box img {
            display: block;
            margin: 0 auto 20px;
            max-width: 100%;
            border-radius: 5px;
        }

        h3 {
            text-align: center;
        }

        h1 {
            text-align: center;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            margin-bottom: 10px;
        }

        p {
            font-size: 15px;
        }

        .btn {
            display: block;
            background-color: #007bff;
            color: #fff;
            text-align: center;
            padding: 10px;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 10px;
        }

        .btn-edit {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 20px 62px;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 10px;
        }

        .btn-delete {
            display: inline-block;
            background-color: #f44336;
            color: white;
            text-align: center;
            padding: 20px 62px;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 10px;
            margin-left: 5px;
        }

        li {
            text-align: middle;
            padding: 10px;
        }

        .service-price {
            display: block;
            background-color: #007bff;
            color: #fff;
            text-align: center;
            padding: 10px;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 10px;
        }

        @media screen and (max-width: 768px) {
            .header {
                flex-direction: row;
                padding: 10px;
                margin-left: 0px;
                margin-right: 0px;
            }

            .sidebar {
                position: absolute;
                z-index: 1000;
                left: 0;
                margin-top: 0px;
                width: 150px;
                height: 100%;
                transform: translateX(-250px);
                transition: transform 0.3s ease-in-out;
            }

             .sidebar-open {
    transform: translateX(0);
}

        .sidebar-close {
            transform: translateX(-250px);
        }

            .content {
                
                margin-top: 0px;
                transform: translateX(0);
                transition: none;
                
            }

            .main-content {
                padding: 10px;
                margin-left: 20px;
                transition: all 0.3s ease-in-out;
            }

            .main-content-collapsed {
                margin-left: 5px;
                margin-right:5px;
            }

         
        .btn-edit {
        padding: 10px 10px; 
    }

    .btn-delete {
        padding: 10px 10px; 
    }

    .service-group {
        flex-direction: column;
    }

    .box {
        width: 100%; /* Set the width to 100% */
        max-width: 100%; /* Ensure the maximum width is 100% */
        margin-bottom: 20px; 
        margin-left:-10px;
    }
        
        .service-price{
            padding:3px;
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
            <h1>MANAGE SERVICES</h1>
            <div class="service-group">
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="box">';
                        echo '<h3>' . $row["service_name"] . '</h3>';
                        echo '<img src="uploads/' . $row["service_image"] . '" alt="' . $row["service_name"] . '">';
                        echo '<p>';
                        echo $row["service_description"] . '<br>';
                        echo '<span class="service-price">PHP ' . number_format($row["service_price"], 2) . '</span>';
                        echo '</p>';
                        echo '<div>';
                        echo '<a href="edit_services.php?id=' . $row["service_id"] . '" class="btn-edit">Edit</a>';
                        echo '<a href="delete_services.php?id=' . $row["service_id"] . '" class="btn-delete">Delete</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "0 results";
                }
                $conn->close();
                ?>
            </div>
        </div>
    </div>
    <script>
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
    </script>
</body>
</html>
