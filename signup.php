<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up twitter</title>
    <link rel="stylesheet" href="css/master.css">
</head>
<body>
 
    <div class="signup-box">
      <h1>Create Account</h1>
      <form action="signup.php" method="post" id="formsignup">
          <!-- Username -->
          <label for="username">Username</label>
          <input type="text" name="username" placeholder="Username">

          <!-- Phone -->
          <label for="phone">Phone</label>
          <input type="text" name="phone" placeholder="Phone">

          <!-- Email -->
          <label for="email">Email</label>
          <input type="text" name="email" placeholder="Email">

          <!-- Password -->
          <label for="password">Password</label>
          <input type="password" name="password" placeholder="Password">

          <input type="submit" name="submit" value="Submit">

          <a href="login.php">Login</a>
      </form>

    </div>
    <script src="js/validation.js"></script>
</body>
</html>