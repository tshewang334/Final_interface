<?php
// Start a session to manage user's login status
session_start();

// --- Configuration ---
// The correct admin code. In a real application, this should be more secure.
$correct_admin_code = "ADMIN12345";

// --- Processing Logic ---

// Check if the request method is POST (i.e., the form was submitted)
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if the 'admin_code' field was sent from the form
    if (isset($_POST['admin_code'])) {
        $submitted_code = $_POST['admin_code'];

        // Validate the submitted code
        if ($submitted_code === $correct_admin_code) {
            // SUCCESS: Code is correct

            // Set a session variable to mark the user as logged in
            $_SESSION['user_is_logged_in'] = true;

            // Redirect the user to the protected dashboard page
            header("Location: dashbord.php");
            exit(); // Stop script execution after redirect

        } else {
            // FAILURE: Code is incorrect

            // Store an error message in the session
            $_SESSION['error_message'] = "Invalid Code. Please try again.";

            // Redirect the user back to the login page
            header("Location: index.php");
            exit();
        }
    } else {
        // Handle cases where the form was submitted without the code field
        $_SESSION['error_message'] = "Please enter a code.";
        header("Location: index.php");
        exit();
    }
} else {
    // If someone tries to access this page directly without POST method, redirect them
    header("Location: index.php");
    exit();
}
?>