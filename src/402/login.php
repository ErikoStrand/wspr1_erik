<?php 
include "config/database.php";
$error = "";

if (isset($_POST["submit"])) {
  $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
  $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

  if(tryLoggingIn($username, $password, $conn)) {
    header("Location: member.php");
    die();
  } else {
    $error = "Incorrect password or username";
  }
}
function tryLoggingIn($username, $password, $conn) {
  $sql = 'SELECT * FROM users WHERE username = ?';

  // Prepare the statement
  $stmt = mysqli_prepare($conn, $sql);

  // Bind the username parameter to the placeholder
  mysqli_stmt_bind_param($stmt, 's', $username);

  // Execute the query
  mysqli_stmt_execute($stmt);

  // Get the result set from the prepared statement
  $result = mysqli_stmt_get_result($stmt);

  // Fetch the user data as an associative array
  $user = mysqli_fetch_assoc($result);
  if ($user) {
    $savedPassword = $user['password'];
    if (password_verify($password, $savedPassword)) {
      return true;
    } else {
      return false;
    }
  }
  }
  
echo $error;
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
  
  <form action="" method="post" class="flex flex-col p-4">
    <label for="" >Username</label>
    <input class="border-2" type="text" name="username" required>
    <label for="" >Password</label>
    <input class="border-2" type="password" name="password" required>
    <input type="submit" value="Login" name="submit" class="bg-zinc-500 border-yellow-500 text-stone-200 font-archivo font-medium tracking-wide p-2 hover:bg-zinc-700 duration-100">
  </form>
</body>
</html>