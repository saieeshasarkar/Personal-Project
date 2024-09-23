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
ob_start();
require 'dbconfig.php';

 $fetchdata = $database->getReference('New')->getValue();
 $counterRef = $database->getReference('Counter');
// Retrieve form data
$first_name = $_POST['firstname'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$address = $_POST['selected_option_id'];
$password = $_POST['password'];
$status = 0;//$_POST['status'];


$AppData = [
    'user'=>$first_name,
    'password'=>$password,
    'phone'=>$email,
    'address'=> $counterRef->getValue()+1,
	'status'	=>	'test',
	
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

$counterRef->transaction(function ($currentValue) {
    return ($currentValue ?? 0) + 1;  // If current value is null, start from 0
});
            $_SESSION["id"] = $postdata->getKey();//$value['phone']; gey unique key
            // $statusRef = $database->getReference('Data/' . $counterRef->getValue());
            // $statusRef->set($_POST['selected_option_id']);
            // Reference to the "Data" node
            $randomKey=$counterRef->getValue();
            $dataRef = $database->getReference("Data/$randomKey");
            // $ref = $database->getReference("Data/$randomKey");
            // Add key-value pair: 0 => "00-3465"
            $dataRef->update([
                $status => $address
            ]);

            $_SESSION["logged_in"] = true; // Set a flag for logged-in users
            header("location: profile.php");
            exit;

ob_end_flush();
?>
