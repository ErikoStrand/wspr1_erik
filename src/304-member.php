<?php
  session_start();
?>
<?php 
  if (empty($_SESSION["logged_in"])) {
    header("Location: " . "304-login.php");
    die();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>304 - Member</title>
</head>

<body>
  <h1>Logged In</h1>
</body>
</html>