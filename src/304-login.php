<?php
session_start();

function redirect($url) {
  header('Location: '.$url);
  die();
}
if (isset($_POST["login"])) {
  login();
}

if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == true && !empty($_SESSION)) {
  redirect("304-member.php");
}

function login() {
  if (!empty($_POST["username"] && !empty($_POST["password"]))) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username == "admin" && $password == "D42aLgTG") {
      $_SESSION["logged_in"] = true;
      redirect("304-member.php");

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
  <title>304 - login</title>
</head>


<body>
    <form action="304-login.php" method="POST">
      <label for="username">Username:</label>
      <input type="text" id="username" placeholder="Username" name="username" required>
      <label for="password">Password:</label>
      <input type="password" placeholder="Password" id="password" name="password" required>
      <input type="submit" value="Login" name="login" id="login">
    </form>
</body>
</html>