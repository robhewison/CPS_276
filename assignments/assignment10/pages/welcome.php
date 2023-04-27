<?php
if (!isset($_SESSION['status']) || $_SESSION['status'] !== 'loggedin') {
    header("Location: index.php?page=login");
    exit;
}

echo "<h1>Welcome, {$_SESSION['name']}</h1>";

if ($_SESSION['user_status'] === 'staff') {
    echo "<a href='index.php?page=addContact'>Add Contact</a><br>";
    echo "<a href='index.php?page=deleteContacts'>Delete Contact(s)</a><br>";
} elseif ($_SESSION['user_status'] === 'admin') {
    echo "<a href='index.php?page=addContact'>Add Contact</a><br>";
    echo "<a href='index.php?page=deleteContacts'>Delete Contact(s)</a><br>";
    echo "<a href='index.php?page=addAdmin'>Add Admin</a><br>";
    echo "<a href='index.php?page=deleteAdmins'>Delete Admin(s)</a><br>";
}

echo "<a href='logout.php'>Logout</a>";
?>
