<?
session_start();
if (!isset($_SESSION["names"])) {
    $_SESSION["names"] = array();
}

$name="";
$empty = array();

if (isset($_POST['addNameButton'])) {
    if(!empty($_REQUEST['nameField'])) {
        $name = $_REQUEST['nameField'];
        $parts = explode(" ", $name);
        $lastname = array_pop($parts);
        $firstname = implode(" ", $parts);
        $namefinalized = $lastname . ", " . $firstname;
        array_push($_SESSION["names"], $namefinalized);
    }
}
elseif (isset($_POST['clearButton'])) {
    $_SESSION["names"] = $empty;
}

?>

<html>
<h1>Add Names</h1>
    <form action="" method="post">
        <input type="submit" name="addNameButton" value="Add Name">
        <input type="submit" name="clearButton" value="Clear Names">
        <br>
        <label for="nameField">Enter Name</label>
        <br>
        <input type="text" name="nameField">
        <br>
    </form>
    <textarea id="displayNames" name="displayNames" rows="10" cols="30"><?php echo implode("\n", $_SESSION["names"]);?></textarea>
</html>