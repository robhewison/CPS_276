<?php

$mainListItems = 5;
$subListItems = 5;

$nestedList = "<ul>";

for ($i = 1; $i <= $mainListItems; $i++) {
  $nestedList .= "<li>$i";
  $nestedList .= "<ul>";
  
  for ($j = 1; $j <= $subListItems
; $j++) {
    $nestedList .= "<li>$j</li>";
  }
  
  $nestedList .= "</ul>";
  $nestedList .= "</li>";
}

$nestedList .= "</ul>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Exercise 1</title>
</head>
<body>
    <?php echo $nestedList; ?>
</body>
</html>
