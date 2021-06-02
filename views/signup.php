<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign up twitter</title>
  <link rel="stylesheet" href="assets/css/master.css">
</head>

<body>

  <div class="signup-box">
    <h1>Create Account</h1>
    <form action="index.php?c=users&a=saveUser" method="post" id="formsignup">
      <!-- Username -->
      <label for="username">Username</label>
      <input type="text" name="username" placeholder="Username">
      <?php
      if (isset($correctUser)) {
        if (!$correctUser) echo "<strong>" . "Username incorrect" . "</strong>";
      }
      ?>
      <!-- Phone -->
      <label for="phone">Phone</label>
      <input type="text" name="phone" placeholder="Phone">
      <?php
      if (isset($correctPhone)) {
        if (!$correctPhone) echo "<strong>" . "Phone incorrect" . "</strong>";
      }
      ?>
      <!-- Email -->
      <label for="email">Email</label>
      <input type="text" name="email" placeholder="Email">
      <?php
      if (isset($correctEmail)) {
        if (!$correctEmail) echo "<strong>" . "Email incorrect" . "</strong>";
      }
      ?>
      <!-- Password -->
      <label for="password">Password</label>
      <input type="password" name="password" placeholder="Password">
      <?php
      if (isset($correctPassword)) {
        if (!$correctPassword) echo "<strong>" . "Password incorrect" . "</strong>";
      }
      ?>
      <?php
      if (isset($error)) {
        echo "<strong>" . $error . "</strong>";
      }
      if (isset($userCreated)) {
        echo "<strong>" . $userCreated . "</strong>";
      }
      ?>
      <input type="submit" name="submit" value="Submit">

      <a href="index.php">Login</a>
    </form>

  </div>
  <!-- <script src="assets/js/validation.js"></script> -->
</body>

</html>