<?php

// 

ob_start();
require 'dbconfig.php';

session_start();
// Check if user is already logged in, if yes, redirect to profile page
if(isset($_SESSION["id"])) {
    // echo $_SESSION["username"];
    header("location: profile.php");
    
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
     exit;
}

// Check if form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $valid_username = $_POST['username']; // Assuming you're getting these values from a form
    $valid_password = $_POST['password'];
    
    $itemFound = false;
    $fetchdata = $database->getReference('New')->getValue();

    foreach ($fetchdata as $key => $value) {
        if ($valid_username  == ($value['phone']) && $valid_password == ($value['password']))
        // if ($valid_username  == '123' && $valid_password == '123')
        {
            $itemFound = true;
            $_SESSION["id"]= $key;
            // $_SESSION["username"] = '123';//$value['phone'];
            $_SESSION["logged_in"] = true; // Set a flag for logged-in users
            header("location: profile.php");
            exit;
             break;
        }
    }
    
    if (!$itemFound) {
        $error = "Invalid username or password";
        // Display the error message to the user (e.g., in your HTML form)
    }
    // else {
    //     // echo $_SESSION["username"];
    //     header("location: test.php");
    //     exit;
    // }

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

//  $firebaseConfig = [
//     apiKey: "AIzaSyBf3m74nlIkWPD1D9PMycQQIKxze0A-1hg",
//     authDomain: "dengue-fever-database-6da72.firebaseapp.com",
//     databaseURL: "https://dengue-fever-database-6da72-default-rtdb.asia-southeast1.firebasedatabase.app",
//     projectId: "dengue-fever-database-6da72",
//     storageBucket: "dengue-fever-database-6da72.appspot.com",
//     messagingSenderId: "484563913792",
//     appId: "1:484563913792:web:617b18689b4238c825e3a5",
//     measurementId: "G-LXXV81FSTD"
// ];
  $firebaseConfig = [
    'apiKey' => "AIzaSyBf3m74nlIkWPD1D9PMycQQIKxze0A-1hg",
    'authDomain' => "dengue-fever-database-6da72.firebaseapp.com",
    'databaseURL' => "https://dengue-fever-database-6da72-default-rtdb.asia-southeast1.firebasedatabase.app",
    'projectId' =>"dengue-fever-database-6da72",
    'storageBucket' => "dengue-fever-database-6da72.appspot.com",
    'messagingSenderId' => "484563913792",
    'appId' => "1:484563913792:web:617b18689b4238c825e3a5",
    'measurementId' => "G-LXXV81FSTD"
];
 ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- <sript src="https://www.gstatic.com/firebasejs/9.0.0/firebase-app.js"></script> -->

<!-- Include the Firebase Realtime Database SDK -->
<!-- <script src="https://www.gstatic.com/firebasejs/9.0.0/firebase-database.js"></script> -->


<script src="https://www.gstatic.com/firebasejs/8.2.4/firebase.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.2.4/firebase-database.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/8.2.4/firebase-analytics.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.2.4/firebase-auth.js"></script>
<sript src="https://www.gstatic.com/firebasejs/8.2.4/firebase-app.js"></script>

<script>
        var firebaseConfig = <?php echo json_encode($firebaseConfig); ?>;
    </script>
    </head>

<body>
<!-- <script src="app.js"></script> -->
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
    <button id="addRecordButton" onclick="addNewRecord()">Add New Record</button>
    <button id="editRecordButton" onclick="editRecord('-O7DY2jSQDgA6M0g6dlm')">Edit Record</button>

    <div id="real-time-data">
  <!-- Real-time data will be displayed here -->
</div>

<script>

firebase.initializeApp(firebaseConfig);
  // Reference to your Firebase Realtime Database
  var database = firebase.database();

  // Reference to the specific location in your database
  var dataRef = database.ref('New');

  // Listen for changes in the data and update the webpage
  dataRef.on('value', function(snapshot) {
    var data = snapshot.val();
    // Update the HTML element with the fetched data
    document.getElementById('real-time-data').innerHTML = JSON.stringify(data);

  });

  function addNewRecord() {
    const newRecordRef = dbRef.push(); // Automatically generates a unique key
    newRecordRef.set({
        name: "John Doe",
        email: "john@example.com"
    }).then(() => {
        console.log('New record saved successfully.');
    }).catch((error) => {
        console.error('Error saving new record:', error);
    });
}

function editRecord(userId) {
    const specificRef = dbRef.child(userId);
    specificRef.update({
        user: "newemail@example.com", // Update email field
        status: "Yes"
    }).then(() => {
        console.log('Record updated successfully.');
    }).catch((error) => {
        console.error('Error updating record:', error);
    });
}
</script>
</body>
</html>
