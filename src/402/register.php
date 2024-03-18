<?php 
include "config/database.php";
$errorName = "";
$errorPassword = "";


// something is wrong with this.
function doesUserExist($email, $username, $conn) {
  $sql = 'SELECT username, email FROM users WHERE username = ? OR email = ?';

  // Prepare the statement
  $stmt = mysqli_prepare($conn, $sql);

  // Bind the parameters to the placeholders
  mysqli_stmt_bind_param($stmt, 'ss', $username, $email);

  // Execute the query
  mysqli_stmt_execute($stmt);

  // Store the result
  mysqli_stmt_store_result($stmt);

  // Check the number of rows that match the query
  if (mysqli_stmt_num_rows($stmt) > 0) {
    // A user with the given username or email exists
    return true;
  } else {
    // No user found with the given username or email
    return false;
  }
}
function registerUser($email, $username, $password, $conn) {
  $sql = "INSERT INTO users (username, email, `password`) VALUES ('$username', '$email', '$password')";
  if (mysqli_query($conn, $sql)) {
    // success
    header('Location: login.php');
    die();
  } else {
    // error
    echo 'Error: ' . mysqli_error($conn);
  }
}

if (isset($_POST["submit"])) {
  $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
  $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
  $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
  if (!ctype_alnum($username)) {
    $errorName = "Only alphanumeric characters allowed.";
  }

  if (str_contains($username, " ")) {
    $errorName .= "Can't contain whitespaces";
  }

  if (strlen($password) >= 50) {
    $errorPassword = "Password can't be longer then 50 characters.";
  } else {
    $password = password_hash($password, PASSWORD_DEFAULT);
  }
  if (empty($errorName) && empty($errorPassword)) {
    if (!doesUserExist($email, $username, $conn)) {
      registerUser($email, $username, $password, $conn);
    } else {
      echo "username or email already taken.";
    }
  }

  echo $errorName . $errorPassword;
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
    
    <div class="">
      <input type="submit" value="Register" name="submit" class="bg-zinc-500 border-yellow-500 text-stone-200 font-archivo font-medium tracking-wide p-2 hover:bg-zinc-700 duration-100">
      <a href="login.php">Already got account?</a>
  </div>
  </form>
</body>
</html>