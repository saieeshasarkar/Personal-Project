<?php
session_start();

// Check if user is already logged in, if yes, redirect to profile page
if(isset($_SESSION["username"])) {
    header("location: profile.php");
    exit;
}

// Check if form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Dummy credentials
    $valid_username = "user";
    $valid_password = "password";

    // Check if the provided credentials are valid
    if($_POST["username"] == $valid_username && $_POST["password"] == $valid_password) {
        // Store username in session and redirect to profile page
        $_SESSION["username"] = $valid_username;
        header("location: profile.php");
        exit;
    } else {
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if(isset($error)) { echo "<div>$error</div>"; } ?>
    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
