<?php
// Start the session to access login status
session_start();

// SECURITY CHECK:
// Check if the user is not logged in. The '!' means 'not'.
// If the session variable is not set or is false, redirect to the login page.
if (!isset($_SESSION['user_is_logged_in']) || $_SESSION['user_is_logged_in'] !== true) {
    header("Location: index.php");
    exit(); // Important to stop the script from running further
}

// If the user wants to log out
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    // Unset all session variables
    $_SESSION = array();
    // Destroy the session
    session_destroy();
    // Redirect to login page
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 40px; }
        .dashboard-container { max-width: 800px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        h1 { color: #333; }
        p { color: #555; }
        a { color: #fff; background-color: #d9534f; padding: 10px 15px; border-radius: 5px; text-decoration: none; }
        a:hover { background-color: #c9302c; }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h1>Welcome to the Admin Dashboard</h1>
        <p>You have successfully logged in. This area is protected.</p>
        <br>
        <!-- Logout link -->
        <a href="dashbord.php?action=logout">Logout</a>
    </div>
</body>
</html>