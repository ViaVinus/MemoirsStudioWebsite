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
            left: -250px; /* Initially hide the sidebar */
        }

         .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            font-weight: bold;
        }

        .sidebar ul li {
            margin-bottom: 50px;
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
         .main-content {
            padding: 20px;
            flex: 1;
            margin-left: 0; /* Initially no margin */
            transition: margin-left 0.3s;
            /* Adjusted to accommodate the sidebar */
            margin-left: 250px;
            box-sizing: border-box;
            /* Padding on all sides to create space */
            padding-left: 70px;
            padding-right: 60px;
        }

        .admin-info {
            padding: 20px;
        }

        table {
    width: 90%; 
    margin: 30px auto; 
    border-collapse: collapse;
    border: 2px solid; 
    background-color: #f2f2f2; 
    margin-left:-0px;
    margin-top: 100px;
}

th, td {
    padding: 10px; 
    text-align: left;
    border-bottom: 1px solid #ddd; 
}

th {
    background-color: #4CAF50;
    color: white;
}

tr:nth-child(even) {
    background-color: #f2f2f2; 
}

tr:hover {
    background-color: #f5f5f5; 
}
        a {
            text-decoration: none;
            color: #333;
        }

        a:hover {
         color: #4F6F52;
        }

        td {
            text-align: center;
            font-weight: bold;
        }

        input[type="text"],
        input[type="submit"] {
            padding: 10px;
            margin: 10px 0;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

         .table-container {
            overflow-x: auto;
        }
        .delete-button {
    padding: 6px 12px;
    border-radius: 4px;
    text-decoration: none;
    display: inline-block; 
    cursor: pointer;
     background-color: #f44336;
    color: white;
}

       @media only screen and (max-width: 768px) {
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
                flex-direction: column;
                margin-top: 0px;
                transform: translateX(0);
                transition: none;
            }

            .main-content {
                padding: 10px;
                margin-left: 0;
            }

            .admin-info h1 {
                font-size: 24px;
            }

            .admin-info p {
                font-size: 14px;
            }

            /* Make the table scrollable horizontally */
            table {
                width: 100%;
                overflow-x: auto;
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
            <form action="view_orders.php" method="GET" class="search-form">
                <label for="search"></label>
                <input type="text" name="search" placeholder="Search...">
                <input type="submit" value="Submit">
            </form>
            <div class="table-container">
                <table>
                    <tr>
                        <th>id</th>
                        <th>Full Name</th>
                        <th>Address</th>
                        <th>Contact Number</th>
                        <th>Date of Reservation</th>
                        <th>Time of Reservation</th>
                        <th>Selected Services</th>
                        <th>Delete</th>
                    </tr>
    <?php
   // Database connection parameters
   $servername = 'localhost';
   $username = 'root'; 
   $password = '';
   $dbname = 'memoirsstudio';
$connection = new mysqli($servername, $username, $password, $dbname);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
$search = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT `id`, `Name`, `Address`, `Contact Number`, `Date of Reservation`, `Time of Reservation`, `Select Services` FROM booking";

if ($search) {
    $sql .= " WHERE `id` LIKE ? OR `Name` LIKE ? OR `Address` LIKE ? OR `Contact Number` LIKE ? OR `Date of Reservation` LIKE ? OR `Time of Reservation` LIKE ? OR `Select Services` LIKE ?";
}
$stmt = $connection->prepare($sql);
if ($stmt) {
    if ($search) {
        $searchParam = "%$search%";
        $stmt->bind_param("sssssss", $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam);
    }

    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
           
                echo "<tr> 
    <td>{$row['id']}</td>
    <td>{$row['Name']}</td>
    <td>{$row['Address']}</td>
    <td>{$row['Contact Number']}</td>
    <td>" . date('Y-m-d', strtotime($row['Date of Reservation'])) . "</td>
    <td>" . date('h:i A', strtotime($row['Time of Reservation'])) . "</td>
    <td>{$row['Select Services']}</td>
    <td> <a class='delete-button' href='delete_reservation.php?id={$row['id']}'>Delete</a></td>

</tr>";
            } 
        } else {
          
            echo "<tr><td colspan='8'>No results</td></tr>";
        }

        $result->close();
    } else {
       
        echo "Error executing statement: " . $stmt->error;
    }

    
    $stmt->close();
} else {
    
    echo "Error preparing statement: " . $connection->error;
}
$connection->close();
?>

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