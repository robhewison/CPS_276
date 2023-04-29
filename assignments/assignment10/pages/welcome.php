<?php
if (!isset($_SESSION['status']) || $_SESSION['status'] !== 'loggedin') {
    header("Location: index.php?page=login");
    exit;
}

/*

// This code was used previously. I'm just keeping it commented out for reference purposes.

if ($_SESSION['user_status'] === 'staff') {
    echo "<a href='index.php?page=addContact'>Add Contact</a>";
    echo "<a href='index.php?page=deleteContacts'>Delete Contact(s)</a>";
} elseif ($_SESSION['user_status'] === 'admin') {
    echo "<a href='index.php?page=addContact'>Add Contact</a>";
    echo "<a href='index.php?page=deleteContacts'>Delete Contact(s)</a>";
    echo "<a href='index.php?page=addAdmin'>Add Admin</a>";
    echo "<a href='index.php?page=deleteAdmins'>Delete Admin(s)</a>";
}
//echo "<a href='logout.php'>Logout</a>";

//echo "<h1>Welcome, {$_SESSION['name']}</h1>";
*/

/*
            THIS CODE WAS UNDER <div class="container"> below

            <?php   
                if ($_SESSION['user_status'] === 'staff') {
                    echo "<a href='index.php?page=addContact' class='me-3'>Add Contact </a>";
                    echo "<a href='index.php?page=deleteContacts' class='me-3'>Delete Contact(s) </a>";
                } elseif ($_SESSION['user_status'] === 'admin') {
                    echo "<a href='index.php?page=addContact' class='me-3'>Add Contact </a>";
                    echo "<a href='index.php?page=deleteContacts' class='me-3'>Delete Contact(s) </a>";
                    echo "<a href='index.php?page=addAdmin' class='me-3'>Add Admin </a>";
                    echo "<a href='index.php?page=deleteAdmins' class='me-3'>Delete Admin(s) </a>";
                }
                echo "<a href='logout.php'>Logout</a>";
            ?>

*/

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Welcome</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <?php echo get_nav(); ?>
            <h1>Welcome</h1>
            <p>Welcome <?php echo $_SESSION['name'] ?></p>
        </div>
</html>