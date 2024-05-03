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
    
 $code = [];
 $groupedData = [];
    foreach($fetchdata as $key => $value)
    {
       // if the email exist
    // if($_POST['email'] == ($value['email'])){$result = '<div class="alert alert-danger">Email are alraedy Sign-Up ..</div>';}
    //     //if the phone number exist
    // if($_POST['number'] == ($value['phone'])){$result ='<div class="alert alert-danger">Phone number are alraedy Sign-Up ..</div>';}
///////////////////////////////////
      // echo $value['user'] . "<br>";
      echo $value['address'] . "<br>";
      $code[] = ['code' => $value['address']];
      // echo $value['phone'] . "<br>";
      // echo $value['status'] . "<br>";
	   //  echo $value['password'] . "<br>";
       //////////////////////////////////////
//     'password'=>'bb',
//     'phone'=>'00000000',
//     'address'=>'dd',


$codeA = explode('-', $value['address'])[0];

// Initialize array for this CodeA if not already done
if (!isset($groupedData[$codeA])) {
    $groupedData[$codeA] = [];
}

// Push item to array for this CodeA
$groupedData[$codeA][] =  $value;

      
    }

    print_r($groupedData);
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
// $AppData = [
//     'user'=>'Mr.aa',
//     'password'=>'bb',
//     'phone'=>'00000000',
//     'address'=>'dd',
// 	'status'	=>	'123',
	
// ];
// $ref='New/';
// $postdata = $database->getReference($ref)->push($AppData);
$jsonData = json_encode($code);
?>

<script>
// Use the PHP variable in JavaScript
let data = JSON.parse('<?php echo $jsonData; ?>');

// let data = [
//     {"code": "6-601-601026", "other_key": "value1"},
//     {"code": "6-601-601027", "other_key": "value2"},
//     {"code": "7-701-701028", "other_key": "value3"},
//     // more data...
// ];

let groupedData = data.reduce((acc, item) => {
    let codeA = item.code.split('-')[0]; // Extract CodeA
    if (!acc[codeA]) {
        acc[codeA] = []; // Initialize array if not already done
    }
    acc[codeA].push(item); // Push item to array for this CodeA
    return acc;
}, {});

console.log(groupedData);

</script>