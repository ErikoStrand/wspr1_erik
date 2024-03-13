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
    header("Location: " . "306-login.php");
  }
  // same checks if user not logged in.
  if (empty($_SESSION["logged_in"]) || $_SESSION["logged_in"] == false) {
    header("Location: " . "306-login.php");
    die();
  }

  function getUsersPosts($filename, $user) {
    if (file_exists($filename)) {
      $posts = file_get_contents($filename);
      $posts = json_decode($posts, true);
    }

    if (isset($posts[$user])) {
      return $posts[$user];
    } else {
      return [];
    }
  }

  $userPosts = getUsersPosts("userPosts.json", $_COOKIE["remember"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>306 - member</title>
</head>

<body>
  <h1>Logged In as <?php echo $_COOKIE["remember"] ?></h1>
  <form action="306-member.php" method="post">
    <label for="postText">Post Something</label>
    <input type="text" name="postText">
    <input type="submit" value="Post" name="postSubmit">
  </form>

  <div id="userPosts">
    <h2>Your Posts:</h2>
    <?php foreach($userPosts as $post): ?>
      <div class="post">
        <p class="post-text"><?php echo date("Y-m-d H:i:s", $post["timestamp"]), " ",  $post["content"] ?></p>
      </div>
      <?php endforeach; ?>
  </div>
</body>
</html>

<style>
#userPosts {
  width: 500px;
  margin-top: 20px;
  display: flex;
  flex-direction: column;
  gap: 4px;
  background-color: rgb(100, 100, 100);
}

.post {
  word-break: break-all;
  width: 100%;
  color:azure;
  background-color: rgb(110, 110, 110);
}

.post-text {
  padding: 8px;
}
</style>

<?php 

function savePost($filename, $content, $user) {
  // Load existing posts from the file
  if (file_exists($filename)) {
      $posts = file_get_contents($filename);
      $posts = json_decode($posts, true); // Decode as associative array
  }
  
  // Generate timestamp
  $timestamp = time();
  
  // If the user already has posts, append the new post; otherwise, create a new list for the user
  if(isset($posts[$user])) {
      $posts[$user][] = ["content" => $content, "timestamp" => $timestamp];
  } else {
      $posts[$user] = [["content" => $content, "timestamp" => $timestamp]];
  }
  
  // Save the updated posts back to the file
  file_put_contents($filename, json_encode($posts));
  header("Refresh:0");
}

if (isset($_POST["postSubmit"])) {
  $text = htmlspecialchars($_POST["postText"]);
  savePost("userPosts.json", $text, $_COOKIE["remember"]);
}

?>