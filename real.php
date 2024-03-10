<?php

// require '/vendor/autoload.php';

// use Kreait\Firebase\Factory;
// use Kreait\Firebase\ServiceAccount;

// use Kreait\Firebase\Factory;
// use Kreait\Firebase\ServiceAccount;
// use Kreait\Firebase\Auth;

// $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/kerrili-firebase-adminsdk-h2y2z-d8a2a21d61.json');

// $firebase = (new Factory)
//     ->withServiceAccount($serviceAccount)
//     ->create();

// $database = $firebase->getDatabase();

// $newPost = $database
//     ->getReference('blog/posts')
//     ->push([
//         'title' => 'Post title',
//         'body' => 'This should probably be longer.'
//     ]);

// $newPost->getChild('title')->set('Changed post title');
// $newPost->getValue(); // Fetches the data from the realtime database
// echo $newPost->getValue();
// // $newPost->remove();

require 'dbconfig.php';

 $fetchdata = $database->getReference('New')->getValue();
    
    
    
    foreach($fetchdata as $key => $value)
    {
        //if the email exist
    // if($_POST['email'] == ($value['email'])){$result = '<div class="alert alert-danger">Email are alraedy Sign-Up ..</div>';}
    //     //if the phone number exist
    // if($_POST['number'] == ($value['phone'])){$result ='<div class="alert alert-danger">Phone number are alraedy Sign-Up ..</div>';}
        
    }
//     $_SESSION['result']=$result;
//     //if there is an error
//     if(isset($result)){echo $result;}
//     //if user doesn't exist at the database
//     //then add him info in the database
//     if(empty($_SESSION['result'])){$AppData = [
//     'email'=>$_POST['email'],
//     'password'=>$_POST['password'],
//     'phone'=>$_POST['number'],
//     'pp'=>'all done',
// 	'username'	=>	$_POST['username'],
	
// ];
$AppData = [
    'user'=>'Mr.aa',
    'password'=>'bb',
    'phone'=>'00000000',
    'address'=>'dd',
	'status'	=>	'123',
	
];
$ref='New/';
$postdata = $database->getReference($ref)->push($AppData);
?>
