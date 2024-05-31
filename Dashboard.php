<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    // Redirect the user to the login page
    header("Location: login.php");
    exit();
}
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

         .main-content {
            padding: 20px;
            flex: 1;
            margin-left: 0; /* Initially no margin */
            transition: margin-left 0.3s;
            /* Adjusted to accommodate the sidebar */
            margin-left: 250px;
            box-sizing: border-box;
            /* Padding on all sides to create space */
            padding-left: 60px;
            padding-right: 60px;
        }

        .admin-info {
            padding: 20px;
        }


        .booking-container {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
        }

        .booking-item {
            background-color: #fff;
            padding: 10px 20px;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            flex: 1;
            margin-right: 20px;
        }

        .booking-item:last-child {
            margin-right: 0;
        }

        .booking-item h2 {
            margin-top: 0;
            text-align: center;
        }

        .booking-item p {
            margin-bottom: 0;
        }

        li {
            text-align: middle;
            padding: 10px;
        }

        @media screen and (max-width: 768px) {
            /* Existing media query styles... */
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
                <h1>HELLO ADMIN</h1>
                <p>
                    Welcome to the admin dashboard. Here you can manage users, products, and orders.
                </p>
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