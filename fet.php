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
      echo $key . "<br>";
      echo $value['address'] . "<br>";
      // $code[] = ['code' => $value['address']];
      $code[] = $value['address'];
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

// let groupedData = data.reduce((acc, item) => {
//     let codeA = item.code.split('-')[0]; // Extract CodeA
//     if (!acc[codeA]) {
//         acc[codeA] = []; // Initialize array if not already done
//     }
//     acc[codeA].push(item.code.split('-')[1]); // Push item to array for this CodeA
//     return acc;
// }, {});
// 1-101-101005
// 1-101-101005
// 1-101-101006
// 6-601-601026
// 14-1405-1405064
// 14-1405-1405000
// 14-1406-140501
// let data = [
//     "1-101-101005",
//     "1-101-101005",
//     "1-101-101006",
//     "6-601-601026",
//     "14-1405-1405064",
//     "14-1405-1405000",
//     "14-1406-140501"
// ];

// let data = {
//   "1": {
//     "101": [
//       "101005",
//       "101005",
//       "101006"
//     ]
//   },
//   "6": {
//     "601": [
//       "601026"
//     ]
//   },
//   "14": {
//     "1405": [
//       "1405064",
//       "1405000"
//     ],
//     "1406": [
//       "140501"
//     ]
//   }
// }
// ;
// console.log(groupedData);
let result = {};

data.forEach(item => {
    let [key1, key2, value] = item.split("-");
    if (!result[key1]) {
        result[key1] = {};
    }
    if (!result[key1][key2]) {
        result[key1][key2] = [];
    }
    result[key1][key2].push(value);
});


console.log(result);

// function countMembers(data, key, subKey) {
//     if (subKey === '0' && data.hasOwnProperty(key)) {
//         let count = 0;
//         for (let subKey in data[key]) {
//             count += data[key][subKey].length;
//         }
//         return count;
//     } else if (data.hasOwnProperty(key) && data[key].hasOwnProperty(subKey)) {
//         return data[key][subKey].length;
//     }
//     return 0;
// }
function countMembers(data, key, subKey) {
    if (data.hasOwnProperty(key)) {
        if (subKey && data[key].hasOwnProperty(subKey)) {
            return data[key][subKey].length;
        } else {
            let count = 0;
            for (let subKey in data[key]) {
                count += data[key][subKey].length;
            }
            return count;
        }
    }
    return 0;
}
console.log(result);
console.log(countMembers(data, '1', '101'));  // Outputs: 2
</script>