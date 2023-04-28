<?php

function get_nav() {
    // Determine the user's role and display navigation links accordingly
    $nav_common = <<<HTML
        <nav>
            <ul>
                <li><a href="index.php?page=welcome">Welcome</a></li>
                <li><a href="index.php?page=addContact">Add Contact</a></li>
                <li><a href="index.php?page=deleteContacts">Delete contact(s)</a></li>
    HTML;

    $nav_admin = '';
    if (isset($_SESSION['user_status']) && $_SESSION['user_status'] === 'admin') {
        $nav_admin = <<<HTML
                <li><a href="index.php?page=addAdmin">Add Admin</a></li>
                <li><a href="index.php?page=deleteAdmins">Delete Admin(s)</a></li>
    HTML;
    }

    $nav_logout = '';
    if (isset($_SESSION['status']) && $_SESSION['status'] === 'loggedin') {
        $nav_logout = <<<HTML
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    HTML;
    }

    return $nav_common . $nav_admin . $nav_logout;
}

function get_content($page) {
    ob_start();
    switch ($page) {
        case 'login':
            require_once 'pages/login.php';
            break;
        case 'welcome':
            require_once 'pages/welcome.php';
            break;
        case 'addContact':
            require_once 'pages/addContact.php';
            break;
        case 'deleteContacts':
            require_once 'pages/deleteContacts.php';
            break;
        case 'addAdmin':
            // Check if user has admin privileges
            if (isset($_SESSION['user_status']) && $_SESSION['user_status'] === 'admin') {
                require_once 'pages/addAdmin.php';
            } else {
                header('Location: index.php?page=login');
            }
            break;
        case 'deleteAdmins':
            // Check if user has admin privileges
            if (isset($_SESSION['user_status']) && $_SESSION['user_status'] === 'admin') {
                require_once 'pages/deleteAdmins.php';
            } else {
                header('Location: index.php?page=login');
            }
            break;
        default:
            // Redirect to the login page if an invalid 'page' parameter is provided
            header('Location: index.php?page=login');
            break;
    }
    return ob_get_clean();
}