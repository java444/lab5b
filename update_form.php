<?php
include 'Database.php';
include 'User.php';
include 'session_check.php';


// Check if the form has been submitted with a GET request
if (isset($_GET['matric']) && !empty($_GET['matric'])) {
    // Retrieve the matric value from the GET request
    $matric = $_GET['matric'];

    // Create an instance of the Database class and get the connection
    $database = new Database();
    $db = $database->getConnection();

    // Fetch user data
    $user = new User($db);
    $userDetails = $user->getUser($matric);

    $db->close();

    // Display the update form if user data exists
    if ($userDetails) {
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Update User</title>
            
        </head>

        <body>
            <h1>Update User</h1>
            <div class="box">
                <form action="update_process.php" method="post">
                    <label for="matric">Matric</label>
                    <input type="text" id="matric" name="matric" value="<?php echo htmlspecialchars($userDetails['matric']); ?>" readonly><br>

                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($userDetails['name']); ?>" required><br>

                    <label for="role">Access Level</label>
                    <select name="role" id="role" required>
                        <option value="student" <?php if ($userDetails['role'] == 'student') echo "selected"; ?>>student</option>
                        <option value="lecturer" <?php if ($userDetails['role'] == 'lecturer') echo "selected"; ?>>lecturer</option>
                    </select><br>

                    <input type="submit" name="update" value="Update">
                    <a href="read.php">Cancel</a>
                </form>
            </div>
        </body>

        </html>
        <?php
    } else {
        echo "User not found.";
    }
} else {
    echo "Invalid request. No Matric provided.";
}
?>
