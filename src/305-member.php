<?php
  session_start();
  //logs user in if already logged in.
  if (isset($_COOKIE["remember"])) {
    $_SESSION["logged_in"] = true;
  }
?>

<?php 
  //redirects to login if not logged in.
  if (!isset($_COOKIE["remember"])) {
    $_SESSION["logged_in"] = false;
    header("Location: " . "305-login.php");
  }
  // same checks if user not logged in.
  if (empty($_SESSION["logged_in"]) || $_SESSION["logged_in"] == false) {
    header("Location: " . "305-login.php");
    die();
  }


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>305 - member</title>
</head>

<body>
  <?php echo $_COOKIE["remember"] ?>
  <h1>Logged In</h1>
</body>
</html>