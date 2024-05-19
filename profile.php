<?php

ob_start();
require 'dbconfig.php';

session_start();

// Check if user is not logged in, redirect to login page

// if(!isset($_SESSION["username"])) {
//  echo $_SESSION["username"];
$userprofile;
if(empty($_SESSION['id'])) {
    header("location: index.php");
    exit;
}else {
    $userprofile = $database->getReference('New')->getChild($_SESSION['id'])->getValue();

}

// Check if form is submitted for updating address
if($_SERVER["REQUEST_METHOD"] == "POST") {

    // Update address logic can go here
    // $updated_address = $_POST["address"];
    // // Dummy logic to update address in session
    // $_SESSION["address"] = $updated_address;
    $childKey = $_SESSION['id']; // replace with your child key
// $newAddress = 'your_new_address'; // replace with your new address
// $fetchdata = $database->getReference('New')->getValue();
$database->getReference('New')->getChild($childKey)->update([
    'status' => $_POST["status"]
]);
$userprofile = $database->getReference('New')->getChild($_SESSION['id'])->getValue();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Profile</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <h2>Welcome, <?php echo $userprofile["user"]; ?></h2>
        <h3>Profile</h3>
        <p>Address: <?php echo isset($userprofile["address"]) ? $userprofile["address"] : "N/A"; ?></p>
        <form method="post" action="">
            <div class="form-group">
                <label for="address">Status:</label>
                <input type="text" id="status" name="status" class="form-control" value="<?php echo isset($userprofile["status"]) ? $userprofile["status"] : ""; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Address</button>
        </form>
    </div>
</body>
</html>
