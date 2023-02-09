<?php

//Set number of rows and cells
$numRows = 15;
$numColumns = 5;

//Create a function that makes a table given a set number of rows and columns
function createTable($rows, $cols) {
    $table = "<table>";
    for ($i = 1; $i <= $rows; $i++) {
        $table .= "<tr>";
        for ($j = 1; $j <= $cols; $j++) {
          $table .= "<td>Row " . $i . " Cell " . $j . "</td>";
        }
        $table .= "</tr>";
      }
    $table .= "</table>";
    return $table;
}

//Call the create table function and store it in the variable
$definedTable = createTable($numRows, $numColumns);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Exercise 3</title>
    <style>
        table, th, td {
            border: 1px solid;
        }
    </style>
</head>
<body>
    <?php echo $definedTable ?>
</body>
</html>