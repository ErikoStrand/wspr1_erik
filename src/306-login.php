<?php
session_start();
// logs user in if they have done it b4.
if (isset($_COOKIE["remember"])) {
  $_SESSION["logged_in"] = true;
}
function redirect($url) {
  header('Location: '.$url);
  die();
}
// only runs login code if the form button is pressed.
if (isset($_POST["login"])) {
  login();
}

// rederiects to member if logged in.
if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == true) {
  redirect("306-member.php");
}

function login() {
  //checks so they are not empty.
  if (!empty($_POST["username"] && !empty($_POST["password"]))) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username == "admin" && $password == "D42aLgTG") {
      setcookie("remember", $username, time() + 60*60*24);
      $_SESSION["logged_in"] = true;
      redirect("306-member.php");

  }} else {
    // add so it displays that smting is wrong.
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>306 - login</title>
</head>


<body>
    <form action="305-login.php" method="POST">
      <label for="username">Username:</label>
      <input type="text" id="username" placeholder="Username" name="username" required>
      <label for="password">Password:</label>
      <input type="password" placeholder="Password" id="password" name="password" required>
      <input type="submit" value="Login" name="login" id="login">
    </form>
</body>
</html>