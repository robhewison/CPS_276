<?php

//declare variables for main and subsections of the list
$mainListItems = 4;
$subListItems = 5;

function createNestedList($mainNum, $subNum) {
    $nestedList = "<ul>";

    for ($i = 1; $i <= $mainNum; $i++) {
    $nestedList .= "<li>$i";
    $nestedList .= "<ul>";
  
        for ($j = 1; $j <= $subNum; $j++) {
            $nestedList .= "<li>$j</li>";
    }
  
  $nestedList .= "</ul>";
  $nestedList .= "</li>";
}

$nestedList .= "</ul>";

return $nestedList;
}

$nestedList = createNestedList($mainListItems, $subListItems)

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
