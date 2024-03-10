
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Form</title>
</head>
<body>
  <h1>Registration Form</h1>
  
  <form action="register.php" method="post">
    <label for="full_name">Full Name:</label>
    <input type="text" id="full_name" name="full_name" required>
    
    <label for="last_name">Last Name:</label>
    <input type="text" id="last_name" name="last_name" required>
    
    <label for="email">Email Address:</label>
    <input type="email" id="email" name="email" required>
    
    <label for="email">Address:</label>
    <input type="address" id="address" name="address" required>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    
    <label for="confirm_password">Confirm Password:</label>
    <input type="password" id="confirm_password" name="confirm_password" required>
    
    <input type="checkbox" id="terms" name="terms" required>
    <label for="terms">I agree to the Terms and Conditions</label>
    
    <button type="submit">Sign Up</button>
  </form>
  
  <p>Already have an account? <a href="login.html">Login here</a></p>
</body>
</html>
