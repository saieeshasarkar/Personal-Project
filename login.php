<?php
// Check if user exists
<?php
// Set content type to JSON
header('Content-Type: application/json');

// Allow only POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get the raw POST data
    $inputData = file_get_contents('php://input');
    $data = json_decode($inputData, true); // Decode JSON input

    require 'dbconfig.php';
    // Retrieving form data
    $email = $_POST['email'];
    $password = $_POST['password'];
    $itemFound = false;
    
    

    // Check if username and password are provided
    $email = $_POST['email'];
    $password = $_POST['password'];
    // if (isset($data['username']) && isset($data['password'])) {
    if (isset($email) && isset($password)) {
        $username = $data['username'];
        $password = $data['password'];

        // Normally, you would retrieve the stored hashed password from the database
        // Example (this is a mockup for demonstration purposes)
        // $storedUser = 'exampleUser'; 
        // $storedPasswordHash = password_hash($password, PASSWORD_BCRYPT); // Simulating stored password hash
        
     $fetchdata = $database->getReference('New')->getValue();
        
        
        
     foreach($fetchdata as $key => $value)
     {
        $storedUser = $value['phone']; 
        $storedPasswordHash = password_hash($value['password'], PASSWORD_BCRYPT); // Simulating stored password hash
        
         if ($email  == ($value['phone']) && password_verify($password, $storedPasswordHash)))
         {
          $itemFound=true;
          $fetchaddress = $database->getReference('Data/'$value['address'])->getValue();
          
        //   data[key].status
          $response = [
            'status' => 'success',
            'message' => 'Login successful!',
            'user' => [
                'username' => $value['user'],
                'email' => $email,
                'address' => $fetchaddress.address,
                'status' => $fetchaddress.status,
                // 'password' => $hashedPassword, // For real-world, never return the actual password
            ]
          break;
        ];
        } else {
        // Invalid credentials
        $response = [
            'status' => 'error',
            'message' => 'Invalid username or password.'
        ];
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
//  if ($itemFound) {
     
//      echo "Login successful!";
//  } else {
     
//      echo "Invalid email or password!";
//  }

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
