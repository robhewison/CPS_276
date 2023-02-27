<?php

class AddNamesProc {

    private $empty = array();

    public function __construct() {
        session_start();
        if (!isset($_SESSION["names"])) {
            $_SESSION["names"] = array();
        }
    }
    
    public function addClearNames() {
      if (isset($_POST['add_name'])) {
          if (!empty($_POST['name'])) {
              $name = $_POST['name'];
              $parts = explode(" ", $name);
              $lastname = array_pop($parts);
              $firstname = implode(" ", $parts);
              $namefinalized = $lastname . ", " . $firstname;
              array_push($_SESSION["names"], $namefinalized);
              sort($_SESSION["names"]);
          }
      } elseif (isset($_POST['clear_names'])) {
          $_SESSION["names"] = $this->empty;
      }
      return implode("\n", $_SESSION["names"]);
  }

}

?>


