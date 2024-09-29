<?php

// Database connection
// $servername = "localhost";
// $username = "username";
// $password = "password";
// $database = "your_database";

// $conn = new mysqli($servername, $username, $password, $database);

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
///////////////
// ob_start();
//////////////
header('Content-Type: application/json');

// Allow only POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
require 'dbconfig.php';

$inputData = file_get_contents('php://input');
$data = json_decode($inputData, true); // Decode JSON input
$response = [];
if (isset($data['firstname']) && isset($data['lastname']) && isset($data['email']) && isset($data['selected_option_id']) && isset($data['regPassword'])) {
    if (!empty($data['email']) && !empty($data['regPassword'])) {
    $fetchdata = $database->getReference('New')->getValue();
    $counterRef = $database->getReference('Counter');
    $count=$counterRef->getValue();
    // Retrieve form data
    // $first_name = $_POST['firstname'];
    $first_name = $data['firstname'];
    $last_name = $data['lastname'];
    $email = $data['email'];
    $address = $data['selected_option_id'];
    $password = $data['regPassword'];
    $status = 1;//$_POST['status'];

    $storedPasswordHash = password_hash($password, PASSWORD_BCRYPT); 
    $AppData = [
        'user'=>$first_name,
        'password'=>$storedPasswordHash,
        'phone'=>$email,
        'address'=> $count+1,
        
    ];
// $count = $database->getReference('Counter');
// // $ref = $database->getReference('Counter');
// $count->set($database->getReference('Counter')->getValue()+1);
// $counterRef = $database->getReference('Counter');

// // Transaction to increment the value by 1
// $counterRef->transaction(function ($currentValue) {
//     return ($currentValue ?? 0) + 1;  // If current value is null, start from 0
// });

$ref='New/';
$postdata = $database->getReference($ref)->push($AppData);

// $counterRef->transaction(function ($currentValue) {
//     return ($currentValue ?? 0) + 1;  // If current value is null, start from 0
// });
$counterRef->set($count+1);
            $_SESSION["id"] = $postdata->getKey();//$value['phone']; gey unique key
            // $statusRef = $database->getReference('Data/' . $counterRef->getValue());
            // $statusRef->set($_POST['selected_option_id']);
            // Reference to the "Data" node
            $randomKey=$count+1;
            $dataRef = $database->getReference("Data/$randomKey");
            // $ref = $database->getReference("Data/$randomKey");
            // Add key-value pair: 0 => "00-3465"
            $dataRef->set([
                'address' => $address,
                'status' => $status
            ]);

            $_SESSION["logged_in"] = true; // Set a flag for logged-in users
            //header("location: profile.php");
            // exit;
///////////////
// ob_end_flush();
///////////////
// Check if username and password are present
    // $username = $data['username'];
    // $password = $data['password'];

    // // Here you would normally handle validation and save the user
    // // For example, hash the password and insert the user into a database
    // // Example (not connected to a database):
    // if (!empty($username) && !empty($password)) {
        // In a real scenario, hash the password before storing it
        // $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Simulating success response
        $response = [
            'status' => 'success',
            'message' => 'User registered successfully!',
            'user' => [
                'username' => $first_name + ' ' + $last_name,
                'email' => $email,
                'address' => $address,
                'status' => 1,
                // 'password' => $hashedPassword, // For real-world, never return the actual password
            ]
        ];
    } else {
        // Handle empty fields
        $response = [
            'status' => 'error',
            'message' => 'Username or password cannot be empty.',
        ];
    }

} else {
    // Handle missing fields
    $response = [
        'status' => 'error',
        'message' => 'Username and password are required.',
    ];
}

// Send the JSON response back to the client
echo json_encode($response);

} else {
// Handle invalid request methods
$errorResponse = [
    'status' => 'error',
    'message' => 'Invalid request method. Only POST is supported.'
];

echo json_encode($errorResponse);
}
?>
