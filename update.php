<?php
// Check if user exists
// Set content type to JSON
header('Content-Type: application/json');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Allow only POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require 'dbconfig.php';
    // Get the raw POST data
    $inputData = file_get_contents('php://input');
    $data = json_decode($inputData, true); // Decode JSON input
    $response = [];

    // Retrieving form data
    // $email = $_POST['username'];
    $status = intval($data['ustatus']);
    // $password = $data['password'];
    $itemFound = false;
    
    // session_start(); // Start the session, if not already started

    if (isset($_SESSION["id"])) {
        // $_SESSION["id"] exists
        // echo "Session ID exists: " . $_SESSION["id"];
        // $fetchdata = $database->getReference('New/'. $_SESSION["id"])->getValue();
        $addresskey = $database->getReference('New/' . $_SESSION["id"] . '/address')->getValue();
        $fetchaddress = $database->getReference('Data/'. $addresskey)->getValue();

        // $uniqueKey = $_SESSION["id"]; // The key under 'New' you want to update

        $updateData = [
            'status' => $status 
        ];

        $database->getReference('Data/' . $addresskey)->update($updateData);
        $response = [
            'status' => 'success',
            'message' => 'update successful!'
        ];
    // } else {
    //     // $_SESSION["id"] does not exist
    //     echo "Session ID does not exist.";
    // }
    

    // // Check if username and password are provided
    // // $email = $_POST['username'];
    // // $password = $_POST['password'];
    // // if (isset($data['username']) && isset($data['password'])) {
    // if (isset($email) && isset($password)) {
    //     $username = $data['username'];
    //     $password = $data['password'];

    //     // Normally, you would retrieve the stored hashed password from the database
    //     // Example (this is a mockup for demonstration purposes)
    //     // $storedUser = 'exampleUser'; 
    //     // $storedPasswordHash = password_hash($password, PASSWORD_BCRYPT); // Simulating stored password hash
     
    //  $fetchdata = $database->getReference('New')->getValue();
        
        
        
    //  foreach($fetchdata as $key => $value)
    //  {
    //     $storedUser = $value['phone']; 
    //     $storedPasswordHash = password_hash($value['password'], PASSWORD_BCRYPT); // Simulating stored password hash
        
    //     //  if ($email  == ($value['phone']) && password_verify($password, $value['password']))
    //     //  {
    //     //   $itemFound=true;
    //     //   $fetchaddress = $database->getReference('Data/'. $value['address'])->getValue();

    //     // $_SESSION["id"]=$key;
    //     // $_SESSION["logged_in"] = true;
    //     // //   "Data/$randomKey"
    //     // //   data[key].status
    //     //   $response = [
    //     //     'status' => 'success',
    //     //     'message' => 'Login successful!',
    //     //     'user' => [
    //     //         'username' => $value['user'],
    //     //         'email' => $value['phone'],
    //     //         'address' => $fetchaddress['address'],
    //     //         'status' => $fetchaddress['status']
    //     //         // 'password' => $hashedPassword, // For real-world, never return the actual password
    //     //     ]
    //     // ];
    //     //   break;
    //     // } 
    //     // else {
    //     // // Invalid credentials
    //     // $response = [
    //     //     'status' => 'error',
    //     //     'message' => 'Invalid username or password.'
    //     // ];
    //     // }
     
    // }     
        // if the email exist
    // if($_POST['email'] == ($value['email'])){$result = '<div class="alert alert-danger">Email are alraedy Sign-Up ..</div>';}
     //     //if the phone number exist
     // if($_POST['number'] == ($value['phone'])){$result ='<div class="alert alert-danger">Phone number are alraedy Sign-Up ..</div>';}
 
       // echo $value['user'] . "<br>";
       // echo $value['address'] . "<br>";
       // echo $value['phone'] . "<br>";
       // echo $value['stastus'] . "<br>";
 //     'password'=>'bb',
 //     'phone'=>'00000000',
 //     'address'=>'dd',
       
    // Send the JSON response back to the client
} else {
    // Handle missing fields
    $response = [
        'status' => 'error',
        'message' => 'Username and password are required.'
    ];
}

// Send the JSON response back to the client
echo json_encode($response);
//  if ($itemFound) {
     
//      echo "Login successful!";
//  } else {
     
//      echo "Invalid email or password!";
//  }


} else {
    // Handle invalid request methods
    $errorResponse = [
        'status' => 'error',
        'message' => 'Invalid request method. Only POST is supported.'
    ];

    echo json_encode($errorResponse);
}


?>
