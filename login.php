<?php
// Check if user exists

require 'dbconfig.php';
// Retrieving form data
$email = $_POST['email'];
$password = $_POST['password'];



 $fetchdata = $database->getReference('New')->getValue();
    
    
    
    foreach($fetchdata as $key => $value)
    {
        if ($email  == ($value['phone']) && $password == ($value['password']))
        {
    echo "Login successful!";
} else {
    echo "Invalid email or password!";
}
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
      
    }


?>
