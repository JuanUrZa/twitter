<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Account twitter</title>
  <link rel="stylesheet" href="assets/css/master.css">
</head>

<body>

  <div class="account-box">
    <h1>Message Posting View</h1>
    <form action="index.php?c=messages&a=searchMessages" id="formaccount" method="post">
      <input type="text" name="search" placeholder="Search">
      <input type="text" name="date" placeholder="YYYY-MM-DD">
      <input type="submit" name="submit" placeholder="Submit">
    </form>
    <br>
    <div class="message">
      <table>
        <tbody>
          <?php
          for ($i = count($messageArray) - 1; $i >= 0; $i--) {
          ?>
            <tr>
              <td><b><?php echo $messageArray[$i][0] ?></b></td>
            </tr>
            <tr>
              <td><?php echo $messageArray[$i][1] ?></td>
            </tr>
            <tr>
              <td><b><?php echo "By: " . $messageArray[$i][2] ?></b></td>
            </tr>
            <tr></tr>
            <tr></tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <br>
    <div class="writemessage">
      <form action="index.php?c=messages&a=saveMessage" method="post">
        <input type="text" name="comment" placeholder="Write a comment..">
        <input type="submit" name="submit" placeholder="Submit">
      </form>
      <?php
      if (isset($error)) {
        echo "<strong>" . $error . "</strong>";
      }
      ?>

    </div>

  </div>
</body>

</html>