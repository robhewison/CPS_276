<?php
require_once "Calculator.php";

$Calculator = new Calculator();

echo("The following is: 10 / 0");
echo "<br>";

echo $Calculator->calc("/", 10, 0); //will output Cannot divide by zero
echo "<br>";

echo("The following is: 10 * 2");
echo "<br>";

echo $Calculator->calc("*", 10, 2); //will output The product of the numbers is 20
echo "<br>";

echo("The following is: 10 / 2");
echo "<br>";

echo $Calculator->calc("/", 10, 2); //will output The division of the numbers is 5
echo "<br>";

echo("The following is: 10 - 2");
echo "<br>";

echo $Calculator->calc("-", 10, 2); //will output The difference of the numbers is 8
echo "<br>";

echo("The following is: 10 + 2");
echo "<br>";

echo $Calculator->calc("+", 10, 2); //will output The sum of the numbers is 12
echo "<br>";

echo("The following is: 10 * ");
echo "<br>";

echo $Calculator->calc("*", 10); //will output You must enter a string and two numbers
echo "<br>";

echo("The following is: 10");
echo "<br>";

echo $Calculator->calc(10); //will output You must enter a string and two numbers

?>