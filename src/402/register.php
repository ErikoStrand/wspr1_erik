<?php 
include "config/database.php";
$errorName = "";
$errorPassword = "";

function doesUserExist($email, $username, $conn) {
  $sql = 'SELECT username, email FROM accounts';
  $result = mysqli_query($conn, $sql);
  $feedback = mysqli_fetch_all($result, MYSQLI_ASSOC);
  echo $feedback;

}
function registerUser($email, $username, $password, $conn) {

}
if (isset($_POST["submit"])) {
  $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
  $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
  $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
  if (!ctype_alnum($username)) {
    $errorName = "Only alphanumeric characters allowed.";
  }
  if (strlen($password) >= 50) {
    $errorPassword = "Password can't be longer then 50 characters.";
  } else {
    $password = password_hash($password, PASSWORD_DEFAULT);
  }
}
echo $password . $username;
if (empty($errorName) && empty($errorPassword)) {
  if (!doesUserExist($email, $username, $conn)) {
    
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="/src/output.css" rel="stylesheet" />
  <title>Document</title>
</head>
<body>
  
  <form action="" method="post" class="flex flex-col p-4 gap-2">
    <label for="" >Email</label>
    <input class="border-2" type="email" name="email" required>
    <label for="" >Username</label>
    <input class="border-2" type="text" name="username" required>
    <label for="" >Password</label>
    <input class="border-2" type="password" name="password" required>
    <input type="submit" value="Login" name="submit" class="bg-zinc-500 border-yellow-500 text-stone-200 font-archivo font-medium tracking-wide p-2 hover:bg-zinc-700 duration-100">
  </form>
</body>
</html>