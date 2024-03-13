<?php
$targetDir = "uploads/"; // Specify the directory where you want to store uploaded files
$allowedExtensions = array("jpg", "jpeg", "png");
$maxFileSize = 500 * 1024;

// Check if file was uploaded without errors
if(isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == 0) {
  $fileName = basename($_FILES["fileToUpload"]["name"]);
    $targetFile = $targetDir . $fileName;
    $fileExtension = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

    // Check if file already exists
    if (!in_array($fileExtension, $allowedExtensions)) {
      echo "Sorry only JPG, JPEG and PNG allowed";
    } else {
      if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
    } else {
      //check if its under size limit.
        if ($_FILES["fileToUpload"]["size"] > $maxFileSize) {
          echo "The file is to large keep ut under 500kb";
        } else {
          if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            echo "The file ". $fileName. " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
        }

    }
    }
  }   
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  
  <form action="307.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="fileToUpload" id="image">
    <input type="submit" value="Submit">
  </form>
</body>
</html>