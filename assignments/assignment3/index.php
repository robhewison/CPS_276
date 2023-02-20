<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Assignment 3</title>
</head>
<body>
<?php
require_once "Calculator.php";
$Calculator = new Calculator();
echo $Calculator->calc("/", 10, 0); 
echo $Calculator->calc("*", 10, 2); 
echo $Calculator->calc("/", 10, 2); 
echo $Calculator->calc("-", 10, 2); 
echo $Calculator->calc("+", 10, 2); 
echo $Calculator->calc("*", 10); 
echo $Calculator->calc(10); 
?>
</body>
</html>