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

// Retrieve form data
$first_name = $_POST['firstname'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$address = $_POST['selected_option_id'];
$password = $_POST['password'];


$AppData = [
    'user'=>$first_name,
    'password'=>$password,
    'phone'=>$email,
    'address'=>$address,
	'status'	=>	'test',
	
];
$ref='New/';
$postdata = $database->getReference($ref)->push($AppData);


            $_SESSION["username"] = '$email';//$value['phone'];
            $_SESSION["logged_in"] = true; // Set a flag for logged-in users
            header("location: profile.php");
            exit;

ob_end_flush();
?>
