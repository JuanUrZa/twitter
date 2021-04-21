<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login twitter</title>
    <link rel="stylesheet" href="css/master.css">
</head>
<body>
 
    <div class="login-box">
      <h1>Log in</h1>
      <form action="login.php" method="post" id="formlogin">
          <!-- Username -->
          <label for="username">Username</label>
          <input type="text" name="username" placeholder="Username">

          <!-- Password -->
          <label for="password">Password</label>
          <input type="password" name="password" placeholder="Password">

          <input type="submit" name="submit" value="Log In">

          <a href="signup.php">Register</a>
      </form>

    </div>
    
    <script src ="js/validation.js"></script>
</body>
</html>