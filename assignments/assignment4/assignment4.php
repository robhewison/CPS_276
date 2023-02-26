<?
session_start();
if (!isset($_SESSION["my_array"])) {
    $_SESSION["my_array"] = array();
}
$name="";
$my_array = array();
$oldnames = array();
$new_array = array();

if(isset($_POST['Submit'])){
    array_push($_SESSION["my_array"], $_POST['INPUT']);

    print_r($_SESSION["my_array"]);
    echo "Count:" . count($_SESSION["my_array"]);
}

/*
if ($_POST['myButton'] == 'Add Name') {
    print("add name!");
} else if ($_POST['myButton2'] == 'Clear Names') {
    print("clear name!");
} else {
    //invalid action!
}
*/

if(!empty($_REQUEST['myField'])) {
    $name = $_REQUEST['myField'];
    $my_array[] = $name;
    $new_array = array_push($my_array, $name);

}

print_r($my_array);
echo('<br>');
print_r($_POST);


?>

<html>
    <h1>Add Names</h1>
    <form action="" method="post">
        <input type="submit" name="myButton" value="Add Name">
        <input type="reset" name="myButton2" value="Clear Names">
        <br>
        <label for="myField">Enter Name</label>
        <br>
        <input type="text" name="myField">
        <br>
    </form>
    <textarea id="displayNames" name="displayNames" rows="10" cols="30" >
    </textarea>
</html>
