<?php
session_start();

include 'Database.php';
include 'User.php';
include 'session_check.php';

if (isset($_POST['submit']) && ($_SERVER['REQUEST_METHOD'] == 'POST')) {
    // Create database connection
    $database = new Database();
    $db = $database->getConnection();

    // Retrieve and sanitize user inputs
    $matric = trim($_POST['matric']);
    $password = trim($_POST['password']);

    // Validate inputs
    if (!empty($matric) && !empty($password)) {
        $user = new User($db);
        $userDetails = $user->getUser($matric);

        // Check if user exists and verify password
        if ($userDetails && password_verify($password, $userDetails['password'])) {
            // Login successful - store session data
            $_SESSION['matric'] = $userDetails['matric'];
            $_SESSION['name'] = $userDetails['name'];
            $_SESSION['role'] = $userDetails['role'];

            // Redirect to a successful page
            header("Location: welcome.php");
            exit;
        } else {
            // Login failed - redirect back with error message
            header("Location: login.php?error=Invalid username or password");
            exit;
        }
    } else {
        // Empty fields
        header("Location: login.php?error=Please fill in all fields");
        exit;
    }
} else {
    echo "Invalid request.";
}
?>
