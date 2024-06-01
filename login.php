<?php
session_start();

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

  // Database connection parameters
  $servername = 'localhost';
  $username = 'root'; 
  $password = '';
  $dbname = 'memoirsstudio';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize input
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows == 1) {
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;

        if (isset($_POST['remember']) && $_POST['remember'] == 'on') {
            // Generate a random token and store it in the database
            $token = bin2hex(random_bytes(16));
            $stmt = $conn->prepare("UPDATE admin SET remember_token = ? WHERE username = ?");
            $stmt->bind_param('ss', $token, $username);
            $stmt->execute();

            setcookie('remember_token', $token, time() + (86400 * 30), "/");
            setcookie('username', $username, time() + (86400 * 30), "/");
        }

        header('Location: Dashboard.php');
        exit; 
    } else {
        $login_error = 'Invalid username or password. Please try again.';
    }

    $stmt->close();
    $conn->close();
} else {
    if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
        setcookie('remember_token', '', time() - 3600, "/");
        setcookie('username', '', time() - 3600, "/");
        header('Location: login.php');
        exit; 
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="container">
        <h2>Admin Login</h2>
        <form id="loginForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="input-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="input-group">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Remember Me</label>
            </div>

            <?php if (isset($login_error)) : ?>
                <p class="error-message"><?php echo $login_error; ?></p>
            <?php endif; ?>
            <div class="clearfix">
                <button class="button" type="submit">Login</button>
            </div>
        </form>
    </div>
</body>
</html>
