<?php 
if (empty($_POST["color"])) {
    $color = "white";
} else {
    $color = $_POST["color"];
};



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>301</title>
</head>
<body style="background-color:<?php echo $color;?>">

<form action="" method="post">
    <label for="color">Change Color</label>
    <input type="text" name="color" id="color">
    <input type="submit" value="Change">
</form>
</body>
</html>