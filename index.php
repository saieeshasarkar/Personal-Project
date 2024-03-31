<?php

require 'dbconfig.php';
session_start();
$itemFound = false;


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

    $fetchdata = $database->getReference('New')->getValue();
    
    
    
    foreach($fetchdata as $key => $value)
    {
        if ($valid_username  == ($value['phone']) && $valid_password == ($value['password']))
        {
         $itemFound=true;
         break;
} 
if ($itemFound) {
    
    $_SESSION["username"] = $valid_username;
    header("location: profile.php");
    exit;
} else {
    
    $error = "Invalid username or password";
}

    // Check if the provided credentials are valid
    // if($_POST["username"] == $valid_username && $_POST["password"] == $valid_password) {
    //     // Store username in session and redirect to profile page
    //     $_SESSION["username"] = $valid_username;
    //     header("location: profile.php");
    //     exit;
    // } else {
    //     $error = "Invalid username or password";
    // }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2>Login</h2>
                    </div>
                    <div class="card-body">
                        <?php if(isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
                        <form method="post" action="">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" id="username" name="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                        <div class="mt-3">
                            <p>Don't have an account? <a href="registration.php">Register</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
