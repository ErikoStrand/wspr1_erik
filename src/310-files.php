
<?php 
  $path = "users.txt";
  
  function writeFile($filename, $content, $cols) {
    $handle = fopen($filename,"a");
    for ($i = 0; $i < $cols; $i++) {
      fwrite($handle, $content);
    }
  }
  
  function echoFile($path) { 
    if (file_exists($path)) {
      $handle = fopen($path,"r");
      $fileContent = fread($handle, filesize($path));
      fclose($handle);
      echo nl2br($fileContent);
    }
  }
?>

