<?php
session_start();

require_once "classes/Db_conn.php";
require_once "classes/Pdo_methods.php";
require_once "classes/StickyForms.php";
require_once "classes/Validation.php";
require_once "pages/routes.php";

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'login';
}

if (isset($_SESSION['status']) && $_SESSION['status'] === 'loggedin') {
    $content = get_content($page);
} else {
    if ($page === 'login') {
        $content = get_content($page);
    } else {
        $content = get_content('login');
    }
}

echo $content;
?>
