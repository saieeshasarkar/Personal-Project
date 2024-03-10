<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Form</title>
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    form {
      width: 300px;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      background-color: #f9f9f9;
    }
    h1 {
      text-align: center;
    }
    input[type="text"],
    input[type="email"],
    input[type="password"],
    button {
      width: 100%;
      margin-bottom: 10px;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
    }
    button {
      background-color: #007bff;
      color: white;
      cursor: pointer;
    }
    button:hover {
      background-color: #0056b3;
    }
    p {
      text-align: center;
    }
  </style>
</head>
<body>
  <div>
    <h1>Registration Form</h1>
    
    <!-- App Logo -->
    <img src="your_logo.png" alt="App Logo">
    
    <form action="submit_registration.php" method="post">
      <label for="full_name">Full Name:</label>
      <input type="text" id="full_name" name="full_name" required>
      
      <label for="last_name">Last Name:</label>
      <input type="text" id="last_name" name="last_name" required>
      
      <label for="email">Email Address:</label>
      <input type="email" id="email" name="email" required>
      
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>
      
      <label for="confirm_password">Confirm Password:</label>
      <input type="password" id="confirm_password" name="confirm_password" required>
      
      <input type="checkbox" id="terms" name="terms" required>
      <label for="terms">I agree to the Terms and Conditions</label>
      
      <button type="submit">Sign Up</button>
    </form>
    
 
