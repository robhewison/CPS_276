<?php

class Calculator {

    public function calc($operator, $num1=null, $num2=null) {
  
        if (!is_string($operator) || !is_numeric($num1) || !is_numeric($num2)) {
            return "You must enter a string and two numbers";
        }
      switch($operator) {
        case '+':
          $result = $num1 + $num2;
          $message = "The sum of the numbers is $result";
          break;
        case '-':
          $result = $num1 - $num2;
          $message = "The difference of the numbers is $result";
          break;
        case '*':
          $result = $num1 * $num2;
          $message = "The product of the numbers is $result";
          break;
        case '/':
          if($num2 == 0) {
            $message = "Cannot divide by zero";
          } else {
            $result = $num1 / $num2;
            $message = "The division of the numbers is $result";
          }
          break;
        default:
          $message = "Invalid operator. Valid operators are: +, -, *, /";
          break;
      }
  
      return $message;
    }
  }

?>