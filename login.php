<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    <!-- Login Box -->
    <div class="box">
        <form action="authenticate.php" method="post">
            <label for="matric">Matric:</label>
            <input type="text" name="matric" id="matric" required><br><br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required><br><br>
            <input type="submit" name="submit" value="Login">
        </form>
        <p><a href="register.php">Register</a> here if you have not.</p>
    </div>

    <!-- Display Error Message If Exists -->
    <?php
    if (isset($_GET['error'])) {
        echo '<div class="error">';
        echo '<p>Invalid username or password, try <a href="login.php">login</a> again.</p>';
        echo '</div>';
    }
    ?>
</body>
</html>
