<?php

require 'dbconfig.php';
session_start();


// Check if user is already logged in, if yes, redirect to profile page
if(isset($_SESSION["username"])) {
    header("location: profile.php");
    exit;
}

// Check if form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $valid_username = $_POST['username']; // Assuming you're getting these values from a form
    $valid_password = $_POST['password'];
    
    $itemFound = false;
    $fetchdata = $database->getReference('New')->getValue();

    foreach ($fetchdata as $key => $value) {
        if ($valid_username == $value['phone'] && $valid_password == $value['password']) {
            $itemFound = true;
            $_SESSION["username"] = $value['phone'];
            $_SESSION["logged_in"] = true; // Set a flag for logged-in users
            header("location: profile.php");
            exit; // Terminate the script after redirection
        }
    }
    
    if (!$itemFound) {
        $error = "Invalid username or password";
        // Display the error message to the user (e.g., in your HTML form)
    }

// $itemFound = false;
//     // Dummy credentials
//     // $valid_username = "user";
//     // $valid_password = "password";
//     $valid_username = $_POST['username'];
// $valid_password = $_POST['password'];

//     $fetchdata = $database->getReference('New')->getValue();
    
    
    
//     foreach($fetchdata as $key => $value)
//     {
//         if ($valid_username  == ($value['phone']) && $valid_password == ($value['password']))
//         {
//          $itemFound=true;
         
//          echo "test1";
//     $_SESSION["username"] = $value['phone'];
//     header("location: profile.php");
//     echo "test2";
//     exit;
//     break;
//         }
//     } 
// if ($itemFound) {
//     // echo "test";
//     // $_SESSION["username"] = $valid_username;
//     // header("location: profile.php");
//     // exit;

// } else {
    
//     $error = "Invalid username or password";
// }

//     // Check if the provided credentials are valid
//     // if($_POST["username"] == $valid_username && $_POST["password"] == $valid_password) {
//     //     // Store username in session and redirect to profile page
//     //     $_SESSION["username"] = $valid_username;
//     //     header("location: profile.php");
//     //     exit;
//     // } else {
//     //     $error = "Invalid username or password";
//     // }
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
